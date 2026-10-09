---
title: 'Instalacja i podstawowa administracja serwerem Linux'
---

### Instalacja i podstawowa administracja serwerem Linux: Wybór dystrybucji serwerowej (Debian/Ubuntu Server/Rocky Linux), konfiguracja statycznej adresacji IP (Netplan / NetworkManager CLI), zdalny dostęp terminalowy i zabezpieczenie serwera OpenSSH.

System operacyjny GNU/Linux stanowi fundament współczesnej infrastruktury serwerowej, napędzając systemy chmurowe, platformy konteneryzacji, środowiska wirtualizacji oraz krytyczne bazy danych enterprise. Skuteczna administracja środowiskiem serwerowym wymaga zrozumienia różnic architektonicznych między głównymi rodzinami dystrybucji, umiejętności projektowania niezawodnych struktur dyskowych (LVM) oraz biegłości w konfigurowaniu podsystemu sieciowego w oparciu o nowoczesne standardy systemowe.

Niniejsze opracowanie stanowi kompendium inżynierskie podzielone na dwie integralne części: od wyboru platformy i architektury instalacji, po niskopoziomową konfigurację stosu sieciowego i diagnostykę połączeń.

---

# Sekcja 1: Wybór dystrybucji serwerowej, architektura instalacji i podsystemy bazowe

## 1.1. Kryteria doboru dystrybucji serwerowej: Ekosystem Debiana vs Enterprise Linux

Dobór dystrybucji serwerowej determinuje długofalowe koszty utrzymania infrastruktury (*TCO – Total Cost of Ownership*), cykl życia aplikacji, częstotliwość aktualizacji oraz model bezpieczeństwa jądra i bibliotek bazowych. Na rynku enterprise dominują dwie główne gałęzie: **rodzina Debiana** (Debian, Ubuntu Server) oraz **rodzina Enterprise Linux** (RHEL, Rocky Linux, AlmaLinux).

```plaintext
+---------------------------------------------------------------------------------------------------+
| DRZEWO GENEALOGICZNE GŁÓWNYCH SERWEROWYCH DYSTRYBUCJI LINUKSA                                    |
|                                                                                                   |
|  [ PROJEKT GNU / JĄDRO LINUX ]                                                                    |
|          |                                                                                        |
|          +---------------------------------------+----------------------------------------+       |
|          |                                       |                                        |       |
|          v                                       v                                        v       |
|   +--------------+                       +---------------+                        +---------------+
|   | DEBIAN GNU   |                       | RED HAT LINUX |                        |  INNE NIEZAL. |
|   +--------------+                       +---------------+                        +---------------+
|          |                                       |                                        |       |
|          +--------------------+                  v                                        v       |
|          |                    |          +---------------+                        +---------------+
|          v                    v          |  RHEL (Core)  |                        | Alpine Linux  |
|   [Debian Stable]      [Ubuntu Server]   +---------------+                        | (musl/busybox)|
|   - Konserwatywny      - Cykle LTS (5+5)         |                                +---------------+
|   - Zero telemetrii    - Jądra HWE (Canonical)   +--------------------+                           |
|   - dpkg / APT         - Subiquity / Netplan     |                    |                           |
|                                                  v                    v                           |
|                                           [Rocky Linux]        [AlmaLinux]                        |
|                                           - Zgodność 1:1 RHEL  - Zgodność 1:1 RHEL                |
|                                           - DNF / RPM / SELinux- DNF / RPM / SELinux              |
+---------------------------------------------------------------------------------------------------+
```

### 1. Debian GNU/Linux („The Universal Operating System”)
Debian to całkowicie niezależna, rozwijana przez społeczność dystrybucja, stanowiąca fundament dla dziesiątek systemów pochodnych. 
* **Model wydawniczy:** Trzy gałęzie (*Unstable/Sid*, *Testing*, *Stable*). Wydanie *Stable* ukazuje się w przybliżeniu co 2 lata i podlega rygorystycznemu zamrożeniu pakietów (*freeze*).
* **Profil zastosowania:** Idealny wybór na węzły bazodanowe, serwery DNS, zapory sieciowe, routery brzegowe oraz środowiska, w których absolutnym priorytetem jest niezmienność API/ABI bibliotek i bezawaryjność.
* **Charakterystyka techniczna:** Brak komercyjnej telemetrii, minimalny zestaw usług po instalacji, konserwatywne wersje pakietów (często starsze wersje oprogramowania ze wstecznie portowanymi łatkami bezpieczeństwa – *backporting*).

