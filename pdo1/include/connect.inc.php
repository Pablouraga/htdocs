<?php
function connect(String $db, String $user, String $pass, array $options) {
try {
    $connection = new PDO($db, $user, $pass, $options);
    return $connection;
} catch (PDOException $e) {
    echo "Conexion no establecida" . $e->getMessage();
    return null;
}}
    