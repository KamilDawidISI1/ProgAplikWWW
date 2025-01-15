<?php
// Ustawienie poziomu raportowania błędów, ignorujemy powiadomienia o brakujących zmiennych (E_NOTICE) i ostrzeżeniach (E_WARNING)
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Dołączenie pliku konfiguracyjnego (cfg.php), który zawiera ustawienia połączenia z bazą danych
include('cfg.php');
// Dołączenie pliku, który zapewne zawiera funkcję do pobierania treści strony (showpage.php)
include('showpage.php');

// Sprawdzamy, czy w parametrze GET 'idp' jest wartość. Jeśli tak, przypisujemy ją do zmiennej $alias, w przeciwnym razie ustawiamy 'glowna' jako domyślny alias
$alias = isset($_GET['idp']) ? $_GET['idp'] : 'glowna';

// Pobieramy treść strony na podstawie aliasu i połączenia z bazą danych, wynik zapisujemy do zmiennej $content
$content = getPageContent($alias, $conn);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Określenie typu dokumentu oraz kodowania znaków (UTF-8) -->
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <!-- Określenie języka strony (Polski) -->
    <meta http-equiv="Content-Language" content="pl"/>
    <!-- Ustawienia widoku dla urządzeń mobilnych, aby strona była responsywna -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Podanie autora strony -->
    <meta name="Author" content="Kamil Dawid"/>
</head>
<!-- Funkcja JavaScript 'startClock' z js/timedate.js jest uruchamiana po załadowaniu strony -->
<body onload="startClock()">
<?php
    // Wyświetlamy treść strony, która została pobrana w zmiennej $content
    echo $content;
?>
</body>
</html>


