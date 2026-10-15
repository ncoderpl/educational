---
title: 'Serwer Samba: Udostępnianie zasobów dla systemów Windows'
published: true
---

### Heterogeniczne współdzielenie plików – Serwer Samba: Udostępnianie zasobów dla systemów Windows (`smb.conf`), uwierzytelnianie użytkowników Samby, konfiguracja praw dostępu do zasobów i integracja z klientami Windows.

W heterogenicznych środowiskach korporacyjnych standardem jest koegzystencja stacji roboczych z systemami Microsoft Windows oraz serwerów infrastrukturalnych działających pod kontrolą systemu GNU/Linux. Kluczowym wyzwaniem staje się zapewnienie transparentnego, bezpiecznego i wydajnego współdzielenia zasobów dyskowych oraz drukarek pomiędzy tymi odmiennymi platformami. Rozwiązaniem tego problemu jest pakiet **Samba** – wolne oprogramowanie reimplementujące sieciowy protokół **SMB/CIFS** w środowiskach uniksowych.

Niniejszy podręcznik omawia architekturę protokołu SMB, zasady działania demonów Samby, mechanizmy uwierzytelniania w oparciu o niezależną bazę haseł, reguły dwuwarstwowego egzekwowania uprawnień (Samba vs system plików POSIX/ACL), zaawansowaną konfigurację pliku `smb.conf` oraz integrację i diagnostykę połączeń ze stacjami Windows 10 i Windows 11.

---

# Sekcja 1: Architektura protokołu SMB, demony Samby i mechanizmy uwierzytelniania

## 1.1. Ewolucja protokołu SMB/CIFS i anatomia komunikacji sieciowej

Protokół **Server Message Block (SMB)** został opracowany na początku lat 80. przez firmę IBM, a następnie zaadaptowany i rozwinięty przez Microsoft. Przez dekady protokół przeszedł fundamentalną ewolucję: od prymitywnego protokołu dla sieci lokalnych NetBIOS po zaawansowany protokół transportu danych zoptymalizowany pod kątem pracy w rozległych sieciach WAN i centrach danych.

```plaintext
+---------------------------------------------------------------------------------------------------+
| EWOLUCJA ARCHITEKTURY PROTOKOŁU SMB                                                               |
|                                                                                                   |
|  SMB 1.0 / CIFS (Przestarzały, niebezpieczny):                                                   |
|  [Warstwa aplikacji: SMB 1.0]                                                                     |
|          |                                                                                        |
|          v                                                                                        |
|  [NetBIOS over TCP/IP (NBT)]  ---> Porty: UDP 137 (Name), UDP 138 (Datagram), TCP 139 (Session)   |
|          |                                                                                        |
|          v                                                                                        |
|  [Stos TCP/IP]                                                                                    |
|                                                                                                   |
|  SMB 2.x / SMB 3.x (Współczesny standard - Direct Hosted SMB):                                    |
|  [Warstwa aplikacji: SMB 2.0 / 2.1 / 3.0 / 3.1.1]                                                |
|          |                                                                                        |
|          v (Eliminacja narzutu NetBIOS - bezpośrednia enkapsulacja TCP)                           |
|  [Port TCP: 445 (Microsoft-DS)]                                                                   |
|          |                                                                                        |
|          v                                                                                        |
|  [Stos TCP/IP]                                                                                    |
+---------------------------------------------------------------------------------------------------+
```

### Przegląd dialektów protokołu SMB

* **SMB 1.0 / CIFS (*Common Internet File System*):** Silnie związany z przestarzałą warstwą NetBIOS over TCP/IP. Protokół typu *chatty* (wymagał potwierdzenia niemal każdego pakietu osobną ramką), podatny na kolizje, o niskiej wydajności w sieciach o wysokim opóźnieniu (*latency*). Podatny na krytyczne luki w zabezpieczeniach (m.in. luka w obsłudze bufora wykorzystana w ataku ransomware WannaCry przez exploit EternalBlue / MS17-010). **Współcześnie bezwzględnie wycofywany i blokowany.**
* **SMB 2.0 / 2.1 (Windows Vista / 7, Server 2008):** Radykalna redukcja liczby poleceń i podpoleceń (z ponad 100 do 19). Wprowadzenie potokowości zapytań (*pipelining*), powiększenie rozmiaru buforów odczytu/zapisu z 64 KB do 1 MB oraz obsługa buforowania po stronie klienta (*Client-Side Caching / Oplocks*).
* **SMB 3.0 / 3.0.2 (Windows 8 / Server 2012):** Wprowadzenie mechanizmu **SMB Multichannel** (agregacja wielu fizycznych kart sieciowych dla zwiększenia przepustowości i redundancji) oraz natywnego szyfrowania transmisji algorytmem AES-CCM bez konieczności stosowania tuneli IPSec.
* **SMB 3.1.1 (Windows 10 / 11, Server 2016+):** Wymuszenie integralności pre-autoryzacyjnej (*Pre-Authentication Integrity* za pomocą haszowania SHA-512), szyfrowanie algorytmem AES-128-GCM oraz ochrona przed atakami typu Man-in-the-Middle (downgrade attacks).

