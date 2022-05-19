<?php
include '../conn.php';



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
        . "WHERE create_by = '" . $session_id_dogs . "'";

$query = mysqli_query($conn, $sql);
?>

<div class="modal fade" id="edit_dogs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลสุนัข :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="edit_dogs" action="edit_dogs_detail.php" method="post" id="edit_dogs" novalidate enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-3">ชื่อ</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="dogs_name" name="dogs_name" placeholder="กรอกชื่อ" data-smk-msg="กรุณากรอกซื่อสัตว์" required>
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
                        <input type="hidden" class="form-control" id="dogs_id" name="dogs_id" >
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
                                <input type="file" class="col-sm-9" id="dogs_img" name="dogs_img" data-smk-msg="กรุณาเลือกรูป">
                                <input name="img2"  type="hidden" id="img2" value="">
                            </div>    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary col-6" data-dismiss="modal">ยกเลิก</a>
                        <button  type="submit" id="<?= $result['dogs_id']; ?>" name="submit_edit_dogs" value="ตกลง" class="btn_supmit btn btn-primary col-6">บันทึก</button>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>