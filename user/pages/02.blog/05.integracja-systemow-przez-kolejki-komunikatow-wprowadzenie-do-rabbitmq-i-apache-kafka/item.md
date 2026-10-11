---
title: 'Integracja systemów przez kolejki komunikatów: wprowadzenie do RabbitMQ i Apache Kafka'
date: '11-10-2026 21:45'
published: true
taxonomy:
    category:
        - 'Inżynieria oprogramowania'
        - 'kolejki komunikatów'
        - RabbitMQ
        - Kafka
        - 'integracja systemów'
        - 'komunikacja asynchroniczna'
        - 'architektura zdarzeniowa'
---

Wyobraź sobie sklep internetowy. Klient klika „Zamawiam", a system musi zapisać zamówienie, zarezerwować towar, obciążyć kartę, wystawić fakturę, wysłać e-mail z potwierdzeniem i powiadomić magazyn. Jeśli aplikacja robi to wszystko po kolei, w jednym żądaniu, klient czeka kilka sekund, a awaria dowolnej usługi (choćby serwera pocztowego) psuje całe zamówienie. Kolejki komunikatów to jeden z najskuteczniejszych sposobów na rozwiązanie tego problemu.

===

## Komunikacja synchroniczna i asynchroniczna

W podejściu **synchronicznym** (np. zwykłe wywołanie API) nadawca wysyła żądanie i **czeka na odpowiedź**. Jest to proste i intuicyjne, ale tworzy ścisłe powiązanie: jeśli odbiorca jest wolny lub niedostępny, nadawca też stoi w miejscu albo kończy się błędem.

W podejściu **asynchronicznym** nadawca przekazuje wiadomość pośrednikowi i od razu wraca do swojej pracy. Odbiorca przetwarza ją później, kiedy będzie gotowy. Pośrednikiem jest **broker komunikatów**, czyli osobna usługa, której zadaniem jest przyjąć, przechować i dostarczyć wiadomości.

Można to porównać do poczty. Gdy wrzucasz list do skrzynki, nie czekasz, aż adresat go przeczyta. Poczta zajmuje się resztą, a Ty możesz wrócić do swoich spraw.

## Podstawowe pojęcia

Niezależnie od konkretnej technologii spotkasz kilka powtarzających się pojęć:

- **Producent** (*producer*) to aplikacja, która wysyła wiadomości.
- **Konsument** (*consumer*) to aplikacja, która je odbiera i przetwarza.
- **Broker** to serwer pośredniczący, który przechowuje wiadomości i zarządza ich dostarczaniem.
- **Kolejka** (*queue*) lub **temat** (*topic*) to nazwane miejsce, w którym wiadomości czekają na odbiór.
- **Wiadomość** (*message*) to porcja danych, zwykle w formacie JSON, wraz z metadanymi.

### Korzyści z kolejek

1. **Luźne powiązanie systemów.** Producent nie musi znać konsumenta ani wiedzieć, czy jest akurat dostępny. Można dodawać nowych odbiorców bez zmiany kodu nadawcy.
2. **Odporność na awarie.** Jeśli konsument przestanie działać na godzinę, wiadomości poczekają w kolejce i zostaną przetworzone po jego powrocie.
3. **Wyrównywanie obciążenia.** Nagły skok liczby zamówień (np. w Black Friday) nie przewraca systemu. Wiadomości ustawiają się w kolejce i są przetwarzane we własnym tempie.
4. **Skalowanie.** Gdy przetwarzanie jest zbyt wolne, uruchamiamy kolejne instancje konsumenta, które wspólnie opróżniają kolejkę.
5. **Szybsza odpowiedź dla użytkownika.** Operacje nieistotne w danej chwili (e-mail, faktura) przenosimy „na później".

### Koszty i pułapki

