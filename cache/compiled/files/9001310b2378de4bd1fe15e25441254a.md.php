<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledMarkdownFile',
    'filename' => '/var/www/html/user/pages/05.lsk/02.warstwa-dostepowa-i-technologia-ethernet/docs.md',
    'modified' => 1791259533,
    'size' => 29064,
    'data' => [
        'header' => [
            'title' => 'Warstwa dostępowa i technologia Ethernet',
            'published' => true
        ],
        'frontmatter' => 'title: \'Warstwa dostępowa i technologia Ethernet\'
published: true',
        'markdown' => '# Część 1: Architektura warstwy łącza danych, adresacja EUI-48, ramkowanie i medium fizyczne

Jednostka lekcyjna skupiająca się na logicznym podziale warstwy łącza danych, różnicach między modelem ISO/OSI a standardem IEEE 802, analizie bitowej adresu MAC oraz budowie ramki sieciowej.

---

## 1. Wprowadzenie i podział warstwy łącza danych (IEEE 802 vs OSI)

### Ewolucja historyczna technologii
* **1970 (ALOHANET):** Norman Abramson na Uniwersytecie Hawajskim uruchamia pierwszą sieć radiową z losowym dostępem do medium. Wprowadza regułę: stacja nadaje pakiet od razu, a w przypadku braku potwierdzenia (kolizji) odczekuje losowy czas. Był to bezpośredni przodek algorytmów kolizyjnych.
* **1973 (Xerox PARC):** Robert Metcalfe i David Boggs adaptują koncepcję ALOHA do kabla koncentrycznego, tworząc eksperymentalny Ethernet o prędkości 2,94 Mb/s łączący komputery Xerox Alto z pierwszą drukarką laserową.
* **1980 (Konsorcjum DIX):** Firmy *Digital Equipment Corporation (DEC), Intel* oraz *Xerox* publikują otwartą specyfikację Ethernet 10 Mb/s (standard DIX Ethernet I, a w 1982 r. – Ethernet II).
* **1983–1985 (IEEE 802.3):** Komitet Standaryzacyjny IEEE formalizuje Ethernet jako międzynarodową normę techniczną IEEE 802.3.

```plaintext
+---------------------------------------------------------------------------------------------------+
| STRUKTURA WARSTWY ŁĄCZA DANYCH WG KOMITETU STANDARYZACYJNEGO IEEE 802                             |
|                                                                                                   |
|  MODEL ODNIESIENIA ISO/OSI               ARCHITEKTURA STANDARDU IEEE 802                          |
|  +-----------------------------+         +-----------------------------------------------------+  |
|  | Warstwa 3: Sieciowa         |         | Warstwa 3: Sieciowa (np. protokół IPv4, IPv6, ARP) |  |
|  +-----------------------------+         +-----------------------------------------------------+  |
|                                                                     ^                             |
|                                                                     | SAP / SNAP / EtherType      |
|                                                                     v                             |
|  +-----------------------------+         +-----------------------------------------------------+  |
|  |                             |         | Podwarstwa LLC (Logical Link Control - IEEE 802.2)  |  |
|  | Warstwa 2: Łącza danych     | <=====> | - Wspólny interfejs programowy dla warstwy 3        |  |
|  | (Data Link Layer)           |         | - Niezależność od medium transmisyjnego             |  |
|  |                             |         +-----------------------------------------------------+  |
|  |                             |         | Podwarstwa MAC (Media Access Control - IEEE 802.3)  |  |
|  |                             |         | - Adresacja fizyczna (EUI-48 / MAC)                 |  |
|  |                             |         | - Ramkowanie, sumy kontrolne FCS (CRC-32)           |  |
|  |                             |         | - Kontrola dostępu do medium (CSMA/CD / Full-Duplex)|  |
|  +-----------------------------+         +-----------------------------------------------------+  |
|                                                                     ^                             |
|                                                                     | Interfejs MII / GMII / RGMII|
|                                                                     v                             |
|  +-----------------------------+         +-----------------------------------------------------+  |
|  | Warstwa 1: Fizyczna         | <=====> | Warstwa Fizyczna (PHY - PCS, PMA, PMD)              |  |
|  | (Physical Layer)            |         | - Kodowanie sygnałów (Manchester, MLT-3, PAM-5)     |  |
|  |                             |         | - Transmisja bitów: 10BASE-T, 100BASE-TX, 1000BASE-T|  |
|  +-----------------------------+         +-----------------------------------------------------+  |
+---------------------------------------------------------------------------------------------------+
```

### Dlaczego komitet IEEE podzielił drugą warstwę na LLC i MAC?
W pierwotnym modelu OSI warstwa druga była jednolitym modułem. W realiach lat 80. zaczęły powstawać różnorodne standardy mediów fizycznych:
* **IEEE 802.3** – Ethernet (magistrala kablowa).
* **IEEE 802.4** – Token Bus (magistrala ze znacznikiem).
* **IEEE 802.5** – Token Ring (topologia pierścienia IBM).
* **IEEE 802.11** – Wi-Fi (sieci bezprzewodowe).

Gdyby warstwa 2 pozostała monolitem, programiści protokołów sieciowych (np. IP, IPX, AppleTalk) musieliby pisać dedykowany sterownik sieciowy pod każdy typ okablowania.

Dzięki podziałowi:
1. **Podwarstwa LLC (IEEE 802.2)** tworzy uniwersalny punkt styku. Dla protokołu IPv4 pobieranie i wysyłanie danych z karty sieciowej wygląda identycznie, niezależnie od tego, czy fizycznym nośnikiem jest skrętka miedziana kat. 6, światłowód jednomodowy czy fala radiowa Wi-Fi.
2. **Podwarstwa MAC (IEEE 802.3)** realizuje zadania sprzętowe: dopasowanie do złączy, formowanie preambuły, obliczanie sumy kontrolnej i pilnowanie reguł transmisji w kablu.

---

## 2. Podwarstwy LLC i MAC – szczegółowa analiza mechanizmów

### Podwarstwa LLC (Logical Link Control – IEEE 802.2)
Podwarstwa LLC odpowiada za logiczną wymianę danych między węzłami i realizuje trzy podstawowe tryby pracy:
* **Type 1 (Unacknowledged Connectionless):** Tryb bezpołączeniowy i bezpotwierdzeniowy. Najprostszy i najszybszy; dominuje we współczesnych sieciach IP. Jeżeli ramka ulegnie uszkodzeniu, podwarstwa LLC ją ignoruje, a retransmisją zajmują się wyższe warstwy stosu (np. TCP).
* **Type 2 (Connection-Oriented):** Tryb połączeniowy z gwarancją dostarczenia, numeracją ramek i potwierdzeniami (ACK). Używany dawniej w sieciach SNA (IBM) i przemysłowych systemach sterowania.
* **Type 3 (Acknowledged Connectionless):** Tryb bezpołączeniowy, lecz z natychmiastowym potwierdzeniem odbioru na poziomie ramki. Stosowany w automatyce i systemach czasu rzeczywistego.

#### Punkty SAP (Service Access Points) i enkapsulacja SNAP
Aby odbiorca wiedział, jakiej usłudze przekazać pakiet, nagłówek LLC definiuje 1-bajtowe pola:
* **DSAP** (*Destination Service Access Point*) – punkt dostępu odbiorcy.
* **SSAP** (*Source Service Access Point*) – punkt dostępu nadawcy.

Przykładowe historyczne wartości SAP:
* `0x06` – Protokół IPv4.
* `0xE0` – Novell NetWare IPX.
* `0x42` – Protokół drzewa rozpinającego STP (Spanning Tree Protocol).

```plaintext
NAGŁÓWEK LLC (IEEE 802.2):
+-------------------+-------------------+--------------------+
| DSAP (1 bajt)     | SSAP (1 bajt)     | Control (1 bajt)   |
+-------------------+-------------------+--------------------+

NAGŁÓWEK SNAP (Rozszerzenie dla DSAP/SSAP = 0xAA):
+-------------------+-------------------+--------------------+
| OUI (3 bajty)     | Protocol ID (2 B) | Dane (Payload)     |
+-------------------+-------------------+--------------------+
```

Ponieważ pole SAP ma tylko 8 bitów (z czego bity najmniej znaczące pełnią funkcje flag kontrolnych, pozostawiając zaledwie kilkadziesiąt unikalnych identyfikatorów), wprowadzono rozszerzenie **SNAP** (*Subnetwork Access Protocol*). Gdy w polu DSAP i SSAP pojawi się wartość `0xAA`, za nagłówkiem LLC doklejany jest nagłówek SNAP. Zawiera on 3-bajtowy identyfikator producenta **OUI** oraz 2-bajtowy identyfikator protokołu, identyczny z polem EtherType.

### Podwarstwa MAC (Media Access Control – IEEE 802.3)
Podwarstwa MAC jest implementowana sprzętowo bezpośrednio w chipsecie karty sieciowej (NIC). Realizuje cztery zadania:
1. **Adresowanie fizyczne:** Przypisywanie unikalnych adresów źródłowych i odczytywanie adresów docelowych.
2. **Kompilacja i dekompilacja ramek:** Opatrywanie danych nagłówkiem, dopełnieniem (Padding) oraz wyliczanie sumy kontrolnej.
3. **Konwersja danych na ciąg szeregowy (Serializacja):** Zamiana bajtów z magistrali komputera (PCIe) na ciąg bitów przesyłany do transceivera PHY za pośrednictwem interfejsu MII (*Media Independent Interface*).
4. **Zarządzanie dostępem do medium:** Badanie stanu łącza i realizacja algorytmu CSMA/CD (w Half-Duplex) lub koordynacja niezależnych kolejek FIFO (w Full-Duplex).

---

## 3. Adresacja fizyczna EUI-48 (Adres MAC)

Adres fizyczny standardu **EUI-48** (*Extended Unique Identifier*) to **48-bitowa liczba binarna (6 bajtów)**.

```plaintext
+-----------------------------------------------------------------------------------+
| STRUKTURA BINARNA ADRESU MAC (6 BAJTÓW / 48 BITÓW)                                |
|                                                                                   |
|  Bajt 0         Bajt 1         Bajt 2         Bajt 3         Bajt 4         Bajt 5|
|  +--------------+--------------+--------------+--------------+--------------+----+|
|  | b7 b6 ... b0 |              |              |              |              |    ||
|  +--------------+--------------+--------------+--------------+--------------+----+|
|  \\____________________________/ \\____________________________/                    |
|                |                                      |                           |
|                v                                      v                           |
|       OUI (24 bity / 3 bajty)            Numer interfejsu (24 bity / 3 bajty)     |
|   Identyfikator producenta sprzętu      Unikalny numer seryjny karty nadany       |
|   Przydzielany centralnie przez IEEE    w fabryce (Burned-In Address - BIA)       |
+-----------------------------------------------------------------------------------+
```

### Znaczenie bitów kontrolnych pierwszego bajtu
Architektura EUI-48 rezerwuje dwa najmniej znaczące bity pierwszego bajtu (bity zerowy i pierwszy) na cele sterowania logiką transmisji:

```plaintext
Pierwszy bajt adresu MAC (Bajt 0):
[ b7 | b6 | b5 | b4 | b3 | b2 | b1 (U/L) | b0 (I/G) ]
```

* **Bit 0 – I/G (Individual / Group):**
  * `0` = Adres indywidualny (**Unicast**). Identyfikuje dokładnie jedną fizyczną kartę sieciową w sieci lokalnej.
  * `1` = Adres grupowy (**Multicast**) lub rozgłoszeniowy (**Broadcast**).
* **Bit 1 – U/L (Universal / Local):**
  * `0` = Adres zarządzany globalnie (**Universal**). Adres BIA (*Burned-In Address*) trwale wypalony w pamięci ROM karty przez producenta posiadającego oficjalny prefiks OUI.
  * `1` = Adres zarządzany lokalnie (**Locally Administered**). Oznacza, że adres MAC został zmieniony programowo przez administratora (spoofing MAC) lub wygenerowany automatycznie przez maszynę wirtualną / kontener.

### Podział adresów ze względu na charakter transmisji

1. **Adresy Unicast:** Skierowane do pojedynczej stacji. Przełącznik sieciowy przekazuje taką ramkę wyłącznie na jeden port na podstawie wpisu w tablicy MAC (CAM).
2. **Adres Broadcast:** Wszystkie 48 bitów ma wartość `1`:
   $$\\text{FF:FF:FF:FF:FF:FF} = 11111111.11111111.11111111.11111111.11111111.11111111_2$$
   Ramka rozgłoszeniowa jest bezwzględnie powielana przez przełączniki na wszystkie aktywne porty w obrębie danego VLAN-u.
3. **Adresy Multicast (Wieloodbiorcze):**
   * **W sieciach IPv4:** Pula adresów IP klasy D (`224.0.0.0` do `239.255.255.255`) jest mapowana na specjalny zakres adresów MAC: od `01:00:5E:00:00:00` do `01:00:5E:7F:FF:FF`.
   * **W sieciach IPv6:** Wszystkie ramki multicastowe zaczynają się od prefiksu `33:33:xx:xx:xx:xx`.

---

## 4. Format ramki Ethernet II, tagowanie 802.1Q i suma kontrolna FCS

W praktyce inżynierskiej standard **Ethernet II (DIX)** całkowicie wyparł ramki IEEE 802.3 z nagłówkiem LLC na potrzeby enkapsulacji pakietów internetowych (IPv4, IPv6, ARP).

```plaintext
+------------+--------+---------+---------+-----------+-----------------------+---------+
| Preambuła  | SFD    | Odbiorca| Nadawca | EtherType | Dane (Payload)        | FCS     |
| 7 Bajtów   | 1 Bajt | 6 Bajtów| 6 Bajtów| 2 Bajty   | Od 46 do 1500 Bajtów  | 4 Bajty |
+------------+--------+---------+---------+-----------+-----------------------+---------+
\\____________________/ \\________________________________________________________________/
  Warstwa fizyczna                  Właściwa ramka sieciowa (od 64 do 1518 bajtów)
```

### Pola ramki Ethernet II krok po kroku

* **Preambuła (7 bajtów):** Ciąg 56 naprzemiennych bitów `10101010...`. Daje układowi odbiorczemu czas na zsynchronizowanie częstotliwości i fazy wewnętrznego generatora zegarowego z sygnałem przychodzącym.
* **SFD (Start Frame Delimiter – 1 bajt):** Wzorzec binarny `10101011`. Końcówka `11` jest sygnałem dla odbiornika: *„Koniec synchronizacji, następny bit to początek adresu docelowego!"*.
* **Adres docelowy (6 bajtów):** Adres MAC stacji odbiorczej lub adres rozgłoszeniowy/multicast.
* **Adres źródłowy (6 bajtów):** Adres MAC nadawcy. Zawsze musi być adresem indywidualnym (Unicast – bit I/G = 0).
* **EtherType (2 bajty):** Liczba określająca typ danych zawartych w polu Payload. Wartość $\\ge \\text{0x0600}$ (1536 dziesiętnie) oznacza kod protokołu.
* **Dane użytkownika (Payload – 46 do 1500 bajtów):** Enkapsulowany pakiet warstwy 3.
  * Wartość **1500 bajtów** definiuje standardowe **MTU** (*Maximum Transmission Unit*).
  * **Wymóg minimalnego rozmiaru:** Pole danych musi zawierać co najmniej **46 bajtów**. Jeżeli przesyłany pakiet jest krótszy (np. nagłówek TCP SYN bez danych lub zapytanie ARP mające 28 bajtów), sterownik karty dołącza bity o wartości `0` (tzw. **Padding / Dopełnienie**), aby ramka bez preambuły osiągnęła minimalny rozmiar 64 bajtów.
* **FCS (Frame Check Sequence – 4 bajty):** Sprzętowa suma kontrolna wyliczana algorytmem wielomianowym **CRC-32**.

### Rozszerzenie ramki: Tagowanie VLAN (Standard IEEE 802.1Q)
Gdy przełączniki przesyłają ruch z wielu wirtualnych sieci LAN przez wspólne łącze magistralne (*Trunk*), w strukturę ramki Ethernet II wstrzykiwany jest dodatkowy 4-bajtowy znacznik VLAN:

```plaintext
RAMKA ETHERNET II Z TAGIEM IEEE 802.1Q:
+----------+----------+-----------------------+-----------+------------------+---------+
| Odbiorca | Nadawca  | Tag 802.1Q            | EtherType | Dane             | FCS     |
| 6 Bajtów | 6 Bajtów | 4 Bajty (TPID + TCI)  | 2 Bajty   | 46 - 1500 Bajtów | 4 Bajty |
+----------+----------+-----------------------+-----------+------------------+---------+
                      \\_______________________/
                       * TPID (2B): Wartość 0x8100
                       * PCP (3 bity): Priorytet QoS (0-7)
                       * DEI (1 bit): Flaga dopuszczalności porzucenia
                       * VID (12 bitów): Identyfikator VLAN (zakres 1 - 4094)
```

Z powodu obecności taga 802.1Q maksymalny rozmiar standardowej ramki na portach magistralnych wzrasta z **1518 do 1522 bajtów** (tzw. *Baby Giant Frame*).

### Matematyka sprawdzania integralności: Suma kontrolna CRC-32
Suma kontrolna w polu FCS to cykliczny kod nadmiarowy. Nadawca traktuje cały strumień bitów ramki (od adresu docelowego do końca dopełnienia) jako współczynniki wielomianu $M(x)$ i dzieli go modulo 2 przez znormalizowany wielomian generacyjny stopnia 32:

$$G(x) = x^{32} + x^{26} + x^{23} + x^{22} + x^{16} + x^{12} + x^{11} + x^{10} + x^8 + x^7 + x^5 + x^4 + x^2 + x + 1$$

Reszta z tego dzielenia zostaje wpisana do 4-bajtowego pola FCS. Karta sieciowa odbiorcy wykonuje to samo dzielenie sprzętowo w locie. Jeżeli reszta wynosi zero, ramka jest uznawana za bezbłędną. W przeciwnym razie układ MAC natychmiast ją wyrzuca, zwiększając sprzętowy licznik błędów CRC.

---

# Część 2: Medium współdzielone, mechanika CSMA/CD, fizyka kolizji i diagnostyka

Przewodnik dydaktyczny po drugiej jednostce lekcyjnej. Obejmuje analizę medium współdzielonego, szczegółowe działanie algorytmu CSMA/CD, matematyczne wyprowadzenie minimalnego rozmiaru ramki 64 bajtów, algorytm Backoff, domeny kolizyjne oraz diagnostykę łącza w systemie Linux.

---

## 5. Medium współdzielone i zjawisko kolizji elektrycznej

### Ewolucja fizyczna: od magistrali do koncentratora
* **Wczesny Ethernet (10BASE5 / 10BASE2):** Wszystkie stacje robocze były wpięte do jednego fizycznego kabla koncentrycznego o impedancji falowej $50\\ \\Omega$, zakończonego na obu końcach rezystorami dopasowującymi (terminatorami zapobiegającymi odbiciu fali).
* **Ethernet na skrętce z koncentratorem (10BASE-T + HUB):** Choć kable tworzyły fizyczną topologię gwiazdy, koncentrator (HUB) łączył wszystkie linie wewnętrznie. Koncentrator działa wyłącznie w **1. warstwie (fizycznej)** modelu OSI – powiela odebrany sygnał na wszystkie pozostałe porty.

Z punktu widzenia logiki sieciowej oba rozwiązania stanowią **medium współdzielone (Shared Medium)** pracujące w trybie **Half-Duplex** (półdupleks).

```plaintext
WĘZEŁ A                                                     WĘZEŁ B
   |                                                           |
   +---> Nadaje bity ramki...                                  +---> Nadaje bity ramki...
   \\                                                           /
    \\                                                         /
     ======> [ !!! ZDERZENIE FAL ELEKTRYCZNYCH: KOLIZJA !!! ] <======
```

### Fizyka kolizji sygnałów
Kolizja nie oznacza zderzenia pakietów w sensie mechanicznym, lecz **interferencję fal elektromagnetycznych**:
1. Gdy stacja A i stacja B zaczną emitować sygnał elektryczny w tym samym czasie, prądy w kablu sumują się.
2. Napięcie w linii przekracza dopuszczalny próg logiczny (w kablu koncentrycznym wzrasta ponad określony poziom napięcia stałego DC).
3. Odbiorniki stacji nie są w stanie zdekodować poziomów logicznych (następuje załamanie kodowania Manchester). Dane obu ramek zostają bezpowrotnie zniszczone.

Aby w takim środowisku uniknąć paraliżu transmisyjnego, zaimplementowano algorytm **CSMA/CD** (*Carrier Sense Multiple Access with Collision Detection*).

---

## 6. Algorytm CSMA/CD i maszyna stanów kontrolera MAC

Działanie algorytmu CSMA/CD można podzielić na trzy fazy logiczne: badanie medium przed transmisją, kontrola w trakcie nadawania oraz procedura pokolizyjna.

```plaintext
KROK 1: CARRIER SENSE (Badaj nośną)
   Węzeł ma gotową ramkę w buforze -> sprawdza, czy medium jest wolne.
   Jeśli medium zajęte: czekaj i badaj ponownie.
   Jeśli medium wolne: przejdź do kroku 2.

KROK 2: ODCZEKAJ PRZERWĘ IFG (Interframe Gap = 96 bit-times)

KROK 3: ROZPOCZNIJ NADAWANIE RAMKI
   Nadawaj i jednocześnie monitoruj medium pod kątem kolizji.

   Brak anomalii  -> ramka wysłana poprawnie -> KONIEC.
   Wykryto kolizję -> przejdź do kroku 4.

KROK 4: NADAJ SYGNAŁ JAM (wymuszony sygnał zakłócający, 32-48 bitów)

KROK 5: ZWIĘKSZ LICZNIK PRÓB (n = n + 1)
   Czy n > 16 prób?
     TAK -> BŁĄD KRYTYCZNY: porzuć ramkę (Excessive Collisions).
     NIE -> przejdź do kroku 6.

KROK 6: ALGORYTM BACKOFF
   Wylosuj zwłokę r, odczekaj r * Slot Time, wróć do kroku 1.
```

### Szczegółowa analiza kroków algorytmu:

1. **Carrier Sense (Badanie stanu nośnika):** Karta sieciowa mierzy napięcie na przewodzie. Jeśli płynie prąd o częstotliwości nośnej, oznacza to, że inny komputer nadaje. Karta wstrzymuje nadawanie.
2. **Interframe Gap (Odstęp międzyramkowy – IFG):** Nawet gdy linia jest wolna, stacja nie może rozpocząć nadawania w ułamku nanosekundy. Musi odczekać pauzę wynoszącą ściśle **96 bit-times**:
   * Dla sieci Ethernet 10 Mb/s: $\\text{IFG} = 9{,}6\\ \\mu\\text{s}$.
   * Dla Fast Ethernet 100 Mb/s: $\\text{IFG} = 960\\text{ ns}$.
   * Dla Gigabit Ethernet 1000 Mb/s: $\\text{IFG} = 96\\text{ ns}$.

   *Cel IFG:* Umożliwienie odbiornikom wyczyszczenia rejestrów przesuwnych, zresetowania buforów i powrotu do stanu równowagi elektrycznej.
3. **Collision Detection (Wykrywanie kolizji w locie):** Stacja nadaje i jednocześnie pobiera próbki sygnału z medium. Porównuje to, co nadała, z tym, co odczytuje. Jeśli odczytany sygnał ma wyższą amplitudę niż sygnał emitowany, stacja stwierdza kolizję.
4. **Sygnał zagłuszający (JAM Signal):** Po wykryciu kolizji nadajnik wysyła ciąg **od 32 do 48 bitów** celowego sygnału zakłócającego.

   *Dlaczego sygnał JAM jest niezbędny?* Jeśli kolizja nastąpi w ułamku mikrosekundy, szczątkowy sygnał mógłby zostać stłumiony przez pojemność kabla i stacje na drugim końcu magistrali mogłyby go nie zauważyć. Sygnał JAM celowo podtrzymuje stan awarii elektrycznej, dając pewność, że wszystkie węzły w sieci odrzucą uszkodzone fragmenty ramek.

---

## 7. Fizyka sieci: Matematyczne wyprowadzenie minimalnego rozmiaru ramki 64B

To jedno z najważniejszych zagadnień egzaminacyjnych i inżynieryjnych: dlaczego minimalny rozmiar ramki wynosi dokładnie **64 bajty (512 bitów)**?

### Zagrożenie: Kolizja spóźniona (Late Collision)
Fala elektromagnetyczna porusza się w miedzi z prędkością propagacji $V_p \\approx 200\\ 000\\text{ km/s}$ (ok. $5\\text{ ns}$ na każdy 1 metr przewodu). Oznacza to, że sygnał nie dociera na drugi koniec sieci natychmiast.

Rozważmy najgorszy możliwy przypadek w dopuszczalnym segmencie sieci magistralnej:

```plaintext
STACJA A (Początek kabla)                                   STACJA B (Koniec kabla)
   |                                                                   |
(t = 0) Stacja A rozpoczyna nadawanie ramki...                         |
   |========== Fala sygnału leci przez kabel (Czas Tp) ==============> |
   |                                                                   |
   |                                                  (t = Tp - epsilon)
   |                                                  Czoło fali jeszcze nie dotarło!
   |                                                  Stacja B bada kabel: "Czysto!"
   |                                                  Stacja B zaczyna nadawać!
   |                                                  BUM! KOLIZJA przy stacji B!
   |                                                                   |
   |<========= Fala powypadkowa wraca przez kabel (Czas Tp) ===========+
   |
(t = 2 * Tp = RTT) Fala kolizyjna dociera z powrotem do stacji A!
```

1. W chwili $t = 0$ Stacja A rozpoczyna nadawanie.
2. Sygnał potrzebuje czasu $T_p$ na dotarcie do stacji B.
3. W chwili $t = T_p - \\varepsilon$ (ułamek nanosekundy przed dotarciem fali ze stacji A) stacja B sprawdza stan linii. Ponieważ sygnał jeszcze nie dotarł, stacja B stwierdza, że linia jest wolna i rozpoczyna nadawanie.
4. Następuje kolizja. Sygnał powypadkowy musi teraz pokonać całą drogę powrotną od stacji B do stacji A (kolejny czas $T_p$).
5. Stacja A dowiaduje się o kolizji dopiero po czasie podwójnej propagacji (**Round-Trip Time – RTT**):
   $$\\text{RTT} = 2 \\times T_p$$

### Wyprowadzenie wzoru inżynieryjnego
Aby stacja A mogła wykryć kolizję i podjąć sprzętową retransmisję w warstwie MAC, **musi nadal fizycznie nadawać bity ramki w chwili, gdy zniekształcona fala powróci do jej nadajnika**:

$$\\text{Czas nadawania ramki } (T_{\\text{tx}}) \\ge 2 \\times T_p \\quad (\\text{RTT})$$

Gdyby ramka była zbyt krótka (np. miała 16 bajtów):
1. Stacja A zakończyłaby nadawanie przed upływem czasu RTT, wyczyściła bufor nadawczy i uznała ramkę za poprawnie dostarczoną.
2. Gdyby fala kolizyjna dotarła do stacji A po zakończeniu nadawania, kontroler MAC uznałby ją za błąd linii (szum) i nie ponowiłby transmisji. Doszłoby do zjawiska **Late Collision** (kolizji spóźnionej) i cichej utraty danych, naprawialnej dopiero po sekundach przez protokół TCP.

### Obliczenia tablicowe (wartości dla standardu 10BASE5):
W specyfikacji sieci 10 Mb/s o maksymalnej rozpiętości segmentów z uwzględnieniem regeneratorów (repeaterów) maksymalny czas podwójnego przejścia sygnału oszacowano na około $45\\ \\mu\\text{s}$. Wprowadzono bezpieczny margines projektowy, definiując **czas szczeliny (Slot Time)**:

$$\\text{Slot Time} = 51{,}2\\ \\mu\\text{s}$$

Obliczamy minimalną liczbę bitów, którą stacja o przepustowości 10 Mb/s musi wyemitować w czasie szczeliny:

$$N_{\\text{bitów}} = \\text{Slot Time} \\times \\text{Prędkość} = 51{,}2\\ \\mu\\text{s} \\times 10\\ \\frac{\\text{Mb}}{\\text{s}} = 51{,}2 \\cdot 10^{-6}\\ \\text{s} \\times 10 \\cdot 10^6\\ \\frac{\\text{bitów}}{\\text{s}} = \\mathbf{512\\ \\text{bitów}}$$

Przeliczamy bity na bajty:

$$Rozmiar_{\\text{min}} = \\frac{512\\ \\text{bitów}}{8\\ \\frac{\\text{bitów}}{\\text{bajt}}} = \\mathbf{64\\ \\text{bajty}}$$

Stąd wynika fundament specyfikacji Ethernet: **żadna poprawna ramka nie może mieć mniej niż 64 bajty (wraz z nagłówkiem i sumą kontrolną FCS)**.

---

## 8. Algorytm Backoff, domeny i diagnostyka laboratoryjna

### Algorytm Truncated Binary Exponential Backoff (BEB)
Po wykryciu kolizji stacje nie mogą ponowić nadawania w tym samym momencie. Czas oczekiwania przed kolejną próbą ($T_{\\text{wait}}$) wyliczany jest losowo:

$$T_{\\text{wait}} = r \\times \\text{Slot Time} \\quad (r \\times 51{,}2\\ \\mu\\text{s})$$

Gdzie parametr $r$ jest losowany ze zbioru liczb całkowitych:

$$r \\in \\{ 0, 1, 2, \\dots, 2^k - 1 \\}, \\quad \\text{gdzie } k = \\min(n, 10)$$

Parametr $n$ to numer kolejnej kolizji dla tej samej ramki:
* **Próba 1 ($n=1$):** $k=1 \\rightarrow r \\in \\{0, 1\\}$ (stacja czeka 0 lub $51{,}2\\ \\mu\\text{s}$).
* **Próba 2 ($n=2$):** $k=2 \\rightarrow r \\in \\{0, 1, 2, 3\\}$ (maksymalnie $153{,}6\\ \\mu\\text{s}$).
* **Próba 3 ($n=3$):** $k=3 \\rightarrow r \\in \\{0, \\dots, 7\\}$.
* **Próba 10 ($n=10$):** $k=10 \\rightarrow r \\in \\{0, \\dots, 1023\\}$ (czas zwłoki może wynieść aż $\\approx 52{,}4\\text{ ms}$).
* **Próby 11–16:** Wykładnik zostaje zamrożony na poziomie $k=10$ (obcięcie – *Truncated*).
* **Po 16 próbach:** Kontroler MAC poddaje się, porzuca ramkę i zgłasza do jądra błąd krytyczny `Excessive Collisions`.

### Zestawienie pojęć: Domena kolizyjna a domena rozgłoszeniowa

| Element sieci | Domena kolizyjna | Domena rozgłoszeniowa |
|---|---|---|
| **Definicja** | Obszar sieci, w którym jednoczesna transmisja powoduje zderzenie pakietów. | Obszar sieci, do którego dociera ramka broadcast (`FF:FF:FF:FF:FF:FF`). |
| **Koncentrator (HUB)** | Łączy wszystkie porty w jedną domenę kolizyjną. | Przekazuje broadcast na 100% portów. |
| **Przełącznik (SWITCH)** | Dzieli domeny kolizyjne — każdy port to odrębna domena. | Domyślnie nie dzieli broadcastu (wszystkie porty to jedna domena). |
| **Router** | Dzieli domeny kolizyjne. | Dzieli domeny rozgłoszeniowe (blokuje pakiety broadcast warstwy 2/3). |

### Zmierzch CSMA/CD: Przejście do Full-Duplex
We współczesnych sieciach przełączanych (ze switchami) stacje łączą się dedykowanymi przewodami punkt-punkt.
* W skrętce miedzianej jedna para żył odpowiada za nadawanie (TX), a osobna para za odbiór (RX).
* Stacja może transmitować i odbierać dane jednocześnie z pełną prędkością interfejsu (**Full-Duplex**).
* Kolizje elektryczne są fizycznie niemożliwe.
* **W trybie Full-Duplex algorytm CSMA/CD zostaje całkowicie wyłączony w mikrokodzie karty sieciowej!**

### Diagnostyka łącza w systemie Linux

Administrator sieci weryfikuje poprawność pracy warstwy łącza za pomocą narzędzi `ethtool`, `ip` oraz analizatora pakietów:

```bash
# 1. Sprawdzenie stanu autonegocjacji, wykrytej prędkości i trybu dupleksu
sudo ethtool enp0s3
```

Przykładowy zrzut diagnostyczny:
```text
Settings for enp0s3:
    Supported ports: [ TP ]
    Speed: 1000Mb/s
    Duplex: Full               # Pełny dupleks - CSMA/CD jest nieaktywne!
    Auto-negotiation: on
    Link detected: yes
```

```bash
# 2. Odczyt liczników błędów sprzętowych interfejsu sieciowego
ip -s link show dev enp0s3
```

Kluczowe liczniki diagnostyczne:
* `errors` – ramki z błędną sumą kontrolną CRC-32 (wskazuje na uszkodzenie mechaniczne kabla, złe zaciśnięcie wtyku RJ-45 lub zakłócenia elektromagnetyczne).
* `collsns` – liczba wykrytych kolizji. W sieci z przełącznikiem pracującej w Full-Duplex wartość ta **musi bezwzględnie wynosić 0**. Jeśli licznik rośnie, mamy do czynienia z błędem **Duplex Mismatch** (jedna strona została ustawiona na sztywno w Half-Duplex, a druga w Full-Duplex).
* `dropped` – pakiety odrzucone z powodu braku miejsca w buforze kolejki FIFO karty sieciowej (przeciążenie procesora lub zalew pakietów).

```bash
# 3. Podgląd surowych nagłówków warstwy łącza danych (MAC docelowy, źródłowy, EtherType)
sudo tcpdump -i enp0s3 -e -nn -c 2
```
'
    ]
];