### 2. Ubuntu Server (Canonical)
Dystrybucja bazująca na gałęzi testowej Debiana, zoptymalizowana pod kątem wdrożeń w chmurze publicznej, konteneryzacji i nowoczesnego sprzętu.
* **Model wydawniczy:** Wydania zwykłe (co 6 miesięcy, wsparcie przez 9 miesięcy) oraz wydania **LTS** (*Long Term Support* – co 2 lata w kwietniu lat parzystych, np. 22.04 LTS, 24.04 LTS). Wydania LTS oferują 5 lat standardowego wsparcia bezpieczeństwa, rozszerzalnego do 10–12 lat w ramach subskrypcji Ubuntu Pro (ESM).
* **Profil zastosowania:** Platformy OpenStack, orkiestracja Kubernetes, maszyny wirtualne w chmurze (AWS, Azure, GCP), serwery aplikacyjne wymagające nowszych wersji kompilatorów i bibliotek środowiskowych (PHP, Node.js, Python).
* **Charakterystyka techniczna:** Wdrożenie instalatora *Subiquity*, integracja z systemem *cloud-init*, jądra HWE (*Hardware Enablement*) umożliwiające obsługę nowoczesnych kontrolerów sprzętowych na starszych wydaniach LTS, wbudowane pakiety izolowane `snapd` (często kontrowersyjne w środowiskach minimalistycznych).

### 3. Rocky Linux (Ekosystem Enterprise Linux)
Powstał jako bezpośrednia odpowiedź społeczności open-source na zmianę strategii firmy Red Hat dotyczącą wygaszenia projektu CentOS Linux na rzecz CentOS Stream.
* **Model wydawniczy:** Ściśle powiązany z cyklem wydawniczym Red Hat Enterprise Linux (RHEL). Gwarantuje 10-letni cykl wsparcia dla każdego wydania głównego (np. Rocky Linux 9 wspierany do 2032 roku).
* **Profil zastosowania:** Środowiska korporacyjne, sektor finansowy, centra obliczeniowe HPC, infrastruktura wymagająca certyfikacji oprogramowania firm trzecich (Oracle Database, SAP, IBM).
* **Charakterystyka techniczna:** Pełna binarna zgodność (bug-for-bug compatible) z RHEL, zaawansowane egzekwowanie polityk Mandatory Access Control za pomocą SELinux, menedżer pakietów DNF z modułami *AppStream*.

### Macierz porównawcza parametrów architektonicznych

| Parametr / Cecha | Debian GNU/Linux (Stable) | Ubuntu Server LTS | Rocky Linux / RHEL |
| :--- | :--- | :--- | :--- |
| **Główny sponsor / Nadzór** | Społeczność (SPI) | Canonical Ltd. | Rocky Enterprise Software Foundation |
| **Cykl wydawniczy** | Ok. 24–30 miesięcy | Co 2 lata (kwiecień) | Zsynchronizowany z RHEL |
| **Czas wsparcia LTS** | 3 lata (Security) + 2 lata (LTS) | 5 lat (Standard) / do 10–12 lat (ESM) | 10 lat |
| **Menedżer pakietów niskiego poz.** | `dpkg` | `dpkg` | `rpm` |
| **Menedżer pakietów wysokiego poz.**| `apt` / `apt-get` | `apt` / `snap` | `dnf` (dawniej `yum`) |
| **Domyślny moduł MAC Security** | AppArmor (opcjonalny/aktywny) | AppArmor (aktywny) | **SELinux** (w trybie Enforcing) |
| **Format deklaracji sieciowej** | `/etc/network/interfaces` | **Netplan** (YAML) | **NetworkManager** (`keyfile` / `nmcli`) |
| **Domyślny system plików** | ext4 | ext4 | **XFS** |
| **Stabilność ABI vs Nowości** | Ekstremalnie wysoka stabilność | Zbalansowana (jądra HWE) | Rygorystyczna stabilność korporacyjna |

---

## 1.2. Menedżery pakietów i weryfikacja integralności oprogramowania

W architekturze Linuksa oprogramowanie dystrybuowane jest w prekompilowanych archiwach binarnych zawierających metadane, skrypty instalacyjne oraz informacje o zależnościach.

### Ekosystem APT (`dpkg`) – Debian i Ubuntu

* **Struktura archiwum `.deb`:** Archiwum ar zawierające pliki `debian-binary`, `control.tar.xz` (metadane, sumy kontrolne MD5/SHA256, skrypty `preinst`, `postinst`, `prerm`, `postrm`) oraz `data.tar.xz` (właściwe pliki binarne instalowane w systemie plików).
* **Repozytoria APT:** Adresy serwerów lustrzanych definiowane są w pliku `/etc/apt/sources.list` oraz w katalogu `/etc/apt/sources.list.d/`.

Nowoczesny format zapisu repozytoriów (deb822) stosowany w nowszych wydaniach zastępuje tradycyjne jednolinijkowe wpisy plikami `.sources`:

```ini
# /etc/apt/sources.list.d/debian.sources
Types: deb deb-src
URIs: [http://deb.debian.org/debian](http://deb.debian.org/debian)
Suites: bookworm bookworm-updates
Components: main contrib non-free non-free-firmware
Signed-By: /usr/share/keyrings/debian-archive-keyring.gpg
```

