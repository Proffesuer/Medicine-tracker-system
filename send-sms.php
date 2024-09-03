<?php
// Refresh the page every 59 seconds
header("Refresh: 59");

// Database connection details
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'medical');

// Include the Africa's Talking SDK
require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
$username   = 'medical';  // Replace with your actual username
$apiKey     = 'atsk_b166cab0c02e553db257942237abc077c455d17a31eaf45e573e462a9a472cca3752339d';  // Replace with your actual API key

// Initialize the SDK
$AT = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms = $AT->sms();

// Establish a connection to the database
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Set the timezone to East Africa Time (EAT)
date_default_timezone_set('Africa/Nairobi');

// Get the current time formatted as 'H:i' (hours and minutes)
$current_time = date('H:i');

// Query to find reminders with the current time, joining with the prescription table
$query = "
    SELECT 
        r.id, 
        r.phone, 
        r.patient, 
        p.medicine, 
        p.quantity, 
        p.times, 
        p.instructions 
    FROM 
        reminder r 
    JOIN 
        prescription p 
    ON 
        r.prescription_id = p.id 
    WHERE 
        r.time_date_start = '$current_time'";

$result = mysqli_query($con, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reminder_id = $row['id'];
            $phone = $row['phone'];
            $patient_name = $row['patient'];
            $medicine = $row['medicine'];
            $quantity = $row['quantity'];
            $times = $row['times'];
            $instructions = $row['instructions'];

            // Set the message content
            $message = "Jambo $patient_name, it's time to take your medicine $medicine. Kindly take $quantity tablets or spoons $times times a day. Don't forget to follow the doctor's instructions: $instructions. Regards, MTS.";

            // Send the SMS
            try {
                $sms->send([
                    'to'      => $phone,
                    'message' => $message,
                    'from'    => '' // Optional: Set a sender ID if you have one
                ]);
                echo "Message sent to $patient_name at $phone\n";

                // Update the 'sent' field in the reminder table for the specific reminder ID
                $update_query = "UPDATE reminder SET sent = 'sent' WHERE id = ?";
                $stmt = $con->prepare($update_query);
                $stmt->bind_param("i", $reminder_id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo "Reminder status updated to 'sent' for reminder ID $reminder_id.\n";
                } else {
                    echo "Failed to update reminder status for reminder ID $reminder_id.\n";
                }

                $stmt->close();
            } catch (Exception $e) {
                echo "Error sending message: " . $e->getMessage();
            }
        }
    } else {
        echo "No reminders found for the current time.\n";
    }
} else {
    echo "Database query error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
