<?php
session_start();
if (session_destroy()) {
    echo "<meta http-equiv='refresh' content='2; URL=../index.php'>";
}
?>
