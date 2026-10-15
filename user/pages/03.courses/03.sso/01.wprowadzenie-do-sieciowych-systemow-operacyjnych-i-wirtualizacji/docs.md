---
title: 'Wprowadzenie do sieciowych systemów operacyjnych i wirtualizacji'
published: true
---

Sieciowy system operacyjny (ang. *Network Operating System* – NOS) to wyspecjalizowany system zaprojektowany do jednoczesnej obsługi wielu żądań sieciowych, centralnego zarządzania tożsamością i uprawnieniami, koordynacji współdzielonych zasobów dyskowych oraz ciągłego świadczenia usług w architekturze klient-serwer.

W odróżnieniu od systemów stacyjnych (klienckich), w środowiskach serwerowych priorytetem projektowym nie jest płynność interfejsu graficznego dla pojedynczego operatora, lecz maksymalna przepustowość wejścia/wyjścia (I/O), stabilność wielowątkowa, odporność na awarie komponentów oraz praca ciągła w trybie 24/7/365.

## 1. System serwerowy a stacja robocza – różnice architektoniczne

Choć systemy klienckie i serwerowe z tej samej rodziny (np. Windows 11 i Windows Server 2022 lub Ubuntu Desktop i Ubuntu Server) bazują na zbliżonym kodzie źródłowym jądra, różnią się parametrami kompilacji, zachowaniem planisty zadań oraz ograniczeniami licencyjno-sprzętowymi.

```text
+-----------------------------------------------------------------------------------+
|                        KLIENT (Desktop OS) vs SERWER (Server OS)                  |
+------------------------------------+----------------------------------------------+
| Stacja robocza (np. Win 11/Ubuntu) | Serwer sieciowy (Windows Server/Debian)      |
+------------------------------------+----------------------------------------------+
| Optymalizacja schedulera CPU pod   | Optymalizacja pod wątki w tle i usługi       |
| interaktywne aplikacje na pulpicie | sieciowe (Network I/O, bazy danych, RPC)     |
+------------------------------------+----------------------------------------------+
| Sztuczne limity TCP/IP (np. maks.  | Brak ograniczeń współbieżnych połączeń       |
| 10-20 jednoczesnych połączeń SMB)  | (limit determinuje sprzęt i zakupione CAL)   |
+------------------------------------+----------------------------------------------+
| Wsparcie dla 1-2 gniazd CPU        | Wsparcie do 64 gniazd CPU, architektury NUMA |
| i zazwyczaj do 128 GB - 2 TB RAM   | i do 24-48 TB pamięci operacyjnej RAM        |
+------------------------------------+----------------------------------------------+
| Interfejs graficzny jako warstwa   | Możliwość pracy headless (Server Core/CLI)   |
| krytyczna i nieusuwalna            | bez GUI, oszczędzając zasoby i wektory ataku |
+------------------------------------+----------------------------------------------+
```

* **Planowanie czasu procesora (CPU Scheduling):**
  * System kliencki przydziela krótsze kwanty czasu procesora (*quantum*), reagując dynamicznie na zdarzenia interfejsu i ruch kursora.
  * System serwerowy stosuje dłuższe kwanty czasu procesora, co minimalizuje koszt przełączania kontekstu (*context switching*) przy przetwarzaniu zapytań bazodanowych i transakcji sieciowych.
* **Wsparcie sprzętowe klasy Enterprise:**
  * Natywna współpraca z pamięciami RAM z korekcją błędów (ECC / ECC Registered), zapobiegająca awariom wywołanym przekłamaniem pojedynczych bitów (*single-bit errors*).
  * Pełna obsługa architektury NUMA (*Non-Uniform Memory Access*), optymalizująca dostęp procesorów wielogniazdowych do fizycznie przypisanych im banków pamięci operacyjnej.

## 2. Architektura systemu Windows Server

Windows Server bazuje na architekturze jądra hybrydowego (*Hybrid Kernel*), dzielącego przestrzeń adresową procesora na dwa odizolowane pierścienie ochrony: **Tryb Użytkownika (User Mode)** oraz **Tryb Jądra (Kernel Mode)**.

