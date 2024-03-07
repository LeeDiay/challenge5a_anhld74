<?php
    session_start();
    include '../inc/config.php';
    include './check_admin.php';
    include '../logout.php';

    // Lấy username từ session
    $username = $_SESSION['username'];

    // Truy vấn để lấy ID của người dùng hiện tại từ username
    $query = "SELECT id FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $currentUserId = $row['id'];

    // Truy vấn để đếm số tin nhắn mới của người dùng hiện tại
    $countQuery = "SELECT COUNT(*) AS new_messages_count FROM messages WHERE receiver_id = $currentUserId";
    $countResult = mysqli_query($conn, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $newMessagesCount = $countRow['new_messages_count'];
?>

<?php include '../inc/admin/header.php'; ?>
    <section class="p-5">
        <div class="container">
            <div>
                <div class="d-flex col-md justify-content-center">
                    <div class="card bg-dark text-light" style="width: 18rem;">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="../source/img/flashy-frog.png" alt="">
                            </div>
                            <h4 class="card-title mb-3">
                                Welcome back, <?php echo $_SESSION['username']; ?> !!
                            </h4>
                            <!-- Hiển thị số tin nhắn mới -->
                            <h6>You have <?php echo $newMessagesCount; ?> new messages.</h6>
                            <p></p>
                            <!-- Thêm nút để xem tin nhắn -->
                            <a href="view_messages.php" class="btn btn-primary">View Messages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal và mã HTML khác -->

<?php 
    include '../inc/footer.php';
?>
