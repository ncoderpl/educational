---
title: 'Model relacyjny i struktura logiczna bazy danych'
---

# Modelowanie konceptualne – diagramy E/R i kardynalność relacji


## 1. Wprowadzenie do modelowania konceptualnego

Projektowanie relacyjnej bazy danych rozpoczyna się od analizy dziedziny problemu biznesowego oraz stworzenia konceptualnego schematu danych. Poziom konceptualny uniezależnia strukturę informacji od docelowego systemu zarządzania bazą danych (SZBD) oraz fizycznych formatów zapisu na nośnikach masowych.

Podstawowym narzędziem inżynierskim na tym etapie jest model związków encji (ERD – Entity-Relationship Diagram), który opisuje obiekty świata rzeczywistego, ich cechy oraz powiązania logiczne. Poprawne zamodelowanie struktur konceptualnych decyduje o spójności, wydajności transakcyjnej oraz skalowalności całego systemu informatycznego.

---

## 2. Elementy składowe modelu związków encji (E/R)

Model E/R opiera się na czterech fundamentalnych pojęciach:

* **Encja (Entity):** Odrębny, jednoznacznie identyfikowalny obiekt świata rzeczywistego lub pojęcie abstrakcyjne (np. student, faktura, samochód, zamówienie). W relacyjnej bazie danych encja przekształcana jest w tabelę.
* **Zbiór encji (Entity Set):** Kolekcja homogenicznych encji tego samego typu (np. zbiór wszystkich klientów zarejestrowanych w sklepie).
* **Atrybut (Attribute):** Pojedyncza cecha charakteryzująca encję (np. nazwisko, data urodzenia, cena jednostkowa), stanowiąca w schemacie tabelarycznym kolumnę.
* **Związek / Relacja (Relationship):** Logiczna asocjacja łącząca co najmniej dwie encje, określająca zasady współzależności ich wystąpień.

### Klasyfikacja atrybutów w ujęciu projektowym

W procesie analizy dziedzinowej atrybuty dzieli się na kategorie determinujące ich późniejszą transformację logiczną:

* **Atrybuty proste (skalarne):** Niepodzielne w modelowanej dziedzinie (np. Wiek, CenaNetto).
* **Atrybuty złożone (kompozytowe):** Zbudowane z logicznych podkomponentów (np. Adres: ulica, numer domu, kod pocztowy, miejscowość). W relacyjnym modelu danych atrybuty złożone podlegają dekompozycji do niezależnych kolumn skalarnych w celu zachowania atomowości danych.
* **Atrybuty jednowartościowe:** Przyjmujące dokładnie jedną wartość dla instancji danej encji (np. PESEL, Identyfikator).
* **Atrybuty wielowartościowe:** Przyjmujące zbiór wartości dla tej samej instancji (np. NumeryTelefonów, Certyfikaty). Bezpośrednie składowanie listy wartości rozdzielanych separatorem w jednym polu stanowi błąd architektoniczny i wymaga dekompozycji do relacji podrzędnej, ponieważ narusza to pierwszą postać normalną (1NF).
* **Atrybuty pochodne:** Wartości wyliczane dynamicznie na podstawie innych pól (np. WartoscBrutto). Atrybutów pochodnych nie należy utrwalać w fizycznej strukturze bazy bez wyraźnego uzasadnienia optymalizacyjnego.

---

## 3. Mechanizmy identyfikacji: klucze główne i klucze obce

Identyfikacja wierszy w modelu relacyjnym wymaga ścisłego rozróżnienia ról kluczy:

* **Nadklucz:** Dowolny zbiór atrybutów jednoznacznie identyfikujący krotkę w relacji.
* **Klucz kandydujący:** Minimalny nadklucz, z którego usunięcie dowolnego atrybutu niszczy unikalność.
* **Klucz główny (PRIMARY KEY):** Wyróżniony klucz kandydujący, podstawa indeksu klastrowego, nie dopuszcza wartości pustych (NOT NULL).
* **Klucz alternatywny:** Pozostałe klucze kandydujące, zabezpieczane przez ograniczenie UNIQUE.
* **Klucz obcy (FOREIGN KEY):** Atrybut w tabeli podrzędnej, którego wartości precyzyjnie wskazują na klucz główny tabeli nadrzędnej. Realizuje on fizyczne powiązanie relacyjne i gwarantuje integralność referencyjną bazy.

### Klucz sztuczny a klucz naturalny

* **Klucz naturalny** to cecha istniejąca w rzeczywistości biznesowej (np. numer PESEL, NIP, ISBN). Stosowanie identyfikatorów naturalnych jako kluczy głównych wiąże się z ryzykiem zmian prawnych i błędów wprowadzania.
* **Klucz sztuczny** to liczba całkowita generowana sekwencyjnie przez system bazodanowy (AUTO_INCREMENT), niemająca żadnego znaczenia biznesowego. Gwarantuje ona stabilność relacji i maksymalną wydajność indeksowania.

---

## 4. Modelowanie powiązań i kardynalność relacji

Kardynalność (krotność) określa dopuszczalną liczbę instancji jednej encji, które mogą być powiązane z określoną liczbą instancji drugiej encji.

### 4.1. Relacja jeden do jednego (1:1)

Relacja 1:1 występuje wtedy, gdy jednemu rekordowi w tabeli A odpowiada dokładnie jeden rekord w tabeli B, i odwrotnie.

![Schemat relacji jeden do jednego](relacja-jeden-do-jednego-%281-1%29.svg)

