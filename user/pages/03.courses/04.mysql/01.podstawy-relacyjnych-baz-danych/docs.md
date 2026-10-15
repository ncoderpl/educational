---
title: 'Podstawy relacyjnych baz danych'
published: true
---


# Wprowadzenie do relacyjnych baz danych (RDBMS) i architektura klient-serwer
### Wprowadzenie do relacyjnych baz danych (RDBMS) i architektura klient-serwer: Zasada działania serwera baz danych, rola protokołu SQL, instalacja i wstępna konfiguracja serwera MySQL, narzędzia linii poleceń (mysqld, mysqladmin) oraz klient interaktywny mysql.

Współczesne systemy przetwarzania danych opierają się na relacyjnym paradygmacie składowania informacji. Od bankowości transakcyjnej wysokiej częstotliwości, przez platformy handlu elektronicznego i systemy klasy ERP, aż po aplikacje sieciowe i systemy wbudowane – relacyjne bazy danych (RDBMS – *Relational Database Management System*) stanowią krytyczny komponent infrastruktury IT, gwarantujący spójność, trwałość oraz kontrolowany dostęp do encji biznesowych.

Niniejsze opracowanie stanowi kompendium inżynierskie, łączące matematyczne i teoretyczne fundamenty modelu relacyjnego z fizyczną implementacją procesową silników bazodanowych w architekturze klient-serwer oraz procedurami wdrożeniowymi w środowiskach produkcyjnych.

---

# Sekcja 1: Teoretyczne fundamenty RDBMS, model relacyjny i architektura klient-serwer

## 1.1. Matematyczna teoria relacji i model Edgara F. Codda

Fundamentem relacyjnych baz danych jest praca naukowa Edgara F. Codda z 1970 roku (*"A Relational Model of Data for Large Shared Data Banks"*), w której sformalizował on zasady organizacji danych w oparciu o teorię mnogości oraz rachunek predykatów pierwszego rzędu. Codd zaproponował całkowite odseparowanie fizycznej reprezentacji danych na nośnikach pamięci masowej od ich logicznej struktury prezentowanej użytkownikowi i aplikacjom.

### Podstawowe pojęcia modelu relacyjnego

W ujęciu czysto matematycznym model relacyjny definiuje dane w kategoriach relacji, atrybutów, krotek i domen:

* **Domena ($D$):** Zbiór dopuszczalnych, atomowych (niepodzielnych) wartości danego typu (np. zbiór dodatnich liczb całkowitych, zbiór łańcuchów znaków o określonej długości, dziedzina dat kalendarzowych).
* **Atrybut ($A$):** Nazwana rola, jaką dana domena pełni w relacji. W implementacji fizycznej atrybut jest tożsamy z kolumną tabeli.
* **Krotka ($t$):** Element relacji reprezentujący pojedynczy fakt lub obiekt. Jest to uporządkowany ciąg wartości $\langle v_1, v_2, \dots, v_n \rangle$, gdzie każda wartość $v_i$ należy do odpowiadającej jej domeny $D_i$. W fizycznej bazie danych krotka jest reprezentowana przez wiersz (rekord).
* **Relacja ($R$):** W ujęciu matematycznym relacja stopnia $n$ jest podzbiorem iloczynu kartezjańskiego $n$ domen:

$$R \subseteq D_1 \times D_2 \times \dots \times D_n$$

Relacja w danym momencie czasu (*stan relacji*) jest skończonym zbiorem krotek. W systemie RDBMS relacja przyjmuje postać dwuwymiarowej tabeli.

```plaintext
+-----------------------------------------------------------------------------------+
| LOGICZNA STRUKTURA RELACJI (TABELA)                                               |
|                                                                                   |
| Schemat relacji R(A1: D1, A2: D2, ..., An: Dn)                                    |
|                                                                                   |
|  Atrybut A1 (Kolumna 1)   Atrybut A2 (Kolumna 2)   ...   Atrybut An (Kolumna n)   |
|  +---------------------+  +---------------------+        +---------------------+  |
|  | Domena: INT         |  | Domena: VARCHAR(50) |        | Domena: DECIMAL     |  |
|  +---------------------+  +---------------------+        +---------------------+  |
|             |                        |                              |             |
|             v                        v                              v             |
|  [ Wartość v1,1      ]    [ Wartość v1,2        ]  ...   [ Wartość v1,n        ]  | <- Krotka t1 (Wiersz 1)
|  [ Wartość v2,1      ]    [ Wartość v2,2        ]  ...   [ Wartość v2,n        ]  | <- Krotka t2 (Wiersz 2)
|  [ Wartość vm,1      ]    [ Wartość vm,2        ]  ...   [ Wartość vm,n        ]  | <- Krotka tm (Wiersz m)
+-----------------------------------------------------------------------------------+
```

### Aksjomaty relacji i reguły integralności Codda

Aby struktura tabelaryczna spełniała wymogi formalnej relacji, musi podlegać restrykcyjnym regułom matematycznym:

* **Niezależność kolejności krotek:** Ponieważ relacja jest zbiorem, kolejność wierszy w tabeli nie ma żadnego znaczenia semantycznego. System RDBMS nie gwarantuje stałego porządku zwracania danych bez jawnej klauzuli sortowania.
* **Niezależność kolejności atrybutów:** Każdy atrybut posiada unikalną nazwę w ramach nagłówka relacji, co uniezależnia interpretację danych od fizycznej pozycji kolumny w pliku bazy.
* **Brak duplikatów (Unikalność krotek):** W relacji matematycznej nie mogą istnieć dwa identyczne elementy. Z zasady tej bezpośrednio wynika konieczność definiowania kluczy głównych.
* **Atomowość atrybutów (Pierwsza Postać Normalna – 1NF):** Każda komórka na przecięciu wiersza i kolumny musi zawierać wyłącznie jedną wartość skalarną, nienależącą do typu powtarzalnego, tablicowego czy zagnieżdżonego rekordu.

