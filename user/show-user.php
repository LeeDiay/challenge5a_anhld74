<?php
    session_start();
    @include '../inc/config.php';
    @include './check_user.php';
    @include '../logout.php';
   
    // Lấy tất cả người dùng từ cơ sở dữ liệu
    $select = "SELECT * FROM user WHERE type = 'user' ";
    $result = mysqli_query($conn, $select);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
    @include '../inc/user/header.php';
?>


<section class="p-5">
    <div class="container">
        <?php foreach ($users as $user): ?>
            <div class="d-flex col-md justify-content-center mb-4">
                <div class="card bg-dark text-light" style="min-width: 45rem;">
                    <div class="card-body d-flex align-items-center">
                    <div class="avatar" style="flex: 0 0 100px; margin-right: 40px;">
                        <img src="<?php echo '../avatar_user/' . $user['avatar']; ?>" alt="Avatar" style="width: 100px; height: 100px; border-radius: 40%;">
                    </div>
                        <div class="user-info flex-grow-1">
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Username:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $user['username']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Name:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $user['name']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Email:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $user['email']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Phone Number:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $user['phone']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Role:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $user['type']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php @include '../inc/footer.php'; ?>
