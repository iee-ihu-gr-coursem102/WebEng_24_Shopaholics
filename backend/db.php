<?php
// Database configuration
$host = 'localhost'; // Replace with your database host
$dbname = 'shopaholics_db'; // Replace with your database name
$username = 'meladma'; // Replace with your database username
$password = '!8pmM$@tz'; // Replace with your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error and terminate
    error_log("Database connection error: " . $e->getMessage());
    die("Database connection failed: " . $e->getMessage());
}

