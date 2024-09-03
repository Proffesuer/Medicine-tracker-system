<?php
require_once '../config.php';

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted reminder ID and confirmation status
    $reminder_id = $_POST['reminder_id'];
    $confirmation = $_POST['confirmation'];

    // Update the reminder table with the confirmation status
    $sql = "UPDATE reminder SET confirmation = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $confirmation, $reminder_id);

    if ($stmt->execute()) {
        echo "Confirmation updated successfully.";
    } else {
        echo "Error updating confirmation: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
    // Redirect to the previous page or another page

    exit;
}
?>
