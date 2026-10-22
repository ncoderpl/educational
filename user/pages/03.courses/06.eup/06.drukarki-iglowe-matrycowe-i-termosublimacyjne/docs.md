---
title: 'Drukarki igłowe (matrycowe) i termosublimacyjne'
published: true
---

# Drukarki igłowe (matrycowe) i termosublimacyjne

*Budowa, zasada działania, parametry, eksploatacja i diagnostyka*
## Karta Pracy
[Karta Pracy](drukarki-karta-pracy.docx)

## 1. Wprowadzenie

Rynek druku zdominowały dziś drukarki laserowe i atramentowe, ale w wielu zastosowaniach nadal pracują dwa „specjaliści”: **drukarka igłowa (matrycowa)**, która drukuje przez uderzenie, oraz **drukarka termosublimacyjna**, która drukuje ciepłem i barwnikiem zamieniającym się w gaz. Pierwsza wygrywa tam, gdzie liczy się trwałość, niski koszt wydruku i kopie na papierze samokopiującym. Druga – tam, gdzie liczy się jakość fotografii i odporność odbitki na zabrudzenia.

Obie technologie dobrze pokazują, że o doborze urządzenia nie decyduje „najnowszy standard”, lecz dopasowanie zasady druku do zadania. W tym materiale poznasz budowę obu drukarek, sposób ich działania, parametry techniczne, podstawy obsługi i typowe usterki.

## 2. Drukarka igłowa (matrycowa)

### 2.1 Zasada działania

Drukarka igłowa należy do drukarek **uderzeniowych (impact)**. Głowica drukująca zawiera metalowe igły, z których każda jest poruszana własnym elektromagnesem. W chwili wydruku igła wysuwa się, uderza w **taśmę barwiącą** i dociska ją do papieru; na papierze zostaje punkt. Znak powstaje z siatki takich punktów – stąd nazwa „matrycowa” (ang. *dot matrix*).

Głowica przesuwa się poziomo wzdłuż wałka, a w każdym położeniu elektronika wybiera, które igły mają uderzyć. Po zakończeniu linii papier jest przesuwany o jedną linię i cykl się powtarza. Druk odbywa się zwykle w obu kierunkach ruchu głowicy (druk dwukierunkowy), co przyspiesza pracę.

### 2.2 Budowa

| Element                      | Funkcja                                                                                                                            |
|----------------------------------|----------------------------------------------------------------------------------------------------------------------------------------|
| Głowica drukująca            | Zespół igieł (9 lub 24) z elektromagnesami. Najdroższy i najbardziej obciążony element drukarki.                                       |
| Taśma barwiąca (kaseta)      | Nasączona tuszem taśma tekstylna, przesuwana tak, by igły nie uderzały stale w to samo miejsce.                                        |
| Wałek (płyta dociskowa)      | Gumowy wałek, o który opiera się papier w chwili uderzenia igły. Zarazem transportuje papier.                                          |
| Mechanizm przesuwu głowicy   | Silnik krokowy z paskiem lub prowadnicą przemieszcza głowicę wzdłuż linii druku.                                                       |
| Transport papieru            | Silnik krokowy; papier ciągły prowadzi traktor (koła z kolcami zazębiające się w perforację), arkusze pojedyncze – wałek tarciowy. |
| Dźwignia grubości papieru    | Reguluje odstęp głowicy od wałka – inaczej dla pojedynczej kartki, a inaczej dla zestawu z kopiami.                                    |
| Płyta sterująca i interfejsy | Elektronika z pamięcią (bufor) i złączami: dawniej LPT i RS-232, dziś USB oraz Ethernet.                                               |

### 2.3 Głowica 9-igłowa i 24-igłowa

W głowicy 9-igłowej igły ułożone są w jednej kolumnie, co daje szybki druk o wyglądzie „maszynowym”. W głowicy 24-igłowej igły rozmieszczone są w dwóch przesuniętych kolumnach, a każdy punkt jest mniejszy – dzięki temu pismo jest wyraźnie gładsze.

| Cecha                    | 9 igieł                           | 24 igły                                      |
|------------------------------|---------------------------------------|--------------------------------------------------|
| Jakość tekstu            | Wystarczająca do dokumentów roboczych | Wyższa, tryb zbliżony do pisma maszynowego (NLQ) |
| Szybkość (orientacyjnie) | Wyższa w trybie roboczym              | Nieco niższa                                     |
| Grafika i kody kreskowe  | Ograniczone                           | Lepsze odwzorowanie                              |
| Typowe użycie            | Zestawienia, listy, formularze ciągłe | Faktury, dokumenty księgowe, etykiety            |

