<?php
    session_start();
    @include '../inc/config.php';
    @include 'check_admin.php';
    @include '../logout.php';
    if (isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $_SESSION['update_user'] = $username;
        $select = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $select); 
        if(mysqli_num_rows($result) == 0){
            $error[] = 'This username doesn\'t exist!';
        }else{
            $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    } 
    if (isset($_POST['update'])){
        $update_user = $_SESSION['update_user'];
        $nusername = mysqli_real_escape_string($conn, $_POST['nusername']);
        $nemail = mysqli_real_escape_string($conn, $_POST['nemail']);
        $npass = md5($_POST['npassword']);
        $query = "UPDATE user SET username='$nusername', email='$nemail', password='$npass' WHERE username='$update_user'";
        mysqli_query($conn, $query);
        unset($update_user);
        $success[] = 'Update successfully';
    }
?>

<?php @include '../inc/admin/header.php'; ?>
    <section class="p-5">
        <div class="container">
            <div>
                <div class="d-flex col-md justify-content-center">
                    <div class="card bg-light text-dark" style="width: 50rem;">
                        <div class="card-body text-center">
                            <form class="text-start" method='POST'>
                                <h3 class="text-center">Update user</h3>
                                <?php
                                    if (isset($error)){
                                        foreach($error as $error){
                                            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                                        }
                                    }
                                    if (isset($success)){
                                        foreach($success as $success){
                                            echo '<div class="alert alert-success" role="alert">'.$success.'</div>';
                                        }
                                    }
                                ?>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Enter username:</label>
                                    <input type="text" name='username' class="form-control" id="username">
                                </div>
                                
                                <div class="d-flex flex-row-reverse" style="margin-top: 1rem;">
                                    <button type="submit" name='submit' class="btn btn-primary">Check</button>
                                </div>

                                <?php if (isset($user)): ?>
                                    <div style="margin-bottom: 1rem";>Available user:</div>
                                        <?php 
                                            echo $user[0]['username'] . ' - ' . $user[0]['email']  . ' - ' . $user[0]['type'] . '<br>'; 
                                            echo '<div style="margin-top: 1rem;">Update information:</div>';
                                        ?> 
                                        <div class="d-flex flex-column col-md justify-content-center" style="margin-top: 1rem;">
                                            <form class="text-start" method='POST'>                                
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Enter username:</label>
                                                    <input type="text" name='nusername' class="form-control" id="username" value="<?php echo $user[0]['username']; ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Enter email:</label>
                                                    <input type="email" name='nemail' class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $user[0]['email']; ?>">
                                                 </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Enter new password:</label>
                                                    <input type="password" name='npassword' class="form-control">
                                                </div>
                                                <div class="d-flex flex-row-reverse">
                                                    <button type="submit" name='update' class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php @include '../inc/footer.php'; ?>