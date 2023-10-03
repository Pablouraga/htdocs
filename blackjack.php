<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    /**
     * @author Pablo Uraga Martinez
     * @version = 1.0.0
     * 
     * Simulacion de una partida de blackjack
     */
    require_once(__DIR__ . '/include/nav.inc.php');
    require_once(__DIR__ . '/include/deck.inc.php');
    require_once(__DIR__ . '/include/valuesblackjack.inc.php');
    require_once(__DIR__ . '/include/functions.inc.php');
    echo '<h1>Blackjack</h1>';

    // Ordenamos aleatoriamente el array de cartas
    shuffle($deck);

    // Array con los jugadores
    $players = [
        ["nombre" => "Banca", "id" => "0", "hand" => [], "puntos" => 0, "amountOfCards" => 0],
        ["nombre" => "Jugador 1", "id" => "1", "hand" => [], "puntos" => 0, "amountOfCards" => 0],
        ["nombre" => "Jugador 2", "id" => "2", "hand" => [], "puntos" => 0, "amountOfCards" => 0],
        ["nombre" => "Jugador 3", "id" => "3", "hand" => [], "puntos" => 0, "amountOfCards" => 0],
        ["nombre" => "Jugador 4", "id" => "4", "hand" => [], "puntos" => 0, "amountOfCards" => 0],
        ["nombre" => "Jugador 5", "id" => "5", "hand" => [], "puntos" => 0, "amountOfCards" => 0]
    ];

    // echo '<pre>';
    // print_r($players);
    // echo '</pre>';

    // Funcion que saque una carta al jugador (foreach)
    // Devuelve un array con el campo 'cardvalue' que contiene el valor de la carta (1,2,Q,A)
    // y 'cardimg' que contiene el enlace a la imagen (tre_3.png)

    foreach ($players as $key => $player) {
        do {
            list($cardvalue, $cardimg, $deck, $players[$key]["amountOfCards"]) = drawCard($player["id"], $deck, $players);

            // Guardamos el valor y la imagen de la carta en un subarray de "hand"
            $players[$key]["hand"][] = ["value" => $cardvalue, "image" => $cardimg];

            // Calculamos puntos
            $players[$key]["score"] = calcScore($players[$key]["hand"]);
        } while ($players[$key]["score"] < 14 || $players[$key]["amountOfCards"] < 2);
    }

    echo '<div id="containerplayers">';
    // Mostrar la puntuación después de repartir las cartas
    foreach ($players as $key => $player) {
        echo '<article class="jugador">';
        echo '<h3>' . $players[$key]["nombre"] . '</h3>';

        // Mostrar las imágenes de las cartas en la mano del jugador
        foreach ($players[$key]["hand"] as $card) {
            // echo '<img src="' . $card["image"] . '" height="200px">';

            // echo $card["value"]. ' ';
            // echo $card["image"]. '<br>';

            echo '<img src="/img/' . $card["image"] . '" height=110px>';
        }

        // Mostrar la puntuación del jugador
        echo '<p>Puntuación: ' . $players[$key]["score"] . '</p>';

        if ($key > 0) {
            if ($players[$key]["score"] > 21 || $players[0]["score"] < 21 && $players[$key]["score"] < $players[0]["score"]) {
                echo '<p>Has perdido</p>';
            } else if ($players[0]["score"] > 21 && $players[$key]["score"] <= 21 || $players[$key]["score"] > $players[0]["score"]) {
                echo '<p>Has ganado</p>';
            } else {
                echo '<p>Has empatado</p>';
            }
        }
        echo '</article>';
    }
    echo '</div>';

    ?>

</body>

</html>