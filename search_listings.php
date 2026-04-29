<?php
include 'db.php';

$q = $_GET['q'] ?? '';

if (!$q) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id, title, price, description, image_url 
        FROM listings 
        WHERE title LIKE ? OR description LIKE ?
        ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);

$search = "%" . $q . "%";
$stmt->bind_param("ss", $search, $search);

$stmt->execute();
$result = $stmt->get_result();

$listings = [];

while ($row = $result->fetch_assoc()) {
    $listings[] = $row;
}

echo json_encode($listings);
?>