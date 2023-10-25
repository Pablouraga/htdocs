<?php
// Modificar el ejercicio anterior para que envíe los datos mediante POST y que valide con expresiones regulares los datos recibidos y en caso de no cumplir con los requisitos mostrar errores en un mismo bloque antes del formulario.
// - Código -> una letra seguida de un guion seguido de 5 dígitos.
// - Nombre -> solo letras (mínimo 3 y máximo 20).
// - Precio -> decimal.
// - Descripción -> alfanumérico (mínimo 50 letras).
// - Fabricante -> alfanumérico (entre 10 y 20 letras).
// - Fecha de adquisición -> fecha.
// - Ningún campo puede estar en blanco.

$errores = [];
$codeRegex = '/[A-z]-\d{5}/';
$nameRegex = '/[A-z]{3,20}/';
$priceRegex = '/^\d+\.\d{1,2}/';
$descRegex = '/[A-z]{50,}/';
$makerRegex = '/\S{10,20}/';
$dateRegex = '/\d{1,2}\/\d{1,2}\/\d{2,4}/';

if (isset($_POST['code'])) {
    if (!preg_match($codeRegex, $_POST['code'])) {
        if (empty($_POST['code'])) {
            $errores[] = "El campo Código no puede estar vacio";
        } else {
            $errores[] = "El campo Código debe tener una letra seguida de un guion y 5 digitos";
        }
    }
    if (!preg_match($nameRegex, $_POST['name'])) {
        if (empty($_POST['name'])) {
            $errores[] = "El campo Nombre no puede estar vacio";
        } else {
            $errores[] = "El campo Nombre debe tener entre 3 y 20 letras";
        }
    }
    if (!preg_match($priceRegex, $_POST['price'])) {
        if (empty($_POST['price'])) {
            $errores[] = "El campo Precio no puede estar vacio";
        } else {
            $errores[] = "El campo Precio debe ser decimal";
        }
    }
    if (!preg_match($descRegex, $_POST['description'])) {
        if (empty($_POST['description'])) {
            $errores[] = "El campo Descripcion no puede estar vacio";
        } else {
            $errores[] = "El campo Descripcion debe tener un minimo de 50 letras";
        }
    }
    if (!preg_match($makerRegex, $_POST['maker'])) {
        if (empty($_POST['maker'])) {
            $errores[] = "El campo Fabricante no puede estar vacio";
        } else {
            $errores[] = "El campo Fabricante debe tener entre 10 y 20 caracteres";
        }
    }
    if (!preg_match($dateRegex, $_POST['adquisitionDate'])) {
        if (empty($_POST['adquisitionDate'])) {
            $errores[] = "El campo Fecha de Adquisicion no puede estar vacio";
        } else {
            $errores[] = "El campo Fecha de Adquisicion debe ser una fecha";
        }
    }

    if (empty($errores)) {
        header("Location: /actividad2PabloUraga.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>

    <div id="errores">
        <?php

        foreach ($errores as $error) {
            echo $error . '<br>';
        }

        ?>
    </div>

    <form method="post" action="#">
        Codigo <input type="text" name="code" id="code"><br><br>

        Nombre <input type="text" name="name" id="name"><br><br>

        Precio <input type="text" name="price" id="price"><br><br>

        Descripcion<br><input type="text" name="description" rows="10" cols="50"></textarea><br><br>

        Fabricante <input type="text" name="maker" id="maker"><br><br>

        Fecha de adquisicion <input type="text" name="adquisitionDate" id="adquisitionDate"><br><br>

        <input type="submit" value="Enviar">

    </form>



</body>

</html>