<?php
$servername = "localhost";
$username = "locha";
$password = "lolocha24";
$dbname = "events_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>