---

## 1.2. Transakcyjność i paradygmat ACID

RDBMS różni się od prostych struktur bazodanowych (plików CSV, systemów klucz-wartość bez kontroli współbieżności) implementacją pojęcia **transakcji**. Transakcja bazodanowa stanowi logiczną jednostkę pracy (*Logical Unit of Work – LUW*), która grupuje jedno lub więcej poleceń SQL w taki sposób, że cała sekwencja musi zostać wykonana bezbłędnie albo całkowicie cofnięta, nie pozostawiając struktur danych w stanie częściowej modyfikacji.

Niezawodność i przewidywalność transakcji opisuje formalny paradygmat **ACID**:

### Atomicity (Atomowość / Niepodzielność)
Zasada „wszystko albo nic” (*All-or-Nothing*). Jeżeli w ramach transakcji składającej się z 10 operacji modyfikacji danych 9 wykona się pomyślnie, a dziesiąta zgłosi błąd naruszenia ograniczenia integralności, serwer RDBMS ma bezwzględny obowiązek wycofania wszelkich zmian wprowadzonych przez pierwsze 9 instrukcji.

* **Mechanizm realizacji:** Silnik bazy danych rejestruje stan pierwotny modyfikowanych rekordów w specjalnych strukturach wycofywania – w silniku InnoDB w MySQL jest to tzw. **Undo Log** (segmenty wycofywania transakcji). W razie błędu lub wywołania instrukcji `ROLLBACK` silnik odczytuje rejestr Undo i przywraca oryginalne wartości krotek.

### Consistency (Spójność)
Transakcja może przenieść bazę danych wyłącznie z jednego stanu spójnego w inny stan spójny. Oznacza to, że żadna transakcja nie ma prawa naruszyć zdefiniowanych reguł integralności:
* Ograniczeń unikalności (`UNIQUE`).
* Ograniczeń kluczy głównych (`PRIMARY KEY`) i dopuszczalności wartości pustych (`NOT NULL`).
* Integralności referencyjnej (`FOREIGN KEY`).
* Ograniczeń dziedzinowych i sprawdzających (`CHECK`).

Jeśli wykonanie transakcji doprowadziłoby do naruszenia choćby jednego z tych niezmienników, system automatycznie przerywa operację i przywraca stan poprzedni.

### Isolation (Izolacja)
Określa stopień, w jakim współbieżnie wykonywane transakcje są od siebie odseparowane. W idealnym środowisku każda równoległa transakcja powinna zachowywać się tak, jakby miała wyłączny dostęp do bazy danych (wykonanie szeregowe). W praktyce inżynierskiej pełna izolacja dławi przepustowość systemu, dlatego wprowadzono cztery standardowe poziomy izolacji transakcji (zdefiniowane w normie ANSI/ISO SQL-92):

| Poziom Izolacji | Brudny odczyt (*Dirty Read*) | Nieniepowtarzalny odczyt (*Non-repeatable Read*) | Odczyt widmo (*Phantom Read*) |
| :--- | :--- | :--- | :--- |
| **Read Uncommitted** | Występuje | Występuje | Występuje |
| **Read Committed** | Wyeliminowany | Występuje | Występuje |
| **Repeatable Read** | Wyeliminowany | Wyeliminowany | Wyeliminowany (w InnoDB dzięki MVCC i Gap Locks) |
| **Serializable** | Wyeliminowany | Wyeliminowany | Wyeliminowany |

* **Anomalie współbieżności:**
  * *Dirty Read:* Transakcja A odczytuje wiersz zmodyfikowany przez transakcję B, który nie został jeszcze zatwierdzony (`COMMIT`). Jeśli transakcja B wykona `ROLLBACK`, dane odczytane przez A stają się bezwartościowe.
  * *Non-repeatable Read:* Transakcja A odczytuje wiersz. Transakcja B modyfikuje ten sam wiersz i zatwierdza zmianę. Transakcja A ponownie odczytuje ten sam wiersz i otrzymuje inne wartości.
  * *Phantom Read:* Transakcja A odczytuje zbiór wierszy spełniających warunek `WHERE`. Transakcja B wstawia nowy wiersz spełniający ten sam warunek i zatwierdza operację. Transakcja A ponawia zapytanie i widzi nowy rekord, który wcześniej nie istniał.

Współczesne silniki (np. MySQL InnoDB, PostgreSQL) realizują izolację bez drastycznych blokad odczytu za pomocą technologii **MVCC** (*Multi-Version Concurrency Control*). Każda krotka posiada wewnętrzne identyfikatory wersji i transakcji (w InnoDB: `DB_TRX_ID` oraz `DB_ROLL_PTR`), co pozwala na odczyt spójnej migawki danych (*Snapshot Isolation*) z poziomu segmentów Undo Log, podczas gdy inne wątki równolegle zapisują nowe dane.

### Durability (Trwałość)
Gwarancja, że z chwilą, gdy serwer potwierdził pomyślne zatwierdzenie transakcji (`COMMIT`), wprowadzone zmiany są bezpiecznie zapisane na nośniku trwałym i nie zostaną utracone nawet w przypadku nagłej awarii zasilania serwera, błędu jądra systemu operacyjnego czy awarii sprzętowej w kolejnej milisekundzie.

