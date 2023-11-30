<?php

/**
 * Script that implements a shopping cart with session variables
 * 
 * @author Álex Torres
 */
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    require_once('includes/header.inc.php');
    require_once('includes/dbconnection.inc.php');
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
                    if ($_POST['autologin30d'] == 'on') {
                        $token = bin2hex(random_bytes(90));
                        $insertToken = $connection->prepare('UPDATE users SET token = (?) WHERE user = ?');
                        $insertToken->execute([$token, $_SESSION['username']]);
                        setcookie('token', $token, time() + 60 * 60 * 24 * 30, '/');
                    }
                    header('Location: /');
                    exit;
                } else {
                    $errorMsg = 'Credenciales inválidas';
                }
            } else {
                $errorMsg = 'Credenciales inválidas';
            }
        } else {
            $errorMsg = 'Credenciales inválidas';
        }
    }
    ?>
    <form action="login.php" method="post">
        <?= $errorMsg ?? '' ?><br>
        <label for="usernameOrEmail"><?= $message['usernameOrEmail'] ?></label>
        <input type="text" name="usernameOrEmail"><br>

        <label for="password"><?= $message['password'] ?></label>
        <input type="password" name="password"><br>

        <label for="checkbox"><?= $message['remember30d'] ?></label>
        <input type="checkbox" name="autologin30d" id="autologin30d"><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>

</html>