```text
+-------------------------------------------------------------------------------+
|                     TRYB UŻYTKOWNIKA (User Mode / Ring 3)                     |
|  +------------------------+  +------------------------+  +-----------------+  |
|  |  Procesy logowania     |  |   Usługi systemowe     |  |   Aplikacje     |  |
|  |  i tożsamości (LSASS)  |  |   (DNS, DHCP, IIS)     |  |   użytkownika   |  |
|  +------------------------+  +------------------------+  +-----------------+  |
+---------------------------------------+---------------------------------------+
                                        | Wywołania systemowe (System API / Ntdll)
+---------------------------------------v---------------------------------------+
|                       TRYB JĄDRA (Kernel Mode / Ring 0)                       |
|  +-------------------------------------------------------------------------+  |
|  |                      Usługi wykonawcze (Executive)                      |  |
|  |  [I/O Mgr]  [Pamięć wirtualna]  [Object Mgr]  [Sterowniki NTFS / ReFS]  |  |
|  +-------------------------------------------------------------------------+  |
|  |                        Mikrojądro (Microkernel)                         |  |
|  |              Szeregowanie wątków, obsługa przerwań procesora            |  |
|  +-------------------------------------------------------------------------+  |
|  |               Warstwa abstrakcji sprzętowej (HAL)                       |  |
|  +-------------------------------------------------------------------------+  |
+---------------------------------------+---------------------------------------+
                                        | Dostęp do magistrali i rejestrów
+---------------------------------------v---------------------------------------+
|                               SPRZĘT (Hardware)                               |
|                   Procesory (CPU), Pamięć RAM (ECC), Płyta główna             |
+-------------------------------------------------------------------------------+
```
*Rysunek 1: Pierścienie ochrony i podział na Kernel Mode oraz User Mode w systemie Windows Server.*

### Tryb Jądra (Kernel Mode)
* **HAL (Hardware Abstraction Layer):** Warstwa abstrakcji sprzętowej izolująca wyższe warstwy systemu od specyfiki płyt głównych, magistrali i chipsetów.
* **Mikrojądro (Microkernel):** Realizuje operacje niskopoziomowe: szeregowanie wątków, obsługę przerwań sprzętowych oraz synchronizację wieloprocesorową.
* **Usługi wykonawcze (Executive Services):** Zestaw modułów zarządzających: Virtual Memory Manager (pamięć wirtualna), Object Manager, I/O Manager oraz sterowniki systemów plików (NTFS, ReFS).

### Tryb Użytkownika (User Mode)
* **Podsystem zabezpieczeń (LSASS):** Odpowiada za weryfikację uprawnień, generowanie tokenów dostępu i obsługę uwierzytelniania domenowego Active Directory.
* **Usługi systemowe i aplikacje:** Procesy działające w odizolowanych, prywatnych przestrzeniach adresowych. Ewentualna awaria usługi użytkownika nie narusza stabilności całego systemu.

### Koncepcja Ról (Roles) i Funkcji (Features)

```text
                      +------------------------------------------+
                      |         KONSOLA MENEDŻERA SERWERA        |
                      |             (Server Manager)             |
                      +---------------------+--------------------+
                                            |
                    +-----------------------+-----------------------+
                    |                                               |
        +-----------v-----------+                       +-----------v-----------+
        |     ROLE SERWERA      |                       |   FUNKCJE SYSTEMOWE   |
        |        (ROLES)        |                       |       (FEATURES)      |
        +-----------------------+                       +-----------------------+
        | * Kontroler domeny    |                       | * Klastrowanie        |
        |   (AD DS, LDAP, KDC)  |                       |   Failover Cluster    |
        | * Serwer nazw DNS     |                       | * Narzędzia RSAT      |
        | * Usługa DHCP         |                       | * Zarządzanie MPIO    |
        | * Usługi sieciowe IIS |                       | * Moduł WSL           |
        +-----------------------+                       +-----------------------+
```

* **Rola serwera (Server Role):** Zespół programów definiujący główne zadanie serwera w sieci (np. kontroler domeny AD DS, serwer DNS, serwer plików).
* **Funkcja serwera (Feature):** Oprogramowanie wspierające pracę ról lub rozszerzające możliwości diagnostyczne i klastrowe systemu.

