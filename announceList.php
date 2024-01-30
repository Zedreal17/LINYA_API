<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';

$sqlCheckUser = $db->query("SELECT a.announcement_details, a.date_posted, a.date_until, a.announcement_status, u.id AS user_id, CONCAT(u.first_name, ' ', u.last_name) AS user_name FROM announcements a INNER JOIN users u ON a.user_id = u.id WHERE a.announcement_status='ACTIVE'");
$result = array();

if ($sqlCheckUser) {
    while($rowData = $sqlCheckUser->fetch_assoc()) {
        $result[] = $rowData;
    }
    echo json_encode($result);
} else {
    // Handle database query error
    echo json_encode(array('error' => 'Database query error'));
}
?>
