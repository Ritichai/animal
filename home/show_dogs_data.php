<?php

include '../conn.php';

function DateThai($strDate) {
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

$id = $_GET['id'];

$sql_edit_dogs = "SELECT * FROM `dogs`  WHERE dogs_id = '$id'";
$result_edit_dogs = mysqli_query($conn, $sql_edit_dogs);
$dog_view_data = mysqli_fetch_array($result_edit_dogs);
$date_insert_dogs = DateThai($dog_view_data['create_at']);


if ($dog_view_data) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success',
        'dogs_id' => $dog_view_data['dogs_id'],
        'dogs_create_at' => $date_insert_dogs,
        'dogs_name' => $dog_view_data['dogs_name'],
        'dogs_gender' => $dog_view_data['dogs_gender'],
        'dogs_img' => '../pic/' . $dog_view_data['dogs_img'],
        'dogs_info' => $dog_view_data['dogs_info'],));
} else {
    header('Content-Type: application/json');
    $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($conn);
    echo json_encode(array('status' => 'danger', 'message' => $errors));
}