<?php
session_start();
?>

<?php

include './conn.php';
$users_usersname = mysqli_escape_string($conn, $_POST['users_usersname']);
$users_password = mysqli_escape_string($conn, $_POST['users_password']);
$sql = "SELECT * FROM users WHERE users_usersname=? AND  users_password=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $users_usersname, $users_password);
mysqli_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);

$sql_profile = "SELECT * FROM profile_users";
$resul_profile = mysqli_query($conn, $sql_profile);
$row_profile = mysqli_fetch_array($resul_profile, MYSQLI_ASSOC);


$sql_dogs = "SELECT * FROM dogs";
$resul_dogs = mysqli_query($conn, $sql_dogs);
$row_dogs = mysqli_fetch_array($resul_dogs, MYSQLI_ASSOC);

if ($result_user->num_rows != 1) {


    header('Content-Type: application/json');
    $errors = "ข้อมูลผู้ใช้หรือรหัสผ่านผิดกรุณาลองใหม่อีกครั้ง" . mysqli_error($conn);
    echo json_encode(array('status' => 'danger', 'message' => $errors));
} else {

    

    $row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
    $_SESSION['users_id'] = $row_user['users_id'];
    $_SESSION['users_usersname'] = $row_user['users_usersname'];
    $_SESSION['users_password'] = $row_user['users_password'];
    $_SESSION['users_role'] = $row_user['users_role'];
    $_SESSION['dogs_id'] = $row_dogs['dogs_id'];
    $row_profile['profile_users_create_at'] = $row_user['users_id'];

       header('Content-Type: application/json');    
    if ($row_user["users_role"] == '0') {
          echo json_encode(array('status' => 'success','message' => 'login','location'=>'./home/index.php'));
    } else if ($row_user["users_role"] != '0') {
        echo json_encode(array('status' => 'success','message' => 'login'));
//        echo "<meta http-equiv='refresh' content='0 ;URL=admin/index.php'>";
    }
}


