<?php
$databaseHost = 'localhost';
$databaseName = 'FRTCEDB';
$databaseUser = 'root';
$databasePassword = '';

try {
    $databaseConnection = new PDO("mysql:host=$databaseHost;dbname=$databaseName;charset=utf8", $databaseUser, $databasePassword);
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Connection failed: " . $exception->getMessage());
}
?>