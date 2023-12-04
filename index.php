<?php

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

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($runsOverview);

    // echo '<pre>';
    // print_r($runsOverview);
    // echo '</pre>';
}
