<header>
    <h1><a href="/index">MerchaShop</a></h1>
    <a href="/index">Principal</a>
</header>
<?php

if (isset($_SESSION['username'])) {
    echo 'Bienvenido, ' . $_SESSION['username'];
    echo '<br><a href="logout.php">Cerrar sesion</a>';
    if ($_SESSION['rol'] == 'admin') {
        echo ' <a href="users.php">Users</a>';
    }
}
