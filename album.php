<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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

    print_r($_POST);
    print_r($_GET);

    if (isset($_POST['submit'])) {
        $doInsert = true;

        //comprobaciones de que los campos son validos, errores etc
        if (empty($_POST['titulo'])) {
            $doInsert = false;
            $errormsg['titulo'] = "El titulo no puede estar vacio";
        } else if (strlen($_POST['titulo']) > 50) {
            $doInsert = false;
            $errormsg['titulo'] = "El titulo no puede tener mas de 50 caracteres";
        }
        if (!preg_match('^[0-9]{1,2}:[0-5]{1,2}$^', $_POST['duracion'])) {
            $doInsert = false;
            $errormsg['duracion'] = "La duración no es valida";
        }

        if ($doInsert === true) {
            $sqlinsert = $connection->prepare("INSERT INTO canciones (titulo, album, duracio, posicion) VALUES (?, ?, ?, ?)");
            $sqlinsert->execute([$_POST['titulo']], $_GET['codigo'], $_POST['duracion'], $_POST['posicion']);
        }

    }

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

    $getcountcanciones = $connection->prepare("SELECT count(*) FROM canciones WHERE album = ?");
    $getcountcanciones->execute([$_GET['codigo']]);
    $posnuevacancion = $getcountcanciones->fetch(PDO::FETCH_ASSOC)['count(*)'];

    echo '<h2>' . $groupinfo['nombre'] . '</h2>';
    echo '<h3>' . $getalbuminfo->fetch(PDO::FETCH_ASSOC)['titulo'] . '</h3>';

    echo '<table border=2><tr><td>Titulo</td><td>Duracion</td>';
    while ($canciones = $getcanciones->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $canciones['titulo'] . '</td>';
        $duracion = $canciones['duracion'];

        $minutes = floor($duracion / 60);
        $seconds = $duracion % 60;

        if ($seconds < 10) {
            $seconds = '0' . $seconds;
        }

        echo '<td>' . $minutes . ':' . $seconds . '</td>';
    }
    ?>
    </table>

    <div id="addnew">

        <h3>Crear nueva cancion</h3>

        <form method="post" action="">
            <input type="text" name="titulo" id="titulo" placeholder="Titulo"><br><br>

            <input type="number" name="duracion" id="duracion" placeholder="Duracion (minutos:segundos)"><br>

            <input type="hidden" name="album" value="<?php echo $_GET['codigo']; ?>"><br>
            <input type="hidden" name="posicion" value="<?= $posnuevacancion + 1 ?>">
            <input type="submit" name="submit" value="Crear nueva cancion">
        </form><br>

    </div>
    <a href="/group/<?= $groupinfo['codigo'] ?>">Volver a <?= $groupinfo['nombre'] ?></a>
</body>

</html>