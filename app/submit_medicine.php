<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session if needed (e.g., for user authentication)
// session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data
    $medicine_name = htmlspecialchars($_POST['medicine_name']);
    $indications = htmlspecialchars($_POST['indications']);
    $precautions = htmlspecialchars($_POST['precautions']);
    $storage = htmlspecialchars($_POST['storage']);
    $quantity = htmlspecialchars($_POST['quantity']);

    // Prepare and bind the SQL statement
    $stmt = $connection->prepare("INSERT INTO medicine (medicine_name, indications, precautions, storage, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $medicine_name, $indications, $precautions, $storage, $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect to a relevant page with a success message
        echo "<script>alert('New Medicine Added Successfully'); </script>";
    } else {
        // If there's an error, display an error message
        echo "<script>alert('Error: Could not add medicine'); window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // If the form is not submitted via POST, redirect to a relevant page
    echo "<script>window.location.href='your_redirect_page.php';</script>";
}

