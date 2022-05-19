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
        <title>ข้อมูลสุนัขภายในสถานสงต์เคราะห์</title>
    </head>
    <body>
        <?php include '../conn.php'; ?>
        <?php include './navbar.php'; ?>
        <div class="container">
            <div class="card mt-2">
                <div class="card-header">
                    ข้อมูลสุนัข
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card-body">
                            <div>
                                <form id="form_dogs_add" name="form_dogs_add" action="insert_dogs.php" method="post" novalidate enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-sm-3">ชื่อ</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="dogs_name" name="dogs_name" placeholder="กรอกชื่อ" data-smk-msg="กรุณากรอกซื่อสัตว์" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3">สายพันธุ์</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="dogs_breed" name="dogs_breed" placeholder="กรอกสายพันธุ์" data-smk-msg="กรุณากรอกสายพันธุ์" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3">ลักษณะเฉพาะ</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="dogs_info" name="dogs_info" placeholder="กรอกลักษณะเฉพาะ" data-smk-msg="กรุณากรอกลักษณะเฉพาะ" required>
                                        </div>

                                    </div>
                                    <div class=" form-group row">
                                        <legend class="col-form-label col-sm-3 pt-0">เลือกเพศ</legend>
                                        <div class="col-sm-7">
                                            <select class="custom-select" id="dogs_gender" name="dogs_gender" data-smk-msg="กรุณาเลือกเพศ" required>
                                                <option value="">เลือกเพศ</option>
                                                <option value="เพศผู้">เพศผู้</option>
                                                <option value="เพศเมีย">เพศเมีย</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">รูปสุนัข</label>
                                            <div>
                                                <input type="file" class="col-sm-9" id="dogs_img" name="dogs_img" data-smk-msg="กรุณาเลือกรูป" required>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <div class="col">
                                            <button type="submit" id="submit_dogs" name="submit_dogs" class="btn btn-danger col-8"><i class="fas fa-plus"> บันทึก</i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <img id="show" src="#" class="img-thumbnail" alt="your image" style="width: 300px; height: 380px;">
                    </div>
                </div>
            </div>    
        </div>
        <?php include '../script_in_body.php'; ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/smoke.min.js"></script>
        <!--  script ค่าว่าง form -->
        <script>
                  $('#show').hide();
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
            $('#form_dogs_add').on("submit", function (e) {
                if ($('#form_dogs_add').smkValidate()) {
                    //upload file via ajax setting
                    $.ajax({
                        url: 'insert_dogs.php',
                        type: 'POST',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        dataType: 'json'
                    }).done(function (data) {
                        if (data.status === "success") {
                            $.smkAlert({text: data.message, type: data.status});
                        } else {
                            $.smkAlert({text: data.message, type: data.status});
                        }
                        
                        $("#form_dogs_add")[0].reset();
                        $("#show").hide('slow');
                    });
                    e.preventDefault();
                }
                e.preventDefault();
            });

        </script>        
        <!--  script ค่าว่าง form -->
        <script>
// Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
    </body>
</html>