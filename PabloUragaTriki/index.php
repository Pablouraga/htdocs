<?php

/**
 *	Script que informa del uso de cookies en él
 * 
 *	@author Pablo Uraga
 *	@version 1.0.0
 */

//  print_r($_GET);

if (!isset($_COOKIE['style'])) {
	setcookie('style', 'dark', time() + 60);
}

//Si el usuario acepta la creacion de la cookie
if (isset($_GET['accepted'])) {
	if ($_GET['accepted'] == true) {
		setcookie('accepted', 'true', time() + 60, httponly: true);
		header('location:index.php');
		exit();
	}
}

//Si estilo existe
if (isset($_GET['style'])) {
	//Estilo claro
	if ($_GET['style'] == 'light') {
		$cssStyle = 'light';
		setcookie('style', 'light');
		//Estilo oscuro
	} else {
		$cssStyle = 'dark';
		setcookie('style', 'dark');
	}
} else {
	$cssStyle = 'dark';
}

//Eliminar cookie
if (isset($_GET['deleteCookie'])) {
	setcookie('style', '', time() - 1);
	setcookie('accepted', '', time() - 1);
	header('location:index.php');
	exit();
}
?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Triki: el monstruo de las Cookies</title>
	<link rel="stylesheet" href="css/<?= $cssStyle ?>.css">
</head>

<body>
	<?php if (!isset($_COOKIE['accepted'])) {
	?>
		<div id="cookies">
			Este sitio web utiliza cookies propias y puede que de terceros.<br>
			Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies.<br>
			<div><a href="index.php?accepted=true">ACEPTAR</a></div>
		</div>
	<?php
	} ?>

	<h1>Bienvenido a la web de Triki, el monstruo de las cookies</h1>

	<h2>Bienvenido a la web donde no se gestionan las cookies, se devoran.</h2>
	<img src="img/triki.jpg" alt="Imagen de triki mirando una galleta">

	<div id="botones">
		<a href="index.php?style=light" class="styleButton">Claro</a>
		<a href="index.php?style=dark" class="styleButton">Oscuro</a>
	</div>
	<br>

	<div><a href="index.php?deleteCookie">Borrar cookies</a></div>
</body>

</html>