<?php
require_once('Team.inc.php');
require_once('Circuit.inc.php');

$teams[] = new Team('Honda HRC', 'Japón');
$teams[] = new Team('Yamaha', 'Japón');
$teams[] = new Team('Ducati', 'Italia');
$teams[] = new Team('Aprilia', 'Italia');

$circuits[] = new Circuit('Ricardo Tormo', 'España', 26);
$circuits[] = new Circuit('Suzuka', 'Jaón', 21);
$circuits[] = new Circuit('Assen', 'Países Bajos', 20);

function randomName(): string{
    $names = ['Juan', 'María', 'Carlos', 'Laura', 'Pedro', 'Ana', 'José', 'Sofía', 'Miguel', 'Elena', 'David', 'Carmen', 'Pablo', 'Isabel', 'Manuel', 'Lucía', 'Javier', 'Raquel', 'Daniel', 'Paula', 'Francisco', 'Martina', 'Diego', 'Valentina', 'Luis', 'Julia', 'Alejandro', 'Valeria', 'Jorge','Emma', 'Alberto', 'Marta', 'Andrés', 'Claudia', 'Joaquín', 'Antonia', 'Adrián', 'Alba', 'Rafael', 'Eva', 'Rubén', 'Lorena', 'Fernando', 'Olivia','álvaro', 'Nerea', 'Iván', 'Mireia', 'Jesús', 'Aitana', 'Mario', 'Celia'];
    return $names[rand(0, count($names)-1)];
}

function randomBirthday(): int {
    return mktime(0,0,0,rand(1,12),rand(1,31),rand(1996,2009));    
}

function randomSpeciality(): string {
    $specialities = ['Motor', 'Aerodinámica', 'Hidráulica', 'Electrónica', 'Neumáticos', 'Suspensión'];
    return $specialities[rand(0, count($specialities)-1)];
}

for($i=1; $i<100; $i++) {
    $dorsals[] = $i;
}
shuffle($dorsals);
// Uso: randomDorsal($dorsals)
function randomDorsal(array &$dorsals): int {
    return array_pop($dorsals);
}