* **Mechanizm realizacji:** Pamięć operacyjna RAM jest ulotna. Silnik bazy danych nie może jednak zapisywać całych zmienionych stron danych (np. bloków 16 KB) na dysk synchronicznie przy każdym `COMMIT`, ponieważ operacje losowego zapisu I/O natychmiast zablokowałyby dyski. 
  Zamiast tego stosuje się algorytm **WAL** (*Write-Ahead Logging*). Zmiany są dopisywane sekwencyjnie do małego, wysoce zoptymalizowanego dziennika ponawiania transakcji – **Redo Log**. Dopiero po fizycznym zrzuceniu logu Redo na dysk za pomocą funkcji systemowej `fsync()` transakcja jest uznawana za zatwierdzoną. Modyfikacja właściwych stron danych w przestrzeni tabel (*Data Pages*) następuje asynchronicznie w tle w procesie zwanym *Checkpointing*.

---

## 1.3. Wewnętrzna architektura serwera baz danych (RDBMS Engine)

Serwer baz danych nie jest prostym programem odczytującym pliki, lecz złożonym, wielowątkowym systemem operacyjnym działającym wewnątrz nadrzędnego systemu operacyjnego (np. Linux). Architektura nowoczesnego silnika RDBMS (takiego jak MySQL z silnikiem InnoDB) dzieli się na warstwy logiczne realizujące odrębne zadania obliczeniowe.

```plaintext
+-----------------------------------------------------------------------------------+
|                        KLIENT SQL (Aplikacja, CLI, DBeaver)                       |
+-----------------------------------------------------------------------------------+
                                          |
                        [ Połączenie: TCP/IP lub UNIX Socket ]
                                          v
+-----------------------------------------------------------------------------------+
| WARSTWA POŁĄCZEŃ I BEZPIECZEŃSTWA (Connection & Authentication Pool)              |
| - Uwierzytelnianie użytkownika (Hasło, Certyfikat SSL/TLS)                         |
| - Autoryzacja uprawnień (Zasada najmniejszych uprawnień)                           |
| - Zarządzanie wątkami klientów (Thread per Connection / Thread Pool)              |
+-----------------------------------------------------------------------------------+
                                          |
                                          v
+-----------------------------------------------------------------------------------+
| WARSTWA USŁUG SYSTEMOWYCH I PARSOWANIA (Core Services Layer)                      |
|                                                                                   |
|  +------------------------+      +------------------------+                       |
|  | Analizator Leksykalny  | ---> | Parser Składniowy      |                       |
|  | (Tokenizacja zapytań)  |      | (Budowa drzewa AST)    |                       |
|  +------------------------+      +------------------------+                       |
|                                              |                                    |
|                                              v                                    |
|  +------------------------+      +------------------------+                       |
|  | Preprocesor Semantyczny| ---> | Optymalizator Zapytań  |                       |
|  | (Weryfikacja obiektów) |      | (Cost-Based Optimizer) |                       |
|  +------------------------+      +------------------------+                       |
|                                              |                                    |
|                                              v                                    |
|                                  +------------------------+                       |
|                                  | Silnik Wykonawczy      |                       |
|                                  | (Execution Engine)     |                       |
|                                  +------------------------+                       |
+-----------------------------------------------------------------------------------+
                                          |
                        [ Wewnętrzne API Storage Engine ]
                                          v
+-----------------------------------------------------------------------------------+
| WARSTWA SILNIKÓW PAMIĘCI MASOWEJ (Pluggable Storage Engines - np. InnoDB)         |
|                                                                                   |
|  STRUKTURY PAMIĘCI ULOTNEJ (RAM):                                                 |
|  +-----------------------------------------------------------------------------+  |
|  | INNODB BUFFER POOL                                                          |  |
|  |  * Pule buforów stron danych (Data Pages: 16 KB)                            |  |
|  |  * Lista czystych i brudnych stron (LRU List, Flush List)                   |  |
|  |  * Change Buffer (Buforowanie modyfikacji indeksów wtórnych)                |  |
|  |  * Adaptive Hash Index (Dynamiczne tablice haszujące)                       |  |
|  +-----------------------------------------------------------------------------+  |
|  | LOG BUFFER (Bufor wpisów Redo Log przed zrzutem fsync)                     |  |
|  +-----------------------------------------------------------------------------+  |
|                                                                                   |
|  STRUKTURY TRWAŁE (DYSK PAMIĘCI MASOWEJ):                                         |
|  +---------------------+   +---------------------+   +--------------------------+ |
|  | Przestrzeń Tabel    |   | Dziennik Ponawiania |   | Dziennik Wycofywania     | |
|  | Systemowych i Usera |   | (Redo Log: ib_logfile)  (Undo Tablespaces)         | |
|  | (*.ibd - B+ Drzewa) |   | Doublewrite Buffer  |   | Segmenty MVCC            | |
|  +---------------------+   +---------------------+   +--------------------------+ |
+-----------------------------------------------------------------------------------+
```

### Anatomia przepływu zapytania SQL: Od tekstu do dysku

Gdy aplikacja wysyła zapytanie (np. `SELECT imie, nazwisko FROM klienci WHERE id = 105;`), wewnątrz serwera zachodzi sekwencja ściśle zoptymalizowanych zdarzeń:

1. **Tokenizacja i analiza leksykalna:** Silnik dzieli surowy ciąg znaków na tokeny (słowa kluczowe: `SELECT`, `FROM`, `WHERE`, identyfikatory kolumn i wartości literałów).
2. **Budowa drzewa składniowego (AST – *Abstract Syntax Tree*):** Parser weryfikuje gramatyczną poprawność zapytania zgodnie ze standardem SQL. Błąd składni (*Syntax Error*) jest generowany właśnie na tym etapie.
3. **Preprocesor semantyczny:** Sprawdza poprawność logiczną: czy tabela `klienci` istnieje w aktualnej bazie danych, czy kolumny `imie`, `nazwisko`, `id` należą do tej tabeli oraz czy użytkownik wykonujący zapytanie posiada uprawnienie `SELECT` do tych zasobów.
4. **Optymalizator oparty na kosztach (CBO – *Cost-Based Optimizer*):** Serwer analizuje statystyki tabeli (liczbę wierszy, histogramy rozkładu wartości, kardynalność indeksów) i generuje alternatywne plany wykonania zapytania (*Execution Plans*). Każdemu planowi przypisuje koszt obliczeniowy mierzony w umownych jednostkach (odczyty z pamięci, operacje I/O z dysku). Optymalizator decyduje m.in.:
   * Czy przeszukać tabelę sekwencyjnie (*Full Table Scan*).
   * Czy użyć indeksu klastrowego (`PRIMARY KEY`) lub indeksu wtórnego.
   * W jakiej kolejności połączyć tabele w operacjach `JOIN`.
