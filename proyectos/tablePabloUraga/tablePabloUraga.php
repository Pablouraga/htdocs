<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tablePabloUraga</title>
</head>

<body>
    <h1>Pablo Uraga Martinez</h1>
    <!-- <img src="" alt="Pablo Uraga Martinez" height="299px"> -->
    <table border="1">

        <?php
            $height = 10;
            $width = 10;
            echo('<tr><td style="background-color: red;">x</td>');
            for ($i=1; $i <= $width; $i++) { 
                echo('<td style="background-color: blue;">'.$i.'</td>');
            }
            echo('</tr>');
        
            for ($i=1; $i <= $height ; $i++) { 
                echo('<tr><td style="background-color: blue;">'.$i.'</td>');
                for ($j=1; $j <= $width; $j++) { 
                    if ($i % 2 === 1) {
                        echo('<td style="background-color: yellow">'.$i*$j.'</td>');
                    } else {
                        echo('<td style="background-color: green">'.$i*$j.'</td>');
                    }
                }
            }
        ?>
    </table>
</body>
</html>