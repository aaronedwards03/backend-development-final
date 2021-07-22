<?php

//inserts a review
function insertReview($reviewText, $invId, $clientId ) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//gets reviews for a specific inventory item
function getVehicleReviews($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, c.clientId, c.clientFirstname, c.clientLastname FROM reviews r JOIN clients c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicleReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicleReviews;
}

//gets specific client reviews
function getClientReviews($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, r.invId, c.clientId, c.clientFirstname, c.clientLastname FROM reviews r JOIN clients c ON r.clientId = c.clientId WHERE c.clientId = :clientId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientReviews;
}

//get specific review
function getSpecificReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $specificReview = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $specificReview;
}

//update review
function updateReview($reviewId, $reviewText) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//delete review
function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}