### Porty sieciowe wykorzystywane przez usługi Samby

| Port | Protokół transportowy | Usługa / Zastosowanie | Status we współczesnych sieciach |
| :--- | :--- | :--- | :--- |
| **445** | **TCP** | **SMB over IP (Direct Hosted / Microsoft-DS)** | **Podstawowy i krytyczny.** Wymagany do transferu plików. |
| **139** | **TCP** | NetBIOS Session Service | Opcjonalny (wsteczna kompatybilność ze starszymi systemami). |
| **137** | **UDP** | NetBIOS Name Service (WINS, rozgłaszanie nazw) | Zbędny w czystych sieciach DNS; zalecany do zablokowania. |
| **138** | **UDP** | NetBIOS Datagram Service (przeglądanie otoczenia sieciowego) | Zbędny w nowoczesnych sieciach. |

---

## 1.2. Architektura procesu Samby: demony `smbd`, `nmbd` i `winbindd`

Oprogramowanie Samba w systemie Linux nie jest pojedynczym programem, lecz zespołem wyspecjalizowanych demonów realizujących odrębne zadania w przestrzeni użytkownika:

```plaintext
+---------------------------------------------------------------------------------------------------+
| ARCHITEKTURA PROCESOWA I MODUŁOWA PAKIETU SAMBA                                                   |
|                                                                                                   |
|  [ KLIENT WINDOWS ]                          [ KLIENT LINUX (cifs-utils) ]                        |
|          \                                                /                                       |
|           \                                              /                                        |
|            v                                            v                                         |
|  +---------------------------------------------------------------------------------------------+  |
|  | SERWER SAMBA (LINUX)                                                                        |  |
|  |                                                                                             |  |
|  |  +-----------------------------+  +---------------------------+  +------------------------+ |  |
|  |  | Demon smbd                  |  | Demon nmbd                |  | Demon winbindd         | |  |
|  |  | - Port TCP: 445 (i 139)     |  | - Porty UDP: 137, 138     |  | - Gniazdo lokalne IPC  | |  |
|  |  | - Transfer plików i folderów|  | - Tłumaczenie nazw NetBIOS|  | - Integracja z domeną  | |  |
|  |  | - Obsługa blokad (Locks)    |  | - Rozgłaszanie otoczenia  |  |   Active Directory     | |  |
|  |  | - Autoryzacja i prawa dost. |  |   sieciowego (Browsing)   |  | - Mapowanie SID <-> UID| |  |
|  |  +-----------------------------+  +---------------------------+  +------------------------+ |  |
|  |                 |                                                             |             |  |
|  |                 v                                                             v             |  |
|  |  +---------------------------------------------------------------------------------------+ |  |
|  |  | BAZY DANYCH TDB (Trivial Database - /var/lib/samba/):                                  | |  |
|  |  | * passdb.tdb  (Baza kont i skrótów haseł NTLM użytkowników Samby)                     | |  |
|  |  | * locking.tdb (Stan blokad współdzielonych plików / oplocks)                           | |  |
|  |  | * secrets.tdb (Klucze maszynowe, poświadczenia domenowe)                             | |  |
|  |  +---------------------------------------------------------------------------------------+ |  |
|  |                 |                                                                           |  |
|  |                 v                                                                           |  |
|  |  +---------------------------------------------------------------------------------------+ |  |
|  |  | JĄDRO SYSTEMU LINUX: VFS (Virtual Filesystem) -> POSIX / ACL -> Dysk fizyczny (ext4/XFS) | |  |
|  |  +---------------------------------------------------------------------------------------+ |  |
|  +---------------------------------------------------------------------------------------------+  |
+---------------------------------------------------------------------------------------------------+
```

### 1. Demon `smbd`
Główny demon wykonawczy serwera. Odpowiada za:
* Zestawianie i obsługę sesji transportowych SMB.
* Uwierzytelnianie użytkowników oraz weryfikację uprawnień do konkretnych zasobów.
* Operacje wejścia/wyjścia na plikach (odczyt, zapis, usuwanie, blokowanie zakresów bajtów).
* Koordynację mechanizmów buforowania i powiadomień o zmianach w strukturze katalogów (*Change Notify*).
* Udostępnianie drukarek za pośrednictwem podsystemu CUPS.

### 2. Demon `nmbd`
Demon odpowiedzialny za usługi zgodności ze standardem NetBIOS over TCP/IP:
* Odpowiada na zapytania o nazwy NetBIOS węzła w sieci lokalnej.
* Umożliwia rejestrację i odpytywanie serwerów WINS (*Windows Internet Name Service*).
* Obsługuje proces wyborów głównej przeglądarki sieci (*Master Browser Election*), która w starszych wersjach systemów Windows odpowiadała za generowanie listy komputerów w folderze „Sieć”.
* *Uwaga wdrożeniowa:* We współczesnych, poprawnie skonfigurowanych sieciach opartych wyłącznie o DNS, demon `nmbd` może zostać bezpiecznie wyłączony.