5. **Silnik wykonawczy (Executor):** Przekształca wybrany plan na wywołania wewnętrznego interfejsu silnika pamięci masowej (*Storage Engine Handler API*).
6. **Dostęp do bufora i nośnika (InnoDB Buffer Pool):** Silnik sprawdza, czy strona pamięci o rozmiarze 16 KB zawierająca żądany rekord znajduje się w puli pamięci RAM (`innodb_buffer_pool`). 
   * Jeśli strona znajduje się w pamięci (tzw. *Buffer Hit*), rekord jest natychmiast odczytywany bez angażowania podsystemu dyskowego.
   * Jeśli strony nie ma w pamięci (*Buffer Miss*), wątek serwera wysyła synchroniczne żądanie I/O do jądra systemu operacyjnego, wczytuje blok 16 KB z pliku `.ibd` do pamięci RAM, a następnie zwraca wiersz do warstwy wykonawczej.

---

## 1.4. Architektura klient-serwer i mechanika protokołu komunikacyjnego

W architekturze dwuwarstwowej serwera bazy danych mamy do czynienia z asymetrycznym podziałem ról pomiędzy dwoma procesami:

* **Serwer bazy danych (Demon, np. `mysqld`, `postgres`):** Proces działający w tle, stale nasłuchujący na dedykowanych gniazdach komunikacyjnych, zarządzający zasobami sprzętowymi, egzekwujący spójność i transakcyjność.
* **Klient bazy danych (Aplikacja, CLI, sterownik JDBC/ODBC/PDO):** Proces inicjujący połączenie, wysyłający zapytania w języku SQL i odbierający pakiety ze zbiorami wynikowymi (*Result Set*).

### Kanały komunikacji międzyprocesowej (IPC)

Komunikacja pomiędzy klientem a serwerem odbywa się za pośrednictwem dwóch głównych mechanizmów:

1. **Gniazdo domenowe systemu UNIX (*UNIX Domain Socket*):**
   * Stosowane wyłącznie wtedy, gdy proces klienta (np. serwer PHP-FPM) i demon bazy danych działają **na tej samej maszynie fizycznej lub w tym samym kontenerze**.
   * W systemie Linux domyślny plik gniazda to zazwyczaj `/var/run/mysqld/mysqld.sock` lub `/tmp/mysql.sock`.
   * **Zaleta wydajnościowa:** Połączenie omija cały stos sieciowy TCP/IP, pętlę zwrotną (*loopback*), sumy kontrolne i routing pakietowy. Komunikacja zachodzi w przestrzeni jądra poprzez bezpośrednie kopiowanie buforów w pamięci RAM, co daje minimalne opóźnienia (*sub-millisecond latency*) i redukuje narzut na CPU.
2. **Gniazdo sieciowe TCP/IP (*Network Socket*):**
   * Wykorzystywane, gdy klient i serwer znajdują się na różnych maszynach w sieci LAN/WAN lub gdy aplikacja celowo łączy się przez adres pętli zwrotnej (`127.0.0.1`).
   * Domyślny port dla serwera MySQL/MariaDB to **3306**, natomiast dla PostgreSQL to **5432**.
   * Wymaga narzutu na trójdrożny uścisk dłoni TCP (*Three-Way Handshake: SYN, SYN-ACK, ACK*), fragmentację pakietów, weryfikację sum kontrolnych oraz opcjonalne szyfrowanie sesji za pomocą protokołu TLS/SSL.

### Anatomia protokołu binarnego MySQL

Komunikacja przez sieć nie odbywa się czystym tekstem, lecz za pomocą binarnego protokołu ramkowego. Każda ramka przesyłana przez sieć posiada 4-bajtowy nagłówek:

```plaintext
+-----------------------------------+-------------------+--------------------------------------+
| 3 Bajty: Długość ładunku (Payload)| 1 Bajt: Numer     | N Bajtów: Rzeczywisty ładunek        |
| (Payload Length: do 16 MB)        | sekwencyjny pakietu| pakietu binarnego (Command / Data)  |
+-----------------------------------+-------------------+--------------------------------------+
```

Przebieg ustanawiania sesji i wykonania zapytania:

1. **TCP Connection:** Ustanowienie połączenia warstwy transportowej.
2. **Initial Handshake Packet:** Serwer wysyła pakiet powitalny zawierający wersję serwera, identyfikator wątku połączenia, ziarno szyfrujące (*auth plugin data / salt*) oraz maskę obsługiwanych możliwości (*Capabilities Flags*).
3. **Handshake Response Packet:** Klient odsyła nazwę użytkownika, skrót hasła zaszyfrowany solą serwera (np. za pomocą algorytmu `caching_sha2_password`), nazwę domyślnej bazy danych oraz flagi konfiguracyjne (np. żądanie kompresji zlib, żądanie szyfrowania SSL).
4. **OK Packet:** Serwer weryfikuje tożsamość w tabelach uprawnień `mysql.user` i zatwierdza autoryzację.
5. **Command Phase (COM_QUERY):** Klient wysyła pakiet o kodzie `0x03` wraz z zapytaniem SQL w formie tekstowej.
6. **Resultset Transmission:** Serwer odpowiada sekwencją pakietów:
   * Pakiet metadanych kolumn (nazwy, typy, długości).
   * Pakiety wierszy danych (*Row Packets*).
   * Pakiet domykający zbiór danych (*EOF Packet* lub *OK Packet* w nowszych wersjach protokołu).

