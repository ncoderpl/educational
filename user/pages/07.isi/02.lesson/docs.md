---
title: 'Integracja systemów informatycznych – plan warsztatów i struktura Moodle'
published: true
---

Warsztaty, VII semestr, informatyka (profil praktyczny). Trzy grupy: dzienni (5 spotkań), zaoczni (2 spotkania), online (1 spotkanie). Każda grupa ma trzy ścieżki ocen (3.0, 4.0, 5.0).

## 1. Zasady wspólne

- Oceny są kumulatywne: ocena 4.0 obejmuje wymagania 3.0, a ocena 5.0 wymagania 4.0.
- Zaliczenie polega na zespoleniu systemów (aplikacji) tak, aby korzystały nawzajem ze swoich zasobów (pliki, bazy danych, urządzenia).
- **Wymóg ogólny:** przy wersji końcowej należy odesłać kompletny kod źródłowy oraz nagrać krótki film pokazujący przepływ danych i uruchomione serwisy.
- Struktura w Moodle: każda ocena to osobny dział (sekcja kursu), a w nim zadania przypisane do spotkań. Studenci widzą tylko dział swojej oceny (ograniczenie dostępu po grupach 3.0 / 4.0 / 5.0).
- Na górze każdego działu warto umieścić opis oceny (cel i kryteria zaliczenia) oraz wymóg ogólny.

### Kryteria poszczególnych ocen

**Ocena 3.0, podstawowa integracja jednokierunkowa.** Eksport danych CSV/JSON z pliku lub zewnętrznego systemu do relacyjnej bazy (MySQL/PostgreSQL). Cykliczny lub ręcznie uruchamiany skrypt importujący, krótka dokumentacja, czysty kod w repozytorium. Zaliczenie: poprawny odczyt danych, brak błędów zapisu, podstawowa obsługa wyjątków.

**Ocena 4.0, dwustronna integracja i synchronizacja.** Wymiana System A ↔ System B przez HTTP/REST lub pliki wymiany, spójność danych (aktualizacja w drugim systemie lub wykrywanie konfliktów), podstawowe uwierzytelnianie (token Bearer / klucz API). Zaliczenie: wymagania 3.0, poprawna synchronizacja dwukierunkowa, logowanie zdarzeń integracyjnych, obsługa błędów sieci i formatu danych.

**Ocena 5.0, zaawansowana integracja (SOA / wzorce integracyjne).** Min. jeden wzorzec (Message Router, Content-Based Router, Aggregator) i architektura zorientowana na usługi, bufor wiadomości i Retry Pattern, autoryzacja (OAuth2 / SAML / role), min. trzy komponenty (klient, usługa pośrednicząca/broker, baza lub IoT). Zaliczenie: wymagania niższych ocen, wysoka jakość architektury, odporność na awarię jednego węzła, dokumentacja techniczna i testy integracyjne.

## 2. Studenci dzienni: 5 spotkań

Zakres zajęć:

- **Spotkanie 1:** integracja jedno- i dwustronna, zasady zaliczenia, wybór oceny i tematu, projekt rozwiązania.
- **Spotkanie 2:** import CSV/JSON do bazy relacyjnej, obsługa wyjątków.
- **Spotkanie 3:** HTTP/REST, uwierzytelnianie, wymiana w obie strony.
- **Spotkanie 4:** SOA, wzorce integracyjne, synchronizacja, odporność na błędy, bezpieczeństwo.
- **Spotkanie 5:** integracja w docelowej aplikacji, testy, prezentacje i omówienie ocen.

### Dział: Ocena 3.0

**Zadanie 1: Koncepcja i projekt** (po spotkaniu 1)
- Do oddania: link do repozytorium, krótki opis koncepcji (źródło, cel, format danych CSV/JSON).

**Zadanie 2: Pierwszy przepływ danych** (po spotkaniu 2)
- Do oddania: działający skrypt importujący CSV/JSON do relacyjnej bazy z podstawową obsługą wyjątków.

