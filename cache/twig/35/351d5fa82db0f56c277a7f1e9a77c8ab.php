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

/* @Page:/var/www/html/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac */
class __TwigTemplate_5cb99cc3d1c57ae0ec77dc36699e44f2_sourced extends Template
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
        yield "<h2>1. Wprowadzenie</h2>
<p>Ramka Ethernet jest podstawową jednostką transmisji danych w warstwie łącza danych (warstwa 2 modelu OSI). To właśnie w ramkę enkapsulowany jest pakiet pochodzący z warstwy sieciowej (np. datagram IPv4 lub IPv6), zanim trafi on na medium fizyczne w postaci ciągu impulsów elektrycznych, optycznych lub fal radiowych. Ramka pełni funkcję „koperty” — otacza dane użytkownika nagłówkiem i stopką, dzięki którym karta sieciowa odbiorcy potrafi rozpoznać początek transmisji, zidentyfikować nadawcę i odbiorcę, ustalić typ przenoszonych danych oraz zweryfikować, czy dane nie uległy uszkodzeniu w drodze.</p>
<p>Struktura ramki, format adresu fizycznego oraz mechanizm sumy kontrolnej zostały ustandaryzowane przez komitet <strong>IEEE 802.3</strong> i są dziś identyczne (z drobnymi wyjątkami) niezależnie od prędkości łącza — od klasycznego Ethernetu 10 Mb/s po współczesne sieci 100 Gb/s. Niniejszy materiał opisuje budowę ramki krok po kroku: od preambuły synchronizującej transmisję, przez 48-bitowy adres MAC, pole danych i mechanizm wykrywania błędów CRC/FCS, aż po ramki Jumbo stosowane w sieciach o podwyższonej wydajności.</p>
<hr />
<h2>2. Ogólna budowa ramki — Ethernet II a IEEE 802.3</h2>
<p>W praktyce funkcjonują dwa pokrewne formaty ramki:</p>
<ul>
<li><strong>Ethernet II (format DIX)</strong> — starszy, lecz dziś dominujący format, w którym pole za adresami nadawcy i odbiorcy określa <strong>typ</strong> przenoszonego protokołu (EtherType). To właśnie ten format enkapsuluje niemal cały współczesny ruch IP.</li>
<li><strong>IEEE 802.3 (format oryginalny)</strong> — pole o tej samej pozycji określa <strong>długość</strong> pola danych, a identyfikacja protokołu odbywa się dopiero w nagłówku podwarstwy LLC (Logical Link Control) doklejonym na początku pola danych.</li>
</ul>
<p>Odbiornik odróżnia oba formaty na podstawie wartości tego pola: jeśli liczba jest <strong>mniejsza lub równa 1500</strong> (0x05DC), interpretowana jest jako długość danych (format IEEE 802.3); jeśli jest <strong>większa lub równa 1536</strong> (0x0600), interpretowana jest jako identyfikator protokołu (format Ethernet II). Zakres 1501–1535 jest celowo niewykorzystany, aby uniknąć niejednoznaczności.</p>
<p>Poniższy schemat przedstawia budowę dominującej dziś ramki Ethernet II wraz z warstwą fizyczną poprzedzającą właściwą ramkę.</p>
<p><img alt=\"Struktura ramki Ethernet II — preambuła, SFD, adresy MAC, EtherType, pole danych i FCS\" src=\"/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/ramka-ethernet-ii-struktura.svg\" /></p>
<p>Warto zwrócić uwagę na istotny szczegół terminologiczny: preambuła i SFD formalnie <strong>nie wchodzą w skład ramki</strong> w rozumieniu specyfikacji IEEE 802.3 — są elementem warstwy fizycznej, odpowiedzialnym wyłącznie za synchronizację odbiornika. Dlatego minimalny i maksymalny rozmiar ramki (64–1518 bajtów) liczony jest dopiero od pola adresu docelowego do końca pola FCS.</p>
<hr />
<h2>3. Preambuła i ogranicznik początku ramki (SFD)</h2>
<h3>Preambuła (7 bajtów)</h3>
<p>Preambuła to ciąg 56 bitów o wzorcu <code>10101010 10101010 ... 10101010</code>. Jego zadaniem jest umożliwienie obwodom odbiornika (pętli PLL — Phase-Locked Loop) zsynchronizowanie własnego zegara taktującego z częstotliwością i fazą sygnału nadchodzącego od nadawcy. Naprzemienny wzorzec jedynek i zer generuje najbardziej przewidywalne, regularne przejścia napięcia, dzięki czemu odbiornik może precyzyjnie „wstrzelić się” w rytm nadchodzących bitów, zanim dotrą dane właściwe.</p>
<h3>SFD — Start Frame Delimiter (1 bajt)</h3>
<p>Ostatni bajt sekwencji synchronizującej ma wzorzec <code>10101011</code> — różni się od preambuły ostatnimi dwoma bitami (<code>11</code> zamiast <code>10</code>). To odstępstwo od regularnego wzorca jest celowym sygnałem: mówi odbiornikowi „synchronizacja zakończona, kolejny bit rozpoczyna adres MAC odbiorcy”. Od tego momentu obwód odbiorczy przełącza się z trybu synchronizacji w tryb odczytu właściwej ramki.</p>
<blockquote>
<p><strong>Uwaga praktyczna:</strong> W terminologii niektórych analizatorów protokołów (np. Wireshark) preambuła i SFD zwykle nie są w ogóle widoczne w przechwyconych danych, ponieważ są usuwane sprzętowo przez kontroler MAC karty sieciowej jeszcze przed przekazaniem ramki do systemu operacyjnego.</p>
</blockquote>
<hr />
<h2>4. Adresacja fizyczna — 48-bitowy adres MAC (EUI-48)</h2>
<p>Każdy interfejs sieciowy Ethernet identyfikowany jest przez unikalny adres fizyczny o długości <strong>48 bitów (6 bajtów)</strong>, zapisywany standardowo w postaci sześciu par cyfr szesnastkowych oddzielonych dwukropkiem lub myślnikiem, np. <code>00:1A:2B:3C:4D:5E</code>. Format ten określa się mianem <strong>EUI-48</strong> (Extended Unique Identifier).</p>
<h3>Podział na producenta i numer seryjny</h3>
<p>Adres MAC dzieli się na dwie 24-bitowe (3-bajtowe) części:</p>
<ul>
<li><strong>OUI (Organizationally Unique Identifier)</strong> — pierwsze 3 bajty, przydzielane centralnie producentom sprzętu sieciowego przez organizację IEEE. Pozwala jednoznacznie zidentyfikować wytwórcę karty sieciowej.</li>
<li><strong>NIC / identyfikator interfejsu</strong> — kolejne 3 bajty, nadawane przez producenta w procesie produkcyjnym; w teorii unikalne w obrębie danego OUI, co w praktyce zapewnia globalną unikalność całego adresu.</li>
</ul>
<h3>Bity kontrolne pierwszego bajtu</h3>
<p>Dwa najmniej znaczące bity pierwszego bajtu adresu pełnią funkcję flag sterujących, niezależnie od przypisanego OUI:</p>
<ul>
<li><strong>Bit 0 — I/G (Individual/Group):</strong> wartość <code>0</code> oznacza adres indywidualny (unicast, wskazujący dokładnie jedną kartę sieciową); wartość <code>1</code> oznacza adres grupowy (multicast lub broadcast).</li>
<li><strong>Bit 1 — U/L (Universal/Local):</strong> wartość <code>0</code> oznacza adres nadany fabrycznie przez producenta (tzw. adres uniwersalny, BIA — Burned-In Address); wartość <code>1</code> oznacza adres nadany lub zmieniony lokalnie przez administratora bądź system operacyjny (np. w maszynach wirtualnych, kontenerach lub przy celowej zmianie adresu MAC).</li>
</ul>
<p><img alt=\"Struktura 48-bitowego adresu MAC z zaznaczonymi bitami I/G i U/L, podziałem na OUI i identyfikator interfejsu NIC\" src=\"/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/adres-mac-struktura.svg\" /></p>
<h3>Typy adresów ze względu na charakter transmisji</h3>
<table>
<thead>
<tr>
<th>Typ adresu</th>
<th>Bit I/G</th>
<th>Przykład</th>
<th>Zachowanie przełącznika</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Unicast</strong></td>
<td>0</td>
<td><code>00:1A:2B:3C:4D:5E</code></td>
<td>Ramka przekazywana na jeden, konkretny port</td>
</tr>
<tr>
<td><strong>Broadcast</strong></td>
<td>1 (wszystkie 48 bitów = 1)</td>
<td><code>FF:FF:FF:FF:FF:FF</code></td>
<td>Ramka powielana na wszystkie porty w danym VLAN-ie</td>
</tr>
<tr>
<td><strong>Multicast</strong></td>
<td>1</td>
<td><code>01:00:5E:xx:xx:xx</code> (mapowanie IPv4), <code>33:33:xx:xx:xx:xx</code> (IPv6)</td>
<td>Ramka kierowana do grupy zainteresowanych odbiorców</td>
</tr>
</tbody>
</table>
<hr />
<h2>5. Pole EtherType / Length</h2>
<p>Dwubajtowe pole następujące bezpośrednio po adresie źródłowym pełni podwójną, zależną od wartości liczbowej rolę opisaną w punkcie 2. Najczęściej spotykane wartości pola EtherType (format Ethernet II) to:</p>
<table>
<thead>
<tr>
<th>Wartość (hex)</th>
<th>Protokół</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>0x0800</code></td>
<td>IPv4</td>
</tr>
<tr>
<td><code>0x0806</code></td>
<td>ARP</td>
</tr>
<tr>
<td><code>0x86DD</code></td>
<td>IPv6</td>
</tr>
<tr>
<td><code>0x8100</code></td>
<td>Znacznik VLAN (IEEE 802.1Q)</td>
</tr>
<tr>
<td><code>0x8863</code> / <code>0x8864</code></td>
<td>PPPoE (faza odkrywania / sesji)</td>
</tr>
</tbody>
</table>
<p>Dzięki temu polu karta sieciowa i sterownik systemowy wiedzą, do którego protokołu warstwy wyższej przekazać zawartość pola danych, bez konieczności jego analizy.</p>
<hr />
<h2>6. Pole danych (Payload) — MTU, rozmiar minimalny i dopełnienie</h2>
<h3>Maksymalna wielkość — MTU</h3>
<p>Standardowe pole danych mieści od <strong>46 do 1500 bajtów</strong>. Górna granica nosi nazwę <strong>MTU</strong> (Maximum Transmission Unit) i wynika z historycznych ograniczeń bufora pamięci we wczesnych kontrolerach sieciowych oraz z kompromisu między efektywnością transmisji a czasem oczekiwania innych stacji na dostęp do współdzielonego medium w klasycznych sieciach opartych na CSMA/CD.</p>
<h3>Minimalna wielkość i dopełnienie (padding)</h3>
<p>Dolna granica — <strong>46 bajtów</strong> — nie jest przypadkowa. Wynika z wymogu, aby cała ramka (od adresu docelowego do FCS włącznie) miała co najmniej <strong>64 bajty</strong>. Wymóg ten jest bezpośrednią konsekwencją fizyki działania mechanizmu CSMA/CD w sieciach półdupleksowych: stacja nadająca musi jeszcze fizycznie emitować bity ramki w chwili, gdy do jej nadajnika powróci ewentualny sygnał kolizyjny z najdalej położonej stacji w segmencie sieci (czas RTT — Round-Trip Time). Gdyby ramka była krótsza, nadawca mógłby błędnie uznać transmisję za zakończoną powodzeniem, zanim informacja o kolizji zdążyłaby do niego dotrzeć.</p>
<p>Jeżeli dane przekazane z warstwy sieciowej są krótsze niż 46 bajtów (np. proste zapytanie ARP, które ma zaledwie 28 bajtów), kontroler MAC automatycznie uzupełnia pole danych bitami o wartości zero — jest to tzw. <strong>dopełnienie (padding)</strong>. Odbiorca, na podstawie długości zadeklarowanej w nagłówkach warstw wyższych (np. pola Total Length w nagłówku IPv4), potrafi odróżnić rzeczywiste dane od sztucznego wypełnienia i je odrzucić.</p>
<hr />
<h2>7. Suma kontrolna — pole FCS i algorytm CRC-32</h2>
<p>Ostatnie 4 bajty ramki stanowi pole <strong>FCS</strong> (Frame Check Sequence), zawierające wartość obliczoną algorytmem <strong>CRC-32</strong> (Cyclic Redundancy Check) — cyklicznego kodu nadmiarowego, będącego standardowym, sprzętowo zaimplementowanym mechanizmem wykrywania błędów transmisji.</p>
<h3>Zasada działania</h3>
<p>Nadawca traktuje cały ciąg bitów ramki objęty sumą kontrolną (od adresu docelowego do końca pola danych, <strong>z pominięciem</strong> preambuły i SFD) jako współczynniki wielomianu <span class=\"mathjax mathjax--inline\">\\(M(x)\\)</span> nad ciałem dwuelementowym <span class=\"mathjax mathjax--inline\">\\(GF(2)\\)</span>, a następnie dzieli go modulo 2 przez ustalony, znormalizowany <strong>wielomian generujący</strong> stopnia 32:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$G(x) = x^{32} + x^{26} + x^{23} + x^{22} + x^{16} + x^{12} + x^{11} + x^{10} + x^8 + x^7 + x^5 + x^4 + x^2 + x + 1\\)</span>\$</p>
<p>Reszta z tego dzielenia — liczba 32-bitowa — zostaje dopisana jako pole FCS. Odbiorca wykonuje dokładnie to samo dzielenie na odebranym ciągu bitów. Jeżeli obliczona przez niego reszta wynosi zero, ramkę uznaje się za nieuszkodzoną; jeśli reszta jest różna od zera, kontroler MAC natychmiast odrzuca ramkę i zwiększa sprzętowy licznik błędów CRC, nie przekazując jej dalej do warstw wyższych.</p>
<h3>Ograniczenia mechanizmu</h3>
<p>Warto podkreślić, że CRC-32 to mechanizm <strong>wykrywania</strong>, a nie <strong>korekcji</strong> błędów — uszkodzona ramka jest po prostu odrzucana, a jej ewentualna retransmisja pozostaje w gestii protokołów warstw wyższych (np. TCP). Algorytm ten jest również probabilistycznie niedoskonały: istnieje (skrajnie mało prawdopodobne, ale niezerowe) ryzyko, że wielobitowe uszkodzenie danych wygeneruje przypadkowo tę samą resztę z dzielenia co ramka oryginalna, co skutkowałoby niewykrytym błędem.</p>
<hr />
<h2>8. Ramki Jumbo</h2>
<p><strong>Ramki Jumbo</strong> to ramki Ethernet, których pole danych przekracza standardowe MTU wynoszące 1500 bajtów — najczęściej sięgając około <strong>9000 bajtów</strong> (spotykane są też inne, nieznormalizowane warianty, np. 9216 B). W przeciwieństwie do rozmiaru standardowego, rozmiar ramek Jumbo <strong>nie został formalnie ujęty w żadnej normie IEEE 802.3</strong> — jest to rozwiązanie funkcjonujące jako powszechnie przyjęta konwencja branżowa, zaimplementowana i obsługiwana przez producentów kart sieciowych oraz przełączników.</p>
<h3>Cel stosowania</h3>
<p>Głównym celem wprowadzenia większych ramek jest <strong>redukcja narzutu protokolarnego</strong> oraz obciążenia procesora w sieciach o wysokiej przepustowości (Gigabit Ethernet i szybszych), typowych dla centrów danych, sieci pamięci masowych (np. iSCSI, NFS) czy klastrów obliczeniowych. Przy stałym narzucie nagłówka (ok. 38 bajtów na ramkę: adresy, EtherType, FCS) większe pole danych oznacza mniej ramek potrzebnych do przesłania tej samej ilości danych, a więc mniej przerwań procesora (interrupts) generowanych przez kartę sieciową i wyższą efektywną przepustowość łącza.</p>
<h3>Ograniczenia i wymagania</h3>
<p>Zastosowanie ramek Jumbo wymaga <strong>spójnej konfiguracji na całej trasie transmisji</strong> — każde urządzenie pośredniczące (karta sieciowa nadawcy i odbiorcy oraz wszystkie przełączniki na trasie) musi jawnie obsługiwać zwiększone MTU. Jeśli choć jedno urządzenie na ścieżce nie obsługuje ramek Jumbo, może dojść do ich odrzucenia lub konieczności fragmentacji na poziomie warstwy sieciowej, co w skrajnych przypadkach prowadzi do degradacji wydajności zamiast jej poprawy. Z tego powodu ramki Jumbo stosuje się zwykle wyłącznie w odizolowanych, w pełni kontrolowanych segmentach sieci (np. wewnątrz centrum danych), a nie w publicznym internecie.</p>
<p><img alt=\"Porównanie rozmiaru ramki standardowej (1518 B) i ramki Jumbo (ok. 9000 B)\" src=\"/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/ramka-jumbo-porownanie.svg\" /></p>
<hr />
<h2>9. Podsumowanie — tabela zbiorcza pól ramki</h2>
<table>
<thead>
<tr>
<th>Pole</th>
<th>Rozmiar</th>
<th>Funkcja</th>
</tr>
</thead>
<tbody>
<tr>
<td>Preambuła</td>
<td>7 B</td>
<td>Synchronizacja zegara odbiornika (element warstwy fizycznej)</td>
</tr>
<tr>
<td>SFD</td>
<td>1 B</td>
<td>Sygnalizacja początku właściwej ramki</td>
</tr>
<tr>
<td>Adres MAC docelowy</td>
<td>6 B</td>
<td>Identyfikacja fizycznego odbiorcy (unicast / multicast / broadcast)</td>
</tr>
<tr>
<td>Adres MAC źródłowy</td>
<td>6 B</td>
<td>Identyfikacja fizycznego nadawcy (zawsze unicast)</td>
</tr>
<tr>
<td>EtherType / Length</td>
<td>2 B</td>
<td>Identyfikacja protokołu warstwy wyższej lub długość pola danych</td>
</tr>
<tr>
<td>Dane (Payload)</td>
<td>46–1500 B (standard) / do ok. 9000 B (Jumbo)</td>
<td>Przenoszony pakiet warstwy sieciowej wraz z ewentualnym dopełnieniem</td>
</tr>
<tr>
<td>FCS</td>
<td>4 B</td>
<td>Suma kontrolna CRC-32 służąca do wykrywania błędów transmisji</td>
</tr>
</tbody>
</table>
<hr />
<h2>10. Pytania kontrolne</h2>
<ol>
<li>Dlaczego preambuła i SFD formalnie nie są wliczane do minimalnego i maksymalnego rozmiaru ramki Ethernet (64–1518 bajtów)?</li>
<li>Jaki wzorzec bitowy odróżnia ostatni bajt sekwencji synchronizującej (SFD) od pozostałych bajtów preambuły i jaką pełni funkcję?</li>
<li>Z jakich dwóch 24-bitowych elementów zbudowany jest 48-bitowy adres MAC i za co odpowiada każdy z nich?</li>
<li>Co oznacza ustawienie bitu I/G na wartość 1 w pierwszym bajcie adresu MAC i jak w takim przypadku zachowa się przełącznik sieciowy?</li>
<li>W jaki sposób odbiornik ramki rozróżnia, czy pole o wartości dwóch bajtów za adresem źródłowym należy interpretować jako EtherType, czy jako długość pola danych (Length)?</li>
<li>Dlaczego minimalny rozmiar pola danych wynosi 46 bajtów i jaki związek ma ta wartość z mechanizmem CSMA/CD?</li>
<li>Na czym polega dopełnienie (padding) i w jaki sposób odbiorca odróżnia rzeczywiste dane od sztucznie dodanych bajtów wypełniających?</li>
<li>Opisz ogólną zasadę działania algorytmu CRC-32 wykorzystywanego do obliczania wartości pola FCS. Które pola ramki są objęte tym obliczeniem?</li>
<li>Czy suma kontrolna CRC-32 pozwala na naprawienie uszkodzonej ramki? Uzasadnij odpowiedź i wskaż, co dzieje się z ramką po wykryciu błędu.</li>
<li>Jakie korzyści wydajnościowe daje stosowanie ramek Jumbo oraz jakie warunki muszą być spełnione na całej trasie transmisji, aby ich zastosowanie nie spowodowało problemów sieciowych?</li>
</ol>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac";
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
        return new Source("<h2>1. Wprowadzenie</h2>
<p>Ramka Ethernet jest podstawową jednostką transmisji danych w warstwie łącza danych (warstwa 2 modelu OSI). To właśnie w ramkę enkapsulowany jest pakiet pochodzący z warstwy sieciowej (np. datagram IPv4 lub IPv6), zanim trafi on na medium fizyczne w postaci ciągu impulsów elektrycznych, optycznych lub fal radiowych. Ramka pełni funkcję „koperty” — otacza dane użytkownika nagłówkiem i stopką, dzięki którym karta sieciowa odbiorcy potrafi rozpoznać początek transmisji, zidentyfikować nadawcę i odbiorcę, ustalić typ przenoszonych danych oraz zweryfikować, czy dane nie uległy uszkodzeniu w drodze.</p>
<p>Struktura ramki, format adresu fizycznego oraz mechanizm sumy kontrolnej zostały ustandaryzowane przez komitet <strong>IEEE 802.3</strong> i są dziś identyczne (z drobnymi wyjątkami) niezależnie od prędkości łącza — od klasycznego Ethernetu 10 Mb/s po współczesne sieci 100 Gb/s. Niniejszy materiał opisuje budowę ramki krok po kroku: od preambuły synchronizującej transmisję, przez 48-bitowy adres MAC, pole danych i mechanizm wykrywania błędów CRC/FCS, aż po ramki Jumbo stosowane w sieciach o podwyższonej wydajności.</p>
<hr />
<h2>2. Ogólna budowa ramki — Ethernet II a IEEE 802.3</h2>
<p>W praktyce funkcjonują dwa pokrewne formaty ramki:</p>
<ul>
<li><strong>Ethernet II (format DIX)</strong> — starszy, lecz dziś dominujący format, w którym pole za adresami nadawcy i odbiorcy określa <strong>typ</strong> przenoszonego protokołu (EtherType). To właśnie ten format enkapsuluje niemal cały współczesny ruch IP.</li>
<li><strong>IEEE 802.3 (format oryginalny)</strong> — pole o tej samej pozycji określa <strong>długość</strong> pola danych, a identyfikacja protokołu odbywa się dopiero w nagłówku podwarstwy LLC (Logical Link Control) doklejonym na początku pola danych.</li>
</ul>
<p>Odbiornik odróżnia oba formaty na podstawie wartości tego pola: jeśli liczba jest <strong>mniejsza lub równa 1500</strong> (0x05DC), interpretowana jest jako długość danych (format IEEE 802.3); jeśli jest <strong>większa lub równa 1536</strong> (0x0600), interpretowana jest jako identyfikator protokołu (format Ethernet II). Zakres 1501–1535 jest celowo niewykorzystany, aby uniknąć niejednoznaczności.</p>
<p>Poniższy schemat przedstawia budowę dominującej dziś ramki Ethernet II wraz z warstwą fizyczną poprzedzającą właściwą ramkę.</p>
<p><img alt=\"Struktura ramki Ethernet II — preambuła, SFD, adresy MAC, EtherType, pole danych i FCS\" src=\"/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/ramka-ethernet-ii-struktura.svg\" /></p>
<p>Warto zwrócić uwagę na istotny szczegół terminologiczny: preambuła i SFD formalnie <strong>nie wchodzą w skład ramki</strong> w rozumieniu specyfikacji IEEE 802.3 — są elementem warstwy fizycznej, odpowiedzialnym wyłącznie za synchronizację odbiornika. Dlatego minimalny i maksymalny rozmiar ramki (64–1518 bajtów) liczony jest dopiero od pola adresu docelowego do końca pola FCS.</p>
<hr />
<h2>3. Preambuła i ogranicznik początku ramki (SFD)</h2>
<h3>Preambuła (7 bajtów)</h3>
<p>Preambuła to ciąg 56 bitów o wzorcu <code>10101010 10101010 ... 10101010</code>. Jego zadaniem jest umożliwienie obwodom odbiornika (pętli PLL — Phase-Locked Loop) zsynchronizowanie własnego zegara taktującego z częstotliwością i fazą sygnału nadchodzącego od nadawcy. Naprzemienny wzorzec jedynek i zer generuje najbardziej przewidywalne, regularne przejścia napięcia, dzięki czemu odbiornik może precyzyjnie „wstrzelić się” w rytm nadchodzących bitów, zanim dotrą dane właściwe.</p>
<h3>SFD — Start Frame Delimiter (1 bajt)</h3>
<p>Ostatni bajt sekwencji synchronizującej ma wzorzec <code>10101011</code> — różni się od preambuły ostatnimi dwoma bitami (<code>11</code> zamiast <code>10</code>). To odstępstwo od regularnego wzorca jest celowym sygnałem: mówi odbiornikowi „synchronizacja zakończona, kolejny bit rozpoczyna adres MAC odbiorcy”. Od tego momentu obwód odbiorczy przełącza się z trybu synchronizacji w tryb odczytu właściwej ramki.</p>
<blockquote>
<p><strong>Uwaga praktyczna:</strong> W terminologii niektórych analizatorów protokołów (np. Wireshark) preambuła i SFD zwykle nie są w ogóle widoczne w przechwyconych danych, ponieważ są usuwane sprzętowo przez kontroler MAC karty sieciowej jeszcze przed przekazaniem ramki do systemu operacyjnego.</p>
</blockquote>
<hr />
<h2>4. Adresacja fizyczna — 48-bitowy adres MAC (EUI-48)</h2>
<p>Każdy interfejs sieciowy Ethernet identyfikowany jest przez unikalny adres fizyczny o długości <strong>48 bitów (6 bajtów)</strong>, zapisywany standardowo w postaci sześciu par cyfr szesnastkowych oddzielonych dwukropkiem lub myślnikiem, np. <code>00:1A:2B:3C:4D:5E</code>. Format ten określa się mianem <strong>EUI-48</strong> (Extended Unique Identifier).</p>
<h3>Podział na producenta i numer seryjny</h3>
<p>Adres MAC dzieli się na dwie 24-bitowe (3-bajtowe) części:</p>
<ul>
<li><strong>OUI (Organizationally Unique Identifier)</strong> — pierwsze 3 bajty, przydzielane centralnie producentom sprzętu sieciowego przez organizację IEEE. Pozwala jednoznacznie zidentyfikować wytwórcę karty sieciowej.</li>
<li><strong>NIC / identyfikator interfejsu</strong> — kolejne 3 bajty, nadawane przez producenta w procesie produkcyjnym; w teorii unikalne w obrębie danego OUI, co w praktyce zapewnia globalną unikalność całego adresu.</li>
</ul>
<h3>Bity kontrolne pierwszego bajtu</h3>
<p>Dwa najmniej znaczące bity pierwszego bajtu adresu pełnią funkcję flag sterujących, niezależnie od przypisanego OUI:</p>
<ul>
<li><strong>Bit 0 — I/G (Individual/Group):</strong> wartość <code>0</code> oznacza adres indywidualny (unicast, wskazujący dokładnie jedną kartę sieciową); wartość <code>1</code> oznacza adres grupowy (multicast lub broadcast).</li>
<li><strong>Bit 1 — U/L (Universal/Local):</strong> wartość <code>0</code> oznacza adres nadany fabrycznie przez producenta (tzw. adres uniwersalny, BIA — Burned-In Address); wartość <code>1</code> oznacza adres nadany lub zmieniony lokalnie przez administratora bądź system operacyjny (np. w maszynach wirtualnych, kontenerach lub przy celowej zmianie adresu MAC).</li>
</ul>
<p><img alt=\"Struktura 48-bitowego adresu MAC z zaznaczonymi bitami I/G i U/L, podziałem na OUI i identyfikator interfejsu NIC\" src=\"/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/adres-mac-struktura.svg\" /></p>
<h3>Typy adresów ze względu na charakter transmisji</h3>
<table>
<thead>
<tr>
<th>Typ adresu</th>
<th>Bit I/G</th>
<th>Przykład</th>
<th>Zachowanie przełącznika</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Unicast</strong></td>
<td>0</td>
<td><code>00:1A:2B:3C:4D:5E</code></td>
<td>Ramka przekazywana na jeden, konkretny port</td>
</tr>
<tr>
<td><strong>Broadcast</strong></td>
<td>1 (wszystkie 48 bitów = 1)</td>
<td><code>FF:FF:FF:FF:FF:FF</code></td>
<td>Ramka powielana na wszystkie porty w danym VLAN-ie</td>
</tr>
<tr>
<td><strong>Multicast</strong></td>
<td>1</td>
<td><code>01:00:5E:xx:xx:xx</code> (mapowanie IPv4), <code>33:33:xx:xx:xx:xx</code> (IPv6)</td>
<td>Ramka kierowana do grupy zainteresowanych odbiorców</td>
</tr>
</tbody>
</table>
<hr />
<h2>5. Pole EtherType / Length</h2>
<p>Dwubajtowe pole następujące bezpośrednio po adresie źródłowym pełni podwójną, zależną od wartości liczbowej rolę opisaną w punkcie 2. Najczęściej spotykane wartości pola EtherType (format Ethernet II) to:</p>
<table>
<thead>
<tr>
<th>Wartość (hex)</th>
<th>Protokół</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>0x0800</code></td>
<td>IPv4</td>
</tr>
<tr>
<td><code>0x0806</code></td>
<td>ARP</td>
</tr>
<tr>
<td><code>0x86DD</code></td>
<td>IPv6</td>
</tr>
<tr>
<td><code>0x8100</code></td>
<td>Znacznik VLAN (IEEE 802.1Q)</td>
</tr>
<tr>
<td><code>0x8863</code> / <code>0x8864</code></td>
<td>PPPoE (faza odkrywania / sesji)</td>
</tr>
</tbody>
</table>
<p>Dzięki temu polu karta sieciowa i sterownik systemowy wiedzą, do którego protokołu warstwy wyższej przekazać zawartość pola danych, bez konieczności jego analizy.</p>
<hr />
<h2>6. Pole danych (Payload) — MTU, rozmiar minimalny i dopełnienie</h2>
<h3>Maksymalna wielkość — MTU</h3>
<p>Standardowe pole danych mieści od <strong>46 do 1500 bajtów</strong>. Górna granica nosi nazwę <strong>MTU</strong> (Maximum Transmission Unit) i wynika z historycznych ograniczeń bufora pamięci we wczesnych kontrolerach sieciowych oraz z kompromisu między efektywnością transmisji a czasem oczekiwania innych stacji na dostęp do współdzielonego medium w klasycznych sieciach opartych na CSMA/CD.</p>
<h3>Minimalna wielkość i dopełnienie (padding)</h3>
<p>Dolna granica — <strong>46 bajtów</strong> — nie jest przypadkowa. Wynika z wymogu, aby cała ramka (od adresu docelowego do FCS włącznie) miała co najmniej <strong>64 bajty</strong>. Wymóg ten jest bezpośrednią konsekwencją fizyki działania mechanizmu CSMA/CD w sieciach półdupleksowych: stacja nadająca musi jeszcze fizycznie emitować bity ramki w chwili, gdy do jej nadajnika powróci ewentualny sygnał kolizyjny z najdalej położonej stacji w segmencie sieci (czas RTT — Round-Trip Time). Gdyby ramka była krótsza, nadawca mógłby błędnie uznać transmisję za zakończoną powodzeniem, zanim informacja o kolizji zdążyłaby do niego dotrzeć.</p>
<p>Jeżeli dane przekazane z warstwy sieciowej są krótsze niż 46 bajtów (np. proste zapytanie ARP, które ma zaledwie 28 bajtów), kontroler MAC automatycznie uzupełnia pole danych bitami o wartości zero — jest to tzw. <strong>dopełnienie (padding)</strong>. Odbiorca, na podstawie długości zadeklarowanej w nagłówkach warstw wyższych (np. pola Total Length w nagłówku IPv4), potrafi odróżnić rzeczywiste dane od sztucznego wypełnienia i je odrzucić.</p>
<hr />
<h2>7. Suma kontrolna — pole FCS i algorytm CRC-32</h2>
<p>Ostatnie 4 bajty ramki stanowi pole <strong>FCS</strong> (Frame Check Sequence), zawierające wartość obliczoną algorytmem <strong>CRC-32</strong> (Cyclic Redundancy Check) — cyklicznego kodu nadmiarowego, będącego standardowym, sprzętowo zaimplementowanym mechanizmem wykrywania błędów transmisji.</p>
<h3>Zasada działania</h3>
<p>Nadawca traktuje cały ciąg bitów ramki objęty sumą kontrolną (od adresu docelowego do końca pola danych, <strong>z pominięciem</strong> preambuły i SFD) jako współczynniki wielomianu <span class=\"mathjax mathjax--inline\">\\(M(x)\\)</span> nad ciałem dwuelementowym <span class=\"mathjax mathjax--inline\">\\(GF(2)\\)</span>, a następnie dzieli go modulo 2 przez ustalony, znormalizowany <strong>wielomian generujący</strong> stopnia 32:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$G(x) = x^{32} + x^{26} + x^{23} + x^{22} + x^{16} + x^{12} + x^{11} + x^{10} + x^8 + x^7 + x^5 + x^4 + x^2 + x + 1\\)</span>\$</p>
<p>Reszta z tego dzielenia — liczba 32-bitowa — zostaje dopisana jako pole FCS. Odbiorca wykonuje dokładnie to samo dzielenie na odebranym ciągu bitów. Jeżeli obliczona przez niego reszta wynosi zero, ramkę uznaje się za nieuszkodzoną; jeśli reszta jest różna od zera, kontroler MAC natychmiast odrzuca ramkę i zwiększa sprzętowy licznik błędów CRC, nie przekazując jej dalej do warstw wyższych.</p>
<h3>Ograniczenia mechanizmu</h3>
<p>Warto podkreślić, że CRC-32 to mechanizm <strong>wykrywania</strong>, a nie <strong>korekcji</strong> błędów — uszkodzona ramka jest po prostu odrzucana, a jej ewentualna retransmisja pozostaje w gestii protokołów warstw wyższych (np. TCP). Algorytm ten jest również probabilistycznie niedoskonały: istnieje (skrajnie mało prawdopodobne, ale niezerowe) ryzyko, że wielobitowe uszkodzenie danych wygeneruje przypadkowo tę samą resztę z dzielenia co ramka oryginalna, co skutkowałoby niewykrytym błędem.</p>
<hr />
<h2>8. Ramki Jumbo</h2>
<p><strong>Ramki Jumbo</strong> to ramki Ethernet, których pole danych przekracza standardowe MTU wynoszące 1500 bajtów — najczęściej sięgając około <strong>9000 bajtów</strong> (spotykane są też inne, nieznormalizowane warianty, np. 9216 B). W przeciwieństwie do rozmiaru standardowego, rozmiar ramek Jumbo <strong>nie został formalnie ujęty w żadnej normie IEEE 802.3</strong> — jest to rozwiązanie funkcjonujące jako powszechnie przyjęta konwencja branżowa, zaimplementowana i obsługiwana przez producentów kart sieciowych oraz przełączników.</p>
<h3>Cel stosowania</h3>
<p>Głównym celem wprowadzenia większych ramek jest <strong>redukcja narzutu protokolarnego</strong> oraz obciążenia procesora w sieciach o wysokiej przepustowości (Gigabit Ethernet i szybszych), typowych dla centrów danych, sieci pamięci masowych (np. iSCSI, NFS) czy klastrów obliczeniowych. Przy stałym narzucie nagłówka (ok. 38 bajtów na ramkę: adresy, EtherType, FCS) większe pole danych oznacza mniej ramek potrzebnych do przesłania tej samej ilości danych, a więc mniej przerwań procesora (interrupts) generowanych przez kartę sieciową i wyższą efektywną przepustowość łącza.</p>
<h3>Ograniczenia i wymagania</h3>
<p>Zastosowanie ramek Jumbo wymaga <strong>spójnej konfiguracji na całej trasie transmisji</strong> — każde urządzenie pośredniczące (karta sieciowa nadawcy i odbiorcy oraz wszystkie przełączniki na trasie) musi jawnie obsługiwać zwiększone MTU. Jeśli choć jedno urządzenie na ścieżce nie obsługuje ramek Jumbo, może dojść do ich odrzucenia lub konieczności fragmentacji na poziomie warstwy sieciowej, co w skrajnych przypadkach prowadzi do degradacji wydajności zamiast jej poprawy. Z tego powodu ramki Jumbo stosuje się zwykle wyłącznie w odizolowanych, w pełni kontrolowanych segmentach sieci (np. wewnątrz centrum danych), a nie w publicznym internecie.</p>
<p><img alt=\"Porównanie rozmiaru ramki standardowej (1518 B) i ramki Jumbo (ok. 9000 B)\" src=\"/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac/ramka-jumbo-porownanie.svg\" /></p>
<hr />
<h2>9. Podsumowanie — tabela zbiorcza pól ramki</h2>
<table>
<thead>
<tr>
<th>Pole</th>
<th>Rozmiar</th>
<th>Funkcja</th>
</tr>
</thead>
<tbody>
<tr>
<td>Preambuła</td>
<td>7 B</td>
<td>Synchronizacja zegara odbiornika (element warstwy fizycznej)</td>
</tr>
<tr>
<td>SFD</td>
<td>1 B</td>
<td>Sygnalizacja początku właściwej ramki</td>
</tr>
<tr>
<td>Adres MAC docelowy</td>
<td>6 B</td>
<td>Identyfikacja fizycznego odbiorcy (unicast / multicast / broadcast)</td>
</tr>
<tr>
<td>Adres MAC źródłowy</td>
<td>6 B</td>
<td>Identyfikacja fizycznego nadawcy (zawsze unicast)</td>
</tr>
<tr>
<td>EtherType / Length</td>
<td>2 B</td>
<td>Identyfikacja protokołu warstwy wyższej lub długość pola danych</td>
</tr>
<tr>
<td>Dane (Payload)</td>
<td>46–1500 B (standard) / do ok. 9000 B (Jumbo)</td>
<td>Przenoszony pakiet warstwy sieciowej wraz z ewentualnym dopełnieniem</td>
</tr>
<tr>
<td>FCS</td>
<td>4 B</td>
<td>Suma kontrolna CRC-32 służąca do wykrywania błędów transmisji</td>
</tr>
</tbody>
</table>
<hr />
<h2>10. Pytania kontrolne</h2>
<ol>
<li>Dlaczego preambuła i SFD formalnie nie są wliczane do minimalnego i maksymalnego rozmiaru ramki Ethernet (64–1518 bajtów)?</li>
<li>Jaki wzorzec bitowy odróżnia ostatni bajt sekwencji synchronizującej (SFD) od pozostałych bajtów preambuły i jaką pełni funkcję?</li>
<li>Z jakich dwóch 24-bitowych elementów zbudowany jest 48-bitowy adres MAC i za co odpowiada każdy z nich?</li>
<li>Co oznacza ustawienie bitu I/G na wartość 1 w pierwszym bajcie adresu MAC i jak w takim przypadku zachowa się przełącznik sieciowy?</li>
<li>W jaki sposób odbiornik ramki rozróżnia, czy pole o wartości dwóch bajtów za adresem źródłowym należy interpretować jako EtherType, czy jako długość pola danych (Length)?</li>
<li>Dlaczego minimalny rozmiar pola danych wynosi 46 bajtów i jaki związek ma ta wartość z mechanizmem CSMA/CD?</li>
<li>Na czym polega dopełnienie (padding) i w jaki sposób odbiorca odróżnia rzeczywiste dane od sztucznie dodanych bajtów wypełniających?</li>
<li>Opisz ogólną zasadę działania algorytmu CRC-32 wykorzystywanego do obliczania wartości pola FCS. Które pola ramki są objęte tym obliczeniem?</li>
<li>Czy suma kontrolna CRC-32 pozwala na naprawienie uszkodzonej ramki? Uzasadnij odpowiedź i wskaż, co dzieje się z ramką po wykryciu błędu.</li>
<li>Jakie korzyści wydajnościowe daje stosowanie ramek Jumbo oraz jakie warunki muszą być spełnione na całej trasie transmisji, aby ich zastosowanie nie spowodowało problemów sieciowych?</li>
</ol>", "@Page:/var/www/html/user/pages/05.lsk/03.struktura-ramki-ethernet-i-adresacja-fizyczna-mac", "");
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
