<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session if needed (e.g., for user authentication)
// session_start();

// Check if an ID is provided
if (isset($_GET['medicine_id'])) {
    $medicine_id = intval($_GET['medicine_id']);

    // Prepare and execute the SQL delete statement
    $stmt = $connection->prepare("DELETE FROM medicine WHERE medicine_id = ?");
    $stmt->bind_param("i", $medicine_id);

    if ($stmt->execute()) {
        // If successful, redirect to the medicine list with a success message
        echo "<script>alert('Medicine deleted successfully');</script>";
    } else {
        // If there's an error, display an error message
        echo "<script>alert('Error: Could not delete medicine'); window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // If no ID is provided, redirect to the list page
    echo "<script>window.location.href='error_delete.php';</script>";
}
