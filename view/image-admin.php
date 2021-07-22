<?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
       }
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Image Management</title>
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
        <h1>Image Management</h1>
        <p>Choose one of the options below</p>

        <?php
          if (isset($message)) {
          echo $message;
        } ?>

        <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data" class='image-man-form'>
            <label for="invItem">Vehicle</label>
            <?php echo $prodSelect; ?>
            <fieldset>
                <label>Is this the main image for the vehicle?</label>
                <label for="priYes" class="pImage">Yes</label>
                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                <label for="priNo" class="pImage">No</label>
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
            </fieldset>
            <label>Upload Image:</label>
            <input type="file" name="file1">
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
        </form>
        <hr>
        <h2>Existing Images</h2>
        <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
        <?php
        if (isset($imageDisplay)) {
        echo $imageDisplay;
        } ?>
        <form></form>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html><?php unset($_SESSION['message']); ?>