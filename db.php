<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP MySQL
$password = ""; // Default password for XAMPP MySQL is empty
$dbname = "weekend_activities"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>
