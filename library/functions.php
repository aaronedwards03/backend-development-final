<?php

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

function createNav($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classifications&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }

//build the list of vehicles
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= "<h2><a href='/phpmotors/vehicles/?action=vehicleDetails&invId=".urlencode($vehicle['invId'])."'>$vehicle[invMake] $vehicle[invModel]</a></h2>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleDetails($details) {
    $detailsDisplay = "<div class='details-image'><img src='$details[imgPath]' alt='Image of $details[invMake] $details[invModel] on phpmotors.com'></div>";
    $detailsDisplay .= "<div class='details-summary'>";
    $detailsDisplay .= "<h1>$details[invMake] $details[invModel]</h1>";
    $detailsDisplay .= '<h2>$'.number_format($details['invPrice']).'</h2>';
    $detailsDisplay .= "<p>$details[invDescription]</p>";
    $detailsDisplay .= "<h3>Vehicle Details</h3>";
    $detailsDisplay .= "<ul>";
    $detailsDisplay .= "<li><span>Price:</span> <span>$".number_format($details['invPrice']).'</span></li>';
    $detailsDisplay .= "<li><span>Vehicle Make:</span> <span>$details[invMake]</span></li>";
    $detailsDisplay .= "<li><span>Vehicle Model:</span> <span>$details[invModel]</span></li>";
    $detailsDisplay .= "<li><span>Stock on Hand:</span> <span>$details[invStock]</span></li>";
    $detailsDisplay .= "<li><span>Exterior Color:</span> <span>$details[invColor]</span></li>";
    $detailsDisplay .= "</ul></div>";
    return $detailsDisplay;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    
// Get image type
$image_info = getimagesize($old_image_path);
$image_type = $image_info[2];

// Set up the function names
switch ($image_type) {
case IMAGETYPE_JPEG:
    $image_from_file = 'imagecreatefromjpeg';
    $image_to_file = 'imagejpeg';
break;
case IMAGETYPE_GIF:
    $image_from_file = 'imagecreatefromgif';
    $image_to_file = 'imagegif';
break;
case IMAGETYPE_PNG:
    $image_from_file = 'imagecreatefrompng';
    $image_to_file = 'imagepng';
break;
default:
    return;
} // ends the swith

// Get the old image and its height and width
$old_image = $image_from_file($old_image_path);
$old_width = imagesx($old_image);
$old_height = imagesy($old_image);

// Calculate height and width ratios
$width_ratio = $old_width / $max_width;
$height_ratio = $old_height / $max_height;

// If image is larger than specified ratio, create the new image
if ($width_ratio > 1 || $height_ratio > 1) {

    // Calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);

    // Create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
    $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
    imagecolortransparent($new_image, $alpha);
    }

    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    }

    // Copy old image to new image - this resizes the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

    // Write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // Free any memory associated with the new image
    imagedestroy($new_image);
    } else {
    // Write the old image to a new file
    $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
   } // ends resizeImage function


// make thumbnail layout for vehicle details page
function buildThumbnails($vehicleThumbnails) {
    $tnList = '<div id="thumbnail_wrapper" class="thumbnail-wrapper">';
    foreach ($vehicleThumbnails as $tn) {
        $tnList .= '<div class="thumbnail-image">';
        $tnList .= "<img src='$tn[imgPath]' alt='additional photo of vehicle'>";
        $tnList .= '</div>';
    }
    $tnList .= '</div>';
    return $tnList;
}

//display reviews for specific vehicle
function buildVehicleReviews($vehicleReviews) {
    $reviewList = "<div class='vehicle-review-wrapper'>";
    foreach ($vehicleReviews as $review) {
        $reviewList .= "<div class='review'>";
        $screenName = ucfirst(substr($review['clientFirstname'], 0, 1));
        $screenName .= ucfirst($review['clientLastname']);

        $reviewTime = strtotime($review['reviewDate']);
        $reviewTime = date("d F, Y", $reviewTime);

        $reviewList .= "<div class='review-info'><h5>$screenName</h5>";
        $reviewList .= "<h5>$reviewTime</h5></div>";
        $reviewList .= "<p>$review[reviewText]</p>";
        $reviewList .= "</div>";
    }
    $reviewList .= "</div>";
    return $reviewList;
}

//display reviews for specific client
function buildClientReviews($clientReviews) {
    $reviewList = "<h3>";
    $reviewList .= $clientReviews[0]['clientFirstname']; 
    $reviewList .= " ";
    $reviewList .= $clientReviews[0]['clientLastname'];
    $reviewList .= "'s Reviews:</h3>";
    $reviewList .= "<div class='client-review-wrapper'>";
    foreach ($clientReviews as $review) {
        $reviewList .= "<div class='review'>";
        $screenName = ucfirst(substr($review['clientFirstname'], 0, 1));
        $screenName .= ucfirst($review['clientLastname']);

        $reviewTime = strtotime($review['reviewDate']);
        $reviewTime = date("d F, Y", $reviewTime);

        $reviewList .= "<div class='review-info'><h5>$screenName</h5>";
        $reviewList .= "<h5>$reviewTime</h5></div>";
        $reviewList .= "<p>$review[reviewText]</p>";
        $reviewList .= "<div class='modify-review-wrapper'>";
        $reviewList .= "<p><a href='/phpmotors/reviews?action=editReview&reviewId=$review[reviewId]' class='edit-review'>Edit Review</a></p>";
        $reviewList .= "<p><a href='/phpmotors/reviews?action=deleteReview&reviewId=$review[reviewId]' class='delete-review'>Delete Review</a></p>";
        $reviewList .= "</div></div>";
    }
    $reviewList .= "</div>";
    return $reviewList;
}

//display specific review for editing
function buildSpecificReview($specificReview, $clientScreenName) {
    $buildSpecificReview = "<form class='edit-review' action='/phpmotors/reviews/index.php' method='post'>";
    $buildSpecificReview .= "<label for='screenName'>Screen Name</label>";
    $buildSpecificReview .= "<input type='text' id='screenName' name='screenName' value='$clientScreenName' readonly>";
    $buildSpecificReview .= "<label for='editReview'>Edit Review</label>";
    $buildSpecificReview .= "<textarea id='editReview' name='editReview' required>$specificReview[reviewText]</textarea>";
    $buildSpecificReview .= "<input type='submit' value='Edit Review' name='submit'>";
    $buildSpecificReview .= "<input type='hidden' name='action' value='updateReview'>";
    $buildSpecificReview .= "<input type='hidden' name='reviewId' value='$specificReview[reviewId]'>";
    $buildSpecificReview .= "</form>";

    return $buildSpecificReview;
}

//build delete review form
function confirmDeleteReview($specificReview, $clientScreenName) {
    $buildSpecificReview = "<form class='delete-review' action='/phpmotors/reviews/index.php' method='post'>";
    $buildSpecificReview .= "<label for='screenName'>Screen Name</label>";
    $buildSpecificReview .= "<input type='text' id='screenName' name='screenName' value='$clientScreenName' readonly>";
    $buildSpecificReview .= "<label for='deleteReview'>Review to be deleted</label>";
    $buildSpecificReview .= "<textarea id='deleteReview' name='deleteReview' readonly>$specificReview[reviewText]</textarea>";
    $buildSpecificReview .= "<input type='submit' value='Delete Review' name='submit'>";
    $buildSpecificReview .= "<input type='hidden' name='action' value='confirmDelete'>";
    $buildSpecificReview .= "<input type='hidden' name='reviewId' value='$specificReview[reviewId]'>";
    $buildSpecificReview .= "</form>";

    return $buildSpecificReview;
}