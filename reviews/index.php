<?php
// reviews controller

if(!isset($_SESSION)) {
    session_start();
  } 

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

//get review model
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';


$classifications = getClassifications();

$navList = createNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if (!isset($action)) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'addReview':
        $newReview = filter_input(INPUT_POST, 'vehicleReview', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($newReview)) {
            $message = 'Please enter data into all fields.';
            header("location: /phpmotors/vehicles/?action=vehicleDetails&invId=$invId&message=$message");
            exit;
            break;
        }

        $reviewOutcome = insertReview($newReview, $invId, $clientId);

        if ($reviewOutcome) {
            $message = 'Review was successfully posted.';
        } else {
            $message = 'Failed to add new review. Please try again.';
        }
        header("location: /phpmotors/vehicles/?action=vehicleDetails&invId=$invId&message=$message");
        
        exit;
        break;
    
    case 'editReview':
        $reviewId = $_GET['reviewId'];
        $clientScreenName = ucfirst(substr($_SESSION['clientData']['clientFirstname'], 0 , 1)). ucfirst($_SESSION['clientData']['clientLastname']);

        $specificReview = getSpecificReview($reviewId);

        if (count($specificReview) < 1) {
            $_SESSION['message'] = 'An unexpected error occurred. Please try again.';
            include '../view/admin.php';
            exit;
            break;
        }

        //if sql was successful, build html
       $displaySpecificReview = buildSpecificReview($specificReview, $clientScreenName);
       include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
        
        exit;
        break;


    case 'updateReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $changedReview = filter_input(INPUT_POST, 'editReview', FILTER_SANITIZE_STRING);

        if (empty($changedReview)) {
            $message = 'Please enter data into all fields';
            header("location: /phpmotors/reviews?action=editReview&message=$message&reviewId=$reviewId");
            exit;
            break;
        }

        $updateOutcome = updateReview($reviewId, $changedReview);

        if ($updateOutcome) {
            $message = 'Review successfully changed.';
        } else  {
            $message = 'Review update was unsuccessful. Please try again.';
        }
        //set review variables to display to client
        $clientReviews = getClientReviews($_SESSION['clientData']['clientId']);
        $displayClientReviews = buildClientReviews($clientReviews);
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        exit;
        break;

    case 'confirmDelete':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteOutcome = deleteReview($reviewId);

        if ($deleteOutcome) {
            $message = 'Review successfully deleted.';
        } else {
            $message = 'Review delete was unsuccessful. Please try again.';
        }

        //set review variables to display to client
        $clientReviews = getClientReviews($_SESSION['clientData']['clientId']);
        $displayClientReviews = buildClientReviews($clientReviews);
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        exit;
        break;

    case 'deleteReview':
        $reviewId = $_GET['reviewId'];
        $clientScreenName = ucfirst(substr($_SESSION['clientData']['clientFirstname'], 0 , 1)). ucfirst($_SESSION['clientData']['clientLastname']);

        $specificReview = getSpecificReview($reviewId);

        if (count($specificReview) < 1) {
            $_SESSION['message'] = 'An unexpected error occurred. Please try again.';
            include '../view/admin.php';
            exit;
            break;
        }

        $displaySpecificReview = confirmDeleteReview($specificReview, $clientScreenName);
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-delete.php';
         
         exit;
         break;


    default: 
        if(!isset($_SESSION)) {
            include  $_SERVER['DOCUMENT_ROOT'].'/phpmotors/index.php';
        } else {
            //set review variables to display to client
            $clientReviews = getClientReviews($_SESSION['clientData']['clientId']);
            $displayClientReviews = buildClientReviews($clientReviews);
            include  $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/admin.php';
        }
        exit;
        break;
}