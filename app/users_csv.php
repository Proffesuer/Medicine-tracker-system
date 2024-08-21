<?php
require_once '../config.php'; // Include your database connection

// Fetch all users from the user table
$sql = "SELECT id, username, email, phone, dob, image, role FROM user";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Set headers to initiate download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=users.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Username', 'Email', 'Phone', 'DOB', 'Image', 'Role'));

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
} else {
    echo "No data available to download.";
}

// Close the database connection
$connection->close();
exit(); // Stop further execution after generating the CSV
?>
