<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';

    if(isset($_GET['id'])) {
        $assignment_id = $_GET['id'];
        $query = "SELECT * FROM assignments WHERE id = '$assignment_id'";
        $result = mysqli_query($conn, $query);
        $assignment = mysqli_fetch_assoc($result);
        
        if(!$assignment) {
            echo "Assignment not found.";
            exit;
        }
    } else {
        header("Location: show_assignment.php");
        exit;
    }

    $selected_students = array();
    $assign_query = "SELECT student_username FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
    $assign_result = mysqli_query($conn, $assign_query);
    while ($assign_row = mysqli_fetch_assoc($assign_result)) {
        $selected_students[] = $assign_row['student_username'];
    }

    if (isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $uploader = $_SESSION['username'];

        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];

        $upload_folder = "../assignments/";
        $file_path = $upload_folder . $file_name;

        move_uploaded_file($file_tmp, $file_path);

        $update_query = "UPDATE assignments SET title = '$title', description = '$description', due_date = '$due_date', file_name = '$file_name', file_path = '$file_path' WHERE id = '$assignment_id'";
        mysqli_query($conn, $update_query);

        if(isset($_POST['students'])) {
            $selected_students = $_POST['students'];
            $delete_assign_query = "DELETE FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
            mysqli_query($conn, $delete_assign_query);

            foreach ($selected_students as $student) {
                $assign_query = "INSERT INTO assigned_assignments(student_username, assignment_id) VALUES ('$student', '$assignment_id')";
                mysqli_query($conn, $assign_query);
            }
        }

        $successes[] = "Assignment updated successfully!";
    }
?>

<?php @include '../inc/admin/header.php'; ?>
<section class="p-5">
    <div class="container">
        <div>
            <div class="d-flex col-md justify-content-center">
                <div class="card bg-light text-dark" style="width: 40rem;">
                    <div class="card-body text-center">
                        <form class="text-start" method="POST" enctype="multipart/form-data">
                            <h3 class="text-center">Update Assignment</h3>
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
                                <label for="title" class="form-label">Title:</label>
                                <input class="form-control" type="text" name="title" value="<?php echo $assignment['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control" name="description" rows="3" required><?php echo $assignment['description']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date:</label>
                                <input class="form-control" type="date" name="due_date" value="<?php echo $assignment['due_date']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload File:</label>
                                <input class="form-control" type="file" name="file">
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" id="select-all">
                                <label class="form-check-label" for="select-all">Select All</label>
                            </div>
                            <div class="mb-3">
                                <label for="students" class="form-label">Assign to Students:</label>
                                <?php
                                    $query = "SELECT username FROM user WHERE type = 'user'";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $checked = in_array($row['username'], $selected_students) ? 'checked' : '';
                                        echo '<div class="form-check">';
                                        echo '<input class="form-check-input student-checkbox" type="checkbox" name="students[]" value="' . $row['username'] . '" id="' . $row['username'] . '" ' . $checked . '>';
                                        echo '<label class="form-check-label" for="' . $row['username'] . '">' . $row['username'] . '</label>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                            <div class="d-flex justify-content-between" style="margin-top: 1rem;">  
                                <a href="show_assignment.php" class="btn btn-secondary">Back</a>                              
                                <button type="submit" name='submit' class="btn btn-primary">Submit</button>                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('select-all').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('.student-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('select-all').checked;
            });
        });
    });
</script>

<?php @include '../inc/footer.php'; ?>
