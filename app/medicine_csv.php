<?php
require_once '../config.php'; // Include your database connection

// Fetch all medicine from the user table
$sql = "SELECT medicine_id, medicine_name, indications, precautions, storage FROM medicine";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Set headers to initiate download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=medicine.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Name', 'Indications', 'Precautions', 'Storage'));

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
