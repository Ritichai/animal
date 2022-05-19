<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="../index.php">Aminmal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
            </li>
        </ul>
        <div class="row">
            <button type="button" class="btn btn-secondary ml-2" disabled>
                <?php {
                    include '../conn.php';
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs ");
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
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs where dogs_type = 0");
                    $row = mysqli_fetch_array($result);
                    $count = $row['dogs_id'];
                    ?>
                    จำนวนสุนัขที่ยังไม่ถูกรับเลี้ยง <span class="badge badge-light"><?php echo $count ?></span>
                <?php } ?>
            </button>
            <button type="button" class="btn btn-dark ml-2" disabled>
                <?php {
                    include '../conn.php';
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS dogs_id FROM dogs where dogs_type = 1");
                    $row = mysqli_fetch_array($result);
                    $count = $row['dogs_id'];
                    ?>
                    จำนวนสุนัขที่ถูกรับเลี้ยง <span class="badge badge-light"><?php echo $count ?></span>
                <?php } ?>
            </button>
        </div> 
    </div>
</nav>






