<?php
require_once '../config.php';

// Fetch all reminders from the reminder table
$sql = "SELECT * FROM reminder";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">All Reminders</h2>';
    echo '<ul class="list-group">';

    // Fetch and display each reminder
    while ($row = $result->fetch_assoc()) {
        // Get the doctor ID from the reminder row
        $doctor_id = $row['doctor'];

        // Fetch the doctor's username from the user table
        $sql_user = "SELECT username FROM user WHERE id = ?";
        $stmt_user = $connection->prepare($sql_user);
        $stmt_user->bind_param("i", $doctor_id);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $doctor_username = ($result_user->num_rows > 0) ? $result_user->fetch_assoc()['username'] : 'Unknown Doctor';

        // Determine the color of the line based on 'sent' and 'confirmation' values
        $line_color = '';
        if ($row['sent'] === 'sent' && $row['confirmation'] === 'Confirmed') {
            $line_color = 'style="background-color: green; color: white;"';
        } elseif ($row['sent'] === 'sent') {
            $line_color = 'style="background-color: orange; color: black;"';
        } elseif (empty($row['sent']) && empty($row['confirmation'])) {
            $line_color = 'style="background-color: red; color: black;"';
        }

        // Display the reminder with appropriate colors and information
        echo '<li class="list-group-item" ' . $line_color . '>';
        echo '<p class="mb-0">Phone: ' . htmlspecialchars($row['phone']) . '</p>';
        echo '<p class="mb-0">Mode: ' . htmlspecialchars($row['mode']) . '</p>';
        echo '<p class="mb-0">Status: ' . htmlspecialchars($row['status']) . '</p>';
        echo '<p class="mb-0">Patient: ' . htmlspecialchars($row['patient']) . '</p>';
        echo '<p class="mb-0">Time & Date Start: ' . htmlspecialchars($row['time_date_start']) . '</p>';
        echo '<p class="mb-0">Doctor: ' . htmlspecialchars($doctor_username) . '</p>';
        echo '<p class="mb-0">Sent: ' . htmlspecialchars($row['sent']) . '</p>';
        echo '<p class="mb-0">Confirmation: ' . htmlspecialchars($row['confirmation']) . '</p>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">No Reminders Found</h2>';
    echo '</div>';
}

$connection->close();
?>
