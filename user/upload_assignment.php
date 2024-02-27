<?php
    session_start();
    @include '../inc/config.php';
    @include './check_user.php';
    @include '../logout.php';
    
    if (isset($_POST['submit'])){
        $assignment_id = $_POST['assignment_id']; 
        $block_ext = "sh"; 
        if (!empty($_FILES['upload']['name'])){
            $name = $_FILES['upload']['name'];
            $size = $_FILES['upload']['size'];
            $type = $_FILES['upload']['type'];
            $file_tmp = $_FILES['upload']['tmp_name'];
            $target_dir = "../uploads/" . $_SESSION['username']; // . "/assignments/";
            $file_ext = explode('.', $name);
            $file_ext = strtolower(end($file_ext));

            // Validate file extension
            if ($file_ext !== $block_ext){
                // Validate the size
                if ($size <= 5000000){ // <= 5MB
                    if (!file_exists($target_dir))
                        mkdir($target_dir, 0777, true);
                    $target_file = $target_dir . "${name}";
                    move_uploaded_file($file_tmp, $target_file);
                    $uploader = $_SESSION['username'];
                    // Insert into database
                    $query = "INSERT INTO submitted_assignments(assignment_id, uploader, file_name, file_size, file_type, upload_time) VALUES ('$assignment_id', '$uploader', '$name', '$size', '$type', CURRENT_TIMESTAMP())";
                    mysqli_query($conn, $query);
                    $successes[] = "File uploaded!";
                }else{
                    $errors[] = "File is too big!";
                }
            }else{
                $errors[] = "Invalid file type!";
            }
        }else{
            $errors[] = "No files chosen!";
        }
    }
?>

<?php @include '../inc/user/header.php'; ?>
<section class="p-5">
    <div class="container">
        <div>
            <div class="d-flex col-md justify-content-center">
                <div class="card bg-light text-dark" style="width: 50rem;">
                    <div class="card-body text-center">
                        <form class="text-start" method="POST" enctype="multipart/form-data">
                            <h3 class="text-center">Submit Assignment</h3>
                            <?php
                                if (isset($errors)){
                                    foreach($errors as $error){
                                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                                    }
                                }
                                if (isset($successes)){
                                    foreach($successes as $success){
                                        echo '<div class="alert alert-success" role="alert">'.$success.'</div>';
                                    }
                                }
                            ?>
                            <div class="mb-3">
                                <label for="assignment_id" class="form-label">Assignment ID:</label>
                                <input class="form-control" type="text" name="assignment_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Choose a file to upload:</label>
                                <input class="form-control" type="file" name="upload" required>
                            </div>
                            <div class="d-flex flex-row-reverse" style="margin-top: 1rem;">
                                <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php @include '../inc/footer.php'; ?>
