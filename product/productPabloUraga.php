<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        // Modificar el ejercicio anterior para que envíe los datos mediante POST y que valide con expresiones regulares los datos recibidos y en caso de no cumplir con los requisitos mostrar errores en un mismo bloque antes del formulario.
        // - Código -> una letra seguida de un guion seguido de 5 dígitos.
        // - Nombre -> solo letras (mínimo 3 y máximo 20).
        // - Precio -> decimal.
        // - Descripción -> alfanumérico (mínimo 50 letras).
        // - Fabricante -> alfanumérico (entre 10 y 20 letras).
        // - Fecha de adquisición -> fecha.
        // - Ningún campo puede estar en blanco.
        
        if (!isset($_POST['code'])) {
            header('Location /productPabloUraga.php');
            exit;
        } else if(!isset($_POST['name'])){
            header('Location /productPabloUraga.php');
            exit;
        } else if(!isset($_POST['price'])){
            header('Location /productPabloUraga.php');
            exit;
        } else if(!isset($_POST['description'])){
            header('Location /productPabloUraga.php');
            exit;
        } else if(!isset($_POST['maker'])){
            header('Location /productPabloUraga.php');
            exit;
        } else if(!isset($_POST['adquisitionDate'])){
            header('Location /productPabloUraga.php');
            exit;
        }

        $codeRegex = '/[A-z]-\d{5}';
        $nameRegex = '[A-z]{3,20}';
        $priceRegex = '^\d+\.\d{1,2}';
        $descRegex = '\S{50,}';
        $dateRegex = '';

    ?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>
    <form method="post" action="productPabloUraga.php">
        Codigo <input type="text" name="code" id="code"><br><br>

        Nombre <input type="text" name="name" id="name"><br><br>

        Precio <input type="text" name="price" id="price"><br><br>

        Descripcion<br><input type="text" name="description" rows="10" cols="50"></textarea><br><br>

        Fabricante <input type="text" name="maker" id="maker"><br><br>

        Fecha de adquisicion <input type="text" name="adquisitionDate" id="adquisitionDate"><br><br>

        <input type="submit" value="Enviar">

    </form>
</body>

</html>