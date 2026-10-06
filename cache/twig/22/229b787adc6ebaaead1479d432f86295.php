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

/* @Page:/var/www/html/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci */
class __TwigTemplate_bed24b1da5648534d622f25944fe3c25_sourced extends Template
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
        yield "<h2>Wprowadzenie do materiału</h2>
<p>Każda sieć komputerowa, niezależnie od tego, jak złożone protokoły działają w wyższych warstwach, ostatecznie opiera się na fizycznym nośniku, który przenosi sygnał z jednego urządzenia do drugiego. Tym nośnikiem może być para miedzianych przewodów, włókno szklane, w którym rozchodzi się światło, albo fala elektromagnetyczna propagująca się w powietrzu. Wybór medium determinuje przepustowość, maksymalny zasięg, odporność na zakłócenia, koszt instalacji, a nawet możliwość zapewnienia bezpieczeństwa transmisji.</p>
<p>Niniejszy materiał przedstawia w sposób uporządkowany i szczegółowy trzy klasy mediów transmisyjnych — <strong>skrętkę miedzianą</strong>, <strong>światłowody</strong> oraz <strong>fale radiowe</strong> — a następnie omawia rodzinę standardów <strong>IEEE 802.11 (Wi-Fi)</strong>, która jest dziś najważniejszym sposobem bezprzewodowego dostępu do sieci lokalnej. Ostatnia część poświęcona jest <strong>technologiom dostępowym</strong> (modemy analogowe, ISDN, DSL, sieci kablowe, dostęp światłowodowy) oraz <strong>sieciom rozległym (WAN)</strong>, czyli infrastrukturze łączącej sieci lokalne z Internetem i między sobą.</p>
<p>Materiał ma charakter akademicki, lecz został napisany tak, aby był zrozumiały dla osoby rozpoczynającej naukę o sieciach. Każde nowe pojęcie jest definiowane przy pierwszym użyciu, a tam, gdzie to możliwe, podano przykłady liczbowe i schematy.</p>
<hr />
<h2>1. Warstwa fizyczna i pojęcia podstawowe</h2>
<h3>1.1. Rola warstwy fizycznej</h3>
<p>Warstwa fizyczna (warstwa 1 modelu ISO/OSI) odpowiada za przekształcenie ciągu bitów w sygnał fizyczny (elektryczny, optyczny lub radiowy), jego przesłanie przez medium oraz odtworzenie bitów po stronie odbiorczej. Definiuje ona:</p>
<ul>
<li><strong>właściwości mechaniczne</strong> — rodzaj złączy, ich rozmieszczenie, budowę kabli;</li>
<li><strong>właściwości elektryczne i optyczne</strong> — poziomy napięć, długości fal, moc nadajnika, czułość odbiornika;</li>
<li><strong>kodowanie i modulację</strong> — sposób reprezentowania bitów w sygnale;</li>
<li><strong>synchronizację</strong> — utrzymanie zgodności zegarów nadajnika i odbiornika;</li>
<li><strong>topologię fizyczną</strong> — sposób połączenia urządzeń (gwiazda, magistrala, siatka).</li>
</ul>
<p>Warstwa fizyczna nie „rozumie\" ramek ani adresów — operuje wyłącznie na bitach i sygnałach. Dlatego urządzenia pracujące wyłącznie w warstwie 1 (repeatery, koncentratory, konwertery mediów) jedynie regenerują i powielają sygnał.</p>
<h3>1.2. Podstawowe pojęcia</h3>
<p><strong>Pasmo (bandwidth)</strong> ma w telekomunikacji dwa różne znaczenia, które należy odróżniać:</p>
<ul>
<li>w sensie <em>analogowym</em> — szerokość zakresu częstotliwości, jaki kanał jest w stanie przenieść, mierzona w hercach (Hz), np. kanał telefoniczny ma pasmo ok. 3,1 kHz (300–3400 Hz);</li>
<li>w sensie <em>potocznym, informatycznym</em> — maksymalna przepływność łącza, mierzona w bitach na sekundę (b/s), np. „łącze o paśmie 1 Gb/s\".</li>
</ul>
<p>W dalszej części, aby uniknąć niejednoznaczności, będziemy używać terminu <strong>szerokość pasma</strong> dla wielkości w hercach oraz <strong>przepływność</strong> dla wielkości w bitach na sekundę.</p>
<p><strong>Przepustowość rzeczywista (throughput)</strong> to ilość danych faktycznie przesłanych w jednostce czasu, uwzględniająca narzuty protokołów, retransmisje i konkurencję o medium. <strong>Przepustowość użyteczna (goodput)</strong> to część throughputu stanowiąca dane aplikacji, bez nagłówków i retransmisji. Zawsze zachodzi zależność:</p>
<div data-m=\"\\text{goodput} \\le \\text{throughput} \\le \\text{przepływność nominalna łącza}\"></div>
<p><strong>Opóźnienie (latency)</strong> to czas przejścia danych od nadawcy do odbiorcy. Składa się z opóźnienia propagacji (zależnego od długości i prędkości sygnału w medium), opóźnienia transmisji (czas „wypchnięcia\" wszystkich bitów ramki na łącze), opóźnienia kolejkowania i przetwarzania. <strong>Jitter</strong> to zmienność opóźnienia w czasie, szczególnie istotna dla telefonii IP i wideo.</p>
<p><strong>Prędkość propagacji sygnału</strong> w miedzi wynosi ok. 0,64–0,7 prędkości światła (dla skrętki kategorii 5e typowo 0,64 c, czyli ok. 5 ns na metr), w szkle światłowodu ok. 0,68 c (ok. 4,9 µs na kilometr), a w próżni i (w przybliżeniu) w powietrzu — 300 000 km/s.</p>
<h3>1.3. Decybele — język inżynierii sygnałów</h3>
<p>Sygnały w mediach transmisyjnych zmieniają swoją moc o wiele rzędów wielkości (od miliwatów na wyjściu nadajnika do pikowatów na wejściu odbiornika), dlatego stosuje się skalę logarytmiczną. <strong>Decybel (dB)</strong> jest miarą <em>stosunku</em> dwóch mocy:</p>
<div data-m=\"G_{\\text{dB}} = 10 \\cdot \\log_{10}\\!\\left(\\frac{P_{\\text{wyj}}}{P_{\\text{wej}}}\\right)\"></div>
<p>Wartość dodatnia oznacza wzmocnienie, ujemna — tłumienie. Kilka wartości warto zapamiętać:</p>
<table>
<thead>
<tr>
<th>Zmiana mocy</th>
<th>Wartość w dB</th>
</tr>
</thead>
<tbody>
<tr>
<td>×2 (podwojenie)</td>
<td>+3 dB</td>
</tr>
<tr>
<td>×10</td>
<td>+10 dB</td>
</tr>
<tr>
<td>×100</td>
<td>+20 dB</td>
</tr>
<tr>
<td>×0,5 (połowa mocy)</td>
<td>−3 dB</td>
</tr>
<tr>
<td>×0,1</td>
<td>−10 dB</td>
</tr>
<tr>
<td>×0,001</td>
<td>−30 dB</td>
</tr>
</tbody>
</table>
<p>Zaletą skali logarytmicznej jest to, że <strong>tłumienia kolejnych odcinków po prostu się dodają</strong>: jeśli kabel tłumi o 6 dB, złącze o 0,5 dB, a spaw o 0,1 dB, to suma wynosi 6,6 dB.</p>
<p><strong>dBm</strong> oznacza moc bezwzględną odniesioną do 1 mW: <span data-m=\"P_{\\text{dBm}} = 10 \\log_{10}(P / 1\\,\\text{mW})\"></span>. Zatem 0 dBm = 1 mW, 20 dBm = 100 mW, 30 dBm = 1 W, a −30 dBm = 1 µW. W technice bezprzewodowej powszechnie używa się też <strong>dBi</strong> (zysk anteny względem hipotetycznej anteny izotropowej) oraz <strong>dBW</strong>.</p>
<h3>1.4. Zjawiska pogarszające jakość sygnału</h3>
<p>Sygnał w trakcie propagacji ulega degradacji z kilku powodów:</p>
<ol>
<li><strong>Tłumienie (attenuation)</strong> — spadek mocy sygnału wraz z odległością. W miedzi rośnie z częstotliwością i długością kabla (straty rezystancyjne, efekt naskórkowy, straty w dielektryku), w światłowodzie wynika z rozpraszania i absorpcji w szkle, w radiu — z rozszerzania się fali w przestrzeni.</li>
<li><strong>Szum (noise)</strong> — losowe sygnały dodające się do użytecznego sygnału: szum termiczny (obecny zawsze, o gęstości ok. −174 dBm/Hz w temperaturze pokojowej), szum śrutowy w detektorach optycznych, zakłócenia impulsowe.</li>
<li><strong>Przesłuchy (crosstalk)</strong> — sprzężenie elektromagnetyczne pomiędzy sąsiednimi torami transmisyjnymi.</li>
<li><strong>Zniekształcenia (distortion)</strong> — zmiana kształtu impulsów spowodowana m.in. dyspersją (różna prędkość propagacji różnych składowych sygnału), odbiciami na niedopasowanych impedancjach czy propagacją wielodrogową.</li>
<li><strong>Interferencja</strong> — zakłócenia od zewnętrznych źródeł (silniki, lampy, inne sieci radiowe).</li>
</ol>
<p>Miarą jakości sygnału jest <strong>stosunek sygnału do szumu (SNR — Signal-to-Noise Ratio)</strong>:</p>
<div data-m=\"\\text{SNR}_{\\text{dB}} = 10 \\cdot \\log_{10}\\left(\\frac{P_{\\text{sygnału}}}{P_{\\text{szumu}}}\\right)\"></div>
<h3>1.5. Granice teoretyczne: Nyquist i Shannon</h3>
<p>Dwa klasyczne twierdzenia wyznaczają górne granice przepływności.</p>
<p><strong>Twierdzenie Nyquista</strong> dotyczy kanału bezszumowego o szerokości pasma <span data-m=\"B\"></span>. Maksymalna szybkość symbolowa (liczba zmian stanu sygnału na sekundę, w baudach) wynosi <span data-m=\"2B\"></span>. Jeśli każdy symbol może przyjąć <span data-m=\"M\"></span> różnych stanów, przepływność wynosi:</p>
<div data-m=\"C_{\\text{Nyquist}} = 2B \\cdot \\log_2 M\"></div>
<p><strong>Twierdzenie Shannona–Hartleya</strong> uwzględnia szum i podaje maksymalną przepływność, przy której można zachować dowolnie małe prawdopodobieństwo błędu:</p>
<div data-m=\"C_{\\text{Shannon}} = B \\cdot \\log_2\\!\\left(1 + \\text{SNR}\\right)\"></div>
<p>gdzie SNR jest podany jako stosunek liniowy (nie w dB).</p>
<p><em>Przykład 1.</em> Kanał telefoniczny ma <span data-m=\"B = 3100\"></span> Hz, a SNR wynosi 35 dB, czyli ok. 3162 razy. Stąd:</p>
<div data-m=\"C = 3100 \\cdot \\log_2(1 + 3162) \\approx 3100 \\cdot 11{,}63 \\approx 36 \\text{ kb/s}\"></div>
<p>Wynik dobrze wyjaśnia, dlaczego modemy analogowe (V.34) zatrzymały się na 33,6 kb/s.</p>
<p><em>Przykład 2.</em> Kanał Wi-Fi o szerokości 20 MHz przy SNR = 25 dB (ok. 316) ma teoretyczną pojemność:</p>
<div data-m=\"C = 20 \\cdot 10^6 \\cdot \\log_2(1 + 316) \\approx 20 \\cdot 10^6 \\cdot 8{,}31 \\approx 166 \\text{ Mb/s}\"></div>
<p>Twierdzenie Shannona jest fundamentem projektowania wszystkich systemów transmisyjnych: aby zwiększyć przepływność, można albo poszerzyć pasmo, albo poprawić SNR (a to oznacza m.in. wyższe modulacje wymagające czystszego sygnału), albo — jak w MIMO — zwielokrotnić liczbę równoległych kanałów.</p>
<h3>1.6. Kryteria wyboru medium transmisyjnego</h3>
<table>
<thead>
<tr>
<th>Kryterium</th>
<th>Skrętka miedziana</th>
<th>Światłowód wielomodowy</th>
<th>Światłowód jednomodowy</th>
<th>Fale radiowe</th>
</tr>
</thead>
<tbody>
<tr>
<td>Typowy zasięg bez regeneracji</td>
<td>do 100 m (Ethernet)</td>
<td>do ok. 550 m (do 10 Gb/s: 300–400 m)</td>
<td>od 10 km do ponad 80 km</td>
<td>od kilku m do kilkunastu km (zależnie od pasma i mocy)</td>
</tr>
<tr>
<td>Przepływność</td>
<td>do 10 Gb/s (kat. 6A), do 40 Gb/s (kat. 8, 30 m)</td>
<td>do 100 Gb/s i więcej</td>
<td>praktycznie bez ograniczeń (Tb/s w WDM)</td>
<td>do kilkunastu Gb/s (Wi-Fi 6/7), zależnie od pasma</td>
</tr>
<tr>
<td>Odporność na zakłócenia EMI</td>
<td>średnia (lepsza z ekranowaniem)</td>
<td>pełna</td>
<td>pełna</td>
<td>niska (współdzielone widmo)</td>
</tr>
<tr>
<td>Bezpieczeństwo (podsłuch)</td>
<td>średnie (możliwy podsłuch indukcyjny)</td>
<td>wysokie</td>
<td>wysokie</td>
<td>niskie (wymaga szyfrowania)</td>
</tr>
<tr>
<td>Koszt kabla</td>
<td>niski</td>
<td>średni</td>
<td>średni</td>
<td>brak kabla</td>
</tr>
<tr>
<td>Koszt zakończeń i instalacji</td>
<td>niski</td>
<td>wysoki</td>
<td>wysoki</td>
<td>niski (ale wymaga planowania radiowego)</td>
</tr>
<tr>
<td>Mobilność użytkownika</td>
<td>brak</td>
<td>brak</td>
<td>brak</td>
<td>pełna</td>
</tr>
<tr>
<td>Zasilanie przez medium</td>
<td>tak (PoE)</td>
<td>nie</td>
<td>nie</td>
<td>nie</td>
</tr>
</tbody>
</table>
<hr />
<h2>2. Skrętka miedziana</h2>
<h3>2.1. Budowa i zasada działania</h3>
<p><strong>Skrętka</strong> (ang. <em>twisted pair</em>) to kabel złożony z par przewodów miedzianych, z których każdy jest osobno izolowany, a przewody w każdej parze są ze sobą <strong>skręcone</strong>. Standardowy kabel sieciowy Ethernet zawiera <strong>cztery pary</strong> (osiem żył), o impedancji falowej <strong>100 Ω</strong> (tolerancja ±15 %), wykonanych zwykle z miedzi o przekroju 24 AWG (ok. 0,51 mm), a w kablach kategorii 6A i wyższych często 23 AWG.</p>
<p>Sens skręcania jest fizyczny. Sygnał w parze przesyła się <strong>różnicowo</strong>: na jednym przewodzie płynie sygnał dodatni, na drugim ujemny (odwrócony w fazie). Odbiornik interpretuje <strong>różnicę</strong> napięć między przewodami, a nie napięcie względem masy. Zewnętrzne zakłócenie elektromagnetyczne indukuje w obu przewodach prawie identyczne napięcie (tzw. zakłócenie współbieżne, common-mode). Ponieważ oba przewody są zakłócone niemal jednakowo, różnica napięć pozostaje praktycznie niezmieniona — zakłócenie zostaje „odjęte\". Skręcenie zapewnia, że oba przewody znajdują się średnio w tym samym miejscu względem źródła zakłóceń, co poprawia to podobieństwo.</p>
<p>Skręcenie pełni również drugą funkcję: ogranicza <strong>przesłuchy</strong> pomiędzy parami. Dlatego w jednym kablu poszczególne pary mają <strong>różne skoki skrętu</strong> (liczbę skrętów na jednostkę długości — typowo kilka na centymetr), tak aby sąsiednie pary nie sprzęgały się rezonansowo.</p>
<p>Jakość skręcenia jest krytyczna: rozkręcenie pary na zakończeniu (np. w gnieździe) o więcej niż ok. 13 mm w kategorii 5e (mniej w wyższych) istotnie pogarsza parametry łącza. Dlatego instalatorzy pilnują, aby przy zarabianiu wtyku rozkręcać pary jak najkrócej.</p>
<p>Przewody mogą być <strong>drut</strong> (jeden pełny przewód, sztywny — do instalacji stałej, tzw. okablowanie poziome) lub <strong>linka</strong> (splot wielu cienkich drucików, elastyczny — do przewodów krosowych, tzw. patchcordów). Linka ma większe tłumienie, dlatego długość patchcordów jest limitowana.</p>
<h3>2.2. Rodzaje ekranowania</h3>
<p>Norma ISO/IEC 11801 stosuje oznaczenie w postaci <strong>XX/YTP</strong>, gdzie XX oznacza ekran całego kabla, a Y ekran poszczególnych par:</p>
<table>
<thead>
<tr>
<th>Oznaczenie</th>
<th>Ekran zbiorczy</th>
<th>Ekran par</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>U/UTP</strong></td>
<td>brak</td>
<td>brak</td>
<td>okablowanie biurowe, domowe (tzw. UTP)</td>
</tr>
<tr>
<td><strong>F/UTP</strong></td>
<td>folia</td>
<td>brak</td>
<td>biura ze średnim poziomem zakłóceń (tzw. FTP)</td>
</tr>
<tr>
<td><strong>S/UTP</strong></td>
<td>oplot</td>
<td>brak</td>
<td>rzadziej stosowany</td>
</tr>
<tr>
<td><strong>SF/UTP</strong></td>
<td>oplot + folia</td>
<td>brak</td>
<td>środowiska o podwyższonych zakłóceniach</td>
</tr>
<tr>
<td><strong>U/FTP</strong></td>
<td>brak</td>
<td>folia na każdej parze</td>
<td>kat. 6A, kat. 7 — redukcja przesłuchów</td>
</tr>
<tr>
<td><strong>F/FTP</strong></td>
<td>folia</td>
<td>folia na każdej parze</td>
<td>kat. 6A i wyższe</td>
</tr>
<tr>
<td><strong>S/FTP</strong></td>
<td>oplot</td>
<td>folia na każdej parze</td>
<td>kat. 7, 7A, 8 (tzw. STP/PiMF)</td>
</tr>
</tbody>
</table>
<p>Ekranowanie poprawia odporność na zakłócenia zewnętrzne i zmniejsza przesłuchy, ale ma warunek: <strong>ekran musi być prawidłowo uziemiony</strong> (zwykle przez gniazda i panele krosowe z metalową obudową). Nieuziemiony lub uziemiony w wielu punktach o różnych potencjałach ekran może stać się anteną i pogorszyć sytuację, a prądy wyrównawcze płynące po ekranie mogą stanowić zagrożenie dla urządzeń.</p>
<h3>2.3. Kategorie okablowania</h3>
<p>Kategorie (ang. <em>categories</em>, skrót Cat) określone w normach TIA/EIA-568 oraz odpowiadające im klasy (Class) w ISO/IEC 11801 definiują maksymalną częstotliwość, w której kabel zachowuje wymagane parametry:</p>
<table>
<thead>
<tr>
<th>Kategoria</th>
<th>Klasa ISO</th>
<th>Pasmo (MHz)</th>
<th>Typowe zastosowanie</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>Cat 3</td>
<td>C</td>
<td>16</td>
<td>10BASE-T, telefonia</td>
<td>przestarzała</td>
</tr>
<tr>
<td>Cat 5</td>
<td>—</td>
<td>100</td>
<td>100BASE-TX</td>
<td>zastąpiona przez 5e</td>
</tr>
<tr>
<td><strong>Cat 5e</strong></td>
<td>D</td>
<td>100</td>
<td>1000BASE-T, 2,5GBASE-T</td>
<td>wciąż powszechna w instalacjach domowych</td>
</tr>
<tr>
<td><strong>Cat 6</strong></td>
<td>E</td>
<td>250</td>
<td>1000BASE-T, 10GBASE-T do 55 m</td>
<td></td>
</tr>
<tr>
<td><strong>Cat 6A</strong></td>
<td>EA</td>
<td>500</td>
<td>10GBASE-T do 100 m</td>
<td>standard dla nowych instalacji biurowych</td>
</tr>
<tr>
<td>Cat 7</td>
<td>F</td>
<td>600</td>
<td>10GBASE-T</td>
<td>tylko ekranowana, nietypowe złącze GG45/TERA</td>
</tr>
<tr>
<td>Cat 7A</td>
<td>FA</td>
<td>1000</td>
<td>10GBASE-T, telewizja kablowa w jednym kablu</td>
<td></td>
</tr>
<tr>
<td><strong>Cat 8 (8.1/8.2)</strong></td>
<td>I / II</td>
<td>2000</td>
<td>25GBASE-T, 40GBASE-T do 30 m</td>
<td>dla centrów danych</td>
</tr>
</tbody>
</table>
<p>Warto zapamiętać, że <strong>kategoria dotyczy kabla i całego toru</strong> (kabel, gniazda, krosownice, patchcordy). Zastosowanie kabla Cat 6A z gniazdami Cat 5e daje tor o parametrach Cat 5e — tor jest tak dobry, jak jego najsłabszy element.</p>
<h3>2.4. Złącze RJ-45 i układ żył</h3>
<p>Standardowym złączem dla skrętki jest <strong>RJ-45</strong> (formalnie 8P8C — osiem pozycji, osiem styków). Kolejność żył w złączu określają dwa układy z normy TIA/EIA-568: <strong>T568A</strong> i <strong>T568B</strong>. Różnią się one zamianą miejscami par zielonej i pomarańczowej. W Polsce i na świecie dominuje układ <strong>T568B</strong>, choć oba są równoważne technicznie. Ważne jest wyłącznie, aby <strong>na obu końcach kabla stosować ten sam układ</strong> (kabel prosty) albo odpowiednio różny (kabel skrosowany).</p>
<p><img alt=\"Układ żył w złączu RJ-45 — T568B i T568A oraz funkcje styków w 10/100BASE-TX i 1000BASE-T\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/skretka-rj45-t568.svg\" /></p>
<p>W Ethernecie 10/100 Mb/s wykorzystywane są tylko dwie pary: <strong>styki 1 i 2</strong> (nadawanie, TX) oraz <strong>styki 3 i 6</strong> (odbiór, RX). Para 4–5 i para 7–8 pozostają niewykorzystane (mogą być użyte do zasilania PoE lub telefonii). W Gigabit Ethernet i szybszych wykorzystywane są wszystkie cztery pary, a każda para przenosi dane w obu kierunkach jednocześnie (dzięki układom hybrydowym i kasowaniu echa).</p>
<h3>2.5. Kabel prosty i skrosowany, Auto-MDI/MDIX</h3>
<p>Dawniej rozróżniano dwa typy urządzeń: <strong>MDI</strong> (np. karta sieciowa komputera, która nadaje na stykach 1–2) i <strong>MDI-X</strong> (np. port koncentratora lub przełącznika, który odbiera na stykach 1–2). Połączenie urządzeń różnych typów wymagało <strong>kabla prostego</strong>, a tych samych typów (komputer–komputer, przełącznik–przełącznik) — <strong>kabla skrosowanego</strong> (crossover), w którym pary TX i RX są zamienione (jeden koniec T568A, drugi T568B).</p>
<p>Współczesne porty Gigabit Ethernet obsługują funkcję <strong>Auto-MDI/MDIX</strong>, w której port sam wykrywa i koryguje niewłaściwe skrosowanie. W praktyce kabla skrosowanego już się nie używa, choć warto znać zasadę.</p>
<h3>2.6. Kodowanie liniowe i standardy Ethernet po skrętce</h3>
<p>Bity muszą zostać zamienione na sygnał elektryczny. Prosty zapis „1 = wysokie napięcie, 0 = niskie\" ma poważne wady: przy długich seriach jednakowych bitów odbiornik traci synchronizację, a widmo sygnału zawiera składową stałą. Dlatego stosuje się <strong>kodowanie liniowe</strong>:</p>
<ul>
<li><strong>Manchester (10BASE-T)</strong> — każdy bit reprezentowany jest przejściem napięcia w środku okresu bitu (w IEEE 802.3: 0 → przejście z wysokiego na niskie, 1 → z niskiego na wysokie). Zawsze jest przejście, więc odbiornik odzyskuje zegar, ale kosztem podwojenia szybkości symbolowej (10 Mb/s wymaga 20 Mbaud).</li>
<li><strong>4B5B + MLT-3 (100BASE-TX)</strong> — cztery bity danych zamieniane są na pięć bitów kodu (nadmiarowość zapewnia częste przejścia), a następnie kodowane trzema poziomami napięcia (−1, 0, +1) w sposób cykliczny. Szybkość symbolowa: 125 Mbaud dla 100 Mb/s. MLT-3 zmniejsza maksymalną częstotliwość sygnału do ok. 31,25 MHz.</li>
<li><strong>PAM-5 (1000BASE-T)</strong> — modulacja amplitudy impulsów z pięcioma poziomami napięcia (−2, −1, 0, +1, +2). Każdą z czterech par wykorzystuje się jednocześnie w obu kierunkach z szybkością symbolową 125 Mbaud, przy czym pojedynczy symbol niesie dwa bity danych (piąty poziom służy korekcji błędów kodowaniem kratowym), co daje 4 pary × 125 Mbaud × 2 bity = 1000 Mb/s.</li>
<li><strong>PAM-16 (10GBASE-T, 2,5/5GBASE-T)</strong> — szesnaście poziomów napięcia, z wykorzystaniem zaawansowanego kodowania (LDPC) i rozszerzonego pasma. Wymaga kabli o pasmie do 500 MHz (kat. 6A).</li>
</ul>
<table>
<thead>
<tr>
<th>Standard</th>
<th>IEEE</th>
<th>Przepływność</th>
<th>Pary</th>
<th>Kodowanie</th>
<th>Minimalna kategoria</th>
<th>Maks. długość</th>
</tr>
</thead>
<tbody>
<tr>
<td>10BASE-T</td>
<td>802.3i (1990)</td>
<td>10 Mb/s</td>
<td>2</td>
<td>Manchester</td>
<td>Cat 3</td>
<td>100 m</td>
</tr>
<tr>
<td>100BASE-TX</td>
<td>802.3u (1995)</td>
<td>100 Mb/s</td>
<td>2</td>
<td>4B5B + MLT-3</td>
<td>Cat 5</td>
<td>100 m</td>
</tr>
<tr>
<td>1000BASE-T</td>
<td>802.3ab (1999)</td>
<td>1 Gb/s</td>
<td>4</td>
<td>PAM-5</td>
<td>Cat 5e</td>
<td>100 m</td>
</tr>
<tr>
<td>2,5GBASE-T / 5GBASE-T</td>
<td>802.3bz (2016)</td>
<td>2,5 / 5 Gb/s</td>
<td>4</td>
<td>PAM-16</td>
<td>Cat 5e / Cat 6</td>
<td>100 m</td>
</tr>
<tr>
<td>10GBASE-T</td>
<td>802.3an (2006)</td>
<td>10 Gb/s</td>
<td>4</td>
<td>PAM-16</td>
<td>Cat 6 (55 m) / Cat 6A (100 m)</td>
<td>55–100 m</td>
</tr>
<tr>
<td>25GBASE-T / 40GBASE-T</td>
<td>802.3bq (2016)</td>
<td>25 / 40 Gb/s</td>
<td>4</td>
<td>PAM-16</td>
<td>Cat 8</td>
<td>30 m</td>
</tr>
</tbody>
</table>
<h3>2.7. Parametry transmisyjne toru miedzianego</h3>
<p>Certyfikacja okablowania (pomiary miernikiem, np. testerem klasy Level IV) obejmuje kilka podstawowych parametrów:</p>
<ul>
<li><strong>Tłumienie (Insertion Loss, IL)</strong> — spadek mocy sygnału na całej długości toru w funkcji częstotliwości; rośnie z częstotliwością i długością. Dla kabla Cat 5e przy 100 MHz nie powinno przekraczać ok. 22 dB na 100 m.</li>
<li><strong>NEXT (Near-End Crosstalk)</strong> — przesłuch zbliżny, mierzony po tej samej stronie, po której dołączony jest nadajnik zakłócający; jest najgroźniejszy, bo zakłócenie pochodzi od silnego sygnału z bliskiego końca. Im wyższa wartość NEXT (w dB), tym lepiej.</li>
<li><strong>FEXT / ACR-F (Far-End Crosstalk)</strong> — przesłuch zdalny, mierzony po przeciwnej stronie łącza; ACR-F to FEXT skorygowany o tłumienie.</li>
<li><strong>PSNEXT / PSACR-F</strong> — sumaryczne (Power Sum) przesłuchy pochodzące od wszystkich pozostałych par jednocześnie, istotne przy transmisji na czterech parach (Gigabit).</li>
<li><strong>ACR (Attenuation-to-Crosstalk Ratio)</strong> — różnica między tłumieniem a przesłuchem, miara „zapasu\" sygnału nad zakłóceniem własnym kabla.</li>
<li><strong>Return Loss (RL, tłumienie odbicia)</strong> — miara, jak dobrze impedancja toru jest dopasowana do 100 Ω; odbicia od niedopasowań (np. źle zarobione złącza) interferują z sygnałem podstawowym, szczególnie w transmisji dwukierunkowej.</li>
<li><strong>Delay Skew</strong> — różnica czasów propagacji między najszybszą a najwolniejszą parą; istotna w transmisjach wielotorowych (limit ok. 50 ns).</li>
<li><strong>Alien Crosstalk (AXT)</strong> — przesłuchy od sąsiednich kabli; istotny w 10GBASE-T, stąd zalecenie stosowania kabli Cat 6A o zwiększonej średnicy lub ekranowanych.</li>
</ul>
<h3>2.8. Okablowanie strukturalne</h3>
<p>W budynkach kabel skrętkowy instaluje się zgodnie z zasadami <strong>okablowania strukturalnego</strong> (normy ISO/IEC 11801, EN 50173, TIA-568). Charakteryzuje się ono hierarchiczną, gwiaździstą topologią:</p>
<ul>
<li><strong>Okablowanie poziome</strong> (horizontal cabling) — od gniazda abonenckiego (w miejscu pracy) do punktu rozdzielczego piętra. Maksymalna długość <strong>stałego łącza (permanent link) wynosi 90 m</strong>.</li>
<li><strong>Patchcordy</strong> — po 5 m po każdej stronie: łącznie <strong>kanał (channel) nie przekracza 100 m</strong> (90 m + 10 m przewodów krosowych, przy czym limity zależą od użycia linki).</li>
<li><strong>Okablowanie pionowe (szkieletowe, backbone)</strong> — łączy punkty rozdzielcze pięter i główny punkt rozdzielczy budynku; dziś zwykle światłowodowe.</li>
<li><strong>Okablowanie międzybudynkowe (campus)</strong> — łączy budynki; niemal wyłącznie światłowodowe (odporność na przepięcia, wyrównanie potencjałów).</li>
</ul>
<p>Zasada 100 m wynika z tłumienia, przesłuchów oraz — w dawnych sieciach półdupleksowych — z ograniczeń czasowych mechanizmu CSMA/CD. Dłuższe odcinki wymagają regeneratora, przełącznika pośredniego lub konwertera na światłowód.</p>
<h3>2.9. Zasilanie przez skrętkę — Power over Ethernet</h3>
<p>Technologia <strong>PoE (Power over Ethernet)</strong> pozwala na przesyłanie zasilania równolegle z danymi po tym samym kablu. Źródło (PSE — Power Sourcing Equipment, np. przełącznik) dostarcza napięcie stałe ok. 44–57 V, które odbiera urządzenie zasilane (PD — Powered Device), np. punkt dostępowy Wi-Fi, kamera IP czy telefon VoIP.</p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Nazwa potoczna</th>
<th>Moc na porcie PSE</th>
<th>Moc dostępna dla PD</th>
<th>Liczba par</th>
</tr>
</thead>
<tbody>
<tr>
<td>IEEE 802.3af (2003)</td>
<td>PoE (Type 1)</td>
<td>15,4 W</td>
<td>12,95 W</td>
<td>2</td>
</tr>
<tr>
<td>IEEE 802.3at (2009)</td>
<td>PoE+ (Type 2)</td>
<td>30 W</td>
<td>25,5 W</td>
<td>2</td>
</tr>
<tr>
<td>IEEE 802.3bt (2018)</td>
<td>PoE++ (Type 3)</td>
<td>60 W</td>
<td>51 W</td>
<td>4</td>
</tr>
<tr>
<td>IEEE 802.3bt (2018)</td>
<td>PoE++ (Type 4)</td>
<td>90 W</td>
<td>71,3 W</td>
<td>4</td>
</tr>
</tbody>
</table>
<p>Przed włączeniem zasilania PSE przeprowadza <strong>detekcję</strong> (sprawdza, czy do portu dołączono urządzenie zgodne z PoE, mierząc rezystancję sygnaturową ok. 25 kΩ) oraz <strong>klasyfikację</strong> mocy. Dzięki temu zwykłe urządzenie bez PoE nie zostanie uszkodzone. Wraz ze wzrostem mocy rośnie nagrzewanie się kabli w wiązkach, dlatego przy PoE++ zaleca się kable Cat 6A o przewodach o większym przekroju.</p>
<h3>2.10. Kabel koncentryczny — uwagi uzupełniające</h3>
<p>Kabel koncentryczny składa się z przewodu wewnętrznego (miedzianego), dielektryka, ekranu (oplotu i/lub folii) oraz osłony zewnętrznej. Ekran otacza żyłę współosiowo, co zapewnia dobrą odporność na zakłócenia i niską tłumienność. W sieciach komputerowych dawał początek Ethernetowi (10BASE5 — gruby koncentryk RG-8, 500 m; 10BASE2 — cienki koncentryk RG-58, 185 m; oba o impedancji 50 Ω), lecz został wyparty przez skrętkę. Kabel koncentryczny o impedancji 75 Ω pozostaje szeroko stosowany w <strong>telewizji kablowej i sieciach HFC</strong> (dostęp DOCSIS, omówiony w rozdziale 6), w instalacjach antenowych oraz w połączeniach o dużych częstotliwościach.</p>
<h3>2.11. Zalety i ograniczenia skrętki</h3>
<p><strong>Zalety:</strong> niski koszt kabla i osprzętu, łatwość instalacji i zakańczania, możliwość zasilania urządzeń (PoE), dojrzała infrastruktura i szeroka dostępność sprzętu, wsteczna zgodność standardów Ethernet.</p>
<p><strong>Ograniczenia:</strong> ograniczony zasięg (100 m), wrażliwość na zakłócenia elektromagnetyczne (zwłaszcza kable nieekranowane w pobliżu silników i kabli energetycznych), tłumienie rosnące z częstotliwością, możliwość podsłuchu przez sprzężenie indukcyjne, ograniczona przepływność w porównaniu z włóknem optycznym oraz przewodzenie prądu (ryzyko wyrównawcze i przepięcia — nieodpowiednie między budynkami).</p>
<hr />
<h2>3. Światłowody</h2>
<h3>3.1. Zasada działania — całkowite wewnętrzne odbicie</h3>
<p><strong>Światłowód</strong> (włókno optyczne) przesyła informację w postaci impulsów światła (najczęściej podczerwonego, o długościach fali 850, 1310 lub 1550 nm), które są prowadzone wewnątrz cienkiego włókna szklanego (rzadziej plastikowego) dzięki zjawisku <strong>całkowitego wewnętrznego odbicia</strong>.</p>
<p>Zjawisko to wynika z prawa Snelliusa. Gdy światło przechodzi z ośrodka o współczynniku załamania <span data-m=\"n_1\"></span> do ośrodka o współczynniku <span data-m=\"n_2\"></span>, kąty (mierzone względem normalnej do powierzchni granicznej) spełniają zależność:</p>
<div data-m=\"n_1 \\sin\\theta_1 = n_2 \\sin\\theta_2\"></div>
<p>Jeśli <span data-m=\"n_1 &gt; n_2\"></span>, to przy dostatecznie dużym kącie padania promień nie przechodzi do drugiego ośrodka, lecz odbija się w całości. Kąt graniczny (krytyczny) wynosi:</p>
<div data-m=\"\\theta_c = \\arcsin\\!\\left(\\frac{n_2}{n_1}\\right)\"></div>
<p>Włókno zbudowane jest więc z <strong>rdzenia</strong> o wyższym współczynniku załamania i otaczającego go <strong>płaszcza</strong> o niższym współczynniku. Światło wprowadzone do rdzenia pod odpowiednio małym kątem względem osi odbija się od granicy rdzeń–płaszcz i wędruje wzdłuż włókna, prawie bez strat na odbiciach.</p>
<p><em>Przykład liczbowy.</em> Dla rdzenia o <span data-m=\"n_1 = 1{,}48\"></span> i płaszcza o <span data-m=\"n_2 = 1{,}46\"></span>:</p>
<ul>
<li>kąt graniczny: <span data-m=\"\\theta_c = \\arcsin(1{,}46 / 1{,}48) \\approx 80{,}6^\\circ\"></span> (względem normalnej), czyli promienie biegnące pod kątem mniejszym niż ok. 9,4° względem osi włókna są prowadzone;</li>
<li><strong>apertura numeryczna</strong>: <span data-m=\"NA = \\sqrt{n_1^2 - n_2^2} = \\sqrt{2{,}1904 - 2{,}1316} \\approx 0{,}24\"></span>;</li>
<li><strong>kąt akceptacji</strong> (maksymalny kąt wprowadzenia światła z powietrza): <span data-m=\"\\theta_{max} = \\arcsin(NA) \\approx 14^\\circ\"></span>.</li>
</ul>
<p>Różnica współczynników załamania jest bardzo mała (rzędu 1 %), co jest typowe dla włókien telekomunikacyjnych.</p>
<h3>3.2. Budowa włókna i kabla</h3>
<p><img alt=\"Budowa włókna światłowodowego oraz propagacja światła we włóknie wielomodowym skokowym, gradientowym i jednomodowym\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/swiatlowod-budowa-i-propagacja.svg\" /></p>
<p>Włókno składa się z trzech warstw:</p>
<ol>
<li><strong>Rdzeń (core)</strong> — obszar, w którym rozchodzi się światło; ze szkła kwarcowego (SiO₂) domieszkowanego np. germanem, aby podnieść współczynnik załamania. Średnica: ok. <strong>9 µm</strong> (jednomodowe) lub <strong>50 / 62,5 µm</strong> (wielomodowe).</li>
<li><strong>Płaszcz (cladding)</strong> — szkło o niższym współczynniku załamania; średnica standardowo <strong>125 µm</strong>.</li>
<li><strong>Powłoka pierwotna (coating)</strong> — lakier akrylowy o średnicy ok. 250 µm chroniący przed uszkodzeniami mechanicznymi i wilgocią.</li>
</ol>
<p>Kabel światłowodowy dodatkowo zawiera <strong>elementy wzmacniające</strong> (nici aramidowe, pręty z włókna szklanego, rzadziej stalowe), <strong>tuby lub bufor ścisły</strong> oraz <strong>osłonę zewnętrzną</strong> (PVC, LSZH — bezhalogenowa niskodymna, PE do instalacji zewnętrznych, często z żelem lub taśmą blokującą wodę). Ponieważ światłowód nie przewodzi prądu, nie wymaga uziemienia i może być prowadzony w pobliżu linii wysokiego napięcia, jednak przewodzące elementy wzmacniające (np. stalowe) wymagają uwagi.</p>
<h3>3.3. Tryby propagacji</h3>
<p>Rozchodzenie się światła we włóknie można opisać jako superpozycję <strong>modów</strong> — dozwolonych rozkładów pola elektromagnetycznego. Liczba modów zależy od średnicy rdzenia, apertury numerycznej i długości fali. Parametrem opisującym to jest tzw. częstotliwość znormalizowana:</p>
<div data-m=\"V = \\frac{2\\pi a}{\\lambda}\\, NA\"></div>
<p>gdzie <span data-m=\"a\"></span> jest promieniem rdzenia. Włókno prowadzi tylko jeden mod (jest jednomodowe), gdy <span data-m=\"V &lt; 2{,}405\"></span>.</p>
<p><strong>Włókno wielomodowe skokowe (MMF step-index).</strong> Rdzeń o jednolitym współczynniku załamania. Promienie biegnące pod różnymi kątami pokonują różne drogi geometryczne, przez co impuls świetlny „rozmywa się\" w czasie (dyspersja modowa). Obecnie prawie nie stosowane w telekomunikacji.</p>
<p><strong>Włókno wielomodowe gradientowe (MMF graded-index).</strong> Współczynnik załamania maleje płynnie od osi rdzenia do jego brzegu. Promienie odbiegające od osi wędrują dłuższą drogę, lecz przez obszary o niższym współczynniku załamania (a więc z większą prędkością), co w dużej mierze <strong>wyrównuje czasy propagacji</strong>. Tego typu jest współczesne włókno wielomodowe (OM1–OM5).</p>
<p><strong>Włókno jednomodowe (SMF).</strong> Rdzeń o średnicy ok. 9 µm prowadzi tylko jeden mod (dla długości fali powyżej tzw. długości fali odcięcia, ≤ 1260 nm w zaleceniu ITU-T G.652). Brak dyspersji modowej daje największe zasięgi i przepływności.</p>
<h3>3.4. Okna transmisyjne i tłumienie</h3>
<p>Tłumienie światłowodu zależy od długości fali. Głównymi mechanizmami strat są: <strong>rozpraszanie Rayleigha</strong> (maleje z czwartą potęgą długości fali, dlatego dłuższe fale są tłumione słabiej), <strong>absorpcja</strong> przez jony hydroksylowe OH⁻ (charakterystyczny pik „wodny\" w okolicy 1383 nm) oraz absorpcja w podczerwieni powyżej ok. 1600 nm. Powstają <strong>okna transmisyjne</strong>, w których tłumienie jest minimalne:</p>
<table>
<thead>
<tr>
<th>Okno</th>
<th>Długość fali</th>
<th>Typowe tłumienie</th>
<th>Zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td>I</td>
<td>850 nm</td>
<td>ok. 2,5–3 dB/km (MMF)</td>
<td>krótkie łącza wielomodowe, tanie źródła (VCSEL)</td>
</tr>
<tr>
<td>II (pasmo O)</td>
<td>1310 nm</td>
<td>ok. 0,35 dB/km (SMF), ok. 1 dB/km (MMF)</td>
<td>łącza jednomodowe średniego zasięgu, punkt zerowej dyspersji</td>
</tr>
<tr>
<td>III (pasmo C)</td>
<td>1550 nm</td>
<td>ok. 0,2 dB/km (SMF)</td>
<td>łącza dalekiego zasięgu, WDM/DWDM, wzmacniacze EDFA</td>
</tr>
</tbody>
</table>
<p>Pasma telekomunikacyjne oznacza się literami: <strong>O</strong> (1260–1360 nm), <strong>E</strong> (1360–1460), <strong>S</strong> (1460–1530), <strong>C</strong> (1530–1565), <strong>L</strong> (1565–1625) i <strong>U</strong> (1625–1675 nm).</p>
<h3>3.5. Dyspersja</h3>
<p><strong>Dyspersja</strong> to zjawisko poszerzania impulsów świetlnych w trakcie propagacji, które ogranicza maksymalną przepływność i zasięg. Wyróżnia się:</p>
<ul>
<li><strong>dyspersję modową</strong> — różne mody docierają do końca włókna w różnym czasie (tylko MMF); miarą jest tzw. iloczyn pasma i długości (MHz·km);</li>
<li><strong>dyspersję chromatyczną</strong> — różne długości fali biegną z różną prędkością (materiałowa + falowodowa); w SMF wyrażana w ps/(nm·km), wynosi w przybliżeniu 0 przy 1310 nm i ok. 17 ps/(nm·km) przy 1550 nm; kompensuje się ją specjalnymi włóknami lub przetwarzaniem sygnału po stronie odbiorczej;</li>
<li><strong>dyspersję polaryzacyjną (PMD)</strong> — różne polaryzacje światła rozchodzą się z nieco różnymi prędkościami; istotna przy przepływnościach ≥ 10 Gb/s na długich łączach.</li>
</ul>
<h3>3.6. Klasy włókien</h3>
<table>
<thead>
<tr>
<th>Klasa</th>
<th>Typ</th>
<th>Rdzeń / płaszcz</th>
<th>Iloczyn pasma i długości przy 850 nm</th>
<th>Kolor typowej osłony</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td>OM1</td>
<td>wielomodowe</td>
<td>62,5/125 µm</td>
<td>200 MHz·km</td>
<td>pomarańczowy</td>
<td>starsze instalacje</td>
</tr>
<tr>
<td>OM2</td>
<td>wielomodowe</td>
<td>50/125 µm</td>
<td>500 MHz·km</td>
<td>pomarańczowy</td>
<td>1 Gb/s, starsze 10 Gb/s do 82 m</td>
</tr>
<tr>
<td>OM3</td>
<td>wielomodowe, zoptymalizowane pod laser</td>
<td>50/125 µm</td>
<td>2000 MHz·km (EMB)</td>
<td>niebieskozielony (aqua)</td>
<td>10 Gb/s do 300 m, 40/100 Gb/s do 100 m</td>
</tr>
<tr>
<td>OM4</td>
<td>wielomodowe, zoptymalizowane pod laser</td>
<td>50/125 µm</td>
<td>4700 MHz·km (EMB)</td>
<td>aqua (lub „erika violet\")</td>
<td>10 Gb/s do 400 m, 40/100 Gb/s do 150 m</td>
</tr>
<tr>
<td>OM5</td>
<td>wielomodowe, szerokopasmowe (WBMMF)</td>
<td>50/125 µm</td>
<td>4700 MHz·km + pasmo do 953 nm</td>
<td>limonkowy</td>
<td>SWDM, zwiększona przepływność na jedną parę włókien</td>
</tr>
<tr>
<td>OS1 / OS2</td>
<td>jednomodowe (G.652.D)</td>
<td>9/125 µm</td>
<td>—</td>
<td>żółty</td>
<td>od kilkuset metrów do setek kilometrów</td>
</tr>
</tbody>
</table>
<p>W nazwach OM (Optical Multimode) i OS (Optical Single-mode) definiowanych w ISO/IEC 11801.</p>
<h3>3.7. Źródła i detektory światła</h3>
<p><strong>Nadajniki optyczne:</strong></p>
<ul>
<li><strong>LED</strong> — prosty, tani, o szerokim widmie i niskiej mocy; do łączy wielomodowych o niskiej przepływności (np. dawny 100BASE-FX).</li>
<li><strong>VCSEL</strong> (laser z pionową wnęką rezonansową) — tani laser o emisji z powierzchni, 850 nm, stosowany w wielomodowych łączach 1–100 Gb/s.</li>
<li><strong>Laser Fabry–Perota</strong> i <strong>DFB</strong> (z rozłożonym sprzężeniem zwrotnym) — lasery o wąskim widmie, 1310/1550 nm; podstawa łączy jednomodowych dalekiego zasięgu i WDM.</li>
</ul>
<p><strong>Odbiorniki (detektory):</strong></p>
<ul>
<li><strong>Fotodioda PIN</strong> — prosta, tania, stosowana w większości łączy;</li>
<li><strong>Fotodioda lawinowa (APD)</strong> — wewnętrzne wzmocnienie prądu dzięki powielaniu lawinowemu; zwiększa czułość o kilka dB, kosztem szumu i wyższego napięcia zasilającego; stosowana w łączach dalekiego zasięgu i w PON.</li>
</ul>
<h3>3.8. Standardy Ethernet po światłowodzie</h3>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Długość fali</th>
<th>Włókno</th>
<th>Typowy zasięg</th>
</tr>
</thead>
<tbody>
<tr>
<td>100BASE-FX</td>
<td>1300 nm</td>
<td>MMF</td>
<td>2 km</td>
</tr>
<tr>
<td>1000BASE-SX</td>
<td>850 nm</td>
<td>MMF</td>
<td>do 550 m</td>
</tr>
<tr>
<td>1000BASE-LX</td>
<td>1310 nm</td>
<td>SMF (także MMF)</td>
<td>5 km (SMF)</td>
</tr>
<tr>
<td>10GBASE-SR</td>
<td>850 nm</td>
<td>MMF OM3/OM4</td>
<td>300 m / 400 m</td>
</tr>
<tr>
<td>10GBASE-LR</td>
<td>1310 nm</td>
<td>SMF</td>
<td>10 km</td>
</tr>
<tr>
<td>10GBASE-ER</td>
<td>1550 nm</td>
<td>SMF</td>
<td>40 km</td>
</tr>
<tr>
<td>40GBASE-SR4</td>
<td>850 nm, 4 tory równoległe (8 włókien)</td>
<td>MMF OM3/OM4</td>
<td>100 m / 150 m</td>
</tr>
<tr>
<td>100GBASE-SR4</td>
<td>850 nm, 4 tory równoległe</td>
<td>MMF OM4</td>
<td>100 m</td>
</tr>
<tr>
<td>100GBASE-LR4</td>
<td>ok. 1310 nm, 4 długości fali (WDM)</td>
<td>SMF</td>
<td>10 km</td>
</tr>
</tbody>
</table>
<p>Oznaczenia literowe: <strong>S</strong> (short — 850 nm), <strong>L</strong> (long — 1310 nm), <strong>E</strong> (extended — 1550 nm), <strong>R</strong> — kodowanie 64B/66B, cyfra na końcu (np. 4) — liczba torów lub długości fali.</p>
<h3>3.9. Złącza, polerowanie i łączenie włókien</h3>
<p><strong>Złącza</strong> światłowodowe różnią się kształtem i sposobem mocowania:</p>
<ul>
<li><strong>SC</strong> — kwadratowe, zatrzaskowe (push-pull), popularne w sieciach telekomunikacyjnych;</li>
<li><strong>LC</strong> — zminiaturyzowane (ferrula 1,25 mm), stosowane w modułach SFP; najpopularniejsze w sieciach LAN i centrach danych;</li>
<li><strong>ST</strong> — okrągłe, bagnetowe, starsze instalacje wielomodowe;</li>
<li><strong>FC</strong> — gwintowane, do pomiarów i zastosowań specjalnych;</li>
<li><strong>MPO/MTP</strong> — wielowłóknowe (12, 16, 24 włókna), dla łączy 40/100 Gb/s i kabli trunkowych.</li>
</ul>
<p><strong>Polerowanie końcówki</strong> (ferruli) wpływa na <strong>tłumienie odbicia</strong>. Złącza <strong>UPC</strong> (Ultra Physical Contact, zwykle niebieskie) mają powierzchnię wypolerowaną płasko wypukło, natomiast <strong>APC</strong> (Angled Physical Contact, zielone) — pod kątem 8°, co kieruje odbite światło poza rdzeń i zapewnia lepszą tłumienność odbicia (rzędu 60 dB i więcej). APC jest wymagane w sieciach PON i przy przesyłaniu sygnałów wideo analogowych; nie wolno łączyć złączy UPC z APC (uszkodzenie i duże straty).</p>
<p><strong>Łączenie włókien:</strong></p>
<ul>
<li><strong>spawanie fuzyjne</strong> — włókna są stapiane łukiem elektrycznym; tłumienność spawu wynosi zwykle 0,02–0,1 dB, jest to metoda trwała i najlepsza jakościowo;</li>
<li><strong>łączenie mechaniczne</strong> — włókna są zestawiane w prowadnicy z żelem dopasowującym; niższy koszt sprzętu, straty rzędu 0,2–0,5 dB.</li>
</ul>
<p>Największym wrogiem światłowodowego złącza jest <strong>zabrudzenie</strong>: pył lub ślad palca na powierzchni ferruli mogą powodować tłumienie i uszkodzenie. Standardem pracy jest inspekcja mikroskopowa i czyszczenie przed każdym połączeniem.</p>
<h3>3.10. Bilans mocy łącza (link budget)</h3>
<p>Poprawność projektu łącza sprawdza się, porównując <strong>budżet mocy</strong> transceiverów z <strong>sumą strat</strong> w torze.</p>
<div data-m=\"\\text{Budżet} = P_{Tx} - S_{Rx} \\qquad\\qquad \\text{Straty} = \\alpha \\cdot L + N_{\\text{spawów}} \\cdot A_s + N_{\\text{złączy}} \\cdot A_z + M\"></div>
<p>gdzie <span data-m=\"P_{Tx}\"></span> to moc nadajnika (dBm), <span data-m=\"S_{Rx}\"></span> — czułość odbiornika (dBm), <span data-m=\"\\alpha\"></span> — tłumienność jednostkowa włókna (dB/km), <span data-m=\"L\"></span> — długość, <span data-m=\"A_s\"></span> i <span data-m=\"A_z\"></span> — tłumienność spawu i pary złączy, a <span data-m=\"M\"></span> — zapas (margines) na starzenie i naprawy (zwykle 2–3 dB).</p>
<p><em>Przykład.</em> Transceiver o mocy nadawczej −5 dBm i czułości odbiornika −15 dBm ma budżet 10 dB. Łącze jednomodowe ma długość 8 km przy 1310 nm (<span data-m=\"\\alpha = 0{,}35\"></span> dB/km), zawiera dwa spawy po 0,1 dB i cztery pary złączy po 0,5 dB, przyjęto zapas 3 dB:</p>
<div data-m=\"\\text{Straty} = 8 \\cdot 0{,}35 + 2 \\cdot 0{,}1 + 4 \\cdot 0{,}5 + 3 = 2{,}8 + 0{,}2 + 2{,}0 + 3 = 8{,}0 \\text{ dB}\"></div>
<p>Straty (8 dB) są mniejsze niż budżet (10 dB), więc łącze pracuje z rezerwą 2 dB. Należy pamiętać, że zbyt duża moc na odbiorniku (np. przy bardzo krótkim łączu i mocnym laserze) również jest problemem: wymaga zastosowania <strong>tłumika optycznego</strong>.</p>
<h3>3.11. Zwielokrotnienie falowe (WDM)</h3>
<p><strong>WDM (Wavelength Division Multiplexing)</strong> pozwala przesyłać jednocześnie wiele niezależnych sygnałów optycznych w jednym włóknie, używając różnych długości fali. Odpowiednik „wielu kolorów\" w jednej nici.</p>
<ul>
<li><strong>CWDM</strong> (Coarse WDM) — odstęp kanałów 20 nm, do 18 kanałów w zakresie ok. 1270–1610 nm (ITU-T G.694.2); tanie lasery niechłodzone, zasięgi do ok. 80 km, zastosowanie w sieciach metropolitalnych i operatorskich.</li>
<li><strong>DWDM</strong> (Dense WDM) — odstępy 100, 50 lub 25 GHz (ok. 0,8 / 0,4 / 0,2 nm; ITU-T G.694.1), zwykle w paśmie C i L; kilkadziesiąt do ponad stu kanałów, każdy o przepływności 10–800 Gb/s; w połączeniu ze wzmacniaczami erbowymi (<strong>EDFA</strong>) pozwala na łącza dalekosiężne (tysiące kilometrów) o łącznej przepływności rzędu dziesiątek terabitów na sekundę na jednym włóknie.</li>
</ul>
<p>WDM jest podstawą sieci szkieletowych operatorów i międzykontynentalnych kabli podmorskich.</p>
<h3>3.12. Transceivery modułowe</h3>
<p>Interfejsy optyczne w przełącznikach i routerach realizowane są jako wymienne moduły (transceivery), co pozwala dobrać typ medium do potrzeb bez wymiany urządzenia:</p>
<ul>
<li><strong>SFP</strong> (1 Gb/s), <strong>SFP+</strong> (10 Gb/s), <strong>SFP28</strong> (25 Gb/s) — moduły z gniazdem LC (duplex);</li>
<li><strong>QSFP+</strong> (40 Gb/s), <strong>QSFP28</strong> (100 Gb/s), <strong>QSFP-DD</strong> (400 Gb/s) i nowsze — moduły wielotorowe;</li>
<li>kable <strong>DAC</strong> (Direct Attach Copper) i <strong>AOC</strong> (Active Optical Cable) — kable z wtopionymi końcówkami, do krótkich połączeń w szafach.</li>
</ul>
<p>W modułach optycznych umieszczany jest zwykle mikrokontroler z interfejsem diagnostycznym <strong>DOM/DDM</strong> (Digital Optical Monitoring), umożliwiającym odczyt mocy nadawczej, odbiorczej, temperatury i napięcia — bardzo przydatny przy diagnostyce.</p>
<h3>3.13. Światłowód w sieciach dostępowych</h3>
<p>W sieciach dostępowych światłowód dociera coraz bliżej użytkownika. Rozróżnia się architektury <strong>FTTx</strong>: FTTH (Fiber to the Home — do mieszkania/domu), FTTB (Fiber to the Building — do budynku), FTTC/FTTN (do szafy ulicznej, dalej miedź). Popularną techniką jest pasywna sieć optyczna <strong>PON</strong>, omówiona szczegółowo w rozdziale 6.</p>
<h3>3.14. Zalety i ograniczenia światłowodów</h3>
<p><strong>Zalety:</strong> ogromna szerokość pasma, minimalne tłumienie (zasięgi do kilkudziesięciu kilometrów bez regeneracji), pełna odporność na zakłócenia elektromagnetyczne i przesłuchy, brak promieniowania (utrudniony podsłuch), galwaniczna separacja urządzeń, mała masa i średnica, brak przewodzenia iskry (bezpieczne w środowisku zagrożonym wybuchem).</p>
<p><strong>Ograniczenia:</strong> wyższy koszt urządzeń i osprzętu, wymagane specjalistyczne narzędzia i przeszkolenie do spawania i pomiarów (reflektometr OTDR, miernik mocy), wrażliwość na zbyt ciasne zagięcia (minimalny promień gięcia to zwykle 10–15 średnic kabla), brak możliwości zasilania urządzeń przez sam kabel oraz konieczność dbania o czystość złączy.</p>
<hr />
<h2>4. Fale radiowe jako medium transmisyjne</h2>
<h3>4.1. Widmo fal radiowych</h3>
<p><strong>Fala elektromagnetyczna</strong> to zaburzenie pola elektrycznego i magnetycznego rozchodzące się w przestrzeni z prędkością światła <span data-m=\"c \\approx 3\\cdot 10^8\"></span> m/s. Częstotliwość <span data-m=\"f\"></span> i długość fali <span data-m=\"\\lambda\"></span> są związane zależnością:</p>
<div data-m=\"c = f \\cdot \\lambda \\quad\\Rightarrow\\quad \\lambda = \\frac{c}{f}\"></div>
<p>Dla Wi-Fi 2,4 GHz długość fali wynosi ok. 12,5 cm, dla 5 GHz — ok. 6 cm, a dla 60 GHz — ok. 5 mm. Długość fali determinuje rozmiary anten (typowo ułamek długości fali, np. ćwierćfalówka), sposób przenikania przez przeszkody i zjawiska dyfrakcyjne.</p>
<p><img alt=\"Pasma fal radiowych według ITU w skali logarytmicznej wraz z zastosowaniami: radio AM/FM, telefonia komórkowa, Wi-Fi, łączność satelitarna\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/widmo-fal-radiowych.svg\" /></p>
<p>Międzynarodowy Związek Telekomunikacyjny (<strong>ITU</strong>) dzieli widmo radiowe na pasma dekadowe, od VLF (3–30 kHz) do EHF (30–300 GHz). Sieci bezprzewodowe LAN pracują głównie w paśmie <strong>UHF/SHF</strong> (od ok. 2,4 do 7 GHz), gdzie zapewniona jest dostatecznie duża szerokość pasma, a anteny są niewielkie i wygodne w urządzeniach mobilnych.</p>
<h3>4.2. Regulacje i pasma bezlicencyjne (ISM/UNII)</h3>
<p>Widmo radiowe jest zasobem ograniczonym i <strong>regulowanym</strong>. Na świecie o podziale częstotliwości decyduje ITU, w Europie normy techniczne opracowuje <strong>ETSI</strong>, a decyzje regulacyjne wprowadza Komisja Europejska; w Polsce nadzór sprawuje <strong>Urząd Komunikacji Elektronicznej (UKE)</strong>. Większość zastosowań wymaga <strong>pozwolenia radiowego</strong> (licencji), ale wybrane pasma, tzw. <strong>ISM</strong> (Industrial, Scientific, Medical), udostępniono do użytku <strong>bezlicencyjnego</strong> pod warunkiem przestrzegania ograniczeń mocy i zasad współdzielenia.</p>
<table>
<thead>
<tr>
<th>Pasmo</th>
<th>Zakres</th>
<th>Typowe zastosowania</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>433 MHz</td>
<td>433,05–434,79 MHz</td>
<td>piloty, czujniki, systemy alarmowe</td>
<td>duży zasięg, mała przepływność</td>
</tr>
<tr>
<td>868 MHz</td>
<td>863–870 MHz (UE)</td>
<td>IoT (LoRa, Sigfox, Wi-Fi HaLow), liczniki</td>
<td>ograniczony cykl pracy (duty cycle)</td>
</tr>
<tr>
<td><strong>2,4 GHz</strong></td>
<td>2400–2483,5 MHz</td>
<td>Wi-Fi, Bluetooth, Zigbee, kuchenki mikrofalowe</td>
<td>bardzo zatłoczone</td>
</tr>
<tr>
<td><strong>5 GHz</strong></td>
<td>ok. 5150–5875 MHz (podpasma)</td>
<td>Wi-Fi</td>
<td>DFS i TPC w części pasma, kanały do 160 MHz</td>
</tr>
<tr>
<td><strong>6 GHz</strong></td>
<td>5945–6425 MHz w UE (5925–7125 MHz w USA)</td>
<td>Wi-Fi 6E/7</td>
<td>brak dostępu starszych urządzeń, kanały do 320 MHz</td>
</tr>
<tr>
<td>60 GHz</td>
<td>57–71 GHz</td>
<td>WiGig (802.11ad/ay), łącza punkt–punkt</td>
<td>bardzo silne tłumienie, zasięg kilku–kilkunastu metrów</td>
</tr>
</tbody>
</table>
<p>Zasady dotyczące mocy, dostępnych kanałów i wymogów (np. DFS — dynamic frequency selection, czyli wykrywanie radarów i ustępowanie im) różnią się między krajami i są aktualizowane. W UE moc wyjściowa urządzeń Wi-Fi jest ograniczona (przykładowo do 100 mW EIRP w paśmie 2,4 GHz), a w 6 GHz wprowadzono kategorie urządzeń o niskiej mocy do zastosowań wewnątrz budynków. <strong>Zawsze należy sprawdzać aktualne przepisy krajowe.</strong></p>
<h3>4.3. Propagacja fal radiowych</h3>
<p>W przeciwieństwie do kabla, w którym sygnał jest prowadzony, fala radiowa rozchodzi się w przestrzeni we wszystkich kierunkach i podlega szeregowi zjawisk.</p>
<p><strong>Tłumienie w przestrzeni swobodnej (FSPL — Free-Space Path Loss).</strong> Nawet bez przeszkód moc fali maleje, ponieważ rozkłada się na coraz większą powierzchnię (odwrotnie proporcjonalnie do kwadratu odległości), a ponadto skuteczna apertura anteny odbiorczej maleje z częstotliwością. Tłumienie wynosi:</p>
<div data-m=\"\\text{FSPL}_{\\text{dB}} = 20\\log_{10}(d_{\\text{m}}) + 20\\log_{10}(f_{\\text{MHz}}) - 27{,}55\"></div>
<p>gdzie <span data-m=\"d\"></span> jest odległością w metrach, a <span data-m=\"f\"></span> częstotliwością w megahercach.</p>
<p><em>Przykład.</em> Dla <span data-m=\"d = 100\"></span> m: przy <span data-m=\"f = 2450\"></span> MHz FSPL <span data-m=\"= 40 + 67{,}8 - 27{,}55 \\approx 80{,}2\"></span> dB, a przy <span data-m=\"f = 5500\"></span> MHz FSPL <span data-m=\"= 40 + 74{,}8 - 27{,}55 \\approx 87{,}3\"></span> dB. Różnica wynosi ok. <strong>7 dB</strong> — to jeden z powodów, dla których sygnał 5 GHz jest „słabszy\" od 2,4 GHz nawet bez przeszkód. Każde podwojenie odległości zwiększa tłumienie o 6 dB, a każde podwojenie częstotliwości również o 6 dB.</p>
<p><strong>Zjawiska propagacyjne w rzeczywistym otoczeniu:</strong></p>
<ul>
<li><strong>odbicie</strong> — fala odbija się od dużych, gładkich powierzchni (metal, szkło, woda, ściany);</li>
<li><strong>załamanie (refrakcja)</strong> — zmiana kierunku fali przy przejściu między ośrodkami;</li>
<li><strong>dyfrakcja</strong> — uginanie fali na krawędziach przeszkód, dzięki czemu sygnał dociera także za przeszkodą (tym silniej, im większa długość fali);</li>
<li><strong>rozpraszanie</strong> — fala odbija się w wielu kierunkach od małych obiektów (liście, chropowate powierzchnie);</li>
<li><strong>absorpcja</strong> — zamiana energii fali na ciepło w przeszkodzie; przykładowo żelbet i woda tłumią silnie, płyta gipsowo-kartonowa niewiele, a 5 GHz i 6 GHz są tłumione silniej niż 2,4 GHz;</li>
<li><strong>propagacja wielodrogowa (multipath)</strong> — do odbiornika docierają kopie tego samego sygnału o różnych opóźnieniach i fazach; mogą się wzmacniać lub wygaszać (<strong>zaniki, fading</strong>) i powodować <strong>interferencję międzysymbolową</strong>.</li>
</ul>
<p>Wielodrogowość jest wrogiem w klasycznej transmisji, ale w nowoczesnych systemach (OFDM, MIMO) jest wykorzystywana jako zasób — patrz podrozdziały 4.5–4.6.</p>
<h3>4.4. Anteny i budżet łącza radiowego</h3>
<p><strong>Antena</strong> zamienia sygnał elektryczny na falę elektromagnetyczną i odwrotnie. Jej najważniejszym parametrem jest <strong>zysk (gain)</strong> wyrażany w <strong>dBi</strong>: o ile mocniej antena promieniuje w danym kierunku w porównaniu z idealną anteną izotropową (promieniującą równomiernie we wszystkich kierunkach). Zysk nie oznacza wytworzenia dodatkowej energii — antena o dużym zysku skupia moc w węższej wiązce.</p>
<ul>
<li><strong>Anteny dookólne</strong> (omnidirectional) — promieniowanie w płaszczyźnie poziomej we wszystkich kierunkach; typowy zysk 2–9 dBi; w routerach domowych i punktach dostępowych.</li>
<li><strong>Anteny kierunkowe</strong> (Yagi, panelowe, paraboliczne) — skupiają wiązkę; zysk 10–30 dBi; do łączy punkt–punkt i pokrycia sektorowego.</li>
</ul>
<p>Moc efektywnie wypromieniowana w kierunku maksymalnego zysku to <strong>EIRP</strong> (Equivalent Isotropically Radiated Power):</p>
<div data-m=\"\\text{EIRP}_{\\text{dBm}} = P_{Tx,\\text{dBm}} - L_{\\text{kabli}} + G_{Tx,\\text{dBi}}\"></div>
<p>To właśnie EIRP jest wielkością limitowaną przepisami. <strong>Bilans łącza</strong> pozwala oszacować moc odbieraną:</p>
<div data-m=\"P_{Rx,\\text{dBm}} = \\text{EIRP} - \\text{FSPL} - L_{\\text{przeszkód}} + G_{Rx,\\text{dBi}}\"></div>
<p><em>Przykład.</em> Nadajnik 17 dBm z anteną 3 dBi (bez strat w kablu): EIRP = 20 dBm. Odległość 50 m przy 5500 MHz: FSPL <span data-m=\"= 33{,}98 + 74{,}81 - 27{,}55 \\approx 81{,}2\"></span> dB. Odbiornik z anteną 0 dBi otrzymuje <span data-m=\"P_{Rx} = 20 - 81{,}2 + 0 \\approx -61{,}2\"></span> dBm. Podłoże szumowe dla kanału 20 MHz wynosi ok. −174 + 73 = −101 dBm, po uwzględnieniu współczynnika szumów odbiornika (ok. 6 dB) ok. −95 dBm. Stąd SNR ≈ 34 dB — wartość pozwalająca na wysokie modulacje. Dodanie dwóch ścian (po ok. 5 dB każda) zmniejszyłoby SNR do ok. 24 dB.</p>
<h3>4.5. Modulacje cyfrowe</h3>
<p>Aby przesłać bity falą radiową, modyfikuje się parametry <strong>fali nośnej</strong> w rytm danych:</p>
<ul>
<li><strong>ASK</strong> (Amplitude-Shift Keying) — zmiana amplitudy;</li>
<li><strong>FSK</strong> (Frequency-Shift Keying) — zmiana częstotliwości (stosowana m.in. w Bluetooth klasycznym i prostych systemach IoT);</li>
<li><strong>PSK</strong> (Phase-Shift Keying) — zmiana fazy: <strong>BPSK</strong> (2 fazy, 1 bit na symbol), <strong>QPSK</strong> (4 fazy, 2 bity);</li>
<li><strong>QAM</strong> (Quadrature Amplitude Modulation) — łączna zmiana amplitudy i fazy dwóch nośnych przesuniętych o 90° (składowe I i Q); kolejne stopnie: 16-QAM (4 bity/symbol), 64-QAM (6), <strong>256-QAM (8)</strong>, <strong>1024-QAM (10)</strong>, <strong>4096-QAM (12)</strong>.</li>
</ul>
<p>Każdemu punktowi na <strong>diagramie konstelacji</strong> odpowiada jeden symbol. Im więcej punktów, tym więcej bitów na symbol — ale tym mniejsze są odległości między punktami, więc mniejszy szum wystarcza do pomylenia symbolu. Dlatego wyższe modulacje wymagają wyższego SNR:</p>
<table>
<thead>
<tr>
<th>Modulacja</th>
<th>Bitów na symbol</th>
<th>Orientacyjny wymagany SNR</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>BPSK</td>
<td>1</td>
<td>ok. 5 dB</td>
<td>najlepsza odporność, największy zasięg</td>
</tr>
<tr>
<td>QPSK</td>
<td>2</td>
<td>ok. 8–10 dB</td>
<td></td>
</tr>
<tr>
<td>16-QAM</td>
<td>4</td>
<td>ok. 15–18 dB</td>
<td></td>
</tr>
<tr>
<td>64-QAM</td>
<td>6</td>
<td>ok. 22–25 dB</td>
<td></td>
</tr>
<tr>
<td>256-QAM</td>
<td>8</td>
<td>ok. 28–32 dB</td>
<td>Wi-Fi 5</td>
</tr>
<tr>
<td>1024-QAM</td>
<td>10</td>
<td>ok. 35 dB</td>
<td>Wi-Fi 6</td>
</tr>
<tr>
<td>4096-QAM</td>
<td>12</td>
<td>ok. 40 dB i więcej</td>
<td>Wi-Fi 7</td>
</tr>
</tbody>
</table>
<p>Przepływność zależy nie tylko od modulacji, ale też od <strong>szybkości kodowania korekcyjnego</strong> (np. 1/2, 2/3, 3/4, 5/6): część bitów służy korekcji błędów (kodowanie splotowe lub LDPC). Zestawy modulacji i kodowania nazywa się w Wi-Fi <strong>MCS</strong> (Modulation and Coding Scheme). System <strong>adaptacji prędkości</strong> automatycznie wybiera najwyższy MCS, przy którym transmisja jest jeszcze niezawodna.</p>
<h3>4.6. Rozpraszanie widma i OFDM</h3>
<p><strong>Techniki rozproszonego widma</strong> (spread spectrum) rozszerzają sygnał na pasmo szersze niż konieczne, co zwiększa odporność na zakłócenia i utrudnia podsłuch:</p>
<ul>
<li><strong>FHSS</strong> (Frequency-Hopping) — nadajnik szybko przeskakuje między wieloma częstotliwościami według ustalonej sekwencji (Bluetooth, pierwotne 802.11);</li>
<li><strong>DSSS</strong> (Direct Sequence) — każdy bit jest mnożony przez szybki ciąg chipów (kod pseudolosowy), np. 11-chipowy kod Barkera w 802.11 i 802.11b (1 i 2 Mb/s).</li>
</ul>
<p>Współczesne systemy szerokopasmowe (Wi-Fi od 802.11a/g, LTE, 5G, DVB-T, DSL) używają <strong>OFDM</strong> (Orthogonal Frequency-Division Multiplexing). Zamiast jednej szybkiej nośnej stosuje się <strong>wiele wolnych, ortogonalnych podnośnych</strong>, których rozstaw równy jest odwrotności czasu trwania symbolu (<span data-m=\"\\Delta f = 1/T_u\"></span>). Dzięki ortogonalności widma podnośnych mogą się nakładać bez wzajemnych zakłóceń. Zalety OFDM:</p>
<ul>
<li><strong>odporność na propagację wielodrogową</strong> — każda podnośna jest wąska, więc widzi „płaski\" kanał; opóźnione kopie symbolu tłumi <strong>przedział ochronny (GI, guard interval)</strong> wstawiany przed symbolem (kopia końca symbolu);</li>
<li><strong>elastyczność</strong> — słabe podnośne można wyłączyć albo zmodulować niżej (adaptive bit loading), a silne — wyżej;</li>
<li><strong>efektywna implementacja</strong> — modulator i demodulator realizowane są przez algorytmy szybkiej transformaty Fouriera (IFFT / FFT).</li>
</ul>
<p>W wariancie wielodostępowym <strong>OFDMA</strong> (Wi-Fi 6, LTE, 5G) podnośne są przydzielane różnym użytkownikom w tym samym symbolu (bloki zasobów, RU).</p>
<h3>4.7. MIMO i formowanie wiązki</h3>
<p><strong>MIMO</strong> (Multiple-Input Multiple-Output) wykorzystuje wiele anten nadawczych i odbiorczych. Wielodrogowość, dotąd szkodliwa, staje się zasobem: kilka niezależnych <strong>strumieni przestrzennych</strong> (spatial streams) przesyłanych jednocześnie na tej samej częstotliwości daje wielokrotność przepływności. Oznaczenie <strong>NxM</strong> to liczba anten nadawczych i odbiorczych, a osobno wyróżnia się liczbę strumieni (np. 2×2:2). Maksymalna teoretyczna liczba strumieni to mniejsza z liczb anten nadawczych i odbiorczych.</p>
<p>Techniki pokrewne:</p>
<ul>
<li><strong>Zróżnicowanie (diversity) i kodowanie przestrzenno-czasowe</strong> — zwiększają niezawodność, nie przepływność;</li>
<li><strong>Beamforming (formowanie wiązki)</strong> — dobór fazy i amplitudy sygnałów na antenach tak, aby energia sumowała się konstruktywnie w kierunku odbiorcy;</li>
<li><strong>MU-MIMO (Multi-User MIMO)</strong> — obsługa wielu klientów jednocześnie na różnych strumieniach przestrzennych; wprowadzone w 802.11ac (kierunek w dół), w 802.11ax także w górę.</li>
</ul>
<h3>4.8. Inne technologie radiowe (przegląd)</h3>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Standard</th>
<th>Pasmo</th>
<th>Zasięg</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td>Bluetooth / BLE</td>
<td>IEEE 802.15.1 / Bluetooth SIG</td>
<td>2,4 GHz</td>
<td>10–100 m</td>
<td>urządzenia peryferyjne, słuchawki, czujniki</td>
</tr>
<tr>
<td>Zigbee / Thread</td>
<td>IEEE 802.15.4</td>
<td>2,4 GHz, 868 MHz</td>
<td>10–100 m</td>
<td>inteligentny dom, sieci kratowe czujników</td>
</tr>
<tr>
<td>LoRaWAN</td>
<td>LoRa Alliance</td>
<td>868 MHz (UE)</td>
<td>kilka–kilkanaście km</td>
<td>IoT o niskiej przepływności (LPWAN)</td>
</tr>
<tr>
<td>NFC</td>
<td>ISO/IEC 14443, 18092</td>
<td>13,56 MHz</td>
<td>do 10 cm</td>
<td>płatności, identyfikacja</td>
</tr>
<tr>
<td>LTE (4G)</td>
<td>3GPP</td>
<td>700–2600 MHz i inne</td>
<td>do kilkunastu km</td>
<td>telefonia komórkowa i FWA</td>
</tr>
<tr>
<td>5G NR</td>
<td>3GPP</td>
<td>sub-6 GHz i mmWave (24–52 GHz)</td>
<td>od setek metrów do kilku km</td>
<td>telefonia, FWA, sieci prywatne</td>
</tr>
<tr>
<td>Łączność satelitarna</td>
<td>m.in. DVB-S2, systemy LEO</td>
<td>1–30 GHz</td>
<td>globalny</td>
<td>dostęp na obszarach o słabej infrastrukturze</td>
</tr>
<tr>
<td>Mikrofalowe łącza punkt–punkt</td>
<td>ETSI</td>
<td>5–80 GHz</td>
<td>do kilkudziesięciu km</td>
<td>radiolinie operatorskie</td>
</tr>
</tbody>
</table>
<h3>4.9. Zalety i ograniczenia mediów radiowych</h3>
<p><strong>Zalety:</strong> mobilność użytkowników, szybkie wdrożenie bez okablowania, możliwość dotarcia do miejsc trudnych do skablowania (zabytki, tereny górskie), elastyczność zmiany układu sieci, niski koszt pokrycia dużych, rozproszonych obszarów.</p>
<p><strong>Ograniczenia:</strong> współdzielenie ograniczonego widma i interferencje (w pasmach bezlicencyjnych), zmienna jakość sygnału zależna od otoczenia, tłumienie przeszkód, niższa przepływność i większe opóźnienia niż w kablu, <strong>podatność na podsłuch i ataki</strong> (medium jest dostępne dla każdego w zasięgu), konieczność szyfrowania oraz kwestie zdrowotne i regulacyjne (limity mocy).</p>
<hr />
<h2>5. Standardy IEEE 802.11 (Wi-Fi)</h2>
<h3>5.1. Rodzina 802.11 i marka Wi-Fi</h3>
<p><strong>IEEE 802.11</strong> to zbiór standardów bezprzewodowych sieci lokalnych (WLAN), opracowywanych przez grupę roboczą 802.11 w ramach komitetu IEEE 802 (tego samego, który stworzył 802.3 — Ethernet). Standardy definiują dwie najniższe warstwy: <strong>warstwę fizyczną (PHY)</strong> oraz <strong>podwarstwę MAC</strong> warstwy łącza danych, dzięki czemu wyższe warstwy (IP, TCP) działają identycznie jak w sieci przewodowej. Ramka 802.11 jest po stronie punktu dostępowego konwertowana na ramkę Ethernet, dlatego Wi-Fi bywa nazywane „bezprzewodowym Ethernetem\" — choć mechanizm dostępu do medium jest zasadniczo inny.</p>
<p>Sama nazwa <strong>Wi-Fi</strong> jest znakiem towarowym organizacji <strong>Wi-Fi Alliance</strong>, która testuje zgodność produktów różnych producentów i przyznaje certyfikaty. Nie każde urządzenie „802.11\" jest certyfikowane jako Wi-Fi, ale w praktyce oba terminy używane są zamiennie. Dla czytelności od 2018 r. Wi-Fi Alliance stosuje <strong>numerację generacji</strong>: Wi-Fi 4 (802.11n), Wi-Fi 5 (802.11ac), Wi-Fi 6 i 6E (802.11ax), Wi-Fi 7 (802.11be).</p>
<p>Standard bazowy jest od czasu do czasu „skonsolidowany\" (rollup) razem z przyjętymi poprawkami w jeden dokument. Obecnie obowiązuje wersja <strong>IEEE 802.11-2024</strong> (opublikowana w 2025 r.), a poszczególne poprawki (amendments), takie jak 802.11be, publikowane są osobno i włączane do następnej rewizji. Oznaczenia liter oznaczają kolejne poprawki, a nie „wersje\" w sensie chronologicznym (np. 802.11i dotyczy bezpieczeństwa, a 802.11ac jest późniejsza niż 802.11n).</p>
<h3>5.2. Architektura sieci 802.11</h3>
<p>Podstawowe pojęcia:</p>
<ul>
<li><strong>STA (station)</strong> — dowolne urządzenie z interfejsem 802.11 (laptop, telefon, czujnik);</li>
<li><strong>AP (Access Point, punkt dostępowy)</strong> — urządzenie łączące stacje bezprzewodowe z siecią przewodową (system dystrybucji);</li>
<li><strong>BSS (Basic Service Set)</strong> — podstawowy zestaw usług: jeden AP wraz ze skojarzonymi z nim stacjami, tworzący pojedynczą „komórkę\" radiową; identyfikowany przez <strong>BSSID</strong> (zwykle adres MAC radia AP);</li>
<li><strong>SSID (Service Set Identifier)</strong> — nazwa sieci widoczna dla użytkownika (do 32 bajtów); wiele AP może rozgłaszać ten sam SSID;</li>
<li><strong>DS (Distribution System)</strong> — system dystrybucji łączący punkty dostępowe (zwykle sieć Ethernet);</li>
<li><strong>ESS (Extended Service Set)</strong> — zbiór BSS połączonych systemem dystrybucji, tworzący jedną logiczną sieć o wspólnym SSID i umożliwiający <strong>roaming</strong> między punktami dostępowymi;</li>
<li><strong>IBSS (Independent BSS, sieć ad hoc)</strong> — grupa stacji komunikujących się bezpośrednio, bez AP (nadal spotykana w trybach typu Wi-Fi Direct).</li>
</ul>
<p>Najczęściej spotykany jest tryb <strong>infrastrukturalny</strong> (infrastructure), w którym cała komunikacja przechodzi przez AP, nawet między dwiema stacjami w tej samej komórce. Wariantami są: <strong>mostek bezprzewodowy</strong> (łączenie dwóch sieci przewodowych), <strong>repeater/extender</strong> (rozszerzenie zasięgu — zwykle kosztem połowy przepustowości, bo radio nadaje i odbiera na tym samym kanale) oraz <strong>sieć kratowa (mesh)</strong>, w której punkty dostępowe łączą się ze sobą bezprzewodowo, tworząc elastyczną strukturę (standard <strong>802.11s</strong> oraz rozwiązania producentów).</p>
<h3>5.3. Przegląd ewolucji standardów</h3>
<p><img alt=\"Teoretyczne maksymalne przepływności kolejnych standardów Wi-Fi w skali logarytmicznej: od 2 Mb/s w 802.11 do ponad 46 Gb/s w 802.11be\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/wifi-ewolucja-standardow.svg\" /></p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Rok</th>
<th>Nazwa marketingowa</th>
<th>Pasmo</th>
<th>Szerokość kanału</th>
<th>Modulacja</th>
<th>Maks. strumieni</th>
<th>Maks. teoretyczna przepływność</th>
</tr>
</thead>
<tbody>
<tr>
<td>802.11 (pierwotny)</td>
<td>1997</td>
<td>—</td>
<td>2,4 GHz</td>
<td>22 MHz</td>
<td>DSSS / FHSS (BPSK, QPSK), podczerwień</td>
<td>1</td>
<td>2 Mb/s</td>
</tr>
<tr>
<td>802.11b</td>
<td>1999</td>
<td>(Wi-Fi 1, nieoficjalnie)</td>
<td>2,4 GHz</td>
<td>22 MHz</td>
<td>DSSS / CCK</td>
<td>1</td>
<td>11 Mb/s</td>
</tr>
<tr>
<td>802.11a</td>
<td>1999</td>
<td>(Wi-Fi 2, nieoficjalnie)</td>
<td>5 GHz</td>
<td>20 MHz</td>
<td>OFDM, do 64-QAM</td>
<td>1</td>
<td>54 Mb/s</td>
</tr>
<tr>
<td>802.11g</td>
<td>2003</td>
<td>(Wi-Fi 3, nieoficjalnie)</td>
<td>2,4 GHz</td>
<td>20 MHz</td>
<td>OFDM, do 64-QAM (+ zgodność z b)</td>
<td>1</td>
<td>54 Mb/s</td>
</tr>
<tr>
<td>802.11n</td>
<td>2009</td>
<td><strong>Wi-Fi 4</strong></td>
<td>2,4 i 5 GHz</td>
<td>20 / 40 MHz</td>
<td>OFDM, do 64-QAM</td>
<td>4</td>
<td>600 Mb/s</td>
</tr>
<tr>
<td>802.11ac</td>
<td>2013 (Wave 2: 2016)</td>
<td><strong>Wi-Fi 5</strong></td>
<td>5 GHz</td>
<td>20 / 40 / 80 / 160 MHz</td>
<td>OFDM, do 256-QAM</td>
<td>8</td>
<td>ok. 6,9 Gb/s</td>
</tr>
<tr>
<td>802.11ax</td>
<td>2021</td>
<td><strong>Wi-Fi 6</strong> (2,4/5 GHz), <strong>6E</strong> (+ 6 GHz)</td>
<td>2,4 / 5 / 6 GHz</td>
<td>20–160 MHz</td>
<td>OFDM/OFDMA, do 1024-QAM</td>
<td>8</td>
<td>ok. 9,6 Gb/s</td>
</tr>
<tr>
<td>802.11be</td>
<td>zatw. 2024, publ. 2025</td>
<td><strong>Wi-Fi 7</strong></td>
<td>2,4 / 5 / 6 GHz</td>
<td>20–320 MHz</td>
<td>OFDM/OFDMA, do 4096-QAM</td>
<td>16</td>
<td>ok. 46 Gb/s</td>
</tr>
</tbody>
</table>
<p>Warto podkreślić: podane przepływności są <strong>teoretycznymi maksimami warstwy fizycznej</strong> dla największej dozwolonej liczby strumieni i szerokości kanału. Typowy telefon czy laptop ma 1–2 anteny (strumienie), więc realne wartości PHY są kilkakrotnie niższe, a przepustowość użytkowa — jeszcze niższa (narzuty protokołu, współdzielenie medium, zakłócenia; w praktyce ok. 50–70 % przepływności PHY przy dobrych warunkach, a mniej w słabych).</p>
<h3>5.4. Charakterystyka poszczególnych standardów</h3>
<h4>802.11 (1997), 802.11b (1999)</h4>
<p>Pierwotny standard oferował zaledwie 1 i 2 Mb/s w paśmie 2,4 GHz z użyciem rozpraszania widma (DSSS lub FHSS) oraz opcjonalnej podczerwieni. <strong>802.11b</strong> wprowadził kodowanie <strong>CCK</strong> (Complementary Code Keying) i przepływności 5,5 oraz 11 Mb/s przy zachowaniu tego samego kanału 22 MHz. To on uczynił Wi-Fi popularnym na rynku konsumenckim.</p>
<h4>802.11a (1999) i 802.11g (2003)</h4>
<p><strong>802.11a</strong> jako pierwszy zastosował <strong>OFDM</strong> (52 podnośne w kanale 20 MHz, z czego 48 na dane i 4 pilotowe) i pasmo <strong>5 GHz</strong>, osiągając do 54 Mb/s. Mniej zatłoczone pasmo było zaletą, lecz wyższa częstotliwość oznaczała krótszy zasięg i wyższe koszty, przez co standard początkowo zdobył mniejszą popularność. <strong>802.11g</strong> przeniósł OFDM do pasma 2,4 GHz, zachowując zgodność wsteczną z 802.11b. Obecność choćby jednego urządzenia „b\" zmuszała jednak AP do stosowania mechanizmów ochronnych (RTS/CTS lub CTS-to-self), co obniżało przepustowość całej komórki.</p>
<h4>802.11n — Wi-Fi 4 (2009)</h4>
<p>Przełomowy standard wprowadzający:</p>
<ul>
<li><strong>MIMO</strong> z do 4 strumieniami przestrzennymi,</li>
<li><strong>kanały 40 MHz</strong> (przez łączenie dwóch sąsiednich kanałów 20 MHz),</li>
<li><strong>agregację ramek</strong> (A-MSDU i A-MPDU) — łączenie wielu ramek w jedną transmisję, co zmniejsza względny narzut nagłówków i przerw międzyramkowych,</li>
<li><strong>Block ACK</strong> — potwierdzanie wielu ramek jednym potwierdzeniem,</li>
<li><strong>krótszy przedział ochronny</strong> (400 ns zamiast 800 ns),</li>
<li>pracę w obu pasmach: 2,4 i 5 GHz.</li>
</ul>
<p>Maksymalnie: 4 strumienie × 40 MHz × 64-QAM 5/6 × krótki GI = 600 Mb/s.</p>
<h4>802.11ac — Wi-Fi 5 (2013)</h4>
<p>Standard działający wyłącznie w paśmie <strong>5 GHz</strong>, wprowadzający:</p>
<ul>
<li>kanały <strong>80 i 160 MHz</strong>,</li>
<li>modulację <strong>256-QAM</strong>,</li>
<li>do <strong>8 strumieni</strong> przestrzennych,</li>
<li><strong>MU-MIMO</strong> w kierunku w dół (Wave 2), pozwalające AP nadawać równocześnie do kilku klientów,</li>
<li>jawny <strong>beamforming</strong> ze standardowym mechanizmem sondowania kanału.</li>
</ul>
<h4>802.11ax — Wi-Fi 6 / 6E (2021)</h4>
<p>Projektowany z myślą o <strong>efektywności w gęstych środowiskach</strong> (biura, lotniska, stadiony), a nie tylko o maksymalnej prędkości. Najważniejsze cechy:</p>
<ul>
<li><strong>OFDMA</strong> — podział kanału na mniejsze bloki zasobów (RU: 26, 52, 106, 242, 484, 996 podnośnych), które AP przydziela różnym klientom w tej samej transmisji; zmniejsza narzut przy krótkich ramkach (VoIP, IoT);</li>
<li><strong>MU-MIMO w obu kierunkach</strong> (UL i DL);</li>
<li><strong>1024-QAM</strong>;</li>
<li><strong>dłuższy symbol OFDM</strong> (12,8 µs zamiast 3,2 µs) i podnośne 4-krotnie węższe (78,125 kHz), z GI 0,8 / 1,6 / 3,2 µs — większa odporność na propagację wielodrogową, szczególnie na zewnątrz;</li>
<li><strong>BSS Coloring</strong> — znacznik komórki w nagłówku PHY, dzięki któremu stacje mogą rozpoznać ramki z sąsiedniej sieci i ponownie użyć kanału (spatial reuse);</li>
<li><strong>TWT (Target Wake Time)</strong> — umowa między AP a klientem o godzinach budzenia się, oszczędzająca baterię urządzeń IoT i mobilnych;</li>
<li><strong>Wi-Fi 6E</strong> — rozszerzenie na pasmo <strong>6 GHz</strong>, oferujące dziesiątki nowych, czystych kanałów bez urządzeń starszych generacji (w UE: 5945–6425 MHz).</li>
</ul>
<h4>802.11be — Wi-Fi 7 (zatwierdzony w 2024, opublikowany w 2025)</h4>
<p>Standard „Extremely High Throughput (EHT)\". Kluczowe cechy:</p>
<ul>
<li>kanały do <strong>320 MHz</strong> (tylko w paśmie 6 GHz),</li>
<li>modulacja <strong>4096-QAM</strong>,</li>
<li><strong>MLO (Multi-Link Operation)</strong> — jedno urządzenie może jednocześnie korzystać z kilku pasm (np. 5 i 6 GHz), agregując przepustowość lub wybierając najlepszy link dla niskiego opóźnienia i niezawodności,</li>
<li><strong>Multi-RU</strong> i <strong>preamble puncturing</strong> — przydział wielu bloków zasobów jednej stacji oraz „wycinanie\" zajętych fragmentów szerokiego kanału (np. przy obecności radarów lub sąsiednich sieci) zamiast rezygnacji z całego kanału,</li>
<li>do <strong>16 strumieni</strong> przestrzennych (w praktyce urządzenia mają 2–4),</li>
<li>dopracowane mechanizmy dla ruchu wrażliwego na opóźnienia (m.in. restricted TWT).</li>
</ul>
<p>Certyfikacja <strong>Wi-Fi CERTIFIED 7</strong> rozpoczęła się w styczniu 2024 r. i produkty na rynku pojawiły się jeszcze przed formalną publikacją standardu.</p>
<h4>Wi-Fi 8 (802.11bn) i kierunki rozwoju</h4>
<p>Grupa robocza IEEE pracuje nad poprawką <strong>802.11bn — Ultra High Reliability (UHR)</strong>, określaną jako Wi-Fi 8. Jej celem nie jest przede wszystkim wzrost szczytowej przepływności, ale <strong>niezawodność, mniejsze opóźnienia i lepsza efektywność</strong> w trudnych warunkach (m.in. koordynacja między punktami dostępowymi, redukcja utraty ramek). Prace są w toku, a zatwierdzenie oczekiwane jest w perspektywie kilku lat; równolegle rozważane są kolejne kierunki (m.in. komunikacja o ultraniskim poborze energii i współpraca z zadaniami edge AI). Szczegółowe daty warto sprawdzać w publicznych materiałach grupy 802.11, ponieważ harmonogram bywa aktualizowany.</p>
<h4>Inne ważne poprawki</h4>
<table>
<thead>
<tr>
<th>Poprawka</th>
<th>Zakres</th>
</tr>
</thead>
<tbody>
<tr>
<td>802.11e</td>
<td>QoS w warstwie MAC (EDCA, HCCA); podstawa certyfikacji WMM</td>
</tr>
<tr>
<td>802.11h</td>
<td>DFS i TPC — zgodność z europejskimi wymogami w paśmie 5 GHz</td>
</tr>
<tr>
<td>802.11i</td>
<td>bezpieczeństwo (WPA2, CCMP, 802.1X)</td>
</tr>
<tr>
<td>802.11k / v / r</td>
<td>zarządzanie radiem, sterowanie roamingiem, szybkie przełączanie między AP (Fast BSS Transition)</td>
</tr>
<tr>
<td>802.11s</td>
<td>sieci kratowe (mesh)</td>
</tr>
<tr>
<td>802.11w</td>
<td>ochrona ramek zarządzających (PMF)</td>
</tr>
<tr>
<td>802.11ad / ay</td>
<td>pasmo <strong>60 GHz</strong> (WiGig): kanały 2,16 GHz, przepływności od kilku do kilkudziesięciu Gb/s, zasięg ograniczony do pomieszczenia</td>
</tr>
<tr>
<td>802.11ah</td>
<td><strong>Wi-Fi HaLow</strong>, pasma poniżej 1 GHz (868 MHz w UE), zasięg do ok. 1 km, IoT o niskiej przepływności i niskim poborze energii</td>
</tr>
<tr>
<td>802.11p</td>
<td>komunikacja pojazdów (V2X)</td>
</tr>
</tbody>
</table>
<h3>5.5. Kanały radiowe</h3>
<h4>Pasmo 2,4 GHz</h4>
<p>W Europie dostępnych jest <strong>13 kanałów</strong> o numerach 1–13, których środki rozmieszczone są co <strong>5 MHz</strong> według wzoru:</p>
<div data-m=\"f_{\\text{środ}}(n) = 2412 + 5\\,(n-1)\\ \\text{[MHz]}, \\qquad n = 1,\\dots,13\"></div>
<p>Ponieważ szerokość kanału wynosi 20 MHz (22 MHz w DSSS/CCK), a odstęp środków tylko 5 MHz, kanały <strong>silnie się nakładają</strong>. Kanały nienakładające się to praktycznie <strong>1, 6 i 11</strong> (w Europie bywa też używany zestaw 1, 5, 9, 13 kosztem lekkiego zachodzenia). Zakłócenie z sąsiedniego, częściowo nakładającego się kanału jest gorsze niż współdzielenie tego samego kanału, ponieważ stacje nie potrafią zdekodować cudzych nagłówków, więc nie koordynują dostępu do medium (patrz 5.7); dlatego zaleca się albo używanie tego samego kanału, albo kanałów rozdzielonych.</p>
<p><img alt=\"Kanały Wi-Fi w paśmie 2,4 GHz — 13 kanałów po 20 MHz; nienakładające się: 1, 6 i 11\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/wifi-kanaly-2-4ghz.svg\" /></p>
<p>Szerokość 40 MHz w paśmie 2,4 GHz praktycznie nie ma sensu w zatłoczonym środowisku, bo zajmuje niemal połowę pasma i zwiększa interferencję. Dodatkowo pasmo jest współdzielone z Bluetooth, kuchenkami mikrofalowymi, bezprzewodowymi kamerami i innymi urządzeniami.</p>
<h4>Pasmo 5 GHz</h4>
<p>W paśmie 5 GHz numeracja kanałów jest ustalona co 5 MHz od częstotliwości 5000 MHz (<span data-m=\"f = 5000 + 5n\"></span> MHz), lecz standardowo używa się kanałów rozłożonych co 4 numery (20 MHz). W Europie dostępne są m.in.:</p>
<ul>
<li><strong>kanały 36–64</strong> (5180–5320 MHz), w tym część wymagająca <strong>DFS</strong> i <strong>TPC</strong> (52–64);</li>
<li><strong>kanały 100–140</strong> (5500–5700 MHz), wymagające DFS;</li>
<li>w części krajów także kanały górne (np. 149–165, w zakresie SRD 5725–5875 MHz).</li>
</ul>
<p><strong>DFS (Dynamic Frequency Selection)</strong> wymaga, aby urządzenie przed rozpoczęciem pracy na kanale (zwykle przez 60 s, a w niektórych kanałach nawet 10 min) nasłuchiwało obecności radarów (meteorologicznych, wojskowych), a po wykryciu radaru natychmiast opuściło kanał. Może to powodować krótkie przerwy w pracy sieci. Szersze kanały (40, 80, 160 MHz) powstają przez łączenie sąsiednich kanałów 20 MHz; kanałów 160 MHz mieści się w paśmie 5 GHz zaledwie kilka, więc w gęstej zabudowie ich użycie prowadzi do interferencji.</p>
<h4>Pasmo 6 GHz</h4>
<p>W UE dla Wi-Fi udostępniono zakres <strong>5945–6425 MHz</strong> (480 MHz), co pozwala na 24 kanały 20 MHz, 12 kanałów 40 MHz, 6 kanałów 80 MHz, 3 kanały 160 MHz i 1 kanał 320 MHz (w USA i niektórych innych krajach dostępne jest 1200 MHz: 5925–7125 MHz). Pasmo jest czyste, ponieważ mogą w nim pracować wyłącznie urządzenia Wi-Fi 6E/7. Ma też zasady, jak <strong>AFC</strong> (Automated Frequency Coordination) dla urządzeń o standardowej mocy w USA oraz ograniczenie do zastosowań wewnątrz budynków dla urządzeń o niskiej mocy. Krótszy zasięg (wyższa częstotliwość) i silniejsze tłumienie przez ściany to cena za czystość widma.</p>
<h3>5.6. Jak oblicza się przepływność fizyczną</h3>
<p>Przepływność PHY wynika ze wzoru:</p>
<div data-m=\"R = \\frac{N_{SD} \\cdot N_{BPSCS} \\cdot R_c \\cdot N_{SS}}{T_{\\text{sym}}}\"></div>
<p>gdzie:</p>
<ul>
<li><span data-m=\"N_{SD}\"></span> — liczba <strong>podnośnych danych</strong> w kanale,</li>
<li><span data-m=\"N_{BPSCS}\"></span> — liczba bitów na podnośną i symbol (z modulacji: 6 dla 64-QAM, 8 dla 256-QAM, 10 dla 1024-QAM, 12 dla 4096-QAM),</li>
<li><span data-m=\"R_c\"></span> — szybkość kodowania korekcyjnego (np. 3/4, 5/6),</li>
<li><span data-m=\"N_{SS}\"></span> — liczba strumieni przestrzennych,</li>
<li><span data-m=\"T_{\\text{sym}}\"></span> — czas trwania symbolu OFDM wraz z przedziałem ochronnym.</li>
</ul>
<p>Liczba podnośnych danych w zależności od standardu i szerokości kanału:</p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>20 MHz</th>
<th>40 MHz</th>
<th>80 MHz</th>
<th>160 MHz</th>
<th>320 MHz</th>
<th>Symbol (bez GI)</th>
</tr>
</thead>
<tbody>
<tr>
<td>802.11a/g</td>
<td>48</td>
<td>—</td>
<td>—</td>
<td>—</td>
<td>—</td>
<td>3,2 µs (+ GI 0,8)</td>
</tr>
<tr>
<td>802.11n</td>
<td>52</td>
<td>108</td>
<td>—</td>
<td>—</td>
<td>—</td>
<td>3,2 µs (+ GI 0,8 / 0,4)</td>
</tr>
<tr>
<td>802.11ac</td>
<td>52</td>
<td>108</td>
<td>234</td>
<td>468</td>
<td>—</td>
<td>3,2 µs (+ GI 0,8 / 0,4)</td>
</tr>
<tr>
<td>802.11ax</td>
<td>234</td>
<td>468</td>
<td>980</td>
<td>1960</td>
<td>—</td>
<td>12,8 µs (+ GI 0,8 / 1,6 / 3,2)</td>
</tr>
<tr>
<td>802.11be</td>
<td>234</td>
<td>468</td>
<td>980</td>
<td>1960</td>
<td>3920</td>
<td>12,8 µs (+ GI 0,8 / 1,6 / 3,2)</td>
</tr>
</tbody>
</table>
<p><strong>Przykład 1 — 802.11n.</strong> Kanał 40 MHz, 64-QAM, <span data-m=\"R_c = 5/6\"></span>, jeden strumień, krótki GI (symbol 3,6 µs):</p>
<div data-m=\"R = \\frac{108 \\cdot 6 \\cdot \\tfrac{5}{6} \\cdot 1}{3{,}6\\ \\mu\\text{s}} = \\frac{540}{3{,}6\\ \\mu\\text{s}} = 150 \\text{ Mb/s}\"></div>
<p>Dla czterech strumieni: 600 Mb/s.</p>
<p><strong>Przykład 2 — 802.11ac.</strong> Kanał 80 MHz, 256-QAM, <span data-m=\"R_c = 5/6\"></span>, jeden strumień, krótki GI:</p>
<div data-m=\"R = \\frac{234 \\cdot 8 \\cdot \\tfrac{5}{6}}{3{,}6\\ \\mu\\text{s}} = \\frac{1560}{3{,}6\\ \\mu\\text{s}} \\approx 433{,}3 \\text{ Mb/s}\"></div>
<p>Typowy laptop 2×2 osiąga więc 866,7 Mb/s (80 MHz), a przy kanale 160 MHz — 1733 Mb/s.</p>
<p><strong>Przykład 3 — 802.11ax.</strong> Kanał 80 MHz, 1024-QAM, <span data-m=\"R_c = 5/6\"></span>, jeden strumień, GI 0,8 µs (symbol 13,6 µs):</p>
<div data-m=\"R = \\frac{980 \\cdot 10 \\cdot \\tfrac{5}{6}}{13{,}6\\ \\mu\\text{s}} \\approx \\frac{8166{,}7}{13{,}6\\ \\mu\\text{s}} \\approx 600{,}5 \\text{ Mb/s}\"></div>
<p><strong>Przykład 4 — 802.11be.</strong> Kanał 320 MHz, 4096-QAM, <span data-m=\"R_c = 5/6\"></span>, GI 0,8 µs: jeden strumień to <span data-m=\"3920 \\cdot 12 \\cdot \\tfrac{5}{6} / 13{,}6\\ \\mu\\text{s} \\approx 2882\"></span> Mb/s. Typowy klient 2×2 osiąga więc ok. 5,8 Gb/s, a hipotetyczne 16 strumieni — 46,1 Gb/s.</p>
<p>Warto zauważyć, że wzrost liczby bitów na symbol (1024-QAM w porównaniu z 256-QAM) daje w 802.11ax jedynie ok. 25 % zysku. Główne korzyści Wi-Fi 6 wynikają z efektywności (OFDMA, spatial reuse), nie z surowej prędkości.</p>
<h3>5.7. Warstwa MAC: dostęp do medium CSMA/CA</h3>
<h4>Dlaczego nie CSMA/CD?</h4>
<p>W Ethernecie stacja nasłuchuje medium podczas nadawania i wykrywa kolizje (<strong>CSMA/CD</strong>). W sieci bezprzewodowej jest to niemożliwe z dwóch powodów:</p>
<ol>
<li><strong>Półdupleks radia i różnica poziomów mocy</strong> — sygnał własnego nadajnika jest na wejściu odbiornika o wiele rzędów wielkości silniejszy niż sygnał zdalny (ok. 100 dB), więc nadajnik „zagłusza\" własny odbiornik. Stacja nie może zatem wykrywać kolizji w trakcie nadawania.</li>
<li><strong>Problem ukrytej stacji (hidden node)</strong> — dwie stacje A i C mogą znajdować się w zasięgu punktu dostępowego B, ale poza zasięgiem siebie nawzajem. Nie słyszą się, więc obie uznają medium za wolne i nadają jednocześnie, powodując kolizję u odbiorcy B, o której żadna z nich nie wie. Występuje także <strong>problem odsłoniętej stacji (exposed node)</strong>, w którym stacja niepotrzebnie wstrzymuje nadawanie, choć jej transmisja nie zakłóciłaby odbioru.</li>
</ol>
<p>Dlatego Wi-Fi stosuje <strong>CSMA/CA (Collision Avoidance)</strong> — unikanie kolizji, a nie ich wykrywanie. Wszystkie transmisje jednostkowe wymagają <strong>potwierdzenia (ACK)</strong>, a jego brak oznacza, że ramka mogła ulec zakłóceniu i należy ją retransmitować.</p>
<h4>DCF — Distributed Coordination Function</h4>
<p>Podstawowy mechanizm dostępu, działający w sposób rozproszony (bez centralnego arbitra):</p>
<ol>
<li>Stacja z gotową ramką <strong>nasłuchuje medium</strong> (fizycznie: odczyt mocy/wykrycie nośnej; wirtualnie: sprawdzenie licznika NAV).</li>
<li>Jeśli medium jest wolne co najmniej przez czas <strong>DIFS</strong>, stacja może nadawać od razu (przy pierwszej próbie).</li>
<li>Jeśli medium jest zajęte, stacja czeka na jego zwolnienie, następnie odczekuje <strong>DIFS</strong> i losuje <strong>licznik backoff</strong> z przedziału <span data-m=\"[0, CW]\"></span>, gdzie <span data-m=\"CW\"></span> (contention window) to okno rywalizacji.</li>
<li>Licznik zmniejsza się o 1 w każdym wolnym slocie czasowym i <strong>zamraża się</strong>, gdy medium staje się zajęte (stacja wznawia odliczanie po ponownym odczekaniu DIFS).</li>
<li>Gdy licznik osiągnie 0, stacja nadaje ramkę.</li>
<li>Odbiorca po poprawnym odebraniu (weryfikacja FCS) odczekuje krótki czas <strong>SIFS</strong> i wysyła <strong>ACK</strong>.</li>
<li>Jeśli ACK nie nadejdzie w oczekiwanym czasie, stacja uznaje kolizję lub zakłócenie, <strong>podwaja okno rywalizacji</strong> (binary exponential backoff): <span data-m=\"CW \\leftarrow 2\\,(CW+1) - 1\"></span> do wartości maksymalnej <span data-m=\"CW_{max}\"></span>, i ponawia próbę (do limitu retransmisji; typowo 7 dla krótkich ramek).</li>
</ol>
<p>Losowy backoff zapobiega temu, że po zwolnieniu się medium wszystkie oczekujące stacje ruszą jednocześnie.</p>
<p><img alt=\"Sekwencja dostępu do medium CSMA/CA: DIFS, backoff, ramka danych, SIFS i ACK oraz zachowanie stacji odczuwającej NAV\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/csma-ca-sekwencja.svg\" /></p>
<p><strong>Odstępy czasowe (przykładowe wartości):</strong></p>
<table>
<thead>
<tr>
<th>Parametr</th>
<th>Znaczenie</th>
<th>802.11a/n/ac/ax (5 GHz)</th>
<th>802.11g/n (2,4 GHz, OFDM)</th>
<th>802.11b</th>
</tr>
</thead>
<tbody>
<tr>
<td>Slot</td>
<td>podstawowa jednostka backoff</td>
<td>9 µs</td>
<td>9 µs (krótki) / 20 µs</td>
<td>20 µs</td>
</tr>
<tr>
<td>SIFS</td>
<td>odstęp krótki (przed ACK, CTS)</td>
<td>16 µs</td>
<td>10 µs</td>
<td>10 µs</td>
</tr>
<tr>
<td>DIFS</td>
<td><span data-m=\"\\text{SIFS} + 2 \\cdot \\text{slot}\"></span></td>
<td>34 µs</td>
<td>28 µs / 50 µs</td>
<td>50 µs</td>
</tr>
<tr>
<td><span data-m=\"CW_{min}\"></span> / <span data-m=\"CW_{max}\"></span></td>
<td>okno rywalizacji</td>
<td>15 / 1023</td>
<td>15 / 1023</td>
<td>31 / 1023</td>
</tr>
</tbody>
</table>
<p>Zasada priorytetu wynika z zależności <strong>SIFS &lt; DIFS</strong>: ACK i inne ramki odpowiedzi są wysyłane po najkrótszym odstępie, więc żadna stacja rywalizująca o medium (czekająca DIFS + backoff) nie wtrąci się w trakcie wymiany.</p>
<h4>Wirtualne wykrywanie nośnej i NAV</h4>
<p>Każda ramka zawiera w nagłówku pole <strong>Duration</strong>, informujące, jak długo (w mikrosekundach) medium zostanie zajęte przez bieżącą wymianę (ramka + SIFS + ACK). Stacje, które słyszą tę ramkę, ustawiają swój licznik <strong>NAV (Network Allocation Vector)</strong> i przez ten czas <strong>nie nadają</strong>, nawet jeśli fizycznie medium wygląda na wolne. To „wirtualne\" wykrywanie nośnej.</p>
<h4>RTS/CTS</h4>
<p>Aby rozwiązać problem ukrytej stacji, stosuje się opcjonalną wymianę <strong>RTS/CTS</strong>:</p>
<ol>
<li>Nadawca wysyła krótką ramkę <strong>RTS (Request To Send)</strong>.</li>
<li>Odbiorca (AP), jeśli medium jest wolne, odpowiada ramką <strong>CTS (Clear To Send)</strong>.</li>
<li>Stacje słyszące CTS (także te ukryte przed nadawcą) ustawiają NAV i wstrzymują transmisję.</li>
<li>Nadawca wysyła właściwą ramkę danych, a odbiorca — ACK.</li>
</ol>
<p>RTS/CTS dodaje narzut, więc jest włączany tylko dla <strong>dużych ramek</strong> powyżej ustalonego progu (<em>RTS threshold</em>) lub w środowiskach z dużą liczbą kolizji.</p>
<h4>QoS: EDCA i WMM</h4>
<p>Standard <strong>802.11e</strong> wprowadził <strong>EDCA (Enhanced Distributed Channel Access)</strong>, w którym ruch jest dzielony na cztery <strong>kategorie dostępu</strong> (AC): <strong>Voice (AC_VO)</strong>, <strong>Video (AC_VI)</strong>, <strong>Best Effort (AC_BE)</strong> i <strong>Background (AC_BK)</strong>. Każda kategoria ma własne parametry: krótszy odstęp arbitrażowy <strong>AIFS</strong>, mniejsze <span data-m=\"CW_{min}/CW_{max}\"></span> i limit czasu transmisji <strong>TXOP</strong>. W efekcie ramki głosowe zyskują statystycznie pierwszeństwo dostępu. Certyfikat Wi-Fi dla tej funkcji nazywa się <strong>WMM (Wi-Fi Multimedia)</strong>.</p>
<h3>5.8. Format ramki 802.11</h3>
<p>Ramka 802.11 jest bardziej złożona niż ramka Ethernet, ponieważ musi obsłużyć adresowanie w środowisku z punktami dostępowymi i zapewniać mechanizmy sterujące.</p>
<table>
<thead>
<tr>
<th>Pole</th>
<th>Rozmiar</th>
<th>Opis</th>
</tr>
</thead>
<tbody>
<tr>
<td>Frame Control</td>
<td>2 B</td>
<td>wersja protokołu, typ i podtyp ramki, flagi (To DS, From DS, More Fragments, Retry, Power Management, More Data, Protected Frame, Order)</td>
</tr>
<tr>
<td>Duration / ID</td>
<td>2 B</td>
<td>czas zajętości medium (NAV) lub identyfikator skojarzenia (w ramkach PS-Poll)</td>
</tr>
<tr>
<td>Address 1</td>
<td>6 B</td>
<td>adres odbiorcy (RA)</td>
</tr>
<tr>
<td>Address 2</td>
<td>6 B</td>
<td>adres nadawcy (TA)</td>
</tr>
<tr>
<td>Address 3</td>
<td>6 B</td>
<td>zależny od trybu: BSSID lub adres źródłowy/docelowy</td>
</tr>
<tr>
<td>Sequence Control</td>
<td>2 B</td>
<td>numer sekwencji i numer fragmentu (wykrywanie duplikatów)</td>
</tr>
<tr>
<td>Address 4</td>
<td>6 B</td>
<td>tylko w ramkach między AP (WDS/mesh)</td>
</tr>
<tr>
<td>QoS Control</td>
<td>2 B</td>
<td>kategoria ruchu, polityka ACK (w ramkach QoS Data)</td>
</tr>
<tr>
<td>HT/VHT/HE Control</td>
<td>4 B</td>
<td>informacje sterujące (opcjonalne)</td>
</tr>
<tr>
<td>Frame Body</td>
<td>0–2304 B klasycznie (do ok. 7,9 kB z A-MSDU)</td>
<td>dane (enkapsulowany pakiet LLC/SNAP + IP), przy agregacji A-MPDU cała transmisja do kilku MB</td>
</tr>
<tr>
<td>FCS</td>
<td>4 B</td>
<td>CRC-32</td>
</tr>
</tbody>
</table>
<p>Inaczej niż w Ethernecie ramka 802.11 może zawierać <strong>trzy lub cztery adresy</strong>, a ich znaczenie zależy od flag <strong>To DS</strong> i <strong>From DS</strong>:</p>
<table>
<thead>
<tr>
<th>To DS</th>
<th>From DS</th>
<th>Scenariusz</th>
<th>Address 1</th>
<th>Address 2</th>
<th>Address 3</th>
<th>Address 4</th>
</tr>
</thead>
<tbody>
<tr>
<td>0</td>
<td>0</td>
<td>stacje w sieci ad hoc (IBSS)</td>
<td>odbiorca (DA)</td>
<td>nadawca (SA)</td>
<td>BSSID</td>
<td>—</td>
</tr>
<tr>
<td>0</td>
<td>1</td>
<td>AP → stacja</td>
<td>odbiorca (DA)</td>
<td>BSSID (AP)</td>
<td>nadawca (SA)</td>
<td>—</td>
</tr>
<tr>
<td>1</td>
<td>0</td>
<td>stacja → AP</td>
<td>BSSID (AP)</td>
<td>nadawca (SA)</td>
<td>odbiorca (DA)</td>
<td>—</td>
</tr>
<tr>
<td>1</td>
<td>1</td>
<td>AP → AP (most, mesh)</td>
<td>RA</td>
<td>TA</td>
<td>DA</td>
<td>SA</td>
</tr>
</tbody>
</table>
<p>Ramki dzielą się na trzy <strong>typy</strong>:</p>
<ul>
<li><strong>ramki zarządzające (management)</strong> — <strong>Beacon</strong> (rozgłaszany co ok. 102,4 ms, czyli 100 TU, zawiera SSID, obsługiwane prędkości, informacje o zabezpieczeniach i możliwościach), <strong>Probe Request/Response</strong>, <strong>Authentication</strong>, <strong>Association/Reassociation Request/Response</strong>, <strong>Deauthentication</strong>, <strong>Disassociation</strong>, <strong>Action</strong>;</li>
<li><strong>ramki sterujące (control)</strong> — <strong>RTS, CTS, ACK, Block ACK, PS-Poll</strong>;</li>
<li><strong>ramki danych (data)</strong> — dane użytkownika, w tym <strong>QoS Data</strong> i <strong>Null</strong> (sygnalizacja trybu oszczędzania energii).</li>
</ul>
<p>Pole <strong>FCS</strong> stanowi taką samą sumę CRC-32 jak w Ethernecie; ramka z błędnym FCS jest odrzucana i w Wi-Fi skutkuje brakiem ACK, a więc retransmisją.</p>
<h3>5.9. Dołączanie stacji do sieci</h3>
<p>Klient przechodzi kilka stanów, zanim będzie mógł przesyłać dane:</p>
<ol>
<li><strong>Skanowanie (scanning)</strong> — stacja poszukuje sieci. <strong>Pasywne</strong>: nasłuchuje ramek Beacon na kolejnych kanałach. <strong>Aktywne</strong>: wysyła <strong>Probe Request</strong> i czeka na <strong>Probe Response</strong> od punktów dostępowych.</li>
<li><strong>Uwierzytelnianie (authentication)</strong> — w trybie Open System wymiana sprowadza się do formalności (dwie ramki); w WPA3-SAE zawiera już wymianę kryptograficzną.</li>
<li><strong>Skojarzenie (association)</strong> — klient wysyła <strong>Association Request</strong> z informacjami o swoich możliwościach (obsługiwane prędkości, standardy), a AP odpowiada <strong>Association Response</strong> z identyfikatorem AID.</li>
<li><strong>Uwierzytelnianie dostępu i uzgodnienie kluczy</strong> — w sieciach z WPA2/WPA3: <strong>4-way handshake</strong> (uzgodnienie kluczy szyfrujących) lub w trybie Enterprise wcześniej wymiana <strong>802.1X/EAP</strong> z serwerem RADIUS.</li>
<li>Po przyznaniu adresu IP (<strong>DHCP</strong>) rozpoczyna się właściwa komunikacja.</li>
</ol>
<h3>5.10. Bezpieczeństwo sieci Wi-Fi</h3>
<p>Ponieważ medium radiowe jest dostępne dla każdego w zasięgu, bezpieczeństwo musi być zapewnione kryptograficznie.</p>
<table>
<thead>
<tr>
<th>Protokół</th>
<th>Rok</th>
<th>Szyfrowanie / uwierzytelnianie</th>
<th>Ocena</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>WEP</strong></td>
<td>1997</td>
<td>RC4, 24-bitowy wektor IV, statyczny klucz 40/104 bity</td>
<td><strong>całkowicie złamany</strong> (od 2001 r.; klucz można odzyskać w minuty) — nie stosować</td>
</tr>
<tr>
<td><strong>WPA</strong></td>
<td>2003</td>
<td>TKIP (RC4 z dynamicznymi kluczami i kontrolą integralności MIC)</td>
<td>przestarzały, rozwiązanie przejściowe</td>
</tr>
<tr>
<td><strong>WPA2</strong></td>
<td>2004 (802.11i)</td>
<td><strong>AES-CCMP</strong>, klucz PSK (Personal) lub 802.1X (Enterprise)</td>
<td>dobre, ale podatne na atak słownikowy offline na słabe hasło i na atak KRACK (2017, łatany)</td>
</tr>
<tr>
<td><strong>WPA3</strong></td>
<td>2018</td>
<td><strong>SAE</strong> zamiast PSK (Personal), 192-bitowy zestaw kryptograficzny (Enterprise), <strong>OWE</strong> dla sieci otwartych, obowiązkowe PMF</td>
<td>zalecany; odporność na atak słownikowy offline, poufność wsteczna (forward secrecy)</td>
</tr>
</tbody>
</table>
<p>Ważne zasady praktyczne:</p>
<ul>
<li>stosować <strong>WPA3</strong> lub co najmniej <strong>WPA2-AES</strong> (w trybie mieszanym WPA2/WPA3 dla zgodności ze starszymi klientami), <strong>nigdy</strong> WEP ani TKIP;</li>
<li>używać długich, unikalnych haseł (Personal) lub <strong>802.1X/EAP</strong> z certyfikatami w środowiskach firmowych;</li>
<li>wyłączyć <strong>WPS</strong> z kodem PIN (znane podatności);</li>
<li>stosować <strong>izolację gości</strong> (osobny VLAN i SSID) oraz aktualizować oprogramowanie sprzętowe punktów dostępowych;</li>
<li>ukrywanie SSID <strong>nie jest</strong> zabezpieczeniem (nazwa jest ujawniana w ramkach przy połączeniu).</li>
</ul>
<p><strong>PMF (Protected Management Frames, 802.11w)</strong> chroni ramki zarządzające (np. deauthentication) przed fałszowaniem, co uniemożliwia proste ataki „wyrzucania\" klientów z sieci.</p>
<h3>5.11. Roaming i zarządzanie siecią WLAN</h3>
<p>W sieci ESS z wieloma punktami dostępowymi klient sam decyduje, kiedy przełączyć się na inny AP (standard nie narzuca algorytmu), co prowadzi do problemu <strong>„lepkich klientów\" (sticky clients)</strong> — urządzeń trzymających się słabego AP mimo obecności lepszego. Rozwiązania:</p>
<ul>
<li><strong>802.11k</strong> — AP przekazuje klientowi listę sąsiednich punktów dostępowych, skracając skanowanie;</li>
<li><strong>802.11v</strong> — AP może zasugerować klientowi przeniesienie się do innego AP (BSS Transition Management);</li>
<li><strong>802.11r (Fast BSS Transition)</strong> — uzgodnienie kluczy z następnym AP jeszcze przed przełączeniem, co skraca przerwę do kilkudziesięciu milisekund (istotne dla VoIP).</li>
</ul>
<p>W większych instalacjach stosuje się <strong>kontrolery WLAN</strong> (lokalne lub chmurowe), które centralnie zarządzają konfiguracją, doborem kanałów i mocy oraz roamingiem punktów dostępowych.</p>
<h3>5.12. Planowanie i diagnostyka sieci Wi-Fi</h3>
<p>Podstawowe zasady projektowania:</p>
<ul>
<li><strong>Sygnał i SNR.</strong> Orientacyjne progi: sygnał (RSSI) około <strong>−67 dBm</strong> lub lepszy dla aplikacji czasu rzeczywistego (VoIP, wideo), około −70 dBm dla przeciętnych zastosowań; SNR co najmniej 25 dB dla wysokich prędkości.</li>
<li><strong>Pokrycie i zakładki komórek.</strong> Sąsiednie komórki powinny nakładać się na ok. 15–20 % powierzchni, aby umożliwić roaming, ale nie tyle, by wprowadzać interferencję współkanałową.</li>
<li><strong>Interferencja współkanałowa (CCI)</strong> — punkty dostępowe na tym samym kanale współdzielą czas antenowy (medium), więc kolejne AP na tym samym kanale w zasięgu słyszalności <strong>nie zwiększają</strong> pojemności. Planując kanały, dąży się do ich powtarzania dopiero z odległości poza zasięgiem słyszalności.</li>
<li><strong>Interferencja kanałów sąsiednich (ACI)</strong> — jak wyżej, częściowo nakładające się kanały są gorsze niż identyczne.</li>
<li><strong>Moc nadawcza</strong> — większa moc AP nie poprawia sytuacji, jeśli urządzenia klienckie (o mniejszej mocy) nie potrafią odpowiedzieć; sieć jest ograniczana przez <strong>najsłabsze ogniwo</strong> — klienta. Zaleca się umiarkowaną moc i większą liczbę AP.</li>
<li><strong>Szerokość kanału.</strong> Szersze kanały zwiększają prędkość, ale zmniejszają liczbę dostępnych kanałów i obniżają czułość odbiornika (szum rośnie o 3 dB przy każdym podwojeniu szerokości). W gęstych instalacjach zwykle stosuje się kanały 20/40 MHz w 5 GHz.</li>
<li><strong>Pasma.</strong> Klientów o możliwościach dwupasmowych warto kierować do pasm 5/6 GHz (<strong>band steering</strong>), pozostawiając 2,4 GHz starszym i prostym urządzeniom IoT.</li>
</ul>
<p><strong>Narzędzia diagnostyczne:</strong> analizatory widma i sieci Wi-Fi (m.in. aplikacje w telefonach i laptopach), narzędzia typu site survey (mapy cieplne pokrycia), analizatory pakietów w trybie monitor (przechwytywanie ramek 802.11), a w systemach operacyjnych — wbudowane polecenia (np. <code>iw</code>, <code>iwconfig</code> w Linuksie).</p>
<h3>5.13. Zalety i wady Wi-Fi</h3>
<p><strong>Zalety:</strong> mobilność, brak konieczności okablowania, powszechność sprzętu i niski koszt, zgodność wsteczna, szybki rozwój (kolejne generacje co kilka lat), wsparcie w niemal każdym urządzeniu końcowym.</p>
<p><strong>Wady:</strong> współdzielone i zatłoczone medium (półdupleks, rywalizacja CSMA/CA), niższa i zmienna przepustowość oraz większe opóźnienia niż w kablu, podatność na zakłócenia, tłumienie przeszkód, konieczność zabezpieczenia kryptograficznego, ograniczenia regulacyjne (moc, DFS) i zależność wydajności od najsłabszego klienta w komórce.</p>
<hr />
<h2>6. Technologie dostępowe i sieci rozległe (WAN)</h2>
<h3>6.1. Sieć dostępowa — pojęcia podstawowe</h3>
<p><strong>Sieć dostępowa</strong> (ang. <em>access network</em>) łączy lokal abonenta (dom, firmę) z siecią operatora i dalej z Internetem. Odcinek ten nazywany jest <strong>ostatnią milą</strong> (<em>last mile</em>) — nie dlatego, że ma dokładnie jedną milę, lecz dlatego, że jest najkosztowniejszym i najtrudniejszym do modernizacji fragmentem infrastruktury: jest go najwięcej (jedno przyłącze na abonenta), a koszty rozkopania ulic i wejścia do budynków są ogromne.</p>
<p>Podstawowe elementy:</p>
<ul>
<li><strong>CPE (Customer Premises Equipment)</strong> — urządzenie po stronie abonenta (modem, router, terminal światłowodowy ONT);</li>
<li><strong>Punkt demarkacyjny (demarc)</strong> — granica odpowiedzialności między siecią operatora a instalacją abonenta;</li>
<li><strong>Pętla lokalna (local loop)</strong> — łącze między abonentem a najbliższym węzłem operatora;</li>
<li><strong>CO (Central Office)</strong> lub <strong>POP (Point of Presence)</strong> — węzeł operatora, w którym kończą się łącza abonenckie (centrala telefoniczna, węzeł kablowy, węzeł światłowodowy);</li>
<li><strong>Sieć szkieletowa (backbone/core)</strong> — szybka sieć łącząca węzły operatora.</li>
</ul>
<p>Technologie dostępowe można klasyfikować według medium: <strong>miedź</strong> (telefoniczna: dial-up, ISDN, DSL; koncentryczna: sieci kablowe), <strong>światłowód</strong> (FTTx, PON), <strong>radio</strong> (sieci komórkowe, FWA, WISP, satelita).</p>
<h3>6.2. Modemy — czym są i jakie mają odmiany</h3>
<p><strong>Modem</strong> (skrót od <em>modulator–demodulator</em>) to urządzenie zamieniające dane cyfrowe na sygnał dostosowany do właściwości danego medium (modulacja) oraz odtwarzające dane z odebranego sygnału (demodulacja). Nazwa pochodzi z czasów, gdy medium było analogowe (linia telefoniczna), lecz dziś oznacza dowolne urządzenie dopasowujące komputer do konkretnej technologii dostępowej:</p>
<ul>
<li><strong>modem analogowy</strong> (dial-up) — na linii telefonicznej w paśmie głosowym;</li>
<li><strong>modem DSL</strong> — na łączu miedzianym, wykorzystujący pasmo powyżej głosu;</li>
<li><strong>modem kablowy (cable modem)</strong> — w sieci telewizji kablowej, standard DOCSIS;</li>
<li><strong>terminal ONT/ONU</strong> — zakończenie światłowodu (formalnie nie „modulator\", ale pełni analogiczną rolę, zamieniając sygnał optyczny na Ethernet);</li>
<li><strong>modem komórkowy</strong> (LTE/5G) — jako moduł w telefonie lub router z kartą SIM;</li>
<li><strong>modem satelitarny</strong> — obsługujący łączność z terminalem satelitarnym.</li>
</ul>
<p>W praktyce urządzenia w domach są zazwyczaj <strong>bramami (gateway)</strong>, łączącymi funkcje modemu, routera z NAT, przełącznika Ethernet, punktu dostępowego Wi-Fi i serwera DHCP w jednej obudowie. Modem może pracować w <strong>trybie mostu (bridge)</strong>, w którym jedynie przekazuje ramki bez routowania — wtedy router (własny lub operatora) realizuje NAT i uwierzytelnianie.</p>
<h3>6.3. Dial-up i ISDN — historyczne technologie dostępowe</h3>
<p><strong>Modemy analogowe (dial-up).</strong> Sieć telefoniczna została zaprojektowana dla głosu w paśmie <strong>300–3400 Hz</strong> (ok. 3,1 kHz). Skoro pasmo jest tak wąskie, przepływność ograniczona jest twierdzeniem Shannona (przykład 1 w rozdziale 1.5: ok. 35 kb/s). Kolejne standardy modemów, wykorzystujące zaawansowane modulacje QAM i kodowanie kratowe, zbliżały się do tej granicy: <strong>V.34</strong> (do 33,6 kb/s, obie strony analogowe), a następnie <strong>V.90</strong> i <strong>V.92</strong>, które osiągały do 56 kb/s w kierunku „do abonenta\" dzięki temu, że po stronie dostawcy sygnał jest już cyfrowy (PCM, 64 kb/s na kanał) i nie występuje szum kwantowania w tej części toru. Dial-up zajmuje linię telefoniczną (brak rozmów podczas połączenia) i wymaga zestawiania połączenia komutowanego.</p>
<p><strong>ISDN (Integrated Services Digital Network).</strong> Cyfrowa sieć telefoniczna z usługą end-to-end w postaci cyfrowej:</p>
<ul>
<li><strong>BRI (Basic Rate Interface)</strong> — dostęp podstawowy <strong>2B+D</strong>: dwa kanały użytkowe <strong>B</strong> po 64 kb/s (razem 128 kb/s) i kanał sygnalizacyjny <strong>D</strong> 16 kb/s (razem 144 kb/s); dla użytkowników domowych i małych firm;</li>
<li><strong>PRI (Primary Rate Interface)</strong> — dostęp pierwotny: w Europie <strong>30B+D</strong> (łącze E1, 2,048 Mb/s), w Ameryce Północnej <strong>23B+D</strong> (łącze T1, 1,544 Mb/s); dla central firmowych.</li>
</ul>
<p>Dziś ISDN jest wypierany przez technologie IP i telefonię VoIP.</p>
<h3>6.4. DSL — cyfrowa linia abonencka</h3>
<h4>Idea</h4>
<p>Kabel telefoniczny (skrętka miedziana) doprowadzony do niemal każdego domu jest zdolny do przenoszenia sygnałów o częstotliwościach dużo wyższych niż pasmo głosowe (do ok. 4 kHz wykorzystywane w telefonii). Technologie <strong>DSL (Digital Subscriber Line)</strong> wykorzystują <strong>wyższe częstotliwości</strong> tej samej pary przewodów do przesyłania danych, <strong>równolegle</strong> z klasyczną usługą telefoniczną (POTS), bez zajmowania linii. Rodzina technologii zbiorczo oznaczana jest <strong>xDSL</strong>.</p>
<p><img alt=\"Architektura dostępu DSL: lokal abonenta z modemem i splitterem, pętla lokalna, DSLAM i BNG w centrali oraz podział pasma ADSL\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/dsl-architektura.svg\" /></p>
<h4>Elementy architektury</h4>
<ul>
<li><strong>Modem/router DSL</strong> u abonenta.</li>
<li><strong>Splitter (rozdzielacz) lub mikrofiltr</strong> — prosty filtr pasywny (dolnoprzepustowy dla telefonu, górnoprzepustowy dla modemu), który rozdziela sygnał głosowy i dane. Mikrofiltry dołączane są do każdego telefonu w instalacji abonenta, aby sygnał DSL nie powodował trzasków, a sygnał telefonii nie zakłócał modemu.</li>
<li><strong>Pętla lokalna</strong> — istniejąca linia telefoniczna (skrętka miedziana, zwykle 0,4 lub 0,5 mm) o długości do kilku kilometrów.</li>
<li><strong>DSLAM (DSL Access Multiplexer)</strong> — urządzenie w centrali (lub w szafie ulicznej), zawierające wiele modemów DSL po stronie operatora; multipleksuje ruch od wielu abonentów w jedno łącze szybkie (dziś zazwyczaj Ethernet/światłowód).</li>
<li><strong>BNG/BRAS (Broadband Network Gateway / Broadband Remote Access Server)</strong> — urządzenie kończące sesje abonentów: uwierzytelnia je (zwykle przez <strong>RADIUS</strong>), przydziela adresy IP, nakłada limity i profile jakości usług.</li>
<li>Rozgałęźnik ruchu głosowego przekazuje sygnał telefoniczny do komutatora <strong>PSTN</strong>.</li>
</ul>
<h4>Modulacja DMT i podział pasma</h4>
<p>Większość systemów DSL (ADSL, VDSL) stosuje modulację <strong>DMT (Discrete Multi-Tone)</strong>, czyli odmianę OFDM dla linii miedzianej. Pasmo dzielone jest na wiele wąskich podkanałów (<strong>podnośnych, tonów</strong>), np. w ADSL o szerokości <strong>4,3125 kHz</strong> każdy. Zestaw tonów podlega <strong>adaptacyjnemu przydziałowi bitów (bit loading)</strong>: podczas synchronizacji (tzw. <em>training</em>) modem mierzy SNR każdego tonu i przydziela mu tyle bitów, ile ten ton może bezpiecznie przenieść (od 0 do 15 bitów w konstelacji QAM). Tony zakłócone (np. zawartością radiową AM lub silną interferencją) są po prostu wyłączane lub obciążane mniej.</p>
<p><em>Przykład.</em> W ADSL symbole DMT wysyłane są z częstotliwością 4000 na sekundę. Jeśli 200 tonów kierunku „w dół\" przenosi średnio 8 bitów, przepływność wynosi:</p>
<div data-m=\"R = 200 \\cdot 8 \\cdot 4000 = 6{,}4 \\text{ Mb/s}\"></div>
<p>W ADSL pasmo jest rozdzielone tak, że <strong>0–4 kHz</strong> to telefonia, <strong>ok. 25–138 kHz</strong> to kierunek „w górę\" (upstream, do sieci), a <strong>ok. 138 kHz – 1,1 MHz</strong> to kierunek „w dół\" (downstream, do abonenta). Ponieważ zasięg upstream i downstream jest nierówny, nazywa się to łączem <strong>asymetrycznym</strong> (ADSL — <em>Asymmetric</em>), co odpowiada typowemu wzorcowi użytkowania (więcej pobierania niż wysyłania).</p>
<h4>Wersje DSL</h4>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Standard ITU-T</th>
<th>Pasmo</th>
<th>Maks. w dół / w górę</th>
<th>Orientacyjny zasięg</th>
</tr>
</thead>
<tbody>
<tr>
<td>ADSL</td>
<td>G.992.1 (G.dmt), 1999</td>
<td>1,1 MHz</td>
<td>8 Mb/s / 1 Mb/s</td>
<td>do ok. 5 km</td>
</tr>
<tr>
<td>ADSL2</td>
<td>G.992.3, 2002</td>
<td>1,1 MHz</td>
<td>12 Mb/s / 1 Mb/s</td>
<td>do ok. 5 km</td>
</tr>
<tr>
<td>ADSL2+</td>
<td>G.992.5, 2003</td>
<td>2,2 MHz</td>
<td>24 Mb/s / 1–3,5 Mb/s</td>
<td>pełna prędkość do ok. 1,5 km, ok. 3 km — kilka Mb/s</td>
</tr>
<tr>
<td>VDSL</td>
<td>G.993.1, 2001</td>
<td>12 MHz</td>
<td>52 Mb/s / 16 Mb/s</td>
<td>do ok. 1,2 km</td>
</tr>
<tr>
<td>VDSL2</td>
<td>G.993.2, 2006</td>
<td>do 17,7 MHz (profil 17a) lub 30 MHz (30a)</td>
<td>do ok. 100 Mb/s (17a) lub 200 Mb/s (30a), także symetrycznie</td>
<td>do ok. 1 km (17a), do ok. 300 m (30a); dłuższe pętle — niższe prędkości</td>
</tr>
<tr>
<td>G.fast</td>
<td>G.9701, 2014</td>
<td>106 MHz lub 212 MHz</td>
<td>do ok. 1 Gb/s (suma obu kierunków, TDD)</td>
<td>ok. 100–250 m</td>
</tr>
<tr>
<td>SHDSL</td>
<td>G.991.2</td>
<td>pasmo symetryczne</td>
<td>do ok. 5,7 Mb/s na parę, symetrycznie</td>
<td>do kilku km</td>
</tr>
</tbody>
</table>
<p>Wartości zasięgu są <strong>orientacyjne</strong> i silnie zależą od jakości pętli. Kluczowe jest to, że tłumienie miedzi rośnie z częstotliwością i długością, więc <strong>im wyższe pasmo, tym krótszy zasięg</strong>. Dlatego rodzina DSL ewoluowała ku coraz krótszym pętlom: światłowód dochodzi do szafy ulicznej (<strong>FTTC/FTTN</strong>, ostatnie 100–500 m po miedzi z VDSL2) lub do budynku (<strong>FTTB</strong>, G.fast na instalacji wewnętrznej).</p>
<h4>Czynniki wpływające na prędkość DSL</h4>
<ul>
<li><strong>Długość i średnica pętli</strong> — im dłuższa i cieńsza, tym większe tłumienie;</li>
<li><strong>Tłumienie linii i margines SNR</strong> — modem zwykle utrzymuje docelowy zapas SNR (ok. 6 dB), poniżej którego przyjmuje niższą prędkość;</li>
<li><strong>Przesłuchy</strong> — zwłaszcza <strong>FEXT</strong> od sąsiednich par w tym samym kablu; w VDSL2 ograniczane technologią <strong>vectoring</strong> (G.993.5), która mierzy i kasuje przesłuchy między liniami (wymaga koordynacji wszystkich par w kablu pod kontrolą jednego operatora);</li>
<li><strong>Odczepy mostkowane i stare instalacje</strong>, niedopasowania impedancji, korozja;</li>
<li><strong>Interleaving i FEC</strong> — kodowanie korekcyjne Reeda–Solomona z przeplotem poprawia odporność na zakłócenia impulsowe kosztem dodatkowego opóźnienia.</li>
</ul>
<p>Rozróżnia się <strong>prędkość synchronizacji</strong> (sync rate, ustalona przez modemy) i <strong>przepustowość użyteczną</strong> — niższą z powodu narzutów enkapsulacji.</p>
<h4>Enkapsulacja danych w DSL</h4>
<p>Dane użytkownika przesyłane są przez DSL w kilku warstwach:</p>
<ul>
<li><strong>ATM</strong> (w klasycznym ADSL) — dane dzielone na <strong>komórki ATM</strong> o stałej długości 53 B (5 B nagłówka + 48 B danych), co powoduje tzw. „podatek komórkowy\" rzędu 10–15 %; w VDSL2 i nowszych stosuje się <strong>PTM (Packet Transfer Mode)</strong> z efektywnym kodowaniem 64/65 B;</li>
<li><strong>PPPoE</strong> (PPP over Ethernet) — najpopularniejsza metoda uwierzytelniania i tworzenia sesji z BNG; dodaje 8 bajtów narzutu, więc <strong>MTU wynosi 1492 B</strong> zamiast 1500 B (co bywa przyczyną problemów z fragmentacją i stosowania MSS clamping); alternatywą jest <strong>IPoE</strong> (IP over Ethernet) z uwierzytelnianiem opartym na opcjach DHCP lub porcie.</li>
</ul>
<h3>6.5. Sieci kablowe (HFC) i DOCSIS</h3>
<p>Operatorzy telewizji kablowej oferują dostęp do Internetu przez sieć koncentryczną. Nowoczesne sieci mają architekturę <strong>HFC (Hybrid Fiber-Coaxial)</strong>: od głównej stacji czołowej (<strong>headend</strong>) biegnie światłowód do węzłów optycznych, a stamtąd — <strong>kabel koncentryczny</strong> (75 Ω) z wzmacniaczami do domów. Kilkaset gospodarstw domowych w obrębie jednego węzła <strong>współdzieli</strong> pasmo, co odróżnia HFC od DSL (gdzie pętla jest dedykowana każdemu abonentowi).</p>
<p>Standard transmisji danych nazywa się <strong>DOCSIS (Data Over Cable Service Interface Specification)</strong> i jest opracowywany przez CableLabs. Po stronie operatora działa <strong>CMTS (Cable Modem Termination System)</strong>, po stronie abonenta — <strong>modem kablowy</strong>. Kierunek „w dół\" wykorzystuje kanały telewizyjne (w Europie 8 MHz, w USA 6 MHz), a kierunek „w górę\" — dolną część widma (5–65 MHz w Europie, 5–42 MHz w USA).</p>
<table>
<thead>
<tr>
<th>Wersja</th>
<th>Rok</th>
<th>Kluczowe cechy</th>
<th>Typowa przepływność (maks.)</th>
</tr>
</thead>
<tbody>
<tr>
<td>DOCSIS 1.0 / 1.1</td>
<td>1997 / 1999</td>
<td>pojedynczy kanał, QAM-64/256; QoS w 1.1</td>
<td>kilkadziesiąt Mb/s w dół</td>
</tr>
<tr>
<td>DOCSIS 2.0</td>
<td>2001</td>
<td>lepsza przepustowość w górę</td>
<td>kilkadziesiąt Mb/s</td>
</tr>
<tr>
<td>DOCSIS 3.0</td>
<td>2006</td>
<td><strong>bonding kanałów</strong> (łączenie 4, 8, 16, 32 kanałów), IPv6</td>
<td>ponad 1 Gb/s w dół</td>
</tr>
<tr>
<td>DOCSIS 3.1</td>
<td>2013</td>
<td>modulacja <strong>OFDM/OFDMA</strong>, do 4096-QAM, kanały 24–192 MHz</td>
<td>do 10 Gb/s w dół, 1–2 Gb/s w górę</td>
</tr>
<tr>
<td>DOCSIS 4.0</td>
<td>2019</td>
<td>tryb <strong>Full Duplex</strong> (FDX) i rozszerzone pasmo (do 1,8 GHz)</td>
<td>do 10 Gb/s w dół i kilka Gb/s w górę</td>
</tr>
</tbody>
</table>
<p>Ponieważ medium jest współdzielone, w kierunku „w górę\" stosuje się mechanizm <strong>rezerwacji</strong> (modem żąda przydziału czasu od CMTS, która harmonogramuje dostęp — bez kolizji, w odróżnieniu od CSMA). Wadą HFC jest <strong>lejek szumowy (noise funnel)</strong>: szumy z wielu domów sumują się w kierunku „w górę\", co wymaga starannej konserwacji sieci.</p>
<h3>6.6. Dostęp światłowodowy: FTTx i PON</h3>
<p>Światłowód dostępowy dociera coraz częściej do samego budynku lub mieszkania. Rozróżnia się:</p>
<ul>
<li><strong>FTTH (Fiber to the Home)</strong> — światłowód do lokalu abonenta;</li>
<li><strong>FTTB (Fiber to the Building)</strong> — do budynku, dalej Ethernet lub G.fast w instalacji wewnętrznej;</li>
<li><strong>FTTC / FTTN (to the Curb / Node)</strong> — do szafy ulicznej, dalej VDSL2 po miedzi;</li>
<li><strong>FTTdp (Distribution Point)</strong> — do punktu bardzo blisko lokalu (G.fast).</li>
</ul>
<h4>Topologie: punkt–punkt i PON</h4>
<p>Klasyczne łącza optyczne są <strong>punkt–punkt</strong>: osobne włókno od centrali do każdego abonenta (najlepsza przepustowość, wysoki koszt). Bardziej ekonomiczna jest <strong>pasywna sieć optyczna (PON — Passive Optical Network)</strong>, w której <strong>jedno włókno z centrali</strong> rozgałęzia się za pomocą <strong>pasywnego (niezasilanego) rozgałęźnika optycznego (splitter)</strong> do wielu abonentów (zazwyczaj 32 lub 64):</p>
<ul>
<li><strong>OLT (Optical Line Terminal)</strong> — urządzenie w centrali;</li>
<li><strong>splitter optyczny</strong> — pasywny element, dzielący moc optyczną (bez zasilania, w szafce ulicznej lub w budynku);</li>
<li><strong>ONT / ONU (Optical Network Terminal / Unit)</strong> — zakończenie u abonenta.</li>
</ul>
<p>Ponieważ splitter dzieli moc, wprowadza tłumienie zależne od stopnia podziału (orientacyjnie: 1:2 → ok. 3,5 dB, 1:8 → ok. 10,5 dB, 1:32 → ok. 17,5 dB, 1:64 → ok. 21 dB). Bilans mocy sieci PON ogranicza więc zasięg (zwykle do 20 km) i współczynnik podziału.</p>
<p><strong>Zasada działania.</strong> W kierunku „w dół\" OLT nadaje <strong>ciągły strumień do wszystkich ONT</strong> (broadcast, zwielokrotnienie czasowe TDM); każdy ONT odbiera wyłącznie własne dane (dane są szyfrowane AES dla poszczególnych abonentów). W kierunku „w górę\" wszystkie ONT dzielą wspólne włókno w sposób <strong>TDMA</strong>: każdy ONT dostaje od OLT wąską szczelinę czasową na nadawanie; OLT mierzy odległość do każdego ONT (<strong>ranging</strong>), aby wyrównać czasy propagacji i uniknąć nakładania się transmisji. Kierunki „w dół\" i „w górę\" wykorzystują różne długości fali (WDM), dzięki czemu jedno włókno służy do transmisji w obu kierunkach.</p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Organizacja</th>
<th>Przepływność w dół / w górę</th>
<th>Długości fali (dół / góra)</th>
</tr>
</thead>
<tbody>
<tr>
<td>EPON</td>
<td>IEEE 802.3ah</td>
<td>1 / 1 Gb/s</td>
<td>1490 / 1310 nm</td>
</tr>
<tr>
<td>10G-EPON</td>
<td>IEEE 802.3av</td>
<td>10 / 1 lub 10 / 10 Gb/s</td>
<td>1577 / 1270 nm</td>
</tr>
<tr>
<td>GPON</td>
<td>ITU-T G.984</td>
<td>2,488 / 1,244 Gb/s</td>
<td>1490 / 1310 nm (wideo RF: 1550 nm)</td>
</tr>
<tr>
<td>XG-PON</td>
<td>ITU-T G.987</td>
<td>10 / 2,5 Gb/s</td>
<td>1577 / 1270 nm</td>
</tr>
<tr>
<td>XGS-PON</td>
<td>ITU-T G.9807.1</td>
<td>10 / 10 Gb/s</td>
<td>1577 / 1270 nm</td>
</tr>
<tr>
<td>NG-PON2</td>
<td>ITU-T G.989</td>
<td>40 / 10 Gb/s (4 długości fali TWDM)</td>
<td>pasma L i C</td>
</tr>
<tr>
<td>25GS-PON, 50G-PON</td>
<td>ITU-T G.9804 i inne</td>
<td>25–50 Gb/s</td>
<td>rozwijane</td>
</tr>
</tbody>
</table>
<p>Zalety PON: oszczędność włókien i portów w centrali, brak zasilanej elektroniki w terenie (niższe koszty utrzymania i awaryjność), duże przepływności i długoterminowa skalowalność. Wady: współdzielenie przepustowości między abonentów przypisanych do jednego OLT/portu, konieczność dokładnego bilansu mocy, trudniejsza lokalizacja awarii.</p>
<h3>6.7. Dostęp radiowy i satelitarny</h3>
<ul>
<li><strong>Sieci komórkowe (LTE, 5G NR)</strong> — dostęp mobilny i jako <strong>FWA (Fixed Wireless Access)</strong>: stacjonarny modem lub router z zewnętrzną anteną zastępuje łącze kablowe, szczególnie na obszarach bez światłowodu. Przepływności od kilkudziesięciu Mb/s (LTE) do kilkuset Mb/s i więcej (5G); pasmo współdzielone z innymi użytkownikami komórki, opóźnienie ok. 10–40 ms.</li>
<li><strong>WISP (Wireless ISP)</strong> — lokalni operatorzy internetowi wykorzystujący łącza radiowe (pasma 5 GHz, 24 GHz, 60 GHz) punkt–wielopunkt do dostarczania Internetu w gęsto zabudowanych obszarach lub na wsiach.</li>
<li><strong>Satelitarny dostęp do Internetu.</strong> Satelity <strong>geostacjonarne (GEO)</strong> na wysokości ok. 35 786 km mają duże opóźnienie propagacji: sygnał pokonuje drogę Ziemia → satelita → Ziemia w ok. 240 ms, czyli <strong>RTT</strong> wynosi ok. 500–600 ms, co utrudnia zastosowania interaktywne. Konstelacje na niskiej orbicie (<strong>LEO</strong>, ok. 500–1200 km) zmniejszają opóźnienie do kilkudziesięciu milisekund, ale wymagają dużej liczby satelitów i anten śledzących. Satelity zapewniają dostęp niemal wszędzie, z ograniczeniami pasma, wpływu pogody i zasięgu geograficznego.</li>
</ul>
<h3>6.8. Porównanie technologii dostępowych</h3>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Medium</th>
<th>Typowa przepływność</th>
<th>Charakter łącza</th>
<th>Główne ograniczenia</th>
</tr>
</thead>
<tbody>
<tr>
<td>Dial-up (V.90/V.92)</td>
<td>skrętka telefoniczna</td>
<td>do 56 kb/s</td>
<td>komutowane</td>
<td>zajmuje linię, bardzo wolne</td>
</tr>
<tr>
<td>ISDN BRI</td>
<td>skrętka</td>
<td>128 kb/s</td>
<td>komutowane, cyfrowe</td>
<td>przestarzały</td>
</tr>
<tr>
<td>ADSL / ADSL2+</td>
<td>skrętka</td>
<td>8–24 Mb/s</td>
<td>dedykowana pętla, asymetryczne</td>
<td>zasięg, tłumienie</td>
</tr>
<tr>
<td>VDSL2 (z vectoringiem)</td>
<td>skrętka</td>
<td>50–200 Mb/s</td>
<td>dedykowana pętla</td>
<td>zasięg do ok. 1 km</td>
</tr>
<tr>
<td>G.fast</td>
<td>skrętka</td>
<td>do ok. 1 Gb/s</td>
<td>dedykowana pętla</td>
<td>zasięg 100–250 m</td>
</tr>
<tr>
<td>Kablowy DOCSIS 3.x</td>
<td>koncentryk (HFC)</td>
<td>100 Mb/s – ponad 1 Gb/s</td>
<td>współdzielone</td>
<td>zmienność przy dużym obciążeniu węzła</td>
</tr>
<tr>
<td>FTTH (P2P / PON)</td>
<td>światłowód</td>
<td>100 Mb/s – 10 Gb/s</td>
<td>punkt–punkt lub współdzielone (PON)</td>
<td>koszt budowy</td>
</tr>
<tr>
<td>LTE / 5G FWA</td>
<td>radio</td>
<td>30 Mb/s – ponad 1 Gb/s</td>
<td>współdzielone</td>
<td>zmienne warunki propagacji</td>
</tr>
<tr>
<td>Satelita GEO</td>
<td>radio</td>
<td>10–100 Mb/s</td>
<td>współdzielone</td>
<td>opóźnienie ok. 500–600 ms</td>
</tr>
<tr>
<td>Satelita LEO</td>
<td>radio</td>
<td>50–300 Mb/s</td>
<td>współdzielone</td>
<td>koszt terminala, zmienność</td>
</tr>
</tbody>
</table>
<h3>6.9. Sieci rozległe (WAN)</h3>
<h4>Definicja i cechy</h4>
<p><strong>Sieć rozległa (WAN — Wide Area Network)</strong> łączy sieci lokalne (LAN) znajdujące się w różnych miastach, krajach lub kontynentach. Jej charakterystyczną cechą jest to, że infrastruktura zwykle <strong>nie należy do organizacji korzystającej z usługi</strong>, lecz jest <strong>dzierżawiona od operatorów telekomunikacyjnych</strong>, którzy pobierają opłaty i gwarantują parametry usługi w umowie SLA.</p>
<table>
<thead>
<tr>
<th>Cecha</th>
<th>LAN</th>
<th>WAN</th>
</tr>
</thead>
<tbody>
<tr>
<td>Zasięg</td>
<td>budynek, kampus</td>
<td>miasto, kraj, świat</td>
</tr>
<tr>
<td>Właściciel infrastruktury</td>
<td>organizacja</td>
<td>operator telekomunikacyjny</td>
</tr>
<tr>
<td>Przepływność</td>
<td>zwykle 1–100 Gb/s</td>
<td>od kilkuset kb/s do setek Gb/s (zależnie od kosztu)</td>
</tr>
<tr>
<td>Koszt eksploatacji</td>
<td>niski</td>
<td>wysoki (opłaty za usługi)</td>
</tr>
<tr>
<td>Opóźnienie</td>
<td>mikrosekundy–milisekundy</td>
<td>milisekundy–setki milisekund</td>
</tr>
<tr>
<td>Typowe technologie</td>
<td>Ethernet, Wi-Fi</td>
<td>łącza dzierżawione, MPLS, Metro Ethernet, VPN, SD-WAN, SDH, DWDM</td>
</tr>
</tbody>
</table>
<h4>Wybrane technologie łączy WAN</h4>
<p><strong>Łącza dzierżawione (leased lines).</strong> Stałe, dedykowane połączenie punkt–punkt o gwarantowanej przepustowości, dostępne przez cały czas. Klasyczne hierarchie <strong>PDH</strong>: <strong>E1</strong> (2,048 Mb/s; 32 szczeliny po 64 kb/s, 30 użytkowych + synchronizacja + sygnalizacja; standard europejski) i <strong>T1</strong> (1,544 Mb/s; 24 kanały; Ameryka Północna); wyższe rzędy: E3 (34,368 Mb/s), T3 (44,736 Mb/s). Nowsza hierarchia synchroniczna <strong>SDH/SONET</strong>: STM-1 (155,52 Mb/s), STM-4 (622,08 Mb/s), STM-16 (2,488 Gb/s), STM-64 (9,953 Gb/s). Dziś łącza dzierżawione realizowane są często jako usługi Ethernet lub wolne długości fal (DWDM) w sieci operatora.</p>
<p><strong>Komutacja łączy (circuit switching).</strong> Dla czasu trwania rozmowy zestawiany jest dedykowany obwód (PSTN, ISDN). Zaleta: gwarantowana przepustowość i stałe opóźnienie. Wada: marnowanie zasobów przy ruchu nieregularnym (dane komputerowe).</p>
<p><strong>Komutacja pakietów (packet switching).</strong> Dane dzielone są na pakiety przesyłane niezależnie, a łącza są współdzielone; wykorzystanie zasobów jest wydajne dla ruchu „impulsowego\". Historyczne technologie: <strong>X.25</strong>, <strong>Frame Relay</strong> (obwody wirtualne identyfikowane przez DLCI), <strong>ATM</strong> (komórki 53 B, identyfikatory VPI/VCI). Ich rolę przejęły <strong>IP/MPLS</strong> i <strong>Ethernet operatorski</strong>.</p>
<p><strong>MPLS (Multiprotocol Label Switching).</strong> Pakiety w sieci operatora otrzymują krótką <strong>etykietę</strong> (nagłówek 32 bity: 20-bitowa etykieta, 3 bity klasy ruchu, bit dna stosu, 8-bitowe TTL), na podstawie której routery (<strong>LSR</strong>) przełączają je szybko, bez pełnej analizy adresu IP; na brzegach sieci działają routery <strong>LER</strong>, dodające i usuwające etykiety. MPLS umożliwia:</p>
<ul>
<li><strong>VPN warstwy 3</strong> (L3VPN) — izolowane wirtualne sieci IP klientów w jednej infrastrukturze operatora (osobne tablice routingu VRF);</li>
<li><strong>VPN warstwy 2</strong> (m.in. VPLS) — przezroczyste łączenie sieci Ethernet;</li>
<li><strong>inżynierię ruchu i QoS</strong> — ustalanie ścieżek i gwarancje jakości.</li>
</ul>
<p><strong>Metro Ethernet / Carrier Ethernet.</strong> Usługi Ethernetowe świadczone przez operatora w obszarze metropolitalnym i szerzej; standaryzowane przez organizację <strong>MEF</strong> jako <strong>E-Line</strong> (punkt–punkt), <strong>E-LAN</strong> (wielopunktowa, jak wirtualny przełącznik) i <strong>E-Tree</strong> (gwiazda). Klient widzi „kabel Ethernet\" lub „przełącznik\" rozciągnięty na wiele lokalizacji; w sieci operatora ruch klientów rozdzielają etykiety <strong>Q-in-Q (802.1ad)</strong> lub MPLS.</p>
<p><strong>VPN przez Internet.</strong> Tania alternatywa dla łączy dzierżawionych: zaszyfrowane <strong>tunele</strong> przez publiczny Internet, np. <strong>IPsec</strong> (IKEv2 + ESP), <strong>SSL/TLS VPN</strong>, <strong>WireGuard</strong>. Zapewniają poufność i uwierzytelnienie, ale nie gwarantują jakości usług (opóźnień, utraty pakietów), ponieważ ruch przechodzi przez sieć „best effort\".</p>
<p><strong>SD-WAN (Software-Defined WAN).</strong> Rozwiązanie łączące wiele łączy (światłowodowe, kablowe, LTE/5G, MPLS) w jedną <strong>nakładkę logiczną</strong> (overlay) sterowaną centralnie. Kontroler dobiera ścieżkę dla aplikacji na podstawie bieżącej jakości łączy (opóźnienie, jitter, straty), zapewniając redundancję i optymalizację kosztów; tunele są szyfrowane, a konfiguracja nowych oddziałów może być zautomatyzowana (<strong>zero-touch provisioning</strong>).</p>
<h4>Topologie WAN</h4>
<p><img alt=\"Topologie WAN: punkt–punkt, gwiazda (hub-and-spoke) i pełna siatka wraz ze wzorami na liczbę łączy\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/wan-topologie.svg\" /></p>
<ul>
<li><strong>Punkt–punkt</strong> — jedno dedykowane łącze między dwiema lokalizacjami; proste, przewidywalne, lecz nieekonomiczne dla wielu lokalizacji.</li>
<li><strong>Gwiazda (hub-and-spoke)</strong> — oddziały łączą się z centralą; koszt rośnie liniowo (n − 1 łączy), ale ruch między oddziałami przechodzi przez centralę (dodatkowe opóźnienie), a centrala jest punktem awarii.</li>
<li><strong>Pełna siatka (full mesh)</strong> — każda lokalizacja połączona z każdą; największa niezawodność i najkrótsze ścieżki, ale liczba łączy rośnie kwadratowo: <span data-m=\"n(n-1)/2\"></span> (dla 10 lokalizacji: 45 łączy).</li>
<li><strong>Częściowa siatka (partial mesh)</strong> — kompromis: łączone są tylko kluczowe lokalizacje.</li>
</ul>
<h4>Protokoły warstwy łącza w WAN</h4>
<ul>
<li><strong>HDLC</strong> (High-Level Data Link Control) — synchroniczny protokół ramkowania na łączach punkt–punkt; wersje producenckie (np. Cisco HDLC);</li>
<li><strong>PPP (Point-to-Point Protocol, RFC 1661)</strong> — uniwersalny protokół dla łączy punkt–punkt, składający się z: <strong>LCP</strong> (Link Control Protocol — negocjacja parametrów, uwierzytelnianie), protokołów uwierzytelniania <strong>PAP</strong> (hasło jawne, nie zalecany) i <strong>CHAP</strong> (wyzwanie–odpowiedź) oraz <strong>NCP</strong> (np. <strong>IPCP</strong> — konfiguracja adresu IP). PPP jest podstawą dostępu dial-up, DSL (w wariancie PPPoE/PPPoA) i wielu łączy szeregowych.</li>
</ul>
<h4>Parametry usług WAN i SLA</h4>
<p>Przy wyborze usługi WAN porównuje się:</p>
<ul>
<li><strong>przepływność</strong> (i <strong>CIR — Committed Information Rate</strong>, gwarantowaną część),</li>
<li><strong>opóźnienie, jitter, utratę pakietów</strong>,</li>
<li><strong>dostępność</strong> — np. 99,9 % oznacza do 8,76 godziny przestoju w roku, a 99,99 % — do ok. 53 minut,</li>
<li><strong>czas usunięcia awarii (MTTR)</strong>,</li>
<li><strong>symetrię</strong> i możliwość zwiększenia przepływności,</li>
<li><strong>koszt</strong> i model rozliczeń (łącze stałe vs zużycie),</li>
<li><strong>zabezpieczenia</strong> i sposób izolacji ruchu.</li>
</ul>
<p>Umowa <strong>SLA (Service Level Agreement)</strong> określa gwarantowane wartości oraz rekompensaty w razie ich naruszenia.</p>
<h3>6.10. Kierunki rozwoju</h3>
<p>Można wskazać kilka trendów w mediach transmisyjnych i technologiach dostępowych:</p>
<ul>
<li><strong>Światłowód wszędzie</strong>, gdzie to ekonomicznie uzasadnione — FTTH jako docelowy standard, PON o coraz wyższych przepływnościach (25G/50G);</li>
<li><strong>Wygaszanie starych technologii</strong> (ISDN, dial-up, część ADSL) i skracanie pętli miedzianych (FTTdp, G.fast);</li>
<li><strong>Konwergencja Wi-Fi i sieci komórkowych</strong> — Wi-Fi 7 i 5G jako uzupełniające się technologie, FWA jako alternatywa dla kabla;</li>
<li><strong>Stałe zwiększanie wykorzystania widma</strong> — pasmo 6 GHz, szersze kanały, wyższe modulacje, MLO;</li>
<li><strong>Sieci definiowane programowo</strong> — SD-WAN, automatyzacja i zarządzanie chmurowe;</li>
<li><strong>IPv6</strong> jako standard adresacji dla milionów urządzeń IoT dołączanych radiowo.</li>
</ul>
<h2>7. Podsumowanie</h2>
<p>Media transmisyjne stanowią fundament, na którym opierają się wszystkie wyższe warstwy sieci. <strong>Skrętka miedziana</strong> dzięki niskim kosztom i możliwości zasilania (PoE) pozostaje podstawowym medium w sieciach lokalnych, jednak jej zasięg (100 m) i podatność na zakłócenia ograniczają zastosowania. <strong>Światłowody</strong> oferują praktycznie nieograniczone pasmo, ogromne zasięgi i odporność na zakłócenia, przez co stanowią podstawę sieci szkieletowych, centrów danych i dostępu FTTH. <strong>Fale radiowe</strong> zapewniają mobilność i elastyczność, ale wymagają dzielenia ograniczonego widma i zabezpieczenia transmisji.</p>
<p>Rodzina <strong>IEEE 802.11</strong> w ciągu ćwierćwiecza przebyła drogę od 2 Mb/s do ponad 46 Gb/s (teoretycznie) dzięki zastosowaniu OFDM, MIMO, szerszych kanałów, wyższych modulacji, OFDMA i wielołączowości (MLO). Jednocześnie — ze względu na mechanizm CSMA/CA i współdzielone medium — Wi-Fi pozostaje technologią, której rzeczywista przepustowość zależy od jakości sygnału, liczby użytkowników i interferencji.</p>
<p><strong>Technologie dostępowe</strong> (DSL, kablowe, światłowodowe, radiowe, satelitarne) wykorzystują różne media i różne kompromisy między kosztem, przepływnością i zasięgiem, a <strong>sieci WAN</strong> łączą lokalizacje przy użyciu łączy dzierżawionych, MPLS, Metro Ethernet, VPN i coraz częściej SD-WAN.</p>
<h3>Zestawienie porównawcze najważniejszych technologii</h3>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Medium</th>
<th>Typowy zakres</th>
<th>Przepływność</th>
<th>Charakterystyczne cechy</th>
</tr>
</thead>
<tbody>
<tr>
<td>Ethernet Cat 6A</td>
<td>skrętka</td>
<td>do 100 m</td>
<td>do 10 Gb/s</td>
<td>PoE, niski koszt, EMI</td>
</tr>
<tr>
<td>Ethernet SMF (LR)</td>
<td>światłowód jednomodowy</td>
<td>10 km i więcej</td>
<td>10–400 Gb/s</td>
<td>brak EMI, wysoki koszt terminali</td>
</tr>
<tr>
<td>Wi-Fi 6 / 6E</td>
<td>radio 2,4/5/6 GHz</td>
<td>kilkadziesiąt metrów w budynku</td>
<td>do 9,6 Gb/s (teoret.)</td>
<td>OFDMA, efektywność w gęstych sieciach</td>
</tr>
<tr>
<td>Wi-Fi 7</td>
<td>radio 2,4/5/6 GHz</td>
<td>kilkadziesiąt metrów w budynku</td>
<td>do 46 Gb/s (teoret.)</td>
<td>MLO, 320 MHz, 4096-QAM</td>
</tr>
<tr>
<td>VDSL2</td>
<td>miedź telefoniczna</td>
<td>do ok. 1 km</td>
<td>do 100–200 Mb/s</td>
<td>wykorzystuje istniejące łącza</td>
</tr>
<tr>
<td>DOCSIS 3.1</td>
<td>koncentryk HFC</td>
<td>HFC</td>
<td>do 10 Gb/s</td>
<td>medium współdzielone</td>
</tr>
<tr>
<td>XGS-PON</td>
<td>światłowód (PON)</td>
<td>do 20 km</td>
<td>10 / 10 Gb/s</td>
<td>pasywny rozgałęźnik</td>
</tr>
<tr>
<td>MPLS VPN / Metro Ethernet</td>
<td>infrastruktura operatora</td>
<td>kraj, region</td>
<td>zgodnie z umową</td>
<td>SLA, izolacja klientów</td>
</tr>
</tbody>
</table>
<h2>8. Słownik podstawowych pojęć</h2>
<table>
<thead>
<tr>
<th>Pojęcie</th>
<th>Znaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>AP (Access Point)</strong></td>
<td>punkt dostępowy łączący klientów Wi-Fi z siecią przewodową</td>
</tr>
<tr>
<td><strong>Backoff</strong></td>
<td>losowe opóźnienie przed próbą nadawania w CSMA/CA</td>
</tr>
<tr>
<td><strong>BSS / ESS</strong></td>
<td>pojedyncza komórka Wi-Fi / zbiór połączonych komórek o wspólnym SSID</td>
</tr>
<tr>
<td><strong>CCK, DSSS</strong></td>
<td>techniki rozpraszania widma stosowane w 802.11 i 802.11b</td>
</tr>
<tr>
<td><strong>CIR</strong></td>
<td>Committed Information Rate — gwarantowana przepływność usługi WAN</td>
</tr>
<tr>
<td><strong>CMTS</strong></td>
<td>urządzenie po stronie operatora w sieci kablowej</td>
</tr>
<tr>
<td><strong>CPE</strong></td>
<td>urządzenie po stronie abonenta</td>
</tr>
<tr>
<td><strong>DFS</strong></td>
<td>mechanizm ustępowania radarom w paśmie 5 GHz</td>
</tr>
<tr>
<td><strong>DMT</strong></td>
<td>modulacja wielotonowa stosowana w DSL</td>
</tr>
<tr>
<td><strong>DSLAM</strong></td>
<td>multiplekser DSL w centrali lub szafie ulicznej</td>
</tr>
<tr>
<td><strong>EIRP</strong></td>
<td>równoważna moc promieniowana izotropowo</td>
</tr>
<tr>
<td><strong>FSPL</strong></td>
<td>tłumienie w przestrzeni swobodnej</td>
</tr>
<tr>
<td><strong>MCS</strong></td>
<td>zestaw modulacji i kodowania w Wi-Fi</td>
</tr>
<tr>
<td><strong>MIMO / MU-MIMO</strong></td>
<td>wiele anten / wielu użytkowników jednocześnie</td>
</tr>
<tr>
<td><strong>MLO</strong></td>
<td>wielołączowość w Wi-Fi 7</td>
</tr>
<tr>
<td><strong>NAV</strong></td>
<td>wirtualny licznik zajętości medium w Wi-Fi</td>
</tr>
<tr>
<td><strong>NEXT / FEXT</strong></td>
<td>przesłuch zbliżny / zdalny</td>
</tr>
<tr>
<td><strong>OFDM / OFDMA</strong></td>
<td>zwielokrotnienie z ortogonalnymi podnośnymi / jego wielodostępny wariant</td>
</tr>
<tr>
<td><strong>OLT / ONT</strong></td>
<td>zakończenie sieci PON po stronie operatora / abonenta</td>
</tr>
<tr>
<td><strong>PoE</strong></td>
<td>zasilanie urządzeń przez kabel Ethernet</td>
</tr>
<tr>
<td><strong>PON</strong></td>
<td>pasywna sieć optyczna</td>
</tr>
<tr>
<td><strong>RSSI</strong></td>
<td>wskaźnik mocy odbieranego sygnału</td>
</tr>
<tr>
<td><strong>SNR</strong></td>
<td>stosunek sygnału do szumu</td>
</tr>
<tr>
<td><strong>SSID</strong></td>
<td>nazwa sieci Wi-Fi</td>
</tr>
<tr>
<td><strong>WDM</strong></td>
<td>zwielokrotnienie falowe w światłowodzie</td>
</tr>
</tbody>
</table>
<h2>9. Pytania kontrolne i zadania</h2>
<h3>Pytania</h3>
<ol>
<li>Wyjaśnij, dlaczego skręcenie przewodów w parze i różnicowy sposób transmisji poprawiają odporność skrętki na zakłócenia. Do czego służą różne skoki skrętu poszczególnych par w kablu?</li>
<li>Opisz różnicę między kablem U/UTP, F/UTP i S/FTP. Jakich wymagań instalacyjnych wymaga stosowanie ekranowanych kabli?</li>
<li>Wyjaśnij, na czym polega zjawisko całkowitego wewnętrznego odbicia i jaką rolę odgrywają rdzeń i płaszcz światłowodu. Dlaczego różnica współczynników załamania jest bardzo mała?</li>
<li>Porównaj światłowody wielomodowe i jednomodowe pod względem średnicy rdzenia, dyspersji, zasięgu i zastosowań. Czym jest dyspersja modowa i jak łagodzi ją profil gradientowy?</li>
<li>Wyjaśnij, dlaczego tłumienie sygnału radiowego w wolnej przestrzeni rośnie wraz z częstotliwością i odległością. Jakie znaczenie ma to dla różnic w zasięgu Wi-Fi 2,4 GHz i 5 GHz?</li>
<li>Czym różni się modulacja 256-QAM od 4096-QAM pod względem liczby bitów na symbol i wymaganego SNR? Dlaczego wyższe modulacje wybierane są dopiero przy dobrym sygnale?</li>
<li>Wyjaśnij, dlaczego w sieciach Wi-Fi stosuje się CSMA/CA zamiast CSMA/CD. Na czym polegają problem ukrytej stacji i mechanizm RTS/CTS?</li>
<li>Wymień najważniejsze cechy standardów 802.11n, 802.11ac, 802.11ax i 802.11be oraz wskaż, które z nich dotyczą przede wszystkim wzrostu przepływności, a które — efektywności w gęstych sieciach.</li>
<li>Opisz architekturę dostępu ADSL: rolę splittera, DSLAM i BNG. Dlaczego prędkość DSL maleje wraz z długością pętli i jak działa modulacja DMT?</li>
<li>Porównaj technologie dostępowe DSL, DOCSIS i PON (w tym pod względem medium, współdzielenia pasma i przepływności) oraz wyjaśnij różnicę między łączem dzierżawionym, MPLS VPN i VPN przez Internet w kontekście sieci WAN.</li>
</ol>
<h3>Zadania obliczeniowe</h3>
<p><strong>Zadanie 1.</strong> Oblicz teoretyczną przepływność warstwy fizycznej Wi-Fi 6 (802.11ax) przy kanale 160 MHz, dwóch strumieniach przestrzennych, modulacji 1024-QAM z kodowaniem 3/4 (MCS 10) i przedziale ochronnym 1,6 µs. (Wskazówka: 1960 podnośnych danych, symbol 12,8 µs + GI.)</p>
<p><strong>Zadanie 2.</strong> Oblicz tłumienie w przestrzeni swobodnej (FSPL) na odległości 30 m dla częstotliwości 2450 MHz oraz 5500 MHz. Ile decybeli wynosi różnica?</p>
<p><strong>Zadanie 3.</strong> Łącze jednomodowe o długości 12 km pracuje przy 1550 nm (tłumienność 0,22 dB/km). Zawiera 5 spawów po 0,08 dB oraz 2 pary złączy po 0,5 dB. Przyjęto margines 3 dB. Transceiver ma moc nadawczą −3 dBm i czułość odbiornika −18 dBm. Oblicz sumę strat i sprawdź, czy łącze zadziała.</p>
<p><strong>Zadanie 4.</strong> Oblicz pojemność kanału Shannona dla szerokości pasma 20 MHz i SNR = 25 dB. Porównaj wynik z teoretyczną przepływnością Wi-Fi 4 (802.11n) 1×1 w kanale 20 MHz (72,2 Mb/s).</p>
<h3>Klucz odpowiedzi do zadań</h3>
<p><strong>Zadanie 1.</strong> Symbol: <span data-m=\"12{,}8 + 1{,}6 = 14{,}4\"></span> µs. Na jeden strumień: <span data-m=\"1960 \\cdot 10 \\cdot 0{,}75 = 14\\,700\"></span> bitów, czyli <span data-m=\"14\\,700 / 14{,}4\\ \\mu\\text{s} \\approx 1020{,}8\"></span> Mb/s. Dla dwóch strumieni: <strong>ok. 2041,7 Mb/s (ok. 2,04 Gb/s)</strong>.</p>
<p><strong>Zadanie 2.</strong> <span data-m=\"\\text{FSPL} = 20\\log_{10}(30) + 20\\log_{10}(f) - 27{,}55\"></span>. Dla 2450 MHz: <span data-m=\"29{,}54 + 67{,}78 - 27{,}55 \\approx 69{,}8\"></span> dB. Dla 5500 MHz: <span data-m=\"29{,}54 + 74{,}81 - 27{,}55 \\approx 76{,}8\"></span> dB. Różnica wynosi <strong>ok. 7,0 dB</strong> (czyli <span data-m=\"20\\log_{10}(5500/2450)\"></span>).</p>
<p><strong>Zadanie 3.</strong> Straty: <span data-m=\"12 \\cdot 0{,}22 = 2{,}64\"></span> dB (włókno) <span data-m=\"+ 5 \\cdot 0{,}08 = 0{,}4\"></span> dB (spawy) <span data-m=\"+ 2 \\cdot 0{,}5 = 1{,}0\"></span> dB (złącza) <span data-m=\"+ 3\"></span> dB (margines) <span data-m=\"= \\mathbf{7{,}04}\"></span> dB. Budżet: <span data-m=\"-3 - (-18) = 15\"></span> dB. Rezerwa ponad zaplanowany margines to <span data-m=\"15 - 7{,}04 \\approx 7{,}96\"></span> dB, więc <strong>łącze zadziała z dużym zapasem</strong>. (Uwaga: dla bardzo krótkich łączy problemem bywa nadmiar mocy, wymagający tłumika.)</p>
<p><strong>Zadanie 4.</strong> SNR = 25 dB → 316,2 razy. <span data-m=\"C = 20\\cdot 10^6 \\cdot \\log_2(1 + 316{,}2) \\approx 20\\cdot 10^6 \\cdot 8{,}31 \\approx \\mathbf{166{,}2}\"></span> Mb/s. Przepływność Wi-Fi 4 1×1 (72,2 Mb/s) stanowi około 43 % tej granicy — pokazuje to, że rzeczywiste systemy pracują poniżej granicy Shannona i że ich rozwój (wyższe modulacje, lepsze kodowanie, więcej strumieni MIMO) zmierza do jej przybliżania lub jej „obejścia\" przez zwielokrotnienie kanałów przestrzennych.</p>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci";
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
        return new Source("<h2>Wprowadzenie do materiału</h2>
<p>Każda sieć komputerowa, niezależnie od tego, jak złożone protokoły działają w wyższych warstwach, ostatecznie opiera się na fizycznym nośniku, który przenosi sygnał z jednego urządzenia do drugiego. Tym nośnikiem może być para miedzianych przewodów, włókno szklane, w którym rozchodzi się światło, albo fala elektromagnetyczna propagująca się w powietrzu. Wybór medium determinuje przepustowość, maksymalny zasięg, odporność na zakłócenia, koszt instalacji, a nawet możliwość zapewnienia bezpieczeństwa transmisji.</p>
<p>Niniejszy materiał przedstawia w sposób uporządkowany i szczegółowy trzy klasy mediów transmisyjnych — <strong>skrętkę miedzianą</strong>, <strong>światłowody</strong> oraz <strong>fale radiowe</strong> — a następnie omawia rodzinę standardów <strong>IEEE 802.11 (Wi-Fi)</strong>, która jest dziś najważniejszym sposobem bezprzewodowego dostępu do sieci lokalnej. Ostatnia część poświęcona jest <strong>technologiom dostępowym</strong> (modemy analogowe, ISDN, DSL, sieci kablowe, dostęp światłowodowy) oraz <strong>sieciom rozległym (WAN)</strong>, czyli infrastrukturze łączącej sieci lokalne z Internetem i między sobą.</p>
<p>Materiał ma charakter akademicki, lecz został napisany tak, aby był zrozumiały dla osoby rozpoczynającej naukę o sieciach. Każde nowe pojęcie jest definiowane przy pierwszym użyciu, a tam, gdzie to możliwe, podano przykłady liczbowe i schematy.</p>
<hr />
<h2>1. Warstwa fizyczna i pojęcia podstawowe</h2>
<h3>1.1. Rola warstwy fizycznej</h3>
<p>Warstwa fizyczna (warstwa 1 modelu ISO/OSI) odpowiada za przekształcenie ciągu bitów w sygnał fizyczny (elektryczny, optyczny lub radiowy), jego przesłanie przez medium oraz odtworzenie bitów po stronie odbiorczej. Definiuje ona:</p>
<ul>
<li><strong>właściwości mechaniczne</strong> — rodzaj złączy, ich rozmieszczenie, budowę kabli;</li>
<li><strong>właściwości elektryczne i optyczne</strong> — poziomy napięć, długości fal, moc nadajnika, czułość odbiornika;</li>
<li><strong>kodowanie i modulację</strong> — sposób reprezentowania bitów w sygnale;</li>
<li><strong>synchronizację</strong> — utrzymanie zgodności zegarów nadajnika i odbiornika;</li>
<li><strong>topologię fizyczną</strong> — sposób połączenia urządzeń (gwiazda, magistrala, siatka).</li>
</ul>
<p>Warstwa fizyczna nie „rozumie\" ramek ani adresów — operuje wyłącznie na bitach i sygnałach. Dlatego urządzenia pracujące wyłącznie w warstwie 1 (repeatery, koncentratory, konwertery mediów) jedynie regenerują i powielają sygnał.</p>
<h3>1.2. Podstawowe pojęcia</h3>
<p><strong>Pasmo (bandwidth)</strong> ma w telekomunikacji dwa różne znaczenia, które należy odróżniać:</p>
<ul>
<li>w sensie <em>analogowym</em> — szerokość zakresu częstotliwości, jaki kanał jest w stanie przenieść, mierzona w hercach (Hz), np. kanał telefoniczny ma pasmo ok. 3,1 kHz (300–3400 Hz);</li>
<li>w sensie <em>potocznym, informatycznym</em> — maksymalna przepływność łącza, mierzona w bitach na sekundę (b/s), np. „łącze o paśmie 1 Gb/s\".</li>
</ul>
<p>W dalszej części, aby uniknąć niejednoznaczności, będziemy używać terminu <strong>szerokość pasma</strong> dla wielkości w hercach oraz <strong>przepływność</strong> dla wielkości w bitach na sekundę.</p>
<p><strong>Przepustowość rzeczywista (throughput)</strong> to ilość danych faktycznie przesłanych w jednostce czasu, uwzględniająca narzuty protokołów, retransmisje i konkurencję o medium. <strong>Przepustowość użyteczna (goodput)</strong> to część throughputu stanowiąca dane aplikacji, bez nagłówków i retransmisji. Zawsze zachodzi zależność:</p>
<div data-m=\"\\text{goodput} \\le \\text{throughput} \\le \\text{przepływność nominalna łącza}\"></div>
<p><strong>Opóźnienie (latency)</strong> to czas przejścia danych od nadawcy do odbiorcy. Składa się z opóźnienia propagacji (zależnego od długości i prędkości sygnału w medium), opóźnienia transmisji (czas „wypchnięcia\" wszystkich bitów ramki na łącze), opóźnienia kolejkowania i przetwarzania. <strong>Jitter</strong> to zmienność opóźnienia w czasie, szczególnie istotna dla telefonii IP i wideo.</p>
<p><strong>Prędkość propagacji sygnału</strong> w miedzi wynosi ok. 0,64–0,7 prędkości światła (dla skrętki kategorii 5e typowo 0,64 c, czyli ok. 5 ns na metr), w szkle światłowodu ok. 0,68 c (ok. 4,9 µs na kilometr), a w próżni i (w przybliżeniu) w powietrzu — 300 000 km/s.</p>
<h3>1.3. Decybele — język inżynierii sygnałów</h3>
<p>Sygnały w mediach transmisyjnych zmieniają swoją moc o wiele rzędów wielkości (od miliwatów na wyjściu nadajnika do pikowatów na wejściu odbiornika), dlatego stosuje się skalę logarytmiczną. <strong>Decybel (dB)</strong> jest miarą <em>stosunku</em> dwóch mocy:</p>
<div data-m=\"G_{\\text{dB}} = 10 \\cdot \\log_{10}\\!\\left(\\frac{P_{\\text{wyj}}}{P_{\\text{wej}}}\\right)\"></div>
<p>Wartość dodatnia oznacza wzmocnienie, ujemna — tłumienie. Kilka wartości warto zapamiętać:</p>
<table>
<thead>
<tr>
<th>Zmiana mocy</th>
<th>Wartość w dB</th>
</tr>
</thead>
<tbody>
<tr>
<td>×2 (podwojenie)</td>
<td>+3 dB</td>
</tr>
<tr>
<td>×10</td>
<td>+10 dB</td>
</tr>
<tr>
<td>×100</td>
<td>+20 dB</td>
</tr>
<tr>
<td>×0,5 (połowa mocy)</td>
<td>−3 dB</td>
</tr>
<tr>
<td>×0,1</td>
<td>−10 dB</td>
</tr>
<tr>
<td>×0,001</td>
<td>−30 dB</td>
</tr>
</tbody>
</table>
<p>Zaletą skali logarytmicznej jest to, że <strong>tłumienia kolejnych odcinków po prostu się dodają</strong>: jeśli kabel tłumi o 6 dB, złącze o 0,5 dB, a spaw o 0,1 dB, to suma wynosi 6,6 dB.</p>
<p><strong>dBm</strong> oznacza moc bezwzględną odniesioną do 1 mW: <span data-m=\"P_{\\text{dBm}} = 10 \\log_{10}(P / 1\\,\\text{mW})\"></span>. Zatem 0 dBm = 1 mW, 20 dBm = 100 mW, 30 dBm = 1 W, a −30 dBm = 1 µW. W technice bezprzewodowej powszechnie używa się też <strong>dBi</strong> (zysk anteny względem hipotetycznej anteny izotropowej) oraz <strong>dBW</strong>.</p>
<h3>1.4. Zjawiska pogarszające jakość sygnału</h3>
<p>Sygnał w trakcie propagacji ulega degradacji z kilku powodów:</p>
<ol>
<li><strong>Tłumienie (attenuation)</strong> — spadek mocy sygnału wraz z odległością. W miedzi rośnie z częstotliwością i długością kabla (straty rezystancyjne, efekt naskórkowy, straty w dielektryku), w światłowodzie wynika z rozpraszania i absorpcji w szkle, w radiu — z rozszerzania się fali w przestrzeni.</li>
<li><strong>Szum (noise)</strong> — losowe sygnały dodające się do użytecznego sygnału: szum termiczny (obecny zawsze, o gęstości ok. −174 dBm/Hz w temperaturze pokojowej), szum śrutowy w detektorach optycznych, zakłócenia impulsowe.</li>
<li><strong>Przesłuchy (crosstalk)</strong> — sprzężenie elektromagnetyczne pomiędzy sąsiednimi torami transmisyjnymi.</li>
<li><strong>Zniekształcenia (distortion)</strong> — zmiana kształtu impulsów spowodowana m.in. dyspersją (różna prędkość propagacji różnych składowych sygnału), odbiciami na niedopasowanych impedancjach czy propagacją wielodrogową.</li>
<li><strong>Interferencja</strong> — zakłócenia od zewnętrznych źródeł (silniki, lampy, inne sieci radiowe).</li>
</ol>
<p>Miarą jakości sygnału jest <strong>stosunek sygnału do szumu (SNR — Signal-to-Noise Ratio)</strong>:</p>
<div data-m=\"\\text{SNR}_{\\text{dB}} = 10 \\cdot \\log_{10}\\left(\\frac{P_{\\text{sygnału}}}{P_{\\text{szumu}}}\\right)\"></div>
<h3>1.5. Granice teoretyczne: Nyquist i Shannon</h3>
<p>Dwa klasyczne twierdzenia wyznaczają górne granice przepływności.</p>
<p><strong>Twierdzenie Nyquista</strong> dotyczy kanału bezszumowego o szerokości pasma <span data-m=\"B\"></span>. Maksymalna szybkość symbolowa (liczba zmian stanu sygnału na sekundę, w baudach) wynosi <span data-m=\"2B\"></span>. Jeśli każdy symbol może przyjąć <span data-m=\"M\"></span> różnych stanów, przepływność wynosi:</p>
<div data-m=\"C_{\\text{Nyquist}} = 2B \\cdot \\log_2 M\"></div>
<p><strong>Twierdzenie Shannona–Hartleya</strong> uwzględnia szum i podaje maksymalną przepływność, przy której można zachować dowolnie małe prawdopodobieństwo błędu:</p>
<div data-m=\"C_{\\text{Shannon}} = B \\cdot \\log_2\\!\\left(1 + \\text{SNR}\\right)\"></div>
<p>gdzie SNR jest podany jako stosunek liniowy (nie w dB).</p>
<p><em>Przykład 1.</em> Kanał telefoniczny ma <span data-m=\"B = 3100\"></span> Hz, a SNR wynosi 35 dB, czyli ok. 3162 razy. Stąd:</p>
<div data-m=\"C = 3100 \\cdot \\log_2(1 + 3162) \\approx 3100 \\cdot 11{,}63 \\approx 36 \\text{ kb/s}\"></div>
<p>Wynik dobrze wyjaśnia, dlaczego modemy analogowe (V.34) zatrzymały się na 33,6 kb/s.</p>
<p><em>Przykład 2.</em> Kanał Wi-Fi o szerokości 20 MHz przy SNR = 25 dB (ok. 316) ma teoretyczną pojemność:</p>
<div data-m=\"C = 20 \\cdot 10^6 \\cdot \\log_2(1 + 316) \\approx 20 \\cdot 10^6 \\cdot 8{,}31 \\approx 166 \\text{ Mb/s}\"></div>
<p>Twierdzenie Shannona jest fundamentem projektowania wszystkich systemów transmisyjnych: aby zwiększyć przepływność, można albo poszerzyć pasmo, albo poprawić SNR (a to oznacza m.in. wyższe modulacje wymagające czystszego sygnału), albo — jak w MIMO — zwielokrotnić liczbę równoległych kanałów.</p>
<h3>1.6. Kryteria wyboru medium transmisyjnego</h3>
<table>
<thead>
<tr>
<th>Kryterium</th>
<th>Skrętka miedziana</th>
<th>Światłowód wielomodowy</th>
<th>Światłowód jednomodowy</th>
<th>Fale radiowe</th>
</tr>
</thead>
<tbody>
<tr>
<td>Typowy zasięg bez regeneracji</td>
<td>do 100 m (Ethernet)</td>
<td>do ok. 550 m (do 10 Gb/s: 300–400 m)</td>
<td>od 10 km do ponad 80 km</td>
<td>od kilku m do kilkunastu km (zależnie od pasma i mocy)</td>
</tr>
<tr>
<td>Przepływność</td>
<td>do 10 Gb/s (kat. 6A), do 40 Gb/s (kat. 8, 30 m)</td>
<td>do 100 Gb/s i więcej</td>
<td>praktycznie bez ograniczeń (Tb/s w WDM)</td>
<td>do kilkunastu Gb/s (Wi-Fi 6/7), zależnie od pasma</td>
</tr>
<tr>
<td>Odporność na zakłócenia EMI</td>
<td>średnia (lepsza z ekranowaniem)</td>
<td>pełna</td>
<td>pełna</td>
<td>niska (współdzielone widmo)</td>
</tr>
<tr>
<td>Bezpieczeństwo (podsłuch)</td>
<td>średnie (możliwy podsłuch indukcyjny)</td>
<td>wysokie</td>
<td>wysokie</td>
<td>niskie (wymaga szyfrowania)</td>
</tr>
<tr>
<td>Koszt kabla</td>
<td>niski</td>
<td>średni</td>
<td>średni</td>
<td>brak kabla</td>
</tr>
<tr>
<td>Koszt zakończeń i instalacji</td>
<td>niski</td>
<td>wysoki</td>
<td>wysoki</td>
<td>niski (ale wymaga planowania radiowego)</td>
</tr>
<tr>
<td>Mobilność użytkownika</td>
<td>brak</td>
<td>brak</td>
<td>brak</td>
<td>pełna</td>
</tr>
<tr>
<td>Zasilanie przez medium</td>
<td>tak (PoE)</td>
<td>nie</td>
<td>nie</td>
<td>nie</td>
</tr>
</tbody>
</table>
<hr />
<h2>2. Skrętka miedziana</h2>
<h3>2.1. Budowa i zasada działania</h3>
<p><strong>Skrętka</strong> (ang. <em>twisted pair</em>) to kabel złożony z par przewodów miedzianych, z których każdy jest osobno izolowany, a przewody w każdej parze są ze sobą <strong>skręcone</strong>. Standardowy kabel sieciowy Ethernet zawiera <strong>cztery pary</strong> (osiem żył), o impedancji falowej <strong>100 Ω</strong> (tolerancja ±15 %), wykonanych zwykle z miedzi o przekroju 24 AWG (ok. 0,51 mm), a w kablach kategorii 6A i wyższych często 23 AWG.</p>
<p>Sens skręcania jest fizyczny. Sygnał w parze przesyła się <strong>różnicowo</strong>: na jednym przewodzie płynie sygnał dodatni, na drugim ujemny (odwrócony w fazie). Odbiornik interpretuje <strong>różnicę</strong> napięć między przewodami, a nie napięcie względem masy. Zewnętrzne zakłócenie elektromagnetyczne indukuje w obu przewodach prawie identyczne napięcie (tzw. zakłócenie współbieżne, common-mode). Ponieważ oba przewody są zakłócone niemal jednakowo, różnica napięć pozostaje praktycznie niezmieniona — zakłócenie zostaje „odjęte\". Skręcenie zapewnia, że oba przewody znajdują się średnio w tym samym miejscu względem źródła zakłóceń, co poprawia to podobieństwo.</p>
<p>Skręcenie pełni również drugą funkcję: ogranicza <strong>przesłuchy</strong> pomiędzy parami. Dlatego w jednym kablu poszczególne pary mają <strong>różne skoki skrętu</strong> (liczbę skrętów na jednostkę długości — typowo kilka na centymetr), tak aby sąsiednie pary nie sprzęgały się rezonansowo.</p>
<p>Jakość skręcenia jest krytyczna: rozkręcenie pary na zakończeniu (np. w gnieździe) o więcej niż ok. 13 mm w kategorii 5e (mniej w wyższych) istotnie pogarsza parametry łącza. Dlatego instalatorzy pilnują, aby przy zarabianiu wtyku rozkręcać pary jak najkrócej.</p>
<p>Przewody mogą być <strong>drut</strong> (jeden pełny przewód, sztywny — do instalacji stałej, tzw. okablowanie poziome) lub <strong>linka</strong> (splot wielu cienkich drucików, elastyczny — do przewodów krosowych, tzw. patchcordów). Linka ma większe tłumienie, dlatego długość patchcordów jest limitowana.</p>
<h3>2.2. Rodzaje ekranowania</h3>
<p>Norma ISO/IEC 11801 stosuje oznaczenie w postaci <strong>XX/YTP</strong>, gdzie XX oznacza ekran całego kabla, a Y ekran poszczególnych par:</p>
<table>
<thead>
<tr>
<th>Oznaczenie</th>
<th>Ekran zbiorczy</th>
<th>Ekran par</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>U/UTP</strong></td>
<td>brak</td>
<td>brak</td>
<td>okablowanie biurowe, domowe (tzw. UTP)</td>
</tr>
<tr>
<td><strong>F/UTP</strong></td>
<td>folia</td>
<td>brak</td>
<td>biura ze średnim poziomem zakłóceń (tzw. FTP)</td>
</tr>
<tr>
<td><strong>S/UTP</strong></td>
<td>oplot</td>
<td>brak</td>
<td>rzadziej stosowany</td>
</tr>
<tr>
<td><strong>SF/UTP</strong></td>
<td>oplot + folia</td>
<td>brak</td>
<td>środowiska o podwyższonych zakłóceniach</td>
</tr>
<tr>
<td><strong>U/FTP</strong></td>
<td>brak</td>
<td>folia na każdej parze</td>
<td>kat. 6A, kat. 7 — redukcja przesłuchów</td>
</tr>
<tr>
<td><strong>F/FTP</strong></td>
<td>folia</td>
<td>folia na każdej parze</td>
<td>kat. 6A i wyższe</td>
</tr>
<tr>
<td><strong>S/FTP</strong></td>
<td>oplot</td>
<td>folia na każdej parze</td>
<td>kat. 7, 7A, 8 (tzw. STP/PiMF)</td>
</tr>
</tbody>
</table>
<p>Ekranowanie poprawia odporność na zakłócenia zewnętrzne i zmniejsza przesłuchy, ale ma warunek: <strong>ekran musi być prawidłowo uziemiony</strong> (zwykle przez gniazda i panele krosowe z metalową obudową). Nieuziemiony lub uziemiony w wielu punktach o różnych potencjałach ekran może stać się anteną i pogorszyć sytuację, a prądy wyrównawcze płynące po ekranie mogą stanowić zagrożenie dla urządzeń.</p>
<h3>2.3. Kategorie okablowania</h3>
<p>Kategorie (ang. <em>categories</em>, skrót Cat) określone w normach TIA/EIA-568 oraz odpowiadające im klasy (Class) w ISO/IEC 11801 definiują maksymalną częstotliwość, w której kabel zachowuje wymagane parametry:</p>
<table>
<thead>
<tr>
<th>Kategoria</th>
<th>Klasa ISO</th>
<th>Pasmo (MHz)</th>
<th>Typowe zastosowanie</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>Cat 3</td>
<td>C</td>
<td>16</td>
<td>10BASE-T, telefonia</td>
<td>przestarzała</td>
</tr>
<tr>
<td>Cat 5</td>
<td>—</td>
<td>100</td>
<td>100BASE-TX</td>
<td>zastąpiona przez 5e</td>
</tr>
<tr>
<td><strong>Cat 5e</strong></td>
<td>D</td>
<td>100</td>
<td>1000BASE-T, 2,5GBASE-T</td>
<td>wciąż powszechna w instalacjach domowych</td>
</tr>
<tr>
<td><strong>Cat 6</strong></td>
<td>E</td>
<td>250</td>
<td>1000BASE-T, 10GBASE-T do 55 m</td>
<td></td>
</tr>
<tr>
<td><strong>Cat 6A</strong></td>
<td>EA</td>
<td>500</td>
<td>10GBASE-T do 100 m</td>
<td>standard dla nowych instalacji biurowych</td>
</tr>
<tr>
<td>Cat 7</td>
<td>F</td>
<td>600</td>
<td>10GBASE-T</td>
<td>tylko ekranowana, nietypowe złącze GG45/TERA</td>
</tr>
<tr>
<td>Cat 7A</td>
<td>FA</td>
<td>1000</td>
<td>10GBASE-T, telewizja kablowa w jednym kablu</td>
<td></td>
</tr>
<tr>
<td><strong>Cat 8 (8.1/8.2)</strong></td>
<td>I / II</td>
<td>2000</td>
<td>25GBASE-T, 40GBASE-T do 30 m</td>
<td>dla centrów danych</td>
</tr>
</tbody>
</table>
<p>Warto zapamiętać, że <strong>kategoria dotyczy kabla i całego toru</strong> (kabel, gniazda, krosownice, patchcordy). Zastosowanie kabla Cat 6A z gniazdami Cat 5e daje tor o parametrach Cat 5e — tor jest tak dobry, jak jego najsłabszy element.</p>
<h3>2.4. Złącze RJ-45 i układ żył</h3>
<p>Standardowym złączem dla skrętki jest <strong>RJ-45</strong> (formalnie 8P8C — osiem pozycji, osiem styków). Kolejność żył w złączu określają dwa układy z normy TIA/EIA-568: <strong>T568A</strong> i <strong>T568B</strong>. Różnią się one zamianą miejscami par zielonej i pomarańczowej. W Polsce i na świecie dominuje układ <strong>T568B</strong>, choć oba są równoważne technicznie. Ważne jest wyłącznie, aby <strong>na obu końcach kabla stosować ten sam układ</strong> (kabel prosty) albo odpowiednio różny (kabel skrosowany).</p>
<p><img alt=\"Układ żył w złączu RJ-45 — T568B i T568A oraz funkcje styków w 10/100BASE-TX i 1000BASE-T\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/skretka-rj45-t568.svg\" /></p>
<p>W Ethernecie 10/100 Mb/s wykorzystywane są tylko dwie pary: <strong>styki 1 i 2</strong> (nadawanie, TX) oraz <strong>styki 3 i 6</strong> (odbiór, RX). Para 4–5 i para 7–8 pozostają niewykorzystane (mogą być użyte do zasilania PoE lub telefonii). W Gigabit Ethernet i szybszych wykorzystywane są wszystkie cztery pary, a każda para przenosi dane w obu kierunkach jednocześnie (dzięki układom hybrydowym i kasowaniu echa).</p>
<h3>2.5. Kabel prosty i skrosowany, Auto-MDI/MDIX</h3>
<p>Dawniej rozróżniano dwa typy urządzeń: <strong>MDI</strong> (np. karta sieciowa komputera, która nadaje na stykach 1–2) i <strong>MDI-X</strong> (np. port koncentratora lub przełącznika, który odbiera na stykach 1–2). Połączenie urządzeń różnych typów wymagało <strong>kabla prostego</strong>, a tych samych typów (komputer–komputer, przełącznik–przełącznik) — <strong>kabla skrosowanego</strong> (crossover), w którym pary TX i RX są zamienione (jeden koniec T568A, drugi T568B).</p>
<p>Współczesne porty Gigabit Ethernet obsługują funkcję <strong>Auto-MDI/MDIX</strong>, w której port sam wykrywa i koryguje niewłaściwe skrosowanie. W praktyce kabla skrosowanego już się nie używa, choć warto znać zasadę.</p>
<h3>2.6. Kodowanie liniowe i standardy Ethernet po skrętce</h3>
<p>Bity muszą zostać zamienione na sygnał elektryczny. Prosty zapis „1 = wysokie napięcie, 0 = niskie\" ma poważne wady: przy długich seriach jednakowych bitów odbiornik traci synchronizację, a widmo sygnału zawiera składową stałą. Dlatego stosuje się <strong>kodowanie liniowe</strong>:</p>
<ul>
<li><strong>Manchester (10BASE-T)</strong> — każdy bit reprezentowany jest przejściem napięcia w środku okresu bitu (w IEEE 802.3: 0 → przejście z wysokiego na niskie, 1 → z niskiego na wysokie). Zawsze jest przejście, więc odbiornik odzyskuje zegar, ale kosztem podwojenia szybkości symbolowej (10 Mb/s wymaga 20 Mbaud).</li>
<li><strong>4B5B + MLT-3 (100BASE-TX)</strong> — cztery bity danych zamieniane są na pięć bitów kodu (nadmiarowość zapewnia częste przejścia), a następnie kodowane trzema poziomami napięcia (−1, 0, +1) w sposób cykliczny. Szybkość symbolowa: 125 Mbaud dla 100 Mb/s. MLT-3 zmniejsza maksymalną częstotliwość sygnału do ok. 31,25 MHz.</li>
<li><strong>PAM-5 (1000BASE-T)</strong> — modulacja amplitudy impulsów z pięcioma poziomami napięcia (−2, −1, 0, +1, +2). Każdą z czterech par wykorzystuje się jednocześnie w obu kierunkach z szybkością symbolową 125 Mbaud, przy czym pojedynczy symbol niesie dwa bity danych (piąty poziom służy korekcji błędów kodowaniem kratowym), co daje 4 pary × 125 Mbaud × 2 bity = 1000 Mb/s.</li>
<li><strong>PAM-16 (10GBASE-T, 2,5/5GBASE-T)</strong> — szesnaście poziomów napięcia, z wykorzystaniem zaawansowanego kodowania (LDPC) i rozszerzonego pasma. Wymaga kabli o pasmie do 500 MHz (kat. 6A).</li>
</ul>
<table>
<thead>
<tr>
<th>Standard</th>
<th>IEEE</th>
<th>Przepływność</th>
<th>Pary</th>
<th>Kodowanie</th>
<th>Minimalna kategoria</th>
<th>Maks. długość</th>
</tr>
</thead>
<tbody>
<tr>
<td>10BASE-T</td>
<td>802.3i (1990)</td>
<td>10 Mb/s</td>
<td>2</td>
<td>Manchester</td>
<td>Cat 3</td>
<td>100 m</td>
</tr>
<tr>
<td>100BASE-TX</td>
<td>802.3u (1995)</td>
<td>100 Mb/s</td>
<td>2</td>
<td>4B5B + MLT-3</td>
<td>Cat 5</td>
<td>100 m</td>
</tr>
<tr>
<td>1000BASE-T</td>
<td>802.3ab (1999)</td>
<td>1 Gb/s</td>
<td>4</td>
<td>PAM-5</td>
<td>Cat 5e</td>
<td>100 m</td>
</tr>
<tr>
<td>2,5GBASE-T / 5GBASE-T</td>
<td>802.3bz (2016)</td>
<td>2,5 / 5 Gb/s</td>
<td>4</td>
<td>PAM-16</td>
<td>Cat 5e / Cat 6</td>
<td>100 m</td>
</tr>
<tr>
<td>10GBASE-T</td>
<td>802.3an (2006)</td>
<td>10 Gb/s</td>
<td>4</td>
<td>PAM-16</td>
<td>Cat 6 (55 m) / Cat 6A (100 m)</td>
<td>55–100 m</td>
</tr>
<tr>
<td>25GBASE-T / 40GBASE-T</td>
<td>802.3bq (2016)</td>
<td>25 / 40 Gb/s</td>
<td>4</td>
<td>PAM-16</td>
<td>Cat 8</td>
<td>30 m</td>
</tr>
</tbody>
</table>
<h3>2.7. Parametry transmisyjne toru miedzianego</h3>
<p>Certyfikacja okablowania (pomiary miernikiem, np. testerem klasy Level IV) obejmuje kilka podstawowych parametrów:</p>
<ul>
<li><strong>Tłumienie (Insertion Loss, IL)</strong> — spadek mocy sygnału na całej długości toru w funkcji częstotliwości; rośnie z częstotliwością i długością. Dla kabla Cat 5e przy 100 MHz nie powinno przekraczać ok. 22 dB na 100 m.</li>
<li><strong>NEXT (Near-End Crosstalk)</strong> — przesłuch zbliżny, mierzony po tej samej stronie, po której dołączony jest nadajnik zakłócający; jest najgroźniejszy, bo zakłócenie pochodzi od silnego sygnału z bliskiego końca. Im wyższa wartość NEXT (w dB), tym lepiej.</li>
<li><strong>FEXT / ACR-F (Far-End Crosstalk)</strong> — przesłuch zdalny, mierzony po przeciwnej stronie łącza; ACR-F to FEXT skorygowany o tłumienie.</li>
<li><strong>PSNEXT / PSACR-F</strong> — sumaryczne (Power Sum) przesłuchy pochodzące od wszystkich pozostałych par jednocześnie, istotne przy transmisji na czterech parach (Gigabit).</li>
<li><strong>ACR (Attenuation-to-Crosstalk Ratio)</strong> — różnica między tłumieniem a przesłuchem, miara „zapasu\" sygnału nad zakłóceniem własnym kabla.</li>
<li><strong>Return Loss (RL, tłumienie odbicia)</strong> — miara, jak dobrze impedancja toru jest dopasowana do 100 Ω; odbicia od niedopasowań (np. źle zarobione złącza) interferują z sygnałem podstawowym, szczególnie w transmisji dwukierunkowej.</li>
<li><strong>Delay Skew</strong> — różnica czasów propagacji między najszybszą a najwolniejszą parą; istotna w transmisjach wielotorowych (limit ok. 50 ns).</li>
<li><strong>Alien Crosstalk (AXT)</strong> — przesłuchy od sąsiednich kabli; istotny w 10GBASE-T, stąd zalecenie stosowania kabli Cat 6A o zwiększonej średnicy lub ekranowanych.</li>
</ul>
<h3>2.8. Okablowanie strukturalne</h3>
<p>W budynkach kabel skrętkowy instaluje się zgodnie z zasadami <strong>okablowania strukturalnego</strong> (normy ISO/IEC 11801, EN 50173, TIA-568). Charakteryzuje się ono hierarchiczną, gwiaździstą topologią:</p>
<ul>
<li><strong>Okablowanie poziome</strong> (horizontal cabling) — od gniazda abonenckiego (w miejscu pracy) do punktu rozdzielczego piętra. Maksymalna długość <strong>stałego łącza (permanent link) wynosi 90 m</strong>.</li>
<li><strong>Patchcordy</strong> — po 5 m po każdej stronie: łącznie <strong>kanał (channel) nie przekracza 100 m</strong> (90 m + 10 m przewodów krosowych, przy czym limity zależą od użycia linki).</li>
<li><strong>Okablowanie pionowe (szkieletowe, backbone)</strong> — łączy punkty rozdzielcze pięter i główny punkt rozdzielczy budynku; dziś zwykle światłowodowe.</li>
<li><strong>Okablowanie międzybudynkowe (campus)</strong> — łączy budynki; niemal wyłącznie światłowodowe (odporność na przepięcia, wyrównanie potencjałów).</li>
</ul>
<p>Zasada 100 m wynika z tłumienia, przesłuchów oraz — w dawnych sieciach półdupleksowych — z ograniczeń czasowych mechanizmu CSMA/CD. Dłuższe odcinki wymagają regeneratora, przełącznika pośredniego lub konwertera na światłowód.</p>
<h3>2.9. Zasilanie przez skrętkę — Power over Ethernet</h3>
<p>Technologia <strong>PoE (Power over Ethernet)</strong> pozwala na przesyłanie zasilania równolegle z danymi po tym samym kablu. Źródło (PSE — Power Sourcing Equipment, np. przełącznik) dostarcza napięcie stałe ok. 44–57 V, które odbiera urządzenie zasilane (PD — Powered Device), np. punkt dostępowy Wi-Fi, kamera IP czy telefon VoIP.</p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Nazwa potoczna</th>
<th>Moc na porcie PSE</th>
<th>Moc dostępna dla PD</th>
<th>Liczba par</th>
</tr>
</thead>
<tbody>
<tr>
<td>IEEE 802.3af (2003)</td>
<td>PoE (Type 1)</td>
<td>15,4 W</td>
<td>12,95 W</td>
<td>2</td>
</tr>
<tr>
<td>IEEE 802.3at (2009)</td>
<td>PoE+ (Type 2)</td>
<td>30 W</td>
<td>25,5 W</td>
<td>2</td>
</tr>
<tr>
<td>IEEE 802.3bt (2018)</td>
<td>PoE++ (Type 3)</td>
<td>60 W</td>
<td>51 W</td>
<td>4</td>
</tr>
<tr>
<td>IEEE 802.3bt (2018)</td>
<td>PoE++ (Type 4)</td>
<td>90 W</td>
<td>71,3 W</td>
<td>4</td>
</tr>
</tbody>
</table>
<p>Przed włączeniem zasilania PSE przeprowadza <strong>detekcję</strong> (sprawdza, czy do portu dołączono urządzenie zgodne z PoE, mierząc rezystancję sygnaturową ok. 25 kΩ) oraz <strong>klasyfikację</strong> mocy. Dzięki temu zwykłe urządzenie bez PoE nie zostanie uszkodzone. Wraz ze wzrostem mocy rośnie nagrzewanie się kabli w wiązkach, dlatego przy PoE++ zaleca się kable Cat 6A o przewodach o większym przekroju.</p>
<h3>2.10. Kabel koncentryczny — uwagi uzupełniające</h3>
<p>Kabel koncentryczny składa się z przewodu wewnętrznego (miedzianego), dielektryka, ekranu (oplotu i/lub folii) oraz osłony zewnętrznej. Ekran otacza żyłę współosiowo, co zapewnia dobrą odporność na zakłócenia i niską tłumienność. W sieciach komputerowych dawał początek Ethernetowi (10BASE5 — gruby koncentryk RG-8, 500 m; 10BASE2 — cienki koncentryk RG-58, 185 m; oba o impedancji 50 Ω), lecz został wyparty przez skrętkę. Kabel koncentryczny o impedancji 75 Ω pozostaje szeroko stosowany w <strong>telewizji kablowej i sieciach HFC</strong> (dostęp DOCSIS, omówiony w rozdziale 6), w instalacjach antenowych oraz w połączeniach o dużych częstotliwościach.</p>
<h3>2.11. Zalety i ograniczenia skrętki</h3>
<p><strong>Zalety:</strong> niski koszt kabla i osprzętu, łatwość instalacji i zakańczania, możliwość zasilania urządzeń (PoE), dojrzała infrastruktura i szeroka dostępność sprzętu, wsteczna zgodność standardów Ethernet.</p>
<p><strong>Ograniczenia:</strong> ograniczony zasięg (100 m), wrażliwość na zakłócenia elektromagnetyczne (zwłaszcza kable nieekranowane w pobliżu silników i kabli energetycznych), tłumienie rosnące z częstotliwością, możliwość podsłuchu przez sprzężenie indukcyjne, ograniczona przepływność w porównaniu z włóknem optycznym oraz przewodzenie prądu (ryzyko wyrównawcze i przepięcia — nieodpowiednie między budynkami).</p>
<hr />
<h2>3. Światłowody</h2>
<h3>3.1. Zasada działania — całkowite wewnętrzne odbicie</h3>
<p><strong>Światłowód</strong> (włókno optyczne) przesyła informację w postaci impulsów światła (najczęściej podczerwonego, o długościach fali 850, 1310 lub 1550 nm), które są prowadzone wewnątrz cienkiego włókna szklanego (rzadziej plastikowego) dzięki zjawisku <strong>całkowitego wewnętrznego odbicia</strong>.</p>
<p>Zjawisko to wynika z prawa Snelliusa. Gdy światło przechodzi z ośrodka o współczynniku załamania <span data-m=\"n_1\"></span> do ośrodka o współczynniku <span data-m=\"n_2\"></span>, kąty (mierzone względem normalnej do powierzchni granicznej) spełniają zależność:</p>
<div data-m=\"n_1 \\sin\\theta_1 = n_2 \\sin\\theta_2\"></div>
<p>Jeśli <span data-m=\"n_1 &gt; n_2\"></span>, to przy dostatecznie dużym kącie padania promień nie przechodzi do drugiego ośrodka, lecz odbija się w całości. Kąt graniczny (krytyczny) wynosi:</p>
<div data-m=\"\\theta_c = \\arcsin\\!\\left(\\frac{n_2}{n_1}\\right)\"></div>
<p>Włókno zbudowane jest więc z <strong>rdzenia</strong> o wyższym współczynniku załamania i otaczającego go <strong>płaszcza</strong> o niższym współczynniku. Światło wprowadzone do rdzenia pod odpowiednio małym kątem względem osi odbija się od granicy rdzeń–płaszcz i wędruje wzdłuż włókna, prawie bez strat na odbiciach.</p>
<p><em>Przykład liczbowy.</em> Dla rdzenia o <span data-m=\"n_1 = 1{,}48\"></span> i płaszcza o <span data-m=\"n_2 = 1{,}46\"></span>:</p>
<ul>
<li>kąt graniczny: <span data-m=\"\\theta_c = \\arcsin(1{,}46 / 1{,}48) \\approx 80{,}6^\\circ\"></span> (względem normalnej), czyli promienie biegnące pod kątem mniejszym niż ok. 9,4° względem osi włókna są prowadzone;</li>
<li><strong>apertura numeryczna</strong>: <span data-m=\"NA = \\sqrt{n_1^2 - n_2^2} = \\sqrt{2{,}1904 - 2{,}1316} \\approx 0{,}24\"></span>;</li>
<li><strong>kąt akceptacji</strong> (maksymalny kąt wprowadzenia światła z powietrza): <span data-m=\"\\theta_{max} = \\arcsin(NA) \\approx 14^\\circ\"></span>.</li>
</ul>
<p>Różnica współczynników załamania jest bardzo mała (rzędu 1 %), co jest typowe dla włókien telekomunikacyjnych.</p>
<h3>3.2. Budowa włókna i kabla</h3>
<p><img alt=\"Budowa włókna światłowodowego oraz propagacja światła we włóknie wielomodowym skokowym, gradientowym i jednomodowym\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/swiatlowod-budowa-i-propagacja.svg\" /></p>
<p>Włókno składa się z trzech warstw:</p>
<ol>
<li><strong>Rdzeń (core)</strong> — obszar, w którym rozchodzi się światło; ze szkła kwarcowego (SiO₂) domieszkowanego np. germanem, aby podnieść współczynnik załamania. Średnica: ok. <strong>9 µm</strong> (jednomodowe) lub <strong>50 / 62,5 µm</strong> (wielomodowe).</li>
<li><strong>Płaszcz (cladding)</strong> — szkło o niższym współczynniku załamania; średnica standardowo <strong>125 µm</strong>.</li>
<li><strong>Powłoka pierwotna (coating)</strong> — lakier akrylowy o średnicy ok. 250 µm chroniący przed uszkodzeniami mechanicznymi i wilgocią.</li>
</ol>
<p>Kabel światłowodowy dodatkowo zawiera <strong>elementy wzmacniające</strong> (nici aramidowe, pręty z włókna szklanego, rzadziej stalowe), <strong>tuby lub bufor ścisły</strong> oraz <strong>osłonę zewnętrzną</strong> (PVC, LSZH — bezhalogenowa niskodymna, PE do instalacji zewnętrznych, często z żelem lub taśmą blokującą wodę). Ponieważ światłowód nie przewodzi prądu, nie wymaga uziemienia i może być prowadzony w pobliżu linii wysokiego napięcia, jednak przewodzące elementy wzmacniające (np. stalowe) wymagają uwagi.</p>
<h3>3.3. Tryby propagacji</h3>
<p>Rozchodzenie się światła we włóknie można opisać jako superpozycję <strong>modów</strong> — dozwolonych rozkładów pola elektromagnetycznego. Liczba modów zależy od średnicy rdzenia, apertury numerycznej i długości fali. Parametrem opisującym to jest tzw. częstotliwość znormalizowana:</p>
<div data-m=\"V = \\frac{2\\pi a}{\\lambda}\\, NA\"></div>
<p>gdzie <span data-m=\"a\"></span> jest promieniem rdzenia. Włókno prowadzi tylko jeden mod (jest jednomodowe), gdy <span data-m=\"V &lt; 2{,}405\"></span>.</p>
<p><strong>Włókno wielomodowe skokowe (MMF step-index).</strong> Rdzeń o jednolitym współczynniku załamania. Promienie biegnące pod różnymi kątami pokonują różne drogi geometryczne, przez co impuls świetlny „rozmywa się\" w czasie (dyspersja modowa). Obecnie prawie nie stosowane w telekomunikacji.</p>
<p><strong>Włókno wielomodowe gradientowe (MMF graded-index).</strong> Współczynnik załamania maleje płynnie od osi rdzenia do jego brzegu. Promienie odbiegające od osi wędrują dłuższą drogę, lecz przez obszary o niższym współczynniku załamania (a więc z większą prędkością), co w dużej mierze <strong>wyrównuje czasy propagacji</strong>. Tego typu jest współczesne włókno wielomodowe (OM1–OM5).</p>
<p><strong>Włókno jednomodowe (SMF).</strong> Rdzeń o średnicy ok. 9 µm prowadzi tylko jeden mod (dla długości fali powyżej tzw. długości fali odcięcia, ≤ 1260 nm w zaleceniu ITU-T G.652). Brak dyspersji modowej daje największe zasięgi i przepływności.</p>
<h3>3.4. Okna transmisyjne i tłumienie</h3>
<p>Tłumienie światłowodu zależy od długości fali. Głównymi mechanizmami strat są: <strong>rozpraszanie Rayleigha</strong> (maleje z czwartą potęgą długości fali, dlatego dłuższe fale są tłumione słabiej), <strong>absorpcja</strong> przez jony hydroksylowe OH⁻ (charakterystyczny pik „wodny\" w okolicy 1383 nm) oraz absorpcja w podczerwieni powyżej ok. 1600 nm. Powstają <strong>okna transmisyjne</strong>, w których tłumienie jest minimalne:</p>
<table>
<thead>
<tr>
<th>Okno</th>
<th>Długość fali</th>
<th>Typowe tłumienie</th>
<th>Zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td>I</td>
<td>850 nm</td>
<td>ok. 2,5–3 dB/km (MMF)</td>
<td>krótkie łącza wielomodowe, tanie źródła (VCSEL)</td>
</tr>
<tr>
<td>II (pasmo O)</td>
<td>1310 nm</td>
<td>ok. 0,35 dB/km (SMF), ok. 1 dB/km (MMF)</td>
<td>łącza jednomodowe średniego zasięgu, punkt zerowej dyspersji</td>
</tr>
<tr>
<td>III (pasmo C)</td>
<td>1550 nm</td>
<td>ok. 0,2 dB/km (SMF)</td>
<td>łącza dalekiego zasięgu, WDM/DWDM, wzmacniacze EDFA</td>
</tr>
</tbody>
</table>
<p>Pasma telekomunikacyjne oznacza się literami: <strong>O</strong> (1260–1360 nm), <strong>E</strong> (1360–1460), <strong>S</strong> (1460–1530), <strong>C</strong> (1530–1565), <strong>L</strong> (1565–1625) i <strong>U</strong> (1625–1675 nm).</p>
<h3>3.5. Dyspersja</h3>
<p><strong>Dyspersja</strong> to zjawisko poszerzania impulsów świetlnych w trakcie propagacji, które ogranicza maksymalną przepływność i zasięg. Wyróżnia się:</p>
<ul>
<li><strong>dyspersję modową</strong> — różne mody docierają do końca włókna w różnym czasie (tylko MMF); miarą jest tzw. iloczyn pasma i długości (MHz·km);</li>
<li><strong>dyspersję chromatyczną</strong> — różne długości fali biegną z różną prędkością (materiałowa + falowodowa); w SMF wyrażana w ps/(nm·km), wynosi w przybliżeniu 0 przy 1310 nm i ok. 17 ps/(nm·km) przy 1550 nm; kompensuje się ją specjalnymi włóknami lub przetwarzaniem sygnału po stronie odbiorczej;</li>
<li><strong>dyspersję polaryzacyjną (PMD)</strong> — różne polaryzacje światła rozchodzą się z nieco różnymi prędkościami; istotna przy przepływnościach ≥ 10 Gb/s na długich łączach.</li>
</ul>
<h3>3.6. Klasy włókien</h3>
<table>
<thead>
<tr>
<th>Klasa</th>
<th>Typ</th>
<th>Rdzeń / płaszcz</th>
<th>Iloczyn pasma i długości przy 850 nm</th>
<th>Kolor typowej osłony</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td>OM1</td>
<td>wielomodowe</td>
<td>62,5/125 µm</td>
<td>200 MHz·km</td>
<td>pomarańczowy</td>
<td>starsze instalacje</td>
</tr>
<tr>
<td>OM2</td>
<td>wielomodowe</td>
<td>50/125 µm</td>
<td>500 MHz·km</td>
<td>pomarańczowy</td>
<td>1 Gb/s, starsze 10 Gb/s do 82 m</td>
</tr>
<tr>
<td>OM3</td>
<td>wielomodowe, zoptymalizowane pod laser</td>
<td>50/125 µm</td>
<td>2000 MHz·km (EMB)</td>
<td>niebieskozielony (aqua)</td>
<td>10 Gb/s do 300 m, 40/100 Gb/s do 100 m</td>
</tr>
<tr>
<td>OM4</td>
<td>wielomodowe, zoptymalizowane pod laser</td>
<td>50/125 µm</td>
<td>4700 MHz·km (EMB)</td>
<td>aqua (lub „erika violet\")</td>
<td>10 Gb/s do 400 m, 40/100 Gb/s do 150 m</td>
</tr>
<tr>
<td>OM5</td>
<td>wielomodowe, szerokopasmowe (WBMMF)</td>
<td>50/125 µm</td>
<td>4700 MHz·km + pasmo do 953 nm</td>
<td>limonkowy</td>
<td>SWDM, zwiększona przepływność na jedną parę włókien</td>
</tr>
<tr>
<td>OS1 / OS2</td>
<td>jednomodowe (G.652.D)</td>
<td>9/125 µm</td>
<td>—</td>
<td>żółty</td>
<td>od kilkuset metrów do setek kilometrów</td>
</tr>
</tbody>
</table>
<p>W nazwach OM (Optical Multimode) i OS (Optical Single-mode) definiowanych w ISO/IEC 11801.</p>
<h3>3.7. Źródła i detektory światła</h3>
<p><strong>Nadajniki optyczne:</strong></p>
<ul>
<li><strong>LED</strong> — prosty, tani, o szerokim widmie i niskiej mocy; do łączy wielomodowych o niskiej przepływności (np. dawny 100BASE-FX).</li>
<li><strong>VCSEL</strong> (laser z pionową wnęką rezonansową) — tani laser o emisji z powierzchni, 850 nm, stosowany w wielomodowych łączach 1–100 Gb/s.</li>
<li><strong>Laser Fabry–Perota</strong> i <strong>DFB</strong> (z rozłożonym sprzężeniem zwrotnym) — lasery o wąskim widmie, 1310/1550 nm; podstawa łączy jednomodowych dalekiego zasięgu i WDM.</li>
</ul>
<p><strong>Odbiorniki (detektory):</strong></p>
<ul>
<li><strong>Fotodioda PIN</strong> — prosta, tania, stosowana w większości łączy;</li>
<li><strong>Fotodioda lawinowa (APD)</strong> — wewnętrzne wzmocnienie prądu dzięki powielaniu lawinowemu; zwiększa czułość o kilka dB, kosztem szumu i wyższego napięcia zasilającego; stosowana w łączach dalekiego zasięgu i w PON.</li>
</ul>
<h3>3.8. Standardy Ethernet po światłowodzie</h3>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Długość fali</th>
<th>Włókno</th>
<th>Typowy zasięg</th>
</tr>
</thead>
<tbody>
<tr>
<td>100BASE-FX</td>
<td>1300 nm</td>
<td>MMF</td>
<td>2 km</td>
</tr>
<tr>
<td>1000BASE-SX</td>
<td>850 nm</td>
<td>MMF</td>
<td>do 550 m</td>
</tr>
<tr>
<td>1000BASE-LX</td>
<td>1310 nm</td>
<td>SMF (także MMF)</td>
<td>5 km (SMF)</td>
</tr>
<tr>
<td>10GBASE-SR</td>
<td>850 nm</td>
<td>MMF OM3/OM4</td>
<td>300 m / 400 m</td>
</tr>
<tr>
<td>10GBASE-LR</td>
<td>1310 nm</td>
<td>SMF</td>
<td>10 km</td>
</tr>
<tr>
<td>10GBASE-ER</td>
<td>1550 nm</td>
<td>SMF</td>
<td>40 km</td>
</tr>
<tr>
<td>40GBASE-SR4</td>
<td>850 nm, 4 tory równoległe (8 włókien)</td>
<td>MMF OM3/OM4</td>
<td>100 m / 150 m</td>
</tr>
<tr>
<td>100GBASE-SR4</td>
<td>850 nm, 4 tory równoległe</td>
<td>MMF OM4</td>
<td>100 m</td>
</tr>
<tr>
<td>100GBASE-LR4</td>
<td>ok. 1310 nm, 4 długości fali (WDM)</td>
<td>SMF</td>
<td>10 km</td>
</tr>
</tbody>
</table>
<p>Oznaczenia literowe: <strong>S</strong> (short — 850 nm), <strong>L</strong> (long — 1310 nm), <strong>E</strong> (extended — 1550 nm), <strong>R</strong> — kodowanie 64B/66B, cyfra na końcu (np. 4) — liczba torów lub długości fali.</p>
<h3>3.9. Złącza, polerowanie i łączenie włókien</h3>
<p><strong>Złącza</strong> światłowodowe różnią się kształtem i sposobem mocowania:</p>
<ul>
<li><strong>SC</strong> — kwadratowe, zatrzaskowe (push-pull), popularne w sieciach telekomunikacyjnych;</li>
<li><strong>LC</strong> — zminiaturyzowane (ferrula 1,25 mm), stosowane w modułach SFP; najpopularniejsze w sieciach LAN i centrach danych;</li>
<li><strong>ST</strong> — okrągłe, bagnetowe, starsze instalacje wielomodowe;</li>
<li><strong>FC</strong> — gwintowane, do pomiarów i zastosowań specjalnych;</li>
<li><strong>MPO/MTP</strong> — wielowłóknowe (12, 16, 24 włókna), dla łączy 40/100 Gb/s i kabli trunkowych.</li>
</ul>
<p><strong>Polerowanie końcówki</strong> (ferruli) wpływa na <strong>tłumienie odbicia</strong>. Złącza <strong>UPC</strong> (Ultra Physical Contact, zwykle niebieskie) mają powierzchnię wypolerowaną płasko wypukło, natomiast <strong>APC</strong> (Angled Physical Contact, zielone) — pod kątem 8°, co kieruje odbite światło poza rdzeń i zapewnia lepszą tłumienność odbicia (rzędu 60 dB i więcej). APC jest wymagane w sieciach PON i przy przesyłaniu sygnałów wideo analogowych; nie wolno łączyć złączy UPC z APC (uszkodzenie i duże straty).</p>
<p><strong>Łączenie włókien:</strong></p>
<ul>
<li><strong>spawanie fuzyjne</strong> — włókna są stapiane łukiem elektrycznym; tłumienność spawu wynosi zwykle 0,02–0,1 dB, jest to metoda trwała i najlepsza jakościowo;</li>
<li><strong>łączenie mechaniczne</strong> — włókna są zestawiane w prowadnicy z żelem dopasowującym; niższy koszt sprzętu, straty rzędu 0,2–0,5 dB.</li>
</ul>
<p>Największym wrogiem światłowodowego złącza jest <strong>zabrudzenie</strong>: pył lub ślad palca na powierzchni ferruli mogą powodować tłumienie i uszkodzenie. Standardem pracy jest inspekcja mikroskopowa i czyszczenie przed każdym połączeniem.</p>
<h3>3.10. Bilans mocy łącza (link budget)</h3>
<p>Poprawność projektu łącza sprawdza się, porównując <strong>budżet mocy</strong> transceiverów z <strong>sumą strat</strong> w torze.</p>
<div data-m=\"\\text{Budżet} = P_{Tx} - S_{Rx} \\qquad\\qquad \\text{Straty} = \\alpha \\cdot L + N_{\\text{spawów}} \\cdot A_s + N_{\\text{złączy}} \\cdot A_z + M\"></div>
<p>gdzie <span data-m=\"P_{Tx}\"></span> to moc nadajnika (dBm), <span data-m=\"S_{Rx}\"></span> — czułość odbiornika (dBm), <span data-m=\"\\alpha\"></span> — tłumienność jednostkowa włókna (dB/km), <span data-m=\"L\"></span> — długość, <span data-m=\"A_s\"></span> i <span data-m=\"A_z\"></span> — tłumienność spawu i pary złączy, a <span data-m=\"M\"></span> — zapas (margines) na starzenie i naprawy (zwykle 2–3 dB).</p>
<p><em>Przykład.</em> Transceiver o mocy nadawczej −5 dBm i czułości odbiornika −15 dBm ma budżet 10 dB. Łącze jednomodowe ma długość 8 km przy 1310 nm (<span data-m=\"\\alpha = 0{,}35\"></span> dB/km), zawiera dwa spawy po 0,1 dB i cztery pary złączy po 0,5 dB, przyjęto zapas 3 dB:</p>
<div data-m=\"\\text{Straty} = 8 \\cdot 0{,}35 + 2 \\cdot 0{,}1 + 4 \\cdot 0{,}5 + 3 = 2{,}8 + 0{,}2 + 2{,}0 + 3 = 8{,}0 \\text{ dB}\"></div>
<p>Straty (8 dB) są mniejsze niż budżet (10 dB), więc łącze pracuje z rezerwą 2 dB. Należy pamiętać, że zbyt duża moc na odbiorniku (np. przy bardzo krótkim łączu i mocnym laserze) również jest problemem: wymaga zastosowania <strong>tłumika optycznego</strong>.</p>
<h3>3.11. Zwielokrotnienie falowe (WDM)</h3>
<p><strong>WDM (Wavelength Division Multiplexing)</strong> pozwala przesyłać jednocześnie wiele niezależnych sygnałów optycznych w jednym włóknie, używając różnych długości fali. Odpowiednik „wielu kolorów\" w jednej nici.</p>
<ul>
<li><strong>CWDM</strong> (Coarse WDM) — odstęp kanałów 20 nm, do 18 kanałów w zakresie ok. 1270–1610 nm (ITU-T G.694.2); tanie lasery niechłodzone, zasięgi do ok. 80 km, zastosowanie w sieciach metropolitalnych i operatorskich.</li>
<li><strong>DWDM</strong> (Dense WDM) — odstępy 100, 50 lub 25 GHz (ok. 0,8 / 0,4 / 0,2 nm; ITU-T G.694.1), zwykle w paśmie C i L; kilkadziesiąt do ponad stu kanałów, każdy o przepływności 10–800 Gb/s; w połączeniu ze wzmacniaczami erbowymi (<strong>EDFA</strong>) pozwala na łącza dalekosiężne (tysiące kilometrów) o łącznej przepływności rzędu dziesiątek terabitów na sekundę na jednym włóknie.</li>
</ul>
<p>WDM jest podstawą sieci szkieletowych operatorów i międzykontynentalnych kabli podmorskich.</p>
<h3>3.12. Transceivery modułowe</h3>
<p>Interfejsy optyczne w przełącznikach i routerach realizowane są jako wymienne moduły (transceivery), co pozwala dobrać typ medium do potrzeb bez wymiany urządzenia:</p>
<ul>
<li><strong>SFP</strong> (1 Gb/s), <strong>SFP+</strong> (10 Gb/s), <strong>SFP28</strong> (25 Gb/s) — moduły z gniazdem LC (duplex);</li>
<li><strong>QSFP+</strong> (40 Gb/s), <strong>QSFP28</strong> (100 Gb/s), <strong>QSFP-DD</strong> (400 Gb/s) i nowsze — moduły wielotorowe;</li>
<li>kable <strong>DAC</strong> (Direct Attach Copper) i <strong>AOC</strong> (Active Optical Cable) — kable z wtopionymi końcówkami, do krótkich połączeń w szafach.</li>
</ul>
<p>W modułach optycznych umieszczany jest zwykle mikrokontroler z interfejsem diagnostycznym <strong>DOM/DDM</strong> (Digital Optical Monitoring), umożliwiającym odczyt mocy nadawczej, odbiorczej, temperatury i napięcia — bardzo przydatny przy diagnostyce.</p>
<h3>3.13. Światłowód w sieciach dostępowych</h3>
<p>W sieciach dostępowych światłowód dociera coraz bliżej użytkownika. Rozróżnia się architektury <strong>FTTx</strong>: FTTH (Fiber to the Home — do mieszkania/domu), FTTB (Fiber to the Building — do budynku), FTTC/FTTN (do szafy ulicznej, dalej miedź). Popularną techniką jest pasywna sieć optyczna <strong>PON</strong>, omówiona szczegółowo w rozdziale 6.</p>
<h3>3.14. Zalety i ograniczenia światłowodów</h3>
<p><strong>Zalety:</strong> ogromna szerokość pasma, minimalne tłumienie (zasięgi do kilkudziesięciu kilometrów bez regeneracji), pełna odporność na zakłócenia elektromagnetyczne i przesłuchy, brak promieniowania (utrudniony podsłuch), galwaniczna separacja urządzeń, mała masa i średnica, brak przewodzenia iskry (bezpieczne w środowisku zagrożonym wybuchem).</p>
<p><strong>Ograniczenia:</strong> wyższy koszt urządzeń i osprzętu, wymagane specjalistyczne narzędzia i przeszkolenie do spawania i pomiarów (reflektometr OTDR, miernik mocy), wrażliwość na zbyt ciasne zagięcia (minimalny promień gięcia to zwykle 10–15 średnic kabla), brak możliwości zasilania urządzeń przez sam kabel oraz konieczność dbania o czystość złączy.</p>
<hr />
<h2>4. Fale radiowe jako medium transmisyjne</h2>
<h3>4.1. Widmo fal radiowych</h3>
<p><strong>Fala elektromagnetyczna</strong> to zaburzenie pola elektrycznego i magnetycznego rozchodzące się w przestrzeni z prędkością światła <span data-m=\"c \\approx 3\\cdot 10^8\"></span> m/s. Częstotliwość <span data-m=\"f\"></span> i długość fali <span data-m=\"\\lambda\"></span> są związane zależnością:</p>
<div data-m=\"c = f \\cdot \\lambda \\quad\\Rightarrow\\quad \\lambda = \\frac{c}{f}\"></div>
<p>Dla Wi-Fi 2,4 GHz długość fali wynosi ok. 12,5 cm, dla 5 GHz — ok. 6 cm, a dla 60 GHz — ok. 5 mm. Długość fali determinuje rozmiary anten (typowo ułamek długości fali, np. ćwierćfalówka), sposób przenikania przez przeszkody i zjawiska dyfrakcyjne.</p>
<p><img alt=\"Pasma fal radiowych według ITU w skali logarytmicznej wraz z zastosowaniami: radio AM/FM, telefonia komórkowa, Wi-Fi, łączność satelitarna\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/widmo-fal-radiowych.svg\" /></p>
<p>Międzynarodowy Związek Telekomunikacyjny (<strong>ITU</strong>) dzieli widmo radiowe na pasma dekadowe, od VLF (3–30 kHz) do EHF (30–300 GHz). Sieci bezprzewodowe LAN pracują głównie w paśmie <strong>UHF/SHF</strong> (od ok. 2,4 do 7 GHz), gdzie zapewniona jest dostatecznie duża szerokość pasma, a anteny są niewielkie i wygodne w urządzeniach mobilnych.</p>
<h3>4.2. Regulacje i pasma bezlicencyjne (ISM/UNII)</h3>
<p>Widmo radiowe jest zasobem ograniczonym i <strong>regulowanym</strong>. Na świecie o podziale częstotliwości decyduje ITU, w Europie normy techniczne opracowuje <strong>ETSI</strong>, a decyzje regulacyjne wprowadza Komisja Europejska; w Polsce nadzór sprawuje <strong>Urząd Komunikacji Elektronicznej (UKE)</strong>. Większość zastosowań wymaga <strong>pozwolenia radiowego</strong> (licencji), ale wybrane pasma, tzw. <strong>ISM</strong> (Industrial, Scientific, Medical), udostępniono do użytku <strong>bezlicencyjnego</strong> pod warunkiem przestrzegania ograniczeń mocy i zasad współdzielenia.</p>
<table>
<thead>
<tr>
<th>Pasmo</th>
<th>Zakres</th>
<th>Typowe zastosowania</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>433 MHz</td>
<td>433,05–434,79 MHz</td>
<td>piloty, czujniki, systemy alarmowe</td>
<td>duży zasięg, mała przepływność</td>
</tr>
<tr>
<td>868 MHz</td>
<td>863–870 MHz (UE)</td>
<td>IoT (LoRa, Sigfox, Wi-Fi HaLow), liczniki</td>
<td>ograniczony cykl pracy (duty cycle)</td>
</tr>
<tr>
<td><strong>2,4 GHz</strong></td>
<td>2400–2483,5 MHz</td>
<td>Wi-Fi, Bluetooth, Zigbee, kuchenki mikrofalowe</td>
<td>bardzo zatłoczone</td>
</tr>
<tr>
<td><strong>5 GHz</strong></td>
<td>ok. 5150–5875 MHz (podpasma)</td>
<td>Wi-Fi</td>
<td>DFS i TPC w części pasma, kanały do 160 MHz</td>
</tr>
<tr>
<td><strong>6 GHz</strong></td>
<td>5945–6425 MHz w UE (5925–7125 MHz w USA)</td>
<td>Wi-Fi 6E/7</td>
<td>brak dostępu starszych urządzeń, kanały do 320 MHz</td>
</tr>
<tr>
<td>60 GHz</td>
<td>57–71 GHz</td>
<td>WiGig (802.11ad/ay), łącza punkt–punkt</td>
<td>bardzo silne tłumienie, zasięg kilku–kilkunastu metrów</td>
</tr>
</tbody>
</table>
<p>Zasady dotyczące mocy, dostępnych kanałów i wymogów (np. DFS — dynamic frequency selection, czyli wykrywanie radarów i ustępowanie im) różnią się między krajami i są aktualizowane. W UE moc wyjściowa urządzeń Wi-Fi jest ograniczona (przykładowo do 100 mW EIRP w paśmie 2,4 GHz), a w 6 GHz wprowadzono kategorie urządzeń o niskiej mocy do zastosowań wewnątrz budynków. <strong>Zawsze należy sprawdzać aktualne przepisy krajowe.</strong></p>
<h3>4.3. Propagacja fal radiowych</h3>
<p>W przeciwieństwie do kabla, w którym sygnał jest prowadzony, fala radiowa rozchodzi się w przestrzeni we wszystkich kierunkach i podlega szeregowi zjawisk.</p>
<p><strong>Tłumienie w przestrzeni swobodnej (FSPL — Free-Space Path Loss).</strong> Nawet bez przeszkód moc fali maleje, ponieważ rozkłada się na coraz większą powierzchnię (odwrotnie proporcjonalnie do kwadratu odległości), a ponadto skuteczna apertura anteny odbiorczej maleje z częstotliwością. Tłumienie wynosi:</p>
<div data-m=\"\\text{FSPL}_{\\text{dB}} = 20\\log_{10}(d_{\\text{m}}) + 20\\log_{10}(f_{\\text{MHz}}) - 27{,}55\"></div>
<p>gdzie <span data-m=\"d\"></span> jest odległością w metrach, a <span data-m=\"f\"></span> częstotliwością w megahercach.</p>
<p><em>Przykład.</em> Dla <span data-m=\"d = 100\"></span> m: przy <span data-m=\"f = 2450\"></span> MHz FSPL <span data-m=\"= 40 + 67{,}8 - 27{,}55 \\approx 80{,}2\"></span> dB, a przy <span data-m=\"f = 5500\"></span> MHz FSPL <span data-m=\"= 40 + 74{,}8 - 27{,}55 \\approx 87{,}3\"></span> dB. Różnica wynosi ok. <strong>7 dB</strong> — to jeden z powodów, dla których sygnał 5 GHz jest „słabszy\" od 2,4 GHz nawet bez przeszkód. Każde podwojenie odległości zwiększa tłumienie o 6 dB, a każde podwojenie częstotliwości również o 6 dB.</p>
<p><strong>Zjawiska propagacyjne w rzeczywistym otoczeniu:</strong></p>
<ul>
<li><strong>odbicie</strong> — fala odbija się od dużych, gładkich powierzchni (metal, szkło, woda, ściany);</li>
<li><strong>załamanie (refrakcja)</strong> — zmiana kierunku fali przy przejściu między ośrodkami;</li>
<li><strong>dyfrakcja</strong> — uginanie fali na krawędziach przeszkód, dzięki czemu sygnał dociera także za przeszkodą (tym silniej, im większa długość fali);</li>
<li><strong>rozpraszanie</strong> — fala odbija się w wielu kierunkach od małych obiektów (liście, chropowate powierzchnie);</li>
<li><strong>absorpcja</strong> — zamiana energii fali na ciepło w przeszkodzie; przykładowo żelbet i woda tłumią silnie, płyta gipsowo-kartonowa niewiele, a 5 GHz i 6 GHz są tłumione silniej niż 2,4 GHz;</li>
<li><strong>propagacja wielodrogowa (multipath)</strong> — do odbiornika docierają kopie tego samego sygnału o różnych opóźnieniach i fazach; mogą się wzmacniać lub wygaszać (<strong>zaniki, fading</strong>) i powodować <strong>interferencję międzysymbolową</strong>.</li>
</ul>
<p>Wielodrogowość jest wrogiem w klasycznej transmisji, ale w nowoczesnych systemach (OFDM, MIMO) jest wykorzystywana jako zasób — patrz podrozdziały 4.5–4.6.</p>
<h3>4.4. Anteny i budżet łącza radiowego</h3>
<p><strong>Antena</strong> zamienia sygnał elektryczny na falę elektromagnetyczną i odwrotnie. Jej najważniejszym parametrem jest <strong>zysk (gain)</strong> wyrażany w <strong>dBi</strong>: o ile mocniej antena promieniuje w danym kierunku w porównaniu z idealną anteną izotropową (promieniującą równomiernie we wszystkich kierunkach). Zysk nie oznacza wytworzenia dodatkowej energii — antena o dużym zysku skupia moc w węższej wiązce.</p>
<ul>
<li><strong>Anteny dookólne</strong> (omnidirectional) — promieniowanie w płaszczyźnie poziomej we wszystkich kierunkach; typowy zysk 2–9 dBi; w routerach domowych i punktach dostępowych.</li>
<li><strong>Anteny kierunkowe</strong> (Yagi, panelowe, paraboliczne) — skupiają wiązkę; zysk 10–30 dBi; do łączy punkt–punkt i pokrycia sektorowego.</li>
</ul>
<p>Moc efektywnie wypromieniowana w kierunku maksymalnego zysku to <strong>EIRP</strong> (Equivalent Isotropically Radiated Power):</p>
<div data-m=\"\\text{EIRP}_{\\text{dBm}} = P_{Tx,\\text{dBm}} - L_{\\text{kabli}} + G_{Tx,\\text{dBi}}\"></div>
<p>To właśnie EIRP jest wielkością limitowaną przepisami. <strong>Bilans łącza</strong> pozwala oszacować moc odbieraną:</p>
<div data-m=\"P_{Rx,\\text{dBm}} = \\text{EIRP} - \\text{FSPL} - L_{\\text{przeszkód}} + G_{Rx,\\text{dBi}}\"></div>
<p><em>Przykład.</em> Nadajnik 17 dBm z anteną 3 dBi (bez strat w kablu): EIRP = 20 dBm. Odległość 50 m przy 5500 MHz: FSPL <span data-m=\"= 33{,}98 + 74{,}81 - 27{,}55 \\approx 81{,}2\"></span> dB. Odbiornik z anteną 0 dBi otrzymuje <span data-m=\"P_{Rx} = 20 - 81{,}2 + 0 \\approx -61{,}2\"></span> dBm. Podłoże szumowe dla kanału 20 MHz wynosi ok. −174 + 73 = −101 dBm, po uwzględnieniu współczynnika szumów odbiornika (ok. 6 dB) ok. −95 dBm. Stąd SNR ≈ 34 dB — wartość pozwalająca na wysokie modulacje. Dodanie dwóch ścian (po ok. 5 dB każda) zmniejszyłoby SNR do ok. 24 dB.</p>
<h3>4.5. Modulacje cyfrowe</h3>
<p>Aby przesłać bity falą radiową, modyfikuje się parametry <strong>fali nośnej</strong> w rytm danych:</p>
<ul>
<li><strong>ASK</strong> (Amplitude-Shift Keying) — zmiana amplitudy;</li>
<li><strong>FSK</strong> (Frequency-Shift Keying) — zmiana częstotliwości (stosowana m.in. w Bluetooth klasycznym i prostych systemach IoT);</li>
<li><strong>PSK</strong> (Phase-Shift Keying) — zmiana fazy: <strong>BPSK</strong> (2 fazy, 1 bit na symbol), <strong>QPSK</strong> (4 fazy, 2 bity);</li>
<li><strong>QAM</strong> (Quadrature Amplitude Modulation) — łączna zmiana amplitudy i fazy dwóch nośnych przesuniętych o 90° (składowe I i Q); kolejne stopnie: 16-QAM (4 bity/symbol), 64-QAM (6), <strong>256-QAM (8)</strong>, <strong>1024-QAM (10)</strong>, <strong>4096-QAM (12)</strong>.</li>
</ul>
<p>Każdemu punktowi na <strong>diagramie konstelacji</strong> odpowiada jeden symbol. Im więcej punktów, tym więcej bitów na symbol — ale tym mniejsze są odległości między punktami, więc mniejszy szum wystarcza do pomylenia symbolu. Dlatego wyższe modulacje wymagają wyższego SNR:</p>
<table>
<thead>
<tr>
<th>Modulacja</th>
<th>Bitów na symbol</th>
<th>Orientacyjny wymagany SNR</th>
<th>Uwagi</th>
</tr>
</thead>
<tbody>
<tr>
<td>BPSK</td>
<td>1</td>
<td>ok. 5 dB</td>
<td>najlepsza odporność, największy zasięg</td>
</tr>
<tr>
<td>QPSK</td>
<td>2</td>
<td>ok. 8–10 dB</td>
<td></td>
</tr>
<tr>
<td>16-QAM</td>
<td>4</td>
<td>ok. 15–18 dB</td>
<td></td>
</tr>
<tr>
<td>64-QAM</td>
<td>6</td>
<td>ok. 22–25 dB</td>
<td></td>
</tr>
<tr>
<td>256-QAM</td>
<td>8</td>
<td>ok. 28–32 dB</td>
<td>Wi-Fi 5</td>
</tr>
<tr>
<td>1024-QAM</td>
<td>10</td>
<td>ok. 35 dB</td>
<td>Wi-Fi 6</td>
</tr>
<tr>
<td>4096-QAM</td>
<td>12</td>
<td>ok. 40 dB i więcej</td>
<td>Wi-Fi 7</td>
</tr>
</tbody>
</table>
<p>Przepływność zależy nie tylko od modulacji, ale też od <strong>szybkości kodowania korekcyjnego</strong> (np. 1/2, 2/3, 3/4, 5/6): część bitów służy korekcji błędów (kodowanie splotowe lub LDPC). Zestawy modulacji i kodowania nazywa się w Wi-Fi <strong>MCS</strong> (Modulation and Coding Scheme). System <strong>adaptacji prędkości</strong> automatycznie wybiera najwyższy MCS, przy którym transmisja jest jeszcze niezawodna.</p>
<h3>4.6. Rozpraszanie widma i OFDM</h3>
<p><strong>Techniki rozproszonego widma</strong> (spread spectrum) rozszerzają sygnał na pasmo szersze niż konieczne, co zwiększa odporność na zakłócenia i utrudnia podsłuch:</p>
<ul>
<li><strong>FHSS</strong> (Frequency-Hopping) — nadajnik szybko przeskakuje między wieloma częstotliwościami według ustalonej sekwencji (Bluetooth, pierwotne 802.11);</li>
<li><strong>DSSS</strong> (Direct Sequence) — każdy bit jest mnożony przez szybki ciąg chipów (kod pseudolosowy), np. 11-chipowy kod Barkera w 802.11 i 802.11b (1 i 2 Mb/s).</li>
</ul>
<p>Współczesne systemy szerokopasmowe (Wi-Fi od 802.11a/g, LTE, 5G, DVB-T, DSL) używają <strong>OFDM</strong> (Orthogonal Frequency-Division Multiplexing). Zamiast jednej szybkiej nośnej stosuje się <strong>wiele wolnych, ortogonalnych podnośnych</strong>, których rozstaw równy jest odwrotności czasu trwania symbolu (<span data-m=\"\\Delta f = 1/T_u\"></span>). Dzięki ortogonalności widma podnośnych mogą się nakładać bez wzajemnych zakłóceń. Zalety OFDM:</p>
<ul>
<li><strong>odporność na propagację wielodrogową</strong> — każda podnośna jest wąska, więc widzi „płaski\" kanał; opóźnione kopie symbolu tłumi <strong>przedział ochronny (GI, guard interval)</strong> wstawiany przed symbolem (kopia końca symbolu);</li>
<li><strong>elastyczność</strong> — słabe podnośne można wyłączyć albo zmodulować niżej (adaptive bit loading), a silne — wyżej;</li>
<li><strong>efektywna implementacja</strong> — modulator i demodulator realizowane są przez algorytmy szybkiej transformaty Fouriera (IFFT / FFT).</li>
</ul>
<p>W wariancie wielodostępowym <strong>OFDMA</strong> (Wi-Fi 6, LTE, 5G) podnośne są przydzielane różnym użytkownikom w tym samym symbolu (bloki zasobów, RU).</p>
<h3>4.7. MIMO i formowanie wiązki</h3>
<p><strong>MIMO</strong> (Multiple-Input Multiple-Output) wykorzystuje wiele anten nadawczych i odbiorczych. Wielodrogowość, dotąd szkodliwa, staje się zasobem: kilka niezależnych <strong>strumieni przestrzennych</strong> (spatial streams) przesyłanych jednocześnie na tej samej częstotliwości daje wielokrotność przepływności. Oznaczenie <strong>NxM</strong> to liczba anten nadawczych i odbiorczych, a osobno wyróżnia się liczbę strumieni (np. 2×2:2). Maksymalna teoretyczna liczba strumieni to mniejsza z liczb anten nadawczych i odbiorczych.</p>
<p>Techniki pokrewne:</p>
<ul>
<li><strong>Zróżnicowanie (diversity) i kodowanie przestrzenno-czasowe</strong> — zwiększają niezawodność, nie przepływność;</li>
<li><strong>Beamforming (formowanie wiązki)</strong> — dobór fazy i amplitudy sygnałów na antenach tak, aby energia sumowała się konstruktywnie w kierunku odbiorcy;</li>
<li><strong>MU-MIMO (Multi-User MIMO)</strong> — obsługa wielu klientów jednocześnie na różnych strumieniach przestrzennych; wprowadzone w 802.11ac (kierunek w dół), w 802.11ax także w górę.</li>
</ul>
<h3>4.8. Inne technologie radiowe (przegląd)</h3>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Standard</th>
<th>Pasmo</th>
<th>Zasięg</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td>Bluetooth / BLE</td>
<td>IEEE 802.15.1 / Bluetooth SIG</td>
<td>2,4 GHz</td>
<td>10–100 m</td>
<td>urządzenia peryferyjne, słuchawki, czujniki</td>
</tr>
<tr>
<td>Zigbee / Thread</td>
<td>IEEE 802.15.4</td>
<td>2,4 GHz, 868 MHz</td>
<td>10–100 m</td>
<td>inteligentny dom, sieci kratowe czujników</td>
</tr>
<tr>
<td>LoRaWAN</td>
<td>LoRa Alliance</td>
<td>868 MHz (UE)</td>
<td>kilka–kilkanaście km</td>
<td>IoT o niskiej przepływności (LPWAN)</td>
</tr>
<tr>
<td>NFC</td>
<td>ISO/IEC 14443, 18092</td>
<td>13,56 MHz</td>
<td>do 10 cm</td>
<td>płatności, identyfikacja</td>
</tr>
<tr>
<td>LTE (4G)</td>
<td>3GPP</td>
<td>700–2600 MHz i inne</td>
<td>do kilkunastu km</td>
<td>telefonia komórkowa i FWA</td>
</tr>
<tr>
<td>5G NR</td>
<td>3GPP</td>
<td>sub-6 GHz i mmWave (24–52 GHz)</td>
<td>od setek metrów do kilku km</td>
<td>telefonia, FWA, sieci prywatne</td>
</tr>
<tr>
<td>Łączność satelitarna</td>
<td>m.in. DVB-S2, systemy LEO</td>
<td>1–30 GHz</td>
<td>globalny</td>
<td>dostęp na obszarach o słabej infrastrukturze</td>
</tr>
<tr>
<td>Mikrofalowe łącza punkt–punkt</td>
<td>ETSI</td>
<td>5–80 GHz</td>
<td>do kilkudziesięciu km</td>
<td>radiolinie operatorskie</td>
</tr>
</tbody>
</table>
<h3>4.9. Zalety i ograniczenia mediów radiowych</h3>
<p><strong>Zalety:</strong> mobilność użytkowników, szybkie wdrożenie bez okablowania, możliwość dotarcia do miejsc trudnych do skablowania (zabytki, tereny górskie), elastyczność zmiany układu sieci, niski koszt pokrycia dużych, rozproszonych obszarów.</p>
<p><strong>Ograniczenia:</strong> współdzielenie ograniczonego widma i interferencje (w pasmach bezlicencyjnych), zmienna jakość sygnału zależna od otoczenia, tłumienie przeszkód, niższa przepływność i większe opóźnienia niż w kablu, <strong>podatność na podsłuch i ataki</strong> (medium jest dostępne dla każdego w zasięgu), konieczność szyfrowania oraz kwestie zdrowotne i regulacyjne (limity mocy).</p>
<hr />
<h2>5. Standardy IEEE 802.11 (Wi-Fi)</h2>
<h3>5.1. Rodzina 802.11 i marka Wi-Fi</h3>
<p><strong>IEEE 802.11</strong> to zbiór standardów bezprzewodowych sieci lokalnych (WLAN), opracowywanych przez grupę roboczą 802.11 w ramach komitetu IEEE 802 (tego samego, który stworzył 802.3 — Ethernet). Standardy definiują dwie najniższe warstwy: <strong>warstwę fizyczną (PHY)</strong> oraz <strong>podwarstwę MAC</strong> warstwy łącza danych, dzięki czemu wyższe warstwy (IP, TCP) działają identycznie jak w sieci przewodowej. Ramka 802.11 jest po stronie punktu dostępowego konwertowana na ramkę Ethernet, dlatego Wi-Fi bywa nazywane „bezprzewodowym Ethernetem\" — choć mechanizm dostępu do medium jest zasadniczo inny.</p>
<p>Sama nazwa <strong>Wi-Fi</strong> jest znakiem towarowym organizacji <strong>Wi-Fi Alliance</strong>, która testuje zgodność produktów różnych producentów i przyznaje certyfikaty. Nie każde urządzenie „802.11\" jest certyfikowane jako Wi-Fi, ale w praktyce oba terminy używane są zamiennie. Dla czytelności od 2018 r. Wi-Fi Alliance stosuje <strong>numerację generacji</strong>: Wi-Fi 4 (802.11n), Wi-Fi 5 (802.11ac), Wi-Fi 6 i 6E (802.11ax), Wi-Fi 7 (802.11be).</p>
<p>Standard bazowy jest od czasu do czasu „skonsolidowany\" (rollup) razem z przyjętymi poprawkami w jeden dokument. Obecnie obowiązuje wersja <strong>IEEE 802.11-2024</strong> (opublikowana w 2025 r.), a poszczególne poprawki (amendments), takie jak 802.11be, publikowane są osobno i włączane do następnej rewizji. Oznaczenia liter oznaczają kolejne poprawki, a nie „wersje\" w sensie chronologicznym (np. 802.11i dotyczy bezpieczeństwa, a 802.11ac jest późniejsza niż 802.11n).</p>
<h3>5.2. Architektura sieci 802.11</h3>
<p>Podstawowe pojęcia:</p>
<ul>
<li><strong>STA (station)</strong> — dowolne urządzenie z interfejsem 802.11 (laptop, telefon, czujnik);</li>
<li><strong>AP (Access Point, punkt dostępowy)</strong> — urządzenie łączące stacje bezprzewodowe z siecią przewodową (system dystrybucji);</li>
<li><strong>BSS (Basic Service Set)</strong> — podstawowy zestaw usług: jeden AP wraz ze skojarzonymi z nim stacjami, tworzący pojedynczą „komórkę\" radiową; identyfikowany przez <strong>BSSID</strong> (zwykle adres MAC radia AP);</li>
<li><strong>SSID (Service Set Identifier)</strong> — nazwa sieci widoczna dla użytkownika (do 32 bajtów); wiele AP może rozgłaszać ten sam SSID;</li>
<li><strong>DS (Distribution System)</strong> — system dystrybucji łączący punkty dostępowe (zwykle sieć Ethernet);</li>
<li><strong>ESS (Extended Service Set)</strong> — zbiór BSS połączonych systemem dystrybucji, tworzący jedną logiczną sieć o wspólnym SSID i umożliwiający <strong>roaming</strong> między punktami dostępowymi;</li>
<li><strong>IBSS (Independent BSS, sieć ad hoc)</strong> — grupa stacji komunikujących się bezpośrednio, bez AP (nadal spotykana w trybach typu Wi-Fi Direct).</li>
</ul>
<p>Najczęściej spotykany jest tryb <strong>infrastrukturalny</strong> (infrastructure), w którym cała komunikacja przechodzi przez AP, nawet między dwiema stacjami w tej samej komórce. Wariantami są: <strong>mostek bezprzewodowy</strong> (łączenie dwóch sieci przewodowych), <strong>repeater/extender</strong> (rozszerzenie zasięgu — zwykle kosztem połowy przepustowości, bo radio nadaje i odbiera na tym samym kanale) oraz <strong>sieć kratowa (mesh)</strong>, w której punkty dostępowe łączą się ze sobą bezprzewodowo, tworząc elastyczną strukturę (standard <strong>802.11s</strong> oraz rozwiązania producentów).</p>
<h3>5.3. Przegląd ewolucji standardów</h3>
<p><img alt=\"Teoretyczne maksymalne przepływności kolejnych standardów Wi-Fi w skali logarytmicznej: od 2 Mb/s w 802.11 do ponad 46 Gb/s w 802.11be\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/wifi-ewolucja-standardow.svg\" /></p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Rok</th>
<th>Nazwa marketingowa</th>
<th>Pasmo</th>
<th>Szerokość kanału</th>
<th>Modulacja</th>
<th>Maks. strumieni</th>
<th>Maks. teoretyczna przepływność</th>
</tr>
</thead>
<tbody>
<tr>
<td>802.11 (pierwotny)</td>
<td>1997</td>
<td>—</td>
<td>2,4 GHz</td>
<td>22 MHz</td>
<td>DSSS / FHSS (BPSK, QPSK), podczerwień</td>
<td>1</td>
<td>2 Mb/s</td>
</tr>
<tr>
<td>802.11b</td>
<td>1999</td>
<td>(Wi-Fi 1, nieoficjalnie)</td>
<td>2,4 GHz</td>
<td>22 MHz</td>
<td>DSSS / CCK</td>
<td>1</td>
<td>11 Mb/s</td>
</tr>
<tr>
<td>802.11a</td>
<td>1999</td>
<td>(Wi-Fi 2, nieoficjalnie)</td>
<td>5 GHz</td>
<td>20 MHz</td>
<td>OFDM, do 64-QAM</td>
<td>1</td>
<td>54 Mb/s</td>
</tr>
<tr>
<td>802.11g</td>
<td>2003</td>
<td>(Wi-Fi 3, nieoficjalnie)</td>
<td>2,4 GHz</td>
<td>20 MHz</td>
<td>OFDM, do 64-QAM (+ zgodność z b)</td>
<td>1</td>
<td>54 Mb/s</td>
</tr>
<tr>
<td>802.11n</td>
<td>2009</td>
<td><strong>Wi-Fi 4</strong></td>
<td>2,4 i 5 GHz</td>
<td>20 / 40 MHz</td>
<td>OFDM, do 64-QAM</td>
<td>4</td>
<td>600 Mb/s</td>
</tr>
<tr>
<td>802.11ac</td>
<td>2013 (Wave 2: 2016)</td>
<td><strong>Wi-Fi 5</strong></td>
<td>5 GHz</td>
<td>20 / 40 / 80 / 160 MHz</td>
<td>OFDM, do 256-QAM</td>
<td>8</td>
<td>ok. 6,9 Gb/s</td>
</tr>
<tr>
<td>802.11ax</td>
<td>2021</td>
<td><strong>Wi-Fi 6</strong> (2,4/5 GHz), <strong>6E</strong> (+ 6 GHz)</td>
<td>2,4 / 5 / 6 GHz</td>
<td>20–160 MHz</td>
<td>OFDM/OFDMA, do 1024-QAM</td>
<td>8</td>
<td>ok. 9,6 Gb/s</td>
</tr>
<tr>
<td>802.11be</td>
<td>zatw. 2024, publ. 2025</td>
<td><strong>Wi-Fi 7</strong></td>
<td>2,4 / 5 / 6 GHz</td>
<td>20–320 MHz</td>
<td>OFDM/OFDMA, do 4096-QAM</td>
<td>16</td>
<td>ok. 46 Gb/s</td>
</tr>
</tbody>
</table>
<p>Warto podkreślić: podane przepływności są <strong>teoretycznymi maksimami warstwy fizycznej</strong> dla największej dozwolonej liczby strumieni i szerokości kanału. Typowy telefon czy laptop ma 1–2 anteny (strumienie), więc realne wartości PHY są kilkakrotnie niższe, a przepustowość użytkowa — jeszcze niższa (narzuty protokołu, współdzielenie medium, zakłócenia; w praktyce ok. 50–70 % przepływności PHY przy dobrych warunkach, a mniej w słabych).</p>
<h3>5.4. Charakterystyka poszczególnych standardów</h3>
<h4>802.11 (1997), 802.11b (1999)</h4>
<p>Pierwotny standard oferował zaledwie 1 i 2 Mb/s w paśmie 2,4 GHz z użyciem rozpraszania widma (DSSS lub FHSS) oraz opcjonalnej podczerwieni. <strong>802.11b</strong> wprowadził kodowanie <strong>CCK</strong> (Complementary Code Keying) i przepływności 5,5 oraz 11 Mb/s przy zachowaniu tego samego kanału 22 MHz. To on uczynił Wi-Fi popularnym na rynku konsumenckim.</p>
<h4>802.11a (1999) i 802.11g (2003)</h4>
<p><strong>802.11a</strong> jako pierwszy zastosował <strong>OFDM</strong> (52 podnośne w kanale 20 MHz, z czego 48 na dane i 4 pilotowe) i pasmo <strong>5 GHz</strong>, osiągając do 54 Mb/s. Mniej zatłoczone pasmo było zaletą, lecz wyższa częstotliwość oznaczała krótszy zasięg i wyższe koszty, przez co standard początkowo zdobył mniejszą popularność. <strong>802.11g</strong> przeniósł OFDM do pasma 2,4 GHz, zachowując zgodność wsteczną z 802.11b. Obecność choćby jednego urządzenia „b\" zmuszała jednak AP do stosowania mechanizmów ochronnych (RTS/CTS lub CTS-to-self), co obniżało przepustowość całej komórki.</p>
<h4>802.11n — Wi-Fi 4 (2009)</h4>
<p>Przełomowy standard wprowadzający:</p>
<ul>
<li><strong>MIMO</strong> z do 4 strumieniami przestrzennymi,</li>
<li><strong>kanały 40 MHz</strong> (przez łączenie dwóch sąsiednich kanałów 20 MHz),</li>
<li><strong>agregację ramek</strong> (A-MSDU i A-MPDU) — łączenie wielu ramek w jedną transmisję, co zmniejsza względny narzut nagłówków i przerw międzyramkowych,</li>
<li><strong>Block ACK</strong> — potwierdzanie wielu ramek jednym potwierdzeniem,</li>
<li><strong>krótszy przedział ochronny</strong> (400 ns zamiast 800 ns),</li>
<li>pracę w obu pasmach: 2,4 i 5 GHz.</li>
</ul>
<p>Maksymalnie: 4 strumienie × 40 MHz × 64-QAM 5/6 × krótki GI = 600 Mb/s.</p>
<h4>802.11ac — Wi-Fi 5 (2013)</h4>
<p>Standard działający wyłącznie w paśmie <strong>5 GHz</strong>, wprowadzający:</p>
<ul>
<li>kanały <strong>80 i 160 MHz</strong>,</li>
<li>modulację <strong>256-QAM</strong>,</li>
<li>do <strong>8 strumieni</strong> przestrzennych,</li>
<li><strong>MU-MIMO</strong> w kierunku w dół (Wave 2), pozwalające AP nadawać równocześnie do kilku klientów,</li>
<li>jawny <strong>beamforming</strong> ze standardowym mechanizmem sondowania kanału.</li>
</ul>
<h4>802.11ax — Wi-Fi 6 / 6E (2021)</h4>
<p>Projektowany z myślą o <strong>efektywności w gęstych środowiskach</strong> (biura, lotniska, stadiony), a nie tylko o maksymalnej prędkości. Najważniejsze cechy:</p>
<ul>
<li><strong>OFDMA</strong> — podział kanału na mniejsze bloki zasobów (RU: 26, 52, 106, 242, 484, 996 podnośnych), które AP przydziela różnym klientom w tej samej transmisji; zmniejsza narzut przy krótkich ramkach (VoIP, IoT);</li>
<li><strong>MU-MIMO w obu kierunkach</strong> (UL i DL);</li>
<li><strong>1024-QAM</strong>;</li>
<li><strong>dłuższy symbol OFDM</strong> (12,8 µs zamiast 3,2 µs) i podnośne 4-krotnie węższe (78,125 kHz), z GI 0,8 / 1,6 / 3,2 µs — większa odporność na propagację wielodrogową, szczególnie na zewnątrz;</li>
<li><strong>BSS Coloring</strong> — znacznik komórki w nagłówku PHY, dzięki któremu stacje mogą rozpoznać ramki z sąsiedniej sieci i ponownie użyć kanału (spatial reuse);</li>
<li><strong>TWT (Target Wake Time)</strong> — umowa między AP a klientem o godzinach budzenia się, oszczędzająca baterię urządzeń IoT i mobilnych;</li>
<li><strong>Wi-Fi 6E</strong> — rozszerzenie na pasmo <strong>6 GHz</strong>, oferujące dziesiątki nowych, czystych kanałów bez urządzeń starszych generacji (w UE: 5945–6425 MHz).</li>
</ul>
<h4>802.11be — Wi-Fi 7 (zatwierdzony w 2024, opublikowany w 2025)</h4>
<p>Standard „Extremely High Throughput (EHT)\". Kluczowe cechy:</p>
<ul>
<li>kanały do <strong>320 MHz</strong> (tylko w paśmie 6 GHz),</li>
<li>modulacja <strong>4096-QAM</strong>,</li>
<li><strong>MLO (Multi-Link Operation)</strong> — jedno urządzenie może jednocześnie korzystać z kilku pasm (np. 5 i 6 GHz), agregując przepustowość lub wybierając najlepszy link dla niskiego opóźnienia i niezawodności,</li>
<li><strong>Multi-RU</strong> i <strong>preamble puncturing</strong> — przydział wielu bloków zasobów jednej stacji oraz „wycinanie\" zajętych fragmentów szerokiego kanału (np. przy obecności radarów lub sąsiednich sieci) zamiast rezygnacji z całego kanału,</li>
<li>do <strong>16 strumieni</strong> przestrzennych (w praktyce urządzenia mają 2–4),</li>
<li>dopracowane mechanizmy dla ruchu wrażliwego na opóźnienia (m.in. restricted TWT).</li>
</ul>
<p>Certyfikacja <strong>Wi-Fi CERTIFIED 7</strong> rozpoczęła się w styczniu 2024 r. i produkty na rynku pojawiły się jeszcze przed formalną publikacją standardu.</p>
<h4>Wi-Fi 8 (802.11bn) i kierunki rozwoju</h4>
<p>Grupa robocza IEEE pracuje nad poprawką <strong>802.11bn — Ultra High Reliability (UHR)</strong>, określaną jako Wi-Fi 8. Jej celem nie jest przede wszystkim wzrost szczytowej przepływności, ale <strong>niezawodność, mniejsze opóźnienia i lepsza efektywność</strong> w trudnych warunkach (m.in. koordynacja między punktami dostępowymi, redukcja utraty ramek). Prace są w toku, a zatwierdzenie oczekiwane jest w perspektywie kilku lat; równolegle rozważane są kolejne kierunki (m.in. komunikacja o ultraniskim poborze energii i współpraca z zadaniami edge AI). Szczegółowe daty warto sprawdzać w publicznych materiałach grupy 802.11, ponieważ harmonogram bywa aktualizowany.</p>
<h4>Inne ważne poprawki</h4>
<table>
<thead>
<tr>
<th>Poprawka</th>
<th>Zakres</th>
</tr>
</thead>
<tbody>
<tr>
<td>802.11e</td>
<td>QoS w warstwie MAC (EDCA, HCCA); podstawa certyfikacji WMM</td>
</tr>
<tr>
<td>802.11h</td>
<td>DFS i TPC — zgodność z europejskimi wymogami w paśmie 5 GHz</td>
</tr>
<tr>
<td>802.11i</td>
<td>bezpieczeństwo (WPA2, CCMP, 802.1X)</td>
</tr>
<tr>
<td>802.11k / v / r</td>
<td>zarządzanie radiem, sterowanie roamingiem, szybkie przełączanie między AP (Fast BSS Transition)</td>
</tr>
<tr>
<td>802.11s</td>
<td>sieci kratowe (mesh)</td>
</tr>
<tr>
<td>802.11w</td>
<td>ochrona ramek zarządzających (PMF)</td>
</tr>
<tr>
<td>802.11ad / ay</td>
<td>pasmo <strong>60 GHz</strong> (WiGig): kanały 2,16 GHz, przepływności od kilku do kilkudziesięciu Gb/s, zasięg ograniczony do pomieszczenia</td>
</tr>
<tr>
<td>802.11ah</td>
<td><strong>Wi-Fi HaLow</strong>, pasma poniżej 1 GHz (868 MHz w UE), zasięg do ok. 1 km, IoT o niskiej przepływności i niskim poborze energii</td>
</tr>
<tr>
<td>802.11p</td>
<td>komunikacja pojazdów (V2X)</td>
</tr>
</tbody>
</table>
<h3>5.5. Kanały radiowe</h3>
<h4>Pasmo 2,4 GHz</h4>
<p>W Europie dostępnych jest <strong>13 kanałów</strong> o numerach 1–13, których środki rozmieszczone są co <strong>5 MHz</strong> według wzoru:</p>
<div data-m=\"f_{\\text{środ}}(n) = 2412 + 5\\,(n-1)\\ \\text{[MHz]}, \\qquad n = 1,\\dots,13\"></div>
<p>Ponieważ szerokość kanału wynosi 20 MHz (22 MHz w DSSS/CCK), a odstęp środków tylko 5 MHz, kanały <strong>silnie się nakładają</strong>. Kanały nienakładające się to praktycznie <strong>1, 6 i 11</strong> (w Europie bywa też używany zestaw 1, 5, 9, 13 kosztem lekkiego zachodzenia). Zakłócenie z sąsiedniego, częściowo nakładającego się kanału jest gorsze niż współdzielenie tego samego kanału, ponieważ stacje nie potrafią zdekodować cudzych nagłówków, więc nie koordynują dostępu do medium (patrz 5.7); dlatego zaleca się albo używanie tego samego kanału, albo kanałów rozdzielonych.</p>
<p><img alt=\"Kanały Wi-Fi w paśmie 2,4 GHz — 13 kanałów po 20 MHz; nienakładające się: 1, 6 i 11\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/wifi-kanaly-2-4ghz.svg\" /></p>
<p>Szerokość 40 MHz w paśmie 2,4 GHz praktycznie nie ma sensu w zatłoczonym środowisku, bo zajmuje niemal połowę pasma i zwiększa interferencję. Dodatkowo pasmo jest współdzielone z Bluetooth, kuchenkami mikrofalowymi, bezprzewodowymi kamerami i innymi urządzeniami.</p>
<h4>Pasmo 5 GHz</h4>
<p>W paśmie 5 GHz numeracja kanałów jest ustalona co 5 MHz od częstotliwości 5000 MHz (<span data-m=\"f = 5000 + 5n\"></span> MHz), lecz standardowo używa się kanałów rozłożonych co 4 numery (20 MHz). W Europie dostępne są m.in.:</p>
<ul>
<li><strong>kanały 36–64</strong> (5180–5320 MHz), w tym część wymagająca <strong>DFS</strong> i <strong>TPC</strong> (52–64);</li>
<li><strong>kanały 100–140</strong> (5500–5700 MHz), wymagające DFS;</li>
<li>w części krajów także kanały górne (np. 149–165, w zakresie SRD 5725–5875 MHz).</li>
</ul>
<p><strong>DFS (Dynamic Frequency Selection)</strong> wymaga, aby urządzenie przed rozpoczęciem pracy na kanale (zwykle przez 60 s, a w niektórych kanałach nawet 10 min) nasłuchiwało obecności radarów (meteorologicznych, wojskowych), a po wykryciu radaru natychmiast opuściło kanał. Może to powodować krótkie przerwy w pracy sieci. Szersze kanały (40, 80, 160 MHz) powstają przez łączenie sąsiednich kanałów 20 MHz; kanałów 160 MHz mieści się w paśmie 5 GHz zaledwie kilka, więc w gęstej zabudowie ich użycie prowadzi do interferencji.</p>
<h4>Pasmo 6 GHz</h4>
<p>W UE dla Wi-Fi udostępniono zakres <strong>5945–6425 MHz</strong> (480 MHz), co pozwala na 24 kanały 20 MHz, 12 kanałów 40 MHz, 6 kanałów 80 MHz, 3 kanały 160 MHz i 1 kanał 320 MHz (w USA i niektórych innych krajach dostępne jest 1200 MHz: 5925–7125 MHz). Pasmo jest czyste, ponieważ mogą w nim pracować wyłącznie urządzenia Wi-Fi 6E/7. Ma też zasady, jak <strong>AFC</strong> (Automated Frequency Coordination) dla urządzeń o standardowej mocy w USA oraz ograniczenie do zastosowań wewnątrz budynków dla urządzeń o niskiej mocy. Krótszy zasięg (wyższa częstotliwość) i silniejsze tłumienie przez ściany to cena za czystość widma.</p>
<h3>5.6. Jak oblicza się przepływność fizyczną</h3>
<p>Przepływność PHY wynika ze wzoru:</p>
<div data-m=\"R = \\frac{N_{SD} \\cdot N_{BPSCS} \\cdot R_c \\cdot N_{SS}}{T_{\\text{sym}}}\"></div>
<p>gdzie:</p>
<ul>
<li><span data-m=\"N_{SD}\"></span> — liczba <strong>podnośnych danych</strong> w kanale,</li>
<li><span data-m=\"N_{BPSCS}\"></span> — liczba bitów na podnośną i symbol (z modulacji: 6 dla 64-QAM, 8 dla 256-QAM, 10 dla 1024-QAM, 12 dla 4096-QAM),</li>
<li><span data-m=\"R_c\"></span> — szybkość kodowania korekcyjnego (np. 3/4, 5/6),</li>
<li><span data-m=\"N_{SS}\"></span> — liczba strumieni przestrzennych,</li>
<li><span data-m=\"T_{\\text{sym}}\"></span> — czas trwania symbolu OFDM wraz z przedziałem ochronnym.</li>
</ul>
<p>Liczba podnośnych danych w zależności od standardu i szerokości kanału:</p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>20 MHz</th>
<th>40 MHz</th>
<th>80 MHz</th>
<th>160 MHz</th>
<th>320 MHz</th>
<th>Symbol (bez GI)</th>
</tr>
</thead>
<tbody>
<tr>
<td>802.11a/g</td>
<td>48</td>
<td>—</td>
<td>—</td>
<td>—</td>
<td>—</td>
<td>3,2 µs (+ GI 0,8)</td>
</tr>
<tr>
<td>802.11n</td>
<td>52</td>
<td>108</td>
<td>—</td>
<td>—</td>
<td>—</td>
<td>3,2 µs (+ GI 0,8 / 0,4)</td>
</tr>
<tr>
<td>802.11ac</td>
<td>52</td>
<td>108</td>
<td>234</td>
<td>468</td>
<td>—</td>
<td>3,2 µs (+ GI 0,8 / 0,4)</td>
</tr>
<tr>
<td>802.11ax</td>
<td>234</td>
<td>468</td>
<td>980</td>
<td>1960</td>
<td>—</td>
<td>12,8 µs (+ GI 0,8 / 1,6 / 3,2)</td>
</tr>
<tr>
<td>802.11be</td>
<td>234</td>
<td>468</td>
<td>980</td>
<td>1960</td>
<td>3920</td>
<td>12,8 µs (+ GI 0,8 / 1,6 / 3,2)</td>
</tr>
</tbody>
</table>
<p><strong>Przykład 1 — 802.11n.</strong> Kanał 40 MHz, 64-QAM, <span data-m=\"R_c = 5/6\"></span>, jeden strumień, krótki GI (symbol 3,6 µs):</p>
<div data-m=\"R = \\frac{108 \\cdot 6 \\cdot \\tfrac{5}{6} \\cdot 1}{3{,}6\\ \\mu\\text{s}} = \\frac{540}{3{,}6\\ \\mu\\text{s}} = 150 \\text{ Mb/s}\"></div>
<p>Dla czterech strumieni: 600 Mb/s.</p>
<p><strong>Przykład 2 — 802.11ac.</strong> Kanał 80 MHz, 256-QAM, <span data-m=\"R_c = 5/6\"></span>, jeden strumień, krótki GI:</p>
<div data-m=\"R = \\frac{234 \\cdot 8 \\cdot \\tfrac{5}{6}}{3{,}6\\ \\mu\\text{s}} = \\frac{1560}{3{,}6\\ \\mu\\text{s}} \\approx 433{,}3 \\text{ Mb/s}\"></div>
<p>Typowy laptop 2×2 osiąga więc 866,7 Mb/s (80 MHz), a przy kanale 160 MHz — 1733 Mb/s.</p>
<p><strong>Przykład 3 — 802.11ax.</strong> Kanał 80 MHz, 1024-QAM, <span data-m=\"R_c = 5/6\"></span>, jeden strumień, GI 0,8 µs (symbol 13,6 µs):</p>
<div data-m=\"R = \\frac{980 \\cdot 10 \\cdot \\tfrac{5}{6}}{13{,}6\\ \\mu\\text{s}} \\approx \\frac{8166{,}7}{13{,}6\\ \\mu\\text{s}} \\approx 600{,}5 \\text{ Mb/s}\"></div>
<p><strong>Przykład 4 — 802.11be.</strong> Kanał 320 MHz, 4096-QAM, <span data-m=\"R_c = 5/6\"></span>, GI 0,8 µs: jeden strumień to <span data-m=\"3920 \\cdot 12 \\cdot \\tfrac{5}{6} / 13{,}6\\ \\mu\\text{s} \\approx 2882\"></span> Mb/s. Typowy klient 2×2 osiąga więc ok. 5,8 Gb/s, a hipotetyczne 16 strumieni — 46,1 Gb/s.</p>
<p>Warto zauważyć, że wzrost liczby bitów na symbol (1024-QAM w porównaniu z 256-QAM) daje w 802.11ax jedynie ok. 25 % zysku. Główne korzyści Wi-Fi 6 wynikają z efektywności (OFDMA, spatial reuse), nie z surowej prędkości.</p>
<h3>5.7. Warstwa MAC: dostęp do medium CSMA/CA</h3>
<h4>Dlaczego nie CSMA/CD?</h4>
<p>W Ethernecie stacja nasłuchuje medium podczas nadawania i wykrywa kolizje (<strong>CSMA/CD</strong>). W sieci bezprzewodowej jest to niemożliwe z dwóch powodów:</p>
<ol>
<li><strong>Półdupleks radia i różnica poziomów mocy</strong> — sygnał własnego nadajnika jest na wejściu odbiornika o wiele rzędów wielkości silniejszy niż sygnał zdalny (ok. 100 dB), więc nadajnik „zagłusza\" własny odbiornik. Stacja nie może zatem wykrywać kolizji w trakcie nadawania.</li>
<li><strong>Problem ukrytej stacji (hidden node)</strong> — dwie stacje A i C mogą znajdować się w zasięgu punktu dostępowego B, ale poza zasięgiem siebie nawzajem. Nie słyszą się, więc obie uznają medium za wolne i nadają jednocześnie, powodując kolizję u odbiorcy B, o której żadna z nich nie wie. Występuje także <strong>problem odsłoniętej stacji (exposed node)</strong>, w którym stacja niepotrzebnie wstrzymuje nadawanie, choć jej transmisja nie zakłóciłaby odbioru.</li>
</ol>
<p>Dlatego Wi-Fi stosuje <strong>CSMA/CA (Collision Avoidance)</strong> — unikanie kolizji, a nie ich wykrywanie. Wszystkie transmisje jednostkowe wymagają <strong>potwierdzenia (ACK)</strong>, a jego brak oznacza, że ramka mogła ulec zakłóceniu i należy ją retransmitować.</p>
<h4>DCF — Distributed Coordination Function</h4>
<p>Podstawowy mechanizm dostępu, działający w sposób rozproszony (bez centralnego arbitra):</p>
<ol>
<li>Stacja z gotową ramką <strong>nasłuchuje medium</strong> (fizycznie: odczyt mocy/wykrycie nośnej; wirtualnie: sprawdzenie licznika NAV).</li>
<li>Jeśli medium jest wolne co najmniej przez czas <strong>DIFS</strong>, stacja może nadawać od razu (przy pierwszej próbie).</li>
<li>Jeśli medium jest zajęte, stacja czeka na jego zwolnienie, następnie odczekuje <strong>DIFS</strong> i losuje <strong>licznik backoff</strong> z przedziału <span data-m=\"[0, CW]\"></span>, gdzie <span data-m=\"CW\"></span> (contention window) to okno rywalizacji.</li>
<li>Licznik zmniejsza się o 1 w każdym wolnym slocie czasowym i <strong>zamraża się</strong>, gdy medium staje się zajęte (stacja wznawia odliczanie po ponownym odczekaniu DIFS).</li>
<li>Gdy licznik osiągnie 0, stacja nadaje ramkę.</li>
<li>Odbiorca po poprawnym odebraniu (weryfikacja FCS) odczekuje krótki czas <strong>SIFS</strong> i wysyła <strong>ACK</strong>.</li>
<li>Jeśli ACK nie nadejdzie w oczekiwanym czasie, stacja uznaje kolizję lub zakłócenie, <strong>podwaja okno rywalizacji</strong> (binary exponential backoff): <span data-m=\"CW \\leftarrow 2\\,(CW+1) - 1\"></span> do wartości maksymalnej <span data-m=\"CW_{max}\"></span>, i ponawia próbę (do limitu retransmisji; typowo 7 dla krótkich ramek).</li>
</ol>
<p>Losowy backoff zapobiega temu, że po zwolnieniu się medium wszystkie oczekujące stacje ruszą jednocześnie.</p>
<p><img alt=\"Sekwencja dostępu do medium CSMA/CA: DIFS, backoff, ramka danych, SIFS i ACK oraz zachowanie stacji odczuwającej NAV\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/csma-ca-sekwencja.svg\" /></p>
<p><strong>Odstępy czasowe (przykładowe wartości):</strong></p>
<table>
<thead>
<tr>
<th>Parametr</th>
<th>Znaczenie</th>
<th>802.11a/n/ac/ax (5 GHz)</th>
<th>802.11g/n (2,4 GHz, OFDM)</th>
<th>802.11b</th>
</tr>
</thead>
<tbody>
<tr>
<td>Slot</td>
<td>podstawowa jednostka backoff</td>
<td>9 µs</td>
<td>9 µs (krótki) / 20 µs</td>
<td>20 µs</td>
</tr>
<tr>
<td>SIFS</td>
<td>odstęp krótki (przed ACK, CTS)</td>
<td>16 µs</td>
<td>10 µs</td>
<td>10 µs</td>
</tr>
<tr>
<td>DIFS</td>
<td><span data-m=\"\\text{SIFS} + 2 \\cdot \\text{slot}\"></span></td>
<td>34 µs</td>
<td>28 µs / 50 µs</td>
<td>50 µs</td>
</tr>
<tr>
<td><span data-m=\"CW_{min}\"></span> / <span data-m=\"CW_{max}\"></span></td>
<td>okno rywalizacji</td>
<td>15 / 1023</td>
<td>15 / 1023</td>
<td>31 / 1023</td>
</tr>
</tbody>
</table>
<p>Zasada priorytetu wynika z zależności <strong>SIFS &lt; DIFS</strong>: ACK i inne ramki odpowiedzi są wysyłane po najkrótszym odstępie, więc żadna stacja rywalizująca o medium (czekająca DIFS + backoff) nie wtrąci się w trakcie wymiany.</p>
<h4>Wirtualne wykrywanie nośnej i NAV</h4>
<p>Każda ramka zawiera w nagłówku pole <strong>Duration</strong>, informujące, jak długo (w mikrosekundach) medium zostanie zajęte przez bieżącą wymianę (ramka + SIFS + ACK). Stacje, które słyszą tę ramkę, ustawiają swój licznik <strong>NAV (Network Allocation Vector)</strong> i przez ten czas <strong>nie nadają</strong>, nawet jeśli fizycznie medium wygląda na wolne. To „wirtualne\" wykrywanie nośnej.</p>
<h4>RTS/CTS</h4>
<p>Aby rozwiązać problem ukrytej stacji, stosuje się opcjonalną wymianę <strong>RTS/CTS</strong>:</p>
<ol>
<li>Nadawca wysyła krótką ramkę <strong>RTS (Request To Send)</strong>.</li>
<li>Odbiorca (AP), jeśli medium jest wolne, odpowiada ramką <strong>CTS (Clear To Send)</strong>.</li>
<li>Stacje słyszące CTS (także te ukryte przed nadawcą) ustawiają NAV i wstrzymują transmisję.</li>
<li>Nadawca wysyła właściwą ramkę danych, a odbiorca — ACK.</li>
</ol>
<p>RTS/CTS dodaje narzut, więc jest włączany tylko dla <strong>dużych ramek</strong> powyżej ustalonego progu (<em>RTS threshold</em>) lub w środowiskach z dużą liczbą kolizji.</p>
<h4>QoS: EDCA i WMM</h4>
<p>Standard <strong>802.11e</strong> wprowadził <strong>EDCA (Enhanced Distributed Channel Access)</strong>, w którym ruch jest dzielony na cztery <strong>kategorie dostępu</strong> (AC): <strong>Voice (AC_VO)</strong>, <strong>Video (AC_VI)</strong>, <strong>Best Effort (AC_BE)</strong> i <strong>Background (AC_BK)</strong>. Każda kategoria ma własne parametry: krótszy odstęp arbitrażowy <strong>AIFS</strong>, mniejsze <span data-m=\"CW_{min}/CW_{max}\"></span> i limit czasu transmisji <strong>TXOP</strong>. W efekcie ramki głosowe zyskują statystycznie pierwszeństwo dostępu. Certyfikat Wi-Fi dla tej funkcji nazywa się <strong>WMM (Wi-Fi Multimedia)</strong>.</p>
<h3>5.8. Format ramki 802.11</h3>
<p>Ramka 802.11 jest bardziej złożona niż ramka Ethernet, ponieważ musi obsłużyć adresowanie w środowisku z punktami dostępowymi i zapewniać mechanizmy sterujące.</p>
<table>
<thead>
<tr>
<th>Pole</th>
<th>Rozmiar</th>
<th>Opis</th>
</tr>
</thead>
<tbody>
<tr>
<td>Frame Control</td>
<td>2 B</td>
<td>wersja protokołu, typ i podtyp ramki, flagi (To DS, From DS, More Fragments, Retry, Power Management, More Data, Protected Frame, Order)</td>
</tr>
<tr>
<td>Duration / ID</td>
<td>2 B</td>
<td>czas zajętości medium (NAV) lub identyfikator skojarzenia (w ramkach PS-Poll)</td>
</tr>
<tr>
<td>Address 1</td>
<td>6 B</td>
<td>adres odbiorcy (RA)</td>
</tr>
<tr>
<td>Address 2</td>
<td>6 B</td>
<td>adres nadawcy (TA)</td>
</tr>
<tr>
<td>Address 3</td>
<td>6 B</td>
<td>zależny od trybu: BSSID lub adres źródłowy/docelowy</td>
</tr>
<tr>
<td>Sequence Control</td>
<td>2 B</td>
<td>numer sekwencji i numer fragmentu (wykrywanie duplikatów)</td>
</tr>
<tr>
<td>Address 4</td>
<td>6 B</td>
<td>tylko w ramkach między AP (WDS/mesh)</td>
</tr>
<tr>
<td>QoS Control</td>
<td>2 B</td>
<td>kategoria ruchu, polityka ACK (w ramkach QoS Data)</td>
</tr>
<tr>
<td>HT/VHT/HE Control</td>
<td>4 B</td>
<td>informacje sterujące (opcjonalne)</td>
</tr>
<tr>
<td>Frame Body</td>
<td>0–2304 B klasycznie (do ok. 7,9 kB z A-MSDU)</td>
<td>dane (enkapsulowany pakiet LLC/SNAP + IP), przy agregacji A-MPDU cała transmisja do kilku MB</td>
</tr>
<tr>
<td>FCS</td>
<td>4 B</td>
<td>CRC-32</td>
</tr>
</tbody>
</table>
<p>Inaczej niż w Ethernecie ramka 802.11 może zawierać <strong>trzy lub cztery adresy</strong>, a ich znaczenie zależy od flag <strong>To DS</strong> i <strong>From DS</strong>:</p>
<table>
<thead>
<tr>
<th>To DS</th>
<th>From DS</th>
<th>Scenariusz</th>
<th>Address 1</th>
<th>Address 2</th>
<th>Address 3</th>
<th>Address 4</th>
</tr>
</thead>
<tbody>
<tr>
<td>0</td>
<td>0</td>
<td>stacje w sieci ad hoc (IBSS)</td>
<td>odbiorca (DA)</td>
<td>nadawca (SA)</td>
<td>BSSID</td>
<td>—</td>
</tr>
<tr>
<td>0</td>
<td>1</td>
<td>AP → stacja</td>
<td>odbiorca (DA)</td>
<td>BSSID (AP)</td>
<td>nadawca (SA)</td>
<td>—</td>
</tr>
<tr>
<td>1</td>
<td>0</td>
<td>stacja → AP</td>
<td>BSSID (AP)</td>
<td>nadawca (SA)</td>
<td>odbiorca (DA)</td>
<td>—</td>
</tr>
<tr>
<td>1</td>
<td>1</td>
<td>AP → AP (most, mesh)</td>
<td>RA</td>
<td>TA</td>
<td>DA</td>
<td>SA</td>
</tr>
</tbody>
</table>
<p>Ramki dzielą się na trzy <strong>typy</strong>:</p>
<ul>
<li><strong>ramki zarządzające (management)</strong> — <strong>Beacon</strong> (rozgłaszany co ok. 102,4 ms, czyli 100 TU, zawiera SSID, obsługiwane prędkości, informacje o zabezpieczeniach i możliwościach), <strong>Probe Request/Response</strong>, <strong>Authentication</strong>, <strong>Association/Reassociation Request/Response</strong>, <strong>Deauthentication</strong>, <strong>Disassociation</strong>, <strong>Action</strong>;</li>
<li><strong>ramki sterujące (control)</strong> — <strong>RTS, CTS, ACK, Block ACK, PS-Poll</strong>;</li>
<li><strong>ramki danych (data)</strong> — dane użytkownika, w tym <strong>QoS Data</strong> i <strong>Null</strong> (sygnalizacja trybu oszczędzania energii).</li>
</ul>
<p>Pole <strong>FCS</strong> stanowi taką samą sumę CRC-32 jak w Ethernecie; ramka z błędnym FCS jest odrzucana i w Wi-Fi skutkuje brakiem ACK, a więc retransmisją.</p>
<h3>5.9. Dołączanie stacji do sieci</h3>
<p>Klient przechodzi kilka stanów, zanim będzie mógł przesyłać dane:</p>
<ol>
<li><strong>Skanowanie (scanning)</strong> — stacja poszukuje sieci. <strong>Pasywne</strong>: nasłuchuje ramek Beacon na kolejnych kanałach. <strong>Aktywne</strong>: wysyła <strong>Probe Request</strong> i czeka na <strong>Probe Response</strong> od punktów dostępowych.</li>
<li><strong>Uwierzytelnianie (authentication)</strong> — w trybie Open System wymiana sprowadza się do formalności (dwie ramki); w WPA3-SAE zawiera już wymianę kryptograficzną.</li>
<li><strong>Skojarzenie (association)</strong> — klient wysyła <strong>Association Request</strong> z informacjami o swoich możliwościach (obsługiwane prędkości, standardy), a AP odpowiada <strong>Association Response</strong> z identyfikatorem AID.</li>
<li><strong>Uwierzytelnianie dostępu i uzgodnienie kluczy</strong> — w sieciach z WPA2/WPA3: <strong>4-way handshake</strong> (uzgodnienie kluczy szyfrujących) lub w trybie Enterprise wcześniej wymiana <strong>802.1X/EAP</strong> z serwerem RADIUS.</li>
<li>Po przyznaniu adresu IP (<strong>DHCP</strong>) rozpoczyna się właściwa komunikacja.</li>
</ol>
<h3>5.10. Bezpieczeństwo sieci Wi-Fi</h3>
<p>Ponieważ medium radiowe jest dostępne dla każdego w zasięgu, bezpieczeństwo musi być zapewnione kryptograficznie.</p>
<table>
<thead>
<tr>
<th>Protokół</th>
<th>Rok</th>
<th>Szyfrowanie / uwierzytelnianie</th>
<th>Ocena</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>WEP</strong></td>
<td>1997</td>
<td>RC4, 24-bitowy wektor IV, statyczny klucz 40/104 bity</td>
<td><strong>całkowicie złamany</strong> (od 2001 r.; klucz można odzyskać w minuty) — nie stosować</td>
</tr>
<tr>
<td><strong>WPA</strong></td>
<td>2003</td>
<td>TKIP (RC4 z dynamicznymi kluczami i kontrolą integralności MIC)</td>
<td>przestarzały, rozwiązanie przejściowe</td>
</tr>
<tr>
<td><strong>WPA2</strong></td>
<td>2004 (802.11i)</td>
<td><strong>AES-CCMP</strong>, klucz PSK (Personal) lub 802.1X (Enterprise)</td>
<td>dobre, ale podatne na atak słownikowy offline na słabe hasło i na atak KRACK (2017, łatany)</td>
</tr>
<tr>
<td><strong>WPA3</strong></td>
<td>2018</td>
<td><strong>SAE</strong> zamiast PSK (Personal), 192-bitowy zestaw kryptograficzny (Enterprise), <strong>OWE</strong> dla sieci otwartych, obowiązkowe PMF</td>
<td>zalecany; odporność na atak słownikowy offline, poufność wsteczna (forward secrecy)</td>
</tr>
</tbody>
</table>
<p>Ważne zasady praktyczne:</p>
<ul>
<li>stosować <strong>WPA3</strong> lub co najmniej <strong>WPA2-AES</strong> (w trybie mieszanym WPA2/WPA3 dla zgodności ze starszymi klientami), <strong>nigdy</strong> WEP ani TKIP;</li>
<li>używać długich, unikalnych haseł (Personal) lub <strong>802.1X/EAP</strong> z certyfikatami w środowiskach firmowych;</li>
<li>wyłączyć <strong>WPS</strong> z kodem PIN (znane podatności);</li>
<li>stosować <strong>izolację gości</strong> (osobny VLAN i SSID) oraz aktualizować oprogramowanie sprzętowe punktów dostępowych;</li>
<li>ukrywanie SSID <strong>nie jest</strong> zabezpieczeniem (nazwa jest ujawniana w ramkach przy połączeniu).</li>
</ul>
<p><strong>PMF (Protected Management Frames, 802.11w)</strong> chroni ramki zarządzające (np. deauthentication) przed fałszowaniem, co uniemożliwia proste ataki „wyrzucania\" klientów z sieci.</p>
<h3>5.11. Roaming i zarządzanie siecią WLAN</h3>
<p>W sieci ESS z wieloma punktami dostępowymi klient sam decyduje, kiedy przełączyć się na inny AP (standard nie narzuca algorytmu), co prowadzi do problemu <strong>„lepkich klientów\" (sticky clients)</strong> — urządzeń trzymających się słabego AP mimo obecności lepszego. Rozwiązania:</p>
<ul>
<li><strong>802.11k</strong> — AP przekazuje klientowi listę sąsiednich punktów dostępowych, skracając skanowanie;</li>
<li><strong>802.11v</strong> — AP może zasugerować klientowi przeniesienie się do innego AP (BSS Transition Management);</li>
<li><strong>802.11r (Fast BSS Transition)</strong> — uzgodnienie kluczy z następnym AP jeszcze przed przełączeniem, co skraca przerwę do kilkudziesięciu milisekund (istotne dla VoIP).</li>
</ul>
<p>W większych instalacjach stosuje się <strong>kontrolery WLAN</strong> (lokalne lub chmurowe), które centralnie zarządzają konfiguracją, doborem kanałów i mocy oraz roamingiem punktów dostępowych.</p>
<h3>5.12. Planowanie i diagnostyka sieci Wi-Fi</h3>
<p>Podstawowe zasady projektowania:</p>
<ul>
<li><strong>Sygnał i SNR.</strong> Orientacyjne progi: sygnał (RSSI) około <strong>−67 dBm</strong> lub lepszy dla aplikacji czasu rzeczywistego (VoIP, wideo), około −70 dBm dla przeciętnych zastosowań; SNR co najmniej 25 dB dla wysokich prędkości.</li>
<li><strong>Pokrycie i zakładki komórek.</strong> Sąsiednie komórki powinny nakładać się na ok. 15–20 % powierzchni, aby umożliwić roaming, ale nie tyle, by wprowadzać interferencję współkanałową.</li>
<li><strong>Interferencja współkanałowa (CCI)</strong> — punkty dostępowe na tym samym kanale współdzielą czas antenowy (medium), więc kolejne AP na tym samym kanale w zasięgu słyszalności <strong>nie zwiększają</strong> pojemności. Planując kanały, dąży się do ich powtarzania dopiero z odległości poza zasięgiem słyszalności.</li>
<li><strong>Interferencja kanałów sąsiednich (ACI)</strong> — jak wyżej, częściowo nakładające się kanały są gorsze niż identyczne.</li>
<li><strong>Moc nadawcza</strong> — większa moc AP nie poprawia sytuacji, jeśli urządzenia klienckie (o mniejszej mocy) nie potrafią odpowiedzieć; sieć jest ograniczana przez <strong>najsłabsze ogniwo</strong> — klienta. Zaleca się umiarkowaną moc i większą liczbę AP.</li>
<li><strong>Szerokość kanału.</strong> Szersze kanały zwiększają prędkość, ale zmniejszają liczbę dostępnych kanałów i obniżają czułość odbiornika (szum rośnie o 3 dB przy każdym podwojeniu szerokości). W gęstych instalacjach zwykle stosuje się kanały 20/40 MHz w 5 GHz.</li>
<li><strong>Pasma.</strong> Klientów o możliwościach dwupasmowych warto kierować do pasm 5/6 GHz (<strong>band steering</strong>), pozostawiając 2,4 GHz starszym i prostym urządzeniom IoT.</li>
</ul>
<p><strong>Narzędzia diagnostyczne:</strong> analizatory widma i sieci Wi-Fi (m.in. aplikacje w telefonach i laptopach), narzędzia typu site survey (mapy cieplne pokrycia), analizatory pakietów w trybie monitor (przechwytywanie ramek 802.11), a w systemach operacyjnych — wbudowane polecenia (np. <code>iw</code>, <code>iwconfig</code> w Linuksie).</p>
<h3>5.13. Zalety i wady Wi-Fi</h3>
<p><strong>Zalety:</strong> mobilność, brak konieczności okablowania, powszechność sprzętu i niski koszt, zgodność wsteczna, szybki rozwój (kolejne generacje co kilka lat), wsparcie w niemal każdym urządzeniu końcowym.</p>
<p><strong>Wady:</strong> współdzielone i zatłoczone medium (półdupleks, rywalizacja CSMA/CA), niższa i zmienna przepustowość oraz większe opóźnienia niż w kablu, podatność na zakłócenia, tłumienie przeszkód, konieczność zabezpieczenia kryptograficznego, ograniczenia regulacyjne (moc, DFS) i zależność wydajności od najsłabszego klienta w komórce.</p>
<hr />
<h2>6. Technologie dostępowe i sieci rozległe (WAN)</h2>
<h3>6.1. Sieć dostępowa — pojęcia podstawowe</h3>
<p><strong>Sieć dostępowa</strong> (ang. <em>access network</em>) łączy lokal abonenta (dom, firmę) z siecią operatora i dalej z Internetem. Odcinek ten nazywany jest <strong>ostatnią milą</strong> (<em>last mile</em>) — nie dlatego, że ma dokładnie jedną milę, lecz dlatego, że jest najkosztowniejszym i najtrudniejszym do modernizacji fragmentem infrastruktury: jest go najwięcej (jedno przyłącze na abonenta), a koszty rozkopania ulic i wejścia do budynków są ogromne.</p>
<p>Podstawowe elementy:</p>
<ul>
<li><strong>CPE (Customer Premises Equipment)</strong> — urządzenie po stronie abonenta (modem, router, terminal światłowodowy ONT);</li>
<li><strong>Punkt demarkacyjny (demarc)</strong> — granica odpowiedzialności między siecią operatora a instalacją abonenta;</li>
<li><strong>Pętla lokalna (local loop)</strong> — łącze między abonentem a najbliższym węzłem operatora;</li>
<li><strong>CO (Central Office)</strong> lub <strong>POP (Point of Presence)</strong> — węzeł operatora, w którym kończą się łącza abonenckie (centrala telefoniczna, węzeł kablowy, węzeł światłowodowy);</li>
<li><strong>Sieć szkieletowa (backbone/core)</strong> — szybka sieć łącząca węzły operatora.</li>
</ul>
<p>Technologie dostępowe można klasyfikować według medium: <strong>miedź</strong> (telefoniczna: dial-up, ISDN, DSL; koncentryczna: sieci kablowe), <strong>światłowód</strong> (FTTx, PON), <strong>radio</strong> (sieci komórkowe, FWA, WISP, satelita).</p>
<h3>6.2. Modemy — czym są i jakie mają odmiany</h3>
<p><strong>Modem</strong> (skrót od <em>modulator–demodulator</em>) to urządzenie zamieniające dane cyfrowe na sygnał dostosowany do właściwości danego medium (modulacja) oraz odtwarzające dane z odebranego sygnału (demodulacja). Nazwa pochodzi z czasów, gdy medium było analogowe (linia telefoniczna), lecz dziś oznacza dowolne urządzenie dopasowujące komputer do konkretnej technologii dostępowej:</p>
<ul>
<li><strong>modem analogowy</strong> (dial-up) — na linii telefonicznej w paśmie głosowym;</li>
<li><strong>modem DSL</strong> — na łączu miedzianym, wykorzystujący pasmo powyżej głosu;</li>
<li><strong>modem kablowy (cable modem)</strong> — w sieci telewizji kablowej, standard DOCSIS;</li>
<li><strong>terminal ONT/ONU</strong> — zakończenie światłowodu (formalnie nie „modulator\", ale pełni analogiczną rolę, zamieniając sygnał optyczny na Ethernet);</li>
<li><strong>modem komórkowy</strong> (LTE/5G) — jako moduł w telefonie lub router z kartą SIM;</li>
<li><strong>modem satelitarny</strong> — obsługujący łączność z terminalem satelitarnym.</li>
</ul>
<p>W praktyce urządzenia w domach są zazwyczaj <strong>bramami (gateway)</strong>, łączącymi funkcje modemu, routera z NAT, przełącznika Ethernet, punktu dostępowego Wi-Fi i serwera DHCP w jednej obudowie. Modem może pracować w <strong>trybie mostu (bridge)</strong>, w którym jedynie przekazuje ramki bez routowania — wtedy router (własny lub operatora) realizuje NAT i uwierzytelnianie.</p>
<h3>6.3. Dial-up i ISDN — historyczne technologie dostępowe</h3>
<p><strong>Modemy analogowe (dial-up).</strong> Sieć telefoniczna została zaprojektowana dla głosu w paśmie <strong>300–3400 Hz</strong> (ok. 3,1 kHz). Skoro pasmo jest tak wąskie, przepływność ograniczona jest twierdzeniem Shannona (przykład 1 w rozdziale 1.5: ok. 35 kb/s). Kolejne standardy modemów, wykorzystujące zaawansowane modulacje QAM i kodowanie kratowe, zbliżały się do tej granicy: <strong>V.34</strong> (do 33,6 kb/s, obie strony analogowe), a następnie <strong>V.90</strong> i <strong>V.92</strong>, które osiągały do 56 kb/s w kierunku „do abonenta\" dzięki temu, że po stronie dostawcy sygnał jest już cyfrowy (PCM, 64 kb/s na kanał) i nie występuje szum kwantowania w tej części toru. Dial-up zajmuje linię telefoniczną (brak rozmów podczas połączenia) i wymaga zestawiania połączenia komutowanego.</p>
<p><strong>ISDN (Integrated Services Digital Network).</strong> Cyfrowa sieć telefoniczna z usługą end-to-end w postaci cyfrowej:</p>
<ul>
<li><strong>BRI (Basic Rate Interface)</strong> — dostęp podstawowy <strong>2B+D</strong>: dwa kanały użytkowe <strong>B</strong> po 64 kb/s (razem 128 kb/s) i kanał sygnalizacyjny <strong>D</strong> 16 kb/s (razem 144 kb/s); dla użytkowników domowych i małych firm;</li>
<li><strong>PRI (Primary Rate Interface)</strong> — dostęp pierwotny: w Europie <strong>30B+D</strong> (łącze E1, 2,048 Mb/s), w Ameryce Północnej <strong>23B+D</strong> (łącze T1, 1,544 Mb/s); dla central firmowych.</li>
</ul>
<p>Dziś ISDN jest wypierany przez technologie IP i telefonię VoIP.</p>
<h3>6.4. DSL — cyfrowa linia abonencka</h3>
<h4>Idea</h4>
<p>Kabel telefoniczny (skrętka miedziana) doprowadzony do niemal każdego domu jest zdolny do przenoszenia sygnałów o częstotliwościach dużo wyższych niż pasmo głosowe (do ok. 4 kHz wykorzystywane w telefonii). Technologie <strong>DSL (Digital Subscriber Line)</strong> wykorzystują <strong>wyższe częstotliwości</strong> tej samej pary przewodów do przesyłania danych, <strong>równolegle</strong> z klasyczną usługą telefoniczną (POTS), bez zajmowania linii. Rodzina technologii zbiorczo oznaczana jest <strong>xDSL</strong>.</p>
<p><img alt=\"Architektura dostępu DSL: lokal abonenta z modemem i splitterem, pętla lokalna, DSLAM i BNG w centrali oraz podział pasma ADSL\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/dsl-architektura.svg\" /></p>
<h4>Elementy architektury</h4>
<ul>
<li><strong>Modem/router DSL</strong> u abonenta.</li>
<li><strong>Splitter (rozdzielacz) lub mikrofiltr</strong> — prosty filtr pasywny (dolnoprzepustowy dla telefonu, górnoprzepustowy dla modemu), który rozdziela sygnał głosowy i dane. Mikrofiltry dołączane są do każdego telefonu w instalacji abonenta, aby sygnał DSL nie powodował trzasków, a sygnał telefonii nie zakłócał modemu.</li>
<li><strong>Pętla lokalna</strong> — istniejąca linia telefoniczna (skrętka miedziana, zwykle 0,4 lub 0,5 mm) o długości do kilku kilometrów.</li>
<li><strong>DSLAM (DSL Access Multiplexer)</strong> — urządzenie w centrali (lub w szafie ulicznej), zawierające wiele modemów DSL po stronie operatora; multipleksuje ruch od wielu abonentów w jedno łącze szybkie (dziś zazwyczaj Ethernet/światłowód).</li>
<li><strong>BNG/BRAS (Broadband Network Gateway / Broadband Remote Access Server)</strong> — urządzenie kończące sesje abonentów: uwierzytelnia je (zwykle przez <strong>RADIUS</strong>), przydziela adresy IP, nakłada limity i profile jakości usług.</li>
<li>Rozgałęźnik ruchu głosowego przekazuje sygnał telefoniczny do komutatora <strong>PSTN</strong>.</li>
</ul>
<h4>Modulacja DMT i podział pasma</h4>
<p>Większość systemów DSL (ADSL, VDSL) stosuje modulację <strong>DMT (Discrete Multi-Tone)</strong>, czyli odmianę OFDM dla linii miedzianej. Pasmo dzielone jest na wiele wąskich podkanałów (<strong>podnośnych, tonów</strong>), np. w ADSL o szerokości <strong>4,3125 kHz</strong> każdy. Zestaw tonów podlega <strong>adaptacyjnemu przydziałowi bitów (bit loading)</strong>: podczas synchronizacji (tzw. <em>training</em>) modem mierzy SNR każdego tonu i przydziela mu tyle bitów, ile ten ton może bezpiecznie przenieść (od 0 do 15 bitów w konstelacji QAM). Tony zakłócone (np. zawartością radiową AM lub silną interferencją) są po prostu wyłączane lub obciążane mniej.</p>
<p><em>Przykład.</em> W ADSL symbole DMT wysyłane są z częstotliwością 4000 na sekundę. Jeśli 200 tonów kierunku „w dół\" przenosi średnio 8 bitów, przepływność wynosi:</p>
<div data-m=\"R = 200 \\cdot 8 \\cdot 4000 = 6{,}4 \\text{ Mb/s}\"></div>
<p>W ADSL pasmo jest rozdzielone tak, że <strong>0–4 kHz</strong> to telefonia, <strong>ok. 25–138 kHz</strong> to kierunek „w górę\" (upstream, do sieci), a <strong>ok. 138 kHz – 1,1 MHz</strong> to kierunek „w dół\" (downstream, do abonenta). Ponieważ zasięg upstream i downstream jest nierówny, nazywa się to łączem <strong>asymetrycznym</strong> (ADSL — <em>Asymmetric</em>), co odpowiada typowemu wzorcowi użytkowania (więcej pobierania niż wysyłania).</p>
<h4>Wersje DSL</h4>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Standard ITU-T</th>
<th>Pasmo</th>
<th>Maks. w dół / w górę</th>
<th>Orientacyjny zasięg</th>
</tr>
</thead>
<tbody>
<tr>
<td>ADSL</td>
<td>G.992.1 (G.dmt), 1999</td>
<td>1,1 MHz</td>
<td>8 Mb/s / 1 Mb/s</td>
<td>do ok. 5 km</td>
</tr>
<tr>
<td>ADSL2</td>
<td>G.992.3, 2002</td>
<td>1,1 MHz</td>
<td>12 Mb/s / 1 Mb/s</td>
<td>do ok. 5 km</td>
</tr>
<tr>
<td>ADSL2+</td>
<td>G.992.5, 2003</td>
<td>2,2 MHz</td>
<td>24 Mb/s / 1–3,5 Mb/s</td>
<td>pełna prędkość do ok. 1,5 km, ok. 3 km — kilka Mb/s</td>
</tr>
<tr>
<td>VDSL</td>
<td>G.993.1, 2001</td>
<td>12 MHz</td>
<td>52 Mb/s / 16 Mb/s</td>
<td>do ok. 1,2 km</td>
</tr>
<tr>
<td>VDSL2</td>
<td>G.993.2, 2006</td>
<td>do 17,7 MHz (profil 17a) lub 30 MHz (30a)</td>
<td>do ok. 100 Mb/s (17a) lub 200 Mb/s (30a), także symetrycznie</td>
<td>do ok. 1 km (17a), do ok. 300 m (30a); dłuższe pętle — niższe prędkości</td>
</tr>
<tr>
<td>G.fast</td>
<td>G.9701, 2014</td>
<td>106 MHz lub 212 MHz</td>
<td>do ok. 1 Gb/s (suma obu kierunków, TDD)</td>
<td>ok. 100–250 m</td>
</tr>
<tr>
<td>SHDSL</td>
<td>G.991.2</td>
<td>pasmo symetryczne</td>
<td>do ok. 5,7 Mb/s na parę, symetrycznie</td>
<td>do kilku km</td>
</tr>
</tbody>
</table>
<p>Wartości zasięgu są <strong>orientacyjne</strong> i silnie zależą od jakości pętli. Kluczowe jest to, że tłumienie miedzi rośnie z częstotliwością i długością, więc <strong>im wyższe pasmo, tym krótszy zasięg</strong>. Dlatego rodzina DSL ewoluowała ku coraz krótszym pętlom: światłowód dochodzi do szafy ulicznej (<strong>FTTC/FTTN</strong>, ostatnie 100–500 m po miedzi z VDSL2) lub do budynku (<strong>FTTB</strong>, G.fast na instalacji wewnętrznej).</p>
<h4>Czynniki wpływające na prędkość DSL</h4>
<ul>
<li><strong>Długość i średnica pętli</strong> — im dłuższa i cieńsza, tym większe tłumienie;</li>
<li><strong>Tłumienie linii i margines SNR</strong> — modem zwykle utrzymuje docelowy zapas SNR (ok. 6 dB), poniżej którego przyjmuje niższą prędkość;</li>
<li><strong>Przesłuchy</strong> — zwłaszcza <strong>FEXT</strong> od sąsiednich par w tym samym kablu; w VDSL2 ograniczane technologią <strong>vectoring</strong> (G.993.5), która mierzy i kasuje przesłuchy między liniami (wymaga koordynacji wszystkich par w kablu pod kontrolą jednego operatora);</li>
<li><strong>Odczepy mostkowane i stare instalacje</strong>, niedopasowania impedancji, korozja;</li>
<li><strong>Interleaving i FEC</strong> — kodowanie korekcyjne Reeda–Solomona z przeplotem poprawia odporność na zakłócenia impulsowe kosztem dodatkowego opóźnienia.</li>
</ul>
<p>Rozróżnia się <strong>prędkość synchronizacji</strong> (sync rate, ustalona przez modemy) i <strong>przepustowość użyteczną</strong> — niższą z powodu narzutów enkapsulacji.</p>
<h4>Enkapsulacja danych w DSL</h4>
<p>Dane użytkownika przesyłane są przez DSL w kilku warstwach:</p>
<ul>
<li><strong>ATM</strong> (w klasycznym ADSL) — dane dzielone na <strong>komórki ATM</strong> o stałej długości 53 B (5 B nagłówka + 48 B danych), co powoduje tzw. „podatek komórkowy\" rzędu 10–15 %; w VDSL2 i nowszych stosuje się <strong>PTM (Packet Transfer Mode)</strong> z efektywnym kodowaniem 64/65 B;</li>
<li><strong>PPPoE</strong> (PPP over Ethernet) — najpopularniejsza metoda uwierzytelniania i tworzenia sesji z BNG; dodaje 8 bajtów narzutu, więc <strong>MTU wynosi 1492 B</strong> zamiast 1500 B (co bywa przyczyną problemów z fragmentacją i stosowania MSS clamping); alternatywą jest <strong>IPoE</strong> (IP over Ethernet) z uwierzytelnianiem opartym na opcjach DHCP lub porcie.</li>
</ul>
<h3>6.5. Sieci kablowe (HFC) i DOCSIS</h3>
<p>Operatorzy telewizji kablowej oferują dostęp do Internetu przez sieć koncentryczną. Nowoczesne sieci mają architekturę <strong>HFC (Hybrid Fiber-Coaxial)</strong>: od głównej stacji czołowej (<strong>headend</strong>) biegnie światłowód do węzłów optycznych, a stamtąd — <strong>kabel koncentryczny</strong> (75 Ω) z wzmacniaczami do domów. Kilkaset gospodarstw domowych w obrębie jednego węzła <strong>współdzieli</strong> pasmo, co odróżnia HFC od DSL (gdzie pętla jest dedykowana każdemu abonentowi).</p>
<p>Standard transmisji danych nazywa się <strong>DOCSIS (Data Over Cable Service Interface Specification)</strong> i jest opracowywany przez CableLabs. Po stronie operatora działa <strong>CMTS (Cable Modem Termination System)</strong>, po stronie abonenta — <strong>modem kablowy</strong>. Kierunek „w dół\" wykorzystuje kanały telewizyjne (w Europie 8 MHz, w USA 6 MHz), a kierunek „w górę\" — dolną część widma (5–65 MHz w Europie, 5–42 MHz w USA).</p>
<table>
<thead>
<tr>
<th>Wersja</th>
<th>Rok</th>
<th>Kluczowe cechy</th>
<th>Typowa przepływność (maks.)</th>
</tr>
</thead>
<tbody>
<tr>
<td>DOCSIS 1.0 / 1.1</td>
<td>1997 / 1999</td>
<td>pojedynczy kanał, QAM-64/256; QoS w 1.1</td>
<td>kilkadziesiąt Mb/s w dół</td>
</tr>
<tr>
<td>DOCSIS 2.0</td>
<td>2001</td>
<td>lepsza przepustowość w górę</td>
<td>kilkadziesiąt Mb/s</td>
</tr>
<tr>
<td>DOCSIS 3.0</td>
<td>2006</td>
<td><strong>bonding kanałów</strong> (łączenie 4, 8, 16, 32 kanałów), IPv6</td>
<td>ponad 1 Gb/s w dół</td>
</tr>
<tr>
<td>DOCSIS 3.1</td>
<td>2013</td>
<td>modulacja <strong>OFDM/OFDMA</strong>, do 4096-QAM, kanały 24–192 MHz</td>
<td>do 10 Gb/s w dół, 1–2 Gb/s w górę</td>
</tr>
<tr>
<td>DOCSIS 4.0</td>
<td>2019</td>
<td>tryb <strong>Full Duplex</strong> (FDX) i rozszerzone pasmo (do 1,8 GHz)</td>
<td>do 10 Gb/s w dół i kilka Gb/s w górę</td>
</tr>
</tbody>
</table>
<p>Ponieważ medium jest współdzielone, w kierunku „w górę\" stosuje się mechanizm <strong>rezerwacji</strong> (modem żąda przydziału czasu od CMTS, która harmonogramuje dostęp — bez kolizji, w odróżnieniu od CSMA). Wadą HFC jest <strong>lejek szumowy (noise funnel)</strong>: szumy z wielu domów sumują się w kierunku „w górę\", co wymaga starannej konserwacji sieci.</p>
<h3>6.6. Dostęp światłowodowy: FTTx i PON</h3>
<p>Światłowód dostępowy dociera coraz częściej do samego budynku lub mieszkania. Rozróżnia się:</p>
<ul>
<li><strong>FTTH (Fiber to the Home)</strong> — światłowód do lokalu abonenta;</li>
<li><strong>FTTB (Fiber to the Building)</strong> — do budynku, dalej Ethernet lub G.fast w instalacji wewnętrznej;</li>
<li><strong>FTTC / FTTN (to the Curb / Node)</strong> — do szafy ulicznej, dalej VDSL2 po miedzi;</li>
<li><strong>FTTdp (Distribution Point)</strong> — do punktu bardzo blisko lokalu (G.fast).</li>
</ul>
<h4>Topologie: punkt–punkt i PON</h4>
<p>Klasyczne łącza optyczne są <strong>punkt–punkt</strong>: osobne włókno od centrali do każdego abonenta (najlepsza przepustowość, wysoki koszt). Bardziej ekonomiczna jest <strong>pasywna sieć optyczna (PON — Passive Optical Network)</strong>, w której <strong>jedno włókno z centrali</strong> rozgałęzia się za pomocą <strong>pasywnego (niezasilanego) rozgałęźnika optycznego (splitter)</strong> do wielu abonentów (zazwyczaj 32 lub 64):</p>
<ul>
<li><strong>OLT (Optical Line Terminal)</strong> — urządzenie w centrali;</li>
<li><strong>splitter optyczny</strong> — pasywny element, dzielący moc optyczną (bez zasilania, w szafce ulicznej lub w budynku);</li>
<li><strong>ONT / ONU (Optical Network Terminal / Unit)</strong> — zakończenie u abonenta.</li>
</ul>
<p>Ponieważ splitter dzieli moc, wprowadza tłumienie zależne od stopnia podziału (orientacyjnie: 1:2 → ok. 3,5 dB, 1:8 → ok. 10,5 dB, 1:32 → ok. 17,5 dB, 1:64 → ok. 21 dB). Bilans mocy sieci PON ogranicza więc zasięg (zwykle do 20 km) i współczynnik podziału.</p>
<p><strong>Zasada działania.</strong> W kierunku „w dół\" OLT nadaje <strong>ciągły strumień do wszystkich ONT</strong> (broadcast, zwielokrotnienie czasowe TDM); każdy ONT odbiera wyłącznie własne dane (dane są szyfrowane AES dla poszczególnych abonentów). W kierunku „w górę\" wszystkie ONT dzielą wspólne włókno w sposób <strong>TDMA</strong>: każdy ONT dostaje od OLT wąską szczelinę czasową na nadawanie; OLT mierzy odległość do każdego ONT (<strong>ranging</strong>), aby wyrównać czasy propagacji i uniknąć nakładania się transmisji. Kierunki „w dół\" i „w górę\" wykorzystują różne długości fali (WDM), dzięki czemu jedno włókno służy do transmisji w obu kierunkach.</p>
<table>
<thead>
<tr>
<th>Standard</th>
<th>Organizacja</th>
<th>Przepływność w dół / w górę</th>
<th>Długości fali (dół / góra)</th>
</tr>
</thead>
<tbody>
<tr>
<td>EPON</td>
<td>IEEE 802.3ah</td>
<td>1 / 1 Gb/s</td>
<td>1490 / 1310 nm</td>
</tr>
<tr>
<td>10G-EPON</td>
<td>IEEE 802.3av</td>
<td>10 / 1 lub 10 / 10 Gb/s</td>
<td>1577 / 1270 nm</td>
</tr>
<tr>
<td>GPON</td>
<td>ITU-T G.984</td>
<td>2,488 / 1,244 Gb/s</td>
<td>1490 / 1310 nm (wideo RF: 1550 nm)</td>
</tr>
<tr>
<td>XG-PON</td>
<td>ITU-T G.987</td>
<td>10 / 2,5 Gb/s</td>
<td>1577 / 1270 nm</td>
</tr>
<tr>
<td>XGS-PON</td>
<td>ITU-T G.9807.1</td>
<td>10 / 10 Gb/s</td>
<td>1577 / 1270 nm</td>
</tr>
<tr>
<td>NG-PON2</td>
<td>ITU-T G.989</td>
<td>40 / 10 Gb/s (4 długości fali TWDM)</td>
<td>pasma L i C</td>
</tr>
<tr>
<td>25GS-PON, 50G-PON</td>
<td>ITU-T G.9804 i inne</td>
<td>25–50 Gb/s</td>
<td>rozwijane</td>
</tr>
</tbody>
</table>
<p>Zalety PON: oszczędność włókien i portów w centrali, brak zasilanej elektroniki w terenie (niższe koszty utrzymania i awaryjność), duże przepływności i długoterminowa skalowalność. Wady: współdzielenie przepustowości między abonentów przypisanych do jednego OLT/portu, konieczność dokładnego bilansu mocy, trudniejsza lokalizacja awarii.</p>
<h3>6.7. Dostęp radiowy i satelitarny</h3>
<ul>
<li><strong>Sieci komórkowe (LTE, 5G NR)</strong> — dostęp mobilny i jako <strong>FWA (Fixed Wireless Access)</strong>: stacjonarny modem lub router z zewnętrzną anteną zastępuje łącze kablowe, szczególnie na obszarach bez światłowodu. Przepływności od kilkudziesięciu Mb/s (LTE) do kilkuset Mb/s i więcej (5G); pasmo współdzielone z innymi użytkownikami komórki, opóźnienie ok. 10–40 ms.</li>
<li><strong>WISP (Wireless ISP)</strong> — lokalni operatorzy internetowi wykorzystujący łącza radiowe (pasma 5 GHz, 24 GHz, 60 GHz) punkt–wielopunkt do dostarczania Internetu w gęsto zabudowanych obszarach lub na wsiach.</li>
<li><strong>Satelitarny dostęp do Internetu.</strong> Satelity <strong>geostacjonarne (GEO)</strong> na wysokości ok. 35 786 km mają duże opóźnienie propagacji: sygnał pokonuje drogę Ziemia → satelita → Ziemia w ok. 240 ms, czyli <strong>RTT</strong> wynosi ok. 500–600 ms, co utrudnia zastosowania interaktywne. Konstelacje na niskiej orbicie (<strong>LEO</strong>, ok. 500–1200 km) zmniejszają opóźnienie do kilkudziesięciu milisekund, ale wymagają dużej liczby satelitów i anten śledzących. Satelity zapewniają dostęp niemal wszędzie, z ograniczeniami pasma, wpływu pogody i zasięgu geograficznego.</li>
</ul>
<h3>6.8. Porównanie technologii dostępowych</h3>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Medium</th>
<th>Typowa przepływność</th>
<th>Charakter łącza</th>
<th>Główne ograniczenia</th>
</tr>
</thead>
<tbody>
<tr>
<td>Dial-up (V.90/V.92)</td>
<td>skrętka telefoniczna</td>
<td>do 56 kb/s</td>
<td>komutowane</td>
<td>zajmuje linię, bardzo wolne</td>
</tr>
<tr>
<td>ISDN BRI</td>
<td>skrętka</td>
<td>128 kb/s</td>
<td>komutowane, cyfrowe</td>
<td>przestarzały</td>
</tr>
<tr>
<td>ADSL / ADSL2+</td>
<td>skrętka</td>
<td>8–24 Mb/s</td>
<td>dedykowana pętla, asymetryczne</td>
<td>zasięg, tłumienie</td>
</tr>
<tr>
<td>VDSL2 (z vectoringiem)</td>
<td>skrętka</td>
<td>50–200 Mb/s</td>
<td>dedykowana pętla</td>
<td>zasięg do ok. 1 km</td>
</tr>
<tr>
<td>G.fast</td>
<td>skrętka</td>
<td>do ok. 1 Gb/s</td>
<td>dedykowana pętla</td>
<td>zasięg 100–250 m</td>
</tr>
<tr>
<td>Kablowy DOCSIS 3.x</td>
<td>koncentryk (HFC)</td>
<td>100 Mb/s – ponad 1 Gb/s</td>
<td>współdzielone</td>
<td>zmienność przy dużym obciążeniu węzła</td>
</tr>
<tr>
<td>FTTH (P2P / PON)</td>
<td>światłowód</td>
<td>100 Mb/s – 10 Gb/s</td>
<td>punkt–punkt lub współdzielone (PON)</td>
<td>koszt budowy</td>
</tr>
<tr>
<td>LTE / 5G FWA</td>
<td>radio</td>
<td>30 Mb/s – ponad 1 Gb/s</td>
<td>współdzielone</td>
<td>zmienne warunki propagacji</td>
</tr>
<tr>
<td>Satelita GEO</td>
<td>radio</td>
<td>10–100 Mb/s</td>
<td>współdzielone</td>
<td>opóźnienie ok. 500–600 ms</td>
</tr>
<tr>
<td>Satelita LEO</td>
<td>radio</td>
<td>50–300 Mb/s</td>
<td>współdzielone</td>
<td>koszt terminala, zmienność</td>
</tr>
</tbody>
</table>
<h3>6.9. Sieci rozległe (WAN)</h3>
<h4>Definicja i cechy</h4>
<p><strong>Sieć rozległa (WAN — Wide Area Network)</strong> łączy sieci lokalne (LAN) znajdujące się w różnych miastach, krajach lub kontynentach. Jej charakterystyczną cechą jest to, że infrastruktura zwykle <strong>nie należy do organizacji korzystającej z usługi</strong>, lecz jest <strong>dzierżawiona od operatorów telekomunikacyjnych</strong>, którzy pobierają opłaty i gwarantują parametry usługi w umowie SLA.</p>
<table>
<thead>
<tr>
<th>Cecha</th>
<th>LAN</th>
<th>WAN</th>
</tr>
</thead>
<tbody>
<tr>
<td>Zasięg</td>
<td>budynek, kampus</td>
<td>miasto, kraj, świat</td>
</tr>
<tr>
<td>Właściciel infrastruktury</td>
<td>organizacja</td>
<td>operator telekomunikacyjny</td>
</tr>
<tr>
<td>Przepływność</td>
<td>zwykle 1–100 Gb/s</td>
<td>od kilkuset kb/s do setek Gb/s (zależnie od kosztu)</td>
</tr>
<tr>
<td>Koszt eksploatacji</td>
<td>niski</td>
<td>wysoki (opłaty za usługi)</td>
</tr>
<tr>
<td>Opóźnienie</td>
<td>mikrosekundy–milisekundy</td>
<td>milisekundy–setki milisekund</td>
</tr>
<tr>
<td>Typowe technologie</td>
<td>Ethernet, Wi-Fi</td>
<td>łącza dzierżawione, MPLS, Metro Ethernet, VPN, SD-WAN, SDH, DWDM</td>
</tr>
</tbody>
</table>
<h4>Wybrane technologie łączy WAN</h4>
<p><strong>Łącza dzierżawione (leased lines).</strong> Stałe, dedykowane połączenie punkt–punkt o gwarantowanej przepustowości, dostępne przez cały czas. Klasyczne hierarchie <strong>PDH</strong>: <strong>E1</strong> (2,048 Mb/s; 32 szczeliny po 64 kb/s, 30 użytkowych + synchronizacja + sygnalizacja; standard europejski) i <strong>T1</strong> (1,544 Mb/s; 24 kanały; Ameryka Północna); wyższe rzędy: E3 (34,368 Mb/s), T3 (44,736 Mb/s). Nowsza hierarchia synchroniczna <strong>SDH/SONET</strong>: STM-1 (155,52 Mb/s), STM-4 (622,08 Mb/s), STM-16 (2,488 Gb/s), STM-64 (9,953 Gb/s). Dziś łącza dzierżawione realizowane są często jako usługi Ethernet lub wolne długości fal (DWDM) w sieci operatora.</p>
<p><strong>Komutacja łączy (circuit switching).</strong> Dla czasu trwania rozmowy zestawiany jest dedykowany obwód (PSTN, ISDN). Zaleta: gwarantowana przepustowość i stałe opóźnienie. Wada: marnowanie zasobów przy ruchu nieregularnym (dane komputerowe).</p>
<p><strong>Komutacja pakietów (packet switching).</strong> Dane dzielone są na pakiety przesyłane niezależnie, a łącza są współdzielone; wykorzystanie zasobów jest wydajne dla ruchu „impulsowego\". Historyczne technologie: <strong>X.25</strong>, <strong>Frame Relay</strong> (obwody wirtualne identyfikowane przez DLCI), <strong>ATM</strong> (komórki 53 B, identyfikatory VPI/VCI). Ich rolę przejęły <strong>IP/MPLS</strong> i <strong>Ethernet operatorski</strong>.</p>
<p><strong>MPLS (Multiprotocol Label Switching).</strong> Pakiety w sieci operatora otrzymują krótką <strong>etykietę</strong> (nagłówek 32 bity: 20-bitowa etykieta, 3 bity klasy ruchu, bit dna stosu, 8-bitowe TTL), na podstawie której routery (<strong>LSR</strong>) przełączają je szybko, bez pełnej analizy adresu IP; na brzegach sieci działają routery <strong>LER</strong>, dodające i usuwające etykiety. MPLS umożliwia:</p>
<ul>
<li><strong>VPN warstwy 3</strong> (L3VPN) — izolowane wirtualne sieci IP klientów w jednej infrastrukturze operatora (osobne tablice routingu VRF);</li>
<li><strong>VPN warstwy 2</strong> (m.in. VPLS) — przezroczyste łączenie sieci Ethernet;</li>
<li><strong>inżynierię ruchu i QoS</strong> — ustalanie ścieżek i gwarancje jakości.</li>
</ul>
<p><strong>Metro Ethernet / Carrier Ethernet.</strong> Usługi Ethernetowe świadczone przez operatora w obszarze metropolitalnym i szerzej; standaryzowane przez organizację <strong>MEF</strong> jako <strong>E-Line</strong> (punkt–punkt), <strong>E-LAN</strong> (wielopunktowa, jak wirtualny przełącznik) i <strong>E-Tree</strong> (gwiazda). Klient widzi „kabel Ethernet\" lub „przełącznik\" rozciągnięty na wiele lokalizacji; w sieci operatora ruch klientów rozdzielają etykiety <strong>Q-in-Q (802.1ad)</strong> lub MPLS.</p>
<p><strong>VPN przez Internet.</strong> Tania alternatywa dla łączy dzierżawionych: zaszyfrowane <strong>tunele</strong> przez publiczny Internet, np. <strong>IPsec</strong> (IKEv2 + ESP), <strong>SSL/TLS VPN</strong>, <strong>WireGuard</strong>. Zapewniają poufność i uwierzytelnienie, ale nie gwarantują jakości usług (opóźnień, utraty pakietów), ponieważ ruch przechodzi przez sieć „best effort\".</p>
<p><strong>SD-WAN (Software-Defined WAN).</strong> Rozwiązanie łączące wiele łączy (światłowodowe, kablowe, LTE/5G, MPLS) w jedną <strong>nakładkę logiczną</strong> (overlay) sterowaną centralnie. Kontroler dobiera ścieżkę dla aplikacji na podstawie bieżącej jakości łączy (opóźnienie, jitter, straty), zapewniając redundancję i optymalizację kosztów; tunele są szyfrowane, a konfiguracja nowych oddziałów może być zautomatyzowana (<strong>zero-touch provisioning</strong>).</p>
<h4>Topologie WAN</h4>
<p><img alt=\"Topologie WAN: punkt–punkt, gwiazda (hub-and-spoke) i pełna siatka wraz ze wzorami na liczbę łączy\" src=\"/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci/wan-topologie.svg\" /></p>
<ul>
<li><strong>Punkt–punkt</strong> — jedno dedykowane łącze między dwiema lokalizacjami; proste, przewidywalne, lecz nieekonomiczne dla wielu lokalizacji.</li>
<li><strong>Gwiazda (hub-and-spoke)</strong> — oddziały łączą się z centralą; koszt rośnie liniowo (n − 1 łączy), ale ruch między oddziałami przechodzi przez centralę (dodatkowe opóźnienie), a centrala jest punktem awarii.</li>
<li><strong>Pełna siatka (full mesh)</strong> — każda lokalizacja połączona z każdą; największa niezawodność i najkrótsze ścieżki, ale liczba łączy rośnie kwadratowo: <span data-m=\"n(n-1)/2\"></span> (dla 10 lokalizacji: 45 łączy).</li>
<li><strong>Częściowa siatka (partial mesh)</strong> — kompromis: łączone są tylko kluczowe lokalizacje.</li>
</ul>
<h4>Protokoły warstwy łącza w WAN</h4>
<ul>
<li><strong>HDLC</strong> (High-Level Data Link Control) — synchroniczny protokół ramkowania na łączach punkt–punkt; wersje producenckie (np. Cisco HDLC);</li>
<li><strong>PPP (Point-to-Point Protocol, RFC 1661)</strong> — uniwersalny protokół dla łączy punkt–punkt, składający się z: <strong>LCP</strong> (Link Control Protocol — negocjacja parametrów, uwierzytelnianie), protokołów uwierzytelniania <strong>PAP</strong> (hasło jawne, nie zalecany) i <strong>CHAP</strong> (wyzwanie–odpowiedź) oraz <strong>NCP</strong> (np. <strong>IPCP</strong> — konfiguracja adresu IP). PPP jest podstawą dostępu dial-up, DSL (w wariancie PPPoE/PPPoA) i wielu łączy szeregowych.</li>
</ul>
<h4>Parametry usług WAN i SLA</h4>
<p>Przy wyborze usługi WAN porównuje się:</p>
<ul>
<li><strong>przepływność</strong> (i <strong>CIR — Committed Information Rate</strong>, gwarantowaną część),</li>
<li><strong>opóźnienie, jitter, utratę pakietów</strong>,</li>
<li><strong>dostępność</strong> — np. 99,9 % oznacza do 8,76 godziny przestoju w roku, a 99,99 % — do ok. 53 minut,</li>
<li><strong>czas usunięcia awarii (MTTR)</strong>,</li>
<li><strong>symetrię</strong> i możliwość zwiększenia przepływności,</li>
<li><strong>koszt</strong> i model rozliczeń (łącze stałe vs zużycie),</li>
<li><strong>zabezpieczenia</strong> i sposób izolacji ruchu.</li>
</ul>
<p>Umowa <strong>SLA (Service Level Agreement)</strong> określa gwarantowane wartości oraz rekompensaty w razie ich naruszenia.</p>
<h3>6.10. Kierunki rozwoju</h3>
<p>Można wskazać kilka trendów w mediach transmisyjnych i technologiach dostępowych:</p>
<ul>
<li><strong>Światłowód wszędzie</strong>, gdzie to ekonomicznie uzasadnione — FTTH jako docelowy standard, PON o coraz wyższych przepływnościach (25G/50G);</li>
<li><strong>Wygaszanie starych technologii</strong> (ISDN, dial-up, część ADSL) i skracanie pętli miedzianych (FTTdp, G.fast);</li>
<li><strong>Konwergencja Wi-Fi i sieci komórkowych</strong> — Wi-Fi 7 i 5G jako uzupełniające się technologie, FWA jako alternatywa dla kabla;</li>
<li><strong>Stałe zwiększanie wykorzystania widma</strong> — pasmo 6 GHz, szersze kanały, wyższe modulacje, MLO;</li>
<li><strong>Sieci definiowane programowo</strong> — SD-WAN, automatyzacja i zarządzanie chmurowe;</li>
<li><strong>IPv6</strong> jako standard adresacji dla milionów urządzeń IoT dołączanych radiowo.</li>
</ul>
<h2>7. Podsumowanie</h2>
<p>Media transmisyjne stanowią fundament, na którym opierają się wszystkie wyższe warstwy sieci. <strong>Skrętka miedziana</strong> dzięki niskim kosztom i możliwości zasilania (PoE) pozostaje podstawowym medium w sieciach lokalnych, jednak jej zasięg (100 m) i podatność na zakłócenia ograniczają zastosowania. <strong>Światłowody</strong> oferują praktycznie nieograniczone pasmo, ogromne zasięgi i odporność na zakłócenia, przez co stanowią podstawę sieci szkieletowych, centrów danych i dostępu FTTH. <strong>Fale radiowe</strong> zapewniają mobilność i elastyczność, ale wymagają dzielenia ograniczonego widma i zabezpieczenia transmisji.</p>
<p>Rodzina <strong>IEEE 802.11</strong> w ciągu ćwierćwiecza przebyła drogę od 2 Mb/s do ponad 46 Gb/s (teoretycznie) dzięki zastosowaniu OFDM, MIMO, szerszych kanałów, wyższych modulacji, OFDMA i wielołączowości (MLO). Jednocześnie — ze względu na mechanizm CSMA/CA i współdzielone medium — Wi-Fi pozostaje technologią, której rzeczywista przepustowość zależy od jakości sygnału, liczby użytkowników i interferencji.</p>
<p><strong>Technologie dostępowe</strong> (DSL, kablowe, światłowodowe, radiowe, satelitarne) wykorzystują różne media i różne kompromisy między kosztem, przepływnością i zasięgiem, a <strong>sieci WAN</strong> łączą lokalizacje przy użyciu łączy dzierżawionych, MPLS, Metro Ethernet, VPN i coraz częściej SD-WAN.</p>
<h3>Zestawienie porównawcze najważniejszych technologii</h3>
<table>
<thead>
<tr>
<th>Technologia</th>
<th>Medium</th>
<th>Typowy zakres</th>
<th>Przepływność</th>
<th>Charakterystyczne cechy</th>
</tr>
</thead>
<tbody>
<tr>
<td>Ethernet Cat 6A</td>
<td>skrętka</td>
<td>do 100 m</td>
<td>do 10 Gb/s</td>
<td>PoE, niski koszt, EMI</td>
</tr>
<tr>
<td>Ethernet SMF (LR)</td>
<td>światłowód jednomodowy</td>
<td>10 km i więcej</td>
<td>10–400 Gb/s</td>
<td>brak EMI, wysoki koszt terminali</td>
</tr>
<tr>
<td>Wi-Fi 6 / 6E</td>
<td>radio 2,4/5/6 GHz</td>
<td>kilkadziesiąt metrów w budynku</td>
<td>do 9,6 Gb/s (teoret.)</td>
<td>OFDMA, efektywność w gęstych sieciach</td>
</tr>
<tr>
<td>Wi-Fi 7</td>
<td>radio 2,4/5/6 GHz</td>
<td>kilkadziesiąt metrów w budynku</td>
<td>do 46 Gb/s (teoret.)</td>
<td>MLO, 320 MHz, 4096-QAM</td>
</tr>
<tr>
<td>VDSL2</td>
<td>miedź telefoniczna</td>
<td>do ok. 1 km</td>
<td>do 100–200 Mb/s</td>
<td>wykorzystuje istniejące łącza</td>
</tr>
<tr>
<td>DOCSIS 3.1</td>
<td>koncentryk HFC</td>
<td>HFC</td>
<td>do 10 Gb/s</td>
<td>medium współdzielone</td>
</tr>
<tr>
<td>XGS-PON</td>
<td>światłowód (PON)</td>
<td>do 20 km</td>
<td>10 / 10 Gb/s</td>
<td>pasywny rozgałęźnik</td>
</tr>
<tr>
<td>MPLS VPN / Metro Ethernet</td>
<td>infrastruktura operatora</td>
<td>kraj, region</td>
<td>zgodnie z umową</td>
<td>SLA, izolacja klientów</td>
</tr>
</tbody>
</table>
<h2>8. Słownik podstawowych pojęć</h2>
<table>
<thead>
<tr>
<th>Pojęcie</th>
<th>Znaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>AP (Access Point)</strong></td>
<td>punkt dostępowy łączący klientów Wi-Fi z siecią przewodową</td>
</tr>
<tr>
<td><strong>Backoff</strong></td>
<td>losowe opóźnienie przed próbą nadawania w CSMA/CA</td>
</tr>
<tr>
<td><strong>BSS / ESS</strong></td>
<td>pojedyncza komórka Wi-Fi / zbiór połączonych komórek o wspólnym SSID</td>
</tr>
<tr>
<td><strong>CCK, DSSS</strong></td>
<td>techniki rozpraszania widma stosowane w 802.11 i 802.11b</td>
</tr>
<tr>
<td><strong>CIR</strong></td>
<td>Committed Information Rate — gwarantowana przepływność usługi WAN</td>
</tr>
<tr>
<td><strong>CMTS</strong></td>
<td>urządzenie po stronie operatora w sieci kablowej</td>
</tr>
<tr>
<td><strong>CPE</strong></td>
<td>urządzenie po stronie abonenta</td>
</tr>
<tr>
<td><strong>DFS</strong></td>
<td>mechanizm ustępowania radarom w paśmie 5 GHz</td>
</tr>
<tr>
<td><strong>DMT</strong></td>
<td>modulacja wielotonowa stosowana w DSL</td>
</tr>
<tr>
<td><strong>DSLAM</strong></td>
<td>multiplekser DSL w centrali lub szafie ulicznej</td>
</tr>
<tr>
<td><strong>EIRP</strong></td>
<td>równoważna moc promieniowana izotropowo</td>
</tr>
<tr>
<td><strong>FSPL</strong></td>
<td>tłumienie w przestrzeni swobodnej</td>
</tr>
<tr>
<td><strong>MCS</strong></td>
<td>zestaw modulacji i kodowania w Wi-Fi</td>
</tr>
<tr>
<td><strong>MIMO / MU-MIMO</strong></td>
<td>wiele anten / wielu użytkowników jednocześnie</td>
</tr>
<tr>
<td><strong>MLO</strong></td>
<td>wielołączowość w Wi-Fi 7</td>
</tr>
<tr>
<td><strong>NAV</strong></td>
<td>wirtualny licznik zajętości medium w Wi-Fi</td>
</tr>
<tr>
<td><strong>NEXT / FEXT</strong></td>
<td>przesłuch zbliżny / zdalny</td>
</tr>
<tr>
<td><strong>OFDM / OFDMA</strong></td>
<td>zwielokrotnienie z ortogonalnymi podnośnymi / jego wielodostępny wariant</td>
</tr>
<tr>
<td><strong>OLT / ONT</strong></td>
<td>zakończenie sieci PON po stronie operatora / abonenta</td>
</tr>
<tr>
<td><strong>PoE</strong></td>
<td>zasilanie urządzeń przez kabel Ethernet</td>
</tr>
<tr>
<td><strong>PON</strong></td>
<td>pasywna sieć optyczna</td>
</tr>
<tr>
<td><strong>RSSI</strong></td>
<td>wskaźnik mocy odbieranego sygnału</td>
</tr>
<tr>
<td><strong>SNR</strong></td>
<td>stosunek sygnału do szumu</td>
</tr>
<tr>
<td><strong>SSID</strong></td>
<td>nazwa sieci Wi-Fi</td>
</tr>
<tr>
<td><strong>WDM</strong></td>
<td>zwielokrotnienie falowe w światłowodzie</td>
</tr>
</tbody>
</table>
<h2>9. Pytania kontrolne i zadania</h2>
<h3>Pytania</h3>
<ol>
<li>Wyjaśnij, dlaczego skręcenie przewodów w parze i różnicowy sposób transmisji poprawiają odporność skrętki na zakłócenia. Do czego służą różne skoki skrętu poszczególnych par w kablu?</li>
<li>Opisz różnicę między kablem U/UTP, F/UTP i S/FTP. Jakich wymagań instalacyjnych wymaga stosowanie ekranowanych kabli?</li>
<li>Wyjaśnij, na czym polega zjawisko całkowitego wewnętrznego odbicia i jaką rolę odgrywają rdzeń i płaszcz światłowodu. Dlaczego różnica współczynników załamania jest bardzo mała?</li>
<li>Porównaj światłowody wielomodowe i jednomodowe pod względem średnicy rdzenia, dyspersji, zasięgu i zastosowań. Czym jest dyspersja modowa i jak łagodzi ją profil gradientowy?</li>
<li>Wyjaśnij, dlaczego tłumienie sygnału radiowego w wolnej przestrzeni rośnie wraz z częstotliwością i odległością. Jakie znaczenie ma to dla różnic w zasięgu Wi-Fi 2,4 GHz i 5 GHz?</li>
<li>Czym różni się modulacja 256-QAM od 4096-QAM pod względem liczby bitów na symbol i wymaganego SNR? Dlaczego wyższe modulacje wybierane są dopiero przy dobrym sygnale?</li>
<li>Wyjaśnij, dlaczego w sieciach Wi-Fi stosuje się CSMA/CA zamiast CSMA/CD. Na czym polegają problem ukrytej stacji i mechanizm RTS/CTS?</li>
<li>Wymień najważniejsze cechy standardów 802.11n, 802.11ac, 802.11ax i 802.11be oraz wskaż, które z nich dotyczą przede wszystkim wzrostu przepływności, a które — efektywności w gęstych sieciach.</li>
<li>Opisz architekturę dostępu ADSL: rolę splittera, DSLAM i BNG. Dlaczego prędkość DSL maleje wraz z długością pętli i jak działa modulacja DMT?</li>
<li>Porównaj technologie dostępowe DSL, DOCSIS i PON (w tym pod względem medium, współdzielenia pasma i przepływności) oraz wyjaśnij różnicę między łączem dzierżawionym, MPLS VPN i VPN przez Internet w kontekście sieci WAN.</li>
</ol>
<h3>Zadania obliczeniowe</h3>
<p><strong>Zadanie 1.</strong> Oblicz teoretyczną przepływność warstwy fizycznej Wi-Fi 6 (802.11ax) przy kanale 160 MHz, dwóch strumieniach przestrzennych, modulacji 1024-QAM z kodowaniem 3/4 (MCS 10) i przedziale ochronnym 1,6 µs. (Wskazówka: 1960 podnośnych danych, symbol 12,8 µs + GI.)</p>
<p><strong>Zadanie 2.</strong> Oblicz tłumienie w przestrzeni swobodnej (FSPL) na odległości 30 m dla częstotliwości 2450 MHz oraz 5500 MHz. Ile decybeli wynosi różnica?</p>
<p><strong>Zadanie 3.</strong> Łącze jednomodowe o długości 12 km pracuje przy 1550 nm (tłumienność 0,22 dB/km). Zawiera 5 spawów po 0,08 dB oraz 2 pary złączy po 0,5 dB. Przyjęto margines 3 dB. Transceiver ma moc nadawczą −3 dBm i czułość odbiornika −18 dBm. Oblicz sumę strat i sprawdź, czy łącze zadziała.</p>
<p><strong>Zadanie 4.</strong> Oblicz pojemność kanału Shannona dla szerokości pasma 20 MHz i SNR = 25 dB. Porównaj wynik z teoretyczną przepływnością Wi-Fi 4 (802.11n) 1×1 w kanale 20 MHz (72,2 Mb/s).</p>
<h3>Klucz odpowiedzi do zadań</h3>
<p><strong>Zadanie 1.</strong> Symbol: <span data-m=\"12{,}8 + 1{,}6 = 14{,}4\"></span> µs. Na jeden strumień: <span data-m=\"1960 \\cdot 10 \\cdot 0{,}75 = 14\\,700\"></span> bitów, czyli <span data-m=\"14\\,700 / 14{,}4\\ \\mu\\text{s} \\approx 1020{,}8\"></span> Mb/s. Dla dwóch strumieni: <strong>ok. 2041,7 Mb/s (ok. 2,04 Gb/s)</strong>.</p>
<p><strong>Zadanie 2.</strong> <span data-m=\"\\text{FSPL} = 20\\log_{10}(30) + 20\\log_{10}(f) - 27{,}55\"></span>. Dla 2450 MHz: <span data-m=\"29{,}54 + 67{,}78 - 27{,}55 \\approx 69{,}8\"></span> dB. Dla 5500 MHz: <span data-m=\"29{,}54 + 74{,}81 - 27{,}55 \\approx 76{,}8\"></span> dB. Różnica wynosi <strong>ok. 7,0 dB</strong> (czyli <span data-m=\"20\\log_{10}(5500/2450)\"></span>).</p>
<p><strong>Zadanie 3.</strong> Straty: <span data-m=\"12 \\cdot 0{,}22 = 2{,}64\"></span> dB (włókno) <span data-m=\"+ 5 \\cdot 0{,}08 = 0{,}4\"></span> dB (spawy) <span data-m=\"+ 2 \\cdot 0{,}5 = 1{,}0\"></span> dB (złącza) <span data-m=\"+ 3\"></span> dB (margines) <span data-m=\"= \\mathbf{7{,}04}\"></span> dB. Budżet: <span data-m=\"-3 - (-18) = 15\"></span> dB. Rezerwa ponad zaplanowany margines to <span data-m=\"15 - 7{,}04 \\approx 7{,}96\"></span> dB, więc <strong>łącze zadziała z dużym zapasem</strong>. (Uwaga: dla bardzo krótkich łączy problemem bywa nadmiar mocy, wymagający tłumika.)</p>
<p><strong>Zadanie 4.</strong> SNR = 25 dB → 316,2 razy. <span data-m=\"C = 20\\cdot 10^6 \\cdot \\log_2(1 + 316{,}2) \\approx 20\\cdot 10^6 \\cdot 8{,}31 \\approx \\mathbf{166{,}2}\"></span> Mb/s. Przepływność Wi-Fi 4 1×1 (72,2 Mb/s) stanowi około 43 % tej granicy — pokazuje to, że rzeczywiste systemy pracują poniżej granicy Shannona i że ich rozwój (wyższe modulacje, lepsze kodowanie, więcej strumieni MIMO) zmierza do jej przybliżania lub jej „obejścia\" przez zwielokrotnienie kanałów przestrzennych.</p>", "@Page:/var/www/html/user/pages/05.lsk/04.media_transmisyjne_i_standardy_sieci", "");
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
