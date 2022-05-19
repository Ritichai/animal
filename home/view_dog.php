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
        . "WHERE create_by = '" . $session_id_dogs . "' and dogs_type = 0";

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
         <?php }?>
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
         <?php }?>
    </button>
    <button type="button" class="btn btn-success ml-2" disabled>
       <?php {
                                    include '../conn.php';
                                   $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs where create_by = '" . $session_id_dogs . "' and dogs_type = 1");
                                    $row = mysqli_fetch_array($result);
                                    $count = $row['dogs_id'];
                                    ?>
        จำนวนสุนัขที่ถูกรับเลี้ยง <span class="badge badge-light"><?php echo $count ?></span>
         <?php }?>
    </button>
</div>
<h3 class="ml-5 mt-5"> สุนัขทั้งหมดที่ยังไม่ถูกรับเลี้ยง</h3>
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
                <div class="btn-group col-12">
                    <a href="#" id="<?= $result['dogs_id']; ?>" class="btn_view btn btn-warning"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-eye"></i></a>
                    <a href="#" id="<?= $result['dogs_id']; ?>" class="btn_edit_detail btn btn-danger" data-toggle="modal"
                       data-id="<?php echo $result['dogs_id'] ?>"
                       data-name="<?php echo $result['dogs_name'] ?>"
                       data-breed="<?php echo $result['dogs_breed'] ?>"
                       data-info="<?php echo $result['dogs_info'] ?>"
                       data-gender="<?php echo $result['dogs_gender'] ?>"
                       data-toggle="modal" data-target="#edit_dogs"><i class="fas fa-edit"></i>
                    </a>
                    <a href="#" id="<?= $result['dogs_id']; ?>" class="btn_edit btn btn-primary"><i class="fas fa-hand-holding-heart"></i></a>
                    <a href="#" id="<?= $result['dogs_id']; ?>" class="btn_del  btn btn-secondary" ><i class="far fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

