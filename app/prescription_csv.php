<?php
require_once '../config.php'; // Include your database connection

// Initialize variables for SQL query and parameters
$sql = '';
$params = [];

// Check if the user role is Patient
if (isset($_SESSION['role']) && ($_SESSION['role'] == 'Patient' || $_SESSION['role'] == 'patient')) {
    // Use the username from the session
    $username = $_SESSION['username'];

    // Prepare the SQL query with a placeholder
    $sql = "SELECT `id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `date` FROM prescription WHERE `patient` = ?";
    $params = [$username];

// Check if the user role is Doctor
} else if (isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor') {
    // Use Doctor ID from the session
    $doctorId = $_SESSION['id'];
    // Prepare the SQL query with a placeholder
    $sql = "SELECT `id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `patient`, `date` FROM prescription WHERE `user_id` = ?";
    $params = [$doctorId];

// If neither Patient nor Doctor, fetch all prescriptions
} else {
    // Prepare the SQL query to fetch all prescriptions
    $sql = "SELECT `id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `patient`, `date` FROM prescription";
}

if ($stmt = $connection->prepare($sql)) {
    if (!empty($params)) {
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set headers to initiate download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=medicine.csv');

        $output = fopen('php://output', 'w');
        
        if (isset($_SESSION['role']) && ($_SESSION['role'] == 'Patient' || $_SESSION['role'] == 'patient')) {
            fputcsv($output, array('ID', 'Medicine', 'Quantity', 'Time', 'Days Prescribed', 'Number Of Refils', 'Instructions', 'Date'));
        } else {
            fputcsv($output, array('ID', 'Medicine', 'Quantity', 'Time', 'Days Prescribed', 'Number Of Refils', 'Instructions', 'Patient', 'Date'));
        }

        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        fclose($output);
    } else {
        echo "No data available to download.";
    }

    $stmt->close();
} else {
    echo "Error preparing the SQL statement: " . $connection->error;
}

// Close the database connection
$connection->close();
exit(); // Stop further execution after generating the CSV
?>
