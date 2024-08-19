<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session to get the active user's ID

$user_id = $_SESSION['id'];  // The ID of the currently logged-in user

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data
    $medicine = htmlspecialchars($_POST['medicine']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $times = htmlspecialchars($_POST['times']);
    $days_prescribed = htmlspecialchars($_POST['days_prescribed']);
    $number_refils = htmlspecialchars($_POST['number_refils']);
    $instructions = htmlspecialchars($_POST['instructions']);
    $patient = htmlspecialchars($_POST['patient']);  // Add the patient field
    $user_id = htmlspecialchars($_POST['user_id']);
    $date = htmlspecialchars($_POST['date']);

    // Prepare and bind the SQL statement
    $stmt = $connection->prepare("INSERT INTO prescription (medicine, quantity, times, days_prescribed, number_refils, instructions, patient, user_id, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $medicine, $quantity, $times, $days_prescribed, $number_refils, $instructions, $patient, $user_id, $date);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect to a relevant page with a success message
        echo "<script>alert('New Prescription Created Successfully');</script>";
    } else {
        // If there's an error, display an error message
        echo "<script>alert('Error: Could not create prescription');</script>";
        echo "<script>window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // If the form is not submitted via POST, redirect to the dashboard
    echo "<script>window.location.href='admin_dashboard.php';</script>";
}

