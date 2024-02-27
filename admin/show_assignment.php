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
                <div class="card bg-light text-dark" style="width: 90rem;">
                    <div class="card-body text-center">
                        <h3 class="text-center">Assignments List</h3>
                        <div class="mb-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Assignment Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Deadline</th>
                                        <!-- <th scope="col">Assigned Students</th> -->
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM assignments";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $assignment_id = $row['id'];
                                            $assign_query = "SELECT student_username FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
                                            $assign_result = mysqli_query($conn, $assign_query);
                                            $assigned_students = [];
                                            while ($assign_row = mysqli_fetch_assoc($assign_result)) {
                                                $assigned_students[] = $assign_row['student_username'];
                                            }
                                            $assigned_students_str = implode(", ", $assigned_students);

                                            echo "<tr>";
                                            // Thêm liên kết cho tiêu đề
                                            echo "<td><a href='assignment_page.php?id={$row['id']}'>{$row['title']}</a></td>";
                                            echo "<td>{$row['description']}</td>";
                                            echo "<td>{$row['due_date']}</td>";
                                            // echo "<td>{$assigned_students_str}</td>";
                                            echo "<td>
                                                    <a href='update_assignment.php?id={$row['id']}' class='btn btn-primary'>Update</a>
                                                    <a href='delete_assignment.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                                                  </td>"; 
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
