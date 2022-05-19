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
                <?php
                include '../conn.php';

                function DateThai($strDate) {
                    $strYear = date("Y", strtotime($strDate)) + 543;
                    $strMonth = date("n", strtotime($strDate));
                    $strDay = date("j", strtotime($strDate));
                    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                    $strMonthThai = $strMonthCut[$strMonth];
                    return "$strDay $strMonthThai $strYear";
                }

                $session_id_dogs = $_SESSION['users_id'];
                $text_serch = isset($_POST['text_serch']) ? $_POST['text_serch'] : '';
                $page = 'repair_list';
                $perpage = 5;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $perpage;
                $sql = "SELECT `dogs_id`, `dogs_name`, `dogs_breed`, `dogs_info`, `dogs_gender`, `dogs_type`, `dogs_img`, `create_by`, `create_at` FROM `dogs` "
                        . "WHERE create_by = '" . $session_id_dogs . "' and dogs_type = 1";

                $query = mysqli_query($conn, $sql);
                ?>

                <div class="row mt-3 ml-5 no-gutters">
                    <a class="btn btn-info" href="form_insert_dogs.php"><i class="fas fa-plus"> เพิ่มข้อมูลสุนัข</i></a>
                    <button type="button" class="btn btn-secondary ml-2" disabled>
                        <?php {
                            include '../conn.php';
                            $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs where create_by = '" . $session_id_dogs . "'");
                            $row = mysqli_fetch_array($result);
                            $count = $row['dogs_id'];
                            ?>
                            จำนวนสุนัขทั้งหมด <span class="badge badge-light"><?php echo $count ?></span>
                        <?php } ?>
                        <span class="sr-only">unread messages</span>
                    </button>
                    <button type="button" class="btn btn-danger ml-2" disabled>
                        <?php {
                            include '../conn.php';
                            $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs where create_by = '" . $session_id_dogs . "' and dogs_type = 0");
                            $row = mysqli_fetch_array($result);
                            $count = $row['dogs_id'];
                            ?>
                            จำนวนสุนัขที่ยังไม่ถูกรับเลี้ยง <span class="badge badge-light"><?php echo $count ?></span>
                        <?php } ?>
                    </button>
                    <button type="button" class="btn btn-success ml-2" disabled>
                        <?php {
                            include '../conn.php';
                            $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs where create_by = '" . $session_id_dogs . "' and dogs_type = 1");
                            $row = mysqli_fetch_array($result);
                            $count = $row['dogs_id'];
                            ?>
                            จำนวนสุนัขที่ถูกรับเลี้ยง <span class="badge badge-light"><?php echo $count ?></span>
                        <?php } ?>
                    </button>
                </div>
                <h3 class="ml-5 mt-5"> สุนัขทั้งหมดที่ถูกรับเลี้ยง</h3>
                <div class="row no-gutters">
                    <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                        <div class="card col-3 ml-5 mt-4 shadow p-3 mb-5 bg-white rounded">
                            <img src="../pic/<?php echo $result['dogs_img'] ?>" class="card-img-top center mx-auto mt-3 mr-3 ml-3" alt="..." style="width: 150px; height: 170px;">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <ul class="list-unstyled card-text">
                                    <li>ชื่อ : <?php echo $result['dogs_name'] ?></li>
                                    <li>สายพันธุ์ : <?php echo $result['dogs_breed'] ?></li>
                                    <li>ลักษณะเฉพาะตัว : <?php echo $result['dogs_info'] ?></li>
                                    <li>เพศ : <?php echo $result['dogs_gender'] ?></li>
                                    <li>วันที่เข้าระบบ : <?php echo DateThai($result['create_at']) ?></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
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

    </body>
</html>
