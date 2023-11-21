<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    require_once('includes/header.inc.php');
    require_once('includes/dbconnection.inc.php');
    $connection = getDBConnection();

    $getOnSaleProducts = $connection->query('SELECT * FROM products WHERE sale <> 0');
    $getOnSaleProducts = $getOnSaleProducts->fetchAll(PDO::FETCH_OBJ);

    foreach ($getOnSaleProducts as $product) {
        echo '<article class="producto">';
        echo '<h2>' . $product->name . '</h2>';
        echo '<span>(' . $product->category . ')</span>';
        echo '<img src="/img/products/' . $product->image . '" alt="' . $product->name . '" class="imgProducto"><br>';
        echo '<span>' . $product->price . ' €</span><br>';
        echo '<span class="botonesCarrito">';
        echo '<a href="/add/' . $product->id . '" class="productos"><img src="/img/mas.png" alt="añadir 1"></a>';
        echo '<a href="/subtract/' . $product->id . '" class="productos"><img src="/img/menos.png" alt="quitar 1"></a>';
        echo '<a href="/remove/' . $product->id . '" class="productos"><img src="/img/papelera.png" alt="quitar todos"></a>';
        echo '</span>';
        echo '<span>Stock: ' . $product->stock . '</span>';
        echo '</article>';
    }

    unset($getOnSaleProducts);
    unset($connection);

    ?>

</body>

</html>