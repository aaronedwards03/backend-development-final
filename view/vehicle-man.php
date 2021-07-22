<?php
if (!$_SESSION['loggedin'] && !$_SESSION['clientData']['clientLevel'] > 1) {
    header('Location: /phpmotors/index.php');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
 
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vehicle Management</title>
    <link rel="stylesheet" href="../css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Aldrich&family=Roboto+Mono&display=swap" rel="stylesheet">  
</head>

<body>
    <header>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    </header>

    <nav>
    <?php echo $navList; ?>
    </nav>

    <main>
        <h1>Vehicle Management</h1>
        <ul>
            <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/vehicles/index.php';
            echo $classificationLink;
            echo $vehicleLink;
            ?>
        </ul>
        <?php
            if (isset($message)) { 
                echo $message; 
            } 
            if (isset($classificationList)) { 
                echo '<h1>Vehicles By Classification</h1>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
            }
        ?>
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay" class="inventoryDisplay"></table>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
    <script src="../js/inventory.js"></script>
</body>

</html><?php unset($_SESSION['message']); ?>