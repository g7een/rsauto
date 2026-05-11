<?php
include 'db.php';

header('Content-Type: application/json');

$listing_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($listing_id <= 0) {
    http_response_code(400);
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT id, image_url
    FROM listing_images
    WHERE listing_id = ?
    ORDER BY sort_order ASC, id ASC
");
$stmt->bind_param("i", $listing_id);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

$stmt->close();

if (empty($images)) {
    $fallback_stmt = $conn->prepare("
        SELECT 0 AS id, image_url
        FROM listings
        WHERE id = ? AND image_url IS NOT NULL AND image_url != ''
    ");
    $fallback_stmt->bind_param("i", $listing_id);
    $fallback_stmt->execute();
    $fallback_result = $fallback_stmt->get_result();

    while ($row = $fallback_result->fetch_assoc()) {
        $images[] = $row;
    }

    $fallback_stmt->close();
}

$conn->close();

echo json_encode($images);
?>
