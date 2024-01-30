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
$query = "SELECT * FROM linyatbl WHERE studentCount = ? AND appointment_status = 'APPROVED'";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'i', $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the user has an approved queue
if (mysqli_num_rows($result) > 0) {
    // User has an approved queue
    echo json_encode(['hasApprovedQueue' => true]);
} else {
    // User does not have an approved queue
    echo json_encode(['hasApprovedQueue' => false]);
}

// Close database connection
mysqli_close($db);
?>
