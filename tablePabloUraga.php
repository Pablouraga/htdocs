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
            echo('<tr><td>x</td>');
            for ($i=1; $i <= $width; $i++) { 
                echo('<td>'.$i.'</td>');
            }
            echo('</tr>');
        
            for ($i=1; $i <= $height ; $i++) { 
                echo('<tr><td>'.$i.'</td>');
                for ($j=1; $j <= $width; $j++) { 
                    echo('<td>'.$i*$j.'</td>');
                }
            }
        ?>
    </table>
</body>

</html>