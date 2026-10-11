---
title: 'REST, GraphQL czy gRPC? Jak wybrać styl API do integracji systemów'
date: '11-10-2026 21:30'
published: true
taxonomy:
    category:
        - 'Inżynieria oprogramowania'
        - API
        - REST
        - GraphQL
        - gRPC
        - 'integracja systemów'
        - architektura
---

Prawie każdy współczesny system informatyczny rozmawia z innymi systemami: aplikacja mobilna z serwerem, sklep internetowy z systemem magazynowym, moduł płatności z księgowością. Sposób, w jaki te rozmowy są zorganizowane, nazywamy interfejsem API, a wybór jego stylu należy do najważniejszych decyzji w projekcie. Trzy najczęściej spotykane podejścia to REST, GraphQL i gRPC. Każde z nich rozwiązuje trochę inny problem i żadne nie jest „najlepsze" w oderwaniu od kontekstu.

===

## Po co w ogóle wybierać styl API?

Interfejs API jest **kontraktem** między dwoma stronami: tym, kto udostępnia dane lub usługę (dostawcą), i tym, kto z niej korzysta (klientem). Kontrakt określa, jakie operacje są dostępne, w jakiej formie przesyłamy dane, jak zgłaszamy błędy i jak zmieniać interfejs, nie psując cudzych aplikacji.

Zła decyzja kosztuje, bo API trudno zmienić po tym, jak zaczną z niego korzystać inne zespoły lub firmy. Zmiana formatu odpowiedzi w jednym miejscu może oznaczać poprawki w kilkunastu aplikacjach. Dlatego warto zrozumieć, jakie założenia kryją się za każdym stylem, zanim napiszemy pierwszą linijkę kodu.

W dalszej części porównamy trzy style pod kątem sposobu działania, mocnych i słabych stron oraz typowych zastosowań. Na końcu znajdziesz tabelę porównawczą i prostą ściągę wyboru.

## REST: uniwersalny standard internetu

**REST** (Representational State Transfer) to styl architektury opisany przez Roya Fieldinga w jego pracy doktorskiej z 2000 roku. Nie jest protokołem ani normą, tylko zbiorem zasad, które w praktyce realizujemy na bazie protokołu HTTP.

### Najważniejsze zasady

- **Zasoby zamiast operacji.** Projektujemy interfejs wokół rzeczy (zamówienie, klient, produkt), a nie czynności. Adres `/zamowienia/42` wskazuje zamówienie nr 42.
- **Metody HTTP mają znaczenie.** `GET` pobiera dane, `POST` tworzy nowy zasób, `PUT` zastępuje go w całości, `PATCH` zmienia go częściowo, a `DELETE` usuwa.
- **Bezstanowość.** Każde żądanie zawiera komplet informacji potrzebnych do jego obsługi. Serwer nie pamięta, co klient robił wcześniej, dzięki czemu łatwo skalować system przez dodawanie kolejnych serwerów.
- **Kody odpowiedzi.** Wynik komunikujemy standardowymi kodami: `200 OK`, `201 Created`, `204 No Content`, `400 Bad Request`, `401 Unauthorized`, `403 Forbidden`, `404 Not Found`, `409 Conflict`, `422 Unprocessable Content`, `429 Too Many Requests` czy `500 Internal Server Error`.
- **Pamięć podręczna.** Odpowiedzi na `GET` można buforować, co jest ogromną zaletą przy dużym ruchu.

### Przykład

Pobranie zamówienia i dodanie nowej pozycji może wyglądać tak:

```http
GET /api/v1/zamowienia/42 HTTP/1.1
Accept: application/json

HTTP/1.1 200 OK
Content-Type: application/json

{
  "id": 42,
  "klientId": 7,
  "status": "oplacone",
  "pozycje": [
    { "produktId": 101, "ilosc": 2, "cena": 49.90 }
  ]
}
```

```http
POST /api/v1/zamowienia/42/pozycje HTTP/1.1
Content-Type: application/json

{ "produktId": 205, "ilosc": 1 }

HTTP/1.1 201 Created
Location: /api/v1/zamowienia/42/pozycje/2
```

### Mocne strony

