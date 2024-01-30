<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';

// Assume you receive the appointment ID from the Flutter app
$id = $_POST['id'];

// Check for empty values
if (empty($id)) {
    echo json_encode(['status' => 'error', 'message' => 'Appointment ID cannot be empty']);
    exit();
}

// Use prepared statements to prevent SQL injection
$query = "UPDATE linyatbl SET appointment_status = 'CANCEL' WHERE id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Appointment cancelled successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to cancel appointment']);
}

// Close database connection
mysqli_close($db);

?>
