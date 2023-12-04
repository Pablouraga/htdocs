<?php
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    setcookie('lang', $_GET['lang'], time() + 60);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} elseif (isset($_COOKIE['lang'])) {
    $_SESSION['lang'] = $_COOKIE['lang'];
}

$langs = ['es', 'en', 'ca'];
if (isset($_GET['lang']) && !in_array($_GET['lang'], $langs)) {
    header('Location: /');
    exit;
}
?>

<header>
    <h1><a href="/index">MerchaShop</a></h1>
    <br><a href="/index">Principal</a>
</header>

<?php
$defaultLang = 'es';
foreach ($langs as $language) {
    if ((!isset($_COOKIE['lang']) && $defaultLang != $language) || (isset($_COOKIE['lang']) && $_COOKIE['lang'] != $language)) {
        echo '<a href="?lang=' . $language . '">';
    }
    echo '<img src="../img/' . $language . '.png" alt="' . $language . '" height="32px"></a>';
}
echo '<br>';

$langFile = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
require_once("./includes/lang/$langFile.inc.php");

if (isset($_SESSION['username'])) {
    printf($message['welcome'], $_SESSION['username']);
    echo '<br><a href="logout.php">' . $message['logout'] . '</a>';
    if ($_SESSION['rol'] == 'admin') {
        echo ' <a href="users.php">' . $message['users'] . '</a>';
    }
}
// $current = substr($_SERVER['PHP_SELF'], 1, -4);

// require_once("'" . $current . '.' . $langFile . '.inc.php');