<?php

// Ruta al archivo JSON
$jsonFilePath = './data.json';
$uuid = 'c4319a64486d4efb9803abde4cf40ffd';

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($jsonFilePath);

// Decodificar el JSON en un array de PHP
$dataArray = json_decode($jsonData, true);

// Verificar si hubo algún error en la decodificación
if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'Error al decodificar el JSON: ' . json_last_error_msg();
} else {
    // Trabajar con los datos como un array de PHP
    $profiles = $dataArray['profiles'];

    // Buscar el perfil con 'selected' establecido en 'true'
    $selectedProfile = null;
    foreach ($profiles as $profile) {
        if ($profile['selected'] == 1) {
            $selectedProfile = $profile;
        }
    }

    //Uncommon 7, Rare 12, Epic 17, Leg 21
    $levelCost = [0, 100, 210, 330, 460, 605, 765, 940, 1130, 1340, 1570, 1820, 2095, 2395, 2725, 3085, 3485, 3925, 4415, 4955, 5555, 6215, 6945, 7745, 8625, 9585, 10635, 11785, 13045, 14425, 15935, 17585, 19385, 21345, 23475, 25785, 28285, 30985, 33905, 37065, 40485, 44185, 48185, 52535, 57285, 62485, 68185, 74485, 81485, 89285, 97985, 107685, 118485, 130485, 143785, 158485, 174685, 192485, 211985, 233285, 256485, 281685, 309085, 338885, 371285, 406485, 444685, 486085, 530885, 579285, 631485, 687685, 748085, 812885, 882285, 956485, 1035685, 1120385, 1211085, 1308285, 1412485, 1524185, 1643885, 1772085, 1909285, 2055985, 2212685, 2380385, 2560085, 2752785, 2959485, 3181185, 3418885, 3673585, 3946285, 4237985, 4549685, 4883385, 5241085, 5624785, 6036485, 6478185, 6954885, 7471585, 8033285, 8644985, 9311685, 10038385, 10830085, 11691785, 12628485, 13645185, 14746885, 15938585, 17225285, 18611985, 20108685, 21725385, 23472085, 253587785];

    $commonCost = array_slice($levelCost, 0, 100);
    $uncommonCost = array_slice($levelCost, 6, 100);
    $rareCost = array_slice($levelCost, 11, 100);
    $epicCost = array_slice($levelCost, 16, 100);
    $legendaryCost = array_slice($levelCost, 20, 100);

    $player = $selectedProfile['members'][$uuid];
    $pets = $player['pets_data']['pets'];

    $cont = 1;
    $xpSub91 = 0;
    $xpOver91 = 0;
    foreach ($legendaryCost as $key => $value) {
        echo 'level ' . $cont++ . ' xp ' . $value . ' <br>';
    }

    // foreach ($pets as $pet) {
    //     echo 'Name: ' . $pet['type'] . '. Rarity: ' . $pet['tier'] . '. Experience: ' . $pet['exp'] . '<br>';
    // }

    // echo '<pre>';
    // print_r($pets);
    // echo '</pre>';

}