---

## 1.5. Rola i semantyka języka SQL

Język **SQL** (*Structured Query Language*) jest deklaratywnym językiem zapytań. Oznacza to фундаментальную różnicę w stosunku do imperatywnych języków programowania (C, Rust, Python, PHP): programista formułujący zapytanie SQL definiuje **co** chce osiągnąć (jakie rekordy, z jakich relacji, spełniające jakie warunki predykatu logicznego), a nie **jak** komputer ma to fizycznie wykonać krok po kroku. Odpowiedzialność za dobór algorytmów przeszukiwania, pętli, alokacji buforów i struktur danych spoczywa w całości na silniku bazy danych.

W architekturze RDBMS język SQL dzieli się na wyspecjalizowane podzbiory funkcjonalne:

* **DDL (Data Definition Language) – Język definicji danych:** Odpowiada za tworzenie, modyfikację i niszczenie struktur przechowujących dane oraz metadanych serwera (`CREATE`, `ALTER`, `DROP`, `TRUNCATE`, `RENAME`).
* **DML (Data Manipulation Language) – Język manipulacji danymi:** Służy do modyfikacji zawartości tabel na poziomie pojedynczych wierszy (`INSERT`, `UPDATE`, `DELETE`).
* **DQL (Data Query Language) – Język zapytań:** Odpowiada za pobieranie, filtrowanie, agregację i projekcję danych z relacji (`SELECT`).
* **DCL (Data Control Language) – Język kontroli danych:** Zarządza uprawnieniami, rolami oraz poziomem dostępu użytkowników do konkretnych tabel, widoków i procedur (`GRANT`, `REVOKE`).
* **TCL (Transaction Control Language) – Język sterowania transakcjami:** Kontroluje granice transakcyjności i spójność zapisu (`START TRANSACTION`, `COMMIT`, `ROLLBACK`, `SAVEPOINT`).

---

# Sekcja 2: Wdrożenie, hardening, konfiguracja sieciowa i strojenie wydajnościowe serwera baz danych

## 2.1. Przygotowanie systemu operacyjnego i instalacja serwera RDBMS

Środowiskiem referencyjnym dla produkcyjnych wdrożeń RDBMS są systemy uniksowe z rodziny Linux (Debian, Ubuntu Server, Red Hat Enterprise Linux, Rocky Linux lub ultrakompaktowy Alpine Linux stosowany w kontenerach). Przed instalacją pakietów konieczne jest dostosowanie limitów jądra systemu operacyjnego (*Kernel Parameters*), aby zapobiec dławieniu serwera przy wysokim obciążeniu współbieżnymi połączeniami.

### Konfiguracja limitów systemowych (OS-level Tuning)

W pliku `/etc/security/limits.conf` należy podnieść limity otwartych deskryptorów plików (*file descriptors*) oraz maksymalnej liczby procesów/wątków dla użytkownika systemowego `mysql`:

```ini
# /etc/security/limits.conf
mysql    soft    nofile    65535
mysql    hard    nofile    65535
mysql    soft    nproc     4096
mysql    hard    nproc     4096
```

Równolegle w konfiguracji parametrów jądra (`/etc/sysctl.conf`) należy zweryfikować zachowanie pamięci wirtualnej:

```ini
# Redukcja agresywności wymiany stron pamięci na partycję SWAP (kluczowe dla baz danych)
vm.swappiness = 1

# Zwiększenie limitu kolejki połączeń przychodzących gniazd sieciowych
net.core.somaxconn = 4096
```
Zastosowanie parametrów bez restartu: `sudo sysctl -p`.

### Procedura instalacji pakietów RDBMS

#### Wariant A: Systemy Debian / Ubuntu Server (MySQL 8.x / MariaDB)

```bash
# Aktualizacja repozytoriów systemowych
sudo apt update && sudo apt upgrade -y

# Instalacja serwera MySQL oraz narzędzi pomocniczych
sudo apt install -y mysql-server mysql-client

# Weryfikacja statusu demona w systemd
sudo systemctl status mysql.service
```

#### Wariant B: Systemy Alpine Linux (Lekkie wdrożenia VPS / Mikroserwery)

```bash
# Instalacja pakietów MariaDB/MySQL w systemie Alpine
sudo apk add --no-cache mariadb mariadb-client

# Inicjalizacja bazowego katalogu danych i tabel systemowych
sudo /usr/bin/mariadb-install-db --user=mysql --datadir=/var/lib/mysql

# Dodanie usługi do domyślnego poziomu uruchomieniowego OpenRC i start
sudo rc-update add mariadb default
sudo rc-service mariadb start
```

### Fizyczna topologia plików w systemie Linux

Po zakończeniu instalacji serwer organizuje swoje zasoby w standardowej hierarchii ścieżek:

* `/var/lib/mysql/` – Główny katalog danych (*Data Directory*). Zawiera pliki przestrzeni tabel (`ibdata1`, podkatalogi z plikami `*.ibd`), pliki dziennika Redo Log (`#ib_redo*`) oraz pliki dziennika binarnego. Właścicielem musi być bezwzględnie `mysql:mysql` z prawami `750` lub `700`.
* `/etc/mysql/` lub `/etc/my.cnf.d/` – Główna lokalizacja plików konfiguracyjnych (`my.cnf`).
* `/var/log/mysql/` – Dzienniki systemowe: plik błędów (`error.log`), dziennik wolnych zapytań (`slow.log`).
* `/var/run/mysqld/` – Lokalizacja gniazda procesowego (`mysqld.sock`) oraz pliku z numerem PID aktywnego procesu (`mysqld.pid`).

