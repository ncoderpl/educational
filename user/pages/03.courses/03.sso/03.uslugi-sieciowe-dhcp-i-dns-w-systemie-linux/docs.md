---
title: 'Usługi sieciowe DHCP i DNS w systemie linux'
---

### Usługi sieciowe DHCP i DNS w systemie Linux: Konfiguracja serwera DHCP (`isc-dhcp-server` / `kea-dhcp`) oraz serwera nazw BIND9 (konfiguracja stref podstawowych i odwrotnych, weryfikacja narzędziami `dig` i `nslookup`).

Prawidłowe funkcjonowanie współczesnych sieci komputerowych opiera się na dwóch fundamentalnych usługach warstwy aplikacji: **Dynamic Host Configuration Protocol (DHCP)** oraz **Domain Name System (DNS)**. Pierwsza odpowiada za automatyczną, bezkolizyjną dystrybucję parametrów konfiguracyjnych stosu TCP/IP do stacji roboczych i serwerów. Druga stanowi rozproszoną bazę danych tłumaczącą mnemoniczne nazwy domenowe na fizyczne adresy IP, warunkując działanie routingu, poczty elektronicznej oraz usług katalogowych.

Niniejsze opracowanie stanowi kompendium inżynierskie, obejmujące architekturę protokołów, konfigurację tradycyjnego serwera `isc-dhcp-server`, nowoczesnego silnika `kea-dhcp`, instalację oraz bezpieczne wdrażanie stref prostych i odwrotnych w serwerze **BIND9**, a także procedury diagnostyczne wymagane w środowiskach produkcyjnych i na egzaminie zawodowym INF.02.

---

# Sekcja 1: Protokół i serwery dynamicznej konfiguracji węzłów (DHCP)

## 1.1. Architektura protokołu DHCP i cykl wymiany komunikatów (DORA)

Protokół DHCP (zdefiniowany w standardzie RFC 2131 dla IPv4 oraz RFC 8415 dla IPv6) działa w architekturze klient-serwer w oparciu o bezpołączeniowy protokół transportowy **UDP**. Serwer nasłuchuje na porcie **UDP 67**, natomiast klient odbiera pakiety na porcie **UDP 68**.

W sytuacji, gdy nowo podłączony węzeł nie posiada przypisanego adresu IP, komunikacja na poziomie warstwy sieciowej (L3) musi zachodzić za pośrednictwem adresów rozgłoszeniowych (*Broadcast*). Pełny cykl pozyskania dzierżawy nosi akronim **DORA** (*Discover, Offer, Request, Acknowledge*).

```plaintext
+---------------------------------------------------------------------------------------------------+
| PRZEPŁYW KOMUNIKATÓW W CYKLU POZYSKANIA DZIERŻAWY DHCP (DORA)                                    |
|                                                                                                   |
|    KLIENT (Stacja robocza)                                           SERWER DHCP (Dzierżawca)     |
|    Port UDP: 68                                                      Port UDP: 67                 |
|         |                                                                 |                       |
|         | ----- 1. DHCPDISCOVER (Rozgłoszenie L2/L3: 255.255.255.255) --->|                       |
|         |       Źródło: 0.0.0.0:68, Cel: 255.255.255.255:67               |                       |
|         |       Parametry: MAC klienta, Transaction ID, Param Request List|                       |
|         |                                                                 |                       |
|         |<----- 2. DHCPOFFER (Unicast L2 lub Broadcast L3) -------------- |                       |
|         |       Oferowany IP (yiaddr), Długość dzierżawy (Option 51),     |                       |
|         |       Maska (Option 1), Brama (Option 3), DNS (Option 6)        |                       |
|         |                                                                 |                       |
|         | ----- 3. DHCPREQUEST (Akceptacja oferty / Rezerwacja adresu) -->|                       |
|         |       Źródło: 0.0.0.0:68, Cel: 255.255.255.255:67               |                       |
|         |       Wskazanie wybranego serwera (Option 54: Server Identifier)|                       |
|         |                                                                 |                       |
|         |<----- 4. DHCPACK (Potwierdzenie przydziału dzierżawy) --------- |                       |
|         |       Zatwierdzenie parametrów IP w bazie serwera (leases)      |                       |
|         v                                                                 v                       |
|   [ Węzeł konfiguruje interfejs sieciowy, startuje liczniki T1 i T2 ]                              |
+---------------------------------------------------------------------------------------------------+
```

### Szczegółowa analiza etapów procesu DORA

