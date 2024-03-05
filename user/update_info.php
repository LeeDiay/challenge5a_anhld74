<?php
session_start();
@include '../inc/config.php';
@include './check_user.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$email = $_POST['email'];
$phone = $_POST['phone'];

$username = $_SESSION['username'];

$update_query = "UPDATE user SET email = '$email', phone = '$phone' WHERE username = '$username'";
$result = mysqli_query($conn, $update_query);

?>
