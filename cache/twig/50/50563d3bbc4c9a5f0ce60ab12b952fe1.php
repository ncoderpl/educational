<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\MacroNamespace;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Sandbox\SecurityNotAllowedTestError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* @Page:/var/www/html/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci */
class __TwigTemplate_e2a91632ac6ae8ee7e4a1a4c6b3eee22_sourced extends Template
{
    private Source $source;
    /**
     * @var array<string, MacroNamespace>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        $this->sandbox = $env->getExtension(SandboxExtension::class)->getChecker();
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<h1>Koncentratory, mosty i przełączniki. Segmentacja, domeny kolizyjne i rozgłoszeniowe</h1>
<h2>Wprowadzenie</h2>
<p>Sieć lokalna nie jest jednorodną, niezróżnicowaną masą kabli — to zbiór urządzeń pośredniczących, z których każde odgrywa inną rolę w przekazywaniu sygnału i podejmowaniu decyzji o tym, dokąd ma trafić dana ramka. Historia rozwoju sieci Ethernet jest w dużej mierze historią stopniowego „mądrzenia się\" tych urządzeń pośredniczących: od prostego wzmacniacza sygnału, przez urządzenie odczytujące adresy fizyczne i podejmujące decyzje przekazywania, aż po współczesny przełącznik zarządzalny, który potrafi tworzyć wirtualne sieci, ograniczać ruch rozgłoszeniowy i współpracować z routingiem.</p>
<p>Ten materiał koncentruje się na trzech klasach urządzeń warstwy dostępu — <strong>koncentratorach (hubach)</strong>, <strong>mostach (bridge\x27ach)</strong> i <strong>przełącznikach (switchach)</strong> — oraz na dwóch pojęciach, które są kluczem do zrozumienia, dlaczego w ogóle segmentujemy sieci: <strong>domenie kolizyjnej</strong> i <strong>domenie rozgłoszeniowej</strong>. Zrozumienie tych pojęć pozwala świadomie projektować sieć: wiedzieć, gdzie umieścić przełącznik, kiedy sięgnąć po VLAN, a kiedy konieczny jest router.</p>
<hr />
<h2>1. Warstwa dostępu i hierarchia urządzeń sieciowych</h2>
<h3>1.1. Warstwa dostępu w projektowaniu sieci</h3>
<p>W klasycznym, hierarchicznym modelu projektowania sieci kampusowych (popularyzowanym m.in. przez Cisco) wyróżnia się trzy warstwy:</p>
<ul>
<li><strong>warstwa dostępu (access layer)</strong> — miejsce, w którym urządzenia końcowe (komputery, drukarki, telefony IP, punkty dostępowe Wi-Fi) fizycznie łączą się z siecią; tu pracują przełączniki dostępowe, tu podejmowane są pierwsze decyzje o przynależności do VLAN-u i tu egzekwowane są podstawowe zabezpieczenia portów;</li>
<li><strong>warstwa dystrybucji (distribution layer)</strong> — agreguje ruch z wielu przełączników dostępowych, realizuje routing między VLAN-ami, filtrację i politykę bezpieczeństwa;</li>
<li><strong>warstwa rdzenia (core layer)</strong> — szybkie przełączanie/routing dużych wolumenów ruchu między warstwami dystrybucji, bez zbędnej filtracji, aby zminimalizować opóźnienie.</li>
</ul>
<p>Ten materiał dotyczy przede wszystkim urządzeń typowych dla warstwy dostępu i mechanizmów, które decydują o tym, jak duży fragment sieci „widzi\" pojedyncza ramka — czy to unikatowa (unicast), czy rozgłoszeniowa (broadcast).</p>
<h3>1.2. Urządzenia sieciowe według warstwy modelu OSI</h3>
<p>Kluczem do zrozumienia różnic między hubem, mostem/przełącznikiem a routerem jest to, <strong>w której warstwie modelu OSI dane urządzenie „czyta\" informacje</strong>, zanim podejmie decyzję o przekazaniu sygnału dalej:</p>
<table>
<thead>
<tr>
<th>Urządzenie</th>
<th>Warstwa OSI</th>
<th>Na czym podejmuje decyzję</th>
<th>Co przekazuje</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Repeater / regenerator</strong></td>
<td>1 (fizyczna)</td>
<td>brak decyzji — wzmacnia i retransmituje każdy sygnał</td>
<td>bity</td>
</tr>
<tr>
<td><strong>Koncentrator (hub)</strong></td>
<td>1 (fizyczna)</td>
<td>brak decyzji — wieloportowy repeater</td>
<td>bity</td>
</tr>
<tr>
<td><strong>Most (bridge)</strong></td>
<td>2 (łącza danych)</td>
<td>adres MAC docelowy</td>
<td>ramki</td>
</tr>
<tr>
<td><strong>Przełącznik (switch)</strong></td>
<td>2 (łącza danych), niektóre modele także 3</td>
<td>adres MAC docelowy (L2) lub adres IP (L3 switch)</td>
<td>ramki (lub pakiety w trybie L3)</td>
</tr>
<tr>
<td><strong>Router</strong></td>
<td>3 (sieciowa)</td>
<td>adres IP docelowy i tablica routingu</td>
<td>pakiety</td>
</tr>
</tbody>
</table>
<p>Ta tabela jest mapą drogową całego materiału: im wyżej w modelu OSI urządzenie „patrzy\" na dane, tym więcej inteligentnych decyzji może podjąć — kosztem większej złożoności i (nieco) większego opóźnienia przetwarzania.</p>
<hr />
<h2>2. Koncentratory (Hubs)</h2>
<h3>2.1. Definicja i zasada działania</h3>
<p><strong>Koncentrator (hub)</strong> to urządzenie warstwy fizycznej — w istocie <strong>wieloportowy wzmacniacz sygnału (repeater)</strong>. Hub nie analizuje żadnych nagłówków ramek, nie odczytuje adresów MAC, nie podejmuje żadnych decyzji o kierunku przekazania danych. Jego działanie sprowadza się do jednej, prostej operacji: <strong>sygnał elektryczny, który dotrze na dowolny port, jest regenerowany (wzmacniany i „odświeżany\" pod względem kształtu impulsów) i wysyłany jednocześnie na wszystkie pozostałe porty</strong>.</p>
<p>Z perspektywy logiki sieciowej hub przekształca fizyczną topologię gwiazdy (kable biegnące do centralnego punktu) w <strong>logiczną topologię magistrali (bus)</strong> — działa dokładnie tak, jakby wszystkie podłączone urządzenia były spięte jednym wspólnym kablem koncentrycznym, tak jak w najwcześniejszych instalacjach Ethernetu (10BASE5, 10BASE2).</p>
<h3>2.2. Konsekwencje braku inteligencji</h3>
<p>Ponieważ hub powiela sygnał na wszystkie porty bez wyjątku, wynikają z tego poważne konsekwencje:</p>
<ol>
<li><strong>Medium współdzielone (shared medium).</strong> W danej chwili tylko jedno urządzenie podłączone do hub-a może nadawać, nie powodując kolizji. Wszystkie porty hub-a stanowią <strong>jedną, wspólną domenę kolizyjną</strong> — zagadnienie to rozwijamy szczegółowo w rozdziale 3.</li>
<li><strong>Praca wyłącznie w trybie Half-Duplex.</strong> Skoro urządzenia współdzielą medium i muszą nasłuchiwać przed nadawaniem (CSMA/CD), transmisja nie może odbywać się jednocześnie w obu kierunkach na tym samym łączu — nadawanie i odbiór wykluczają się wzajemnie.</li>
<li><strong>Brak filtrowania ruchu.</strong> Ramka wysłana przez PC-A do PC-B zostanie i tak dostarczona fizycznie do <strong>wszystkich</strong> pozostałych portów — PC-C i PC-D „usłyszą\" tę transmisję, mimo że nie są jej adresatem; ich karty sieciowe po prostu odrzucą ramkę na podstawie niezgodnego adresu MAC docelowego, ale medium przez cały czas trwania tej transmisji jest zajęte dla wszystkich.</li>
<li><strong>Sumowanie się przepustowości.</strong> Cała nominalna przepływność łącza (np. 10 lub 100 Mb/s) jest <strong>dzielona między wszystkie podłączone urządzenia</strong> — im więcej hostów na hub-ie, tym mniej pasma przypada statystycznie na każdego z nich, a rywalizacja o dostęp do medium (i liczba kolizji) rośnie.</li>
<li><strong>Brak wsparcia dla Gigabit Ethernet w praktyce.</strong> Standard 1000BASE-T formalnie dopuszcza pracę Half-Duplex z repeaterem, ale w praktyce urządzenia takie nigdy nie zyskały popularności rynkowej — Gigabit Ethernet od początku projektowano z myślą o przełącznikach i pracy Full-Duplex.</li>
</ol>
<p><img alt=\"Koncentrator (hub) — cały segment sieci stanowi jedną, wspólną domenę kolizyjną\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/hub-domena-kolizyjna.svg\" /></p>
<h3>2.3. Hub aktywny i pasywny</h3>
<p>Rozróżnia się:</p>
<ul>
<li><strong>hub pasywny</strong> — jedynie łączy elektrycznie przewody (bez wzmacniania sygnału); dziś praktycznie niespotykany, ograniczony do bardzo krótkich odległości;</li>
<li><strong>hub aktywny</strong> — regeneruje (wzmacnia i resynchronizuje) sygnał na każdym porcie, dzięki czemu można zachować pełną, dopuszczalną długość segmentów kablowych na każdym z odcinków.</li>
</ul>
<h3>2.4. Dlaczego huby zniknęły z nowoczesnych sieci</h3>
<p>Wraz ze spadkiem cen układów scalonych realizujących przełączanie, <strong>przełączniki stały się tańsze niż utrzymanie wydajności sieci opartej na hubach</strong>, a jednocześnie oferowały wielokrotnie wyższą efektywną przepustowość (patrz rozdział 5). Dziś huby praktycznie zniknęły z produkcji i z nowych instalacji — spotyka się je niemal wyłącznie w kontekście edukacyjnym (do demonstrowania zjawiska kolizji) lub w wyspecjalizowanych zastosowaniach diagnostycznych (tzw. <strong>network tap</strong>, urządzenie do pasywnego podsłuchu ruchu na potrzeby analizatorów pakietów, gdzie celowo wykorzystuje się właściwość „powielania sygnału na wszystkie porty\").</p>
<h3>2.5. Zalety i wady koncentratorów</h3>
<p><strong>Zalety (głównie historyczne):</strong> bardzo niski koszt, prostota działania, brak opóźnienia przetwarzania (poza czasem propagacji sygnału i regeneracji), łatwość diagnostyki (cały ruch widoczny na każdym porcie).</p>
<p><strong>Wady:</strong> jedna wspólna domena kolizyjna ograniczająca skalowalność, praca wyłącznie Half-Duplex, brak filtrowania ruchu (marnotrawstwo pasma), brak wsparcia dla VLAN-ów i jakichkolwiek mechanizmów bezpieczeństwa portów, ograniczona maksymalna liczba huby połączonych kaskadowo (tzw. <strong>reguła 5-4-3</strong> w 10 Mb/s Ethernet: maksymalnie 5 segmentów, 4 repeatery/huby, z czego tylko 3 segmenty obsadzone hostami — wynikająca z limitu czasowego działania CSMA/CD, patrz materiał o ramce Ethernet).</p>
<hr />
<h2>3. Domena kolizyjna</h2>
<h3>3.1. Definicja</h3>
<p><strong>Domena kolizyjna (collision domain)</strong> to obszar sieci, w którym <strong>jednoczesna transmisja dwóch (lub więcej) urządzeń powoduje wzajemne zakłócenie (kolizję) ich sygnałów</strong>. Innymi słowy — to zbiór urządzeń współdzielących jedno medium fizyczne na tyle blisko pod względem topologii, że ich sygnały elektryczne mogą się wzajemnie „zderzyć\".</p>
<p>Domena kolizyjna jest ściśle związana z mechanizmem <strong>CSMA/CD</strong> (Carrier Sense Multiple Access with Collision Detection), stosowanym w klasycznych sieciach Ethernet pracujących w trybie Half-Duplex: stacja nasłuchuje medium przed nadawaniem, a jeśli mimo to dojdzie do jednoczesnej transmisji dwóch stacji, obie wykrywają kolizję, przerywają nadawanie, wysyłają sygnał zagłuszający (JAM) i po losowym czasie (algorytm Backoff) próbują ponownie.</p>
<h3>3.2. Jak poszczególne urządzenia wpływają na rozmiar domeny kolizyjnej</h3>
<table>
<thead>
<tr>
<th>Urządzenie</th>
<th>Wpływ na domenę kolizyjną</th>
</tr>
</thead>
<tbody>
<tr>
<td>Kabel koncentryczny (10BASE5/10BASE2)</td>
<td>wszystkie stacje na wspólnym kablu = jedna domena kolizyjna</td>
</tr>
<tr>
<td>Repeater / hub</td>
<td><strong>nie dzieli</strong> domeny kolizyjnej — wszystkie połączone porty nadal stanowią jedną, wspólną domenę</td>
</tr>
<tr>
<td>Most / przełącznik</td>
<td><strong>dzieli</strong> domenę kolizyjną — każdy port to osobna domena kolizyjna</td>
</tr>
<tr>
<td>Router</td>
<td>dzieli domenę kolizyjną (i dodatkowo domenę rozgłoszeniową)</td>
</tr>
</tbody>
</table>
<p>Ta różnica jest fundamentalna i tłumaczy, dlaczego przełącznik jest urządzeniem jakościowo innym niż hub, mimo pozornego podobieństwa (oba mają wiele portów RJ-45 i pośredniczą w komunikacji urządzeń w sieci lokalnej).</p>
<h3>3.3. Konsekwencje wielkości domeny kolizyjnej</h3>
<p>Im <strong>większa</strong> domena kolizyjna (więcej stacji współdzielących medium), tym:</p>
<ul>
<li><strong>więcej kolizji statystycznie</strong> — prawdopodobieństwo, że dwie stacje zaczną nadawać niemal jednocześnie, rośnie z liczbą aktywnych urządzeń;</li>
<li><strong>niższa efektywna przepustowość</strong> — czas i pasmo „marnowane\" na wykrywanie kolizji, wysyłanie sygnału JAM i odczekiwanie losowego czasu Backoff nie są dostępne dla użytecznej transmisji danych; przy silnym obciążeniu efektywne wykorzystanie łącza Half-Duplex w praktyce może spaść nawet do 30–40% nominalnej przepływności;</li>
<li><strong>większe opóźnienie</strong> — retransmisje po kolizji wydłużają czas dostarczenia danych, a przy wielu kolizjach z rzędu algorytm wykładniczego Backoff znacząco wydłuża oczekiwanie (patrz materiał o ramce Ethernet, rozdział o algorytmie Backoff).</li>
</ul>
<h3>3.4. Full-Duplex jako eliminacja kolizji</h3>
<p>We współczesnych sieciach opartych na przełącznikach, w których każde urządzenie ma dedykowane, punkt-punktowe połączenie z portem przełącznika, a transmisja i odbiór odbywają się na osobnych parach przewodów (lub osobnych długościach fali w światłowodzie), możliwa jest praca w trybie <strong>Full-Duplex</strong>. W tym trybie <strong>kolizje są fizycznie niemożliwe</strong> — nie ma współdzielonego medium, na którym mogłyby wystąpić. Mechanizm CSMA/CD zostaje wtedy całkowicie wyłączony w mikrokodzie karty sieciowej i przełącznika.</p>
<p>Z formalnego punktu widzenia każdy port przełącznika pracującego Full-Duplex nadal „technicznie\" stanowi osobną, jednoelementową domenę kolizyjną (zawiera dokładnie dwa urządzenia: kartę sieciową hosta i port przełącznika, połączone dedykowanym łączem) — ale ponieważ kolizja nie może w niej fizycznie zajść, pojęcie to traci praktyczne znaczenie diagnostyczne we współczesnych, w pełni przełączanych sieciach.</p>
<p><img alt=\"Przełącznik — każdy port stanowi osobną, mikroskopijną domenę kolizyjną; przy Full-Duplex kolizje są fizycznie niemożliwe\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/switch-domeny-kolizyjne.svg\" /></p>
<h3>3.5. Jak sprawdzić granice domeny kolizyjnej w praktyce</h3>
<p>Praktyczną wskazówką jest pytanie: <em>„Gdyby dwa urządzenia w tym obszarze nadały jednocześnie, czy ich sygnały zderzyłyby się fizycznie?\"</em> Jeśli odpowiedź brzmi „tak\" — znajdują się w tej samej domenie kolizyjnej. Diagnostycznie w systemie Linux rosnący licznik kolizji (<code>collisions</code>) w statystykach interfejsu pracującego w trybie Half-Duplex sygnalizuje przeciążoną lub zbyt rozległą domenę kolizyjną; we współczesnych sieciach Full-Duplex licznik ten <strong>powinien pozostawać zerowy</strong> — jego wzrost wskazuje zwykle na błąd konfiguracji (tzw. <strong>duplex mismatch</strong> — niezgodność ustawień dupleksu między dwoma końcami łącza).</p>
<hr />
<h2>4. Mosty (Bridges)</h2>
<h3>4.1. Geneza i motywacja</h3>
<p>Wraz z rozrostem wczesnych sieci Ethernet opartych na wspólnym medium (kablu koncentrycznym, a później hub-ach) administratorzy napotykali twardą barierę: powiększanie jednej, wspólnej domeny kolizyjnej ponad pewien rozmiar prowadziło do lawinowego wzrostu liczby kolizji i drastycznego spadku efektywnej przepustowości. Rozwiązaniem okazało się urządzenie, które — w przeciwieństwie do repeatera/hub-a — <strong>odczytuje adresy MAC</strong> zawarte w ramkach i <strong>podejmuje decyzję</strong>, czy dana ramka rzeczywiście musi zostać przekazana do drugiego segmentu sieci, czy też jej odbiorca znajduje się już w tym samym segmencie, z którego nadeszła (a więc przekazywanie byłoby zbędne). Takie urządzenie nazwano <strong>mostem (bridge)</strong>.</p>
<h3>4.2. Definicja i zasada działania</h3>
<p><strong>Most (bridge)</strong> to urządzenie warstwy 2 modelu OSI, łączące dwa (lub więcej) segmenty sieci w taki sposób, że:</p>
<ul>
<li><strong>odczytuje adres MAC źródłowy i docelowy</strong> każdej odbieranej ramki,</li>
<li><strong>buduje i utrzymuje tablicę adresów MAC</strong> widzianych na poszczególnych swoich portach (interfejsach),</li>
<li>na tej podstawie <strong>podejmuje decyzję</strong>: przekazać ramkę na drugi segment, czy odrzucić ją (bo odbiorca znajduje się w tym samym segmencie, z którego ramka nadeszła — nie ma potrzeby jej powielania).</li>
</ul>
<p>Most <strong>dzieli domenę kolizyjną</strong> — segmenty po obu jego stronach stanowią osobne domeny kolizyjne — ale <strong>nie dzieli domeny rozgłoszeniowej</strong>: ramka rozgłoszeniowa (broadcast) jest zawsze przekazywana przez most na wszystkie pozostałe segmenty, ponieważ z definicji jest ona adresowana do wszystkich.</p>
<h3>4.3. Algorytm mostkowania przezroczystego (Transparent Bridging)</h3>
<p>Najpowszechniej stosowanym algorytmem pracy mostu (i, jak zobaczymy w rozdziale 5, także przełącznika) jest <strong>mostkowanie przezroczyste (transparent bridging)</strong>, opisane w standardzie <strong>IEEE 802.1D</strong>. Nazwa „przezroczyste\" oznacza, że urządzenia końcowe <strong>nie muszą wiedzieć o istnieniu mostu</strong> — działa on w pełni automatycznie, bez konieczności ręcznej konfiguracji tablic adresowych. Algorytm opiera się na czterech mechanizmach.</p>
<h4>a) Uczenie się (Learning)</h4>
<p>Dla każdej odbieranej ramki most odczytuje <strong>adres MAC źródłowy</strong> oraz <strong>numer portu</strong>, na którym ramka dotarła, i zapisuje tę parę (adres MAC → port) w swojej tablicy adresów. W ten sposób most stopniowo, w sposób całkowicie automatyczny, „uczy się\" topologii sieci — po jakimś czasie zna lokalizację (port) każdego aktywnego urządzenia w sieci.</p>
<h4>b) Przekazywanie i filtrowanie (Forwarding / Filtering)</h4>
<p>Dla adresu MAC <strong>docelowego</strong> odbieranej ramki most sprawdza swoją tablicę:</p>
<ul>
<li>jeśli adres docelowy jest <strong>znany</strong> i znajduje się na <strong>innym</strong> porcie niż ten, z którego nadeszła ramka — most <strong>przekazuje</strong> ramkę wyłącznie na ten jeden, właściwy port (<strong>forwarding</strong>);</li>
<li>jeśli adres docelowy jest <strong>znany</strong> i znajduje się na <strong>tym samym</strong> porcie, z którego nadeszła ramka — oznacza to, że nadawca i odbiorca są w tym samym segmencie, a most <strong>odrzuca</strong> ramkę, nie przekazując jej dalej (<strong>filtering</strong>); to właśnie ten mechanizm odciąża ruch między segmentami;</li>
<li>jeśli adres docelowy jest <strong>nieznany</strong> (brak wpisu w tablicy) — most przekazuje ramkę na <strong>wszystkie</strong> porty poza tym, z którego nadeszła (<strong>flooding</strong>, zalewanie) — to jedyny bezpieczny sposób, by mieć pewność, że ramka dotrze do adresata, którego lokalizacja nie jest jeszcze znana;</li>
<li>jeśli adres docelowy jest <strong>rozgłoszeniowy</strong> (<code>FF:FF:FF:FF:FF:FF</code>) lub grupowy (multicast) — most zawsze przekazuje ramkę na wszystkie porty poza portem źródłowym.</li>
</ul>
<h4>c) Starzenie się wpisów (Aging)</h4>
<p>Każdy wpis w tablicy adresów MAC opatrzony jest znacznikiem czasu. Jeśli przez określony czas (domyślnie zwykle <strong>300 sekund</strong>) most nie zaobserwuje żadnej ramki z danym adresem źródłowym na zapisanym porcie, wpis jest <strong>usuwany</strong>. Mechanizm ten pozwala sieci dostosować się do zmian topologii — np. przeniesienia urządzenia do innego portu lub jego odłączenia — bez ręcznej interwencji administratora, kosztem tego, że pierwsza ramka do „zapomnianego\" adresu ponownie wywoła zalewanie.</p>
<h4>d) Zalewanie (Flooding) dla nieznanych adresów</h4>
<p>Jak wspomniano w punkcie b), zalewanie jest mechanizmem awaryjnym stosowanym zawsze, gdy most nie ma jeszcze wiedzy o lokalizacji odbiorcy. W dużych, aktywnych sieciach zalewanie występuje relatywnie rzadko po początkowym okresie „uczenia się\", ale w sieciach o dużej liczbie rzadko komunikujących się urządzeń (np. gdy wpisy wygasają między kolejnymi transmisjami) może stanowić zauważalny narzut.</p>
<h3>4.4. Most a problem pętli — wprowadzenie do STP</h3>
<p>Jeśli w sieci istnieją <strong>dwa lub więcej mostów (lub przełączników) połączonych w taki sposób, że tworzą fizyczną pętlę</strong> (np. dla redundancji, na wypadek awarii jednego łącza), mechanizm zalewania nieznanych adresów i ramek rozgłoszeniowych prowadzi do katastrofalnego zjawiska zwanego <strong>burzą rozgłoszeniową (broadcast storm)</strong>: ta sama ramka rozgłoszeniowa krąży w pętli w nieskończoność, a każdy most/przełącznik na jej drodze wciąż ją powiela na wszystkie porty, mnożąc ruch wykładniczo, aż do całkowitego zapchania sieci.</p>
<p>Rozwiązaniem tego problemu jest protokół <strong>STP (Spanning Tree Protocol, IEEE 802.1D)</strong>, który automatycznie wykrywa pętle w topologii i <strong>blokuje logicznie nadmiarowe łącza</strong> (przechodzą one w stan blokowania, nie przekazując ruchu użytkownika, ale pozostając aktywnymi „w rezerwie\"), tworząc na potrzeby przekazywania ramek drzewo rozpinające bez pętli (stąd nazwa — <em>spanning tree</em>, drzewo rozpinające). Gdy aktywne łącze ulegnie awarii, STP automatycznie przelicza topologię i aktywuje wcześniej zablokowane łącze zapasowe. Zagadnienie STP i jego następców (RSTP, MSTP) jest na tyle obszerne, że zasługuje na osobne, szczegółowe opracowanie — w tym materiale sygnalizujemy je jedynie jako niezbędny kontekst do zrozumienia, dlaczego mosty/przełączniki nie mogą być łączone w dowolne pętle bez dodatkowych mechanizmów zabezpieczających.</p>
<h3>4.5. Rodzaje mostów (nota historyczna)</h3>
<p>W literaturze rozróżnia się kilka odmian mostów, choć w praktyce współczesnych sieci Ethernet dominuje transparent bridging:</p>
<ul>
<li><strong>mosty przezroczyste (transparent bridges)</strong> — opisany wyżej, dominujący w sieciach Ethernet;</li>
<li><strong>mosty ze źródłowym trasowaniem (source-route bridging)</strong> — stosowane historycznie w sieciach Token Ring, gdzie to stacja nadawcza (a nie most) decydowała o trasie ramki na podstawie informacji zebranej wcześniej przez specjalne ramki odkrywające; dziś praktycznie nieużywane wraz z zanikiem Token Ring;</li>
<li><strong>mosty translacyjne (translational bridges)</strong> — łączące segmenty o różnych technologiach warstwy 2 (np. Ethernet i Token Ring), wymagające przekształcenia formatu ramki.</li>
</ul>
<h3>4.6. Most a przełącznik — czy to to samo?</h3>
<p>Koncepcyjnie <strong>przełącznik jest bezpośrednim, sprzętowo zoptymalizowanym następcą mostu</strong> — realizuje dokładnie ten sam algorytm transparent bridging (uczenie się, przekazywanie/filtrowanie, starzenie, zalewanie), lecz różni się przede wszystkim:</p>
<ul>
<li><strong>implementacją</strong> — most tradycyjnie był urządzeniem programowym, realizującym przełączanie w oprogramowaniu na ogólnego przeznaczenia procesorze, obsługującym zwykle niewiele portów (2–4); przełącznik realizuje te same decyzje sprzętowo, w dedykowanych układach ASIC, co pozwala obsługiwać dziesiątki lub setki portów z pełną prędkością łącza jednocześnie (tzw. przełączanie <strong>non-blocking</strong>, z przepustowością macierzy przełączającej — <em>switching fabric</em> — wystarczającą, by obsłużyć ruch na wszystkich portach jednocześnie bez utraty wydajności);</li>
<li><strong>liczbą portów</strong> — klasyczny most miał zwykle 2–4 porty, łącząc niewielką liczbę segmentów; przełącznik ma zazwyczaj kilkanaście do kilkudziesięciu portów, a każdy z nich traktowany jest de facto jako osobny, jednoportowy „segment\" mostkowany;</li>
<li><strong>terminologią rynkową</strong> — w praktyce od końca lat 90. XX wieku termin „przełącznik\" niemal całkowicie wyparł w kontekście Ethernetu termin „most\", choć formalnie w wielu standardach (w tym w nazwach protokołów, np. <em>Spanning Tree Protocol</em> działa na urządzeniach nazywanych w dokumentach IEEE „bridges\") stara terminologia przetrwała.</li>
</ul>
<p>Można zatem powiedzieć: <strong>każdy przełącznik Ethernet jest, z technicznego punktu widzenia, wieloportowym mostem</strong> — a rozróżnienie „most vs przełącznik\" ma dziś głównie znaczenie historyczne i edukacyjne, pomocne w zrozumieniu ewolucji urządzeń warstwy 2.</p>
<hr />
<h2>5. Przełączniki (Switches)</h2>
<h3>5.1. Przełącznik jako sprzętowa realizacja mostkowania</h3>
<p><strong>Przełącznik (switch)</strong> to urządzenie warstwy 2 modelu OSI, realizujące algorytm transparent bridging (opisany w rozdziale 4) w dedykowanym sprzęcie (układach ASIC — Application-Specific Integrated Circuit), co pozwala na podejmowanie decyzji o przekazywaniu ramek z prędkością liniową (<em>wire speed</em>) na wielu portach jednocześnie, bez zauważalnego opóźnienia przetwarzania. To właśnie przełącznik jest dziś absolutnie podstawowym, wszechobecnym urządzeniem każdej przewodowej sieci lokalnej.</p>
<h3>5.2. Tablica adresów MAC (CAM)</h3>
<p>Sercem działania przełącznika jest <strong>tablica adresów MAC</strong>, często określana skrótem <strong>CAM</strong> (Content-Addressable Memory) — od typu pamięci sprzętowej, w której jest fizycznie zaimplementowana. Pamięć CAM pozwala na <strong>wyszukiwanie skojarzone z zawartością</strong> (podanie adresu MAC jako klucza zwraca natychmiast numer portu) w czasie stałym, niezależnym od liczby wpisów — co jest kluczowe dla zachowania prędkości liniowej przy tysiącach wpisów.</p>
<p>Każdy wpis w tablicy CAM zawiera typowo:</p>
<ul>
<li><strong>adres MAC</strong> urządzenia,</li>
<li><strong>numer portu</strong>, na którym to urządzenie zostało zaobserwowane,</li>
<li><strong>identyfikator VLAN</strong>, do którego należy dany wpis (we współczesnych przełącznikach zarządzalnych, patrz rozdział 5.6),</li>
<li><strong>znacznik czasu</strong> (do mechanizmu starzenia się wpisów).</li>
</ul>
<p><img alt=\"Proces uczenia się adresów MAC przez przełącznik i podejmowania decyzji o przekazaniu lub zalaniu ramki\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/przelacznik-tablica-mac.svg\" /></p>
<h3>5.3. Metody przełączania</h3>
<p>Producenci przełączników stosują kilka odmiennych strategii dotyczących tego, <strong>w którym momencie odbioru ramki przełącznik rozpoczyna jej retransmisję</strong> na port docelowy. Wybór strategii to kompromis między <strong>opóźnieniem</strong> a <strong>niezawodnością</strong> (unikaniem przekazywania uszkodzonych ramek).</p>
<h4>Store-and-Forward (składuj i przekaż)</h4>
<p>Przełącznik <strong>odbiera całą ramkę w buforze</strong>, oblicza i weryfikuje sumę kontrolną <strong>FCS (CRC-32)</strong>, i dopiero po potwierdzeniu, że ramka jest bezbłędna, rozpoczyna jej przekazywanie na port docelowy. Jest to metoda <strong>najbezpieczniejsza</strong> — uszkodzone ramki są odrzucane i nigdy nie trafiają dalej do sieci — kosztem <strong>największego opóźnienia</strong>, proporcjonalnego do długości ramki (im dłuższa ramka, tym dłużej trzeba czekać na jej pełne odebranie przed retransmisją). Metoda ta dominuje we współczesnych przełącznikach, ponieważ dodatkowe opóźnienie (rzędu mikrosekund przy typowych prędkościach łączy) jest w praktyce pomijalne, a korzyści w postaci niefiltrowania uszkodzonych ramek — istotne. Store-and-Forward jest też jedyną metodą pozwalającą na <strong>łączenie portów o różnych prędkościach</strong> (np. port 1 Gb/s przekazujący do portu 100 Mb/s) — bez pełnego buforowania ramki nie da się bezpiecznie dopasować różnych szybkości transmisji.</p>
<h4>Cut-Through (przelotowe)</h4>
<p>Przełącznik zaczyna retransmisję ramki <strong>natychmiast po odczytaniu adresu MAC docelowego</strong> — czyli już po odebraniu pierwszych ok. 14 bajtów ramki (pola: adres docelowy i częściowo adres źródłowy) — bez czekania na resztę danych ani na weryfikację sumy FCS. Zapewnia to <strong>minimalne możliwe opóźnienie</strong>, kosztem ryzyka przekazania dalej uszkodzonej ramki (błąd zostanie wykryty dopiero przez kartę sieciową odbiorcy końcowego, na podstawie FCS, i ramka zostanie tam odrzucona — ale zdążyła już zająć pasmo w dalszej części sieci).</p>
<h4>Fragment-Free (bez fragmentów)</h4>
<p>Rozwiązanie pośrednie: przełącznik odczekuje na odebranie pierwszych <strong>64 bajtów</strong> ramki przed rozpoczęciem retransmisji. Wartość 64 bajtów nie jest przypadkowa — to dokładnie minimalny dopuszczalny rozmiar poprawnej ramki Ethernet (patrz materiał o strukturze ramki Ethernet, rozdział o minimalnym rozmiarze ramki). Większość uszkodzeń powstałych na skutek kolizji w sieciach Half-Duplex objawia się jako tzw. <strong>fragmenty kolizyjne (collision fragments)</strong> — ramki krótsze niż 64 bajty. Odczekanie na pierwsze 64 bajty pozwala odfiltrować niemal wszystkie tego typu uszkodzone fragmenty, przy opóźnieniu znacznie mniejszym niż pełny Store-and-Forward.</p>
<p><img alt=\"Porównanie momentu rozpoczęcia retransmisji ramki: Store-and-Forward, Cut-Through i Fragment-Free\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/metody-przelaczania-switch.svg\" /></p>
<table>
<thead>
<tr>
<th>Metoda</th>
<th>Moment rozpoczęcia przekazywania</th>
<th>Opóźnienie</th>
<th>Filtrowanie błędów</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>Store-and-Forward</td>
<td>po odebraniu całej ramki i weryfikacji FCS</td>
<td>największe (zależne od długości ramki)</td>
<td>pełne</td>
<td>jedyna metoda umożliwiająca zmianę prędkości portów; dominująca dziś</td>
</tr>
<tr>
<td>Cut-Through</td>
<td>po odczytaniu adresu MAC docelowego (~14 B)</td>
<td>minimalne, stałe</td>
<td>brak</td>
<td>ryzyko przekazania uszkodzonej ramki dalej</td>
</tr>
<tr>
<td>Fragment-Free</td>
<td>po odebraniu pierwszych 64 B</td>
<td>pośrednie</td>
<td>częściowe (odrzuca fragmenty kolizyjne)</td>
<td>kompromis między szybkością a bezpieczeństwem</td>
</tr>
</tbody>
</table>
<p>W praktyce współczesnych, w pełni przełączanych sieci Full-Duplex (gdzie fragmenty kolizyjne w ogóle nie powstają, bo kolizji nie ma) różnica między metodami traci część swojego pierwotnego uzasadnienia, a wiele nowoczesnych przełączników stosuje <strong>adaptacyjne</strong> podejście — działa w trybie cut-through, dopóki na danym porcie licznik błędów FCS pozostaje niski, i automatycznie przełącza się na store-and-forward, jeśli wykryje podwyższony poziom błędów.</p>
<h3>5.4. Przełącznik a duplex i autonegocjacja</h3>
<p>Nowoczesne przełączniki pracują niemal wyłącznie w trybie <strong>Full-Duplex</strong> na łączach point-to-point z każdym urządzeniem końcowym. Zgodność prędkości i trybu dupleksu między portem przełącznika a kartą sieciową urządzenia ustalana jest automatycznie przez mechanizm <strong>autonegocjacji (IEEE 802.3 Clause 28)</strong> — obie strony łącza wymieniają informacje o swoich możliwościach (obsługiwane prędkości, tryby dupleksu) i wybierają najlepszy wspólny mianownik. Ręczne, sztywne (ang. <em>hard-coded</em>) ustawienie prędkości/dupleksu tylko po jednej stronie łącza jest klasyczną przyczyną błędu <strong>duplex mismatch</strong>: jedna strona pracuje Full-Duplex, druga Half-Duplex, co objawia się dużą liczbą błędów CRC i pozornych „kolizji\" (rejestrowanych przez stronę Half-Duplex, mimo że w rzeczywistości drugie urządzenie po prostu nadaje i odbiera jednocześnie, co strona Half-Duplex błędnie interpretuje jako kolizję).</p>
<h3>5.5. Rodzaje przełączników</h3>
<table>
<thead>
<tr>
<th>Kryterium</th>
<th>Kategorie</th>
</tr>
</thead>
<tbody>
<tr>
<td>Zarządzalność</td>
<td><strong>niezarządzalne</strong> (plug-and-play, bez konfiguracji, typowe w małych sieciach domowych) / <strong>zarządzalne</strong> (konfiguracja VLAN-ów, STP, QoS, SNMP, zwykle przez interfejs webowy, CLI lub protokoły zarządzania)</td>
</tr>
<tr>
<td>Warstwa działania</td>
<td><strong>L2</strong> (czysto adresy MAC) / <strong>L3 (multilayer switch)</strong> — potrafi dodatkowo routing między VLAN-ami na podstawie adresów IP, łącząc funkcje przełącznika i routera w jednym urządzeniu sprzętowym</td>
</tr>
<tr>
<td>Forma fizyczna</td>
<td><strong>stałej konfiguracji (fixed configuration)</strong> — ustalona liczba portów / <strong>modularne (chassis-based)</strong> — z wymiennymi kartami liniowymi, stosowane w dużych sieciach szkieletowych i centrach danych</td>
</tr>
<tr>
<td>Przeznaczenie</td>
<td><strong>dostępowe</strong> (access) — obsługa urządzeń końcowych / <strong>agregujące/dystrybucyjne</strong> / <strong>rdzeniowe (core)</strong> — bardzo wysoka przepustowość macierzy przełączającej</td>
</tr>
<tr>
<td>Zasilanie portów</td>
<td>z <strong>PoE/PoE+/PoE++</strong> (zasilanie urządzeń końcowych, patrz materiał o skrętce miedzianej) lub bez</td>
</tr>
</tbody>
</table>
<h3>5.6. Wprowadzenie do VLAN — zapowiedź segmentacji logicznej</h3>
<p>Zarządzalne przełączniki umożliwiają podział pojedynczego urządzenia fizycznego na wiele <strong>wirtualnych sieci lokalnych (VLAN — Virtual LAN, IEEE 802.1Q)</strong>. Każdy port przełącznika przypisywany jest do określonego VLAN-u (lub, w trybie <em>trunk</em>, przenosi ruch wielu VLAN-ów jednocześnie, ze znacznikami 802.1Q w nagłówku ramki). Urządzenia w różnych VLAN-ach, nawet podłączone do tego samego przełącznika fizycznego, <strong>znajdują się w osobnych domenach rozgłoszeniowych</strong> i nie mogą się ze sobą komunikować bez pośrednictwa routera lub przełącznika warstwy 3. VLAN-y są jednym z głównych narzędzi <strong>segmentacji logicznej</strong> sieci, omówionej szczegółowo w rozdziale 7 — tu sygnalizujemy je jedynie jako naturalne rozszerzenie możliwości przełącznika, wykraczające poza podstawowy mechanizm mostkowania przezroczystego.</p>
<h3>5.7. Zalety przełączników względem koncentratorów</h3>
<p>Podsumowując rozdziały 2–5, przejście od koncentratorów do przełączników przyniosło sieciom lokalnym:</p>
<ul>
<li><strong>mikrosegmentację</strong> — każdy port to osobna domena kolizyjna, praktycznie eliminująca kolizje przy Full-Duplex;</li>
<li><strong>pełne wykorzystanie nominalnej przepływności</strong> na każdym porcie jednocześnie (agregowana przepustowość przełącznika 24-portowego 1 Gb/s Full-Duplex może w teorii wynieść nawet 48 Gb/s w obu kierunkach łącznie, o ile macierz przełączająca jest non-blocking);</li>
<li><strong>filtrowanie ruchu</strong> — ramki nie są niepotrzebnie powielane do segmentów, w których odbiorca nie występuje;</li>
<li><strong>bezpieczeństwo</strong> — ruch unicastowy między dwoma hostami nie jest fizycznie widoczny na pozostałych portach (utrudnia to prosty podsłuch, choć nie eliminuje go całkowicie — istnieją techniki ataku, jak zatruwanie tablicy CAM czy ataki ARP spoofing, wykraczające poza zakres tego materiału);</li>
<li><strong>elastyczność logicznej segmentacji</strong> dzięki VLAN-om;</li>
<li><strong>wsparcie dla zaawansowanych mechanizmów</strong> — QoS (priorytetyzacja ruchu), STP/RSTP (bezpieczna redundancja), Link Aggregation (łączenie wielu fizycznych portów w jedno logiczne łącze o zsumowanej przepustowości), zabezpieczenia portów (np. ograniczenie liczby adresów MAC na porcie, uwierzytelnianie 802.1X).</li>
</ul>
<hr />
<h2>6. Domena rozgłoszeniowa</h2>
<h3>6.1. Definicja</h3>
<p><strong>Domena rozgłoszeniowa (broadcast domain)</strong> to obszar sieci, do którego dociera ramka <strong>rozgłoszeniowa (broadcast)</strong> — wysłana na adres MAC <code>FF:FF:FF:FF:FF:FF</code> — wysłana przez dowolne urządzenie w tym obszarze. Innymi słowy: zbiór wszystkich urządzeń, które „usłyszą\" broadcast nadany przez którekolwiek z nich, bez pośrednictwa routingu.</p>
<p>To pojęcie jest fundamentalnie różne od domeny kolizyjnej, mimo że oba terminy bywają mylone przez początkujących. Kluczowa różnica ujęta jest w poniższej zasadzie:</p>
<blockquote>
<p><strong>Most i przełącznik DZIELĄ domeny kolizyjne, ale NIE DZIELĄ domeny rozgłoszeniowej. Tylko router (lub logiczny podział na VLAN-y wraz z routingiem między nimi) dzieli domenę rozgłoszeniową.</strong></p>
</blockquote>
<p>Wynika to wprost z algorytmu transparent bridging opisanego w rozdziale 4: ramka rozgłoszeniowa jest przez most/przełącznik <strong>zawsze</strong> przekazywana na wszystkie porty poza źródłowym — nie istnieje żaden mechanizm w warstwie 2, który filtrowałby broadcast na podstawie adresu docelowego (bo adres <code>FF:FF:FF:FF:FF:FF</code> z definicji oznacza „wszyscy\").</p>
<h3>6.2. Dlaczego ramki rozgłoszeniowe są potrzebne</h3>
<p>Zanim potraktujemy broadcast jako wyłącznie problem, warto przypomnieć, że pełni on <strong>niezbędną funkcję</strong>. Klasyczny przykład to protokół <strong>ARP (Address Resolution Protocol)</strong>: gdy komputer zna adres IP docelowy, ale nie zna odpowiadającego mu adresu MAC (niezbędnego do zbudowania nagłówka ramki Ethernet), wysyła <strong>zapytanie ARP jako broadcast</strong> — „kto ma adres IP X.X.X.X, proszę o odpowiedź ze swoim adresem MAC\". Ponieważ nadawca nie wie jeszcze, gdzie znajduje się odbiorca, jedynym sposobem dotarcia do niego jest wysłanie zapytania do wszystkich urządzeń w segmencie. Innymi typowymi źródłami ruchu rozgłoszeniowego są: zapytania <strong>DHCP Discover</strong> (urządzenie szukające serwera DHCP), niektóre protokoły odkrywania usług, stare protokoły routingu (np. RIPv1), czy powiadomienia Wake-on-LAN.</p>
<h3>6.3. Problem nadmiaru ruchu rozgłoszeniowego</h3>
<p>Skoro broadcast dociera do <strong>każdego</strong> urządzenia w domenie rozgłoszeniowej, a każde urządzenie musi go choćby przetworzyć (odebrać przerwanie, sprawdzić nagłówek, ewentualnie przekazać do wyższych warstw stosu), zbyt duża domena rozgłoszeniowa prowadzi do zjawiska określanego jako <strong>broadcast radiation</strong> (promieniowanie rozgłoszeniowe) — narastającej ilości ruchu broadcastowego, który zajmuje pasmo i moc obliczeniową procesorów wszystkich podłączonych urządzeń, nawet jeśli nie są one bezpośrednim adresatem konkretnej transmisji. W skrajnym przypadku — połączonym zwykle z błędem konfiguracji sieci (pętlą bez STP) — dochodzi do wspomnianej w rozdziale 4.4 <strong>burzy rozgłoszeniowej</strong>, praktycznie paraliżującej całą sieć.</p>
<p>Z tego powodu <strong>nie istnieje jeden „idealny\" rozmiar domeny rozgłoszeniowej</strong> — jest to kompromis, który administrator musi świadomie podejmować, uwzględniając liczbę urządzeń, charakter generowanego przez nie ruchu rozgłoszeniowego i wymagania dotyczące komunikacji między nimi. W praktyce orientacyjnie przyjmuje się, że domena rozgłoszeniowa licząca więcej niż kilkaset (typowo 200–500) aktywnych hostów zaczyna generować zauważalny narzut ruchu rozgłoszeniowego, choć dokładna granica silnie zależy od profilu aplikacji pracujących w sieci.</p>
<h3>6.4. Wizualizacja: domeny kolizyjne i rozgłoszeniowe razem</h3>
<p>Poniższy schemat zestawia oba pojęcia w jednej, złożonej topologii, łączącej hub, dwa przełączniki i router — dokładnie tak, jak mogłyby współistnieć w realnej, choć uproszczonej, sieci.</p>
<p><img alt=\"Domeny kolizyjne i rozgłoszeniowe w sieci z hubem, przełącznikami i routerem — router dzieli sieć na dwie domeny rozgłoszeniowe, a w ich obrębie przełączniki tworzą osobne mikrodomeny kolizyjne\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/domeny-topologia.svg\" /></p>
<p>Kluczowe wnioski płynące z powyższego schematu:</p>
<ul>
<li><strong>Liczba domen kolizyjnych</strong> w sieci z przełącznikami pracującymi Full-Duplex jest w praktyce równa <strong>liczbie aktywnych portów przełączników</strong> (każdy host na dedykowanym łączu = jedna mikrodomena) plus, jeśli występuje, liczba hub-ów (każdy hub, niezależnie od liczby podłączonych do niego hostów, to zawsze dokładnie <strong>jedna</strong> domena kolizyjna obejmująca wszystkie jego porty).</li>
<li><strong>Liczba domen rozgłoszeniowych</strong> jest równa liczbie interfejsów routera (lub, przy zastosowaniu VLAN-ów, liczbie skonfigurowanych sieci VLAN, z których każda wymaga własnego interfejsu routingu, aby komunikować się z pozostałymi).</li>
<li>Ramka rozgłoszeniowa nadana przez PC1 dotrze do PC2, PC3, PC4 i PC5 (cała domena rozgłoszeniowa A), ale <strong>nigdy</strong> nie dotrze do PC6, PC7 ani PC8 (domena rozgłoszeniowa B) — router z definicji nie przekazuje ruchu rozgłoszeniowego między swoimi interfejsami (każdy interfejs routera stanowi granicę domeny rozgłoszeniowej).</li>
</ul>
<h3>6.5. Tabela porównawcza: domena kolizyjna vs domena rozgłoszeniowa</h3>
<table>
<thead>
<tr>
<th>Cecha</th>
<th>Domena kolizyjna</th>
<th>Domena rozgłoszeniowa</th>
</tr>
</thead>
<tbody>
<tr>
<td>Definicja</td>
<td>obszar, w którym jednoczesna transmisja powoduje zderzenie sygnałów</td>
<td>obszar, do którego dociera ramka broadcast</td>
</tr>
<tr>
<td>Warstwa OSI, której dotyczy</td>
<td>1 (fizyczna)</td>
<td>2 (łącza danych)</td>
</tr>
<tr>
<td>Co ją dzieli</td>
<td>most, przełącznik, router</td>
<td><strong>wyłącznie</strong> router (lub VLAN + routing między VLAN-ami)</td>
</tr>
<tr>
<td>Co NIE dzieli</td>
<td>hub/repeater (nie dzieli w ogóle)</td>
<td>hub, most, przełącznik (żadne z nich nie dzieli)</td>
</tr>
<tr>
<td>Typowy dziś rozmiar we w pełni przełączanej sieci Full-Duplex</td>
<td>1 host na port (praktycznie nieistotna)</td>
<td>zależny od liczby VLAN-ów/interfejsów routingu</td>
</tr>
<tr>
<td>Główne zagrożenie przy nadmiernym rozmiarze</td>
<td>lawinowy wzrost liczby kolizji, spadek przepustowości (dotyczy głównie Half-Duplex)</td>
<td>nadmiar ruchu rozgłoszeniowego, ryzyko burzy rozgłoszeniowej</td>
</tr>
</tbody>
</table>
<hr />
<h2>7. Segmentacja sieci</h2>
<h3>7.1. Po co segmentować sieć</h3>
<p><strong>Segmentacja sieci</strong> to celowy podział większej sieci na mniejsze, logicznie lub fizycznie odseparowane fragmenty. Motywacje są liczne i częściowo się przenikają:</p>
<ul>
<li><strong>Ograniczenie rozmiaru domen kolizyjnych</strong> — dziś w dużej mierze zagadnienie historyczne, rozwiązane przez powszechne przejście na przełączniki Full-Duplex (rozdział 3.4), ale wciąż istotne tam, gdzie z jakiegoś powodu funkcjonują urządzenia Half-Duplex.</li>
<li><strong>Ograniczenie rozmiaru domen rozgłoszeniowych</strong> — kluczowy, wciąż aktualny powód segmentacji, realizowany przez routing i/lub VLAN-y.</li>
<li><strong>Bezpieczeństwo</strong> — odseparowanie ruchu wrażliwego (np. sieci zarządzania urządzeniami sieciowymi, systemów finansowo-księgowych) od ruchu ogólnego, ograniczenie zasięgu potencjalnego ataku (np. rozprzestrzeniania się złośliwego oprogramowania skanującego sieć lokalną) oraz umożliwienie precyzyjnej kontroli dostępu między segmentami za pomocą list kontroli dostępu (ACL) na routerze lub zaporze sieciowej.</li>
<li><strong>Wydajność i zarządzanie ruchem</strong> — oddzielenie ruchu o różnej charakterystyce (np. telefonii VoIP wymagającej niskiego opóźnienia od transferu dużych plików), łatwiejsza diagnostyka problemów w mniejszym, dobrze zdefiniowanym fragmencie sieci.</li>
<li><strong>Organizacyjne odwzorowanie struktury firmy</strong> — osobne segmenty dla poszczególnych działów, pięter budynku czy lokalizacji, ułatwiające administrację i rozliczanie kosztów.</li>
<li><strong>Zgodność z regulacjami</strong> — niektóre standardy branżowe (np. PCI DSS w sektorze płatności kartowych) wprost wymagają logicznego odseparowania systemów przetwarzających dane wrażliwe od reszty sieci.</li>
</ul>
<h3>7.2. Segmentacja fizyczna</h3>
<p>Najprostsza, historycznie pierwsza forma segmentacji polega na <strong>fizycznym rozdzieleniu</strong> sieci na osobne urządzenia lub osobne okablowanie — np. odrębne przełączniki dla różnych działów, połączone routerem. Zaletą jest prostota koncepcyjna i pełna separacja sprzętowa; wadą — mniejsza elastyczność (zmiana przynależności urządzenia do segmentu wymaga fizycznego przełączenia kabla) oraz zwykle wyższy koszt (więcej urządzeń fizycznych).</p>
<h3>7.3. Segmentacja logiczna — VLAN</h3>
<p>Współcześnie dominującą metodą segmentacji jest wykorzystanie <strong>sieci VLAN (Virtual LAN, IEEE 802.1Q)</strong>, wprowadzonych już w rozdziale 5.6. VLAN pozwala na <strong>logiczny</strong> podział pojedynczej infrastruktury fizycznej (tych samych przełączników, tego samego okablowania) na wiele odseparowanych domen rozgłoszeniowych, bez konieczności fizycznego rozdzielania sprzętu.</p>
<p>Mechanizm działania w skrócie:</p>
<ul>
<li>każdy port przełącznika przypisywany jest do jednego VLAN-u w trybie <strong>access</strong> (typowo porty do urządzeń końcowych) lub przenosi ruch wielu VLAN-ów jednocześnie w trybie <strong>trunk</strong> (typowo połączenia między przełącznikami lub do routera), gdzie każda ramka opatrywana jest 4-bajtowym znacznikiem <strong>802.1Q</strong> identyfikującym VLAN, z którego pochodzi (patrz materiał o strukturze ramki Ethernet, rozdział o tagowaniu VLAN);</li>
<li>przełącznik utrzymuje <strong>osobną tablicę adresów MAC dla każdego VLAN-u</strong> i nigdy nie przekazuje ramki (w tym ramki rozgłoszeniowej) między portami należącymi do różnych VLAN-ów;</li>
<li>komunikacja między urządzeniami w <strong>różnych</strong> VLAN-ach wymaga przejścia przez <strong>router</strong> (fizyczny, z osobnym interfejsem lub podinterfejsami na jednym łączu trunk — konfiguracja znana jako <strong>router-on-a-stick</strong>) lub przez <strong>przełącznik warstwy 3 (multilayer switch)</strong>, który realizuje routing między VLAN-ami (tzw. <strong>inter-VLAN routing</strong>) sprzętowo, z pełną prędkością portów.</li>
</ul>
<p>Zalety VLAN-ów względem czystej segmentacji fizycznej: pełna elastyczność (przeniesienie urządzenia do innego segmentu logicznego to zmiana konfiguracji portu, nie okablowania), lepsze wykorzystanie infrastruktury fizycznej (jeden zestaw przełączników obsługuje wiele logicznych sieci), możliwość rozciągnięcia tego samego segmentu logicznego na wiele lokalizacji fizycznych (przy odpowiedniej konfiguracji trunków), granularna kontrola bezpieczeństwa.</p>
<h3>7.4. Segmentacja a routing — gdzie kończy się warstwa 2, a zaczyna warstwa 3</h3>
<p>Kluczowe rozróżnienie kompetencji:</p>
<ul>
<li><strong>Przełącznik (warstwa 2)</strong> segreguje ruch <strong>wewnątrz</strong> jednej domeny rozgłoszeniowej (lub, przy VLAN-ach, utrzymuje wiele osobnych domen na jednym urządzeniu fizycznym), opierając decyzje wyłącznie na adresach MAC.</li>
<li><strong>Router (warstwa 3)</strong> — lub przełącznik warstwy 3 pełniący tę rolę — umożliwia komunikację <strong>między</strong> różnymi domenami rozgłoszeniowymi (różnymi sieciami/podsieciami IP), opierając decyzje na adresach IP i tablicy routingu, oraz — co równie istotne — <strong>naturalnie blokuje</strong> propagację ruchu rozgłoszeniowego między tymi domenami (chyba że administrator jawnie skonfiguruje mechanizm przekazywania rozgłoszeń, np. IP Helper dla DHCP, co jest jednak świadomym wyjątkiem, a nie zachowaniem domyślnym).</li>
</ul>
<p>Ta współpraca — przełączniki segmentujące logicznie za pomocą VLAN-ów, router (lub przełącznik L3) łączący te segmenty i kontrolujący ruch między nimi — stanowi fundament architektury niemal każdej współczesnej sieci lokalnej, od małego biura po rozległy kampus korporacyjny.</p>
<h3>7.5. Przykład praktyczny</h3>
<p>Rozważmy biuro ze 120 pracownikami podzielonymi na trzy działy: sprzedaż, księgowość i IT, wszystkie podłączone do wspólnej infrastruktury przełączników. Bez segmentacji wszystkie 120 stacji stanowiłoby jedną domenę rozgłoszeniową — każde zapytanie ARP, każdy broadcast DHCP docierałby do wszystkich. Po segmentacji na trzy VLAN-y (np. VLAN 10 — sprzedaż, VLAN 20 — księgowość, VLAN 30 — IT), każdy dział otrzymuje własną, mniejszą domenę rozgłoszeniową, co ogranicza narzut broadcastowy do ok. 40 hostów na segment. Dodatkowo administrator może skonfigurować na routerze (lub przełączniku L3) listy ACL blokujące np. bezpośredni dostęp z VLAN-u sprzedaży do serwerów księgowości, realizując w ten sposób politykę bezpieczeństwa niemożliwą do wyegzekwowania w płaskiej, niesegmentowanej sieci.</p>
<hr />
<h2>8. Zbiorcze porównanie urządzeń warstwy dostępu</h2>
<table>
<thead>
<tr>
<th>Urządzenie</th>
<th>Warstwa OSI</th>
<th>Decyzja podejmowana na podstawie</th>
<th>Dzieli domenę kolizyjną?</th>
<th>Dzieli domenę rozgłoszeniową?</th>
<th>Typowa liczba portów</th>
<th>Tryb pracy</th>
</tr>
</thead>
<tbody>
<tr>
<td>Repeater</td>
<td>1</td>
<td>brak</td>
<td>nie</td>
<td>nie</td>
<td>2</td>
<td>regeneracja sygnału</td>
</tr>
<tr>
<td>Hub</td>
<td>1</td>
<td>brak</td>
<td>nie</td>
<td>nie</td>
<td>4–24</td>
<td>Half-Duplex, zalewanie zawsze</td>
</tr>
<tr>
<td>Most (bridge)</td>
<td>2</td>
<td>adres MAC</td>
<td><strong>tak</strong></td>
<td>nie</td>
<td>2–4 (klasycznie)</td>
<td>uczenie się, filtrowanie, zalewanie nieznanych</td>
</tr>
<tr>
<td>Przełącznik (switch)</td>
<td>2 (lub 2+3 dla L3)</td>
<td>adres MAC (i/lub IP dla L3)</td>
<td><strong>tak</strong></td>
<td>nie (tak, jeśli pełni funkcję L3 z inter-VLAN routing)</td>
<td>kilka–kilkaset</td>
<td>zwykle Full-Duplex, VLAN, STP</td>
</tr>
<tr>
<td>Router</td>
<td>3</td>
<td>adres IP / tablica routingu</td>
<td>tak</td>
<td><strong>tak</strong></td>
<td>zwykle niewiele (kilka–kilkanaście)</td>
<td>routing między sieciami</td>
</tr>
</tbody>
</table>
<p>Powyższa tabela stanowi syntezę całego materiału: przesuwając się od repeatera do routera, każde kolejne urządzenie „widzi\" więcej informacji o ruchu (od surowych bitów, przez adresy fizyczne, po adresy logiczne z tablicą tras) i w efekcie potrafi podejmować coraz bardziej precyzyjne decyzje o segmentacji ruchu.</p>
<hr />
<h2>9. Podsumowanie</h2>
<p>Ewolucja urządzeń warstwy dostępu — od koncentratora, przez most, po współczesny przełącznik — jest ilustracją ogólniejszej zasady w projektowaniu sieci: <strong>im więcej informacji o ruchu urządzenie potrafi odczytać, tym bardziej precyzyjnie może nim zarządzać</strong>. Koncentrator, działający wyłącznie w warstwie fizycznej, nie ma wyboru — musi powielić każdy sygnał na wszystkie porty, tworząc jedną, wspólną domenę kolizyjną i marnując pasmo. Most i jego sprzętowy następca, przełącznik, odczytując adresy MAC, potrafią podejmować świadome decyzje o przekazywaniu lub filtrowaniu ramek, dzieląc domeny kolizyjne — ale z racji samej natury adresu rozgłoszeniowego wciąż muszą przekazywać broadcast wszędzie w obrębie swojej sieci.</p>
<p>Rozróżnienie <strong>domeny kolizyjnej</strong> i <strong>domeny rozgłoszeniowej</strong> — mimo że we współczesnych, w pełni przełączanych sieciach Full-Duplex ta pierwsza straciła w dużej mierze praktyczne znaczenie — pozostaje fundamentalnym narzędziem pojęciowym do zrozumienia, dlaczego architektura sieci wymaga zarówno przełączników (dla wydajnego przekazywania ruchu wewnątrz segmentu), jak i routerów lub VLAN-ów wraz z routingiem między nimi (dla kontrolowania zasięgu ruchu rozgłoszeniowego i realizacji polityki bezpieczeństwa). Świadome zaprojektowanie segmentacji sieci — decyzja o tym, ile i jak dużych domen rozgłoszeniowych utworzyć, gdzie postawić granice VLAN-ów i jak połączyć je routingiem — jest jedną z podstawowych kompetencji każdego administratora sieci.</p>
<hr />
<h2>10. Słownik podstawowych pojęć</h2>
<table>
<thead>
<tr>
<th>Pojęcie</th>
<th>Znaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>ASIC</strong></td>
<td>dedykowany układ scalony realizujący przełączanie sprzętowo, z prędkością liniową</td>
</tr>
<tr>
<td><strong>Broadcast storm</strong></td>
<td>burza rozgłoszeniowa — niekontrolowane, lawinowe krążenie ramek broadcastowych w pętli sieciowej</td>
</tr>
<tr>
<td><strong>CAM (Content-Addressable Memory)</strong></td>
<td>typ pamięci sprzętowej używanej do realizacji tablicy adresów MAC przełącznika</td>
</tr>
<tr>
<td><strong>Cut-Through</strong></td>
<td>metoda przełączania rozpoczynająca retransmisję zaraz po odczytaniu adresu docelowego</td>
</tr>
<tr>
<td><strong>Duplex mismatch</strong></td>
<td>błąd konfiguracji, w którym dwa końce łącza mają różne ustawienia trybu dupleksu</td>
</tr>
<tr>
<td><strong>Flooding (zalewanie)</strong></td>
<td>przekazanie ramki na wszystkie porty poza źródłowym, stosowane dla nieznanych adresów i rozgłoszeń</td>
</tr>
<tr>
<td><strong>Fragment-Free</strong></td>
<td>metoda przełączania odczekująca na pierwsze 64 B ramki przed retransmisją</td>
</tr>
<tr>
<td><strong>Inter-VLAN routing</strong></td>
<td>routing między różnymi sieciami VLAN, realizowany przez router lub przełącznik warstwy 3</td>
</tr>
<tr>
<td><strong>Router-on-a-stick</strong></td>
<td>konfiguracja, w której jeden fizyczny interfejs routera, podzielony na podinterfejsy, obsługuje routing między wieloma VLAN-ami</td>
</tr>
<tr>
<td><strong>Store-and-Forward</strong></td>
<td>metoda przełączania odbierająca całą ramkę i weryfikująca FCS przed retransmisją</td>
</tr>
<tr>
<td><strong>STP (Spanning Tree Protocol)</strong></td>
<td>protokół zapobiegający pętlom w sieciach z redundantnymi połączeniami mostów/przełączników</td>
</tr>
<tr>
<td><strong>Transparent bridging</strong></td>
<td>algorytm mostkowania przezroczystego: uczenie się, przekazywanie/filtrowanie, starzenie, zalewanie</td>
</tr>
<tr>
<td><strong>VLAN (Virtual LAN)</strong></td>
<td>logiczny podział sieci fizycznej na wiele odseparowanych domen rozgłoszeniowych</td>
</tr>
</tbody>
</table>
<hr />
<h2>11. Pytania kontrolne</h2>
<ol>
<li>Wyjaśnij, dlaczego koncentrator (hub) nazywany jest „wieloportowym repeaterem\" i jakie wynikają z tego ograniczenia dla wydajności sieci.</li>
<li>Na czym polega różnica między domeną kolizyjną a domeną rozgłoszeniową? Podaj po jednym przykładzie urządzenia, które dzieli tylko pierwszą z nich, oraz urządzenia, które dzieli obie.</li>
<li>Opisz cztery mechanizmy składające się na algorytm mostkowania przezroczystego (transparent bridging): uczenie się, przekazywanie/filtrowanie, starzenie się wpisów i zalewanie.</li>
<li>Dlaczego ramka rozgłoszeniowa jest zawsze przekazywana przez most/przełącznik na wszystkie porty, niezależnie od zawartości tablicy adresów MAC?</li>
<li>Co to jest burza rozgłoszeniowa i w jakich okolicznościach może wystąpić? Jaki protokół zapobiega temu zjawisku i na czym polega jego działanie w skrócie?</li>
<li>Porównaj trzy metody przełączania: Store-and-Forward, Cut-Through i Fragment-Free — pod względem momentu rozpoczęcia retransmisji, opóźnienia i zdolności do filtrowania uszkodzonych ramek.</li>
<li>Dlaczego przy pracy w trybie Full-Duplex pojęcie domeny kolizyjnej traci praktyczne znaczenie? Co dokładnie uniemożliwia fizyczne wystąpienie kolizji w takim trybie?</li>
<li>Wyjaśnij, w jaki sposób sieci VLAN pozwalają na logiczną segmentację ruchu bez fizycznego rozdzielania infrastruktury. Co jest wymagane, aby urządzenia w dwóch różnych VLAN-ach mogły się ze sobą komunikować?</li>
<li>Podaj co najmniej trzy różne motywacje stojące za segmentacją sieci (inne niż wyłącznie ograniczenie domeny kolizyjnej) i krótko uzasadnij każdą z nich.</li>
<li>Mając sieć złożoną z jednego routera, dwóch przełączników (po 8 aktywnych portów Full-Duplex każdy) oraz jednego 4-portowego hub-a podłączonego do jednego z portów pierwszego przełącznika (z trzema komputerami na hub-ie), określ: (a) liczbę domen rozgłoszeniowych, (b) liczbę domen kolizyjnych w tej sieci.</li>
</ol>
<h3>Klucz odpowiedzi do pytania 10</h3>
<p><strong>(a) Domeny rozgłoszeniowe:</strong> router ma tylko jedno „ramię\" schodzące do przełączników (w tym uproszczonym scenariuszu bez VLAN-ów) — cała sieć za przełącznikami stanowi <strong>jedną</strong> domenę rozgłoszeniową (zakładając brak dodatkowych interfejsów routera prowadzących do innych segmentów).</p>
<p><strong>(b) Domeny kolizyjne:</strong> pierwszy przełącznik ma 8 portów, z czego 7 prowadzi bezpośrednio do pojedynczych hostów (7 osobnych mikrodomen kolizyjnych Full-Duplex) i 1 prowadzi do hub-a (który sam w sobie stanowi <strong>jedną</strong> wspólną domenę kolizyjną obejmującą wszystkie 3 podłączone do niego komputery oraz port przełącznika). Drugi przełącznik ma 8 portów, z czego 8 osobnych mikrodomen kolizyjnych. Łącznie: <span class=\"mathjax mathjax--inline\">\\(7 + 1 + 8 = \\mathbf{16}\\)</span> domen kolizyjnych (7 z pierwszego przełącznika + 1 z hub-a + 8 z drugiego przełącznika).</p>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDefaultEscapeStrategy(): string|false
    {
        return "html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<h1>Koncentratory, mosty i przełączniki. Segmentacja, domeny kolizyjne i rozgłoszeniowe</h1>
<h2>Wprowadzenie</h2>
<p>Sieć lokalna nie jest jednorodną, niezróżnicowaną masą kabli — to zbiór urządzeń pośredniczących, z których każde odgrywa inną rolę w przekazywaniu sygnału i podejmowaniu decyzji o tym, dokąd ma trafić dana ramka. Historia rozwoju sieci Ethernet jest w dużej mierze historią stopniowego „mądrzenia się\" tych urządzeń pośredniczących: od prostego wzmacniacza sygnału, przez urządzenie odczytujące adresy fizyczne i podejmujące decyzje przekazywania, aż po współczesny przełącznik zarządzalny, który potrafi tworzyć wirtualne sieci, ograniczać ruch rozgłoszeniowy i współpracować z routingiem.</p>
<p>Ten materiał koncentruje się na trzech klasach urządzeń warstwy dostępu — <strong>koncentratorach (hubach)</strong>, <strong>mostach (bridge\x27ach)</strong> i <strong>przełącznikach (switchach)</strong> — oraz na dwóch pojęciach, które są kluczem do zrozumienia, dlaczego w ogóle segmentujemy sieci: <strong>domenie kolizyjnej</strong> i <strong>domenie rozgłoszeniowej</strong>. Zrozumienie tych pojęć pozwala świadomie projektować sieć: wiedzieć, gdzie umieścić przełącznik, kiedy sięgnąć po VLAN, a kiedy konieczny jest router.</p>
<hr />
<h2>1. Warstwa dostępu i hierarchia urządzeń sieciowych</h2>
<h3>1.1. Warstwa dostępu w projektowaniu sieci</h3>
<p>W klasycznym, hierarchicznym modelu projektowania sieci kampusowych (popularyzowanym m.in. przez Cisco) wyróżnia się trzy warstwy:</p>
<ul>
<li><strong>warstwa dostępu (access layer)</strong> — miejsce, w którym urządzenia końcowe (komputery, drukarki, telefony IP, punkty dostępowe Wi-Fi) fizycznie łączą się z siecią; tu pracują przełączniki dostępowe, tu podejmowane są pierwsze decyzje o przynależności do VLAN-u i tu egzekwowane są podstawowe zabezpieczenia portów;</li>
<li><strong>warstwa dystrybucji (distribution layer)</strong> — agreguje ruch z wielu przełączników dostępowych, realizuje routing między VLAN-ami, filtrację i politykę bezpieczeństwa;</li>
<li><strong>warstwa rdzenia (core layer)</strong> — szybkie przełączanie/routing dużych wolumenów ruchu między warstwami dystrybucji, bez zbędnej filtracji, aby zminimalizować opóźnienie.</li>
</ul>
<p>Ten materiał dotyczy przede wszystkim urządzeń typowych dla warstwy dostępu i mechanizmów, które decydują o tym, jak duży fragment sieci „widzi\" pojedyncza ramka — czy to unikatowa (unicast), czy rozgłoszeniowa (broadcast).</p>
<h3>1.2. Urządzenia sieciowe według warstwy modelu OSI</h3>
<p>Kluczem do zrozumienia różnic między hubem, mostem/przełącznikiem a routerem jest to, <strong>w której warstwie modelu OSI dane urządzenie „czyta\" informacje</strong>, zanim podejmie decyzję o przekazaniu sygnału dalej:</p>
<table>
<thead>
<tr>
<th>Urządzenie</th>
<th>Warstwa OSI</th>
<th>Na czym podejmuje decyzję</th>
<th>Co przekazuje</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Repeater / regenerator</strong></td>
<td>1 (fizyczna)</td>
<td>brak decyzji — wzmacnia i retransmituje każdy sygnał</td>
<td>bity</td>
</tr>
<tr>
<td><strong>Koncentrator (hub)</strong></td>
<td>1 (fizyczna)</td>
<td>brak decyzji — wieloportowy repeater</td>
<td>bity</td>
</tr>
<tr>
<td><strong>Most (bridge)</strong></td>
<td>2 (łącza danych)</td>
<td>adres MAC docelowy</td>
<td>ramki</td>
</tr>
<tr>
<td><strong>Przełącznik (switch)</strong></td>
<td>2 (łącza danych), niektóre modele także 3</td>
<td>adres MAC docelowy (L2) lub adres IP (L3 switch)</td>
<td>ramki (lub pakiety w trybie L3)</td>
</tr>
<tr>
<td><strong>Router</strong></td>
<td>3 (sieciowa)</td>
<td>adres IP docelowy i tablica routingu</td>
<td>pakiety</td>
</tr>
</tbody>
</table>
<p>Ta tabela jest mapą drogową całego materiału: im wyżej w modelu OSI urządzenie „patrzy\" na dane, tym więcej inteligentnych decyzji może podjąć — kosztem większej złożoności i (nieco) większego opóźnienia przetwarzania.</p>
<hr />
<h2>2. Koncentratory (Hubs)</h2>
<h3>2.1. Definicja i zasada działania</h3>
<p><strong>Koncentrator (hub)</strong> to urządzenie warstwy fizycznej — w istocie <strong>wieloportowy wzmacniacz sygnału (repeater)</strong>. Hub nie analizuje żadnych nagłówków ramek, nie odczytuje adresów MAC, nie podejmuje żadnych decyzji o kierunku przekazania danych. Jego działanie sprowadza się do jednej, prostej operacji: <strong>sygnał elektryczny, który dotrze na dowolny port, jest regenerowany (wzmacniany i „odświeżany\" pod względem kształtu impulsów) i wysyłany jednocześnie na wszystkie pozostałe porty</strong>.</p>
<p>Z perspektywy logiki sieciowej hub przekształca fizyczną topologię gwiazdy (kable biegnące do centralnego punktu) w <strong>logiczną topologię magistrali (bus)</strong> — działa dokładnie tak, jakby wszystkie podłączone urządzenia były spięte jednym wspólnym kablem koncentrycznym, tak jak w najwcześniejszych instalacjach Ethernetu (10BASE5, 10BASE2).</p>
<h3>2.2. Konsekwencje braku inteligencji</h3>
<p>Ponieważ hub powiela sygnał na wszystkie porty bez wyjątku, wynikają z tego poważne konsekwencje:</p>
<ol>
<li><strong>Medium współdzielone (shared medium).</strong> W danej chwili tylko jedno urządzenie podłączone do hub-a może nadawać, nie powodując kolizji. Wszystkie porty hub-a stanowią <strong>jedną, wspólną domenę kolizyjną</strong> — zagadnienie to rozwijamy szczegółowo w rozdziale 3.</li>
<li><strong>Praca wyłącznie w trybie Half-Duplex.</strong> Skoro urządzenia współdzielą medium i muszą nasłuchiwać przed nadawaniem (CSMA/CD), transmisja nie może odbywać się jednocześnie w obu kierunkach na tym samym łączu — nadawanie i odbiór wykluczają się wzajemnie.</li>
<li><strong>Brak filtrowania ruchu.</strong> Ramka wysłana przez PC-A do PC-B zostanie i tak dostarczona fizycznie do <strong>wszystkich</strong> pozostałych portów — PC-C i PC-D „usłyszą\" tę transmisję, mimo że nie są jej adresatem; ich karty sieciowe po prostu odrzucą ramkę na podstawie niezgodnego adresu MAC docelowego, ale medium przez cały czas trwania tej transmisji jest zajęte dla wszystkich.</li>
<li><strong>Sumowanie się przepustowości.</strong> Cała nominalna przepływność łącza (np. 10 lub 100 Mb/s) jest <strong>dzielona między wszystkie podłączone urządzenia</strong> — im więcej hostów na hub-ie, tym mniej pasma przypada statystycznie na każdego z nich, a rywalizacja o dostęp do medium (i liczba kolizji) rośnie.</li>
<li><strong>Brak wsparcia dla Gigabit Ethernet w praktyce.</strong> Standard 1000BASE-T formalnie dopuszcza pracę Half-Duplex z repeaterem, ale w praktyce urządzenia takie nigdy nie zyskały popularności rynkowej — Gigabit Ethernet od początku projektowano z myślą o przełącznikach i pracy Full-Duplex.</li>
</ol>
<p><img alt=\"Koncentrator (hub) — cały segment sieci stanowi jedną, wspólną domenę kolizyjną\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/hub-domena-kolizyjna.svg\" /></p>
<h3>2.3. Hub aktywny i pasywny</h3>
<p>Rozróżnia się:</p>
<ul>
<li><strong>hub pasywny</strong> — jedynie łączy elektrycznie przewody (bez wzmacniania sygnału); dziś praktycznie niespotykany, ograniczony do bardzo krótkich odległości;</li>
<li><strong>hub aktywny</strong> — regeneruje (wzmacnia i resynchronizuje) sygnał na każdym porcie, dzięki czemu można zachować pełną, dopuszczalną długość segmentów kablowych na każdym z odcinków.</li>
</ul>
<h3>2.4. Dlaczego huby zniknęły z nowoczesnych sieci</h3>
<p>Wraz ze spadkiem cen układów scalonych realizujących przełączanie, <strong>przełączniki stały się tańsze niż utrzymanie wydajności sieci opartej na hubach</strong>, a jednocześnie oferowały wielokrotnie wyższą efektywną przepustowość (patrz rozdział 5). Dziś huby praktycznie zniknęły z produkcji i z nowych instalacji — spotyka się je niemal wyłącznie w kontekście edukacyjnym (do demonstrowania zjawiska kolizji) lub w wyspecjalizowanych zastosowaniach diagnostycznych (tzw. <strong>network tap</strong>, urządzenie do pasywnego podsłuchu ruchu na potrzeby analizatorów pakietów, gdzie celowo wykorzystuje się właściwość „powielania sygnału na wszystkie porty\").</p>
<h3>2.5. Zalety i wady koncentratorów</h3>
<p><strong>Zalety (głównie historyczne):</strong> bardzo niski koszt, prostota działania, brak opóźnienia przetwarzania (poza czasem propagacji sygnału i regeneracji), łatwość diagnostyki (cały ruch widoczny na każdym porcie).</p>
<p><strong>Wady:</strong> jedna wspólna domena kolizyjna ograniczająca skalowalność, praca wyłącznie Half-Duplex, brak filtrowania ruchu (marnotrawstwo pasma), brak wsparcia dla VLAN-ów i jakichkolwiek mechanizmów bezpieczeństwa portów, ograniczona maksymalna liczba huby połączonych kaskadowo (tzw. <strong>reguła 5-4-3</strong> w 10 Mb/s Ethernet: maksymalnie 5 segmentów, 4 repeatery/huby, z czego tylko 3 segmenty obsadzone hostami — wynikająca z limitu czasowego działania CSMA/CD, patrz materiał o ramce Ethernet).</p>
<hr />
<h2>3. Domena kolizyjna</h2>
<h3>3.1. Definicja</h3>
<p><strong>Domena kolizyjna (collision domain)</strong> to obszar sieci, w którym <strong>jednoczesna transmisja dwóch (lub więcej) urządzeń powoduje wzajemne zakłócenie (kolizję) ich sygnałów</strong>. Innymi słowy — to zbiór urządzeń współdzielących jedno medium fizyczne na tyle blisko pod względem topologii, że ich sygnały elektryczne mogą się wzajemnie „zderzyć\".</p>
<p>Domena kolizyjna jest ściśle związana z mechanizmem <strong>CSMA/CD</strong> (Carrier Sense Multiple Access with Collision Detection), stosowanym w klasycznych sieciach Ethernet pracujących w trybie Half-Duplex: stacja nasłuchuje medium przed nadawaniem, a jeśli mimo to dojdzie do jednoczesnej transmisji dwóch stacji, obie wykrywają kolizję, przerywają nadawanie, wysyłają sygnał zagłuszający (JAM) i po losowym czasie (algorytm Backoff) próbują ponownie.</p>
<h3>3.2. Jak poszczególne urządzenia wpływają na rozmiar domeny kolizyjnej</h3>
<table>
<thead>
<tr>
<th>Urządzenie</th>
<th>Wpływ na domenę kolizyjną</th>
</tr>
</thead>
<tbody>
<tr>
<td>Kabel koncentryczny (10BASE5/10BASE2)</td>
<td>wszystkie stacje na wspólnym kablu = jedna domena kolizyjna</td>
</tr>
<tr>
<td>Repeater / hub</td>
<td><strong>nie dzieli</strong> domeny kolizyjnej — wszystkie połączone porty nadal stanowią jedną, wspólną domenę</td>
</tr>
<tr>
<td>Most / przełącznik</td>
<td><strong>dzieli</strong> domenę kolizyjną — każdy port to osobna domena kolizyjna</td>
</tr>
<tr>
<td>Router</td>
<td>dzieli domenę kolizyjną (i dodatkowo domenę rozgłoszeniową)</td>
</tr>
</tbody>
</table>
<p>Ta różnica jest fundamentalna i tłumaczy, dlaczego przełącznik jest urządzeniem jakościowo innym niż hub, mimo pozornego podobieństwa (oba mają wiele portów RJ-45 i pośredniczą w komunikacji urządzeń w sieci lokalnej).</p>
<h3>3.3. Konsekwencje wielkości domeny kolizyjnej</h3>
<p>Im <strong>większa</strong> domena kolizyjna (więcej stacji współdzielących medium), tym:</p>
<ul>
<li><strong>więcej kolizji statystycznie</strong> — prawdopodobieństwo, że dwie stacje zaczną nadawać niemal jednocześnie, rośnie z liczbą aktywnych urządzeń;</li>
<li><strong>niższa efektywna przepustowość</strong> — czas i pasmo „marnowane\" na wykrywanie kolizji, wysyłanie sygnału JAM i odczekiwanie losowego czasu Backoff nie są dostępne dla użytecznej transmisji danych; przy silnym obciążeniu efektywne wykorzystanie łącza Half-Duplex w praktyce może spaść nawet do 30–40% nominalnej przepływności;</li>
<li><strong>większe opóźnienie</strong> — retransmisje po kolizji wydłużają czas dostarczenia danych, a przy wielu kolizjach z rzędu algorytm wykładniczego Backoff znacząco wydłuża oczekiwanie (patrz materiał o ramce Ethernet, rozdział o algorytmie Backoff).</li>
</ul>
<h3>3.4. Full-Duplex jako eliminacja kolizji</h3>
<p>We współczesnych sieciach opartych na przełącznikach, w których każde urządzenie ma dedykowane, punkt-punktowe połączenie z portem przełącznika, a transmisja i odbiór odbywają się na osobnych parach przewodów (lub osobnych długościach fali w światłowodzie), możliwa jest praca w trybie <strong>Full-Duplex</strong>. W tym trybie <strong>kolizje są fizycznie niemożliwe</strong> — nie ma współdzielonego medium, na którym mogłyby wystąpić. Mechanizm CSMA/CD zostaje wtedy całkowicie wyłączony w mikrokodzie karty sieciowej i przełącznika.</p>
<p>Z formalnego punktu widzenia każdy port przełącznika pracującego Full-Duplex nadal „technicznie\" stanowi osobną, jednoelementową domenę kolizyjną (zawiera dokładnie dwa urządzenia: kartę sieciową hosta i port przełącznika, połączone dedykowanym łączem) — ale ponieważ kolizja nie może w niej fizycznie zajść, pojęcie to traci praktyczne znaczenie diagnostyczne we współczesnych, w pełni przełączanych sieciach.</p>
<p><img alt=\"Przełącznik — każdy port stanowi osobną, mikroskopijną domenę kolizyjną; przy Full-Duplex kolizje są fizycznie niemożliwe\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/switch-domeny-kolizyjne.svg\" /></p>
<h3>3.5. Jak sprawdzić granice domeny kolizyjnej w praktyce</h3>
<p>Praktyczną wskazówką jest pytanie: <em>„Gdyby dwa urządzenia w tym obszarze nadały jednocześnie, czy ich sygnały zderzyłyby się fizycznie?\"</em> Jeśli odpowiedź brzmi „tak\" — znajdują się w tej samej domenie kolizyjnej. Diagnostycznie w systemie Linux rosnący licznik kolizji (<code>collisions</code>) w statystykach interfejsu pracującego w trybie Half-Duplex sygnalizuje przeciążoną lub zbyt rozległą domenę kolizyjną; we współczesnych sieciach Full-Duplex licznik ten <strong>powinien pozostawać zerowy</strong> — jego wzrost wskazuje zwykle na błąd konfiguracji (tzw. <strong>duplex mismatch</strong> — niezgodność ustawień dupleksu między dwoma końcami łącza).</p>
<hr />
<h2>4. Mosty (Bridges)</h2>
<h3>4.1. Geneza i motywacja</h3>
<p>Wraz z rozrostem wczesnych sieci Ethernet opartych na wspólnym medium (kablu koncentrycznym, a później hub-ach) administratorzy napotykali twardą barierę: powiększanie jednej, wspólnej domeny kolizyjnej ponad pewien rozmiar prowadziło do lawinowego wzrostu liczby kolizji i drastycznego spadku efektywnej przepustowości. Rozwiązaniem okazało się urządzenie, które — w przeciwieństwie do repeatera/hub-a — <strong>odczytuje adresy MAC</strong> zawarte w ramkach i <strong>podejmuje decyzję</strong>, czy dana ramka rzeczywiście musi zostać przekazana do drugiego segmentu sieci, czy też jej odbiorca znajduje się już w tym samym segmencie, z którego nadeszła (a więc przekazywanie byłoby zbędne). Takie urządzenie nazwano <strong>mostem (bridge)</strong>.</p>
<h3>4.2. Definicja i zasada działania</h3>
<p><strong>Most (bridge)</strong> to urządzenie warstwy 2 modelu OSI, łączące dwa (lub więcej) segmenty sieci w taki sposób, że:</p>
<ul>
<li><strong>odczytuje adres MAC źródłowy i docelowy</strong> każdej odbieranej ramki,</li>
<li><strong>buduje i utrzymuje tablicę adresów MAC</strong> widzianych na poszczególnych swoich portach (interfejsach),</li>
<li>na tej podstawie <strong>podejmuje decyzję</strong>: przekazać ramkę na drugi segment, czy odrzucić ją (bo odbiorca znajduje się w tym samym segmencie, z którego ramka nadeszła — nie ma potrzeby jej powielania).</li>
</ul>
<p>Most <strong>dzieli domenę kolizyjną</strong> — segmenty po obu jego stronach stanowią osobne domeny kolizyjne — ale <strong>nie dzieli domeny rozgłoszeniowej</strong>: ramka rozgłoszeniowa (broadcast) jest zawsze przekazywana przez most na wszystkie pozostałe segmenty, ponieważ z definicji jest ona adresowana do wszystkich.</p>
<h3>4.3. Algorytm mostkowania przezroczystego (Transparent Bridging)</h3>
<p>Najpowszechniej stosowanym algorytmem pracy mostu (i, jak zobaczymy w rozdziale 5, także przełącznika) jest <strong>mostkowanie przezroczyste (transparent bridging)</strong>, opisane w standardzie <strong>IEEE 802.1D</strong>. Nazwa „przezroczyste\" oznacza, że urządzenia końcowe <strong>nie muszą wiedzieć o istnieniu mostu</strong> — działa on w pełni automatycznie, bez konieczności ręcznej konfiguracji tablic adresowych. Algorytm opiera się na czterech mechanizmach.</p>
<h4>a) Uczenie się (Learning)</h4>
<p>Dla każdej odbieranej ramki most odczytuje <strong>adres MAC źródłowy</strong> oraz <strong>numer portu</strong>, na którym ramka dotarła, i zapisuje tę parę (adres MAC → port) w swojej tablicy adresów. W ten sposób most stopniowo, w sposób całkowicie automatyczny, „uczy się\" topologii sieci — po jakimś czasie zna lokalizację (port) każdego aktywnego urządzenia w sieci.</p>
<h4>b) Przekazywanie i filtrowanie (Forwarding / Filtering)</h4>
<p>Dla adresu MAC <strong>docelowego</strong> odbieranej ramki most sprawdza swoją tablicę:</p>
<ul>
<li>jeśli adres docelowy jest <strong>znany</strong> i znajduje się na <strong>innym</strong> porcie niż ten, z którego nadeszła ramka — most <strong>przekazuje</strong> ramkę wyłącznie na ten jeden, właściwy port (<strong>forwarding</strong>);</li>
<li>jeśli adres docelowy jest <strong>znany</strong> i znajduje się na <strong>tym samym</strong> porcie, z którego nadeszła ramka — oznacza to, że nadawca i odbiorca są w tym samym segmencie, a most <strong>odrzuca</strong> ramkę, nie przekazując jej dalej (<strong>filtering</strong>); to właśnie ten mechanizm odciąża ruch między segmentami;</li>
<li>jeśli adres docelowy jest <strong>nieznany</strong> (brak wpisu w tablicy) — most przekazuje ramkę na <strong>wszystkie</strong> porty poza tym, z którego nadeszła (<strong>flooding</strong>, zalewanie) — to jedyny bezpieczny sposób, by mieć pewność, że ramka dotrze do adresata, którego lokalizacja nie jest jeszcze znana;</li>
<li>jeśli adres docelowy jest <strong>rozgłoszeniowy</strong> (<code>FF:FF:FF:FF:FF:FF</code>) lub grupowy (multicast) — most zawsze przekazuje ramkę na wszystkie porty poza portem źródłowym.</li>
</ul>
<h4>c) Starzenie się wpisów (Aging)</h4>
<p>Każdy wpis w tablicy adresów MAC opatrzony jest znacznikiem czasu. Jeśli przez określony czas (domyślnie zwykle <strong>300 sekund</strong>) most nie zaobserwuje żadnej ramki z danym adresem źródłowym na zapisanym porcie, wpis jest <strong>usuwany</strong>. Mechanizm ten pozwala sieci dostosować się do zmian topologii — np. przeniesienia urządzenia do innego portu lub jego odłączenia — bez ręcznej interwencji administratora, kosztem tego, że pierwsza ramka do „zapomnianego\" adresu ponownie wywoła zalewanie.</p>
<h4>d) Zalewanie (Flooding) dla nieznanych adresów</h4>
<p>Jak wspomniano w punkcie b), zalewanie jest mechanizmem awaryjnym stosowanym zawsze, gdy most nie ma jeszcze wiedzy o lokalizacji odbiorcy. W dużych, aktywnych sieciach zalewanie występuje relatywnie rzadko po początkowym okresie „uczenia się\", ale w sieciach o dużej liczbie rzadko komunikujących się urządzeń (np. gdy wpisy wygasają między kolejnymi transmisjami) może stanowić zauważalny narzut.</p>
<h3>4.4. Most a problem pętli — wprowadzenie do STP</h3>
<p>Jeśli w sieci istnieją <strong>dwa lub więcej mostów (lub przełączników) połączonych w taki sposób, że tworzą fizyczną pętlę</strong> (np. dla redundancji, na wypadek awarii jednego łącza), mechanizm zalewania nieznanych adresów i ramek rozgłoszeniowych prowadzi do katastrofalnego zjawiska zwanego <strong>burzą rozgłoszeniową (broadcast storm)</strong>: ta sama ramka rozgłoszeniowa krąży w pętli w nieskończoność, a każdy most/przełącznik na jej drodze wciąż ją powiela na wszystkie porty, mnożąc ruch wykładniczo, aż do całkowitego zapchania sieci.</p>
<p>Rozwiązaniem tego problemu jest protokół <strong>STP (Spanning Tree Protocol, IEEE 802.1D)</strong>, który automatycznie wykrywa pętle w topologii i <strong>blokuje logicznie nadmiarowe łącza</strong> (przechodzą one w stan blokowania, nie przekazując ruchu użytkownika, ale pozostając aktywnymi „w rezerwie\"), tworząc na potrzeby przekazywania ramek drzewo rozpinające bez pętli (stąd nazwa — <em>spanning tree</em>, drzewo rozpinające). Gdy aktywne łącze ulegnie awarii, STP automatycznie przelicza topologię i aktywuje wcześniej zablokowane łącze zapasowe. Zagadnienie STP i jego następców (RSTP, MSTP) jest na tyle obszerne, że zasługuje na osobne, szczegółowe opracowanie — w tym materiale sygnalizujemy je jedynie jako niezbędny kontekst do zrozumienia, dlaczego mosty/przełączniki nie mogą być łączone w dowolne pętle bez dodatkowych mechanizmów zabezpieczających.</p>
<h3>4.5. Rodzaje mostów (nota historyczna)</h3>
<p>W literaturze rozróżnia się kilka odmian mostów, choć w praktyce współczesnych sieci Ethernet dominuje transparent bridging:</p>
<ul>
<li><strong>mosty przezroczyste (transparent bridges)</strong> — opisany wyżej, dominujący w sieciach Ethernet;</li>
<li><strong>mosty ze źródłowym trasowaniem (source-route bridging)</strong> — stosowane historycznie w sieciach Token Ring, gdzie to stacja nadawcza (a nie most) decydowała o trasie ramki na podstawie informacji zebranej wcześniej przez specjalne ramki odkrywające; dziś praktycznie nieużywane wraz z zanikiem Token Ring;</li>
<li><strong>mosty translacyjne (translational bridges)</strong> — łączące segmenty o różnych technologiach warstwy 2 (np. Ethernet i Token Ring), wymagające przekształcenia formatu ramki.</li>
</ul>
<h3>4.6. Most a przełącznik — czy to to samo?</h3>
<p>Koncepcyjnie <strong>przełącznik jest bezpośrednim, sprzętowo zoptymalizowanym następcą mostu</strong> — realizuje dokładnie ten sam algorytm transparent bridging (uczenie się, przekazywanie/filtrowanie, starzenie, zalewanie), lecz różni się przede wszystkim:</p>
<ul>
<li><strong>implementacją</strong> — most tradycyjnie był urządzeniem programowym, realizującym przełączanie w oprogramowaniu na ogólnego przeznaczenia procesorze, obsługującym zwykle niewiele portów (2–4); przełącznik realizuje te same decyzje sprzętowo, w dedykowanych układach ASIC, co pozwala obsługiwać dziesiątki lub setki portów z pełną prędkością łącza jednocześnie (tzw. przełączanie <strong>non-blocking</strong>, z przepustowością macierzy przełączającej — <em>switching fabric</em> — wystarczającą, by obsłużyć ruch na wszystkich portach jednocześnie bez utraty wydajności);</li>
<li><strong>liczbą portów</strong> — klasyczny most miał zwykle 2–4 porty, łącząc niewielką liczbę segmentów; przełącznik ma zazwyczaj kilkanaście do kilkudziesięciu portów, a każdy z nich traktowany jest de facto jako osobny, jednoportowy „segment\" mostkowany;</li>
<li><strong>terminologią rynkową</strong> — w praktyce od końca lat 90. XX wieku termin „przełącznik\" niemal całkowicie wyparł w kontekście Ethernetu termin „most\", choć formalnie w wielu standardach (w tym w nazwach protokołów, np. <em>Spanning Tree Protocol</em> działa na urządzeniach nazywanych w dokumentach IEEE „bridges\") stara terminologia przetrwała.</li>
</ul>
<p>Można zatem powiedzieć: <strong>każdy przełącznik Ethernet jest, z technicznego punktu widzenia, wieloportowym mostem</strong> — a rozróżnienie „most vs przełącznik\" ma dziś głównie znaczenie historyczne i edukacyjne, pomocne w zrozumieniu ewolucji urządzeń warstwy 2.</p>
<hr />
<h2>5. Przełączniki (Switches)</h2>
<h3>5.1. Przełącznik jako sprzętowa realizacja mostkowania</h3>
<p><strong>Przełącznik (switch)</strong> to urządzenie warstwy 2 modelu OSI, realizujące algorytm transparent bridging (opisany w rozdziale 4) w dedykowanym sprzęcie (układach ASIC — Application-Specific Integrated Circuit), co pozwala na podejmowanie decyzji o przekazywaniu ramek z prędkością liniową (<em>wire speed</em>) na wielu portach jednocześnie, bez zauważalnego opóźnienia przetwarzania. To właśnie przełącznik jest dziś absolutnie podstawowym, wszechobecnym urządzeniem każdej przewodowej sieci lokalnej.</p>
<h3>5.2. Tablica adresów MAC (CAM)</h3>
<p>Sercem działania przełącznika jest <strong>tablica adresów MAC</strong>, często określana skrótem <strong>CAM</strong> (Content-Addressable Memory) — od typu pamięci sprzętowej, w której jest fizycznie zaimplementowana. Pamięć CAM pozwala na <strong>wyszukiwanie skojarzone z zawartością</strong> (podanie adresu MAC jako klucza zwraca natychmiast numer portu) w czasie stałym, niezależnym od liczby wpisów — co jest kluczowe dla zachowania prędkości liniowej przy tysiącach wpisów.</p>
<p>Każdy wpis w tablicy CAM zawiera typowo:</p>
<ul>
<li><strong>adres MAC</strong> urządzenia,</li>
<li><strong>numer portu</strong>, na którym to urządzenie zostało zaobserwowane,</li>
<li><strong>identyfikator VLAN</strong>, do którego należy dany wpis (we współczesnych przełącznikach zarządzalnych, patrz rozdział 5.6),</li>
<li><strong>znacznik czasu</strong> (do mechanizmu starzenia się wpisów).</li>
</ul>
<p><img alt=\"Proces uczenia się adresów MAC przez przełącznik i podejmowania decyzji o przekazaniu lub zalaniu ramki\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/przelacznik-tablica-mac.svg\" /></p>
<h3>5.3. Metody przełączania</h3>
<p>Producenci przełączników stosują kilka odmiennych strategii dotyczących tego, <strong>w którym momencie odbioru ramki przełącznik rozpoczyna jej retransmisję</strong> na port docelowy. Wybór strategii to kompromis między <strong>opóźnieniem</strong> a <strong>niezawodnością</strong> (unikaniem przekazywania uszkodzonych ramek).</p>
<h4>Store-and-Forward (składuj i przekaż)</h4>
<p>Przełącznik <strong>odbiera całą ramkę w buforze</strong>, oblicza i weryfikuje sumę kontrolną <strong>FCS (CRC-32)</strong>, i dopiero po potwierdzeniu, że ramka jest bezbłędna, rozpoczyna jej przekazywanie na port docelowy. Jest to metoda <strong>najbezpieczniejsza</strong> — uszkodzone ramki są odrzucane i nigdy nie trafiają dalej do sieci — kosztem <strong>największego opóźnienia</strong>, proporcjonalnego do długości ramki (im dłuższa ramka, tym dłużej trzeba czekać na jej pełne odebranie przed retransmisją). Metoda ta dominuje we współczesnych przełącznikach, ponieważ dodatkowe opóźnienie (rzędu mikrosekund przy typowych prędkościach łączy) jest w praktyce pomijalne, a korzyści w postaci niefiltrowania uszkodzonych ramek — istotne. Store-and-Forward jest też jedyną metodą pozwalającą na <strong>łączenie portów o różnych prędkościach</strong> (np. port 1 Gb/s przekazujący do portu 100 Mb/s) — bez pełnego buforowania ramki nie da się bezpiecznie dopasować różnych szybkości transmisji.</p>
<h4>Cut-Through (przelotowe)</h4>
<p>Przełącznik zaczyna retransmisję ramki <strong>natychmiast po odczytaniu adresu MAC docelowego</strong> — czyli już po odebraniu pierwszych ok. 14 bajtów ramki (pola: adres docelowy i częściowo adres źródłowy) — bez czekania na resztę danych ani na weryfikację sumy FCS. Zapewnia to <strong>minimalne możliwe opóźnienie</strong>, kosztem ryzyka przekazania dalej uszkodzonej ramki (błąd zostanie wykryty dopiero przez kartę sieciową odbiorcy końcowego, na podstawie FCS, i ramka zostanie tam odrzucona — ale zdążyła już zająć pasmo w dalszej części sieci).</p>
<h4>Fragment-Free (bez fragmentów)</h4>
<p>Rozwiązanie pośrednie: przełącznik odczekuje na odebranie pierwszych <strong>64 bajtów</strong> ramki przed rozpoczęciem retransmisji. Wartość 64 bajtów nie jest przypadkowa — to dokładnie minimalny dopuszczalny rozmiar poprawnej ramki Ethernet (patrz materiał o strukturze ramki Ethernet, rozdział o minimalnym rozmiarze ramki). Większość uszkodzeń powstałych na skutek kolizji w sieciach Half-Duplex objawia się jako tzw. <strong>fragmenty kolizyjne (collision fragments)</strong> — ramki krótsze niż 64 bajty. Odczekanie na pierwsze 64 bajty pozwala odfiltrować niemal wszystkie tego typu uszkodzone fragmenty, przy opóźnieniu znacznie mniejszym niż pełny Store-and-Forward.</p>
<p><img alt=\"Porównanie momentu rozpoczęcia retransmisji ramki: Store-and-Forward, Cut-Through i Fragment-Free\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/metody-przelaczania-switch.svg\" /></p>
<table>
<thead>
<tr>
<th>Metoda</th>
<th>Moment rozpoczęcia przekazywania</th>
<th>Opóźnienie</th>
<th>Filtrowanie błędów</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>Store-and-Forward</td>
<td>po odebraniu całej ramki i weryfikacji FCS</td>
<td>największe (zależne od długości ramki)</td>
<td>pełne</td>
<td>jedyna metoda umożliwiająca zmianę prędkości portów; dominująca dziś</td>
</tr>
<tr>
<td>Cut-Through</td>
<td>po odczytaniu adresu MAC docelowego (~14 B)</td>
<td>minimalne, stałe</td>
<td>brak</td>
<td>ryzyko przekazania uszkodzonej ramki dalej</td>
</tr>
<tr>
<td>Fragment-Free</td>
<td>po odebraniu pierwszych 64 B</td>
<td>pośrednie</td>
<td>częściowe (odrzuca fragmenty kolizyjne)</td>
<td>kompromis między szybkością a bezpieczeństwem</td>
</tr>
</tbody>
</table>
<p>W praktyce współczesnych, w pełni przełączanych sieci Full-Duplex (gdzie fragmenty kolizyjne w ogóle nie powstają, bo kolizji nie ma) różnica między metodami traci część swojego pierwotnego uzasadnienia, a wiele nowoczesnych przełączników stosuje <strong>adaptacyjne</strong> podejście — działa w trybie cut-through, dopóki na danym porcie licznik błędów FCS pozostaje niski, i automatycznie przełącza się na store-and-forward, jeśli wykryje podwyższony poziom błędów.</p>
<h3>5.4. Przełącznik a duplex i autonegocjacja</h3>
<p>Nowoczesne przełączniki pracują niemal wyłącznie w trybie <strong>Full-Duplex</strong> na łączach point-to-point z każdym urządzeniem końcowym. Zgodność prędkości i trybu dupleksu między portem przełącznika a kartą sieciową urządzenia ustalana jest automatycznie przez mechanizm <strong>autonegocjacji (IEEE 802.3 Clause 28)</strong> — obie strony łącza wymieniają informacje o swoich możliwościach (obsługiwane prędkości, tryby dupleksu) i wybierają najlepszy wspólny mianownik. Ręczne, sztywne (ang. <em>hard-coded</em>) ustawienie prędkości/dupleksu tylko po jednej stronie łącza jest klasyczną przyczyną błędu <strong>duplex mismatch</strong>: jedna strona pracuje Full-Duplex, druga Half-Duplex, co objawia się dużą liczbą błędów CRC i pozornych „kolizji\" (rejestrowanych przez stronę Half-Duplex, mimo że w rzeczywistości drugie urządzenie po prostu nadaje i odbiera jednocześnie, co strona Half-Duplex błędnie interpretuje jako kolizję).</p>
<h3>5.5. Rodzaje przełączników</h3>
<table>
<thead>
<tr>
<th>Kryterium</th>
<th>Kategorie</th>
</tr>
</thead>
<tbody>
<tr>
<td>Zarządzalność</td>
<td><strong>niezarządzalne</strong> (plug-and-play, bez konfiguracji, typowe w małych sieciach domowych) / <strong>zarządzalne</strong> (konfiguracja VLAN-ów, STP, QoS, SNMP, zwykle przez interfejs webowy, CLI lub protokoły zarządzania)</td>
</tr>
<tr>
<td>Warstwa działania</td>
<td><strong>L2</strong> (czysto adresy MAC) / <strong>L3 (multilayer switch)</strong> — potrafi dodatkowo routing między VLAN-ami na podstawie adresów IP, łącząc funkcje przełącznika i routera w jednym urządzeniu sprzętowym</td>
</tr>
<tr>
<td>Forma fizyczna</td>
<td><strong>stałej konfiguracji (fixed configuration)</strong> — ustalona liczba portów / <strong>modularne (chassis-based)</strong> — z wymiennymi kartami liniowymi, stosowane w dużych sieciach szkieletowych i centrach danych</td>
</tr>
<tr>
<td>Przeznaczenie</td>
<td><strong>dostępowe</strong> (access) — obsługa urządzeń końcowych / <strong>agregujące/dystrybucyjne</strong> / <strong>rdzeniowe (core)</strong> — bardzo wysoka przepustowość macierzy przełączającej</td>
</tr>
<tr>
<td>Zasilanie portów</td>
<td>z <strong>PoE/PoE+/PoE++</strong> (zasilanie urządzeń końcowych, patrz materiał o skrętce miedzianej) lub bez</td>
</tr>
</tbody>
</table>
<h3>5.6. Wprowadzenie do VLAN — zapowiedź segmentacji logicznej</h3>
<p>Zarządzalne przełączniki umożliwiają podział pojedynczego urządzenia fizycznego na wiele <strong>wirtualnych sieci lokalnych (VLAN — Virtual LAN, IEEE 802.1Q)</strong>. Każdy port przełącznika przypisywany jest do określonego VLAN-u (lub, w trybie <em>trunk</em>, przenosi ruch wielu VLAN-ów jednocześnie, ze znacznikami 802.1Q w nagłówku ramki). Urządzenia w różnych VLAN-ach, nawet podłączone do tego samego przełącznika fizycznego, <strong>znajdują się w osobnych domenach rozgłoszeniowych</strong> i nie mogą się ze sobą komunikować bez pośrednictwa routera lub przełącznika warstwy 3. VLAN-y są jednym z głównych narzędzi <strong>segmentacji logicznej</strong> sieci, omówionej szczegółowo w rozdziale 7 — tu sygnalizujemy je jedynie jako naturalne rozszerzenie możliwości przełącznika, wykraczające poza podstawowy mechanizm mostkowania przezroczystego.</p>
<h3>5.7. Zalety przełączników względem koncentratorów</h3>
<p>Podsumowując rozdziały 2–5, przejście od koncentratorów do przełączników przyniosło sieciom lokalnym:</p>
<ul>
<li><strong>mikrosegmentację</strong> — każdy port to osobna domena kolizyjna, praktycznie eliminująca kolizje przy Full-Duplex;</li>
<li><strong>pełne wykorzystanie nominalnej przepływności</strong> na każdym porcie jednocześnie (agregowana przepustowość przełącznika 24-portowego 1 Gb/s Full-Duplex może w teorii wynieść nawet 48 Gb/s w obu kierunkach łącznie, o ile macierz przełączająca jest non-blocking);</li>
<li><strong>filtrowanie ruchu</strong> — ramki nie są niepotrzebnie powielane do segmentów, w których odbiorca nie występuje;</li>
<li><strong>bezpieczeństwo</strong> — ruch unicastowy między dwoma hostami nie jest fizycznie widoczny na pozostałych portach (utrudnia to prosty podsłuch, choć nie eliminuje go całkowicie — istnieją techniki ataku, jak zatruwanie tablicy CAM czy ataki ARP spoofing, wykraczające poza zakres tego materiału);</li>
<li><strong>elastyczność logicznej segmentacji</strong> dzięki VLAN-om;</li>
<li><strong>wsparcie dla zaawansowanych mechanizmów</strong> — QoS (priorytetyzacja ruchu), STP/RSTP (bezpieczna redundancja), Link Aggregation (łączenie wielu fizycznych portów w jedno logiczne łącze o zsumowanej przepustowości), zabezpieczenia portów (np. ograniczenie liczby adresów MAC na porcie, uwierzytelnianie 802.1X).</li>
</ul>
<hr />
<h2>6. Domena rozgłoszeniowa</h2>
<h3>6.1. Definicja</h3>
<p><strong>Domena rozgłoszeniowa (broadcast domain)</strong> to obszar sieci, do którego dociera ramka <strong>rozgłoszeniowa (broadcast)</strong> — wysłana na adres MAC <code>FF:FF:FF:FF:FF:FF</code> — wysłana przez dowolne urządzenie w tym obszarze. Innymi słowy: zbiór wszystkich urządzeń, które „usłyszą\" broadcast nadany przez którekolwiek z nich, bez pośrednictwa routingu.</p>
<p>To pojęcie jest fundamentalnie różne od domeny kolizyjnej, mimo że oba terminy bywają mylone przez początkujących. Kluczowa różnica ujęta jest w poniższej zasadzie:</p>
<blockquote>
<p><strong>Most i przełącznik DZIELĄ domeny kolizyjne, ale NIE DZIELĄ domeny rozgłoszeniowej. Tylko router (lub logiczny podział na VLAN-y wraz z routingiem między nimi) dzieli domenę rozgłoszeniową.</strong></p>
</blockquote>
<p>Wynika to wprost z algorytmu transparent bridging opisanego w rozdziale 4: ramka rozgłoszeniowa jest przez most/przełącznik <strong>zawsze</strong> przekazywana na wszystkie porty poza źródłowym — nie istnieje żaden mechanizm w warstwie 2, który filtrowałby broadcast na podstawie adresu docelowego (bo adres <code>FF:FF:FF:FF:FF:FF</code> z definicji oznacza „wszyscy\").</p>
<h3>6.2. Dlaczego ramki rozgłoszeniowe są potrzebne</h3>
<p>Zanim potraktujemy broadcast jako wyłącznie problem, warto przypomnieć, że pełni on <strong>niezbędną funkcję</strong>. Klasyczny przykład to protokół <strong>ARP (Address Resolution Protocol)</strong>: gdy komputer zna adres IP docelowy, ale nie zna odpowiadającego mu adresu MAC (niezbędnego do zbudowania nagłówka ramki Ethernet), wysyła <strong>zapytanie ARP jako broadcast</strong> — „kto ma adres IP X.X.X.X, proszę o odpowiedź ze swoim adresem MAC\". Ponieważ nadawca nie wie jeszcze, gdzie znajduje się odbiorca, jedynym sposobem dotarcia do niego jest wysłanie zapytania do wszystkich urządzeń w segmencie. Innymi typowymi źródłami ruchu rozgłoszeniowego są: zapytania <strong>DHCP Discover</strong> (urządzenie szukające serwera DHCP), niektóre protokoły odkrywania usług, stare protokoły routingu (np. RIPv1), czy powiadomienia Wake-on-LAN.</p>
<h3>6.3. Problem nadmiaru ruchu rozgłoszeniowego</h3>
<p>Skoro broadcast dociera do <strong>każdego</strong> urządzenia w domenie rozgłoszeniowej, a każde urządzenie musi go choćby przetworzyć (odebrać przerwanie, sprawdzić nagłówek, ewentualnie przekazać do wyższych warstw stosu), zbyt duża domena rozgłoszeniowa prowadzi do zjawiska określanego jako <strong>broadcast radiation</strong> (promieniowanie rozgłoszeniowe) — narastającej ilości ruchu broadcastowego, który zajmuje pasmo i moc obliczeniową procesorów wszystkich podłączonych urządzeń, nawet jeśli nie są one bezpośrednim adresatem konkretnej transmisji. W skrajnym przypadku — połączonym zwykle z błędem konfiguracji sieci (pętlą bez STP) — dochodzi do wspomnianej w rozdziale 4.4 <strong>burzy rozgłoszeniowej</strong>, praktycznie paraliżującej całą sieć.</p>
<p>Z tego powodu <strong>nie istnieje jeden „idealny\" rozmiar domeny rozgłoszeniowej</strong> — jest to kompromis, który administrator musi świadomie podejmować, uwzględniając liczbę urządzeń, charakter generowanego przez nie ruchu rozgłoszeniowego i wymagania dotyczące komunikacji między nimi. W praktyce orientacyjnie przyjmuje się, że domena rozgłoszeniowa licząca więcej niż kilkaset (typowo 200–500) aktywnych hostów zaczyna generować zauważalny narzut ruchu rozgłoszeniowego, choć dokładna granica silnie zależy od profilu aplikacji pracujących w sieci.</p>
<h3>6.4. Wizualizacja: domeny kolizyjne i rozgłoszeniowe razem</h3>
<p>Poniższy schemat zestawia oba pojęcia w jednej, złożonej topologii, łączącej hub, dwa przełączniki i router — dokładnie tak, jak mogłyby współistnieć w realnej, choć uproszczonej, sieci.</p>
<p><img alt=\"Domeny kolizyjne i rozgłoszeniowe w sieci z hubem, przełącznikami i routerem — router dzieli sieć na dwie domeny rozgłoszeniowe, a w ich obrębie przełączniki tworzą osobne mikrodomeny kolizyjne\" src=\"/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci/domeny-topologia.svg\" /></p>
<p>Kluczowe wnioski płynące z powyższego schematu:</p>
<ul>
<li><strong>Liczba domen kolizyjnych</strong> w sieci z przełącznikami pracującymi Full-Duplex jest w praktyce równa <strong>liczbie aktywnych portów przełączników</strong> (każdy host na dedykowanym łączu = jedna mikrodomena) plus, jeśli występuje, liczba hub-ów (każdy hub, niezależnie od liczby podłączonych do niego hostów, to zawsze dokładnie <strong>jedna</strong> domena kolizyjna obejmująca wszystkie jego porty).</li>
<li><strong>Liczba domen rozgłoszeniowych</strong> jest równa liczbie interfejsów routera (lub, przy zastosowaniu VLAN-ów, liczbie skonfigurowanych sieci VLAN, z których każda wymaga własnego interfejsu routingu, aby komunikować się z pozostałymi).</li>
<li>Ramka rozgłoszeniowa nadana przez PC1 dotrze do PC2, PC3, PC4 i PC5 (cała domena rozgłoszeniowa A), ale <strong>nigdy</strong> nie dotrze do PC6, PC7 ani PC8 (domena rozgłoszeniowa B) — router z definicji nie przekazuje ruchu rozgłoszeniowego między swoimi interfejsami (każdy interfejs routera stanowi granicę domeny rozgłoszeniowej).</li>
</ul>
<h3>6.5. Tabela porównawcza: domena kolizyjna vs domena rozgłoszeniowa</h3>
<table>
<thead>
<tr>
<th>Cecha</th>
<th>Domena kolizyjna</th>
<th>Domena rozgłoszeniowa</th>
</tr>
</thead>
<tbody>
<tr>
<td>Definicja</td>
<td>obszar, w którym jednoczesna transmisja powoduje zderzenie sygnałów</td>
<td>obszar, do którego dociera ramka broadcast</td>
</tr>
<tr>
<td>Warstwa OSI, której dotyczy</td>
<td>1 (fizyczna)</td>
<td>2 (łącza danych)</td>
</tr>
<tr>
<td>Co ją dzieli</td>
<td>most, przełącznik, router</td>
<td><strong>wyłącznie</strong> router (lub VLAN + routing między VLAN-ami)</td>
</tr>
<tr>
<td>Co NIE dzieli</td>
<td>hub/repeater (nie dzieli w ogóle)</td>
<td>hub, most, przełącznik (żadne z nich nie dzieli)</td>
</tr>
<tr>
<td>Typowy dziś rozmiar we w pełni przełączanej sieci Full-Duplex</td>
<td>1 host na port (praktycznie nieistotna)</td>
<td>zależny od liczby VLAN-ów/interfejsów routingu</td>
</tr>
<tr>
<td>Główne zagrożenie przy nadmiernym rozmiarze</td>
<td>lawinowy wzrost liczby kolizji, spadek przepustowości (dotyczy głównie Half-Duplex)</td>
<td>nadmiar ruchu rozgłoszeniowego, ryzyko burzy rozgłoszeniowej</td>
</tr>
</tbody>
</table>
<hr />
<h2>7. Segmentacja sieci</h2>
<h3>7.1. Po co segmentować sieć</h3>
<p><strong>Segmentacja sieci</strong> to celowy podział większej sieci na mniejsze, logicznie lub fizycznie odseparowane fragmenty. Motywacje są liczne i częściowo się przenikają:</p>
<ul>
<li><strong>Ograniczenie rozmiaru domen kolizyjnych</strong> — dziś w dużej mierze zagadnienie historyczne, rozwiązane przez powszechne przejście na przełączniki Full-Duplex (rozdział 3.4), ale wciąż istotne tam, gdzie z jakiegoś powodu funkcjonują urządzenia Half-Duplex.</li>
<li><strong>Ograniczenie rozmiaru domen rozgłoszeniowych</strong> — kluczowy, wciąż aktualny powód segmentacji, realizowany przez routing i/lub VLAN-y.</li>
<li><strong>Bezpieczeństwo</strong> — odseparowanie ruchu wrażliwego (np. sieci zarządzania urządzeniami sieciowymi, systemów finansowo-księgowych) od ruchu ogólnego, ograniczenie zasięgu potencjalnego ataku (np. rozprzestrzeniania się złośliwego oprogramowania skanującego sieć lokalną) oraz umożliwienie precyzyjnej kontroli dostępu między segmentami za pomocą list kontroli dostępu (ACL) na routerze lub zaporze sieciowej.</li>
<li><strong>Wydajność i zarządzanie ruchem</strong> — oddzielenie ruchu o różnej charakterystyce (np. telefonii VoIP wymagającej niskiego opóźnienia od transferu dużych plików), łatwiejsza diagnostyka problemów w mniejszym, dobrze zdefiniowanym fragmencie sieci.</li>
<li><strong>Organizacyjne odwzorowanie struktury firmy</strong> — osobne segmenty dla poszczególnych działów, pięter budynku czy lokalizacji, ułatwiające administrację i rozliczanie kosztów.</li>
<li><strong>Zgodność z regulacjami</strong> — niektóre standardy branżowe (np. PCI DSS w sektorze płatności kartowych) wprost wymagają logicznego odseparowania systemów przetwarzających dane wrażliwe od reszty sieci.</li>
</ul>
<h3>7.2. Segmentacja fizyczna</h3>
<p>Najprostsza, historycznie pierwsza forma segmentacji polega na <strong>fizycznym rozdzieleniu</strong> sieci na osobne urządzenia lub osobne okablowanie — np. odrębne przełączniki dla różnych działów, połączone routerem. Zaletą jest prostota koncepcyjna i pełna separacja sprzętowa; wadą — mniejsza elastyczność (zmiana przynależności urządzenia do segmentu wymaga fizycznego przełączenia kabla) oraz zwykle wyższy koszt (więcej urządzeń fizycznych).</p>
<h3>7.3. Segmentacja logiczna — VLAN</h3>
<p>Współcześnie dominującą metodą segmentacji jest wykorzystanie <strong>sieci VLAN (Virtual LAN, IEEE 802.1Q)</strong>, wprowadzonych już w rozdziale 5.6. VLAN pozwala na <strong>logiczny</strong> podział pojedynczej infrastruktury fizycznej (tych samych przełączników, tego samego okablowania) na wiele odseparowanych domen rozgłoszeniowych, bez konieczności fizycznego rozdzielania sprzętu.</p>
<p>Mechanizm działania w skrócie:</p>
<ul>
<li>każdy port przełącznika przypisywany jest do jednego VLAN-u w trybie <strong>access</strong> (typowo porty do urządzeń końcowych) lub przenosi ruch wielu VLAN-ów jednocześnie w trybie <strong>trunk</strong> (typowo połączenia między przełącznikami lub do routera), gdzie każda ramka opatrywana jest 4-bajtowym znacznikiem <strong>802.1Q</strong> identyfikującym VLAN, z którego pochodzi (patrz materiał o strukturze ramki Ethernet, rozdział o tagowaniu VLAN);</li>
<li>przełącznik utrzymuje <strong>osobną tablicę adresów MAC dla każdego VLAN-u</strong> i nigdy nie przekazuje ramki (w tym ramki rozgłoszeniowej) między portami należącymi do różnych VLAN-ów;</li>
<li>komunikacja między urządzeniami w <strong>różnych</strong> VLAN-ach wymaga przejścia przez <strong>router</strong> (fizyczny, z osobnym interfejsem lub podinterfejsami na jednym łączu trunk — konfiguracja znana jako <strong>router-on-a-stick</strong>) lub przez <strong>przełącznik warstwy 3 (multilayer switch)</strong>, który realizuje routing między VLAN-ami (tzw. <strong>inter-VLAN routing</strong>) sprzętowo, z pełną prędkością portów.</li>
</ul>
<p>Zalety VLAN-ów względem czystej segmentacji fizycznej: pełna elastyczność (przeniesienie urządzenia do innego segmentu logicznego to zmiana konfiguracji portu, nie okablowania), lepsze wykorzystanie infrastruktury fizycznej (jeden zestaw przełączników obsługuje wiele logicznych sieci), możliwość rozciągnięcia tego samego segmentu logicznego na wiele lokalizacji fizycznych (przy odpowiedniej konfiguracji trunków), granularna kontrola bezpieczeństwa.</p>
<h3>7.4. Segmentacja a routing — gdzie kończy się warstwa 2, a zaczyna warstwa 3</h3>
<p>Kluczowe rozróżnienie kompetencji:</p>
<ul>
<li><strong>Przełącznik (warstwa 2)</strong> segreguje ruch <strong>wewnątrz</strong> jednej domeny rozgłoszeniowej (lub, przy VLAN-ach, utrzymuje wiele osobnych domen na jednym urządzeniu fizycznym), opierając decyzje wyłącznie na adresach MAC.</li>
<li><strong>Router (warstwa 3)</strong> — lub przełącznik warstwy 3 pełniący tę rolę — umożliwia komunikację <strong>między</strong> różnymi domenami rozgłoszeniowymi (różnymi sieciami/podsieciami IP), opierając decyzje na adresach IP i tablicy routingu, oraz — co równie istotne — <strong>naturalnie blokuje</strong> propagację ruchu rozgłoszeniowego między tymi domenami (chyba że administrator jawnie skonfiguruje mechanizm przekazywania rozgłoszeń, np. IP Helper dla DHCP, co jest jednak świadomym wyjątkiem, a nie zachowaniem domyślnym).</li>
</ul>
<p>Ta współpraca — przełączniki segmentujące logicznie za pomocą VLAN-ów, router (lub przełącznik L3) łączący te segmenty i kontrolujący ruch między nimi — stanowi fundament architektury niemal każdej współczesnej sieci lokalnej, od małego biura po rozległy kampus korporacyjny.</p>
<h3>7.5. Przykład praktyczny</h3>
<p>Rozważmy biuro ze 120 pracownikami podzielonymi na trzy działy: sprzedaż, księgowość i IT, wszystkie podłączone do wspólnej infrastruktury przełączników. Bez segmentacji wszystkie 120 stacji stanowiłoby jedną domenę rozgłoszeniową — każde zapytanie ARP, każdy broadcast DHCP docierałby do wszystkich. Po segmentacji na trzy VLAN-y (np. VLAN 10 — sprzedaż, VLAN 20 — księgowość, VLAN 30 — IT), każdy dział otrzymuje własną, mniejszą domenę rozgłoszeniową, co ogranicza narzut broadcastowy do ok. 40 hostów na segment. Dodatkowo administrator może skonfigurować na routerze (lub przełączniku L3) listy ACL blokujące np. bezpośredni dostęp z VLAN-u sprzedaży do serwerów księgowości, realizując w ten sposób politykę bezpieczeństwa niemożliwą do wyegzekwowania w płaskiej, niesegmentowanej sieci.</p>
<hr />
<h2>8. Zbiorcze porównanie urządzeń warstwy dostępu</h2>
<table>
<thead>
<tr>
<th>Urządzenie</th>
<th>Warstwa OSI</th>
<th>Decyzja podejmowana na podstawie</th>
<th>Dzieli domenę kolizyjną?</th>
<th>Dzieli domenę rozgłoszeniową?</th>
<th>Typowa liczba portów</th>
<th>Tryb pracy</th>
</tr>
</thead>
<tbody>
<tr>
<td>Repeater</td>
<td>1</td>
<td>brak</td>
<td>nie</td>
<td>nie</td>
<td>2</td>
<td>regeneracja sygnału</td>
</tr>
<tr>
<td>Hub</td>
<td>1</td>
<td>brak</td>
<td>nie</td>
<td>nie</td>
<td>4–24</td>
<td>Half-Duplex, zalewanie zawsze</td>
</tr>
<tr>
<td>Most (bridge)</td>
<td>2</td>
<td>adres MAC</td>
<td><strong>tak</strong></td>
<td>nie</td>
<td>2–4 (klasycznie)</td>
<td>uczenie się, filtrowanie, zalewanie nieznanych</td>
</tr>
<tr>
<td>Przełącznik (switch)</td>
<td>2 (lub 2+3 dla L3)</td>
<td>adres MAC (i/lub IP dla L3)</td>
<td><strong>tak</strong></td>
<td>nie (tak, jeśli pełni funkcję L3 z inter-VLAN routing)</td>
<td>kilka–kilkaset</td>
<td>zwykle Full-Duplex, VLAN, STP</td>
</tr>
<tr>
<td>Router</td>
<td>3</td>
<td>adres IP / tablica routingu</td>
<td>tak</td>
<td><strong>tak</strong></td>
<td>zwykle niewiele (kilka–kilkanaście)</td>
<td>routing między sieciami</td>
</tr>
</tbody>
</table>
<p>Powyższa tabela stanowi syntezę całego materiału: przesuwając się od repeatera do routera, każde kolejne urządzenie „widzi\" więcej informacji o ruchu (od surowych bitów, przez adresy fizyczne, po adresy logiczne z tablicą tras) i w efekcie potrafi podejmować coraz bardziej precyzyjne decyzje o segmentacji ruchu.</p>
<hr />
<h2>9. Podsumowanie</h2>
<p>Ewolucja urządzeń warstwy dostępu — od koncentratora, przez most, po współczesny przełącznik — jest ilustracją ogólniejszej zasady w projektowaniu sieci: <strong>im więcej informacji o ruchu urządzenie potrafi odczytać, tym bardziej precyzyjnie może nim zarządzać</strong>. Koncentrator, działający wyłącznie w warstwie fizycznej, nie ma wyboru — musi powielić każdy sygnał na wszystkie porty, tworząc jedną, wspólną domenę kolizyjną i marnując pasmo. Most i jego sprzętowy następca, przełącznik, odczytując adresy MAC, potrafią podejmować świadome decyzje o przekazywaniu lub filtrowaniu ramek, dzieląc domeny kolizyjne — ale z racji samej natury adresu rozgłoszeniowego wciąż muszą przekazywać broadcast wszędzie w obrębie swojej sieci.</p>
<p>Rozróżnienie <strong>domeny kolizyjnej</strong> i <strong>domeny rozgłoszeniowej</strong> — mimo że we współczesnych, w pełni przełączanych sieciach Full-Duplex ta pierwsza straciła w dużej mierze praktyczne znaczenie — pozostaje fundamentalnym narzędziem pojęciowym do zrozumienia, dlaczego architektura sieci wymaga zarówno przełączników (dla wydajnego przekazywania ruchu wewnątrz segmentu), jak i routerów lub VLAN-ów wraz z routingiem między nimi (dla kontrolowania zasięgu ruchu rozgłoszeniowego i realizacji polityki bezpieczeństwa). Świadome zaprojektowanie segmentacji sieci — decyzja o tym, ile i jak dużych domen rozgłoszeniowych utworzyć, gdzie postawić granice VLAN-ów i jak połączyć je routingiem — jest jedną z podstawowych kompetencji każdego administratora sieci.</p>
<hr />
<h2>10. Słownik podstawowych pojęć</h2>
<table>
<thead>
<tr>
<th>Pojęcie</th>
<th>Znaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>ASIC</strong></td>
<td>dedykowany układ scalony realizujący przełączanie sprzętowo, z prędkością liniową</td>
</tr>
<tr>
<td><strong>Broadcast storm</strong></td>
<td>burza rozgłoszeniowa — niekontrolowane, lawinowe krążenie ramek broadcastowych w pętli sieciowej</td>
</tr>
<tr>
<td><strong>CAM (Content-Addressable Memory)</strong></td>
<td>typ pamięci sprzętowej używanej do realizacji tablicy adresów MAC przełącznika</td>
</tr>
<tr>
<td><strong>Cut-Through</strong></td>
<td>metoda przełączania rozpoczynająca retransmisję zaraz po odczytaniu adresu docelowego</td>
</tr>
<tr>
<td><strong>Duplex mismatch</strong></td>
<td>błąd konfiguracji, w którym dwa końce łącza mają różne ustawienia trybu dupleksu</td>
</tr>
<tr>
<td><strong>Flooding (zalewanie)</strong></td>
<td>przekazanie ramki na wszystkie porty poza źródłowym, stosowane dla nieznanych adresów i rozgłoszeń</td>
</tr>
<tr>
<td><strong>Fragment-Free</strong></td>
<td>metoda przełączania odczekująca na pierwsze 64 B ramki przed retransmisją</td>
</tr>
<tr>
<td><strong>Inter-VLAN routing</strong></td>
<td>routing między różnymi sieciami VLAN, realizowany przez router lub przełącznik warstwy 3</td>
</tr>
<tr>
<td><strong>Router-on-a-stick</strong></td>
<td>konfiguracja, w której jeden fizyczny interfejs routera, podzielony na podinterfejsy, obsługuje routing między wieloma VLAN-ami</td>
</tr>
<tr>
<td><strong>Store-and-Forward</strong></td>
<td>metoda przełączania odbierająca całą ramkę i weryfikująca FCS przed retransmisją</td>
</tr>
<tr>
<td><strong>STP (Spanning Tree Protocol)</strong></td>
<td>protokół zapobiegający pętlom w sieciach z redundantnymi połączeniami mostów/przełączników</td>
</tr>
<tr>
<td><strong>Transparent bridging</strong></td>
<td>algorytm mostkowania przezroczystego: uczenie się, przekazywanie/filtrowanie, starzenie, zalewanie</td>
</tr>
<tr>
<td><strong>VLAN (Virtual LAN)</strong></td>
<td>logiczny podział sieci fizycznej na wiele odseparowanych domen rozgłoszeniowych</td>
</tr>
</tbody>
</table>
<hr />
<h2>11. Pytania kontrolne</h2>
<ol>
<li>Wyjaśnij, dlaczego koncentrator (hub) nazywany jest „wieloportowym repeaterem\" i jakie wynikają z tego ograniczenia dla wydajności sieci.</li>
<li>Na czym polega różnica między domeną kolizyjną a domeną rozgłoszeniową? Podaj po jednym przykładzie urządzenia, które dzieli tylko pierwszą z nich, oraz urządzenia, które dzieli obie.</li>
<li>Opisz cztery mechanizmy składające się na algorytm mostkowania przezroczystego (transparent bridging): uczenie się, przekazywanie/filtrowanie, starzenie się wpisów i zalewanie.</li>
<li>Dlaczego ramka rozgłoszeniowa jest zawsze przekazywana przez most/przełącznik na wszystkie porty, niezależnie od zawartości tablicy adresów MAC?</li>
<li>Co to jest burza rozgłoszeniowa i w jakich okolicznościach może wystąpić? Jaki protokół zapobiega temu zjawisku i na czym polega jego działanie w skrócie?</li>
<li>Porównaj trzy metody przełączania: Store-and-Forward, Cut-Through i Fragment-Free — pod względem momentu rozpoczęcia retransmisji, opóźnienia i zdolności do filtrowania uszkodzonych ramek.</li>
<li>Dlaczego przy pracy w trybie Full-Duplex pojęcie domeny kolizyjnej traci praktyczne znaczenie? Co dokładnie uniemożliwia fizyczne wystąpienie kolizji w takim trybie?</li>
<li>Wyjaśnij, w jaki sposób sieci VLAN pozwalają na logiczną segmentację ruchu bez fizycznego rozdzielania infrastruktury. Co jest wymagane, aby urządzenia w dwóch różnych VLAN-ach mogły się ze sobą komunikować?</li>
<li>Podaj co najmniej trzy różne motywacje stojące za segmentacją sieci (inne niż wyłącznie ograniczenie domeny kolizyjnej) i krótko uzasadnij każdą z nich.</li>
<li>Mając sieć złożoną z jednego routera, dwóch przełączników (po 8 aktywnych portów Full-Duplex każdy) oraz jednego 4-portowego hub-a podłączonego do jednego z portów pierwszego przełącznika (z trzema komputerami na hub-ie), określ: (a) liczbę domen rozgłoszeniowych, (b) liczbę domen kolizyjnych w tej sieci.</li>
</ol>
<h3>Klucz odpowiedzi do pytania 10</h3>
<p><strong>(a) Domeny rozgłoszeniowe:</strong> router ma tylko jedno „ramię\" schodzące do przełączników (w tym uproszczonym scenariuszu bez VLAN-ów) — cała sieć za przełącznikami stanowi <strong>jedną</strong> domenę rozgłoszeniową (zakładając brak dodatkowych interfejsów routera prowadzących do innych segmentów).</p>
<p><strong>(b) Domeny kolizyjne:</strong> pierwszy przełącznik ma 8 portów, z czego 7 prowadzi bezpośrednio do pojedynczych hostów (7 osobnych mikrodomen kolizyjnych Full-Duplex) i 1 prowadzi do hub-a (który sam w sobie stanowi <strong>jedną</strong> wspólną domenę kolizyjną obejmującą wszystkie 3 podłączone do niego komputery oraz port przełącznika). Drugi przełącznik ma 8 portów, z czego 8 osobnych mikrodomen kolizyjnych. Łącznie: <span class=\"mathjax mathjax--inline\">\\(7 + 1 + 8 = \\mathbf{16}\\)</span> domen kolizyjnych (7 z pierwszego przełącznika + 1 z hub-a + 8 z drugiego przełącznika).</p>", "@Page:/var/www/html/user/pages/05.lsk/05.urzadzenia-warstwy-dostepu-do-sieci", "");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = [];
        static $filters = [];
        static $functions = [];
        static $tests = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                [],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            } elseif ($e instanceof SecurityNotAllowedTestError && isset($tests[$e->getTestName()])) {
                $e->setTemplateLine($tests[$e->getTestName()]);
            }

            throw $e;
        }

    }
}
