<?php
function drawCard($player, $deck, $players): array
{
    $card = array_pop($deck);

    $cardvalue = $card['value'];
    $cardimg = $card['image'];

    // Contador de las cartas que tiene el jugador
    if (!isset($players[$player]["amountOfCards"])) {
        $players[$player]["amountOfCards"] = 1;
    } else {
        $players[$player]["amountOfCards"]++;
    }

    return [$cardvalue, $cardimg, $deck, $players[$player]["amountOfCards"]];
}

function calcScore($hand)
{
    $score = 0;
    $aceAmount = 0;

    // Suma los valores de las cartas (excepto los ases) a la puntuación
    foreach ($hand as $card) {
        if ($card['value'] === 'A') {
            $aceAmount++;
        } else {
            $score += (is_numeric($card["value"]) ? intval($card["value"]) : 10);
        }
    }

    // Agrega 11 si al sumarselo a la puntuacion actual, no supera 21
    // De lo contrario agrega 1
    while ($aceAmount > 0) {
        if ($score + 11 <= 21) {
            $score += 11;
        } else {
            $score += 1;
        }
        $aceAmount--;
    }

    return $score;
}
