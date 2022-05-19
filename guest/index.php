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
        <title>รายการสุนัข</title>
    </head>
    <body>
      
        <?php include '../conn.php'; ?>
        <?php include './navbar.php';?>
        
        <div class="no-gutters">
                <?php include './view_dog.php'; ?>
        </div>
        
        <?php include '../script_in_body.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../js/smoke.js"></script>
        
            <script>
                $(document).ready(function (){
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
                            $("#profile_users_name_show").text(data.profile_users_name);
                            $("#profile_users_province_show").text(data.PROVINCE_NAME);
                            $("#profile_users_amp_show").text(data.AMPHUR_NAME);
                            $("#profile_users_district_show").text(data.DISTRICT_NAME);
                            $("#profile_users_detail1_show").text(data.profile_users_detail1);
                            $("#profile_users_detail2_show").text(data.profile_users_detail2);
                        }
                    });
                    e.preventDefault();
                }); 
                });
            </script>
    </body>
</html>
<?php include './modal_dog_view.php';?>

