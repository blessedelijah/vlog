<?php
// Include the function.php file for database connection or other utility functions
include "../function.php";  

// Check if the 'id' parameter is set in the GET request
if (isset($_GET['id'])) {
    // Use the global $conn variable for database connection
    global $conn;

    // Get the 'id' value from the GET request
    $deleteId = $_GET['id'];

    // SQL query to delete a record from the 'vlogposts' table where the 'id' matches
    $sql = "DELETE FROM vlogposts WHERE `id` = '$deleteId'";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Set a session variable to indicate successful deletion
        $_SESSION['delete'] = 'Post Deleted Successful';

        // Redirect to the 'listed-property.php' page
        header('Location: listed-property.php');
        exit(); // Ensure no further code is executed after the redirect
    }
}
?>