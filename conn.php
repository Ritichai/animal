
<?php  
    $host = "localhost";
    $db = "animal";
    $usr = "root";
    $pwd = "";
    $port = "3306";
    $conn = mysqli_connect($host,$usr,$pwd,$db,$port);
    if (!$conn) {
        die('Could not connect to MySQL: ' . mysqli_connect_error());    }
    date_default_timezone_set('Asia/Bangkok');
    mysqli_query($conn, 'SET NAMES \'utf8\'');
?>


