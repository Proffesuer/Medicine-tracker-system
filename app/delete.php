<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session to check user role

// Check if user is authenticated and authorized (optional)
if (!isset($_SESSION['role']) || $_SESSION['role'] === 'Patient') {
    echo "<script>alert('Access denied.'); window.location.href='list_medicines.php';</script>";
    exit();
}

// Check if an ID is provided and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $medicine_id = intval($_GET['id']);

    // Prepare the SQL statement to delete the record
    $query = "DELETE FROM medicine WHERE medicine_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $medicine_id);

    if ($stmt->execute()) {
        echo "<script>alert('Medicine deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting medicine.'); </script>";
    }
} else {
    echo "<script>alert('Invalid ID.'); </script>";
}

// Close the database connection
mysqli_close($connection);
?>
