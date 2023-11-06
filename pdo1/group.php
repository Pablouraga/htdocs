<?php
include_once(__DIR__ . '/include/head.inc.php');
include_once(__DIR__ . '/include/connect.inc.php');
$dbname = 'mysql:host=localhost;dbname=discografia';
$dbuser = 'vetustamorla';
$dbpassword = '15151';
$dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$connection = connect($dbname, $dbuser, $dbpassword, $dboptions);
$getgroups = $connection->prepare("SELECT * FROM grupos WHERE codigo = ?");
$getgroups->bindParam(1, $_GET['codigo']);
$getgroups->execute();

while ($row = $getgroups->fetch(PDO::FETCH_ASSOC)) {
    $codgrupo = $row['codigo'];
    echo "Grupo: " . $row['nombre'] . "<br>";
    echo "Genero: " . $row['genero'] . "<br>";
    echo "Pais: " . $row['pais'] . "<br>";
    echo "Inicio: " . $row['inicio'] . "<br>";
    echo "<br>";
}

// echo $codgrupo;

// echo '<pre>';
// print_r($getgroups->fetchAll(PDO::FETCH_ASSOC));
// echo '</pre>';

$getalbums = $connection->prepare("SELECT * FROM albumes where grupo = ?");
$getalbums->bindParam(1, $codgrupo);
$getalbums->execute();

//título, año, formato, fecha de compra y precio

echo '<table><tr><td>Titulo</td><td>Año</td><td>Formato</td><td>Fecha de compra</td><td>Precio</td>';
while ($row = $getalbums->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td><a href="album.php?codigo=' . $row['codigo'] . '">' . $row['titulo'] . '</td>';
    echo '<td>' . $row['anyo'] . '</td>';
    echo '<td>' . $row['formato'] . '</td>';
    echo '<td>' . $row['fechacompra'] . '</td>';
    echo '<td>' . $row['precio'] . '</td>';
    echo '</tr>';
}
echo '</table>';

// echo '<pre>';
// print_r($getalbums->fetchAll(PDO::FETCH_ASSOC));
// echo '</pre>';
