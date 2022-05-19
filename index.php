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
    <body>
        <section>
            <div class="view" style="background-image: url('wallpaper/wallpaper.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                <div class="row no-gutters">
                    <div  class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                        <br><br><br>
                        <div>
                            <h1 class="display-3 wow fadeIn text-white">We love Animal</h1>
                            <p class="lead text-white wow fadeInLeft">เว็บเป็นช่วยเหลือสุนัขจรจัด</p>
                            <hr class="my-4 wow fadeInLeft">
                            <p class="wow fadeInRight">ผู้จัดทำมีความตั้งใจที่จะช่วยเหลือ สัตว์สุนัขจรที่ ยังไม่มีผู้เลี้ยงได้มีเจ้าของ เจ้าของสุนัขที่มีสุนัขหลายตัวที่ต้องการให้ลูกสุนัข แก่ผู้ที่ต้องการได้รับไปเลี้ยง</p>
                            <p class="lead wow fadeInUp">
                                <a class="btn btn-danger btn-lg col-12" href="login.php" role="button">เข้าสู่ระบบ</a>
                                <a class="btn btn-success btn-lg col-12 mt-1" href="guest/index.php" role="button">เข้าชมรายการสุนัข</a>
                            </p>
                        </div>
                    </div>  
                </div> 
            </div>        
        </section>
        <div class="container mb-5">
            <hr class="my-4">
            <h3 class="text-center"><b>จำนวนผู้สนใจเข้าร่วมโคตรงการ</b></h3>
            <hr class="my-4">
        </div>
<br>
        <!-- card แสดงจำนวนต่างๆ-->
        <section class="mt-3">
            <div class="row no-gutters">
                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                    <div class="text-center shadow-lg p-3 mb-5 bg-white rounded" >
                        <div class="card border-light">
                            <div class="text-center wow fadeInUp">
                                <img src="icon/house.png" style="height: 150px; width: 150px;">
                            </div>
                            
                                <h5 class="card-title">จำนวนผู้เข้าร่วมโครงการ</h5>
                                  <?php {
                                    include './conn.php';
                                    $result = mysqli_query($conn, "SELECT COUNT(*) AS profile_users_name FROM profile_users");
                                    $row = mysqli_fetch_array($result);
                                    $count = $row['profile_users_name'];
                                    ?>
                                
                                <h1 class="card-text"><?php echo $count;?></h1>
                                 <?php } ?>
                        </div>
                    </div>  
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                    <div class="text-center shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card border-light">
                            <div class="text-center wow fadeInUp">
                                <img src="icon/dog.png" style="height: 150px; width: 150px;">
                            </div>  
                                <h5 class="card-title">หมาในโคตรงการ</h5>
                                <?php {
                                    include './conn.php';
                                    $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs");
                                    $row = mysqli_fetch_array($result);
                                    $count = $row['dogs_id'];
                                    ?>
                                <h1 class="card-text"><?php echo $count;?></h1>
                                 <?php } ?>
                        </div>
                    </div>  
                </div>

            </div>
        </section>
        <!-- card แสดงจำนวนต่างๆ-->


        <hr class="my-4" style="width: 800px;">
        <div class="view" style="background-image: url('wallpaper/wallpaper_regis.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <div class="container ">
                <br><br><br>    
                <div class="row no-gutters">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12"></div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 ">

                        <div class="container text-center">
                            <h2 class="text-white">สมัครเข้าร่วมโคตรงการ</h2>
                            <div class="card bg-light" id="card_regis">
                                <h5 class="card-header">กรอกข้อมูล</h5>
                                <div class="card-body"> 

                                    <form class="text-left"  id="form_regis" action="insert_users.php" method="post" >
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="users_usersname"  name="users_usersname" placeholder="ชื่อผู้ใช้">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="users_password" name="users_password" placeholder="รผัสผ่าน"  minlength="6" maxlength="8" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน">
                                        </div>
                                        <button type="submit"  id="submit" name="submit" class="btn btn-primary col-12">ยืนยัน</button>    
                                    </form>
                                </div>
                            </div>
                            <br><br><br>
                        </div>               

                    </div>
                </div>
            </div>
        </div>






        <?php include './script_in_body.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/smoke.min.js"></script>


        <script>
            $(document).ready(function () {
                $("#form_regis").on("submit", function (e) {

                    if ($("#users_usersname").val() === '' || $("#users_password").val() === '') {
                        $.smkAlert({text: "กรุณากรอกข้อมูลให้ครบ", type: "danger"});
                        e.preventDefault();
                    } else
                    if ($("#users_password").val() !== $("#confirm_password").val()) {
                        $.smkAlert({text: "รหัสผ่านไม่ตรงกัน", type: "danger"});
                        e.preventDefault();

                    } else {
                        $.post("insert_users.php", {users_usersname: $("#users_usersname").val(), users_password: $("#users_password").val()})
                                .done(function (data) {
                                    if (data.status === "success") {
                                        $.smkAlert({text: data.message, type: data.status});
                                        $("#card_regis").hide("slow");
                                    } else {
                                        $.smkAlert({text: data.message, type: data.status});
                                    }
                                    $('#form_regis').smkClear();
                                });
                        e.preventDefault();
                    }

                });
                 
            });
        </script>

        
    </body>
</html>