### 2.4 Parametry techniczne

- **Szybkość** podawana w **cps** (characters per second – znaków na sekundę), zwykle dla trybu roboczego (draft). Typowo kilkaset cps; w trybie wysokiej jakości (NLQ) szybkość jest wyraźnie niższa.

- **Tryby jakości:** draft (szkic – najszybszy), NLQ (*near letter quality* – jakość zbliżona do maszyny do pisania).

- **Gęstość znaków:** cpi (characters per inch), np. 10 lub 12 znaków na cal.

- **Liczba kopii:** oryginał plus zwykle od kilku do kilkunastu kopii (zależnie od modelu i klasy drukarki) na papierze samokopiującym.

- **Szerokość druku:** 80 kolumn (wąska karetka) lub 136 kolumn (szeroka karetka, format A3 poziomo).

- **Języki sterowania:** najczęściej emulacje **ESC/P** (Epson) i **IBM Proprinter**.

- **Rozdzielczość:** niska w porównaniu z laserową i atramentową; nie jest to technologia do fotografii.

### 2.5 Zalety i wady

| Zalety                                                            | Wady                                            |
|-----------------------------------------------------------------------|-----------------------------------------------------|
| Możliwość drukowania kilku kopii jednocześnie                         | Głośna praca (uderzenia igieł)                      |
| Bardzo niski koszt wydruku (tylko taśma)                              | Niska rozdzielczość, brak lub marny kolor           |
| Wytrzymałość i praca w trudnych warunkach (kurz, wahania temperatury) | Mała szybkość w porównaniu z laserową               |
| Obsługa papieru ciągłego i grubszych zestawów                         | Wydruk bywa bladszy, gdy taśma jest wyeksploatowana |
| Trwały, odporny na wilgoć i światło zapis na papierze                 | Większe gabaryty i masa mechanizmu                  |

### 2.6 Zastosowania

- faktury, zamówienia i dokumenty magazynowe wielodzielne (oryginał + kopie),

- wydruki na papierze ciągłym: listy płac, zestawienia, rejestry,

- kasy fiskalne i potwierdzenia w usługach, bankowość, logistyka i transport,

- drukowanie w trudnym środowisku przemysłowym (warsztaty, hale).

### 2.7 Eksploatacja i typowe usterki

> **Nie drukuj bez papieru!**
>
> Gdy w drukarce nie ma papieru, igły uderzają bezpośrednio w wałek. Powoduje to uszkodzenie igieł głowicy i zniszczenie powierzchni wałka. Zawsze sprawdź, czy papier jest założony, zanim wyślesz zadanie.

| Objaw                                           | Najczęstsza przyczyna                                     | Działanie                                           |
|-----------------------------------------------------|---------------------------------------------------------------|---------------------------------------------------------|
| Blady wydruk                                    | Zużyta taśma barwiąca lub zbyt duży odstęp głowicy od papieru | Wymienić taśmę; ustawić dźwignię grubości papieru       |
| Brakujące punkty, białe poziome smugi           | Zablokowana lub uszkodzona igła                               | Wyczyścić głowicę; w razie potrzeby wymienić głowicę    |
| Zacięcia i ucieczka papieru ciągłego            | Papier źle założony w traktor, uszkodzona perforacja          | Poprawnie założyć papier, sprawdzić prowadzenie         |
| Przesunięte pionowe linie, „postrzępiony” tekst | Rozsynchronizowanie druku dwukierunkowego                     | Wykonać kalibrację / przełączyć na druk jednokierunkowy |
| Przegrzewająca się głowica, wolniejszy druk     | Długotrwały druk gęstej grafiki                               | Zrobić przerwę, ograniczyć gęstość wydruku              |

## 3. Drukarka termosublimacyjna

### 3.1 Zasada działania

**Sublimacja** to przejście substancji ze stanu stałego od razu w gazowy, z pominięciem cieczy. W drukarce termosublimacyjnej (ang. *dye-sublimation*, *dye-sub*) wykorzystuje się to zjawisko: barwnik znajdujący się na **wstędze** pod wpływem ciepła zamienia się w gaz i wnika w specjalną powłokę **papieru fotograficznego**, gdzie ponownie się utrwala.