**Zadanie 3: Wersja końcowa** (po spotkaniu 3)
- Do oddania: kod źródłowy, krótka dokumentacja tekstowa, film z działania. Zadanie zaliczone.

**Zadanie 4** (po spotkaniu 4)
- Nic do oddania. Czas na poprawki po uwagach.

**Zadanie 5: Prezentacja** (po spotkaniu 5)
- Nic do oddania. Udział w prezentacjach i omówieniu ocen.

### Dział: Ocena 4.0

**Zadanie 1: Koncepcja i projekt** (po spotkaniu 1)
- Do oddania: link do repozytorium, opis koncepcji (źródło, cel, format danych), schemat przepływu System A ↔ System B.

**Zadanie 2: Import i szkielet API** (po spotkaniu 2)
- Do oddania: działający skrypt importujący z obsługą wyjątków, szkielet API drugiego systemu.

**Zadanie 3: Wymiana w obie strony** (po spotkaniu 3)
- Do oddania: działająca dwustronna wymiana przez HTTP/REST z uwierzytelnianiem (token Bearer / klucz API).

**Zadanie 4: Wersja końcowa** (po spotkaniu 4)
- Do oddania: kod, dokumentacja, film. Synchronizacja z wykrywaniem konfliktów, logowanie zdarzeń integracyjnych, obsługa błędów sieci i formatu danych. Zadanie zaliczone.

**Zadanie 5: Prezentacja** (po spotkaniu 5)
- Nic do oddania. Poprawki po uwagach, prezentacja projektu i omówienie ocen.

### Dział: Ocena 5.0

**Zadanie 1: Koncepcja i architektura** (po spotkaniu 1)
- Do oddania: link do repozytorium, opis koncepcji, schemat A ↔ B, architektura z min. 3 komponentami (klient, usługa pośrednicząca/broker, baza lub IoT) i wybranym wzorcem (Router/Aggregator).

**Zadanie 2: Import i szkielety usług** (po spotkaniu 2)
- Do oddania: działający skrypt importujący, szkielet API drugiego systemu, szkielet usługi pośredniczącej/brokera.

**Zadanie 3: Komunikacja przez pośrednika** (po spotkaniu 3)
- Do oddania: działająca wymiana przez REST z tokenem oraz usługa pośrednicząca przekazująca wiadomości między systemami.

**Zadanie 4: Wzorce i odporność na błędy** (po spotkaniu 4)
- Do oddania: wdrożony wzorzec integracyjny, bufor wiadomości, Retry Pattern, OAuth2 / kontrola dostępu oparta na rolach.

**Zadanie 5: Wersja końcowa i prezentacja** (po spotkaniu 5)
- Do oddania: kod, dokumentacja techniczna, testy integracyjne, film z testem awarii jednego węzła, prezentacja. Zadanie zaliczone.

## 3. Studenci zaoczni: 2 spotkania

Zakres zajęć:

- **Spotkanie 1:** wprowadzenie, wybór oceny i tematu, koncepcja, pierwszy przepływ danych (import CSV/JSON → baza).
- **Spotkanie 2:** API i wymiana dwustronna, SOA/wzorce, bezpieczeństwo, odporność na błędy, prezentacja i omówienie ocen.

### Dział: Ocena 3.0

**Zadanie 1: Koncepcja i wersja końcowa** (po spotkaniu 1, termin ok. 2 tygodnie)
- Do oddania: link do repozytorium, krótki opis koncepcji (źródło, cel, format danych CSV/JSON), działający skrypt importujący do relacyjnej bazy z podstawową obsługą wyjątków, krótka dokumentacja tekstowa, film z działania. Zadanie zaliczone.

**Zadanie 2: Prezentacja** (po spotkaniu 2)
- Nic do oddania. Poprawki po uwagach, udział w omówieniu ocen.

### Dział: Ocena 4.0

**Zadanie 1: Koncepcja i pierwszy przepływ** (po spotkaniu 1, termin ok. 1-2 tygodnie)
- Do oddania: link do repozytorium, opis koncepcji, schemat przepływu System A ↔ System B, działający skrypt importujący z obsługą wyjątków, szkielet API drugiego systemu z uwierzytelnianiem (token Bearer / klucz API).

