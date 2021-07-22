<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Review</title>
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
    <?php 
    echo $navList; ?>
    </nav>

    <main>
        <h1>Edit Review</h1>
        <?php 
        if(!empty($_GET['message'])) {
            echo $_GET['message'];
        } ?>
        <?php if(isset($displaySpecificReview)) {
            echo $displaySpecificReview;
        } ?>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>