<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo "$vehicleDetails[invMake] $vehicleDetails[invModel]"?> | PHP Motors, Inc.</title>
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
        <?php if(isset($message)){
                echo $message; 
                }?>
        <!-- create wrapper for thumnail and details-->
        <div class='details-wrapper'>
        <?php if(isset($thumbnailDisplay)){
                echo $thumbnailDisplay;
                } ?>
        <?php if(isset($detailsDisplay)){
                echo $detailsDisplay;
                } ?>
        </div>
        <h2>Customer Reviews</h2>
        <?php if(isset($_GET['message'])) {
            echo $_GET['message'], '<br>';
        } ?>
        <?php if(isset($_SESSION['loggedin'])) {
                if($_SESSION['loggedin']) {
                    $clientScreenName = ucfirst(substr($_SESSION['clientData']['clientFirstname'], 0 , 1)). ucfirst($_SESSION['clientData']['clientLastname']);
                    $addReview = "<form class='add-review' action='/phpmotors/reviews/index.php' method='post'>";
                    $addReview .= "<label for='screenName'>Screen Name</label>";
                    $addReview .= "<input type='text' id='screenName' name='screenName' value='$clientScreenName' readonly>";
                    $addReview .= "<label for='vehicleReview'>Review</label>";
                    $addReview .= "<textarea id='vehicleReview' name='vehicleReview' required='required'></textarea>";
                    $addReview .= "<input type='submit' value='Add New Review' name='submit'>";
                    $addReview .= "<input type='hidden' name='action' value='addReview'>";
                    $addReview .= "<input type='hidden' name='invId' value='$vehicleDetails[invId]'>";
                    $addReview .= "<input type='hidden' name='clientId' value='".$_SESSION['clientData']['clientId']."'>";
                    $addReview .= "</form>";
                    echo $addReview;
                }
            } else {
                $addReview = '<p class=review-login-reminder>Login to add a review by using the link below.</p>';
                $addReview .= "<p class='review-login'><a href='/phpmotors/accounts/index.php?action=login'>Log In</a></p>";
                echo $addReview;
            }?>
        <?php
            if(isset($displayVehicleReviews)) {
            echo $displayVehicleReviews;
        } ?>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>