1. **DHCPDISCOVER:** Klient wysyła pakiet rozgłoszeniowy na adres `255.255.255.255` (warstwa L3) oraz `FF:FF:FF:FF:FF:FF` (warstwa L2), poszukując dostępnych serwerów w segmencie sieci. 
   * Adres źródłowy pakietu wynosi `0.0.0.0`.
   * W polu `chaddr` (*Client Hardware Address*) przesyłany jest fizyczny adres MAC karty sieciowej.
   * Pakiet zawiera listę parametrów, o które wnioskuje stacja (*Option 55: Parameter Request List*).
2. **DHCPOFFER:** Serwer DHCP rezerwuje wstępnie wolny adres IP ze skonfigurowanej puli i odsyła propozycję. W pakiecie przekazywane są krytyczne opcje konfiguracyjne: proponowany adres IP klienta (`yiaddr` – *Your IP Address*), identyfikator serwera (Opcja 54), czas dzierżawy (Opcja 51), maska podsieci (Opcja 1) oraz domyślna brama (Opcja 3).
3. **DHCPREQUEST:** Klient odpowiada pakietem rozgłoszeniowym, informując wszystkie serwery w sieci, którą ofertę wybrał (wskazując adres IP serwera w Opcji 54). Pozostałe serwery DHCP, które również wysłały oferty, otrzymują sygnał do zwolnienia zarezerwowanych tymczasowo adresów IP.
4. **DHCPACK:** Wybrany serwer zatwierdza transakcję, zapisuje dzierżawę w trwałej bazie danych i przesyła pakiet potwierdzający. Od tej chwili klient oficjalnie konfiguruje swój interfejs sieciowy.
   * *Uwaga:* W przypadku braku wolnych adresów lub żądania adresu niepoprawnego dla danej podsieci, serwer wysyła pakiet negatywny **DHCPNAK** (*Negative Acknowledgment*), zmuszając klienta do restartu procedury od kroku Discover.

### Zarządzanie cyklem życia dzierżawy: Timery T1 i T2
Dzierżawa adresu nie jest bezterminowa. Klient monitoruje dwa liczniki czasu:
* **Timer T1 (Renewal Timer):** Domyślnie wynosi **50%** czasu dzierżawy. Po jego upływie klient wysyła pakiet `DHCPREQUEST` (już w trybie Unicast bezpośrednio do serwera, który wydał adres) w celu przedłużenia czasu ważności parametrów.
* **Timer T2 (Rebinding Timer):** Domyślnie wynosi **87.5% (7/8)** czasu dzierżawy. Jeśli serwer macierzysty nie odpowiedział na odnowienie T1 (np. uległ awarii), klient przełącza się w tryb rozgłoszeniowy (*Broadcast*) i próbuje odnowić dzierżawę u **dowolnego** innego serwera DHCP obsługującego dany segment sieci.
* **Expiration (Wygaśnięcie):** Po upływie 100% czasu dzierżawy stacja natychmiast zwalnia adres IP i całkowicie traci komunikację w sieci L3 do czasu ponownego wykonania procedury DORA.

---

## 1.2. Tradycyjny serwer: `isc-dhcp-server`

Klasyczny serwer DHCP od Internet Systems Consortium (ISC) przez dekady stanowił rynkowy standard środowisk uniksowych. Choć projekt osiągnął status *End-of-Life*, pozostaje powszechnie eksploatowany w istniejących infrastrukturach oraz w zadaniach egzaminacyjnych technika informatyka.

### Instalacja i powiązanie z interfejsem sieciowym
W systemach Debian/Ubuntu instalację przeprowadza się z poziomu menedżera pakietów:

```bash
sudo apt update
sudo apt install -y isc-dhcp-server
```

Serwer musi wiedzieć, na których fizycznych kartach sieciowych ma nasłuchiwać żądań rozgłoszeniowych. Odpowiada za to plik `/etc/default/isc-dhcp-server`:

```ini
# /etc/default/isc-dhcp-server
# Wskazanie interfejsów dla IPv4 (rozdzielane spacjami)
INTERFACESv4="enp0s8"
INTERFACESv6=""
```

### Konfiguracja pliku `/etc/dhcp/dhcpd.conf`
Główny plik konfiguracyjny operuje na deklaracjach globalnych oraz blokach podsieci (`subnet ... netmask ...`).

Poniższy listing przedstawia kompletną, produkcyjną konfigurację z obsługą puli dynamicznej, opcji sieciowych oraz statycznej rezerwacji adresu MAC:

