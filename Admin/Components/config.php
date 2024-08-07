<?php
// $server = "localhost";
// $username = "id21742502_care";
// $password = "Tahakhan_53";
// $database = "id21742502_caregroup";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "care-php";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
