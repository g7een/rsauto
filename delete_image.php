<?php
include 'db.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo "Invalid image id.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM listing_images WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();
$conn->close();

echo "OK";
?> 
