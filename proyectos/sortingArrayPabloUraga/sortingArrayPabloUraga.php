<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorging Array</title>
    
</head>
<body>
    <h1>Algoritmo de seleccion</h1>
<?php
        $arrayLength = 10;

        for ($i=0; $i < $arrayLength; $i++) { 
            $list[] = rand(1,100);
            // echo($list[$i]);
        }
        // var_dump($list);
        echo '<pre>'; print_r($list); echo '</pre>';
        // print_r($list);
        $aux = 0;

        $pre_time = microtime(true);
        for ($i=0; $i < count($list) -1; $i++) { 
            $minimum = $i;
            for ($j=$i+1; $j < count($list); $j++) { 
                if ($list[$j] < $list[$minimum]) {
                    $minimum = $j;
                }
            }
            $aux = $list[$i];
            $list[$i] = $list[$minimum];
            $list[$minimum] = $aux;
        }
        $post_time = microtime(true);
        
        echo '<pre>'; print_r($list); echo '</pre>';
        echo($post_time - $pre_time);

        echo('<h1>EXTRA</h1>');

        $arrayLength = 10;
        for ($i=0; $i < $arrayLength; $i++) { 
            $list2[] = rand(1,100);
        }
        echo '<pre>'; print_r($list2); echo '</pre>';
        $aux2 = 0;
        $pre_time2 = microtime(true);
        for ($i = 0; $i < count($list2) - 1; $i++) {
            for ($j = 0; $j < count($list2) - $i - 1; $j++) {
                if ($list2[$j] > $list2[$j + 1]) {
                    $aux2 = $list2[$j];
                    $list2[$j] = $list2[$j + 1];
                    $list2[$j + 1] = $aux2;
                }
            }
        }
        
        $post_time2 = microtime(true);
        echo '<pre>'; print_r($list2); echo '</pre>';
        echo($post_time2 - $pre_time2);
    ?>
</body>
</html>
