<header>
    <h1><a href="/index">MerchaShop</a></h1>
    <a href="?lang=es"><img src="../img/spain.png" alt="Spanish"></a>
    <a href="?lang=en"><img src="../img/united-kingdom.png" alt="English"></a>
    <a href="?lang=ca"><img src="../img/catalonia.png" alt="catalonia" height="32px"></a>
    <br><a href="/index">Principal</a>
</header>
<?php

if (isset($_GET['lang'])) {
    setcookie('lang', $_GET['lang'], time()+60);
}

//Cargar idioma por defecto y el seleccionado en la cookie
require_once('./includes/lang/en.inc.php');
if (isset($_COOKIE['lang'])) {
    require_once('./includes/lang/'. $_COOKIE['lang'] .'.inc.php');
}

if (isset($_SESSION['username'])) {
    // echo 'Bienvenido, ' . $_SESSION['username'];
    printf($message['welcome'], $_SESSION['username']);
    echo '<br><a href="logout.php">Cerrar sesion</a>';
    if ($_SESSION['rol'] == 'admin') {
        echo ' <a href="users.php">Users</a>';
    }
}