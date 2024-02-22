<?php
    if ($_SESSION['role'] !== 'admin') {
        http_response_code(403);
        echo "Truy cập bị từ chối!";
        die(); 
    }
?>  