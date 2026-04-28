<?php
include 'config.php';

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

if (!$username || !$email || !$password) {
    die("Missing fields.");
}

$check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$check->bind_param("ss", $username, $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("User already exists.");
}

$stmt = $conn->prepare("
    INSERT INTO users (username, email, password)
    VALUES (?, ?, ?)
");

$stmt->bind_param("sss", $username, $email, $password);
$stmt->execute();

header("Location: admin.php");