Kluczowe operacje administracyjne w APT:

```bash
# Aktualizacja lokalnego indeksu pakietów z serwerów lustrzanych
sudo apt update

# Bezpieczna aktualizacja zainstalowanych pakietów bez usuwania zależności
sudo apt upgrade -y

# Inteligentna aktualizacja dystrybucji (rozwiązuje konflikty, instaluje nowe pakiety jądra)
sudo apt full-upgrade -y

# Wyszukiwanie pakietu w bazie repozytoriów
apt search nginx

# Szczegółowa inspekcja pakietu (wersja, zależności, opis)
apt show nginx

# Czyszczenie lokalnego bufora pobranych plików .deb (/var/cache/apt/archives/)
sudo apt clean
sudo apt autoremove --purge -y
```

### Ekosystem DNF/RPM – Rocky Linux

System bazujący na formacie `.rpm` (*RPM Package Manager*) wykorzystuje nowoczesny silnik **DNF** (*Dandified YUM*), oparty na bibliotece `libsolv`, która rozwiązuje graf zależności za pomocą algorytmów SAT-solver.

* **Moduły AppStream:** Pozwalają na równoległe udostępnianie wielu wersji tego samego oprogramowania (np. Node.js 18 i Node.js 20, PHP 8.1 i PHP 8.2) w ramach jednego wydania systemu operacyjnego:

```bash
# Wyświetlenie dostępnych strumieni modułów dla danego pakietu
dnf module list php

# Włączenie i instalacja konkretnego profilu
sudo dnf module enable php:8.2
sudo dnf install php-cli php-fpm
```

* **Transakcyjność operacji DNF:** Każda operacja instalacji, aktualizacji lub usunięcia jest rejestrowana w bazie transakcyjnej, co umożliwia jej pełne wycofanie:

```bash
# Wyświetlenie historii transakcji menedżera pakietów
dnf history

# Cofnięcie zmian wprowadzonych przez transakcję o numerze ID 15
sudo dnf history undo 15
```

---

## 1.3. Architektura partycjonowania dysków i LVM (Logical Volume Manager)

Niepoprawne zaplanowanie partycjonowania na etapie instalacji serwera bare-metal lub maszyny wirtualnej jest jednym z najtrudniejszych do skorygowania błędów administracyjnych. Standardem we wdrożeniach produkcyjnych jest zastosowanie tabeli partycji **GPT** (*GUID Partition Table*) z obsługą rozruchu **UEFI** oraz warstwy abstrakcji **LVM** (*Logical Volume Manager*).

### Dlaczego partycja jednolicie płaska (`/`) to błąd krytyczny?
Umieszczenie całego systemu operacyjnego na jednej partycji root (`/`) rodzi ryzyko zablokowania serwera:
1. Niekontrolowany wyciek logów aplikacji do `/var/log` zapełnia 100% przestrzeni dyskowej.
2. Demon bazy danych lub serwer WWW nie może zaalokować miejsca w `/tmp` ani dokonać zapisu w `/var/lib`.
3. Brak możliwości zapisu plików PID i gniazd uniksowych w `/run` powoduje awarię jądra i brak możliwości zdalnego zalogowania się administratora przez SSH.

### Architektura warstwowa LVM

LVM wprowadza warstwę wirtualizacji pamięci masowej, rozdzielając fizyczne dyski twarde od systemów plików:

```plaintext
+-----------------------------------------------------------------------------------+
| STRUKTURA WARSTWOWA LOGICAL VOLUME MANAGER (LVM)                                  |
|                                                                                   |
|  [ DYSK FIZYCZNY 1: /dev/nvme0n1 ]         [ DYSK FIZYCZNY 2: /dev/sda ]          |
|  Partycja: /dev/nvme0n1p3 (800 GB)         Partycja: /dev/sda1 (1000 GB)          |
|                   |                                       |                       |
|                   v                                       v                       |
|  +---------------------------------+     +---------------------------------+      |
|  | Wolumen Fizyczny (PV):          |     | Wolumen Fizyczny (PV):          |      |
|  | pvcreate /dev/nvme0n1p3         |     | pvcreate /dev/sda1              |      |
|  +---------------------------------+     +---------------------------------+      |
|                   \                                       /                       |
|                    \                                     /                        |
|                     v                                   v                         |
|  +-----------------------------------------------------------------------------+  |
|  | Grupa Wolumenów (VG - Volume Group):                                         |  |
|  | vgcreate vg_system /dev/nvme0n1p3 /dev/sda1  (Łączna pula: 1800 GB)         |  |
|  | Podział na Physical Extents (PE, domyślnie bloki 4 MB)                      |  |
|  +-----------------------------------------------------------------------------+  |
|         |                        |                          |                     |
|         v (Alokacja 50 GB)       v (Alokacja 200 GB)        v (Alokacja 500 GB)   |
|  +---------------------+  +----------------------+  +---------------------------+ |
|  | Wolumen Logiczny    |  | Wolumen Logiczny     |  | Wolumen Logiczny          | |
|  | (LV): lv_root       |  | (LV): lv_var         |  | (LV): lv_data             | |
|  +---------------------+  +----------------------+  +---------------------------+ |
|             |                         |                          |                |
|             v (Formatowanie)          v (Formatowanie)           v (Formatowanie) |
|      [ System ext4 ]           [ System xfs ]             [ System xfs ]          |
|             |                         |                          |                |
|             v (Punkt montowania)      v (Punkt montowania)       v (Punkt mont.)  |
|       Katalog: /                Katalog: /var              Katalog: /mnt/storage  |
+-----------------------------------------------------------------------------------+
```

