<?php

/**
 *	Script que implementa un carrito de la compra con variables de sesión
 * 
 *	@author Álex Torres
 */
session_start();
require_once('includes/dbconnection.inc.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require_once('includes/header.inc.php');
    if (isset($_POST['username'])) {
        $connection = getDBConnection();
        $users = $connection->prepare('SELECT COUNT(*) FROM users WHERE user=? OR email=?');
        $users->execute([$_POST['username'], $_POST['email']]);
        $users = $users->fetch(PDO::FETCH_ASSOC);
        $canRegister = true;

        //Si no hay ningun usuario con ese nombre y/o email
        if ($users['COUNT(*)'] == 0) {
            //Validacion username
            if (empty($_POST['username'])) {
                $errorMsg['username'] = 'El nombre de usuario no puede estar vacio';
                $canRegister = false;
            } else if (strlen($_POST['username']) > 20) {
                $errorMsg['username'] = "El nombre no puede tener mas de 20 caracteres";
                $canRegister = false;
            }

            //Validacion Email
            if (empty($_POST['email'])) {
                $errorMsg['email'] = 'La direccion de correo electronico no puede estar vacia';
                $canRegister = false;
            } else if (strlen($_POST['email']) > 80) {
                $errorMsg['email'] = 'La direccion de correo electronico no puede tener mas de 80 caracteres';
                $canRegister = false;
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errorMsg['email'] = 'La direccion de correo electronico no es valida';
                $canRegister = false;
            }

            //Validacion password
            if (empty($_POST['password'])) {
                $errorMsg['password'] = 'La contraseña no puede estar vacia';
                $canRegister = false;
            } else if (strlen($_POST['password']) > 255) {
                $errorMsg['password'] = 'La contraseña no puede tener mas de 255 caracteres';
                $canRegister = false;
            } else if (strlen($_POST['password']) < 3) {
                $errorMsg['password'] = 'La contraseña no puede tener menos de 3 caracteres';
                $canRegister = false;
            }
        } else {
            $errorMsg['global'] = 'Ya hay un usuario registrado con estas credenciales';
            $canRegister = false;
        }

        if ($canRegister) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $insertNewUser = $connection->prepare("INSERT INTO users (user, email, password) VALUES (?, ?, ?)");
            $insertNewUser->execute([$_POST['username'], $_POST['email'], $password]);
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['rol'] = $_POST['rol'];
            header('Location: /');
            exit;
        } else {
            foreach ($errorMsg as $error) {
                echo $error . '<br>';
            }
    ?>

            <br><a href="index.php"><button>Volver</button></a>

    <?php
        }
    }
    ?>


</body>

</html>