<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/vehicles/index.php';
    echo $navList; ?>
    </nav>

    <main>
        <h1><?php echo $classificationName; ?> vehicles</h1>
        <?php if(isset($message)){
                echo $message; 
                }?>
        <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;
                } ?>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>