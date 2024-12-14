<link rel="stylesheet" href="css/styleadmin.css">
<?php
include("cfg.php");


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

function WyslijMailKontakt()
{
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
       $to = "kamil.dawid1234@gmail.com"; //adres docelowy
       $subject = "Wiadomość od: ".htmlspecialchars($_POST["name"]);
       $messege = "Wiadomość:\n".htmlspecialchars($_POST["message"])."\n\nOd".htmlspecialchars($_POST['name'])."(".htmlspecialchars($_POST['email']).")";
       $headers = "From:".htmlspecialchars($_POST["email"]);

       if (mail($to, $subject, $messege, $headers)) {
           echo '<p>Wiadomość została wysłana pomyślnie.</p>';
       } else {
           echo '<p>Wystąpił problem z wysłaniem wiadomości. Spróbuj ponownie.</p>';
       }
   } else {
       echo '<p>Wszystkie pola są wymagane.</p>';
   }

}

function PrzypomnijHaslo()
{
    global $pass;
    $email = 'kamil.dawid1234@gmail.com';
    $subject = 'Przypomnienie hasła';
    $password = $pass;
    $message = "Twoje hasło do panelu admina to: ".$password;

    if (mail($email, $subject, $message)) {
        echo '<p>Hasło zostało wysłane na adres e-mail administratora.</p>';
    } else {
        echo '<p>Wystąpił problem z wysłaniem hasła. Spróbuj ponownie.</p>';
    }
}