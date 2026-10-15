---
title: 'Wstęp do lokalnych sieci komputerowych (LAN)'
published: true

---

## Wprowadzenie
Lokalne sieci komputerowe — **LAN (Local Area Network)** — stanowią fundament współczesnej infrastruktury IT. To właśnie w sieciach LAN pracują stacje robocze, serwery, drukarki sieciowe, urządzenia IoT, systemy monitoringu oraz aplikacje biznesowe. Sieć lokalna umożliwia szybkie i bezpieczne przesyłanie danych na ograniczonym obszarze: w domu, biurze, szkole, magazynie czy kampusie firmowym.

## Czym jest sieć LAN?

Sieć LAN to zestaw urządzeń komputerowych połączonych ze sobą w ograniczonej przestrzeni geograficznej — najczęściej do kilkuset metrów lub w obrębie kilku sąsiadujących budynków.

Infrastruktura LAN zapewnia:
* **Wysoką przepustowość:** 1–10 Gb/s (w nowoczesnych instalacjach szkieletowych nawet 25–100 Gb/s).
* **Niskie opóźnienia (*latency*):** często poniżej 1 ms.
* **Pełną kontrolę:** bezpośrednie zarządzanie infrastrukturą przez administratora.
* **Współdzielenie zasobów:** scentralizowany dostęp do plików, usług i urządzeń peryferyjnych.

*LAN stanowi przeciwieństwo sieci rozległych (WAN), które łączą odległe geograficznie ośrodki i bazują na infrastrukturze zewnętrznych operatorów telekomunikacyjnych.*

## Kluczowe cechy sieci LAN

* **Ograniczony zasięg geograficzny:** pojedynczy pokój, budynek, szkoła lub zamknięty kampus.
* **Wysoka wydajność:** optymalne środowisko do transferu dużych wolumenów danych, obsługi baz danych oraz aplikacji czasu rzeczywistego.
* **Autonomia zarządzania:** administrator w pełni kontroluje adresację IP, polityki bezpieczeństwa oraz segmentację ruchu.
* **Ekonomia wdrożenia:** niski koszt budowy i eksploatacji w zestawieniu z dzierżawionymi łączami rozległymi.
* **Skalowalność:** szybkie i bezproblemowe dołączanie kolejnych węzłów końcowych.

## Elementy składowe sieci LAN

* **Urządzenia końcowe (*hosts*):** komputery stacjonarne, laptopy, stacje robocze, drukarki sieciowe, smartfony, kamery IP.
* **Przełączniki (*switches*):** kluczowe komponenty dystrybucyjne, odpowiedzialne za komutację ramek w warstwie 2 (łącza danych).
* **Routery:** urządzenia brzegowe realizujące trasowanie pakietów w warstwie 3, łączące sieć lokalną z Internetem lub innymi podsieciami.
* **Punkty dostępowe (*Access Points – AP*):** moduły radiowe rozszerzające sieć przewodową o łączność bezprzewodową Wi-Fi.
* **Medium transmisyjne:** miedziana skrętka komputerowa (Cat 5e, Cat 6, Cat 6A) ze złączami RJ-45 lub kable światłowodowe (jedno- i wielomodowe).
* **Karty sieciowe (*NIC*):** interfejsy fizyczne umożliwiające komunikację sprzętu z medium transmisyjnym.
* **Usługi sieciowe:** oprogramowanie systemowe i serwerowe realizujące podstawowe funkcje infrastrukturalne (DHCP, DNS, serwery plików).

## Topologie sieci LAN

Topologia określa architekturę geometryczną oraz sposób fizycznego połączenia urządzeń w sieci.

| Topologia | Architektura | Zalety | Wady |
| :--- | :--- | :--- | :--- |
| **Gwiazda (*Star*)** | Urządzenia podłączone do wspólnego, centralnego węzła (przełącznika). | Uszkodzenie pojedynczego kabla wyłącza tylko jedno urządzenie; prosta diagnostyka. | Awaria węzła centralnego (switcha) unieruchamia cały segment. |
| **Magistrala (*Bus*)** | Wszystkie stacje współdzielą jedną wspólną linię transmisyjną zakończoną terminatorami. | Niskie zużycie kabla, prosta konstrukcja historyczna. | Duża podatność na kolizje; przerwanie kabla głównego unieruchamia całą magistralę. |
| **Pierścień (*Ring*)** | Urządzenia spięte w pętlę zamkniętą; dane krążą sekwencyjnie w jednym kierunku. | Przewidywalny czas dostępu do medium, brak kolizji przy zastosowaniu znacznika (*token*). | Awaria pojedynczego węzła powoduje przerwę w transmisji w całym obwodzie. |
| **Drzewo (*Tree*)** | Hierarchiczne rozwinięcie gwiazdy z nadrzędnymi przełącznikami rdzeniowymi. | Bardzo dobra skalowalność, ułatwiona segmentacja logiczna na podsieci. | Złożona struktura okablowania; awaria switcha wyższego rzędu odcina podległe gałęzie. |
| **Siatka (*Mesh*)** | Węzły połączone wielopunktowo ze zwielokrotnionymi trasami zapasowymi. | Najwyższa odporność na awarie dzięki redundancji ścieżek transmisyjnych. | Znaczny koszt instalacji, wysoki stopień skomplikowania konfiguracji. |

