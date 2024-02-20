<?php
    session_start();
    @include './inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';
?>

<?php @include '../inc/admin/header.php'; ?>

<!-- cop ra file rieng roi include vao -->
<!-- Tim hieu cach header sang trang status code -->
<!-- Log out thi huy session roi header den trang login -->

    <section class="p-5">
        <div class="container">
            <div>
                <div class="d-flex col-md justify-content-center">
                    <div class="card bg-dark text-light" style="width: 18rem;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="../source/img/flashy-frog.png" alt="">
                            </div>
                            <h6 class="card-title mb-3">
                                Welcome back,  <?php echo $_SESSION['username'] ?> !!
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    @include '../inc/footer.php';
?>