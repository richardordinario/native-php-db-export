<?php

require_once __DIR__ . '/vendor/autoload.php'; // Include Composer's autoloader

use Dotenv\Dotenv;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables
$dbHost = $_ENV['DB_HOST'] ?? '127.0.0.1';
$dbName = $_ENV['DB_NAME'] ?? 'test';
$dbUser = $_ENV['DB_USER'] ?? 'root';
$dbPassword = $_ENV['DB_PASSWORD'] ?? '';

// Example: Output environment variables (for debugging only)
// echo "Database Host: $dbHost<br>";
// echo "Database Name: $dbName<br>";
// echo "Database User: $dbUser<br>";
?>