Ilość przekazanego barwnika zależy od temperatury elementu grzejnego. Dzięki temu każdy punkt może mieć **płynnie zmienianą intensywność** – to druk **ciągłotonalny**. Obraz nie jest zbudowany z rastra drobnych kropek, jak w druku atramentowym, więc przejścia tonalne są gładkie i bardzo zbliżone do klasycznej odbitki fotograficznej.

### 3.2 Budowa i przebieg druku

| Element                                | Funkcja                                                                                                                                            |
|--------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------|
| Głowica termiczna                      | Rząd miniaturowych elementów grzejnych; każdy nagrzewa się z inną intensywnością zależnie od jasności punktu.                                          |
| Wstęga barwiąca                        | Folia z kolejno powtarzającymi się panelami: żółtym (Y), purpurowym (M), błękitnym (C) oraz przezroczystą warstwą ochronną (overcoat). |
| Papier fotograficzny                   | Specjalny nośnik z powłoką chłonącą barwnik. Zwykle sprzedawany w zestawie z dopasowaną wstęgą.                                                        |
| Wałek dociskowy i mechanizm transportu | Dociska wstęgę z papierem do głowicy i wielokrotnie przesuwa papier tam i z powrotem.                                                                  |
| Kaseta ze wstęgą (kaseta/zestaw)       | Wymienny moduł, często z licznikiem odbitek; nie wolno stosować wstęgi niedopasowanej do modelu.                                                       |

Jedna odbitka powstaje w **czterech przebiegach**. Papier jest wciągany do drukarki, a następnie wielokrotnie cofany i przesuwany pod głowicą:

- **przebieg 1 – żółty (Y):** nanoszenie żółtego barwnika,

- **przebieg 2 – purpurowy (M):** nanoszenie purpurowego barwnika,

- **przebieg 3 – błękitny (C):** nanoszenie błękitnego barwnika; z trzech barw powstaje pełna paleta,

- **przebieg 4 – warstwa ochronna (overcoat):** przezroczysta warstwa chroniąca odbitkę przed wilgocią, odciskami palców i promieniowaniem UV; często nadaje też wykończenie błyszczące lub matowe.

Po czwartym przebiegu odbitka jest wysuwana – zazwyczaj gotowa, sucha i odporna na zarysowania, bez konieczności schnięcia.

### 3.3 Parametry techniczne

- **Rozdzielczość:** typowo 300 dpi (np. 300 × 300 lub 300 × 600); wysoka jakość wynika z ciągłego tonu, nie z samej liczby punktów.

- **Głębia koloru:** pełna paleta (ok. 16,7 mln barw) dzięki płynnej regulacji ilości barwnika.

- **Formaty odbitek:** najczęściej 10 × 15 cm, a także m.in. 13 × 18 cm i 15 × 20 cm.

- **Czas wydruku jednej odbitki:** od kilkunastu sekund do ok. minuty, zależnie od modelu i formatu.

- **Interfejsy:** USB, często także karta pamięci, Wi-Fi lub Ethernet.

- **Koszt odbitki:** stały, przewidywalny – wstęga i papier sprzedawane są w zestawie na określoną liczbę wydruków.

### 3.4 Zalety i wady

| Zalety                                              | Wady                                                              |
|---------------------------------------------------------|-----------------------------------------------------------------------|
| Jakość zbliżona do klasycznej fotografii, ciągły ton    | Wolniejszy wydruk jednej odbitki (cztery przebiegi)                   |
| Odbitka sucha, odporna na wodę, odciski i UV (overcoat) | Wyższy koszt jednej odbitki niż w druku atramentowym                  |
| Stałe, łatwe do policzenia koszty wydruku               | Konieczność używania dedykowanych zestawów (wstęga + papier)          |
| Kompaktowe, ciche, przystosowane do pracy mobilnej      | Ograniczone formaty; tylko fotografie i grafika, nie tekst dokumentów |
| Powtarzalność kolorów                                   | Duża wrażliwość na kurz i zabrudzenia głowicy                         |

### 3.5 Zastosowania

- fotokioski i punkty fotograficzne, fotobudki,

- fotografia okolicznościowa i eventowa (wydruk „na miejscu”),

- drukarki do kart plastikowych: legitymacje, identyfikatory, karty dostępu,

- zastosowania profesjonalne i medyczne wymagające trwałych, wiernych kolorów.

> **Uwaga na pojęcia**
>
> W praktyce słowa „sublimacja” używa się też do druku na kubkach i koszulkach: zwykła drukarka z tuszem sublimacyjnym drukuje na papierze transferowym, a obraz przenosi się na materiał w **prasie termicznej**. To inna technologia niż opisana tu drukarka dye-sub z wstęgą, choć opiera się na tym samym zjawisku.

