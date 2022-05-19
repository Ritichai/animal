<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-9NlqO4dP5KfioUGS568UFwM3lbWf3Uj3Qb7FBHuIuhLoDp3ZgAqPE1/MYLEBPZYM" crossorigin="anonymous">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.min.css"/>
        <link rel="stylesheet" href="css/smoke.min.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <title>สถานสงเคราะห์สัตว์</title>
    </head>
    <body style="background-color: #eff2f4">




        <div class="container">
            <div class="row" style="margin-top: 30px;">
                <div class="col-sm-12 col-md-4 col-lg-4">
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="shadow" style="padding-bottom: 5px;">
                        <form action="check_login.php" method="post" id="login_form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col text-center rounded mx-auto d-block mt-3">
                                        <img src="wallpaper/login_icon.png" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="col"></div>
                                </div>
                                <br>
                                <div class="col-12 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"> <i class="fas fa-user"></i></div>
                                        </div>
                                        <input type="text" name="users_usersname" id="users_usersname" class="form-control"  placeholder="usersname" >
                                    </div>
                                </div>
                                <div class="col-12 pb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                                        </div>
                                        <input type="password" name="users_password" id="users_password" class="form-control" placeholder="password" >

                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="btnlogin" class="btn btn-primary col-12 mb-1"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
                                    <a class="btn btn-danger col-12 text-white" href="index.php"><i class="fas fa-angle-double-left"></i> กลับหน้าหลัก</a>
                                </div>
                            </div>
                        </form> 
                    </div>     
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4" id="ack">
                </div>
            </div>
        </div>
        <?php include './script_in_body.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/smoke.min.js"></script>

        <script>
            $('#btnlogin').click(function (e) {
                if ($('#users_usersname').smkValidate()) {
                    if ($("#users_usersname").val() === '' || $("#users_password").val() === '') {
                        e.preventDefault();
                        $.smkAlert({
                            text: 'กรอกข้อมูลให้ครบ!',
                            type: 'danger'
                        });
                    } else {
                        $.post("check_login.php", {users_usersname: $("#users_usersname").val(), users_password: $("#users_password").val()})
                                .done(function (data) {
                                    if (data.status === "danger") {
                                        $.smkAlert({text: data.message,
                                            type: data.status});
                                    } else {
//                                          $(open(data.location));
                                            location.href = data.location;
                                    }
                                });
                        e.preventDefault();
                    }
                }
            });
        </script>

    </body>
</html>