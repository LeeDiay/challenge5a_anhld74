<?php
    if (empty($_SESSION['username'])) {
        http_response_code(403);
        die(); // veef xem them
    }
?>