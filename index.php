<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSAuto</title>

    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d8ef069dc4.js" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <span class="header-text-wrapper">
            <h2>[logo]</h2>

            <div class="header-links">
                <p>since 2023</p>
                <div class="vertical-line">
                    <p>|</p>
                </div>
                <a href="https://github.com/g7een/rsauto" target="_blank">GitHub</a>
                <div class="vertical-line">
                    <p>|</p>
                </div>
                <a href="">Locate</a>
                <div class="vertical-line">
                    <p>|</p>
                </div>
                <a href="login.php">Sign In</a>
            </div>

        </span>
    </header>
    <div class="navigation-wrapper">
        <nav class="navigation">
            <div class="hamburger" id="hamburger">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="side-menu" id="sideMenu">
                <div class="side-menu-content">

                    <div class="side-item">
                        <p class="side-title">Auto Listings</p>
                    </div>

                    <div class="side-item">
                        <p class="side-title">Quotes</p>
                        <div class="side-submenu">
                            <p>item 1</p>
                            <p>item 2</p>
                        </div>
                    </div>

                    <div class="side-item">
                        <p class="side-title">Repairs</p>
                        <div class="side-submenu">
                            <p>item 1</p>
                            <p>item 2</p>
                        </div>
                    </div>

                </div>
            </div>

            <h2 class="navigation-store-title">
                RSAuto
            </h2>

            <div class="navigation-links">
                <div class="nav-item dropdown">

                    <a href="" class="navlink">Auto Listings</a>
                    
                </div>
                
                <div class="quotes menu-dropdown">
                    <a href="" class="navlink">Quotes</a>
                    <div class="menu-dropdown-content">

                        <div class="menu-dropdown-columns">

                            <div class="menu-dropdown-rows">
                                <p class="menu-dropdown-label">subheading1</p>
                                <p class="menu-dropdown-item">item 1</p>
                                <p class="menu-dropdown-item">item 2</p>
                            </div>
                            <div class="menu-dropdown-rows">
                                <p class="menu-dropdown-label">subheading1</p>
                                <p class="menu-dropdown-item">item 1</p>
                                <p class="menu-dropdown-item">item 2</p>
                            </div>
                            <div class="menu-dropdown-rows">
                                <p class="menu-dropdown-label">subheading2</p>
                                <p class="menu-dropdown-item">item 1</p>
                                <p class="menu-dropdown-item">item 2</p>
                            </div>
                            
                        </div>

                        
                    </div>
                </div>

                <div class="misc menu-dropdown">
                    <a href="" class="navlink">Repairs</a>
                </div>

            </div>

            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search..." class="searchInput">
            </div>
        </nav>
    </div>

    <div class="page-content">
        <div class="landing-wrapper">
            <p>Landing Section</p>
        </div>

        <div class="listings-wrapper">
            <div class="listings-navigation-wrapper">
                <p>Finding a listing?:</p>
                <!--<div class="listings-search-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search..." class="searchInput">
                </div>-->
            </div>

            <div class="listings-grid">
                <?php
                $sql = "SELECT * FROM listings ORDER BY created_at DESC";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()):
                ?>
                    <div class="listing-card">
                        <img src="<?= $row['image_url'] ?>" alt="User provided image">
                        <h3><?= $row['title'] ?></h3>
                        <p>$<?= $row['price'] ?></p>
                        <p>description: <?= $row['description'] ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <footer>
            <p>footer hello footer</p>
        </footer>
    </div>



    <div class="search-overlay" id="searchOverlay">
        <div class="search-overlay-content">
            
            <div class="search-top">
                <input type="text" placeholder="Search" class="search-overlay-input">
                <button class="cancel-btn" id="closeSearch">Cancel</button>
            </div>

            <div class="search-suggestions">
                <p class="suggest-title">Results</p>

                <div class="suggest-items">
                    <span>engine</span>
                    <span>brakes</span>
                    <span>tires</span>
                    <span>oil change</span>
                    <span>battery</span>
                </div>
            </div>

        </div>
    </div>



    <script type=module src="scripts.js"></script>
    
</body>
</html>