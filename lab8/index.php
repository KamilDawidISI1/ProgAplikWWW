<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include('cfg.php');
include('showpage.php');

$alias = isset($_GET['idp']) ? $_GET['idp'] : 'glowna';

$content = getPageContent($alias, $conn);

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
    echo $content;
?>
</body>
</html>


