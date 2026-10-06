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

/* @Page:/var/www/html/user/pages/05.lsk/01.wstep-do-lokalnych-sieci-komputerowych-lan */
class __TwigTemplate_2279ac2a62600aadb83b62c57c29e40b_sourced extends Template
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
        yield "<p>Lokalne sieci komputerowe — <strong>LAN (Local Area Network)</strong> — stanowią fundament współczesnej infrastruktury IT. To właśnie w sieciach LAN pracują stacje robocze, serwery, drukarki sieciowe, urządzenia IoT, systemy monitoringu oraz aplikacje biznesowe. Sieć lokalna umożliwia szybkie i bezpieczne przesyłanie danych na ograniczonym obszarze: w domu, biurze, szkole, magazynie czy kampusie firmowym.</p>
<h2>Czym jest sieć LAN?</h2>
<p>Sieć LAN to zestaw urządzeń komputerowych połączonych ze sobą w ograniczonej przestrzeni geograficznej — najczęściej do kilkuset metrów lub w obrębie kilku sąsiadujących budynków.</p>
<p>Infrastruktura LAN zapewnia:</p>
<ul>
<li><strong>Wysoką przepustowość:</strong> 1–10 Gb/s (w nowoczesnych instalacjach szkieletowych nawet 25–100 Gb/s).</li>
<li><strong>Niskie opóźnienia (<em>latency</em>):</strong> często poniżej 1 ms.</li>
<li><strong>Pełną kontrolę:</strong> bezpośrednie zarządzanie infrastrukturą przez administratora.</li>
<li><strong>Współdzielenie zasobów:</strong> scentralizowany dostęp do plików, usług i urządzeń peryferyjnych.</li>
</ul>
<p><em>LAN stanowi przeciwieństwo sieci rozległych (WAN), które łączą odległe geograficznie ośrodki i bazują na infrastrukturze zewnętrznych operatorów telekomunikacyjnych.</em></p>
<h2>Kluczowe cechy sieci LAN</h2>
<ul>
<li><strong>Ograniczony zasięg geograficzny:</strong> pojedynczy pokój, budynek, szkoła lub zamknięty kampus.</li>
<li><strong>Wysoka wydajność:</strong> optymalne środowisko do transferu dużych wolumenów danych, obsługi baz danych oraz aplikacji czasu rzeczywistego.</li>
<li><strong>Autonomia zarządzania:</strong> administrator w pełni kontroluje adresację IP, polityki bezpieczeństwa oraz segmentację ruchu.</li>
<li><strong>Ekonomia wdrożenia:</strong> niski koszt budowy i eksploatacji w zestawieniu z dzierżawionymi łączami rozległymi.</li>
<li><strong>Skalowalność:</strong> szybkie i bezproblemowe dołączanie kolejnych węzłów końcowych.</li>
</ul>
<h2>Elementy składowe sieci LAN</h2>
<ul>
<li><strong>Urządzenia końcowe (<em>hosts</em>):</strong> komputery stacjonarne, laptopy, stacje robocze, drukarki sieciowe, smartfony, kamery IP.</li>
<li><strong>Przełączniki (<em>switches</em>):</strong> kluczowe komponenty dystrybucyjne, odpowiedzialne za komutację ramek w warstwie 2 (łącza danych).</li>
<li><strong>Routery:</strong> urządzenia brzegowe realizujące trasowanie pakietów w warstwie 3, łączące sieć lokalną z Internetem lub innymi podsieciami.</li>
<li><strong>Punkty dostępowe (<em>Access Points – AP</em>):</strong> moduły radiowe rozszerzające sieć przewodową o łączność bezprzewodową Wi-Fi.</li>
<li><strong>Medium transmisyjne:</strong> miedziana skrętka komputerowa (Cat 5e, Cat 6, Cat 6A) ze złączami RJ-45 lub kable światłowodowe (jedno- i wielomodowe).</li>
<li><strong>Karty sieciowe (<em>NIC</em>):</strong> interfejsy fizyczne umożliwiające komunikację sprzętu z medium transmisyjnym.</li>
<li><strong>Usługi sieciowe:</strong> oprogramowanie systemowe i serwerowe realizujące podstawowe funkcje infrastrukturalne (DHCP, DNS, serwery plików).</li>
</ul>
<h2>Topologie sieci LAN</h2>
<p>Topologia określa architekturę geometryczną oraz sposób fizycznego połączenia urządzeń w sieci.</p>
<table>
<thead>
<tr>
<th style=\"text-align: left;\">Topologia</th>
<th style=\"text-align: left;\">Architektura</th>
<th style=\"text-align: left;\">Zalety</th>
<th style=\"text-align: left;\">Wady</th>
</tr>
</thead>
<tbody>
<tr>
<td style=\"text-align: left;\"><strong>Gwiazda (<em>Star</em>)</strong></td>
<td style=\"text-align: left;\">Urządzenia podłączone do wspólnego, centralnego węzła (przełącznika).</td>
<td style=\"text-align: left;\">Uszkodzenie pojedynczego kabla wyłącza tylko jedno urządzenie; prosta diagnostyka.</td>
<td style=\"text-align: left;\">Awaria węzła centralnego (switcha) unieruchamia cały segment.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Magistrala (<em>Bus</em>)</strong></td>
<td style=\"text-align: left;\">Wszystkie stacje współdzielą jedną wspólną linię transmisyjną zakończoną terminatorami.</td>
<td style=\"text-align: left;\">Niskie zużycie kabla, prosta konstrukcja historyczna.</td>
<td style=\"text-align: left;\">Duża podatność na kolizje; przerwanie kabla głównego unieruchamia całą magistralę.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Pierścień (<em>Ring</em>)</strong></td>
<td style=\"text-align: left;\">Urządzenia spięte w pętlę zamkniętą; dane krążą sekwencyjnie w jednym kierunku.</td>
<td style=\"text-align: left;\">Przewidywalny czas dostępu do medium, brak kolizji przy zastosowaniu znacznika (<em>token</em>).</td>
<td style=\"text-align: left;\">Awaria pojedynczego węzła powoduje przerwę w transmisji w całym obwodzie.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Drzewo (<em>Tree</em>)</strong></td>
<td style=\"text-align: left;\">Hierarchiczne rozwinięcie gwiazdy z nadrzędnymi przełącznikami rdzeniowymi.</td>
<td style=\"text-align: left;\">Bardzo dobra skalowalność, ułatwiona segmentacja logiczna na podsieci.</td>
<td style=\"text-align: left;\">Złożona struktura okablowania; awaria switcha wyższego rzędu odcina podległe gałęzie.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Siatka (<em>Mesh</em>)</strong></td>
<td style=\"text-align: left;\">Węzły połączone wielopunktowo ze zwielokrotnionymi trasami zapasowymi.</td>
<td style=\"text-align: left;\">Najwyższa odporność na awarie dzięki redundancji ścieżek transmisyjnych.</td>
<td style=\"text-align: left;\">Znaczny koszt instalacji, wysoki stopień skomplikowania konfiguracji.</td>
</tr>
</tbody>
</table>
<h2>Modele referencyjne i protokoły sieciowe</h2>
<p>Komunikacja w sieciach LAN opiera się na warstwowych modelach referencyjnych:</p>
<ul>
<li><strong>Model ISO/OSI (7 warstw):</strong>
<ol>
<li>Warstwa fizyczna (<em>Physical</em>)</li>
<li>Warstwa łącza danych (<em>Data Link</em>)</li>
<li>Warstwa sieciowa (<em>Network</em>)</li>
<li>Warstwa transportowa (<em>Transport</em>)</li>
<li>Warstwa sesji (<em>Session</em>)</li>
<li>Warstwa prezentacji (<em>Presentation</em>)</li>
<li>Warstwa aplikacji (<em>Application</em>)</li>
</ol></li>
<li><strong>Model TCP/IP (4 warstwy):</strong>
<ol>
<li>Warstwa dostępu do sieci (<em>Network Access</em>)</li>
<li>Warstwa Internetu (<em>Internet</em>)</li>
<li>Warstwa transportowa (<em>Transport</em>)</li>
<li>Warstwa aplikacji (<em>Application</em>)</li>
</ol></li>
</ul>
<h3>Kluczowe protokoły infrastruktury LAN</h3>
<ul>
<li><strong>ARP (<em>Address Resolution Protocol</em>):</strong> odwzorowuje logiczne adresy IPv4 na fizyczne adresy sprzętowe MAC.</li>
<li><strong>DHCP (<em>Dynamic Host Configuration Protocol</em>):</strong> automatycznie przydziela konfigurację sieciową (IP, maska, brama, DNS) urządzeniom klienckim.</li>
<li><strong>DNS (<em>Domain Name System</em>):</strong> translacja przyjaznych nazw domenowych na docelowe adresy IP.</li>
<li><strong>ICMP (<em>Internet Control Message Protocol</em>):</strong> protokół diagnostyczny i kontrolny wykorzystywany przez narzędzia <code>ping</code> i <code>traceroute</code>.</li>
<li><strong>HTTP / HTTPS:</strong> protokoły warstwy aplikacji służące do transmisji danych aplikacji webowych.</li>
</ul>
<h2>Technologie transmisji w sieciach LAN</h2>
<ul>
<li><strong>Ethernet (standard IEEE 802.3):</strong> podstawowy standard sieci przewodowych. Wykorzystuje komutację pakietów, miedziane kable symetryczne (skrętkę) oraz światłowody. Oferuje prędkości od 1 Gb/s do 100 Gb/s.</li>
<li><strong>Wi-Fi (standard IEEE 802.11):</strong> łączność bezprzewodowa w pasmach 2.4 GHz, 5 GHz oraz 6 GHz (standardy Wi-Fi 5 / 802.11ac, Wi-Fi 6 / 802.11ax, Wi-Fi 7 / 802.11be).</li>
<li><strong>Token Ring &amp; FDDI (standardy historyczne):</strong> sieci z przekazywaniem żetonu, zrealizowane odpowiednio na miedzi lub światłowodach (FDDI), współcześnie wyparte przez technologię Switched Ethernet.</li>
</ul>
<h2>Bezpieczeństwo sieci lokalnej</h2>
<p>Stacje robocze i przełączniki w LAN są bezpośrednio narażone na ataki w przypadku uzyskania przez intruza fizycznego lub radiowego dostępu do medium:</p>
<ul>
<li><strong>Wirtualne sieci LAN (VLAN – IEEE 802.1Q):</strong> logiczna segmentacja sieci fizycznej na odrębne domeny rozgłoszeniowe w celu separacji działów, urządzeń IoT czy serwerów.</li>
<li><strong>Listy kontroli dostępu (ACL):</strong> filtry pakietów na poziomie routerów i przełączników warstwy L3 blokujące nieuprawniony ruch między segmentami.</li>
<li><strong>Standard 802.1X / RADIUS:</strong> uwierzytelnianie użytkowników i urządzeń na poziomie portu przełącznika przed dopuszczeniem do sieci.</li>
<li><strong>Audyt i monitoring:</strong> stała analiza przepływów danych (NetFlow/sFlow, Syslog) oraz systemy wykrywania intruzów (IDS/IPS).</li>
<li><strong>Aktualizacje oprogramowania układowego (<em>firmware</em>):</strong> eliminacja podatności w przełącznikach, punktach dostępowych i routerach brzegowych.</li>
</ul>
<h2>Podsumowanie</h2>
<p>Zrozumienie działania sieci LAN — od warstwy fizycznej okablowania, przez komutację w warstwie 2, po adresację logiczną i mechanizmy bezpieczeństwa — stanowi bazę pod dalsze zagadnienia administracyjne: konfigurację trasowania, zarządzanie zaporami sieciowymi oraz budowę tuneli VPN.</p>";
        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@Page:/var/www/html/user/pages/05.lsk/01.wstep-do-lokalnych-sieci-komputerowych-lan";
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
        return new Source("<p>Lokalne sieci komputerowe — <strong>LAN (Local Area Network)</strong> — stanowią fundament współczesnej infrastruktury IT. To właśnie w sieciach LAN pracują stacje robocze, serwery, drukarki sieciowe, urządzenia IoT, systemy monitoringu oraz aplikacje biznesowe. Sieć lokalna umożliwia szybkie i bezpieczne przesyłanie danych na ograniczonym obszarze: w domu, biurze, szkole, magazynie czy kampusie firmowym.</p>
<h2>Czym jest sieć LAN?</h2>
<p>Sieć LAN to zestaw urządzeń komputerowych połączonych ze sobą w ograniczonej przestrzeni geograficznej — najczęściej do kilkuset metrów lub w obrębie kilku sąsiadujących budynków.</p>
<p>Infrastruktura LAN zapewnia:</p>
<ul>
<li><strong>Wysoką przepustowość:</strong> 1–10 Gb/s (w nowoczesnych instalacjach szkieletowych nawet 25–100 Gb/s).</li>
<li><strong>Niskie opóźnienia (<em>latency</em>):</strong> często poniżej 1 ms.</li>
<li><strong>Pełną kontrolę:</strong> bezpośrednie zarządzanie infrastrukturą przez administratora.</li>
<li><strong>Współdzielenie zasobów:</strong> scentralizowany dostęp do plików, usług i urządzeń peryferyjnych.</li>
</ul>
<p><em>LAN stanowi przeciwieństwo sieci rozległych (WAN), które łączą odległe geograficznie ośrodki i bazują na infrastrukturze zewnętrznych operatorów telekomunikacyjnych.</em></p>
<h2>Kluczowe cechy sieci LAN</h2>
<ul>
<li><strong>Ograniczony zasięg geograficzny:</strong> pojedynczy pokój, budynek, szkoła lub zamknięty kampus.</li>
<li><strong>Wysoka wydajność:</strong> optymalne środowisko do transferu dużych wolumenów danych, obsługi baz danych oraz aplikacji czasu rzeczywistego.</li>
<li><strong>Autonomia zarządzania:</strong> administrator w pełni kontroluje adresację IP, polityki bezpieczeństwa oraz segmentację ruchu.</li>
<li><strong>Ekonomia wdrożenia:</strong> niski koszt budowy i eksploatacji w zestawieniu z dzierżawionymi łączami rozległymi.</li>
<li><strong>Skalowalność:</strong> szybkie i bezproblemowe dołączanie kolejnych węzłów końcowych.</li>
</ul>
<h2>Elementy składowe sieci LAN</h2>
<ul>
<li><strong>Urządzenia końcowe (<em>hosts</em>):</strong> komputery stacjonarne, laptopy, stacje robocze, drukarki sieciowe, smartfony, kamery IP.</li>
<li><strong>Przełączniki (<em>switches</em>):</strong> kluczowe komponenty dystrybucyjne, odpowiedzialne za komutację ramek w warstwie 2 (łącza danych).</li>
<li><strong>Routery:</strong> urządzenia brzegowe realizujące trasowanie pakietów w warstwie 3, łączące sieć lokalną z Internetem lub innymi podsieciami.</li>
<li><strong>Punkty dostępowe (<em>Access Points – AP</em>):</strong> moduły radiowe rozszerzające sieć przewodową o łączność bezprzewodową Wi-Fi.</li>
<li><strong>Medium transmisyjne:</strong> miedziana skrętka komputerowa (Cat 5e, Cat 6, Cat 6A) ze złączami RJ-45 lub kable światłowodowe (jedno- i wielomodowe).</li>
<li><strong>Karty sieciowe (<em>NIC</em>):</strong> interfejsy fizyczne umożliwiające komunikację sprzętu z medium transmisyjnym.</li>
<li><strong>Usługi sieciowe:</strong> oprogramowanie systemowe i serwerowe realizujące podstawowe funkcje infrastrukturalne (DHCP, DNS, serwery plików).</li>
</ul>
<h2>Topologie sieci LAN</h2>
<p>Topologia określa architekturę geometryczną oraz sposób fizycznego połączenia urządzeń w sieci.</p>
<table>
<thead>
<tr>
<th style=\"text-align: left;\">Topologia</th>
<th style=\"text-align: left;\">Architektura</th>
<th style=\"text-align: left;\">Zalety</th>
<th style=\"text-align: left;\">Wady</th>
</tr>
</thead>
<tbody>
<tr>
<td style=\"text-align: left;\"><strong>Gwiazda (<em>Star</em>)</strong></td>
<td style=\"text-align: left;\">Urządzenia podłączone do wspólnego, centralnego węzła (przełącznika).</td>
<td style=\"text-align: left;\">Uszkodzenie pojedynczego kabla wyłącza tylko jedno urządzenie; prosta diagnostyka.</td>
<td style=\"text-align: left;\">Awaria węzła centralnego (switcha) unieruchamia cały segment.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Magistrala (<em>Bus</em>)</strong></td>
<td style=\"text-align: left;\">Wszystkie stacje współdzielą jedną wspólną linię transmisyjną zakończoną terminatorami.</td>
<td style=\"text-align: left;\">Niskie zużycie kabla, prosta konstrukcja historyczna.</td>
<td style=\"text-align: left;\">Duża podatność na kolizje; przerwanie kabla głównego unieruchamia całą magistralę.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Pierścień (<em>Ring</em>)</strong></td>
<td style=\"text-align: left;\">Urządzenia spięte w pętlę zamkniętą; dane krążą sekwencyjnie w jednym kierunku.</td>
<td style=\"text-align: left;\">Przewidywalny czas dostępu do medium, brak kolizji przy zastosowaniu znacznika (<em>token</em>).</td>
<td style=\"text-align: left;\">Awaria pojedynczego węzła powoduje przerwę w transmisji w całym obwodzie.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Drzewo (<em>Tree</em>)</strong></td>
<td style=\"text-align: left;\">Hierarchiczne rozwinięcie gwiazdy z nadrzędnymi przełącznikami rdzeniowymi.</td>
<td style=\"text-align: left;\">Bardzo dobra skalowalność, ułatwiona segmentacja logiczna na podsieci.</td>
<td style=\"text-align: left;\">Złożona struktura okablowania; awaria switcha wyższego rzędu odcina podległe gałęzie.</td>
</tr>
<tr>
<td style=\"text-align: left;\"><strong>Siatka (<em>Mesh</em>)</strong></td>
<td style=\"text-align: left;\">Węzły połączone wielopunktowo ze zwielokrotnionymi trasami zapasowymi.</td>
<td style=\"text-align: left;\">Najwyższa odporność na awarie dzięki redundancji ścieżek transmisyjnych.</td>
<td style=\"text-align: left;\">Znaczny koszt instalacji, wysoki stopień skomplikowania konfiguracji.</td>
</tr>
</tbody>
</table>
<h2>Modele referencyjne i protokoły sieciowe</h2>
<p>Komunikacja w sieciach LAN opiera się na warstwowych modelach referencyjnych:</p>
<ul>
<li><strong>Model ISO/OSI (7 warstw):</strong>
<ol>
<li>Warstwa fizyczna (<em>Physical</em>)</li>
<li>Warstwa łącza danych (<em>Data Link</em>)</li>
<li>Warstwa sieciowa (<em>Network</em>)</li>
<li>Warstwa transportowa (<em>Transport</em>)</li>
<li>Warstwa sesji (<em>Session</em>)</li>
<li>Warstwa prezentacji (<em>Presentation</em>)</li>
<li>Warstwa aplikacji (<em>Application</em>)</li>
</ol></li>
<li><strong>Model TCP/IP (4 warstwy):</strong>
<ol>
<li>Warstwa dostępu do sieci (<em>Network Access</em>)</li>
<li>Warstwa Internetu (<em>Internet</em>)</li>
<li>Warstwa transportowa (<em>Transport</em>)</li>
<li>Warstwa aplikacji (<em>Application</em>)</li>
</ol></li>
</ul>
<h3>Kluczowe protokoły infrastruktury LAN</h3>
<ul>
<li><strong>ARP (<em>Address Resolution Protocol</em>):</strong> odwzorowuje logiczne adresy IPv4 na fizyczne adresy sprzętowe MAC.</li>
<li><strong>DHCP (<em>Dynamic Host Configuration Protocol</em>):</strong> automatycznie przydziela konfigurację sieciową (IP, maska, brama, DNS) urządzeniom klienckim.</li>
<li><strong>DNS (<em>Domain Name System</em>):</strong> translacja przyjaznych nazw domenowych na docelowe adresy IP.</li>
<li><strong>ICMP (<em>Internet Control Message Protocol</em>):</strong> protokół diagnostyczny i kontrolny wykorzystywany przez narzędzia <code>ping</code> i <code>traceroute</code>.</li>
<li><strong>HTTP / HTTPS:</strong> protokoły warstwy aplikacji służące do transmisji danych aplikacji webowych.</li>
</ul>
<h2>Technologie transmisji w sieciach LAN</h2>
<ul>
<li><strong>Ethernet (standard IEEE 802.3):</strong> podstawowy standard sieci przewodowych. Wykorzystuje komutację pakietów, miedziane kable symetryczne (skrętkę) oraz światłowody. Oferuje prędkości od 1 Gb/s do 100 Gb/s.</li>
<li><strong>Wi-Fi (standard IEEE 802.11):</strong> łączność bezprzewodowa w pasmach 2.4 GHz, 5 GHz oraz 6 GHz (standardy Wi-Fi 5 / 802.11ac, Wi-Fi 6 / 802.11ax, Wi-Fi 7 / 802.11be).</li>
<li><strong>Token Ring &amp; FDDI (standardy historyczne):</strong> sieci z przekazywaniem żetonu, zrealizowane odpowiednio na miedzi lub światłowodach (FDDI), współcześnie wyparte przez technologię Switched Ethernet.</li>
</ul>
<h2>Bezpieczeństwo sieci lokalnej</h2>
<p>Stacje robocze i przełączniki w LAN są bezpośrednio narażone na ataki w przypadku uzyskania przez intruza fizycznego lub radiowego dostępu do medium:</p>
<ul>
<li><strong>Wirtualne sieci LAN (VLAN – IEEE 802.1Q):</strong> logiczna segmentacja sieci fizycznej na odrębne domeny rozgłoszeniowe w celu separacji działów, urządzeń IoT czy serwerów.</li>
<li><strong>Listy kontroli dostępu (ACL):</strong> filtry pakietów na poziomie routerów i przełączników warstwy L3 blokujące nieuprawniony ruch między segmentami.</li>
<li><strong>Standard 802.1X / RADIUS:</strong> uwierzytelnianie użytkowników i urządzeń na poziomie portu przełącznika przed dopuszczeniem do sieci.</li>
<li><strong>Audyt i monitoring:</strong> stała analiza przepływów danych (NetFlow/sFlow, Syslog) oraz systemy wykrywania intruzów (IDS/IPS).</li>
<li><strong>Aktualizacje oprogramowania układowego (<em>firmware</em>):</strong> eliminacja podatności w przełącznikach, punktach dostępowych i routerach brzegowych.</li>
</ul>
<h2>Podsumowanie</h2>
<p>Zrozumienie działania sieci LAN — od warstwy fizycznej okablowania, przez komutację w warstwie 2, po adresację logiczną i mechanizmy bezpieczeństwa — stanowi bazę pod dalsze zagadnienia administracyjne: konfigurację trasowania, zarządzanie zaporami sieciowymi oraz budowę tuneli VPN.</p>", "@Page:/var/www/html/user/pages/05.lsk/01.wstep-do-lokalnych-sieci-komputerowych-lan", "");
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
