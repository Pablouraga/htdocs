<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $generateSections = 5;
    for ($count = 1; $count <= $generateSections; $count++) {
        echo'<li><a href="#sec-'.$count.'">Seccion '.$count.'</a></li>';
    }
    ?>  
</body>
</html>
<!-- <li><a href="sec-'.$count.">Seccion '.$count.'</a></li> -->

<!-- '<li>Seccion '.$count.'</li>'