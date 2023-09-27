<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <h1>Blackjack</h1>
    <?php
    /**
     * @author Pablo Uraga Martinez
     * @version = 1.0.0
     * 
     * Simulacion de una partida de blackjack
     */
    require_once(__DIR__ . '/include/nav.inc.php');
    require_once(__DIR__ . '/include/deck.inc.php');

    // Ordenamos aleatoriamente el array de cartas
    shuffle($deck);

    // Array con los jugadores
    $players = [
        ["nombre" => "Banca", "value" => "0"],
        ["nombre" => "Jugador 1", "value" => "1"],
        ["nombre" => "Jugador 2", "value" => "2"],
        ["nombre" => "Jugador 3", "value" => "3"],
        ["nombre" => "Jugador 4", "value" => "4"],
        ["nombre" => "Jugador 5", "value" => "5"]
    ];

    // Repartimos las cartas, 2 a cada jugador
    for ($i = 0; $i < 2; $i++) {
        $generatedcard = array_pop($deck);
        $playerbanca[] = array(
            "image" => $generatedcard["image"],
            "value" => $generatedcard["value"],
            "suit" => $generatedcard["suit"]
        );
        $generatedcard = array_pop($deck);
        $player1[] = array(
            "image" => $generatedcard["image"],
            "value" => $generatedcard["value"],
            "suit" => $generatedcard["suit"]
        );
        $generatedcard = array_pop($deck);
        $player2[] = array(
            "image" => $generatedcard["image"],
            "value" => $generatedcard["value"],
            "suit" => $generatedcard["suit"]
        );
        $generatedcard = array_pop($deck);
        $player3[] = array(
            "image" => $generatedcard["image"],
            "value" => $generatedcard["value"],
            "suit" => $generatedcard["suit"]
        );
        $generatedcard = array_pop($deck);
        $player4[] = array(
            "image" => $generatedcard["image"],
            "value" => $generatedcard["value"],
            "suit" => $generatedcard["suit"]
        );
        $generatedcard = array_pop($deck);
        $player5[] = array(
            "image" => $generatedcard["image"],
            "value" => $generatedcard["value"],
            "suit" => $generatedcard["suit"]
        );
    }

    $cardValues = [
        "A" => 1,
        "K" => 10,
        "Q" => 10,
        "J" => 10,
        "10" => 10,
        "9" => 9,
        "8" => 8,
        "7" => 7,
        "6" => 6,
        "5" => 5,
        "4" => 4,
        "3" => 3,
        "2" => 2,
    ];

    echo '<div id="banca">';
    echo '<h2>Banca</h2>';
    $totalcardvaluebanca = 0;
    foreach ($playerbanca as $card) {
        $cardValue = $card["value"];
        $totalcardvaluebanca += $cardValues[$cardValue];
        echo '<img src="/img/' . $card["image"] . '" height="200px">';
    }
    echo '<br><p class="puntos">Puntos: ' . $totalcardvaluebanca . '</p>';
    echo '</div>';

    echo '<div id="containerplayers">';

    // Generamos los bloques para cada jugador
    for ($i = 1; $i <= 5; $i++) {
        echo '<article class="jugador">';
        echo '<h2>Jugador ' . $i . '</h2>';
        $playerCards = ${'player' . $i};
        $totalcardvalue = 0;

        foreach ($playerCards as $card) {
            $cardValue = $card["value"];
            // Si la carta que tiene el jugador es A =>
            if ($cardValue == "A") {
                // Si la puntuacion antes de sumar la carta es menor o igual a 10, contara como 11 puntos
                if ($totalcardvalue <= 10) {
                    $totalcardvalue += 11;
                    // Si la puntuacion es mayor que 10, la carta contara como 1 punto
                } else {
                    $totalcardvalue += 1;
                }
                // En caso de que la carta no sea A
            } else {
                $totalcardvalue += $cardValues[$cardValue];
            }

            // Imprimir cartas
            echo '<img src="/img/' . $card["image"] . '" height="200px">';
        }

        echo '<br><p class="puntos">Puntos: ' . $totalcardvalue . '</p>';
        echo '</article>';
    }
    echo '</div>';

    ?>


</body>

</html>