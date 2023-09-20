<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorging Array</title>
    
</head>
<body>
<?php
        $arrayLength = 10;

        for ($i=0; $i < $arrayLength; $i++) { 
            $list[] = rand(1,100);
            // echo($list[$i]);
        }
        // var_dump($list);
        // echo '<pre>'; print_r($list); echo '</pre>';
        print_r($list);
        $aux = 0;

        for ($i=0; $i < count($list); $i++) { 
            for ($j=0; $j < count($list); $j++) { 
                if ($list[$j] < $list[$i]) {
                    $min = $list[$j];
                }
            }
            $aux = $list[$i];
            $list[$i] = $list[$min];
            $list[$min] = $aux;
        }
        
        echo('<br>');
        print_r($list);

        echo('<h1>EXTRA</h1>');

        // for ($i=0; $i < count($list); $i++) { 
        //     for ($i=0; $i < count($list); $i++) { 
        //         if ($list[$i] > $list[$j]) {
                    
        //         }
        //     }
        // }
    ?>
</body>
</html>
