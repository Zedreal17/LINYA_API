<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';
$date = date('Y-m-d');
// $date = "2023-11-29";
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
    WHERE date_appointment = ?
      AND student_department = (SELECT student_department FROM linyatbl WHERE studentCount = ? AND date_appointment = ?)
      AND appointment_status = 'APPROVED'
    ORDER BY id ASC
    LIMIT 1;";

    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 'sis', $date, $userID, $date);
    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if ($result) {
        $data = array();
        while ($rowData = $result->fetch_assoc()) {
            $data[] = $rowData;
        }
        echo $date;
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