Kolejki nie są darmowe. Pojawia się **dodatkowy element infrastruktury**, który trzeba utrzymywać i monitorować. Zmienia się sposób myślenia: system staje się **ostatecznie spójny** (*eventually consistent*), czyli stan w różnych miejscach wyrównuje się z opóźnieniem. Trudniej też śledzić przepływ: zamiast jednego stosu wywołań mamy łańcuch zdarzeń rozrzuconych po wielu usługach. Wreszcie trzeba świadomie zarządzać błędami, duplikatami i kolejnością wiadomości, o czym piszemy niżej.

## RabbitMQ: klasyczny broker komunikatów

**RabbitMQ** to jeden z najpopularniejszych brokerów. Jest otwartoprogramowy, napisany w języku Erlang, a jego głównym protokołem jest **AMQP 0-9-1**. Obsługuje też m.in. MQTT i STOMP. Działa według modelu „inteligentny broker, prosty konsument": to broker zajmuje się routingiem i pilnuje, które wiadomości zostały dostarczone.

### Jak działa routing: exchange, kolejka, binding

W RabbitMQ producent **nie wysyła wiadomości bezpośrednio do kolejki**. Wysyła je do **exchange** (węzła wymiany), który na podstawie reguł kieruje je do właściwych kolejek. Powiązanie exchange z kolejką nazywa się **binding**, a opisujący je klucz to **routing key**.

Najczęściej spotykane typy exchange:

- **direct**: wiadomość trafia do kolejek, których klucz powiązania dokładnie pasuje do klucza routingu,
- **fanout**: kopia wiadomości trafia do wszystkich powiązanych kolejek (rozgłaszanie),
- **topic**: dopasowanie wzorcem, np. `zamowienia.*.polska` lub `zamowienia.#`,
- **headers**: routing według nagłówków wiadomości.

Dzięki temu jedno zdarzenie „zamówienie złożone" może jednocześnie trafić do kolejki fakturowania, magazynu i powiadomień, a każdy z tych systemów pracuje we własnym tempie.

### Potwierdzenia i trwałość

Ważną cechą RabbitMQ jest mechanizm **potwierdzeń** (*acknowledgements*). Konsument odbiera wiadomość, przetwarza ją i dopiero wtedy wysyła do brokera potwierdzenie (*ack*). Jeśli połączenie zerwie się przed potwierdzeniem, broker uzna, że wiadomość nie została obsłużona, i dostarczy ją ponownie, być może innemu konsumentowi. Gwarantuje to, że wiadomość nie zginie z powodu awarii konsumenta.

Aby wiadomości przetrwały restart brokera, kolejkę oznaczamy jako **trwałą** (*durable*), a wiadomości jako **persistent**. Po stronie nadawcy warto włączyć też *publisher confirms*, czyli potwierdzenia, że broker rzeczywiście przyjął wiadomość.

### Przykład w Pythonie

Poniższy przykład używa biblioteki `pika`. Najpierw producent:

```python
import json
import pika

polaczenie = pika.BlockingConnection(pika.ConnectionParameters("localhost"))
kanal = polaczenie.channel()

# Trwała kolejka: przetrwa restart brokera
kanal.queue_declare(queue="zamowienia", durable=True)

zamowienie = {"id": 1001, "klient": "Jan Kowalski", "kwota": 149.90}

kanal.basic_publish(
    exchange="",                    # domyślny exchange kieruje po nazwie kolejki
    routing_key="zamowienia",
    body=json.dumps(zamowienie),
    properties=pika.BasicProperties(
        delivery_mode=2,            # wiadomość trwała
        content_type="application/json",
    ),
)
polaczenie.close()
```

Konsument, który potwierdza wiadomość dopiero po przetworzeniu:

