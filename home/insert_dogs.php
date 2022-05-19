<?php

session_start();
include '../conn.php';
$dogs_name = $_POST['dogs_name'];
$dogs_breed = $_POST['dogs_breed'];
$dogs_info = $_POST['dogs_info'];
$dogs_gender = $_POST['dogs_gender'];
//$dogs_img = $_POST['dogs_img'];
$sessionID = $_SESSION['users_id'];

if (is_uploaded_file($_FILES['dogs_img']['tmp_name'])) {
    $new_namepic = 'dog_' . uniqid() . '.' . pathinfo(basename($_FILES['dogs_img']['name']), PATHINFO_EXTENSION);
    $path = '../pic/' . $new_namepic;
    move_uploaded_file($_FILES['dogs_img']['tmp_name'], $path);
} else {
    $new_namepic = "";
}

$sql = "INSERT INTO `dogs` (`dogs_id`, `dogs_name`, `dogs_breed`, `dogs_info`, `dogs_gender`, `dogs_type`, `dogs_img`, `create_by`, `create_at`) "
        . "VALUES (NULL, '$dogs_name', '$dogs_breed', '$dogs_info', '$dogs_gender', '0', '$new_namepic', '$sessionID', CURRENT_TIMESTAMP());";

$data = mysqli_query($conn, $sql);

if ($data) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success', 'message' => 'บันทึกข้อมูลเรียบร้อยแล้ว'));
} else {
    header('Content-Type: application/json');
    $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($conn);
    echo json_encode(array('status' => 'danger', 'message' => $errors));
}


  