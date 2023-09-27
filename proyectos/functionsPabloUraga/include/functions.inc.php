<?php
// Calculo de la suma - devuelve int
function suma($number1, $number2) : int{
    return $number1+$number2;
}

// Calculo de la resta - devuelve int
function resta($number1, $number2) : int{
    return $number1-$number2;
}

// Calculo del producto - devuelve int
function multiplicacion($number1, $number2) : int{
    return $number1*$number2;
}

// Calculo de la division - devuelve float
function division($number1, $number2) : float{
    return $number1/$number2;
}

// Calculo del modulo - devuelve int
function modulo($number1, $number2) : int{
    return $number1-($number1/$number2);
}

// Calculo de la potencia - devuelve int
function potencia($number1, $number2) : float{
    return $number1**$number2;
}
?>