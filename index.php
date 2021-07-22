<?php

//Controller

if(!isset($_SESSION)) {
  session_start();
} 

require_once 'library/connections.php';
require_once 'model/main-model.php';

// Get the functions library
require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/library/functions.php';

$classifications = getClassifications();

$navList = createNav($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

 switch ($action){
 case 'something':
  
  break;
  case 'none':
    break;
 
 default:
  include 'view/home.php';
}