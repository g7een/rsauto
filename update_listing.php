<?php
include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];

$image_path = null;

if (!empty($_FILES['image']['name'])) {
    $target_dir = "uploads/";
    $image_path = $target_dir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

    $sql = "UPDATE listings 
            SET title=?, price=?, description=?, image_url=? 
            WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $title, $price, $description, $image_path, $id);
} 

else {
    $sql = "UPDATE listings 
            SET title=?, price=?, description=? 
            WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $title, $price, $description, $id);
}

$stmt->execute();

header("Location: admin.php");
exit;
?>