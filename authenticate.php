<?php

session_start();
require_once "config.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    } 
    else {
        header("Location: index.php?error=Invalid username or password");
        exit();
    }
}

$conn->close();
?>
