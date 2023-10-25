<?php

/**
 * @author Pablo Uraga Martinez
 * @version 1.6.9
 */


$userRegex = '/\S{3,30}/';
$nameRegex = '/[A-z]{3,20}/';
$surnameRegex = '/[A-z]{3,40}/';
$idRegex = '/[0-9]{8}[A-Z]{1}/';
$addressRegex = '/^[0-9A-Za-z\s\.\,\-]+$/';
$mailRegex = '/\S+@\S+.[A-z]{2,3}/';
$phonenumberRegex = '/\d{9}/';
$dateRegex = '/\d{1,2}\/\d{1,2}\/\d{2,4}/';

if (isset($_POST['username'])) {
    // Comprobaciones campos texto
    if (trim(!preg_match($userRegex, $_POST['username']))) {
        $errores['username'] = empty($_POST['username']) ? 'El usuario no puede estar vacio' : 'El nombre de usuario debe tener entre 3 y 30 caracteres';
    }
    if (trim(!preg_match($nameRegex, $_POST['name']))) {
        $errores['name'] = empty($_POST['name']) ? 'El nombre no puede estar vacio' : 'El nombre debe tener entre 3 y 20 caracteres';
    }
    if (trim(!preg_match($surnameRegex, $_POST['surname']))) {
        $errores['surname'] = empty($_POST['surname']) ? 'Los apellidos no pueden estar vacios' : 'Los apellidos deben tener entre 3 y 40 caracteres';
    }
    if (trim(!preg_match($idRegex, $_POST['id']))) {
        $errores['id'] = empty($_POST['id']) ? 'El DNI no puede estar vacio' : 'El DNI debe estar compuesto de 8 numeros y 1 letra';
    }
    if (trim(!preg_match($addressRegex, $_POST['address']))) {
        $errores['address'] = empty($_POST['address']) ? 'La direccion no puede estar vacia' : 'La direccion puede contener letras mayusculas y minusculas, espacios, numeros, comas y guiones';
    }
    if (trim(!preg_match($mailRegex, $_POST['mail']))) {
        $errores['mail'] = empty($_POST['mail']) ? 'El correo electronico no puede estar vacio' : 'El correo electronico debe contener una @, letras y/o numeros antes y despues de esta, un punto y un dominio (.com, .co.uk...)';
    }
    if (trim(!preg_match($phonenumberRegex, $_POST['phonenumber']))) {
        $errores['phonenumber'] = empty($_POST['phonenumber']) ? 'El numero de telefono no puede estar vacio' : 'El numero de telefono debe estar compuesto de 9 numeros';
    }
    if (trim(!preg_match($dateRegex, $_POST['dateofbirth']))) {
        $errores['dateofbirth'] = empty($_POST['dateofbirth']) ? 'La fecha de nacimiento no puede estar vacia' : 'La fecha de nacimiento debe contener el siguiente formato: DD/MM/YY o DD/MM/YYYY';
    }



    // Comprobaciones CV
    if (empty($_FILES['cv']['name'])) {
        $errores['cv'] = 'Debes subir un CV';
    } elseif ($_FILES['cv']['error'] != UPLOAD_ERR_OK) {
        switch ($_FILES['cv']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $errores['cv'] = 'El fichero es demasiado grande';
                break;
            case UPLOAD_ERR_PARTIAL:
                $errores['cv'] = 'El fichero no se ha podido subir entero';
                break;
            case UPLOAD_ERR_NO_FILE:
                $errores['cv'] = 'No se ha podido subir el fichero';
                break;
        }
    } elseif ($_FILES['cv']['type'] != 'application/pdf') {
        $errores['cv'] = 'El CV tiene que ser un fichero pdf';
    } else if (!is_uploaded_file($_FILES['cv']['tmp_name'])) {
        $ruta = __DIR__ . '/img/files/' . $_FILES['cv']['name'];
        $movefilecv = move_uploaded_file($_FILES['cv']['tmp_name'], $ruta);
        if (is_file($ruta) === true) {
            $errores['cv'] = 'El fichero ya existe';
        }
        if (!$movefilecv) {
            $errores['cv'] = 'No se ha podido guardar el CV';
        }
        $errores['cv'] = 'Posible ataque';
    }

    // Comprobaciones foto
    if (empty($_FILES['photo']['name'])) {
        $errores['photo'] = 'Debes subir una foto';
    } elseif ($_FILES['photo']['error'] != UPLOAD_ERR_OK) {
        switch ($_FILES['photo']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $errores['photo'] = 'El fichero es demasiado grande';
                break;
            case UPLOAD_ERR_PARTIAL:
                $errores['photo'] = 'El fichero no se ha podido subir entero';
                break;
            case UPLOAD_ERR_NO_FILE:
                $errores['photo'] = 'No se ha podido subir el fichero';
                break;
        }
    } elseif ($_FILES['photo']['type'] != 'image/jpeg') {
        $errores['photo'] = 'La foto tiene que ser un fichero jpg/jpeg';
    } elseif (!is_uploaded_file($_FILES['photo']['tmp_name'])) {
        $ruta = __DIR__ . '/img/files/' . $_FILES['photo']['name'];
        $movefilephoto = move_uploaded_file($_FILES['photo']['tmp_name'], $ruta);
        if (is_file($ruta) === true) {
            $errores['photo'] = 'El fichero ya existe';
        }
        if (!$movefilephoto) {
            $errores['photo'] = 'No se ha podido guardar la foto';
        }
        $errores['photo'] = 'Posible ataque';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
</head>

<body>
    <?php
    // if (!empty($_POST) || isset($errores)) {
    ?>
        <form method="post" action="#" enctype="multipart/form-data">
            Usuario <input type="text" name="username" id="username" value="<?=$_POST['username']?? '' ?>"><br>
            <?=$errores['username']?? '' ?><br><br>

            Nombre <input type="text" name="name" id="name" value="<?=$_POST['name']?? '' ?>"><br>
            <?=$errores['name']?? '' ?><br><br>

            Apellidos <input type="text" name="surname" id="surname" value="<?=$_POST['surname']?? '' ?>"><br>
            <?=$errores['surname']?? '' ?><br><br>

            DNI <input type="text" name="id" id="id" value="<?=$_POST['id']?? '' ?>"><br>
            <?=$errores['id']?? '' ?><br><br>

            Direccion <br><input type="text" name="address" value="<?=$_POST['address']?? '' ?>"><br>
            <?=$errores['address']?? '' ?><br><br>

            Mail <input type="text" name="mail" id="mail" value="<?=$_POST['mail']?? '' ?>"><br>
            <?=$errores['mail']?? '' ?><br><br>

            Telefono <input type="text" name="phonenumber" id="phonenumber" value="<?=$_POST['phonenumber']?? '' ?>"><br>
            <?=$errores['phonenumber']?? '' ?><br><br>

            Fecha de nacimiento <input type="text" name="dateofbirth" id="dateofbirth" value="<?=$_POST['dateofbirth']?? '' ?>"><br>
            <?=$errores['dateofbirth']?? '' ?><br><br>

            Sube tu CV <input type="file" name="cv" id="cv"><br>
            <?=$errores['cv']?? '' ?><br><br>

            Sube tu foto <input type="file" name="photo" id="photo"><br>
            <?=$errores['photo']?? '' ?><br><br>

            <input type="submit" value="Enviar">

        </form>
    <?php
    // } else {
        ?>
        <h1>Todo correcto!</h1>
        <?php
    // }
    ?>

</body>

</html>