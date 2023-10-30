<?php
include_once(__DIR__ . '/include/head.inc.php');
include_once(__DIR__ . '/include/connect.inc.php');
$dbname = 'mysql:host=localhost;dbname=discografia';
$dbuser = 'vetustamorla';
$dbpassword = '15151';
$dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$connection = connect($dbname, $dbuser, $dbpassword, $dboptions);
$result = $connection->prepare("SELECT * from grupos WHERE nombre=?");
$result = $connection->prepare("SELECT * from grupos LEFT JOIN albumes WHERE nombre=?");
$result->bindParam(1, $_GET['nombre_grupo']);
$result->execute();
// echo $_GET['nombre_grupo'];
echo '<table>';
while ($group = $result->fetch(PDO::FETCH_ASSOC)) {
    echo 'Codigo: ' . $group['codigo'];
    echo '<br>Nombre: ' . $group['nombre'];
    echo '<br>Genero: ' . $group['genero'];
    echo '<br>Pais: ' . $group['pais'];
    echo '<br>Inicio: ' . $group['inicio'];
}
echo '</table>';