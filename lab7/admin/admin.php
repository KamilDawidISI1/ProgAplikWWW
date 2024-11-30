<?php
include('../cfg.php');

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
        </form>
    ';
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loguj']))
{
    global $login, $pass;
    $user = $_POST['login'];
    $password = $_POST['pass'];

    if($user == $login && $password == $pass)
    {
        $_SESSION['zalogowany'] = true;
        header('Location: admin.php');
        echo "<p>Zalogowano! Witaj ".$login."</p>>";
        exit();
    }
    else
    {
        FormularzLogowania('Nieprawidłowy login lub hasło');
    }
}
if(!isset($_SESSION['zalogowany']) || !$_SESSION['zalogowany']) {
    FormularzLogowania();
    exit();
}

echo '<p>Panel Administracyjny</p>';
echo '<p>Wybierz akcję</p>';

echo '<form method="GET">
    <label for="id">Podaj ID (tylko dla edycji/usuwania):</label>
    <input type="number" id="id" name="id" min="1">
    
    <button type="submit" name="akcja" value="lista">Lista podstron</button>
    <button type="submit" name="akcja" value="dodaj">Dodaj nową podstronę</button>
    <button type="submit" name="akcja" value="edytuj">Edytuj podstronę</button>
    <button type="submit" name="akcja" value="usun">Usuń podstronę</button>
</form>';


function ListaPodstron()
{
    global $conn;
    echo '<h2>Lista Podstron</h2>>';
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
}

function EdytujPodstrone($id)
{
    global $conn;
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['zapisz']))
    {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;
        $alias = isset($_POST['alias']) ? 1 : 0;

        $conn->query("UPDATE page_list SET page_title = '$title', content = '$content', status = '$status', alias = '$alias' WHERE id = '$id'");
        echo '<p>Podstrona zaktualizowana!</p>';
    }
}

function DodajNowaPodstrone()
{
    global $conn;
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dodaj']))
    {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;
        $alias = isset($_POST['alias']) ? 1 : 0;

        $conn->query("INSERT INTO page_list (page_title, page_content, status, alias) VALUES ('$title', '$content', '$status', '$alias')");
    }
}

function UsunPodstrone($id)
{
    global $conn;
    $conn->query("DELETE FROM page_list WHERE id = '$id' LIMIT 1");
    echo '<p>Podstrona została usunięta!</p>';
}

if(isset($_GET['akcja']))
{
    switch ($_GET['akcja'])
    {
        case 'lista':
            ListaPodstron();
            break;
        case 'edytuj':
            if(isset($_GET['id']))
            {
                EdytujPodstrone($_GET['id']);
            }
            else
            {
                echo '<p>Błąd: brak ID podstrony!</p>';
            }
            break;
        case 'dodaj':
            DodajNowaPodstrone();
            break;
        case 'usun':
            if(isset($_GET['id']))
            {
                UsunPodstrone($_GET['id']);
            }
            else
            {
                echo '<p>Błąd: brak ID podstrony!</p>';
            }
            break;
        default:
            echo '<p>Nieznana akcja!</p>';
    }
}


?>
