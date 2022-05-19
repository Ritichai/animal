<?php

session_start();
include '../conn.php';
$profile_users_name = $_POST['profile_users_name'];
$profile_users_detail1 = $_POST['profile_users_detail1'];
$profile_users_detail2 = $_POST['profile_users_detail2'];
$profile_users_province = $_POST['profile_users_province'];
$sessionID = $_SESSION['users_id'];
$profile_users_geo = $_POST['profile_users_geo'];
$profile_users_amp = $_POST['profile_users_amp'];
$profile_users_district = $_POST['profile_users_district'];
$sql = "INSERT INTO profile_users "
        . "(profile_users_name,"
        . "profile_users_detail1,"
        . "profile_users_detail2,"
        . "profile_users_province,"
        . "profile_users_create_at,"
        . "profile_users_geo,"
        . "profile_users_amp,"
        . "profile_users_district)"
        . " VALUES ('$profile_users_name',"
        . "'$profile_users_detail1',"
        . "'$profile_users_detail2',"
        . "'$profile_users_province',"
        . "'$sessionID',"
        . "'$profile_users_geo',"
        . "'$profile_users_amp',"
        . "'$profile_users_district')";
$data = mysqli_query($conn, $sql);
if ($data) {
    header('Content-Type: application/json');
      echo json_encode(array('status' => 'success','message' => 'login','location'=>'./index.php'));
} else {
    header('Content-Type: application/json');
    $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($conn);
    echo json_encode(array('status' => 'danger', 'message' => $errors));
}


  