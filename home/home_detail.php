<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-9NlqO4dP5KfioUGS568UFwM3lbWf3Uj3Qb7FBHuIuhLoDp3ZgAqPE1/MYLEBPZYM" crossorigin="anonymous">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/animate.min.css"/>
        <link rel="stylesheet" href="../css/smoke.min.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <title>ข้อมูลสถานสงเคราะห์สัตว์</title>
    </head>
    <body>
        <?php include '../conn.php'; ?>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    รายละเอียดสถานสงเคราะห์สัตว์
                </div>
                <div class="card-body">
                    <div>
                        <form name="frmMain" action="insert_detail.php" method="post" id="frmMain" novalidate>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="profile_users_name"  name="profile_users_name" data-smk-msg="กรุณากรอกข้อมูล" placeholder="ชื่อสถานสงเคราะห์สัตว์" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">ภูมิภาค</label>
                                        <select class="form-control" id="ddlGeo" name="profile_users_geo" data-smk-msg="กรุณาเลือกภูมิภาค" onChange = "ListProvince(this.value)" required>
                                            <option selected value=""></option>
                                            <?php
                                            $strSQL = "SELECT * FROM geography ORDER BY GEO_ID ASC ";
                                            $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
                                            while ($objResult = mysqli_fetch_array($objQuery)) {
                                                ?>
                                                <option value="<?= $objResult["GEO_ID"]; ?>"><?= $objResult["GEO_NAME"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">จังหวัด</label>
                                        <select class="form-control" id="ddlProvince" name="profile_users_province" data-smk-msg="กรุณาเลือกจังหวัด" onChange = "ListAmphur(this.value)" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">อำเภอ</label>
                                        <select class="form-control" id="ddlAmphur" name="profile_users_amp" data-smk-msg="กรุณาเลือกอำเภอ" onChange = "Listdistrict(this.value)" required></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">ตำบล</label>
                                        <select class="form-control" id="ddldistrict" name="profile_users_district" data-smk-msg="กรุณาเลือกตำบล" required></select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <textarea class="form-control" id="profile_users_detail1"  name="profile_users_detail1" rows="3" placeholder="รายละเอียดที่อยู่เพิ่มเติม" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="profile_users_detail2" name="profile_users_detail2" rows="3" placeholder="รายละเอียดต่างๆที่ต้องการเพิ่มเติม" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <button id="submit_form" name="submit_form" value="ตกลง" class="btn btn-danger col-12">บันทึก</button>  
                        </form>
                    </div>
                </div>
            </div>    
        </div>


        <?php include '../script_in_body.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/smoke.min.js"></script>

        <!--  script dropdown -->
        <script>
        function ListProvince(SelectValue)
        {
                                                frmMain.ddlProvince.length = 0;
                                                frmMain.ddlAmphur.length = 0;
                                                var myOption = new Option('', '');
                                                frmMain.ddlProvince.options[frmMain.ddlProvince.length] = myOption;
                                            <?php
                                                $intRows = 0;
                                                $strSQL = "SELECT * FROM  province ORDER BY PROVINCE_ID ASC ";
                                                $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
                                                $intRows = 0;
                                                while ($objResult = mysqli_fetch_array($objQuery)) {
                                                $intRows++;
                                            ?>
                                                    x = <?= $intRows; ?>;
                                                    mySubList = new Array();
                                                    strGroup = <?= $objResult["GEO_ID"]; ?>;
                                                    strValue = "<?= $objResult["PROVINCE_ID"]; ?>";
                                                    strItem = "<?= $objResult["PROVINCE_NAME"]; ?>";
                                                    mySubList[x, 0] = strItem;
                                                    mySubList[x, 1] = strGroup;
                                                    mySubList[x, 2] = strValue;
                                                    if (mySubList[x, 1] == SelectValue) {
                                                        var myOption = new Option(mySubList[x, 0], mySubList[x, 2]);
                                                        frmMain.ddlProvince.options[frmMain.ddlProvince.length] = myOption;
                                                    }
                                            <?php
                                                    }
                                            ?>
                                            }
        function ListAmphur(SelectValue)
        {
                                                frmMain.ddlAmphur.length = 0;
                                                frmMain.ddldistrict.length = 0;
                                                //*** Insert null Default Value ***//
                                                var myOption = new Option('', '');
                                                frmMain.ddlAmphur.options[frmMain.ddlAmphur.length] = myOption;
<?php
$intRows = 0;
$strSQL = "SELECT * FROM amphur ORDER BY AMPHUR_ID ASC ";
$objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
$intRows = 0;
while ($objResult = mysqli_fetch_array($objQuery)) {
    $intRows++;
    ?>
                                                    x = <?= $intRows; ?>;
                                                    mySubList = new Array();
                                                    strGroup = <?= $objResult["PROVINCE_ID"]; ?>;
                                                    strValue = "<?= $objResult["AMPHUR_ID"]; ?>";
                                                    strItem = "<?= $objResult["AMPHUR_NAME"]; ?>";
                                                    mySubList[x, 0] = strItem;
                                                    mySubList[x, 1] = strGroup;
                                                    mySubList[x, 2] = strValue;
                                                    if (mySubList[x, 1] == SelectValue) {
                                                        var myOption = new Option(mySubList[x, 0], mySubList[x, 2])
                                                        frmMain.ddlAmphur.options[frmMain.ddlAmphur.length] = myOption;
                                                    }
    <?php
}
?>
                                            }
        function Listdistrict(SelectValue)
        {
                                                frmMain.ddldistrict.length = 0;

                                                //*** Insert null Default Value ***//
                                                var myOption = new Option('', '');
                                                frmMain.ddldistrict.options[frmMain.ddldistrict.length] = myOption;

<?php
$intRows = 0;
$strSQL = "SELECT * FROM district ORDER BY DISTRICT_ID ASC ";
$objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
$intRows = 0;
while ($objResult = mysqli_fetch_array($objQuery)) {
    $intRows++;
    ?>
                                                    x = <?= $intRows; ?>;
                                                    mySubList = new Array();
                                                    strGroup = <?= $objResult["AMPHUR_ID"]; ?>;
                                                    strValue = "<?= $objResult["DISTRICT_ID"]; ?>";
                                                    strItem = "<?= $objResult["DISTRICT_NAME"]; ?>";
                                                    mySubList[x, 0] = strItem;
                                                    mySubList[x, 1] = strGroup;
                                                    mySubList[x, 2] = strValue;
                                                    if (mySubList[x, 1] == SelectValue) {
                                                        var myOption = new Option(mySubList[x, 0], mySubList[x, 2])
                                                        frmMain.ddldistrict.options[frmMain.ddldistrict.length] = myOption;
                                                    }
    <?php
}
?>
                                            }
        </script>
        <!--  script dropdown -->   
        <!--  script ค่าว่าง form -->
        <script>
            $(document).ready(function () {
                $('#submit_form').on("click", function (e) {
                    if ($('#frmMain').smkValidate()) {
                        $.post("insert_detail.php", $("#frmMain").serialize()).done(function (data)
                        {
                            if (data.status === "success") {
                                location.href = data.location;
                            } else {

                                $.smkAlert({text: data.message, type: data.status});
                            }
                        });
                        e.preventDefault();
                    }
                    e.preventDefault();
                });
            });
        </script>        
        <!--  script ค่าว่าง form -->
    </body>
</html>