<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=tab, initial-scale=1.0">
    <title>Process</title>
</head>

<body>
    <table border="4">
        <tr>
            <?php

            $headers = ['Codigo', 'Nombre', 'Precio', 'Descripcion', 'Fabricante', 'Fecha de adquisicion'];


            foreach ($headers as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr><tr>';
            foreach ($_GET as $value) {
                echo '<td>' . $value . '</td>';
            }

            ?>
        </tr>
    </table>
</body>

</html>