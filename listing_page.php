<?php
include 'db.php';

$listing_id = 0;

if (isset($_GET['id'])) {
    $listing_id = (int) $_GET['id'];
}

if (isset($_POST['id'])) {
    $listing_id = (int) $_POST['id'];
}

if ($listing_id <= 0) {
    http_response_code(404);
    $listing = null;
    $images = [];
} 

else {
    $stmt = $conn->prepare("SELECT * FROM listings WHERE id = ?");
    $stmt->bind_param("i", $listing_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $listing = $result->fetch_assoc();
    $stmt->close();

    $images = [];

    if ($listing) {
        $image_stmt = $conn->prepare("
            SELECT image_url
            FROM listing_images
            WHERE listing_id = ?
            ORDER BY sort_order ASC, id ASC
        ");
        $image_stmt->bind_param("i", $listing_id);
        $image_stmt->execute();
        $image_result = $image_stmt->get_result();

        while ($image = $image_result->fetch_assoc()) {
            $images[] = $image['image_url'];
        }

        $image_stmt->close();

        if (empty($images) && !empty($listing['image_url'])) {
            $images[] = $listing['image_url'];
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $listing ? htmlspecialchars($listing['title']) : 'Listing Not Found' ?> | RSAuto</title>

    <link rel="stylesheet" href="listing_page.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d8ef069dc4.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="return-button">
        <a href="index.php"><i class="fa-solid fa-caret-left"></i></a>
        <a href="index.php"><p>Listings</p></a>
    </div>

    <main class="listing-page">
        <?php if (!$listing): ?>
            <section class="empty-listing">
                <p class="eyebrow">RSAuto</p>
                <h1>Listing not found</h1>
                <a href="index.php">Back to listings</a>
            </section>
        <?php else: ?>
            <section class="listing-shell">
                <div class="album-panel">
                    <div class="album-scroll">
                        <?php if (empty($images)): ?>
                            <div class="album-placeholder">
                                <i class="fa-regular fa-image"></i>
                                <p>No images available</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($images as $index => $image_url): ?>
                                <img
                                    src="<?= htmlspecialchars($image_url) ?>"
                                    alt="<?= htmlspecialchars($listing['title']) ?> image <?= $index + 1 ?>"
                                >
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <aside class="details-panel">
                    <p class="eyebrow">Available listing</p>
                    <h1><?= htmlspecialchars($listing['title']) ?></h1>
                    <p class="price">$<?= number_format((float) $listing['price'], 2) ?></p>

                    <div class="details-block">
                        <p class="details-label">Description</p>
                        <p class="description">
                            <?= nl2br(htmlspecialchars($listing['description'] ?: 'No description has been added yet.')) ?>
                        </p>
                    </div>

                    <a class="contact-button" href="mailto:">
                        Contact
                    </a>
                </aside>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
