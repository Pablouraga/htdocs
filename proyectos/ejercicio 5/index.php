<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reutilizando código</title>
    
</head>
<body>
    <?php
        $num1 = rand(1,5);
        $num2 = rand(1,5);
    ?>

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

    function suma($number1, $number2) : int{
        return $number1+$number2;
    }

    function resta($number1, $number2) : int{
        return $number1-$number2;
    }

    function multiplicacion($number1, $number2) : int{
        return $number1*$number2;
    }

    function division($number1, $number2) : float{
        return $number1/$number2;
    }

    function modulo($number1, $number2) : int{
        return $number1 % $number2;
    }

    function potencia($number1, $number2) : float{
        $resultado = 1;
        for ($i=0; $i < $number2; $i++) { 
            $resultado *= $number1;
        }
        return $resultado;
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