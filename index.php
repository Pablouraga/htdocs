<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1: Agenda de contactos</title>
</head>

<body>
    <?php
    include_once(__DIR__.'/include/users.inc.php');
    foreach ($users as $usuario) {
        echo $usuario;
    }
    ?>
</body>

</html>