### Rekomendowany podział przestrzeni dyskowej serwera produkcyjnego

W tabeli poniżej przedstawiono optymalny podział dysku o pojemności 500 GB dla serwera produkcyjnego:

| Punkt montowania | Zalecany system plików | Minimalny rozmiar | Flagi montowania (`/etc/fstab`) | Uzasadnienie architektoniczne |
| :--- | :--- | :--- | :--- | :--- |
| `/boot/efi` | VFAT (FAT32) | 512 MB – 1 GB | `defaults,umask=0077` | Wymagana przez specyfikację UEFI partycja ESP. |
| `/boot` | ext4 | 1 GB – 2 GB | `defaults,nodev,nosuid` | Pliki jądra (`vmlinuz`) i obrazy ramdysku (`initrd`). Poza LVM! |
| `/` (root) | ext4 lub XFS | 20 GB – 40 GB | `defaults` | Podstawa systemu, biblioteki `/usr`, pliki binarne `/bin`. |
| `/var` | ext4 lub XFS | 40 GB – 60 GB | `defaults,nodev` | Zmienne dane systemowe, bazy pakietów, bazy flat-file. |
| `/var/log` | ext4 lub XFS | 30 GB – 50 GB | `defaults,nodev,nosuid,noexec` | Izolacja logów systemowych; flaga `noexec` blokuje uruchamianie exploitów. |
| `/var/log/audit` | ext4 lub XFS | 10 GB – 20 GB | `defaults,nodev,nosuid,noexec` | Niezbędna dla audytu bezpieczeństwa (SELinux/auditd). |
| `/tmp` | tmpfs (RAM) | 8 GB – 16 GB | `defaults,nodev,nosuid,noexec` | Pliki tymczasowe; czyszczone przy restarcie; ochrona przed atakami ze skryptów. |
| `/home` | ext4 lub XFS | Zależnie od potrzeb | `defaults,nodev,nosuid` | Katalogi domowe użytkowników. |
| `[SWAP]` | swap | 4 GB – 8 GB | `sw` | Przestrzeń wymiany stronicowania pamięci jądra. |
| **Pula wolna** | Niezalokowana w VG | **Min. 30% dysku** | — | **Kluczowe:** Wolne miejsce w LVM na migawki (snapshots) i rozbudowę w locie. |

### Praktyczne operacje na strukturach LVM z poziomu terminala

```bash
# 1. Inicjalizacja partycji jako Physical Volume
sudo pvcreate /dev/sdb1

# 2. Utworzenie grupy wolumenów o nazwie vg_data
sudo vgcreate vg_data /dev/sdb1

# 3. Utworzenie wolumenu logicznego lv_database o rozmiarze 100 GB
sudo lvcreate -L 100G -n lv_database vg_data

# 4. Sformatowanie wolumenu systemem plików XFS
sudo mkfs.xfs /dev/vg_data/lv_database

# 5. Dynamiczne rozszerzenie wolumenu w locie o kolejne 50 GB (wraz z systemem plików)
# Dla systemu XFS:
sudo lvextend -L +50G -r /dev/vg_data/lv_database
# Flaga -r (resize) automatycznie wywołuje xfs_growfs lub resize2fs dla ext4!
```

---

## 1.4. System inicjalizacji i zarządzanie usługami (systemd)

Współczesne dystrybucje Linuksa opierają się na systemie inicjalizacji **systemd** (PID 1), który odpowiada za sekwencyjne lub równoległe uruchamianie usług, zarządzanie procesami potomnymi za pomocą grup kontrolnych (*cgroups*) oraz monitorowanie zasobów.

Struktura jednostek (*units*) systemd dzieli się na pliki dostarczane przez dystrybucję (`/lib/systemd/system/` lub `/usr/lib/systemd/system/`) oraz pliki konfigurowane przez administratora (`/etc/systemd/system/`), które mają bezwzględny priorytet nadpisujący.