REST jest **znany prawie każdemu programiście**, działa w każdej przeglądarce, w każdym języku i na każdym narzędziu (`curl`, Postman, biblioteki HTTP). Dobrze współpracuje z infrastrukturą internetu: serwerami proxy, sieciami CDN i zaporami. Jest czytelny dla człowieka, więc łatwo go debugować. Dzięki specyfikacji **OpenAPI** (dawniej Swagger) można go opisać w pliku, z którego generuje się dokumentację, a nawet kod klienta.

### Słabe strony

Największym problemem jest dopasowanie ilości danych do potrzeb klienta. Gdy endpoint zwraca zbyt wiele pól, mówimy o **over-fetchingu**: aplikacja mobilna pobiera cały obiekt klienta, choć potrzebuje tylko imienia. Gdy zbyt mało, mamy **under-fetching** i klient musi wysłać kolejne żądania, np. najpierw po zamówienie, potem po klienta, potem po produkty. Każde z nich to dodatkowy czas oczekiwania.

REST nie wymusza też ścisłego typowania. Jeśli kontrakt nie jest opisany i pilnowany, odpowiedzi serwera mogą się „rozjechać" z oczekiwaniami klienta. Wreszcie wersjonowanie (`/v1`, `/v2`) wymaga dyscypliny, bo stare wersje trzeba utrzymywać tak długo, jak ktoś z nich korzysta.

## GraphQL: klient zamawia dokładnie to, czego potrzebuje

**GraphQL** powstał w Facebooku około 2012 roku, a jako otwarta specyfikacja ukazał się w 2015. Powstał z konkretnego problemu: aplikacje mobilne na wolnych łączach potrzebowały pobierać dokładnie określone dane w jednym żądaniu.

### Jak to działa

Zamiast wielu adresów mamy zazwyczaj **jeden endpoint** (np. `/graphql`) i **schemat** opisujący typy danych oraz relacje między nimi. Klient przesyła zapytanie, w którym wymienia dokładnie pola, jakie chce otrzymać:

```graphql
query {
  zamowienie(id: 42) {
    status
    klient {
      imie
    }
    pozycje {
      ilosc
      produkt {
        nazwa
        cena
      }
    }
  }
}
```

Odpowiedź ma kształt identyczny jak zapytanie: serwer zwraca tylko wskazane pola, w jednym żądaniu, razem z powiązanymi obiektami. Operacje dzielą się na trzy rodzaje: **query** (odczyt), **mutation** (zmiana danych) i **subscription** (subskrypcja zdarzeń w czasie rzeczywistym).

Schemat jest silnie typowany. Opisuje się go w języku SDL:

```graphql
type Zamowienie {
  id: ID!
  status: String!
  klient: Klient!
  pozycje: [Pozycja!]!
}
```

Wykrzyknik oznacza, że pole nie może być puste. Dzięki schematowi narzędzia potrafią podpowiadać składnię, walidować zapytania i generować dokumentację.

### Mocne strony

GraphQL **eliminuje over-fetching i under-fetching**, bo klient sam decyduje o kształcie odpowiedzi. Zespół frontendowy może dodawać nowe widoki bez czekania, aż backend przygotuje specjalny endpoint. Schemat jest zawsze aktualną dokumentacją, a interfejs można rozwijać ewolucyjnie: nowe pola dodaje się bez numerów wersji, a stare oznacza jako przestarzałe (`@deprecated`).

### Słabe strony

- **Buforowanie jest trudniejsze.** Skoro wszystko trafia na jeden adres, mechanizmy HTTP (np. cache po adresie URL) działają słabo. Pomagają „zapytania zapisane" (persisted queries) i buforowanie po stronie klienta, ale wymaga to dodatkowej pracy.
- **Problem N+1.** Naiwna implementacja dla listy 100 zamówień wykona 100 osobnych zapytań o klientów do bazy danych. Rozwiązaniem są narzędzia grupujące zapytania, np. wzorzec *DataLoader*.
- **Ryzyko nadużyć.** Klient może wysłać bardzo głębokie lub kosztowne zapytanie. Trzeba ograniczać głębokość, złożoność i czas wykonania.
- **Obsługa błędów jest inna.** Serwer często odpowiada kodem `200 OK`, a błędy umieszcza w polu `errors` w treści odpowiedzi. Prosty monitoring oparty na kodach HTTP przestaje wtedy wystarczać.
- **Większa złożoność serwera.** Zbudowanie dobrego serwera GraphQL wymaga więcej pracy niż prostego REST-a.