* **Zastosowanie inżynierskie:** Wydzielanie danych wysoce poufnych do osobnej tabeli (wertykalne partycjonowanie) lub obsługa podtypów encji (dziedziczenie).
* **Implementacja fizyczna:** Klucz główny tabeli podrzędnej jest jednocześnie jej kluczem obcym, wskazującym bezpośrednio na klucz główny tabeli nadrzędnej.

### 4.2. Relacja jeden do wielu (1:N)

Relacja 1:N zachodzi wtedy, gdy jednemu rekordowi w tabeli nadrzędnej odpowiada zero, jeden lub wiele rekordów w tabeli podrzędnej, natomiast rekord podrzędny wskazuje wyłącznie na jednego rodzica.

![Schemat relacji jeden do wielu](relacja-jeden-do-wielu-%281-n%29.svg)

* **Zasada implementacji:** Klucz obcy umieszcza się zawsze po stronie "wielu" (w tabeli podrzędnej). Umieszczenie klucza obcego po stronie tabeli nadrzędnej uniemożliwiłoby zarejestrowanie więcej niż jednego zamówienia na osobę bez krytycznego naruszenia atomowości danych.

### 4.3. Relacja wiele do wielu (N:M) i tabela asocjacyjna

Relacja N:M występuje wtedy, gdy jedna instancja encji A może łączyć się z wieloma instancjami encji B, a jedna instancja encji B może być powiązana z wieloma instancjami encji A. Publikacja książkowa może mieć wielu autorów, natomiast pojedynczy autor może uczestniczyć w tworzeniu wielu różnych książek.

#### Błędy modelowania relacji N:M (Antywzorce)

* **Powielone kolumny kluczy obcych:** Tworzenie kolumn Autor1Id, Autor2Id, Autor3Id w tabeli Ksiazki. Skutkuje to sztywnym limitem współautorów i gigantycznym marnotrawstwem miejsca (NULL) dla publikacji jednoautorskich.
* **Składowanie listy identyfikatorów po przecinku:** Zapisywanie wartości typu "1, 4, 18" w jednej kolumnie. Skutkuje to kompletnym złamaniem atomowości (1NF) i niemożliwością założenia mechanicznych więzów klucza obcego.

#### Prawidłowa dekompozycja do poziomu relacyjnego

Relacyjny silnik bazodanowy z zasady nie obsługuje bezpośrednich fizycznych połączeń N:M pomiędzy dwoma tabelami. Związek ten należy zdekodować na dwie niezależne relacje 1:N za pomocą dedykowanej tabeli asocjacyjnej (pośredniczącej).

![Schemat relacji wiele do wielu z tabelą asocjacyjną](relacja-wiele-do-wielu-%28n-m%29-z-tabela-asocjacyjna.svg)

* **Struktura tabeli asocjacyjnej:** Zawiera co najmniej dwie kolumny będące kluczami obcymi wskazującymi na tabele nadrzędne. Obie kolumny wspólnie tworzą silny złożony klucz główny, co zabezpiecza strukturę przed przypadkowym, wielokrotnym przypisaniem tego samego autora do tej samej książki.

---

## 5. Reguły projektowe i eliminacja anomalii strukturalnych

Prawidłowy projekt schematu bazy danych musi ściśle respektować poniższe zasady inżynierskie:

* **Zasada atomowości danych (Pierwsza Postać Normalna - 1NF):** Każda komórka tabeli musi przechowywać pojedynczą, elementarną wartość. Składowanie połączonego imienia i nazwiska w jednym polu to błąd, który drastycznie utrudnia późniejsze indeksowane sortowanie czy wyszukiwanie po samym nazwisku.
* **Eliminacja redundancji (nadmiarowości):** Powtarzające się zestawy informacji tekstowych muszą bezwzględnie zostać wydzielone do osobnych słowników. Powiązanie realizuje się wtedy za pomocą krótkiego identyfikatora numerycznego, co oszczędza przestrzeń dyskową i chroni przed anomalią modyfikacji.
* **Minimalizacja występowania wartości pustych (NULL):** Obecność zbyt wielu opcjonalnych kolumn, które dla większości rekordów pozostają niewypełnione, wyraźnie wskazuje na konieczność dekompozycji tabeli. Puste atrybuty należy wydzielić do relacji 1:1 lub struktury słownikowej 1:N.
* **Jawne definiowanie integralności referencyjnej:** Każdy zdefiniowany klucz obcy musi mieć ściśle określoną regułę reakcji silnika na próbę usunięcia rekordu rodzica (np. ON DELETE RESTRICT lub ON DELETE CASCADE). Zapobiega to powstawaniu niespójnych i osieroconych rekordów w bazie danych.

---

## Pytania sprawdzające do lekcji

1. Na czym polega zasadnicza różnica między kluczem głównym (PRIMARY KEY) a kluczem obcym (FOREIGN KEY) w relacyjnej bazie danych?
2. Dlaczego składowanie kilku wartości po przecinku w jednej kolumnie (np. przypisanie autorów do książki) uważa się za poważny błąd projektowy i naruszenie zasad normalizacji?
3. Jak w praktyce relacyjnej rozwiązuje się problem połączeń typu "wiele do wielu" (N:M)? Podaj odpowiedni mechanizm.
4. W której tabeli przywiązuje się klucz obcy w przypadku powiązania typu "jeden do wielu" (1:N)? Dlaczego nie robi się tego w tabeli nadrzędnej?
5. Czym różni się klucz naturalny od klucza sztucznego i dlaczego klucze sztuczne (np. `AUTO_INCREMENT`) są znacznie częściej stosowane w środowiskach produkcyjnych?

---