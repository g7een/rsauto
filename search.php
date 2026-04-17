<?php
$conn = new mysqli("localhost", "root", "", "rsauto_db");

if ($conn->connect_error) {
    die("Connection failed");
}

$query = isset($_GET['q']) ? $_GET['q'] : '';

$sql = "SELECT title, category, type 
        FROM search_items 
        WHERE title LIKE ? 
        LIMIT 8";

$stmt = $conn->prepare($sql);
$search = "%" . $query . "%";
$stmt->bind_param("s", $search);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
