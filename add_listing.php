<?php
include 'db.php';

$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];

$image_url = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $image_url = $targetFile;
    } else {
        die("File upload failed.");
    }
}


else if (!empty($_POST['image_url'])) {
    $image_url = $_POST['image_url'];
}

else {
    die("Please provide an image (upload or URL).");
}



$stmt = $conn->prepare("
    INSERT INTO listings (title, price, description, image_url)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param("sdss", $title, $price, $description, $image_url);

if ($stmt->execute()) {
    header("Location: admin.php");
} 
else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>