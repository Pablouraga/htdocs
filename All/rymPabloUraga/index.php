<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3 - API RESTful Rick & Morty</title>
    <?php
    require_once(__DIR__ . '/include/header.inc.php');
    $endpoint = 'https://rickandmortyapi.com/api';
    ?>
</head>

<body>
    <?php
    $endpoint = 'https://rickandmortyapi.com/api';

    if (isset($_GET['char'])) {
        $_POST = []; // Limpia $_POST si existe
        $endpoint .= '/character/?name=' . $_GET['char'];
    }

    if (isset($_POST['characterSearch'])) {
        $_GET = []; // Limpia $_GET si existe
        $endpoint .= '/character/?name=' . $_POST['characterSearch'];
    }

    if (!empty($_GET) || !empty($_POST)) {
        $data = file_get_contents($endpoint);
        $data = json_decode($data, true);

        $next = $data['info']['next'];
        $result = $data['results'];

        while ($next != null) {
            $data = json_decode(file_get_contents($next), true);
            $next = $data['info']['next'];
            $result = array_merge($result, $data['results']);
        }

        foreach ($result as $character) {
            echo '<div class="char"><a href="character.php?id=' . $character['id'] . '">' . $character['name'] . '</a><br><img src="' . $character['image'] . '" alt="' . $character['name'] . '"></div>';
        }

        $_GET = [];
        $_POST = [];
    }
    ?>
</body>

</html>