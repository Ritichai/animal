<?php

 include '../conn.php';
 $id=$_GET['id'];
 
 $sql_img_dog="select dogs_img from dogs where dogs_id = '$id'";
 $result_img = mysqli_query($conn, $sql_img_dog);
 $img_name = mysqli_fetch_row($result_img);
 @unlink('../pic/'.$img_name[0]);

 $sql_del_dogs="delete from dogs where dogs_id = '$id'";
 $result_del_dogs= mysqli_query($conn, $sql_del_dogs);
 
 if($result_del_dogs){
     header("Location:index.php");
 }