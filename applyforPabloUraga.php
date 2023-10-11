<?php

$errores = [];
$userRegex = '/\S{3,30}/';
$nameRegex = '/[A-z]{3,20}/';
$surnameRegex = '/[A-z]{3,40}/';
$idRegex = '/[0-9]{8}[A-Z]{1}/';
$addressRegex = '/^[0-9A-Za-z\s\.\,\-]+$/';
$mailRegex = '/\S+@\S+.[A-z]{2,3}/';
$phonenumberRegex = '/\d{9}/';
$dateRegex = '/\d{1,2}\/\d{1,2}\/\d{2,4}/';

if (isset($_POST['username'])) {
    if (!preg_match($userRegex, $_POST['username'])) {
        $errores[] = empty($_POST['username']) ? 'El usuario no puede estar vacio' : 'El nombre de usuario debe tener entre 3 y 30 caracteres';
    }
    if (!preg_match($nameRegex, $_POST['name'])) {
        $errores[] = empty($_POST['name']) ? 'El nombre no puede estar vacio' : 'El nombre debe tener entre 3 y 20 caracteres';
    }
    if (!preg_match($surnameRegex, $_POST['surname'])) {
        $errores[] = empty($_POST['surname']) ? 'Los apellidos no pueden estar vacios' : 'Los apellidos deben tener entre 3 y 40 caracteres';
    }
    if (!preg_match($idRegex, $_POST['id'])) {
        $errores[] = empty($_POST['id']) ? 'El DNI no puede estar vacio' : 'El DNI debe estar compuesto de 8 numeros y 1 letra';
    }
    if (!preg_match($addressRegex, $_POST['address'])) {
        $errores[] = empty($_POST['address']) ? 'La direccion no puede estar vacia' : 'La direccion puede contener letras mayusculas y minusculas, espacios, numeros, comas y guiones';
    }
    if (!preg_match($mailRegex, $_POST['mail'])) {
        $errores[] = empty($_POST['mail']) ? 'El correo electronico no puede estar vacio' : 'El correo electronico debe contener una @, letras y/o numeros antes y despues de esta, un punto y un dominio (.com, .co.uk...)';
    }
    if (!preg_match($phonenumberRegex, $_POST['phonenumber'])) {
        $errores[] = empty($_POST['phonenumber']) ? 'El numero de telefono no puede estar vacio' : 'El numero de telefono debe estar compuesto de 9 numeros';
    }
    if (!preg_match($dateRegex, $_POST['dateofbirth'])) {
        $errores[] = empty($_POST['dateofbirth']) ? 'La fecha de nacimiento no puede estar vacia' : 'La fecha de nacimiento debe contener el siguiente formato: DD/MM/YY o DD/MM/YYYY';
    }

    if (empty($errores)) {
        header("Location: /applyforPablouraga.php");
        exit;
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

    <div id="errores">
        <?php

        foreach ($errores as $error) {
            echo $error . '<br>';
        }

        ?>
    </div>

    <form method="post" action="#">
        Usuario <input type="text" name="username" id="username"><br><br>

        Nombre <input type="text" name="name" id="name"><br><br>

        Apellidos <input type="text" name="surname" id="surname"><br><br>

        DNI <input type="text" name="id" id="id"><br><br>

        Direccion <br><input type="text" name="address"><br><br>

        Mail <input type="text" name="mail" id="mail"><br><br>

        Telefono <input type="text" name="phonenumber" id="phonenumber"><br><br>
        
        Fecha de nacimiento <input type="text" name="dateofbirth" id="dateofbirth"><br><br>

        <input type="submit" value="Enviar">

    </form>



</body>

</html>