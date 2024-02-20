<?php
    session_start();
    @include '../inc/config.php';
    @include './check_user.php';
    @include '../logout.php';
    $query = "SELECT * FROM post ORDER BY post_time";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>

<?php @include '../inc/user/header.php'; ?>
    <?php foreach($posts as $post):?>
        <section class="p-5">
            <div class="container">
                <div>
                    <div class="d-flex col-md justify-content-center">
                        <div class="card bg-light text-dark" style="width: 50rem;">
                            <div class="card-body text-center">
                                <div>
                                    <?php echo $post['content']; ?>
                                </div>
                                <div class="text-secondary">
                                    By <?php echo $post['uploader'] . ' on ' . $post['post_time']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php @include '../inc/footer.php'; ?>