**Zadanie 2: Wersja końcowa** (po spotkaniu 2, termin ok. 2 tygodnie)
- Do oddania: kod, dokumentacja, film. Dwustronna wymiana przez HTTP/REST, synchronizacja z wykrywaniem konfliktów, logowanie zdarzeń integracyjnych, obsługa błędów sieci i formatu danych. Zadanie zaliczone.

### Dział: Ocena 5.0

**Zadanie 1: Architektura i pierwszy przepływ** (po spotkaniu 1, termin ok. 1-2 tygodnie)
- Do oddania: link do repozytorium, opis koncepcji, schemat A ↔ B, architektura z min. 3 komponentami i wybranym wzorcem (Router/Aggregator), działający skrypt importujący, szkielet API i szkielet usługi pośredniczącej/brokera.

**Zadanie 2: Wersja końcowa** (po spotkaniu 2, termin ok. 2 tygodnie)
- Do oddania: kod, dokumentacja techniczna, testy integracyjne, film z testem awarii jednego węzła. Wdrożony wzorzec integracyjny, bufor wiadomości, Retry Pattern, OAuth2 / kontrola dostępu oparta na rolach, usługa pośrednicząca przekazująca wiadomości. Zadanie zaliczone.

## 4. Studenci online: 1 spotkanie

Zakres spotkania: wprowadzenie, zasady zaliczenia (kod + film), wybór oceny i tematu, koncepcja i architektura rozwiązania, najczęstsze pułapki. Pozostałe treści (SOA, wzorce, API, integracja) są omawiane jako wskazówki do pracy własnej. Punkt kontrolny jest jedynym momentem na wczesne wychwycenie złego tematu lub zbyt ambitnego zakresu.

### Dział: Ocena 3.0

**Zadanie 1: Koncepcja** (punkt kontrolny, ok. 1 tydzień po spotkaniu)
- Do oddania: link do repozytorium, krótki opis koncepcji (źródło, cel, format danych CSV/JSON).

**Zadanie 2: Wersja końcowa** (ok. 3 tygodnie po spotkaniu)
- Do oddania: kod źródłowy, działający skrypt importujący do relacyjnej bazy z podstawową obsługą wyjątków, krótka dokumentacja tekstowa, film z działania. Zadanie zaliczone.

### Dział: Ocena 4.0

**Zadanie 1: Koncepcja i schemat** (punkt kontrolny, ok. 1 tydzień po spotkaniu)
- Do oddania: link do repozytorium, opis koncepcji, schemat przepływu System A ↔ System B.

**Zadanie 2: Wersja końcowa** (ok. 3 tygodnie po spotkaniu)
- Do oddania: kod, dokumentacja, film. Dwustronna wymiana przez HTTP/REST z uwierzytelnianiem (token Bearer / klucz API), synchronizacja z wykrywaniem konfliktów, logowanie zdarzeń integracyjnych, obsługa błędów sieci i formatu danych. Zadanie zaliczone.

### Dział: Ocena 5.0

**Zadanie 1: Koncepcja i architektura** (punkt kontrolny, ok. 1 tydzień po spotkaniu)
- Do oddania: link do repozytorium, opis koncepcji, schemat A ↔ B, architektura z min. 3 komponentami i wybranym wzorcem (Router/Aggregator).

**Zadanie 2: Wersja końcowa** (ok. 3-4 tygodnie po spotkaniu)
- Do oddania: kod, dokumentacja techniczna, testy integracyjne, film z testem awarii jednego węzła. Wdrożony wzorzec integracyjny, bufor wiadomości, Retry Pattern, OAuth2 / kontrola dostępu oparta na rolach, usługa pośrednicząca przekazująca wiadomości. Zadanie zaliczone.

W grupie online nie ma prezentacji na żywo, więc film jest jedynym dowodem działania i powinien pokazywać przepływ danych oraz uruchomione serwisy.