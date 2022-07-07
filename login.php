<?php // PHP-код 

$host='localhost';
$login='admin';
$password='Vorobev2601';
$dbname='turfirma';
$link = mysqli_connect($host, $login, $password, $dbname);

mysqli_query($link, 'set names utf8');
mysqli_query($link, "SET CHARACTER 'utf8'");
mysqli_query($link, "SET SESSION collation_connection = 'utf8_general_ci';");

?>