```text
# /etc/dhcp/dhcpd.conf

# 1. PARAMETRY I DEKLARACJE GLOBALNE
# Oznaczenie serwera jako nadrzędnego dla danej podsieci
authoritative;

# Czasy dzierżawy w sekundach (default: 12 godzin, max: 24 godziny)
default-lease-time 43200;
max-lease-time 86400;

# Konfiguracja domeny i serwerów DNS przekazywanych klientom
option domain-name "lan.local";
option domain-name-servers 192.168.10.1, 1.1.1.1;

# Poziom logowania zdarzeń do /var/log/syslog
log-facility local7;

# 2. DEFINICJA OBSŁUGIWANEJ PODSIECI
subnet 192.168.10.0 netmask 255.255.255.0 {
    # Domyślna brama sieciowa dla stacji roboczych
    option routers 192.168.10.1;
    
    # Maska podsieci oraz adres rozgłoszeniowy
    option subnet-mask 255.255.255.0;
    option broadcast-address 192.168.10.255;

    # Dynamiczny zakres adresów przydzielanych stacjom roboczym
    range 192.168.10.100 192.168.10.200;
}

# 3. STATYCZNA REZERWACJA ADRESU IP (Host Reservation)
# Przypisanie stałego IP na podstawie unikalnego adresu fizycznego MAC
host drukarka-biuro {
    hardware ethernet 00:11:22:33:44:55;
    fixed-address 192.168.10.25;
    option host-name "printer-office";
}

host serwer-backup {
    hardware ethernet 08:00:27:aa:bb:cc;
    fixed-address 192.168.10.30;
}
```

Weryfikacja poprawności składni pliku konfiguracyjnego przed restartem demona:

```bash
# Test syntaktyczny (flaga -t)
sudo dhcpd -t -cf /etc/dhcp/dhcpd.conf

# Uruchomienie i włączenie autostartu usługi
sudo systemctl restart isc-dhcp-server
sudo systemctl enable isc-dhcp-server
```

Baza aktywnych dzierżaw jest zapisywana w pliku `/var/lib/dhcp/dhcpd.leases`. Można ją na bieżąco monitorować:

```bash
cat /var/lib/dhcp/dhcpd.leases
```

---

## 1.3. Nowoczesny serwer: `kea-dhcp`

Serwer **Kea** to nowoczesny następca `isc-dhcp-server`, stworzony przez konsorcjum ISC od podstaw w języku C++. Został zaprojektowany z myślą o środowiskach wielowątkowych, wysokiej wydajności (tysiące żądań na sekundę), dynamicznym przeładowywaniu konfiguracji przez REST API oraz składowaniu bazy dzierżaw w zewnętrznych relacyjnych bazach danych (MySQL, PostgreSQL).

### Architektura modułowa Kea
Kea składa się z odrębnych demonów systemowych:
* `kea-dhcp4` – obsługa protokołu IPv4.
* `kea-dhcp6` – obsługa protokołu IPv6.
* `kea-dhcp-ddns` – dynamiczne aktualizacje rekordów w serwerze DNS.
* `kea-ctrl-agent` – interfejs komunikacyjny REST API (JSON).

### Instalacja i konfiguracja JSON (`kea-dhcp4.conf`)
Instalacja w systemie Debian/Ubuntu:

```bash
sudo apt update
sudo apt install -y kea-dhcp4-server
```

Konfiguracja Kea DHCP opiera się na ustrukturyzowanym formacie **JSON** (z dopuszczalnymi komentarzami). Główny plik konfiguracyjny to `/etc/kea/kea-dhcp4.conf`:

```json
{
  "Dhcp4": {
    "interfaces-config": {
      "interfaces": [ "enp0s8" ]
    },
    
    "control-socket": {
      "socket-type": "stdout"
    },

    "lease-database": {
      "type": "memfile",
      "persist": true,
      "name": "/var/lib/kea/kea-leases4.csv",
      "lfc-interval": 3600
    },

    "valid-lifetime": 43200,
    "max-valid-lifetime": 86400,

    "option-data": [
      {
        "name": "domain-name",
        "data": "lan.local"
      },
      {
        "name": "domain-name-servers",
        "data": "192.168.10.1, 1.1.1.1"
      }
    ],

    "subnet4": [
      {
        "id": 1,
        "subnet": "192.168.10.0/24",
        "pools": [
          { "pool": "192.168.10.100 - 192.168.10.200" }
        ],
        "option-data": [
          {
            "name": "routers",
            "data": "192.168.10.1"
          }
        ],
        "reservations": [
          {
            "hw-address": "00:11:22:33:44:55",
            "ip-address": "192.168.10.25",
            "hostname": "printer-office"
          }
        ]
      }
    ]
  }
}
```

Weryfikacja poprawności składni oraz start usługi:

