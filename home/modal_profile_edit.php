<div class="modal fade" id="edit_add1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลที่อยู่ :<?php echo $row_user['profile_users_name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmMain" action="edit_add1.php" method="post" id="frmMain" novalidate>
                    <div class="row">
                        <div class="col-6">
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary col-6" data-dismiss="modal">ยกเลิก</a>
                <button id="submit_form_add1" name="submit_form_add1" value="ตกลง" class="btn btn-primary col-6">บันทึก</button>  
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_add2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลที่อยู่ : <?php echo $row_user['profile_users_name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="edit_add2_form" action="edit_add2.php" method="post" id="edit_add2_form" novalidate>
                    
                    
                            <div class="form-group">
                                <label>รายละเอียดที่อยู่</label>
                                <textarea class="form-control" id="profile_users_detail1" name="profile_users_detail1"rows="3" data-smk-msg="กรุณากรอกข้อมูล" required></textarea>
                            </div>
                    
                    
                </form>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary col-6" data-dismiss="modal">ยกเลิก</a>
                    <button id="submit_form_add2" name="submit_form_add2" value="ตกลง" class="btn btn-primary col-6">บันทึก</button>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_add3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลที่อยู่ : <?php echo $row_user['profile_users_name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="edit_add3_form" action="edit_add3.php" method="post" id="edit_add3_form" novalidate>
                            <div class="form-group">
                                <label>รายละเอียดความต้องการ</label>
                                <textarea class="form-control" id="profile_users_detail2" name="profile_users_detail2"rows="3" data-smk-msg="กรุณากรอกข้อมูลความต้องการ" required></textarea>
                            </div>
                </form>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary col-6" data-dismiss="modal">ยกเลิก</a>
                    <button id="submit_form_add3" name="submit_form_add3" value="ตกลง" class="btn btn-primary col-6">บันทึก</button>  
                </div>
            </div>
        </div>
    </div>
</div>

</div>
