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

$sql_edit_dogs = "SELECT
    dogs.dogs_id,
    dogs.dogs_name,
    dogs.dogs_breed,
    dogs.dogs_info,
    dogs.dogs_gender,
    dogs.dogs_img,
    dogs.create_at,
    profile_users.profile_users_name,
    profile_users.profile_users_detail1,
    profile_users.profile_users_detail2,
    profile_users.profile_users_province,
    profile_users.profile_users_amp,
    profile_users.profile_users_district,
    profile_users.profile_users_geo,
    profile_users.profile_users_create_at,
    amphur.AMPHUR_NAME,
    province.PROVINCE_NAME,
    geography.GEO_NAME,
    district.DISTRICT_NAME
FROM
    (
            dogs
        INNER JOIN profile_users ON dogs.create_by = profile_users.profile_users_create_at
        INNER JOIN amphur    ON profile_users.profile_users_amp = amphur.AMPHUR_ID
        INNER JOIN province  ON profile_users.profile_users_province = province.PROVINCE_ID
        INNER JOIN geography ON profile_users.profile_users_geo = geography.GEO_ID
        INNER JOIN district  ON profile_users.profile_users_district = district.DISTRICT_ID
        )
   "
        . " WHERE dogs_id = '$id'";
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
        'dogs_info' => $dog_view_data['dogs_info'],
        'profile_users_name' => $dog_view_data['profile_users_name'],
        'PROVINCE_NAME' => $dog_view_data['PROVINCE_NAME'],
        'AMPHUR_NAME' => $dog_view_data['AMPHUR_NAME'],
        'DISTRICT_NAME' => $dog_view_data['DISTRICT_NAME'],
        'profile_users_detail1' => $dog_view_data['profile_users_detail1'],
        'profile_users_detail2' => $dog_view_data['profile_users_detail2'],));
} else {
    header('Content-Type: application/json');
    $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($conn);
    echo json_encode(array('status' => 'danger', 'message' => $errors));
}