```bash
# Weryfikacja pliku konfiguracyjnego Kea
sudo kea-dhcp4 -t /etc/kea/kea-dhcp4.conf

# Start i zarządzanie usługą
sudo systemctl restart kea-dhcp4-server
sudo systemctl status kea-dhcp4-server
```

---

# Sekcja 2: System Nazw Domenowych (DNS) i konfiguracja serwera BIND9

## 2.1. Architektura przestrzeni nazw DNS i typy zapytań

System DNS to hierarchiczna, rozproszona baza danych o strukturze odwróconego drzewa. Na szczycie hierarchii znajduje się **strefa główna (Root Zone)**, oznaczana kropką (`.`), obsługiwana przez 13 klastrów serwerów głównych (*Root Name Servers*, oznaczonych literami od A do M) z wykorzystaniem routingu Anycast.

Poniżej strefy głównej znajdują się domeny najwyższego poziomu (**TLD** – *Top-Level Domain*):
* Domeny generyczne (gTLD): `.com`, `.org`, `.net`, `.edu`.
* Domeny krajowe (ccTLD): `.pl`, `.de`, `.uk`.

```plaintext
+---------------------------------------------------------------------------------------------------+
| HIERARCHIA DRZEWA DOMENOWEGO DNS                                                                  |
|                                                                                                   |
|                                          [ ROOT ZONE (.) ]                                        |
|                                          /       |       \                                        |
|                                         v        v        v                                       |
|                                     [ .pl ]   [ .com ]  [ .org ]     <- Domeny TLD                |
|                                       /          |                                                |
|                                      v           v                                                |
|                                 [ lan.pl ]   [ google.com ]          <- Domeny drugiego poziomu   |
|                                    /                                                              |
|                                   v                                                               |
|                           [ srv01.lan.pl ]                           <- FQDN (Węzeł końcowy)      |
+---------------------------------------------------------------------------------------------------+
```

### Zapytania rekurencyjne vs iteracyjne

```plaintext
+---------------------------------------------------------------------------------------------------+
| MECHANIZM ROZWIĄZYWANIA NAZW: REKURENCJA A ITERACJA                                               |
|                                                                                                   |
| [ Klient / Stacja ]                                                                               |
|         |                                                                                         |
|         | (1) Zapytanie rekurencyjne: "Jaki jest IP dla srv01.firma.pl?"                         |
|         v                                                                                         |
| +----------------------------------+                                                              |
| | LOKALNY RESOLVER CACHE (ISP/LAN) |                                                              |
| +----------------------------------+                                                              |
|         |                                                                                         |
|         | (2) Zapytanie iteracyjne: "Gdzie jest .pl?"                                             |
|         |--------------------------------------------------------> [ Root Server (.) ]            |
|         |<-------------------------------------------------------- | Odpowiedź: NS dla .pl        |
|         |                                                                                         |
|         | (3) Zapytanie iteracyjne: "Gdzie jest firma.pl?"                                        |
|         |--------------------------------------------------------> [ Serwer TLD (.pl) ]          |
|         |<-------------------------------------------------------- | Odpowiedź: NS dla firma.pl   |
|         |                                                                                         |
|         | (4) Zapytanie iteracyjne: "Jaki jest IP srv01.firma.pl?"                                |
|         |--------------------------------------------------------> [ Authoritative NS (firma.pl) ]|
|         |<-------------------------------------------------------- | Odpowiedź: A = 192.168.10.50 |
|         |                                                                                         |
|         v                                                                                         |
| (5) Ostateczna odpowiedź trafia do klienta (i do pamięci podręcznej Cache na czas TTL)            |
+---------------------------------------------------------------------------------------------------+
```

1. **Zapytanie rekurencyjne (*Recursive Query*):** Klient żąda od lokalnego serwera DNS pełnego rozwiązania nazwy. Serwer przyjmuje na siebie cały ciężar odpytania kolejnych serwerów w hierarchii i zwraca klientowi gotowy adres IP lub jednoznaczny komunikat o braku rekordu (`NXDOMAIN`).
2. **Zapytanie iteracyjne (*Iterative Query*):** Serwer lokalny odpytuje kolejne serwery autorytatywne. Zapytany serwer nie rozwiązuje nazwy samodzielnie, lecz zwraca najlepszą posiadaną odpowiedź – zazwyczaj wskazanie (*Referral*) na serwery autorytatywne leżące szczebel niżej w drzewie hierarchii.

---

## 2.2. Instalacja i struktura plików konfiguracyjnych BIND9

