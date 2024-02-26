<?php
if (empty($_SESSION['username'])) {
    // Điều hướng đến trang lỗi error_page.php
    header("Location: ../error_page.php");
    //header("Location:../index.php");
    // Đảm bảo không có mã HTML hoặc mã PHP nào được xuất ra sau dòng này
    exit;
}
?>
