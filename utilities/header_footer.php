<?php

function title_bar($title)
{

    // Default title if none is provided
    if (!$title) {
        $title = "VeloWorld";
    }

    $currentPage = basename($_SERVER['PHP_SELF']);
?>
    <!DOCTYPE html>
    <html lang="en-gb">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title; ?></title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/navbar_style.css">
        <link rel="stylesheet" href="css/footer_style.css">
    </head>

    <body>
        <header>
            <nav class="main-nav">
                <figure class="nav-logo">
                    <a href="index.php"><img src="images/bike_store_icon.png" alt="VeloWorld Logo"></a>
                </figure>
                <button class="menu-toggle" aria-label="Toggle menu">
                    &#9776;
                </button>
                <ul class="nav-links">
                    <li><a href="about_us.php" <?php if ($currentPage === 'about_us.php') echo 'class="current"'; ?>>About Us</a></li>
                    <li><a href="items_in_stock.php" <?php if ($currentPage === 'items_in_stock.php') echo 'class="current"'; ?>>Items in Stock</a></li>
                    <li><a href="reviews.php" <?php if ($currentPage === 'reviews.php') echo 'class="current"'; ?>>Reviews</a></li>
                    <li><a href="contact_us.php" <?php if ($currentPage === 'contact_us.php') echo 'class="current"'; ?>>Contact Us</a></li>
                </ul>
                <section class="nav-icon" aria-label="Utility button">
                    <a href="login.php" class="member-btn" aria-label="Member Area"><img src="images/member_icon.png" alt="Member Area Logo" class="member-icon"></a>
                </section>
            </nav>
        </header>
        
    <?php
}

function footer_bar()
{
    ?>
    <footer class="website-footer">
        <a href="contact_us.php" class="footer-contact">Contact Us</a>
        <p>&copy; 2025 VeloWorld. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
    </body>
    </html>
    <?php
}