**BIND** (*Berkeley Internet Name Domain*) w wersji 9 jest najpopularniejszym, referencyjnym serwerem DNS dla systemów linuksowych.

Instalacja oprogramowania oraz narzędzi diagnostycznych (`dnsutils`):

```bash
sudo apt update
sudo apt install -y bind9 bind9utils bind9-doc dnsutils
```

### Podział plików konfiguracyjnych w systemie Debian/Ubuntu
Konfiguracja w katalogu `/etc/bind/` została podzielona modularnie:
* `named.conf` – główny plik wejściowy, włączający dyrektywami `include` pozostałe podpliki.
* `named.conf.options` – globalne opcje działania serwera: katalog roboczy, serwery forwardujące, uprawnienia do rekurencji, porty nasłuchiwania, obsługa DNSSEC.
* `named.conf.local` – lokalne deklaracje stref autorytatywnych (strefy proste i odwrotne).
* `named.conf.default-zones` – deklaracje stref domyślnych (strefa root, localhost, broadcast).

---

## 2.3. Konfiguracja globalna: `/etc/bind/named.conf.options`

W środowiskach korporacyjnych serwer BIND9 pełni zazwyczaj podwójną rolę: jest serwerem autorytatywnym dla domen lokalnych oraz serwerem buforującym (*Caching Forwarder*) dla zapytań internetowych.

```text
// /etc/bind/named.conf.options

// Definicja list kontroli dostępu (ACL)
acl "zaufana_siec" {
    127.0.0.1;
    192.168.10.0/24;
};

options {
    directory "/var/cache/bind";

    // Bezpieczeństwo: zezwól na rekurencję WYŁĄCZNIE stacjom z sieci lokalnej
    // Otwarta rekurencja (Open Resolver) grozi udziałem w atakach typu DNS Amplification!
    recursion yes;
    allow-recursion { "zaufana_siec"; };

    // Interfejsy i porty nasłuchiwania IPv4 i IPv6
    listen-on port 53 { 127.0.0.1; 192.168.10.1; };
    listen-on-v6 { none; };

    // Serwery przekazujące (Forwarders) - nadrzędne serwery DNS w przypadku braku rekordu w cache
    forwarders {
        1.1.1.1;
        8.8.8.8;
    };
    forward only;

    // Walidacja DNSSEC
    dnssec-validation auto;

    // Maskowanie numeru wersji BIND przed skanerami podatności
    version "Niedostępna";
};
```

Weryfikacja składni pliku opcji:

```bash
sudo named-checkconf
```

---

## 2.4. Deklaracja stref w `/etc/bind/named.conf.local`

Aby serwer autorytatywnie odpowiadał za domenę `lan.local` oraz odwrotne mapowanie adresów z podsieci `192.168.10.0/24`, należy zadeklarować dwie strefy:

```text
// /etc/bind/named.conf.local

// 1. STREFA PODSTAWOWA PROSTA (Forward Lookup Zone)
zone "lan.local" {
    type master;
    file "/etc/bind/zones/db.lan.local";
    allow-transfer { none; }; // Blokada transferu strefy (AXFR) dla nieautoryzowanych hostów
};

// 2. STREFA ODWROTNA (Reverse Lookup Zone)
// Adres podsieci 192.168.10.0 zapisany odwróconymi oktetami z sufiksem in-addr.arpa
zone "10.168.192.in-addr.arpa" {
    type master;
    file "/etc/bind/zones/db.192.168.10";
    allow-transfer { none; };
};
```

Utworzenie dedykowanego katalogu na pliki bazowe stref:

```bash
sudo mkdir -p /etc/bind/zones
```

---

## 2.5. Rekordy zasobów (Resource Records – RR) i pliki stref

Plik strefy to tekstowa baza danych opisująca przestrzeń nazw w formacie zdefiniowanym w RFC 1035. Każdy wpis nosi nazwę **rekordu zasobów (RR)** i charakteryzuje się jednolitą składnią:

```text
[Nazwa/Właściciel]    [TTL]    [Klasa]    [Typ Rekordu]    [Dane rekordu (RDATA)]
```

* **Klasa:** Prawie zawsze `IN` (*Internet*).
* **TTL (*Time To Live*):** Czas w sekundach, przez jaki inne serwery buforujące mogą przechowywać dany rekord w pamięci cache.

### Przegląd kluczowych typów rekordów DNS

