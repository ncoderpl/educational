<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledMarkdownFile',
    'filename' => '/var/www/html/user/pages/05.lsk/01.media_transmisyjne_i_standardy_sieci/docs.md',
    'modified' => 1791227872,
    'size' => 116581,
    'data' => [
        'header' => [
            'title' => 'Media transmisyjne i standardy sieci bezprzewodowych',
            'published' => true
        ],
        'frontmatter' => 'title: \'Media transmisyjne i standardy sieci bezprzewodowych\'
published: true',
        'markdown' => '## Wprowadzenie do materiału

Każda sieć komputerowa, niezależnie od tego, jak złożone protokoły działają w wyższych warstwach, ostatecznie opiera się na fizycznym nośniku, który przenosi sygnał z jednego urządzenia do drugiego. Tym nośnikiem może być para miedzianych przewodów, włókno szklane, w którym rozchodzi się światło, albo fala elektromagnetyczna propagująca się w powietrzu. Wybór medium determinuje przepustowość, maksymalny zasięg, odporność na zakłócenia, koszt instalacji, a nawet możliwość zapewnienia bezpieczeństwa transmisji.

Niniejszy materiał przedstawia w sposób uporządkowany i szczegółowy trzy klasy mediów transmisyjnych — **skrętkę miedzianą**, **światłowody** oraz **fale radiowe** — a następnie omawia rodzinę standardów **IEEE 802.11 (Wi-Fi)**, która jest dziś najważniejszym sposobem bezprzewodowego dostępu do sieci lokalnej. Ostatnia część poświęcona jest **technologiom dostępowym** (modemy analogowe, ISDN, DSL, sieci kablowe, dostęp światłowodowy) oraz **sieciom rozległym (WAN)**, czyli infrastrukturze łączącej sieci lokalne z Internetem i między sobą.

Materiał ma charakter akademicki, lecz został napisany tak, aby był zrozumiały dla osoby rozpoczynającej naukę o sieciach. Każde nowe pojęcie jest definiowane przy pierwszym użyciu, a tam, gdzie to możliwe, podano przykłady liczbowe i schematy.

---

## 1. Warstwa fizyczna i pojęcia podstawowe

### 1.1. Rola warstwy fizycznej

Warstwa fizyczna (warstwa 1 modelu ISO/OSI) odpowiada za przekształcenie ciągu bitów w sygnał fizyczny (elektryczny, optyczny lub radiowy), jego przesłanie przez medium oraz odtworzenie bitów po stronie odbiorczej. Definiuje ona:

* **właściwości mechaniczne** — rodzaj złączy, ich rozmieszczenie, budowę kabli;
* **właściwości elektryczne i optyczne** — poziomy napięć, długości fal, moc nadajnika, czułość odbiornika;
* **kodowanie i modulację** — sposób reprezentowania bitów w sygnale;
* **synchronizację** — utrzymanie zgodności zegarów nadajnika i odbiornika;
* **topologię fizyczną** — sposób połączenia urządzeń (gwiazda, magistrala, siatka).

Warstwa fizyczna nie „rozumie" ramek ani adresów — operuje wyłącznie na bitach i sygnałach. Dlatego urządzenia pracujące wyłącznie w warstwie 1 (repeatery, koncentratory, konwertery mediów) jedynie regenerują i powielają sygnał.

### 1.2. Podstawowe pojęcia

**Pasmo (bandwidth)** ma w telekomunikacji dwa różne znaczenia, które należy odróżniać:

* w sensie *analogowym* — szerokość zakresu częstotliwości, jaki kanał jest w stanie przenieść, mierzona w hercach (Hz), np. kanał telefoniczny ma pasmo ok. 3,1 kHz (300–3400 Hz);
* w sensie *potocznym, informatycznym* — maksymalna przepływność łącza, mierzona w bitach na sekundę (b/s), np. „łącze o paśmie 1 Gb/s".

W dalszej części, aby uniknąć niejednoznaczności, będziemy używać terminu **szerokość pasma** dla wielkości w hercach oraz **przepływność** dla wielkości w bitach na sekundę.

**Przepustowość rzeczywista (throughput)** to ilość danych faktycznie przesłanych w jednostce czasu, uwzględniająca narzuty protokołów, retransmisje i konkurencję o medium. **Przepustowość użyteczna (goodput)** to część throughputu stanowiąca dane aplikacji, bez nagłówków i retransmisji. Zawsze zachodzi zależność:

<div data-m="\\text{goodput} \\le \\text{throughput} \\le \\text{przepływność nominalna łącza}"></div>

**Opóźnienie (latency)** to czas przejścia danych od nadawcy do odbiorcy. Składa się z opóźnienia propagacji (zależnego od długości i prędkości sygnału w medium), opóźnienia transmisji (czas „wypchnięcia" wszystkich bitów ramki na łącze), opóźnienia kolejkowania i przetwarzania. **Jitter** to zmienność opóźnienia w czasie, szczególnie istotna dla telefonii IP i wideo.

**Prędkość propagacji sygnału** w miedzi wynosi ok. 0,64–0,7 prędkości światła (dla skrętki kategorii 5e typowo 0,64 c, czyli ok. 5 ns na metr), w szkle światłowodu ok. 0,68 c (ok. 4,9 µs na kilometr), a w próżni i (w przybliżeniu) w powietrzu — 300 000 km/s.

### 1.3. Decybele — język inżynierii sygnałów

Sygnały w mediach transmisyjnych zmieniają swoją moc o wiele rzędów wielkości (od miliwatów na wyjściu nadajnika do pikowatów na wejściu odbiornika), dlatego stosuje się skalę logarytmiczną. **Decybel (dB)** jest miarą *stosunku* dwóch mocy:

<div data-m="G_{\\text{dB}} = 10 \\cdot \\log_{10}\\!\\left(\\frac{P_{\\text{wyj}}}{P_{\\text{wej}}}\\right)"></div>

Wartość dodatnia oznacza wzmocnienie, ujemna — tłumienie. Kilka wartości warto zapamiętać:

| Zmiana mocy | Wartość w dB |
|---|---|
| ×2 (podwojenie) | +3 dB |
| ×10 | +10 dB |
| ×100 | +20 dB |
| ×0,5 (połowa mocy) | −3 dB |
| ×0,1 | −10 dB |
| ×0,001 | −30 dB |

Zaletą skali logarytmicznej jest to, że **tłumienia kolejnych odcinków po prostu się dodają**: jeśli kabel tłumi o 6 dB, złącze o 0,5 dB, a spaw o 0,1 dB, to suma wynosi 6,6 dB.

**dBm** oznacza moc bezwzględną odniesioną do 1 mW: <span data-m="P_{\\text{dBm}} = 10 \\log_{10}(P / 1\\,\\text{mW})"></span>. Zatem 0 dBm = 1 mW, 20 dBm = 100 mW, 30 dBm = 1 W, a −30 dBm = 1 µW. W technice bezprzewodowej powszechnie używa się też **dBi** (zysk anteny względem hipotetycznej anteny izotropowej) oraz **dBW**.

### 1.4. Zjawiska pogarszające jakość sygnału

Sygnał w trakcie propagacji ulega degradacji z kilku powodów:

1. **Tłumienie (attenuation)** — spadek mocy sygnału wraz z odległością. W miedzi rośnie z częstotliwością i długością kabla (straty rezystancyjne, efekt naskórkowy, straty w dielektryku), w światłowodzie wynika z rozpraszania i absorpcji w szkle, w radiu — z rozszerzania się fali w przestrzeni.
2. **Szum (noise)** — losowe sygnały dodające się do użytecznego sygnału: szum termiczny (obecny zawsze, o gęstości ok. −174 dBm/Hz w temperaturze pokojowej), szum śrutowy w detektorach optycznych, zakłócenia impulsowe.
3. **Przesłuchy (crosstalk)** — sprzężenie elektromagnetyczne pomiędzy sąsiednimi torami transmisyjnymi.
4. **Zniekształcenia (distortion)** — zmiana kształtu impulsów spowodowana m.in. dyspersją (różna prędkość propagacji różnych składowych sygnału), odbiciami na niedopasowanych impedancjach czy propagacją wielodrogową.
5. **Interferencja** — zakłócenia od zewnętrznych źródeł (silniki, lampy, inne sieci radiowe).

Miarą jakości sygnału jest **stosunek sygnału do szumu (SNR — Signal-to-Noise Ratio)**:

<div data-m="\\text{SNR}_{\\text{dB}} = 10 \\cdot \\log_{10}\\left(\\frac{P_{\\text{sygnału}}}{P_{\\text{szumu}}}\\right)"></div>

### 1.5. Granice teoretyczne: Nyquist i Shannon

Dwa klasyczne twierdzenia wyznaczają górne granice przepływności.

**Twierdzenie Nyquista** dotyczy kanału bezszumowego o szerokości pasma <span data-m="B"></span>. Maksymalna szybkość symbolowa (liczba zmian stanu sygnału na sekundę, w baudach) wynosi <span data-m="2B"></span>. Jeśli każdy symbol może przyjąć <span data-m="M"></span> różnych stanów, przepływność wynosi:

<div data-m="C_{\\text{Nyquist}} = 2B \\cdot \\log_2 M"></div>

**Twierdzenie Shannona–Hartleya** uwzględnia szum i podaje maksymalną przepływność, przy której można zachować dowolnie małe prawdopodobieństwo błędu:

<div data-m="C_{\\text{Shannon}} = B \\cdot \\log_2\\!\\left(1 + \\text{SNR}\\right)"></div>

gdzie SNR jest podany jako stosunek liniowy (nie w dB).

*Przykład 1.* Kanał telefoniczny ma <span data-m="B = 3100"></span> Hz, a SNR wynosi 35 dB, czyli ok. 3162 razy. Stąd:

<div data-m="C = 3100 \\cdot \\log_2(1 + 3162) \\approx 3100 \\cdot 11{,}63 \\approx 36 \\text{ kb/s}"></div>

Wynik dobrze wyjaśnia, dlaczego modemy analogowe (V.34) zatrzymały się na 33,6 kb/s.

*Przykład 2.* Kanał Wi-Fi o szerokości 20 MHz przy SNR = 25 dB (ok. 316) ma teoretyczną pojemność:

<div data-m="C = 20 \\cdot 10^6 \\cdot \\log_2(1 + 316) \\approx 20 \\cdot 10^6 \\cdot 8{,}31 \\approx 166 \\text{ Mb/s}"></div>

Twierdzenie Shannona jest fundamentem projektowania wszystkich systemów transmisyjnych: aby zwiększyć przepływność, można albo poszerzyć pasmo, albo poprawić SNR (a to oznacza m.in. wyższe modulacje wymagające czystszego sygnału), albo — jak w MIMO — zwielokrotnić liczbę równoległych kanałów.

### 1.6. Kryteria wyboru medium transmisyjnego

| Kryterium | Skrętka miedziana | Światłowód wielomodowy | Światłowód jednomodowy | Fale radiowe |
|---|---|---|---|---|
| Typowy zasięg bez regeneracji | do 100 m (Ethernet) | do ok. 550 m (do 10 Gb/s: 300–400 m) | od 10 km do ponad 80 km | od kilku m do kilkunastu km (zależnie od pasma i mocy) |
| Przepływność | do 10 Gb/s (kat. 6A), do 40 Gb/s (kat. 8, 30 m) | do 100 Gb/s i więcej | praktycznie bez ograniczeń (Tb/s w WDM) | do kilkunastu Gb/s (Wi-Fi 6/7), zależnie od pasma |
| Odporność na zakłócenia EMI | średnia (lepsza z ekranowaniem) | pełna | pełna | niska (współdzielone widmo) |
| Bezpieczeństwo (podsłuch) | średnie (możliwy podsłuch indukcyjny) | wysokie | wysokie | niskie (wymaga szyfrowania) |
| Koszt kabla | niski | średni | średni | brak kabla |
| Koszt zakończeń i instalacji | niski | wysoki | wysoki | niski (ale wymaga planowania radiowego) |
| Mobilność użytkownika | brak | brak | brak | pełna |
| Zasilanie przez medium | tak (PoE) | nie | nie | nie |

---

## 2. Skrętka miedziana

### 2.1. Budowa i zasada działania

**Skrętka** (ang. *twisted pair*) to kabel złożony z par przewodów miedzianych, z których każdy jest osobno izolowany, a przewody w każdej parze są ze sobą **skręcone**. Standardowy kabel sieciowy Ethernet zawiera **cztery pary** (osiem żył), o impedancji falowej **100 Ω** (tolerancja ±15 %), wykonanych zwykle z miedzi o przekroju 24 AWG (ok. 0,51 mm), a w kablach kategorii 6A i wyższych często 23 AWG.

Sens skręcania jest fizyczny. Sygnał w parze przesyła się **różnicowo**: na jednym przewodzie płynie sygnał dodatni, na drugim ujemny (odwrócony w fazie). Odbiornik interpretuje **różnicę** napięć między przewodami, a nie napięcie względem masy. Zewnętrzne zakłócenie elektromagnetyczne indukuje w obu przewodach prawie identyczne napięcie (tzw. zakłócenie współbieżne, common-mode). Ponieważ oba przewody są zakłócone niemal jednakowo, różnica napięć pozostaje praktycznie niezmieniona — zakłócenie zostaje „odjęte". Skręcenie zapewnia, że oba przewody znajdują się średnio w tym samym miejscu względem źródła zakłóceń, co poprawia to podobieństwo.

Skręcenie pełni również drugą funkcję: ogranicza **przesłuchy** pomiędzy parami. Dlatego w jednym kablu poszczególne pary mają **różne skoki skrętu** (liczbę skrętów na jednostkę długości — typowo kilka na centymetr), tak aby sąsiednie pary nie sprzęgały się rezonansowo.

Jakość skręcenia jest krytyczna: rozkręcenie pary na zakończeniu (np. w gnieździe) o więcej niż ok. 13 mm w kategorii 5e (mniej w wyższych) istotnie pogarsza parametry łącza. Dlatego instalatorzy pilnują, aby przy zarabianiu wtyku rozkręcać pary jak najkrócej.

Przewody mogą być **drut** (jeden pełny przewód, sztywny — do instalacji stałej, tzw. okablowanie poziome) lub **linka** (splot wielu cienkich drucików, elastyczny — do przewodów krosowych, tzw. patchcordów). Linka ma większe tłumienie, dlatego długość patchcordów jest limitowana.

### 2.2. Rodzaje ekranowania

Norma ISO/IEC 11801 stosuje oznaczenie w postaci **XX/YTP**, gdzie XX oznacza ekran całego kabla, a Y ekran poszczególnych par:

| Oznaczenie | Ekran zbiorczy | Ekran par | Typowe zastosowanie |
|---|---|---|---|
| **U/UTP** | brak | brak | okablowanie biurowe, domowe (tzw. UTP) |
| **F/UTP** | folia | brak | biura ze średnim poziomem zakłóceń (tzw. FTP) |
| **S/UTP** | oplot | brak | rzadziej stosowany |
| **SF/UTP** | oplot + folia | brak | środowiska o podwyższonych zakłóceniach |
| **U/FTP** | brak | folia na każdej parze | kat. 6A, kat. 7 — redukcja przesłuchów |
| **F/FTP** | folia | folia na każdej parze | kat. 6A i wyższe |
| **S/FTP** | oplot | folia na każdej parze | kat. 7, 7A, 8 (tzw. STP/PiMF) |

Ekranowanie poprawia odporność na zakłócenia zewnętrzne i zmniejsza przesłuchy, ale ma warunek: **ekran musi być prawidłowo uziemiony** (zwykle przez gniazda i panele krosowe z metalową obudową). Nieuziemiony lub uziemiony w wielu punktach o różnych potencjałach ekran może stać się anteną i pogorszyć sytuację, a prądy wyrównawcze płynące po ekranie mogą stanowić zagrożenie dla urządzeń.

### 2.3. Kategorie okablowania

Kategorie (ang. *categories*, skrót Cat) określone w normach TIA/EIA-568 oraz odpowiadające im klasy (Class) w ISO/IEC 11801 definiują maksymalną częstotliwość, w której kabel zachowuje wymagane parametry:

| Kategoria | Klasa ISO | Pasmo (MHz) | Typowe zastosowanie | Uwagi |
|---|---|---|---|---|
| Cat 3 | C | 16 | 10BASE-T, telefonia | przestarzała |
| Cat 5 | — | 100 | 100BASE-TX | zastąpiona przez 5e |
| **Cat 5e** | D | 100 | 1000BASE-T, 2,5GBASE-T | wciąż powszechna w instalacjach domowych |
| **Cat 6** | E | 250 | 1000BASE-T, 10GBASE-T do 55 m | |
| **Cat 6A** | EA | 500 | 10GBASE-T do 100 m | standard dla nowych instalacji biurowych |
| Cat 7 | F | 600 | 10GBASE-T | tylko ekranowana, nietypowe złącze GG45/TERA |
| Cat 7A | FA | 1000 | 10GBASE-T, telewizja kablowa w jednym kablu | |
| **Cat 8 (8.1/8.2)** | I / II | 2000 | 25GBASE-T, 40GBASE-T do 30 m | dla centrów danych |

Warto zapamiętać, że **kategoria dotyczy kabla i całego toru** (kabel, gniazda, krosownice, patchcordy). Zastosowanie kabla Cat 6A z gniazdami Cat 5e daje tor o parametrach Cat 5e — tor jest tak dobry, jak jego najsłabszy element.

### 2.4. Złącze RJ-45 i układ żył

Standardowym złączem dla skrętki jest **RJ-45** (formalnie 8P8C — osiem pozycji, osiem styków). Kolejność żył w złączu określają dwa układy z normy TIA/EIA-568: **T568A** i **T568B**. Różnią się one zamianą miejscami par zielonej i pomarańczowej. W Polsce i na świecie dominuje układ **T568B**, choć oba są równoważne technicznie. Ważne jest wyłącznie, aby **na obu końcach kabla stosować ten sam układ** (kabel prosty) albo odpowiednio różny (kabel skrosowany).

![Układ żył w złączu RJ-45 — T568B i T568A oraz funkcje styków w 10/100BASE-TX i 1000BASE-T](skretka-rj45-t568.svg)

W Ethernecie 10/100 Mb/s wykorzystywane są tylko dwie pary: **styki 1 i 2** (nadawanie, TX) oraz **styki 3 i 6** (odbiór, RX). Para 4–5 i para 7–8 pozostają niewykorzystane (mogą być użyte do zasilania PoE lub telefonii). W Gigabit Ethernet i szybszych wykorzystywane są wszystkie cztery pary, a każda para przenosi dane w obu kierunkach jednocześnie (dzięki układom hybrydowym i kasowaniu echa).

### 2.5. Kabel prosty i skrosowany, Auto-MDI/MDIX

Dawniej rozróżniano dwa typy urządzeń: **MDI** (np. karta sieciowa komputera, która nadaje na stykach 1–2) i **MDI-X** (np. port koncentratora lub przełącznika, który odbiera na stykach 1–2). Połączenie urządzeń różnych typów wymagało **kabla prostego**, a tych samych typów (komputer–komputer, przełącznik–przełącznik) — **kabla skrosowanego** (crossover), w którym pary TX i RX są zamienione (jeden koniec T568A, drugi T568B).

Współczesne porty Gigabit Ethernet obsługują funkcję **Auto-MDI/MDIX**, w której port sam wykrywa i koryguje niewłaściwe skrosowanie. W praktyce kabla skrosowanego już się nie używa, choć warto znać zasadę.

### 2.6. Kodowanie liniowe i standardy Ethernet po skrętce

Bity muszą zostać zamienione na sygnał elektryczny. Prosty zapis „1 = wysokie napięcie, 0 = niskie" ma poważne wady: przy długich seriach jednakowych bitów odbiornik traci synchronizację, a widmo sygnału zawiera składową stałą. Dlatego stosuje się **kodowanie liniowe**:

* **Manchester (10BASE-T)** — każdy bit reprezentowany jest przejściem napięcia w środku okresu bitu (w IEEE 802.3: 0 → przejście z wysokiego na niskie, 1 → z niskiego na wysokie). Zawsze jest przejście, więc odbiornik odzyskuje zegar, ale kosztem podwojenia szybkości symbolowej (10 Mb/s wymaga 20 Mbaud).
* **4B5B + MLT-3 (100BASE-TX)** — cztery bity danych zamieniane są na pięć bitów kodu (nadmiarowość zapewnia częste przejścia), a następnie kodowane trzema poziomami napięcia (−1, 0, +1) w sposób cykliczny. Szybkość symbolowa: 125 Mbaud dla 100 Mb/s. MLT-3 zmniejsza maksymalną częstotliwość sygnału do ok. 31,25 MHz.
* **PAM-5 (1000BASE-T)** — modulacja amplitudy impulsów z pięcioma poziomami napięcia (−2, −1, 0, +1, +2). Każdą z czterech par wykorzystuje się jednocześnie w obu kierunkach z szybkością symbolową 125 Mbaud, przy czym pojedynczy symbol niesie dwa bity danych (piąty poziom służy korekcji błędów kodowaniem kratowym), co daje 4 pary × 125 Mbaud × 2 bity = 1000 Mb/s.
* **PAM-16 (10GBASE-T, 2,5/5GBASE-T)** — szesnaście poziomów napięcia, z wykorzystaniem zaawansowanego kodowania (LDPC) i rozszerzonego pasma. Wymaga kabli o pasmie do 500 MHz (kat. 6A).

| Standard | IEEE | Przepływność | Pary | Kodowanie | Minimalna kategoria | Maks. długość |
|---|---|---|---|---|---|---|
| 10BASE-T | 802.3i (1990) | 10 Mb/s | 2 | Manchester | Cat 3 | 100 m |
| 100BASE-TX | 802.3u (1995) | 100 Mb/s | 2 | 4B5B + MLT-3 | Cat 5 | 100 m |
| 1000BASE-T | 802.3ab (1999) | 1 Gb/s | 4 | PAM-5 | Cat 5e | 100 m |
| 2,5GBASE-T / 5GBASE-T | 802.3bz (2016) | 2,5 / 5 Gb/s | 4 | PAM-16 | Cat 5e / Cat 6 | 100 m |
| 10GBASE-T | 802.3an (2006) | 10 Gb/s | 4 | PAM-16 | Cat 6 (55 m) / Cat 6A (100 m) | 55–100 m |
| 25GBASE-T / 40GBASE-T | 802.3bq (2016) | 25 / 40 Gb/s | 4 | PAM-16 | Cat 8 | 30 m |

### 2.7. Parametry transmisyjne toru miedzianego

Certyfikacja okablowania (pomiary miernikiem, np. testerem klasy Level IV) obejmuje kilka podstawowych parametrów:

* **Tłumienie (Insertion Loss, IL)** — spadek mocy sygnału na całej długości toru w funkcji częstotliwości; rośnie z częstotliwością i długością. Dla kabla Cat 5e przy 100 MHz nie powinno przekraczać ok. 22 dB na 100 m.
* **NEXT (Near-End Crosstalk)** — przesłuch zbliżny, mierzony po tej samej stronie, po której dołączony jest nadajnik zakłócający; jest najgroźniejszy, bo zakłócenie pochodzi od silnego sygnału z bliskiego końca. Im wyższa wartość NEXT (w dB), tym lepiej.
* **FEXT / ACR-F (Far-End Crosstalk)** — przesłuch zdalny, mierzony po przeciwnej stronie łącza; ACR-F to FEXT skorygowany o tłumienie.
* **PSNEXT / PSACR-F** — sumaryczne (Power Sum) przesłuchy pochodzące od wszystkich pozostałych par jednocześnie, istotne przy transmisji na czterech parach (Gigabit).
* **ACR (Attenuation-to-Crosstalk Ratio)** — różnica między tłumieniem a przesłuchem, miara „zapasu" sygnału nad zakłóceniem własnym kabla.
* **Return Loss (RL, tłumienie odbicia)** — miara, jak dobrze impedancja toru jest dopasowana do 100 Ω; odbicia od niedopasowań (np. źle zarobione złącza) interferują z sygnałem podstawowym, szczególnie w transmisji dwukierunkowej.
* **Delay Skew** — różnica czasów propagacji między najszybszą a najwolniejszą parą; istotna w transmisjach wielotorowych (limit ok. 50 ns).
* **Alien Crosstalk (AXT)** — przesłuchy od sąsiednich kabli; istotny w 10GBASE-T, stąd zalecenie stosowania kabli Cat 6A o zwiększonej średnicy lub ekranowanych.

### 2.8. Okablowanie strukturalne

W budynkach kabel skrętkowy instaluje się zgodnie z zasadami **okablowania strukturalnego** (normy ISO/IEC 11801, EN 50173, TIA-568). Charakteryzuje się ono hierarchiczną, gwiaździstą topologią:

* **Okablowanie poziome** (horizontal cabling) — od gniazda abonenckiego (w miejscu pracy) do punktu rozdzielczego piętra. Maksymalna długość **stałego łącza (permanent link) wynosi 90 m**.
* **Patchcordy** — po 5 m po każdej stronie: łącznie **kanał (channel) nie przekracza 100 m** (90 m + 10 m przewodów krosowych, przy czym limity zależą od użycia linki).
* **Okablowanie pionowe (szkieletowe, backbone)** — łączy punkty rozdzielcze pięter i główny punkt rozdzielczy budynku; dziś zwykle światłowodowe.
* **Okablowanie międzybudynkowe (campus)** — łączy budynki; niemal wyłącznie światłowodowe (odporność na przepięcia, wyrównanie potencjałów).

Zasada 100 m wynika z tłumienia, przesłuchów oraz — w dawnych sieciach półdupleksowych — z ograniczeń czasowych mechanizmu CSMA/CD. Dłuższe odcinki wymagają regeneratora, przełącznika pośredniego lub konwertera na światłowód.

### 2.9. Zasilanie przez skrętkę — Power over Ethernet

Technologia **PoE (Power over Ethernet)** pozwala na przesyłanie zasilania równolegle z danymi po tym samym kablu. Źródło (PSE — Power Sourcing Equipment, np. przełącznik) dostarcza napięcie stałe ok. 44–57 V, które odbiera urządzenie zasilane (PD — Powered Device), np. punkt dostępowy Wi-Fi, kamera IP czy telefon VoIP.

| Standard | Nazwa potoczna | Moc na porcie PSE | Moc dostępna dla PD | Liczba par |
|---|---|---|---|---|
| IEEE 802.3af (2003) | PoE (Type 1) | 15,4 W | 12,95 W | 2 |
| IEEE 802.3at (2009) | PoE+ (Type 2) | 30 W | 25,5 W | 2 |
| IEEE 802.3bt (2018) | PoE++ (Type 3) | 60 W | 51 W | 4 |
| IEEE 802.3bt (2018) | PoE++ (Type 4) | 90 W | 71,3 W | 4 |

Przed włączeniem zasilania PSE przeprowadza **detekcję** (sprawdza, czy do portu dołączono urządzenie zgodne z PoE, mierząc rezystancję sygnaturową ok. 25 kΩ) oraz **klasyfikację** mocy. Dzięki temu zwykłe urządzenie bez PoE nie zostanie uszkodzone. Wraz ze wzrostem mocy rośnie nagrzewanie się kabli w wiązkach, dlatego przy PoE++ zaleca się kable Cat 6A o przewodach o większym przekroju.

### 2.10. Kabel koncentryczny — uwagi uzupełniające

Kabel koncentryczny składa się z przewodu wewnętrznego (miedzianego), dielektryka, ekranu (oplotu i/lub folii) oraz osłony zewnętrznej. Ekran otacza żyłę współosiowo, co zapewnia dobrą odporność na zakłócenia i niską tłumienność. W sieciach komputerowych dawał początek Ethernetowi (10BASE5 — gruby koncentryk RG-8, 500 m; 10BASE2 — cienki koncentryk RG-58, 185 m; oba o impedancji 50 Ω), lecz został wyparty przez skrętkę. Kabel koncentryczny o impedancji 75 Ω pozostaje szeroko stosowany w **telewizji kablowej i sieciach HFC** (dostęp DOCSIS, omówiony w rozdziale 6), w instalacjach antenowych oraz w połączeniach o dużych częstotliwościach.

### 2.11. Zalety i ograniczenia skrętki

**Zalety:** niski koszt kabla i osprzętu, łatwość instalacji i zakańczania, możliwość zasilania urządzeń (PoE), dojrzała infrastruktura i szeroka dostępność sprzętu, wsteczna zgodność standardów Ethernet.

**Ograniczenia:** ograniczony zasięg (100 m), wrażliwość na zakłócenia elektromagnetyczne (zwłaszcza kable nieekranowane w pobliżu silników i kabli energetycznych), tłumienie rosnące z częstotliwością, możliwość podsłuchu przez sprzężenie indukcyjne, ograniczona przepływność w porównaniu z włóknem optycznym oraz przewodzenie prądu (ryzyko wyrównawcze i przepięcia — nieodpowiednie między budynkami).

---

## 3. Światłowody

### 3.1. Zasada działania — całkowite wewnętrzne odbicie

**Światłowód** (włókno optyczne) przesyła informację w postaci impulsów światła (najczęściej podczerwonego, o długościach fali 850, 1310 lub 1550 nm), które są prowadzone wewnątrz cienkiego włókna szklanego (rzadziej plastikowego) dzięki zjawisku **całkowitego wewnętrznego odbicia**.

Zjawisko to wynika z prawa Snelliusa. Gdy światło przechodzi z ośrodka o współczynniku załamania <span data-m="n_1"></span> do ośrodka o współczynniku <span data-m="n_2"></span>, kąty (mierzone względem normalnej do powierzchni granicznej) spełniają zależność:

<div data-m="n_1 \\sin\\theta_1 = n_2 \\sin\\theta_2"></div>

Jeśli <span data-m="n_1 &gt; n_2"></span>, to przy dostatecznie dużym kącie padania promień nie przechodzi do drugiego ośrodka, lecz odbija się w całości. Kąt graniczny (krytyczny) wynosi:

<div data-m="\\theta_c = \\arcsin\\!\\left(\\frac{n_2}{n_1}\\right)"></div>

Włókno zbudowane jest więc z **rdzenia** o wyższym współczynniku załamania i otaczającego go **płaszcza** o niższym współczynniku. Światło wprowadzone do rdzenia pod odpowiednio małym kątem względem osi odbija się od granicy rdzeń–płaszcz i wędruje wzdłuż włókna, prawie bez strat na odbiciach.

*Przykład liczbowy.* Dla rdzenia o <span data-m="n_1 = 1{,}48"></span> i płaszcza o <span data-m="n_2 = 1{,}46"></span>:

* kąt graniczny: <span data-m="\\theta_c = \\arcsin(1{,}46 / 1{,}48) \\approx 80{,}6^\\circ"></span> (względem normalnej), czyli promienie biegnące pod kątem mniejszym niż ok. 9,4° względem osi włókna są prowadzone;
* **apertura numeryczna**: <span data-m="NA = \\sqrt{n_1^2 - n_2^2} = \\sqrt{2{,}1904 - 2{,}1316} \\approx 0{,}24"></span>;
* **kąt akceptacji** (maksymalny kąt wprowadzenia światła z powietrza): <span data-m="\\theta_{max} = \\arcsin(NA) \\approx 14^\\circ"></span>.

Różnica współczynników załamania jest bardzo mała (rzędu 1 %), co jest typowe dla włókien telekomunikacyjnych.

### 3.2. Budowa włókna i kabla

![Budowa włókna światłowodowego oraz propagacja światła we włóknie wielomodowym skokowym, gradientowym i jednomodowym](swiatlowod-budowa-i-propagacja.svg)

Włókno składa się z trzech warstw:

1. **Rdzeń (core)** — obszar, w którym rozchodzi się światło; ze szkła kwarcowego (SiO₂) domieszkowanego np. germanem, aby podnieść współczynnik załamania. Średnica: ok. **9 µm** (jednomodowe) lub **50 / 62,5 µm** (wielomodowe).
2. **Płaszcz (cladding)** — szkło o niższym współczynniku załamania; średnica standardowo **125 µm**.
3. **Powłoka pierwotna (coating)** — lakier akrylowy o średnicy ok. 250 µm chroniący przed uszkodzeniami mechanicznymi i wilgocią.

Kabel światłowodowy dodatkowo zawiera **elementy wzmacniające** (nici aramidowe, pręty z włókna szklanego, rzadziej stalowe), **tuby lub bufor ścisły** oraz **osłonę zewnętrzną** (PVC, LSZH — bezhalogenowa niskodymna, PE do instalacji zewnętrznych, często z żelem lub taśmą blokującą wodę). Ponieważ światłowód nie przewodzi prądu, nie wymaga uziemienia i może być prowadzony w pobliżu linii wysokiego napięcia, jednak przewodzące elementy wzmacniające (np. stalowe) wymagają uwagi.

### 3.3. Tryby propagacji

Rozchodzenie się światła we włóknie można opisać jako superpozycję **modów** — dozwolonych rozkładów pola elektromagnetycznego. Liczba modów zależy od średnicy rdzenia, apertury numerycznej i długości fali. Parametrem opisującym to jest tzw. częstotliwość znormalizowana:

<div data-m="V = \\frac{2\\pi a}{\\lambda}\\, NA"></div>

gdzie <span data-m="a"></span> jest promieniem rdzenia. Włókno prowadzi tylko jeden mod (jest jednomodowe), gdy <span data-m="V &lt; 2{,}405"></span>.

**Włókno wielomodowe skokowe (MMF step-index).** Rdzeń o jednolitym współczynniku załamania. Promienie biegnące pod różnymi kątami pokonują różne drogi geometryczne, przez co impuls świetlny „rozmywa się" w czasie (dyspersja modowa). Obecnie prawie nie stosowane w telekomunikacji.

**Włókno wielomodowe gradientowe (MMF graded-index).** Współczynnik załamania maleje płynnie od osi rdzenia do jego brzegu. Promienie odbiegające od osi wędrują dłuższą drogę, lecz przez obszary o niższym współczynniku załamania (a więc z większą prędkością), co w dużej mierze **wyrównuje czasy propagacji**. Tego typu jest współczesne włókno wielomodowe (OM1–OM5).

**Włókno jednomodowe (SMF).** Rdzeń o średnicy ok. 9 µm prowadzi tylko jeden mod (dla długości fali powyżej tzw. długości fali odcięcia, ≤ 1260 nm w zaleceniu ITU-T G.652). Brak dyspersji modowej daje największe zasięgi i przepływności.

### 3.4. Okna transmisyjne i tłumienie

Tłumienie światłowodu zależy od długości fali. Głównymi mechanizmami strat są: **rozpraszanie Rayleigha** (maleje z czwartą potęgą długości fali, dlatego dłuższe fale są tłumione słabiej), **absorpcja** przez jony hydroksylowe OH⁻ (charakterystyczny pik „wodny" w okolicy 1383 nm) oraz absorpcja w podczerwieni powyżej ok. 1600 nm. Powstają **okna transmisyjne**, w których tłumienie jest minimalne:

| Okno | Długość fali | Typowe tłumienie | Zastosowanie |
|---|---|---|---|
| I | 850 nm | ok. 2,5–3 dB/km (MMF) | krótkie łącza wielomodowe, tanie źródła (VCSEL) |
| II (pasmo O) | 1310 nm | ok. 0,35 dB/km (SMF), ok. 1 dB/km (MMF) | łącza jednomodowe średniego zasięgu, punkt zerowej dyspersji |
| III (pasmo C) | 1550 nm | ok. 0,2 dB/km (SMF) | łącza dalekiego zasięgu, WDM/DWDM, wzmacniacze EDFA |

Pasma telekomunikacyjne oznacza się literami: **O** (1260–1360 nm), **E** (1360–1460), **S** (1460–1530), **C** (1530–1565), **L** (1565–1625) i **U** (1625–1675 nm).

### 3.5. Dyspersja

**Dyspersja** to zjawisko poszerzania impulsów świetlnych w trakcie propagacji, które ogranicza maksymalną przepływność i zasięg. Wyróżnia się:

* **dyspersję modową** — różne mody docierają do końca włókna w różnym czasie (tylko MMF); miarą jest tzw. iloczyn pasma i długości (MHz·km);
* **dyspersję chromatyczną** — różne długości fali biegną z różną prędkością (materiałowa + falowodowa); w SMF wyrażana w ps/(nm·km), wynosi w przybliżeniu 0 przy 1310 nm i ok. 17 ps/(nm·km) przy 1550 nm; kompensuje się ją specjalnymi włóknami lub przetwarzaniem sygnału po stronie odbiorczej;
* **dyspersję polaryzacyjną (PMD)** — różne polaryzacje światła rozchodzą się z nieco różnymi prędkościami; istotna przy przepływnościach ≥ 10 Gb/s na długich łączach.

### 3.6. Klasy włókien

| Klasa | Typ | Rdzeń / płaszcz | Iloczyn pasma i długości przy 850 nm | Kolor typowej osłony | Typowe zastosowanie |
|---|---|---|---|---|---|
| OM1 | wielomodowe | 62,5/125 µm | 200 MHz·km | pomarańczowy | starsze instalacje |
| OM2 | wielomodowe | 50/125 µm | 500 MHz·km | pomarańczowy | 1 Gb/s, starsze 10 Gb/s do 82 m |
| OM3 | wielomodowe, zoptymalizowane pod laser | 50/125 µm | 2000 MHz·km (EMB) | niebieskozielony (aqua) | 10 Gb/s do 300 m, 40/100 Gb/s do 100 m |
| OM4 | wielomodowe, zoptymalizowane pod laser | 50/125 µm | 4700 MHz·km (EMB) | aqua (lub „erika violet") | 10 Gb/s do 400 m, 40/100 Gb/s do 150 m |
| OM5 | wielomodowe, szerokopasmowe (WBMMF) | 50/125 µm | 4700 MHz·km + pasmo do 953 nm | limonkowy | SWDM, zwiększona przepływność na jedną parę włókien |
| OS1 / OS2 | jednomodowe (G.652.D) | 9/125 µm | — | żółty | od kilkuset metrów do setek kilometrów |

W nazwach OM (Optical Multimode) i OS (Optical Single-mode) definiowanych w ISO/IEC 11801.

### 3.7. Źródła i detektory światła

**Nadajniki optyczne:**

* **LED** — prosty, tani, o szerokim widmie i niskiej mocy; do łączy wielomodowych o niskiej przepływności (np. dawny 100BASE-FX).
* **VCSEL** (laser z pionową wnęką rezonansową) — tani laser o emisji z powierzchni, 850 nm, stosowany w wielomodowych łączach 1–100 Gb/s.
* **Laser Fabry–Perota** i **DFB** (z rozłożonym sprzężeniem zwrotnym) — lasery o wąskim widmie, 1310/1550 nm; podstawa łączy jednomodowych dalekiego zasięgu i WDM.

**Odbiorniki (detektory):**

* **Fotodioda PIN** — prosta, tania, stosowana w większości łączy;
* **Fotodioda lawinowa (APD)** — wewnętrzne wzmocnienie prądu dzięki powielaniu lawinowemu; zwiększa czułość o kilka dB, kosztem szumu i wyższego napięcia zasilającego; stosowana w łączach dalekiego zasięgu i w PON.

### 3.8. Standardy Ethernet po światłowodzie

| Standard | Długość fali | Włókno | Typowy zasięg |
|---|---|---|---|
| 100BASE-FX | 1300 nm | MMF | 2 km |
| 1000BASE-SX | 850 nm | MMF | do 550 m |
| 1000BASE-LX | 1310 nm | SMF (także MMF) | 5 km (SMF) |
| 10GBASE-SR | 850 nm | MMF OM3/OM4 | 300 m / 400 m |
| 10GBASE-LR | 1310 nm | SMF | 10 km |
| 10GBASE-ER | 1550 nm | SMF | 40 km |
| 40GBASE-SR4 | 850 nm, 4 tory równoległe (8 włókien) | MMF OM3/OM4 | 100 m / 150 m |
| 100GBASE-SR4 | 850 nm, 4 tory równoległe | MMF OM4 | 100 m |
| 100GBASE-LR4 | ok. 1310 nm, 4 długości fali (WDM) | SMF | 10 km |

Oznaczenia literowe: **S** (short — 850 nm), **L** (long — 1310 nm), **E** (extended — 1550 nm), **R** — kodowanie 64B/66B, cyfra na końcu (np. 4) — liczba torów lub długości fali.

### 3.9. Złącza, polerowanie i łączenie włókien

**Złącza** światłowodowe różnią się kształtem i sposobem mocowania:

* **SC** — kwadratowe, zatrzaskowe (push-pull), popularne w sieciach telekomunikacyjnych;
* **LC** — zminiaturyzowane (ferrula 1,25 mm), stosowane w modułach SFP; najpopularniejsze w sieciach LAN i centrach danych;
* **ST** — okrągłe, bagnetowe, starsze instalacje wielomodowe;
* **FC** — gwintowane, do pomiarów i zastosowań specjalnych;
* **MPO/MTP** — wielowłóknowe (12, 16, 24 włókna), dla łączy 40/100 Gb/s i kabli trunkowych.

**Polerowanie końcówki** (ferruli) wpływa na **tłumienie odbicia**. Złącza **UPC** (Ultra Physical Contact, zwykle niebieskie) mają powierzchnię wypolerowaną płasko wypukło, natomiast **APC** (Angled Physical Contact, zielone) — pod kątem 8°, co kieruje odbite światło poza rdzeń i zapewnia lepszą tłumienność odbicia (rzędu 60 dB i więcej). APC jest wymagane w sieciach PON i przy przesyłaniu sygnałów wideo analogowych; nie wolno łączyć złączy UPC z APC (uszkodzenie i duże straty).

**Łączenie włókien:**

* **spawanie fuzyjne** — włókna są stapiane łukiem elektrycznym; tłumienność spawu wynosi zwykle 0,02–0,1 dB, jest to metoda trwała i najlepsza jakościowo;
* **łączenie mechaniczne** — włókna są zestawiane w prowadnicy z żelem dopasowującym; niższy koszt sprzętu, straty rzędu 0,2–0,5 dB.

Największym wrogiem światłowodowego złącza jest **zabrudzenie**: pył lub ślad palca na powierzchni ferruli mogą powodować tłumienie i uszkodzenie. Standardem pracy jest inspekcja mikroskopowa i czyszczenie przed każdym połączeniem.

### 3.10. Bilans mocy łącza (link budget)

Poprawność projektu łącza sprawdza się, porównując **budżet mocy** transceiverów z **sumą strat** w torze.

<div data-m="\\text{Budżet} = P_{Tx} - S_{Rx} \\qquad\\qquad \\text{Straty} = \\alpha \\cdot L + N_{\\text{spawów}} \\cdot A_s + N_{\\text{złączy}} \\cdot A_z + M"></div>

gdzie <span data-m="P_{Tx}"></span> to moc nadajnika (dBm), <span data-m="S_{Rx}"></span> — czułość odbiornika (dBm), <span data-m="\\alpha"></span> — tłumienność jednostkowa włókna (dB/km), <span data-m="L"></span> — długość, <span data-m="A_s"></span> i <span data-m="A_z"></span> — tłumienność spawu i pary złączy, a <span data-m="M"></span> — zapas (margines) na starzenie i naprawy (zwykle 2–3 dB).

*Przykład.* Transceiver o mocy nadawczej −5 dBm i czułości odbiornika −15 dBm ma budżet 10 dB. Łącze jednomodowe ma długość 8 km przy 1310 nm (<span data-m="\\alpha = 0{,}35"></span> dB/km), zawiera dwa spawy po 0,1 dB i cztery pary złączy po 0,5 dB, przyjęto zapas 3 dB:

<div data-m="\\text{Straty} = 8 \\cdot 0{,}35 + 2 \\cdot 0{,}1 + 4 \\cdot 0{,}5 + 3 = 2{,}8 + 0{,}2 + 2{,}0 + 3 = 8{,}0 \\text{ dB}"></div>

Straty (8 dB) są mniejsze niż budżet (10 dB), więc łącze pracuje z rezerwą 2 dB. Należy pamiętać, że zbyt duża moc na odbiorniku (np. przy bardzo krótkim łączu i mocnym laserze) również jest problemem: wymaga zastosowania **tłumika optycznego**.

### 3.11. Zwielokrotnienie falowe (WDM)

**WDM (Wavelength Division Multiplexing)** pozwala przesyłać jednocześnie wiele niezależnych sygnałów optycznych w jednym włóknie, używając różnych długości fali. Odpowiednik „wielu kolorów" w jednej nici.

* **CWDM** (Coarse WDM) — odstęp kanałów 20 nm, do 18 kanałów w zakresie ok. 1270–1610 nm (ITU-T G.694.2); tanie lasery niechłodzone, zasięgi do ok. 80 km, zastosowanie w sieciach metropolitalnych i operatorskich.
* **DWDM** (Dense WDM) — odstępy 100, 50 lub 25 GHz (ok. 0,8 / 0,4 / 0,2 nm; ITU-T G.694.1), zwykle w paśmie C i L; kilkadziesiąt do ponad stu kanałów, każdy o przepływności 10–800 Gb/s; w połączeniu ze wzmacniaczami erbowymi (**EDFA**) pozwala na łącza dalekosiężne (tysiące kilometrów) o łącznej przepływności rzędu dziesiątek terabitów na sekundę na jednym włóknie.

WDM jest podstawą sieci szkieletowych operatorów i międzykontynentalnych kabli podmorskich.

### 3.12. Transceivery modułowe

Interfejsy optyczne w przełącznikach i routerach realizowane są jako wymienne moduły (transceivery), co pozwala dobrać typ medium do potrzeb bez wymiany urządzenia:

* **SFP** (1 Gb/s), **SFP+** (10 Gb/s), **SFP28** (25 Gb/s) — moduły z gniazdem LC (duplex);
* **QSFP+** (40 Gb/s), **QSFP28** (100 Gb/s), **QSFP-DD** (400 Gb/s) i nowsze — moduły wielotorowe;
* kable **DAC** (Direct Attach Copper) i **AOC** (Active Optical Cable) — kable z wtopionymi końcówkami, do krótkich połączeń w szafach.

W modułach optycznych umieszczany jest zwykle mikrokontroler z interfejsem diagnostycznym **DOM/DDM** (Digital Optical Monitoring), umożliwiającym odczyt mocy nadawczej, odbiorczej, temperatury i napięcia — bardzo przydatny przy diagnostyce.

### 3.13. Światłowód w sieciach dostępowych

W sieciach dostępowych światłowód dociera coraz bliżej użytkownika. Rozróżnia się architektury **FTTx**: FTTH (Fiber to the Home — do mieszkania/domu), FTTB (Fiber to the Building — do budynku), FTTC/FTTN (do szafy ulicznej, dalej miedź). Popularną techniką jest pasywna sieć optyczna **PON**, omówiona szczegółowo w rozdziale 6.

### 3.14. Zalety i ograniczenia światłowodów

**Zalety:** ogromna szerokość pasma, minimalne tłumienie (zasięgi do kilkudziesięciu kilometrów bez regeneracji), pełna odporność na zakłócenia elektromagnetyczne i przesłuchy, brak promieniowania (utrudniony podsłuch), galwaniczna separacja urządzeń, mała masa i średnica, brak przewodzenia iskry (bezpieczne w środowisku zagrożonym wybuchem).

**Ograniczenia:** wyższy koszt urządzeń i osprzętu, wymagane specjalistyczne narzędzia i przeszkolenie do spawania i pomiarów (reflektometr OTDR, miernik mocy), wrażliwość na zbyt ciasne zagięcia (minimalny promień gięcia to zwykle 10–15 średnic kabla), brak możliwości zasilania urządzeń przez sam kabel oraz konieczność dbania o czystość złączy.

---

## 4. Fale radiowe jako medium transmisyjne

### 4.1. Widmo fal radiowych

**Fala elektromagnetyczna** to zaburzenie pola elektrycznego i magnetycznego rozchodzące się w przestrzeni z prędkością światła <span data-m="c \\approx 3\\cdot 10^8"></span> m/s. Częstotliwość <span data-m="f"></span> i długość fali <span data-m="\\lambda"></span> są związane zależnością:

<div data-m="c = f \\cdot \\lambda \\quad\\Rightarrow\\quad \\lambda = \\frac{c}{f}"></div>

Dla Wi-Fi 2,4 GHz długość fali wynosi ok. 12,5 cm, dla 5 GHz — ok. 6 cm, a dla 60 GHz — ok. 5 mm. Długość fali determinuje rozmiary anten (typowo ułamek długości fali, np. ćwierćfalówka), sposób przenikania przez przeszkody i zjawiska dyfrakcyjne.

![Pasma fal radiowych według ITU w skali logarytmicznej wraz z zastosowaniami: radio AM/FM, telefonia komórkowa, Wi-Fi, łączność satelitarna](widmo-fal-radiowych.svg)

Międzynarodowy Związek Telekomunikacyjny (**ITU**) dzieli widmo radiowe na pasma dekadowe, od VLF (3–30 kHz) do EHF (30–300 GHz). Sieci bezprzewodowe LAN pracują głównie w paśmie **UHF/SHF** (od ok. 2,4 do 7 GHz), gdzie zapewniona jest dostatecznie duża szerokość pasma, a anteny są niewielkie i wygodne w urządzeniach mobilnych.

### 4.2. Regulacje i pasma bezlicencyjne (ISM/UNII)

Widmo radiowe jest zasobem ograniczonym i **regulowanym**. Na świecie o podziale częstotliwości decyduje ITU, w Europie normy techniczne opracowuje **ETSI**, a decyzje regulacyjne wprowadza Komisja Europejska; w Polsce nadzór sprawuje **Urząd Komunikacji Elektronicznej (UKE)**. Większość zastosowań wymaga **pozwolenia radiowego** (licencji), ale wybrane pasma, tzw. **ISM** (Industrial, Scientific, Medical), udostępniono do użytku **bezlicencyjnego** pod warunkiem przestrzegania ograniczeń mocy i zasad współdzielenia.

| Pasmo | Zakres | Typowe zastosowania | Uwagi |
|---|---|---|---|
| 433 MHz | 433,05–434,79 MHz | piloty, czujniki, systemy alarmowe | duży zasięg, mała przepływność |
| 868 MHz | 863–870 MHz (UE) | IoT (LoRa, Sigfox, Wi-Fi HaLow), liczniki | ograniczony cykl pracy (duty cycle) |
| **2,4 GHz** | 2400–2483,5 MHz | Wi-Fi, Bluetooth, Zigbee, kuchenki mikrofalowe | bardzo zatłoczone |
| **5 GHz** | ok. 5150–5875 MHz (podpasma) | Wi-Fi | DFS i TPC w części pasma, kanały do 160 MHz |
| **6 GHz** | 5945–6425 MHz w UE (5925–7125 MHz w USA) | Wi-Fi 6E/7 | brak dostępu starszych urządzeń, kanały do 320 MHz |
| 60 GHz | 57–71 GHz | WiGig (802.11ad/ay), łącza punkt–punkt | bardzo silne tłumienie, zasięg kilku–kilkunastu metrów |

Zasady dotyczące mocy, dostępnych kanałów i wymogów (np. DFS — dynamic frequency selection, czyli wykrywanie radarów i ustępowanie im) różnią się między krajami i są aktualizowane. W UE moc wyjściowa urządzeń Wi-Fi jest ograniczona (przykładowo do 100 mW EIRP w paśmie 2,4 GHz), a w 6 GHz wprowadzono kategorie urządzeń o niskiej mocy do zastosowań wewnątrz budynków. **Zawsze należy sprawdzać aktualne przepisy krajowe.**

### 4.3. Propagacja fal radiowych

W przeciwieństwie do kabla, w którym sygnał jest prowadzony, fala radiowa rozchodzi się w przestrzeni we wszystkich kierunkach i podlega szeregowi zjawisk.

**Tłumienie w przestrzeni swobodnej (FSPL — Free-Space Path Loss).** Nawet bez przeszkód moc fali maleje, ponieważ rozkłada się na coraz większą powierzchnię (odwrotnie proporcjonalnie do kwadratu odległości), a ponadto skuteczna apertura anteny odbiorczej maleje z częstotliwością. Tłumienie wynosi:

<div data-m="\\text{FSPL}_{\\text{dB}} = 20\\log_{10}(d_{\\text{m}}) + 20\\log_{10}(f_{\\text{MHz}}) - 27{,}55"></div>

gdzie <span data-m="d"></span> jest odległością w metrach, a <span data-m="f"></span> częstotliwością w megahercach.

*Przykład.* Dla <span data-m="d = 100"></span> m: przy <span data-m="f = 2450"></span> MHz FSPL <span data-m="= 40 + 67{,}8 - 27{,}55 \\approx 80{,}2"></span> dB, a przy <span data-m="f = 5500"></span> MHz FSPL <span data-m="= 40 + 74{,}8 - 27{,}55 \\approx 87{,}3"></span> dB. Różnica wynosi ok. **7 dB** — to jeden z powodów, dla których sygnał 5 GHz jest „słabszy" od 2,4 GHz nawet bez przeszkód. Każde podwojenie odległości zwiększa tłumienie o 6 dB, a każde podwojenie częstotliwości również o 6 dB.

**Zjawiska propagacyjne w rzeczywistym otoczeniu:**

* **odbicie** — fala odbija się od dużych, gładkich powierzchni (metal, szkło, woda, ściany);
* **załamanie (refrakcja)** — zmiana kierunku fali przy przejściu między ośrodkami;
* **dyfrakcja** — uginanie fali na krawędziach przeszkód, dzięki czemu sygnał dociera także za przeszkodą (tym silniej, im większa długość fali);
* **rozpraszanie** — fala odbija się w wielu kierunkach od małych obiektów (liście, chropowate powierzchnie);
* **absorpcja** — zamiana energii fali na ciepło w przeszkodzie; przykładowo żelbet i woda tłumią silnie, płyta gipsowo-kartonowa niewiele, a 5 GHz i 6 GHz są tłumione silniej niż 2,4 GHz;
* **propagacja wielodrogowa (multipath)** — do odbiornika docierają kopie tego samego sygnału o różnych opóźnieniach i fazach; mogą się wzmacniać lub wygaszać (**zaniki, fading**) i powodować **interferencję międzysymbolową**.

Wielodrogowość jest wrogiem w klasycznej transmisji, ale w nowoczesnych systemach (OFDM, MIMO) jest wykorzystywana jako zasób — patrz podrozdziały 4.5–4.6.

### 4.4. Anteny i budżet łącza radiowego

**Antena** zamienia sygnał elektryczny na falę elektromagnetyczną i odwrotnie. Jej najważniejszym parametrem jest **zysk (gain)** wyrażany w **dBi**: o ile mocniej antena promieniuje w danym kierunku w porównaniu z idealną anteną izotropową (promieniującą równomiernie we wszystkich kierunkach). Zysk nie oznacza wytworzenia dodatkowej energii — antena o dużym zysku skupia moc w węższej wiązce.

* **Anteny dookólne** (omnidirectional) — promieniowanie w płaszczyźnie poziomej we wszystkich kierunkach; typowy zysk 2–9 dBi; w routerach domowych i punktach dostępowych.
* **Anteny kierunkowe** (Yagi, panelowe, paraboliczne) — skupiają wiązkę; zysk 10–30 dBi; do łączy punkt–punkt i pokrycia sektorowego.

Moc efektywnie wypromieniowana w kierunku maksymalnego zysku to **EIRP** (Equivalent Isotropically Radiated Power):

<div data-m="\\text{EIRP}_{\\text{dBm}} = P_{Tx,\\text{dBm}} - L_{\\text{kabli}} + G_{Tx,\\text{dBi}}"></div>

To właśnie EIRP jest wielkością limitowaną przepisami. **Bilans łącza** pozwala oszacować moc odbieraną:

<div data-m="P_{Rx,\\text{dBm}} = \\text{EIRP} - \\text{FSPL} - L_{\\text{przeszkód}} + G_{Rx,\\text{dBi}}"></div>

*Przykład.* Nadajnik 17 dBm z anteną 3 dBi (bez strat w kablu): EIRP = 20 dBm. Odległość 50 m przy 5500 MHz: FSPL <span data-m="= 33{,}98 + 74{,}81 - 27{,}55 \\approx 81{,}2"></span> dB. Odbiornik z anteną 0 dBi otrzymuje <span data-m="P_{Rx} = 20 - 81{,}2 + 0 \\approx -61{,}2"></span> dBm. Podłoże szumowe dla kanału 20 MHz wynosi ok. −174 + 73 = −101 dBm, po uwzględnieniu współczynnika szumów odbiornika (ok. 6 dB) ok. −95 dBm. Stąd SNR ≈ 34 dB — wartość pozwalająca na wysokie modulacje. Dodanie dwóch ścian (po ok. 5 dB każda) zmniejszyłoby SNR do ok. 24 dB.

### 4.5. Modulacje cyfrowe

Aby przesłać bity falą radiową, modyfikuje się parametry **fali nośnej** w rytm danych:

* **ASK** (Amplitude-Shift Keying) — zmiana amplitudy;
* **FSK** (Frequency-Shift Keying) — zmiana częstotliwości (stosowana m.in. w Bluetooth klasycznym i prostych systemach IoT);
* **PSK** (Phase-Shift Keying) — zmiana fazy: **BPSK** (2 fazy, 1 bit na symbol), **QPSK** (4 fazy, 2 bity);
* **QAM** (Quadrature Amplitude Modulation) — łączna zmiana amplitudy i fazy dwóch nośnych przesuniętych o 90° (składowe I i Q); kolejne stopnie: 16-QAM (4 bity/symbol), 64-QAM (6), **256-QAM (8)**, **1024-QAM (10)**, **4096-QAM (12)**.

Każdemu punktowi na **diagramie konstelacji** odpowiada jeden symbol. Im więcej punktów, tym więcej bitów na symbol — ale tym mniejsze są odległości między punktami, więc mniejszy szum wystarcza do pomylenia symbolu. Dlatego wyższe modulacje wymagają wyższego SNR:

| Modulacja | Bitów na symbol | Orientacyjny wymagany SNR | Uwagi |
|---|---|---|---|
| BPSK | 1 | ok. 5 dB | najlepsza odporność, największy zasięg |
| QPSK | 2 | ok. 8–10 dB | |
| 16-QAM | 4 | ok. 15–18 dB | |
| 64-QAM | 6 | ok. 22–25 dB | |
| 256-QAM | 8 | ok. 28–32 dB | Wi-Fi 5 |
| 1024-QAM | 10 | ok. 35 dB | Wi-Fi 6 |
| 4096-QAM | 12 | ok. 40 dB i więcej | Wi-Fi 7 |

Przepływność zależy nie tylko od modulacji, ale też od **szybkości kodowania korekcyjnego** (np. 1/2, 2/3, 3/4, 5/6): część bitów służy korekcji błędów (kodowanie splotowe lub LDPC). Zestawy modulacji i kodowania nazywa się w Wi-Fi **MCS** (Modulation and Coding Scheme). System **adaptacji prędkości** automatycznie wybiera najwyższy MCS, przy którym transmisja jest jeszcze niezawodna.

### 4.6. Rozpraszanie widma i OFDM

**Techniki rozproszonego widma** (spread spectrum) rozszerzają sygnał na pasmo szersze niż konieczne, co zwiększa odporność na zakłócenia i utrudnia podsłuch:

* **FHSS** (Frequency-Hopping) — nadajnik szybko przeskakuje między wieloma częstotliwościami według ustalonej sekwencji (Bluetooth, pierwotne 802.11);
* **DSSS** (Direct Sequence) — każdy bit jest mnożony przez szybki ciąg chipów (kod pseudolosowy), np. 11-chipowy kod Barkera w 802.11 i 802.11b (1 i 2 Mb/s).

Współczesne systemy szerokopasmowe (Wi-Fi od 802.11a/g, LTE, 5G, DVB-T, DSL) używają **OFDM** (Orthogonal Frequency-Division Multiplexing). Zamiast jednej szybkiej nośnej stosuje się **wiele wolnych, ortogonalnych podnośnych**, których rozstaw równy jest odwrotności czasu trwania symbolu (<span data-m="\\Delta f = 1/T_u"></span>). Dzięki ortogonalności widma podnośnych mogą się nakładać bez wzajemnych zakłóceń. Zalety OFDM:

* **odporność na propagację wielodrogową** — każda podnośna jest wąska, więc widzi „płaski" kanał; opóźnione kopie symbolu tłumi **przedział ochronny (GI, guard interval)** wstawiany przed symbolem (kopia końca symbolu);
* **elastyczność** — słabe podnośne można wyłączyć albo zmodulować niżej (adaptive bit loading), a silne — wyżej;
* **efektywna implementacja** — modulator i demodulator realizowane są przez algorytmy szybkiej transformaty Fouriera (IFFT / FFT).

W wariancie wielodostępowym **OFDMA** (Wi-Fi 6, LTE, 5G) podnośne są przydzielane różnym użytkownikom w tym samym symbolu (bloki zasobów, RU).

### 4.7. MIMO i formowanie wiązki

**MIMO** (Multiple-Input Multiple-Output) wykorzystuje wiele anten nadawczych i odbiorczych. Wielodrogowość, dotąd szkodliwa, staje się zasobem: kilka niezależnych **strumieni przestrzennych** (spatial streams) przesyłanych jednocześnie na tej samej częstotliwości daje wielokrotność przepływności. Oznaczenie **NxM** to liczba anten nadawczych i odbiorczych, a osobno wyróżnia się liczbę strumieni (np. 2×2:2). Maksymalna teoretyczna liczba strumieni to mniejsza z liczb anten nadawczych i odbiorczych.

Techniki pokrewne:

* **Zróżnicowanie (diversity) i kodowanie przestrzenno-czasowe** — zwiększają niezawodność, nie przepływność;
* **Beamforming (formowanie wiązki)** — dobór fazy i amplitudy sygnałów na antenach tak, aby energia sumowała się konstruktywnie w kierunku odbiorcy;
* **MU-MIMO (Multi-User MIMO)** — obsługa wielu klientów jednocześnie na różnych strumieniach przestrzennych; wprowadzone w 802.11ac (kierunek w dół), w 802.11ax także w górę.

### 4.8. Inne technologie radiowe (przegląd)

| Technologia | Standard | Pasmo | Zasięg | Typowe zastosowanie |
|---|---|---|---|---|
| Bluetooth / BLE | IEEE 802.15.1 / Bluetooth SIG | 2,4 GHz | 10–100 m | urządzenia peryferyjne, słuchawki, czujniki |
| Zigbee / Thread | IEEE 802.15.4 | 2,4 GHz, 868 MHz | 10–100 m | inteligentny dom, sieci kratowe czujników |
| LoRaWAN | LoRa Alliance | 868 MHz (UE) | kilka–kilkanaście km | IoT o niskiej przepływności (LPWAN) |
| NFC | ISO/IEC 14443, 18092 | 13,56 MHz | do 10 cm | płatności, identyfikacja |
| LTE (4G) | 3GPP | 700–2600 MHz i inne | do kilkunastu km | telefonia komórkowa i FWA |
| 5G NR | 3GPP | sub-6 GHz i mmWave (24–52 GHz) | od setek metrów do kilku km | telefonia, FWA, sieci prywatne |
| Łączność satelitarna | m.in. DVB-S2, systemy LEO | 1–30 GHz | globalny | dostęp na obszarach o słabej infrastrukturze |
| Mikrofalowe łącza punkt–punkt | ETSI | 5–80 GHz | do kilkudziesięciu km | radiolinie operatorskie |

### 4.9. Zalety i ograniczenia mediów radiowych

**Zalety:** mobilność użytkowników, szybkie wdrożenie bez okablowania, możliwość dotarcia do miejsc trudnych do skablowania (zabytki, tereny górskie), elastyczność zmiany układu sieci, niski koszt pokrycia dużych, rozproszonych obszarów.

**Ograniczenia:** współdzielenie ograniczonego widma i interferencje (w pasmach bezlicencyjnych), zmienna jakość sygnału zależna od otoczenia, tłumienie przeszkód, niższa przepływność i większe opóźnienia niż w kablu, **podatność na podsłuch i ataki** (medium jest dostępne dla każdego w zasięgu), konieczność szyfrowania oraz kwestie zdrowotne i regulacyjne (limity mocy).

---

## 5. Standardy IEEE 802.11 (Wi-Fi)

### 5.1. Rodzina 802.11 i marka Wi-Fi

**IEEE 802.11** to zbiór standardów bezprzewodowych sieci lokalnych (WLAN), opracowywanych przez grupę roboczą 802.11 w ramach komitetu IEEE 802 (tego samego, który stworzył 802.3 — Ethernet). Standardy definiują dwie najniższe warstwy: **warstwę fizyczną (PHY)** oraz **podwarstwę MAC** warstwy łącza danych, dzięki czemu wyższe warstwy (IP, TCP) działają identycznie jak w sieci przewodowej. Ramka 802.11 jest po stronie punktu dostępowego konwertowana na ramkę Ethernet, dlatego Wi-Fi bywa nazywane „bezprzewodowym Ethernetem" — choć mechanizm dostępu do medium jest zasadniczo inny.

Sama nazwa **Wi-Fi** jest znakiem towarowym organizacji **Wi-Fi Alliance**, która testuje zgodność produktów różnych producentów i przyznaje certyfikaty. Nie każde urządzenie „802.11" jest certyfikowane jako Wi-Fi, ale w praktyce oba terminy używane są zamiennie. Dla czytelności od 2018 r. Wi-Fi Alliance stosuje **numerację generacji**: Wi-Fi 4 (802.11n), Wi-Fi 5 (802.11ac), Wi-Fi 6 i 6E (802.11ax), Wi-Fi 7 (802.11be).

Standard bazowy jest od czasu do czasu „skonsolidowany" (rollup) razem z przyjętymi poprawkami w jeden dokument. Obecnie obowiązuje wersja **IEEE 802.11-2024** (opublikowana w 2025 r.), a poszczególne poprawki (amendments), takie jak 802.11be, publikowane są osobno i włączane do następnej rewizji. Oznaczenia liter oznaczają kolejne poprawki, a nie „wersje" w sensie chronologicznym (np. 802.11i dotyczy bezpieczeństwa, a 802.11ac jest późniejsza niż 802.11n).

### 5.2. Architektura sieci 802.11

Podstawowe pojęcia:

* **STA (station)** — dowolne urządzenie z interfejsem 802.11 (laptop, telefon, czujnik);
* **AP (Access Point, punkt dostępowy)** — urządzenie łączące stacje bezprzewodowe z siecią przewodową (system dystrybucji);
* **BSS (Basic Service Set)** — podstawowy zestaw usług: jeden AP wraz ze skojarzonymi z nim stacjami, tworzący pojedynczą „komórkę" radiową; identyfikowany przez **BSSID** (zwykle adres MAC radia AP);
* **SSID (Service Set Identifier)** — nazwa sieci widoczna dla użytkownika (do 32 bajtów); wiele AP może rozgłaszać ten sam SSID;
* **DS (Distribution System)** — system dystrybucji łączący punkty dostępowe (zwykle sieć Ethernet);
* **ESS (Extended Service Set)** — zbiór BSS połączonych systemem dystrybucji, tworzący jedną logiczną sieć o wspólnym SSID i umożliwiający **roaming** między punktami dostępowymi;
* **IBSS (Independent BSS, sieć ad hoc)** — grupa stacji komunikujących się bezpośrednio, bez AP (nadal spotykana w trybach typu Wi-Fi Direct).

Najczęściej spotykany jest tryb **infrastrukturalny** (infrastructure), w którym cała komunikacja przechodzi przez AP, nawet między dwiema stacjami w tej samej komórce. Wariantami są: **mostek bezprzewodowy** (łączenie dwóch sieci przewodowych), **repeater/extender** (rozszerzenie zasięgu — zwykle kosztem połowy przepustowości, bo radio nadaje i odbiera na tym samym kanale) oraz **sieć kratowa (mesh)**, w której punkty dostępowe łączą się ze sobą bezprzewodowo, tworząc elastyczną strukturę (standard **802.11s** oraz rozwiązania producentów).

### 5.3. Przegląd ewolucji standardów

![Teoretyczne maksymalne przepływności kolejnych standardów Wi-Fi w skali logarytmicznej: od 2 Mb/s w 802.11 do ponad 46 Gb/s w 802.11be](wifi-ewolucja-standardow.svg)

| Standard | Rok | Nazwa marketingowa | Pasmo | Szerokość kanału | Modulacja | Maks. strumieni | Maks. teoretyczna przepływność |
|---|---|---|---|---|---|---|---|
| 802.11 (pierwotny) | 1997 | — | 2,4 GHz | 22 MHz | DSSS / FHSS (BPSK, QPSK), podczerwień | 1 | 2 Mb/s |
| 802.11b | 1999 | (Wi-Fi 1, nieoficjalnie) | 2,4 GHz | 22 MHz | DSSS / CCK | 1 | 11 Mb/s |
| 802.11a | 1999 | (Wi-Fi 2, nieoficjalnie) | 5 GHz | 20 MHz | OFDM, do 64-QAM | 1 | 54 Mb/s |
| 802.11g | 2003 | (Wi-Fi 3, nieoficjalnie) | 2,4 GHz | 20 MHz | OFDM, do 64-QAM (+ zgodność z b) | 1 | 54 Mb/s |
| 802.11n | 2009 | **Wi-Fi 4** | 2,4 i 5 GHz | 20 / 40 MHz | OFDM, do 64-QAM | 4 | 600 Mb/s |
| 802.11ac | 2013 (Wave 2: 2016) | **Wi-Fi 5** | 5 GHz | 20 / 40 / 80 / 160 MHz | OFDM, do 256-QAM | 8 | ok. 6,9 Gb/s |
| 802.11ax | 2021 | **Wi-Fi 6** (2,4/5 GHz), **6E** (+ 6 GHz) | 2,4 / 5 / 6 GHz | 20–160 MHz | OFDM/OFDMA, do 1024-QAM | 8 | ok. 9,6 Gb/s |
| 802.11be | zatw. 2024, publ. 2025 | **Wi-Fi 7** | 2,4 / 5 / 6 GHz | 20–320 MHz | OFDM/OFDMA, do 4096-QAM | 16 | ok. 46 Gb/s |

Warto podkreślić: podane przepływności są **teoretycznymi maksimami warstwy fizycznej** dla największej dozwolonej liczby strumieni i szerokości kanału. Typowy telefon czy laptop ma 1–2 anteny (strumienie), więc realne wartości PHY są kilkakrotnie niższe, a przepustowość użytkowa — jeszcze niższa (narzuty protokołu, współdzielenie medium, zakłócenia; w praktyce ok. 50–70 % przepływności PHY przy dobrych warunkach, a mniej w słabych).

### 5.4. Charakterystyka poszczególnych standardów

#### 802.11 (1997), 802.11b (1999)

Pierwotny standard oferował zaledwie 1 i 2 Mb/s w paśmie 2,4 GHz z użyciem rozpraszania widma (DSSS lub FHSS) oraz opcjonalnej podczerwieni. **802.11b** wprowadził kodowanie **CCK** (Complementary Code Keying) i przepływności 5,5 oraz 11 Mb/s przy zachowaniu tego samego kanału 22 MHz. To on uczynił Wi-Fi popularnym na rynku konsumenckim.

#### 802.11a (1999) i 802.11g (2003)

**802.11a** jako pierwszy zastosował **OFDM** (52 podnośne w kanale 20 MHz, z czego 48 na dane i 4 pilotowe) i pasmo **5 GHz**, osiągając do 54 Mb/s. Mniej zatłoczone pasmo było zaletą, lecz wyższa częstotliwość oznaczała krótszy zasięg i wyższe koszty, przez co standard początkowo zdobył mniejszą popularność. **802.11g** przeniósł OFDM do pasma 2,4 GHz, zachowując zgodność wsteczną z 802.11b. Obecność choćby jednego urządzenia „b" zmuszała jednak AP do stosowania mechanizmów ochronnych (RTS/CTS lub CTS-to-self), co obniżało przepustowość całej komórki.

#### 802.11n — Wi-Fi 4 (2009)

Przełomowy standard wprowadzający:

* **MIMO** z do 4 strumieniami przestrzennymi,
* **kanały 40 MHz** (przez łączenie dwóch sąsiednich kanałów 20 MHz),
* **agregację ramek** (A-MSDU i A-MPDU) — łączenie wielu ramek w jedną transmisję, co zmniejsza względny narzut nagłówków i przerw międzyramkowych,
* **Block ACK** — potwierdzanie wielu ramek jednym potwierdzeniem,
* **krótszy przedział ochronny** (400 ns zamiast 800 ns),
* pracę w obu pasmach: 2,4 i 5 GHz.

Maksymalnie: 4 strumienie × 40 MHz × 64-QAM 5/6 × krótki GI = 600 Mb/s.

#### 802.11ac — Wi-Fi 5 (2013)

Standard działający wyłącznie w paśmie **5 GHz**, wprowadzający:

* kanały **80 i 160 MHz**,
* modulację **256-QAM**,
* do **8 strumieni** przestrzennych,
* **MU-MIMO** w kierunku w dół (Wave 2), pozwalające AP nadawać równocześnie do kilku klientów,
* jawny **beamforming** ze standardowym mechanizmem sondowania kanału.

#### 802.11ax — Wi-Fi 6 / 6E (2021)

Projektowany z myślą o **efektywności w gęstych środowiskach** (biura, lotniska, stadiony), a nie tylko o maksymalnej prędkości. Najważniejsze cechy:

* **OFDMA** — podział kanału na mniejsze bloki zasobów (RU: 26, 52, 106, 242, 484, 996 podnośnych), które AP przydziela różnym klientom w tej samej transmisji; zmniejsza narzut przy krótkich ramkach (VoIP, IoT);
* **MU-MIMO w obu kierunkach** (UL i DL);
* **1024-QAM**;
* **dłuższy symbol OFDM** (12,8 µs zamiast 3,2 µs) i podnośne 4-krotnie węższe (78,125 kHz), z GI 0,8 / 1,6 / 3,2 µs — większa odporność na propagację wielodrogową, szczególnie na zewnątrz;
* **BSS Coloring** — znacznik komórki w nagłówku PHY, dzięki któremu stacje mogą rozpoznać ramki z sąsiedniej sieci i ponownie użyć kanału (spatial reuse);
* **TWT (Target Wake Time)** — umowa między AP a klientem o godzinach budzenia się, oszczędzająca baterię urządzeń IoT i mobilnych;
* **Wi-Fi 6E** — rozszerzenie na pasmo **6 GHz**, oferujące dziesiątki nowych, czystych kanałów bez urządzeń starszych generacji (w UE: 5945–6425 MHz).

#### 802.11be — Wi-Fi 7 (zatwierdzony w 2024, opublikowany w 2025)

Standard „Extremely High Throughput (EHT)". Kluczowe cechy:

* kanały do **320 MHz** (tylko w paśmie 6 GHz),
* modulacja **4096-QAM**,
* **MLO (Multi-Link Operation)** — jedno urządzenie może jednocześnie korzystać z kilku pasm (np. 5 i 6 GHz), agregując przepustowość lub wybierając najlepszy link dla niskiego opóźnienia i niezawodności,
* **Multi-RU** i **preamble puncturing** — przydział wielu bloków zasobów jednej stacji oraz „wycinanie" zajętych fragmentów szerokiego kanału (np. przy obecności radarów lub sąsiednich sieci) zamiast rezygnacji z całego kanału,
* do **16 strumieni** przestrzennych (w praktyce urządzenia mają 2–4),
* dopracowane mechanizmy dla ruchu wrażliwego na opóźnienia (m.in. restricted TWT).

Certyfikacja **Wi-Fi CERTIFIED 7** rozpoczęła się w styczniu 2024 r. i produkty na rynku pojawiły się jeszcze przed formalną publikacją standardu.

#### Wi-Fi 8 (802.11bn) i kierunki rozwoju

Grupa robocza IEEE pracuje nad poprawką **802.11bn — Ultra High Reliability (UHR)**, określaną jako Wi-Fi 8. Jej celem nie jest przede wszystkim wzrost szczytowej przepływności, ale **niezawodność, mniejsze opóźnienia i lepsza efektywność** w trudnych warunkach (m.in. koordynacja między punktami dostępowymi, redukcja utraty ramek). Prace są w toku, a zatwierdzenie oczekiwane jest w perspektywie kilku lat; równolegle rozważane są kolejne kierunki (m.in. komunikacja o ultraniskim poborze energii i współpraca z zadaniami edge AI). Szczegółowe daty warto sprawdzać w publicznych materiałach grupy 802.11, ponieważ harmonogram bywa aktualizowany.

#### Inne ważne poprawki

| Poprawka | Zakres |
|---|---|
| 802.11e | QoS w warstwie MAC (EDCA, HCCA); podstawa certyfikacji WMM |
| 802.11h | DFS i TPC — zgodność z europejskimi wymogami w paśmie 5 GHz |
| 802.11i | bezpieczeństwo (WPA2, CCMP, 802.1X) |
| 802.11k / v / r | zarządzanie radiem, sterowanie roamingiem, szybkie przełączanie między AP (Fast BSS Transition) |
| 802.11s | sieci kratowe (mesh) |
| 802.11w | ochrona ramek zarządzających (PMF) |
| 802.11ad / ay | pasmo **60 GHz** (WiGig): kanały 2,16 GHz, przepływności od kilku do kilkudziesięciu Gb/s, zasięg ograniczony do pomieszczenia |
| 802.11ah | **Wi-Fi HaLow**, pasma poniżej 1 GHz (868 MHz w UE), zasięg do ok. 1 km, IoT o niskiej przepływności i niskim poborze energii |
| 802.11p | komunikacja pojazdów (V2X) |

### 5.5. Kanały radiowe

#### Pasmo 2,4 GHz

W Europie dostępnych jest **13 kanałów** o numerach 1–13, których środki rozmieszczone są co **5 MHz** według wzoru:

<div data-m="f_{\\text{środ}}(n) = 2412 + 5\\,(n-1)\\ \\text{[MHz]}, \\qquad n = 1,\\dots,13"></div>

Ponieważ szerokość kanału wynosi 20 MHz (22 MHz w DSSS/CCK), a odstęp środków tylko 5 MHz, kanały **silnie się nakładają**. Kanały nienakładające się to praktycznie **1, 6 i 11** (w Europie bywa też używany zestaw 1, 5, 9, 13 kosztem lekkiego zachodzenia). Zakłócenie z sąsiedniego, częściowo nakładającego się kanału jest gorsze niż współdzielenie tego samego kanału, ponieważ stacje nie potrafią zdekodować cudzych nagłówków, więc nie koordynują dostępu do medium (patrz 5.7); dlatego zaleca się albo używanie tego samego kanału, albo kanałów rozdzielonych.

![Kanały Wi-Fi w paśmie 2,4 GHz — 13 kanałów po 20 MHz; nienakładające się: 1, 6 i 11](wifi-kanaly-2-4ghz.svg)

Szerokość 40 MHz w paśmie 2,4 GHz praktycznie nie ma sensu w zatłoczonym środowisku, bo zajmuje niemal połowę pasma i zwiększa interferencję. Dodatkowo pasmo jest współdzielone z Bluetooth, kuchenkami mikrofalowymi, bezprzewodowymi kamerami i innymi urządzeniami.

#### Pasmo 5 GHz

W paśmie 5 GHz numeracja kanałów jest ustalona co 5 MHz od częstotliwości 5000 MHz (<span data-m="f = 5000 + 5n"></span> MHz), lecz standardowo używa się kanałów rozłożonych co 4 numery (20 MHz). W Europie dostępne są m.in.:

* **kanały 36–64** (5180–5320 MHz), w tym część wymagająca **DFS** i **TPC** (52–64);
* **kanały 100–140** (5500–5700 MHz), wymagające DFS;
* w części krajów także kanały górne (np. 149–165, w zakresie SRD 5725–5875 MHz).

**DFS (Dynamic Frequency Selection)** wymaga, aby urządzenie przed rozpoczęciem pracy na kanale (zwykle przez 60 s, a w niektórych kanałach nawet 10 min) nasłuchiwało obecności radarów (meteorologicznych, wojskowych), a po wykryciu radaru natychmiast opuściło kanał. Może to powodować krótkie przerwy w pracy sieci. Szersze kanały (40, 80, 160 MHz) powstają przez łączenie sąsiednich kanałów 20 MHz; kanałów 160 MHz mieści się w paśmie 5 GHz zaledwie kilka, więc w gęstej zabudowie ich użycie prowadzi do interferencji.

#### Pasmo 6 GHz

W UE dla Wi-Fi udostępniono zakres **5945–6425 MHz** (480 MHz), co pozwala na 24 kanały 20 MHz, 12 kanałów 40 MHz, 6 kanałów 80 MHz, 3 kanały 160 MHz i 1 kanał 320 MHz (w USA i niektórych innych krajach dostępne jest 1200 MHz: 5925–7125 MHz). Pasmo jest czyste, ponieważ mogą w nim pracować wyłącznie urządzenia Wi-Fi 6E/7. Ma też zasady, jak **AFC** (Automated Frequency Coordination) dla urządzeń o standardowej mocy w USA oraz ograniczenie do zastosowań wewnątrz budynków dla urządzeń o niskiej mocy. Krótszy zasięg (wyższa częstotliwość) i silniejsze tłumienie przez ściany to cena za czystość widma.

### 5.6. Jak oblicza się przepływność fizyczną

Przepływność PHY wynika ze wzoru:

<div data-m="R = \\frac{N_{SD} \\cdot N_{BPSCS} \\cdot R_c \\cdot N_{SS}}{T_{\\text{sym}}}"></div>

gdzie:

* <span data-m="N_{SD}"></span> — liczba **podnośnych danych** w kanale,
* <span data-m="N_{BPSCS}"></span> — liczba bitów na podnośną i symbol (z modulacji: 6 dla 64-QAM, 8 dla 256-QAM, 10 dla 1024-QAM, 12 dla 4096-QAM),
* <span data-m="R_c"></span> — szybkość kodowania korekcyjnego (np. 3/4, 5/6),
* <span data-m="N_{SS}"></span> — liczba strumieni przestrzennych,
* <span data-m="T_{\\text{sym}}"></span> — czas trwania symbolu OFDM wraz z przedziałem ochronnym.

Liczba podnośnych danych w zależności od standardu i szerokości kanału:

| Standard | 20 MHz | 40 MHz | 80 MHz | 160 MHz | 320 MHz | Symbol (bez GI) |
|---|---|---|---|---|---|---|
| 802.11a/g | 48 | — | — | — | — | 3,2 µs (+ GI 0,8) |
| 802.11n | 52 | 108 | — | — | — | 3,2 µs (+ GI 0,8 / 0,4) |
| 802.11ac | 52 | 108 | 234 | 468 | — | 3,2 µs (+ GI 0,8 / 0,4) |
| 802.11ax | 234 | 468 | 980 | 1960 | — | 12,8 µs (+ GI 0,8 / 1,6 / 3,2) |
| 802.11be | 234 | 468 | 980 | 1960 | 3920 | 12,8 µs (+ GI 0,8 / 1,6 / 3,2) |

**Przykład 1 — 802.11n.** Kanał 40 MHz, 64-QAM, <span data-m="R_c = 5/6"></span>, jeden strumień, krótki GI (symbol 3,6 µs):

<div data-m="R = \\frac{108 \\cdot 6 \\cdot \\tfrac{5}{6} \\cdot 1}{3{,}6\\ \\mu\\text{s}} = \\frac{540}{3{,}6\\ \\mu\\text{s}} = 150 \\text{ Mb/s}"></div>

Dla czterech strumieni: 600 Mb/s.

**Przykład 2 — 802.11ac.** Kanał 80 MHz, 256-QAM, <span data-m="R_c = 5/6"></span>, jeden strumień, krótki GI:

<div data-m="R = \\frac{234 \\cdot 8 \\cdot \\tfrac{5}{6}}{3{,}6\\ \\mu\\text{s}} = \\frac{1560}{3{,}6\\ \\mu\\text{s}} \\approx 433{,}3 \\text{ Mb/s}"></div>

Typowy laptop 2×2 osiąga więc 866,7 Mb/s (80 MHz), a przy kanale 160 MHz — 1733 Mb/s.

**Przykład 3 — 802.11ax.** Kanał 80 MHz, 1024-QAM, <span data-m="R_c = 5/6"></span>, jeden strumień, GI 0,8 µs (symbol 13,6 µs):

<div data-m="R = \\frac{980 \\cdot 10 \\cdot \\tfrac{5}{6}}{13{,}6\\ \\mu\\text{s}} \\approx \\frac{8166{,}7}{13{,}6\\ \\mu\\text{s}} \\approx 600{,}5 \\text{ Mb/s}"></div>

**Przykład 4 — 802.11be.** Kanał 320 MHz, 4096-QAM, <span data-m="R_c = 5/6"></span>, GI 0,8 µs: jeden strumień to <span data-m="3920 \\cdot 12 \\cdot \\tfrac{5}{6} / 13{,}6\\ \\mu\\text{s} \\approx 2882"></span> Mb/s. Typowy klient 2×2 osiąga więc ok. 5,8 Gb/s, a hipotetyczne 16 strumieni — 46,1 Gb/s.

Warto zauważyć, że wzrost liczby bitów na symbol (1024-QAM w porównaniu z 256-QAM) daje w 802.11ax jedynie ok. 25 % zysku. Główne korzyści Wi-Fi 6 wynikają z efektywności (OFDMA, spatial reuse), nie z surowej prędkości.

### 5.7. Warstwa MAC: dostęp do medium CSMA/CA

#### Dlaczego nie CSMA/CD?

W Ethernecie stacja nasłuchuje medium podczas nadawania i wykrywa kolizje (**CSMA/CD**). W sieci bezprzewodowej jest to niemożliwe z dwóch powodów:

1. **Półdupleks radia i różnica poziomów mocy** — sygnał własnego nadajnika jest na wejściu odbiornika o wiele rzędów wielkości silniejszy niż sygnał zdalny (ok. 100 dB), więc nadajnik „zagłusza" własny odbiornik. Stacja nie może zatem wykrywać kolizji w trakcie nadawania.
2. **Problem ukrytej stacji (hidden node)** — dwie stacje A i C mogą znajdować się w zasięgu punktu dostępowego B, ale poza zasięgiem siebie nawzajem. Nie słyszą się, więc obie uznają medium za wolne i nadają jednocześnie, powodując kolizję u odbiorcy B, o której żadna z nich nie wie. Występuje także **problem odsłoniętej stacji (exposed node)**, w którym stacja niepotrzebnie wstrzymuje nadawanie, choć jej transmisja nie zakłóciłaby odbioru.

Dlatego Wi-Fi stosuje **CSMA/CA (Collision Avoidance)** — unikanie kolizji, a nie ich wykrywanie. Wszystkie transmisje jednostkowe wymagają **potwierdzenia (ACK)**, a jego brak oznacza, że ramka mogła ulec zakłóceniu i należy ją retransmitować.

#### DCF — Distributed Coordination Function

Podstawowy mechanizm dostępu, działający w sposób rozproszony (bez centralnego arbitra):

1. Stacja z gotową ramką **nasłuchuje medium** (fizycznie: odczyt mocy/wykrycie nośnej; wirtualnie: sprawdzenie licznika NAV).
2. Jeśli medium jest wolne co najmniej przez czas **DIFS**, stacja może nadawać od razu (przy pierwszej próbie).
3. Jeśli medium jest zajęte, stacja czeka na jego zwolnienie, następnie odczekuje **DIFS** i losuje **licznik backoff** z przedziału <span data-m="[0, CW]"></span>, gdzie <span data-m="CW"></span> (contention window) to okno rywalizacji.
4. Licznik zmniejsza się o 1 w każdym wolnym slocie czasowym i **zamraża się**, gdy medium staje się zajęte (stacja wznawia odliczanie po ponownym odczekaniu DIFS).
5. Gdy licznik osiągnie 0, stacja nadaje ramkę.
6. Odbiorca po poprawnym odebraniu (weryfikacja FCS) odczekuje krótki czas **SIFS** i wysyła **ACK**.
7. Jeśli ACK nie nadejdzie w oczekiwanym czasie, stacja uznaje kolizję lub zakłócenie, **podwaja okno rywalizacji** (binary exponential backoff): <span data-m="CW \\leftarrow 2\\,(CW+1) - 1"></span> do wartości maksymalnej <span data-m="CW_{max}"></span>, i ponawia próbę (do limitu retransmisji; typowo 7 dla krótkich ramek).

Losowy backoff zapobiega temu, że po zwolnieniu się medium wszystkie oczekujące stacje ruszą jednocześnie.

![Sekwencja dostępu do medium CSMA/CA: DIFS, backoff, ramka danych, SIFS i ACK oraz zachowanie stacji odczuwającej NAV](csma-ca-sekwencja.svg)

**Odstępy czasowe (przykładowe wartości):**

| Parametr | Znaczenie | 802.11a/n/ac/ax (5 GHz) | 802.11g/n (2,4 GHz, OFDM) | 802.11b |
|---|---|---|---|---|
| Slot | podstawowa jednostka backoff | 9 µs | 9 µs (krótki) / 20 µs | 20 µs |
| SIFS | odstęp krótki (przed ACK, CTS) | 16 µs | 10 µs | 10 µs |
| DIFS | <span data-m="\\text{SIFS} + 2 \\cdot \\text{slot}"></span> | 34 µs | 28 µs / 50 µs | 50 µs |
| <span data-m="CW_{min}"></span> / <span data-m="CW_{max}"></span> | okno rywalizacji | 15 / 1023 | 15 / 1023 | 31 / 1023 |

Zasada priorytetu wynika z zależności **SIFS < DIFS**: ACK i inne ramki odpowiedzi są wysyłane po najkrótszym odstępie, więc żadna stacja rywalizująca o medium (czekająca DIFS + backoff) nie wtrąci się w trakcie wymiany.

#### Wirtualne wykrywanie nośnej i NAV

Każda ramka zawiera w nagłówku pole **Duration**, informujące, jak długo (w mikrosekundach) medium zostanie zajęte przez bieżącą wymianę (ramka + SIFS + ACK). Stacje, które słyszą tę ramkę, ustawiają swój licznik **NAV (Network Allocation Vector)** i przez ten czas **nie nadają**, nawet jeśli fizycznie medium wygląda na wolne. To „wirtualne" wykrywanie nośnej.

#### RTS/CTS

Aby rozwiązać problem ukrytej stacji, stosuje się opcjonalną wymianę **RTS/CTS**:

1. Nadawca wysyła krótką ramkę **RTS (Request To Send)**.
2. Odbiorca (AP), jeśli medium jest wolne, odpowiada ramką **CTS (Clear To Send)**.
3. Stacje słyszące CTS (także te ukryte przed nadawcą) ustawiają NAV i wstrzymują transmisję.
4. Nadawca wysyła właściwą ramkę danych, a odbiorca — ACK.

RTS/CTS dodaje narzut, więc jest włączany tylko dla **dużych ramek** powyżej ustalonego progu (*RTS threshold*) lub w środowiskach z dużą liczbą kolizji.

#### QoS: EDCA i WMM

Standard **802.11e** wprowadził **EDCA (Enhanced Distributed Channel Access)**, w którym ruch jest dzielony na cztery **kategorie dostępu** (AC): **Voice (AC_VO)**, **Video (AC_VI)**, **Best Effort (AC_BE)** i **Background (AC_BK)**. Każda kategoria ma własne parametry: krótszy odstęp arbitrażowy **AIFS**, mniejsze <span data-m="CW_{min}/CW_{max}"></span> i limit czasu transmisji **TXOP**. W efekcie ramki głosowe zyskują statystycznie pierwszeństwo dostępu. Certyfikat Wi-Fi dla tej funkcji nazywa się **WMM (Wi-Fi Multimedia)**.

### 5.8. Format ramki 802.11

Ramka 802.11 jest bardziej złożona niż ramka Ethernet, ponieważ musi obsłużyć adresowanie w środowisku z punktami dostępowymi i zapewniać mechanizmy sterujące.

| Pole | Rozmiar | Opis |
|---|---|---|
| Frame Control | 2 B | wersja protokołu, typ i podtyp ramki, flagi (To DS, From DS, More Fragments, Retry, Power Management, More Data, Protected Frame, Order) |
| Duration / ID | 2 B | czas zajętości medium (NAV) lub identyfikator skojarzenia (w ramkach PS-Poll) |
| Address 1 | 6 B | adres odbiorcy (RA) |
| Address 2 | 6 B | adres nadawcy (TA) |
| Address 3 | 6 B | zależny od trybu: BSSID lub adres źródłowy/docelowy |
| Sequence Control | 2 B | numer sekwencji i numer fragmentu (wykrywanie duplikatów) |
| Address 4 | 6 B | tylko w ramkach między AP (WDS/mesh) |
| QoS Control | 2 B | kategoria ruchu, polityka ACK (w ramkach QoS Data) |
| HT/VHT/HE Control | 4 B | informacje sterujące (opcjonalne) |
| Frame Body | 0–2304 B klasycznie (do ok. 7,9 kB z A-MSDU) | dane (enkapsulowany pakiet LLC/SNAP + IP), przy agregacji A-MPDU cała transmisja do kilku MB |
| FCS | 4 B | CRC-32 |

Inaczej niż w Ethernecie ramka 802.11 może zawierać **trzy lub cztery adresy**, a ich znaczenie zależy od flag **To DS** i **From DS**:

| To DS | From DS | Scenariusz | Address 1 | Address 2 | Address 3 | Address 4 |
|---|---|---|---|---|---|---|
| 0 | 0 | stacje w sieci ad hoc (IBSS) | odbiorca (DA) | nadawca (SA) | BSSID | — |
| 0 | 1 | AP → stacja | odbiorca (DA) | BSSID (AP) | nadawca (SA) | — |
| 1 | 0 | stacja → AP | BSSID (AP) | nadawca (SA) | odbiorca (DA) | — |
| 1 | 1 | AP → AP (most, mesh) | RA | TA | DA | SA |

Ramki dzielą się na trzy **typy**:

* **ramki zarządzające (management)** — **Beacon** (rozgłaszany co ok. 102,4 ms, czyli 100 TU, zawiera SSID, obsługiwane prędkości, informacje o zabezpieczeniach i możliwościach), **Probe Request/Response**, **Authentication**, **Association/Reassociation Request/Response**, **Deauthentication**, **Disassociation**, **Action**;
* **ramki sterujące (control)** — **RTS, CTS, ACK, Block ACK, PS-Poll**;
* **ramki danych (data)** — dane użytkownika, w tym **QoS Data** i **Null** (sygnalizacja trybu oszczędzania energii).

Pole **FCS** stanowi taką samą sumę CRC-32 jak w Ethernecie; ramka z błędnym FCS jest odrzucana i w Wi-Fi skutkuje brakiem ACK, a więc retransmisją.

### 5.9. Dołączanie stacji do sieci

Klient przechodzi kilka stanów, zanim będzie mógł przesyłać dane:

1. **Skanowanie (scanning)** — stacja poszukuje sieci. **Pasywne**: nasłuchuje ramek Beacon na kolejnych kanałach. **Aktywne**: wysyła **Probe Request** i czeka na **Probe Response** od punktów dostępowych.
2. **Uwierzytelnianie (authentication)** — w trybie Open System wymiana sprowadza się do formalności (dwie ramki); w WPA3-SAE zawiera już wymianę kryptograficzną.
3. **Skojarzenie (association)** — klient wysyła **Association Request** z informacjami o swoich możliwościach (obsługiwane prędkości, standardy), a AP odpowiada **Association Response** z identyfikatorem AID.
4. **Uwierzytelnianie dostępu i uzgodnienie kluczy** — w sieciach z WPA2/WPA3: **4-way handshake** (uzgodnienie kluczy szyfrujących) lub w trybie Enterprise wcześniej wymiana **802.1X/EAP** z serwerem RADIUS.
5. Po przyznaniu adresu IP (**DHCP**) rozpoczyna się właściwa komunikacja.

### 5.10. Bezpieczeństwo sieci Wi-Fi

Ponieważ medium radiowe jest dostępne dla każdego w zasięgu, bezpieczeństwo musi być zapewnione kryptograficznie.

| Protokół | Rok | Szyfrowanie / uwierzytelnianie | Ocena |
|---|---|---|---|
| **WEP** | 1997 | RC4, 24-bitowy wektor IV, statyczny klucz 40/104 bity | **całkowicie złamany** (od 2001 r.; klucz można odzyskać w minuty) — nie stosować |
| **WPA** | 2003 | TKIP (RC4 z dynamicznymi kluczami i kontrolą integralności MIC) | przestarzały, rozwiązanie przejściowe |
| **WPA2** | 2004 (802.11i) | **AES-CCMP**, klucz PSK (Personal) lub 802.1X (Enterprise) | dobre, ale podatne na atak słownikowy offline na słabe hasło i na atak KRACK (2017, łatany) |
| **WPA3** | 2018 | **SAE** zamiast PSK (Personal), 192-bitowy zestaw kryptograficzny (Enterprise), **OWE** dla sieci otwartych, obowiązkowe PMF | zalecany; odporność na atak słownikowy offline, poufność wsteczna (forward secrecy) |

Ważne zasady praktyczne:

* stosować **WPA3** lub co najmniej **WPA2-AES** (w trybie mieszanym WPA2/WPA3 dla zgodności ze starszymi klientami), **nigdy** WEP ani TKIP;
* używać długich, unikalnych haseł (Personal) lub **802.1X/EAP** z certyfikatami w środowiskach firmowych;
* wyłączyć **WPS** z kodem PIN (znane podatności);
* stosować **izolację gości** (osobny VLAN i SSID) oraz aktualizować oprogramowanie sprzętowe punktów dostępowych;
* ukrywanie SSID **nie jest** zabezpieczeniem (nazwa jest ujawniana w ramkach przy połączeniu).

**PMF (Protected Management Frames, 802.11w)** chroni ramki zarządzające (np. deauthentication) przed fałszowaniem, co uniemożliwia proste ataki „wyrzucania" klientów z sieci.

### 5.11. Roaming i zarządzanie siecią WLAN

W sieci ESS z wieloma punktami dostępowymi klient sam decyduje, kiedy przełączyć się na inny AP (standard nie narzuca algorytmu), co prowadzi do problemu **„lepkich klientów" (sticky clients)** — urządzeń trzymających się słabego AP mimo obecności lepszego. Rozwiązania:

* **802.11k** — AP przekazuje klientowi listę sąsiednich punktów dostępowych, skracając skanowanie;
* **802.11v** — AP może zasugerować klientowi przeniesienie się do innego AP (BSS Transition Management);
* **802.11r (Fast BSS Transition)** — uzgodnienie kluczy z następnym AP jeszcze przed przełączeniem, co skraca przerwę do kilkudziesięciu milisekund (istotne dla VoIP).

W większych instalacjach stosuje się **kontrolery WLAN** (lokalne lub chmurowe), które centralnie zarządzają konfiguracją, doborem kanałów i mocy oraz roamingiem punktów dostępowych.

### 5.12. Planowanie i diagnostyka sieci Wi-Fi

Podstawowe zasady projektowania:

* **Sygnał i SNR.** Orientacyjne progi: sygnał (RSSI) około **−67 dBm** lub lepszy dla aplikacji czasu rzeczywistego (VoIP, wideo), około −70 dBm dla przeciętnych zastosowań; SNR co najmniej 25 dB dla wysokich prędkości.
* **Pokrycie i zakładki komórek.** Sąsiednie komórki powinny nakładać się na ok. 15–20 % powierzchni, aby umożliwić roaming, ale nie tyle, by wprowadzać interferencję współkanałową.
* **Interferencja współkanałowa (CCI)** — punkty dostępowe na tym samym kanale współdzielą czas antenowy (medium), więc kolejne AP na tym samym kanale w zasięgu słyszalności **nie zwiększają** pojemności. Planując kanały, dąży się do ich powtarzania dopiero z odległości poza zasięgiem słyszalności.
* **Interferencja kanałów sąsiednich (ACI)** — jak wyżej, częściowo nakładające się kanały są gorsze niż identyczne.
* **Moc nadawcza** — większa moc AP nie poprawia sytuacji, jeśli urządzenia klienckie (o mniejszej mocy) nie potrafią odpowiedzieć; sieć jest ograniczana przez **najsłabsze ogniwo** — klienta. Zaleca się umiarkowaną moc i większą liczbę AP.
* **Szerokość kanału.** Szersze kanały zwiększają prędkość, ale zmniejszają liczbę dostępnych kanałów i obniżają czułość odbiornika (szum rośnie o 3 dB przy każdym podwojeniu szerokości). W gęstych instalacjach zwykle stosuje się kanały 20/40 MHz w 5 GHz.
* **Pasma.** Klientów o możliwościach dwupasmowych warto kierować do pasm 5/6 GHz (**band steering**), pozostawiając 2,4 GHz starszym i prostym urządzeniom IoT.

**Narzędzia diagnostyczne:** analizatory widma i sieci Wi-Fi (m.in. aplikacje w telefonach i laptopach), narzędzia typu site survey (mapy cieplne pokrycia), analizatory pakietów w trybie monitor (przechwytywanie ramek 802.11), a w systemach operacyjnych — wbudowane polecenia (np. `iw`, `iwconfig` w Linuksie).

### 5.13. Zalety i wady Wi-Fi

**Zalety:** mobilność, brak konieczności okablowania, powszechność sprzętu i niski koszt, zgodność wsteczna, szybki rozwój (kolejne generacje co kilka lat), wsparcie w niemal każdym urządzeniu końcowym.

**Wady:** współdzielone i zatłoczone medium (półdupleks, rywalizacja CSMA/CA), niższa i zmienna przepustowość oraz większe opóźnienia niż w kablu, podatność na zakłócenia, tłumienie przeszkód, konieczność zabezpieczenia kryptograficznego, ograniczenia regulacyjne (moc, DFS) i zależność wydajności od najsłabszego klienta w komórce.

---

## 6. Technologie dostępowe i sieci rozległe (WAN)

### 6.1. Sieć dostępowa — pojęcia podstawowe

**Sieć dostępowa** (ang. *access network*) łączy lokal abonenta (dom, firmę) z siecią operatora i dalej z Internetem. Odcinek ten nazywany jest **ostatnią milą** (*last mile*) — nie dlatego, że ma dokładnie jedną milę, lecz dlatego, że jest najkosztowniejszym i najtrudniejszym do modernizacji fragmentem infrastruktury: jest go najwięcej (jedno przyłącze na abonenta), a koszty rozkopania ulic i wejścia do budynków są ogromne.

Podstawowe elementy:

* **CPE (Customer Premises Equipment)** — urządzenie po stronie abonenta (modem, router, terminal światłowodowy ONT);
* **Punkt demarkacyjny (demarc)** — granica odpowiedzialności między siecią operatora a instalacją abonenta;
* **Pętla lokalna (local loop)** — łącze między abonentem a najbliższym węzłem operatora;
* **CO (Central Office)** lub **POP (Point of Presence)** — węzeł operatora, w którym kończą się łącza abonenckie (centrala telefoniczna, węzeł kablowy, węzeł światłowodowy);
* **Sieć szkieletowa (backbone/core)** — szybka sieć łącząca węzły operatora.

Technologie dostępowe można klasyfikować według medium: **miedź** (telefoniczna: dial-up, ISDN, DSL; koncentryczna: sieci kablowe), **światłowód** (FTTx, PON), **radio** (sieci komórkowe, FWA, WISP, satelita).

### 6.2. Modemy — czym są i jakie mają odmiany

**Modem** (skrót od *modulator–demodulator*) to urządzenie zamieniające dane cyfrowe na sygnał dostosowany do właściwości danego medium (modulacja) oraz odtwarzające dane z odebranego sygnału (demodulacja). Nazwa pochodzi z czasów, gdy medium było analogowe (linia telefoniczna), lecz dziś oznacza dowolne urządzenie dopasowujące komputer do konkretnej technologii dostępowej:

* **modem analogowy** (dial-up) — na linii telefonicznej w paśmie głosowym;
* **modem DSL** — na łączu miedzianym, wykorzystujący pasmo powyżej głosu;
* **modem kablowy (cable modem)** — w sieci telewizji kablowej, standard DOCSIS;
* **terminal ONT/ONU** — zakończenie światłowodu (formalnie nie „modulator", ale pełni analogiczną rolę, zamieniając sygnał optyczny na Ethernet);
* **modem komórkowy** (LTE/5G) — jako moduł w telefonie lub router z kartą SIM;
* **modem satelitarny** — obsługujący łączność z terminalem satelitarnym.

W praktyce urządzenia w domach są zazwyczaj **bramami (gateway)**, łączącymi funkcje modemu, routera z NAT, przełącznika Ethernet, punktu dostępowego Wi-Fi i serwera DHCP w jednej obudowie. Modem może pracować w **trybie mostu (bridge)**, w którym jedynie przekazuje ramki bez routowania — wtedy router (własny lub operatora) realizuje NAT i uwierzytelnianie.

### 6.3. Dial-up i ISDN — historyczne technologie dostępowe

**Modemy analogowe (dial-up).** Sieć telefoniczna została zaprojektowana dla głosu w paśmie **300–3400 Hz** (ok. 3,1 kHz). Skoro pasmo jest tak wąskie, przepływność ograniczona jest twierdzeniem Shannona (przykład 1 w rozdziale 1.5: ok. 35 kb/s). Kolejne standardy modemów, wykorzystujące zaawansowane modulacje QAM i kodowanie kratowe, zbliżały się do tej granicy: **V.34** (do 33,6 kb/s, obie strony analogowe), a następnie **V.90** i **V.92**, które osiągały do 56 kb/s w kierunku „do abonenta" dzięki temu, że po stronie dostawcy sygnał jest już cyfrowy (PCM, 64 kb/s na kanał) i nie występuje szum kwantowania w tej części toru. Dial-up zajmuje linię telefoniczną (brak rozmów podczas połączenia) i wymaga zestawiania połączenia komutowanego.

**ISDN (Integrated Services Digital Network).** Cyfrowa sieć telefoniczna z usługą end-to-end w postaci cyfrowej:

* **BRI (Basic Rate Interface)** — dostęp podstawowy **2B+D**: dwa kanały użytkowe **B** po 64 kb/s (razem 128 kb/s) i kanał sygnalizacyjny **D** 16 kb/s (razem 144 kb/s); dla użytkowników domowych i małych firm;
* **PRI (Primary Rate Interface)** — dostęp pierwotny: w Europie **30B+D** (łącze E1, 2,048 Mb/s), w Ameryce Północnej **23B+D** (łącze T1, 1,544 Mb/s); dla central firmowych.

Dziś ISDN jest wypierany przez technologie IP i telefonię VoIP.

### 6.4. DSL — cyfrowa linia abonencka

#### Idea

Kabel telefoniczny (skrętka miedziana) doprowadzony do niemal każdego domu jest zdolny do przenoszenia sygnałów o częstotliwościach dużo wyższych niż pasmo głosowe (do ok. 4 kHz wykorzystywane w telefonii). Technologie **DSL (Digital Subscriber Line)** wykorzystują **wyższe częstotliwości** tej samej pary przewodów do przesyłania danych, **równolegle** z klasyczną usługą telefoniczną (POTS), bez zajmowania linii. Rodzina technologii zbiorczo oznaczana jest **xDSL**.

![Architektura dostępu DSL: lokal abonenta z modemem i splitterem, pętla lokalna, DSLAM i BNG w centrali oraz podział pasma ADSL](dsl-architektura.svg)

#### Elementy architektury

* **Modem/router DSL** u abonenta.
* **Splitter (rozdzielacz) lub mikrofiltr** — prosty filtr pasywny (dolnoprzepustowy dla telefonu, górnoprzepustowy dla modemu), który rozdziela sygnał głosowy i dane. Mikrofiltry dołączane są do każdego telefonu w instalacji abonenta, aby sygnał DSL nie powodował trzasków, a sygnał telefonii nie zakłócał modemu.
* **Pętla lokalna** — istniejąca linia telefoniczna (skrętka miedziana, zwykle 0,4 lub 0,5 mm) o długości do kilku kilometrów.
* **DSLAM (DSL Access Multiplexer)** — urządzenie w centrali (lub w szafie ulicznej), zawierające wiele modemów DSL po stronie operatora; multipleksuje ruch od wielu abonentów w jedno łącze szybkie (dziś zazwyczaj Ethernet/światłowód).
* **BNG/BRAS (Broadband Network Gateway / Broadband Remote Access Server)** — urządzenie kończące sesje abonentów: uwierzytelnia je (zwykle przez **RADIUS**), przydziela adresy IP, nakłada limity i profile jakości usług.
* Rozgałęźnik ruchu głosowego przekazuje sygnał telefoniczny do komutatora **PSTN**.

#### Modulacja DMT i podział pasma

Większość systemów DSL (ADSL, VDSL) stosuje modulację **DMT (Discrete Multi-Tone)**, czyli odmianę OFDM dla linii miedzianej. Pasmo dzielone jest na wiele wąskich podkanałów (**podnośnych, tonów**), np. w ADSL o szerokości **4,3125 kHz** każdy. Zestaw tonów podlega **adaptacyjnemu przydziałowi bitów (bit loading)**: podczas synchronizacji (tzw. *training*) modem mierzy SNR każdego tonu i przydziela mu tyle bitów, ile ten ton może bezpiecznie przenieść (od 0 do 15 bitów w konstelacji QAM). Tony zakłócone (np. zawartością radiową AM lub silną interferencją) są po prostu wyłączane lub obciążane mniej.

*Przykład.* W ADSL symbole DMT wysyłane są z częstotliwością 4000 na sekundę. Jeśli 200 tonów kierunku „w dół" przenosi średnio 8 bitów, przepływność wynosi:

<div data-m="R = 200 \\cdot 8 \\cdot 4000 = 6{,}4 \\text{ Mb/s}"></div>

W ADSL pasmo jest rozdzielone tak, że **0–4 kHz** to telefonia, **ok. 25–138 kHz** to kierunek „w górę" (upstream, do sieci), a **ok. 138 kHz – 1,1 MHz** to kierunek „w dół" (downstream, do abonenta). Ponieważ zasięg upstream i downstream jest nierówny, nazywa się to łączem **asymetrycznym** (ADSL — *Asymmetric*), co odpowiada typowemu wzorcowi użytkowania (więcej pobierania niż wysyłania).

#### Wersje DSL

| Technologia | Standard ITU-T | Pasmo | Maks. w dół / w górę | Orientacyjny zasięg |
|---|---|---|---|---|
| ADSL | G.992.1 (G.dmt), 1999 | 1,1 MHz | 8 Mb/s / 1 Mb/s | do ok. 5 km |
| ADSL2 | G.992.3, 2002 | 1,1 MHz | 12 Mb/s / 1 Mb/s | do ok. 5 km |
| ADSL2+ | G.992.5, 2003 | 2,2 MHz | 24 Mb/s / 1–3,5 Mb/s | pełna prędkość do ok. 1,5 km, ok. 3 km — kilka Mb/s |
| VDSL | G.993.1, 2001 | 12 MHz | 52 Mb/s / 16 Mb/s | do ok. 1,2 km |
| VDSL2 | G.993.2, 2006 | do 17,7 MHz (profil 17a) lub 30 MHz (30a) | do ok. 100 Mb/s (17a) lub 200 Mb/s (30a), także symetrycznie | do ok. 1 km (17a), do ok. 300 m (30a); dłuższe pętle — niższe prędkości |
| G.fast | G.9701, 2014 | 106 MHz lub 212 MHz | do ok. 1 Gb/s (suma obu kierunków, TDD) | ok. 100–250 m |
| SHDSL | G.991.2 | pasmo symetryczne | do ok. 5,7 Mb/s na parę, symetrycznie | do kilku km |

Wartości zasięgu są **orientacyjne** i silnie zależą od jakości pętli. Kluczowe jest to, że tłumienie miedzi rośnie z częstotliwością i długością, więc **im wyższe pasmo, tym krótszy zasięg**. Dlatego rodzina DSL ewoluowała ku coraz krótszym pętlom: światłowód dochodzi do szafy ulicznej (**FTTC/FTTN**, ostatnie 100–500 m po miedzi z VDSL2) lub do budynku (**FTTB**, G.fast na instalacji wewnętrznej).

#### Czynniki wpływające na prędkość DSL

* **Długość i średnica pętli** — im dłuższa i cieńsza, tym większe tłumienie;
* **Tłumienie linii i margines SNR** — modem zwykle utrzymuje docelowy zapas SNR (ok. 6 dB), poniżej którego przyjmuje niższą prędkość;
* **Przesłuchy** — zwłaszcza **FEXT** od sąsiednich par w tym samym kablu; w VDSL2 ograniczane technologią **vectoring** (G.993.5), która mierzy i kasuje przesłuchy między liniami (wymaga koordynacji wszystkich par w kablu pod kontrolą jednego operatora);
* **Odczepy mostkowane i stare instalacje**, niedopasowania impedancji, korozja;
* **Interleaving i FEC** — kodowanie korekcyjne Reeda–Solomona z przeplotem poprawia odporność na zakłócenia impulsowe kosztem dodatkowego opóźnienia.

Rozróżnia się **prędkość synchronizacji** (sync rate, ustalona przez modemy) i **przepustowość użyteczną** — niższą z powodu narzutów enkapsulacji.

#### Enkapsulacja danych w DSL

Dane użytkownika przesyłane są przez DSL w kilku warstwach:

* **ATM** (w klasycznym ADSL) — dane dzielone na **komórki ATM** o stałej długości 53 B (5 B nagłówka + 48 B danych), co powoduje tzw. „podatek komórkowy" rzędu 10–15 %; w VDSL2 i nowszych stosuje się **PTM (Packet Transfer Mode)** z efektywnym kodowaniem 64/65 B;
* **PPPoE** (PPP over Ethernet) — najpopularniejsza metoda uwierzytelniania i tworzenia sesji z BNG; dodaje 8 bajtów narzutu, więc **MTU wynosi 1492 B** zamiast 1500 B (co bywa przyczyną problemów z fragmentacją i stosowania MSS clamping); alternatywą jest **IPoE** (IP over Ethernet) z uwierzytelnianiem opartym na opcjach DHCP lub porcie.

### 6.5. Sieci kablowe (HFC) i DOCSIS

Operatorzy telewizji kablowej oferują dostęp do Internetu przez sieć koncentryczną. Nowoczesne sieci mają architekturę **HFC (Hybrid Fiber-Coaxial)**: od głównej stacji czołowej (**headend**) biegnie światłowód do węzłów optycznych, a stamtąd — **kabel koncentryczny** (75 Ω) z wzmacniaczami do domów. Kilkaset gospodarstw domowych w obrębie jednego węzła **współdzieli** pasmo, co odróżnia HFC od DSL (gdzie pętla jest dedykowana każdemu abonentowi).

Standard transmisji danych nazywa się **DOCSIS (Data Over Cable Service Interface Specification)** i jest opracowywany przez CableLabs. Po stronie operatora działa **CMTS (Cable Modem Termination System)**, po stronie abonenta — **modem kablowy**. Kierunek „w dół" wykorzystuje kanały telewizyjne (w Europie 8 MHz, w USA 6 MHz), a kierunek „w górę" — dolną część widma (5–65 MHz w Europie, 5–42 MHz w USA).

| Wersja | Rok | Kluczowe cechy | Typowa przepływność (maks.) |
|---|---|---|---|
| DOCSIS 1.0 / 1.1 | 1997 / 1999 | pojedynczy kanał, QAM-64/256; QoS w 1.1 | kilkadziesiąt Mb/s w dół |
| DOCSIS 2.0 | 2001 | lepsza przepustowość w górę | kilkadziesiąt Mb/s |
| DOCSIS 3.0 | 2006 | **bonding kanałów** (łączenie 4, 8, 16, 32 kanałów), IPv6 | ponad 1 Gb/s w dół |
| DOCSIS 3.1 | 2013 | modulacja **OFDM/OFDMA**, do 4096-QAM, kanały 24–192 MHz | do 10 Gb/s w dół, 1–2 Gb/s w górę |
| DOCSIS 4.0 | 2019 | tryb **Full Duplex** (FDX) i rozszerzone pasmo (do 1,8 GHz) | do 10 Gb/s w dół i kilka Gb/s w górę |

Ponieważ medium jest współdzielone, w kierunku „w górę" stosuje się mechanizm **rezerwacji** (modem żąda przydziału czasu od CMTS, która harmonogramuje dostęp — bez kolizji, w odróżnieniu od CSMA). Wadą HFC jest **lejek szumowy (noise funnel)**: szumy z wielu domów sumują się w kierunku „w górę", co wymaga starannej konserwacji sieci.

### 6.6. Dostęp światłowodowy: FTTx i PON

Światłowód dostępowy dociera coraz częściej do samego budynku lub mieszkania. Rozróżnia się:

* **FTTH (Fiber to the Home)** — światłowód do lokalu abonenta;
* **FTTB (Fiber to the Building)** — do budynku, dalej Ethernet lub G.fast w instalacji wewnętrznej;
* **FTTC / FTTN (to the Curb / Node)** — do szafy ulicznej, dalej VDSL2 po miedzi;
* **FTTdp (Distribution Point)** — do punktu bardzo blisko lokalu (G.fast).

#### Topologie: punkt–punkt i PON

Klasyczne łącza optyczne są **punkt–punkt**: osobne włókno od centrali do każdego abonenta (najlepsza przepustowość, wysoki koszt). Bardziej ekonomiczna jest **pasywna sieć optyczna (PON — Passive Optical Network)**, w której **jedno włókno z centrali** rozgałęzia się za pomocą **pasywnego (niezasilanego) rozgałęźnika optycznego (splitter)** do wielu abonentów (zazwyczaj 32 lub 64):

* **OLT (Optical Line Terminal)** — urządzenie w centrali;
* **splitter optyczny** — pasywny element, dzielący moc optyczną (bez zasilania, w szafce ulicznej lub w budynku);
* **ONT / ONU (Optical Network Terminal / Unit)** — zakończenie u abonenta.

Ponieważ splitter dzieli moc, wprowadza tłumienie zależne od stopnia podziału (orientacyjnie: 1:2 → ok. 3,5 dB, 1:8 → ok. 10,5 dB, 1:32 → ok. 17,5 dB, 1:64 → ok. 21 dB). Bilans mocy sieci PON ogranicza więc zasięg (zwykle do 20 km) i współczynnik podziału.

**Zasada działania.** W kierunku „w dół" OLT nadaje **ciągły strumień do wszystkich ONT** (broadcast, zwielokrotnienie czasowe TDM); każdy ONT odbiera wyłącznie własne dane (dane są szyfrowane AES dla poszczególnych abonentów). W kierunku „w górę" wszystkie ONT dzielą wspólne włókno w sposób **TDMA**: każdy ONT dostaje od OLT wąską szczelinę czasową na nadawanie; OLT mierzy odległość do każdego ONT (**ranging**), aby wyrównać czasy propagacji i uniknąć nakładania się transmisji. Kierunki „w dół" i „w górę" wykorzystują różne długości fali (WDM), dzięki czemu jedno włókno służy do transmisji w obu kierunkach.

| Standard | Organizacja | Przepływność w dół / w górę | Długości fali (dół / góra) |
|---|---|---|---|
| EPON | IEEE 802.3ah | 1 / 1 Gb/s | 1490 / 1310 nm |
| 10G-EPON | IEEE 802.3av | 10 / 1 lub 10 / 10 Gb/s | 1577 / 1270 nm |
| GPON | ITU-T G.984 | 2,488 / 1,244 Gb/s | 1490 / 1310 nm (wideo RF: 1550 nm) |
| XG-PON | ITU-T G.987 | 10 / 2,5 Gb/s | 1577 / 1270 nm |
| XGS-PON | ITU-T G.9807.1 | 10 / 10 Gb/s | 1577 / 1270 nm |
| NG-PON2 | ITU-T G.989 | 40 / 10 Gb/s (4 długości fali TWDM) | pasma L i C |
| 25GS-PON, 50G-PON | ITU-T G.9804 i inne | 25–50 Gb/s | rozwijane |

Zalety PON: oszczędność włókien i portów w centrali, brak zasilanej elektroniki w terenie (niższe koszty utrzymania i awaryjność), duże przepływności i długoterminowa skalowalność. Wady: współdzielenie przepustowości między abonentów przypisanych do jednego OLT/portu, konieczność dokładnego bilansu mocy, trudniejsza lokalizacja awarii.

### 6.7. Dostęp radiowy i satelitarny

* **Sieci komórkowe (LTE, 5G NR)** — dostęp mobilny i jako **FWA (Fixed Wireless Access)**: stacjonarny modem lub router z zewnętrzną anteną zastępuje łącze kablowe, szczególnie na obszarach bez światłowodu. Przepływności od kilkudziesięciu Mb/s (LTE) do kilkuset Mb/s i więcej (5G); pasmo współdzielone z innymi użytkownikami komórki, opóźnienie ok. 10–40 ms.
* **WISP (Wireless ISP)** — lokalni operatorzy internetowi wykorzystujący łącza radiowe (pasma 5 GHz, 24 GHz, 60 GHz) punkt–wielopunkt do dostarczania Internetu w gęsto zabudowanych obszarach lub na wsiach.
* **Satelitarny dostęp do Internetu.** Satelity **geostacjonarne (GEO)** na wysokości ok. 35 786 km mają duże opóźnienie propagacji: sygnał pokonuje drogę Ziemia → satelita → Ziemia w ok. 240 ms, czyli **RTT** wynosi ok. 500–600 ms, co utrudnia zastosowania interaktywne. Konstelacje na niskiej orbicie (**LEO**, ok. 500–1200 km) zmniejszają opóźnienie do kilkudziesięciu milisekund, ale wymagają dużej liczby satelitów i anten śledzących. Satelity zapewniają dostęp niemal wszędzie, z ograniczeniami pasma, wpływu pogody i zasięgu geograficznego.

### 6.8. Porównanie technologii dostępowych

| Technologia | Medium | Typowa przepływność | Charakter łącza | Główne ograniczenia |
|---|---|---|---|---|
| Dial-up (V.90/V.92) | skrętka telefoniczna | do 56 kb/s | komutowane | zajmuje linię, bardzo wolne |
| ISDN BRI | skrętka | 128 kb/s | komutowane, cyfrowe | przestarzały |
| ADSL / ADSL2+ | skrętka | 8–24 Mb/s | dedykowana pętla, asymetryczne | zasięg, tłumienie |
| VDSL2 (z vectoringiem) | skrętka | 50–200 Mb/s | dedykowana pętla | zasięg do ok. 1 km |
| G.fast | skrętka | do ok. 1 Gb/s | dedykowana pętla | zasięg 100–250 m |
| Kablowy DOCSIS 3.x | koncentryk (HFC) | 100 Mb/s – ponad 1 Gb/s | współdzielone | zmienność przy dużym obciążeniu węzła |
| FTTH (P2P / PON) | światłowód | 100 Mb/s – 10 Gb/s | punkt–punkt lub współdzielone (PON) | koszt budowy |
| LTE / 5G FWA | radio | 30 Mb/s – ponad 1 Gb/s | współdzielone | zmienne warunki propagacji |
| Satelita GEO | radio | 10–100 Mb/s | współdzielone | opóźnienie ok. 500–600 ms |
| Satelita LEO | radio | 50–300 Mb/s | współdzielone | koszt terminala, zmienność |

### 6.9. Sieci rozległe (WAN)

#### Definicja i cechy

**Sieć rozległa (WAN — Wide Area Network)** łączy sieci lokalne (LAN) znajdujące się w różnych miastach, krajach lub kontynentach. Jej charakterystyczną cechą jest to, że infrastruktura zwykle **nie należy do organizacji korzystającej z usługi**, lecz jest **dzierżawiona od operatorów telekomunikacyjnych**, którzy pobierają opłaty i gwarantują parametry usługi w umowie SLA.

| Cecha | LAN | WAN |
|---|---|---|
| Zasięg | budynek, kampus | miasto, kraj, świat |
| Właściciel infrastruktury | organizacja | operator telekomunikacyjny |
| Przepływność | zwykle 1–100 Gb/s | od kilkuset kb/s do setek Gb/s (zależnie od kosztu) |
| Koszt eksploatacji | niski | wysoki (opłaty za usługi) |
| Opóźnienie | mikrosekundy–milisekundy | milisekundy–setki milisekund |
| Typowe technologie | Ethernet, Wi-Fi | łącza dzierżawione, MPLS, Metro Ethernet, VPN, SD-WAN, SDH, DWDM |

#### Wybrane technologie łączy WAN

**Łącza dzierżawione (leased lines).** Stałe, dedykowane połączenie punkt–punkt o gwarantowanej przepustowości, dostępne przez cały czas. Klasyczne hierarchie **PDH**: **E1** (2,048 Mb/s; 32 szczeliny po 64 kb/s, 30 użytkowych + synchronizacja + sygnalizacja; standard europejski) i **T1** (1,544 Mb/s; 24 kanały; Ameryka Północna); wyższe rzędy: E3 (34,368 Mb/s), T3 (44,736 Mb/s). Nowsza hierarchia synchroniczna **SDH/SONET**: STM-1 (155,52 Mb/s), STM-4 (622,08 Mb/s), STM-16 (2,488 Gb/s), STM-64 (9,953 Gb/s). Dziś łącza dzierżawione realizowane są często jako usługi Ethernet lub wolne długości fal (DWDM) w sieci operatora.

**Komutacja łączy (circuit switching).** Dla czasu trwania rozmowy zestawiany jest dedykowany obwód (PSTN, ISDN). Zaleta: gwarantowana przepustowość i stałe opóźnienie. Wada: marnowanie zasobów przy ruchu nieregularnym (dane komputerowe).

**Komutacja pakietów (packet switching).** Dane dzielone są na pakiety przesyłane niezależnie, a łącza są współdzielone; wykorzystanie zasobów jest wydajne dla ruchu „impulsowego". Historyczne technologie: **X.25**, **Frame Relay** (obwody wirtualne identyfikowane przez DLCI), **ATM** (komórki 53 B, identyfikatory VPI/VCI). Ich rolę przejęły **IP/MPLS** i **Ethernet operatorski**.

**MPLS (Multiprotocol Label Switching).** Pakiety w sieci operatora otrzymują krótką **etykietę** (nagłówek 32 bity: 20-bitowa etykieta, 3 bity klasy ruchu, bit dna stosu, 8-bitowe TTL), na podstawie której routery (**LSR**) przełączają je szybko, bez pełnej analizy adresu IP; na brzegach sieci działają routery **LER**, dodające i usuwające etykiety. MPLS umożliwia:

* **VPN warstwy 3** (L3VPN) — izolowane wirtualne sieci IP klientów w jednej infrastrukturze operatora (osobne tablice routingu VRF);
* **VPN warstwy 2** (m.in. VPLS) — przezroczyste łączenie sieci Ethernet;
* **inżynierię ruchu i QoS** — ustalanie ścieżek i gwarancje jakości.

**Metro Ethernet / Carrier Ethernet.** Usługi Ethernetowe świadczone przez operatora w obszarze metropolitalnym i szerzej; standaryzowane przez organizację **MEF** jako **E-Line** (punkt–punkt), **E-LAN** (wielopunktowa, jak wirtualny przełącznik) i **E-Tree** (gwiazda). Klient widzi „kabel Ethernet" lub „przełącznik" rozciągnięty na wiele lokalizacji; w sieci operatora ruch klientów rozdzielają etykiety **Q-in-Q (802.1ad)** lub MPLS.

**VPN przez Internet.** Tania alternatywa dla łączy dzierżawionych: zaszyfrowane **tunele** przez publiczny Internet, np. **IPsec** (IKEv2 + ESP), **SSL/TLS VPN**, **WireGuard**. Zapewniają poufność i uwierzytelnienie, ale nie gwarantują jakości usług (opóźnień, utraty pakietów), ponieważ ruch przechodzi przez sieć „best effort".

**SD-WAN (Software-Defined WAN).** Rozwiązanie łączące wiele łączy (światłowodowe, kablowe, LTE/5G, MPLS) w jedną **nakładkę logiczną** (overlay) sterowaną centralnie. Kontroler dobiera ścieżkę dla aplikacji na podstawie bieżącej jakości łączy (opóźnienie, jitter, straty), zapewniając redundancję i optymalizację kosztów; tunele są szyfrowane, a konfiguracja nowych oddziałów może być zautomatyzowana (**zero-touch provisioning**).

#### Topologie WAN

![Topologie WAN: punkt–punkt, gwiazda (hub-and-spoke) i pełna siatka wraz ze wzorami na liczbę łączy](wan-topologie.svg)

* **Punkt–punkt** — jedno dedykowane łącze między dwiema lokalizacjami; proste, przewidywalne, lecz nieekonomiczne dla wielu lokalizacji.
* **Gwiazda (hub-and-spoke)** — oddziały łączą się z centralą; koszt rośnie liniowo (n − 1 łączy), ale ruch między oddziałami przechodzi przez centralę (dodatkowe opóźnienie), a centrala jest punktem awarii.
* **Pełna siatka (full mesh)** — każda lokalizacja połączona z każdą; największa niezawodność i najkrótsze ścieżki, ale liczba łączy rośnie kwadratowo: <span data-m="n(n-1)/2"></span> (dla 10 lokalizacji: 45 łączy).
* **Częściowa siatka (partial mesh)** — kompromis: łączone są tylko kluczowe lokalizacje.

#### Protokoły warstwy łącza w WAN

* **HDLC** (High-Level Data Link Control) — synchroniczny protokół ramkowania na łączach punkt–punkt; wersje producenckie (np. Cisco HDLC);
* **PPP (Point-to-Point Protocol, RFC 1661)** — uniwersalny protokół dla łączy punkt–punkt, składający się z: **LCP** (Link Control Protocol — negocjacja parametrów, uwierzytelnianie), protokołów uwierzytelniania **PAP** (hasło jawne, nie zalecany) i **CHAP** (wyzwanie–odpowiedź) oraz **NCP** (np. **IPCP** — konfiguracja adresu IP). PPP jest podstawą dostępu dial-up, DSL (w wariancie PPPoE/PPPoA) i wielu łączy szeregowych.

#### Parametry usług WAN i SLA

Przy wyborze usługi WAN porównuje się:

* **przepływność** (i **CIR — Committed Information Rate**, gwarantowaną część),
* **opóźnienie, jitter, utratę pakietów**,
* **dostępność** — np. 99,9 % oznacza do 8,76 godziny przestoju w roku, a 99,99 % — do ok. 53 minut,
* **czas usunięcia awarii (MTTR)**,
* **symetrię** i możliwość zwiększenia przepływności,
* **koszt** i model rozliczeń (łącze stałe vs zużycie),
* **zabezpieczenia** i sposób izolacji ruchu.

Umowa **SLA (Service Level Agreement)** określa gwarantowane wartości oraz rekompensaty w razie ich naruszenia.

### 6.10. Kierunki rozwoju

Można wskazać kilka trendów w mediach transmisyjnych i technologiach dostępowych:

* **Światłowód wszędzie**, gdzie to ekonomicznie uzasadnione — FTTH jako docelowy standard, PON o coraz wyższych przepływnościach (25G/50G);
* **Wygaszanie starych technologii** (ISDN, dial-up, część ADSL) i skracanie pętli miedzianych (FTTdp, G.fast);
* **Konwergencja Wi-Fi i sieci komórkowych** — Wi-Fi 7 i 5G jako uzupełniające się technologie, FWA jako alternatywa dla kabla;
* **Stałe zwiększanie wykorzystania widma** — pasmo 6 GHz, szersze kanały, wyższe modulacje, MLO;
* **Sieci definiowane programowo** — SD-WAN, automatyzacja i zarządzanie chmurowe;
* **IPv6** jako standard adresacji dla milionów urządzeń IoT dołączanych radiowo.

## 7. Podsumowanie

Media transmisyjne stanowią fundament, na którym opierają się wszystkie wyższe warstwy sieci. **Skrętka miedziana** dzięki niskim kosztom i możliwości zasilania (PoE) pozostaje podstawowym medium w sieciach lokalnych, jednak jej zasięg (100 m) i podatność na zakłócenia ograniczają zastosowania. **Światłowody** oferują praktycznie nieograniczone pasmo, ogromne zasięgi i odporność na zakłócenia, przez co stanowią podstawę sieci szkieletowych, centrów danych i dostępu FTTH. **Fale radiowe** zapewniają mobilność i elastyczność, ale wymagają dzielenia ograniczonego widma i zabezpieczenia transmisji.

Rodzina **IEEE 802.11** w ciągu ćwierćwiecza przebyła drogę od 2 Mb/s do ponad 46 Gb/s (teoretycznie) dzięki zastosowaniu OFDM, MIMO, szerszych kanałów, wyższych modulacji, OFDMA i wielołączowości (MLO). Jednocześnie — ze względu na mechanizm CSMA/CA i współdzielone medium — Wi-Fi pozostaje technologią, której rzeczywista przepustowość zależy od jakości sygnału, liczby użytkowników i interferencji.

**Technologie dostępowe** (DSL, kablowe, światłowodowe, radiowe, satelitarne) wykorzystują różne media i różne kompromisy między kosztem, przepływnością i zasięgiem, a **sieci WAN** łączą lokalizacje przy użyciu łączy dzierżawionych, MPLS, Metro Ethernet, VPN i coraz częściej SD-WAN.

### Zestawienie porównawcze najważniejszych technologii

| Technologia | Medium | Typowy zakres | Przepływność | Charakterystyczne cechy |
|---|---|---|---|---|
| Ethernet Cat 6A | skrętka | do 100 m | do 10 Gb/s | PoE, niski koszt, EMI |
| Ethernet SMF (LR) | światłowód jednomodowy | 10 km i więcej | 10–400 Gb/s | brak EMI, wysoki koszt terminali |
| Wi-Fi 6 / 6E | radio 2,4/5/6 GHz | kilkadziesiąt metrów w budynku | do 9,6 Gb/s (teoret.) | OFDMA, efektywność w gęstych sieciach |
| Wi-Fi 7 | radio 2,4/5/6 GHz | kilkadziesiąt metrów w budynku | do 46 Gb/s (teoret.) | MLO, 320 MHz, 4096-QAM |
| VDSL2 | miedź telefoniczna | do ok. 1 km | do 100–200 Mb/s | wykorzystuje istniejące łącza |
| DOCSIS 3.1 | koncentryk HFC | HFC | do 10 Gb/s | medium współdzielone |
| XGS-PON | światłowód (PON) | do 20 km | 10 / 10 Gb/s | pasywny rozgałęźnik |
| MPLS VPN / Metro Ethernet | infrastruktura operatora | kraj, region | zgodnie z umową | SLA, izolacja klientów |

## 8. Słownik podstawowych pojęć

| Pojęcie | Znaczenie |
|---|---|
| **AP (Access Point)** | punkt dostępowy łączący klientów Wi-Fi z siecią przewodową |
| **Backoff** | losowe opóźnienie przed próbą nadawania w CSMA/CA |
| **BSS / ESS** | pojedyncza komórka Wi-Fi / zbiór połączonych komórek o wspólnym SSID |
| **CCK, DSSS** | techniki rozpraszania widma stosowane w 802.11 i 802.11b |
| **CIR** | Committed Information Rate — gwarantowana przepływność usługi WAN |
| **CMTS** | urządzenie po stronie operatora w sieci kablowej |
| **CPE** | urządzenie po stronie abonenta |
| **DFS** | mechanizm ustępowania radarom w paśmie 5 GHz |
| **DMT** | modulacja wielotonowa stosowana w DSL |
| **DSLAM** | multiplekser DSL w centrali lub szafie ulicznej |
| **EIRP** | równoważna moc promieniowana izotropowo |
| **FSPL** | tłumienie w przestrzeni swobodnej |
| **MCS** | zestaw modulacji i kodowania w Wi-Fi |
| **MIMO / MU-MIMO** | wiele anten / wielu użytkowników jednocześnie |
| **MLO** | wielołączowość w Wi-Fi 7 |
| **NAV** | wirtualny licznik zajętości medium w Wi-Fi |
| **NEXT / FEXT** | przesłuch zbliżny / zdalny |
| **OFDM / OFDMA** | zwielokrotnienie z ortogonalnymi podnośnymi / jego wielodostępny wariant |
| **OLT / ONT** | zakończenie sieci PON po stronie operatora / abonenta |
| **PoE** | zasilanie urządzeń przez kabel Ethernet |
| **PON** | pasywna sieć optyczna |
| **RSSI** | wskaźnik mocy odbieranego sygnału |
| **SNR** | stosunek sygnału do szumu |
| **SSID** | nazwa sieci Wi-Fi |
| **WDM** | zwielokrotnienie falowe w światłowodzie |


## 9. Pytania kontrolne i zadania

### Pytania

1. Wyjaśnij, dlaczego skręcenie przewodów w parze i różnicowy sposób transmisji poprawiają odporność skrętki na zakłócenia. Do czego służą różne skoki skrętu poszczególnych par w kablu?
2. Opisz różnicę między kablem U/UTP, F/UTP i S/FTP. Jakich wymagań instalacyjnych wymaga stosowanie ekranowanych kabli?
3. Wyjaśnij, na czym polega zjawisko całkowitego wewnętrznego odbicia i jaką rolę odgrywają rdzeń i płaszcz światłowodu. Dlaczego różnica współczynników załamania jest bardzo mała?
4. Porównaj światłowody wielomodowe i jednomodowe pod względem średnicy rdzenia, dyspersji, zasięgu i zastosowań. Czym jest dyspersja modowa i jak łagodzi ją profil gradientowy?
5. Wyjaśnij, dlaczego tłumienie sygnału radiowego w wolnej przestrzeni rośnie wraz z częstotliwością i odległością. Jakie znaczenie ma to dla różnic w zasięgu Wi-Fi 2,4 GHz i 5 GHz?
6. Czym różni się modulacja 256-QAM od 4096-QAM pod względem liczby bitów na symbol i wymaganego SNR? Dlaczego wyższe modulacje wybierane są dopiero przy dobrym sygnale?
7. Wyjaśnij, dlaczego w sieciach Wi-Fi stosuje się CSMA/CA zamiast CSMA/CD. Na czym polegają problem ukrytej stacji i mechanizm RTS/CTS?
8. Wymień najważniejsze cechy standardów 802.11n, 802.11ac, 802.11ax i 802.11be oraz wskaż, które z nich dotyczą przede wszystkim wzrostu przepływności, a które — efektywności w gęstych sieciach.
9. Opisz architekturę dostępu ADSL: rolę splittera, DSLAM i BNG. Dlaczego prędkość DSL maleje wraz z długością pętli i jak działa modulacja DMT?
10. Porównaj technologie dostępowe DSL, DOCSIS i PON (w tym pod względem medium, współdzielenia pasma i przepływności) oraz wyjaśnij różnicę między łączem dzierżawionym, MPLS VPN i VPN przez Internet w kontekście sieci WAN.

### Zadania obliczeniowe

**Zadanie 1.** Oblicz teoretyczną przepływność warstwy fizycznej Wi-Fi 6 (802.11ax) przy kanale 160 MHz, dwóch strumieniach przestrzennych, modulacji 1024-QAM z kodowaniem 3/4 (MCS 10) i przedziale ochronnym 1,6 µs. (Wskazówka: 1960 podnośnych danych, symbol 12,8 µs + GI.)

**Zadanie 2.** Oblicz tłumienie w przestrzeni swobodnej (FSPL) na odległości 30 m dla częstotliwości 2450 MHz oraz 5500 MHz. Ile decybeli wynosi różnica?

**Zadanie 3.** Łącze jednomodowe o długości 12 km pracuje przy 1550 nm (tłumienność 0,22 dB/km). Zawiera 5 spawów po 0,08 dB oraz 2 pary złączy po 0,5 dB. Przyjęto margines 3 dB. Transceiver ma moc nadawczą −3 dBm i czułość odbiornika −18 dBm. Oblicz sumę strat i sprawdź, czy łącze zadziała.

**Zadanie 4.** Oblicz pojemność kanału Shannona dla szerokości pasma 20 MHz i SNR = 25 dB. Porównaj wynik z teoretyczną przepływnością Wi-Fi 4 (802.11n) 1×1 w kanale 20 MHz (72,2 Mb/s).

### Klucz odpowiedzi do zadań

**Zadanie 1.** Symbol: <span data-m="12{,}8 + 1{,}6 = 14{,}4"></span> µs. Na jeden strumień: <span data-m="1960 \\cdot 10 \\cdot 0{,}75 = 14\\,700"></span> bitów, czyli <span data-m="14\\,700 / 14{,}4\\ \\mu\\text{s} \\approx 1020{,}8"></span> Mb/s. Dla dwóch strumieni: **ok. 2041,7 Mb/s (ok. 2,04 Gb/s)**.

**Zadanie 2.** <span data-m="\\text{FSPL} = 20\\log_{10}(30) + 20\\log_{10}(f) - 27{,}55"></span>. Dla 2450 MHz: <span data-m="29{,}54 + 67{,}78 - 27{,}55 \\approx 69{,}8"></span> dB. Dla 5500 MHz: <span data-m="29{,}54 + 74{,}81 - 27{,}55 \\approx 76{,}8"></span> dB. Różnica wynosi **ok. 7,0 dB** (czyli <span data-m="20\\log_{10}(5500/2450)"></span>).

**Zadanie 3.** Straty: <span data-m="12 \\cdot 0{,}22 = 2{,}64"></span> dB (włókno) <span data-m="+ 5 \\cdot 0{,}08 = 0{,}4"></span> dB (spawy) <span data-m="+ 2 \\cdot 0{,}5 = 1{,}0"></span> dB (złącza) <span data-m="+ 3"></span> dB (margines) <span data-m="= \\mathbf{7{,}04}"></span> dB. Budżet: <span data-m="-3 - (-18) = 15"></span> dB. Rezerwa ponad zaplanowany margines to <span data-m="15 - 7{,}04 \\approx 7{,}96"></span> dB, więc **łącze zadziała z dużym zapasem**. (Uwaga: dla bardzo krótkich łączy problemem bywa nadmiar mocy, wymagający tłumika.)

**Zadanie 4.** SNR = 25 dB → 316,2 razy. <span data-m="C = 20\\cdot 10^6 \\cdot \\log_2(1 + 316{,}2) \\approx 20\\cdot 10^6 \\cdot 8{,}31 \\approx \\mathbf{166{,}2}"></span> Mb/s. Przepływność Wi-Fi 4 1×1 (72,2 Mb/s) stanowi około 43 % tej granicy — pokazuje to, że rzeczywiste systemy pracują poniżej granicy Shannona i że ich rozwój (wyższe modulacje, lepsze kodowanie, więcej strumieni MIMO) zmierza do jej przybliżania lub jej „obejścia" przez zwielokrotnienie kanałów przestrzennych.'
    ]
];
