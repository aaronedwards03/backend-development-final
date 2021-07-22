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
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?></title>
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
	        echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
	        echo "Delete $invMake $invModel"; }?></h1>
        <?php
            if (isset($message)) {
                echo $message;
            } 
        ?>
        <p>WARNING: Confirm Vehicle Deletion. The delete is permanent.</p>

        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="invMake">Make</label>
            <input type="text" id="invMake" name="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }  ?> readonly>

            <label for="invModel">Model</label>
            <input type="text" id="invModel" name="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }  ?> readonly>

            <label for="invDescription">Description</label>
            <textarea id="invDescription" name="invDescription" readonly><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>

            <input type="submit" value="Delete Vehicle" name="submit">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?> ">

        </form>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>