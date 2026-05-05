<?php
include 'db.php';

$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];

$image_urls = [];

if (!empty($_FILES['images']['name'][0])) {

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            $fileType = mime_content_type($tmp_name);
            if (!$fileType || strpos($fileType, 'image/') !== 0) {
                continue;
            }

            $extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
            $safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($_FILES['images']['name'][$key], PATHINFO_FILENAME));
            $fileName = uniqid('', true) . "_" . $safeBaseName . "." . $extension;
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $image_urls[] = $targetFile;
            }
        }
    }
}

if (empty($image_urls)) {
    die("Please upload at least one image.");
}

$stmt = $conn->prepare("
    INSERT INTO listings (title, price, description, image_url)
    VALUES (?, ?, ?, ?)
");

$cover = $image_urls[0];

$stmt->bind_param("sdss", $title, $price, $description, $cover);
$stmt->execute();

$listing_id = $stmt->insert_id;


$order = 0;
foreach ($image_urls as $img) {
    $stmt2 = $conn->prepare("
        INSERT INTO listing_images (listing_id, image_url, sort_order)
        VALUES (?, ?, ?)
    ");
    $stmt2->bind_param("isi", $listing_id, $img, $order);
    $stmt2->execute();
    $order++;
}

$stmt->close();
$conn->close();

header("Location: admin.php");
exit;
?>
