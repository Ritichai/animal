<?php

session_start();
include '../conn.php';
$profile_users_province = $_POST['profile_users_province'];
$sessionID = $_SESSION['users_id'];
$profile_users_geo = $_POST['profile_users_geo'];
$profile_users_amp = $_POST['profile_users_amp'];
$profile_users_district = $_POST['profile_users_district'];
$sql = "UPDATE
    `profile_users` SET
    `profile_users_province` = '$profile_users_province',
    `profile_users_geo` =  '$profile_users_geo',
    `profile_users_amp` = '$profile_users_amp',
    `profile_users_district` = '$profile_users_district'
WHERE
  profile_users_create_at=  $sessionID";

$data = mysqli_query($conn, $sql);
if ($data) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success', 'message' => 'login'));
} else {
    header('Content-Type: application/json');
    $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($conn);
    echo json_encode(array('status' => 'danger', 'message' => $sessionID));
}


  