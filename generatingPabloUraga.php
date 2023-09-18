<?php
$generateSections = 5;
    echo('<ul>');
    for ($count = 1; $count <= $generateSections; $count++) {
        echo'<li><a href="#sec-'.$count.'">Seccion '.$count.'</a></li>';
    }
    echo('</ul>');
?>

    <div id="sec-1"><h1>Negativo - Cero - Positivo</h1>
    
    <?php
    $generatedNumber = rand(-200,200);
    $result = $generatedNumber <=> 0;
    if($result == -1) {
        $result = "negativo";
    } else if ($result == 0) {
        $result = "cero";
    } else {
        $result = "positivo";
    }
    echo('El numero '.$generatedNumber.' es '.$result.'</div><br>');
    ?>
    <div id="sec-2"><h1>Nota</h1>
    <?php

    $generatedMark = rand(0,10);
    switch ($generatedMark) {
        case '0':
        case '1':
        case '2':
            $finalMark = 'insuficiente';
            break;
        case '3':
        case '4':
            $finalMark = 'necesita mejorar';
            break;
        case '5':
            $finalMark = 'aprobado justito';
            break;
        case '6':
            $finalMark = 'aprobado';
            break;
        case '7':
            $finalMark = 'notable bajo';
            break;
        case '8':
            $finalMark = 'notable';
            break;
        case '9':
        case '10':
            $finalMark = 'sobresaliente';
            break;
        default:
            echo('Valor no valido');
    }
    ?>
    Martina Fez tiene una nota media de: <?=$finalMark?> </div>

    <?php
    $generatedMultiply = rand(0,100);
    echo('<div id="sec-3"><h1>Tabla de multiplicar del '.$generatedMultiply.'</h1>');
    
    $timesToMultiply = 20;
    echo('<table border="1"><tr><td>x</td><td>'.$generatedMultiply.'</td></tr>');
    for($i = 1; $i <= $timesToMultiply; $i++) {
        echo('<tr><td>'.$i.'</td><td>'.$generatedMultiply*$i.'</td></tr>');
    }
    ?>
    </table></div>

    <div id="sec-4"><h1>Tabla de 4 filas y 7 columnas</h1>
    <table border="1">
    <?php
        $columns = rand(1,10);
        $rows = rand(1,10);
        for ($i = 0; $i < $rows ; $i++) {
            echo('<tr>');
            for ($j = 0; $j < $columns; $j++) {
                echo('<td>'.$i.'x'.$j.'</td>');
            }
            echo('</tr>');
        }
    ?>
    </table>
    </div>

    
    <div id="sec-5">
    <h1>Calculo de cambio</h1>
        <?php
        $billetes500 = 0;
        $billetes200 = 0;
        $billetes100 = 0;
        $billetes50 = 0;
        $billetes20 = 0;
        $billetes10 = 0;
        $billetes5 = 0;
        $monedas2 = 0;
        $monedas1 = 0;
        $amount = rand(1,1000);
        echo($amount);
            while ( $amount > 1) {
                if ($amount >= 500) {
                    $billetes500++;
                    $amount -= 500;
                } else if ($amount >= 200) {
                    $billetes200++;
                    $amount -= 200;
                } else if ($amount >= 100) {
                    $billetes100++;
                    $amount -= 100;
                } else if ($amount >= 50) {
                    $billetes50++;
                    $amount -= 50;
                } else if ($amount >= 20) {
                    $billetes20++;
                    $amount -= 20;
                } else if ($amount >= 10) {
                    $billetes10++;
                    $amount -= 10;
                } else if ($amount >= 5) {
                    $billetes5++;
                    $amount -= 5;
                } else if ($amount >= 2) {
                    $monedas2++;
                    $amount -= 2;
                } else if ($amount >= 1) {
                    $monedas1++;
                    $amount -= 1;
                }
            } 
        ?>
        Billetes de 500 <?=$billetes500?><br>
        Billetes de 200 <?=$billetes200?><br>
        Billetes de 100 <?=$billetes100?><br>
        Billetes de 50 <?=$billetes50?><br>
        Billetes de 20 <?=$billetes20?><br>
        Billetes de 10 <?=$billetes10?><br>
        Billetes de 5 <?=$billetes5?><br>
        Monedas de 2 <?=$monedas2?><br>
        Monedas de 1 <?=$monedas1?>
    </div>