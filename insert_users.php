<?php
include './conn.php';
$users_usersname = $_POST['users_usersname'];
$users_password = $_POST['users_password'];
$sql1 = "insert into users values";
$sql1 .= "(null,'$users_usersname','$users_password','0',CURRENT_TIMESTAMP)";
$data = mysqli_query($conn, $sql1);




    if ($data) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว'));
    } else {
        header('Content-Type: application/json');
        $errors = "ชื่อผู้ใช้ซ้ำ กรุณากรอกชื่อผู้ใช้งานอีกครั้ง";
        echo json_encode(array('status' => 'danger','message' => $errors));
      
    }


  