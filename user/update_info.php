<?php
session_start();
@include '../inc/config.php';
@include './check_user.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit();
}

// Lấy thông tin từ form gửi đi
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Lấy username của người dùng từ session
$username = $_SESSION['username'];

// Cập nhật thông tin trong cơ sở dữ liệu
$update_query = "UPDATE user SET name = '$name', email = '$email', phone = '$phone' WHERE username = '$username'";
$result = mysqli_query($conn, $update_query);

if ($result) {
    // Nếu cập nhật thành công, gửi phản hồi về cho client
    echo json_encode(array('status' => 'success', 'message' => 'Information updated successfully!'));
} else {
    // Nếu có lỗi xảy ra, gửi phản hồi về cho client
    echo json_encode(array('status' => 'error', 'message' => 'Failed to update information.'));
}
?>