### 3. Demon `winbindd`
Komponent stosowany w zaawansowanych środowiskach korporacyjnych:
* Integruje serwer Linuksa z usługą katalogową **Microsoft Active Directory (AD DS)**.
* Mapuje identyfikatory bezpieczeństwa Windows (**SID**) na numeryczne identyfikatory uniksowe (**UID** użytkowników i **GID** grup).
* Pozwala użytkownikom domenowym na logowanie się do serwera Linuksa i dostęp do zasobów Samby z wykorzystaniem biletów protokołu Kerberos.

---

## 1.3. Baza tożsamości Samby (`passdb`) a systemowy model kont Linuksa

Jednym z najczęstszych problemów koncepcyjnych u początkujących administratorów jest relacja pomiędzy użytkownikami systemu Linux a użytkownikami Samby.

### Dlaczego Samba nie korzysta bezpośrednio z pliku `/etc/shadow`?
System operacyjny Linux weryfikuje tożsamość użytkowników, porównując hasło wprowadzone przez użytkownika z kryptograficznym haszem zapisanym w `/etc/shadow` (wygenerowanym najczęściej za pomocą nowoczesnych funkcji skrótu, takich jak SHA-512 crypt czy yescrypt). Funkcje te celowo wykorzystują losową sól (*salt*) i tysiące rund obliczeniowych, aby uniemożliwić atak słownikowy.

Protokół Windows SMB nie przesyła hasła użytkownika czystym tekstem przez sieć. Zamiast tego stosuje protokół uwierzytelniania typu wyzwanie-odpowiedź (**NTLMv2** – *NT LAN Manager version 2*). Do obliczenia i zweryfikowania odpowiedzi NTLMv2 niezbędny jest tzw. **NT Hash**, który jest skrótem algorytmu MD4 obliczonym z hasła zakodowanego w formacie UTF-16LE:

$$\text{NT Hash} = \text{MD4}(\text{UTF-16LE}(\text{Hasło}))$$

Z hasza uniksowego zapisanego w `/etc/shadow` **nie da się matematycznie odtworzyć** hasza NTLM ani hasła jawnego. Z tego względu serwer Samba musi utrzymywać **własną, niezależną bazę poświadczeń**.

```plaintext
+-----------------------------------------------------------------------------------+
| ZALEŻNOŚĆ TOŻSAMOŚCI: LINUX OS vs BAZA SAMBY (passdb.tdb)                          |
|                                                                                   |
|  KROK 1: Istnienie konta w systemie operacyjnym (Konto bazowe / Właściciel plików)|
|  +-----------------------------------------------------------------------------+  |
|  | /etc/passwd:   jan:x:1001:1001:Jan Kowalski:/home/jan:/bin/bash             |  |
|  | /etc/shadow:   jan:$6$rounds=5000$saltsalt$hash_sha512...                   |  |
|  +-----------------------------------------------------------------------------+  |
|                                         ^                                         |
|                                         | Wymagana relacja: Użytkownik Samby      |
|                                         | MUSI posiadać odpowiednik w /etc/passwd!|
|                                         |                                         |
|  KROK 2: Dopisanie tożsamości do bazy NTLM serwera Samba                          |
|  +-----------------------------------------------------------------------------+  |
|  | /var/lib/samba/private/passdb.tdb                                           |  |
|  | Użytkownik: jan (UID 1001)                                                  |  |
|  | Skrót NTLM: 32915A7601409C0C10204E595D3... (Weryfikacja protokołu SMB)      |  |
|  +-----------------------------------------------------------------------------+  |
+-----------------------------------------------------------------------------------+
```

### Zarządzanie tożsamością: Narzędzia `smbpasswd` i `pdbedit`

Aby użytkownik mógł uzyskać dostęp do autoryzowanego zasobu Samby:
1. Musi fizycznie istnieć w systemie Linux (posiadać wpis w `/etc/passwd`). Jeśli konto ma służyć wyłącznie do wymiany plików bez prawa logowania do powłoki Linuksa, tworzy się je z powłoką `/sbin/nologin` lub `/bin/false`.
2. Musi zostać wprowadzony do bazy Samby (`passdb.tdb`) wraz z wygenerowanym skrótem NTLM.

```bash
# 1. Utworzenie systemowego konta technicznego bez prawa interaktywnego logowania (brak shella)
sudo useradd -M -s /usr/sbin/nologin ksiegowy1

# 2. Dodanie użytkownika do bazy Samby i ustawienie hasła SMB (flaga -a)
sudo smbpasswd -a ksiegowy1

# 3. Zmiana hasła istniejącego użytkownika Samby
sudo smbpasswd ksiegowy1

# 4. Czasowe zablokowanie (wyłączenie) konta w Sambie
sudo smbpasswd -d ksiegowy1

# 5. Odblokowanie konta
sudo smbpasswd -e ksiegowy1

# 6. Usunięcie konta z bazy Samby
sudo smbpasswd -x ksiegowy1
```

Zaawansowane zarządzanie bazą użytkowników realizuje polecenie `pdbedit`:

```bash
# Wypisanie listy użytkowników zarejestrowanych w bazie Samby
sudo pdbedit -L

# Wyświetlenie szczegółowych metadanych konta (flagi konta, data zmiany hasła, SID)
sudo pdbedit -L -v -u ksiegowy1
```

---