## Modele referencyjne i protokoły sieciowe

Komunikacja w sieciach LAN opiera się na warstwowych modelach referencyjnych:

* **Model ISO/OSI (7 warstw):**
  1. Warstwa fizyczna (*Physical*)
  2. Warstwa łącza danych (*Data Link*)
  3. Warstwa sieciowa (*Network*)
  4. Warstwa transportowa (*Transport*)
  5. Warstwa sesji (*Session*)
  6. Warstwa prezentacji (*Presentation*)
  7. Warstwa aplikacji (*Application*)
* **Model TCP/IP (4 warstwy):**
  1. Warstwa dostępu do sieci (*Network Access*)
  2. Warstwa Internetu (*Internet*)
  3. Warstwa transportowa (*Transport*)
  4. Warstwa aplikacji (*Application*)

### Kluczowe protokoły infrastruktury LAN
* **ARP (*Address Resolution Protocol*):** odwzorowuje logiczne adresy IPv4 na fizyczne adresy sprzętowe MAC.
* **DHCP (*Dynamic Host Configuration Protocol*):** automatycznie przydziela konfigurację sieciową (IP, maska, brama, DNS) urządzeniom klienckim.
* **DNS (*Domain Name System*):** translacja przyjaznych nazw domenowych na docelowe adresy IP.
* **ICMP (*Internet Control Message Protocol*):** protokół diagnostyczny i kontrolny wykorzystywany przez narzędzia `ping` i `traceroute`.
* **HTTP / HTTPS:** protokoły warstwy aplikacji służące do transmisji danych aplikacji webowych.

## Technologie transmisji w sieciach LAN

* **Ethernet (standard IEEE 802.3):** podstawowy standard sieci przewodowych. Wykorzystuje komutację pakietów, miedziane kable symetryczne (skrętkę) oraz światłowody. Oferuje prędkości od 1 Gb/s do 100 Gb/s.
* **Wi-Fi (standard IEEE 802.11):** łączność bezprzewodowa w pasmach 2.4 GHz, 5 GHz oraz 6 GHz (standardy Wi-Fi 5 / 802.11ac, Wi-Fi 6 / 802.11ax, Wi-Fi 7 / 802.11be).
* **Token Ring & FDDI (standardy historyczne):** sieci z przekazywaniem żetonu, zrealizowane odpowiednio na miedzi lub światłowodach (FDDI), współcześnie wyparte przez technologię Switched Ethernet.

## Bezpieczeństwo sieci lokalnej

Stacje robocze i przełączniki w LAN są bezpośrednio narażone na ataki w przypadku uzyskania przez intruza fizycznego lub radiowego dostępu do medium:

* **Wirtualne sieci LAN (VLAN – IEEE 802.1Q):** logiczna segmentacja sieci fizycznej na odrębne domeny rozgłoszeniowe w celu separacji działów, urządzeń IoT czy serwerów.
* **Listy kontroli dostępu (ACL):** filtry pakietów na poziomie routerów i przełączników warstwy L3 blokujące nieuprawniony ruch między segmentami.
* **Standard 802.1X / RADIUS:** uwierzytelnianie użytkowników i urządzeń na poziomie portu przełącznika przed dopuszczeniem do sieci.
* **Audyt i monitoring:** stała analiza przepływów danych (NetFlow/sFlow, Syslog) oraz systemy wykrywania intruzów (IDS/IPS).
* **Aktualizacje oprogramowania układowego (*firmware*):** eliminacja podatności w przełącznikach, punktach dostępowych i routerach brzegowych.

## Podsumowanie

Zrozumienie działania sieci LAN — od warstwy fizycznej okablowania, przez komutację w warstwie 2, po adresację logiczną i mechanizmy bezpieczeństwa — stanowi bazę pod dalsze zagadnienia administracyjne: konfigurację trasowania, zarządzanie zaporami sieciowymi oraz budowę tuneli VPN.