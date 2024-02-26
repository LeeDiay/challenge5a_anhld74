<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';
    $query = "SELECT * FROM post ORDER BY post_time DESC";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>

<?php @include '../inc/admin/header.php'; ?>
    <?php foreach($posts as $post):?>
        <section class="p-5">
            <div class="container">
                <div>
                    <div class="d-flex col-md justify-content-center">
                        <div class="card bg-light text-dark" style="width: 50rem;">
                            <div class="card-body text-center">
                                <div>
                                    <strong><?php echo $post['content']; ?> </strong>
                                </div>
                               
                                <div class="text-secondary">
                                    By <?php echo $post['uploader'] . ' on ' . $post['post_time']; ?>
                                </div>
                                <a href="create-user.php"> Click to follow  </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php @include '../inc/footer.php'; ?>