## 1.4. Dwuwarstwowy model uprawnień: Uprawnienia udziału (Samba) a uprawnienia systemu plików (POSIX/ACL)

Kluczową zasadą architektury bezpieczeństwa Samby jest **zasada koniunkcji ograniczeń (najbardziej restrykcyjne uprawnienie wygrywa)**. Żądanie dostępu klienta Windows przechodzi przez dwa niezależne filtry ochronne:

```plaintext
+-----------------------------------------------------------------------------------+
| DWUWARSTWOWY FILTR UPRAWNIEŃ DO ZASOBU                                            |
|                                                                                   |
|  Żądanie klienta: ZAPIS PLIKU (Write Request)                                     |
|         |                                                                         |
|         v                                                                         |
|  [ WARSTWA 1: UPRAWNIENIA UDZIAŁU W SAMBIE (smb.conf) ]                           |
|  * Czy udział jest 'read only = no' (writable = yes)?                             |
|  * Czy użytkownik znajduje się na liście 'write list'?                            |
|  * Czy użytkownik nie jest zablokowany przez 'invalid users'?                     |
|         |                                                                         |
|         +----> NIE  ===> BŁĄD: ODMOWA DOSTĘPU (Access Denied / NT_STATUS_ACCESS_DENIED)
|         |                                                                         |
|         v TAK                                                                     |
|  [ WARSTWA 2: UPRAWNIENIA SYSTEMU PLIKÓW LINUKSA (Kernel VFS) ]                   |
|  * Tradycyjne uprawnienia POSIX (UGO / Owner-Group-Others) katalogu na dysku      |
|  * Listy kontroli dostępu POSIX ACL (getfacl / setfacl)                           |
|  * Kontekst bezpieczeństwa SELinux / Profile AppArmor                             |
|         |                                                                         |
|         +----> NIE  ===> BŁĄD: ODMOWA DOSTĘPU (Access Denied / EACCES)            |
|         |                                                                         |
|         v TAK                                                                     |
|  [ SUKCES: Plik zostaje fizycznie zapisany w systemie plików ]                    |
+-----------------------------------------------------------------------------------+
```

### Przykład konfliktu uprawnień:
* Jeśli w `smb.conf` zdefiniowano `read only = no`, ale katalog na dysku posiada uprawnienia `drwxr-xr-x` (`755`) i należy do użytkownika `root`, to zwykły użytkownik uwierzytelniony w Sambie **nie zapisze żadnego pliku**, ponieważ zablokuje go jądro systemu operacyjnego (Warstwa 2).
* Jeśli katalog na dysku ma uprawnienia `rwxrwxrwx` (`777`), ale w `smb.conf` wpisano `read only = yes`, to użytkownik również **nie zapisze pliku**, ponieważ operację zablokuje demon `smbd` (Warstwa 1).

---

# Sekcja 2: Implementacja wdrożeniowa, konfiguracja `smb.conf`, integracja z Windows i diagnostyka

## 2.1. Anatomia pliku `smb.conf`: Konfiguracja globalna i hardening

Głównym plikiem sterującym zachowaniem serwera jest `/etc/samba/smb.conf`. Posiada strukturę zbliżoną do plików INI, podzieloną na sekcje oznaczone nawiasami kwadratowymi:
* `[global]` – parametry wpływające na całą instancję serwera, mechanizmy uwierzytelniania, wersje protokołów, logowanie i zachowania sieciowe.
* `[homes]` – specjalna sekcja automatycznie generująca prywatny udział domowy dla każdego zalogowanego użytkownika.
* `[printers]` / `[print$]` – definicje integracji z podsystemem buforowania wydruków.
* `[nazwa_udzialu]` – dowolnie nazywane sekcje definiujące współdzielone katalogi.

Poniższy listing przedstawia utwardzony, produkcyjny blok `[global]` zoptymalizowany pod kątem bezpieczeństwa i wydajności:

