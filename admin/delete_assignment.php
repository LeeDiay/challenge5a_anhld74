<?php
    session_start();
    @include '../inc/config.php';
    @include './check_admin.php';
    @include '../logout.php';

    // Check if assignment ID is provided
    if(isset($_GET['id'])) {
        $assignment_id = $_GET['id'];

        // Delete assignment from database
        $delete_assignment_query = "DELETE FROM assignments WHERE id = '$assignment_id'";
        mysqli_query($conn, $delete_assignment_query);

        // Delete assigned assignments from database
        $delete_assigned_query = "DELETE FROM assigned_assignments WHERE assignment_id = '$assignment_id'";
        mysqli_query($conn, $delete_assigned_query);

        // Redirect back to show_assignments page
        header("Location: show_assignment.php");
        exit();
    } else {
        // If assignment ID is not provided, redirect back to show_assignments page
        header("Location: show_assignment.php");
        exit();
    }
?>
