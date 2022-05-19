<?php
include '../conn.php';
$sql = "SELECT * FROM users  where users_id ='" . $_SESSION['users_id'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$sql_users = "SELECT
    users.users_id,
    profile_users.profile_users_create_at,
    profile_users.profile_users_name,
    profile_users.profile_users_detail1,
    profile_users.profile_users_detail2,
    profile_users.profile_users_province,
    profile_users.profile_users_amp,
    profile_users.profile_users_district
FROM
    profile_users
INNER JOIN users ON users.users_id = profile_users.profile_users_create_at 
WHERE users.users_id='" . $_SESSION['users_id'] . "'";
$result_user = mysqli_query($conn, $sql_users);
$row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);
if ($row_user['profile_users_create_at'] == $row['users_id']) {
    
} else {
    echo "<meta http-equiv='refresh' content='0 ;URL=./home_detail.php'>";
}
mysqli_free_result($result);
mysqli_close($conn);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">Aminmal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <!--                <a class="nav-link" href="form_insert_dogs.php">เพิ่มข้อมูลสนุข</a>-->
                <a class="nav-link" href="view_dog_have_home.php">สุนัขถูกรับเลี้ยง</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <label class="control-label text-white mr-3"for="disabledInput"><?php echo $row_user['profile_users_name'] ?></label>
            <a class="btn btn-secondary my-2 my-sm-0" href="logout.php">
                <i class="fas fa-power-off"></i>
            </a>
        </form>
    </div>
</nav>






