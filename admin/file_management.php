<?php
    session_start();
    @include '../inc/config.php';
    @include 'check_admin.php';
    @include '../logout.php';
    if (isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $select = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $select); 
        if(mysqli_num_rows($result) == 0){
            $error[] = 'This username doesn\'t exist!';
        }else{
            $select = "SELECT user.username, submitted_assignments.uploader, submitted_assignments.upload_time, submitted_assignments.assignment_id, submitted_assignments.file_size, submitted_assignments.file_name 
                       FROM user 
                       INNER JOIN submitted_assignments ON user.username = submitted_assignments.uploader 
                       WHERE user.username = '$username' ORDER BY submitted_assignments.upload_time ASC;";
            $result = mysqli_query($conn, $select); 
            if(mysqli_num_rows($result) == 0){
                $error[] = "This username hasn't uploaded any file!";
            }else{
                $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
        }
    } 
?>

<?php @include '../inc/admin/header.php'; ?>
    <section class="p-5">
        <div class="container"> 
            <div>
                <div class="d-flex col-md justify-content-center">
                    <div class="card bg-light text-dark" style="width: 60rem;">
                        <div class="card-body text-center">
                            <form class="text-start" method='POST'>
                                <h3 class="text-center">File Management</h3>
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
                                    <label for="username" class="form-label">Enter username to search for their uploaded files:</label>
                                    <input type="text" name='username' class="form-control" id="username">
                                </div>
                                
                                <div class="d-flex flex-row-reverse" style="margin-top: 1rem;">
                                    <button type="submit" name='submit' class="btn btn-primary">Check</button>
                                </div>

                                <?php if (isset($files)): ?>
                                    <div style="margin-bottom: 1rem";>Available files of user '<strong><?php echo $username; ?></strong>':</div>
                                    <?php foreach($files as $file): ?>
                                        <div class="d-flex justify-content-between align-items-center" style="margin-bottom:1rem;">
                                            <div>
                                                <?php echo $file['file_name'] . ' - ' . $file['file_size'] . ' KB - '. $file['upload_time'];?>
                                            </div>
                                            <div>
                                                <form class="text-start" method='POST'>
                                                    <button type="submit" name="<?php echo $file['assignment_id'];?>" class="btn btn-primary">Download</button>
                                                    <button type="submit" name="<?php echo $file['assignment_id'];?>" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                            if (isset($_POST[$file['assignment_id']])){
                                                $name = $file['file_name'];
                                                $query = "DELETE FROM upload WHERE name='$name';";
                                                mysqli_query($conn, $query);
                                                $success[] = 'Delete successfully!';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php @include '../inc/footer.php'; ?>