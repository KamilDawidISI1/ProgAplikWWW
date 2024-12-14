<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    $login = 'admin';
    $pass = '169232';


    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "moja_strona";

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("błąd połączenia: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");
?>
