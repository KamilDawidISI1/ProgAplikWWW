<link rel="stylesheet" href="../css/styleadmin.css">
<?php
// Wczytanie plików konfiguracyjnych i funkcji kontaktowych
include('../cfg.php');
include("../contact.php");

/**
 * Funkcja FormularzLogowania()
 * Wyświetla formularz logowania. Można podąć komunikat o błędzie, jeśli podane dane logowania są nieprawidłowe.
 */
function FormularzLogowania($error = '')
{
    echo '<h2>Panel Logowania</h2>';

    if ($error) {
        echo '<p style="color: red;">' . $error . '</p>';
    }

    echo '
    <form method="POST">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required><br>
        <label for="pass">Hasło:</label>
        <input type="password" name="pass" id="pass" required><br>
        <button type="submit" name="loguj">Zaloguj</button>
        <button type="submit" name="akcja" value="przypomnij_haslo">Przypomnij hasło</button>
        </form>
    ';
}
// Obsługa logowania
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loguj']))
{
    global $login, $pass; // Pobranie danych z pliku cfg.php
    $user = $_POST['login'];
    $password = $_POST['pass'];

    // Pobranie danych z pliku cfg.php
    if($user == $login && $password == $pass)
    {
        $_SESSION['zalogowany'] = true; // Ustawienie sesji zalogowanego użytkownika
        header('Location: admin.php'); // Przekierowanie do panelu administracyjnego
        echo "<p>Zalogowano! Witaj ".$login."</p>>";
        exit();
    }
    else
    {
        FormularzLogowania('Nieprawidłowy login lub hasło');
    }
}

// Sprawdzenie, czy użytkownik jest zalogowany
if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany']) {
    FormularzLogowania();
    exit();
}


// Wyświetlenie głównego panelu administracyjnego
echo '<div class="container">';
echo '<p>Panel Administracyjny</p>';
echo '<p>Wybierz akcję</p>';

// Formularz wyboru akcji z możliwością podania ID
echo '<form method="GET">
    <label for="id">Podaj ID (tylko dla edycji/usuwania):</label>
    <input type="number" id="id" name="id" min="1">
    
    <button type="submit" name="akcja" value="lista">Lista podstron</button>
    <button type="submit" name="akcja" value="dodaj">Dodaj nową podstronę</button>
    <button type="submit" name="akcja" value="edytuj">Edytuj podstronę</button>
    <button type="submit" name="akcja" value="usun">Usuń podstronę</button>
    <button type="submit" name="akcja" value="kontakt">Kontakt</button>
</form>';

echo '</div>';



/**
 * Funkcja ListaPodstron()
 * Pobiera i wyświetla listę podstron z bazy danych. Dla każdej podstrony dodaje opcje edycji i usunięcia.
 */
function ListaPodstron()
{
    global $conn;
    echo '<div class="container">';
    echo '<h2>Lista Podstron</h2>';
    $result = $conn->query("SELECT id, page_title FROM page_list ORDER BY id ASC");

    if($result->num_rows > 0)
    {
        echo '<table style="border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Akcje</th>
                </tr>';
        while($row = $result->fetch_assoc())
        {
            echo '<tr>
                    <td>' . $row["id"] . '</td>
                    <td>' . $row["page_title"] . '</td>
                    <td>
                        <a href="?akcja-edutuj&id=' . $row["id"] . '">Edytuj</a>
                        <a href="?akcja-usun&id=' . $row["id"] . '">Usuń</a>
                    </td>
                  </tr>';
        }
        echo '</table>';
    }
    else
    {
        echo '<p>Brak podstron w badzie danych</p>';
    }
    echo '</div>';
}


/**
 * Funkcja EdytujPodstrone($id)
 * Wyświetla formularz edycji podstrony i pozwala zapisać zmiany do bazy danych.
 * Parametr $id określa, którą podstronę edytujemy.
 */
