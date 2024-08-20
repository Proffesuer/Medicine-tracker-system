<?php 
require_once '../config.php';

// Get the logged-in user's role, username, and ID from the session
$role = $_SESSION['role'];  
$username = $_SESSION['username']; 
$user_id = $_SESSION['id'];

// Define the SQL query based on the user's role
if ($role === 'Administrator') {
    // Administrator can see all reminders
    $sql = "SELECT * FROM reminder";
} elseif ($role === 'patient') {
    // Patients can only see reminders where the patient field matches their username
    $sql = "SELECT * FROM reminder WHERE patient = ?";
} elseif ($role === 'Doctor') {
    // Doctors can only see reminders where the doctor field matches their ID
    $sql = "SELECT * FROM reminder WHERE doctor = ?";
} else {
    // If the role is unrecognized, deny access
    echo "Access denied.";
    exit;
}

// Prepare and execute the SQL query
$stmt = $connection->prepare($sql);

// Bind the appropriate parameter based on the user's role
if ($role === 'Administrator') {
    // No binding needed for Administrator since they see all reminders
} else {
    // Bind the patient username or doctor ID for patients and doctors, respectively
    if ($role === 'patient') {
      // Bind the patient username as a string
      $stmt->bind_param("s", $username);
  } elseif ($role === 'Doctor') {
      // Bind the doctor ID as an integer
      $stmt->bind_param("i", $user_id);
  }
  
}

$stmt->execute();
$result = $stmt->get_result();

// Check if any reminders were found
if ($result->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">Your Reminders</h2>';
    echo '<ul class="list-group">';

    // Fetch and display reminders
    while ($row = $result->fetch_assoc()) {
        echo '<li class="list-group-item">';
        echo '<h5 class="mb-1">Reminder ID: ' . htmlspecialchars($row['id']) . '</h5>';
        echo '<p class="mb-0">Prescription ID: ' . htmlspecialchars($row['prescription_id']) . '</p>';
        echo '<p class="mb-0">Phone: ' . htmlspecialchars($row['phone']) . '</p>';
        echo '<p class="mb-0">Mode: ' . htmlspecialchars($row['mode']) . '</p>';
        echo '<p class="mb-0">Status: ' . htmlspecialchars($row['status']) . '</p>';
        echo '<p class="mb-0">Patient: ' . htmlspecialchars($row['patient']) . '</p>';
        echo '<p class="mb-0">Time & Date Start: ' . htmlspecialchars($row['time_date_start']) . '</p>';

        // Edit button for all roles
        echo '<a href="edit_reminder.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-sm btn-primary">Edit</a>';

        // Delete button for Doctor and Administrator roles
        if ($role === 'Doctor' || $role === 'Administrator') {
            echo ' <a href="delete_reminder.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this reminder?\')">Delete</a>';
        }

        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">No Reminders Found</h2>';
    echo '</div>';
}
?>
