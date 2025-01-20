<link rel="stylesheet" href="../css/styleadmin.css">
<?php
// Wczytanie plików konfiguracyjnych i funkcji kontaktowych
include('../cfg.php');
include("../contact.php");
include("../CategoryManager.php");
include("../ProductManager.php");

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
    $haslo = $_POST['pass'];

    // Pobranie danych z pliku cfg.php
    if($user == $login && $haslo == $pass)
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
    <button type="submit" name="akcja" value="kategorie">Zarządzaj kategoriami</button>
    <button type="submit" name="akcja" value="produkty">Zarządzaj produktami</button>
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

        $conn->query("UPDATE page_list SET page_title = '$title', page_content = '$content', status = '$status', alias = '$alias' WHERE id = '$id'");
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

function DodajProdukt($productManager) {
    echo '<div class="column">
        <h3>Dodaj Produkt</h3>
        <form method="POST" enctype="multipart/form-data">
            <label for="tytul">Tytuł:</label>
            <input type="text" name="tytul" required>
            <label for="opis">Opis:</label>
            <textarea name="opis" required></textarea>
            <label for="data_wygasniecia">Data Wygaśnięcia:</label>
            <input type="date" name="data_wygasniecia" required>
            <label for="cena_netto">Cena Netto:</label>
            <input type="number" step="0.01" name="cena_netto" required>
            <label for="podatek_vat">Podatek VAT (%):</label>
            <input type="number" step="0.01" name="podatek_vat" required>
            <label for="ilosc">Ilość:</label>
            <input type="number" name="ilosc" required>
            <label for="status_dostepnosci">Dostępność:</label>
            <select name="status_dostepnosci">
                <option value="1">Dostępny</option>
                <option value="0">Niedostępny</option>
            </select>
            <label for="kategoria">ID Kategorii:</label>
            <input type="number" name="kategoria" required>
            <label for="gabaryt">Gabaryt:</label>
            <input type="text" name="gabaryt">
            <label for="zdjecie">Zdjęcie:</label>
            <input type="file" name="zdjecie" accept="image/*" required>
            <button type="submit" name="add_product">Dodaj</button>
        </form>
    </div>';

    // Obsługa dodawania produktu
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
        $uploadDir = 'uploads/'; // Katalog na serwerze do przechowywania zdjęć
        $fileName = basename($_FILES['zdjecie']['name']); // Nazwa pliku
        $uploadFile = $uploadDir . uniqid() . "_" . $fileName; // Unikalna nazwa pliku

        // Sprawdzenie, czy katalog istnieje, jeśli nie - utworzenie
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Przesyłanie pliku na serwer
        if (move_uploaded_file($_FILES['zdjecie']['tmp_name'], $uploadFile)) {
            // Jeśli przesyłanie się powiedzie, zapisz ścieżkę w bazie danych
            $zdjecieSciezka = $uploadFile;

            $productManager->addProduct(
                $_POST['tytul'],
                $_POST['opis'],
                $_POST['data_wygasniecia'],
                $_POST['cena_netto'],
                $_POST['podatek_vat'],
                $_POST['ilosc'],
                $_POST['status_dostepnosci'],
                $_POST['kategoria'],
                $_POST['gabaryt'],
                $zdjecieSciezka
            );

            echo '<p class="success">Produkt został dodany!</p>';
        } else {
            echo '<p class="error">Wystąpił problem z przesyłaniem zdjęcia.</p>';
        }
    }
}



