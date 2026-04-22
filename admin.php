<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d8ef069dc4.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="return-button">
        <a href="index.php"><i class="fa-solid fa-caret-left"></i></a>
        <a href="index.php"><p>Home</p></a>
    </div>

    <section class="console-page">
        <div class="admin-console-container">
            <div class="admin-console-header">
                <p>RSAuto Console</p>
            </div>

            <div class="console-listings-container">
                <div class="view-listings">
                    <p class="listings-header">Current Listings</p>
                </div>
                <div class="adding-listings">
                    <p class="listings-header">Add listing</p>
                    <div class="adding-data">

                    </div>
                    <button type="submit" id="addListing">Add</button>
                </div>
            </div>

            <div class="console-users-container">
                <div class="console-user-header">
                    <p class="listings-header">User Management</p>

                </div>
            </div>
        </div>
    </section>

    <footer>
        <p class="disclaimer">*Do not modify listings or site data without prior approval.</p>
    </footer>

</body>
</html>