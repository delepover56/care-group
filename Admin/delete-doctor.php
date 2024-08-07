<?php
// Include the configuration file
include_once './Components/config.php';

// Check if the user has the role of a doctor (Role 2)
if ($_SESSION['Role'] == 2) {
    // Redirect doctors to the index page
    header("location:./index.php");
}

// Check if the request method is GET, and if delete action and user ID are set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    // Get the user ID to be deleted from the URL
    $user_id_to_delete = $_GET["id"];

    // Perform the deletion query
    $delete_query = "DELETE FROM user WHERE id = $user_id_to_delete";

    // Check if the deletion query is successful
    if ($conn->query($delete_query) === TRUE) {
        // Redirect after successful deletion
        header("Location: ./doctors.php");
        exit();
    } else {
        // Handle deletion failure
        echo "Error deleting record: " . $conn->error;
    }
}
