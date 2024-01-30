<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';

$userID = $_POST['userID'];

// Check for empty values
if (empty($userID)) {
    echo json_encode(['status' => 'error', 'message' => 'UserID cannot be empty']);
    exit();
}

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM linyatbl WHERE studentCount = ? AND appointment_status = 'APPROVAL'";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'i', $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the user has a pending request
if (mysqli_num_rows($result) > 0) {
    // User has a pending request
    echo json_encode(['hasPendingRequest' => true]);
} else {
    // User does not have a pending request
    echo json_encode(['hasPendingRequest' => false]);
}

// Close database connection
mysqli_close($db);
?>