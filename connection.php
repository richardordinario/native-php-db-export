<?php
require_once __DIR__ . '/config.php';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>