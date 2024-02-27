<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';
?>

<?php @include '../inc/admin/header.php'; ?>
<section class="p-5">
    <div class="container">
        <div>
            <div class="d-flex col-md justify-content-center">
                <div class="card bg-light text-dark" style="width: 80rem;">
                    <div class="card-body text-center">
                        <h3 class="text-center">Assignments List</h3>
                        <div class="mb-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Assignment Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Assigned Students</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Query to retrieve assignments
                                        $query = "SELECT * FROM assignments";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Retrieve assigned students for each assignment
                                            $assignment_id = $row['id'];
                                            $assign_query = "SELECT student_username FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
                                            $assign_result = mysqli_query($conn, $assign_query);
                                            $assigned_students = [];
                                            while ($assign_row = mysqli_fetch_assoc($assign_result)) {
                                                $assigned_students[] = $assign_row['student_username'];
                                            }
                                            $assigned_students_str = implode(", ", $assigned_students);

                                            // Display assignment details
                                            echo "<tr>";
                                            echo "<td>{$row['title']}</td>";
                                            echo "<td>{$row['description']}</td>";
                                            echo "<td>{$row['due_date']}</td>";
                                            echo "<td>{$assigned_students_str}</td>";
                                            echo "<td><a href='delete_assignment.php?id={$row['id']}'>Delete</a></td>"; // Provide link to delete assignment
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
