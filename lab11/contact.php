<!-- Łączenie z plikiem CSS, który zawiera style dla panelu administracyjnego -->
<link rel="stylesheet" href="css/styleadmin.css">
<?php
// Łączenie z plikiem konfiguracyjnym, który może zawierać ustawienia lub dane do połączenia z bazą danych
include("cfg.php");

// Funkcja wyświetlająca formularz kontaktowy
function PokazKontakt()
{
    echo '<div class="container">';
    echo '
    <h2>Formularz kontaktowy</h2>
    <form method="post" action="?akcja=kontakt">
        <label for="name">Imię i nazwisko:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">Treść wiadomości:</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>
        
        <input type="submit" value="Wyślij">
    </form>
    ';
    echo '</div>';
}

// Funkcja do obsługi wysyłania wiadomości e-mail z formularza kontaktowego
function WyslijMailKontakt()
{
    // Sprawdzamy, czy metoda żądania to POST i czy wszystkie pola formularza są wypełnione
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
       $to = "kamil.dawid1234@gmail.com"; //adres docelowy
       $subject = "Wiadomość od: ".htmlspecialchars($_POST["name"]);
       $messege = "Wiadomość:\n".htmlspecialchars($_POST["message"])."\n\nOd".htmlspecialchars($_POST['name'])."(".htmlspecialchars($_POST['email']).")";
       $headers = "From:".htmlspecialchars($_POST["email"]);

        // Próba wysłania wiadomości, jeśli uda się, wyświetlamy komunikat o sukcesie
        if (mail($to, $subject, $messege, $headers)) {
           echo '<p>Wiadomość została wysłana pomyślnie.</p>';
       } else {
           echo '<p>Wystąpił problem z wysłaniem wiadomości. Spróbuj ponownie.</p>'; // Komunikat o błędzie wysyłania
       }
   } else {
       echo '<p>Wszystkie pola są wymagane.</p>'; // Komunikat, jeśli użytkownik nie wypełnił wszystkich pól
   }

}

// Funkcja przypomnienia hasła do panelu admina
function PrzypomnijHaslo()
{
    global $pass; // Globalna zmienna zawierająca hasło admina
    $email = 'kamil.dawid1234@gmail.com'; // Adres e-mail administratora, na który wysyłamy przypomnienie
    $subject = 'Przypomnienie hasła'; // Tytuł wiadomości
    $password = $pass; // Przypomniane hasło
    $message = "Twoje hasło do panelu admina to: ".$password; // Treść wiadomości z hasłem

    // Próba wysłania wiadomości e-mail
    if (mail($email, $subject, $message)) {
        echo '<p>Hasło zostało wysłane na adres e-mail administratora.</p>';
    } else {
        echo '<p>Wystąpił problem z wysłaniem hasła. Spróbuj ponownie.</p>'; // Komunikat o błędzie wysyłania
    }
}