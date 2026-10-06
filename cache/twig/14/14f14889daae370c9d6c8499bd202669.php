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

/* @Page:/var/www/html/user/pages/05.lsk/02.warstwa-dostepowa-i-technologia-ethernet */
class __TwigTemplate_b078871abc2fa04f28bf8de535d2d43b_sourced extends Template
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
        yield "<h1>Część 1: Architektura warstwy łącza danych, adresacja EUI-48, ramkowanie i medium fizyczne</h1>
<p>Jednostka lekcyjna skupiająca się na logicznym podziale warstwy łącza danych, różnicach między modelem ISO/OSI a standardem IEEE 802, analizie bitowej adresu MAC oraz budowie ramki sieciowej.</p>
<hr />
<h2>1. Wprowadzenie i podział warstwy łącza danych (IEEE 802 vs OSI)</h2>
<h3>Ewolucja historyczna technologii</h3>
<ul>
<li><strong>1970 (ALOHANET):</strong> Norman Abramson na Uniwersytecie Hawajskim uruchamia pierwszą sieć radiową z losowym dostępem do medium. Wprowadza regułę: stacja nadaje pakiet od razu, a w przypadku braku potwierdzenia (kolizji) odczekuje losowy czas. Był to bezpośredni przodek algorytmów kolizyjnych.</li>
<li><strong>1973 (Xerox PARC):</strong> Robert Metcalfe i David Boggs adaptują koncepcję ALOHA do kabla koncentrycznego, tworząc eksperymentalny Ethernet o prędkości 2,94 Mb/s łączący komputery Xerox Alto z pierwszą drukarką laserową.</li>
<li><strong>1980 (Konsorcjum DIX):</strong> Firmy <em>Digital Equipment Corporation (DEC), Intel</em> oraz <em>Xerox</em> publikują otwartą specyfikację Ethernet 10 Mb/s (standard DIX Ethernet I, a w 1982 r. – Ethernet II).</li>
<li><strong>1983–1985 (IEEE 802.3):</strong> Komitet Standaryzacyjny IEEE formalizuje Ethernet jako międzynarodową normę techniczną IEEE 802.3.</li>
</ul>
<pre><code class=\"language-plaintext\">+---------------------------------------------------------------------------------------------------+
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
|  | Warstwa 2: Łącza danych     | &lt;=====&gt; | - Wspólny interfejs programowy dla warstwy 3        |  |
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
|  | Warstwa 1: Fizyczna         | &lt;=====&gt; | Warstwa Fizyczna (PHY - PCS, PMA, PMD)              |  |
|  | (Physical Layer)            |         | - Kodowanie sygnałów (Manchester, MLT-3, PAM-5)     |  |
|  |                             |         | - Transmisja bitów: 10BASE-T, 100BASE-TX, 1000BASE-T|  |
|  +-----------------------------+         +-----------------------------------------------------+  |
+---------------------------------------------------------------------------------------------------+</code></pre>
<h3>Dlaczego komitet IEEE podzielił drugą warstwę na LLC i MAC?</h3>
<p>W pierwotnym modelu OSI warstwa druga była jednolitym modułem. W realiach lat 80. zaczęły powstawać różnorodne standardy mediów fizycznych:</p>
<ul>
<li><strong>IEEE 802.3</strong> – Ethernet (magistrala kablowa).</li>
<li><strong>IEEE 802.4</strong> – Token Bus (magistrala ze znacznikiem).</li>
<li><strong>IEEE 802.5</strong> – Token Ring (topologia pierścienia IBM).</li>
<li><strong>IEEE 802.11</strong> – Wi-Fi (sieci bezprzewodowe).</li>
</ul>
<p>Gdyby warstwa 2 pozostała monolitem, programiści protokołów sieciowych (np. IP, IPX, AppleTalk) musieliby pisać dedykowany sterownik sieciowy pod każdy typ okablowania.</p>
<p>Dzięki podziałowi:</p>
<ol>
<li><strong>Podwarstwa LLC (IEEE 802.2)</strong> tworzy uniwersalny punkt styku. Dla protokołu IPv4 pobieranie i wysyłanie danych z karty sieciowej wygląda identycznie, niezależnie od tego, czy fizycznym nośnikiem jest skrętka miedziana kat. 6, światłowód jednomodowy czy fala radiowa Wi-Fi.</li>
<li><strong>Podwarstwa MAC (IEEE 802.3)</strong> realizuje zadania sprzętowe: dopasowanie do złączy, formowanie preambuły, obliczanie sumy kontrolnej i pilnowanie reguł transmisji w kablu.</li>
</ol>
<hr />
<h2>2. Podwarstwy LLC i MAC – szczegółowa analiza mechanizmów</h2>
<h3>Podwarstwa LLC (Logical Link Control – IEEE 802.2)</h3>
<p>Podwarstwa LLC odpowiada za logiczną wymianę danych między węzłami i realizuje trzy podstawowe tryby pracy:</p>
<ul>
<li><strong>Type 1 (Unacknowledged Connectionless):</strong> Tryb bezpołączeniowy i bezpotwierdzeniowy. Najprostszy i najszybszy; dominuje we współczesnych sieciach IP. Jeżeli ramka ulegnie uszkodzeniu, podwarstwa LLC ją ignoruje, a retransmisją zajmują się wyższe warstwy stosu (np. TCP).</li>
<li><strong>Type 2 (Connection-Oriented):</strong> Tryb połączeniowy z gwarancją dostarczenia, numeracją ramek i potwierdzeniami (ACK). Używany dawniej w sieciach SNA (IBM) i przemysłowych systemach sterowania.</li>
<li><strong>Type 3 (Acknowledged Connectionless):</strong> Tryb bezpołączeniowy, lecz z natychmiastowym potwierdzeniem odbioru na poziomie ramki. Stosowany w automatyce i systemach czasu rzeczywistego.</li>
</ul>
<h4>Punkty SAP (Service Access Points) i enkapsulacja SNAP</h4>
<p>Aby odbiorca wiedział, jakiej usłudze przekazać pakiet, nagłówek LLC definiuje 1-bajtowe pola:</p>
<ul>
<li><strong>DSAP</strong> (<em>Destination Service Access Point</em>) – punkt dostępu odbiorcy.</li>
<li><strong>SSAP</strong> (<em>Source Service Access Point</em>) – punkt dostępu nadawcy.</li>
</ul>
<p>Przykładowe historyczne wartości SAP:</p>
<ul>
<li><code>0x06</code> – Protokół IPv4.</li>
<li><code>0xE0</code> – Novell NetWare IPX.</li>
<li><code>0x42</code> – Protokół drzewa rozpinającego STP (Spanning Tree Protocol).</li>
</ul>
<pre><code class=\"language-plaintext\">NAGŁÓWEK LLC (IEEE 802.2):
+-------------------+-------------------+--------------------+
| DSAP (1 bajt)     | SSAP (1 bajt)     | Control (1 bajt)   |
+-------------------+-------------------+--------------------+

