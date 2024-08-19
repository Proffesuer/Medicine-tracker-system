<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session


// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize and get the reminder ID
    $id = htmlspecialchars($_GET['id']);

    // Prepare and bind the SQL statement
    $stmt = $connection->prepare("DELETE FROM reminder WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the list reminder page after successful deletion
    echo "Record Deleted successfuly";
        exit();
    } else {
        // Handle errors
        echo "<p>Error deleting reminder: " . htmlspecialchars($stmt->error) . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // If no ID is provided, redirect to the list reminder page
    header("Location: list_reminders.php");
    exit();
}
?>