---

## 2.2. Procedura bezpieczeństwa i utwardzanie serwera (Hardening)

Domyślna instalacja serwera baz danych posiada ustawienia zoptymalizowane pod kątem łatwości pierwszego uruchomienia, co w środowisku produkcyjnym stanowi krytyczne zagrożenie bezpieczeństwa. Pierwszym krokiem administratora musi być wykonanie skryptu utwardzającego:

```bash
sudo mysql_secure_installation
```

Skrypt ten wykonuje kluczowe operacje zabezpieczające:
1. Weryfikuje lub wymusza silną politykę haseł poprzez wtyczkę `validate_password` (minimalna długość, obecność wielkich liter, cyfr i znaków specjalnych).
2. Usuwa anonimowe konta użytkowników (`DELETE FROM mysql.user WHERE User='';`).
3. Blokuje możliwość zdalnego logowania na konto administratora `root` z innych hostów niż `localhost`.
4. Usuwa testową bazę danych (`test`), do której domyślnie dostęp posiadał każdy nieuwierzytelniony użytkownik.
5. Przeładowuje tabele uprawnień (`FLUSH PRIVILEGES;`).

### Zarządzanie użytkownikami zgodnie z zasadą najmniejszych uprawnień (POLP)

Złotą zasadą inżynierii bezpieczeństwa baz danych jest **Zasada Najmniejszych Uprawnień** (*Principle of Least Privilege*). Aplikacja sieciowa nigdy nie może łączyć się z bazą danych za pośrednictwem konta `root`. Dla każdej aplikacji tworzy się dedykowanego użytkownika z uprawnieniami ograniczonymi wyłącznie do jej własnej bazy danych i ściśle określonych hostów źródłowych.

Logowanie administracyjne do konsoli bazy danych:

```bash
sudo mysql -u root
```

Wdrożenie użytkownika produkcyjnego dla aplikacji (np. platformy edukacyjnej):

```sql
-- 1. Tworzenie dedykowanej bazy danych z nowoczesnym kodowaniem wielobajtowym
CREATE DATABASE IF NOT EXISTS platforma_kursowa
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_520_ci;

-- 2. Tworzenie użytkownika ograniczonego do lokalnego hosta (np. serwer WWW na tej samej maszynie)
-- Zastosowanie wtyczki nowoczesnego haszowania SHA-256
CREATE USER 'kurs_app_user'@'localhost' 
    IDENTIFIED WITH caching_sha2_password BY 'B4rdzo$ilne_H@slo#2026';

-- 3. Nadanie wyłącznie niezbędnych uprawnień manipulacyjnych i definicyjnych
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, LOCK TABLES 
    ON platforma_kursowa.* 
    TO 'kurs_app_user'@'localhost';

-- 4. Jawne przeładowanie pamięci podręcznej uprawnień
FLUSH PRIVILEGES;
```

Jeśli aplikacja znajduje się na osobnym serwerze aplikacyjnym w dedykowanej sieci prywatnej (np. pod adresem IP `10.0.1.50`), definicję hosta w koncie użytkownika należy bezwzględnie zawęzić:

```sql
CREATE USER 'kurs_app_user'@'10.0.1.50' 
    IDENTIFIED WITH caching_sha2_password BY 'Inne$ilne_H@slo#2026';

GRANT SELECT, INSERT, UPDATE, DELETE 
    ON platforma_kursowa.* 
    TO 'kurs_app_user'@'10.0.1.50';
```

---

## 2.3. Architektura sieciowa, nasłuchiwanie i zapora ogniowa

Domyślnie bezpieczna instalacja MySQL nasłuchuje wyłącznie na interfejsie pętli zwrotnej (*Loopback Interface*): `127.0.0.1`. Oznacza to, że jakiekolwiek próby połączenia z zewnątrz sieci zostaną natychmiast odrzucone na poziomie warstwy transportowej jądra.

W pliku konfiguracyjnym (np. `/etc/mysql/mysql.conf.d/mysqld.cnf` lub `/etc/my.cnf.d/mariadb-server.cnf`) parametr `bind-address` determinuje zachowanie interfejsu sieciowego:

```ini
[mysqld]
# Domyślnie: nasłuchiwanie wyłącznie lokalne (najbezpieczniejsze, gdy app i db są na 1 VPS)
bind-address = 127.0.0.1

# UWAGA: Jeśli baza ma być dostępna z zewnętrznego serwera aplikacji w sieci LAN:
# bind-address = 10.0.1.10  <-- Wpisz prywatny adres IP serwera bazy danych
# KATEGORYCZNIE UNIKAJ wpisywania 0.0.0.0 (wszystkie interfejsy) bez restrykcyjnej zapory firewall!
```

Po zmianie dyrektywy należy zrestartować demona:

```bash
sudo systemctl restart mysql
```

Weryfikacja aktywnych portów i gniazd za pomocą polecenia `ss` lub `netstat`:

```bash
sudo ss -tulpn | grep 3306
# Prawidłowy wynik dla nasłuchu lokalnego:
# tcp  LISTEN  0  128  127.0.0.1:3306  0.0.0.0:*  users:(("mysqld",pid=1234,fd=21))
```

### Konfiguracja zapory ogniowej (Firewall Hardening)

Port bazy danych (3306) **nigdy nie powinien być publicznie wystawiony do globalnej sieci Internet**. Jeśli serwer aplikacji musi łączyć się zdalnie, dostęp na zaporze ogniowej konfiguruje się na zasadzie białej listy (*Whitelisting*).

