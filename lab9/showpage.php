<?php
// Funkcja do pobierania treści strony na podstawie aliasu i połączenia z bazą danych
function getPageContent($alias, $conn)
{
    // Sprawdzamy, czy alias zawiera tylko dozwolone znaki (litery, cyfry, myślniki i podkreślenia)
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $alias)) {
        die("Nieprawidłowy alias strony."); // Jeśli alias zawiera niepoprawne znaki, skrypt zostaje przerwany z komunikatem o błędzie
    }

    // Przygotowujemy zapytanie SQL do pobrania strony na podstawie aliasu i statusu (status = 1 oznacza, że strona jest aktywna)
    $stmt = $conn->prepare("SELECT * FROM `page_list` WHERE `alias` = ? AND `status` = 1 LIMIT 1");
    // Powiązanie parametru w zapytaniu z wartością aliasu (s oznacza typ parametru - string)
    $stmt->bind_param("s", $alias);
    // Wykonanie zapytania
    $stmt->execute();
    // Pobranie wyniku zapytania
    $result = $stmt->get_result();

    // Sprawdzamy, czy znaleziono jakikolwiek wynik (czy strona istnieje i jest aktywna)
    if ($result->num_rows > 0) {
        // Jeśli wynik jest, pobieramy dane strony jako tablicę asocjacyjną
        $row = $result->fetch_assoc();
        // Zwracamy zawartość strony
        return $row["page_content"];
    }
    else {
        // Jeśli strona nie istnieje lub jest nieaktywna, zwracamy komunikat o błędzie
        return "Strona nie istnieje lub jest nieaktywna";
    }
}
?>