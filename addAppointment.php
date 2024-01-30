<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

require 'connection.php';
$date = date('Y-m-d');
$sName = $_POST['sName'];
$sDepartment = $_POST['sDepartment'];
$sCourse = $_POST['sCourse'];
$dateAppointment = $_POST['dateAppointment'];

$sAppointment = $_POST['sAppointment'];
$sReason = $_POST['sReason'];


$student_year = $_POST['student_year'];
$natureCounselling = $_POST['natureCounselling'];
$teacherInvolved = $_POST['teacherInvolved'];
$subjectInvolved = $_POST['subjectInvolved'];
$sqlCheckUser = "SELECT * FROM linyatbl WHERE studentCount = '$sName' AND student_course = '$sCourse' AND date_appointment ='$dateAppointment' AND appointment_time ='$sAppointment'";
$res = mysqli_query($db, $sqlCheckUser);
$countResult = mysqli_num_rows($res);



if ($countResult > 1) {
    echo json_encode("ERROR");
} else {
    if($sDepartment == "Computer Studies Department") {
        $query0 = "SELECT COUNT(appointment_queue) AS QueueID FROM linyatbl WHERE student_department = '$sDepartment' AND date_appointment = '$dateAppointment';";
        $CSD = mysqli_query($db, $query0);
        if ($CSD) {

            $countData = mysqli_fetch_assoc($CSD);
            $CSDID = $countData['QueueID'];
        }
        $ResID = $CSDID + 1;
        $queID = "CSD-00" . $ResID;
        if (strtotime($date) != strtotime($dateAppointment)) {
            // If the current date is after the appointment date, set the status to 'APPROVAL'
            $sStatus = 'APPROVAL';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        } else if (strtotime($date) == strtotime($dateAppointment)) {
            // If the current date is the same as the appointment date, set the status to 'APPROVED'
            $sStatus = 'APPROVED';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        }
    }
    else if($sDepartment == "Electrical, Electronics, and Computer Engineering (EECE) Department") {
        $query0 = "SELECT COUNT(appointment_queue) AS QueueID FROM linyatbl WHERE student_department = '$sDepartment' AND  date_appointment = '$dateAppointment';";
        $EECED = mysqli_query($db, $query0);
        if ($EECED) {
            
            $countData = mysqli_fetch_assoc($EECED);
            $EECEDID = $countData['QueueID'];
        }
        $ResID = $EECEDID + 1;
        $queID = "EECED-00" . $ResID;
        if (strtotime($date) != strtotime($dateAppointment)) {
            // If the current date is after the appointment date, set the status to 'APPROVAL'
            $sStatus = 'APPROVAL';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        } else if (strtotime($date) == strtotime($dateAppointment)) {
            // If the current date is the same as the appointment date, set the status to 'APPROVED'
            $sStatus = 'APPROVED';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        }
    }
    else if($sDepartment == "Civil Engineering Department") {
        $query0 = "SELECT COUNT(appointment_queue) AS QueueID FROM linyatbl WHERE student_department = '$sDepartment' AND  date_appointment = '$dateAppointment';";
        $CED = mysqli_query($db, $query0);
        if ($CED) {

            $countData = mysqli_fetch_assoc($CED);
            $CEDID = $countData['QueueID'];
        }
        $ResID = $CEDID + 1;
        $queID = "CED-00" . $ResID;
        if (strtotime($date) != strtotime($dateAppointment)) {
            // If the current date is after the appointment date, set the status to 'APPROVAL'
            $sStatus = 'APPROVAL';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        } else if (strtotime($date) == strtotime($dateAppointment)) {
            // If the current date is the same as the appointment date, set the status to 'APPROVED'
            $sStatus = 'APPROVED';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        }
    }
    else if($sDepartment == "Architecture Department") {
        $query0 = "SELECT COUNT(appointment_queue) AS QueueID FROM linyatbl WHERE student_department = '$sDepartment' AND  date_appointment = '$dateAppointment';";
        $AD = mysqli_query($db, $query0);
        if ($AD) {

            $countData = mysqli_fetch_assoc($AD);
            $ADID = $countData['QueueID'];
        }
        $ResID = $ADID + 1;
        $queID = "AD-00" . $ResID;
        if (strtotime($date) != strtotime($dateAppointment)) {
            // If the current date is after the appointment date, set the status to 'APPROVAL'
            $sStatus = 'APPROVAL';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        } else if (strtotime($date) == strtotime($dateAppointment)) {
            // If the current date is the same as the appointment date, set the status to 'APPROVED'
            $sStatus = 'APPROVED';
            $insertQuery = "INSERT INTO linyatbl VALUES('','$queID','$sName','$sDepartment','$sCourse','$dateAppointment','$sStatus','$sAppointment','$sReason','','$student_year','$natureCounselling','$teacherInvolved','$subjectInvolved')";
            $queryChecker = mysqli_query($db, $insertQuery);
        
            if ($queryChecker) {
                echo json_encode("SUCCESS");
            }
        }
    }


}
?>