NAGŁÓWEK SNAP (Rozszerzenie dla DSAP/SSAP = 0xAA):
+-------------------+-------------------+--------------------+
| OUI (3 bajty)     | Protocol ID (2 B) | Dane (Payload)     |
+-------------------+-------------------+--------------------+</code></pre>
<p>Ponieważ pole SAP ma tylko 8 bitów (z czego bity najmniej znaczące pełnią funkcje flag kontrolnych, pozostawiając zaledwie kilkadziesiąt unikalnych identyfikatorów), wprowadzono rozszerzenie <strong>SNAP</strong> (<em>Subnetwork Access Protocol</em>). Gdy w polu DSAP i SSAP pojawi się wartość <code>0xAA</code>, za nagłówkiem LLC doklejany jest nagłówek SNAP. Zawiera on 3-bajtowy identyfikator producenta <strong>OUI</strong> oraz 2-bajtowy identyfikator protokołu, identyczny z polem EtherType.</p>
<h3>Podwarstwa MAC (Media Access Control – IEEE 802.3)</h3>
<p>Podwarstwa MAC jest implementowana sprzętowo bezpośrednio w chipsecie karty sieciowej (NIC). Realizuje cztery zadania:</p>
<ol>
<li><strong>Adresowanie fizyczne:</strong> Przypisywanie unikalnych adresów źródłowych i odczytywanie adresów docelowych.</li>
<li><strong>Kompilacja i dekompilacja ramek:</strong> Opatrywanie danych nagłówkiem, dopełnieniem (Padding) oraz wyliczanie sumy kontrolnej.</li>
<li><strong>Konwersja danych na ciąg szeregowy (Serializacja):</strong> Zamiana bajtów z magistrali komputera (PCIe) na ciąg bitów przesyłany do transceivera PHY za pośrednictwem interfejsu MII (<em>Media Independent Interface</em>).</li>
<li><strong>Zarządzanie dostępem do medium:</strong> Badanie stanu łącza i realizacja algorytmu CSMA/CD (w Half-Duplex) lub koordynacja niezależnych kolejek FIFO (w Full-Duplex).</li>
</ol>
<hr />
<h2>3. Adresacja fizyczna EUI-48 (Adres MAC)</h2>
<p>Adres fizyczny standardu <strong>EUI-48</strong> (<em>Extended Unique Identifier</em>) to <strong>48-bitowa liczba binarna (6 bajtów)</strong>.</p>
<pre><code class=\"language-plaintext\">+-----------------------------------------------------------------------------------+
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
+-----------------------------------------------------------------------------------+</code></pre>
<h3>Znaczenie bitów kontrolnych pierwszego bajtu</h3>
<p>Architektura EUI-48 rezerwuje dwa najmniej znaczące bity pierwszego bajtu (bity zerowy i pierwszy) na cele sterowania logiką transmisji:</p>
<pre><code class=\"language-plaintext\">Pierwszy bajt adresu MAC (Bajt 0):
[ b7 | b6 | b5 | b4 | b3 | b2 | b1 (U/L) | b0 (I/G) ]</code></pre>
<ul>
<li><strong>Bit 0 – I/G (Individual / Group):</strong>
<ul>
<li><code>0</code> = Adres indywidualny (<strong>Unicast</strong>). Identyfikuje dokładnie jedną fizyczną kartę sieciową w sieci lokalnej.</li>
<li><code>1</code> = Adres grupowy (<strong>Multicast</strong>) lub rozgłoszeniowy (<strong>Broadcast</strong>).</li>
</ul></li>
<li><strong>Bit 1 – U/L (Universal / Local):</strong>
<ul>
<li><code>0</code> = Adres zarządzany globalnie (<strong>Universal</strong>). Adres BIA (<em>Burned-In Address</em>) trwale wypalony w pamięci ROM karty przez producenta posiadającego oficjalny prefiks OUI.</li>
<li><code>1</code> = Adres zarządzany lokalnie (<strong>Locally Administered</strong>). Oznacza, że adres MAC został zmieniony programowo przez administratora (spoofing MAC) lub wygenerowany automatycznie przez maszynę wirtualną / kontener.</li>
</ul></li>
</ul>
<h3>Podział adresów ze względu na charakter transmisji</h3>
<ol>
<li><strong>Adresy Unicast:</strong> Skierowane do pojedynczej stacji. Przełącznik sieciowy przekazuje taką ramkę wyłącznie na jeden port na podstawie wpisu w tablicy MAC (CAM).</li>
<li><strong>Adres Broadcast:</strong> Wszystkie 48 bitów ma wartość <code>1</code>:
<span class=\"mathjax mathjax--inline\">\\(\$\\text{FF:FF:FF:FF:FF:FF} = 11111111.11111111.11111111.11111111.11111111.11111111_2\\)</span>\$
Ramka rozgłoszeniowa jest bezwzględnie powielana przez przełączniki na wszystkie aktywne porty w obrębie danego VLAN-u.</li>
<li><strong>Adresy Multicast (Wieloodbiorcze):</strong>
<ul>
<li><strong>W sieciach IPv4:</strong> Pula adresów IP klasy D (<code>224.0.0.0</code> do <code>239.255.255.255</code>) jest mapowana na specjalny zakres adresów MAC: od <code>01:00:5E:00:00:00</code> do <code>01:00:5E:7F:FF:FF</code>.</li>
<li><strong>W sieciach IPv6:</strong> Wszystkie ramki multicastowe zaczynają się od prefiksu <code>33:33:xx:xx:xx:xx</code>.</li>
</ul></li>
</ol>
<hr />
<h2>4. Format ramki Ethernet II, tagowanie 802.1Q i suma kontrolna FCS</h2>
<p>W praktyce inżynierskiej standard <strong>Ethernet II (DIX)</strong> całkowicie wyparł ramki IEEE 802.3 z nagłówkiem LLC na potrzeby enkapsulacji pakietów internetowych (IPv4, IPv6, ARP).</p>
<pre><code class=\"language-plaintext\">+------------+--------+---------+---------+-----------+-----------------------+---------+
| Preambuła  | SFD    | Odbiorca| Nadawca | EtherType | Dane (Payload)        | FCS     |
| 7 Bajtów   | 1 Bajt | 6 Bajtów| 6 Bajtów| 2 Bajty   | Od 46 do 1500 Bajtów  | 4 Bajty |
+------------+--------+---------+---------+-----------+-----------------------+---------+
\\____________________/ \\________________________________________________________________/
  Warstwa fizyczna                  Właściwa ramka sieciowa (od 64 do 1518 bajtów)</code></pre>
<h3>Pola ramki Ethernet II krok po kroku</h3>
<ul>
<li><strong>Preambuła (7 bajtów):</strong> Ciąg 56 naprzemiennych bitów <code>10101010...</code>. Daje układowi odbiorczemu czas na zsynchronizowanie częstotliwości i fazy wewnętrznego generatora zegarowego z sygnałem przychodzącym.</li>
<li><strong>SFD (Start Frame Delimiter – 1 bajt):</strong> Wzorzec binarny <code>10101011</code>. Końcówka <code>11</code> jest sygnałem dla odbiornika: <em>„Koniec synchronizacji, następny bit to początek adresu docelowego!\"</em>.</li>
<li><strong>Adres docelowy (6 bajtów):</strong> Adres MAC stacji odbiorczej lub adres rozgłoszeniowy/multicast.</li>
<li><strong>Adres źródłowy (6 bajtów):</strong> Adres MAC nadawcy. Zawsze musi być adresem indywidualnym (Unicast – bit I/G = 0).</li>
<li><strong>EtherType (2 bajty):</strong> Liczba określająca typ danych zawartych w polu Payload. Wartość <span class=\"mathjax mathjax--inline\">\\(\\ge \\text{0x0600}\\)</span> (1536 dziesiętnie) oznacza kod protokołu.</li>
<li><strong>Dane użytkownika (Payload – 46 do 1500 bajtów):</strong> Enkapsulowany pakiet warstwy 3.
<ul>
<li>Wartość <strong>1500 bajtów</strong> definiuje standardowe <strong>MTU</strong> (<em>Maximum Transmission Unit</em>).</li>
<li><strong>Wymóg minimalnego rozmiaru:</strong> Pole danych musi zawierać co najmniej <strong>46 bajtów</strong>. Jeżeli przesyłany pakiet jest krótszy (np. nagłówek TCP SYN bez danych lub zapytanie ARP mające 28 bajtów), sterownik karty dołącza bity o wartości <code>0</code> (tzw. <strong>Padding / Dopełnienie</strong>), aby ramka bez preambuły osiągnęła minimalny rozmiar 64 bajtów.</li>
</ul></li>
<li><strong>FCS (Frame Check Sequence – 4 bajty):</strong> Sprzętowa suma kontrolna wyliczana algorytmem wielomianowym <strong>CRC-32</strong>.</li>
</ul>
<h3>Rozszerzenie ramki: Tagowanie VLAN (Standard IEEE 802.1Q)</h3>
<p>Gdy przełączniki przesyłają ruch z wielu wirtualnych sieci LAN przez wspólne łącze magistralne (<em>Trunk</em>), w strukturę ramki Ethernet II wstrzykiwany jest dodatkowy 4-bajtowy znacznik VLAN:</p>
<pre><code class=\"language-plaintext\">RAMKA ETHERNET II Z TAGIEM IEEE 802.1Q:
+----------+----------+-----------------------+-----------+------------------+---------+
| Odbiorca | Nadawca  | Tag 802.1Q            | EtherType | Dane             | FCS     |
| 6 Bajtów | 6 Bajtów | 4 Bajty (TPID + TCI)  | 2 Bajty   | 46 - 1500 Bajtów | 4 Bajty |
+----------+----------+-----------------------+-----------+------------------+---------+
                      \\_______________________/
                       * TPID (2B): Wartość 0x8100
                       * PCP (3 bity): Priorytet QoS (0-7)
                       * DEI (1 bit): Flaga dopuszczalności porzucenia
                       * VID (12 bitów): Identyfikator VLAN (zakres 1 - 4094)</code></pre>
<p>Z powodu obecności taga 802.1Q maksymalny rozmiar standardowej ramki na portach magistralnych wzrasta z <strong>1518 do 1522 bajtów</strong> (tzw. <em>Baby Giant Frame</em>).</p>
<h3>Matematyka sprawdzania integralności: Suma kontrolna CRC-32</h3>
<p>Suma kontrolna w polu FCS to cykliczny kod nadmiarowy. Nadawca traktuje cały strumień bitów ramki (od adresu docelowego do końca dopełnienia) jako współczynniki wielomianu <span class=\"mathjax mathjax--inline\">\\(M(x)\\)</span> i dzieli go modulo 2 przez znormalizowany wielomian generacyjny stopnia 32:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$G(x) = x^{32} + x^{26} + x^{23} + x^{22} + x^{16} + x^{12} + x^{11} + x^{10} + x^8 + x^7 + x^5 + x^4 + x^2 + x + 1\\)</span>\$</p>
<p>Reszta z tego dzielenia zostaje wpisana do 4-bajtowego pola FCS. Karta sieciowa odbiorcy wykonuje to samo dzielenie sprzętowo w locie. Jeżeli reszta wynosi zero, ramka jest uznawana za bezbłędną. W przeciwnym razie układ MAC natychmiast ją wyrzuca, zwiększając sprzętowy licznik błędów CRC.</p>
<hr />
<h1>Część 2: Medium współdzielone, mechanika CSMA/CD, fizyka kolizji i diagnostyka</h1>
<p>Przewodnik dydaktyczny po drugiej jednostce lekcyjnej. Obejmuje analizę medium współdzielonego, szczegółowe działanie algorytmu CSMA/CD, matematyczne wyprowadzenie minimalnego rozmiaru ramki 64 bajtów, algorytm Backoff, domeny kolizyjne oraz diagnostykę łącza w systemie Linux.</p>
<hr />
<h2>5. Medium współdzielone i zjawisko kolizji elektrycznej</h2>
<h3>Ewolucja fizyczna: od magistrali do koncentratora</h3>
<ul>
<li><strong>Wczesny Ethernet (10BASE5 / 10BASE2):</strong> Wszystkie stacje robocze były wpięte do jednego fizycznego kabla koncentrycznego o impedancji falowej <span class=\"mathjax mathjax--inline\">\\(50\\ \\Omega\\)</span>, zakończonego na obu końcach rezystorami dopasowującymi (terminatorami zapobiegającymi odbiciu fali).</li>
<li><strong>Ethernet na skrętce z koncentratorem (10BASE-T + HUB):</strong> Choć kable tworzyły fizyczną topologię gwiazdy, koncentrator (HUB) łączył wszystkie linie wewnętrznie. Koncentrator działa wyłącznie w <strong>1. warstwie (fizycznej)</strong> modelu OSI – powiela odebrany sygnał na wszystkie pozostałe porty.</li>
</ul>
<p>Z punktu widzenia logiki sieciowej oba rozwiązania stanowią <strong>medium współdzielone (Shared Medium)</strong> pracujące w trybie <strong>Half-Duplex</strong> (półdupleks).</p>
<pre><code class=\"language-plaintext\">WĘZEŁ A                                                     WĘZEŁ B
   |                                                           |
   +---&gt; Nadaje bity ramki...                                  +---&gt; Nadaje bity ramki...
   \\                                                           /
    \\                                                         /
     ======&gt; [ !!! ZDERZENIE FAL ELEKTRYCZNYCH: KOLIZJA !!! ] &lt;======</code></pre>
