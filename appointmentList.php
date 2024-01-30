<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['userID'];

    // Check for empty values
    if (empty($userID)) {
        echo json_encode(['status' => 'error', 'message' => 'UserID cannot be empty']);
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT *
    FROM linyatbl
    WHERE studentCount = ? AND appointment_status = 'APPROVED'
    ORDER BY date_appointment ASC
    LIMIT 1;
    ";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if ($result) {
        $data = array();
        while ($rowData = $result->fetch_assoc()) {
            $data[] = $rowData;
        }
        echo json_encode($data);
    } else {
        // Handle database query error
        echo json_encode(['status' => 'error', 'message' => 'Database query error']);
    }

    // Close database connection
    mysqli_close($db);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
