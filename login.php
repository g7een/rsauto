<?php
session_start();

$errors = [];
if (isset($_GET['error'])) {
    $errors[] = $_GET['error'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d8ef069dc4.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="page-content">
        <div class="return-button">
            <a href="index.php"><i class="fa-solid fa-caret-left"></i></a>
            <a href="index.php"><p>Return</p></a>
        </div>
        <div class="login-panel">
            <h1>Enter username and password for console access.</h1>

            <form action="authenticate.php" class="login-panel-form" method="post">
                <div class="credentials">
                    <label for="username">username</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">password</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit" id="signin">Enter</button>
                </div>
            </form>
            <a href="">forgot password?</a>

        </div>


        <div class="admin-panel hidden">
            <h1>login processing</h1>
            <p>redirecting... <span id="current-user"></span></p>
        </div>
    </div>

    <script type=module src="login.js"></script>
        
</body>
</html>