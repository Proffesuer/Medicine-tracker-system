<?php
require_once '../config.php';
// Check if an ID is provided
// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if an ID is provided
if (isset($_GET['id'])) {
    $medicine_id = mysqli_real_escape_string($connection, $_GET['id']);
    
    // Prepare and execute the DELETE statement
    $query = "DELETE FROM medicine WHERE medicine_id = '$medicine_id'";
    if (mysqli_query($connection, $query)) {
        echo "Medicine with ID $medicine_id has been deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    echo "No medicine ID provided.";
}

// Close the database connection
mysqli_close($connection);