```bash
# Sprawdzenie statusu działania usługi (np. Nginx)
systemctl status nginx.service

# Uruchomienie, zatrzymanie i restart usługi
sudo systemctl start nginx
sudo systemctl stop nginx
sudo systemctl restart nginx

# Przeładowanie konfiguracji bez przerywania aktywnych połączeń workerów
sudo systemctl reload nginx

# Włączenie automatycznego startu usługi przy rozruchu systemu (tworzy symlink w .wants)
sudo systemctl enable nginx

# Wyłączenie automatycznego startu
sudo systemctl disable nginx

# Inspekcja logów usługi w czasie rzeczywistym z poziomu journald
sudo journalctl -u nginx.service -f -n 100
```

---

# Sekcja 2: Podsystem sieciowy, konfiguracja statycznej adresacji IP i diagnostyka

## 2.1. Architektura stosu sieciowego w Linuksie i nazewnictwo interfejsów

Tradycyjny model konfiguracji sieci w Linuksie oparty na pakiecie `net-tools` (polecenia `ifconfig`, `route`, `arp`) został oficjalnie uznany za przestarzały (*deprecated*). Współczesne jądra korzystają z interfejsu **Netlink** oraz pakietu **iproute2** (`ip`, `ss`).

### Przewidywalne nazewnictwo interfejsów sieciowych (Predictable Network Interface Names)
Klasyczne nazwy takie jak `eth0`, `eth1` były niedeterministyczne – kolejność inicjalizacji kart sieciowych przez jądro podczas startu systemu zależała od czasu odpowiedzi magistrali PCIe, co mogło zamienić interfejs zewnętrzny z wewnętrznym.

Wprowadzono przewidywalne nazwy interfejsów bazujące na topologii sprzętowej:
* `enp0s3` – Interfejs Ethernet (`en`), magistrala PCI (`p0`), slot 3 (`s3`).
* `ens18` – Interfejs Ethernet (`en`), slot PCI z funkcją hotplug (`s18`).
* `eno1` – Interfejs Ethernet zintegrowany na płycie głównej (*onboard*, `o1`).
* `wlp2s0` – Bezprzewodowa karta sieciowa Wireless LAN (`wl`), magistrala PCI (`p2`), slot 0 (`s0`).

---

## 2.2. Implementacje konfiguracji statycznej adresacji IP

W zależności od wybranej dystrybucji serwerowej zarządca podsystemu sieciowego różni się formatem plików konfiguracyjnych i demonem wykonawczym. Poniżej przedstawiono konfigurację statycznego adresu IP dla parametrów referencyjnych:

* **Adres IP:** `192.168.10.50`
* **Maska sieci:** `/24` (`255.255.255.0`)
* **Brama domyślna (Gateway):** `192.168.10.1`
* **Serwery DNS:** `1.1.1.1`, `8.8.8.8`
* **Interfejs sieciowy:** `enp0s3` (lub `ens18`)

```plaintext
+-----------------------------------------------------------------------------------+
| PORÓWNANIE MECHANIZMÓW ZARZĄDZANIA SIECIĄ W DYSTRYBUCJACH LINUKSA                 |
|                                                                                   |
|  DEBIAN GNU/LINUX:             UBUNTU SERVER (20.04+):       ROCKY LINUX / RHEL:  |
|  +--------------------+        +--------------------+        +------------------+ |
|  | /etc/network/      |        | /etc/netplan/      |        | NetworkManager   | |
|  | interfaces         |        | *.yaml             |        | (nmcli / keyfile)| |
|  +--------------------+        +--------------------+        +------------------+ |
|            |                             |                             |          |
|            v                             v                             v          |
|  [ Demon networking ]          [ Netplan Generator ]         [ Demon            | |
|  [ Skrypty ifup/ifdown]        +----------+---------+        | NetworkManager ] | |
|                                /                    \                  |          |
|                               v                      v                 v          |
|                     [systemd-networkd]        [NetworkManager] [ Gniazdo Netlink] |
|                               \                      /                 |          |
|                                v                    v                  v          |
|                           +-----------------------------------------------------+ |
|                           |      JĄDRO LINUX (Kernel Network Stack / Routing)   | |
|                           +-----------------------------------------------------+ |
+-----------------------------------------------------------------------------------+
```

---

### Metoda 1: Ubuntu Server – Konfiguracja za pomocą Netplan (YAML)

Netplan to narzędzie opracowane przez Canonical, które nie zarządza bezpośrednio interfejsami, lecz generuje konfigurację dla wybranego silnika (*backendu/renderera*): `systemd-networkd` (domyślny na serwerach) lub `NetworkManager` (na desktopach).

Pliki konfiguracyjne znajdują się w katalogu `/etc/netplan/` (np. `/etc/netplan/00-installer-config.yaml` lub `/etc/netplan/50-cloud-init.yaml`).

> **Krytyczna reguła składni YAML:** W plikach Netplan **kategorycznie zabrania się używania znaków tabulacji**. Wcięcia muszą być realizowane za pomocą dokładnie 2 spacji na każdy poziom zagnieżdżenia.

