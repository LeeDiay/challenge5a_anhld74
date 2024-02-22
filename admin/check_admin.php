<?php
    if ($_SESSION['role'] !== 'admin') {
        http_response_code(403);
        die(); 
    }
    // else {
    //     echo "<script>alert('Đăng nhập thành công!');</script>";
    // }
?>  