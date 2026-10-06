<?php
return [
    '@class' => 'Grav\\Common\\File\\CompiledMarkdownFile',
    'filename' => '/var/www/html/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/docs.md',
    'modified' => 1791259902,
    'size' => 51169,
    'data' => [
        'header' => [
            'title' => 'Urządzenia warstwy dostępu do sieci',
            'published' => true
        ],
        'frontmatter' => 'title: \'Urządzenia warstwy dostępu do sieci\'
published: true',
        'markdown' => '# Koncentratory, mosty i przełączniki. Segmentacja, domeny kolizyjne i rozgłoszeniowe

## Wprowadzenie

Sieć lokalna nie jest jednorodną, niezróżnicowaną masą kabli — to zbiór urządzeń pośredniczących, z których każde odgrywa inną rolę w przekazywaniu sygnału i podejmowaniu decyzji o tym, dokąd ma trafić dana ramka. Historia rozwoju sieci Ethernet jest w dużej mierze historią stopniowego „mądrzenia się" tych urządzeń pośredniczących: od prostego wzmacniacza sygnału, przez urządzenie odczytujące adresy fizyczne i podejmujące decyzje przekazywania, aż po współczesny przełącznik zarządzalny, który potrafi tworzyć wirtualne sieci, ograniczać ruch rozgłoszeniowy i współpracować z routingiem.

Ten materiał koncentruje się na trzech klasach urządzeń warstwy dostępu — **koncentratorach (hubach)**, **mostach (bridge\'ach)** i **przełącznikach (switchach)** — oraz na dwóch pojęciach, które są kluczem do zrozumienia, dlaczego w ogóle segmentujemy sieci: **domenie kolizyjnej** i **domenie rozgłoszeniowej**. Zrozumienie tych pojęć pozwala świadomie projektować sieć: wiedzieć, gdzie umieścić przełącznik, kiedy sięgnąć po VLAN, a kiedy konieczny jest router.

---

## 1. Warstwa dostępu i hierarchia urządzeń sieciowych

### 1.1. Warstwa dostępu w projektowaniu sieci

W klasycznym, hierarchicznym modelu projektowania sieci kampusowych (popularyzowanym m.in. przez Cisco) wyróżnia się trzy warstwy:

* **warstwa dostępu (access layer)** — miejsce, w którym urządzenia końcowe (komputery, drukarki, telefony IP, punkty dostępowe Wi-Fi) fizycznie łączą się z siecią; tu pracują przełączniki dostępowe, tu podejmowane są pierwsze decyzje o przynależności do VLAN-u i tu egzekwowane są podstawowe zabezpieczenia portów;
* **warstwa dystrybucji (distribution layer)** — agreguje ruch z wielu przełączników dostępowych, realizuje routing między VLAN-ami, filtrację i politykę bezpieczeństwa;
* **warstwa rdzenia (core layer)** — szybkie przełączanie/routing dużych wolumenów ruchu między warstwami dystrybucji, bez zbędnej filtracji, aby zminimalizować opóźnienie.

Ten materiał dotyczy przede wszystkim urządzeń typowych dla warstwy dostępu i mechanizmów, które decydują o tym, jak duży fragment sieci „widzi" pojedyncza ramka — czy to unikatowa (unicast), czy rozgłoszeniowa (broadcast).

### 1.2. Urządzenia sieciowe według warstwy modelu OSI

Kluczem do zrozumienia różnic między hubem, mostem/przełącznikiem a routerem jest to, **w której warstwie modelu OSI dane urządzenie „czyta" informacje**, zanim podejmie decyzję o przekazaniu sygnału dalej:

| Urządzenie | Warstwa OSI | Na czym podejmuje decyzję | Co przekazuje |
|---|---|---|---|
| **Repeater / regenerator** | 1 (fizyczna) | brak decyzji — wzmacnia i retransmituje każdy sygnał | bity |
| **Koncentrator (hub)** | 1 (fizyczna) | brak decyzji — wieloportowy repeater | bity |
| **Most (bridge)** | 2 (łącza danych) | adres MAC docelowy | ramki |
| **Przełącznik (switch)** | 2 (łącza danych), niektóre modele także 3 | adres MAC docelowy (L2) lub adres IP (L3 switch) | ramki (lub pakiety w trybie L3) |
| **Router** | 3 (sieciowa) | adres IP docelowy i tablica routingu | pakiety |

Ta tabela jest mapą drogową całego materiału: im wyżej w modelu OSI urządzenie „patrzy" na dane, tym więcej inteligentnych decyzji może podjąć — kosztem większej złożoności i (nieco) większego opóźnienia przetwarzania.

---

## 2. Koncentratory (Hubs)

### 2.1. Definicja i zasada działania

**Koncentrator (hub)** to urządzenie warstwy fizycznej — w istocie **wieloportowy wzmacniacz sygnału (repeater)**. Hub nie analizuje żadnych nagłówków ramek, nie odczytuje adresów MAC, nie podejmuje żadnych decyzji o kierunku przekazania danych. Jego działanie sprowadza się do jednej, prostej operacji: **sygnał elektryczny, który dotrze na dowolny port, jest regenerowany (wzmacniany i „odświeżany" pod względem kształtu impulsów) i wysyłany jednocześnie na wszystkie pozostałe porty**.

Z perspektywy logiki sieciowej hub przekształca fizyczną topologię gwiazdy (kable biegnące do centralnego punktu) w **logiczną topologię magistrali (bus)** — działa dokładnie tak, jakby wszystkie podłączone urządzenia były spięte jednym wspólnym kablem koncentrycznym, tak jak w najwcześniejszych instalacjach Ethernetu (10BASE5, 10BASE2).

### 2.2. Konsekwencje braku inteligencji

Ponieważ hub powiela sygnał na wszystkie porty bez wyjątku, wynikają z tego poważne konsekwencje:

1. **Medium współdzielone (shared medium).** W danej chwili tylko jedno urządzenie podłączone do hub-a może nadawać, nie powodując kolizji. Wszystkie porty hub-a stanowią **jedną, wspólną domenę kolizyjną** — zagadnienie to rozwijamy szczegółowo w rozdziale 3.
2. **Praca wyłącznie w trybie Half-Duplex.** Skoro urządzenia współdzielą medium i muszą nasłuchiwać przed nadawaniem (CSMA/CD), transmisja nie może odbywać się jednocześnie w obu kierunkach na tym samym łączu — nadawanie i odbiór wykluczają się wzajemnie.
3. **Brak filtrowania ruchu.** Ramka wysłana przez PC-A do PC-B zostanie i tak dostarczona fizycznie do **wszystkich** pozostałych portów — PC-C i PC-D „usłyszą" tę transmisję, mimo że nie są jej adresatem; ich karty sieciowe po prostu odrzucą ramkę na podstawie niezgodnego adresu MAC docelowego, ale medium przez cały czas trwania tej transmisji jest zajęte dla wszystkich.
4. **Sumowanie się przepustowości.** Cała nominalna przepływność łącza (np. 10 lub 100 Mb/s) jest **dzielona między wszystkie podłączone urządzenia** — im więcej hostów na hub-ie, tym mniej pasma przypada statystycznie na każdego z nich, a rywalizacja o dostęp do medium (i liczba kolizji) rośnie.
5. **Brak wsparcia dla Gigabit Ethernet w praktyce.** Standard 1000BASE-T formalnie dopuszcza pracę Half-Duplex z repeaterem, ale w praktyce urządzenia takie nigdy nie zyskały popularności rynkowej — Gigabit Ethernet od początku projektowano z myślą o przełącznikach i pracy Full-Duplex.

![Koncentrator (hub) — cały segment sieci stanowi jedną, wspólną domenę kolizyjną](hub-domena-kolizyjna.svg)

### 2.3. Hub aktywny i pasywny

Rozróżnia się:

* **hub pasywny** — jedynie łączy elektrycznie przewody (bez wzmacniania sygnału); dziś praktycznie niespotykany, ograniczony do bardzo krótkich odległości;
* **hub aktywny** — regeneruje (wzmacnia i resynchronizuje) sygnał na każdym porcie, dzięki czemu można zachować pełną, dopuszczalną długość segmentów kablowych na każdym z odcinków.

### 2.4. Dlaczego huby zniknęły z nowoczesnych sieci

Wraz ze spadkiem cen układów scalonych realizujących przełączanie, **przełączniki stały się tańsze niż utrzymanie wydajności sieci opartej na hubach**, a jednocześnie oferowały wielokrotnie wyższą efektywną przepustowość (patrz rozdział 5). Dziś huby praktycznie zniknęły z produkcji i z nowych instalacji — spotyka się je niemal wyłącznie w kontekście edukacyjnym (do demonstrowania zjawiska kolizji) lub w wyspecjalizowanych zastosowaniach diagnostycznych (tzw. **network tap**, urządzenie do pasywnego podsłuchu ruchu na potrzeby analizatorów pakietów, gdzie celowo wykorzystuje się właściwość „powielania sygnału na wszystkie porty").

### 2.5. Zalety i wady koncentratorów

**Zalety (głównie historyczne):** bardzo niski koszt, prostota działania, brak opóźnienia przetwarzania (poza czasem propagacji sygnału i regeneracji), łatwość diagnostyki (cały ruch widoczny na każdym porcie).

**Wady:** jedna wspólna domena kolizyjna ograniczająca skalowalność, praca wyłącznie Half-Duplex, brak filtrowania ruchu (marnotrawstwo pasma), brak wsparcia dla VLAN-ów i jakichkolwiek mechanizmów bezpieczeństwa portów, ograniczona maksymalna liczba huby połączonych kaskadowo (tzw. **reguła 5-4-3** w 10 Mb/s Ethernet: maksymalnie 5 segmentów, 4 repeatery/huby, z czego tylko 3 segmenty obsadzone hostami — wynikająca z limitu czasowego działania CSMA/CD, patrz materiał o ramce Ethernet).

---

## 3. Domena kolizyjna

### 3.1. Definicja

**Domena kolizyjna (collision domain)** to obszar sieci, w którym **jednoczesna transmisja dwóch (lub więcej) urządzeń powoduje wzajemne zakłócenie (kolizję) ich sygnałów**. Innymi słowy — to zbiór urządzeń współdzielących jedno medium fizyczne na tyle blisko pod względem topologii, że ich sygnały elektryczne mogą się wzajemnie „zderzyć".

Domena kolizyjna jest ściśle związana z mechanizmem **CSMA/CD** (Carrier Sense Multiple Access with Collision Detection), stosowanym w klasycznych sieciach Ethernet pracujących w trybie Half-Duplex: stacja nasłuchuje medium przed nadawaniem, a jeśli mimo to dojdzie do jednoczesnej transmisji dwóch stacji, obie wykrywają kolizję, przerywają nadawanie, wysyłają sygnał zagłuszający (JAM) i po losowym czasie (algorytm Backoff) próbują ponownie.

### 3.2. Jak poszczególne urządzenia wpływają na rozmiar domeny kolizyjnej

| Urządzenie | Wpływ na domenę kolizyjną |
|---|---|
| Kabel koncentryczny (10BASE5/10BASE2) | wszystkie stacje na wspólnym kablu = jedna domena kolizyjna |
| Repeater / hub | **nie dzieli** domeny kolizyjnej — wszystkie połączone porty nadal stanowią jedną, wspólną domenę |
| Most / przełącznik | **dzieli** domenę kolizyjną — każdy port to osobna domena kolizyjna |
| Router | dzieli domenę kolizyjną (i dodatkowo domenę rozgłoszeniową) |

Ta różnica jest fundamentalna i tłumaczy, dlaczego przełącznik jest urządzeniem jakościowo innym niż hub, mimo pozornego podobieństwa (oba mają wiele portów RJ-45 i pośredniczą w komunikacji urządzeń w sieci lokalnej).

### 3.3. Konsekwencje wielkości domeny kolizyjnej

Im **większa** domena kolizyjna (więcej stacji współdzielących medium), tym:

* **więcej kolizji statystycznie** — prawdopodobieństwo, że dwie stacje zaczną nadawać niemal jednocześnie, rośnie z liczbą aktywnych urządzeń;
* **niższa efektywna przepustowość** — czas i pasmo „marnowane" na wykrywanie kolizji, wysyłanie sygnału JAM i odczekiwanie losowego czasu Backoff nie są dostępne dla użytecznej transmisji danych; przy silnym obciążeniu efektywne wykorzystanie łącza Half-Duplex w praktyce może spaść nawet do 30–40% nominalnej przepływności;
* **większe opóźnienie** — retransmisje po kolizji wydłużają czas dostarczenia danych, a przy wielu kolizjach z rzędu algorytm wykładniczego Backoff znacząco wydłuża oczekiwanie (patrz materiał o ramce Ethernet, rozdział o algorytmie Backoff).

### 3.4. Full-Duplex jako eliminacja kolizji

We współczesnych sieciach opartych na przełącznikach, w których każde urządzenie ma dedykowane, punkt-punktowe połączenie z portem przełącznika, a transmisja i odbiór odbywają się na osobnych parach przewodów (lub osobnych długościach fali w światłowodzie), możliwa jest praca w trybie **Full-Duplex**. W tym trybie **kolizje są fizycznie niemożliwe** — nie ma współdzielonego medium, na którym mogłyby wystąpić. Mechanizm CSMA/CD zostaje wtedy całkowicie wyłączony w mikrokodzie karty sieciowej i przełącznika.

Z formalnego punktu widzenia każdy port przełącznika pracującego Full-Duplex nadal „technicznie" stanowi osobną, jednoelementową domenę kolizyjną (zawiera dokładnie dwa urządzenia: kartę sieciową hosta i port przełącznika, połączone dedykowanym łączem) — ale ponieważ kolizja nie może w niej fizycznie zajść, pojęcie to traci praktyczne znaczenie diagnostyczne we współczesnych, w pełni przełączanych sieciach.

![Przełącznik — każdy port stanowi osobną, mikroskopijną domenę kolizyjną; przy Full-Duplex kolizje są fizycznie niemożliwe](switch-domeny-kolizyjne.svg)

### 3.5. Jak sprawdzić granice domeny kolizyjnej w praktyce

Praktyczną wskazówką jest pytanie: *„Gdyby dwa urządzenia w tym obszarze nadały jednocześnie, czy ich sygnały zderzyłyby się fizycznie?"* Jeśli odpowiedź brzmi „tak" — znajdują się w tej samej domenie kolizyjnej. Diagnostycznie w systemie Linux rosnący licznik kolizji (`collisions`) w statystykach interfejsu pracującego w trybie Half-Duplex sygnalizuje przeciążoną lub zbyt rozległą domenę kolizyjną; we współczesnych sieciach Full-Duplex licznik ten **powinien pozostawać zerowy** — jego wzrost wskazuje zwykle na błąd konfiguracji (tzw. **duplex mismatch** — niezgodność ustawień dupleksu między dwoma końcami łącza).

---
## 4. Mosty (Bridges)

### 4.1. Geneza i motywacja

Wraz z rozrostem wczesnych sieci Ethernet opartych na wspólnym medium (kablu koncentrycznym, a później hub-ach) administratorzy napotykali twardą barierę: powiększanie jednej, wspólnej domeny kolizyjnej ponad pewien rozmiar prowadziło do lawinowego wzrostu liczby kolizji i drastycznego spadku efektywnej przepustowości. Rozwiązaniem okazało się urządzenie, które — w przeciwieństwie do repeatera/hub-a — **odczytuje adresy MAC** zawarte w ramkach i **podejmuje decyzję**, czy dana ramka rzeczywiście musi zostać przekazana do drugiego segmentu sieci, czy też jej odbiorca znajduje się już w tym samym segmencie, z którego nadeszła (a więc przekazywanie byłoby zbędne). Takie urządzenie nazwano **mostem (bridge)**.

### 4.2. Definicja i zasada działania

**Most (bridge)** to urządzenie warstwy 2 modelu OSI, łączące dwa (lub więcej) segmenty sieci w taki sposób, że:

* **odczytuje adres MAC źródłowy i docelowy** każdej odbieranej ramki,
* **buduje i utrzymuje tablicę adresów MAC** widzianych na poszczególnych swoich portach (interfejsach),
* na tej podstawie **podejmuje decyzję**: przekazać ramkę na drugi segment, czy odrzucić ją (bo odbiorca znajduje się w tym samym segmencie, z którego ramka nadeszła — nie ma potrzeby jej powielania).

Most **dzieli domenę kolizyjną** — segmenty po obu jego stronach stanowią osobne domeny kolizyjne — ale **nie dzieli domeny rozgłoszeniowej**: ramka rozgłoszeniowa (broadcast) jest zawsze przekazywana przez most na wszystkie pozostałe segmenty, ponieważ z definicji jest ona adresowana do wszystkich.

### 4.3. Algorytm mostkowania przezroczystego (Transparent Bridging)

Najpowszechniej stosowanym algorytmem pracy mostu (i, jak zobaczymy w rozdziale 5, także przełącznika) jest **mostkowanie przezroczyste (transparent bridging)**, opisane w standardzie **IEEE 802.1D**. Nazwa „przezroczyste" oznacza, że urządzenia końcowe **nie muszą wiedzieć o istnieniu mostu** — działa on w pełni automatycznie, bez konieczności ręcznej konfiguracji tablic adresowych. Algorytm opiera się na czterech mechanizmach.

#### a) Uczenie się (Learning)

Dla każdej odbieranej ramki most odczytuje **adres MAC źródłowy** oraz **numer portu**, na którym ramka dotarła, i zapisuje tę parę (adres MAC → port) w swojej tablicy adresów. W ten sposób most stopniowo, w sposób całkowicie automatyczny, „uczy się" topologii sieci — po jakimś czasie zna lokalizację (port) każdego aktywnego urządzenia w sieci.

#### b) Przekazywanie i filtrowanie (Forwarding / Filtering)

Dla adresu MAC **docelowego** odbieranej ramki most sprawdza swoją tablicę:

* jeśli adres docelowy jest **znany** i znajduje się na **innym** porcie niż ten, z którego nadeszła ramka — most **przekazuje** ramkę wyłącznie na ten jeden, właściwy port (**forwarding**);
* jeśli adres docelowy jest **znany** i znajduje się na **tym samym** porcie, z którego nadeszła ramka — oznacza to, że nadawca i odbiorca są w tym samym segmencie, a most **odrzuca** ramkę, nie przekazując jej dalej (**filtering**); to właśnie ten mechanizm odciąża ruch między segmentami;
* jeśli adres docelowy jest **nieznany** (brak wpisu w tablicy) — most przekazuje ramkę na **wszystkie** porty poza tym, z którego nadeszła (**flooding**, zalewanie) — to jedyny bezpieczny sposób, by mieć pewność, że ramka dotrze do adresata, którego lokalizacja nie jest jeszcze znana;
* jeśli adres docelowy jest **rozgłoszeniowy** (`FF:FF:FF:FF:FF:FF`) lub grupowy (multicast) — most zawsze przekazuje ramkę na wszystkie porty poza portem źródłowym.

#### c) Starzenie się wpisów (Aging)

Każdy wpis w tablicy adresów MAC opatrzony jest znacznikiem czasu. Jeśli przez określony czas (domyślnie zwykle **300 sekund**) most nie zaobserwuje żadnej ramki z danym adresem źródłowym na zapisanym porcie, wpis jest **usuwany**. Mechanizm ten pozwala sieci dostosować się do zmian topologii — np. przeniesienia urządzenia do innego portu lub jego odłączenia — bez ręcznej interwencji administratora, kosztem tego, że pierwsza ramka do „zapomnianego" adresu ponownie wywoła zalewanie.

#### d) Zalewanie (Flooding) dla nieznanych adresów

Jak wspomniano w punkcie b), zalewanie jest mechanizmem awaryjnym stosowanym zawsze, gdy most nie ma jeszcze wiedzy o lokalizacji odbiorcy. W dużych, aktywnych sieciach zalewanie występuje relatywnie rzadko po początkowym okresie „uczenia się", ale w sieciach o dużej liczbie rzadko komunikujących się urządzeń (np. gdy wpisy wygasają między kolejnymi transmisjami) może stanowić zauważalny narzut.

### 4.4. Most a problem pętli — wprowadzenie do STP

Jeśli w sieci istnieją **dwa lub więcej mostów (lub przełączników) połączonych w taki sposób, że tworzą fizyczną pętlę** (np. dla redundancji, na wypadek awarii jednego łącza), mechanizm zalewania nieznanych adresów i ramek rozgłoszeniowych prowadzi do katastrofalnego zjawiska zwanego **burzą rozgłoszeniową (broadcast storm)**: ta sama ramka rozgłoszeniowa krąży w pętli w nieskończoność, a każdy most/przełącznik na jej drodze wciąż ją powiela na wszystkie porty, mnożąc ruch wykładniczo, aż do całkowitego zapchania sieci.

Rozwiązaniem tego problemu jest protokół **STP (Spanning Tree Protocol, IEEE 802.1D)**, który automatycznie wykrywa pętle w topologii i **blokuje logicznie nadmiarowe łącza** (przechodzą one w stan blokowania, nie przekazując ruchu użytkownika, ale pozostając aktywnymi „w rezerwie"), tworząc na potrzeby przekazywania ramek drzewo rozpinające bez pętli (stąd nazwa — *spanning tree*, drzewo rozpinające). Gdy aktywne łącze ulegnie awarii, STP automatycznie przelicza topologię i aktywuje wcześniej zablokowane łącze zapasowe. Zagadnienie STP i jego następców (RSTP, MSTP) jest na tyle obszerne, że zasługuje na osobne, szczegółowe opracowanie — w tym materiale sygnalizujemy je jedynie jako niezbędny kontekst do zrozumienia, dlaczego mosty/przełączniki nie mogą być łączone w dowolne pętle bez dodatkowych mechanizmów zabezpieczających.

### 4.5. Rodzaje mostów (nota historyczna)

W literaturze rozróżnia się kilka odmian mostów, choć w praktyce współczesnych sieci Ethernet dominuje transparent bridging:

* **mosty przezroczyste (transparent bridges)** — opisany wyżej, dominujący w sieciach Ethernet;
* **mosty ze źródłowym trasowaniem (source-route bridging)** — stosowane historycznie w sieciach Token Ring, gdzie to stacja nadawcza (a nie most) decydowała o trasie ramki na podstawie informacji zebranej wcześniej przez specjalne ramki odkrywające; dziś praktycznie nieużywane wraz z zanikiem Token Ring;
* **mosty translacyjne (translational bridges)** — łączące segmenty o różnych technologiach warstwy 2 (np. Ethernet i Token Ring), wymagające przekształcenia formatu ramki.

### 4.6. Most a przełącznik — czy to to samo?

Koncepcyjnie **przełącznik jest bezpośrednim, sprzętowo zoptymalizowanym następcą mostu** — realizuje dokładnie ten sam algorytm transparent bridging (uczenie się, przekazywanie/filtrowanie, starzenie, zalewanie), lecz różni się przede wszystkim:

* **implementacją** — most tradycyjnie był urządzeniem programowym, realizującym przełączanie w oprogramowaniu na ogólnego przeznaczenia procesorze, obsługującym zwykle niewiele portów (2–4); przełącznik realizuje te same decyzje sprzętowo, w dedykowanych układach ASIC, co pozwala obsługiwać dziesiątki lub setki portów z pełną prędkością łącza jednocześnie (tzw. przełączanie **non-blocking**, z przepustowością macierzy przełączającej — *switching fabric* — wystarczającą, by obsłużyć ruch na wszystkich portach jednocześnie bez utraty wydajności);
* **liczbą portów** — klasyczny most miał zwykle 2–4 porty, łącząc niewielką liczbę segmentów; przełącznik ma zazwyczaj kilkanaście do kilkudziesięciu portów, a każdy z nich traktowany jest de facto jako osobny, jednoportowy „segment" mostkowany;
* **terminologią rynkową** — w praktyce od końca lat 90. XX wieku termin „przełącznik" niemal całkowicie wyparł w kontekście Ethernetu termin „most", choć formalnie w wielu standardach (w tym w nazwach protokołów, np. *Spanning Tree Protocol* działa na urządzeniach nazywanych w dokumentach IEEE „bridges") stara terminologia przetrwała.

Można zatem powiedzieć: **każdy przełącznik Ethernet jest, z technicznego punktu widzenia, wieloportowym mostem** — a rozróżnienie „most vs przełącznik" ma dziś głównie znaczenie historyczne i edukacyjne, pomocne w zrozumieniu ewolucji urządzeń warstwy 2.

---
## 5. Przełączniki (Switches)

### 5.1. Przełącznik jako sprzętowa realizacja mostkowania

**Przełącznik (switch)** to urządzenie warstwy 2 modelu OSI, realizujące algorytm transparent bridging (opisany w rozdziale 4) w dedykowanym sprzęcie (układach ASIC — Application-Specific Integrated Circuit), co pozwala na podejmowanie decyzji o przekazywaniu ramek z prędkością liniową (*wire speed*) na wielu portach jednocześnie, bez zauważalnego opóźnienia przetwarzania. To właśnie przełącznik jest dziś absolutnie podstawowym, wszechobecnym urządzeniem każdej przewodowej sieci lokalnej.

### 5.2. Tablica adresów MAC (CAM)

Sercem działania przełącznika jest **tablica adresów MAC**, często określana skrótem **CAM** (Content-Addressable Memory) — od typu pamięci sprzętowej, w której jest fizycznie zaimplementowana. Pamięć CAM pozwala na **wyszukiwanie skojarzone z zawartością** (podanie adresu MAC jako klucza zwraca natychmiast numer portu) w czasie stałym, niezależnym od liczby wpisów — co jest kluczowe dla zachowania prędkości liniowej przy tysiącach wpisów.

Każdy wpis w tablicy CAM zawiera typowo:

* **adres MAC** urządzenia,
* **numer portu**, na którym to urządzenie zostało zaobserwowane,
* **identyfikator VLAN**, do którego należy dany wpis (we współczesnych przełącznikach zarządzalnych, patrz rozdział 5.6),
* **znacznik czasu** (do mechanizmu starzenia się wpisów).

![Proces uczenia się adresów MAC przez przełącznik i podejmowania decyzji o przekazaniu lub zalaniu ramki](przelacznik-tablica-mac.svg)

### 5.3. Metody przełączania

Producenci przełączników stosują kilka odmiennych strategii dotyczących tego, **w którym momencie odbioru ramki przełącznik rozpoczyna jej retransmisję** na port docelowy. Wybór strategii to kompromis między **opóźnieniem** a **niezawodnością** (unikaniem przekazywania uszkodzonych ramek).

#### Store-and-Forward (składuj i przekaż)

Przełącznik **odbiera całą ramkę w buforze**, oblicza i weryfikuje sumę kontrolną **FCS (CRC-32)**, i dopiero po potwierdzeniu, że ramka jest bezbłędna, rozpoczyna jej przekazywanie na port docelowy. Jest to metoda **najbezpieczniejsza** — uszkodzone ramki są odrzucane i nigdy nie trafiają dalej do sieci — kosztem **największego opóźnienia**, proporcjonalnego do długości ramki (im dłuższa ramka, tym dłużej trzeba czekać na jej pełne odebranie przed retransmisją). Metoda ta dominuje we współczesnych przełącznikach, ponieważ dodatkowe opóźnienie (rzędu mikrosekund przy typowych prędkościach łączy) jest w praktyce pomijalne, a korzyści w postaci niefiltrowania uszkodzonych ramek — istotne. Store-and-Forward jest też jedyną metodą pozwalającą na **łączenie portów o różnych prędkościach** (np. port 1 Gb/s przekazujący do portu 100 Mb/s) — bez pełnego buforowania ramki nie da się bezpiecznie dopasować różnych szybkości transmisji.

#### Cut-Through (przelotowe)

Przełącznik zaczyna retransmisję ramki **natychmiast po odczytaniu adresu MAC docelowego** — czyli już po odebraniu pierwszych ok. 14 bajtów ramki (pola: adres docelowy i częściowo adres źródłowy) — bez czekania na resztę danych ani na weryfikację sumy FCS. Zapewnia to **minimalne możliwe opóźnienie**, kosztem ryzyka przekazania dalej uszkodzonej ramki (błąd zostanie wykryty dopiero przez kartę sieciową odbiorcy końcowego, na podstawie FCS, i ramka zostanie tam odrzucona — ale zdążyła już zająć pasmo w dalszej części sieci).

#### Fragment-Free (bez fragmentów)

Rozwiązanie pośrednie: przełącznik odczekuje na odebranie pierwszych **64 bajtów** ramki przed rozpoczęciem retransmisji. Wartość 64 bajtów nie jest przypadkowa — to dokładnie minimalny dopuszczalny rozmiar poprawnej ramki Ethernet (patrz materiał o strukturze ramki Ethernet, rozdział o minimalnym rozmiarze ramki). Większość uszkodzeń powstałych na skutek kolizji w sieciach Half-Duplex objawia się jako tzw. **fragmenty kolizyjne (collision fragments)** — ramki krótsze niż 64 bajty. Odczekanie na pierwsze 64 bajty pozwala odfiltrować niemal wszystkie tego typu uszkodzone fragmenty, przy opóźnieniu znacznie mniejszym niż pełny Store-and-Forward.

![Porównanie momentu rozpoczęcia retransmisji ramki: Store-and-Forward, Cut-Through i Fragment-Free](metody-przelaczania-switch.svg)

| Metoda | Moment rozpoczęcia przekazywania | Opóźnienie | Filtrowanie błędów | Uwagi |
|---|---|---|---|---|
| Store-and-Forward | po odebraniu całej ramki i weryfikacji FCS | największe (zależne od długości ramki) | pełne | jedyna metoda umożliwiająca zmianę prędkości portów; dominująca dziś |
| Cut-Through | po odczytaniu adresu MAC docelowego (~14 B) | minimalne, stałe | brak | ryzyko przekazania uszkodzonej ramki dalej |
| Fragment-Free | po odebraniu pierwszych 64 B | pośrednie | częściowe (odrzuca fragmenty kolizyjne) | kompromis między szybkością a bezpieczeństwem |

W praktyce współczesnych, w pełni przełączanych sieci Full-Duplex (gdzie fragmenty kolizyjne w ogóle nie powstają, bo kolizji nie ma) różnica między metodami traci część swojego pierwotnego uzasadnienia, a wiele nowoczesnych przełączników stosuje **adaptacyjne** podejście — działa w trybie cut-through, dopóki na danym porcie licznik błędów FCS pozostaje niski, i automatycznie przełącza się na store-and-forward, jeśli wykryje podwyższony poziom błędów.

### 5.4. Przełącznik a duplex i autonegocjacja

Nowoczesne przełączniki pracują niemal wyłącznie w trybie **Full-Duplex** na łączach point-to-point z każdym urządzeniem końcowym. Zgodność prędkości i trybu dupleksu między portem przełącznika a kartą sieciową urządzenia ustalana jest automatycznie przez mechanizm **autonegocjacji (IEEE 802.3 Clause 28)** — obie strony łącza wymieniają informacje o swoich możliwościach (obsługiwane prędkości, tryby dupleksu) i wybierają najlepszy wspólny mianownik. Ręczne, sztywne (ang. *hard-coded*) ustawienie prędkości/dupleksu tylko po jednej stronie łącza jest klasyczną przyczyną błędu **duplex mismatch**: jedna strona pracuje Full-Duplex, druga Half-Duplex, co objawia się dużą liczbą błędów CRC i pozornych „kolizji" (rejestrowanych przez stronę Half-Duplex, mimo że w rzeczywistości drugie urządzenie po prostu nadaje i odbiera jednocześnie, co strona Half-Duplex błędnie interpretuje jako kolizję).

### 5.5. Rodzaje przełączników

| Kryterium | Kategorie |
|---|---|
| Zarządzalność | **niezarządzalne** (plug-and-play, bez konfiguracji, typowe w małych sieciach domowych) / **zarządzalne** (konfiguracja VLAN-ów, STP, QoS, SNMP, zwykle przez interfejs webowy, CLI lub protokoły zarządzania) |
| Warstwa działania | **L2** (czysto adresy MAC) / **L3 (multilayer switch)** — potrafi dodatkowo routing między VLAN-ami na podstawie adresów IP, łącząc funkcje przełącznika i routera w jednym urządzeniu sprzętowym |
| Forma fizyczna | **stałej konfiguracji (fixed configuration)** — ustalona liczba portów / **modularne (chassis-based)** — z wymiennymi kartami liniowymi, stosowane w dużych sieciach szkieletowych i centrach danych |
| Przeznaczenie | **dostępowe** (access) — obsługa urządzeń końcowych / **agregujące/dystrybucyjne** / **rdzeniowe (core)** — bardzo wysoka przepustowość macierzy przełączającej |
| Zasilanie portów | z **PoE/PoE+/PoE++** (zasilanie urządzeń końcowych, patrz materiał o skrętce miedzianej) lub bez |

### 5.6. Wprowadzenie do VLAN — zapowiedź segmentacji logicznej

Zarządzalne przełączniki umożliwiają podział pojedynczego urządzenia fizycznego na wiele **wirtualnych sieci lokalnych (VLAN — Virtual LAN, IEEE 802.1Q)**. Każdy port przełącznika przypisywany jest do określonego VLAN-u (lub, w trybie *trunk*, przenosi ruch wielu VLAN-ów jednocześnie, ze znacznikami 802.1Q w nagłówku ramki). Urządzenia w różnych VLAN-ach, nawet podłączone do tego samego przełącznika fizycznego, **znajdują się w osobnych domenach rozgłoszeniowych** i nie mogą się ze sobą komunikować bez pośrednictwa routera lub przełącznika warstwy 3. VLAN-y są jednym z głównych narzędzi **segmentacji logicznej** sieci, omówionej szczegółowo w rozdziale 7 — tu sygnalizujemy je jedynie jako naturalne rozszerzenie możliwości przełącznika, wykraczające poza podstawowy mechanizm mostkowania przezroczystego.

### 5.7. Zalety przełączników względem koncentratorów

Podsumowując rozdziały 2–5, przejście od koncentratorów do przełączników przyniosło sieciom lokalnym:

* **mikrosegmentację** — każdy port to osobna domena kolizyjna, praktycznie eliminująca kolizje przy Full-Duplex;
* **pełne wykorzystanie nominalnej przepływności** na każdym porcie jednocześnie (agregowana przepustowość przełącznika 24-portowego 1 Gb/s Full-Duplex może w teorii wynieść nawet 48 Gb/s w obu kierunkach łącznie, o ile macierz przełączająca jest non-blocking);
* **filtrowanie ruchu** — ramki nie są niepotrzebnie powielane do segmentów, w których odbiorca nie występuje;
* **bezpieczeństwo** — ruch unicastowy między dwoma hostami nie jest fizycznie widoczny na pozostałych portach (utrudnia to prosty podsłuch, choć nie eliminuje go całkowicie — istnieją techniki ataku, jak zatruwanie tablicy CAM czy ataki ARP spoofing, wykraczające poza zakres tego materiału);
* **elastyczność logicznej segmentacji** dzięki VLAN-om;
* **wsparcie dla zaawansowanych mechanizmów** — QoS (priorytetyzacja ruchu), STP/RSTP (bezpieczna redundancja), Link Aggregation (łączenie wielu fizycznych portów w jedno logiczne łącze o zsumowanej przepustowości), zabezpieczenia portów (np. ograniczenie liczby adresów MAC na porcie, uwierzytelnianie 802.1X).

---
## 6. Domena rozgłoszeniowa

### 6.1. Definicja

**Domena rozgłoszeniowa (broadcast domain)** to obszar sieci, do którego dociera ramka **rozgłoszeniowa (broadcast)** — wysłana na adres MAC `FF:FF:FF:FF:FF:FF` — wysłana przez dowolne urządzenie w tym obszarze. Innymi słowy: zbiór wszystkich urządzeń, które „usłyszą" broadcast nadany przez którekolwiek z nich, bez pośrednictwa routingu.

To pojęcie jest fundamentalnie różne od domeny kolizyjnej, mimo że oba terminy bywają mylone przez początkujących. Kluczowa różnica ujęta jest w poniższej zasadzie:

> **Most i przełącznik DZIELĄ domeny kolizyjne, ale NIE DZIELĄ domeny rozgłoszeniowej. Tylko router (lub logiczny podział na VLAN-y wraz z routingiem między nimi) dzieli domenę rozgłoszeniową.**

Wynika to wprost z algorytmu transparent bridging opisanego w rozdziale 4: ramka rozgłoszeniowa jest przez most/przełącznik **zawsze** przekazywana na wszystkie porty poza źródłowym — nie istnieje żaden mechanizm w warstwie 2, który filtrowałby broadcast na podstawie adresu docelowego (bo adres `FF:FF:FF:FF:FF:FF` z definicji oznacza „wszyscy").

### 6.2. Dlaczego ramki rozgłoszeniowe są potrzebne

Zanim potraktujemy broadcast jako wyłącznie problem, warto przypomnieć, że pełni on **niezbędną funkcję**. Klasyczny przykład to protokół **ARP (Address Resolution Protocol)**: gdy komputer zna adres IP docelowy, ale nie zna odpowiadającego mu adresu MAC (niezbędnego do zbudowania nagłówka ramki Ethernet), wysyła **zapytanie ARP jako broadcast** — „kto ma adres IP X.X.X.X, proszę o odpowiedź ze swoim adresem MAC". Ponieważ nadawca nie wie jeszcze, gdzie znajduje się odbiorca, jedynym sposobem dotarcia do niego jest wysłanie zapytania do wszystkich urządzeń w segmencie. Innymi typowymi źródłami ruchu rozgłoszeniowego są: zapytania **DHCP Discover** (urządzenie szukające serwera DHCP), niektóre protokoły odkrywania usług, stare protokoły routingu (np. RIPv1), czy powiadomienia Wake-on-LAN.

### 6.3. Problem nadmiaru ruchu rozgłoszeniowego

Skoro broadcast dociera do **każdego** urządzenia w domenie rozgłoszeniowej, a każde urządzenie musi go choćby przetworzyć (odebrać przerwanie, sprawdzić nagłówek, ewentualnie przekazać do wyższych warstw stosu), zbyt duża domena rozgłoszeniowa prowadzi do zjawiska określanego jako **broadcast radiation** (promieniowanie rozgłoszeniowe) — narastającej ilości ruchu broadcastowego, który zajmuje pasmo i moc obliczeniową procesorów wszystkich podłączonych urządzeń, nawet jeśli nie są one bezpośrednim adresatem konkretnej transmisji. W skrajnym przypadku — połączonym zwykle z błędem konfiguracji sieci (pętlą bez STP) — dochodzi do wspomnianej w rozdziale 4.4 **burzy rozgłoszeniowej**, praktycznie paraliżującej całą sieć.

Z tego powodu **nie istnieje jeden „idealny" rozmiar domeny rozgłoszeniowej** — jest to kompromis, który administrator musi świadomie podejmować, uwzględniając liczbę urządzeń, charakter generowanego przez nie ruchu rozgłoszeniowego i wymagania dotyczące komunikacji między nimi. W praktyce orientacyjnie przyjmuje się, że domena rozgłoszeniowa licząca więcej niż kilkaset (typowo 200–500) aktywnych hostów zaczyna generować zauważalny narzut ruchu rozgłoszeniowego, choć dokładna granica silnie zależy od profilu aplikacji pracujących w sieci.

### 6.4. Wizualizacja: domeny kolizyjne i rozgłoszeniowe razem

Poniższy schemat zestawia oba pojęcia w jednej, złożonej topologii, łączącej hub, dwa przełączniki i router — dokładnie tak, jak mogłyby współistnieć w realnej, choć uproszczonej, sieci.

![Domeny kolizyjne i rozgłoszeniowe w sieci z hubem, przełącznikami i routerem — router dzieli sieć na dwie domeny rozgłoszeniowe, a w ich obrębie przełączniki tworzą osobne mikrodomeny kolizyjne](domeny-topologia.svg)

Kluczowe wnioski płynące z powyższego schematu:

* **Liczba domen kolizyjnych** w sieci z przełącznikami pracującymi Full-Duplex jest w praktyce równa **liczbie aktywnych portów przełączników** (każdy host na dedykowanym łączu = jedna mikrodomena) plus, jeśli występuje, liczba hub-ów (każdy hub, niezależnie od liczby podłączonych do niego hostów, to zawsze dokładnie **jedna** domena kolizyjna obejmująca wszystkie jego porty).
* **Liczba domen rozgłoszeniowych** jest równa liczbie interfejsów routera (lub, przy zastosowaniu VLAN-ów, liczbie skonfigurowanych sieci VLAN, z których każda wymaga własnego interfejsu routingu, aby komunikować się z pozostałymi).
* Ramka rozgłoszeniowa nadana przez PC1 dotrze do PC2, PC3, PC4 i PC5 (cała domena rozgłoszeniowa A), ale **nigdy** nie dotrze do PC6, PC7 ani PC8 (domena rozgłoszeniowa B) — router z definicji nie przekazuje ruchu rozgłoszeniowego między swoimi interfejsami (każdy interfejs routera stanowi granicę domeny rozgłoszeniowej).

### 6.5. Tabela porównawcza: domena kolizyjna vs domena rozgłoszeniowa

| Cecha | Domena kolizyjna | Domena rozgłoszeniowa |
|---|---|---|
| Definicja | obszar, w którym jednoczesna transmisja powoduje zderzenie sygnałów | obszar, do którego dociera ramka broadcast |
| Warstwa OSI, której dotyczy | 1 (fizyczna) | 2 (łącza danych) |
| Co ją dzieli | most, przełącznik, router | **wyłącznie** router (lub VLAN + routing między VLAN-ami) |
| Co NIE dzieli | hub/repeater (nie dzieli w ogóle) | hub, most, przełącznik (żadne z nich nie dzieli) |
| Typowy dziś rozmiar we w pełni przełączanej sieci Full-Duplex | 1 host na port (praktycznie nieistotna) | zależny od liczby VLAN-ów/interfejsów routingu |
| Główne zagrożenie przy nadmiernym rozmiarze | lawinowy wzrost liczby kolizji, spadek przepustowości (dotyczy głównie Half-Duplex) | nadmiar ruchu rozgłoszeniowego, ryzyko burzy rozgłoszeniowej |

---

## 7. Segmentacja sieci

### 7.1. Po co segmentować sieć

**Segmentacja sieci** to celowy podział większej sieci na mniejsze, logicznie lub fizycznie odseparowane fragmenty. Motywacje są liczne i częściowo się przenikają:

* **Ograniczenie rozmiaru domen kolizyjnych** — dziś w dużej mierze zagadnienie historyczne, rozwiązane przez powszechne przejście na przełączniki Full-Duplex (rozdział 3.4), ale wciąż istotne tam, gdzie z jakiegoś powodu funkcjonują urządzenia Half-Duplex.
* **Ograniczenie rozmiaru domen rozgłoszeniowych** — kluczowy, wciąż aktualny powód segmentacji, realizowany przez routing i/lub VLAN-y.
* **Bezpieczeństwo** — odseparowanie ruchu wrażliwego (np. sieci zarządzania urządzeniami sieciowymi, systemów finansowo-księgowych) od ruchu ogólnego, ograniczenie zasięgu potencjalnego ataku (np. rozprzestrzeniania się złośliwego oprogramowania skanującego sieć lokalną) oraz umożliwienie precyzyjnej kontroli dostępu między segmentami za pomocą list kontroli dostępu (ACL) na routerze lub zaporze sieciowej.
* **Wydajność i zarządzanie ruchem** — oddzielenie ruchu o różnej charakterystyce (np. telefonii VoIP wymagającej niskiego opóźnienia od transferu dużych plików), łatwiejsza diagnostyka problemów w mniejszym, dobrze zdefiniowanym fragmencie sieci.
* **Organizacyjne odwzorowanie struktury firmy** — osobne segmenty dla poszczególnych działów, pięter budynku czy lokalizacji, ułatwiające administrację i rozliczanie kosztów.
* **Zgodność z regulacjami** — niektóre standardy branżowe (np. PCI DSS w sektorze płatności kartowych) wprost wymagają logicznego odseparowania systemów przetwarzających dane wrażliwe od reszty sieci.

### 7.2. Segmentacja fizyczna

Najprostsza, historycznie pierwsza forma segmentacji polega na **fizycznym rozdzieleniu** sieci na osobne urządzenia lub osobne okablowanie — np. odrębne przełączniki dla różnych działów, połączone routerem. Zaletą jest prostota koncepcyjna i pełna separacja sprzętowa; wadą — mniejsza elastyczność (zmiana przynależności urządzenia do segmentu wymaga fizycznego przełączenia kabla) oraz zwykle wyższy koszt (więcej urządzeń fizycznych).

### 7.3. Segmentacja logiczna — VLAN

Współcześnie dominującą metodą segmentacji jest wykorzystanie **sieci VLAN (Virtual LAN, IEEE 802.1Q)**, wprowadzonych już w rozdziale 5.6. VLAN pozwala na **logiczny** podział pojedynczej infrastruktury fizycznej (tych samych przełączników, tego samego okablowania) na wiele odseparowanych domen rozgłoszeniowych, bez konieczności fizycznego rozdzielania sprzętu.

Mechanizm działania w skrócie:

* każdy port przełącznika przypisywany jest do jednego VLAN-u w trybie **access** (typowo porty do urządzeń końcowych) lub przenosi ruch wielu VLAN-ów jednocześnie w trybie **trunk** (typowo połączenia między przełącznikami lub do routera), gdzie każda ramka opatrywana jest 4-bajtowym znacznikiem **802.1Q** identyfikującym VLAN, z którego pochodzi (patrz materiał o strukturze ramki Ethernet, rozdział o tagowaniu VLAN);
* przełącznik utrzymuje **osobną tablicę adresów MAC dla każdego VLAN-u** i nigdy nie przekazuje ramki (w tym ramki rozgłoszeniowej) między portami należącymi do różnych VLAN-ów;
* komunikacja między urządzeniami w **różnych** VLAN-ach wymaga przejścia przez **router** (fizyczny, z osobnym interfejsem lub podinterfejsami na jednym łączu trunk — konfiguracja znana jako **router-on-a-stick**) lub przez **przełącznik warstwy 3 (multilayer switch)**, który realizuje routing między VLAN-ami (tzw. **inter-VLAN routing**) sprzętowo, z pełną prędkością portów.

Zalety VLAN-ów względem czystej segmentacji fizycznej: pełna elastyczność (przeniesienie urządzenia do innego segmentu logicznego to zmiana konfiguracji portu, nie okablowania), lepsze wykorzystanie infrastruktury fizycznej (jeden zestaw przełączników obsługuje wiele logicznych sieci), możliwość rozciągnięcia tego samego segmentu logicznego na wiele lokalizacji fizycznych (przy odpowiedniej konfiguracji trunków), granularna kontrola bezpieczeństwa.

### 7.4. Segmentacja a routing — gdzie kończy się warstwa 2, a zaczyna warstwa 3

Kluczowe rozróżnienie kompetencji:

* **Przełącznik (warstwa 2)** segreguje ruch **wewnątrz** jednej domeny rozgłoszeniowej (lub, przy VLAN-ach, utrzymuje wiele osobnych domen na jednym urządzeniu fizycznym), opierając decyzje wyłącznie na adresach MAC.
* **Router (warstwa 3)** — lub przełącznik warstwy 3 pełniący tę rolę — umożliwia komunikację **między** różnymi domenami rozgłoszeniowymi (różnymi sieciami/podsieciami IP), opierając decyzje na adresach IP i tablicy routingu, oraz — co równie istotne — **naturalnie blokuje** propagację ruchu rozgłoszeniowego między tymi domenami (chyba że administrator jawnie skonfiguruje mechanizm przekazywania rozgłoszeń, np. IP Helper dla DHCP, co jest jednak świadomym wyjątkiem, a nie zachowaniem domyślnym).

Ta współpraca — przełączniki segmentujące logicznie za pomocą VLAN-ów, router (lub przełącznik L3) łączący te segmenty i kontrolujący ruch między nimi — stanowi fundament architektury niemal każdej współczesnej sieci lokalnej, od małego biura po rozległy kampus korporacyjny.

### 7.5. Przykład praktyczny

Rozważmy biuro ze 120 pracownikami podzielonymi na trzy działy: sprzedaż, księgowość i IT, wszystkie podłączone do wspólnej infrastruktury przełączników. Bez segmentacji wszystkie 120 stacji stanowiłoby jedną domenę rozgłoszeniową — każde zapytanie ARP, każdy broadcast DHCP docierałby do wszystkich. Po segmentacji na trzy VLAN-y (np. VLAN 10 — sprzedaż, VLAN 20 — księgowość, VLAN 30 — IT), każdy dział otrzymuje własną, mniejszą domenę rozgłoszeniową, co ogranicza narzut broadcastowy do ok. 40 hostów na segment. Dodatkowo administrator może skonfigurować na routerze (lub przełączniku L3) listy ACL blokujące np. bezpośredni dostęp z VLAN-u sprzedaży do serwerów księgowości, realizując w ten sposób politykę bezpieczeństwa niemożliwą do wyegzekwowania w płaskiej, niesegmentowanej sieci.

---

## 8. Zbiorcze porównanie urządzeń warstwy dostępu

| Urządzenie | Warstwa OSI | Decyzja podejmowana na podstawie | Dzieli domenę kolizyjną? | Dzieli domenę rozgłoszeniową? | Typowa liczba portów | Tryb pracy |
|---|---|---|---|---|---|---|
| Repeater | 1 | brak | nie | nie | 2 | regeneracja sygnału |
| Hub | 1 | brak | nie | nie | 4–24 | Half-Duplex, zalewanie zawsze |
| Most (bridge) | 2 | adres MAC | **tak** | nie | 2–4 (klasycznie) | uczenie się, filtrowanie, zalewanie nieznanych |
| Przełącznik (switch) | 2 (lub 2+3 dla L3) | adres MAC (i/lub IP dla L3) | **tak** | nie (tak, jeśli pełni funkcję L3 z inter-VLAN routing) | kilka–kilkaset | zwykle Full-Duplex, VLAN, STP |
| Router | 3 | adres IP / tablica routingu | tak | **tak** | zwykle niewiele (kilka–kilkanaście) | routing między sieciami |

Powyższa tabela stanowi syntezę całego materiału: przesuwając się od repeatera do routera, każde kolejne urządzenie „widzi" więcej informacji o ruchu (od surowych bitów, przez adresy fizyczne, po adresy logiczne z tablicą tras) i w efekcie potrafi podejmować coraz bardziej precyzyjne decyzje o segmentacji ruchu.

---

## 9. Podsumowanie

Ewolucja urządzeń warstwy dostępu — od koncentratora, przez most, po współczesny przełącznik — jest ilustracją ogólniejszej zasady w projektowaniu sieci: **im więcej informacji o ruchu urządzenie potrafi odczytać, tym bardziej precyzyjnie może nim zarządzać**. Koncentrator, działający wyłącznie w warstwie fizycznej, nie ma wyboru — musi powielić każdy sygnał na wszystkie porty, tworząc jedną, wspólną domenę kolizyjną i marnując pasmo. Most i jego sprzętowy następca, przełącznik, odczytując adresy MAC, potrafią podejmować świadome decyzje o przekazywaniu lub filtrowaniu ramek, dzieląc domeny kolizyjne — ale z racji samej natury adresu rozgłoszeniowego wciąż muszą przekazywać broadcast wszędzie w obrębie swojej sieci.

Rozróżnienie **domeny kolizyjnej** i **domeny rozgłoszeniowej** — mimo że we współczesnych, w pełni przełączanych sieciach Full-Duplex ta pierwsza straciła w dużej mierze praktyczne znaczenie — pozostaje fundamentalnym narzędziem pojęciowym do zrozumienia, dlaczego architektura sieci wymaga zarówno przełączników (dla wydajnego przekazywania ruchu wewnątrz segmentu), jak i routerów lub VLAN-ów wraz z routingiem między nimi (dla kontrolowania zasięgu ruchu rozgłoszeniowego i realizacji polityki bezpieczeństwa). Świadome zaprojektowanie segmentacji sieci — decyzja o tym, ile i jak dużych domen rozgłoszeniowych utworzyć, gdzie postawić granice VLAN-ów i jak połączyć je routingiem — jest jedną z podstawowych kompetencji każdego administratora sieci.

---

## 10. Słownik podstawowych pojęć

| Pojęcie | Znaczenie |
|---|---|
| **ASIC** | dedykowany układ scalony realizujący przełączanie sprzętowo, z prędkością liniową |
| **Broadcast storm** | burza rozgłoszeniowa — niekontrolowane, lawinowe krążenie ramek broadcastowych w pętli sieciowej |
| **CAM (Content-Addressable Memory)** | typ pamięci sprzętowej używanej do realizacji tablicy adresów MAC przełącznika |
| **Cut-Through** | metoda przełączania rozpoczynająca retransmisję zaraz po odczytaniu adresu docelowego |
| **Duplex mismatch** | błąd konfiguracji, w którym dwa końce łącza mają różne ustawienia trybu dupleksu |
| **Flooding (zalewanie)** | przekazanie ramki na wszystkie porty poza źródłowym, stosowane dla nieznanych adresów i rozgłoszeń |
| **Fragment-Free** | metoda przełączania odczekująca na pierwsze 64 B ramki przed retransmisją |
| **Inter-VLAN routing** | routing między różnymi sieciami VLAN, realizowany przez router lub przełącznik warstwy 3 |
| **Router-on-a-stick** | konfiguracja, w której jeden fizyczny interfejs routera, podzielony na podinterfejsy, obsługuje routing między wieloma VLAN-ami |
| **Store-and-Forward** | metoda przełączania odbierająca całą ramkę i weryfikująca FCS przed retransmisją |
| **STP (Spanning Tree Protocol)** | protokół zapobiegający pętlom w sieciach z redundantnymi połączeniami mostów/przełączników |
| **Transparent bridging** | algorytm mostkowania przezroczystego: uczenie się, przekazywanie/filtrowanie, starzenie, zalewanie |
| **VLAN (Virtual LAN)** | logiczny podział sieci fizycznej na wiele odseparowanych domen rozgłoszeniowych |

---

## 11. Pytania kontrolne

1. Wyjaśnij, dlaczego koncentrator (hub) nazywany jest „wieloportowym repeaterem" i jakie wynikają z tego ograniczenia dla wydajności sieci.
2. Na czym polega różnica między domeną kolizyjną a domeną rozgłoszeniową? Podaj po jednym przykładzie urządzenia, które dzieli tylko pierwszą z nich, oraz urządzenia, które dzieli obie.
3. Opisz cztery mechanizmy składające się na algorytm mostkowania przezroczystego (transparent bridging): uczenie się, przekazywanie/filtrowanie, starzenie się wpisów i zalewanie.
4. Dlaczego ramka rozgłoszeniowa jest zawsze przekazywana przez most/przełącznik na wszystkie porty, niezależnie od zawartości tablicy adresów MAC?
5. Co to jest burza rozgłoszeniowa i w jakich okolicznościach może wystąpić? Jaki protokół zapobiega temu zjawisku i na czym polega jego działanie w skrócie?
6. Porównaj trzy metody przełączania: Store-and-Forward, Cut-Through i Fragment-Free — pod względem momentu rozpoczęcia retransmisji, opóźnienia i zdolności do filtrowania uszkodzonych ramek.
7. Dlaczego przy pracy w trybie Full-Duplex pojęcie domeny kolizyjnej traci praktyczne znaczenie? Co dokładnie uniemożliwia fizyczne wystąpienie kolizji w takim trybie?
8. Wyjaśnij, w jaki sposób sieci VLAN pozwalają na logiczną segmentację ruchu bez fizycznego rozdzielania infrastruktury. Co jest wymagane, aby urządzenia w dwóch różnych VLAN-ach mogły się ze sobą komunikować?
9. Podaj co najmniej trzy różne motywacje stojące za segmentacją sieci (inne niż wyłącznie ograniczenie domeny kolizyjnej) i krótko uzasadnij każdą z nich.
10. Mając sieć złożoną z jednego routera, dwóch przełączników (po 8 aktywnych portów Full-Duplex każdy) oraz jednego 4-portowego hub-a podłączonego do jednego z portów pierwszego przełącznika (z trzema komputerami na hub-ie), określ: (a) liczbę domen rozgłoszeniowych, (b) liczbę domen kolizyjnych w tej sieci.

### Klucz odpowiedzi do pytania 10

**(a) Domeny rozgłoszeniowe:** router ma tylko jedno „ramię" schodzące do przełączników (w tym uproszczonym scenariuszu bez VLAN-ów) — cała sieć za przełącznikami stanowi **jedną** domenę rozgłoszeniową (zakładając brak dodatkowych interfejsów routera prowadzących do innych segmentów).

**(b) Domeny kolizyjne:** pierwszy przełącznik ma 8 portów, z czego 7 prowadzi bezpośrednio do pojedynczych hostów (7 osobnych mikrodomen kolizyjnych Full-Duplex) i 1 prowadzi do hub-a (który sam w sobie stanowi **jedną** wspólną domenę kolizyjną obejmującą wszystkie 3 podłączone do niego komputery oraz port przełącznika). Drugi przełącznik ma 8 portów, z czego 8 osobnych mikrodomen kolizyjnych. Łącznie: $7 + 1 + 8 = \\mathbf{16}$ domen kolizyjnych (7 z pierwszego przełącznika + 1 z hub-a + 8 z drugiego przełącznika).'
    ]
];