### Warianty wdrożeniowe: Desktop Experience vs Server Core
1. **Server with Desktop Experience:** Pełne środowisko graficzne GUI. Dedykowane dla środowisk testowych oraz aplikacji firm trzecich wymagających okienkowego instalatora.
2. **Server Core:** Rekomendowany tryb produkcyjny pozbawiony powłoki graficznej `explorer.exe`. 
   * Zmniejsza zapotrzebowanie na pamięć RAM i przestrzeń dyskową o ponad 60%.
   * Drastycznie redukuje liczbę wymaganych restartów i podatności na ataki (brak bibliotek multimedialnych i przeglądarki).
   * Administrowany przez PowerShell, konsolę `sconfig`, Windows Admin Center lub zdalne konsole RSAT.

## 3. Architektura serwerowego systemu Linux

Serwery linuksowe wykorzystują architekturę jądra monolitycznego z mechanizmem dynamicznie ładowanych modułów (*Loadable Kernel Modules – LKM*). Zapewnia to maksymalną szybkość transferu danych wewnątrz jądra bez utraty możliwości dołączania sterowników w locie.

```text
+-------------------------------------------------------------------------------+
|                   PRZESTRZEŃ INTERFEJSU I DOSTĘPU ZDALNEGO                   |
|        Sesje SSH (OpenSSH)  |  Konsola CLI (Bash/Zsh)  |  Skrypty zadań       |
+---------------------------------------+---------------------------------------+
                                        | Interakcja i polecenia administracyjne
+---------------------------------------v---------------------------------------+
|                  PRZESTRZEŃ UŻYTKOWNIKA (User Space / Daemony)                |
|       Usługi: Nginx / Apache  |  Baza MySQL / MariaDB  |  Samba / NFS         |
|       Narzędzia sieciowe: iproute2, nftables, ufw, journalctl                 |
+---------------------------------------+---------------------------------------+
                                        | Zarządzanie stanem i procesami
+---------------------------------------v---------------------------------------+
|                     MENEDŻER SYSTEMU I USŁUG (PID 1)                          |
|                                 systemd                                       |
|           (Jednostki: .service, .socket, .target, .mount, .timer)             |
+---------------------------------------+---------------------------------------+
                                        | Wywołania systemowe (Syscalls)
+---------------------------------------v---------------------------------------+
|                      JĄDRO MONOLITYCZNE (Kernel Space)                        |
|  +-------------------------------------------------------------------------+  |
|  |  Scheduler CPU  |  Virtual Filesystem (VFS)  |  Stos sieciowy TCP/IP    |  |
|  +-------------------------------------------------------------------------+  |
|  |        Moduły dynamicznie ładowane (Loadable Kernel Modules - LKM)      |  |
|  |        Sterowniki kart sieciowych, kontrolerów RAID, systemy plików     |  |
|  +-------------------------------------------------------------------------+  |
+---------------------------------------+---------------------------------------+
                                        | Bezpośrednia kontrola urządzeń
+---------------------------------------v---------------------------------------+
|                               SPRZĘT (Hardware)                               |
|                   Procesory x86_64, Pamięć RAM, Dyski NVMe/SATA               |
+-------------------------------------------------------------------------------+
```
*Rysunek 2: Architektura serwerowego systemu Linux: Hardware → Kernel → Systemd → Usługi → Shell/SSH.*

### Menedżer systemu i usług: Systemd
Systemd jest pierwszym procesem przestrzeni użytkownika uruchamianym przez jądro, przyjmującym identyfikator **PID 1**.
* **Jednostki (Units):** Pliki konfiguracyjne definiujące zachowanie usług (`.service`), punktów montowania dysków (`.mount`), gniazd sieciowych (`.socket`) oraz harmonogramów czasowych (`.timer`).
* **Cele systemowe (Targets):** Grupy jednostek określające stan operacyjny serwera (zastępujące dawne poziomy *runlevels*):
  * `multi-user.target`: Standardowy tryb pracy serwera sieciowego z konsolą tekstową i obsługą wielu użytkowników (odpowiednik runlevel 3).
  * `graphical.target`: Tryb z uruchomionym serwerem wyświetlania i środowiskiem graficznym (odpowiednik runlevel 5).

