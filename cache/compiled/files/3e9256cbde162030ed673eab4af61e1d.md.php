<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledMarkdownFile',
    'filename' => '/var/www/html/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/docs.md',
    'modified' => 1791258771,
    'size' => 14794,
    'data' => [
        'header' => [
            'title' => 'Struktura ramki Ethernet i adresacja fizyczna MAC',
            'published' => true
        ],
        'frontmatter' => 'title: \'Struktura ramki Ethernet i adresacja fizyczna MAC\'
published: true',
        'markdown' => '## 1. Wprowadzenie

Ramka Ethernet jest podstawową jednostką transmisji danych w warstwie łącza danych (warstwa 2 modelu OSI). To właśnie w ramkę enkapsulowany jest pakiet pochodzący z warstwy sieciowej (np. datagram IPv4 lub IPv6), zanim trafi on na medium fizyczne w postaci ciągu impulsów elektrycznych, optycznych lub fal radiowych. Ramka pełni funkcję „koperty” — otacza dane użytkownika nagłówkiem i stopką, dzięki którym karta sieciowa odbiorcy potrafi rozpoznać początek transmisji, zidentyfikować nadawcę i odbiorcę, ustalić typ przenoszonych danych oraz zweryfikować, czy dane nie uległy uszkodzeniu w drodze.

Struktura ramki, format adresu fizycznego oraz mechanizm sumy kontrolnej zostały ustandaryzowane przez komitet **IEEE 802.3** i są dziś identyczne (z drobnymi wyjątkami) niezależnie od prędkości łącza — od klasycznego Ethernetu 10 Mb/s po współczesne sieci 100 Gb/s. Niniejszy materiał opisuje budowę ramki krok po kroku: od preambuły synchronizującej transmisję, przez 48-bitowy adres MAC, pole danych i mechanizm wykrywania błędów CRC/FCS, aż po ramki Jumbo stosowane w sieciach o podwyższonej wydajności.

---

## 2. Ogólna budowa ramki — Ethernet II a IEEE 802.3

W praktyce funkcjonują dwa pokrewne formaty ramki:

* **Ethernet II (format DIX)** — starszy, lecz dziś dominujący format, w którym pole za adresami nadawcy i odbiorcy określa **typ** przenoszonego protokołu (EtherType). To właśnie ten format enkapsuluje niemal cały współczesny ruch IP.
* **IEEE 802.3 (format oryginalny)** — pole o tej samej pozycji określa **długość** pola danych, a identyfikacja protokołu odbywa się dopiero w nagłówku podwarstwy LLC (Logical Link Control) doklejonym na początku pola danych.

Odbiornik odróżnia oba formaty na podstawie wartości tego pola: jeśli liczba jest **mniejsza lub równa 1500** (0x05DC), interpretowana jest jako długość danych (format IEEE 802.3); jeśli jest **większa lub równa 1536** (0x0600), interpretowana jest jako identyfikator protokołu (format Ethernet II). Zakres 1501–1535 jest celowo niewykorzystany, aby uniknąć niejednoznaczności.

Poniższy schemat przedstawia budowę dominującej dziś ramki Ethernet II wraz z warstwą fizyczną poprzedzającą właściwą ramkę.

![Struktura ramki Ethernet II — preambuła, SFD, adresy MAC, EtherType, pole danych i FCS](ramka-ethernet-ii-struktura.svg)

Warto zwrócić uwagę na istotny szczegół terminologiczny: preambuła i SFD formalnie **nie wchodzą w skład ramki** w rozumieniu specyfikacji IEEE 802.3 — są elementem warstwy fizycznej, odpowiedzialnym wyłącznie za synchronizację odbiornika. Dlatego minimalny i maksymalny rozmiar ramki (64–1518 bajtów) liczony jest dopiero od pola adresu docelowego do końca pola FCS.

---

## 3. Preambuła i ogranicznik początku ramki (SFD)

### Preambuła (7 bajtów)

Preambuła to ciąg 56 bitów o wzorcu `10101010 10101010 ... 10101010`. Jego zadaniem jest umożliwienie obwodom odbiornika (pętli PLL — Phase-Locked Loop) zsynchronizowanie własnego zegara taktującego z częstotliwością i fazą sygnału nadchodzącego od nadawcy. Naprzemienny wzorzec jedynek i zer generuje najbardziej przewidywalne, regularne przejścia napięcia, dzięki czemu odbiornik może precyzyjnie „wstrzelić się” w rytm nadchodzących bitów, zanim dotrą dane właściwe.

### SFD — Start Frame Delimiter (1 bajt)

Ostatni bajt sekwencji synchronizującej ma wzorzec `10101011` — różni się od preambuły ostatnimi dwoma bitami (`11` zamiast `10`). To odstępstwo od regularnego wzorca jest celowym sygnałem: mówi odbiornikowi „synchronizacja zakończona, kolejny bit rozpoczyna adres MAC odbiorcy”. Od tego momentu obwód odbiorczy przełącza się z trybu synchronizacji w tryb odczytu właściwej ramki.

> **Uwaga praktyczna:** W terminologii niektórych analizatorów protokołów (np. Wireshark) preambuła i SFD zwykle nie są w ogóle widoczne w przechwyconych danych, ponieważ są usuwane sprzętowo przez kontroler MAC karty sieciowej jeszcze przed przekazaniem ramki do systemu operacyjnego.

---

## 4. Adresacja fizyczna — 48-bitowy adres MAC (EUI-48)

Każdy interfejs sieciowy Ethernet identyfikowany jest przez unikalny adres fizyczny o długości **48 bitów (6 bajtów)**, zapisywany standardowo w postaci sześciu par cyfr szesnastkowych oddzielonych dwukropkiem lub myślnikiem, np. `00:1A:2B:3C:4D:5E`. Format ten określa się mianem **EUI-48** (Extended Unique Identifier).

### Podział na producenta i numer seryjny

Adres MAC dzieli się na dwie 24-bitowe (3-bajtowe) części:

* **OUI (Organizationally Unique Identifier)** — pierwsze 3 bajty, przydzielane centralnie producentom sprzętu sieciowego przez organizację IEEE. Pozwala jednoznacznie zidentyfikować wytwórcę karty sieciowej.
* **NIC / identyfikator interfejsu** — kolejne 3 bajty, nadawane przez producenta w procesie produkcyjnym; w teorii unikalne w obrębie danego OUI, co w praktyce zapewnia globalną unikalność całego adresu.

### Bity kontrolne pierwszego bajtu

Dwa najmniej znaczące bity pierwszego bajtu adresu pełnią funkcję flag sterujących, niezależnie od przypisanego OUI:

* **Bit 0 — I/G (Individual/Group):** wartość `0` oznacza adres indywidualny (unicast, wskazujący dokładnie jedną kartę sieciową); wartość `1` oznacza adres grupowy (multicast lub broadcast).
* **Bit 1 — U/L (Universal/Local):** wartość `0` oznacza adres nadany fabrycznie przez producenta (tzw. adres uniwersalny, BIA — Burned-In Address); wartość `1` oznacza adres nadany lub zmieniony lokalnie przez administratora bądź system operacyjny (np. w maszynach wirtualnych, kontenerach lub przy celowej zmianie adresu MAC).

![Struktura 48-bitowego adresu MAC z zaznaczonymi bitami I/G i U/L, podziałem na OUI i identyfikator interfejsu NIC](adres-mac-struktura.svg)

### Typy adresów ze względu na charakter transmisji

| Typ adresu | Bit I/G | Przykład | Zachowanie przełącznika |
|---|---|---|---|
| **Unicast** | 0 | `00:1A:2B:3C:4D:5E` | Ramka przekazywana na jeden, konkretny port |
| **Broadcast** | 1 (wszystkie 48 bitów = 1) | `FF:FF:FF:FF:FF:FF` | Ramka powielana na wszystkie porty w danym VLAN-ie |
| **Multicast** | 1 | `01:00:5E:xx:xx:xx` (mapowanie IPv4), `33:33:xx:xx:xx:xx` (IPv6) | Ramka kierowana do grupy zainteresowanych odbiorców |

---

## 5. Pole EtherType / Length

Dwubajtowe pole następujące bezpośrednio po adresie źródłowym pełni podwójną, zależną od wartości liczbowej rolę opisaną w punkcie 2. Najczęściej spotykane wartości pola EtherType (format Ethernet II) to:

| Wartość (hex) | Protokół |
|---|---|
| `0x0800` | IPv4 |
| `0x0806` | ARP |
| `0x86DD` | IPv6 |
| `0x8100` | Znacznik VLAN (IEEE 802.1Q) |
| `0x8863` / `0x8864` | PPPoE (faza odkrywania / sesji) |

Dzięki temu polu karta sieciowa i sterownik systemowy wiedzą, do którego protokołu warstwy wyższej przekazać zawartość pola danych, bez konieczności jego analizy.

---

## 6. Pole danych (Payload) — MTU, rozmiar minimalny i dopełnienie

### Maksymalna wielkość — MTU

Standardowe pole danych mieści od **46 do 1500 bajtów**. Górna granica nosi nazwę **MTU** (Maximum Transmission Unit) i wynika z historycznych ograniczeń bufora pamięci we wczesnych kontrolerach sieciowych oraz z kompromisu między efektywnością transmisji a czasem oczekiwania innych stacji na dostęp do współdzielonego medium w klasycznych sieciach opartych na CSMA/CD.

### Minimalna wielkość i dopełnienie (padding)

Dolna granica — **46 bajtów** — nie jest przypadkowa. Wynika z wymogu, aby cała ramka (od adresu docelowego do FCS włącznie) miała co najmniej **64 bajty**. Wymóg ten jest bezpośrednią konsekwencją fizyki działania mechanizmu CSMA/CD w sieciach półdupleksowych: stacja nadająca musi jeszcze fizycznie emitować bity ramki w chwili, gdy do jej nadajnika powróci ewentualny sygnał kolizyjny z najdalej położonej stacji w segmencie sieci (czas RTT — Round-Trip Time). Gdyby ramka była krótsza, nadawca mógłby błędnie uznać transmisję za zakończoną powodzeniem, zanim informacja o kolizji zdążyłaby do niego dotrzeć.

Jeżeli dane przekazane z warstwy sieciowej są krótsze niż 46 bajtów (np. proste zapytanie ARP, które ma zaledwie 28 bajtów), kontroler MAC automatycznie uzupełnia pole danych bitami o wartości zero — jest to tzw. **dopełnienie (padding)**. Odbiorca, na podstawie długości zadeklarowanej w nagłówkach warstw wyższych (np. pola Total Length w nagłówku IPv4), potrafi odróżnić rzeczywiste dane od sztucznego wypełnienia i je odrzucić.

---

## 7. Suma kontrolna — pole FCS i algorytm CRC-32

Ostatnie 4 bajty ramki stanowi pole **FCS** (Frame Check Sequence), zawierające wartość obliczoną algorytmem **CRC-32** (Cyclic Redundancy Check) — cyklicznego kodu nadmiarowego, będącego standardowym, sprzętowo zaimplementowanym mechanizmem wykrywania błędów transmisji.

### Zasada działania

Nadawca traktuje cały ciąg bitów ramki objęty sumą kontrolną (od adresu docelowego do końca pola danych, **z pominięciem** preambuły i SFD) jako współczynniki wielomianu $M(x)$ nad ciałem dwuelementowym $GF(2)$, a następnie dzieli go modulo 2 przez ustalony, znormalizowany **wielomian generujący** stopnia 32:

$$G(x) = x^{32} + x^{26} + x^{23} + x^{22} + x^{16} + x^{12} + x^{11} + x^{10} + x^8 + x^7 + x^5 + x^4 + x^2 + x + 1$$

Reszta z tego dzielenia — liczba 32-bitowa — zostaje dopisana jako pole FCS. Odbiorca wykonuje dokładnie to samo dzielenie na odebranym ciągu bitów. Jeżeli obliczona przez niego reszta wynosi zero, ramkę uznaje się za nieuszkodzoną; jeśli reszta jest różna od zera, kontroler MAC natychmiast odrzuca ramkę i zwiększa sprzętowy licznik błędów CRC, nie przekazując jej dalej do warstw wyższych.

### Ograniczenia mechanizmu

Warto podkreślić, że CRC-32 to mechanizm **wykrywania**, a nie **korekcji** błędów — uszkodzona ramka jest po prostu odrzucana, a jej ewentualna retransmisja pozostaje w gestii protokołów warstw wyższych (np. TCP). Algorytm ten jest również probabilistycznie niedoskonały: istnieje (skrajnie mało prawdopodobne, ale niezerowe) ryzyko, że wielobitowe uszkodzenie danych wygeneruje przypadkowo tę samą resztę z dzielenia co ramka oryginalna, co skutkowałoby niewykrytym błędem.

---

## 8. Ramki Jumbo

**Ramki Jumbo** to ramki Ethernet, których pole danych przekracza standardowe MTU wynoszące 1500 bajtów — najczęściej sięgając około **9000 bajtów** (spotykane są też inne, nieznormalizowane warianty, np. 9216 B). W przeciwieństwie do rozmiaru standardowego, rozmiar ramek Jumbo **nie został formalnie ujęty w żadnej normie IEEE 802.3** — jest to rozwiązanie funkcjonujące jako powszechnie przyjęta konwencja branżowa, zaimplementowana i obsługiwana przez producentów kart sieciowych oraz przełączników.

### Cel stosowania

Głównym celem wprowadzenia większych ramek jest **redukcja narzutu protokolarnego** oraz obciążenia procesora w sieciach o wysokiej przepustowości (Gigabit Ethernet i szybszych), typowych dla centrów danych, sieci pamięci masowych (np. iSCSI, NFS) czy klastrów obliczeniowych. Przy stałym narzucie nagłówka (ok. 38 bajtów na ramkę: adresy, EtherType, FCS) większe pole danych oznacza mniej ramek potrzebnych do przesłania tej samej ilości danych, a więc mniej przerwań procesora (interrupts) generowanych przez kartę sieciową i wyższą efektywną przepustowość łącza.

### Ograniczenia i wymagania

Zastosowanie ramek Jumbo wymaga **spójnej konfiguracji na całej trasie transmisji** — każde urządzenie pośredniczące (karta sieciowa nadawcy i odbiorcy oraz wszystkie przełączniki na trasie) musi jawnie obsługiwać zwiększone MTU. Jeśli choć jedno urządzenie na ścieżce nie obsługuje ramek Jumbo, może dojść do ich odrzucenia lub konieczności fragmentacji na poziomie warstwy sieciowej, co w skrajnych przypadkach prowadzi do degradacji wydajności zamiast jej poprawy. Z tego powodu ramki Jumbo stosuje się zwykle wyłącznie w odizolowanych, w pełni kontrolowanych segmentach sieci (np. wewnątrz centrum danych), a nie w publicznym internecie.

![Porównanie rozmiaru ramki standardowej (1518 B) i ramki Jumbo (ok. 9000 B)](ramka-jumbo-porownanie.svg)

---

## 9. Podsumowanie — tabela zbiorcza pól ramki

| Pole | Rozmiar | Funkcja |
|---|---|---|
| Preambuła | 7 B | Synchronizacja zegara odbiornika (element warstwy fizycznej) |
| SFD | 1 B | Sygnalizacja początku właściwej ramki |
| Adres MAC docelowy | 6 B | Identyfikacja fizycznego odbiorcy (unicast / multicast / broadcast) |
| Adres MAC źródłowy | 6 B | Identyfikacja fizycznego nadawcy (zawsze unicast) |
| EtherType / Length | 2 B | Identyfikacja protokołu warstwy wyższej lub długość pola danych |
| Dane (Payload) | 46–1500 B (standard) / do ok. 9000 B (Jumbo) | Przenoszony pakiet warstwy sieciowej wraz z ewentualnym dopełnieniem |
| FCS | 4 B | Suma kontrolna CRC-32 służąca do wykrywania błędów transmisji |

---

## 10. Pytania kontrolne

1. Dlaczego preambuła i SFD formalnie nie są wliczane do minimalnego i maksymalnego rozmiaru ramki Ethernet (64–1518 bajtów)?
2. Jaki wzorzec bitowy odróżnia ostatni bajt sekwencji synchronizującej (SFD) od pozostałych bajtów preambuły i jaką pełni funkcję?
3. Z jakich dwóch 24-bitowych elementów zbudowany jest 48-bitowy adres MAC i za co odpowiada każdy z nich?
4. Co oznacza ustawienie bitu I/G na wartość 1 w pierwszym bajcie adresu MAC i jak w takim przypadku zachowa się przełącznik sieciowy?
5. W jaki sposób odbiornik ramki rozróżnia, czy pole o wartości dwóch bajtów za adresem źródłowym należy interpretować jako EtherType, czy jako długość pola danych (Length)?
6. Dlaczego minimalny rozmiar pola danych wynosi 46 bajtów i jaki związek ma ta wartość z mechanizmem CSMA/CD?
7. Na czym polega dopełnienie (padding) i w jaki sposób odbiorca odróżnia rzeczywiste dane od sztucznie dodanych bajtów wypełniających?
8. Opisz ogólną zasadę działania algorytmu CRC-32 wykorzystywanego do obliczania wartości pola FCS. Które pola ramki są objęte tym obliczeniem?
9. Czy suma kontrolna CRC-32 pozwala na naprawienie uszkodzonej ramki? Uzasadnij odpowiedź i wskaż, co dzieje się z ramką po wykryciu błędu.
10. Jakie korzyści wydajnościowe daje stosowanie ramek Jumbo oraz jakie warunki muszą być spełnione na całej trasie transmisji, aby ich zastosowanie nie spowodowało problemów sieciowych?
'
    ]
];
