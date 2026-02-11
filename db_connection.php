<?php
// Database configuration for Docker environment
$host = 'db';
$username = 'root';
$password = 'root_password';
$database = 'course_registration_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8");
?>