### Standard FHS (Filesystem Hierarchy Standard)
Struktura danych w systemie Linux tworzy jednolite, logiczne drzewo katalogowe wywodzące się z korzenia (`/`):
* `/etc/`: Wszystkie pliki konfiguracyjne usług i systemu zapisane w formacie tekstowym.
* `/var/`: Dane o zmiennym rozmiarze: bazy danych (`/var/lib/`), kolejki oraz logi systemowe (`/var/log/`).
* `/proc/` oraz `/sys/`: Wirtualne systemy plików mapowane w pamięci RAM, reprezentujące stan jądra, procesów i parametrów sprzętowych.
* `/dev/`: Punkty dostępowe do urządzeń blokowych i znakowych (np. dyski `/dev/sda`, interfejsy szeregowe).

## 4. Porównanie systemów Windows Server i Linux Server

| Kategoria architektoniczna | Microsoft Windows Server | Linux Server (np. Debian / RHEL) |
| :--- | :--- | :--- |
| **Model jądra** | Hybrydowe (HAL + Microkernel + Executive) | Monolityczne z modułami LKM |
| **Główne narzędzia zarządzania** | Server Manager, PowerShell, WAC, RSAT | Terminal CLI, powłoka Bash, protokół SSH |
| **Format bazy konfiguracji** | Binarny Rejestr systemowy (Registry) | Płaskie pliki tekstowe w strukturze `/etc/` |
| **Zarządzanie tożsamością** | Active Directory Domain Services (Kerberos/LDAP) | OpenLDAP, FreeIPA, Samba Active Directory |
| **Współdzielenie plików w sieci** | Natywny protokół SMB/CIFS, systemy NTFS/ReFS | Serwer Samba (dla Windows) oraz protokół NFS |
| **Polityka aktualizacji** | Usługa Windows Update (częste restarty środowiska) | Menedżery pakietów (`apt`, `dnf`), obsługa ksplice |
| **Średnie zużycie RAM (start)** | ~1.5–2.5 GB (GUI), ~800 MB (Core) | ~150–500 MB (wersja serwerowa bez środowiska graficznego) |

## 5. Modele licencjonowania środowisk serwerowych

Błędy na etapie doboru licencji niosą ryzyko poważnych konsekwencji prawno-finansowych w trakcie audytów zgodności.

### Model licencjonowania Windows Server (Per Core)
Dla edycji Standard oraz Datacenter licencjonowaniu podlegają fizyczne rdzenie procesorów serwera:
1. **Zasada procesora:** Wymagane jest pokrycie licencją minimum 8 rdzeni dla każdego fizycznego procesora.
2. **Zasada serwera:** Wymagane jest pokrycie licencją minimum 16 rdzeni dla całej maszyny fizycznej.
3. **Pakiety licencyjne:** Licencje dostarczane są w pakietach po 2 rdzenie (*2-Core*) oraz 16 rdzeni (*16-Core*).

```text
PRZYKŁADY KALKULACJI LICENCJI NA RDZENIE:

Serwer 1: 1 procesor fizyczny, 8 rdzeni
→ Zadziała reguła minimum serwerowego: Wymagana licencja na 16 RDZENI.

Serwer 2: 2 procesory fizyczne, po 12 rdzeni każdy (łącznie 24 rdzenie)
→ Liczba rdzeni przekracza minima: Wymagana licencja na 24 RDZENIE.
```

### Licencje dostępowe CAL (Client Access License)
W modelach Standard i Datacenter licencja serwera uprawnia jedynie do uruchomienia oprogramowania na maszynie. Każdy użytkownik lub stacja łącząca się z jego usługami wymaga licencji dostępowej:
* **User CAL:** Przypisywana do konkretnego użytkownika; optymalna, gdy jeden pracownik korzysta ze stacji roboczej, laptopa i telefonu.
* **Device CAL:** Przypisywana do urządzenia końcowego; optymalna w pracy zmianowej (wielu techników korzysta z tego samego komputera).
* **RDS CAL (Remote Desktop Services):** Niezależna licencja wymagana przy dostępie do pulpitów zdalnych i aplikacji terminalowych.

### Licencjonowanie w środowiskach Open Source (Linux)
* **Brak opłat per-core oraz brak licencji CAL:** Dystrybucje społecznościowe (Debian, Rocky Linux, Ubuntu) mogą być instalowane na dowolnej liczbie maszyn i udostępniane nielimitowanej liczbie stacji bez opłat licencyjnych.
* **Model subskrypcyjny Enterprise:** W dystrybucjach komercyjnych (Red Hat Enterprise Linux, SUSE) opłata obejmuje wsparcie techniczne producenta (SLA), dostęp do certyfikowanych repozytoriów oraz audytowane poprawki bezpieczeństwa.