Edytuj lub utwórz plik `/etc/netplan/01-netcfg.yaml`:

```yaml
network:
  version: 2
  renderer: networkd
  ethernets:
    enp0s3:
      dhcp4: false
      dhcp6: false
      addresses:
        - 192.168.10.50/24
      routes:
        - to: default
          via: 192.168.10.1
      nameservers:
        addresses:
          - 1.1.1.1
          - 8.8.8.8
        search:
          - lan.local
```

Wdrożenie konfiguracji z zabezpieczeniem przed utratą dostępu przez SSH:

```bash
# 1. Bezpieczne testowanie (cofa zmiany po 120 sekundach, jeśli nie potwierdzisz klawiszem ENTER)
sudo netplan try

# 2. Bezpośrednie zaaplikowanie konfiguracji do systemu
sudo netplan apply

# 3. Weryfikacja ewentualnych błędów parsowania
sudo netplan --debug generate
```

---

### Metoda 2: Debian GNU/Linux – Klasyczny podsystem `ifupdown`

Tradycyjny i niezwykle stabilny mechanizm Debiana opiera się na pliku `/etc/network/interfaces` oraz katalogu `/etc/network/interfaces.d/`.

Edytuj plik `/etc/network/interfaces`:

```ini
# Pętla zwrotna (Loopback) - niezbędna do poprawnego działania IPC
auto lo
iface lo inet loopback

# Główny fizyczny interfejs sieciowy
auto enp0s3
iface enp0s3 inet static
    address 192.168.10.50
    netmask 255.255.255.0
    gateway 192.168.10.1
    dns-nameservers 1.1.1.1 8.8.8.8
    dns-search lan.local
```

Zastosowanie zmian w Debianie:

```bash
# Przeładowanie pojedynczego interfejsu bez restartu całego serwera
sudo ifdown enp0s3 && sudo ifup enp0s3

# LUB restart całej usługi sieciowej za pomocą systemd
sudo systemctl restart networking.service
```

---

### Metoda 3: Rocky Linux / Enterprise Linux – NetworkManager i `nmcli`

W Rocky Linux 8 i 9 standardem zarządzania siecią jest demon **NetworkManager**. Ręczna edycja plików w `/etc/sysconfig/network-scripts/ifcfg-*` została wycofana na rzecz plików kluczy w `/etc/NetworkManager/system-connections/*.nmconnection` oraz narzędzia wiersza poleceń `nmcli`.

Konfiguracja krok po kroku za pomocą `nmcli`:

```bash
# 1. Identyfikacja nazwy aktywnego połączenia (kolumna NAME) oraz interfejsu (DEVICE)
nmcli connection show

# 2. Modyfikacja połączenia do trybu statycznego (zakładamy nazwę profilu 'enp0s3')
sudo nmcli connection modify enp0s3 ipv4.method manual

# 3. Ustawienie adresu IP wraz z maską podsieci (notacja CIDR)
sudo nmcli connection modify enp0s3 ipv4.addresses 192.168.10.50/24

# 4. Ustawienie bramy domyślnej
sudo nmcli connection modify enp0s3 ipv4.gateway 192.168.10.1

# 5. Ustawienie adresów serwerów DNS
sudo nmcli connection modify enp0s3 ipv4.dns "1.1.1.1 8.8.8.8"

# 6. Wymuszenie automatycznego nawiązywania połączenia przy starcie
sudo nmcli connection modify enp0s3 connection.autoconnect yes

# 7. Aktywacja wprowadzonych zmian
sudo nmcli connection up enp0s3
```

Wygenerowany plik konfiguracyjny ma postać czytelnego pliku INI (`/etc/NetworkManager/system-connections/enp0s3.nmconnection`):

```ini
[connection]
id=enp0s3
uuid=a1b2c3d4-e5f6-7890-abcd-ef1234567890
type=ethernet
interface-name=enp0s3

[ipv4]
address1=192.168.10.50/24,192.168.10.1
dns=1.1.1.1;8.8.8.8;
method=manual

[ipv6]
addr-gen-mode=default
method=auto
```

---

## 2.3. Konfiguracja rozwiązywania nazw (DNS Resolver) i `systemd-resolved`

Rozwiązywanie nazw domenowych w Linuksie historycznie opierało się na bibliotece C standardu POSIX oraz pliku konfiguracyjnym `/etc/resolv.conf`.

### Integracja z `systemd-resolved` (Ubuntu)
W nowoczesnych systemach plik `/etc/resolv.conf` nie jest edytowany ręcznie, lecz stanowi dowiązanie symboliczne (*symlink*) do pliku stub generatora `systemd-resolved`:

```plaintext
/etc/resolv.conf -> /run/systemd/resolve/stub-resolv.conf
```

W pliku tym znajduje się lokalny adres nasłuchujący: `127.0.0.53`. Zapytania DNS aplikacji trafiają do lokalnego resolvera buforującego `systemd-resolved`, który dopiero odpytuje serwery nadrzędne.

