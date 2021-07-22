<?php

//Accounts Controller

if(!isset($_SESSION)) {
   session_start();
 } 

define('__ROOT__', '/xampp/htdocs/phpmotors/');
require_once(__ROOT__.'library/connections.php');
require_once(__ROOT__.'model/main-model.php');

// Getting Accounts Model
require_once(__ROOT__.'model/accounts-model.php');

// Get the functions library
require_once(__ROOT__.'library/functions.php');

//get review model
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/model/reviews-model.php';

$classifications = getClassifications();

$navList = createNav($classifications);

$registrationLink = "<a href='/phpmotors/accounts/index.php?action=".urlencode("registration")."' title='View the PHP Motors registration page'>Not a member yet?</a>";

$accountLink = "<h3><a href='/phpmotors/accounts/index.php?action=".urlencode("login")."' title='Login to your account'>My Account</a></h3>";

if(isset($_SESSION['clientData'])){
   $clientReviews = getClientReviews($_SESSION['clientData']['clientId']);
   $displayClientReviews = buildClientReviews($clientReviews);
}



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'registration':
       include '../view/registration.php';
     break;
   
   case 'login': // link from 'My Account' button
       include '../view/login.php';
       break;
   case 'register':
      // Filter and store the data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      //checking for existing email in the database
      $existingEmail = checkExistingEmail($clientEmail);
      if ($existingEmail) {
         $message = '<p class="notice">That email already exists. Do you want to login instead?</p>';
         include '../view/login.php';
         exit;
      }
      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
         $message = '<p>Please provide information for all empty form fields.</p>';
         include '../view/login.php';
         exit; 
      }
      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      // Check and report result
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
      if ($regOutcome === 1) {
         setcookie("firstName", $clientFirstname, strtotime('+1 year'), "/");
         $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
         header('Location: /phpmotors/accounts/?action=login');
         exit;
      } else {
         $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
         include '../view/registration.php';
         exit;
      }
   case 'Login': //login to account
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
      $username = checkEmail($username);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $passwordCheck = checkPassword($password);

      $username = checkEmail($username);
      $checkPassword = checkPassword($password);

      if(empty($username) || empty($checkPassword)){
         $message = '<p>Please provide information for all empty form fields.</p>';
         include '../view/login.php';
         exit; 
      }

      //Proceed with login
      $clientData = getClient($username);
      $hashCheck = password_verify($password, $clientData['clientPassword']);
      if(!$hashCheck) {
         $message = '<p class="notice">Please check your password and try again.</p>';
         include '../view/login.php';
         exit;
         }
         $_SESSION['loggedin'] = TRUE;

      array_pop($clientData);
      $_SESSION['clientData'] = $clientData;

      //set review variables to display to client
      $clientReviews = getClientReviews($_SESSION['clientData']['clientId']);
      $displayClientReviews = buildClientReviews($clientReviews);

      include '../view/admin.php';
      exit;
      break;
   break;

   case 'Logout':
      session_unset();
      session_destroy();
      header('Location: /phpmotors/');
      exit;
      break;
   
   // send to update page
   case 'update':
      include '../view/client-update.php';
      exit;
      break;
   
   // update account in database
   case 'updateAccount':
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      $clientEmail = checkEmail($clientEmail);

      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
         $messageUpdateAccount = '<p>Please provide information for all empty form fields.</p>';
         include '../view/client-update.php';
         exit; 
      }

      if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
         $existingEmail = checkExistingEmail($clientEmail);
         if ($existingEmail) {
            $messageUpdateAccount = '<p>That email already exists. Please try a different one.</p>';
            include '../view/client-update.php';
            exit;
         }
      }


      $updateResult = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

      if ($updateResult) {
         $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
         $_SESSION['clientData']['clientLastname'] = $clientLastname;
         $_SESSION['clientData']['clientEmail'] = $clientEmail;
         $_SESSION['message'] = '<p>Account was successfully updated.</p>';
         include '../view/admin.php';
         exit;
      } else {
         $messageUpdateAccount = '<p>Failed to update account. Please try again.</p>';
         include '../view/client-update.php';
         exit;
      }
      exit;
      break;

   // change password in database
   case 'changePassword':
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      if (empty($clientPassword)) {
         $messageChangePassword = '<p>Please provide information in the empty form field.';
         include '../view/client-update.php';
         exit;
      }

      $checkPassword = checkPassword($clientPassword);
      if (!$checkPassword) {
         $messageChangePassword = '<p>Please input at least 8 characters, with 1 uppercase, 1 lowercase, and 1 special character';
         include '../view/client-update.php';
         exit;
      }

      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      $changeResult = changePassword($hashedPassword, $clientId);

      if ($changeResult) {
         $_SESSION['clientData']['clientPassword'] = $hashedPassword;
         $_SESSION['message'] = '<p>Password was successfully changed.</p>';
         include '../view/admin.php';
         exit;
      } else {
         $messageChangePassword = '<p>Failed to change password. Please try again.</p>';
         include '../view/client-update.php';
         exit;
      }

      exit;
      break;
   
   default:
      include '../view/admin.php';
      break;
   }