<?php
include_once(__DIR__ . '/include/head.inc.php');
include_once(__DIR__ . '/include/connect.inc.php');
$dbname = 'mysql:host=localhost;dbname=discografia';
$dbuser = 'vetustamorla';
$dbpassword = '15151';
$dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$connection = connect($dbname, $dbuser, $dbpassword, $dboptions);
$result = $connection->prepare("SELECT * from grupos g, albumes a WHERE g.codigo = a.grupo");
// $result->bindParam(1, $_GET['nombre_grupo']);
$result->execute();

// while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//     echo "Grupo: " . $row['nombre'] . "<br>";
//     echo "Título: " . $row['titulo'] . "<br>";
//     echo "<br>"; 
// }

echo '<pre>';
print_r($result->fetchAll(PDO::FETCH_ASSOC));
echo '</pre>';