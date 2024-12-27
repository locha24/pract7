<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $date = $_POST['date'];
    $type = $_POST['type'];
    $price = (float)$_POST['price'];

    if (empty($title) || empty($date) || !is_numeric($price)) {
        echo "Please fill in all required fields.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO events (title, description, date, type, price, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssssd", $title, $description, $date, $type, $price);

    if ($stmt->execute()) {
        echo "Event added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>