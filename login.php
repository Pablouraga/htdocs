<?php

/**
 *	Script que implementa un carrito de la compra con variables de sesión
 * 
 *	@author Álex Torres
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    require_once('includes/header.inc.php');
    require_once('includes/dbconnection.inc.php');
    print_r($_POST);
    $connection = getDBConnection();
    if (isset($_POST['usernameOrEmail'])) {
        if ($_POST['usernameOrEmail'] != '' && $_POST['password'] != '') {
            $getUsernamesAndEmails = $connection->prepare('SELECT password FROM users WHERE user = ? OR email = ?');
            $getUsernamesAndEmails->execute([$_POST['usernameOrEmail'], $_POST['usernameOrEmail']]);
            $getUsernamesAndEmails = $getUsernamesAndEmails->fetch(PDO::FETCH_ASSOC);
            if (isset($getUsernamesAndEmails['password'])) {
                if (password_verify($_POST['password'], $getUsernamesAndEmails['password'])) {
                    $getRol = $connection->prepare('SELECT rol FROM users WHERE user = ? OR email = ?');
                    $getRol->execute([$_POST['usernameOrEmail'], $_POST['usernameOrEmail']]);
                    $getRol = $getRol->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['username'] = $_POST['usernameOrEmail'];
                    $_SESSION['rol'] = $getRol['rol'];
                    header('Location: /');
                    exit;
                } else {
                    $errorMsg = 'Credenciales invalidas';
                }
            } else {
                $errorMsg = 'Credenciales invalidas';
            }
        } else {
            $errorMsg = 'Credenciales invalidas';
        }
    }
    ?>
    <form action="login.php" method="post">
        <?= $errorMsg ?? '' ?><br>
        <label for="usernameOrEmail">Usuario o Email:</label>
        <input type="text" name="usernameOrEmail"><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password"><br>

        <label for="checkbox">Recordarme durante 30 dias</label>
        <input type="checkbox" name="autologin30d" id="autologin30d"><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>

</html>