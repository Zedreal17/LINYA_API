<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

include 'connection.php';

// Get input data from Flutter app
$eMail = $_POST['eMail'];
$pWord = $_POST['pWord'];

// Check for empty values
if (empty($eMail) || empty($pWord)) {
    echo json_encode(['status' => 'error', 'message' => 'Username and password cannot be empty']);
    exit();
}

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM studentinformation WHERE eMail=? AND pWord=?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'ss', $eMail, $pWord);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
    // Fetch the user's data, including the name
    $userData = mysqli_fetch_assoc($result);

    // User exists, send a success response with user's name
    echo json_encode([
        'status' => 'success',
        'message' => 'Login successful',
        'userName' => $userData['fname'] . ' ' .$userData['lname'],
        'userID' => $userData['studentCount'],
        'Course' => $userData['course'],
    ]);
} else {
    // User does not exist, send an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
}

// Close database connection
mysqli_close($db);
?>