```python
import json
import pika

def obsluz(kanal, metoda, wlasciwosci, tresc):
    zamowienie = json.loads(tresc)
    print("Przetwarzam zamówienie", zamowienie["id"])
    # ... tu wystawiamy fakturę, zapisujemy w bazie itd.
    kanal.basic_ack(delivery_tag=metoda.delivery_tag)

polaczenie = pika.BlockingConnection(pika.ConnectionParameters("localhost"))
kanal = polaczenie.channel()
kanal.queue_declare(queue="zamowienia", durable=True)

# Jedna wiadomość naraz: sprawiedliwy podział pracy między konsumentów
kanal.basic_qos(prefetch_count=1)
kanal.basic_consume(queue="zamowienia", on_message_callback=obsluz)
kanal.start_consuming()
```

Aby szybko uruchomić RabbitMQ na własnym komputerze, wystarczy Docker:

```bash
docker run -d --name rabbit -p 5672:5672 -p 15672:15672 rabbitmq:3-management
```

Panel zarządzania będzie dostępny pod adresem `http://localhost:15672` (domyślnie login i hasło `guest`, tylko z lokalnego komputera).

### Kolejka martwych wiadomości

Co zrobić z wiadomością, której nie da się przetworzyć, bo ma błędne dane lub wywołuje błąd w kodzie? Jeśli bez końca wraca do kolejki, blokuje pracę. Standardowym rozwiązaniem jest **kolejka martwych wiadomości** (*dead letter queue*, DLQ). Wiadomość odrzucona lub taka, której wyczerpano liczbę prób, trafia do osobnej kolejki, gdzie człowiek lub specjalny proces może ją przeanalizować, naprawić i ewentualnie ponownie wysłać.

## Apache Kafka: rozproszony dziennik zdarzeń

**Apache Kafka** powstała w LinkedIn i została przekazana fundacji Apache. Choć często wrzuca się ją do jednego worka z kolejkami, jest zbudowana na innej idei: to **rozproszony, trwały dziennik zdarzeń** (*distributed commit log*). Model jest odwrotny niż w RabbitMQ: „prosty broker, inteligentny konsument". Broker tylko dopisuje zdarzenia do dziennika, a to konsument pamięta, dokąd doczytał.

### Kluczowe pojęcia

- **Temat** (*topic*) to nazwana kategoria zdarzeń, np. `zamowienia`.
- **Partycja** (*partition*): temat dzieli się na partycje, czyli niezależne, uporządkowane dzienniki. To one umożliwiają skalowanie, bo różne partycje mogą obsługiwać różne serwery i różni konsumenci.
- **Offset** to numer wiadomości w obrębie partycji. Konsument zapisuje, do którego offsetu doczytał.
- **Klucz wiadomości**: wiadomości o tym samym kluczu (np. identyfikator klienta) trafiają do tej samej partycji, więc zachowują **kolejność względem siebie**. Kafka gwarantuje kolejność tylko w obrębie jednej partycji.
- **Grupa konsumentów** (*consumer group*): kilku konsumentów o tym samym identyfikatorze grupy dzieli między siebie partycje tematu. Różne grupy czytają ten sam temat niezależnie, każda we własnym tempie.
- **Retencja**: wiadomości **nie znikają po odczytaniu**. Kafka przechowuje je przez ustalony czas (np. 7 dni) lub do osiągnięcia ustalonego rozmiaru. Dzięki temu można cofnąć się i przetworzyć dane od nowa.
- **Replikacja**: każda partycja może mieć kopie na kilku brokerach, więc awaria jednego serwera nie powoduje utraty danych.

W nowszych wersjach Kafka działa w trybie **KRaft**, w którym sama zarządza metadanymi klastra. Dawniej wymagała do tego osobnej usługi ZooKeeper, która została usunięta w wersji 4.0.

### Przykład w Pythonie

Poniższy kod używa biblioteki `confluent-kafka`. Producent:

```python
import json
from confluent_kafka import Producer

producent = Producer({"bootstrap.servers": "localhost:9092"})

zamowienie = {"id": 1001, "klient": "jan.kowalski", "kwota": 149.90}

# Klucz = klient, więc wszystkie jego zdarzenia trafią do jednej partycji
producent.produce(
    topic="zamowienia",
    key=zamowienie["klient"],
    value=json.dumps(zamowienie),
)
producent.flush()   # czeka, aż wiadomości zostaną wysłane
```

