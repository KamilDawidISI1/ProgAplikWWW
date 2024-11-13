<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);


if($_GET['idp'] =='') $strona = 'html/glowna.html';
if($_GET['idp']=='Dama') $strona = 'html/Dama.html';
if($_GET['idp']=='DTP') $strona = 'html/DTP.html';
if($_GET['idp']=='Form') $strona = 'html/From.html';
if($_GET['idp']=='Krym') $strona = 'html/Krym.html';
if($_GET['idp']=='NWP') $strona = 'html/NWP.html';
if($_GET['idp']=='Slow') $strona = 'html/Slow.html';

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="pl"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Kamil Dawid"/>
</head>
<body onload="startClock()">
<?php
    if (file_exists($strona)) {
        include($strona);
    } else
        echo 'Nie działa'
?>
</body>
</html>


