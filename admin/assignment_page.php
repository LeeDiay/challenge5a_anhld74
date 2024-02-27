<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';

    // Kiểm tra xem ID của bài tập đã được truyền qua URL hay không
    if(isset($_GET['id'])) {
        $assignment_id = $_GET['id'];

        // Truy vấn để lấy thông tin chi tiết về bài tập
        $query = "SELECT * FROM assignments WHERE id = '$assignment_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Tính toán thời gian còn lại
        $due_date = strtotime($row['due_date']);
        $current_time = time();
        $time_left = $due_date - $current_time;

        // Nếu thời gian còn lại âm, hiển thị thông báo đã hết thời gian
        if ($time_left < 0) {
            $time_left = 0;
        }

        $days_left = floor($time_left / (60 * 60 * 24));
        $hours_left = floor(($time_left % (60 * 60 * 24)) / (60 * 60));
        $minutes_left = floor(($time_left % (60 * 60)) / 60);
    } else {
        // Nếu không có ID được truyền, chuyển hướng người dùng trở lại trang danh sách bài tập
        header("Location: assignments_list.php");
        exit();
    }
?>

<?php @include '../inc/admin/header.php'; ?>
<section class="p-5">
    <div class="container">
        <div class="d-flex col-md justify-content-center">
            <div class="card bg-light text-dark" style="width: 60rem;">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $row['title']; ?></h3>
                    <p class="card-text"><strong>Description:</strong> <?php echo $row['description']; ?></p>
                    <p class="card-text"><strong>Deadline:</strong> <?php echo $row['due_date']; ?></p>
                    <p class="card-text"><strong>Assigned Students:</strong> 
                        <?php
                            // Truy vấn để lấy danh sách sinh viên được giao bài tập
                            $assign_query = "SELECT student_username FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
                            $assign_result = mysqli_query($conn, $assign_query);
                            $assigned_students = [];
                            while ($assign_row = mysqli_fetch_assoc($assign_result)) {
                                $assigned_students[] = $assign_row['student_username'];
                            }
                            $assigned_students_str = implode(", ", $assigned_students);
                            echo $assigned_students_str;
                        ?>
                    </p>
                    <!-- Hiển thị thời gian còn lại -->
                    <p class="card-text"><strong>Time Left:</strong> <span id="timeLeft">
                        <?php 
                            if ($time_left > 0) {
                                echo "$days_left days, $hours_left hours, $minutes_left minutes";
                            } else {
                                echo "Time's up!";
                            }
                        ?>
                    </span></p>
                    <!-- Nút Back -->
                    <a href="show_assignment.php" class="btn btn-secondary">Back</a>
                    <!-- Nút Update -->
                    <a href="update_assignment.php?id=<?php echo $assignment_id; ?>" class="btn btn-primary">Update</a>
                    <!-- Nút Delete -->
                    <a href="delete_assignment.php?id=<?php echo $assignment_id; ?>" class="btn btn-danger">Delete</a>
                    <!-- Script JavaScript để đếm ngược thời gian -->
                    <script>
                        // Hàm cập nhật thời gian còn lại
                        function updateTime() {
                            var timeLeftSpan = document.getElementById("timeLeft");
                            var daysLeft = <?php echo $days_left; ?>;
                            var hoursLeft = <?php echo $hours_left; ?>;
                            var minutesLeft = <?php echo $minutes_left; ?>;

                            // Giảm thời gian còn lại
                            if (minutesLeft > 0) {
                                minutesLeft--;
                            } else {
                                if (hoursLeft > 0) {
                                    hoursLeft--;
                                    minutesLeft = 59;
                                } else {
                                    if (daysLeft > 0) {
                                        daysLeft--;
                                        hoursLeft = 23;
                                        minutesLeft = 59;
                                    } else {
                                        // Nếu hết thời gian, dừng đếm ngược
                                        clearInterval(timer);
                                        timeLeftSpan.textContent = "Time's up!";
                                    }
                                }
                            }

                            // Cập nhật nội dung thẻ span
                            if (daysLeft >= 0 || hoursLeft >= 0 || minutesLeft >= 0) {
                                timeLeftSpan.textContent = daysLeft + " days, " + hoursLeft + " hours, " + minutesLeft + " minutes";
                            } else {
                                timeLeftSpan.textContent = "Time's up!";
                            }
                        }

                        // Gọi hàm updateTime mỗi phút
                        var timer = setInterval(updateTime, 60000);
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<?php @include '../inc/footer.php'; ?>