Konsument, który zatwierdza offset po przetworzeniu:

```python
import json
from confluent_kafka import Consumer

konsument = Consumer({
    "bootstrap.servers": "localhost:9092",
    "group.id": "fakturowanie",
    "auto.offset.reset": "earliest",
    "enable.auto.commit": False,     # zatwierdzamy ręcznie, po przetworzeniu
})
konsument.subscribe(["zamowienia"])

try:
    while True:
        wiadomosc = konsument.poll(1.0)
        if wiadomosc is None:
            continue
        if wiadomosc.error():
            print("Błąd:", wiadomosc.error())
            continue

        zamowienie = json.loads(wiadomosc.value())
        print("Fakturuję zamówienie", zamowienie["id"])
        konsument.commit(message=wiadomosc)
finally:
    konsument.close()
```

Lokalny, jednowęzłowy Kafka uruchomisz jednym poleceniem:

```bash
docker run -d --name kafka -p 9092:9092 apache/kafka:latest
```

## RabbitMQ czy Kafka? Porównanie

| Cecha | RabbitMQ | Apache Kafka |
|---|---|---|
| Model | broker kolejek z routingiem | rozproszony dziennik zdarzeń |
| Co dzieje się po odczycie | wiadomość jest usuwana po potwierdzeniu | wiadomość zostaje do końca retencji |
| Możliwość ponownego odczytu | ograniczona (wymaga osobnych rozwiązań) | naturalna, przez zmianę offsetu |
| Routing | bogaty (exchange, binding, wzorce) | prosty (temat i klucz) |
| Kolejność | w obrębie kolejki | w obrębie partycji |
| Przepustowość | wysoka | bardzo wysoka |
| Skalowanie | dobre, ale trudniejsze przy ogromnym ruchu | zaprojektowana do skalowania poziomego |
| Typowe zastosowanie | zadania w tle, powiadomienia, komunikacja usług | strumienie zdarzeń, logi, analityka, event sourcing |
| Złożoność utrzymania | niższa | wyższa |

W uproszczeniu: **RabbitMQ** wybierz, gdy chcesz niezawodnie przekazać zadania lub komunikaty z elastycznym kierowaniem (np. „wyślij e-mail", „wygeneruj raport"). **Kafkę** wybierz, gdy zdarzenia są cenne same w sobie: gdy ma je czytać wiele niezależnych systemów, gdy chcesz je przechowywać, odtwarzać i analizować, a ruch jest duży.

Nie jest to jednak wybór „albo-albo". W niektórych organizacjach obie technologie działają obok siebie, każda do innej klasy zadań.

## Gwarancje dostarczania i duplikaty

Najważniejsze, co trzeba zrozumieć przy pracy z kolejkami, to **semantyka dostarczania**:

- **At most once** (co najwyżej raz): wiadomość może zostać zgubiona, ale nigdy nie przyjdzie dwa razy. Nadaje się do danych mało istotnych.
- **At least once** (co najmniej raz): wiadomość na pewno dotrze, ale w razie problemów może przyjść **więcej niż raz**. To najczęstszy tryb.
- **Exactly once** (dokładnie raz): wiadomość jest przetworzona jeden raz. Jest to trudne do uzyskania w systemach rozproszonych. Niektóre rozwiązania (np. transakcje w Kafce) oferują je w ściśle określonych warunkach.

W praktyce najczęściej pracujemy w trybie *at least once*, więc **konsument musi być idempotentny**, czyli jednokrotne i wielokrotne przetworzenie tej samej wiadomości ma dawać ten sam skutek. Najprościej jest zapisywać identyfikatory przetworzonych wiadomości (lub zamówień) i pomijać te, które już widzieliśmy:

