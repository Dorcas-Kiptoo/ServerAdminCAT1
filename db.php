<?php
// db.php - Database connection script

require_once 'config.php'; // Include configuration file

// Create a connection to the database using the credentials in config.php
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set the charset to avoid character encoding issues
$conn->set_charset("utf8");

// If successful
// echo "Connected successfully";
?>
