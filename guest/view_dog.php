<?php
include '../conn.php';

function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

$PROVINCE_ID = isset($_POST['PROVINCE_ID']) ? $_POST['PROVINCE_ID'] : '';



if (isset($PROVINCE_ID) != "") {
    $sql = "SELECT
    dogs.dogs_id,
    dogs.dogs_name,
    dogs.dogs_breed,
    dogs.dogs_info,
    dogs.dogs_gender,
    dogs.dogs_img,
    dogs.create_at,
    dogs.dogs_type,
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
        
        )  WHERE dogs_type = 0 and province.PROVINCE_NAME like '%$PROVINCE_ID%' 
        order by dogs.dogs_id ";
    $query = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT
    dogs.dogs_id,
    dogs.dogs_name,
    dogs.dogs_breed,
    dogs.dogs_info,
    dogs.dogs_gender,
    dogs.dogs_img,
    dogs.create_at,
    dogs.dogs_type,
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
        
        )  WHERE dogs_type = 0' order by dogs.dogs_id ";
    $query = mysqli_query($conn, $sql);
}


?>


<div class="container mt-5">
    <br>
    <div class="row">
        <h3 class="mt-5 ml-5"><u>รายการสุนัข</u></h3>
        <form method="POST" action="index.php">
            <div class="input-group  mt-5 ml-5">
                <select class="custom-select" id="PROVINCE_ID" name="PROVINCE_ID">
                    <option selected></option>
                    <?php
                    $strSQL = "SELECT * FROM province ORDER BY 	PROVINCE_ID ASC ";
                    $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
                    while ($objResult = mysqli_fetch_array($objQuery)) {
                    ?>
                        <option value="<?= $objResult["PROVINCE_NAME"]; ?>"><?= $objResult["PROVINCE_NAME"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">ค้นหา</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <?php while ($result = mysqli_fetch_assoc($query)) { ?>
            <div class="mb-4 mt-3 col-md-4 col-sm-12">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <img src="../pic/<?php echo $result['dogs_img'] ?>" class="card-img-top" alt="..." style="width: 135px; height: 170px; display: block; margin-left: auto; margin-right: auto;">
                        <ul class="list-unstyled card-text mt-3">
                            <li>ชื่อ : <?php echo $result['dogs_name'] ?></li>
                            <li>สายพันธุ์ : <?php echo $result['dogs_breed'] ?></li>
                            <li>ลักษณะเฉพาะตัว : <?php echo $result['dogs_info'] ?></li>
                            <li>เพศ : <?php echo $result['dogs_gender'] ?></li>
                            <li>วันที่เข้าระบบ : <?php echo DateThai($result['create_at']) ?></li>
                        </ul>
                        <a href="#" id="<?= $result['dogs_id']; ?>" class="btn_view btn btn-primary col-12" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-eye"> ข้อมูลสุนัข</i></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>