* **SOA (*Start of Authority*):** Otwiera każdy plik strefy. Definiuje podstawowe metadane: serwer nadrzędny, adres e-mail administratora oraz parametry replikacji i wygasania.
* **NS (*Name Server*):** Wskazuje autorytatywne serwery nazw dla danej domeny.
* **A (*Address IPv4*):** Mapuje nazwę domenową na 32-bitowy adres IPv4.
* **AAAA (*Address IPv6*):** Mapuje nazwę domenową na 128-bitowy adres IPv6.
* **CNAME (*Canonical Name*):** Alias (pseudonim) wskazujący na inną, kanoniczną nazwę domenową. Nie może współistnieć z innymi rekordami dla tej samej etykiety.
* **MX (*Mail Exchange*):** Wskazuje serwery pocztowe obsługujące daną domenę wraz z priorytetem liczbowym (niższa wartość = wyższy priorytet).
* **PTR (*Pointer*):** Wykorzystywany wyłącznie w strefach odwrotnych do tłumaczenia adresu IP na pełną nazwę domenową (FQDN).
* **TXT (*Text*):** Przechowuje dowolny ciąg znaków; powszechnie stosowany w mechanizmach uwierzytelniania poczty (SPF, DKIM, DMARC).

---

## 2.6. Konfiguracja strefy podstawowej prostej: `/etc/bind/zones/db.lan.local`

Poniższy plik definiuje odwzorowanie nazw na adresy IP w domenie `lan.local`:

```dns
; /etc/bind/zones/db.lan.local
$TTL    86400           ; Domyślny czas życia rekordów (1 doba)
@       IN      SOA     ns1.lan.local. admin.lan.local. (
                        2026091101      ; Serial number (Format: YYYYMMDDNN) - KRYTYCZNY!
                        14400           ; Refresh: czas odpytania serwera Master przez Slave (4h)
                        3600            ; Retry: czas ponowienia próby po błędzie połączenia (1h)
                        1209600         ; Expire: czas wygaszenia strefy w serwerze Slave (2 tyg.)
                        7200 )          ; Negative Cache TTL: buforowanie braku rekordu NXDOMAIN (2h)

; ------------------------------------------------------------------------------
; DEKLARACJE SERWERÓW NAZW (NS)
; ------------------------------------------------------------------------------
@       IN      NS      ns1.lan.local.
@       IN      NS      ns2.lan.local.

; ------------------------------------------------------------------------------
; REKORDY ADRESOWE GŁÓWNE (A) DLA INFRASTRUKTURY
; ------------------------------------------------------------------------------
@       IN      A       192.168.10.10          ; Adres główny domeny (apex: lan.local)
ns1     IN      A       192.168.10.1           ; Adres serwera DNS podstawowego
ns2     IN      A       192.168.10.2           ; Adres serwera DNS zapasowego
router  IN      A       192.168.10.1           ; Domyślna brama L3
srv01   IN      A       192.168.10.50          ; Główny serwer aplikacji / baz danych
mail    IN      A       192.168.10.20          ; Serwer pocztowy

; ------------------------------------------------------------------------------
; OBSŁUGA POCZTY ELEKTRONICZNEJ (MX)
; ------------------------------------------------------------------------------
@       IN      MX  10  mail.lan.local.

; ------------------------------------------------------------------------------
; ALIAS CNAME DLA USŁUG WEBNOWYCH
; ------------------------------------------------------------------------------
www     IN      CNAME   srv01.lan.local.
db      IN      CNAME   srv01.lan.local.
poczta  IN      CNAME   mail.lan.local.

; ------------------------------------------------------------------------------
; REKORDY TEKSTOWE I BEZPIECZEŃSTWO POCZTY
; ------------------------------------------------------------------------------
@       IN      TXT     "v=spf1 mx ip4:192.168.10.20 ~all"
```

> **Zasada bezwzględna:** Zwróć uwagę na kończące kropki w pełnych nazwach domenowych FQDN (np. `ns1.lan.local.`). Brak kropki na końcu sprawi, że BIND automatycznie doklei nazwę bieżącej strefy, tworząc błędny zapis: `ns1.lan.local.lan.local.`.

---

## 2.7. Konfiguracja strefy odwrotnej (Reverse): `/etc/bind/zones/db.192.168.10`

Strefa odwrotna pozwala systemom na weryfikację, jaka nazwa hosta jest powiązana z danym adresem IP (procedura Reverse DNS Lookup – rDNS). Jest to fundament weryfikacji serwerów pocztowych (antyspam) oraz audytu logów systemowych.

Dla sieci `192.168.10.0/24` strefa nosi nazwę `10.168.192.in-addr.arpa`:

