<?php
session_start();
@include '../inc/config.php';
@include './check_admin.php';
@include '../logout.php';
$username = $_SESSION['username'];
$select = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $select);
$info = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $check_password = "SELECT password FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $check_password);
    $row = mysqli_fetch_assoc($result);
    $current_password_db = $row['password'];

    if ($current_password_db === md5($current_password)) {
        if ($new_password === $confirm_password) {
            $hashed_new_password = md5($new_password);
            $update_password = "UPDATE user SET password = '$hashed_new_password' WHERE username = '$username'";
            if (mysqli_query($conn, $update_password)) {
                $success_message = "Password updated successfully!";
            } else {
                $error_message = "Error updating password: " . mysqli_error($conn);
            }
        } else {
            $error_message = "New password and confirm password do not match!";
        }
    } else {
        $error_message = "Incorrect current password!";
    }
}
?>

<?php
@include '../inc/admin/header.php';
?>

<section class="p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <h3 class="mb-3 text-center">Update Password</h3>
                        <?php if (isset($error_message)) : ?>
                            <div class="alert alert-danger text-left"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success_message)) : ?>
                            <div class="alert alert-success text-left"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password:</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php @include '../inc/footer.php'; ?>
