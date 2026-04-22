<?php
include 'db.php';

$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
$image_url = $_POST['image_url'];

$stmt = $conn->prepare("INSERT INTO listings (title, price, description, image_url) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $title, $price, $description, $image_url);

if ($stmt->execute()) {
    header("Location: admin.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>