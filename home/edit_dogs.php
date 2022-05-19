<?php

 include '../conn.php';
 $id=$_GET['id'];

 $sql_edit_dogs="UPDATE `dogs` SET `dogs_type`= 1  WHERE dogs_id = '$id'";
 $result_edit_dogs= mysqli_query($conn, $sql_edit_dogs);
 
 if($result_edit_dogs){
     header("Location:index.php");
 }