<?php
session_start();
@include '../inc/config.php';
@include './check_admin.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

$username = $_SESSION['username'];

$update_query = "UPDATE user SET email = '$email', phone = '$phone' WHERE username = '$username'";
$result = mysqli_query($conn, $update_query);
?>