## gRPC: szybkie wywołania między usługami

**gRPC** to framework wywołań zdalnych (RPC) opracowany w Google i udostępniony jako otwarte oprogramowanie w 2015 roku. Idea jest odmienna od poprzednich: zamiast „pobierz zasób" mówimy „wywołaj funkcję na zdalnym serwerze", i wygląda to prawie jak zwykłe wywołanie metody.

### Jak to działa

Kontrakt zapisujemy w pliku `.proto` w formacie **Protocol Buffers**:

```protobuf
syntax = "proto3";

service ZamowieniaService {
  rpc PobierzZamowienie (PobierzRequest) returns (Zamowienie);
  rpc SledzStatus (PobierzRequest) returns (stream StatusZamowienia);
}

message PobierzRequest {
  int64 id = 1;
}

message Zamowienie {
  int64 id = 1;
  string status = 2;
  int64 klient_id = 3;
}
```

Z takiego pliku specjalny kompilator (`protoc`) **generuje kod** klienta i serwera w wielu językach, m.in. w Javie, Pythonie, Go, C#, C++ czy JavaScripcie. Programista wywołuje wygenerowaną metodę, a biblioteka zajmuje się serializacją, wysyłką i odbiorem.

Pod spodem gRPC używa protokołu **HTTP/2** i kodowania **binarnego**. Dzięki temu wiadomości są mniejsze niż w JSON, a połączenia efektywniej wykorzystywane (wiele żądań w jednym połączeniu). gRPC obsługuje cztery rodzaje wywołań: pojedyncze (*unary*), strumieniowanie z serwera, strumieniowanie od klienta i strumieniowanie dwukierunkowe.

### Mocne strony

gRPC jest **bardzo wydajne**, wymusza **ścisły kontrakt** i zapewnia **bezpieczeństwo typów** już w czasie kompilacji. Wbudowane są terminy wykonania (*deadlines*), anulowanie wywołań i strumieniowanie, co ułatwia budowę komunikacji między usługami w architekturze mikroserwisowej. Kompatybilność wstecz kontroluje się numerami pól: dodanie nowego pola z nowym numerem nie psuje starych klientów. Jedyna reguła, której nie wolno łamać: **nie zmieniamy ani nie używamy ponownie numerów istniejących pól**.

### Słabe strony

Przeglądarki nie obsługują gRPC bezpośrednio. Potrzebna jest warstwa pośrednia (gRPC-Web z proxy), co komplikuje aplikacje webowe. Format binarny jest nieczytelny dla człowieka, więc debugowanie wymaga specjalnych narzędzi, takich jak `grpcurl`. Ekosystem narzędzi pomocniczych (testowanie, bramy API, cache) jest uboższy niż dla REST-a. Zespoły zewnętrzne też częściej wolą prosty REST, bo wymaga mniej wstępnej konfiguracji.

## Porównanie w pigułce

| Cecha | REST | GraphQL | gRPC |
|---|---|---|---|
| Model | zasoby i metody HTTP | zapytania do schematu | wywołania zdalnych funkcji |
| Format danych | zwykle JSON | JSON | binarny (Protocol Buffers) |
| Transport | HTTP/1.1 lub HTTP/2 | HTTP (zwykle POST) | HTTP/2 |
| Kontrakt | opcjonalny (OpenAPI) | schemat (obowiązkowy) | plik `.proto` (obowiązkowy) |
| Wybór pól przez klienta | nie | tak | nie |
| Buforowanie | proste (HTTP) | trudniejsze | wymaga własnych rozwiązań |
| Wydajność | dobra | dobra | bardzo dobra |
| Strumieniowanie | ograniczone | subskrypcje | wbudowane |
| Wsparcie w przeglądarce | pełne | pełne | wymaga gRPC-Web |
| Czytelność dla człowieka | wysoka | wysoka | niska |
| Typowe zastosowanie | publiczne API, integracje | aplikacje z wieloma widokami | komunikacja między usługami |

## Jak wybrać? Praktyczne wskazówki

**Wybierz REST, gdy:**