```dns
; /etc/bind/zones/db.192.168.10
$TTL    86400
@       IN      SOA     ns1.lan.local. admin.lan.local. (
                        2026091101      ; Serial
                        14400           ; Refresh
                        3600            ; Retry
                        1209600         ; Expire
                        7200 )          ; Negative Cache TTL

; Serwery nazw dla strefy odwrotnej
@       IN      NS      ns1.lan.local.
@       IN      NS      ns2.lan.local.

; ------------------------------------------------------------------------------
; REKORDY WSKAŹNIKA PTR (Ostatni oktet adresu IP w podsieci /24)
; ------------------------------------------------------------------------------
1       IN      PTR     router.lan.local.
1       IN      PTR     ns1.lan.local.
2       IN      PTR     ns2.lan.local.
10      IN      PTR     lan.local.
20      IN      PTR     mail.lan.local.
50      IN      PTR     srv01.lan.local.
```

---

## 2.8. Walidacja składniowa stref i restart demona BIND9

Przed ponownym uruchomieniem serwera BIND9 należy każdorazowo przeprowadzić formalną walidację plików konfiguracyjnych. Błąd w pliku strefy uniemożliwi jej załadowanie i spowoduje odrzucanie zapytań klientów.

```bash
# 1. Sprawdzenie głównego pliku konfiguracyjnego (brak komunikatu = poprawność)
sudo named-checkconf

# 2. Sprawdzenie poprawności strefy prostej
sudo named-checkzone lan.local /etc/bind/zones/db.lan.local
# Prawidłowy wynik:
# zone lan.local/IN: loaded serial 2026091101
# OK

# 3. Sprawdzenie poprawności strefy odwrotnej
sudo named-checkzone 10.168.192.in-addr.arpa /etc/bind/zones/db.192.168.10
# Prawidłowy wynik:
# zone 10.168.192.in-addr.arpa/IN: loaded serial 2026091101
# OK

# 4. Restart usługi i weryfikacja statusu
sudo systemctl restart bind9
sudo systemctl status bind9
```

---

# Sekcja 3: Diagnostyka, analiza ruchu i zagadnienia egzaminacyjne (INF.02)

## 3.1. Diagnostyka podsystemu DHCP

W przypadku problemów z uzyskaniem adresu IP przez stacje robocze, administrator przeprowadza diagnostykę weryfikującą obecność pakietów na interfejsie oraz stan bazy dzierżaw.

```plaintext
+-----------------------------------------------------------------------------------+
| METODYKA DIAGNOSTYKI AWARII DHCP                                                  |
|                                                                                   |
| 1. Czy demon serwera działa i nasłuchuje na porcie UDP 67?                        |
|    $ sudo ss -ulpn | grep :67                                                     |
|                                                                                   |
| 2. Czy pakiety DHCP docierają do interfejsu serwera?                              |
|    $ sudo tcpdump -nn -i enp0s8 port 67 or port 68                                |
|                                                                                   |
| 3. Czy pula adresów nie została wyczerpana?                                       |
|    Inspekcja /var/lib/dhcp/dhcpd.leases lub /var/lib/kea/kea-leases4.csv          |
|                                                                                   |
| 4. Test żądania po stronie klienta:                                               |
|    $ sudo dhclient -v -r enp0s3  (zwolnienie dzierżawy / DHCPRELEASE)             |
|    $ sudo dhclient -v enp0s3     (nowe żądanie DORA z podglądem kroków)           |
+-----------------------------------------------------------------------------------+
```

Przechwytywanie pełnego cyklu DORA w czasie rzeczywistym za pomocą `tcpdump`:

```bash
sudo tcpdump -i enp0s8 -n -v "port 67 or port 68"
```
W podglądzie pakietów zaobserwujesz kolejno flagi `BOOTP/DHCP`: `Discover`, `Offer`, `Request` oraz `ACK`.

---

## 3.2. Precyzyjna diagnostyka serwera nazw DNS za pomocą `dig`

Polecenie `dig` (*Domain Information Groper*) jest podstawowym narzędziem inżynierskim do odpytywania serwerów nazw. Zwraca surowe flagi odpowiedzi, sekcje autorytatywne oraz czasy odpowiedzi.

### Podstawowe wzorce użycia `dig`:

1. **Odpytanie wskazanego serwera DNS o rekord A:**
   ```bash
   dig @192.168.10.1 srv01.lan.local A
   ```
   Kluczowe elementy odpowiedzi:
   * `status: NOERROR` – zapytanie przetworzone poprawnie.
   * `flags: qr aa rd ra` – flaga **`aa`** (*Authoritative Answer*) oznacza, że odpowiedź pochodzi bezpośrednio z serwera autorytatywnego dla tej strefy, a nie z pamięci podręcznej.
   * Sekcja `ANSWER SECTION` zawiera poszukiwany rekord `srv01.lan.local. 86400 IN A 192.168.10.50`.

