<?php

include '../conn.php';

if(isset($_POST["dogs_id"]))
{
    $query="select * from dogs where dogs_id = '".$_POST["dogs_id"]."'";
    $result_data = mysqli_query($conn, $query);
    $row_dogs = mysqli_fetch_array($result_data);
    echo json_encode($row_dogs);
}
?>