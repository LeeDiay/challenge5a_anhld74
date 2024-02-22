<?php
    session_start();
    @include './inc/config.php';
    @include './check_user.php';
    @include '../logout.php';
    
?>

<?php @include '../inc/user/header.php'; ?>
    <section class="p-5">
        <div class="container">
            <div>
                <div class="d-flex col-md justify-content-center">
                    <div class="card bg-dark text-light" style="width: 18rem;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="../source/img/two-frogs.png" alt="">
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

    <div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="Email/User" class="col-form-label">Email/Username</label>
                            <input type="text" class="form-control" id="Email">
                        </div>
                    </form>
                    <form>
                        <div class="mb-3">
                            <label for="Password" class="col-form-label">Password</label>
                            <input type="text" class="form-control" id="Password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="justify-content: space-between;">
                    <p style="text-align: left;">Don't have an account? <a href="register.php">Sign up here</a></p>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
<?php 
    @include '../inc/footer.php';
?>