```ini
# /etc/samba/smb.conf
# ==============================================================================
# 1. KONFIGURACJA GLOBALNA I BEZPIECZEŃSTWO (GLOBAL SETTINGS)
# ==============================================================================
[global]
    # Nazwa grupy roboczej Windows lub domeny NetBIOS
    workgroup = WORKGROUP

    # Ciąg identyfikacyjny prezentowany w sieci (opis serwera)
    server string = Serwer Plikow Samba %v (Wydzial IT)

    # Model bezpieczeństwa: USER (wymaga poprawnego uwierzytelnienia użytkownika)
    security = user

    # Zachowanie w przypadku podania nieznanego loginu:
    # 'bad user' automatycznie degraduje nieznanego użytkownika do konta gościa (guest account).
    # Pozwala na współistnienie zasobów prywatnych oraz publicznych bez ciągłych monitów o hasło.
    map to guest = bad user

    # Nazwa systemowego konta Linuksa używanego do operacji anonimowych (gościa)
    guest account = nobody

    # --------------------------------------------------------------------------
    # PROTOKOŁY I HARDENING SIECIOWY
    # --------------------------------------------------------------------------
    # Wymuszenie minimalnej wersji protokołu SMB na poziomie SMB2_10 (blokada SMB1/WannaCry)
    server min protocol = SMB2_10
    client min protocol = SMB2_10

    # Wyłączenie przestarzałej obsługi zapytań rozgłoszeniowych NetBIOS (nasłuch wyłącznie na TCP 445)
    disable netbios = yes

    # Ograniczenie interfejsów sieciowych, na których demon ma nasłuchiwać
    interfaces = 127.0.0.1 192.168.10.0/24 enp0s8
    bind interfaces only = yes

    # --------------------------------------------------------------------------
    # LOGOWANIE I DIAGNOSTYKA
    # --------------------------------------------------------------------------
    # Ścieżka do logów dzielonych na poszczególne komputery klienckie (%m = nazwa klienta NetBIOS)
    log file = /var/log/samba/log.%m

    # Maksymalny rozmiar pojedynczego pliku logu w KB (tutaj: 10 MB), po przekroczeniu następuje rotacja
    max log size = 10000

    # Poziom szczegółowości logowania (0 - tylko błędy krytyczne, 1 - ostrzeżenia, 3 - debug)
    log level = 1

    # --------------------------------------------------------------------------
    # ZAAWANSOWANA OBSŁUGA METADANYCH I ROZSZERZEŃ (VFS OBJECTS)
    # --------------------------------------------------------------------------
    # Integracja z atrybutami rozszerzonymi Linuksa oraz obsługa kosza sieciowego
    vfs objects = acl_xattr fruit streams_xattr
```

---

## 2.2. Wzorce projektowe udziałów: Zasób publiczny, działowy i prywatny

W strukturze enterprise najczęściej zachodzi potrzeba wdrożenia trzech odmiennych scenariuszy udostępniania katalogów.

```plaintext
+---------------------------------------------------------------------------------------------------+
| ARCHITEKTURA ZASOBÓW SIECIOWYCH W TYPOWYM PRZEDSIĘBIORSTWIE                                       |
|                                                                                                   |
|  /srv/samba/                                                                                      |
|  ├── publiczny/             -> [publiczny]  Dostęp anonimowy (Gość: Odczyt/Zapis)                 |
|  ├── kadry/                 -> [kadry]      Dostęp ograniczony ściśle do grupy 'kadry_gr'         |
|  └── domowe/                                                                                      |
|      ├── jan/               -> [homes]      Izolowany katalog prywatny użytkownika 'jan'          |
|      └── anna/              -> [homes]      Izolowany katalog prywatny użytkowniczki 'anna'       |
+---------------------------------------------------------------------------------------------------+
```

Dopisz do pliku `/etc/samba/smb.conf` poniższe definicje udziałów:

```ini
# ==============================================================================
# SCENARIUSZ A: ZASÓB PUBLICZNY (Dla wszystkich pracowników i gości)
# ==============================================================================
[publiczny]
    comment = Folder Wymiany Ogolnej (Dostep bezhaslowy)
    path = /srv/samba/publiczny
    browseable = yes
    read only = no
    guest ok = yes
    guest only = yes
    
    # Maski uprawnień nadawane nowo tworzonym plikom i folderom
    create mask = 0666
    directory mask = 0777
    force user = nobody
    force group = nogroup

# ==============================================================================
# SCENARIUSZ B: ZASÓB DZIAŁOWY / OGRANICZONY (Ściśle dla uprawnionej grupy)
# ==============================================================================
[kadry]
    comment = Dokumentacja Poufna Dzialu Kadr
    path = /srv/samba/kadry
    browseable = yes
    read only = no
    guest ok = no

    # Dostęp zezwolony wyłącznie członkom grupy 'kadry_gr' (prefiks @ oznacza grupę)
    valid users = @kadry_gr

    # Lista użytkowników i grup uprawnionych do zapisu
    write list = @kadry_gr

    # Wymuszenie dziedziczenia grupy i masek uprawnień
    force group = kadry_gr
    create mask = 0660
    directory mask = 0770

# ==============================================================================
# SCENARIUSZ C: AUTOMATYCZNE KATALOGI DOMOWE UŻYTKOWNIKÓW (Prywatne)
# ==============================================================================
[homes]
    comment = Prywatny folder uzytkownika %S
    browseable = no
    read only = no
    guest ok = no
    valid users = %S
    create mask = 0700
    directory mask = 0700
```

### Wyjaśnienie kluczowych dyrektyw i makr Samby:
* `browseable = yes/no`: Określa, czy folder jest widoczny na liście zasobów serwera przy przeglądaniu otoczenia sieciowego. Udział `[homes]` musi mieć wartość `no`, aby użytkownicy nie widzieli listy katalogów swoich współpracowników.
* `read only = no` (synonim: `writable = yes`): Zezwala na modyfikację i zapis danych w udziale (pod warunkiem spełnienia wymogów warstwy systemu plików).
* `guest ok = yes` (synonim: `public = yes`): Zezwala na dostęp do udziału bez podawania poświadczeń (jako użytkownik zmapowany w dyrektywie `guest account`).
* `valid users`: Biała lista użytkowników lub grup (oznaczanych prefiksem `@`), którzy mają prawo podłączyć się do zasobu.
* `write list`: Wyszczególnienie podzbioru uprawnionych użytkowników, którzy mogą zapisywać dane w udziale skonfigurowanym jako `read only = yes`.
* **Makra systemowe:**
  * `%u`: Nazwa zalogowanego użytkownika.
  * `%m`: Nazwa NetBIOS stacji roboczej klienta.
  * `%I`: Adres IP klienta.
  * `%S`: Nazwa bieżącej sekcji/udziału (w `[homes]` reprezentuje login użytkownika).