### 3.6 Eksploatacja i typowe usterki

- Wymieniaj **całe zestawy** (wstęga + papier) zgodne z modelem drukarki.

- Chroń drukarkę przed **kurzem** – pojedyncze cząstki na papierze lub głowicy zostawiają białe kropki.

- Głowicę termiczną czyść wyłącznie zalecanymi środkami (np. izopropanol i miękki wacik, rolka czyszcząca) – nigdy narzędziami ostrymi.

- Unikaj dotykania papieru i głowicy palcami i wilgotnego otoczenia.

| Objaw                                                    | Najczęstsza przyczyna                   | Działanie                                              |
|--------------------------------------------------------------|---------------------------------------------|------------------------------------------------------------|
| Poziome smugi lub paski na odbitce                       | Zabrudzona lub uszkodzona głowica termiczna | Wyczyścić głowicę; przy uszkodzeniu wymienić               |
| Białe kropki lub drobne plamki                           | Kurz na papierze lub wstędze                | Przeczyścić wnętrze, wymienić zestaw, ograniczyć zapylenie |
| Wyblakłe lub przesunięte kolory                          | Niedopasowana wstęga/papier; zła kalibracja | Zastosować oryginalny zestaw; skalibrować drukarkę         |
| Zmarszczona wstęga, zacięcie, komunikat o błędzie kasety | Źle osadzony zestaw lub luz wstęgi          | Wyjąć i ponownie zamontować kasetę, napiąć wstęgę          |

## 4. Porównanie technologii

| Cecha                   | Drukarka igłowa                            | Drukarka termosublimacyjna                    |
|-----------------------------|------------------------------------------------|---------------------------------------------------|
| Zasada druku            | Uderzenie igieł przez taśmę barwiącą           | Sublimacja barwnika ze wstęgi pod wpływem ciepła  |
| Typ druku               | Uderzeniowy (impact)                           | Bezuderzeniowy, termiczny                         |
| Materiał eksploatacyjny | Taśma barwiąca, papier zwykły lub ciągły       | Wstęga (Y, M, C, overcoat) + papier fotograficzny |
| Jakość obrazu           | Niska; tekst i prosta grafika                  | Bardzo wysoka; druk ciągłotonalny, fotografia     |
| Kopie                   | Tak – papier samokopiujący                     | Nie                                               |
| Hałas                   | Wysoki                                         | Niski                                             |
| Koszt wydruku           | Bardzo niski                                   | Wyższy, stały na odbitkę                          |
| Typowe zastosowania     | Faktury, dokumenty wielodzielne, papier ciągły | Zdjęcia, fotokioski, karty plastikowe             |

## 5. Podsumowanie

- Drukarka igłowa drukuje **przez uderzenie** igieł w taśmę; jest głośna i mało dokładna, ale tania w eksploatacji, wytrzymała i **jedyna, która drukuje kopie** na papierze samokopiującym.

- Drukarka termosublimacyjna drukuje **barwnikiem sublimującym z wstęgi**, w czterech przebiegach (Y, M, C i overcoat), dając ciągłotonalne, trwałe odbitki fotograficzne.

- O wyborze urządzenia decyduje zadanie: dokumenty wielodzielne i papier ciągły – igłowa; zdjęcia i karty plastikowe – termosublimacyjna.

- Podstawą długiej żywotności obu drukarek jest właściwa eksploatacja: dobór papieru i materiałów, czystość oraz unikanie typowych błędów (druk bez papieru, kurz na głowicy).

## Słowniczek

| Pojęcie     | Znaczenie                                                             |
|-----------------|---------------------------------------------------------------------------|
| cps         | znaków na sekundę – miara szybkości druku drukarki igłowej                |
| Draft / NLQ | tryb szybki (szkic) / tryb wyższej jakości zbliżony do maszyny do pisania |
| ESC/P       | język sterowania drukarek Epson, powszechnie emulowany                    |
| Traktor     | mechanizm z kolcami prowadzący papier ciągły przez perforację             |
| Sublimacja  | przejście ze stanu stałego w gazowy z pominięciem cieczy                  |
| Overcoat    | przezroczysta warstwa ochronna nakładana jako ostatnia w drukarce dye-sub |
| Ciągły ton  | płynna zmiana intensywności barwy w każdym punkcie obrazu, bez rastra     |