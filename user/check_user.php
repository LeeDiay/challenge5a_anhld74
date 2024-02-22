<?php
    if ($_SESSION['role'] !== 'user') {
        http_response_code(403);
        die(); 
    }
?>