---

## 2.3. Praktyczna konfiguracja uprawnień dyskowych (POSIX i POSIX ACL)

Zdefiniowanie udziałów w `smb.conf` nie zadziała, dopóki katalogi na fizycznym dysku twardym Linuksa nie zostaną poprawnie utworzone i zabezpieczone.

### Krok 1: Przygotowanie grup, użytkowników i struktury folderów

```bash
# 1. Utworzenie grupy działowej
sudo groupadd kadry_gr

# 2. Utworzenie użytkowników systemowych i przypisanie do grupy
sudo useradd -M -s /usr/sbin/nologin -G kadry_gr pracownik1
sudo useradd -M -s /usr/sbin/nologin -G kadry_gr pracownik2
sudo useradd -M -s /usr/sbin/nologin stazysta1 # Nie należy do grupy kadry_gr

# 3. Zarejestrowanie haseł w bazie Samby
sudo smbpasswd -a pracownik1
sudo smbpasswd -a pracownik2
sudo smbpasswd -a stazysta1

# 4. Utworzenie fizycznych katalogów w systemie plików
sudo mkdir -p /srv/samba/publiczny
sudo mkdir -p /srv/samba/kadry
```

### Krok 2: Nadanie uprawnień POSIX (Katalog publiczny)

Dla katalogu publicznego właścicielem musi być konto systemowe `nobody:nogroup`:

```bash
sudo chown -R nobody:nogroup /srv/samba/publiczny
sudo chmod -R 0777 /srv/samba/publiczny
```

### Krok 3: Nadanie uprawnień POSIX i flagi SGID (Katalog działowy)

Dla zasobu `kadry` właścicielem grupy musi być `kadry_gr`. Krytycznym elementem jest nadanie specjalnego bitu **SGID (Set Group ID – wartość `2` w ósemkowym zapisie uprawnień)** na katalogu:

```bash
# Ustawienie właściciela: root, grupa: kadry_gr
sudo chown -R root:kadry_gr /srv/samba/kadry

# Uprawnienia: Pełny dostęp dla właściciela i grupy, całkowity zakaz dla innych (770)
sudo chmod -R 0770 /srv/samba/kadry

# Nadanie bitu SGID na katalogu
sudo chmod g+s /srv/samba/kadry
```

> **Dlaczego bit SGID jest niezbędny?** W systemie Linux nowo tworzony plik otrzymuje jako grupę domyślną grupę podstawową użytkownika, który go stworzył. Gdyby pracownik1 utworzył plik w folderze kadry, otrzymałby on grupę `pracownik1`. Bit SGID (`chmod g+s`) wymusza, aby każdy nowy plik i podfolder utworzony wewnątrz `/srv/samba/kadry` **automatycznie dziedziczył grupę nadrzędną katalogu (`kadry_gr`)**, co gwarantuje stały dostęp pozostałym członkom zespołu.

### Krok 4: Zastosowanie zaawansowanych list kontroli dostępu (POSIX ACL)

Jeśli wymagane jest bardziej granularne sterowanie uprawnieniami (np. zapewnienie audytorowi prawa wyłącznie do odczytu całego zasobu kadr), tradycyjny model `UGO` staje się niewystarczający. Stosuje się wtedy narzędzia `setfacl` oraz `getfacl`:

```bash
# Nadanie użytkownikowi 'audytor' prawa tylko do odczytu (r-x) do katalogu kadry
sudo setfacl -m u:audytor:r-x /srv/samba/kadry

# Ustawienie domyślnej listy ACL (Default ACL - flaga -d), 
# która będzie automatycznie dziedziczona przez wszystkie nowo tworzone pliki:
sudo setfacl -d -m g:kadry_gr:rwx /srv/samba/kadry
sudo setfacl -d -m u:audytor:r-x /srv/samba/kadry

# Weryfikacja aktywnych uprawnień ACL na katalogu
getfacl /srv/samba/kadry
```

---

## 2.4. Integracja z klientami Windows

Podłączenie stacji roboczej z systemem Windows 10/11 do linuksowego serwera Samby realizowane jest na kilka sposobów.

### Metoda A: Dostęp doraźny przez pasek adresu Eksploratora plików
Wciśnij kombinację klawiszy `Win + R` i wprowadź ścieżkę UNC (*Universal Naming Convention*):
```text
\\192.168.10.1\kadry
```
lub z wykorzystaniem nazwy serwera:
```text
\\SRV-SAMBA\kadry
```
W oknie logowania Windows wprowadź poświadczenia utworzone wcześniej poleceniem `smbpasswd` (np. login: `pracownik1`, hasło: `zaq1@WSX`).

