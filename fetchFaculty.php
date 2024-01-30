<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

include 'connection.php';

// Use prepared statements to prevent SQL injection
$query = "SELECT `facultyID`, `facultyName` FROM `facultyinfo`";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch faculty data
$facultyData = [];

while ($row = mysqli_fetch_assoc($result)) {
    $facultyData[] = $row;
}

// Check if there is any faculty data
if (!empty($facultyData)) {
    // Faculty data exists, send a success response
    echo json_encode([
        'status' => 'success',
        'message' => 'Faculty data fetched successfully',
        'facultyData' => $facultyData,
    ]);
} else {
    // No faculty data found, send an error response
    echo json_encode(['status' => 'error', 'message' => 'No faculty data found']);
}


// Close database connection
mysqli_close($db);
?>
