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
    $quantity_given = htmlspecialchars($_POST['quantity_given']);
    $times = htmlspecialchars($_POST['times']);
    $days_prescribed = htmlspecialchars($_POST['days_prescribed']);
    $number_refils = htmlspecialchars($_POST['number_refils']);
    $instructions = htmlspecialchars($_POST['instructions']);
    $patient = htmlspecialchars($_POST['patient']);  // Add the patient field
    $user_id = htmlspecialchars($_POST['user_id']);
    $date = htmlspecialchars($_POST['date']);

    $sql_medicine = "SELECT medicine_name, quantity FROM medicine WHERE medicine_id =" . $medicine;
    $result = $connection->query($sql_medicine);
    if ($result->num_rows > 0) {
        // Get the row containing the quantity
        $row = $result->fetch_assoc();
        $current_quantity = $row['quantity'];
        $medicine_name = $row['medicine_name'];
    
        if (($current_quantity <= 0) || ($current_quantity < $quantity_given)) {
            echo "<script>alert('Not enough medicine for this prescription. Remaining: $current_quantity');</script>";
        } else {
            $quantityM = $current_quantity - $quantity_given;
            $medicine_name = $row['medicine_name'];

            $stmtQ = $connection->prepare("UPDATE medicine SET quantity = ? WHERE medicine_id = ?");
            $stmtQ->bind_param("ii", $quantityM, $medicine);
            $stmtQ->execute();
            // Prepare and bind the SQL statement
            $stmt = $connection->prepare("INSERT INTO prescription (medicine, quantity, quantity_given, times, days_prescribed, number_refils, instructions, patient, user_id, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisssssss", $medicine_name, $quantity, $quantity_given, $times, $days_prescribed, $number_refils, $instructions, $patient, $user_id, $date);
        
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
        }
    }
} else {
    // If the form is not submitted via POST, redirect to the dashboard
    echo "<script>window.location.href='admin_dashboard.php';</script>";
}