#### Konfiguracja UFW (Uncomplicated Firewall – Ubuntu/Debian):

```bash
# Blokowanie publicznego dostępu do portu 3306
sudo ufw default deny incoming

# Zezwolenie na połączenia z portem 3306 WYŁĄCZNIE ze znanego adresu IP serwera aplikacji
sudo ufw allow from 10.0.1.50 to any port 3306 proto tcp comment 'Dostęp do MySQL z serwera App1'

# Włączenie zapory i weryfikacja reguł
sudo ufw enable
sudo ufw status verbose
```

#### Alternatywa: Bezpieczne tunelowanie przez SSH (SSH Port Forwarding)
Jeżeli zachodzi potrzeba doraźnego zarządzania bazą danych z lokalnej stacji roboczej administratora za pomocą narzędzi graficznych (DBeaver, DataGrip, MySQL Workbench), nie należy otwierać portu 3306 w zaporze. Zamiast tego tworzy się szyfrowany tunel SSH:

```bash
ssh -L 3307:127.0.0.1:3306 uzytkownik@serwer-bazy-danych.pl -N
```
W programie graficznym klient łączy się wówczas z adresem `localhost:3307`, a cały ruch sieciowy jest transparentnie i bezpiecznie szyfrowany przez tunel SSH.

---

## 2.4. Strojenie wydajnościowe silnika InnoDB (`my.cnf`)

Domyślna konfiguracja silnika RDBMS po instalacji jest skonstruowana niezwykle zachowawczo (tak, aby serwer uruchomił się nawet na maszynie wirtualnej posiadającej 512 MB pamięci RAM). Na serwerze dedykowanym lub zoptymalizowanym VPS parametry te powodują drastyczną degradację wydajności, ponieważ silnik nie wykorzystuje dostępnej pamięci operacyjnej i zbyt często odpytuje dysk masowy.

Głównym elementem podlegającym optymalizacji jest silnik **InnoDB** oraz jego struktury buforowania.

Poniżej przedstawiono zoptymalizowany, produkcyjny plik konfiguracyjny (np. `/etc/mysql/conf.d/tuning.cnf` lub sekcja `[mysqld]` w `/etc/mysql/my.cnf`) wraz ze szczegółowym wyjaśnieniem alokacji zasobów:

```ini
[mysqld]
# ==============================================================================
# 1. IDENTYFIKACJA PAMIĘCI I BUFORÓW GŁÓWNYCH (GLOBAL MEMORY ALLOCATION)
# ==============================================================================

# Najważniejszy parametr serwera baz danych. Rozmiar pamięci RAM przeznaczonej
# na buforowanie stron danych tabel oraz indeksów. 
# Rekomendacja dla serwerów dedykowanych bazodanowych: 60% - 75% całkowitej pamięci RAM.
# Dla VPS współdzielonego z serwerem WWW: ok. 30% - 40% RAM.
# Przykład dla maszyny posiadającej 8 GB RAM dedykowanej dla bazy:
innodb_buffer_pool_size = 5G

# Podział puli buforów na niezależne instancje. Zmniejsza rywalizację o blokady (mutex contention)
# pomiędzy wątkami odczytującymi/zapisującymi w środowiskach wielordzeniowych.
# Zalecane: 1 instancja na każdy 1 GB Buffer Poola.
innodb_buffer_pool_instances = 5

# Wymuszenie fizycznej separacji tabel na dysku. Każda nowo utworzona tabela
# otrzymuje własny plik .ibd zamiast wspólnego pliku ibdata1.
# Ułatwia zarządzanie miejscem na dysku i odzyskiwanie przestrzeni po operacji TRUNCATE/DROP.
innodb_file_per_table = 1

# ==============================================================================
# 2. MECHANIZMY ZAPISU TRANSAKCYJNEGO I DZIENNIKA REDO LOG (ACID VS I/O PERFORMANCE)
# ==============================================================================

# Rozmiar bufora pamięci RAM dla transakcji oczekujących na zrzut do Redo Logu.
# Zazwyczaj 16M do 64M jest wartością w zupełności wystarczającą.
innodb_log_buffer_size = 32M

# Łączna przestrzeń przeznaczona na dziennik ponawiania (Redo Log).
# Od wersji MySQL 8.0.30 zarządzana parametrem innodb_redo_log_capacity.
# Większa pojemność pozwala na buforowanie gwałtownych skoków zapisu (write bursts).
innodb_redo_log_capacity = 1G

# Strategia zrzucania logu transakcyjnego na dysk (Kluczowy kompromis ACID vs IOPS):
# 1 = Pełna zgodność z ACID (Domyślne). Zrzut i fsync() przy KAŻDYM zatwierdzeniu transakcji (COMMIT).
#     Maksymalne bezpieczeństwo kosztem dużej liczby operacji wejścia/wyjścia dysku.
# 2 = Zapis do bufora systemu operacyjnego przy każdym COMMIT, ale fsync() na dysk raz na sekundę.
#     W razie awarii systemu operacyjnego/zasilania można stracić do 1 sekundy transakcji,
#     ale awaria samego procesu mysqld nie powoduje utraty danych. Daje gigantyczny wzrost wydajności zapisu.
# 0 = Zapis i fsync() wyłącznie raz na sekundę. Najszybsze, lecz najmniej bezpieczne.
innodb_flush_log_at_trx_commit = 1

# Metoda komunikacji z systemem plików przy zrzucaniu danych:
# O_DIRECT zapobiega podwójnemu buforowaniu (double buffering) – dane trafiają bezpośrednio
# z InnoDB Buffer Pool na dysk, omijając bufor podręczny systemu operacyjnego (OS Page Cache).
innodb_flush_method = O_DIRECT

# ==============================================================================
# 3. ZARZĄDZANIE POŁĄCZENIAMI I PAMIĘĆ POJEDYNCZYCH SESJI (PER-THREAD MEMORY)
# ==============================================================================

# Maksymalna dopuszczalna liczba jednoczesnych połączeń klientów.
# Każde aktywne połączenie alokuje własne bufory pamięci (sort, join, read)!
max_connections = 250

# Czas w sekundach, przez jaki serwer oczekuje na aktywność na połączeniu interaktywnym/nieinteraktywnym.
# Zmniejszenie z domyślnych 28800 s (8 h) do rozsądnych wartości zwalnia wiszące wątki aplikacji.
wait_timeout = 300
interactive_timeout = 300

# Rozmiary buforów przydzielanych dynamicznie per wątek kliencki.
# ZBYT DUŻE wartości mogą doprowadzić do natychmiastowego wyczerpania pamięci RAM (OOM Killer)!
sort_buffer_size = 2M
join_buffer_size = 2M
read_rnd_buffer_size = 1M

# Pula pamięci podręcznej dla wątków. Pozwala na ponowne wykorzystanie istniejących wątków
# zamiast ich ciągłego niszczenia i tworzenia na poziomie jądra systemu.
thread_cache_size = 32
```

