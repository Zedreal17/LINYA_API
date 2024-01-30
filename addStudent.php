<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");
require 'connection.php';

$studentID = $_POST['studentID'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pNumber = $_POST['pNumber'];
$eMail = $_POST['eMail'];
$pWord = $_POST['pWord'];
$department = $_POST['department'];
$course = $_POST['course'];
$studentStatus = 'ACTIVE';
$dateReg = $_POST['dateReg'];

$sqlCheckUser = "SELECT * FROM studentinformation WHERE fname = '$fname' AND lname = '$lname' AND eMail ='$eMail'";


$res = mysqli_query($db, $sqlCheckUser);
$countResult = mysqli_num_rows($res);
if ($countResult > 1) {
    echo json_encode("ERROR");
} else {
    $insertQuery = "INSERT INTO studentinformation VALUES('','$studentID','$fname','$lname','$pNumber','$eMail','$pWord','$department','$course','$studentStatus','$dateReg')";

    $queryChecker = mysqli_query($db, $insertQuery);
    if($queryChecker)
    {
        echo json_encode("SUCCESS");
    }

}
?>