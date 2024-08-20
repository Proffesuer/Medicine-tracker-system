<?php
require_once '../config.php'; // Include your database connection

// Check if 'id' is present in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Prepare an SQL statement to delete the user
    $stmt = $connection->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No user ID provided.";
}

// Close the database connection
$connection->close();
?>
