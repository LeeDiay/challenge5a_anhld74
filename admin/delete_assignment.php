<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';

    if(isset($_GET['id'])) {
        $assignment_id = $_GET['id'];

        $delete_assignment_query = "DELETE FROM assignments WHERE id = '$assignment_id'";
        mysqli_query($conn, $delete_assignment_query);

        $delete_assigned_query = "DELETE FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
        mysqli_query($conn, $delete_assigned_query);

        header("Location: show_assignment.php");
        exit();
    } else {
        // If assignment ID is not provided, redirect back to show_assignment page
        header("Location: show_assignment.php");
        exit();
    }
?>