---

## 2.5. Diagnostyka, inspekcja stanu i rejestrowanie wolnych zapytań (Slow Query Log)

Nawet najlepiej zabezpieczony i wstępnie skonfigurowany serwer wymaga stałego monitorowania metryk wydajnościowych. System RDBMS udostępnia wewnętrzne narzędzia telemetryczne pozwalające na dokładną inspekcję zachodzących procesów.

### Dziennik wolnych zapytań (Slow Query Log)

Podstawowe narzędzie inżyniera baz danych do eliminowania wąskich gardeł w aplikacjach. Rejestruje do pliku każde zapytanie SQL, którego czas wykonania przekroczył zadany próg tolerancji lub które nie wykorzystało prawidłowo indeksów tabelarycznych.

Aktywacja rejestratora w konfiguracji `/etc/mysql/my.cnf`:

```ini
[mysqld]
# Włączenie mechanizmu powolnych zapytań
slow_query_log = 1

# Ścieżka docelowa do pliku dziennika
slow_query_log_file = /var/log/mysql/slow-query.log

# Próg czasowy w sekundach (np. 0.5 sekundy = 500 milisekund).
# Zapytania trwające dłużej zostaną przechwycone do logu.
long_query_time = 0.5

# Rejestruj także zapytania, które nie używają indeksów (opcjonalne, przydatne w fazie testów)
# log_queries_not_using_indexes = 1
```

Zastosowanie zmian wymaga restartu usługi lub wykonania zapytań dynamicznych w sesji administracyjnej:

```sql
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 0.5;
```

#### Analiza dziennika za pomocą narzędzia `mysqldumpslow`:
Ręczne przeglądanie wielomegabajtowych plików logów jest nieefektywne. W systemie Linux wykorzystuje się dedykowany agregator `mysqldumpslow`:

```bash
# Wyświetlenie 10 najczęściej powtarzających się zapytań posortowanych według łącznego czasu wykonywania
mysqldumpslow -s t -t 10 /var/log/mysql/slow-query.log

# Wyświetlenie zapytań posortowanych według średniego czasu trwania, z wyłączeniem wartości liczbowych
mysqldumpslow -s at -a /var/log/mysql/slow-query.log
```

### Kluczowe zapytania inspekcyjne w konsoli administratora

1. **Weryfikacja aktywnych połączeń i zablokowanych wątków:**
   ```sql
   SHOW FULL PROCESSLIST;
   ```
   Polecenie zwraca identyfikator wątku, użytkownika, hosta, aktualnie odpytywaną bazę, czas trwania operacji w sekundach oraz wykonywane zapytanie. W razie wykrycia zapytania blokującego całą bazę (np. wiszącej blokady metadanych) administrator może natychmiast ubić dany wątek:
   ```sql
   KILL CONNECTION 1054;
   ```

2. **Głęboka analiza telemetrii silnika pamięci masowej:**
   ```sql
   SHOW ENGINE INNODB STATUS\G
   ```
   Generuje szczegółowy raport techniczny, podzielony na sekcje diagnostyczne:
   * **SEMAPHORES:** Informacje o oczekiwaniu na blokady pamięciowe (*Mutex Wait*), wskazujące na wąskie gardła procesora.
   * **TRANSACTIONS:** Wykaz aktywnych transakcji, blokad wierszy oraz historia wykrytych zakleszczeń (*Deadlocks* wraz z pełnym zrzutem zapytań kolidujących).
   * **BUFFER POOL AND MEMORY:** Dokładny stan utylizacji pamięci: liczba stron wczytanych, brudnych (*dirty pages*), wskaźnik trafień w pamięć podręczną (*Buffer Pool Hit Rate* – w zdrowym systemie produkcyjnym wskaźnik ten powinien przekraczać 990/1000, czyli 99%).
   * **FILE I/O:** Prędkość zapisu logów i stron oraz liczba oczekujących synchronicznych operacji wejścia/wyjścia.

3. **Weryfikacja zmiennych statusowych serwera:**
   ```sql
   -- Weryfikacja liczby przerwanych połączeń (częsty symptom problemów sieciowych lub ataków)
   SHOW GLOBAL STATUS LIKE 'Aborted_connects';

   -- Sprawdzenie ile tabel tymczasowych zostało zrzuconych na dysk zamiast do RAM
   SHOW GLOBAL STATUS LIKE 'Created_tmp_disk_tables';

   -- Wskaźnik liczby otwartych plików względem limitu systemowego
   SHOW GLOBAL STATUS LIKE 'Open_files';
   ```

---
