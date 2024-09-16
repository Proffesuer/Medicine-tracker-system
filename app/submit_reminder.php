<?php
// Assuming you have a connection to your database
require_once '../config.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $prescription_id = $_POST['prescription_id'];
    $phone = $_POST['phone'];
    $mode = $_POST['mode'];
    $status = $_POST['status'];
    $patient = $_POST['patient'];
    $date = $_POST['date'];
    $time_date_start = $_POST['time_date_start'];
    $doctor = $_POST['doctor'];

    // Prepare an SQL statement to insert the data into the reminders table
    $sql = "INSERT INTO reminder (prescription_id, phone, mode, status, patient, date, time_date_start, doctor) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $connection->prepare($sql)) {
        // Bind the parameters to the SQL query
        $stmt->bind_param("issssssi", $prescription_id, $phone, $mode, $status, $patient, $date, $time_date_start, $doctor);

        // Execute the statement
        if ($stmt->execute()) {
            // If successful, redirect to a confirmation page or back to the form
            echo "<script>alert('New Reminder Created Successfully');</script>";
            // Redirect or reload the page after the alert
           
            echo "<script>alert('New Reminder Created Successfully');</script>";

            exit();
        } else {
            echo "Error: Could not execute the query: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the query: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    // If the form was not submitted via POST, redirect back to the form
    header("Location: form_page.php");
    exit();
}