```python
def obsluz_zamowienie(zamowienie):
    if baza.czy_przetworzone(zamowienie["id"]):
        return                       # duplikat, ignorujemy
    wystaw_fakture(zamowienie)
    baza.oznacz_jako_przetworzone(zamowienie["id"])
```

## Wzorce, które warto znać

**Wzorzec Outbox.** Typowy problem: aplikacja zapisuje zamówienie w bazie danych **i** wysyła zdarzenie do kolejki. Co, jeśli zapis się uda, a wysyłka nie (albo odwrotnie)? Rozwiązaniem jest zapisanie zdarzenia w tej samej transakcji bazodanowej, w specjalnej tabeli *outbox*. Osobny proces odczytuje ją i publikuje wiadomości do brokera. Dzięki temu nie powstaje rozjazd między bazą a kolejką.

**Ponawianie z opóźnieniem** (*retry with backoff*). Zamiast natychmiast powtarzać nieudane przetwarzanie, czekamy coraz dłużej między próbami (np. 1 s, 5 s, 30 s). Po przekroczeniu limitu prób wiadomość trafia do kolejki martwych wiadomości.

**Wersjonowanie komunikatów.** Format wiadomości to kontrakt, tak jak w API. Zmiany powinny być zgodne wstecz: dodawaj nowe pola, nie usuwaj i nie zmieniaj znaczenia starych. Warto korzystać z formalnego schematu (np. Avro lub JSON Schema).

**Monitorowanie.** Obserwuj długość kolejki lub tzw. *consumer lag* w Kafce, czyli różnicę między najnowszym a ostatnio przetworzonym offsetem. Rosnące opóźnienie to pierwszy sygnał, że konsumenci nie nadążają.

## Typowe błędy początkujących

1. **Wysyłanie ogromnych wiadomości.** Brokery są stworzone do przekazywania niewielkich komunikatów. Duże pliki lepiej trzymać w magazynie plików, a w wiadomości przesyłać tylko odnośnik.
2. **Brak obsługi duplikatów.** Zakładanie, że wiadomość przyjdzie dokładnie raz, kończy się podwójnymi fakturami.
3. **Brak kolejki martwych wiadomości.** Jedna „zatruta" wiadomość potrafi zablokować przetwarzanie.
4. **Automatyczne potwierdzanie przed przetworzeniem.** Jeśli potwierdzisz wiadomość, zanim ją obsłużysz, awaria w trakcie pracy oznacza jej utratę.
5. **Użycie kolejki tam, gdzie wystarczy zwykłe wywołanie.** Nie każda integracja musi być asynchroniczna. Jeśli klient potrzebuje odpowiedzi natychmiast, synchroniczne API bywa prostsze i lepsze.
6. **Zakładanie globalnej kolejności w Kafce.** Kolejność jest gwarantowana tylko w obrębie partycji, więc klucz wiadomości trzeba dobrać świadomie.

## Podsumowanie

Kolejki komunikatów pozwalają budować systemy, które są **luźniej powiązane, bardziej odporne na awarie i łatwiejsze do skalowania**. Kosztem jest większa złożoność: dodatkowy komponent, ostateczna spójność i konieczność zadbania o duplikaty i błędy.

**RabbitMQ** to niezawodny „listonosz" dla zadań i komunikatów z elastycznym routingiem. **Kafka** to trwały dziennik zdarzeń, z którego wiele systemów może czytać niezależnie, także po latach. Zacznij od prostego przypadku, np. wysyłki powiadomień w tle, a doświadczenie, które zdobędziesz, pozwoli Ci ocenić, które z narzędzi pasuje do bardziej wymagających zadań.

Jeśli czytasz ten cykl od początku, pamiętaj, że komunikacja asynchroniczna i API (opisane w poprzednim wpisie o REST, GraphQL i gRPC) się nie wykluczają. Często wspólnie tworzą spójną architekturę: zapytania i polecenia obsługują API, a zdarzenia rozchodzą się po systemie przez broker.