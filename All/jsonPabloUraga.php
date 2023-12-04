<?php

/**
 * @author Pablo Uraga Martinez
 * @version 1.0.0
 * 
 * get products from merchashop database, return as json
 */
$dsn = 'mysql:dbname=merchashop;host=127.0.0.1';
$user = 'Lumos';
$pass = 'Nox';
$connection = new PDO($dsn, $user, $pass);
if (empty($_GET['product'])) {
    $query = $connection->query('SELECT * FROM products');
    $query = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = $connection->prepare('SELECT name, category, price, sale, stock, image FROM products WHERE id=?');
    $query->execute([$_GET['product']]);
    $query = $query->fetch(PDO::FETCH_ASSOC);
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($query);
