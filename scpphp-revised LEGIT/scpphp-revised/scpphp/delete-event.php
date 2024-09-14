<?php
session_start();
include("server.php");
if(isset($_SESSION['confirm_delete_event']) && $_SESSION['confirm_delete_event'] === true) {
    $eveid = $_SESSION['uid_to_delete']; // Retrieve the room ID from the session
    unset($_SESSION['confirm_delete_event']); // Unset the session variable
    unset($_SESSION['uid_to_delete']); // Unset the room ID session variable

    $sqldelete = "DELETE FROM event_tbl WHERE id = '$eveid'";
    if (mysqli_query($conn, $sqldelete)){
        echo '<script>alert("event deleted successfully!");</script>';
    } else {
        echo '<script>alert("Error deleting event!");</script>';
    }
    echo '<script>window.location.href = "admin-delete.php";</script>'; // Close the window after deletion
} else {
    echo '<script>alert("Confirmation not received.");</script>'; // Handle case where confirmation wasn't received
}
?>