<?php
//Conexion base de datos
$dsn = 'mysql:dbname=pokemon;host=127.0.0.1';
$user = 'Ash';
$pass = 'pikachu';
$connection = new PDO($dsn, $user, $pass);

if (isset($_GET['api'])) {
    if (isset($_GET['pokemon']) && isset($_GET['id'])) {
        //Nombre, peso, altura y estadísticas base del pokemon con la id recibida.
        $query = $connection->prepare('SELECT p.nombre, p.peso, p.altura, e.ps, e.ataque, e.defensa, e.especial, e.velocidad
        FROM pokemon p, estadisticas_base e WHERE p.numero_pokedex = e.numero_pokedex AND p.numero_pokedex=?');

        $query->execute([$_GET['id']]);
        $query = $query->fetch(PDO::FETCH_ASSOC);
    } else if (isset($_GET['pokemon']) && !isset($_GET['id'])) {
        //numero_pokedex y nombre de todos los pokemon de la base de datos.
        $query = $connection->query('SELECT numero_pokedex, nombre FROM pokemon');
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
    } else if (isset($_GET['type']) && isset($_GET['id'])) {
        //Nombre del tipo y todos los pokemon de ese tipo (de cada pokemon su nombre y numero_pokedex).
        $query = $connection->prepare('SELECT t.nombre, pt.numero_pokedex, p.nombre, p.numero_pokedex
        FROM tipo t, pokemon_tipo pt, pokemon p WHERE p.numero_pokedex = pt.numero_pokedex AND pt.id_tipo = t.id_tipo AND t.id_tipo = ?');

        $query->execute([$_GET['id']]);
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
    } else if (isset($_GET['type']) && !isset($_GET['id'])) {
        //id_tipo y nombre de todos los tipos de pokemon de la base de datos.
        $query = $connection->query('SELECT id_tipo, nombre FROM tipo');
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //Devolver contenido en formato json
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($query);
}
