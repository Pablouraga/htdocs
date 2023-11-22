<?php
function getDBConnection() {
    $dsn = 'mysql:dbname=merchashop;host=127.0.0.1';
    $user = 'Lumos';
    $pass = 'Nox';
    return new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}