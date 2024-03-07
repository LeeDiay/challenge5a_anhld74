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

    // Truy vấn để lấy tin nhắn được gửi đến người dùng hiện tại
    $messagesQuery = "SELECT * FROM messages WHERE receiver_id = $currentUserId";
    $messagesResult = mysqli_query($conn, $messagesQuery);
?>

<?php include '../inc/admin/header.php'; ?>

<section class="p-5">
    <div class="container">
        <div>
            <h2>Received Messages</h2>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Message</th>
                            <th>Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($messagesResult)) {
                                $senderId = $row['sender_id'];
                                $message = $row['message'];
                                $sentAt = $row['sent_at'];

                                // Lấy thông tin về người gửi
                                $senderQuery = "SELECT username FROM user WHERE id = $senderId";
                                $senderResult = mysqli_query($conn, $senderQuery);
                                $senderRow = mysqli_fetch_assoc($senderResult);
                                $senderUsername = $senderRow['username'];

                                echo "<tr>";
                                echo "<td>$senderUsername</td>";
                                echo "<td>$message</td>";
                                echo "<td>$sentAt</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include '../inc/footer.php'; ?>
