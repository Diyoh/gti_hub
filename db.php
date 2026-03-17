<?php
/**
 * Day 3: Persistence Layer Handshake
 * This file establishes a secure connection to the MySQL database.
 */

$host = 'localhost';
$db   = 'gti_hub_db';
$user = 'root';
$pass = ''; // Default XAMPP password is empty
$charset = 'utf8mb4';

// Data Source Name (DSN) - tells PDO where and how to connect
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Professional configuration for error handling
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch data as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    // Establishing the "phonebook" connection
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // If the handshake fails, we catch the error for professional debugging
    die("Vault Connection Failed: " . $e->getMessage());
}
?>
