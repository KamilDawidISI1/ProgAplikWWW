<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if ($_GET['idp'] == '') {
    $strona = 'html/glowna.html';
} elseif ($_GET['idp'] == 'Dama') {
    $strona = 'html/Dama.html';
} elseif ($_GET['idp'] == 'DTP') {
    $strona = 'html/DTP.html';
} elseif ($_GET['idp'] == 'Krym') {
    $strona = 'html/Krym.html';
} elseif ($_GET['idp'] == 'NWP') {
    $strona = 'html/NWP.html';
} elseif ($_GET['idp'] == 'Slow') {
    $strona = 'html/Slow.html';
} else {
    $strona = 'html/glowna.html';
}

if (file_exists($strona)) {
    include($strona);
} else {
    echo "Nie znaleziono strony.";
}

?>





<!DOCTYPE html>
<html lang="pl">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="pl" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Author" content="Kamil Dawid" />
  <title>Moje hobby to podcasty</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/kolorujtlo.js" type="text/javascript"></script>
  <script src="js/timedate.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function () {
      $("header").click(function (){
        $(this).toggleClass("header_animation")
      });
    });
  </script>

</head>
<body onload="startClock()">

</body>
</html>