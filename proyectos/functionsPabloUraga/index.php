<?php
/**
  * Unidad 1 Actividad 5
  * @author Pablo Uraga
  * @version 1.0.0
  */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reutilizando código</title>
    <link rel="stylesheet" href="/styles/styles.css">
    
</head>
<body>
    <?php
        include_once(__DIR__.'/include/functions.inc.php');
        $num1 = rand(1,100);
        $num2 = rand(1,100);
    ?>
    <h1>Pablo Uraga Martinez</h1>
    <p>El primer numero es <?=$num1?></p>
    <p>El segundo es <?=$num2?></p>
    <?php 
    if ($num1 === $num2) {
        echo('Los dos numeros son iguales');
    } else {
        echo('<p>El elemento mayor es '.max($num1, $num2));
    }
    echo('<br><br>');
    if ($num1 % 2 != 0) {
        echo('El primer numero es impar');
    } else {
        echo('El primer numero es par');
    }
    echo('<br>');
    if ($num2 % 2 != 0) {
        echo('El segundo numero es impar');
    } else {
        echo('El segundo numero es par');
    }
    ?>

    <p>La suma es <?=suma($num1,$num2)?></p>
    <p>La resta es <?=resta($num1,$num2)?></p>
    <p>La multiplicacion es <?=multiplicacion($num1,$num2)?></p>
    <p>La division es <?=division($num1,$num2)?></p>
    <p>El modulo es <?=modulo($num1,$num2)?></p>
    <p>La potencia es <?=potencia($num1,$num2)?></p>

</body>
</html>