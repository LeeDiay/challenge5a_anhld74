<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';
   
    $username = $_SESSION['username'];
    $select = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $select);
    $info = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
    @include '../inc/admin/header.php';
?>


<section class="p-5">
        <div class="container">
            <div>
                <div class="d-flex col-md justify-content-center">
                    <div class="card bg-dark text-light" style="min-width: 25rem;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="<?php echo '../avatar_user/' . $info[0]['avatar']; ?>" alt="Avatar" style="width: 200px; height: 200px; border-radius: 30%;">
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Username:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $info[0]['username']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Name:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $info[0]['name']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Email:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $info[0]['email']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Phone Number:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $info[0]['phone']; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="text-end" style="min-width: 10rem;">
                                    <h6 class="text-start card-title" style="margin-top: 0.1rem;">
                                        Role:
                                    </h6>
                                </div>
                                <div class="text-end" style="min-width: 10rem;">
                                    <?php echo $info[0]['type']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php @include '../inc/footer.php'; ?>