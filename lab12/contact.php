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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function WyslijMailKontakt()
{
    // Sprawdzenie, czy formularz został wysłany
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"], $_POST["email"], $_POST["message"])) {
        $name = htmlspecialchars($_POST["name"]);   // Pobranie i oczyszczenie pola "name"
        $email = htmlspecialchars($_POST["email"]); // Pobranie i oczyszczenie pola "email"
        $messageContent = htmlspecialchars($_POST["message"]); // Pobranie i oczyszczenie pola "message"

        $mail = new PHPMailer(true);

        try {
            //Konfiguracja serwera SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dopocztyphp@gmail.com';
            $mail->Password   = 'qssy cblq swoh cdmv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Ustawienie nadawcy
            $mail->setFrom($email, $name);

            //Ustawienie odbiorcy
            $mail->addAddress('dopocztyphp@gmail.com', 'Administrator');

            //Treść
            $mail->isHTML(true);
            $mail->Subject = "Wyslij do $name";
            $mail->Body    = "<b>Wiadomość: </b><br>$messageContent";
            $mail->AltBody = $messageContent;

            //Wysłanie wiadomości
            $mail->send();
            echo 'Wiadomość została wysłana';
        } catch (Exception $e) {
            //Obsługa błędu
            echo '<p>Wystąpił problem z wysłaniem wiadomości: ' . $mail->ErrorInfo . '</p>';
        }
    } else {
        echo 'Wszystkie pola są wymagane';
    }
}

// Funkcja przypomnienia hasła do panelu admina
function PrzypomnijHaslo()
{
    global $pass; // Globalna zmienna zawierająca hasło admina
    $email = 'dopocztyphp@gmail.com'; // Adres e-mail administratora, na który wysyłamy przypomnienie
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