function EdytujPodstrone($id)
{
    global $conn;
    echo '<div class="container">';

    // Pobranie danych podstrony z bazy
    $result = $conn->query("SELECT * FROM page_list WHERE id = '$id' LIMIT 1");
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        echo '<form method="POST">
              <label for="title">Tytuł:</label>
              <input type="text" name="title" id="title" value="'.htmlspecialchars($row['page_title']).'"><br>
              <label for="content">Treść:</label>
              <textarea id="content" name="content">'.htmlspecialchars($row['page_content']).'</textarea><br>
              <label for="status">Aktywna:</label>
              <input type="checkbox" name="status" id="status"' . ($row['status'] ? 'checked' : '') . '><br>
              <label for="alias">Alias:</label>
              <input type="text" name="alias" id="alias" value="'.htmlspecialchars($row['alias']).'"><br>
              <button type="submit" name="zapisz">Zapisz</button>   
        </form>';
    }
    else
    {
        echo '<p>Brak podstron w badzie danych</p>';
    }

    // Obsługa zapisu zmian do bazy
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['zapisz']))
    {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;
        $alias = isset($_POST['alias']) ? 1 : 0;

        $conn->query("UPDATE page_list SET page_title = '$title', content = '$content', status = '$status', alias = '$alias' WHERE id = '$id'");
        echo '<p>Podstrona zaktualizowana!</p>';
    }
    echo '</div>';
}


/**
 * Funkcja DodajNowaPodstrone()
 * Wyświetla formularz dodawania nowej podstrony i zapisuje dane do bazy.
 */
function DodajNowaPodstrone()
{
    global $conn;
    echo '<div class="container">';
    echo '<h2>Dodaj Nową Podstronę</h2>';
    echo '<form method="POST">
        <label for="title">Nazwa:</label>
        <input type="text" name="title" id="title" required><br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required></textarea><br>
        <label for="status">Aktywna:</label>
        <input type="checkbox" id="status" name="status"><br>
        <label for="alias">Alias:</label>
        <input type="text" name="alias" id="alias" required><br>
        <button type="submit" name="dodaj">Dodaj</button>
    </form>';

    // Obsługa dodawania nowej podstrony do bazy
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dodaj']))
    {
        // Zabezpieczenie danych wejściowych przed SQL Injection
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;
        $alias = isset($_POST['alias']) ? 1 : 0;

        // Zapytanie SQL do dodania nowej podstrony
        $conn->query("INSERT INTO page_list (page_title, page_content, status, alias) VALUES ('$title', '$content', '$status', '$alias')");

        // Potwierdzenie operacji
        echo '<p>Nowa podstrona została dodana!</p>';
    }
    echo '</div>';
}

/**
 * Funkcja DodajNowaPodstrone()
 * Po wpisaniu id strony usuwa ją z bazy danych.
 */
function UsunPodstrone($id)
{
    global $conn;
    echo '<div class="container">';
    // Usuwanie podstrony o podanym ID
    $conn->query("DELETE FROM page_list WHERE id = '$id' LIMIT 1");
    echo '<p>Podstrona została usunięta!</p>';
    echo '</div>';
}

// Obsługa akcji na podstawie wartości parametru 'akcja' w URL
if(isset($_GET['akcja']))
{
    switch ($_GET['akcja'])
    {
        case 'lista': // Wyświetlenie listy podstron
            ListaPodstron();
            break;
        case 'edytuj': // Edycja istniejącej podstrony
            if(isset($_GET['id']))
            {
                EdytujPodstrone($_GET['id']); // Wywołanie funkcji edycji z ID
            }
            else
            {
                echo '<p>Błąd: brak ID podstrony!</p>';
            }
            break;
        case 'dodaj': // Dodawanie nowej podstrony
            DodajNowaPodstrone();
            break;
        case 'usun': // Usuwanie podstrony
            if(isset($_GET['id']))
            {
                UsunPodstrone($_GET['id']); // Wywołanie funkcji usunięcia z ID
            }
            else
            {
                echo '<p>Błąd: brak ID podstrony!</p>';
            }
            break;
        case 'kontakt': // Wywołanie modułu kontaktowego
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                WyslijMailKontakt(); // Wysłanie maila z formularza kontaktowego
            } else {
                PokazKontakt(); // Wyświetlenie formularza kontaktowego
            }
            break;
        case 'przypomnij_haslo': // Przypomnienie hasła admina
            PrzypomnijHaslo();
            break;
        default: // Obsługa nieznanej akcji
            echo '<p>Nieznana akcja!</p>';
    }
}


?>
