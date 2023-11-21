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

	//header('location: /');
}

?>
<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MerchaShop</title>
	<link rel="stylesheet" href="/css/style.css">
</head>

<body>
	<?php
	require_once('includes/header.inc.php');
	require_once('includes/dbconnection.inc.php');
	if (isset($_SESSION['username'])) {
	?>
		<div id="carrito">
			<?php
			if (!isset($_SESSION['basket']))
				$products = 0;
			else
				$products = count($_SESSION['basket']);
			echo $products;
			echo ' producto';
			if ($products > 1)
				echo 's';
			?>
			en el carrito.

			<a href="/basket" class="boton">Ver carrito</a>
		</div>

		<section class="productos">
			<?php
			$connection = getDBConnection();
			$products = $connection->query('SELECT * FROM products;', PDO::FETCH_OBJ);

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

		if (isset($_POST['username'])) {
			$connection = getDBConnection();
			$users = $connection->prepare('SELECT COUNT(*) FROM users WHERE user=? OR email=?');
			$users->execute([$_POST['username'], $_POST['email']]);
			$users = $users->fetch(PDO::FETCH_ASSOC);
			$canRegister = true;

			//Si no hay ningun usuario con ese nombre y/o email
			if ($users['COUNT(*)'] == 0) {
				//Validacion username
				if (empty($_POST['username'])) {
					$errorMsg['username'] = 'El nombre de usuario no puede estar vacio';
					$canRegister = false;
				} else if (strlen($_POST['username']) > 20) {
					$errorMsg['username'] = "El nombre no puede tener mas de 20 caracteres";
					$canRegister = false;
				}

				//Validacion Email
				if (empty($_POST['email'])) {
					$errorMsg['email'] = 'La direccion de correo electronico no puede estar vacia';
					$canRegister = false;
				} else if (strlen($_POST['email']) > 80) {
					$errorMsg['email'] = 'La direccion de correo electronico no puede tener mas de 80 caracteres';
					$canRegister = false;
				} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$errorMsg['email'] = 'La direccion de correo electronico no es valida';
					$canRegister = false;
				}

				//Validacion password
				if (empty($_POST['password'])) {
					$errorMsg['password'] = 'La contraseña no puede estar vacia';
					$canRegister = false;
				} else if (strlen($_POST['password']) > 255) {
					$errorMsg['password'] = 'La contraseña no puede tener mas de 255 caracteres';
					$canRegister = false;
				} else if (strlen($_POST['password']) < 3) {
					$errorMsg['password'] = 'La contraseña no puede tener menos de 3 caracteres';
					$canRegister = false;
				}
			} else {
				$errorMsg['global'] = 'Ya hay un usuario registrado con estas credenciales';
				$canRegister = false;
			}

			if ($canRegister) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $insertNewUser = $connection->prepare("INSERT INTO users (user, email, password) VALUES (?, ?, ?)");
                $insertNewUser->execute([$_POST['username'], $_POST['email'], $password]);
                $_SESSION['username'] = $_POST['username'];
				$_SESSION['rol'] = $_POST['rol'];
                header('Location: /');
				exit;
			}
		}

	?>

		<form action="#" method="post">
			<?= $errorMsg['username'] ?? '' ?><br>
			<label for="username">Nombre de usuario</label>
			<input type="text" name="username"><br>

			<?= $errorMsg['email'] ?? '' ?><br>
			<label for="email">Correo electronico</label>
			<input type="text" name="email"><br>

			<?= $errorMsg['password'] ?? '' ?><br>
			<label for="password">Contraseña</label>
			<input type="password" name="password"><br>

			<?= $errorMsg['global'] ?? '' ?> <br>
			<input type="hidden" name="rol" value="customer">
			<input type="submit" value="Registrarse">
		</form>

		<p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>

		<a href="sales.php"><img src="/img/price-tag.png" width="48px" alt="Ofertas"></a>
	<?php } ?>
</body>

</html>