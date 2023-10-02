<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta mas alta</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <h1>Juego de Carta Mas Alta</h1>
    <header>
        <?php
        /**
         * @author Pablo Uraga Martinez
         * @version = 1.0.0
         * 
         * Juego entre dos jugadores a ver quien saca las cartas mas altas
         */
        require_once(__DIR__ . '/include/nav.inc.php');
        ?>
    </header>
    <main>
        <?php
        // Baraja de cartas francesa
        require_once(__DIR__ . '/include/deck.inc.php');

        // Ordenamos aleatoriamente el array de cartas
        shuffle($deck);

        // Array con los jugadores
        $players = [
            ["nombre" => "Pepe", "value" => "1"],
            ["nombre" => "Ramon", "value" => "2"],
            ["nombre" => "Antonio", "value" => "3"],
            ["nombre" => "Paco", "value" => "4"],
            ["nombre" => "Xuan", "value" => "5"],
            ["nombre" => "Hignacio", "value" => "6"],
            ["nombre" => "Sandro", "value" => "7"],
            ["nombre" => "ALvaro", "value" => "8"],
            ["nombre" => "Maria", "value" => "9"],
            ["nombre" => "Paula", "value" => "10"]
        ];

        // Seleccionar un jugador aleatorio
        $generatedplayer = array_rand($players);

        // Obtener el jugador seleccionado y su nombre
        $idjugador = $players[$generatedplayer];
        $nombrejugador = $idjugador["nombre"];

        echo $nombrejugador . "\n<br>";


        // Seleccionar otro jugador aleatorio
        do {
            $generatedplayer2 = array_rand($players);

            $idjugador2 = $players[$generatedplayer2];

            $nombrejugador2 = $idjugador2["nombre"];
        } while ($idjugador === $idjugador2);

        echo $nombrejugador2 . "\n<br><br>";

        for ($i = 0; $i < 20; $i++) {
            $generatedcard = array_pop($deck);
            if ($i % 2 == 0) {
                $player1[] = array(
                    "value" => $generatedcard["value"],
                    "image" => $generatedcard["image"]
                );
            } else {
                $player2[] = array(
                    "value" => $generatedcard["value"],
                    "image" => $generatedcard["image"]
                );
            }
        }

        // Comparamos los valores de cada carta
        // Si una es mayor que otra, +2 puntos para ese jugador - en caso de ser iguales, +1 punto a los dos jugadores
        $player1points = 0;
        $player2points = 0;

        for ($i = 0; $i < count($player1); $i++) {
            $player1card = $player1[$i]["value"];
            $player2card = $player2[$i]["value"];

            // Asignar valores numéricos a las cartas
            $cardValues = [
                "A" => 1,
                "K" => 13,
                "Q" => 12,
                "J" => 11,
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

            $player1value = $cardValues[$player1card];
            $player2value = $cardValues[$player2card];

            if ($player1value > $player2value) {
                $player1points += 2;
                $player1[$i]["highlight"] = true; // Marcar la carta del jugador 1
            } elseif ($player2value > $player1value) {
                $player2points += 2;
                $player2[$i]["highlight"] = true; // Marcar la carta del jugador 2
            } else {
                $player1points++;
                $player2points++;
            }
        }

        // Mostramos las cartas de cada jugador
        echo '<h3>Jugador 1</h3>';
        foreach ($player1 as $card) {
            $highlightClass = isset($card["highlight"]) && $card["highlight"] ? 'highlight' : '';
            echo '<img src="/img/' . $card["image"] . '" alt="Carta" height="200px" class="carta ' . $highlightClass . '">';
        }

        echo '<br>';

        echo '<h3>Jugador 2</h3>';

        foreach ($player2 as $card) {
            $highlightClass = isset($card["highlight"]) && $card["highlight"] ? 'highlight' : '';
            echo '<img src="/img/' . $card["image"] . '" alt="Carta" height="200px" class="carta ' . $highlightClass . '">';
        }

        echo '<br>';

        echo '<br>Jugador 1: ' . $player1points;
        echo '<br>Jugador 2: ' . $player2points;

        if ($player1points > $player2points) {
            echo '<h2>El jugador ganador ha sido ' . $nombrejugador . '</h2>';
        } else if ($player2points > $player1points) {
            echo '<h2>El jugador ganador ha sido ' . $nombrejugador2 . '</h2>';
        } else {
            echo '<h2>Empate</h2>';
        }
        ?>
    </main>
</body>

</html>