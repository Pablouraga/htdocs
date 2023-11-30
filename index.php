<?php

/**
 *	Script que implementa un carrito de la compra con variables de sesión
 * 
 *	@author Álex Torres
 */
session_start();
require_once('includes/dbconnection.inc.php');
$connection = getDBConnection();

// NO existe variable sesion y EXISTE cookie con token
if (!isset($_SESSION['username']) && isset($_COOKIE['token'])) {
	$tokenExists = $connection->prepare('SELECT user, rol FROM users WHERE token = ?');
	$tokenExists->execute([$_COOKIE['token']]);
	$tokenExists = $tokenExists->fetch(PDO::FETCH_ASSOC);
	// print_r($tokenExists);
	$_SESSION['username'] = $tokenExists['user'];
	$_SESSION['rol'] = $tokenExists['rol'];
}

if (isset($_SESSION['last_active']) && (time() - $_SESSION['last_active'] > 600)) {
	session_unset();
	session_destroy();
}

$_SESSION['last_active'] = time();

if (isset($_GET['add']) || isset($_GET['subtract']) || isset($_GET['remove'])) {
	if (isset($_GET['add']) && $_GET['add'] != '') {
		if (!isset($_SESSION['basket'][$_GET['add']]))
			$_SESSION['basket'][$_GET['add']] = 1;
		else
			$_SESSION['basket'][$_GET['add']] += 1;
	}
	if (isset($_GET['subtract']) && $_GET['subtract'] != '' && isset($_SESSION['basket'][$_GET['subtract']])) {
		$_SESSION['basket'][$_GET['subtract']] -= 1;
		if ($_SESSION['basket'][$_GET['subtract']] <= 0)
			unset($_SESSION['basket'][$_GET['subtract']]);
	}
	if (isset($_GET['remove']) && $_GET['remove'] != '' && isset($_SESSION['basket'][$_GET['remove']])) {
		unset($_SESSION['basket'][$_GET['remove']]);
	}

	header('location: /');
	exit;
}

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MerchaShop</title>
	<link rel="stylesheet" href="/css/style.css">
</head>

<body>
	<?php
	require_once('includes/header.inc.php');
	if (isset($_SESSION['username'])) {
	?>
		<div id="carrito">
			<?php
			if (!isset($_SESSION['basket']))
				$products = 0;
			else
				$products = count($_SESSION['basket']);

			$langFile = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
			require_once("./includes/lang/$langFile.inc.php");

			echo $products;
			echo ' ';
			echo $message['products_in_cart'];

			if ($products > 1)
				echo ' ' . $message['products_in_cart_plural'];

			echo ' ' . $message['in_the_cart'];
			?>

			<a href="/basket" class="boton"><?php echo $message['view_cart']; ?></a>
		</div>

		<section class="productos">
			<?php
			$products = $connection->query('SELECT * FROM products;', PDO::FETCH_OBJ);
			// print_r($_COOKIE);

			foreach ($products as $product) {
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

			unset($products);
			unset($connection);
			?>
		</section>
	<?php } else {
	?>

		<form action="signup.php" method="post">
			<?= $errorMsg['username'] ?? '' ?><br>
			<label for="username"><?= $message['username'] ?></label>
			<input type="text" name="username"><br>

			<?= $errorMsg['email'] ?? '' ?><br>
			<label for="email"><?= $message['email'] ?></label>
			<input type="text" name="email"><br>

			<?= $errorMsg['password'] ?? '' ?><br>
			<label for="password"><?= $message['password'] ?></label>
			<input type="password" name="password"><br>

			<?= $errorMsg['global'] ?? '' ?> <br>
			<input type="hidden" name="rol" value="customer">
			<input type="submit" value="<?= $message['register'] ?>">
		</form>

		<p><?= $message['have_account'] ?> <a href="login.php"><?= $message['login'] ?></a></p>

		<a href="sales.php"><img src="/img/price-tag.png" width="48px" alt="<?= $message['offers'] ?>"></a>

	<?php } ?>
</body>

</html>