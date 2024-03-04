<?php
session_start();
@include '../inc/config.php';
@include './check_user.php';
@include '../logout.php';

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

    // Nếu thời gian còn lại âm, hiển thị thông báo đã hết thời gian và không cho phép upload
    if ($time_left <= 0) {
        $time_left = 0;
        $upload_disabled = true;
    } else {
        $upload_disabled = false;
    }

    $days_left = floor($time_left / (60 * 60 * 24));
    $hours_left = floor(($time_left % (60 * 60 * 24)) / (60 * 60));
    $minutes_left = floor(($time_left % (60 * 60)) / 60);
} else {
    // Nếu không có ID được truyền, chuyển hướng người dùng trở lại trang danh sách bài tập
    header("Location: show_assignment.php");
    exit();
}

if(isset($_POST['submit']) && !$upload_disabled) {
    $username = $_SESSION['username'];

    if(isset($_FILES['submission'])) {
        $block_ext = "sh"; 
        if (!empty($_FILES['submission']['name'])){
            $name = $_FILES['submission']['name'];
            $size = $_FILES['submission']['size'];
            $type = $_FILES['submission']['type'];
            $file_tmp = $_FILES['submission']['tmp_name'];
            $target_dir = "../submissions/";
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
        } 
    else {
        $errors[] = "No files chosen!";
      }   
    } 
}
?>

<?php @include '../inc/user/header.php'; ?>
<section class="p-5">
    <div class="container">
        <div class="d-flex col-md justify-content-center">
            <div class="card bg-light text-dark" style="width: 40rem;">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $row['title']; ?></h3>
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
                    <p class="card-text"><strong>Description:</strong> <?php echo $row['description']; ?></p>
                    <p class="card-text"><strong>Deadline:</strong> <?php echo $row['due_date']; ?></p>
                    <p class="card-text"><strong>Document:</strong>
                        <?php
                            if (!empty($row['file_name'])) {
                                echo '<a href="' . $row['file_path'] . '" download>' . $row['file_name'] . '</a>';
                            } else {
                                echo 'No file uploaded';
                            }
                        ?>
                    </p>
                    <p class="card-text"><strong>Time Left:</strong> <span id="timeLeft">
                        <?php 
                            if ($time_left > 0) {
                                echo "$days_left days, $hours_left hours, $minutes_left minutes";
                            } else {
                                echo "Time's up! You can't submit your assignment!";
                            }
                        ?>
                    </span></p>

                    <?php if(!$upload_disabled): ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="submission" class="form-label"><strong>Submit Assignment:</strong></label>
                                <input class="form-control" type="file" name="submission">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary float-end">Submit</button>
                        </form>
                    <?php endif; ?>

                    <a href="show_assignment.php" class="btn btn-secondary">Back</a>
                    <!--đếm ngược thời gian -->
                    <script>
                        function updateTime() {
                            var timeLeftSpan = document.getElementById("timeLeft");
                            var daysLeft = <?php echo $days_left; ?>;
                            var hoursLeft = <?php echo $hours_left; ?>;
                            var minutesLeft = <?php echo $minutes_left; ?>;

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
                                        clearInterval(timer);
                                        timeLeftSpan.textContent = "Time's up!";
                                    }
                                }
                            }

                            if (daysLeft >= 0 || hoursLeft >= 0 || minutesLeft >= 0) {
                                timeLeftSpan.textContent = daysLeft + " days, " + hoursLeft + " hours, " + minutesLeft + " minutes";
                            } else {
                                timeLeftSpan.textContent = "Time's up!";
                            }
                        }

                        var timer = setInterval(updateTime, 60000);
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<?php @include '../inc/footer.php'; ?>
