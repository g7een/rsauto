<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "rsauto";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("
    CREATE TABLE IF NOT EXISTS listing_images (
        id int(11) NOT NULL AUTO_INCREMENT,
        listing_id int(11) NOT NULL,
        image_url varchar(255) NOT NULL,
        sort_order int(11) NOT NULL DEFAULT 0,
        created_at timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (id),
        KEY listing_id (listing_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
");
?>
