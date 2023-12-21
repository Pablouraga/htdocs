<?php

require('nbt.php');

// Ruta al archivo JSON
$jsonFilePath = './data.json';
$uuid = 'c4319a64486d4efb9803abde4cf40ffd';

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($jsonFilePath);

// Decodificar el JSON en un array de PHP
$data = json_decode($jsonData, true);

// Verificar si hubo algún error en la decodificación
if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'Error al decodificar el JSON: ' . json_last_error_msg();
} else {
    // Trabajar con los datos como un array de PHP
    $profiles = $data['profiles'];

    // Buscar el perfil con 'selected' establecido en 'true'
    $selectedProfile = null;
    foreach ($profiles as $profile) {
        if ($profile['selected'] == 1) {
            $selectedProfile = $profile;
        }
    }
    //$selectedProfile>members>uuid>dungeons>treasures>chests

    $runs = $selectedProfile['members'][$uuid]['dungeons']['treasures']['runs'];
    $chests = $selectedProfile['members'][$uuid]['dungeons']['treasures']['chests'];
    $runsOverview = [];

    foreach ($runs as $run) {
        $runData = [
            "run_id" => $run["run_id"],
            "dungeon_type" => $run["dungeon_type"],
            "dungeon_tier" => $run["dungeon_tier"],
            "participants" => [],
            "chests" => []
        ];

        foreach ($run["participants"] as $participant) {
            $runData["participants"][] = $participant["display_name"];
        }

        foreach ($chests as $chest) {
            if ($chest["run_id"] == $run["run_id"]) {
                $runData["chests"][] = [
                    "treasure_type" => $chest["treasure_type"],
                    "rewards" => $chest["rewards"]
                ];
            }
        }

        $runsOverview[] = $runData;
    }

    // header('Content-Type: application/json; charset=utf-8');
    // echo json_encode($runsOverview);

    $data = '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';
    $data = base64_decode($data);
    $data = gzdecode($data);

    $reader = new NBT;
    $reader->loadString($data);
    $jsonInventory = json_encode($reader->result);

    // Decodificar el JSON para obtener un array asociativo
    $decodedArray = json_decode($jsonInventory, true);
    $jsonInventory = $decodedArray;
    $rows = array_chunk($jsonInventory['']['i'], 9);

    $htmlTable = '<table border="1">';
    $htmlTable .= '<tr>';
    $cont = 1;

    foreach ($jsonInventory['']['i'] as $slot) {
        if ($cont == 10 || $cont == 19 || $cont == 28) {
            $htmlTable .= '<tr>';
        }
        if (isset($slot['tag']['display']['Name'])) {
            $value = $slot['tag']['display']['Name'];
        } else {
            $value = 'Empty';
        }
        $htmlTable .= '<td>' . $value . '</td>';
        if ($cont == 9 || $cont == 18 || $cont == 27) {
            $htmlTable .= '</tr>';
        }
        $cont++;
    }
    $htmlTable .= '</tr>';
    $htmlTable .= '</table>';

    echo $htmlTable;
}