Diagnostyka konfiguracji DNS:

```bash
# Sprawdzenie aktualnych serwerów DNS powiązanych z poszczególnymi interfejsami
resolvectl status

# Testowe odpytanie domeny za pomocą resolvectl
resolvectl query google.com
```

### Plik `/etc/hosts` i mechanizm NSS
Przed odpytaniem serwerów DNS system sprawdza lokalną bazę translacji `/etc/hosts`. Kolejność przeszukiwania definiuje plik `/etc/nsswitch.conf` w linijce:

```ini
hosts: files dns
```
Oznacza to, że wpisy w `/etc/hosts` mają bezwzględny priorytet przed zewnętrznym serwerem DNS.

```ini
# /etc/hosts
127.0.0.1   localhost
127.0.1.1   serwer-poczta.lan.local serwer-poczta
192.168.10.50 srv01.lan.local srv01
```

---

## 2.4. Kompleksowa diagnostyka sieciowa z wykorzystaniem `iproute2`

Weryfikacja poprawności działania skonfigurowanej sieci wymaga znajomości nowoczesnego zestawu narzędzi diagnostycznych:

```plaintext
+-----------------------------------------------------------------------------------+
| PRZEPŁYW DIAGNOSTYKI SIECIOWEJ W ARCHITEKTURZE WARSTWOWEJ (MODEL OSI)             |
|                                                                                   |
| 1. WARSTWA FIZYCZNA / ŁĄCZA:       Czy kabel/karta działa?                        |
|    $ ip link show                  -> Sprawdź flagę <UP,LOWER_UP> i MTU           |
|                                                                                   |
| 2. WARSTWA SIECIOWA (IP):          Czy mamy poprawny adres IP i podsieć?          |
|    $ ip -c addr show               -> Zweryfikuj IP, maskę CIDR, broadcast       |
|                                                                                   |
| 3. WARSTWA ROUTINGU:               Czy pakiety wiedzą, dokąd lecieć?              |
|    $ ip route show                 -> Sprawdź obecność "default via <brama>"      |
|    $ ip route get 8.8.8.8          -> Sprawdź trasę wychodzącą dla celu           |
|                                                                                   |
| 4. TEST SPOISTOŚCI WĘZŁA:          Czy brama odpowiada na ICMP?                   |
|    $ ping -c 4 192.168.10.1        -> Brak odpowiedzi = problem w L2/L3 lokalnie  |
|                                                                                   |
| 5. TEST WYJŚCIA NA ŚWIAT:          Czy trasa publiczna jest osiągalna?            |
|    $ ping -c 4 1.1.1.1             -> Test po czystym IP (omija DNS)              |
|                                                                                   |
| 6. TEST WARSTWY APLIKACJI (DNS):   Czy nazwy są poprawnie tłumaczone?             |
|    $ dig @1.1.1.1 kernel.org       -> Test odpytania bezpośredniego serwera       |
|    $ nslookup kernel.org           -> Test przez systemowy resolver               |
+-----------------------------------------------------------------------------------+
```

### Zestaw procedur diagnostycznych w terminalu

1. **Inspekcja interfejsów i adresów:**
   ```bash
   # Kolorowe, czytelne wyświetlenie adresów IP
   ip -c a

   # Sprawdzenie statystyk błędów i utraconych pakietów (RX/TX errors, dropped)
   ip -s link show dev enp0s3
   ```

2. **Weryfikacja tablicy routingu:**
   ```bash
   # Wyświetlenie tablicy routingu jądra
   ip r

   # Wynik powinien zawierać trasę domyślną:
   # default via 192.168.10.1 dev enp0s3 proto static metric 100
   # 192.168.10.0/24 dev enp0s3 proto kernel scope link src 192.168.10.50 metric 100
   ```

3. **Inspekcja tablicy sąsiedztwa (ARP Cache):**
   ```bash
   # Wyświetla skojarzenia adresów IP z adresami fizycznymi MAC w sieci lokalnej
   ip neigh show
   ```

4. **Weryfikacja otwartych portów i gniazd sieciowych (`ss`):**
   Narzędzie `ss` (*Socket Statistics*) zastępuje przestarzałe polecenie `netstat`:
   ```bash
   # Wyświetlenie portów TCP (-t) i UDP (-u), nasłuchujących (-l), numerycznie (-n) wraz z procesami (-p)
   sudo ss -tulnp

   # Sprawdzenie czy demon SSH nasłuchuje na porcie 22
   sudo ss -tulpn | grep :22
   ```

5. **Przechwytywanie i analiza pakietów (`tcpdump`):**
   W sytuacjach skrajnych problemów z routingiem lub zaporą sieciową, administrator przeprowadza nasłuch ruchu:
   ```bash
   # Przechwytywanie zapytań ICMP (ping) oraz DNS na wybranym interfejsie
   sudo tcpdump -nn -i enp0s3 icmp or port 53
   ```

