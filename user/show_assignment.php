<?php
    session_start();
    @include '../inc/config.php';
    @include './check_user.php';
    @include '../logout.php';

    $student_username = $_SESSION['username'];

    $query = "SELECT DISTINCT assignments.*, assigned_assignments.student_username
              FROM assignments
              INNER JOIN assigned_assignments ON assignments.id = assigned_assignments.assignment_id
              WHERE assigned_assignments.student_username = '$student_username'";
    $result = mysqli_query($conn, $query);
?>

<?php @include '../inc/user/header.php'; ?>
<section class="p-5">
    <div class="container">
        <div>
            <div class="d-flex col-md justify-content-center">
                <div class="card bg-light text-dark" style="width: 80rem;">
                    <div class="card-body text-center">
                        <h3 class="text-center">My Assignments</h3>
                        <div class="mb-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Assignment Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['title']}</td>";
                                            echo "<td>{$row['description']}</td>";
                                            echo "<td>{$row['due_date']}</td>";
                                            echo "<td><a href='upload_assignment.php?id={$row['id']}' class='btn btn-primary'>Submit</a></td>"; // Link to upload_assignment.php
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php @include '../inc/footer.php'; ?>
