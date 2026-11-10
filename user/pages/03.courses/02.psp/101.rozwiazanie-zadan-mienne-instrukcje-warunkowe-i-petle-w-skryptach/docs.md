---
title: 'Rozwiązanie zadań - Zmienne, instrukcje warunkowe i pętle w skryptach'
published: true
access:
    site.testy: true
---

## Rozwiązania ćwiczeń (dla nauczyciela)

### L1

```bash
#!/bin/bash
read -p "Imię: " imie
read -p "Wiek: " wiek
read -p "Miasto: " miasto

rok=$(date +%Y)
urodzony=$((rok - wiek))

echo "Cześć, jestem $imie z miasta $miasto."
echo "Mam $wiek lat, więc urodziłem(-am) się około roku $urodzony."
```

### L2

```bash
#!/bin/bash
read -p "Podaj liczbę punktów (0-100): " p

if [ "$p" -lt 0 ] || [ "$p" -gt 100 ]; then
    echo "Punkty muszą być z zakresu 0-100" >&2
    exit 1
fi

if   [ "$p" -ge 90 ]; then ocena="bardzo dobry"
elif [ "$p" -ge 75 ]; then ocena="dobry"
elif [ "$p" -ge 50 ]; then ocena="dostateczny"
elif [ "$p" -ge 30 ]; then ocena="dopuszczający"
else                       ocena="niedostateczny"
fi

echo "Ocena: $ocena"
```

### L3

```bash
#!/bin/bash
read -p "Podaj n: " n

suma=0
for ((i = 1; i <= n; i++)); do
    suma=$((suma + i))
done
echo "Suma liczb od 1 do $n wynosi $suma"

for i in {1..10}; do
    echo "$n x $i = $((n * i))"
done
```

### L4

```bash
#!/bin/bash
cel=$((RANDOM % 100 + 1))
proby=0

while true; do
    read -p "Zgadnij liczbę (1-100): " strzal

    if [[ ! "$strzal" =~ ^[0-9]+$ ]]; then
        echo "To nie jest liczba całkowita, spróbuj jeszcze raz."
        continue
    fi

    proby=$((proby + 1))

    if [ "$strzal" -lt "$cel" ]; then
        echo "Za mało"
    elif [ "$strzal" -gt "$cel" ]; then
        echo "Za dużo"
    else
        echo "Brawo! Zgadłeś w $proby próbach."
        break
    fi
done
```

### W1

```bat
@echo off
set /p imie=Imie: 
set /p wiek=Wiek: 
set /a za5=wiek+5
echo Czesc, %imie%! Za 5 lat bedziesz miec %za5% lat.

set /p a=Dlugosc boku a: 
set /p b=Dlugosc boku b: 
set /a pole=a*b
echo Pole prostokata: %pole%
pause
```

### W2

```bat
@echo off
set /p n=Podaj liczbe calkowita: 
set /a r=n %% 2
if %r% equ 0 (
    echo Liczba %n% jest parzysta.
) else (
    echo Liczba %n% jest nieparzysta.
)
pause
```

### W3

```bat
@echo off
setlocal enabledelayedexpansion
set /p n=Podaj liczbe: 
for /l %%i in (1,1,10) do (
    set /a w=n*%%i
    echo %n% x %%i = !w!
)
endlocal
pause
```

### W4

```powershell
$cel = Get-Random -Minimum 1 -Maximum 101
$proby = 0
$limit = 7
$wygrana = $false

while ($proby -lt $limit -and -not $wygrana) {
    $strzal = [int](Read-Host "Zgadnij liczbę (1-100), próba $($proby + 1) z $limit")
    $proby++

    if ($strzal -lt $cel)     { Write-Host "Za mało" }
    elseif ($strzal -gt $cel) { Write-Host "Za dużo" }
    else                      { $wygrana = $true }
}

if ($wygrana) {
    Write-Host "Brawo! Zgadłeś w $proby próbach."
} else {
    Write-Host "Przegrana! Szukana liczba to $cel."
}
```

### Wskazówki do zadań samodzielnych

**Zadanie 1 (szkic w bash):**

```bash
#!/bin/bash
read -p "Podaj n: " n
for ((i = 2; i <= n; i++)); do
    czy_pierwsza=1
    for ((d = 2; d * d <= i; d++)); do
        if [ $((i % d)) -eq 0 ]; then
            czy_pierwsza=0
            break
        fi
    done
    [ "$czy_pierwsza" -eq 1 ] && echo "$i"
done
```

**Zadanie 5, FizzBuzz w bash:**

```bash
#!/bin/bash
for i in {1..30}; do
    if   [ $((i % 15)) -eq 0 ]; then echo "FizzBuzz"
    elif [ $((i % 3))  -eq 0 ]; then echo "Fizz"
    elif [ $((i % 5))  -eq 0 ]; then echo "Buzz"
    else echo "$i"
    fi
done
```

**Zadanie 5, FizzBuzz w PowerShell:**

```powershell
foreach ($i in 1..30) {
    if     ($i % 15 -eq 0) { "FizzBuzz" }
    elseif ($i % 3 -eq 0)  { "Fizz" }
    elseif ($i % 5 -eq 0)  { "Buzz" }
    else                   { $i }
}
```

> Kolejność warunków ma znaczenie: sprawdzenie `% 15` musi być **pierwsze**, bo liczba podzielna przez 15 jest też podzielna przez 3 i 5.

---