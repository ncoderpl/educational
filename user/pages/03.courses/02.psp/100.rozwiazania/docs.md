---
title: 'Rozwiązania zadań - Tworzenie skryptów w systemie Windows i Linux '
published: true
access:
    site.testy: true
---

## 10. Rozwiązania ćwiczeń (dla nauczyciela)

### L1

```bash
#!/bin/bash
echo "Witaj w świecie skryptów!"
echo "Użytkownik: $USER"
echo "Data: $(date +%Y-%m-%d)"
```

Bez prawa wykonywania pojawi się komunikat `Permission denied`. Po `chmod +x hello.sh` skrypt działa. Przykładowy zapis uprawnień: `-rwxr-xr-x`, liczbowo `755`.

### L2

```bash
#!/bin/bash
if [ $# -eq 0 ]; then
    echo "Użycie: $0 imię" >&2
    exit 1
fi
echo "Witaj, $1!"
```

### L3

```bash
#!/bin/bash
read -p "Podaj pierwszą liczbę: " a
read -p "Podaj drugą liczbę: " b
read -p "Działanie (+ - x /): " op

case "$op" in
    +) echo "Wynik: $((a + b))" ;;
    -) echo "Wynik: $((a - b))" ;;
    x) echo "Wynik: $((a * b))" ;;
    /)
        if [ "$b" -eq 0 ]; then
            echo "Nie dziel przez zero!" >&2
            exit 1
        fi
        echo "Wynik: $((a / b))"
        ;;
    *)
        echo "Nieznane działanie" >&2
        exit 1
        ;;
esac
```

### L4

```bash
#!/bin/bash
katalog="${1:-.}"
suma=0
znaleziono=0

for plik in "$katalog"/*.txt; do
    [ -e "$plik" ] || continue
    linie=$(wc -l < "$plik")
    echo "$plik: $linie linii"
    suma=$((suma + linie))
    znaleziono=1
done

if [ "$znaleziono" -eq 0 ]; then
    echo "Brak plików .txt w katalogu $katalog"
    exit 1
fi
echo "Razem: $suma linii"
```

### L5

Wpis w `crontab` (pełne ścieżki, nazwę użytkownika dostosuj):

```
*/5 * * * * /home/uczen/skrypty/backup.sh
```

### W1

```bat
@echo off
echo Witaj w swiecie skryptow!
echo Uzytkownik: %USERNAME%
echo Komputer: %COMPUTERNAME%
echo Data: %DATE%
pause
```

### W2

```bat
@echo off
if "%~1"=="" (
    echo Uzycie: pozdrow.bat imie
    exit /b 1
)
echo Witaj, %~1!
```

### W3

```bat
@echo off
:menu
cls
echo ===== MENU =====
echo 1. Data i godzina
echo 2. Adres IPv4
echo 3. Uruchomione procesy
echo 0. Wyjscie
choice /c 1230 /n /m "Wybierz opcje: "
if errorlevel 4 goto koniec
if errorlevel 3 goto procesy
if errorlevel 2 goto ip
if errorlevel 1 goto data

:data
echo %date% %time%
pause
goto menu

:ip
ipconfig | findstr /i "IPv4"
pause
goto menu

:procesy
tasklist
pause
goto menu

:koniec
exit /b 0
```

### W4

```powershell
param(
    [string]$Sciezka = ".",
    [int]$Ile = 5
)

if (-not (Test-Path $Sciezka)) {
    Write-Host "Folder nie istnieje: $Sciezka" -ForegroundColor Red
    exit 1
}

Get-ChildItem -Path $Sciezka -File |
    Sort-Object Length -Descending |
    Select-Object -First $Ile -Property Name, @{Name = "KB"; Expression = { [math]::Round($_.Length / 1KB, 1) }}
```

### W5

Skrypt `backup.ps1` znajduje się w podrozdziale 4.2. Przykładowe polecenie harmonogramu:

```bat
schtasks /create /tn "TestBackup" /tr "powershell -File C:\skrypty\backup.ps1" /sc once /st 15:30
schtasks /delete /tn "TestBackup" /f
```

---