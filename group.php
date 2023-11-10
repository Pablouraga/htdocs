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

    if (isset($_POST['submit'])) {
        $doInsert = true;
        if (empty($_POST['titulo'])) {
            $doInsert = false;
            $errormsg['titulo'] = "El titulo no puede estar vacio";
        } else if (strlen($_POST['titulo']) > 50) {
            $doInsert = false;
            $errormsg['titulo'] = "El titulo debe contener 50 caracteres como maximo";
        }
        if (empty($_POST['boughtdate'])) {
            $doInsert = false;
            $errormsg['boughtdate'] = "La fecha de compra no puede estar vacia";
        }
        if (empty($_POST['price'])) {
            $errormsg['price'] = 'El precio es obligatorio.';
        } else if (!is_numeric($_POST['price'])) {
            $errormsg['price'] = 'El precio debe ser un número decimal.';
        } else {
            $_POST['price'] = number_format($_POST['price'], 2, '.', '');
        }

        if ($doInsert === true) {

            $sqlinsert = $connection->prepare("INSERT INTO albumes (titulo, grupo, anyo, formato, fechacompra, precio) VALUES (?,?,?,?,?,?)");
            $sqlinsert->execute([$_POST['titulo'], $_POST['group'], $_POST['anyo'], $_POST['format'], $_POST['boughtdate'], $_POST['price']]);
        }
    }

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

    $getalbums = $connection->prepare("SELECT * FROM albumes where grupo = ?");
    $getalbums->bindParam(1, $codgrupo);
    $getalbums->execute();

    ?>
    <!-- título, año, formato, fecha de compra y precio -->

    <table>
        <tr>
            <td>Titulo</td>
            <td>Año</td>
            <td>Formato</td>
            <td>Fecha de compra</td>
            <td>Precio</td>
            <?php
            while ($row = $getalbums->fetch(PDO::FETCH_ASSOC)) {
                $albumcode = $row['codigo'];
                echo '<tr>';
                echo '<td><a href="/album/' . $row['codigo'] . '">' . $row['titulo'] . '</td>';
                echo '<td>' . $row['anyo'] . '</td>';
                echo '<td>' . $row['formato'] . '</td>';
                echo '<td>' . $row['fechacompra'] . '</td>';
                echo '<td>' . $row['precio'] . '</td>';
                echo '</tr>';
            }
            ?>
    </table>

    <?php

    //Formatos disponibles
    $sqlinsert = $connection->prepare("SELECT COLUMN_TYPE from information_schema.COLUMNS where TABLE_NAME = 'albumes' AND COLUMN_NAME='formato'");
    $sqlinsert->execute();

    $formats = $sqlinsert->fetch(PDO::FETCH_ASSOC)['COLUMN_TYPE'];
    $formats = str_replace("'", "", explode(',', substr($formats, 5, -1)));
    ?>

    <div id="addnew album">
        <h3>Crear nuevo album</h3>
        <form action="#" method="post">

            <input type="text" name="titulo" id="titulo" value="<?= $_POST['titulo'] ?? '' ?>" placeholder="Titulo del album"><br>
            <?php if (isset($errormsg['titulo'])) {
                echo $errormsg['titulo'] . '<br>';
            } ?><br>

            <label for="anyo">Año de publicacion:</label>
            <select name="anyo" id="anyo">
                <?php

                for ($i = 1990; $i <= 2023; $i++) {
                    if ($_POST['anyo'] == $i) {
                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                    } else {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                }
                ?>
            </select><br>
            <?php if (isset($errormsg['anyo'])) {
                echo $errormsg['anyo'] . '<br>';
            } ?><br>

            <label for="format">Formato del album:</label>
            <select name="format" id="format">
                <?php
                foreach ($formats as $format) {
                    if ($_POST['format'] == $format) {
                        echo '<option value="' . $format . '" selected>' . $format . '</option>';
                    } else {
                        echo '<option value="' . $format . '">' . $format . '</option>';
                    }
                }

                ?>
            </select><br>
            <?php if (isset($errormsg['format'])) {
                echo $errormsg['format'] . '<br>';
            } ?><br>

            <label for="boughtdate">Fecha de compra: </label>
            <input type="date" name="boughtdate" id="boughtdate" value="<?php echo $_POST['boughtdate'] ?? ''; ?>"><br>
            <?php if (isset($errormsg['boughtdate'])) {
                echo $errormsg['boughtdate'] . '<br>';
            } ?><br>

            <label for="price">Precio: </label><br>
            <input type="number" name="price" id="price" value="<?= $_POST['price'] ?? '' ?>" placeholder="19.99" step="0.01"><br><br>

            <input type="hidden" name="group" value="<?= $_GET['codigo'] ?>">
            <input type="submit" name="submit" value="Crear nuevo album"><br><br>

        </form>
    </div>


    <a href="/index">Volver</a>

</body>

</html>