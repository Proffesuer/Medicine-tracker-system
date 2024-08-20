<?php
header("Refresh:20");
// Database connection details
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'medical');

// Establish a connection to the database
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Include the Africa's Talking SDK
require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
$username   = 'medical';  // Replace with your actual username
$apiKey     = 'atsk_b166cab0c02e553db257942237abc077c455d17a31eaf45e573e462a9a472cca3752339d';  // Replace with your actual API key

// Initialize the SDK
$AT         = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms        = $AT->sms();

// Endless loop to keep checking for reminders
while (true) {
    // Query to select reminders that need to be sent (where time_remind equals the current time)
    $query = mysqli_query($con, "SELECT * FROM reminder WHERE time_date_start = CURTIME()");

    // Check if there are any reminders to send
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            // Get the recipient's phone number
            $recipients = $row['phone'];

            // Set your message
            $message = "Medical app is coming hureeee with chisira";

            // Set your shortCode or senderId
            $from = ""; // Optional: Set a sender ID if you have one

            try {
                // Send the message
                $result = $sms->send([
                    'to'      => $recipients,
                    'message' => $message,
                    'from'    => $from
                ]);

                print_r($result);

                // Mark the reminder as sent
                $updateQuery = "UPDATE reminder SET sent = 1 WHERE id = " . $row['id'];
                mysqli_query($con, $updateQuery);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo "No reminders to send at " . date('Y-m-d H:i:s') . "\n";
    }

    // Wait for 60 seconds before checking again to avoid too frequent queries
    sleep(60);
}

// Close the database connection
