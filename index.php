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
                <a href="">since 2023</a>
                <div class="vertical-line">
                    <p>|</p>
                </div>
                <a href="">documentation</a>
                <div class="vertical-line">
                    <p>|</p>
                </div>
                <a href="">yea</a>
                <div class="vertical-line">
                    <p>|</p>
                </div>
                <a href="login.php">sign in</a>
            </div>

        </span>
    </header>
    <div class="navigation-wrapper">
        <nav class="navigation">
            <h2 class="navigation-store-title">
                rsauto
            </h2>
            <div class="navigation-links">
                <div class="nav-item dropdown">

                    <a href="" class="navlink">Inventory</a>
                    
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
                    <a href="" class="navlink">Misc</a>
                </div>

            </div>

            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search..." class="searchInput">
            </div>
        </nav>
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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