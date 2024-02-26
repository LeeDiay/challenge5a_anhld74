<?php
if (empty($_SESSION['username'])) {
    // Điều hướng đến trang lỗi error_page.php
    header("Location: ../error_page.php");
    exit;
}
?>
