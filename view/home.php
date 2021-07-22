<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Motors Home</title>
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Aldrich&family=Roboto+Mono:wght@400;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <?php 
        require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    </header>

    <nav>
    <?php echo $navList;?> 
    
    </nav>

    <main>
        <h1>Welcome to PHP Motors!</h1>
        <div class="car-listing">
            <img src="images/vehicles/delorean.jpg" alt="Picture of a Delorean">
            <div class="car-desc">
                <h3>DMC Delorean</h3>
                <ul>
                    <li>3 Cup holders</li>
                    <li>Superman doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
            </div>
            <div class="own-today-button"><a href="#" title="Add to cart">Own Today</a></div>
        </div>


        <div class="largeview-flex">
            <div class="car-reviews">
                <h4>DMC Delorean Reviews</h4>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest rde on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futurtistic ride of our day!" (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>

            <div class="car-upgrades">
                <h4>Delorean Upgrades</h4>
                <figure class="upgrade-box">
                    <img src="images/upgrades/flux-cap.png" alt="image of a flux cap">
                    <figcaption><a href="#" title="View our inventory of Flux Capacitors">Flux Capacitor</a></figcaption>
                </figure>
                <figure class="upgrade-box">
                    <img src="images/upgrades/flame.jpg" alt="image of a flame decal">
                    <figcaption><a href="#" title="View our inventory of Flame Decals">Flame Decals</a></figcaption>
                </figure>
                <figure class="upgrade-box">
                    <img src="images/upgrades/bumper_sticker.jpg" alt="image of a bumper sticker">
                    <figcaption><a href="#" title="View our inventory of Bumper Sickers">Bumper Sticker</a></figcaption>
                </figure>
                <figure class="upgrade-box">
                    <img src="images/upgrades/hub-cap.jpg" alt="image of a hub cap">
                    <figcaption><a href="#" title="View our inventory of Hub Capss">Hub Caps</a></figcaption>
                </figure>
            </div>
        </div>
    </main>

    <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>