function EdytujProdukt($productManager) {
    echo '<div class="column">
        <h3>Edytuj Produkt</h3>
        <form method="POST" enctype="multipart/form-data">
            <label for="id">ID Produktu:</label>
            <input type="number" name="id" required>
            <label for="tytul">Nowy Tytuł:</label>
            <input type="text" name="tytul" required>
            <label for="opis">Nowy Opis:</label>
            <textarea name="opis" required></textarea>
            <label for="data_wygasniecia">Nowa Data Wygaśnięcia:</label>
            <input type="date" name="data_wygasniecia" required>
            <label for="cena_netto">Nowa Cena Netto:</label>
            <input type="number" step="0.01" name="cena_netto" required>
            <label for="podatek_vat">Nowy Podatek VAT (%):</label>
            <input type="number" step="0.01" name="podatek_vat" required>
            <label for="ilosc">Nowa Ilość:</label>
            <input type="number" name="ilosc" required>
            <label for="status_dostepnosci">Dostępność:</label>
            <select name="status_dostepnosci">
                <option value="1">Dostępny</option>
                <option value="0">Niedostępny</option>
            </select>
            <label for="kategoria">Nowe ID Kategorii:</label>
            <input type="number" name="kategoria" required>
            <label for="gabaryt">Nowy Gabaryt:</label>
            <input type="text" name="gabaryt">
            <label for="zdjecie">Nowe Zdjęcie:</label>
            <input type="file" name="zdjecie" accept="image/*">
            <button type="submit" name="edit_product">Edytuj</button>
        </form>
    </div>';

    // Obsługa edycji produktu
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
        $uploadDir = 'uploads/'; // Katalog na serwerze do przechowywania zdjęć
        $zdjecieSciezka = null;

        // Sprawdzenie, czy przesłano nowe zdjęcie
        if (!empty($_FILES['zdjecie']['name'])) {
            $fileName = basename($_FILES['zdjecie']['name']);
            $uploadFile = $uploadDir . uniqid() . "_" . $fileName;

            // Sprawdzenie, czy katalog istnieje, jeśli nie - utworzenie
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Przesyłanie pliku na serwer
            if (move_uploaded_file($_FILES['zdjecie']['tmp_name'], $uploadFile)) {
                $zdjecieSciezka = $uploadFile;
            } else {
                echo '<p class="error">Wystąpił problem z przesyłaniem zdjęcia.</p>';
                return;
            }
        }

        // Aktualizacja produktu w bazie danych
        $productManager->editProduct(
            $_POST['id'],
            $_POST['tytul'],
            $_POST['opis'],
            $_POST['data_wygasniecia'],
            $_POST['cena_netto'],
            $_POST['podatek_vat'],
            $_POST['ilosc'],
            $_POST['status_dostepnosci'],
            $_POST['kategoria'],
            $_POST['gabaryt'],
            $zdjecieSciezka
        );
        echo '<p class="success">Produkt został zaktualizowany!</p>';
    }
}


function UsunProdukt($productManager) {
    echo '<div class="column">
        <h3>Usuń Produkt</h3>
        <form method="POST">
            <label for="id">ID Produktu:</label>
            <input type="number" name="id" required>
            <button type="submit" name="delete_product">Usuń</button>
        </form>
    </div>';

    // Obsługa usuwania produktu
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
        $productManager->deleteProduct($_POST['id']);
        echo '<p class="success">Produkt został usunięty!</p>';
    }
}

function WyswietlProdukty($productManager) {
    echo '<div class="column">';
    echo '<h3>Lista Produktów</h3>';

    // Pobranie listy produktów
    $products = $productManager->getAllProducts();

    if (!empty($products)) {
        echo '<table class="products-table">';
        echo '<thead>';
        echo '<tr>
                <th>ID</th>
                <th>Tytuł</th>
                <th>Opis</th>
                <th>Cena Netto</th>
                <th>Podatek VAT</th>
                <th>Ilość</th>
                <th>Status</th>
                <th>Kategoria</th>
                <th>Data Wygaśnięcia</th>
              </tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($products as $product) {
            $status = $product['status_dostepnosci'] ? 'Dostępny' : 'Niedostępny';
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['id']) . '</td>';
            echo '<td>' . htmlspecialchars($product['tytul']) . '</td>';
            echo '<td>' . htmlspecialchars($product['opis']) . '</td>';
            echo '<td>' . number_format($product['cena_netto'], 2) . ' PLN</td>';
            echo '<td>' . htmlspecialchars($product['podatek_vat']) . '%</td>';
            echo '<td>' . htmlspecialchars($product['ilosc']) . '</td>';
            echo '<td>' . $status . '</td>';
            echo '<td>' . htmlspecialchars($product['kategoria']) . '</td>';
            echo '<td>' . htmlspecialchars($product['data_wygasniecia']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Brak produktów w bazie danych.</p>';
    }
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
        case 'kategorie':
            global $host, $database, $username, $password;
            $categoryManager = new CategoryManager($host, $database, $username, $password);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['add_category'])) {
                    $matka = $_POST['matka'];
                    $nazwa = $_POST['nazwa'];
                    $opis = $_POST['opis'];
                    $categoryManager->addCategory($matka, $nazwa, $opis);
                    echo "<p>Kategoria dodana!</p>";
                } elseif (isset($_POST['edit_category'])) {
                    $id = $_POST['id'];
                    $nazwa = $_POST['nazwa'];
                    $opis = $_POST['opis'];
                    $categoryManager->editCategory($id, $nazwa, $opis);
                    echo "<p>Kategoria zaktualizowana!</p>";
                } elseif (isset($_POST['delete_category'])) {
                    $id = $_POST['id'];
                    $categoryManager->deleteCategory($id);
                    echo "<p>Kategoria usunięta!</p>";
                }
            }

            // Wyświetlenie formularzy i listy kategorii
            echo '<h2>Zarządzanie Kategoriami</h2>';

            echo '
