<?php
    if (empty($_SESSION['username'])) {
        http_response_code(403);
        echo "Truy cập bị từ chối!";
        die(); 
    }
?>