## 6. Wirtualizacja w infrastrukturze serwerowej

Wirtualizacja polega na wprowadzeniu warstwy abstrakcji sprzętowej (hiperwizora), umożliwiającej uruchomienie wielu niezależnych systemów operacyjnych na jednej fizycznej platformie sprzętowej.

```text
+-------------------------------------+   +-------------------------------------+
|    HIPERWIZOR TYPU 1 (Bare-Metal)   |   |     HIPERWIZOR TYPU 2 (Hosted)      |
+-------------------------------------+   +-------------------------------------+
|  +---------------+ +--------------+ |   |  +---------------+ +--------------+ |
|  |  VM 1 (Win)   | | VM 2 (Linux) | |   |  |  VM 1 (Win)   | | VM 2 (Linux) | |
|  |  Aplikacje    | | Aplikacje    | |   |  |  Aplikacje    | | Aplikacje    | |
|  |  Gość (Guest) | | Gość (Guest) | |   |  |  Gość (Guest) | | Gość (Guest) | |
|  +---------------+ +--------------+ |   |  +---------------+ +--------------+ |
|  |  Wirtualny sprzęt (vCPU/vRAM)  | |   |  |  Wirtualny sprzęt (vCPU/vRAM)  | |
|  +--------------------------------+ |   |  +--------------------------------+ |
+------------------+------------------+   +------------------+------------------+
                   |                                         |
+------------------v------------------+   +------------------v------------------+
|          HIPERWIZOR TYPU 1          |   |          HIPERWIZOR TYPU 2          |
|      (Proxmox VE, ESXi, Hyper-V)    |   |     (VirtualBox, Workstation)       |
+------------------+------------------+   +------------------+------------------+
                   |                                         |
                   |                      +------------------v------------------+
                   |                      |     SYSTEM GOSPODARZA (Host OS)     |
                   |                      |         (np. Windows 11 / Linux)    |
                   |                      +------------------+------------------+
                   |                                         |
+------------------v-----------------------------------------v------------------+
|                                FIZYCZNY SPRZĘT                                |
|                   Procesory (VT-x/AMD-V), Pamięć RAM, Dyski, Sieć             |
+-------------------------------------------------------------------------------+
```
*Rysunek 3: Ścieżka wykonawcza: Hiperwizor Typu 1 (Bare-metal) a Hiperwizor Typu 2 (Hosted).*

* **Hiperwizor Typu 1 (Natywny / Bare-Metal):**
  * Instalowany bezpośrednio na warstwie sprzętowej serwera.
  * Zapewnia minimalny narzut wydajnościowy (< 2%) oraz bezpośredni dostęp do sprzętowych funkcji procesora (Intel VT-x, AMD-V).
  * Rozwiązania klasy produkcyjnej: Proxmox VE (KVM), VMware ESXi, Microsoft Hyper-V Server.
* **Hiperwizor Typu 2 (Hostowany):**
  * Uruchamiany jako tradycyjna aplikacja wewnątrz nadrzędnego systemu operacyjnego gospodarza (*Host OS*).
  * Operacje wejścia/wyjścia są kolejkowane przez sterowniki systemu nadrzędnego.
  * Rozwiązania laboratoryjno-dydaktyczne: Oracle VM VirtualBox, VMware Workstation.

### Typy wirtualnych przełączników sieciowych (vSwitch)
* **Karta zmostkowana (Bridged):** Wirtualny interfejs jest podłączony bezpośrednio do fizycznej sieci LAN. Maszyna wirtualna otrzymuje niezależny adres IP z nadrzędnego serwera DHCP.
* **Translacja adresów (NAT):** Maszyna wirtualna funkcjonuje w odizolowanej podsieci za wirtualnym routerem. Posiada wyjście do sieci zewnętrznej, lecz nie jest widoczna z fizycznej sieci lokalnej.
* **Sieć wewnętrzna (Internal / Host-Only):** Hermetyczny segment sieciowy bez wyjścia na zewnątrz. Pozwala na bezpieczne uruchamianie laboratoryjnych serwerów DHCP, testowanie złośliwego oprogramowania oraz symulację awarii.

## 7. Procedura wdrożeniowa: Węzeł serwerowy w laboratorium

