<?php
include_once(__DIR__ . '/include/head.inc.php');
include_once(__DIR__ . '/include/connect.inc.php');
$dbname = 'mysql:host=localhost;dbname=discografia';
$dbuser = 'vetustamorla';
$dbpassword = '15151';
$dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$connection = connect($dbname, $dbuser, $dbpassword, $dboptions);


$getgrupo = $connection->prepare("SELECT g.nombre, g.codigo FROM grupos g, albumes a WHERE a.codigo = ? AND a.grupo = g.codigo");
$getgrupo->bindParam(1, $_GET['codigo']);
$getgrupo->execute();
$groupinfo = $getgrupo->fetch(PDO::FETCH_ASSOC);

$getalbuminfo = $connection->prepare("SELECT titulo FROM albumes WHERE codigo = ?");
$getalbuminfo->bindParam(1, $_GET['codigo']);
$getalbuminfo->execute();

$getcanciones = $connection->prepare("SELECT titulo, duracion FROM canciones WHERE album = ?");
$getcanciones->bindParam(1, $_GET['codigo']);
$getcanciones->execute();



echo '<h2>' . $groupinfo['nombre'] . '</h2>';
echo '<h3>' . $getalbuminfo->fetch(PDO::FETCH_ASSOC)['titulo'] . '</h3>';

echo '<table border=2><tr><td>Titulo</td><td>Duracion</td>';
while ($canciones = $getcanciones->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $canciones['titulo'] . '</td>';
    $duracion = $canciones['duracion'];

    $minutes = floor($duracion/60);
    $seconds = $duracion%60;

    if ($seconds < 10) {
        $seconds = '0' . $seconds;
    }

    echo '<td>' . $minutes . ':' . $seconds . '</td>';
}
echo '</table>';

echo '<a href="/group/' . $groupinfo['codigo'] . '">Volver</a>';