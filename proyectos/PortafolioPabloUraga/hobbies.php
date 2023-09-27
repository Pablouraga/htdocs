<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hobbies</title>
    <link rel="stylesheet" href="/styles/styles.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <script src="/scripts/navbar.js"></script>
</head>

<body>
<header>

<?php require_once(__DIR__ . '/include/navbar.inc.php');?>

</header>
<main>
<h1>Hobbies</h1>
    <div class="hobbiescontainer">
        <div class="sec-1">
            <h3>Videojuegos</h3>
            <img src="/images/videogames.png" alt="Videojuegos">
        </div>
        <div class="sec-2">
            <h3>Ejercicio</h3>
            <img src="/images/fitness-icon-png-279.png" alt="Ejercicio">
        </div>
        <div class="sec-3">
            <h3>Formula 1</h3>
            <a href="https://youtu.be/oq9HlVE86OA" target="_blank"><img src="/images/fernando-alonso-2023.png" alt="Fernando Alonso"></a>
        </div>
    </div>

</main>
<footer><?=require_once(__DIR__ . '/include/footer.inc.php')?></footer>
</body>
</html>