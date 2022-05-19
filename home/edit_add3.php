<?php

session_start();
include '../conn.php';
$profile_users_detail2 = $_POST['profile_users_detail2'];
$sessionID = $_SESSION['users_id'];

$sql = "UPDATE
    `profile_users` SET
    `profile_users_detail2` = '$profile_users_detail2'
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


  