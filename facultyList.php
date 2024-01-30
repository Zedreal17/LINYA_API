<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';

$sqlCheckFaculty = $db->query("SELECT facultyID, facultyName, facultyContact FROM faculty");
$result = array();

if ($sqlCheckFaculty) {
    while($rowData = $sqlCheckFaculty->fetch_assoc()) {
        $result[] = $rowData;
    }
    echo json_encode($result);
} else {
    // Handle database query error
    echo json_encode(array('error' => 'Database query error'));
}
?>