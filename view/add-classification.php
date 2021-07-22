<?php
if (!$_SESSION['loggedin'] && !$_SESSION['clientData']['clientLevel'] > 1) {
    header('Location: /phpmotors/index.php');
    exit;
} 

 
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Motors Add Classification</title>
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
        <h1>Add Car Classification</h1>
        <?php
            if (isset($message)) {
                echo $message;
            } 
        ?>
        
        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="classificationName">Classification Name</label>
            <input type="text" id="classificationName" name="classificationName" required>

            <input type="submit" value="Add Classification" name="submit">
            <input type="hidden" name="action" value="addClassification">

        </form>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>