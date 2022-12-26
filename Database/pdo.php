<?php
// https://www.php.net/manual/fr/book.pdo.php

// $pdo = new PDO('mysql:dbname=jumia;host=localhost', 'root', '');

$database_name = 'jumia';
$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO('mysql:dbname=' . $database_name . ';host=' . $host . '', $username, $password, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // FETCH_OBJ or FETCH_ASSOC or FETCH_CLASS
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo 'Error Database';
    exit();
}
