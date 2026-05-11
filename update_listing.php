<?php
include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];

$uploaded_images = [];
$target_dir = "uploads/";

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (!empty($_FILES['new_images']['name'][0])) {
    foreach ($_FILES['new_images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['new_images']['error'][$key] !== UPLOAD_ERR_OK) {
            continue;
        }

        $file_type = mime_content_type($tmp_name);
        if (!$file_type || strpos($file_type, 'image/') !== 0) {
            continue;
        }

        $extension = pathinfo($_FILES['new_images']['name'][$key], PATHINFO_EXTENSION);
        $safe_base_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($_FILES['new_images']['name'][$key], PATHINFO_FILENAME));
        $file_name = uniqid('', true) . "_" . $safe_base_name . "." . $extension;
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($tmp_name, $target_file)) {
            $uploaded_images[] = $target_file;
        }
    }
}

$sql = "UPDATE listings 
        SET title=?, price=?, description=?
        WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdsi", $title, $price, $description, $id);
$stmt->execute();
$stmt->close();

if (!empty($uploaded_images)) {
    $order_stmt = $conn->prepare("SELECT COALESCE(MAX(sort_order), -1) + 1 AS next_order FROM listing_images WHERE listing_id = ?");
    $order_stmt->bind_param("i", $id);
    $order_stmt->execute();
    $order_result = $order_stmt->get_result();
    $order_row = $order_result->fetch_assoc();
    $order = (int) $order_row['next_order'];
    $order_stmt->close();

    $insert_stmt = $conn->prepare("
        INSERT INTO listing_images (listing_id, image_url, sort_order)
        VALUES (?, ?, ?)
    ");

    foreach ($uploaded_images as $image_path) {
        $insert_stmt->bind_param("isi", $id, $image_path, $order);
        $insert_stmt->execute();
        $order++;
    }

    $insert_stmt->close();

    $cover_stmt = $conn->prepare("UPDATE listings SET image_url = COALESCE(NULLIF(image_url, ''), ?) WHERE id = ?");
    $cover_stmt->bind_param("si", $uploaded_images[0], $id);
    $cover_stmt->execute();
    $cover_stmt->close();
}

header("Location: admin.php");
exit;
?>