### Metoda B: Trwałe mapowanie dysku sieciowego (PowerShell / CMD)
Zautomatyzowane przypisanie litery dysku za pomocą wiersza poleceń:

```cmd
:: Mapowanie udziału kadry pod literę Z: z jawnym podaniem poświadczeń
net use Z: \\192.168.10.1\kadry /user:pracownik1 B4rdzo$ilneHaslo /persistent:yes

:: Odłączenie zmapowanego dysku
net use Z: /delete
```

W nowoczesnym środowisku PowerShell:

```powershell
New-PSDrive -Name "Y" -PSProvider "FileSystem" -Root "\\192.168.10.1\publiczny" -Persist
```

### Pułapka architektoniczna: Menedżer poświadczeń Windows (Credential Manager)
Częstym problemem zgłaszanym przez administratorów jest błąd systemu Windows:
> *"Wielokrotne połączenia z serwerem lub zasobem współdzielonym przez tego samego użytkownika przy użyciu więcej niż jednej nazwy użytkownika są niedozwolone."*

Wynika to z faktu, że system Windows w ramach jednej sesji logowania pozwala na zestawienie tylko **jednego kontekstu bezpieczeństwa SMB do danego serwera docelowego (IP/Nazwa)**. 
* Jeśli użytkownik najpierw wszedł do udziału `\\192.168.10.1\publiczny` jako gość (`nobody`), Windows nie pozwoli mu wejść do `\\192.168.10.1\kadry` jako `pracownik1`.
* **Rozwiązanie:** Należy zresetować bufor poświadczeń w wierszu poleceń:
  ```cmd
  net use * /delete /y
  ```
  lub wymusić zapisanie poświadczeń w: *Panel sterowania $\rightarrow$ Menedżer poświadczeń $\rightarrow$ Poświadczenia systemu Windows $\rightarrow$ Dodaj poświadczenie systemu Windows*.

### Problem bezpieczeństwa: Blokada „Insecure Guest Logons” w Windows 10 / 11
Począwszy od nowszych kompilacji Windows 10 Pro/Enterprise oraz domyślnie w systemie **Windows 11 (od wersji 24H2)**, Microsoft wprowadził blokadę niesprawdzonych logowań gościa (*Insecure guest logons*). Przy próbie wejścia do bezhasłowego folderu `[publiczny]` klient Windows wyświetla błąd:
> *"Nie można uzyskać dostępu do tego folderu udostępnionego, ponieważ zasady bezpieczeństwa Twojej organizacji blokują nieuwierzytelniony dostęp gościa."*

**Rozwiązanie po stronie Windows (jeśli zasób publiczny musi działać):**
1. Uruchom edytor zasad grupy: `gpedit.msc`.
2. Przejdź do ścieżki: *Konfiguracja komputera $\rightarrow$ Szablony administracyjne $\rightarrow$ Sieć $\rightarrow$ Stacja robocza Lanman*.
3. Odszukaj zasadę: **Włącz niezabezpieczone logowania gości** (*Enable insecure guest logons*).
4. Przestaw jej stan na: **Włączone** i zatwierdź.
5. Zastosuj zmiany w terminalu Windows poleceniem: `gpupdate /force`.

---

## 2.5. Diagnostyka, inspekcja stanu i rozwiązywanie problemów

Praca z serwerem Samba wymaga opanowania procedur diagnostycznych eliminujących błędy składniowe, blokady sieciowe oraz konflikty uprawnień.

```plaintext
+-----------------------------------------------------------------------------------+
| DRZEWO DIAGNOSTYCZNE USŁUGI SAMBA                                                 |
|                                                                                   |
| 1. TEST SKŁADNI:                                                                  |
|    $ testparm -s                                                                  |
|    Sprawdzenie błędów parsowania smb.conf i nieprawidłowych dyrektyw.             |
|                                                                                   |
| 2. TEST PROCESÓW I GNIAZD SIECIOWYCH:                                             |
|    $ sudo ss -tulnp | grep -E '445|139'                                           |
|    Weryfikacja czy demon smbd nasłuchuje na właściwych interfejsach IP.           |
|                                                                                   |
| 3. TEST ZAPORY SIECIOWEJ (FIREWALL):                                              |
|    Upewnij się, że ruch na porcie TCP 445 nie jest odrzucany (DROP/REJECT).       |
|                                                                                   |
| 4. TEST LOKALNY KLIENTA (Loopback):                                               |
|    $ smbclient -L //localhost -U pracownik1                                       |
|    Eliminacja problemów sieciowych - weryfikacja bazy passdb.tdb.                 |
|                                                                                   |
| 5. MONITOROWANIE AKTYWNYCH POŁĄCZEŃ I BLOKAD:                                     |
|    $ sudo smbstatus                                                               |
|    Podgląd aktywnych sesji SMB, zalogowanych maszyn i zablokowanych plików.       |
+-----------------------------------------------------------------------------------+
```

### 1. Walidacja pliku konfiguracyjnego (`testparm`)
Polecenie `testparm` przetwarza plik `/etc/samba/smb.conf` pod kątem błędów składni, nieznanych parametrów oraz wyświetla efektywną konfigurację serwera (z pominięciem opcji domyślnych):

