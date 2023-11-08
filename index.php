<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include_once(__DIR__ . '/include/head.inc.php');
    include_once(__DIR__ . '/include/connect.inc.php');
    ?>
</head>

<body>
    <?php
    $dbname = 'mysql:host=localhost;dbname=discografia';
    $dbuser = 'vetustamorla';
    $dbpassword = '15151';
    $dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    $connection = connect($dbname, $dbuser, $dbpassword, $dboptions);

    $getgrupos = $connection->query("SELECT nombre, codigo from grupos");

    while ($grupo = $getgrupos->fetch()) {
        $nombre = $grupo['nombre'];
        echo '<a href="group/' . $grupo['codigo'] . '">' . $nombre . '</a>';
        echo '<br>';
    }


    ?>
</body>

</html>