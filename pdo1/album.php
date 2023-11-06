<?php
include_once(__DIR__ . '/include/head.inc.php');
include_once(__DIR__ . '/include/connect.inc.php');
$dbname = 'mysql:host=localhost;dbname=discografia';
$dbuser = 'vetustamorla';
$dbpassword = '15151';
$dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$connection = connect($dbname, $dbuser, $dbpassword, $dboptions);
$getalbuminfo = $connection->prepare("SELECT titulo FROM albumes WHERE codigo = ?");
$getalbuminfo->bindParam(1, $_GET['codigo']);
$getalbuminfo->execute();

$getcanciones = $connection->prepare("SELECT titulo, duracion FROM canciones WHERE album = ?");
$getcanciones->bindParam(1, $_GET['codigo']);
$getcanciones->execute();

// echo $_GET['codigo'];

while ($album = $getalbuminfo->fetch(PDO::FETCH_ASSOC)) {
    echo $album['titulo'];
    while ($canciones = $getcanciones->fetchAll(PDO::FETCH_ASSOC)) {
        echo $canciones['titulo'];
    }
    echo '<br>';
}

// echo '<h1>' . $getalbuminfo->fetch(PDO::FETCH_ASSOC) . '</h1>';

echo '<pre>';
print_r($getcanciones->fetchAll(PDO::FETCH_ASSOC));
echo '</pre>';