2. **Weryfikacja zapytania odwrotnego (rDNS):**
   ```bash
   dig @192.168.10.1 -x 192.168.10.50
   ```
   W sekcji odpowiedzi pojawi się wpis:
   `50.10.168.192.in-addr.arpa. 86400 IN PTR srv01.lan.local.`

3. **Odpytanie o rekordy MX oraz serwery nazw:**
   ```bash
   dig @192.168.10.1 lan.local MX +short
   dig @192.168.10.1 lan.local NS +short
   ```

4. **Śledzenie pełnej ścieżki iteracyjnej od serwerów głównych Root:**
   ```bash
   dig +trace google.com
   ```

### Alternatywne narzędzia: `nslookup` oraz `host`
Na stacjach z systemem Windows oraz w szybkich testach w Linuksie stosuje się narzędzia uproszczone:

```bash
# Szybkie sprawdzenie translacji
host srv01.lan.local 192.168.10.1

# Interaktywny tryb nslookup
nslookup
> server 192.168.10.1
> set type=any
> lan.local
> exit
```

---

## 3.3. Zestawienie kodów odpowiedzi serwera DNS (RCODE)

Podczas diagnostyki serwer DNS zwraca w nagłówku status odpowiedzi (*Response Code*), precyzujący przyczynę ewentualnego niepowodzenia:

| Kod RCODE | Nazwa statusu | Przyczyna techniczna | Działanie naprawcze |
| :--- | :--- | :--- | :--- |
| **0** | `NOERROR` | Zapytanie przetworzone pomyślnie. Rekord odnaleziony. | Brak błędu. |
| **2** | `SERVFAIL` | Serwer nazw napotkał wewnętrzny błąd (np. brak łączności z forwarderem, błąd składni strefy, niespójność sygnatur DNSSEC). | Sprawdź logi serwera (`journalctl -u bind9`), uprawnienia do plików stref i walidację DNSSEC. |
| **3** | `NXDOMAIN` | Domena lub nazwa hosta nie istnieje w przestrzeni nazw. | Zweryfikuj literówki w FQDN lub dopisz brakujący rekord A do pliku strefy. |
| **5** | `REFUSED` | Serwer odrzucił wykonanie operacji ze względów bezpieczeństwa (polityka ACL). | Zweryfikuj dyrektywy `allow-query`, `allow-recursion` lub `allow-transfer` w konfiguracji BIND. |

---
## Pytania do lekcji
1. Wymień i krótko opisz cztery etapy cyklu DORA w protokole DHCP, wraz z portami UDP, na których komunikują się klient i serwer.
2. Jaka jest różnica między timerem T1 (Renewal) a T2 (Rebinding), i co się dzieje, gdy serwer macierzysty nie odpowie na próbę odnowienia dzierżawy w ramach T1?
3. W jakim celu w konfiguracji `isc-dhcp-server` stosuje się blok `host { hardware ethernet ...; fixed-address ...; }`, i jakie ma to zastosowanie praktyczne (np. dla drukarki sieciowej)?
4. Jakie są główne architektoniczne różnice między klasycznym `isc-dhcp-server` a nowoczesnym `kea-dhcp`, szczególnie w kontekście formatu konfiguracji i możliwości integracji z bazami danych?
5. Na czym polega różnica między zapytaniem rekurencyjnym a iteracyjnym w mechanizmie rozwiązywania nazw DNS?
6. Dlaczego pozostawienie otwartej rekurencji (Open Resolver) na serwerze DNS dostępnym z internetu jest uznawane za poważne zagrożenie bezpieczeństwa, i jaka dyrektywa w `named.conf.options` temu zapobiega?
7. Jak zbudowana jest nazwa strefy odwrotnej dla podsieci `192.168.10.0/24`, i czym różni się rekord PTR od rekordu A pod względem zastosowania?
8. Wyjaśnij znaczenie poszczególnych parametrów czasowych w rekordzie SOA: Serial, Refresh, Retry, Expire oraz Negative Cache TTL.
9. Jakie mogą być konsekwencje pominięcia kończącej kropki w pełnej nazwie domenowej (FQDN) w pliku strefy BIND9, np. przy wpisie `ns1.lan.local` zamiast `ns1.lan.local.`?
10. Co oznacza w odpowiedzi `dig` flaga `aa` (Authoritative Answer), oraz jakie działanie naprawcze należałoby podjąć po otrzymaniu kodu odpowiedzi `SERVFAIL` lub `REFUSED`?