<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';

    // Xử lý yêu cầu xóa
    if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        // Xóa bài đăng từ cơ sở dữ liệu
        $delete_query = "DELETE FROM post WHERE id = $post_id";
        mysqli_query($conn, $delete_query);
        // Điều hướng người dùng đến trang hiển thị bài đăng sau khi đã xóa
        header("Location: announcement.php");
        exit();
    }

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
                                <strong><?php echo $post['content']; ?></strong>
                            </div>
                            <div class="text-secondary">
                                By <?php echo $post['uploader'] . ' on ' . $post['post_time']; ?>
                            </div>
                            <?php if($post['uploader'] == $_SESSION['username']): ?>
                                <!-- Nút hoặc liên kết để xóa bài đăng -->
                                <a href="?action=delete&post_id=<?php echo $post['id']; ?>" class="btn btn-danger">Xóa</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endforeach; ?>

<?php @include '../inc/footer.php'; ?>
