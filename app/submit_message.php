<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session to access the active user's data


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data
    $user_id = htmlspecialchars($_POST['user_id']);
    $recipient = htmlspecialchars($_POST['user_id']);
    $message = htmlspecialchars($_POST['message-text']);

    // Prepare and bind the SQL statement
    $stmt = $connection->prepare("INSERT INTO reviews (user_id, recipient, message, date) VALUES (?, ?, ?, ?)");
    $current_timestamp = date('Y-m-d H:i:s');
    $stmt->bind_param("ssss", $user_id, $recipient, $message, $current_timestamp);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect to a relevant page with a success message
        echo "<script>alert('Message sent successfully');</script>";
         // Replace 'your_dashboard.php' with the appropriate file
    } else {
        // If there's an error, display an error message
        echo "<script>alert('Error: Could not send message');</script>";
        echo "<script>window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // If the form is not submitted via POST, redirect to the dashboard
    echo "<script>window.location.href='your_dashboard.php';</script>";  // Replace 'your_dashboard.php' with the appropriate file
}
?>