---

## 2.5. Podstawowe utwardzanie środowiska sieciowego (Security Baseline)

Świeżo zainstalowany serwer ze skonfigurowanym statycznym adresem IP musi zostać natychmiast zabezpieczony przed atakami z sieci lokalnej i zewnętrznej.

### Utwardzanie demona OpenSSH (`sshd`)

Plik konfiguracyjny `/etc/ssh/sshd_config` (lub plik w `/etc/ssh/sshd_config.d/99-hardened.conf`):

```ini
# Całkowity zakaz bezpośredniego logowania na konto root
PermitRootLogin no

# Maksymalna liczba prób uwierzytelnienia przed przerwaniem połączenia
MaxAuthTries 3

# Kategoryczne wyłączenie logowania hasłem na rzecz kluczy asymetrycznych (np. Ed25519)
PasswordAuthentication no
PubkeyAuthentication yes

# Wyłączenie pustych haseł i przekazywania X11
PermitEmptyPasswords no
X11Forwarding no

# Opcjonalnie: zmiana standardowego portu 22 w celu redukcji szumu ze skanerów botnetów
Port 2222
```
Test poprawności składni przed restartem usługi:
```bash
sudo sshd -t
sudo systemctl restart ssh || sudo systemctl restart sshd
```

### Konfiguracja zapory ogniowej: UFW vs firewalld

W zależności od dystrybucji, ruch filtruje się za pomocą nakładek na podsystem jądra **nftables**.

#### Ubuntu / Debian (UFW – Uncomplicated Firewall):

```bash
# 1. Domyślna polityka: blokuj ruch przychodzący, zezwalaj na wychodzący
sudo ufw default deny incoming
sudo ufw default allow outgoing

# 2. Zezwolenie na połączenia SSH (dla portu niestandardowego np. 2222)
sudo ufw allow 2222/tcp comment 'SSH Custom Port'

# 3. Zezwolenie na serwer WWW (HTTP/HTTPS)
sudo ufw allow 80/tcp comment 'HTTP'
sudo ufw allow 443/tcp comment 'HTTPS'

# 4. Aktywacja reguł
sudo ufw enable
sudo ufw status numbered
```

#### Rocky Linux (firewalld):

```bash
# 1. Sprawdzenie aktywnej strefy (domyślnie public)
sudo firewall-cmd --get-active-zones

# 2. Dodanie portu SSH do konfiguracji trwałej
sudo firewall-cmd --permanent --add-port=2222/tcp

# 3. Otwarcie usług sieciowych
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https

# 4. Przeładowanie reguł w locie
sudo firewall-cmd --reload
sudo firewall-cmd --list-all
```

---
## Pytania do lekcji
1. Jakie są kluczowe różnice w modelu wydawniczym i cyklu wsparcia między Debian Stable, Ubuntu Server LTS a Rocky Linux, i jak przekładają się one na dobór dystrybucji do środowiska produkcyjnego?
2. Czym różni się struktura archiwum `.deb` (ekosystem APT) od pakietu `.rpm`, i do czego służą moduły AppStream w DNF?
3. Jakie trzy konkretne problemy operacyjne może spowodować umieszczenie całego systemu operacyjnego na jednej, płaskiej partycji root (`/`) bez wydzielenia osobnych punktów montowania?
4. Wyjaśnij hierarchię warstw LVM: czym różni się Physical Volume (PV), Volume Group (VG) i Logical Volume (LV), i jakie polecenia służą do ich utworzenia?
5. Dlaczego zaleca się pozostawienie minimum 30% niezalokowanej przestrzeni w grupie wolumenów (VG) i do czego może się to przydać w przyszłości?
6. Jakie znaczenie mają poszczególne segmenty przewidywalnej nazwy interfejsu sieciowego, np. `enp0s3`, i dlaczego zastąpiono nimi klasyczne nazwy typu `eth0`?
7. Jaka jest zasadnicza różnica w podejściu do konfiguracji sieci między Netplan (Ubuntu), plikiem `/etc/network/interfaces` (Debian) a `nmcli/NetworkManager` (Rocky Linux)?
8. Dlaczego polecenie `sudo netplan try` jest bezpieczniejsze od `sudo netplan apply` przy zdalnej konfiguracji sieci przez SSH, i co się dzieje, jeśli administrator nie potwierdzi zmian?
9. W jakiej kolejności, zgodnie z plikiem `/etc/nsswitch.conf`, system rozwiązuje nazwy hostów, i jakie ma to konsekwencje dla wpisów w pliku `/etc/hosts`?
10. Jakie ustawienia w pliku `sshd_config` oraz jakie reguły zapory (`UFW` lub `firewalld`) należałoby wdrożyć, aby zabezpieczyć świeżo zainstalowany serwer korzystający z niestandardowego portu SSH 2222?