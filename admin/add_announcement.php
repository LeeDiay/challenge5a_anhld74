<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';
    if (isset($_POST['submit'])){
        if ($_POST['post'] == "")
            $errors[] = "There is nothing yet!";
        else{
            $content = $_POST['post'];
            $uploader = $_SESSION['username'];
            $query = "INSERT INTO post(uploader, content) VALUES ('$uploader', '$content')";
            mysqli_query($conn, $query);
            $successes[] = 'Post successfully!'; 
        }
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
                                <h3 class="text-center">Upload Post</h3>
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
                                <div class="input-group">
                                    <span class="input-group-text">Add your post</span>
                                    <textarea name="post" class="form-control" aria-label="With textarea"></textarea>
                                </div>
                                <div class="d-flex flex-row-reverse" style="margin-top: 1rem;">
                                    <button type="submit" name='submit' class="btn btn-primary">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php @include '../inc/footer.php'; ?>