Prawidłowe przygotowanie węzła serwerowego wymaga przejścia sekwencji konfiguracyjnej:

```text
[KROK 1: Weryfikacja CPU]
        |---> Sprawdzenie wsparcia wirtualizacji (VT-x / AMD-V) w BIOS/UEFI
[KROK 2: Alokacja zasobów maszyny wirtualnej]
        |---> Przydział vCPU (min. 2 rdzenie) oraz pamięci RAM (min. 4 GB)
[KROK 3: Konfiguracja magazynu dyskowego]
        |---> Format: VHDX / QCOW2 (Dynamiczny dla labu, Stały dla produkcji)
[KROK 4: Separacja sieciowa]
        |---> Sprawdzenie typu przełącznika (Internal / Host-Only / Bridged)
[KROK 5: Konfiguracja poinstalacyjna (Baseline)]
        |---> Zmiana nazwy komputera (Hostname zgodny z topologią)
        |---> Statyczna adresacja IPv4 (wyłączenie klienta DHCP)
        |---> Weryfikacja strefy czasowej i synchronizacji czasu NTP
```

1. **Weryfikacja wsparcia wirtualizacji:**
   Przed rozpoczęciem instalacji należy potwierdzić aktywność rozszerzeń sprzętowych wirtualizacji w procesorze (w Windows: Menedżer zadań → zakładka Wydajność → Procesor → *Wirtualizacja: Włączono*; w systemie Linux: `grep -E 'vmx|svm' /proc/cpuinfo`).
2. **Optymalizacja magazynu maszyn:**
   W warunkach laboratoryjnych stosuje się dyski rozszerzane dynamicznie, co oszczędza przestrzeń dysku fizycznego stacji roboczej. W środowiskach produkcyjnych zawsze rezerwuje się dyski o stałym rozmiarze (*Fixed*), eliminując fragmentację i ryzyko zatrzymania maszyn po przepełnieniu woluminu nadrzędnego.
3. **Konfiguracja poinstalacyjna (Out-of-the-Box):**
   * Nadanie jednoznacznej nazwy serwera (np. `SRV-DC01` zamiast losowego ciągu znaków) przed uruchomieniem jakichkolwiek ról sieciowych.
   * Ręczne przypisanie statycznego adresu IP, właściwej maski podsieci oraz bramy.
   * Ustawienie strefy czasowej i synchronizacji czasu protokołem NTP (krytyczny warunek działania biletów Kerberos w domenach Windows).

---
## Pytania sprawdzające do lekcji:

1. Czym różni się priorytet projektowy systemu serwerowego od systemu stacji roboczej w kontekście planowania czasu procesora (CPU Scheduling) i dlaczego serwer stosuje dłuższe kwanty czasu?
2. Jakie funkcje pełnią kolejno: HAL, mikrojądro oraz usługi wykonawcze (Executive Services) w architekturze jądra hybrydowego Windows Server?
3. Czym różni się rola serwera (Server Role) od funkcji serwera (Feature) i podaj po jednym przykładzie każdej z nich.
4. Jakie są główne zalety wdrożenia w wariancie Server Core względem Server with Desktop Experience?
5. Jaką funkcję pełni proces systemd jako PID 1 w architekturze serwera Linux i czym różnią się jednostki typu `.service`, `.socket` oraz `.timer`?
6. Do czego służą katalogi `/etc/`, `/var/` oraz `/proc/` zgodnie ze standardem FHS?
7. Na czym polega reguła minimum procesora i minimum serwerowego w modelu licencjonowania Windows Server per-core, i ile rdzeni wymaga licencjonowania serwer z jednym procesorem 8-rdzeniowym?
8. Jaka jest różnica między licencją User CAL a Device CAL i w jakich scenariuszach użycia każda z nich jest bardziej opłacalna?
9. Czym różni się hiperwizor Typu 1 (bare-metal) od hiperwizora Typu 2 (hostowany) pod względem architektury i narzutu wydajnościowego, oraz podaj przykład rozwiązania klasy produkcyjnej dla każdego z nich.
10. Jakie są różnice między wirtualnym przełącznikiem sieciowym w trybie Bridged, NAT i Internal (Host-Only), i który z nich wybrałbyś do bezpiecznego testowania złośliwego oprogramowania?