<h3>Fizyka kolizji sygnałów</h3>
<p>Kolizja nie oznacza zderzenia pakietów w sensie mechanicznym, lecz <strong>interferencję fal elektromagnetycznych</strong>:</p>
<ol>
<li>Gdy stacja A i stacja B zaczną emitować sygnał elektryczny w tym samym czasie, prądy w kablu sumują się.</li>
<li>Napięcie w linii przekracza dopuszczalny próg logiczny (w kablu koncentrycznym wzrasta ponad określony poziom napięcia stałego DC).</li>
<li>Odbiorniki stacji nie są w stanie zdekodować poziomów logicznych (następuje załamanie kodowania Manchester). Dane obu ramek zostają bezpowrotnie zniszczone.</li>
</ol>
<p>Aby w takim środowisku uniknąć paraliżu transmisyjnego, zaimplementowano algorytm <strong>CSMA/CD</strong> (<em>Carrier Sense Multiple Access with Collision Detection</em>).</p>
<hr />
<h2>6. Algorytm CSMA/CD i maszyna stanów kontrolera MAC</h2>
<p>Działanie algorytmu CSMA/CD można podzielić na trzy fazy logiczne: badanie medium przed transmisją, kontrola w trakcie nadawania oraz procedura pokolizyjna.</p>
<pre><code class=\"language-plaintext\">KROK 1: CARRIER SENSE (Badaj nośną)
   Węzeł ma gotową ramkę w buforze -&gt; sprawdza, czy medium jest wolne.
   Jeśli medium zajęte: czekaj i badaj ponownie.
   Jeśli medium wolne: przejdź do kroku 2.

KROK 2: ODCZEKAJ PRZERWĘ IFG (Interframe Gap = 96 bit-times)

KROK 3: ROZPOCZNIJ NADAWANIE RAMKI
   Nadawaj i jednocześnie monitoruj medium pod kątem kolizji.

   Brak anomalii  -&gt; ramka wysłana poprawnie -&gt; KONIEC.
   Wykryto kolizję -&gt; przejdź do kroku 4.

KROK 4: NADAJ SYGNAŁ JAM (wymuszony sygnał zakłócający, 32-48 bitów)

KROK 5: ZWIĘKSZ LICZNIK PRÓB (n = n + 1)
   Czy n &gt; 16 prób?
     TAK -&gt; BŁĄD KRYTYCZNY: porzuć ramkę (Excessive Collisions).
     NIE -&gt; przejdź do kroku 6.

KROK 6: ALGORYTM BACKOFF
   Wylosuj zwłokę r, odczekaj r * Slot Time, wróć do kroku 1.</code></pre>
<h3>Szczegółowa analiza kroków algorytmu:</h3>
<ol>
<li><strong>Carrier Sense (Badanie stanu nośnika):</strong> Karta sieciowa mierzy napięcie na przewodzie. Jeśli płynie prąd o częstotliwości nośnej, oznacza to, że inny komputer nadaje. Karta wstrzymuje nadawanie.</li>
<li>
<p><strong>Interframe Gap (Odstęp międzyramkowy – IFG):</strong> Nawet gdy linia jest wolna, stacja nie może rozpocząć nadawania w ułamku nanosekundy. Musi odczekać pauzę wynoszącą ściśle <strong>96 bit-times</strong>:</p>
<ul>
<li>Dla sieci Ethernet 10 Mb/s: <span class=\"mathjax mathjax--inline\">\\(\\text{IFG} = 9{,}6\\ \\mu\\text{s}\\)</span>.</li>
<li>Dla Fast Ethernet 100 Mb/s: <span class=\"mathjax mathjax--inline\">\\(\\text{IFG} = 960\\text{ ns}\\)</span>.</li>
<li>Dla Gigabit Ethernet 1000 Mb/s: <span class=\"mathjax mathjax--inline\">\\(\\text{IFG} = 96\\text{ ns}\\)</span>.</li>
</ul>
<p><em>Cel IFG:</em> Umożliwienie odbiornikom wyczyszczenia rejestrów przesuwnych, zresetowania buforów i powrotu do stanu równowagi elektrycznej.</p>
</li>
<li><strong>Collision Detection (Wykrywanie kolizji w locie):</strong> Stacja nadaje i jednocześnie pobiera próbki sygnału z medium. Porównuje to, co nadała, z tym, co odczytuje. Jeśli odczytany sygnał ma wyższą amplitudę niż sygnał emitowany, stacja stwierdza kolizję.</li>
<li>
<p><strong>Sygnał zagłuszający (JAM Signal):</strong> Po wykryciu kolizji nadajnik wysyła ciąg <strong>od 32 do 48 bitów</strong> celowego sygnału zakłócającego.</p>
<p><em>Dlaczego sygnał JAM jest niezbędny?</em> Jeśli kolizja nastąpi w ułamku mikrosekundy, szczątkowy sygnał mógłby zostać stłumiony przez pojemność kabla i stacje na drugim końcu magistrali mogłyby go nie zauważyć. Sygnał JAM celowo podtrzymuje stan awarii elektrycznej, dając pewność, że wszystkie węzły w sieci odrzucą uszkodzone fragmenty ramek.</p>
</li>
</ol>
<hr />
<h2>7. Fizyka sieci: Matematyczne wyprowadzenie minimalnego rozmiaru ramki 64B</h2>
<p>To jedno z najważniejszych zagadnień egzaminacyjnych i inżynieryjnych: dlaczego minimalny rozmiar ramki wynosi dokładnie <strong>64 bajty (512 bitów)</strong>?</p>
<h3>Zagrożenie: Kolizja spóźniona (Late Collision)</h3>
<p>Fala elektromagnetyczna porusza się w miedzi z prędkością propagacji <span class=\"mathjax mathjax--inline\">\\(V_p \\approx 200\\ 000\\text{ km/s}\\)</span> (ok. <span class=\"mathjax mathjax--inline\">\\(5\\text{ ns}\\)</span> na każdy 1 metr przewodu). Oznacza to, że sygnał nie dociera na drugi koniec sieci natychmiast.</p>
<p>Rozważmy najgorszy możliwy przypadek w dopuszczalnym segmencie sieci magistralnej:</p>
<pre><code class=\"language-plaintext\">STACJA A (Początek kabla)                                   STACJA B (Koniec kabla)
   |                                                                   |
(t = 0) Stacja A rozpoczyna nadawanie ramki...                         |
   |========== Fala sygnału leci przez kabel (Czas Tp) ==============&gt; |
   |                                                                   |
   |                                                  (t = Tp - epsilon)
   |                                                  Czoło fali jeszcze nie dotarło!
   |                                                  Stacja B bada kabel: \"Czysto!\"
   |                                                  Stacja B zaczyna nadawać!
   |                                                  BUM! KOLIZJA przy stacji B!
   |                                                                   |
   |&lt;========= Fala powypadkowa wraca przez kabel (Czas Tp) ===========+
   |
