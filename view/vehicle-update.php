<?php
if (!$_SESSION['loggedin'] && !$_SESSION['clientData']['clientLevel'] > 1) {
    header('Location: /phpmotors/index.php');
    exit;
}
// Drop down menu 
$classificationList = '<select name="classificationId" id="classificationId">';
$classificationList .= '<option disabled="disabled" selected="selected">Choose Car Classification</option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        }
    }  elseif(isset($invInfo['classificationId'])) {
        $classificationList .= ' selected ';
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></title>
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
        <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
	        echo "Modify $invMake $invModel"; }?></h1>
        <?php
            if (isset($message)) {
                echo $message;
            } 
        ?>
        <p>*Note all fields are required</p>
        

        <form action="/phpmotors/vehicles/index.php" method="post">
            <?php echo $classificationList; ?>

            <label for="invMake">Make</label>
            <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }  ?> required>

            <label for="invModel">Model</label>
            <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }  ?> required>

            <label for="invDescription">Description</label>
            <textarea id="invDescription" name="invDescription" required><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>

            <label for="invImage">Image Path</label>
            <input type="text" id="invImage" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?> required>

            <label for="invThumbnail">Thumbnail Path</label>
            <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?> required>

            <label for="invPrice">Price</label>
            <input type="text" id="invPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?> required>

            <label for="invStock"># in stock</label>
            <input type="number" id="invStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?> required>

            <label for="invColor">Color</label>
            <input type="text" id="invColor" name="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?> required>

            <input type="submit" value="Update Vehicle" name="submit">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?> ">

        </form>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>