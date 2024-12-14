<?php
// Sprawdzamy, czy sesja jest już rozpoczęta, jeśli nie, rozpoczynamy ją.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    // Ustalamy dane logowania do aplikacji
    $login = 'admin';
    $pass = '169232';

    // Parametry połączenia z bazą danych
    $host = "localhost"; // Adres hosta bazy danych (localhost dla lokalnego serwera)
    $username = "root"; // Adres hosta bazy danych (localhost dla lokalnego serwera)
    $password = ""; // Hasło użytkownika bazy danych
    $database = "moja_strona"; // Nazwa bazy danych, z którą chcemy się połączyć

    // Tworzymy połączenie z bazą danych
    $conn = new mysqli($host, $username, $password, $database);

    // Sprawdzamy, czy połączenie z bazą danych zakończyło się błędem
    if ($conn->connect_error) {
        die("błąd połączenia: " . $conn->connect_error); // W razie błędu kończymy skrypt i wyświetlamy komunikat
    }
    // Ustawiamy kodowanie znaków na UTF-8, aby zapewnić poprawność wyświetlania znaków
    $conn->set_charset("utf8");
?>
