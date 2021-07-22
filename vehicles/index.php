<?php
// Vehicles Controller

if(!isset($_SESSION)) {
    session_start();
  } 

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicle-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/uploads-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/reviews-model.php';

// Get the functions library
require_once '../library/functions.php';

$classifications = getClassifications();

$navList = createNav($classifications);

// Link variables
$classificationLink = '<li><a href="/phpmotors/vehicles/index.php?action='.urlencode("classification").'" title="Add new car classification">Add Classification</a></li>';

$vehicleLink = '<li><a href="/phpmotors/vehicles/index.php?action='.urlencode("vehicle").'" title="Add new vehicle">Add Vehicle</a></li>';




$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action) {
    case 'classification':
        include '../view/add-classification.php';
        break;

    case 'vehicle':
        include '../view/add-vehicle.php';
        break;

    case 'addClassification':
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);
        if(empty($classificationName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

        $classificationOutcome = newClassification($classificationName);
        //echo $classificationOutcome; 
        if ($classificationOutcome === 1) {
            header("Location:");
            exit;
        } else {
            $message = "<p>Sorry, but adding the new classification failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;

    case 'addVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

        //hard code img path and thumbnail for now
        $invImage = "/images/no-image.png";
        $invThumbnail = "/images/no-image.png";

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        $vehicleOutcome = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
    
        if ($vehicleOutcome === 1) {
            $message = "The $invMake $invModel was added successfully!";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, but adding the new vehicle failed. Please try again.</p>";
         include '../view/registration.php';
         exit;
        }
        break;
    
    //Used for starting Update and Delete process
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

    case 'updateVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
    
        if ($updateResult) {
            $message = "<p>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry, but updating the new vehicle failed. Please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
    
        if ($deleteResult) {
            $message = "<p>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry, but deleting the new vehicle failed. Please try again.</p>";
            $_SESSION['message'] = $message;
	        header('location: /phpmotors/vehicles/');
	        exit;
        }
        break;
    
    case 'classifications':    
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, $classificationName could not be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    
    case 'vehicleDetails':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);

        // variables to display vehicle reviews
        $vehicleReviews = getVehicleReviews($invId);
        $displayVehicleReviews = buildVehicleReviews($vehicleReviews);

        $vehicleDetails = vehicleDetails($invId);
        $thumbnails = getThumbnails($invId);

        if (count($vehicleDetails) < 1) {
            $message = '<p>Sorry, that vehicle could not be found. Click on one of the tabs above to try again.</p>';
        } else {
           $detailsDisplay = buildVehicleDetails($vehicleDetails);
           $thumbnailDisplay = buildThumbnails($thumbnails);
        }
        include '../view/vehicle-detail.php';
        break;

    case 'none':
        break;
        
    default:
        
        $classificationList = buildClassificationList($classifications);

        if ($_SESSION['loggedin'] && $_SESSION['clientData']['clientLevel'] > 1) {
            include '../view/vehicle-man.php';
        } else {
            header('Location: /phpmotors/index.php');
        }
        
        break;
 }