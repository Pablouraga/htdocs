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
    require_once(__DIR__ . '/include/nav.inc.php');
    $deck = [
        ["suit" => "corazones", "value" => "A", "image" => "cor_1.png"],
        ["suit" => "corazones", "value" => "2", "image" => "cor_2.png"],
        ["suit" => "corazones", "value" => "3", "image" => "cor_3.png"],
        ["suit" => "corazones", "value" => "4", "image" => "cor_4.png"],
        ["suit" => "corazones", "value" => "5", "image" => "cor_5.png"],
        ["suit" => "corazones", "value" => "6", "image" => "cor_6.png"],
        ["suit" => "corazones", "value" => "7", "image" => "cor_7.png"],
        ["suit" => "corazones", "value" => "8", "image" => "cor_8.png"],
        ["suit" => "corazones", "value" => "9", "image" => "cor_9.png"],
        ["suit" => "corazones", "value" => "10", "image" => "cor_10.png"],
        ["suit" => "corazones", "value" => "J", "image" => "cor_j.png"],
        ["suit" => "corazones", "value" => "Q", "image" => "cor_q.png"],
        ["suit" => "corazones", "value" => "K", "image" => "cor_k.png"],
        ["suit" => "rombos", "value" => "A", "image" => "rom_1.png"],
        ["suit" => "rombos", "value" => "2", "image" => "rom_2.png"],
        ["suit" => "rombos", "value" => "3", "image" => "rom_3.png"],
        ["suit" => "rombos", "value" => "4", "image" => "rom_4.png"],
        ["suit" => "rombos", "value" => "5", "image" => "rom_5.png"],
        ["suit" => "rombos", "value" => "6", "image" => "rom_6.png"],
        ["suit" => "rombos", "value" => "7", "image" => "rom_7.png"],
        ["suit" => "rombos", "value" => "8", "image" => "rom_8.png"],
        ["suit" => "rombos", "value" => "9", "image" => "rom_9.png"],
        ["suit" => "rombos", "value" => "10", "image" => "rom_10.png"],
        ["suit" => "rombos", "value" => "J", "image" => "rom_j.png"],
        ["suit" => "rombos", "value" => "Q", "image" => "rom_q.png"],
        ["suit" => "rombos", "value" => "K", "image" => "rom_k.png"],
        ["suit" => "treboles", "value" => "A", "image" => "tre_1.png"],
        ["suit" => "treboles", "value" => "2", "image" => "tre_2.png"],
        ["suit" => "treboles", "value" => "3", "image" => "tre_3.png"],
        ["suit" => "treboles", "value" => "4", "image" => "tre_4.png"],
        ["suit" => "treboles", "value" => "5", "image" => "tre_5.png"],
        ["suit" => "treboles", "value" => "6", "image" => "tre_6.png"],
        ["suit" => "treboles", "value" => "7", "image" => "tre_7.png"],
        ["suit" => "treboles", "value" => "8", "image" => "tre_8.png"],
        ["suit" => "treboles", "value" => "9", "image" => "tre_9.png"],
        ["suit" => "treboles", "value" => "10", "image" => "tre_10.png"],
        ["suit" => "treboles", "value" => "J", "image" => "tre_j.png"],
        ["suit" => "treboles", "value" => "Q", "image" => "tre_q.png"],
        ["suit" => "treboles", "value" => "K", "image" => "tre_k.png"],
        ["suit" => "picas", "value" => "A", "image" => "pic_1.png"],
        ["suit" => "picas", "value" => "2", "image" => "pic_2.png"],
        ["suit" => "picas", "value" => "3", "image" => "pic_3.png"],
        ["suit" => "picas", "value" => "4", "image" => "pic_4.png"],
        ["suit" => "picas", "value" => "5", "image" => "pic_5.png"],
        ["suit" => "picas", "value" => "6", "image" => "pic_6.png"],
        ["suit" => "picas", "value" => "7", "image" => "pic_7.png"],
        ["suit" => "picas", "value" => "8", "image" => "pic_8.png"],
        ["suit" => "picas", "value" => "9", "image" => "pic_9.png"],
        ["suit" => "picas", "value" => "10", "image" => "pic_10.png"],
        ["suit" => "picas", "value" => "J", "image" => "pic_j.png"],
        ["suit" => "picas", "value" => "Q", "image" => "pic_q.png"],
        ["suit" => "picas", "value" => "K", "image" => "pic_k.png"]
    ];

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