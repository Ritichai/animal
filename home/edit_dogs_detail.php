<?php

include '../conn.php';
if (isset($_POST["dogs_id"])) {
    $dogs_id = $_POST["dogs_id"];
    $dogs_name = $_POST["dogs_name"];
    $dogs_breed = $_POST["dogs_breed"];
    $dogs_gender = $_POST["dogs_gender"];
    $dogs_img = $_POST["img2"];
    $dogs_info = $_POST["dogs_info"];


    if (is_uploaded_file($_FILES['dogs_img']['tmp_name'])) {
        $new_namepic = 'dog_' . uniqid() . '.' . pathinfo(basename($_FILES['dogs_img']['name']), PATHINFO_EXTENSION);
        $path = '../pic/' . $new_namepic;
        move_uploaded_file($_FILES['dogs_img']['tmp_name'], $path);
    } else {
        $new_namepic = $dogs_img;
    }


    if (!empty($_FILES['dogs_img']['tmp_name'])) {

        $sql_img_dog = "select dogs_img from dogs where dogs_id = '$dogs_id'";
        $result_img = mysqli_query($conn, $sql_img_dog);
        $img_name = mysqli_fetch_row($result_img);
        @unlink('../pic/' . $img_name[0]);


        $sql = "UPDATE
    `dogs` SET
    `dogs_name` = '$dogs_name',
    `dogs_breed` = '$dogs_breed',
    `dogs_gender` = '$dogs_gender',
    `dogs_info` = '$dogs_info',
    `dogs_img` = '$new_namepic'   
WHERE
  dogs_id =  $dogs_id";
        $data = mysqli_query($conn, $sql);
        if ($data) {
          echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
        } else {
           echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
            
        }
    } else {


        $sql = "UPDATE
    `dogs` SET
    `dogs_name` = '$dogs_name',
    `dogs_breed` = '$dogs_breed',
    `dogs_gender` = '$dogs_gender',
    `dogs_info` = '$dogs_info',
    `dogs_img` = '$dogs_img'   
WHERE
  dogs_id =  $dogs_id";
        $data = mysqli_query($conn, $sql);
        if ($data) {
           echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
        } else {
            echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
        }
    }
}