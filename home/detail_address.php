<?php {
    include '../conn.php';
    $sql = "SELECT
    users.users_id,
    profile_users.profile_users_create_at,
    profile_users.profile_users_name,
    profile_users.profile_users_detail1,
    profile_users.profile_users_detail2,
    profile_users.profile_users_province,
    profile_users.profile_users_amp,
    profile_users.profile_users_district,
    province.PROVINCE_NAME,
    district.DISTRICT_NAME,
    geography.GEO_NAME,
    amphur.AMPHUR_NAME
FROM(((((
    profile_users
INNER JOIN users ON users.users_id = profile_users.profile_users_create_at)
INNER JOIN province ON province.PROVINCE_ID = profile_users.profile_users_province)
INNER JOIN geography ON geography.GEO_ID = profile_users.profile_users_geo)
INNER JOIN amphur ON amphur.AMPHUR_ID = profile_users.profile_users_amp)
INNER JOIN district ON district.DISTRICT_ID = profile_users.profile_users_district)
WHERE users.users_id='" . $_SESSION['users_id'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
}
?>
<div class="row border-right border-bottom mt-2">
    <div class="col-12" id="add1">
        <div class="border-bottom">
            <div class="card-body">
                <h5 class="card-title">ที่อยู่ สถานสงเคราะห์</h5>
                <ul class="list-unstyled">
                    <li><?php echo "จังหวัด : " . $row['PROVINCE_NAME']; ?></li>
                    <li><?php echo "อำเภอ : " . $row['AMPHUR_NAME']; ?></li>
                    <li><?php echo "ตำบล  : " . $row['DISTRICT_NAME']; ?></li>
                </ul>
                <a href="#" class="btn btn-danger"id="<?php echo $row["users_id"]; ?>"  data-toggle="modal" data-target="#edit_add1"><i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="border-bottom">
            <div class="card-body">
                <h5 class="card-title">รายละเอียด ที่อยู่</h5>
                <p class="card-text"><?php echo $row['profile_users_detail1']; ?></p>
                <a href="#" class="btn btn-danger"id="<?php echo $row["users_id"]; ?>"  data-toggle="modal" data-target="#edit_add2"><i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="">
            <div class="card-body">
                <h5 class="card-title">รายละเอียดความต้องการ</h5>
                <dd class="card-text"><?php echo $row['profile_users_detail2']; ?> </dd>
                 <a href="#" class="btn btn-danger"id="<?php echo $row["users_id"]; ?>"  data-toggle="modal" data-target="#edit_add3"><i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>
</div>