<div class="manage-categories">
    <div class="column">
        <h3>Dodaj Kategorię</h3>
        <form method="POST">
        <label for="matka">Kategoria nadrzędna:</label>
        <select name="matka">
            <option value="0">Brak</option>';
            $categories = $categoryManager->getAllCategories();
            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['nazwa']}</option>";
            }
            echo '</select>
        <label for="nazwa">Nazwa:</label>
        <input type="text" name="nazwa" required>
        <label for="opis">Opis:</label>
        <textarea name="opis"></textarea>
        <button type="submit" name="add_category">Dodaj</button>
        </form>
    </div>';

            echo '
    <div class="column">
        <h3>Edytuj Kategorię</h3>
        <form method="POST">
        <label for="id">ID Kategorii:</label>
        <input type="number" name="id" required>
        <label for="nazwa">Nowa nazwa:</label>
        <input type="text" name="nazwa" required>
        <label for="opis">Nowy opis:</label>
        <textarea name="opis"></textarea>
        <button type="submit" name="edit_category">Edytuj</button>
        </form>
    </div>';

            echo '
    <div class="column">
        <h3>Usuń Kategorię</h3>
        <form method="POST">
        <label for="id">ID Kategorii:</label>
        <input type="number" name="id" required>
        <button type="submit" name="delete_category">Usuń</button>
        </form>
    </div>
</div>';

            echo '
<div class="category-list">
    <h3>Lista Kategorii</h3>';
            $categoryManager->showCategories();
            break;
        case 'produkty':
            global $host, $database, $username, $password;
            echo '<h2>Zarządzanie Produktami</h2>';
            require_once '../ProductManager.php'; // Ładowanie klasy ProductManager
            $productManager = new ProductManager($host, $database, $username, $password);

            // Menu wyboru akcji
            echo '<div class="products-menu">';
            echo '<form method="GET">';
            echo '<input type="hidden" name="akcja" value="produkty">';
            echo '<button type="submit" name="dzialanie" value="dodaj">Dodaj Produkt</button>';
            echo '<button type="submit" name="dzialanie" value="edytuj">Edytuj Produkt</button>';
            echo '<button type="submit" name="dzialanie" value="usun">Usuń Produkt</button>';
            echo '<button type="submit" name="dzialanie" value="wyswietl">Wyświetl Produkty</button>';
            echo '</form>';
            echo '</div>';

            // Obsługa akcji na podstawie wyboru użytkownika
            if (isset($_GET['dzialanie'])) {
                switch ($_GET['dzialanie']) {
                    case 'dodaj':
                        DodajProdukt($productManager);
                        break;
                    case 'edytuj':
                        EdytujProdukt($productManager);
                        break;
                    case 'usun':
                        UsunProdukt($productManager);
                        break;
                    case 'wyswietl':
                        WyswietlProdukty($productManager);
                        break;
                    default:
                        echo '<p>Nieznane działanie.</p>';
                }
            } else {
                echo '<p>Wybierz akcję z menu powyżej.</p>';
            }
            break;
        default: // Obsługa nieznanej akcji
            echo '<p>Nieznana akcja!</p>';
            echo '</div>';
    }
}


?>
