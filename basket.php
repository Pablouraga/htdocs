<?php

/**
 *	Script que implementa un carrito de la compra con variables de sesión
 * 
 *	@author Álex Torres
 */
session_start();

if (isset($_SESSION['last_active']) && (time() - $_SESSION['last_active'] > 600)) {
	session_unset();
	session_destroy();
	header('Location: /');
}

$_SESSION['last_active'] = time();
?>
<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MerchaShop - carrito</title>
	<link rel="stylesheet" href="/css/style.css">
</head>

<body>
	<?php require_once('includes/header.inc.php'); ?>

	<h2><?= $message['cart_title'] ?></h2>

	<section>
		<?php
		if (!isset($_SESSION['basket']) || count($_SESSION['basket']) == 0)
			echo '<div>' . $message['empty_cart'] . '</div>';
		else {
			require_once('includes/dbconnection.inc.php');
			$connection = getDBConnection();

			$basketTotal = 0;

			echo '<table>';
			echo '<tr><td>' . $message['product'] . '</td><td>' . $message['quantity'] . '</td><td>' . $message['price'] . '</td><td>' . $message['subtotal'] . '</td></tr>';
			foreach ($_SESSION['basket'] as $productId => $quantity) {
				$product = $connection->query('SELECT name, price FROM products WHERE id=' . $productId . ';', PDO::FETCH_OBJ);
				$product = $product->fetch();
				echo '<tr>';
				echo '<td>' . $product->name . '</td>';
				echo '<td>' . $quantity . '</td>';
				printf('<td>%4.2f ' . $message['currencySymbol'] . '/' . $message['unit'] . '</td>', $product->price * $message['conversionRatio']);
				printf('<td>%4.2f ' . $message['currencySymbol'], $product->price * $message['conversionRatio']);

				$basketTotal += $product->price * $quantity;

				echo '</tr>';
			}

			printf('<tr><td></td><td></td><td>' . $message['total'] . '</td><td>%4.2f ' . $message['currencySymbol'] . '</td></tr>', $basketTotal * $message['conversionRatio']);
			echo '</table>';

			unset($product);
			unset($connection);
		}
		?>
		<br><br>
		<a href="/index" class="boton"><?= $message['back'] ?></a>
	</section>
</body>

</html>