(t = 2 * Tp = RTT) Fala kolizyjna dociera z powrotem do stacji A!</code></pre>
<ol>
<li>W chwili <span class=\"mathjax mathjax--inline\">\\(t = 0\\)</span> Stacja A rozpoczyna nadawanie.</li>
<li>Sygnał potrzebuje czasu <span class=\"mathjax mathjax--inline\">\\(T_p\\)</span> na dotarcie do stacji B.</li>
<li>W chwili <span class=\"mathjax mathjax--inline\">\\(t = T_p - \\varepsilon\\)</span> (ułamek nanosekundy przed dotarciem fali ze stacji A) stacja B sprawdza stan linii. Ponieważ sygnał jeszcze nie dotarł, stacja B stwierdza, że linia jest wolna i rozpoczyna nadawanie.</li>
<li>Następuje kolizja. Sygnał powypadkowy musi teraz pokonać całą drogę powrotną od stacji B do stacji A (kolejny czas <span class=\"mathjax mathjax--inline\">\\(T_p\\)</span>).</li>
<li>Stacja A dowiaduje się o kolizji dopiero po czasie podwójnej propagacji (<strong>Round-Trip Time – RTT</strong>):
<span class=\"mathjax mathjax--inline\">\\(\$\\text{RTT} = 2 \\times T_p\\)</span>\$</li>
</ol>
<h3>Wyprowadzenie wzoru inżynieryjnego</h3>
<p>Aby stacja A mogła wykryć kolizję i podjąć sprzętową retransmisję w warstwie MAC, <strong>musi nadal fizycznie nadawać bity ramki w chwili, gdy zniekształcona fala powróci do jej nadajnika</strong>:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Czas nadawania ramki } (T_{\\text{tx}}) \\ge 2 \\times T_p \\quad (\\text{RTT})\\)</span>\$</p>
<p>Gdyby ramka była zbyt krótka (np. miała 16 bajtów):</p>
<ol>
<li>Stacja A zakończyłaby nadawanie przed upływem czasu RTT, wyczyściła bufor nadawczy i uznała ramkę za poprawnie dostarczoną.</li>
<li>Gdyby fala kolizyjna dotarła do stacji A po zakończeniu nadawania, kontroler MAC uznałby ją za błąd linii (szum) i nie ponowiłby transmisji. Doszłoby do zjawiska <strong>Late Collision</strong> (kolizji spóźnionej) i cichej utraty danych, naprawialnej dopiero po sekundach przez protokół TCP.</li>
</ol>
<h3>Obliczenia tablicowe (wartości dla standardu 10BASE5):</h3>
<p>W specyfikacji sieci 10 Mb/s o maksymalnej rozpiętości segmentów z uwzględnieniem regeneratorów (repeaterów) maksymalny czas podwójnego przejścia sygnału oszacowano na około <span class=\"mathjax mathjax--inline\">\\(45\\ \\mu\\text{s}\\)</span>. Wprowadzono bezpieczny margines projektowy, definiując <strong>czas szczeliny (Slot Time)</strong>:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Slot Time} = 51{,}2\\ \\mu\\text{s}\\)</span>\$</p>
<p>Obliczamy minimalną liczbę bitów, którą stacja o przepustowości 10 Mb/s musi wyemitować w czasie szczeliny:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$N_{\\text{bitów}} = \\text{Slot Time} \\times \\text{Prędkość} = 51{,}2\\ \\mu\\text{s} \\times 10\\ \\frac{\\text{Mb}}{\\text{s}} = 51{,}2 \\cdot 10^{-6}\\ \\text{s} \\times 10 \\cdot 10^6\\ \\frac{\\text{bitów}}{\\text{s}} = \\mathbf{512\\ \\text{bitów}}\\)</span>\$</p>
<p>Przeliczamy bity na bajty:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$Rozmiar_{\\text{min}} = \\frac{512\\ \\text{bitów}}{8\\ \\frac{\\text{bitów}}{\\text{bajt}}} = \\mathbf{64\\ \\text{bajty}}\\)</span>\$</p>
<p>Stąd wynika fundament specyfikacji Ethernet: <strong>żadna poprawna ramka nie może mieć mniej niż 64 bajty (wraz z nagłówkiem i sumą kontrolną FCS)</strong>.</p>
<hr />
<h2>8. Algorytm Backoff, domeny i diagnostyka laboratoryjna</h2>
<h3>Algorytm Truncated Binary Exponential Backoff (BEB)</h3>
<p>Po wykryciu kolizji stacje nie mogą ponowić nadawania w tym samym momencie. Czas oczekiwania przed kolejną próbą (<span class=\"mathjax mathjax--inline\">\\(T_{\\text{wait}}\\)</span>) wyliczany jest losowo:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$T_{\\text{wait}} = r \\times \\text{Slot Time} \\quad (r \\times 51{,}2\\ \\mu\\text{s})\\)</span>\$</p>
<p>Gdzie parametr <span class=\"mathjax mathjax--inline\">\\(r\\)</span> jest losowany ze zbioru liczb całkowitych:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$r \\in \\{ 0, 1, 2, \\dots, 2^k - 1 \\}, \\quad \\text{gdzie } k = \\min(n, 10)\\)</span>\$</p>
<p>Parametr <span class=\"mathjax mathjax--inline\">\\(n\\)</span> to numer kolejnej kolizji dla tej samej ramki:</p>
<ul>
<li><strong>Próba 1 (<span class=\"mathjax mathjax--inline\">\\(n=1\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=1 \\rightarrow r \\in \\{0, 1\\}\\)</span> (stacja czeka 0 lub <span class=\"mathjax mathjax--inline\">\\(51{,}2\\ \\mu\\text{s}\\)</span>).</li>
<li><strong>Próba 2 (<span class=\"mathjax mathjax--inline\">\\(n=2\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=2 \\rightarrow r \\in \\{0, 1, 2, 3\\}\\)</span> (maksymalnie <span class=\"mathjax mathjax--inline\">\\(153{,}6\\ \\mu\\text{s}\\)</span>).</li>
<li><strong>Próba 3 (<span class=\"mathjax mathjax--inline\">\\(n=3\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=3 \\rightarrow r \\in \\{0, \\dots, 7\\}\\)</span>.</li>
<li><strong>Próba 10 (<span class=\"mathjax mathjax--inline\">\\(n=10\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=10 \\rightarrow r \\in \\{0, \\dots, 1023\\}\\)</span> (czas zwłoki może wynieść aż <span class=\"mathjax mathjax--inline\">\\(\\approx 52{,}4\\text{ ms}\\)</span>).</li>
<li><strong>Próby 11–16:</strong> Wykładnik zostaje zamrożony na poziomie <span class=\"mathjax mathjax--inline\">\\(k=10\\)</span> (obcięcie – <em>Truncated</em>).</li>
<li><strong>Po 16 próbach:</strong> Kontroler MAC poddaje się, porzuca ramkę i zgłasza do jądra błąd krytyczny <code>Excessive Collisions</code>.</li>
</ul>
<h3>Zestawienie pojęć: Domena kolizyjna a domena rozgłoszeniowa</h3>
<table>
<thead>
<tr>
<th>Element sieci</th>
<th>Domena kolizyjna</th>
<th>Domena rozgłoszeniowa</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Definicja</strong></td>
<td>Obszar sieci, w którym jednoczesna transmisja powoduje zderzenie pakietów.</td>
<td>Obszar sieci, do którego dociera ramka broadcast (<code>FF:FF:FF:FF:FF:FF</code>).</td>
</tr>
<tr>
<td><strong>Koncentrator (HUB)</strong></td>
<td>Łączy wszystkie porty w jedną domenę kolizyjną.</td>
<td>Przekazuje broadcast na 100% portów.</td>
</tr>
<tr>
<td><strong>Przełącznik (SWITCH)</strong></td>
<td>Dzieli domeny kolizyjne — każdy port to odrębna domena.</td>
<td>Domyślnie nie dzieli broadcastu (wszystkie porty to jedna domena).</td>
</tr>
<tr>
<td><strong>Router</strong></td>
<td>Dzieli domeny kolizyjne.</td>
<td>Dzieli domeny rozgłoszeniowe (blokuje pakiety broadcast warstwy 2/3).</td>
</tr>
</tbody>
</table>
<h3>Zmierzch CSMA/CD: Przejście do Full-Duplex</h3>
<p>We współczesnych sieciach przełączanych (ze switchami) stacje łączą się dedykowanymi przewodami punkt-punkt.</p>
<ul>
<li>W skrętce miedzianej jedna para żył odpowiada za nadawanie (TX), a osobna para za odbiór (RX).</li>
<li>Stacja może transmitować i odbierać dane jednocześnie z pełną prędkością interfejsu (<strong>Full-Duplex</strong>).</li>
<li>Kolizje elektryczne są fizycznie niemożliwe.</li>
<li><strong>W trybie Full-Duplex algorytm CSMA/CD zostaje całkowicie wyłączony w mikrokodzie karty sieciowej!</strong></li>
</ul>
<h3>Diagnostyka łącza w systemie Linux</h3>
<p>Administrator sieci weryfikuje poprawność pracy warstwy łącza za pomocą narzędzi <code>ethtool</code>, <code>ip</code> oraz analizatora pakietów:</p>
<pre><code class=\"language-bash\"># 1. Sprawdzenie stanu autonegocjacji, wykrytej prędkości i trybu dupleksu
sudo ethtool enp0s3</code></pre>
<p>Przykładowy zrzut diagnostyczny:</p>
<pre><code class=\"language-text\">Settings for enp0s3:
    Supported ports: [ TP ]
    Speed: 1000Mb/s
    Duplex: Full               # Pełny dupleks - CSMA/CD jest nieaktywne!
    Auto-negotiation: on
    Link detected: yes</code></pre>
<pre><code class=\"language-bash\"># 2. Odczyt liczników błędów sprzętowych interfejsu sieciowego
ip -s link show dev enp0s3</code></pre>
<p>Kluczowe liczniki diagnostyczne:</p>
<ul>
<li><code>errors</code> – ramki z błędną sumą kontrolną CRC-32 (wskazuje na uszkodzenie mechaniczne kabla, złe zaciśnięcie wtyku RJ-45 lub zakłócenia elektromagnetyczne).</li>
<li><code>collsns</code> – liczba wykrytych kolizji. W sieci z przełącznikiem pracującej w Full-Duplex wartość ta <strong>musi bezwzględnie wynosić 0</strong>. Jeśli licznik rośnie, mamy do czynienia z błędem <strong>Duplex Mismatch</strong> (jedna strona została ustawiona na sztywno w Half-Duplex, a druga w Full-Duplex).</li>
<li><code>dropped</code> – pakiety odrzucone z powodu braku miejsca w buforze kolejki FIFO karty sieciowej (przeciążenie procesora lub zalew pakietów).</li>
</ul>
<pre><code class=\"language-bash\"># 3. Podgląd surowych nagłówków warstwy łącza danych (MAC docelowy, źródłowy, EtherType)
sudo tcpdump -i enp0s3 -e -nn -c 2</code></pre>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/05.lsk/02.warstwa-dostepowa-i-technologia-ethernet";
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
        return new Source("<h1>Część 1: Architektura warstwy łącza danych, adresacja EUI-48, ramkowanie i medium fizyczne</h1>
<p>Jednostka lekcyjna skupiająca się na logicznym podziale warstwy łącza danych, różnicach między modelem ISO/OSI a standardem IEEE 802, analizie bitowej adresu MAC oraz budowie ramki sieciowej.</p>
<hr />
<h2>1. Wprowadzenie i podział warstwy łącza danych (IEEE 802 vs OSI)</h2>
<h3>Ewolucja historyczna technologii</h3>
<ul>
<li><strong>1970 (ALOHANET):</strong> Norman Abramson na Uniwersytecie Hawajskim uruchamia pierwszą sieć radiową z losowym dostępem do medium. Wprowadza regułę: stacja nadaje pakiet od razu, a w przypadku braku potwierdzenia (kolizji) odczekuje losowy czas. Był to bezpośredni przodek algorytmów kolizyjnych.</li>
<li><strong>1973 (Xerox PARC):</strong> Robert Metcalfe i David Boggs adaptują koncepcję ALOHA do kabla koncentrycznego, tworząc eksperymentalny Ethernet o prędkości 2,94 Mb/s łączący komputery Xerox Alto z pierwszą drukarką laserową.</li>
<li><strong>1980 (Konsorcjum DIX):</strong> Firmy <em>Digital Equipment Corporation (DEC), Intel</em> oraz <em>Xerox</em> publikują otwartą specyfikację Ethernet 10 Mb/s (standard DIX Ethernet I, a w 1982 r. – Ethernet II).</li>
<li><strong>1983–1985 (IEEE 802.3):</strong> Komitet Standaryzacyjny IEEE formalizuje Ethernet jako międzynarodową normę techniczną IEEE 802.3.</li>
</ul>
<pre><code class=\"language-plaintext\">+---------------------------------------------------------------------------------------------------+
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
|  | Warstwa 2: Łącza danych     | &lt;=====&gt; | - Wspólny interfejs programowy dla warstwy 3        |  |
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
|  | Warstwa 1: Fizyczna         | &lt;=====&gt; | Warstwa Fizyczna (PHY - PCS, PMA, PMD)              |  |
|  | (Physical Layer)            |         | - Kodowanie sygnałów (Manchester, MLT-3, PAM-5)     |  |
|  |                             |         | - Transmisja bitów: 10BASE-T, 100BASE-TX, 1000BASE-T|  |
|  +-----------------------------+         +-----------------------------------------------------+  |
+---------------------------------------------------------------------------------------------------+</code></pre>
<h3>Dlaczego komitet IEEE podzielił drugą warstwę na LLC i MAC?</h3>
<p>W pierwotnym modelu OSI warstwa druga była jednolitym modułem. W realiach lat 80. zaczęły powstawać różnorodne standardy mediów fizycznych:</p>
<ul>
<li><strong>IEEE 802.3</strong> – Ethernet (magistrala kablowa).</li>
<li><strong>IEEE 802.4</strong> – Token Bus (magistrala ze znacznikiem).</li>
<li><strong>IEEE 802.5</strong> – Token Ring (topologia pierścienia IBM).</li>
<li><strong>IEEE 802.11</strong> – Wi-Fi (sieci bezprzewodowe).</li>
</ul>
<p>Gdyby warstwa 2 pozostała monolitem, programiści protokołów sieciowych (np. IP, IPX, AppleTalk) musieliby pisać dedykowany sterownik sieciowy pod każdy typ okablowania.</p>
<p>Dzięki podziałowi:</p>
<ol>
<li><strong>Podwarstwa LLC (IEEE 802.2)</strong> tworzy uniwersalny punkt styku. Dla protokołu IPv4 pobieranie i wysyłanie danych z karty sieciowej wygląda identycznie, niezależnie od tego, czy fizycznym nośnikiem jest skrętka miedziana kat. 6, światłowód jednomodowy czy fala radiowa Wi-Fi.</li>
<li><strong>Podwarstwa MAC (IEEE 802.3)</strong> realizuje zadania sprzętowe: dopasowanie do złączy, formowanie preambuły, obliczanie sumy kontrolnej i pilnowanie reguł transmisji w kablu.</li>
</ol>
<hr />
<h2>2. Podwarstwy LLC i MAC – szczegółowa analiza mechanizmów</h2>
<h3>Podwarstwa LLC (Logical Link Control – IEEE 802.2)</h3>
<p>Podwarstwa LLC odpowiada za logiczną wymianę danych między węzłami i realizuje trzy podstawowe tryby pracy:</p>
<ul>
<li><strong>Type 1 (Unacknowledged Connectionless):</strong> Tryb bezpołączeniowy i bezpotwierdzeniowy. Najprostszy i najszybszy; dominuje we współczesnych sieciach IP. Jeżeli ramka ulegnie uszkodzeniu, podwarstwa LLC ją ignoruje, a retransmisją zajmują się wyższe warstwy stosu (np. TCP).</li>
<li><strong>Type 2 (Connection-Oriented):</strong> Tryb połączeniowy z gwarancją dostarczenia, numeracją ramek i potwierdzeniami (ACK). Używany dawniej w sieciach SNA (IBM) i przemysłowych systemach sterowania.</li>
<li><strong>Type 3 (Acknowledged Connectionless):</strong> Tryb bezpołączeniowy, lecz z natychmiastowym potwierdzeniem odbioru na poziomie ramki. Stosowany w automatyce i systemach czasu rzeczywistego.</li>
</ul>
<h4>Punkty SAP (Service Access Points) i enkapsulacja SNAP</h4>
<p>Aby odbiorca wiedział, jakiej usłudze przekazać pakiet, nagłówek LLC definiuje 1-bajtowe pola:</p>
<ul>
<li><strong>DSAP</strong> (<em>Destination Service Access Point</em>) – punkt dostępu odbiorcy.</li>
<li><strong>SSAP</strong> (<em>Source Service Access Point</em>) – punkt dostępu nadawcy.</li>
</ul>
<p>Przykładowe historyczne wartości SAP:</p>
<ul>
<li><code>0x06</code> – Protokół IPv4.</li>
<li><code>0xE0</code> – Novell NetWare IPX.</li>
<li><code>0x42</code> – Protokół drzewa rozpinającego STP (Spanning Tree Protocol).</li>
</ul>
<pre><code class=\"language-plaintext\">NAGŁÓWEK LLC (IEEE 802.2):
+-------------------+-------------------+--------------------+
| DSAP (1 bajt)     | SSAP (1 bajt)     | Control (1 bajt)   |
+-------------------+-------------------+--------------------+

NAGŁÓWEK SNAP (Rozszerzenie dla DSAP/SSAP = 0xAA):
+-------------------+-------------------+--------------------+
| OUI (3 bajty)     | Protocol ID (2 B) | Dane (Payload)     |
+-------------------+-------------------+--------------------+</code></pre>
<p>Ponieważ pole SAP ma tylko 8 bitów (z czego bity najmniej znaczące pełnią funkcje flag kontrolnych, pozostawiając zaledwie kilkadziesiąt unikalnych identyfikatorów), wprowadzono rozszerzenie <strong>SNAP</strong> (<em>Subnetwork Access Protocol</em>). Gdy w polu DSAP i SSAP pojawi się wartość <code>0xAA</code>, za nagłówkiem LLC doklejany jest nagłówek SNAP. Zawiera on 3-bajtowy identyfikator producenta <strong>OUI</strong> oraz 2-bajtowy identyfikator protokołu, identyczny z polem EtherType.</p>
<h3>Podwarstwa MAC (Media Access Control – IEEE 802.3)</h3>
<p>Podwarstwa MAC jest implementowana sprzętowo bezpośrednio w chipsecie karty sieciowej (NIC). Realizuje cztery zadania:</p>
<ol>
<li><strong>Adresowanie fizyczne:</strong> Przypisywanie unikalnych adresów źródłowych i odczytywanie adresów docelowych.</li>
<li><strong>Kompilacja i dekompilacja ramek:</strong> Opatrywanie danych nagłówkiem, dopełnieniem (Padding) oraz wyliczanie sumy kontrolnej.</li>
<li><strong>Konwersja danych na ciąg szeregowy (Serializacja):</strong> Zamiana bajtów z magistrali komputera (PCIe) na ciąg bitów przesyłany do transceivera PHY za pośrednictwem interfejsu MII (<em>Media Independent Interface</em>).</li>
<li><strong>Zarządzanie dostępem do medium:</strong> Badanie stanu łącza i realizacja algorytmu CSMA/CD (w Half-Duplex) lub koordynacja niezależnych kolejek FIFO (w Full-Duplex).</li>
</ol>
<hr />
<h2>3. Adresacja fizyczna EUI-48 (Adres MAC)</h2>
<p>Adres fizyczny standardu <strong>EUI-48</strong> (<em>Extended Unique Identifier</em>) to <strong>48-bitowa liczba binarna (6 bajtów)</strong>.</p>
<pre><code class=\"language-plaintext\">+-----------------------------------------------------------------------------------+
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
+-----------------------------------------------------------------------------------+</code></pre>
<h3>Znaczenie bitów kontrolnych pierwszego bajtu</h3>
<p>Architektura EUI-48 rezerwuje dwa najmniej znaczące bity pierwszego bajtu (bity zerowy i pierwszy) na cele sterowania logiką transmisji:</p>
<pre><code class=\"language-plaintext\">Pierwszy bajt adresu MAC (Bajt 0):
[ b7 | b6 | b5 | b4 | b3 | b2 | b1 (U/L) | b0 (I/G) ]</code></pre>
<ul>
<li><strong>Bit 0 – I/G (Individual / Group):</strong>
<ul>
<li><code>0</code> = Adres indywidualny (<strong>Unicast</strong>). Identyfikuje dokładnie jedną fizyczną kartę sieciową w sieci lokalnej.</li>
<li><code>1</code> = Adres grupowy (<strong>Multicast</strong>) lub rozgłoszeniowy (<strong>Broadcast</strong>).</li>
</ul></li>
<li><strong>Bit 1 – U/L (Universal / Local):</strong>
<ul>
<li><code>0</code> = Adres zarządzany globalnie (<strong>Universal</strong>). Adres BIA (<em>Burned-In Address</em>) trwale wypalony w pamięci ROM karty przez producenta posiadającego oficjalny prefiks OUI.</li>
<li><code>1</code> = Adres zarządzany lokalnie (<strong>Locally Administered</strong>). Oznacza, że adres MAC został zmieniony programowo przez administratora (spoofing MAC) lub wygenerowany automatycznie przez maszynę wirtualną / kontener.</li>
</ul></li>
</ul>
<h3>Podział adresów ze względu na charakter transmisji</h3>
<ol>
<li><strong>Adresy Unicast:</strong> Skierowane do pojedynczej stacji. Przełącznik sieciowy przekazuje taką ramkę wyłącznie na jeden port na podstawie wpisu w tablicy MAC (CAM).</li>
<li><strong>Adres Broadcast:</strong> Wszystkie 48 bitów ma wartość <code>1</code>:
<span class=\"mathjax mathjax--inline\">\\(\$\\text{FF:FF:FF:FF:FF:FF} = 11111111.11111111.11111111.11111111.11111111.11111111_2\\)</span>\$
Ramka rozgłoszeniowa jest bezwzględnie powielana przez przełączniki na wszystkie aktywne porty w obrębie danego VLAN-u.</li>
<li><strong>Adresy Multicast (Wieloodbiorcze):</strong>
<ul>
<li><strong>W sieciach IPv4:</strong> Pula adresów IP klasy D (<code>224.0.0.0</code> do <code>239.255.255.255</code>) jest mapowana na specjalny zakres adresów MAC: od <code>01:00:5E:00:00:00</code> do <code>01:00:5E:7F:FF:FF</code>.</li>
<li><strong>W sieciach IPv6:</strong> Wszystkie ramki multicastowe zaczynają się od prefiksu <code>33:33:xx:xx:xx:xx</code>.</li>
</ul></li>
</ol>
<hr />
<h2>4. Format ramki Ethernet II, tagowanie 802.1Q i suma kontrolna FCS</h2>
<p>W praktyce inżynierskiej standard <strong>Ethernet II (DIX)</strong> całkowicie wyparł ramki IEEE 802.3 z nagłówkiem LLC na potrzeby enkapsulacji pakietów internetowych (IPv4, IPv6, ARP).</p>
<pre><code class=\"language-plaintext\">+------------+--------+---------+---------+-----------+-----------------------+---------+
| Preambuła  | SFD    | Odbiorca| Nadawca | EtherType | Dane (Payload)        | FCS     |
| 7 Bajtów   | 1 Bajt | 6 Bajtów| 6 Bajtów| 2 Bajty   | Od 46 do 1500 Bajtów  | 4 Bajty |
+------------+--------+---------+---------+-----------+-----------------------+---------+
\\____________________/ \\________________________________________________________________/
  Warstwa fizyczna                  Właściwa ramka sieciowa (od 64 do 1518 bajtów)</code></pre>
<h3>Pola ramki Ethernet II krok po kroku</h3>
<ul>
<li><strong>Preambuła (7 bajtów):</strong> Ciąg 56 naprzemiennych bitów <code>10101010...</code>. Daje układowi odbiorczemu czas na zsynchronizowanie częstotliwości i fazy wewnętrznego generatora zegarowego z sygnałem przychodzącym.</li>
<li><strong>SFD (Start Frame Delimiter – 1 bajt):</strong> Wzorzec binarny <code>10101011</code>. Końcówka <code>11</code> jest sygnałem dla odbiornika: <em>„Koniec synchronizacji, następny bit to początek adresu docelowego!\"</em>.</li>
<li><strong>Adres docelowy (6 bajtów):</strong> Adres MAC stacji odbiorczej lub adres rozgłoszeniowy/multicast.</li>
<li><strong>Adres źródłowy (6 bajtów):</strong> Adres MAC nadawcy. Zawsze musi być adresem indywidualnym (Unicast – bit I/G = 0).</li>
<li><strong>EtherType (2 bajty):</strong> Liczba określająca typ danych zawartych w polu Payload. Wartość <span class=\"mathjax mathjax--inline\">\\(\\ge \\text{0x0600}\\)</span> (1536 dziesiętnie) oznacza kod protokołu.</li>
<li><strong>Dane użytkownika (Payload – 46 do 1500 bajtów):</strong> Enkapsulowany pakiet warstwy 3.
<ul>
<li>Wartość <strong>1500 bajtów</strong> definiuje standardowe <strong>MTU</strong> (<em>Maximum Transmission Unit</em>).</li>
<li><strong>Wymóg minimalnego rozmiaru:</strong> Pole danych musi zawierać co najmniej <strong>46 bajtów</strong>. Jeżeli przesyłany pakiet jest krótszy (np. nagłówek TCP SYN bez danych lub zapytanie ARP mające 28 bajtów), sterownik karty dołącza bity o wartości <code>0</code> (tzw. <strong>Padding / Dopełnienie</strong>), aby ramka bez preambuły osiągnęła minimalny rozmiar 64 bajtów.</li>
</ul></li>
<li><strong>FCS (Frame Check Sequence – 4 bajty):</strong> Sprzętowa suma kontrolna wyliczana algorytmem wielomianowym <strong>CRC-32</strong>.</li>
</ul>
<h3>Rozszerzenie ramki: Tagowanie VLAN (Standard IEEE 802.1Q)</h3>
<p>Gdy przełączniki przesyłają ruch z wielu wirtualnych sieci LAN przez wspólne łącze magistralne (<em>Trunk</em>), w strukturę ramki Ethernet II wstrzykiwany jest dodatkowy 4-bajtowy znacznik VLAN:</p>
<pre><code class=\"language-plaintext\">RAMKA ETHERNET II Z TAGIEM IEEE 802.1Q:
+----------+----------+-----------------------+-----------+------------------+---------+
| Odbiorca | Nadawca  | Tag 802.1Q            | EtherType | Dane             | FCS     |
| 6 Bajtów | 6 Bajtów | 4 Bajty (TPID + TCI)  | 2 Bajty   | 46 - 1500 Bajtów | 4 Bajty |
+----------+----------+-----------------------+-----------+------------------+---------+
                      \\_______________________/
                       * TPID (2B): Wartość 0x8100
                       * PCP (3 bity): Priorytet QoS (0-7)
                       * DEI (1 bit): Flaga dopuszczalności porzucenia
                       * VID (12 bitów): Identyfikator VLAN (zakres 1 - 4094)</code></pre>
<p>Z powodu obecności taga 802.1Q maksymalny rozmiar standardowej ramki na portach magistralnych wzrasta z <strong>1518 do 1522 bajtów</strong> (tzw. <em>Baby Giant Frame</em>).</p>
<h3>Matematyka sprawdzania integralności: Suma kontrolna CRC-32</h3>
<p>Suma kontrolna w polu FCS to cykliczny kod nadmiarowy. Nadawca traktuje cały strumień bitów ramki (od adresu docelowego do końca dopełnienia) jako współczynniki wielomianu <span class=\"mathjax mathjax--inline\">\\(M(x)\\)</span> i dzieli go modulo 2 przez znormalizowany wielomian generacyjny stopnia 32:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$G(x) = x^{32} + x^{26} + x^{23} + x^{22} + x^{16} + x^{12} + x^{11} + x^{10} + x^8 + x^7 + x^5 + x^4 + x^2 + x + 1\\)</span>\$</p>
<p>Reszta z tego dzielenia zostaje wpisana do 4-bajtowego pola FCS. Karta sieciowa odbiorcy wykonuje to samo dzielenie sprzętowo w locie. Jeżeli reszta wynosi zero, ramka jest uznawana za bezbłędną. W przeciwnym razie układ MAC natychmiast ją wyrzuca, zwiększając sprzętowy licznik błędów CRC.</p>
<hr />
<h1>Część 2: Medium współdzielone, mechanika CSMA/CD, fizyka kolizji i diagnostyka</h1>
<p>Przewodnik dydaktyczny po drugiej jednostce lekcyjnej. Obejmuje analizę medium współdzielonego, szczegółowe działanie algorytmu CSMA/CD, matematyczne wyprowadzenie minimalnego rozmiaru ramki 64 bajtów, algorytm Backoff, domeny kolizyjne oraz diagnostykę łącza w systemie Linux.</p>
<hr />
<h2>5. Medium współdzielone i zjawisko kolizji elektrycznej</h2>
<h3>Ewolucja fizyczna: od magistrali do koncentratora</h3>
<ul>
<li><strong>Wczesny Ethernet (10BASE5 / 10BASE2):</strong> Wszystkie stacje robocze były wpięte do jednego fizycznego kabla koncentrycznego o impedancji falowej <span class=\"mathjax mathjax--inline\">\\(50\\ \\Omega\\)</span>, zakończonego na obu końcach rezystorami dopasowującymi (terminatorami zapobiegającymi odbiciu fali).</li>
<li><strong>Ethernet na skrętce z koncentratorem (10BASE-T + HUB):</strong> Choć kable tworzyły fizyczną topologię gwiazdy, koncentrator (HUB) łączył wszystkie linie wewnętrznie. Koncentrator działa wyłącznie w <strong>1. warstwie (fizycznej)</strong> modelu OSI – powiela odebrany sygnał na wszystkie pozostałe porty.</li>
</ul>
<p>Z punktu widzenia logiki sieciowej oba rozwiązania stanowią <strong>medium współdzielone (Shared Medium)</strong> pracujące w trybie <strong>Half-Duplex</strong> (półdupleks).</p>
<pre><code class=\"language-plaintext\">WĘZEŁ A                                                     WĘZEŁ B
   |                                                           |
   +---&gt; Nadaje bity ramki...                                  +---&gt; Nadaje bity ramki...
   \\                                                           /
    \\                                                         /
     ======&gt; [ !!! ZDERZENIE FAL ELEKTRYCZNYCH: KOLIZJA !!! ] &lt;======</code></pre>
<h3>Fizyka kolizji sygnałów</h3>
<p>Kolizja nie oznacza zderzenia pakietów w sensie mechanicznym, lecz <strong>interferencję fal elektromagnetycznych</strong>:</p>
<ol>
<li>Gdy stacja A i stacja B zaczną emitować sygnał elektryczny w tym samym czasie, prądy w kablu sumują się.</li>
<li>Napięcie w linii przekracza dopuszczalny próg logiczny (w kablu koncentrycznym wzrasta ponad określony poziom napięcia stałego DC).</li>
<li>Odbiorniki stacji nie są w stanie zdekodować poziomów logicznych (następuje załamanie kodowania Manchester). Dane obu ramek zostają bezpowrotnie zniszczone.</li>
</ol>
<p>Aby w takim środowisku uniknąć paraliżu transmisyjnego, zaimplementowano algorytm <strong>CSMA/CD</strong> (<em>Carrier Sense Multiple Access with Collision Detection</em>).</p>
<hr />
<h2>6. Algorytm CSMA/CD i maszyna stanów kontrolera MAC</h2>
<p>Działanie algorytmu CSMA/CD można podzielić na trzy fazy logiczne: badanie medium przed transmisją, kontrola w trakcie nadawania oraz procedura pokolizyjna.</p>
<pre><code class=\"language-plaintext\">KROK 1: CARRIER SENSE (Badaj nośną)
   Węzeł ma gotową ramkę w buforze -&gt; sprawdza, czy medium jest wolne.
   Jeśli medium zajęte: czekaj i badaj ponownie.
   Jeśli medium wolne: przejdź do kroku 2.

KROK 2: ODCZEKAJ PRZERWĘ IFG (Interframe Gap = 96 bit-times)

KROK 3: ROZPOCZNIJ NADAWANIE RAMKI
   Nadawaj i jednocześnie monitoruj medium pod kątem kolizji.

   Brak anomalii  -&gt; ramka wysłana poprawnie -&gt; KONIEC.
   Wykryto kolizję -&gt; przejdź do kroku 4.

KROK 4: NADAJ SYGNAŁ JAM (wymuszony sygnał zakłócający, 32-48 bitów)

KROK 5: ZWIĘKSZ LICZNIK PRÓB (n = n + 1)
   Czy n &gt; 16 prób?
     TAK -&gt; BŁĄD KRYTYCZNY: porzuć ramkę (Excessive Collisions).
     NIE -&gt; przejdź do kroku 6.

KROK 6: ALGORYTM BACKOFF
   Wylosuj zwłokę r, odczekaj r * Slot Time, wróć do kroku 1.</code></pre>
<h3>Szczegółowa analiza kroków algorytmu:</h3>
<ol>
<li><strong>Carrier Sense (Badanie stanu nośnika):</strong> Karta sieciowa mierzy napięcie na przewodzie. Jeśli płynie prąd o częstotliwości nośnej, oznacza to, że inny komputer nadaje. Karta wstrzymuje nadawanie.</li>
<li>
<p><strong>Interframe Gap (Odstęp międzyramkowy – IFG):</strong> Nawet gdy linia jest wolna, stacja nie może rozpocząć nadawania w ułamku nanosekundy. Musi odczekać pauzę wynoszącą ściśle <strong>96 bit-times</strong>:</p>
<ul>
<li>Dla sieci Ethernet 10 Mb/s: <span class=\"mathjax mathjax--inline\">\\(\\text{IFG} = 9{,}6\\ \\mu\\text{s}\\)</span>.</li>
<li>Dla Fast Ethernet 100 Mb/s: <span class=\"mathjax mathjax--inline\">\\(\\text{IFG} = 960\\text{ ns}\\)</span>.</li>
<li>Dla Gigabit Ethernet 1000 Mb/s: <span class=\"mathjax mathjax--inline\">\\(\\text{IFG} = 96\\text{ ns}\\)</span>.</li>
</ul>
<p><em>Cel IFG:</em> Umożliwienie odbiornikom wyczyszczenia rejestrów przesuwnych, zresetowania buforów i powrotu do stanu równowagi elektrycznej.</p>
</li>
<li><strong>Collision Detection (Wykrywanie kolizji w locie):</strong> Stacja nadaje i jednocześnie pobiera próbki sygnału z medium. Porównuje to, co nadała, z tym, co odczytuje. Jeśli odczytany sygnał ma wyższą amplitudę niż sygnał emitowany, stacja stwierdza kolizję.</li>
<li>
<p><strong>Sygnał zagłuszający (JAM Signal):</strong> Po wykryciu kolizji nadajnik wysyła ciąg <strong>od 32 do 48 bitów</strong> celowego sygnału zakłócającego.</p>
<p><em>Dlaczego sygnał JAM jest niezbędny?</em> Jeśli kolizja nastąpi w ułamku mikrosekundy, szczątkowy sygnał mógłby zostać stłumiony przez pojemność kabla i stacje na drugim końcu magistrali mogłyby go nie zauważyć. Sygnał JAM celowo podtrzymuje stan awarii elektrycznej, dając pewność, że wszystkie węzły w sieci odrzucą uszkodzone fragmenty ramek.</p>
</li>
</ol>
<hr />
<h2>7. Fizyka sieci: Matematyczne wyprowadzenie minimalnego rozmiaru ramki 64B</h2>
<p>To jedno z najważniejszych zagadnień egzaminacyjnych i inżynieryjnych: dlaczego minimalny rozmiar ramki wynosi dokładnie <strong>64 bajty (512 bitów)</strong>?</p>
<h3>Zagrożenie: Kolizja spóźniona (Late Collision)</h3>
<p>Fala elektromagnetyczna porusza się w miedzi z prędkością propagacji <span class=\"mathjax mathjax--inline\">\\(V_p \\approx 200\\ 000\\text{ km/s}\\)</span> (ok. <span class=\"mathjax mathjax--inline\">\\(5\\text{ ns}\\)</span> na każdy 1 metr przewodu). Oznacza to, że sygnał nie dociera na drugi koniec sieci natychmiast.</p>
<p>Rozważmy najgorszy możliwy przypadek w dopuszczalnym segmencie sieci magistralnej:</p>
<pre><code class=\"language-plaintext\">STACJA A (Początek kabla)                                   STACJA B (Koniec kabla)
   |                                                                   |
(t = 0) Stacja A rozpoczyna nadawanie ramki...                         |
   |========== Fala sygnału leci przez kabel (Czas Tp) ==============&gt; |
   |                                                                   |
   |                                                  (t = Tp - epsilon)
   |                                                  Czoło fali jeszcze nie dotarło!
   |                                                  Stacja B bada kabel: \"Czysto!\"
   |                                                  Stacja B zaczyna nadawać!
   |                                                  BUM! KOLIZJA przy stacji B!
   |                                                                   |
   |&lt;========= Fala powypadkowa wraca przez kabel (Czas Tp) ===========+
   |
(t = 2 * Tp = RTT) Fala kolizyjna dociera z powrotem do stacji A!</code></pre>
<ol>
<li>W chwili <span class=\"mathjax mathjax--inline\">\\(t = 0\\)</span> Stacja A rozpoczyna nadawanie.</li>
<li>Sygnał potrzebuje czasu <span class=\"mathjax mathjax--inline\">\\(T_p\\)</span> na dotarcie do stacji B.</li>
<li>W chwili <span class=\"mathjax mathjax--inline\">\\(t = T_p - \\varepsilon\\)</span> (ułamek nanosekundy przed dotarciem fali ze stacji A) stacja B sprawdza stan linii. Ponieważ sygnał jeszcze nie dotarł, stacja B stwierdza, że linia jest wolna i rozpoczyna nadawanie.</li>
<li>Następuje kolizja. Sygnał powypadkowy musi teraz pokonać całą drogę powrotną od stacji B do stacji A (kolejny czas <span class=\"mathjax mathjax--inline\">\\(T_p\\)</span>).</li>
<li>Stacja A dowiaduje się o kolizji dopiero po czasie podwójnej propagacji (<strong>Round-Trip Time – RTT</strong>):
<span class=\"mathjax mathjax--inline\">\\(\$\\text{RTT} = 2 \\times T_p\\)</span>\$</li>
</ol>
<h3>Wyprowadzenie wzoru inżynieryjnego</h3>
<p>Aby stacja A mogła wykryć kolizję i podjąć sprzętową retransmisję w warstwie MAC, <strong>musi nadal fizycznie nadawać bity ramki w chwili, gdy zniekształcona fala powróci do jej nadajnika</strong>:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Czas nadawania ramki } (T_{\\text{tx}}) \\ge 2 \\times T_p \\quad (\\text{RTT})\\)</span>\$</p>
<p>Gdyby ramka była zbyt krótka (np. miała 16 bajtów):</p>
<ol>
<li>Stacja A zakończyłaby nadawanie przed upływem czasu RTT, wyczyściła bufor nadawczy i uznała ramkę za poprawnie dostarczoną.</li>
<li>Gdyby fala kolizyjna dotarła do stacji A po zakończeniu nadawania, kontroler MAC uznałby ją za błąd linii (szum) i nie ponowiłby transmisji. Doszłoby do zjawiska <strong>Late Collision</strong> (kolizji spóźnionej) i cichej utraty danych, naprawialnej dopiero po sekundach przez protokół TCP.</li>
</ol>
<h3>Obliczenia tablicowe (wartości dla standardu 10BASE5):</h3>
<p>W specyfikacji sieci 10 Mb/s o maksymalnej rozpiętości segmentów z uwzględnieniem regeneratorów (repeaterów) maksymalny czas podwójnego przejścia sygnału oszacowano na około <span class=\"mathjax mathjax--inline\">\\(45\\ \\mu\\text{s}\\)</span>. Wprowadzono bezpieczny margines projektowy, definiując <strong>czas szczeliny (Slot Time)</strong>:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$\\text{Slot Time} = 51{,}2\\ \\mu\\text{s}\\)</span>\$</p>
<p>Obliczamy minimalną liczbę bitów, którą stacja o przepustowości 10 Mb/s musi wyemitować w czasie szczeliny:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$N_{\\text{bitów}} = \\text{Slot Time} \\times \\text{Prędkość} = 51{,}2\\ \\mu\\text{s} \\times 10\\ \\frac{\\text{Mb}}{\\text{s}} = 51{,}2 \\cdot 10^{-6}\\ \\text{s} \\times 10 \\cdot 10^6\\ \\frac{\\text{bitów}}{\\text{s}} = \\mathbf{512\\ \\text{bitów}}\\)</span>\$</p>
<p>Przeliczamy bity na bajty:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$Rozmiar_{\\text{min}} = \\frac{512\\ \\text{bitów}}{8\\ \\frac{\\text{bitów}}{\\text{bajt}}} = \\mathbf{64\\ \\text{bajty}}\\)</span>\$</p>
<p>Stąd wynika fundament specyfikacji Ethernet: <strong>żadna poprawna ramka nie może mieć mniej niż 64 bajty (wraz z nagłówkiem i sumą kontrolną FCS)</strong>.</p>
<hr />
<h2>8. Algorytm Backoff, domeny i diagnostyka laboratoryjna</h2>
<h3>Algorytm Truncated Binary Exponential Backoff (BEB)</h3>
<p>Po wykryciu kolizji stacje nie mogą ponowić nadawania w tym samym momencie. Czas oczekiwania przed kolejną próbą (<span class=\"mathjax mathjax--inline\">\\(T_{\\text{wait}}\\)</span>) wyliczany jest losowo:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$T_{\\text{wait}} = r \\times \\text{Slot Time} \\quad (r \\times 51{,}2\\ \\mu\\text{s})\\)</span>\$</p>
<p>Gdzie parametr <span class=\"mathjax mathjax--inline\">\\(r\\)</span> jest losowany ze zbioru liczb całkowitych:</p>
<p><span class=\"mathjax mathjax--inline\">\\(\$r \\in \\{ 0, 1, 2, \\dots, 2^k - 1 \\}, \\quad \\text{gdzie } k = \\min(n, 10)\\)</span>\$</p>
<p>Parametr <span class=\"mathjax mathjax--inline\">\\(n\\)</span> to numer kolejnej kolizji dla tej samej ramki:</p>
<ul>
<li><strong>Próba 1 (<span class=\"mathjax mathjax--inline\">\\(n=1\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=1 \\rightarrow r \\in \\{0, 1\\}\\)</span> (stacja czeka 0 lub <span class=\"mathjax mathjax--inline\">\\(51{,}2\\ \\mu\\text{s}\\)</span>).</li>
<li><strong>Próba 2 (<span class=\"mathjax mathjax--inline\">\\(n=2\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=2 \\rightarrow r \\in \\{0, 1, 2, 3\\}\\)</span> (maksymalnie <span class=\"mathjax mathjax--inline\">\\(153{,}6\\ \\mu\\text{s}\\)</span>).</li>
<li><strong>Próba 3 (<span class=\"mathjax mathjax--inline\">\\(n=3\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=3 \\rightarrow r \\in \\{0, \\dots, 7\\}\\)</span>.</li>
<li><strong>Próba 10 (<span class=\"mathjax mathjax--inline\">\\(n=10\\)</span>):</strong> <span class=\"mathjax mathjax--inline\">\\(k=10 \\rightarrow r \\in \\{0, \\dots, 1023\\}\\)</span> (czas zwłoki może wynieść aż <span class=\"mathjax mathjax--inline\">\\(\\approx 52{,}4\\text{ ms}\\)</span>).</li>
<li><strong>Próby 11–16:</strong> Wykładnik zostaje zamrożony na poziomie <span class=\"mathjax mathjax--inline\">\\(k=10\\)</span> (obcięcie – <em>Truncated</em>).</li>
<li><strong>Po 16 próbach:</strong> Kontroler MAC poddaje się, porzuca ramkę i zgłasza do jądra błąd krytyczny <code>Excessive Collisions</code>.</li>
</ul>
<h3>Zestawienie pojęć: Domena kolizyjna a domena rozgłoszeniowa</h3>
<table>
<thead>
<tr>
<th>Element sieci</th>
<th>Domena kolizyjna</th>
<th>Domena rozgłoszeniowa</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Definicja</strong></td>
<td>Obszar sieci, w którym jednoczesna transmisja powoduje zderzenie pakietów.</td>
<td>Obszar sieci, do którego dociera ramka broadcast (<code>FF:FF:FF:FF:FF:FF</code>).</td>
</tr>
<tr>
<td><strong>Koncentrator (HUB)</strong></td>
<td>Łączy wszystkie porty w jedną domenę kolizyjną.</td>
<td>Przekazuje broadcast na 100% portów.</td>
</tr>
<tr>
<td><strong>Przełącznik (SWITCH)</strong></td>
<td>Dzieli domeny kolizyjne — każdy port to odrębna domena.</td>
<td>Domyślnie nie dzieli broadcastu (wszystkie porty to jedna domena).</td>
</tr>
<tr>
<td><strong>Router</strong></td>
<td>Dzieli domeny kolizyjne.</td>
<td>Dzieli domeny rozgłoszeniowe (blokuje pakiety broadcast warstwy 2/3).</td>
</tr>
</tbody>
</table>
<h3>Zmierzch CSMA/CD: Przejście do Full-Duplex</h3>
<p>We współczesnych sieciach przełączanych (ze switchami) stacje łączą się dedykowanymi przewodami punkt-punkt.</p>
<ul>
<li>W skrętce miedzianej jedna para żył odpowiada za nadawanie (TX), a osobna para za odbiór (RX).</li>
<li>Stacja może transmitować i odbierać dane jednocześnie z pełną prędkością interfejsu (<strong>Full-Duplex</strong>).</li>
<li>Kolizje elektryczne są fizycznie niemożliwe.</li>
<li><strong>W trybie Full-Duplex algorytm CSMA/CD zostaje całkowicie wyłączony w mikrokodzie karty sieciowej!</strong></li>
</ul>
<h3>Diagnostyka łącza w systemie Linux</h3>
<p>Administrator sieci weryfikuje poprawność pracy warstwy łącza za pomocą narzędzi <code>ethtool</code>, <code>ip</code> oraz analizatora pakietów:</p>
<pre><code class=\"language-bash\"># 1. Sprawdzenie stanu autonegocjacji, wykrytej prędkości i trybu dupleksu
sudo ethtool enp0s3</code></pre>
<p>Przykładowy zrzut diagnostyczny:</p>
<pre><code class=\"language-text\">Settings for enp0s3:
    Supported ports: [ TP ]
    Speed: 1000Mb/s
    Duplex: Full               # Pełny dupleks - CSMA/CD jest nieaktywne!
    Auto-negotiation: on
    Link detected: yes</code></pre>
<pre><code class=\"language-bash\"># 2. Odczyt liczników błędów sprzętowych interfejsu sieciowego
ip -s link show dev enp0s3</code></pre>
<p>Kluczowe liczniki diagnostyczne:</p>
<ul>
<li><code>errors</code> – ramki z błędną sumą kontrolną CRC-32 (wskazuje na uszkodzenie mechaniczne kabla, złe zaciśnięcie wtyku RJ-45 lub zakłócenia elektromagnetyczne).</li>
<li><code>collsns</code> – liczba wykrytych kolizji. W sieci z przełącznikiem pracującej w Full-Duplex wartość ta <strong>musi bezwzględnie wynosić 0</strong>. Jeśli licznik rośnie, mamy do czynienia z błędem <strong>Duplex Mismatch</strong> (jedna strona została ustawiona na sztywno w Half-Duplex, a druga w Full-Duplex).</li>
<li><code>dropped</code> – pakiety odrzucone z powodu braku miejsca w buforze kolejki FIFO karty sieciowej (przeciążenie procesora lub zalew pakietów).</li>
</ul>
<pre><code class=\"language-bash\"># 3. Podgląd surowych nagłówków warstwy łącza danych (MAC docelowy, źródłowy, EtherType)
sudo tcpdump -i enp0s3 -e -nn -c 2</code></pre>", "@Page:/var/www/html/user/pages/05.lsk/02.warstwa-dostepowa-i-technologia-ethernet", "");
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
