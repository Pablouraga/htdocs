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
    /**
     * @author Pablo Uraga
     * @version 1.0.0
     */
    $dbname = 'mysql:host=localhost;dbname=discografia';
    $dbuser = 'vetustamorla';
    $dbpassword = '15151';
    $dboptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $connection = connect($dbname, $dbuser, $dbpassword, $dboptions);

    if (isset($_POST['submit'])) {
        $doInsert = true;

        //comprobaciones de que los campos son validos, errores etc
        if (empty($_POST['nombre'])) {
            $doInsert = false;
            $errormsg['nombre'] = "El nombre no puede estar vacio";
        } else if (strlen($_POST['nombre']) > 50) {
            $doInsert = false;
            $errormsg['nombre'] = "El nombre debe contener 50 caracteres como maximo";
        }
        if (empty($_POST['genero'])) {
            $doInsert = false;
            $errormsg['genero'] = "El genero no puede estar vacio";
        } else if (strlen($_POST['genero']) > 50) {
            $doInsert = false;
            $errormsg['genero'] = "El genero debe contener 50 caracteres como maximo";
        }
        if (empty($_POST['pais'])) {
            $doInsert = false;
            $errormsg['pais'] = "El pais no puede estar vacio";
        } else if (strlen($_POST['pais']) > 20) {
            $doInsert = false;
            $errormsg['pais'] = "El pais debe contener 20 caracteres como maximo";
        }

        if ($doInsert === true) {
            //Insertamos en la base de datos
            $sqlinsert = $connection->prepare("INSERT INTO grupos (nombre, genero, pais, inicio) VALUES (?, ?, ?, ?)");
            $sqlinsert->execute([$_POST['nombre'], $_POST['genero'], $_POST['pais'], $_POST['inicio']]);
            unset($_POST);   
        }

    }


    $getgrupos = $connection->query("SELECT nombre, codigo from grupos");

    while ($grupo = $getgrupos->fetch()) {
        $nombre = $grupo['nombre'];
        echo '<a href="group/' . $grupo['codigo'] . '">' . $nombre . '</a>';
        echo '<br>';
    }

    ?>
    <div id="addnew group">
        <h3>Crear nuevo grupo</h3>
        <form action="#" method="post">

            <!-- <label for="nombre">Nombre:</label><br> -->
            <input type="text" name="nombre" id="nombre" value="<?= $_POST['nombre'] ?? '' ?>" placeholder="Nombre del grupo"><br>
            <?php if (isset($errormsg['nombre'])) {
                echo $errormsg['nombre'];
            } ?><br>

            <!-- <label for="genero">Genero:</label><br> -->
            <input type="text" name="genero" id="genero" value="<?= $_POST['genero'] ?? '' ?>" placeholder="Genero"><br>
            <?php if (isset($errormsg['genero'])) {
                echo $errormsg['genero'];
            } ?><br>

            <!-- <label for="pais">País:</label><br> -->
            <input type="text" name="pais" id="pais" value="<?= $_POST['pais'] ?? '' ?>" placeholder="Pais"><br>
            <?php if (isset($errormsg['pais'])) {
                echo $errormsg['pais'];
            }
            ?><br>

            <label for="inicio">Año de inicio:</label>
                <select name="inicio" id="inicio">
                    <?php

                    for ($i = 1990; $i <= 2023; $i++) {
                        if ($_POST['inicio'] == $i) {
                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                        } else {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                    ?>
                </select><br>
            <?php if (isset($errormsg['inicio'])) {
                echo $errormsg['inicio'];
            } ?><br>

            <input type="submit" name="submit" value="Crear nuevo grupo">

        </form>
    </div>
</body>

</html>