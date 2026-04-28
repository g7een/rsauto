<?php


?>


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
                        <?php include 'db.php'; ?>

                        <?php
                        $sql = "SELECT * FROM listings ORDER BY created_at DESC";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()):
                        ?>
                            <div class="listing-cell">
                                <div>
                                    <p><?= $row['title'] ?></p>
                                    <p>$<?= $row['price'] ?></p>
                                </div>

                                <button class="edit" id="editbutton">Edit</button>

                            </div>

                        <?php endwhile; ?>
                        
                </div>
                <div class="adding-listings">
                    <p class="listings-header">Add listing</p>
                    <form action="add_listing.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="title" placeholder="Car Title" required>
                        <input type="number" step="0.01" name="price" placeholder="Price" required>

                        <div class="listings-image">
                            <input type="hidden" name="image_url" id="image_url">

                            <div class="listings-image-drag" id="dropZone">
                                <i class="fa-regular fa-file-image"></i>
                                <p>Drop image</p>
                            </div>

                            <input type="file" id="fileInput" name="image" hidden>
                        </div>
                    
                        <textarea name="description" placeholder="Description"></textarea>

                        <button type="submit">Add</button>
                    </form>
                </div>
            </div>

            <div class="console-users-container">
                <div class="adding-users">
                    <p class="listings-header">Add Admin User</p>

                    <form action="add_user.php" method="POST">
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>

                        <button type="submit">Create Admin</button>
                    </form>
                </div>

                <div class="view-users">
                    <p class="listings-header">Current Admins</p>

                    <?php
                    include 'config.php';

                    $result = $conn->query("SELECT id, username, email FROM users ORDER BY id ASC");

                    while($user = $result->fetch_assoc()):
                    ?>
                        <div class="user-row">
                            <div>
                                <p><?= $user['username'] ?></p>
                                <p><?= $user['email'] ?></p>
                            </div>

                            <form action="delete_user.php" method="POST">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    <?php endwhile; ?>

                </div>

            </div>
        </div>
    </section>

    <div class="edit-panel hidden" id="editpanel">
        <div class="edit-panel-nav">
            Editing Listing
        </div>
        <div class="edit-panel-close" id="collapse">
            <p>Collapse</p>
        </div>

    </div>


    <footer>
        <p class="disclaimer">*Do not modify listings or site data without prior approval.</p>
    </footer>

    <script type=module src="admin.js"></script>

</body>
</html>