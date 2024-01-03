<?php 
// Assuming you have a database connection established

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emplois_temps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$dsn = 'mysql:host=localhost;dbname=emplois_temps';
$username = 'root';
$password = '';
$pdo = new PDO($dsn, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>