```bash
# Weryfikacja składni
testparm -s

# Prawidłowy wynik kończy się komunikatem:
# Loaded services file OK.
# Server role: ROLE_STANDALONE
# Press enter to see a dumped Services list...
```

### 2. Narzędzie testowe `smbclient`
Pozwala na przetestowanie widoczności udziałów i poprawności autoryzacji bezpośrednio z konsoli Linuksa:

```bash
# Wylistowanie udziałów dostępnych na serwerze dla danego użytkownika
smbclient -L //127.0.0.1 -U pracownik1

# Interaktywne połączenie z udziałem w trybie tekstowym (podobnym do klienta FTP)
smbclient //127.0.0.1/kadry -U pracownik1
# smb: \> ls
# smb: \> put plik_testowy.txt
# smb: \> exit
```

### 3. Inspekcja stanu w czasie rzeczywistym (`smbstatus`)
W środowiskach produkcyjnych kluczowa jest wiedza o tym, kto jest aktualnie połączony z serwerem i jakie pliki ma otwarte w trybie wyłącznym:

```bash
# Pełny raport statusu: aktywne procesy PID, zalogowani użytkownicy, wersje SMB i blokady
sudo smbstatus

# Wyświetlenie wyłącznie listy zablokowanych plików (Locked files)
sudo smbstatus -L

# Wyświetlenie wyłącznie aktywnych połączeń do udziałów (Shares)
sudo smbstatus -S
```

### 4. Konfiguracja zapory sieciowej (Firewall) dla Samby

#### Ubuntu / Debian (UFW):
```bash
# Otwarcie dedykowanego profilu aplikacji Samba (porty 137, 138, 139, 445)
sudo ufw allow Samba comment 'Samba File Server'

# LUB otwarcie wyłącznie bezpiecznego portu bezpośredniego SMB (rekomendowane):
sudo ufw allow 445/tcp comment 'SMB Direct'
sudo ufw reload
```

#### Rocky Linux / RHEL (firewalld):
```bash
sudo firewall-cmd --permanent --add-service=samba
sudo firewall-cmd --reload
```

### 5. SELinux – Rozwiązywanie problemów w systemach Enterprise (Rocky Linux / RHEL)
W systemach z aktywnym modułem **SELinux** (Security-Enhanced Linux) samo nadanie uprawnień POSIX nie wystarczy. Domyślna polityka blokuje procesowi `smbd` dostęp do katalogów, które nie posiadają odpowiedniego kontekstu bezpieczeństwa.

```bash
# Błędny objaw: Mimo chmod 777 w logach pojawia się "Permission denied"

# 1. Nadanie właściwego kontekstu SELinux dla współdzielonego folderu
sudo semanage fcontext -a -t samba_share_t "/srv/samba(/.*)?"

# 2. Zastosowanie etykiet w strukturze plików
sudo restorecon -R -v /srv/samba

# 3. Zezwolenie na współdzielenie katalogów domowych użytkowników (jeśli używamy [homes])
sudo setsebool -P samba_enable_home_dirs on
```

---
## Pytania do lekcji
1. Jakie kluczowe usprawnienia wprowadziła wersja protokołu SMB 2.x względem przestarzałego SMB 1.0/CIFS, i dlaczego SMB 1.0 jest dziś bezwzględnie wycofywany?
2.  Jaką rolę pełnią odpowiednio demony `smbd`, `nmbd` i `winbindd` w architekturze Samby, i który z nich można bezpiecznie wyłączyć w sieci opartej wyłącznie na DNS?
3. Dlaczego Samba nie może korzystać bezpośrednio z hasha hasła zapisanego w `/etc/shadow` i musi utrzymywać własną, niezależną bazę poświadczeń `(passdb.tdb)`?
4. Jakie dwa warunki musi spełnić użytkownik systemowy, aby mógł uzyskać dostęp do zasobu Samby, i jakich poleceń używa się do zarządzania jego kontem w bazie Samby?
5. Na czym polega „zasada koniunkcji ograniczeń” w dwuwarstwowym modelu uprawnień Samby, i co się stanie, gdy `smb.conf` zezwala na zapis, a uprawnienia POSIX katalogu na dysku tego zabraniają?
6. Do czego służy dyrektywa `map` to guest = bad user w sekcji `[global]`, i jakie konto systemowe zwykle pełni rolę `guest account`?
7. Dlaczego w udziale działowym (np. [kadry]) konieczne jest nadanie katalogowi bitu SGID (`chmod g+s`), i co by się stało bez tego ustawienia?
8.Wyjaśnij różnicę między dyrektywami `valid users`, `write list` oraz `read` only w kontekście udziału Samby skonfigurowanego jako `read only = yes`.
9. Jaka jest przyczyna błędu Windows „Wielokrotne połączenia z serwerem... przy użyciu więcej niż jednej nazwy użytkownika są niedozwolone”, i jakim poleceniem można go rozwiązać po stronie klienta?
10. Jakie dodatkowe kroki (poza standardowymi uprawnieniami POSIX/ACL) są wymagane, aby demon `smbd` mógł poprawnie udostępnić katalog na serwerze z aktywnym modułem SELinux (Rocky Linux/RHEL)?