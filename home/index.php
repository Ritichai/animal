<?php
session_start();

if (!isset($_SESSION['users_id'])) {
    header("Location:../login.php");
}
?>
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
        <title>สถานสงเคราะห์สัตว์</title>
    </head>
    <body>
        <?php include './navbar.php'; ?>
        <?php include '../conn.php'; ?>
        <div class="row no-gutters">
            <div class="col-2">
                <?php include './detail_address.php'; ?>
            </div>
            <div class="col-10">
                <?php include './view_dog.php'; ?>
            </div>
        </div>
        <?php include '../script_in_body.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/smoke.js"></script>
        <script>
            $(document).ready(function () {
                //ลบข้อมูล
                $('a.btn_del').on("click", function (e) {
                    var dog_del_id = $(this).attr('id');
                    $.smkConfirm({
                        text: 'คุณต้องการลบข้อมูลหรือไม่',
                        accept: 'ยืนยัน',
                        cancel: 'ยกเลิก'

                    }, function (res) {
                        if (res) {
                            window.location.replace('del_dogs.php?id=' + dog_del_id);
                            $.smkAlert({text: 'Confirmado!!', type: 'success'});
                        }
                    });
                    e.preventDefault();
                });
                //ปุ่มยืนยันการรับเลี้ยงแล้ว
                $('a.btn_edit').on("click", function (e) {
                    var dog_del_id = $(this).attr('id');
                    $.smkConfirm({
                        text: 'ยืนยันสุนัขถูกรับเลี้ยงแล้ว',
                        accept: 'ยืนยัน',
                        cancel: 'ยกเลิก'

                    }, function (res) {
                        if (res) {
                            window.location.replace('edit_dogs.php?id=' + dog_del_id);
                            $.smkAlert({text: 'ลบข้อมูลแล้ว!!', type: 'success'});
                        }
                    });
                    e.preventDefault();
                });
                //แสดงข้อมูลหมา
                $('a.btn_view').on("click", function (e) {
                    var dogs_id = $(this).attr('id');
                    $.ajax({
                        url: "show_dogs_data.php",
                        dataType: 'json',
                        method: 'get',
                        data: {id: dogs_id},
                        success: function (data) {
                            $("#dogs_id_show").text(data.dogs_id);
                            $("#dogs_name_show").text(data.dogs_name);
                            $("#dogs_gender_show").text(data.dogs_gender);
                            $("#dogs_info_show").text(data.dogs_info);
                            //$("#dogs_img_show").text(data.dogs_img);
                            $("#dogs_img_show").attr('src', data.dogs_img);
                            $("#dogs_create_show").text(data.dogs_create_at);
                        }
                    });
                    e.preventDefault();
                });
                //แก้ไขจังหวัด อำภอ ตำบล
                $("#submit_form_add1").click(function (e) {
                    if ($('#frmMain').smkValidate()) {
                        $.ajax({
                            url: "edit_add1.php",
                            type: 'POST',
                            cache: false,
                            data: {
                                profile_users_geo: $("#ddlGeo").val(),
                                profile_users_province: $("#ddlProvince").val(),
                                profile_users_amp: $("#ddlAmphur").val(),
                                profile_users_district: $("#ddldistrict").val()
                            },
                            success: function (data) {
                                $.smkAlert({text: 'แก้ไขข้อมูลเเล้ว!!', type: 'success'});
                                $(".modal.fade.show").hide();
                                $(".modal-backdrop.fade.show").hide();
                                location.reload(this);
                            }

                        });
                    }
                    e.preventDefault();
                });
                //แก้ไขรายละเอียดที่อยู่
                $("#submit_form_add2").click(function (e) {
                    if ($('#edit_add2_form').smkValidate()) {
                        $.ajax({
                            url: "edit_add2.php",
                            type: 'POST',
                            cache: false,
                            data: {
                                profile_users_detail1: $("#profile_users_detail1").val()
                            },
                            success: function (data) {
                                $.smkAlert({text: 'แก้ไขข้อมูลเเล้ว!!', type: 'success'});
                                $(".modal.fade.show").hide();
                                $(".modal-backdrop.fade.show").hide();
                                location.reload(this);
                            }
                        });
                    }
                    e.preventDefault();
                });
                //แก้ไขรายละเอียดความต้องการ
                $("#submit_form_add3").click(function (e) {
                    if ($('#edit_add3_form').smkValidate()) {
                        $.ajax({
                            url: "edit_add3.php",
                            type: 'POST',
                            cache: false,
                            data: {
                                profile_users_detail2: $("#profile_users_detail2").val()
                            },
                            success: function (data) {
                                $.smkAlert({text: 'แก้ไขข้อมูลเเล้ว!!', type: 'success'});
                                $(".modal.fade.show").hide();
                                $(".modal-backdrop.fade.show").hide();
                                location.reload(this);
                            }
                        });
                    }
                    e.preventDefault();
                });
                //แก้ไขข้อมูลสุนัข
                $('.btn_edit_detail').on('click', function (e) {
                    var dogs_id = $(this).attr('id');
                    $.ajax({
                        url: "edit_dogs_detail_show.php",
                        method: "POST",
                        data: {dogs_id: dogs_id},
                        dataType: 'json',
                        success: function (data) {

                            $('#dogs_id').val(data.dogs_id);
                            $('#dogs_name').val(data.dogs_name);
                            $('#dogs_breed').val(data.dogs_breed);
                            $('#dogs_info').val(data.dogs_info);
                            $('#dogs_gender').val(data.dogs_gender);
                            $('#img2').val(data.dogs_img);
                        }
                    });
                });

                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#show').show('slow');
                            $('#show').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $("#dogs_img").change(function () {
                    readURL(this);
                });
            });
        </script>  
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
    </body>
</html>
<?php include './modal_dogs_view.php'; ?>
<?php include './modal_profile_edit.php'; ?>
<?php include './modal_dogs_edit.php'; ?>