- budujesz API publiczne, z którego będą korzystać zewnętrzni programiści,
- zależy Ci na prostocie, szerokiej zgodności i łatwym buforowaniu,
- zasoby i operacje dobrze pasują do modelu „rzeczy i czasowniki HTTP".

**Wybierz GraphQL, gdy:**

- masz wielu różnych klientów (strona, aplikacja mobilna, partnerzy) o odmiennych potrzebach co do danych,
- dane są silnie powiązane i klient często potrzebuje „kawałków" z kilku miejsc naraz,
- zespół frontendowy chce pracować niezależnie od backendu.

**Wybierz gRPC, gdy:**

- usługi wewnętrzne komunikują się ze sobą bardzo często i liczy się wydajność,
- potrzebujesz strumieniowania lub komunikacji dwukierunkowej,
- chcesz ścisłego kontraktu i generowania kodu w wielu językach.

W prawdziwych projektach często **łączy się style**: na zewnątrz udostępnia się REST lub GraphQL, a wewnątrz organizacji usługi rozmawiają przez gRPC. Popularnym wzorcem jest też **BFF** (*Backend for Frontend*): osobna warstwa z GraphQL-em lub REST-em, która zbiera dane z wielu usług wewnętrznych i dostarcza je aplikacji w dogodnej formie.

## Wspólne zasady dobrego API, niezależnie od stylu

Niezależnie od wybranej technologii kilka reguł zawsze się opłaca:

1. **Traktuj API jak produkt.** Dokumentuj je, wersjonuj i planuj zmiany z wyprzedzeniem.
2. **Projektuj z myślą o błędach.** Sieć zawodzi, więc ustaw rozsądne limity czasu (*timeouty*) i zaplanuj ponawianie nieudanych wywołań.
3. **Dbaj o idempotentność.** Powtórzenie tego samego żądania (np. po utracie odpowiedzi) nie powinno tworzyć duplikatów, na przykład dwóch zamówień. W REST-ie pomagają klucze idempotentności przesyłane w nagłówku.
4. **Zadbaj o bezpieczeństwo.** Uwierzytelnianie i autoryzacja (np. OAuth 2.0, tokeny JWT), szyfrowanie połączeń (TLS) i ograniczanie liczby żądań (*rate limiting*) są obowiązkowe.
5. **Nie ujawniaj wewnętrznej struktury.** API nie powinno być lustrzanym odbiciem tabel w bazie danych. Dzięki temu zmiany wewnętrzne nie łamią kontraktu.
6. **Mierz i monitoruj.** Czasy odpowiedzi, błędy i obciążenie powiedzą Ci więcej niż najlepsze założenia projektowe.

## Najczęstsze błędy przy wyborze

Pierwszy błąd to **wybór „modnej" technologii**, a nie takiej, która rozwiązuje realny problem. GraphQL dla prostej aplikacji z trzema ekranami albo gRPC dla publicznego API używanego przez studentów to częste przykłady przesady.

Drugi to **ignorowanie kompetencji zespołu**. Technologia, której nikt nie zna, oznacza dłuższy czas wdrożenia i więcej błędów. Trzeci to **brak planu rozwoju kontraktu**: bez zasad wersjonowania pierwsza poważna zmiana zablokuje wszystkich klientów. Czwarty to **zbyt „gadatliwe" interfejsy**, w których pojedyncza operacja biznesowa wymaga dziesięciu wywołań. Takie API będzie wolne bez względu na to, jak szybki jest protokół.

## Podsumowanie

REST, GraphQL i gRPC nie rywalizują ze sobą tak, jak się czasem sugeruje. To trzy narzędzia do trzech różnych klas problemów. **REST** to bezpieczny wybór dla publicznych i uniwersalnych interfejsów, **GraphQL** daje elastyczność aplikacjom z różnorodnymi widokami danych, a **gRPC** sprawdza się tam, gdzie liczą się szybkość i ścisły kontrakt między usługami.

Zanim zdecydujesz, zadaj sobie trzy pytania: kto będzie korzystał z API, jak często i jakie dane będzie potrzebował, oraz jak będziemy zmieniać ten interfejs za rok. Odpowiedzi zwykle wskazują właściwy kierunek.

W następnym wpisie przyjrzymy się komunikacji asynchronicznej, czyli integracji systemów za pomocą kolejek komunikatów, takich jak RabbitMQ i Apache Kafka.