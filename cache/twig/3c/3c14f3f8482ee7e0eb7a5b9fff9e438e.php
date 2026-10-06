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

/* @Page:/var/www/html/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6 */
class __TwigTemplate_377c31dd187c66e56e304a9fcd4ecbc8_sourced extends Template
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
        yield "<h2>Wprowadzenie</h2>
<p>Warstwa sieciowa (warstwa 3 modelu ISO/OSI) jest miejscem, w którym pojedyncze sieci lokalne — każda ze swoją niezależną adresacją fizyczną, swoim medium transmisyjnym i swoimi urządzeniami warstwy 2 — zostają połączone w jedną, spójną, globalną strukturę: internet. To właśnie tutaj żyje protokół <strong>IP (Internet Protocol)</strong>, będący dosłownie tym „klejem\", który sprawia, że ramka wysłana z laptopa w Warszawie może dotrzeć do serwera w Tokio, przechodząc po drodze przez dziesiątki różnych sieci, technologii łącza i administratorów, z których żaden nie musi wiedzieć nic o pozostałych — musi jedynie umieć przekazać pakiet IP o krok bliżej celu.</p>
<p>Ten materiał koncentruje się przede wszystkim na <strong>protokole IPv4</strong> — jego roli, adresacji logicznej oraz drobiazgowej, pole po polu, analizie budowy nagłówka, ze szczególnym naciskiem na mechanizmy IHL, ToS/DiffServ, TTL, fragmentację oraz identyfikację protokołu warstwy wyższej. W dalszej części materiał przedstawia również <strong>protokół IPv6</strong>, jego nagłówek i najważniejsze różnice względem poprzednika, aby całość dawała pełny, porównawczy obraz warstwy sieciowej we współczesnych sieciach.</p>
<hr />
<h2>1. Rola warstwy sieciowej</h2>
<h3>1.1. Zadania warstwy 3</h3>
<p>Warstwa sieciowa odpowiada za dostarczenie danych <strong>od hosta źródłowego do hosta docelowego</strong>, potencjalnie przez wiele pośredniczących sieci, niezależnie od technologii warstwy 2 każdej z nich. Do jej podstawowych zadań należą:</p>
<ul>
<li><strong>adresacja logiczna</strong> — nadanie każdemu urządzeniu w sieci unikalnego, globalnie (lub przynajmniej w obrębie danej sieci) rozpoznawalnego adresu, niezależnego od technologii fizycznej łącza, po którym akurat przemieszcza się dany pakiet;</li>
<li><strong>routing (trasowanie)</strong> — wybór ścieżki, którą pakiet powinien pokonać od źródła do celu, przez potencjalnie wiele pośredniczących routerów; realizowany na podstawie tablic routingu budowanych statycznie lub dynamicznie (protokoły takie jak OSPF, BGP — wykraczające poza zakres tego materiału);</li>
<li><strong>przekazywanie (forwarding)</strong> — praktyczna, wykonywana „w locie\" przez każdy router czynność polegająca na odebraniu pakietu na jednym interfejsie, odczytaniu adresu docelowego, sprawdzeniu go w tablicy routingu i wysłaniu na odpowiedni interfejs wyjściowy;</li>
<li><strong>fragmentacja i ponowne składanie danych</strong> — dostosowanie rozmiaru pakietu do maksymalnej jednostki transmisji (MTU) kolejnych łączy na trasie</li>
<li><strong>oznaczanie klasy usługi (opcjonalnie)</strong> — możliwość wskazania priorytetu lub wymagań jakościowych pakietu (pole ToS/DiffServ, rozdział 3.3), wykorzystywana przez mechanizmy QoS;</li>
<li><strong>kontrola czasu życia pakietu</strong> — zapobieganie nieskończonemu krążeniu pakietów w pętlach routingu.</li>
</ul>
<p>Co istotne, warstwa sieciowa <strong>nie zajmuje się</strong> niezawodnością dostarczenia (retransmisją utraconych danych), kontrolą przepływu ani zachowaniem kolejności — te zadania, o ile są potrzebne, realizowane są przez warstwę transportową (TCP) lub aplikacje korzystające bezpośrednio z UDP.</p>
<h3>1.2. Usługa bezpołączeniowa — model best-effort</h3>
<p>Protokół IP, zarówno w wersji 4, jak i 6, realizuje <strong>usługę bezpołączeniową (connectionless)</strong>, określaną też mianem <strong>best-effort</strong> (najlepszego możliwego wysiłku, ale bez gwarancji). Oznacza to, że:</p>
<ul>
<li>każdy pakiet (zwany w kontekście IP <strong>datagramem</strong>) jest przetwarzany <strong>niezależnie</strong> od poprzednich i kolejnych — router nie utrzymuje żadnego „stanu rozmowy\" między dwoma hostami;</li>
<li>kolejne datagramy tej samej komunikacji <strong>mogą dotrzeć do celu różnymi trasami</strong> i w <strong>innej kolejności</strong>, niż zostały wysłane;</li>
<li>protokół IP <strong>nie gwarantuje dostarczenia</strong> — datagram może zostać odrzucony (np. z powodu przeciążenia routera, błędu, wygaśnięcia TTL) bez żadnego powiadomienia nadawcy (poza opcjonalnymi komunikatami ICMP);</li>
<li><strong>nie ma potwierdzeń ani retransmisji</strong> na poziomie IP — jeśli aplikacja wymaga niezawodności, musi skorzystać z protokołu transportowego TCP, który buduje tę niezawodność na bazie zawodnej usługi IP.</li>
</ul>
<p>Ten model — prosty, „głupi\" rdzeń sieci (routery jedynie przekazują pakiety najlepiej, jak potrafią) i „inteligentne\" brzegi (hosty końcowe odpowiadają za niezawodność) — bywa określany zasadą <strong>end-to-end</strong> i jest jedną z fundamentalnych decyzji architektonicznych, które umożliwiły internetowi skalowanie do miliardów urządzeń: routery szkieletowe nie muszą pamiętać nic o pojedynczych połączeniach, co drastycznie upraszcza i przyspiesza ich działanie.</p>
<h3>1.3. Miejsce IP w stosie protokołów i enkapsulacja</h3>
<p>Datagram IP jest przenoszony jako <strong>pole danych (payload)</strong> ramki warstwy 2 (np. ramki Ethernet — patrz materiał o strukturze ramki Ethernet). Z kolei sam datagram IP zawiera w swoim polu danych segment lub datagram warstwy transportowej (TCP lub UDP), a ten z kolei — dane aplikacji. Każda warstwa dokłada swój własny nagłówek, tworząc strukturę „matrioszki\":</p>
<pre><code class=\"language-bash\">Ramka Ethernet [ nagłówek Ethernet [ nagłówek IP [ nagłówek TCP/UDP [ dane aplikacji ] ] ] FCS ]</code></pre>
<p>To pole <strong>EtherType</strong> w nagłówku Ethernet (wartość <code>0x0800</code> dla IPv4, <code>0x86DD</code> dla IPv6) informuje odbiorcę, że zawartość ramki należy przekazać do modułu IP w systemie operacyjnym. Analogicznie, wewnątrz samego datagramu IP pole <strong>Protokół</strong> (rozdział 3.9) pełni dokładnie tę samą funkcję na kolejnym poziomie — wskazuje, do którego protokołu warstwy transportowej należy przekazać zawartość pola danych.</p>
<hr />
<h2>2. Logiczna adresacja hostów w IPv4</h2>
<h3>2.1. Dlaczego adresacja logiczna, skoro istnieje adres MAC?</h3>
<p>Adres MAC (warstwa 2, patrz materiał o strukturze ramki Ethernet) jest przypisany <strong>na stałe do konkretnego interfejsu sieciowego</strong> przez producenta i nie niesie żadnej informacji o <strong>lokalizacji</strong> urządzenia w globalnej strukturze sieci — jest płaski, nie ma hierarchii. Gdyby internet próbował trasować ruch bezpośrednio na podstawie adresów MAC, każdy router szkieletowy musiałby przechowywać w swojej tablicy wpis dla każdego z miliardów urządzeń na świecie — co jest architektonicznie niewykonalne.</p>
<p><strong>Adres IP</strong> rozwiązuje ten problem, wprowadzając <strong>hierarchiczną, logiczną</strong> strukturę adresacji, przypominającą system pocztowy: podobnie jak adres pocztowy dzieli się na kraj, miasto, ulicę i numer domu, adres IP dzieli się na <strong>część sieciową</strong> (identyfikującą, do której sieci należy host — odpowiednik „miasta\") i <strong>część hosta</strong> (identyfikującą konkretne urządzenie w tej sieci — odpowiednik „numeru domu\"). Dzięki tej hierarchii router szkieletowy musi znać trasę jedynie do całych <strong>sieci</strong> (agregowanych bloków adresów), a nie do każdego pojedynczego hosta z osobna — co czyni routing skalowalnym.</p>
<p>Kluczowa różnica: adres MAC jest <strong>trwale związany ze sprzętem</strong> (interfejsem sieciowym) i nie zmienia się, gdy urządzenie zmienia lokalizację; adres IP jest <strong>związany z lokalizacją w topologii sieci</strong> i musi się zmienić, gdy urządzenie zostanie przeniesione do innej sieci (chyba że zastosowane zostaną specjalne mechanizmy, jak Mobile IP).</p>
<h3>2.2. Struktura adresu IPv4</h3>
<p>Adres IPv4 to liczba <strong>32-bitowa</strong>, zapisywana dla wygody człowieka w <strong>notacji dziesiętnej kropkowanej (dotted-decimal notation)</strong>: cztery liczby od 0 do 255 (każda reprezentująca jeden 8-bitowy oktet), oddzielone kropkami, np. <code>192.168.1.10</code>. W zapisie binarnym: <code>11000000.10101000.00000001.00001010</code>.</p>
<p>Adres dzieli się na <strong>prefiks sieciowy (network prefix)</strong> i <strong>identyfikator hosta (host identifier)</strong>. Granica między nimi nie jest zapisana w samym adresie — jest określana osobno, przez <strong>maskę podsieci</strong> lub <strong>notację prefiksową (CIDR)</strong>.</p>
<h3>2.3. Historyczny podział na klasy adresowe</h3>
<p>W pierwotnej specyfikacji IPv4 (RFC 791, 1981) granica między częścią sieciową a hostową była <strong>sztywno ustalona</strong> na podstawie kilku najstarszych bitów adresu — tzw. <strong>klasowy</strong> model adresacji:</p>
<table>
<thead>
<tr>
<th>Klasa</th>
<th>Pierwsze bity</th>
<th>Zakres pierwszego oktetu</th>
<th>Domyślna maska</th>
<th>Bity sieci / hosta</th>
<th>Liczba sieci</th>
<th>Hostów na sieć</th>
</tr>
</thead>
<tbody>
<tr>
<td>A</td>
<td><code>0</code></td>
<td>1–126</td>
<td>255.0.0.0 (/8)</td>
<td>8 / 24</td>
<td>126</td>
<td>16 777 214</td>
</tr>
<tr>
<td>B</td>
<td><code>10</code></td>
<td>128–191</td>
<td>255.255.0.0 (/16)</td>
<td>16 / 16</td>
<td>16 384</td>
<td>65 534</td>
</tr>
<tr>
<td>C</td>
<td><code>110</code></td>
<td>192–223</td>
<td>255.255.255.0 (/24)</td>
<td>24 / 8</td>
<td>2 097 152</td>
<td>254</td>
</tr>
<tr>
<td>D (multicast)</td>
<td><code>1110</code></td>
<td>224–239</td>
<td>— nie dotyczy</td>
<td>—</td>
<td>—</td>
<td>—</td>
</tr>
<tr>
<td>E (zarezerwowana)</td>
<td><code>1111</code></td>
<td>240–255</td>
<td>— eksperymentalna</td>
<td>—</td>
<td>—</td>
<td>—</td>
</tr>
</tbody>
</table>
<p><em>(Adres 127.x.x.x, formalnie należący do klasy A, jest zarezerwowany na potrzeby pętli zwrotnej — patrz rozdział 2.5).</em></p>
<p>Podział klasowy okazał się mało elastyczny i marnotrawił przestrzeń adresową: firma potrzebująca 300 adresów musiała otrzymać całą sieć klasy B (65 534 adresów), marnując resztę. Z tego powodu w 1993 roku (RFC 1519) wprowadzono <strong>CIDR</strong>, który klasowy podział praktycznie wyparł — dziś ma on już wyłącznie znaczenie historyczne i edukacyjne, choć terminologia („adres klasy C\") bywa wciąż potocznie używana.</p>
<h3>2.4. CIDR i maska podsieci</h3>
<p><strong>CIDR (Classless Inter-Domain Routing)</strong> pozwala na <strong>dowolne</strong> ustalenie granicy między częścią sieciową a hostową, niezależnie od „klasy\" adresu. Granica ta jest wyrażana na dwa równoważne sposoby:</p>
<ul>
<li><strong>maska podsieci (subnet mask)</strong> — 32-bitowa liczba, w której bity ustawione na <code>1</code> odpowiadają części sieciowej, a bity <code>0</code> — części hosta, np. <code>255.255.255.0</code> (binarnie: 24 jedynki, potem 8 zer);</li>
<li><strong>notacja prefiksowa (slash notation)</strong> — liczba jedynek w masce zapisana po ukośniku bezpośrednio za adresem, np. <code>192.168.1.0/24</code>.</li>
</ul>
<p>Liczba dostępnych adresów hostów w sieci o prefiksie <span class=\"mathjax mathjax--inline\">\\(/n\\)</span> wynosi <span class=\"mathjax mathjax--inline\">\\(2^{32-n}\\)</span>, przy czym <strong>dwa adresy są zawsze zarezerwowane</strong>: pierwszy (same zera w części hosta) to <strong>adres sieci</strong> (identyfikuje samą sieć jako całość, nie żaden konkretny host), a ostatni (same jedynki w części hosta) to <strong>adres rozgłoszeniowy kierowany (directed broadcast)</strong> tej podsieci. Liczba adresów <strong>użytecznych dla hostów</strong> wynosi zatem <span class=\"mathjax mathjax--inline\">\\(2^{32-n} - 2\\)</span>.</p>
<p><em>Przykład.</em> Sieć <code>192.168.1.0/26</code>: prefiks 26 bitów zostawia <span class=\"mathjax mathjax--inline\">\\(32-26=6\\)</span> bitów na hosta, czyli <span class=\"mathjax mathjax--inline\">\\(2^6 = 64\\)</span> adresy łącznie, z czego <span class=\"mathjax mathjax--inline\">\\(64-2=62\\)</span> adresy użyteczne dla hostów (od <code>192.168.1.1</code> do <code>192.168.1.62</code>), <code>192.168.1.0</code> to adres sieci, a <code>192.168.1.63</code> to adres rozgłoszeniowy tej podsieci.</p>
<h3>2.5. Adresy specjalne i zarezerwowane zakresy</h3>
<table>
<thead>
<tr>
<th>Zakres / adres</th>
<th>Nazwa</th>
<th>Przeznaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>0.0.0.0/8</code></td>
<td>adres nieokreślony</td>
<td>źródłowy adres hosta, który nie ma jeszcze przydzielonego adresu (np. w trakcie DHCP)</td>
</tr>
<tr>
<td><code>10.0.0.0/8</code></td>
<td>prywatny (RFC 1918)</td>
<td>sieci wewnętrzne, niemarszrutyzowane w publicznym internecie</td>
</tr>
<tr>
<td><code>172.16.0.0/12</code></td>
<td>prywatny (RFC 1918)</td>
<td>jw.</td>
</tr>
<tr>
<td><code>192.168.0.0/16</code></td>
<td>prywatny (RFC 1918)</td>
<td>jw., najpopularniejszy w sieciach domowych</td>
</tr>
<tr>
<td><code>127.0.0.0/8</code></td>
<td>pętla zwrotna (loopback)</td>
<td>komunikacja procesu z samym sobą (np. <code>127.0.0.1</code>)</td>
</tr>
<tr>
<td><code>169.254.0.0/16</code></td>
<td>link-local (APIPA)</td>
<td>automatycznie nadawany, gdy DHCP zawiedzie; ważny tylko w obrębie jednego segmentu</td>
</tr>
<tr>
<td><code>224.0.0.0/4</code></td>
<td>multicast</td>
<td>adresowanie grupowe (dawna klasa D)</td>
</tr>
<tr>
<td><code>255.255.255.255</code></td>
<td>ograniczony broadcast</td>
<td>rozgłoszenie ograniczone do lokalnego segmentu (nigdy nie routowane dalej)</td>
</tr>
<tr>
<td><code>100.64.0.0/10</code></td>
<td>CGN (Carrier-Grade NAT, RFC 6598)</td>
<td>przestrzeń operatorska dla NAT na dużą skalę, np. w sieciach mobilnych</td>
</tr>
</tbody>
</table>
<p>Adresy prywatne (RFC 1918) mogą być dowolnie wykorzystywane w sieciach wewnętrznych, ponieważ routery szkieletowe internetu <strong>nigdy</strong> nie przekazują pakietów z takimi adresami docelowymi dalej niż do najbliższego routera brzegowego z translacją NAT — to właśnie dzięki temu miliony sieci domowych mogą niezależnie od siebie używać identycznego zakresu <code>192.168.1.0/24</code> bez żadnego konfliktu.</p>
<h3>2.6. Podsieciowanie (subnetting) — przykład praktyczny</h3>
<p><strong>Podsieciowanie</strong> to praktyka dzielenia jednej, większej sieci na mniejsze podsieci poprzez „pożyczenie\" części bitów przeznaczonych pierwotnie na hosta i przekazanie ich do części sieciowej (wydłużenie maski/prefiksu).</p>
<p><em>Przykład.</em> Firma otrzymała sieć <code>192.168.10.0/24</code> (254 adresy użyteczne) i chce podzielić ją na 4 równe podsieci (np. dla czterech działów). Potrzeba <span class=\"mathjax mathjax--inline\">\\(\\log_2 4 = 2\\)</span> dodatkowych bitów sieciowych, czyli nowy prefiks to <span class=\"mathjax mathjax--inline\">\\(/26\\)</span> (<span class=\"mathjax mathjax--inline\">\\(24+2\\)</span>):</p>
<table>
<thead>
<tr>
<th>Podsieć</th>
<th>Adres sieci</th>
<th>Zakres hostów</th>
<th>Adres rozgłoszeniowy</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>192.168.10.0/26</td>
<td>.1 – .62</td>
<td>192.168.10.63</td>
</tr>
<tr>
<td>2</td>
<td>192.168.10.64/26</td>
<td>.65 – .126</td>
<td>192.168.10.127</td>
</tr>
<tr>
<td>3</td>
<td>192.168.10.128/26</td>
<td>.129 – .190</td>
<td>192.168.10.191</td>
</tr>
<tr>
<td>4</td>
<td>192.168.10.192/26</td>
<td>.193 – .254</td>
<td>192.168.10.255</td>
</tr>
</tbody>
</table>
<p>Każda z czterech podsieci mieści <span class=\"mathjax mathjax--inline\">\\(2^6-2=62\\)</span> adresy użyteczne dla hostów — łącznie 248 z pierwotnych 254, „stracone\" na dodatkowe adresy sieci i broadcastu w każdej podsieci. Jest to typowy kompromis podsieciowania: więcej, mniejszych podsieci oznacza mniej dostępnych adresów hostów, ale lepszą segmentację (patrz materiał o urządzeniach warstwy dostępu, rozdział o segmentacji sieci) i mniejsze domeny rozgłoszeniowe.</p>
<hr />
<h2>3. Format nagłówka IPv4 — analiza pole po polu</h2>
<p>Nagłówek IPv4, opisany w RFC 791, ma <strong>zmienną długość</strong> — od <strong>20 do 60 bajtów</strong> — w zależności od obecności opcjonalnych pól. Składa się z <strong>13 pól obowiązkowych</strong> (mieszczących się w pierwszych pięciu 32-bitowych słowach, czyli 20 bajtach) oraz opcjonalnego pola <strong>Opcje</strong> o zmiennej długości.</p>
<p><img alt=\"Budowa nagłówka IPv4 z podziałem bitowym wszystkich pól\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ipv4-naglowek-budowa.svg\" /></p>
<p>Poniżej każde pole omówione jest szczegółowo, w kolejności występowania w nagłówku.</p>
<h3>3.1. Wersja (Version) — 4 bity</h3>
<p>Najstarsze 4 bity pierwszego bajtu nagłówka określają <strong>wersję protokołu IP</strong>. Dla IPv4 pole to zawsze przyjmuje wartość binarną <code>0100</code>, czyli dziesiętnie <strong>4</strong>. To właśnie ta wartość pozwala stosowi sieciowemu odbiorcy natychmiast rozpoznać, że ma do czynienia z pakietem IPv4 (w odróżnieniu od IPv6, gdzie to samo pole przyjmuje wartość 6 — patrz rozdział 6.2) i zastosować odpowiedni algorytm parsowania pozostałej części nagłówka, którego struktura różni się diametralnie między obiema wersjami.</p>
<h3>3.2. Długość nagłówka — IHL (Internet Header Length) — 4 bity</h3>
<p>Pole <strong>IHL</strong> określa długość całego nagłówka IPv4, <strong>wyrażoną w jednostkach 32-bitowych słów (4-bajtowych)</strong>, nie w bajtach bezpośrednio. Ponieważ pole ma 4 bity, może przyjąć wartości od 0 do 15, ale w praktyce sensowny zakres to <strong>5 do 15</strong>:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Długość nagłówka w bajtach} = \\text{IHL} \\times 4\\)</span>\$</p>
<ul>
<li><strong>Minimalna wartość IHL = 5</strong>, co odpowiada <span class=\"mathjax mathjax--inline\">\\(5 \\times 4 = 20\\)</span> bajtom — jest to długość nagłówka <strong>bez żadnych opcji</strong>, obejmująca wyłącznie 13 pól obowiązkowych. Zdecydowana większość ruchu w dzisiejszym internecie korzysta właśnie z tej minimalnej wartości.</li>
<li><strong>Maksymalna wartość IHL = 15</strong>, co odpowiada <span class=\"mathjax mathjax--inline\">\\(15 \\times 4 = 60\\)</span> bajtom — nagłówek z maksymalną dopuszczalną liczbą opcji, zajmujących <span class=\"mathjax mathjax--inline\">\\(60 - 20 = 40\\)</span> dodatkowych bajtów.</li>
</ul>
<p>Dlaczego długość wyrażono w 4-bajtowych słowach, a nie wprost w bajtach? Ponieważ zakres 0–15 (4 bity) wystarcza dokładnie do zaadresowania pełnego zakresu dopuszczalnych długości nagłówka (do 60 B) tylko wtedy, gdy jednostką jest słowo 32-bitowe — bezpośredni zapis w bajtach wymagałby więcej bitów. Jest to również powód, dla którego pole <strong>Opcje</strong> musi być zawsze <strong>dopełnione (padding)</strong> do pełnej wielokrotności 4 bajtów — IHL nie potrafiłby wyrazić długości nagłówka niebędącej wielokrotnością słowa.</p>
<p>Stos sieciowy odbiorcy wykorzystuje wartość IHL do obliczenia, <strong>gdzie dokładnie w pakiecie zaczyna się pole danych</strong> (payload) — jest to pierwsza operacja parsowania po odczytaniu wersji protokołu.</p>
<h3>3.3. Typ usługi — ToS / DiffServ i ECN — 8 bitów</h3>
<p>Ósmy do piętnastego bit nagłówka (drugi bajt) pierwotnie nazywany był <strong>ToS (Type of Service)</strong> i miał, zgodnie z pierwotną specyfikacją RFC 791, umożliwiać nadawcy zasygnalizowanie preferencji dotyczących sposobu obsługi pakietu (np. priorytet, preferencja niskiego opóźnienia kontra wysokiej przepustowości). W praktyce pierwotny format ToS był rzadko wykorzystywany i z czasem został <strong>przedefiniowany</strong>.</p>
<h4>Format historyczny (RFC 791, dziś nieużywany)</h4>
<p>Pierwotnie 8 bitów dzieliło się na: 3-bitowe pole <strong>Precedence</strong> (priorytet, 0–7), oraz pojedyncze bity flag: <strong>D</strong> (Delay — preferencja niskiego opóźnienia), <strong>T</strong> (Throughput — preferencja wysokiej przepustowości), <strong>R</strong> (Reliability — preferencja niezawodności) i 2 bity zarezerwowane.</p>
<h4>Format współczesny — DiffServ i ECN (RFC 2474, RFC 3168)</h4>
<p>Od 1998 roku (RFC 2474) te same 8 bitów zostały <strong>przedefiniowane</strong> na potrzeby architektury <strong>DiffServ (Differentiated Services)</strong>:</p>
<ul>
<li><strong>6 najstarszych bitów</strong> → pole <strong>DSCP (Differentiated Services Code Point)</strong> — pozwala zakwalifikować pakiet do jednej z 64 możliwych klas obsługi (ang. <em>Per-Hop Behavior</em>, PHB), na podstawie której routery na trasie mogą różnicować kolejkowanie, priorytetyzację i prawdopodobieństwo odrzucenia pakietu w razie przeciążenia. Popularne, standaryzowane wartości DSCP obejmują m.in.:</li>
</ul>
<table>
<thead>
<tr>
<th>Nazwa PHB</th>
<th>Wartość DSCP (dziesiętnie)</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>CS0 (Default)</strong></td>
<td>0</td>
<td>ruch bez gwarancji (best effort)</td>
</tr>
<tr>
<td><strong>AF (Assured Forwarding)</strong>, np. AF41</td>
<td>34</td>
<td>ruch wymagający gwarancji, np. wideokonferencje</td>
</tr>
<tr>
<td><strong>EF (Expedited Forwarding)</strong></td>
<td>46</td>
<td>ruch o najniższym dopuszczalnym opóźnieniu i jitterze, np. VoIP</td>
</tr>
<tr>
<td><strong>CS6 / CS7</strong></td>
<td>48 / 56</td>
<td>ruch sygnalizacyjny sieci (routing, zarządzanie)</td>
</tr>
</tbody>
</table>
<ul>
<li><strong>2 najmłodsze bity</strong> → pole <strong>ECN (Explicit Congestion Notification, RFC 3168)</strong> — mechanizm pozwalający routerowi <strong>zasygnalizować początek przeciążenia</strong> poprzez ustawienie odpowiednich bitów w przechodzącym pakiecie, <strong>zamiast</strong> jego odrzucenia. Odbiorca odczytuje te bity i informuje nadawcę (poprzez mechanizmy warstwy transportowej, np. nagłówek TCP), który może <strong>proaktywnie zmniejszyć tempo nadawania</strong>, zanim dojdzie do rzeczywistej utraty pakietów. Wartości pola ECN: <code>00</code> — end-point nie obsługuje ECN, <code>10</code> lub <code>01</code> — end-point obsługuje ECN, ale przeciążenia jeszcze nie wykryto, <code>11</code> — router na trasie wykrył przeciążenie i oznaczył pakiet (Congestion Experienced).</li>
</ul>
<p>Ważne rozróżnienie: <strong>DiffServ jest mechanizmem klasyfikacji dla każdego pakietu z osobna</strong> (routery na podstawie DSCP decydują lokalnie, jak obsłużyć dany pakiet — nie ma żadnej rezerwacji zasobów ani gwarancji end-to-end), w odróżnieniu od starszej, znacznie bardziej złożonej architektury <strong>IntServ (Integrated Services)</strong>, która próbowała rezerwować zasoby na całej trasie (protokół RSVP) — podejście to nie zyskało powszechnego zastosowania ze względu na problemy ze skalowalnością w rdzeniu internetu.</p>
<h3>3.4. Całkowita długość — Total Length — 16 bitów</h3>
<p>Pole <strong>Total Length</strong> określa <strong>całkowitą długość całego datagramu IP</strong> (nagłówek <strong>łącznie</strong> z polem danych), wyrażoną <strong>wprost w bajtach</strong> (w odróżnieniu od IHL, które wyrażone jest w słowach). Ponieważ pole ma 16 bitów, maksymalna teoretyczna długość datagramu IPv4 wynosi:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$2^{16} - 1 = 65\\,535 \\text{ bajtów}\\)</span>\$</p>
<p>Długość pola danych (payload) oblicza się jako:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Długość danych} = \\text{Total Length} - (\\text{IHL} \\times 4)\\)</span>\$</p>
<p><em>Przykład.</em> Datagram o Total Length = 1500 B i IHL = 5 (nagłówek 20 B) niesie <span class=\"mathjax mathjax--inline\">\\(1500 - 20 = 1480\\)</span> bajtów danych.</p>
<p>Każde urządzenie warstwy łącza danych ma swoje własne ograniczenie maksymalnej wielkości ramki — <strong>MTU (Maximum Transmission Unit)</strong>, patrz materiał o strukturze ramki Ethernet, gdzie standardowe MTU wynosi 1500 B. Ponieważ 65 535 B znacznie przekracza typowe MTU sieci Ethernet, w praktyce warstwa IP <strong>musi fragmentować</strong> większe datagramy, aby zmieściły się w ramkach warstwy 2 — mechanizm ten jest przedmiotem osobnego, szczegółowego rozdziału 4.</p>
<p>Warto dodać, że mechanizm <strong>Jumbogramów</strong> (RFC 2675) w IPv6 pozwala, w ściśle określonych warunkach sieci wspierających Jumbo Frames, na przesyłanie danych powyżej granicy 65 535 B — nie dotyczy to jednak standardowego IPv4.</p>
<h3>3.5. Identyfikacja — Identification — 16 bitów</h3>
<p>Pole <strong>Identification</strong> zawiera liczbę, którą nadawca przypisuje <strong>każdemu wysyłanemu datagramowi</strong>, typowo inkrementowaną (zwiększaną) dla kolejnych datagramów, choć RFC nie narzuca dokładnego algorytmu jej generowania (współczesne systemy operacyjne z powodów bezpieczeństwa często stosują częściowo losowe wartości, aby utrudnić pewne klasy ataków opierających się na przewidywalności tego pola).</p>
<p>Podstawowa, krytycznie ważna funkcja tego pola ujawnia się w kontekście <strong>fragmentacji</strong>: gdy duży datagram zostaje podzielony na mniejsze fragmenty (bo nie mieści się w MTU kolejnego łącza), <strong>wszystkie fragmenty pochodzące z tego samego, oryginalnego datagramu otrzymują identyczną wartość Identification</strong>. To właśnie ta wspólna wartość pozwala odbiorcy końcowemu — nawet jeśli fragmenty dotrą w różnej kolejności lub wymieszane z fragmentami zupełnie innych datagramów tego samego nadawcy — poprawnie <strong>zgrupować</strong> fragmenty należące do tego samego oryginalnego datagramu przed próbą ich ponownego złożenia (reasembly). Mechanizm ten jest szczegółowo zilustrowany w rozdziale 4.</p>
<h3>3.6. Flagi — Flags — 3 bity</h3>
<p>Trzy bity flag kontrolnych związanych bezpośrednio z mechanizmem fragmentacji:</p>
<table>
<thead>
<tr>
<th>Bit</th>
<th>Nazwa</th>
<th>Znaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td>bit 0</td>
<td><strong>Reserved (zarezerwowany)</strong></td>
<td>musi zawsze wynosić 0; w niektórych eksperymentalnych zastosowaniach (RFC 3514, żartobliwie nazwany „Evil bit\") proponowano wykorzystać go do oznaczania pakietów o złośliwych intencjach — propozycja ta miała charakter satyryczny i nigdy nie została wdrożona</td>
</tr>
<tr>
<td>bit 1</td>
<td><strong>DF (Don\x27t Fragment)</strong></td>
<td>gdy ustawiony na <code>1</code>, <strong>zabrania</strong> routerom na trasie fragmentacji tego datagramu; jeśli datagram z ustawionym DF napotka łącze o MTU mniejszym niż jego rozmiar, zostaje <strong>odrzucony</strong>, a nadawcy zwracany jest komunikat ICMP „Fragmentation Needed\" (mechanizm wykorzystywany przez Path MTU Discovery, patrz rozdział 4.5)</td>
</tr>
<tr>
<td>bit 2</td>
<td><strong>MF (More Fragments)</strong></td>
<td>gdy ustawiony na <code>1</code>, oznacza, że <strong>po tym fragmencie nastąpią kolejne</strong> fragmenty tego samego oryginalnego datagramu; wartość <code>0</code> oznacza, że jest to <strong>ostatni</strong> fragment (lub że datagram w ogóle nie został pofragmentowany)</td>
</tr>
</tbody>
</table>
<h3>3.7. Przesunięcie fragmentu — Fragment Offset — 13 bitów</h3>
<p>Pole <strong>Fragment Offset</strong> określa <strong>pozycję danego fragmentu w oryginalnym, niepofragmentowanym datagramie</strong>, wyrażoną — analogicznie do pola IHL — <strong>w jednostkach 8-bajtowych (64-bitowych)</strong>, a nie wprost w bajtach:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Pozycja bajtu w oryginalnych danych} = \\text{Fragment Offset} \\times 8\\)</span>\$</p>
<p>Wybór jednostki 8 bajtów (zamiast np. 1 bajta) wynika z tego samego kompromisu co przy IHL: pole 13-bitowe pozwala zaadresować przesunięcie do <span class=\"mathjax mathjax--inline\">\\(2^{13}-1 = 8191\\)</span> jednostek, co przy jednostce 8-bajtowej daje maksymalne przesunięcie <span class=\"mathjax mathjax--inline\">\\(8191 \\times 8 = 65\\,528\\)</span> bajtów — praktycznie pokrywające cały dopuszczalny zakres pola Total Length (65 535 B). Gdyby jednostką był 1 bajt, 13 bitów pozwoliłoby zaadresować jedynie do 8191 B — zbyt mało. Ta sama zależność wymusza regułę: <strong>rozmiar danych każdego fragmentu (poza ostatnim) musi być wielokrotnością 8 bajtów</strong>, ponieważ przesunięcie kolejnego fragmentu musi dać się wyrazić w pełnych jednostkach 8-bajtowych.</p>
<p>Fragment Offset dla <strong>pierwszego</strong> fragmentu (lub dla datagramu niepofragmentowanego) zawsze wynosi <strong>0</strong>. Szczegółowy, w pełni obliczony przykład fragmentacji z wykorzystaniem pól Identification, MF i Fragment Offset znajduje się w rozdziale 4.</p>
<hr />
<h3>3.8. Czas życia — TTL (Time To Live) — 8 bitów</h3>
<p>Pole <strong>TTL</strong> jest omówione szczegółowo w rozdziale 5 — tu krótkie wprowadzenie definicyjne. TTL to 8-bitowy licznik, ustawiany przez nadawcę na pewną wartość początkową (typowo 64, 128 lub 255, zależnie od systemu operacyjnego) i <strong>dekrementowany o co najmniej 1 przez każdy router</strong>, przez który przechodzi datagram. Gdy TTL osiągnie wartość 0, router <strong>odrzuca</strong> datagram i (typowo) odsyła do nadawcy komunikat ICMP Time Exceeded. Mechanizm ten zapobiega nieskończonemu krążeniu pakietów w przypadku błędnej konfiguracji routingu tworzącej pętlę.</p>
<h3>3.9. Protokół — Protocol — 8 bitów</h3>
<p>Pole <strong>Protokół</strong> identyfikuje, <strong>do którego protokołu warstwy wyższej</strong> (typowo warstwy transportowej) należy przekazać zawartość pola danych datagramu po jego dotarciu do hosta docelowego. Pełni dokładnie analogiczną funkcję do pola EtherType w nagłówku Ethernet (patrz materiał o strukturze ramki Ethernet, rozdział 5), tyle że o jeden poziom enkapsulacji wyżej. Wartości tego pola są scentralizowanie zarządzane przez IANA w rejestrze <strong>Protocol Numbers</strong>. Najczęściej spotykane wartości:</p>
<table>
<thead>
<tr>
<th>Wartość (dziesiętnie)</th>
<th>Wartość (hex)</th>
<th>Protokół</th>
<th>Opis</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td><code>0x01</code></td>
<td><strong>ICMP</strong></td>
<td>Internet Control Message Protocol — komunikaty diagnostyczne i błędów</td>
</tr>
<tr>
<td>2</td>
<td><code>0x02</code></td>
<td><strong>IGMP</strong></td>
<td>Internet Group Management Protocol — zarządzanie grupami multicast</td>
</tr>
<tr>
<td>6</td>
<td><code>0x06</code></td>
<td><strong>TCP</strong></td>
<td>Transmission Control Protocol — połączeniowy, niezawodny transport</td>
</tr>
<tr>
<td>17</td>
<td><code>0x11</code></td>
<td><strong>UDP</strong></td>
<td>User Datagram Protocol — bezpołączeniowy, „najlepszego wysiłku\" transport</td>
</tr>
<tr>
<td>41</td>
<td><code>0x29</code></td>
<td><strong>IPv6</strong> (enkapsulowany)</td>
<td>tunelowanie IPv6 wewnątrz IPv4 (6in4)</td>
</tr>
<tr>
<td>47</td>
<td><code>0x2F</code></td>
<td><strong>GRE</strong></td>
<td>Generic Routing Encapsulation — tunelowanie ogólnego przeznaczenia</td>
</tr>
<tr>
<td>50</td>
<td><code>0x32</code></td>
<td><strong>ESP</strong></td>
<td>Encapsulating Security Payload — część IPsec (szyfrowanie)</td>
</tr>
<tr>
<td>51</td>
<td><code>0x33</code></td>
<td><strong>AH</strong></td>
<td>Authentication Header — część IPsec (uwierzytelnianie integralności)</td>
</tr>
<tr>
<td>89</td>
<td><code>0x59</code></td>
<td><strong>OSPF</strong></td>
<td>Open Shortest Path First — protokół routingu dynamicznego</td>
</tr>
<tr>
<td>132</td>
<td><code>0x84</code></td>
<td><strong>SCTP</strong></td>
<td>Stream Control Transmission Protocol</td>
</tr>
</tbody>
</table>
<p>Dzięki temu polu stos sieciowy odbiorcy, po zweryfikowaniu, że dany datagram IP jest adresowany do niego (na podstawie adresu docelowego), wie natychmiast, czy przekazać dane do modułu TCP, UDP, ICMP czy innego — bez konieczności „zgadywania\" formatu danych zawartych w polu payload.</p>
<h3>3.10. Suma kontrolna nagłówka — Header Checksum — 16 bitów</h3>
<p>Pole <strong>Header Checksum</strong> zawiera 16-bitową sumę kontrolną, obliczaną metodą <strong>dopełnienia do jedynki (one\x27s complement)</strong>, obejmującą <strong>wyłącznie nagłówek IP</strong> (nie obejmuje pola danych — za integralność danych odpowiadają mechanizmy warstw wyższych, np. suma kontrolna TCP/UDP lub FCS warstwy 2).</p>
<h4>Algorytm obliczania</h4>
<ol>
<li>Pole Header Checksum jest <strong>tymczasowo zerowane</strong>.</li>
<li>Cały nagłówek traktowany jest jako ciąg <strong>16-bitowych słów</strong>.</li>
<li>Wszystkie słowa są sumowane metodą arytmetyki dopełnienia do jedynki (jeśli podczas dodawania wystąpi przeniesienie poza 16 bitów, jest ono „zawijane\" i dodawane z powrotem do wyniku — tzw. <em>end-around carry</em>).</li>
<li>Wynik sumowania jest <strong>negowany bitowo</strong> (dopełnienie do jedynki całej sumy) i wpisywany do pola Header Checksum.</li>
</ol>
<p>Odbiorca powtarza tę samą operację na <strong>całym</strong> odebranym nagłówku (tym razem <strong>łącznie</strong> z odebraną wartością pola Header Checksum, bez jej zerowania) — jeśli nagłówek nie został uszkodzony, wynik sumowania powinien dać w rezultacie same jedynki binarne (<code>0xFFFF</code>). Dowolna inna wartość oznacza wykryty błąd, a pakiet jest po cichu odrzucany.</p>
<p><em>Uproszczony przykład liczbowy.</em> Rozważmy nagłówek złożony (dla uproszczenia) z zaledwie czterech słów 16-bitowych, z polem checksum wyzerowanym:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Słowo 1} = \\texttt{4500}_{16}, \\quad \\text{Słowo 2} = \\texttt{003C}_{16}, \\quad \\text{Słowo 3} = \\texttt{1C46}_{16}, \\quad \\text{Słowo 4} = \\texttt{4000}_{16}\\)</span>\$</p>
<p>Suma: <span class=\"mathjax mathjax--inline\">\\(\\texttt{4500} + \\texttt{003C} + \\texttt{1C46} + \\texttt{4000} = \\texttt{5F82}_{16}\\)</span> (bez przeniesienia poza 16 bitów w tym przykładzie). Dopełnienie do jedynki (negacja bitowa) tej sumy: <span class=\"mathjax mathjax--inline\">\\(\\overline{\\texttt{5F82}} = \\texttt{A07D}_{16}\\)</span> — to właśnie ta wartość zostałaby wpisana do pola Header Checksum. Weryfikacja: odbiorca zsumowałby cztery oryginalne słowa <strong>oraz</strong> wartość checksum <span class=\"mathjax mathjax--inline\">\\(\\texttt{A07D}\\)</span>: <span class=\"mathjax mathjax--inline\">\\(\\texttt{5F82} + \\texttt{A07D} = \\texttt{FFFF}_{16}\\)</span> — same jedynki, co potwierdza brak wykrytych błędów.</p>
<h4>Dlaczego checksum musi być przeliczana na każdym routerze</h4>
<p>Ponieważ pole <strong>TTL</strong> jest dekrementowane na każdym routerze na trasie (rozdział 5), a TTL jest częścią nagłówka objętą sumą kontrolną, <strong>każdy router musi przeliczyć Header Checksum od nowa</strong> po zmodyfikowaniu TTL — w przeciwnym razie suma kontrolna przestałaby się zgadzać u kolejnego odbiorcy. Z powodów wydajnościowych routery zwykle nie liczą całej sumy od zera, lecz stosują <strong>przyrostową aktualizację</strong> (RFC 1624) — matematyczną sztuczkę pozwalającą obliczyć nową sumę kontrolną na podstawie starej wartości i wyłącznie zmienionego pola (TTL), bez konieczności ponownego sumowania całego nagłówka.</p>
<p><strong>IPv6, dla porównania, całkowicie rezygnuje z sumy kontrolnej nagłówka</strong> (rozdział 6) — decyzja ta, choć może się wydawać zaskakująca, jest świadomym wyborem projektowym uzasadnionym w rozdziale 6.3.</p>
<h3>3.11. Adres źródłowy i adres docelowy — po 32 bity</h3>
<p>Dwa pola po 32 bity każde, zawierające adresy IPv4 nadawcy i odbiorcy datagramu, opisane szczegółowo w rozdziale 2. To one — wraz z polem Protokół i portami warstwy transportowej — jednoznacznie identyfikują konkretną „rozmowę\" sieciową (tzw. <strong>5-tuple</strong>: adres źródłowy, port źródłowy, adres docelowy, port docelowy, protokół), wykorzystywaną m.in. przez tablice stanu zapór sieciowych (firewalli) i urządzeń NAT.</p>
<h3>3.12. Opcje i dopełnienie — Options and Padding</h3>
<p>Pole <strong>Opcje</strong> jest <strong>opcjonalne</strong> (stąd nazwa) i o <strong>zmiennej długości</strong>, wykorzystywane rzadko we współczesnym ruchu internetowym — w praktyce wiele urządzeń brzegowych i zapór sieciowych domyślnie odrzuca pakiety z niestandardowymi opcjami ze względów bezpieczeństwa (potencjalny wektor ataku lub obejścia filtracji). Przykładowe historyczne opcje obejmują:</p>
<ul>
<li><strong>Record Route</strong> — każdy router na trasie dopisuje swój adres IP, pozwalając nadawcy prześledzić dokładną trasę pakietu (ograniczone praktyczne zastosowanie ze względu na niewielki dostępny rozmiar pola);</li>
<li><strong>Timestamp</strong> — podobnie, routery dopisują znaczniki czasu przejścia;</li>
<li><strong>Strict/Loose Source Routing</strong> — nadawca narzuca (ściśle lub „luźno\") konkretną trasę pakietu przez wskazane routery, z pominięciem standardowego routingu; mechanizm ten jest dziś powszechnie blokowany ze względów bezpieczeństwa (mógłby posłużyć do obejścia list kontroli dostępu).</li>
</ul>
<p>Ponieważ pole IHL wyraża długość nagłówka w pełnych 4-bajtowych słowach (rozdział 3.2), a Opcje mogą mieć dowolną długość w bajtach, po polu Opcje dodaje się <strong>Padding</strong> — bajty o wartości zero — tak, aby cały nagłówek (13 pól obowiązkowych plus Opcje plus Padding) zawsze kończył się dokładnie na granicy 32-bitowego słowa.</p>
<hr />
<h2>4. Fragmentacja IPv4 — dogłębna analiza</h2>
<h3>4.1. Przyczyna fragmentacji</h3>
<p>Fragmentacja jest konieczna, gdy datagram IP, przekazywany przez router na kolejne łącze, jest <strong>większy niż MTU tego łącza</strong>. Klasyczny scenariusz: dane pochodzą z sieci o dużym MTU (np. niektóre sieci wewnętrzne czy tunele obsługujące Jumbo Frames) i trafiają na standardowy segment Ethernet o MTU 1500 B. Router na granicy tych sieci musi wtedy <strong>podzielić</strong> zbyt duży datagram na mniejsze <strong>fragmenty</strong>, z których każdy zmieści się w MTU łącza wyjściowego.</p>
<h3>4.2. Zasady konstruowania fragmentów</h3>
<p>Każdy fragment jest <strong>samodzielnym, w pełni poprawnym datagramem IP</strong> — otrzymuje własny, kompletny nagłówek (skopiowany w większości pól z oryginału, ale ze zmodyfikowanymi polami Total Length, Flags, Fragment Offset oraz przeliczoną Header Checksum). Reguły konstruowania:</p>
<ol>
<li><strong>Pole Identification</strong> jest identyczne we wszystkich fragmentach pochodzących z tego samego oryginalnego datagramu — to klucz grupujący przy ponownym składaniu.</li>
<li><strong>Pole Fragment Offset</strong> określa pozycję danych tego fragmentu w oryginalnym datagramie, w jednostkach 8-bajtowych (rozdział 3.7).</li>
<li><strong>Pole MF (More Fragments)</strong> ustawione na <code>1</code> we wszystkich fragmentach <strong>poza ostatnim</strong>, gdzie wynosi <code>0</code>.</li>
<li><strong>Pole DF (Don\x27t Fragment)</strong>, jeśli było ustawione w oryginalnym datagramie, uniemożliwia fragmentację w ogóle — router w takiej sytuacji odrzuca datagram (rozdział 4.5).</li>
<li>Rozmiar danych każdego fragmentu (poza ostatnim) musi być <strong>wielokrotnością 8 bajtów</strong>, ze względu na jednostkę pola Fragment Offset.</li>
</ol>
<h3>4.3. Przykład obliczeniowy krok po kroku</h3>
<p>Rozważmy datagram o <strong>4000 bajtach danych</strong> (plus standardowy 20-bajtowy nagłówek, czyli Total Length = 4020 B), z Identification = 51 200, który musi zostać przesłany przez łącze o <strong>MTU = 1500 B</strong>.</p>
<p><strong>Krok 1 — obliczenie maksymalnej ilości danych na fragment.</strong> Dostępne miejsce na dane w jednym fragmencie: <span class=\"mathjax mathjax--inline\">\\(1500 - 20 \\text{ (nagłówek)} = 1480\\)</span> bajtów. Wartość ta musi być zaokrąglona <strong>w dół</strong> do najbliższej wielokrotności 8: <span class=\"mathjax mathjax--inline\">\\(1480 / 8 = 185\\)</span> — już jest wielokrotnością 8, więc zaokrąglenie nie zmienia wyniku. Maksymalna ilość danych na fragment: <strong>1480 B</strong>.</p>
<p><strong>Krok 2 — obliczenie liczby potrzebnych fragmentów.</strong> <span class=\"mathjax mathjax--inline\">\\(\\lceil 4000 / 1480 \\rceil = \\lceil 2{,}70 \\rceil = 3\\)</span> fragmenty.</p>
<p><strong>Krok 3 — konstrukcja poszczególnych fragmentów:</strong></p>
<p><img alt=\"Fragmentacja datagramu IPv4 o rozmiarze 4020 B (4000 B danych) na trzy fragmenty przy MTU 1500 B\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ipv4-fragmentacja.svg\" /></p>
<table>
<thead>
<tr>
<th>Fragment</th>
<th>Dane oryginału (bajty)</th>
<th>Rozmiar danych</th>
<th>Fragment Offset (jedn. 8 B)</th>
<th>MF</th>
<th>Total Length fragmentu</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>0–1479</td>
<td>1480 B</td>
<td><span class=\"mathjax mathjax--inline\">\\(0 / 8 = 0\\)</span></td>
<td>1</td>
<td><span class=\"mathjax mathjax--inline\">\\(20+1480=1500\\)</span> B</td>
</tr>
<tr>
<td>2</td>
<td>1480–2959</td>
<td>1480 B</td>
<td><span class=\"mathjax mathjax--inline\">\\(1480 / 8 = 185\\)</span></td>
<td>1</td>
<td><span class=\"mathjax mathjax--inline\">\\(20+1480=1500\\)</span> B</td>
</tr>
<tr>
<td>3</td>
<td>2960–3999</td>
<td>1040 B</td>
<td><span class=\"mathjax mathjax--inline\">\\(2960 / 8 = 370\\)</span></td>
<td>0</td>
<td><span class=\"mathjax mathjax--inline\">\\(20+1040=1060\\)</span> B</td>
</tr>
</tbody>
</table>
<p>Wszystkie trzy fragmenty niosą identyczną wartość <strong>Identification = 51 200</strong>. Suma rozmiarów danych wszystkich fragmentów: <span class=\"mathjax mathjax--inline\">\\(1480+1480+1040 = 4000\\)</span> B — dokładnie zgadza się z rozmiarem oryginalnych danych, co jest naturalnym warunkiem poprawności fragmentacji.</p>
<h3>4.4. Ponowne składanie fragmentów (Reassembly)</h3>
<p>Kluczowa, często pomijana w uproszczonych opisach zasada: <strong>fragmenty są ponownie składane w oryginalny datagram wyłącznie przez hosta docelowego (odbiorcę końcowego)</strong> — <strong>nie</strong> przez routery pośredniczące na trasie. Router, który sam dokonał fragmentacji lub przez który przechodzą fragmenty utworzone wcześniej, po prostu przekazuje każdy fragment dalej jako niezależny datagram, w oparciu wyłącznie o jego adres docelowy — nie interesuje go, że jest to fragment czegokolwiek.</p>
<p>Host docelowy, odbierając fragmenty (identyfikowane przez trójkę: adres źródłowy + adres docelowy + Identification, a niekiedy dodatkowo pole Protokół), umieszcza je w buforze rekonstrukcyjnym, wykorzystując pole <strong>Fragment Offset</strong> do ustalenia właściwej pozycji danych każdego fragmentu, i uznaje odtwarzanie za zakończone, gdy otrzyma fragment z <strong>MF = 0</strong> (ostatni) <strong>oraz</strong> gdy nie ma żadnych „dziur\" (brakujących zakresów bajtów) między fragmentem o offset 0 a fragmentem końcowym. Jeśli w rozsądnym czasie (typowo ok. 30–60 sekund, zależnie od implementacji systemu operacyjnego) nie uda się skompletować wszystkich fragmentów — np. jeden z nich zaginął po drodze — <strong>cały</strong> datagram jest odrzucany (nie ma mechanizmu retransmisji pojedynczego brakującego fragmentu na poziomie IP), a bywa wysyłany komunikat ICMP „Time Exceeded — Fragment Reassembly Time Exceeded\".</p>
<h3>4.5. Path MTU Discovery — unikanie fragmentacji w praktyce</h3>
<p>Fragmentacja, choć funkcjonalnie poprawna, ma istotne wady wydajnościowe i bywa problematyczna z punktu widzenia bezpieczeństwa (fragmenty bywały historycznie wykorzystywane do obchodzenia zapór sieciowych i systemów IDS/IPS, analizujących zwykle tylko pierwszy fragment z pełnym nagłówkiem warstwy transportowej). Z tych powodów współczesne stosy sieciowe <strong>wolą unikać fragmentacji w ogóle</strong>, stosując mechanizm <strong>Path MTU Discovery (PMTUD, RFC 1191)</strong>:</p>
<ol>
<li>Nadawca ustawia bit <strong>DF (Don\x27t Fragment)</strong> we wszystkich wysyłanych datagramach.</li>
<li>Jeśli na trasie datagram napotka router z łączem wyjściowym o mniejszym MTU niż rozmiar datagramu, router — zamiast fragmentować (co i tak byłoby zabronione przez DF) — <strong>odrzuca</strong> datagram i odsyła nadawcy komunikat <strong>ICMP Destination Unreachable, kod 4 (Fragmentation Needed and DF Set)</strong>, zawierający informację o MTU łącza, które spowodowało problem.</li>
<li>Nadawca, otrzymawszy ten komunikat, <strong>zmniejsza</strong> rozmiar kolejnych wysyłanych datagramów do tej wartości i próbuje ponownie — proces powtarza się, jeśli na dalszej trasie napotkane zostanie łącze o jeszcze mniejszym MTU, aż do znalezienia najmniejszej wartości MTU na całej trasie (tzw. <strong>Path MTU</strong>).</li>
</ol>
<p>Mechanizm ten pozwala nadawcy z góry dostosować rozmiar wysyłanych danych do faktycznych możliwości całej trasy, <strong>eliminując potrzebę fragmentacji przez routery pośredniczące</strong> — fragmentacja, jeśli w ogóle występuje, odbywa się już tylko <strong>na hoście źródłowym</strong>, zanim dane w ogóle opuszczą nadawcę (a dokładniej: w praktyce warstwa transportowa, znając Path MTU, po prostu nie generuje segmentów większych niż to uzasadnione, więc fragmentacja IP staje się zbędna niemal całkowicie). Warto zaznaczyć słabość tego mechanizmu: jeśli komunikaty ICMP są blokowane przez pośredniczącą zaporę sieciową (błąd konfiguracji określany jako <strong>PMTUD black hole</strong>), nadawca nigdy nie dowiaduje się o problemie, a jego pakiety są po cichu odrzucane — dlatego dobra praktyka administracyjna zaleca zawsze przepuszczać komunikaty ICMP typu Destination Unreachable.</p>
<hr />
<h2>5. Pole TTL i zapobieganie pętlom routingu</h2>
<h3>5.1. Problem: co by się stało bez TTL?</h3>
<p>W dużej, rozproszonej sieci, zarządzanej przez wielu niezależnych administratorów i wykorzystującej dynamiczne protokoły routingu, <strong>błędy konfiguracji prowadzące do pętli routingu</strong> (sytuacji, w której router A kieruje ruch do routera B, a router B — z powrotem do routera A) są, choć rzadkie, praktycznie nieuniknione w skali całego internetu. Bez żadnego mechanizmu ograniczającego, pakiet uwięziony w takiej pętli krążyłby <strong>w nieskończoność</strong>, bezużytecznie zajmując pasmo i zasoby przetwarzania kolejnych routerów, aż do całkowitego zapchania dotkniętego fragmentu sieci — zjawisko analogiczne do burzy rozgłoszeniowej w warstwie 2 (patrz materiał o urządzeniach warstwy dostępu), lecz występujące w warstwie 3.</p>
<h3>5.2. Zasada działania TTL</h3>
<p>Pole <strong>TTL (Time To Live)</strong>, mimo swojej nazwy sugerującej jednostkę czasu, jest w praktyce <strong>licznikiem przeskoków (hop count)</strong>, a nie licznikiem czasu w sekundach (taka była pierwotna, nigdy w pełni niewdrożona koncepcja z RFC 791, gdzie TTL miał być dekrementowany również w trakcie oczekiwania w kolejce routera, nie tylko przy każdym przeskoku). Zasada działania:</p>
<ol>
<li>Nadawca ustawia TTL na pewną <strong>wartość początkową</strong>, typową dla systemu operacyjnego: <strong>64</strong> (Linux, macOS, większość dystrybucji Unix), <strong>128</strong> (Windows) lub <strong>255</strong> (niektóre starsze systemy i urządzenia sieciowe, np. Cisco IOS).</li>
<li><strong>Każdy router</strong>, przez który przechodzi datagram, <strong>dekrementuje TTL o co najmniej 1</strong> przed dalszym przekazaniem (RFC dopuszcza dekrementację o więcej niż 1, jeśli pakiet oczekiwał w kolejce dłużej niż 1 sekundę, ale w praktyce niemal wszystkie implementacje stosują dokładnie dekrementację o 1 na przeskok).</li>
<li>Jeśli po dekrementacji TTL osiągnie wartość <strong>0</strong>, router <strong>odrzuca</strong> datagram (nie przekazuje go dalej) i — o ile nie jest to celowo wyłączone ze względów bezpieczeństwa lub wydajności — odsyła do adresu źródłowego komunikat <strong>ICMP Time Exceeded (Typ 11, Kod 0)</strong>.</li>
</ol>
<p><img alt=\"Dekrementacja TTL na każdym przeskoku routingu i odrzucenie pakietu po osiągnięciu wartości zero\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ttl-forwarding.svg\" /></p>
<h3>5.3. TTL jako narzędzie diagnostyczne — mechanizm traceroute</h3>
<p>Zjawisko odrzucania pakietu i generowania komunikatu ICMP Time Exceeded po wygaśnięciu TTL jest sprytnie wykorzystywane przez narzędzie diagnostyczne <strong>traceroute</strong> (w Windows: <code>tracert</code>) do <strong>odkrywania trasy</strong> pakietów do danego celu, router po routerze:</p>
<ol>
<li>Narzędzie wysyła pierwszy pakiet (zwykle UDP na nietypowy port, ICMP Echo Request lub TCP SYN, zależnie od implementacji i systemu) z <strong>TTL = 1</strong>.</li>
<li>Pierwszy router na trasie dekrementuje TTL do 0, odrzuca pakiet i odsyła ICMP Time Exceeded — traceroute odczytuje adres źródłowy tego komunikatu, poznając w ten sposób adres <strong>pierwszego przeskoku (hop)</strong>.</li>
<li>Narzędzie wysyła kolejny pakiet z <strong>TTL = 2</strong> — tym razem pierwszy router przepuszcza go dalej (dekrementując do 1), a to <strong>drugi</strong> router w kolejności odrzuca pakiet przy TTL = 0, ujawniając swój adres.</li>
<li>Proces powtarza się z rosnącym TTL (3, 4, 5, …), aż pakiet w końcu dotrze do właściwego celu, który — nie mając już czego przekazywać dalej — odpowiada bezpośrednio (typowo komunikatem ICMP Destination Unreachable/Port Unreachable dla sond UDP, lub bezpośrednią odpowiedzią dla ICMP Echo).</li>
</ol>
<p>W ten elegancki sposób, wykorzystując mechanizm zaprojektowany pierwotnie wyłącznie do zapobiegania pętlom, traceroute odtwarza <strong>pełną listę routerów</strong> na trasie do celu wraz z przybliżonym czasem odpowiedzi każdego z nich (zwykle trzy próby na każdy TTL, dla uśrednienia opóźnienia i wykrycia niestabilności trasy).</p>
<h3>5.4. Praktyczne konsekwencje wartości początkowej TTL</h3>
<p>Analiza wartości TTL w odebranym pakiecie bywa też wykorzystywana (choć zawodnie) do <strong>przybliżonego rozpoznania systemu operacyjnego</strong> nadawcy (tzw. pasywny fingerprinting) — poprzez porównanie <strong>odebranej</strong> wartości TTL z najbliższą typową wartością początkową (64, 128, 255) i policzenie różnicy, można oszacować <strong>liczbę przeskoków</strong> pokonanych przez pakiet, a pośrednio typowa wartość początkowa bywa wskazówką co do rodzaju nadawcy. Metoda ta jest jednak dość zawodna: administratorzy mogą ręcznie zmieniać domyślne wartości TTL, a rzeczywista liczba przeskoków bywa trudna do jednoznacznego oszacowania.</p>
<p>Zbyt <strong>niska</strong> wartość początkowa TTL, ustawiona przez nadawcę, może w skrajnym przypadku spowodować, że pakiet <strong>nigdy nie dotrze do odległego celu</strong>, wygasając po drodze, zanim dotrze do miejsca docelowego — z tego powodu wartości początkowe TTL są dobierane z pewnym zapasem (64 lub 128 przeskoków to znacznie więcej, niż typowa trasa w internecie wymaga — rzeczywiste trasy między hostami na całym świecie liczą zwykle kilkanaście do góra dwudziestu kilku przeskoków).</p>
<hr />
<h2>6. Warstwa sieciowa a protokół IPv6</h2>
<h3>6.1. Motywacja powstania IPv6</h3>
<p>Jak wspomniano w rozdziale 2, 32-bitowa przestrzeń adresowa IPv4 (nieco ponad 4,3 miliarda adresów) okazała się dalece niewystarczająca w obliczu globalnej ekspansji internetu, eksplozji urządzeń mobilnych i internetu rzeczy. Protokół <strong>IPv6</strong>, opisany obecnie w <strong>RFC 8200</strong> (wcześniej RFC 2460 z 1998 r.), został zaprojektowany od podstaw, aby rozwiązać ten problem, a przy okazji — usprawnić i uprościć szereg mechanizmów, które w IPv4 z czasem okazały się niepotrzebnie skomplikowane lub przestarzałe.</p>
<h3>6.2. Budowa stałego nagłówka IPv6</h3>
<p>W przeciwieństwie do nagłówka IPv4, który ma <strong>zmienną</strong> długość (20–60 B, zależnie od obecności opcji — rozdział 3), <strong>stały nagłówek IPv6 ma zawsze dokładnie 40 bajtów</strong> i składa się z zaledwie <strong>8 pól</strong> — znacznie mniej niż 13 pól obowiązkowych IPv4.</p>
<p><img alt=\"Budowa stałego nagłówka IPv6 — zawsze dokładnie 40 bajtów, 8 pól\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ipv6-naglowek-budowa.svg\" /></p>
<table>
<thead>
<tr>
<th>Pole</th>
<th>Rozmiar</th>
<th>Odpowiednik / różnica względem IPv4</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Wersja (Version)</strong></td>
<td>4 b</td>
<td>jak w IPv4, tu zawsze wartość 6</td>
</tr>
<tr>
<td><strong>Klasa ruchu (Traffic Class)</strong></td>
<td>8 b</td>
<td>odpowiednik pola ToS/DiffServ+ECN (rozdział 3.3) — identyczna koncepcja DSCP i ECN, przeniesiona wprost</td>
</tr>
<tr>
<td><strong>Etykieta przepływu (Flow Label)</strong></td>
<td>20 b</td>
<td><strong>pole nowe</strong>, nieobecne w IPv4 — pozwala oznaczyć wszystkie pakiety należące do tego samego „przepływu\" (np. jednej sesji TCP) tą samą wartością, ułatwiając routerom szybkie, sprzętowe utrzymywanie spójnego traktowania (np. tej samej ścieżki w równoważeniu obciążenia ECMP) bez konieczności analizy portów warstwy transportowej</td>
</tr>
<tr>
<td><strong>Długość danych (Payload Length)</strong></td>
<td>16 b</td>
<td>odpowiednik Total Length, ale liczy <strong>wyłącznie dane</strong> (bez 40-bajtowego nagłówka stałego), ponieważ ten ma zawsze znaną, stałą długość</td>
</tr>
<tr>
<td><strong>Następny nagłówek (Next Header)</strong></td>
<td>8 b</td>
<td>odpowiednik pola Protokół (rozdział 3.9), ale pełni też dodatkową rolę — może wskazywać na <strong>nagłówek rozszerzenia</strong> (rozdział 6.4), a nie bezpośrednio na protokół transportowy</td>
</tr>
<tr>
<td><strong>Limit przeskoków (Hop Limit)</strong></td>
<td>8 b</td>
<td>dokładny odpowiednik TTL (rozdział 5) — inna nazwa, identyczna funkcja: dekrementacja o 1 na każdym routerze, odrzucenie przy 0</td>
</tr>
<tr>
<td><strong>Adres źródłowy</strong></td>
<td><strong>128 b</strong></td>
<td>4-krotnie dłuższy niż w IPv4 (32 b)</td>
</tr>
<tr>
<td><strong>Adres docelowy</strong></td>
<td><strong>128 b</strong></td>
<td>jw.</td>
</tr>
</tbody>
</table>
<p><strong>Pól, które zniknęły całkowicie</strong> względem IPv4: IHL (zbędne — nagłówek ma zawsze stałą długość 40 B), Identification/Flags/Fragment Offset (fragmentacja działa inaczej — rozdział 6.5), oraz <strong>Header Checksum</strong> (rozdział 6.3).</p>
<h3>6.3. Dlaczego IPv6 zrezygnował z sumy kontrolnej nagłówka?</h3>
<p>Decyzja o usunięciu pola Header Checksum (obecnego w IPv4, rozdział 3.10) była świadomym wyborem projektowym, uzasadnionym kilkoma argumentami:</p>
<ul>
<li><strong>Redundancja z innymi warstwami.</strong> Ramka warstwy 2 (np. Ethernet) już zawiera własną sumę kontrolną <strong>FCS/CRC-32</strong>, wykrywającą uszkodzenia na poziomie pojedynczego łącza. Protokoły transportowe <strong>TCP i UDP</strong> zawierają własne sumy kontrolne, obejmujące zarówno nagłówek transportowy, jak i dane, a nawet (poprzez tzw. pseudo-nagłówek) kluczowe pola nagłówka IP (adresy źródłowy i docelowy). Suma kontrolna na poziomie IP była więc w dużej mierze <strong>powtórzeniem</strong> zabezpieczenia już zapewnianego przez warstwy sąsiadujące.</li>
<li><strong>Koszt wydajnościowy.</strong> Jak wyjaśniono w rozdziale 3.10, obecność sumy kontrolnej w IPv4 wymusza jej <strong>przeliczenie przez każdy router</strong> po każdej modyfikacji nagłówka (w szczególności — dekrementacji TTL/Hop Limit). Przy prędkościach transmisji rzędu dziesiątek i setek gigabitów na sekundę, charakterystycznych dla współczesnych routerów szkieletowych, nawet niewielki koszt obliczeniowy per-pakiet, pomnożony przez miliardy pakietów na sekundę, staje się istotnym obciążeniem. Usunięcie tego wymogu upraszcza i przyspiesza sprzętową implementację przekazywania pakietów.</li>
<li><strong>Filozofia end-to-end.</strong> Zgodnie z zasadą end-to-end (rozdział 1.2), odpowiedzialność za integralność danych aplikacji lepiej umiejscowić na brzegach sieci (w protokołach transportowych i aplikacyjnych), a nie duplikować ją niepotrzebnie w każdym pośredniczącym routerze rdzenia sieci.</li>
</ul>
<h3>6.4. Nagłówki rozszerzeń (Extension Headers)</h3>
<p>Zamiast pojedynczego pola Opcje o zmiennej długości (jak w IPv4, rozdział 3.12), IPv6 wprowadza koncepcję <strong>łańcucha nagłówków rozszerzeń</strong> — dodatkowych, opcjonalnych nagłówków, umieszczanych między stałym nagłówkiem IPv6 a nagłówkiem protokołu warstwy transportowej, połączonych w łańcuch za pomocą pola <strong>Next Header</strong> każdego z nich (każdy nagłówek rozszerzenia, podobnie jak nagłówek stały, zawiera własne pole Next Header wskazujące na kolejny element łańcucha). Do standardowych nagłówków rozszerzeń należą m.in.: <strong>Hop-by-Hop Options</strong>, <strong>Routing</strong> (odpowiednik source routing z IPv4), <strong>Fragment</strong> (patrz niżej), <strong>Authentication Header (AH)</strong> i <strong>Encapsulating Security Payload (ESP)</strong> — te dwa ostatnie współdzielone z mechanizmem IPsec, również dostępnym w IPv4.</p>
<p>Kluczowa zaleta tej architektury: routery pośredniczące na trasie muszą przetwarzać (i mogą efektywnie pominąć) tylko nagłówki, które ich rzeczywiście dotyczą — w typowym przypadku <strong>żadnych</strong> nagłówków rozszerzeń, przechodząc bezpośrednio od stałego nagłówka do przekazania pakietu dalej, bez analizowania opcji przeznaczonych wyłącznie dla hosta docelowego.</p>
<h3>6.5. Fragmentacja w IPv6 — fundamentalna różnica koncepcyjna</h3>
<p>To jedna z najbardziej istotnych różnic architektonicznych między obiema wersjami protokołu. W IPv4 fragmentacji, jak opisano w rozdziale 4, mógł dokonać <strong>dowolny router na trasie</strong>, jeśli napotkał łącze o zbyt małym MTU. <strong>W IPv6 routery pośredniczące nigdy nie fragmentują pakietów.</strong> Fragmentacja, jeśli jest w ogóle konieczna, może zostać wykonana <strong>wyłącznie przez hosta źródłowego</strong>, przed wysłaniem pakietu — a informacja o niej przenoszona jest w osobnym, opcjonalnym <strong>nagłówku rozszerzenia Fragment</strong> (zawierającym pola analogiczne funkcjonalnie do Identification, Fragment Offset i M-flag z IPv4, lecz umieszczone poza stałym nagłówkiem).</p>
<p>Jeśli router IPv6 napotka na trasie pakiet zbyt duży dla łącza wyjściowego, <strong>zawsze</strong> odrzuca go i odsyła nadawcy komunikat <strong>ICMPv6 Packet Too Big (Typ 2)</strong> — dokładny odpowiednik mechanizmu Path MTU Discovery (rozdział 4.5), z tą różnicą, że w IPv6 jest to <strong>jedyny</strong> dostępny sposób obsługi zbyt dużych pakietów (nie istnieje odpowiednik „zwykłej\" fragmentacji przez router, obecnej opcjonalnie w IPv4 przy braku bitu DF). Decyzja ta wymusza powszechne stosowanie mechanizmu Path MTU Discovery jako integralnej, obowiązkowej części stosu IPv6, a nie opcjonalnego usprawnienia jak w IPv4.</p>
<p>Dodatkowo IPv6 wprowadza wymóg <strong>minimalnego MTU całej trasy wynoszącego co najmniej 1280 bajtów</strong> — każde łącze obsługujące IPv6 musi zapewniać MTU nie mniejsze niż ta wartość (a jeśli fizyczne łącze ma mniejsze MTU, warstwa 2 musi zapewnić przezroczystą fragmentację/składanie na swoim własnym poziomie, niewidoczną dla IPv6). Gwarantuje to, że host źródłowy zawsze może bezpiecznie wysłać pakiet o rozmiarze do 1280 B bez ryzyka odrzucenia z powodu zbyt małego MTU gdziekolwiek na trasie, nawet bez uprzedniego przeprowadzenia pełnego Path MTU Discovery.</p>
<h3>6.6. Porównanie kluczowych pól i mechanizmów</h3>
<table>
<thead>
<tr>
<th>Cecha / pole</th>
<th>IPv4</th>
<th>IPv6</th>
</tr>
</thead>
<tbody>
<tr>
<td>Długość adresu</td>
<td>32 bity</td>
<td>128 bitów</td>
</tr>
<tr>
<td>Długość nagłówka</td>
<td>zmienna, 20–60 B</td>
<td>zawsze 40 B (nagłówek stały)</td>
</tr>
<tr>
<td>Pole długości nagłówka (IHL)</td>
<td>tak</td>
<td>nie istnieje (długość zawsze stała)</td>
</tr>
<tr>
<td>Suma kontrolna nagłówka</td>
<td>tak, przeliczana na każdym routerze</td>
<td><strong>usunięta</strong></td>
</tr>
<tr>
<td>Fragmentacja przez routery pośredniczące</td>
<td>dopuszczalna (jeśli brak DF)</td>
<td><strong>niedopuszczalna</strong> — tylko host źródłowy, przez nagłówek rozszerzenia</td>
</tr>
<tr>
<td>Minimalne MTU gwarantowane na każdym łączu</td>
<td>brak formalnego wymogu</td>
<td><strong>1280 B</strong></td>
</tr>
<tr>
<td>Opcje</td>
<td>pole Options w nagłówku podstawowym</td>
<td>oddzielny łańcuch nagłówków rozszerzeń</td>
</tr>
<tr>
<td>Priorytetyzacja ruchu</td>
<td>ToS / DSCP + ECN (8 b)</td>
<td>Traffic Class (8 b) — koncepcyjnie identyczne</td>
</tr>
<tr>
<td>Identyfikacja przepływu</td>
<td>brak dedykowanego pola</td>
<td>Flow Label (20 b) — pole nowe</td>
</tr>
<tr>
<td>Licznik przeskoków</td>
<td>TTL (8 b)</td>
<td>Hop Limit (8 b) — identyczna funkcja, inna nazwa</td>
</tr>
<tr>
<td>Pole wskazujące protokół wyższej warstwy</td>
<td>Protocol (8 b)</td>
<td>Next Header (8 b) — ta sama koncepcja, rozszerzona o łańcuch nagłówków</td>
</tr>
<tr>
<td>Adresacja rozgłoszeniowa (broadcast)</td>
<td>tak (np. <code>255.255.255.255</code>)</td>
<td><strong>nie istnieje</strong> — zastąpiona przez rozszerzone wykorzystanie multicastu</td>
</tr>
<tr>
<td>Autokonfiguracja adresu bez serwera</td>
<td>brak (poza link-local APIPA)</td>
<td><strong>SLAAC</strong> wbudowany w projekt protokołu</td>
</tr>
</tbody>
</table>
<hr />
<h2>7. Podsumowanie</h2>
<p>Warstwa sieciowa, a w niej protokół IP, stanowi kręgosłup, dzięki któremu miliardy niezależnie zarządzanych, technologicznie odmiennych sieci lokalnych tworzą jedną, spójną całość — internet. Kluczem do tej integracji jest <strong>hierarchiczna adresacja logiczna</strong>, pozwalająca routerom podejmować decyzje na podstawie skalowalnych, agregowanych bloków adresów, zamiast płaskiej listy każdego pojedynczego urządzenia.</p>
<p>Dokładna analiza nagłówka IPv4 — pole IHL określające zmienną długość nagłówka w jednostkach 4-bajtowych, pole ToS przekształcone z czasem w architekturę DiffServ i mechanizm ECN, pole TTL zapobiegające nieskończonym pętlom routingu (i przy okazji umożliwiające działanie narzędzia traceroute), złożony, wieloetapowy mechanizm fragmentacji oparty na współpracy pól Identification, Flags i Fragment Offset, oraz pole Protokół pełniące funkcję „adresu docelowego\" w obrębie stosu protokołów hosta — pokazuje, jak wiele przemyślanych, wzajemnie powiązanych decyzji projektowych kryje się w pozornie prostym, 20-bajtowym nagłówku zaprojektowanym w 1981 roku, a wciąż niosącym większość światowego ruchu internetowego.</p>
<p><strong>IPv6</strong>, projektowany dwie dekady później, z pełną świadomością ograniczeń poprzednika, pokazuje alternatywną filozofię projektową: stały, uproszczony nagłówek zamiast zmiennej długości z polem IHL, rezygnacja z sumy kontrolnej na rzecz zabezpieczeń w warstwach sąsiednich, przeniesienie fragmentacji wyłącznie na hosta źródłowego oraz elastyczny, rozszerzalny łańcuch nagłówków zamiast sztywnego pola Opcje. Obie wersje protokołu, mimo fundamentalnych różnic w szczegółach implementacyjnych, realizują tę samą, wspólną misję warstwy sieciowej: dostarczenie danych od źródła do celu, przez potencjalnie wiele pośredniczących sieci, w modelu bezpołączeniowym, najlepszego możliwego wysiłku.</p>
<hr />
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
<td><strong>Best-effort</strong></td>
<td>model usługi bez gwarancji dostarczenia, kolejności czy czasu</td>
</tr>
<tr>
<td><strong>CIDR</strong></td>
<td>bezklasowy routing międzydomenowy — dowolna granica sieć/host wyrażona prefiksem</td>
</tr>
<tr>
<td><strong>DiffServ / DSCP</strong></td>
<td>architektura różnicowania klas obsługi pakietów na podstawie 6-bitowego pola w nagłówku</td>
</tr>
<tr>
<td><strong>ECN</strong></td>
<td>jawne sygnalizowanie przeciążenia bez odrzucania pakietu</td>
</tr>
<tr>
<td><strong>Flow Label</strong></td>
<td>20-bitowe pole IPv6 identyfikujące przepływ pakietów należących do tej samej sesji</td>
</tr>
<tr>
<td><strong>Fragmentacja</strong></td>
<td>podział zbyt dużego datagramu na mniejsze części dopasowane do MTU łącza</td>
</tr>
<tr>
<td><strong>Header Checksum</strong></td>
<td>suma kontrolna obejmująca wyłącznie nagłówek IPv4, przeliczana na każdym routerze</td>
</tr>
<tr>
<td><strong>Hop Limit</strong></td>
<td>odpowiednik TTL w IPv6</td>
</tr>
<tr>
<td><strong>IHL</strong></td>
<td>pole określające długość nagłówka IPv4 w jednostkach 4-bajtowych</td>
</tr>
<tr>
<td><strong>MTU</strong></td>
<td>maksymalna jednostka transmisji dopuszczalna na danym łączu</td>
</tr>
<tr>
<td><strong>Next Header</strong></td>
<td>pole IPv6 wskazujące kolejny nagłówek rozszerzenia lub protokół warstwy transportowej</td>
</tr>
<tr>
<td><strong>Path MTU Discovery</strong></td>
<td>mechanizm ustalania najmniejszego MTU na całej trasie, bez fragmentacji przez routery</td>
</tr>
<tr>
<td><strong>RFC 1918</strong></td>
<td>dokument definiujący prywatne, niemarszrutyzowane publicznie zakresy adresów IPv4</td>
</tr>
<tr>
<td><strong>TTL</strong></td>
<td>licznik przeskoków dekrementowany przez każdy router, zapobiegający pętlom routingu</td>
</tr>
</tbody>
</table>
<hr />
<h2>9. Pytania kontrolne i zadania</h2>
<h3>Pytania</h3>
<ol>
<li>Wyjaśnij, dlaczego adresacja hierarchiczna (jak w IP) jest niezbędna dla skalowalności internetu, w odróżnieniu od płaskiej adresacji MAC.</li>
<li>Pole IHL wyraża długość nagłówka w jednostkach 4-bajtowych, a nie wprost w bajtach. Wyjaśnij, dlaczego, oraz oblicz maksymalną długość nagłówka IPv4 w bajtach.</li>
<li>Czym różni się dzisiejsza interpretacja 8-bitowego pola ToS (DSCP + ECN) od jego pierwotnego znaczenia z RFC 791? Jaką funkcję pełni każda z tych dwóch nowych części?</li>
<li>Opisz krok po kroku, jak router wykorzystuje pola Identification, Flags (MF, DF) i Fragment Offset przy fragmentacji zbyt dużego datagramu.</li>
<li>Dlaczego rozmiar danych każdego fragmentu IPv4 (poza ostatnim) musi być wielokrotnością 8 bajtów?</li>
<li>Wyjaśnij zasadę działania pola TTL i opisz, w jaki sposób to pole jest wykorzystywane przez narzędzie diagnostyczne traceroute do odkrywania trasy pakietów.</li>
<li>Do czego służy pole Protokół w nagłówku IPv4? Podaj przykład sytuacji, w której nieprawidłowa wartość tego pola uniemożliwiłaby poprawne dostarczenie danych do aplikacji.</li>
<li>Dlaczego suma kontrolna nagłówka IPv4 musi być przeliczana na każdym routerze na trasie? Jakie są konsekwencje wydajnościowe tego wymogu i jak rozwiązuje ten problem IPv6?</li>
<li>Wymień co najmniej cztery różnice między nagłówkiem IPv4 a nagłówkiem IPv6 (poza samą długością adresu) i krótko uzasadnij motywację projektową każdej z nich.</li>
<li>Wyjaśnij, na czym polega fundamentalna różnica w podejściu do fragmentacji między IPv4 a IPv6, oraz jaką rolę odgrywa w tym kontekście gwarantowane minimalne MTU 1280 B w IPv6.</li>
</ol>
<h3>Zadania obliczeniowe</h3>
<p><strong>Zadanie 1.</strong> Datagram IPv4 ma pole Total Length = 5940 B i standardowy nagłówek bez opcji (IHL = 5). Musi zostać przesłany przez łącze o MTU = 1500 B. Oblicz: (a) rozmiar danych oryginalnego datagramu, (b) liczbę wymaganych fragmentów, (c) wartości pól Fragment Offset i MF dla każdego fragmentu.</p>
<p><strong>Zadanie 2.</strong> Host wysyła pakiet z TTL = 64 do serwera odległego o 11 przeskoków routingu. Jaka wartość TTL zostanie odczytana przez serwer docelowy w odebranym pakiecie? Jaka jest maksymalna liczba dodatkowych przeskoków, jaką mógłby jeszcze pokonać ten pakiet, zanim zostałby odrzucony?</p>
<p><strong>Zadanie 3.</strong> Sieć <code>10.20.30.0/23</code> ma zostać podzielona na 8 równych podsieci. Oblicz nowy prefiks, liczbę adresów użytecznych dla hostów w każdej podsieci oraz podaj adres sieci i adres rozgłoszeniowy trzeciej z kolei podsieci.</p>
<h3>Klucz odpowiedzi do zadań</h3>
<p><strong>Zadanie 1.</strong> (a) Dane = <span class=\"mathjax mathjax--inline\">\\(5940 - 20 = 5920\\)</span> B. (b) Maksymalne dane na fragment: <span class=\"mathjax mathjax--inline\">\\(1500-20=1480\\)</span> B (już wielokrotność 8). Liczba fragmentów: <span class=\"mathjax mathjax--inline\">\\(\\lceil 5920/1480 \\rceil = 4\\)</span>. (c) Fragment 1: offset = 0, dane 0–1479 (1480 B), MF=1. Fragment 2: offset = <span class=\"mathjax mathjax--inline\">\\(1480/8=185\\)</span>, dane 1480–2959 (1480 B), MF=1. Fragment 3: offset = <span class=\"mathjax mathjax--inline\">\\(2960/8=370\\)</span>, dane 2960–4439 (1480 B), MF=1. Fragment 4: offset = <span class=\"mathjax mathjax--inline\">\\(4440/8=555\\)</span>, dane 4440–5919 (1480 B), MF=0. (Suma danych: <span class=\"mathjax mathjax--inline\">\\(1480 \\times 4 = 5920\\)</span> B — zgadza się).</p>
<p><strong>Zadanie 2.</strong> Serwer odczyta TTL <span class=\"mathjax mathjax--inline\">\\(= 64 - 11 = \\mathbf{53}\\)</span>. Ponieważ pakiet zostanie odrzucony przy TTL = 0, mógłby jeszcze pokonać maksymalnie <strong>53 dodatkowe przeskoki</strong> (docierając z TTL=1 do dwunastego kolejnego routera), zanim zostałby odrzucony.</p>
<p><strong>Zadanie 3.</strong> <span class=\"mathjax mathjax--inline\">\\(/23\\)</span> ma <span class=\"mathjax mathjax--inline\">\\(32-23=9\\)</span> bitów hosta (<span class=\"mathjax mathjax--inline\">\\(2^9=512\\)</span> adresów). Podział na 8 podsieci wymaga <span class=\"mathjax mathjax--inline\">\\(\\log_2 8 = 3\\)</span> dodatkowych bitów sieciowych: nowy prefiks <span class=\"mathjax mathjax--inline\">\\(= 23+3 = \\mathbf{/26}\\)</span>. Adresów łącznie na podsieć: <span class=\"mathjax mathjax--inline\">\\(2^{32-26}=2^6=64\\)</span>, użytecznych dla hostów: <span class=\"mathjax mathjax--inline\">\\(64-2=\\mathbf{62}\\)</span>. Rozmiar skoku między kolejnymi podsieciami: 64 adresy. Podsieci (licząc od <code>10.20.30.0/26</code>): 1. <code>10.20.30.0/26</code>, 2. <code>10.20.30.64/26</code>, 3. <strong><code>10.20.30.128/26</code></strong> — adres sieci: <strong>10.20.30.128</strong>, zakres hostów: 10.20.30.129–10.20.30.190, adres rozgłoszeniowy: <strong>10.20.30.191</strong>.</p>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6";
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
        return new Source("<h2>Wprowadzenie</h2>
<p>Warstwa sieciowa (warstwa 3 modelu ISO/OSI) jest miejscem, w którym pojedyncze sieci lokalne — każda ze swoją niezależną adresacją fizyczną, swoim medium transmisyjnym i swoimi urządzeniami warstwy 2 — zostają połączone w jedną, spójną, globalną strukturę: internet. To właśnie tutaj żyje protokół <strong>IP (Internet Protocol)</strong>, będący dosłownie tym „klejem\", który sprawia, że ramka wysłana z laptopa w Warszawie może dotrzeć do serwera w Tokio, przechodząc po drodze przez dziesiątki różnych sieci, technologii łącza i administratorów, z których żaden nie musi wiedzieć nic o pozostałych — musi jedynie umieć przekazać pakiet IP o krok bliżej celu.</p>
<p>Ten materiał koncentruje się przede wszystkim na <strong>protokole IPv4</strong> — jego roli, adresacji logicznej oraz drobiazgowej, pole po polu, analizie budowy nagłówka, ze szczególnym naciskiem na mechanizmy IHL, ToS/DiffServ, TTL, fragmentację oraz identyfikację protokołu warstwy wyższej. W dalszej części materiał przedstawia również <strong>protokół IPv6</strong>, jego nagłówek i najważniejsze różnice względem poprzednika, aby całość dawała pełny, porównawczy obraz warstwy sieciowej we współczesnych sieciach.</p>
<hr />
<h2>1. Rola warstwy sieciowej</h2>
<h3>1.1. Zadania warstwy 3</h3>
<p>Warstwa sieciowa odpowiada za dostarczenie danych <strong>od hosta źródłowego do hosta docelowego</strong>, potencjalnie przez wiele pośredniczących sieci, niezależnie od technologii warstwy 2 każdej z nich. Do jej podstawowych zadań należą:</p>
<ul>
<li><strong>adresacja logiczna</strong> — nadanie każdemu urządzeniu w sieci unikalnego, globalnie (lub przynajmniej w obrębie danej sieci) rozpoznawalnego adresu, niezależnego od technologii fizycznej łącza, po którym akurat przemieszcza się dany pakiet;</li>
<li><strong>routing (trasowanie)</strong> — wybór ścieżki, którą pakiet powinien pokonać od źródła do celu, przez potencjalnie wiele pośredniczących routerów; realizowany na podstawie tablic routingu budowanych statycznie lub dynamicznie (protokoły takie jak OSPF, BGP — wykraczające poza zakres tego materiału);</li>
<li><strong>przekazywanie (forwarding)</strong> — praktyczna, wykonywana „w locie\" przez każdy router czynność polegająca na odebraniu pakietu na jednym interfejsie, odczytaniu adresu docelowego, sprawdzeniu go w tablicy routingu i wysłaniu na odpowiedni interfejs wyjściowy;</li>
<li><strong>fragmentacja i ponowne składanie danych</strong> — dostosowanie rozmiaru pakietu do maksymalnej jednostki transmisji (MTU) kolejnych łączy na trasie</li>
<li><strong>oznaczanie klasy usługi (opcjonalnie)</strong> — możliwość wskazania priorytetu lub wymagań jakościowych pakietu (pole ToS/DiffServ, rozdział 3.3), wykorzystywana przez mechanizmy QoS;</li>
<li><strong>kontrola czasu życia pakietu</strong> — zapobieganie nieskończonemu krążeniu pakietów w pętlach routingu.</li>
</ul>
<p>Co istotne, warstwa sieciowa <strong>nie zajmuje się</strong> niezawodnością dostarczenia (retransmisją utraconych danych), kontrolą przepływu ani zachowaniem kolejności — te zadania, o ile są potrzebne, realizowane są przez warstwę transportową (TCP) lub aplikacje korzystające bezpośrednio z UDP.</p>
<h3>1.2. Usługa bezpołączeniowa — model best-effort</h3>
<p>Protokół IP, zarówno w wersji 4, jak i 6, realizuje <strong>usługę bezpołączeniową (connectionless)</strong>, określaną też mianem <strong>best-effort</strong> (najlepszego możliwego wysiłku, ale bez gwarancji). Oznacza to, że:</p>
<ul>
<li>każdy pakiet (zwany w kontekście IP <strong>datagramem</strong>) jest przetwarzany <strong>niezależnie</strong> od poprzednich i kolejnych — router nie utrzymuje żadnego „stanu rozmowy\" między dwoma hostami;</li>
<li>kolejne datagramy tej samej komunikacji <strong>mogą dotrzeć do celu różnymi trasami</strong> i w <strong>innej kolejności</strong>, niż zostały wysłane;</li>
<li>protokół IP <strong>nie gwarantuje dostarczenia</strong> — datagram może zostać odrzucony (np. z powodu przeciążenia routera, błędu, wygaśnięcia TTL) bez żadnego powiadomienia nadawcy (poza opcjonalnymi komunikatami ICMP);</li>
<li><strong>nie ma potwierdzeń ani retransmisji</strong> na poziomie IP — jeśli aplikacja wymaga niezawodności, musi skorzystać z protokołu transportowego TCP, który buduje tę niezawodność na bazie zawodnej usługi IP.</li>
</ul>
<p>Ten model — prosty, „głupi\" rdzeń sieci (routery jedynie przekazują pakiety najlepiej, jak potrafią) i „inteligentne\" brzegi (hosty końcowe odpowiadają za niezawodność) — bywa określany zasadą <strong>end-to-end</strong> i jest jedną z fundamentalnych decyzji architektonicznych, które umożliwiły internetowi skalowanie do miliardów urządzeń: routery szkieletowe nie muszą pamiętać nic o pojedynczych połączeniach, co drastycznie upraszcza i przyspiesza ich działanie.</p>
<h3>1.3. Miejsce IP w stosie protokołów i enkapsulacja</h3>
<p>Datagram IP jest przenoszony jako <strong>pole danych (payload)</strong> ramki warstwy 2 (np. ramki Ethernet — patrz materiał o strukturze ramki Ethernet). Z kolei sam datagram IP zawiera w swoim polu danych segment lub datagram warstwy transportowej (TCP lub UDP), a ten z kolei — dane aplikacji. Każda warstwa dokłada swój własny nagłówek, tworząc strukturę „matrioszki\":</p>
<pre><code class=\"language-bash\">Ramka Ethernet [ nagłówek Ethernet [ nagłówek IP [ nagłówek TCP/UDP [ dane aplikacji ] ] ] FCS ]</code></pre>
<p>To pole <strong>EtherType</strong> w nagłówku Ethernet (wartość <code>0x0800</code> dla IPv4, <code>0x86DD</code> dla IPv6) informuje odbiorcę, że zawartość ramki należy przekazać do modułu IP w systemie operacyjnym. Analogicznie, wewnątrz samego datagramu IP pole <strong>Protokół</strong> (rozdział 3.9) pełni dokładnie tę samą funkcję na kolejnym poziomie — wskazuje, do którego protokołu warstwy transportowej należy przekazać zawartość pola danych.</p>
<hr />
<h2>2. Logiczna adresacja hostów w IPv4</h2>
<h3>2.1. Dlaczego adresacja logiczna, skoro istnieje adres MAC?</h3>
<p>Adres MAC (warstwa 2, patrz materiał o strukturze ramki Ethernet) jest przypisany <strong>na stałe do konkretnego interfejsu sieciowego</strong> przez producenta i nie niesie żadnej informacji o <strong>lokalizacji</strong> urządzenia w globalnej strukturze sieci — jest płaski, nie ma hierarchii. Gdyby internet próbował trasować ruch bezpośrednio na podstawie adresów MAC, każdy router szkieletowy musiałby przechowywać w swojej tablicy wpis dla każdego z miliardów urządzeń na świecie — co jest architektonicznie niewykonalne.</p>
<p><strong>Adres IP</strong> rozwiązuje ten problem, wprowadzając <strong>hierarchiczną, logiczną</strong> strukturę adresacji, przypominającą system pocztowy: podobnie jak adres pocztowy dzieli się na kraj, miasto, ulicę i numer domu, adres IP dzieli się na <strong>część sieciową</strong> (identyfikującą, do której sieci należy host — odpowiednik „miasta\") i <strong>część hosta</strong> (identyfikującą konkretne urządzenie w tej sieci — odpowiednik „numeru domu\"). Dzięki tej hierarchii router szkieletowy musi znać trasę jedynie do całych <strong>sieci</strong> (agregowanych bloków adresów), a nie do każdego pojedynczego hosta z osobna — co czyni routing skalowalnym.</p>
<p>Kluczowa różnica: adres MAC jest <strong>trwale związany ze sprzętem</strong> (interfejsem sieciowym) i nie zmienia się, gdy urządzenie zmienia lokalizację; adres IP jest <strong>związany z lokalizacją w topologii sieci</strong> i musi się zmienić, gdy urządzenie zostanie przeniesione do innej sieci (chyba że zastosowane zostaną specjalne mechanizmy, jak Mobile IP).</p>
<h3>2.2. Struktura adresu IPv4</h3>
<p>Adres IPv4 to liczba <strong>32-bitowa</strong>, zapisywana dla wygody człowieka w <strong>notacji dziesiętnej kropkowanej (dotted-decimal notation)</strong>: cztery liczby od 0 do 255 (każda reprezentująca jeden 8-bitowy oktet), oddzielone kropkami, np. <code>192.168.1.10</code>. W zapisie binarnym: <code>11000000.10101000.00000001.00001010</code>.</p>
<p>Adres dzieli się na <strong>prefiks sieciowy (network prefix)</strong> i <strong>identyfikator hosta (host identifier)</strong>. Granica między nimi nie jest zapisana w samym adresie — jest określana osobno, przez <strong>maskę podsieci</strong> lub <strong>notację prefiksową (CIDR)</strong>.</p>
<h3>2.3. Historyczny podział na klasy adresowe</h3>
<p>W pierwotnej specyfikacji IPv4 (RFC 791, 1981) granica między częścią sieciową a hostową była <strong>sztywno ustalona</strong> na podstawie kilku najstarszych bitów adresu — tzw. <strong>klasowy</strong> model adresacji:</p>
<table>
<thead>
<tr>
<th>Klasa</th>
<th>Pierwsze bity</th>
<th>Zakres pierwszego oktetu</th>
<th>Domyślna maska</th>
<th>Bity sieci / hosta</th>
<th>Liczba sieci</th>
<th>Hostów na sieć</th>
</tr>
</thead>
<tbody>
<tr>
<td>A</td>
<td><code>0</code></td>
<td>1–126</td>
<td>255.0.0.0 (/8)</td>
<td>8 / 24</td>
<td>126</td>
<td>16 777 214</td>
</tr>
<tr>
<td>B</td>
<td><code>10</code></td>
<td>128–191</td>
<td>255.255.0.0 (/16)</td>
<td>16 / 16</td>
<td>16 384</td>
<td>65 534</td>
</tr>
<tr>
<td>C</td>
<td><code>110</code></td>
<td>192–223</td>
<td>255.255.255.0 (/24)</td>
<td>24 / 8</td>
<td>2 097 152</td>
<td>254</td>
</tr>
<tr>
<td>D (multicast)</td>
<td><code>1110</code></td>
<td>224–239</td>
<td>— nie dotyczy</td>
<td>—</td>
<td>—</td>
<td>—</td>
</tr>
<tr>
<td>E (zarezerwowana)</td>
<td><code>1111</code></td>
<td>240–255</td>
<td>— eksperymentalna</td>
<td>—</td>
<td>—</td>
<td>—</td>
</tr>
</tbody>
</table>
<p><em>(Adres 127.x.x.x, formalnie należący do klasy A, jest zarezerwowany na potrzeby pętli zwrotnej — patrz rozdział 2.5).</em></p>
<p>Podział klasowy okazał się mało elastyczny i marnotrawił przestrzeń adresową: firma potrzebująca 300 adresów musiała otrzymać całą sieć klasy B (65 534 adresów), marnując resztę. Z tego powodu w 1993 roku (RFC 1519) wprowadzono <strong>CIDR</strong>, który klasowy podział praktycznie wyparł — dziś ma on już wyłącznie znaczenie historyczne i edukacyjne, choć terminologia („adres klasy C\") bywa wciąż potocznie używana.</p>
<h3>2.4. CIDR i maska podsieci</h3>
<p><strong>CIDR (Classless Inter-Domain Routing)</strong> pozwala na <strong>dowolne</strong> ustalenie granicy między częścią sieciową a hostową, niezależnie od „klasy\" adresu. Granica ta jest wyrażana na dwa równoważne sposoby:</p>
<ul>
<li><strong>maska podsieci (subnet mask)</strong> — 32-bitowa liczba, w której bity ustawione na <code>1</code> odpowiadają części sieciowej, a bity <code>0</code> — części hosta, np. <code>255.255.255.0</code> (binarnie: 24 jedynki, potem 8 zer);</li>
<li><strong>notacja prefiksowa (slash notation)</strong> — liczba jedynek w masce zapisana po ukośniku bezpośrednio za adresem, np. <code>192.168.1.0/24</code>.</li>
</ul>
<p>Liczba dostępnych adresów hostów w sieci o prefiksie <span class=\"mathjax mathjax--inline\">\\(/n\\)</span> wynosi <span class=\"mathjax mathjax--inline\">\\(2^{32-n}\\)</span>, przy czym <strong>dwa adresy są zawsze zarezerwowane</strong>: pierwszy (same zera w części hosta) to <strong>adres sieci</strong> (identyfikuje samą sieć jako całość, nie żaden konkretny host), a ostatni (same jedynki w części hosta) to <strong>adres rozgłoszeniowy kierowany (directed broadcast)</strong> tej podsieci. Liczba adresów <strong>użytecznych dla hostów</strong> wynosi zatem <span class=\"mathjax mathjax--inline\">\\(2^{32-n} - 2\\)</span>.</p>
<p><em>Przykład.</em> Sieć <code>192.168.1.0/26</code>: prefiks 26 bitów zostawia <span class=\"mathjax mathjax--inline\">\\(32-26=6\\)</span> bitów na hosta, czyli <span class=\"mathjax mathjax--inline\">\\(2^6 = 64\\)</span> adresy łącznie, z czego <span class=\"mathjax mathjax--inline\">\\(64-2=62\\)</span> adresy użyteczne dla hostów (od <code>192.168.1.1</code> do <code>192.168.1.62</code>), <code>192.168.1.0</code> to adres sieci, a <code>192.168.1.63</code> to adres rozgłoszeniowy tej podsieci.</p>
<h3>2.5. Adresy specjalne i zarezerwowane zakresy</h3>
<table>
<thead>
<tr>
<th>Zakres / adres</th>
<th>Nazwa</th>
<th>Przeznaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>0.0.0.0/8</code></td>
<td>adres nieokreślony</td>
<td>źródłowy adres hosta, który nie ma jeszcze przydzielonego adresu (np. w trakcie DHCP)</td>
</tr>
<tr>
<td><code>10.0.0.0/8</code></td>
<td>prywatny (RFC 1918)</td>
<td>sieci wewnętrzne, niemarszrutyzowane w publicznym internecie</td>
</tr>
<tr>
<td><code>172.16.0.0/12</code></td>
<td>prywatny (RFC 1918)</td>
<td>jw.</td>
</tr>
<tr>
<td><code>192.168.0.0/16</code></td>
<td>prywatny (RFC 1918)</td>
<td>jw., najpopularniejszy w sieciach domowych</td>
</tr>
<tr>
<td><code>127.0.0.0/8</code></td>
<td>pętla zwrotna (loopback)</td>
<td>komunikacja procesu z samym sobą (np. <code>127.0.0.1</code>)</td>
</tr>
<tr>
<td><code>169.254.0.0/16</code></td>
<td>link-local (APIPA)</td>
<td>automatycznie nadawany, gdy DHCP zawiedzie; ważny tylko w obrębie jednego segmentu</td>
</tr>
<tr>
<td><code>224.0.0.0/4</code></td>
<td>multicast</td>
<td>adresowanie grupowe (dawna klasa D)</td>
</tr>
<tr>
<td><code>255.255.255.255</code></td>
<td>ograniczony broadcast</td>
<td>rozgłoszenie ograniczone do lokalnego segmentu (nigdy nie routowane dalej)</td>
</tr>
<tr>
<td><code>100.64.0.0/10</code></td>
<td>CGN (Carrier-Grade NAT, RFC 6598)</td>
<td>przestrzeń operatorska dla NAT na dużą skalę, np. w sieciach mobilnych</td>
</tr>
</tbody>
</table>
<p>Adresy prywatne (RFC 1918) mogą być dowolnie wykorzystywane w sieciach wewnętrznych, ponieważ routery szkieletowe internetu <strong>nigdy</strong> nie przekazują pakietów z takimi adresami docelowymi dalej niż do najbliższego routera brzegowego z translacją NAT — to właśnie dzięki temu miliony sieci domowych mogą niezależnie od siebie używać identycznego zakresu <code>192.168.1.0/24</code> bez żadnego konfliktu.</p>
<h3>2.6. Podsieciowanie (subnetting) — przykład praktyczny</h3>
<p><strong>Podsieciowanie</strong> to praktyka dzielenia jednej, większej sieci na mniejsze podsieci poprzez „pożyczenie\" części bitów przeznaczonych pierwotnie na hosta i przekazanie ich do części sieciowej (wydłużenie maski/prefiksu).</p>
<p><em>Przykład.</em> Firma otrzymała sieć <code>192.168.10.0/24</code> (254 adresy użyteczne) i chce podzielić ją na 4 równe podsieci (np. dla czterech działów). Potrzeba <span class=\"mathjax mathjax--inline\">\\(\\log_2 4 = 2\\)</span> dodatkowych bitów sieciowych, czyli nowy prefiks to <span class=\"mathjax mathjax--inline\">\\(/26\\)</span> (<span class=\"mathjax mathjax--inline\">\\(24+2\\)</span>):</p>
<table>
<thead>
<tr>
<th>Podsieć</th>
<th>Adres sieci</th>
<th>Zakres hostów</th>
<th>Adres rozgłoszeniowy</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>192.168.10.0/26</td>
<td>.1 – .62</td>
<td>192.168.10.63</td>
</tr>
<tr>
<td>2</td>
<td>192.168.10.64/26</td>
<td>.65 – .126</td>
<td>192.168.10.127</td>
</tr>
<tr>
<td>3</td>
<td>192.168.10.128/26</td>
<td>.129 – .190</td>
<td>192.168.10.191</td>
</tr>
<tr>
<td>4</td>
<td>192.168.10.192/26</td>
<td>.193 – .254</td>
<td>192.168.10.255</td>
</tr>
</tbody>
</table>
<p>Każda z czterech podsieci mieści <span class=\"mathjax mathjax--inline\">\\(2^6-2=62\\)</span> adresy użyteczne dla hostów — łącznie 248 z pierwotnych 254, „stracone\" na dodatkowe adresy sieci i broadcastu w każdej podsieci. Jest to typowy kompromis podsieciowania: więcej, mniejszych podsieci oznacza mniej dostępnych adresów hostów, ale lepszą segmentację (patrz materiał o urządzeniach warstwy dostępu, rozdział o segmentacji sieci) i mniejsze domeny rozgłoszeniowe.</p>
<hr />
<h2>3. Format nagłówka IPv4 — analiza pole po polu</h2>
<p>Nagłówek IPv4, opisany w RFC 791, ma <strong>zmienną długość</strong> — od <strong>20 do 60 bajtów</strong> — w zależności od obecności opcjonalnych pól. Składa się z <strong>13 pól obowiązkowych</strong> (mieszczących się w pierwszych pięciu 32-bitowych słowach, czyli 20 bajtach) oraz opcjonalnego pola <strong>Opcje</strong> o zmiennej długości.</p>
<p><img alt=\"Budowa nagłówka IPv4 z podziałem bitowym wszystkich pól\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ipv4-naglowek-budowa.svg\" /></p>
<p>Poniżej każde pole omówione jest szczegółowo, w kolejności występowania w nagłówku.</p>
<h3>3.1. Wersja (Version) — 4 bity</h3>
<p>Najstarsze 4 bity pierwszego bajtu nagłówka określają <strong>wersję protokołu IP</strong>. Dla IPv4 pole to zawsze przyjmuje wartość binarną <code>0100</code>, czyli dziesiętnie <strong>4</strong>. To właśnie ta wartość pozwala stosowi sieciowemu odbiorcy natychmiast rozpoznać, że ma do czynienia z pakietem IPv4 (w odróżnieniu od IPv6, gdzie to samo pole przyjmuje wartość 6 — patrz rozdział 6.2) i zastosować odpowiedni algorytm parsowania pozostałej części nagłówka, którego struktura różni się diametralnie między obiema wersjami.</p>
<h3>3.2. Długość nagłówka — IHL (Internet Header Length) — 4 bity</h3>
<p>Pole <strong>IHL</strong> określa długość całego nagłówka IPv4, <strong>wyrażoną w jednostkach 32-bitowych słów (4-bajtowych)</strong>, nie w bajtach bezpośrednio. Ponieważ pole ma 4 bity, może przyjąć wartości od 0 do 15, ale w praktyce sensowny zakres to <strong>5 do 15</strong>:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Długość nagłówka w bajtach} = \\text{IHL} \\times 4\\)</span>\$</p>
<ul>
<li><strong>Minimalna wartość IHL = 5</strong>, co odpowiada <span class=\"mathjax mathjax--inline\">\\(5 \\times 4 = 20\\)</span> bajtom — jest to długość nagłówka <strong>bez żadnych opcji</strong>, obejmująca wyłącznie 13 pól obowiązkowych. Zdecydowana większość ruchu w dzisiejszym internecie korzysta właśnie z tej minimalnej wartości.</li>
<li><strong>Maksymalna wartość IHL = 15</strong>, co odpowiada <span class=\"mathjax mathjax--inline\">\\(15 \\times 4 = 60\\)</span> bajtom — nagłówek z maksymalną dopuszczalną liczbą opcji, zajmujących <span class=\"mathjax mathjax--inline\">\\(60 - 20 = 40\\)</span> dodatkowych bajtów.</li>
</ul>
<p>Dlaczego długość wyrażono w 4-bajtowych słowach, a nie wprost w bajtach? Ponieważ zakres 0–15 (4 bity) wystarcza dokładnie do zaadresowania pełnego zakresu dopuszczalnych długości nagłówka (do 60 B) tylko wtedy, gdy jednostką jest słowo 32-bitowe — bezpośredni zapis w bajtach wymagałby więcej bitów. Jest to również powód, dla którego pole <strong>Opcje</strong> musi być zawsze <strong>dopełnione (padding)</strong> do pełnej wielokrotności 4 bajtów — IHL nie potrafiłby wyrazić długości nagłówka niebędącej wielokrotnością słowa.</p>
<p>Stos sieciowy odbiorcy wykorzystuje wartość IHL do obliczenia, <strong>gdzie dokładnie w pakiecie zaczyna się pole danych</strong> (payload) — jest to pierwsza operacja parsowania po odczytaniu wersji protokołu.</p>
<h3>3.3. Typ usługi — ToS / DiffServ i ECN — 8 bitów</h3>
<p>Ósmy do piętnastego bit nagłówka (drugi bajt) pierwotnie nazywany był <strong>ToS (Type of Service)</strong> i miał, zgodnie z pierwotną specyfikacją RFC 791, umożliwiać nadawcy zasygnalizowanie preferencji dotyczących sposobu obsługi pakietu (np. priorytet, preferencja niskiego opóźnienia kontra wysokiej przepustowości). W praktyce pierwotny format ToS był rzadko wykorzystywany i z czasem został <strong>przedefiniowany</strong>.</p>
<h4>Format historyczny (RFC 791, dziś nieużywany)</h4>
<p>Pierwotnie 8 bitów dzieliło się na: 3-bitowe pole <strong>Precedence</strong> (priorytet, 0–7), oraz pojedyncze bity flag: <strong>D</strong> (Delay — preferencja niskiego opóźnienia), <strong>T</strong> (Throughput — preferencja wysokiej przepustowości), <strong>R</strong> (Reliability — preferencja niezawodności) i 2 bity zarezerwowane.</p>
<h4>Format współczesny — DiffServ i ECN (RFC 2474, RFC 3168)</h4>
<p>Od 1998 roku (RFC 2474) te same 8 bitów zostały <strong>przedefiniowane</strong> na potrzeby architektury <strong>DiffServ (Differentiated Services)</strong>:</p>
<ul>
<li><strong>6 najstarszych bitów</strong> → pole <strong>DSCP (Differentiated Services Code Point)</strong> — pozwala zakwalifikować pakiet do jednej z 64 możliwych klas obsługi (ang. <em>Per-Hop Behavior</em>, PHB), na podstawie której routery na trasie mogą różnicować kolejkowanie, priorytetyzację i prawdopodobieństwo odrzucenia pakietu w razie przeciążenia. Popularne, standaryzowane wartości DSCP obejmują m.in.:</li>
</ul>
<table>
<thead>
<tr>
<th>Nazwa PHB</th>
<th>Wartość DSCP (dziesiętnie)</th>
<th>Typowe zastosowanie</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>CS0 (Default)</strong></td>
<td>0</td>
<td>ruch bez gwarancji (best effort)</td>
</tr>
<tr>
<td><strong>AF (Assured Forwarding)</strong>, np. AF41</td>
<td>34</td>
<td>ruch wymagający gwarancji, np. wideokonferencje</td>
</tr>
<tr>
<td><strong>EF (Expedited Forwarding)</strong></td>
<td>46</td>
<td>ruch o najniższym dopuszczalnym opóźnieniu i jitterze, np. VoIP</td>
</tr>
<tr>
<td><strong>CS6 / CS7</strong></td>
<td>48 / 56</td>
<td>ruch sygnalizacyjny sieci (routing, zarządzanie)</td>
</tr>
</tbody>
</table>
<ul>
<li><strong>2 najmłodsze bity</strong> → pole <strong>ECN (Explicit Congestion Notification, RFC 3168)</strong> — mechanizm pozwalający routerowi <strong>zasygnalizować początek przeciążenia</strong> poprzez ustawienie odpowiednich bitów w przechodzącym pakiecie, <strong>zamiast</strong> jego odrzucenia. Odbiorca odczytuje te bity i informuje nadawcę (poprzez mechanizmy warstwy transportowej, np. nagłówek TCP), który może <strong>proaktywnie zmniejszyć tempo nadawania</strong>, zanim dojdzie do rzeczywistej utraty pakietów. Wartości pola ECN: <code>00</code> — end-point nie obsługuje ECN, <code>10</code> lub <code>01</code> — end-point obsługuje ECN, ale przeciążenia jeszcze nie wykryto, <code>11</code> — router na trasie wykrył przeciążenie i oznaczył pakiet (Congestion Experienced).</li>
</ul>
<p>Ważne rozróżnienie: <strong>DiffServ jest mechanizmem klasyfikacji dla każdego pakietu z osobna</strong> (routery na podstawie DSCP decydują lokalnie, jak obsłużyć dany pakiet — nie ma żadnej rezerwacji zasobów ani gwarancji end-to-end), w odróżnieniu od starszej, znacznie bardziej złożonej architektury <strong>IntServ (Integrated Services)</strong>, która próbowała rezerwować zasoby na całej trasie (protokół RSVP) — podejście to nie zyskało powszechnego zastosowania ze względu na problemy ze skalowalnością w rdzeniu internetu.</p>
<h3>3.4. Całkowita długość — Total Length — 16 bitów</h3>
<p>Pole <strong>Total Length</strong> określa <strong>całkowitą długość całego datagramu IP</strong> (nagłówek <strong>łącznie</strong> z polem danych), wyrażoną <strong>wprost w bajtach</strong> (w odróżnieniu od IHL, które wyrażone jest w słowach). Ponieważ pole ma 16 bitów, maksymalna teoretyczna długość datagramu IPv4 wynosi:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$2^{16} - 1 = 65\\,535 \\text{ bajtów}\\)</span>\$</p>
<p>Długość pola danych (payload) oblicza się jako:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Długość danych} = \\text{Total Length} - (\\text{IHL} \\times 4)\\)</span>\$</p>
<p><em>Przykład.</em> Datagram o Total Length = 1500 B i IHL = 5 (nagłówek 20 B) niesie <span class=\"mathjax mathjax--inline\">\\(1500 - 20 = 1480\\)</span> bajtów danych.</p>
<p>Każde urządzenie warstwy łącza danych ma swoje własne ograniczenie maksymalnej wielkości ramki — <strong>MTU (Maximum Transmission Unit)</strong>, patrz materiał o strukturze ramki Ethernet, gdzie standardowe MTU wynosi 1500 B. Ponieważ 65 535 B znacznie przekracza typowe MTU sieci Ethernet, w praktyce warstwa IP <strong>musi fragmentować</strong> większe datagramy, aby zmieściły się w ramkach warstwy 2 — mechanizm ten jest przedmiotem osobnego, szczegółowego rozdziału 4.</p>
<p>Warto dodać, że mechanizm <strong>Jumbogramów</strong> (RFC 2675) w IPv6 pozwala, w ściśle określonych warunkach sieci wspierających Jumbo Frames, na przesyłanie danych powyżej granicy 65 535 B — nie dotyczy to jednak standardowego IPv4.</p>
<h3>3.5. Identyfikacja — Identification — 16 bitów</h3>
<p>Pole <strong>Identification</strong> zawiera liczbę, którą nadawca przypisuje <strong>każdemu wysyłanemu datagramowi</strong>, typowo inkrementowaną (zwiększaną) dla kolejnych datagramów, choć RFC nie narzuca dokładnego algorytmu jej generowania (współczesne systemy operacyjne z powodów bezpieczeństwa często stosują częściowo losowe wartości, aby utrudnić pewne klasy ataków opierających się na przewidywalności tego pola).</p>
<p>Podstawowa, krytycznie ważna funkcja tego pola ujawnia się w kontekście <strong>fragmentacji</strong>: gdy duży datagram zostaje podzielony na mniejsze fragmenty (bo nie mieści się w MTU kolejnego łącza), <strong>wszystkie fragmenty pochodzące z tego samego, oryginalnego datagramu otrzymują identyczną wartość Identification</strong>. To właśnie ta wspólna wartość pozwala odbiorcy końcowemu — nawet jeśli fragmenty dotrą w różnej kolejności lub wymieszane z fragmentami zupełnie innych datagramów tego samego nadawcy — poprawnie <strong>zgrupować</strong> fragmenty należące do tego samego oryginalnego datagramu przed próbą ich ponownego złożenia (reasembly). Mechanizm ten jest szczegółowo zilustrowany w rozdziale 4.</p>
<h3>3.6. Flagi — Flags — 3 bity</h3>
<p>Trzy bity flag kontrolnych związanych bezpośrednio z mechanizmem fragmentacji:</p>
<table>
<thead>
<tr>
<th>Bit</th>
<th>Nazwa</th>
<th>Znaczenie</th>
</tr>
</thead>
<tbody>
<tr>
<td>bit 0</td>
<td><strong>Reserved (zarezerwowany)</strong></td>
<td>musi zawsze wynosić 0; w niektórych eksperymentalnych zastosowaniach (RFC 3514, żartobliwie nazwany „Evil bit\") proponowano wykorzystać go do oznaczania pakietów o złośliwych intencjach — propozycja ta miała charakter satyryczny i nigdy nie została wdrożona</td>
</tr>
<tr>
<td>bit 1</td>
<td><strong>DF (Don\x27t Fragment)</strong></td>
<td>gdy ustawiony na <code>1</code>, <strong>zabrania</strong> routerom na trasie fragmentacji tego datagramu; jeśli datagram z ustawionym DF napotka łącze o MTU mniejszym niż jego rozmiar, zostaje <strong>odrzucony</strong>, a nadawcy zwracany jest komunikat ICMP „Fragmentation Needed\" (mechanizm wykorzystywany przez Path MTU Discovery, patrz rozdział 4.5)</td>
</tr>
<tr>
<td>bit 2</td>
<td><strong>MF (More Fragments)</strong></td>
<td>gdy ustawiony na <code>1</code>, oznacza, że <strong>po tym fragmencie nastąpią kolejne</strong> fragmenty tego samego oryginalnego datagramu; wartość <code>0</code> oznacza, że jest to <strong>ostatni</strong> fragment (lub że datagram w ogóle nie został pofragmentowany)</td>
</tr>
</tbody>
</table>
<h3>3.7. Przesunięcie fragmentu — Fragment Offset — 13 bitów</h3>
<p>Pole <strong>Fragment Offset</strong> określa <strong>pozycję danego fragmentu w oryginalnym, niepofragmentowanym datagramie</strong>, wyrażoną — analogicznie do pola IHL — <strong>w jednostkach 8-bajtowych (64-bitowych)</strong>, a nie wprost w bajtach:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Pozycja bajtu w oryginalnych danych} = \\text{Fragment Offset} \\times 8\\)</span>\$</p>
<p>Wybór jednostki 8 bajtów (zamiast np. 1 bajta) wynika z tego samego kompromisu co przy IHL: pole 13-bitowe pozwala zaadresować przesunięcie do <span class=\"mathjax mathjax--inline\">\\(2^{13}-1 = 8191\\)</span> jednostek, co przy jednostce 8-bajtowej daje maksymalne przesunięcie <span class=\"mathjax mathjax--inline\">\\(8191 \\times 8 = 65\\,528\\)</span> bajtów — praktycznie pokrywające cały dopuszczalny zakres pola Total Length (65 535 B). Gdyby jednostką był 1 bajt, 13 bitów pozwoliłoby zaadresować jedynie do 8191 B — zbyt mało. Ta sama zależność wymusza regułę: <strong>rozmiar danych każdego fragmentu (poza ostatnim) musi być wielokrotnością 8 bajtów</strong>, ponieważ przesunięcie kolejnego fragmentu musi dać się wyrazić w pełnych jednostkach 8-bajtowych.</p>
<p>Fragment Offset dla <strong>pierwszego</strong> fragmentu (lub dla datagramu niepofragmentowanego) zawsze wynosi <strong>0</strong>. Szczegółowy, w pełni obliczony przykład fragmentacji z wykorzystaniem pól Identification, MF i Fragment Offset znajduje się w rozdziale 4.</p>
<hr />
<h3>3.8. Czas życia — TTL (Time To Live) — 8 bitów</h3>
<p>Pole <strong>TTL</strong> jest omówione szczegółowo w rozdziale 5 — tu krótkie wprowadzenie definicyjne. TTL to 8-bitowy licznik, ustawiany przez nadawcę na pewną wartość początkową (typowo 64, 128 lub 255, zależnie od systemu operacyjnego) i <strong>dekrementowany o co najmniej 1 przez każdy router</strong>, przez który przechodzi datagram. Gdy TTL osiągnie wartość 0, router <strong>odrzuca</strong> datagram i (typowo) odsyła do nadawcy komunikat ICMP Time Exceeded. Mechanizm ten zapobiega nieskończonemu krążeniu pakietów w przypadku błędnej konfiguracji routingu tworzącej pętlę.</p>
<h3>3.9. Protokół — Protocol — 8 bitów</h3>
<p>Pole <strong>Protokół</strong> identyfikuje, <strong>do którego protokołu warstwy wyższej</strong> (typowo warstwy transportowej) należy przekazać zawartość pola danych datagramu po jego dotarciu do hosta docelowego. Pełni dokładnie analogiczną funkcję do pola EtherType w nagłówku Ethernet (patrz materiał o strukturze ramki Ethernet, rozdział 5), tyle że o jeden poziom enkapsulacji wyżej. Wartości tego pola są scentralizowanie zarządzane przez IANA w rejestrze <strong>Protocol Numbers</strong>. Najczęściej spotykane wartości:</p>
<table>
<thead>
<tr>
<th>Wartość (dziesiętnie)</th>
<th>Wartość (hex)</th>
<th>Protokół</th>
<th>Opis</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td><code>0x01</code></td>
<td><strong>ICMP</strong></td>
<td>Internet Control Message Protocol — komunikaty diagnostyczne i błędów</td>
</tr>
<tr>
<td>2</td>
<td><code>0x02</code></td>
<td><strong>IGMP</strong></td>
<td>Internet Group Management Protocol — zarządzanie grupami multicast</td>
</tr>
<tr>
<td>6</td>
<td><code>0x06</code></td>
<td><strong>TCP</strong></td>
<td>Transmission Control Protocol — połączeniowy, niezawodny transport</td>
</tr>
<tr>
<td>17</td>
<td><code>0x11</code></td>
<td><strong>UDP</strong></td>
<td>User Datagram Protocol — bezpołączeniowy, „najlepszego wysiłku\" transport</td>
</tr>
<tr>
<td>41</td>
<td><code>0x29</code></td>
<td><strong>IPv6</strong> (enkapsulowany)</td>
<td>tunelowanie IPv6 wewnątrz IPv4 (6in4)</td>
</tr>
<tr>
<td>47</td>
<td><code>0x2F</code></td>
<td><strong>GRE</strong></td>
<td>Generic Routing Encapsulation — tunelowanie ogólnego przeznaczenia</td>
</tr>
<tr>
<td>50</td>
<td><code>0x32</code></td>
<td><strong>ESP</strong></td>
<td>Encapsulating Security Payload — część IPsec (szyfrowanie)</td>
</tr>
<tr>
<td>51</td>
<td><code>0x33</code></td>
<td><strong>AH</strong></td>
<td>Authentication Header — część IPsec (uwierzytelnianie integralności)</td>
</tr>
<tr>
<td>89</td>
<td><code>0x59</code></td>
<td><strong>OSPF</strong></td>
<td>Open Shortest Path First — protokół routingu dynamicznego</td>
</tr>
<tr>
<td>132</td>
<td><code>0x84</code></td>
<td><strong>SCTP</strong></td>
<td>Stream Control Transmission Protocol</td>
</tr>
</tbody>
</table>
<p>Dzięki temu polu stos sieciowy odbiorcy, po zweryfikowaniu, że dany datagram IP jest adresowany do niego (na podstawie adresu docelowego), wie natychmiast, czy przekazać dane do modułu TCP, UDP, ICMP czy innego — bez konieczności „zgadywania\" formatu danych zawartych w polu payload.</p>
<h3>3.10. Suma kontrolna nagłówka — Header Checksum — 16 bitów</h3>
<p>Pole <strong>Header Checksum</strong> zawiera 16-bitową sumę kontrolną, obliczaną metodą <strong>dopełnienia do jedynki (one\x27s complement)</strong>, obejmującą <strong>wyłącznie nagłówek IP</strong> (nie obejmuje pola danych — za integralność danych odpowiadają mechanizmy warstw wyższych, np. suma kontrolna TCP/UDP lub FCS warstwy 2).</p>
<h4>Algorytm obliczania</h4>
<ol>
<li>Pole Header Checksum jest <strong>tymczasowo zerowane</strong>.</li>
<li>Cały nagłówek traktowany jest jako ciąg <strong>16-bitowych słów</strong>.</li>
<li>Wszystkie słowa są sumowane metodą arytmetyki dopełnienia do jedynki (jeśli podczas dodawania wystąpi przeniesienie poza 16 bitów, jest ono „zawijane\" i dodawane z powrotem do wyniku — tzw. <em>end-around carry</em>).</li>
<li>Wynik sumowania jest <strong>negowany bitowo</strong> (dopełnienie do jedynki całej sumy) i wpisywany do pola Header Checksum.</li>
</ol>
<p>Odbiorca powtarza tę samą operację na <strong>całym</strong> odebranym nagłówku (tym razem <strong>łącznie</strong> z odebraną wartością pola Header Checksum, bez jej zerowania) — jeśli nagłówek nie został uszkodzony, wynik sumowania powinien dać w rezultacie same jedynki binarne (<code>0xFFFF</code>). Dowolna inna wartość oznacza wykryty błąd, a pakiet jest po cichu odrzucany.</p>
<p><em>Uproszczony przykład liczbowy.</em> Rozważmy nagłówek złożony (dla uproszczenia) z zaledwie czterech słów 16-bitowych, z polem checksum wyzerowanym:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Słowo 1} = \\texttt{4500}_{16}, \\quad \\text{Słowo 2} = \\texttt{003C}_{16}, \\quad \\text{Słowo 3} = \\texttt{1C46}_{16}, \\quad \\text{Słowo 4} = \\texttt{4000}_{16}\\)</span>\$</p>
<p>Suma: <span class=\"mathjax mathjax--inline\">\\(\\texttt{4500} + \\texttt{003C} + \\texttt{1C46} + \\texttt{4000} = \\texttt{5F82}_{16}\\)</span> (bez przeniesienia poza 16 bitów w tym przykładzie). Dopełnienie do jedynki (negacja bitowa) tej sumy: <span class=\"mathjax mathjax--inline\">\\(\\overline{\\texttt{5F82}} = \\texttt{A07D}_{16}\\)</span> — to właśnie ta wartość zostałaby wpisana do pola Header Checksum. Weryfikacja: odbiorca zsumowałby cztery oryginalne słowa <strong>oraz</strong> wartość checksum <span class=\"mathjax mathjax--inline\">\\(\\texttt{A07D}\\)</span>: <span class=\"mathjax mathjax--inline\">\\(\\texttt{5F82} + \\texttt{A07D} = \\texttt{FFFF}_{16}\\)</span> — same jedynki, co potwierdza brak wykrytych błędów.</p>
<h4>Dlaczego checksum musi być przeliczana na każdym routerze</h4>
<p>Ponieważ pole <strong>TTL</strong> jest dekrementowane na każdym routerze na trasie (rozdział 5), a TTL jest częścią nagłówka objętą sumą kontrolną, <strong>każdy router musi przeliczyć Header Checksum od nowa</strong> po zmodyfikowaniu TTL — w przeciwnym razie suma kontrolna przestałaby się zgadzać u kolejnego odbiorcy. Z powodów wydajnościowych routery zwykle nie liczą całej sumy od zera, lecz stosują <strong>przyrostową aktualizację</strong> (RFC 1624) — matematyczną sztuczkę pozwalającą obliczyć nową sumę kontrolną na podstawie starej wartości i wyłącznie zmienionego pola (TTL), bez konieczności ponownego sumowania całego nagłówka.</p>
<p><strong>IPv6, dla porównania, całkowicie rezygnuje z sumy kontrolnej nagłówka</strong> (rozdział 6) — decyzja ta, choć może się wydawać zaskakująca, jest świadomym wyborem projektowym uzasadnionym w rozdziale 6.3.</p>
<h3>3.11. Adres źródłowy i adres docelowy — po 32 bity</h3>
<p>Dwa pola po 32 bity każde, zawierające adresy IPv4 nadawcy i odbiorcy datagramu, opisane szczegółowo w rozdziale 2. To one — wraz z polem Protokół i portami warstwy transportowej — jednoznacznie identyfikują konkretną „rozmowę\" sieciową (tzw. <strong>5-tuple</strong>: adres źródłowy, port źródłowy, adres docelowy, port docelowy, protokół), wykorzystywaną m.in. przez tablice stanu zapór sieciowych (firewalli) i urządzeń NAT.</p>
<h3>3.12. Opcje i dopełnienie — Options and Padding</h3>
<p>Pole <strong>Opcje</strong> jest <strong>opcjonalne</strong> (stąd nazwa) i o <strong>zmiennej długości</strong>, wykorzystywane rzadko we współczesnym ruchu internetowym — w praktyce wiele urządzeń brzegowych i zapór sieciowych domyślnie odrzuca pakiety z niestandardowymi opcjami ze względów bezpieczeństwa (potencjalny wektor ataku lub obejścia filtracji). Przykładowe historyczne opcje obejmują:</p>
<ul>
<li><strong>Record Route</strong> — każdy router na trasie dopisuje swój adres IP, pozwalając nadawcy prześledzić dokładną trasę pakietu (ograniczone praktyczne zastosowanie ze względu na niewielki dostępny rozmiar pola);</li>
<li><strong>Timestamp</strong> — podobnie, routery dopisują znaczniki czasu przejścia;</li>
<li><strong>Strict/Loose Source Routing</strong> — nadawca narzuca (ściśle lub „luźno\") konkretną trasę pakietu przez wskazane routery, z pominięciem standardowego routingu; mechanizm ten jest dziś powszechnie blokowany ze względów bezpieczeństwa (mógłby posłużyć do obejścia list kontroli dostępu).</li>
</ul>
<p>Ponieważ pole IHL wyraża długość nagłówka w pełnych 4-bajtowych słowach (rozdział 3.2), a Opcje mogą mieć dowolną długość w bajtach, po polu Opcje dodaje się <strong>Padding</strong> — bajty o wartości zero — tak, aby cały nagłówek (13 pól obowiązkowych plus Opcje plus Padding) zawsze kończył się dokładnie na granicy 32-bitowego słowa.</p>
<hr />
<h2>4. Fragmentacja IPv4 — dogłębna analiza</h2>
<h3>4.1. Przyczyna fragmentacji</h3>
<p>Fragmentacja jest konieczna, gdy datagram IP, przekazywany przez router na kolejne łącze, jest <strong>większy niż MTU tego łącza</strong>. Klasyczny scenariusz: dane pochodzą z sieci o dużym MTU (np. niektóre sieci wewnętrzne czy tunele obsługujące Jumbo Frames) i trafiają na standardowy segment Ethernet o MTU 1500 B. Router na granicy tych sieci musi wtedy <strong>podzielić</strong> zbyt duży datagram na mniejsze <strong>fragmenty</strong>, z których każdy zmieści się w MTU łącza wyjściowego.</p>
<h3>4.2. Zasady konstruowania fragmentów</h3>
<p>Każdy fragment jest <strong>samodzielnym, w pełni poprawnym datagramem IP</strong> — otrzymuje własny, kompletny nagłówek (skopiowany w większości pól z oryginału, ale ze zmodyfikowanymi polami Total Length, Flags, Fragment Offset oraz przeliczoną Header Checksum). Reguły konstruowania:</p>
<ol>
<li><strong>Pole Identification</strong> jest identyczne we wszystkich fragmentach pochodzących z tego samego oryginalnego datagramu — to klucz grupujący przy ponownym składaniu.</li>
<li><strong>Pole Fragment Offset</strong> określa pozycję danych tego fragmentu w oryginalnym datagramie, w jednostkach 8-bajtowych (rozdział 3.7).</li>
<li><strong>Pole MF (More Fragments)</strong> ustawione na <code>1</code> we wszystkich fragmentach <strong>poza ostatnim</strong>, gdzie wynosi <code>0</code>.</li>
<li><strong>Pole DF (Don\x27t Fragment)</strong>, jeśli było ustawione w oryginalnym datagramie, uniemożliwia fragmentację w ogóle — router w takiej sytuacji odrzuca datagram (rozdział 4.5).</li>
<li>Rozmiar danych każdego fragmentu (poza ostatnim) musi być <strong>wielokrotnością 8 bajtów</strong>, ze względu na jednostkę pola Fragment Offset.</li>
</ol>
<h3>4.3. Przykład obliczeniowy krok po kroku</h3>
<p>Rozważmy datagram o <strong>4000 bajtach danych</strong> (plus standardowy 20-bajtowy nagłówek, czyli Total Length = 4020 B), z Identification = 51 200, który musi zostać przesłany przez łącze o <strong>MTU = 1500 B</strong>.</p>
<p><strong>Krok 1 — obliczenie maksymalnej ilości danych na fragment.</strong> Dostępne miejsce na dane w jednym fragmencie: <span class=\"mathjax mathjax--inline\">\\(1500 - 20 \\text{ (nagłówek)} = 1480\\)</span> bajtów. Wartość ta musi być zaokrąglona <strong>w dół</strong> do najbliższej wielokrotności 8: <span class=\"mathjax mathjax--inline\">\\(1480 / 8 = 185\\)</span> — już jest wielokrotnością 8, więc zaokrąglenie nie zmienia wyniku. Maksymalna ilość danych na fragment: <strong>1480 B</strong>.</p>
<p><strong>Krok 2 — obliczenie liczby potrzebnych fragmentów.</strong> <span class=\"mathjax mathjax--inline\">\\(\\lceil 4000 / 1480 \\rceil = \\lceil 2{,}70 \\rceil = 3\\)</span> fragmenty.</p>
<p><strong>Krok 3 — konstrukcja poszczególnych fragmentów:</strong></p>
<p><img alt=\"Fragmentacja datagramu IPv4 o rozmiarze 4020 B (4000 B danych) na trzy fragmenty przy MTU 1500 B\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ipv4-fragmentacja.svg\" /></p>
<table>
<thead>
<tr>
<th>Fragment</th>
<th>Dane oryginału (bajty)</th>
<th>Rozmiar danych</th>
<th>Fragment Offset (jedn. 8 B)</th>
<th>MF</th>
<th>Total Length fragmentu</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>0–1479</td>
<td>1480 B</td>
<td><span class=\"mathjax mathjax--inline\">\\(0 / 8 = 0\\)</span></td>
<td>1</td>
<td><span class=\"mathjax mathjax--inline\">\\(20+1480=1500\\)</span> B</td>
</tr>
<tr>
<td>2</td>
<td>1480–2959</td>
<td>1480 B</td>
<td><span class=\"mathjax mathjax--inline\">\\(1480 / 8 = 185\\)</span></td>
<td>1</td>
<td><span class=\"mathjax mathjax--inline\">\\(20+1480=1500\\)</span> B</td>
</tr>
<tr>
<td>3</td>
<td>2960–3999</td>
<td>1040 B</td>
<td><span class=\"mathjax mathjax--inline\">\\(2960 / 8 = 370\\)</span></td>
<td>0</td>
<td><span class=\"mathjax mathjax--inline\">\\(20+1040=1060\\)</span> B</td>
</tr>
</tbody>
</table>
<p>Wszystkie trzy fragmenty niosą identyczną wartość <strong>Identification = 51 200</strong>. Suma rozmiarów danych wszystkich fragmentów: <span class=\"mathjax mathjax--inline\">\\(1480+1480+1040 = 4000\\)</span> B — dokładnie zgadza się z rozmiarem oryginalnych danych, co jest naturalnym warunkiem poprawności fragmentacji.</p>
<h3>4.4. Ponowne składanie fragmentów (Reassembly)</h3>
<p>Kluczowa, często pomijana w uproszczonych opisach zasada: <strong>fragmenty są ponownie składane w oryginalny datagram wyłącznie przez hosta docelowego (odbiorcę końcowego)</strong> — <strong>nie</strong> przez routery pośredniczące na trasie. Router, który sam dokonał fragmentacji lub przez który przechodzą fragmenty utworzone wcześniej, po prostu przekazuje każdy fragment dalej jako niezależny datagram, w oparciu wyłącznie o jego adres docelowy — nie interesuje go, że jest to fragment czegokolwiek.</p>
<p>Host docelowy, odbierając fragmenty (identyfikowane przez trójkę: adres źródłowy + adres docelowy + Identification, a niekiedy dodatkowo pole Protokół), umieszcza je w buforze rekonstrukcyjnym, wykorzystując pole <strong>Fragment Offset</strong> do ustalenia właściwej pozycji danych każdego fragmentu, i uznaje odtwarzanie za zakończone, gdy otrzyma fragment z <strong>MF = 0</strong> (ostatni) <strong>oraz</strong> gdy nie ma żadnych „dziur\" (brakujących zakresów bajtów) między fragmentem o offset 0 a fragmentem końcowym. Jeśli w rozsądnym czasie (typowo ok. 30–60 sekund, zależnie od implementacji systemu operacyjnego) nie uda się skompletować wszystkich fragmentów — np. jeden z nich zaginął po drodze — <strong>cały</strong> datagram jest odrzucany (nie ma mechanizmu retransmisji pojedynczego brakującego fragmentu na poziomie IP), a bywa wysyłany komunikat ICMP „Time Exceeded — Fragment Reassembly Time Exceeded\".</p>
<h3>4.5. Path MTU Discovery — unikanie fragmentacji w praktyce</h3>
<p>Fragmentacja, choć funkcjonalnie poprawna, ma istotne wady wydajnościowe i bywa problematyczna z punktu widzenia bezpieczeństwa (fragmenty bywały historycznie wykorzystywane do obchodzenia zapór sieciowych i systemów IDS/IPS, analizujących zwykle tylko pierwszy fragment z pełnym nagłówkiem warstwy transportowej). Z tych powodów współczesne stosy sieciowe <strong>wolą unikać fragmentacji w ogóle</strong>, stosując mechanizm <strong>Path MTU Discovery (PMTUD, RFC 1191)</strong>:</p>
<ol>
<li>Nadawca ustawia bit <strong>DF (Don\x27t Fragment)</strong> we wszystkich wysyłanych datagramach.</li>
<li>Jeśli na trasie datagram napotka router z łączem wyjściowym o mniejszym MTU niż rozmiar datagramu, router — zamiast fragmentować (co i tak byłoby zabronione przez DF) — <strong>odrzuca</strong> datagram i odsyła nadawcy komunikat <strong>ICMP Destination Unreachable, kod 4 (Fragmentation Needed and DF Set)</strong>, zawierający informację o MTU łącza, które spowodowało problem.</li>
<li>Nadawca, otrzymawszy ten komunikat, <strong>zmniejsza</strong> rozmiar kolejnych wysyłanych datagramów do tej wartości i próbuje ponownie — proces powtarza się, jeśli na dalszej trasie napotkane zostanie łącze o jeszcze mniejszym MTU, aż do znalezienia najmniejszej wartości MTU na całej trasie (tzw. <strong>Path MTU</strong>).</li>
</ol>
<p>Mechanizm ten pozwala nadawcy z góry dostosować rozmiar wysyłanych danych do faktycznych możliwości całej trasy, <strong>eliminując potrzebę fragmentacji przez routery pośredniczące</strong> — fragmentacja, jeśli w ogóle występuje, odbywa się już tylko <strong>na hoście źródłowym</strong>, zanim dane w ogóle opuszczą nadawcę (a dokładniej: w praktyce warstwa transportowa, znając Path MTU, po prostu nie generuje segmentów większych niż to uzasadnione, więc fragmentacja IP staje się zbędna niemal całkowicie). Warto zaznaczyć słabość tego mechanizmu: jeśli komunikaty ICMP są blokowane przez pośredniczącą zaporę sieciową (błąd konfiguracji określany jako <strong>PMTUD black hole</strong>), nadawca nigdy nie dowiaduje się o problemie, a jego pakiety są po cichu odrzucane — dlatego dobra praktyka administracyjna zaleca zawsze przepuszczać komunikaty ICMP typu Destination Unreachable.</p>
<hr />
<h2>5. Pole TTL i zapobieganie pętlom routingu</h2>
<h3>5.1. Problem: co by się stało bez TTL?</h3>
<p>W dużej, rozproszonej sieci, zarządzanej przez wielu niezależnych administratorów i wykorzystującej dynamiczne protokoły routingu, <strong>błędy konfiguracji prowadzące do pętli routingu</strong> (sytuacji, w której router A kieruje ruch do routera B, a router B — z powrotem do routera A) są, choć rzadkie, praktycznie nieuniknione w skali całego internetu. Bez żadnego mechanizmu ograniczającego, pakiet uwięziony w takiej pętli krążyłby <strong>w nieskończoność</strong>, bezużytecznie zajmując pasmo i zasoby przetwarzania kolejnych routerów, aż do całkowitego zapchania dotkniętego fragmentu sieci — zjawisko analogiczne do burzy rozgłoszeniowej w warstwie 2 (patrz materiał o urządzeniach warstwy dostępu), lecz występujące w warstwie 3.</p>
<h3>5.2. Zasada działania TTL</h3>
<p>Pole <strong>TTL (Time To Live)</strong>, mimo swojej nazwy sugerującej jednostkę czasu, jest w praktyce <strong>licznikiem przeskoków (hop count)</strong>, a nie licznikiem czasu w sekundach (taka była pierwotna, nigdy w pełni niewdrożona koncepcja z RFC 791, gdzie TTL miał być dekrementowany również w trakcie oczekiwania w kolejce routera, nie tylko przy każdym przeskoku). Zasada działania:</p>
<ol>
<li>Nadawca ustawia TTL na pewną <strong>wartość początkową</strong>, typową dla systemu operacyjnego: <strong>64</strong> (Linux, macOS, większość dystrybucji Unix), <strong>128</strong> (Windows) lub <strong>255</strong> (niektóre starsze systemy i urządzenia sieciowe, np. Cisco IOS).</li>
<li><strong>Każdy router</strong>, przez który przechodzi datagram, <strong>dekrementuje TTL o co najmniej 1</strong> przed dalszym przekazaniem (RFC dopuszcza dekrementację o więcej niż 1, jeśli pakiet oczekiwał w kolejce dłużej niż 1 sekundę, ale w praktyce niemal wszystkie implementacje stosują dokładnie dekrementację o 1 na przeskok).</li>
<li>Jeśli po dekrementacji TTL osiągnie wartość <strong>0</strong>, router <strong>odrzuca</strong> datagram (nie przekazuje go dalej) i — o ile nie jest to celowo wyłączone ze względów bezpieczeństwa lub wydajności — odsyła do adresu źródłowego komunikat <strong>ICMP Time Exceeded (Typ 11, Kod 0)</strong>.</li>
</ol>
<p><img alt=\"Dekrementacja TTL na każdym przeskoku routingu i odrzucenie pakietu po osiągnięciu wartości zero\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ttl-forwarding.svg\" /></p>
<h3>5.3. TTL jako narzędzie diagnostyczne — mechanizm traceroute</h3>
<p>Zjawisko odrzucania pakietu i generowania komunikatu ICMP Time Exceeded po wygaśnięciu TTL jest sprytnie wykorzystywane przez narzędzie diagnostyczne <strong>traceroute</strong> (w Windows: <code>tracert</code>) do <strong>odkrywania trasy</strong> pakietów do danego celu, router po routerze:</p>
<ol>
<li>Narzędzie wysyła pierwszy pakiet (zwykle UDP na nietypowy port, ICMP Echo Request lub TCP SYN, zależnie od implementacji i systemu) z <strong>TTL = 1</strong>.</li>
<li>Pierwszy router na trasie dekrementuje TTL do 0, odrzuca pakiet i odsyła ICMP Time Exceeded — traceroute odczytuje adres źródłowy tego komunikatu, poznając w ten sposób adres <strong>pierwszego przeskoku (hop)</strong>.</li>
<li>Narzędzie wysyła kolejny pakiet z <strong>TTL = 2</strong> — tym razem pierwszy router przepuszcza go dalej (dekrementując do 1), a to <strong>drugi</strong> router w kolejności odrzuca pakiet przy TTL = 0, ujawniając swój adres.</li>
<li>Proces powtarza się z rosnącym TTL (3, 4, 5, …), aż pakiet w końcu dotrze do właściwego celu, który — nie mając już czego przekazywać dalej — odpowiada bezpośrednio (typowo komunikatem ICMP Destination Unreachable/Port Unreachable dla sond UDP, lub bezpośrednią odpowiedzią dla ICMP Echo).</li>
</ol>
<p>W ten elegancki sposób, wykorzystując mechanizm zaprojektowany pierwotnie wyłącznie do zapobiegania pętlom, traceroute odtwarza <strong>pełną listę routerów</strong> na trasie do celu wraz z przybliżonym czasem odpowiedzi każdego z nich (zwykle trzy próby na każdy TTL, dla uśrednienia opóźnienia i wykrycia niestabilności trasy).</p>
<h3>5.4. Praktyczne konsekwencje wartości początkowej TTL</h3>
<p>Analiza wartości TTL w odebranym pakiecie bywa też wykorzystywana (choć zawodnie) do <strong>przybliżonego rozpoznania systemu operacyjnego</strong> nadawcy (tzw. pasywny fingerprinting) — poprzez porównanie <strong>odebranej</strong> wartości TTL z najbliższą typową wartością początkową (64, 128, 255) i policzenie różnicy, można oszacować <strong>liczbę przeskoków</strong> pokonanych przez pakiet, a pośrednio typowa wartość początkowa bywa wskazówką co do rodzaju nadawcy. Metoda ta jest jednak dość zawodna: administratorzy mogą ręcznie zmieniać domyślne wartości TTL, a rzeczywista liczba przeskoków bywa trudna do jednoznacznego oszacowania.</p>
<p>Zbyt <strong>niska</strong> wartość początkowa TTL, ustawiona przez nadawcę, może w skrajnym przypadku spowodować, że pakiet <strong>nigdy nie dotrze do odległego celu</strong>, wygasając po drodze, zanim dotrze do miejsca docelowego — z tego powodu wartości początkowe TTL są dobierane z pewnym zapasem (64 lub 128 przeskoków to znacznie więcej, niż typowa trasa w internecie wymaga — rzeczywiste trasy między hostami na całym świecie liczą zwykle kilkanaście do góra dwudziestu kilku przeskoków).</p>
<hr />
<h2>6. Warstwa sieciowa a protokół IPv6</h2>
<h3>6.1. Motywacja powstania IPv6</h3>
<p>Jak wspomniano w rozdziale 2, 32-bitowa przestrzeń adresowa IPv4 (nieco ponad 4,3 miliarda adresów) okazała się dalece niewystarczająca w obliczu globalnej ekspansji internetu, eksplozji urządzeń mobilnych i internetu rzeczy. Protokół <strong>IPv6</strong>, opisany obecnie w <strong>RFC 8200</strong> (wcześniej RFC 2460 z 1998 r.), został zaprojektowany od podstaw, aby rozwiązać ten problem, a przy okazji — usprawnić i uprościć szereg mechanizmów, które w IPv4 z czasem okazały się niepotrzebnie skomplikowane lub przestarzałe.</p>
<h3>6.2. Budowa stałego nagłówka IPv6</h3>
<p>W przeciwieństwie do nagłówka IPv4, który ma <strong>zmienną</strong> długość (20–60 B, zależnie od obecności opcji — rozdział 3), <strong>stały nagłówek IPv6 ma zawsze dokładnie 40 bajtów</strong> i składa się z zaledwie <strong>8 pól</strong> — znacznie mniej niż 13 pól obowiązkowych IPv4.</p>
<p><img alt=\"Budowa stałego nagłówka IPv6 — zawsze dokładnie 40 bajtów, 8 pól\" src=\"/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6/ipv6-naglowek-budowa.svg\" /></p>
<table>
<thead>
<tr>
<th>Pole</th>
<th>Rozmiar</th>
<th>Odpowiednik / różnica względem IPv4</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Wersja (Version)</strong></td>
<td>4 b</td>
<td>jak w IPv4, tu zawsze wartość 6</td>
</tr>
<tr>
<td><strong>Klasa ruchu (Traffic Class)</strong></td>
<td>8 b</td>
<td>odpowiednik pola ToS/DiffServ+ECN (rozdział 3.3) — identyczna koncepcja DSCP i ECN, przeniesiona wprost</td>
</tr>
<tr>
<td><strong>Etykieta przepływu (Flow Label)</strong></td>
<td>20 b</td>
<td><strong>pole nowe</strong>, nieobecne w IPv4 — pozwala oznaczyć wszystkie pakiety należące do tego samego „przepływu\" (np. jednej sesji TCP) tą samą wartością, ułatwiając routerom szybkie, sprzętowe utrzymywanie spójnego traktowania (np. tej samej ścieżki w równoważeniu obciążenia ECMP) bez konieczności analizy portów warstwy transportowej</td>
</tr>
<tr>
<td><strong>Długość danych (Payload Length)</strong></td>
<td>16 b</td>
<td>odpowiednik Total Length, ale liczy <strong>wyłącznie dane</strong> (bez 40-bajtowego nagłówka stałego), ponieważ ten ma zawsze znaną, stałą długość</td>
</tr>
<tr>
<td><strong>Następny nagłówek (Next Header)</strong></td>
<td>8 b</td>
<td>odpowiednik pola Protokół (rozdział 3.9), ale pełni też dodatkową rolę — może wskazywać na <strong>nagłówek rozszerzenia</strong> (rozdział 6.4), a nie bezpośrednio na protokół transportowy</td>
</tr>
<tr>
<td><strong>Limit przeskoków (Hop Limit)</strong></td>
<td>8 b</td>
<td>dokładny odpowiednik TTL (rozdział 5) — inna nazwa, identyczna funkcja: dekrementacja o 1 na każdym routerze, odrzucenie przy 0</td>
</tr>
<tr>
<td><strong>Adres źródłowy</strong></td>
<td><strong>128 b</strong></td>
<td>4-krotnie dłuższy niż w IPv4 (32 b)</td>
</tr>
<tr>
<td><strong>Adres docelowy</strong></td>
<td><strong>128 b</strong></td>
<td>jw.</td>
</tr>
</tbody>
</table>
<p><strong>Pól, które zniknęły całkowicie</strong> względem IPv4: IHL (zbędne — nagłówek ma zawsze stałą długość 40 B), Identification/Flags/Fragment Offset (fragmentacja działa inaczej — rozdział 6.5), oraz <strong>Header Checksum</strong> (rozdział 6.3).</p>
<h3>6.3. Dlaczego IPv6 zrezygnował z sumy kontrolnej nagłówka?</h3>
<p>Decyzja o usunięciu pola Header Checksum (obecnego w IPv4, rozdział 3.10) była świadomym wyborem projektowym, uzasadnionym kilkoma argumentami:</p>
<ul>
<li><strong>Redundancja z innymi warstwami.</strong> Ramka warstwy 2 (np. Ethernet) już zawiera własną sumę kontrolną <strong>FCS/CRC-32</strong>, wykrywającą uszkodzenia na poziomie pojedynczego łącza. Protokoły transportowe <strong>TCP i UDP</strong> zawierają własne sumy kontrolne, obejmujące zarówno nagłówek transportowy, jak i dane, a nawet (poprzez tzw. pseudo-nagłówek) kluczowe pola nagłówka IP (adresy źródłowy i docelowy). Suma kontrolna na poziomie IP była więc w dużej mierze <strong>powtórzeniem</strong> zabezpieczenia już zapewnianego przez warstwy sąsiadujące.</li>
<li><strong>Koszt wydajnościowy.</strong> Jak wyjaśniono w rozdziale 3.10, obecność sumy kontrolnej w IPv4 wymusza jej <strong>przeliczenie przez każdy router</strong> po każdej modyfikacji nagłówka (w szczególności — dekrementacji TTL/Hop Limit). Przy prędkościach transmisji rzędu dziesiątek i setek gigabitów na sekundę, charakterystycznych dla współczesnych routerów szkieletowych, nawet niewielki koszt obliczeniowy per-pakiet, pomnożony przez miliardy pakietów na sekundę, staje się istotnym obciążeniem. Usunięcie tego wymogu upraszcza i przyspiesza sprzętową implementację przekazywania pakietów.</li>
<li><strong>Filozofia end-to-end.</strong> Zgodnie z zasadą end-to-end (rozdział 1.2), odpowiedzialność za integralność danych aplikacji lepiej umiejscowić na brzegach sieci (w protokołach transportowych i aplikacyjnych), a nie duplikować ją niepotrzebnie w każdym pośredniczącym routerze rdzenia sieci.</li>
</ul>
<h3>6.4. Nagłówki rozszerzeń (Extension Headers)</h3>
<p>Zamiast pojedynczego pola Opcje o zmiennej długości (jak w IPv4, rozdział 3.12), IPv6 wprowadza koncepcję <strong>łańcucha nagłówków rozszerzeń</strong> — dodatkowych, opcjonalnych nagłówków, umieszczanych między stałym nagłówkiem IPv6 a nagłówkiem protokołu warstwy transportowej, połączonych w łańcuch za pomocą pola <strong>Next Header</strong> każdego z nich (każdy nagłówek rozszerzenia, podobnie jak nagłówek stały, zawiera własne pole Next Header wskazujące na kolejny element łańcucha). Do standardowych nagłówków rozszerzeń należą m.in.: <strong>Hop-by-Hop Options</strong>, <strong>Routing</strong> (odpowiednik source routing z IPv4), <strong>Fragment</strong> (patrz niżej), <strong>Authentication Header (AH)</strong> i <strong>Encapsulating Security Payload (ESP)</strong> — te dwa ostatnie współdzielone z mechanizmem IPsec, również dostępnym w IPv4.</p>
<p>Kluczowa zaleta tej architektury: routery pośredniczące na trasie muszą przetwarzać (i mogą efektywnie pominąć) tylko nagłówki, które ich rzeczywiście dotyczą — w typowym przypadku <strong>żadnych</strong> nagłówków rozszerzeń, przechodząc bezpośrednio od stałego nagłówka do przekazania pakietu dalej, bez analizowania opcji przeznaczonych wyłącznie dla hosta docelowego.</p>
<h3>6.5. Fragmentacja w IPv6 — fundamentalna różnica koncepcyjna</h3>
<p>To jedna z najbardziej istotnych różnic architektonicznych między obiema wersjami protokołu. W IPv4 fragmentacji, jak opisano w rozdziale 4, mógł dokonać <strong>dowolny router na trasie</strong>, jeśli napotkał łącze o zbyt małym MTU. <strong>W IPv6 routery pośredniczące nigdy nie fragmentują pakietów.</strong> Fragmentacja, jeśli jest w ogóle konieczna, może zostać wykonana <strong>wyłącznie przez hosta źródłowego</strong>, przed wysłaniem pakietu — a informacja o niej przenoszona jest w osobnym, opcjonalnym <strong>nagłówku rozszerzenia Fragment</strong> (zawierającym pola analogiczne funkcjonalnie do Identification, Fragment Offset i M-flag z IPv4, lecz umieszczone poza stałym nagłówkiem).</p>
<p>Jeśli router IPv6 napotka na trasie pakiet zbyt duży dla łącza wyjściowego, <strong>zawsze</strong> odrzuca go i odsyła nadawcy komunikat <strong>ICMPv6 Packet Too Big (Typ 2)</strong> — dokładny odpowiednik mechanizmu Path MTU Discovery (rozdział 4.5), z tą różnicą, że w IPv6 jest to <strong>jedyny</strong> dostępny sposób obsługi zbyt dużych pakietów (nie istnieje odpowiednik „zwykłej\" fragmentacji przez router, obecnej opcjonalnie w IPv4 przy braku bitu DF). Decyzja ta wymusza powszechne stosowanie mechanizmu Path MTU Discovery jako integralnej, obowiązkowej części stosu IPv6, a nie opcjonalnego usprawnienia jak w IPv4.</p>
<p>Dodatkowo IPv6 wprowadza wymóg <strong>minimalnego MTU całej trasy wynoszącego co najmniej 1280 bajtów</strong> — każde łącze obsługujące IPv6 musi zapewniać MTU nie mniejsze niż ta wartość (a jeśli fizyczne łącze ma mniejsze MTU, warstwa 2 musi zapewnić przezroczystą fragmentację/składanie na swoim własnym poziomie, niewidoczną dla IPv6). Gwarantuje to, że host źródłowy zawsze może bezpiecznie wysłać pakiet o rozmiarze do 1280 B bez ryzyka odrzucenia z powodu zbyt małego MTU gdziekolwiek na trasie, nawet bez uprzedniego przeprowadzenia pełnego Path MTU Discovery.</p>
<h3>6.6. Porównanie kluczowych pól i mechanizmów</h3>
<table>
<thead>
<tr>
<th>Cecha / pole</th>
<th>IPv4</th>
<th>IPv6</th>
</tr>
</thead>
<tbody>
<tr>
<td>Długość adresu</td>
<td>32 bity</td>
<td>128 bitów</td>
</tr>
<tr>
<td>Długość nagłówka</td>
<td>zmienna, 20–60 B</td>
<td>zawsze 40 B (nagłówek stały)</td>
</tr>
<tr>
<td>Pole długości nagłówka (IHL)</td>
<td>tak</td>
<td>nie istnieje (długość zawsze stała)</td>
</tr>
<tr>
<td>Suma kontrolna nagłówka</td>
<td>tak, przeliczana na każdym routerze</td>
<td><strong>usunięta</strong></td>
</tr>
<tr>
<td>Fragmentacja przez routery pośredniczące</td>
<td>dopuszczalna (jeśli brak DF)</td>
<td><strong>niedopuszczalna</strong> — tylko host źródłowy, przez nagłówek rozszerzenia</td>
</tr>
<tr>
<td>Minimalne MTU gwarantowane na każdym łączu</td>
<td>brak formalnego wymogu</td>
<td><strong>1280 B</strong></td>
</tr>
<tr>
<td>Opcje</td>
<td>pole Options w nagłówku podstawowym</td>
<td>oddzielny łańcuch nagłówków rozszerzeń</td>
</tr>
<tr>
<td>Priorytetyzacja ruchu</td>
<td>ToS / DSCP + ECN (8 b)</td>
<td>Traffic Class (8 b) — koncepcyjnie identyczne</td>
</tr>
<tr>
<td>Identyfikacja przepływu</td>
<td>brak dedykowanego pola</td>
<td>Flow Label (20 b) — pole nowe</td>
</tr>
<tr>
<td>Licznik przeskoków</td>
<td>TTL (8 b)</td>
<td>Hop Limit (8 b) — identyczna funkcja, inna nazwa</td>
</tr>
<tr>
<td>Pole wskazujące protokół wyższej warstwy</td>
<td>Protocol (8 b)</td>
<td>Next Header (8 b) — ta sama koncepcja, rozszerzona o łańcuch nagłówków</td>
</tr>
<tr>
<td>Adresacja rozgłoszeniowa (broadcast)</td>
<td>tak (np. <code>255.255.255.255</code>)</td>
<td><strong>nie istnieje</strong> — zastąpiona przez rozszerzone wykorzystanie multicastu</td>
</tr>
<tr>
<td>Autokonfiguracja adresu bez serwera</td>
<td>brak (poza link-local APIPA)</td>
<td><strong>SLAAC</strong> wbudowany w projekt protokołu</td>
</tr>
</tbody>
</table>
<hr />
<h2>7. Podsumowanie</h2>
<p>Warstwa sieciowa, a w niej protokół IP, stanowi kręgosłup, dzięki któremu miliardy niezależnie zarządzanych, technologicznie odmiennych sieci lokalnych tworzą jedną, spójną całość — internet. Kluczem do tej integracji jest <strong>hierarchiczna adresacja logiczna</strong>, pozwalająca routerom podejmować decyzje na podstawie skalowalnych, agregowanych bloków adresów, zamiast płaskiej listy każdego pojedynczego urządzenia.</p>
<p>Dokładna analiza nagłówka IPv4 — pole IHL określające zmienną długość nagłówka w jednostkach 4-bajtowych, pole ToS przekształcone z czasem w architekturę DiffServ i mechanizm ECN, pole TTL zapobiegające nieskończonym pętlom routingu (i przy okazji umożliwiające działanie narzędzia traceroute), złożony, wieloetapowy mechanizm fragmentacji oparty na współpracy pól Identification, Flags i Fragment Offset, oraz pole Protokół pełniące funkcję „adresu docelowego\" w obrębie stosu protokołów hosta — pokazuje, jak wiele przemyślanych, wzajemnie powiązanych decyzji projektowych kryje się w pozornie prostym, 20-bajtowym nagłówku zaprojektowanym w 1981 roku, a wciąż niosącym większość światowego ruchu internetowego.</p>
<p><strong>IPv6</strong>, projektowany dwie dekady później, z pełną świadomością ograniczeń poprzednika, pokazuje alternatywną filozofię projektową: stały, uproszczony nagłówek zamiast zmiennej długości z polem IHL, rezygnacja z sumy kontrolnej na rzecz zabezpieczeń w warstwach sąsiednich, przeniesienie fragmentacji wyłącznie na hosta źródłowego oraz elastyczny, rozszerzalny łańcuch nagłówków zamiast sztywnego pola Opcje. Obie wersje protokołu, mimo fundamentalnych różnic w szczegółach implementacyjnych, realizują tę samą, wspólną misję warstwy sieciowej: dostarczenie danych od źródła do celu, przez potencjalnie wiele pośredniczących sieci, w modelu bezpołączeniowym, najlepszego możliwego wysiłku.</p>
<hr />
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
<td><strong>Best-effort</strong></td>
<td>model usługi bez gwarancji dostarczenia, kolejności czy czasu</td>
</tr>
<tr>
<td><strong>CIDR</strong></td>
<td>bezklasowy routing międzydomenowy — dowolna granica sieć/host wyrażona prefiksem</td>
</tr>
<tr>
<td><strong>DiffServ / DSCP</strong></td>
<td>architektura różnicowania klas obsługi pakietów na podstawie 6-bitowego pola w nagłówku</td>
</tr>
<tr>
<td><strong>ECN</strong></td>
<td>jawne sygnalizowanie przeciążenia bez odrzucania pakietu</td>
</tr>
<tr>
<td><strong>Flow Label</strong></td>
<td>20-bitowe pole IPv6 identyfikujące przepływ pakietów należących do tej samej sesji</td>
</tr>
<tr>
<td><strong>Fragmentacja</strong></td>
<td>podział zbyt dużego datagramu na mniejsze części dopasowane do MTU łącza</td>
</tr>
<tr>
<td><strong>Header Checksum</strong></td>
<td>suma kontrolna obejmująca wyłącznie nagłówek IPv4, przeliczana na każdym routerze</td>
</tr>
<tr>
<td><strong>Hop Limit</strong></td>
<td>odpowiednik TTL w IPv6</td>
</tr>
<tr>
<td><strong>IHL</strong></td>
<td>pole określające długość nagłówka IPv4 w jednostkach 4-bajtowych</td>
</tr>
<tr>
<td><strong>MTU</strong></td>
<td>maksymalna jednostka transmisji dopuszczalna na danym łączu</td>
</tr>
<tr>
<td><strong>Next Header</strong></td>
<td>pole IPv6 wskazujące kolejny nagłówek rozszerzenia lub protokół warstwy transportowej</td>
</tr>
<tr>
<td><strong>Path MTU Discovery</strong></td>
<td>mechanizm ustalania najmniejszego MTU na całej trasie, bez fragmentacji przez routery</td>
</tr>
<tr>
<td><strong>RFC 1918</strong></td>
<td>dokument definiujący prywatne, niemarszrutyzowane publicznie zakresy adresów IPv4</td>
</tr>
<tr>
<td><strong>TTL</strong></td>
<td>licznik przeskoków dekrementowany przez każdy router, zapobiegający pętlom routingu</td>
</tr>
</tbody>
</table>
<hr />
<h2>9. Pytania kontrolne i zadania</h2>
<h3>Pytania</h3>
<ol>
<li>Wyjaśnij, dlaczego adresacja hierarchiczna (jak w IP) jest niezbędna dla skalowalności internetu, w odróżnieniu od płaskiej adresacji MAC.</li>
<li>Pole IHL wyraża długość nagłówka w jednostkach 4-bajtowych, a nie wprost w bajtach. Wyjaśnij, dlaczego, oraz oblicz maksymalną długość nagłówka IPv4 w bajtach.</li>
<li>Czym różni się dzisiejsza interpretacja 8-bitowego pola ToS (DSCP + ECN) od jego pierwotnego znaczenia z RFC 791? Jaką funkcję pełni każda z tych dwóch nowych części?</li>
<li>Opisz krok po kroku, jak router wykorzystuje pola Identification, Flags (MF, DF) i Fragment Offset przy fragmentacji zbyt dużego datagramu.</li>
<li>Dlaczego rozmiar danych każdego fragmentu IPv4 (poza ostatnim) musi być wielokrotnością 8 bajtów?</li>
<li>Wyjaśnij zasadę działania pola TTL i opisz, w jaki sposób to pole jest wykorzystywane przez narzędzie diagnostyczne traceroute do odkrywania trasy pakietów.</li>
<li>Do czego służy pole Protokół w nagłówku IPv4? Podaj przykład sytuacji, w której nieprawidłowa wartość tego pola uniemożliwiłaby poprawne dostarczenie danych do aplikacji.</li>
<li>Dlaczego suma kontrolna nagłówka IPv4 musi być przeliczana na każdym routerze na trasie? Jakie są konsekwencje wydajnościowe tego wymogu i jak rozwiązuje ten problem IPv6?</li>
<li>Wymień co najmniej cztery różnice między nagłówkiem IPv4 a nagłówkiem IPv6 (poza samą długością adresu) i krótko uzasadnij motywację projektową każdej z nich.</li>
<li>Wyjaśnij, na czym polega fundamentalna różnica w podejściu do fragmentacji między IPv4 a IPv6, oraz jaką rolę odgrywa w tym kontekście gwarantowane minimalne MTU 1280 B w IPv6.</li>
</ol>
<h3>Zadania obliczeniowe</h3>
<p><strong>Zadanie 1.</strong> Datagram IPv4 ma pole Total Length = 5940 B i standardowy nagłówek bez opcji (IHL = 5). Musi zostać przesłany przez łącze o MTU = 1500 B. Oblicz: (a) rozmiar danych oryginalnego datagramu, (b) liczbę wymaganych fragmentów, (c) wartości pól Fragment Offset i MF dla każdego fragmentu.</p>
<p><strong>Zadanie 2.</strong> Host wysyła pakiet z TTL = 64 do serwera odległego o 11 przeskoków routingu. Jaka wartość TTL zostanie odczytana przez serwer docelowy w odebranym pakiecie? Jaka jest maksymalna liczba dodatkowych przeskoków, jaką mógłby jeszcze pokonać ten pakiet, zanim zostałby odrzucony?</p>
<p><strong>Zadanie 3.</strong> Sieć <code>10.20.30.0/23</code> ma zostać podzielona na 8 równych podsieci. Oblicz nowy prefiks, liczbę adresów użytecznych dla hostów w każdej podsieci oraz podaj adres sieci i adres rozgłoszeniowy trzeciej z kolei podsieci.</p>
<h3>Klucz odpowiedzi do zadań</h3>
<p><strong>Zadanie 1.</strong> (a) Dane = <span class=\"mathjax mathjax--inline\">\\(5940 - 20 = 5920\\)</span> B. (b) Maksymalne dane na fragment: <span class=\"mathjax mathjax--inline\">\\(1500-20=1480\\)</span> B (już wielokrotność 8). Liczba fragmentów: <span class=\"mathjax mathjax--inline\">\\(\\lceil 5920/1480 \\rceil = 4\\)</span>. (c) Fragment 1: offset = 0, dane 0–1479 (1480 B), MF=1. Fragment 2: offset = <span class=\"mathjax mathjax--inline\">\\(1480/8=185\\)</span>, dane 1480–2959 (1480 B), MF=1. Fragment 3: offset = <span class=\"mathjax mathjax--inline\">\\(2960/8=370\\)</span>, dane 2960–4439 (1480 B), MF=1. Fragment 4: offset = <span class=\"mathjax mathjax--inline\">\\(4440/8=555\\)</span>, dane 4440–5919 (1480 B), MF=0. (Suma danych: <span class=\"mathjax mathjax--inline\">\\(1480 \\times 4 = 5920\\)</span> B — zgadza się).</p>
<p><strong>Zadanie 2.</strong> Serwer odczyta TTL <span class=\"mathjax mathjax--inline\">\\(= 64 - 11 = \\mathbf{53}\\)</span>. Ponieważ pakiet zostanie odrzucony przy TTL = 0, mógłby jeszcze pokonać maksymalnie <strong>53 dodatkowe przeskoki</strong> (docierając z TTL=1 do dwunastego kolejnego routera), zanim zostałby odrzucony.</p>
<p><strong>Zadanie 3.</strong> <span class=\"mathjax mathjax--inline\">\\(/23\\)</span> ma <span class=\"mathjax mathjax--inline\">\\(32-23=9\\)</span> bitów hosta (<span class=\"mathjax mathjax--inline\">\\(2^9=512\\)</span> adresów). Podział na 8 podsieci wymaga <span class=\"mathjax mathjax--inline\">\\(\\log_2 8 = 3\\)</span> dodatkowych bitów sieciowych: nowy prefiks <span class=\"mathjax mathjax--inline\">\\(= 23+3 = \\mathbf{/26}\\)</span>. Adresów łącznie na podsieć: <span class=\"mathjax mathjax--inline\">\\(2^{32-26}=2^6=64\\)</span>, użytecznych dla hostów: <span class=\"mathjax mathjax--inline\">\\(64-2=\\mathbf{62}\\)</span>. Rozmiar skoku między kolejnymi podsieciami: 64 adresy. Podsieci (licząc od <code>10.20.30.0/26</code>): 1. <code>10.20.30.0/26</code>, 2. <code>10.20.30.64/26</code>, 3. <strong><code>10.20.30.128/26</code></strong> — adres sieci: <strong>10.20.30.128</strong>, zakres hostów: 10.20.30.129–10.20.30.190, adres rozgłoszeniowy: <strong>10.20.30.191</strong>.</p>", "@Page:/var/www/html/user/pages/05.lsk/06.warstwa-sieciowa-protokoly-ipv4-i-ipv6", "");
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
