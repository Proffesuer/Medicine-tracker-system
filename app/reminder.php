
<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Reminder</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Reminder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="prescription_id" class="col-form-label">Prescription ID:</label>
            <input type="text" class="form-control" id="prescription_id">
          </div>
          <div class="mb-3">
            <label for="phone" class="col-form-label">Phone Number:</label>
            <input type="number" class="form-control" id="phone">
          </div>
          <div class="mb-3">
            <label for="mode" class="col-form-label">Mode:</label>
            <input type="text" class="form-control" id="mode">
          </div>
          <div class="mb-3">
            <label for="status" class="col-form-label">Status:</label>
            <input type="text" class="form-control" id="status">
          </div>
          <div class="mb-3">
            <label for="patient" class="col-form-label">Patient:</label>
            <input type="text" class="form-control" id="patient">
          </div>
          <div class="mb-3">
            <label for="time_date_start" class="col-form-label">Time/Date Start:</label>
            <input type="text" class="form-control" id="time_date_start">
          </div>
          <div class="mb-3">
            <label for="user_id" class="col-form-label">use id:</label>
            <input type="text" class="form-control" id="user_id">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
<?php 
require_once '../config.php';
// Get the logged-in user's role and username from the session
$role = $_SESSION['role'];  // This should be set during login
$username = $_SESSION['username']; // Username or user ID of the logged-in user
$user_id = $_SESSION['id'];
// Query to get reminders based on role
$sql = "";
if ($role === 'Administrator') {
    // Administrator can see all reminders
    $sql = "SELECT * FROM reminder";
} elseif ($role === 'patient') {
    // Patients can only see reminders where the patient field matches their username
    $sql = "SELECT * FROM reminder WHERE patient =?";

} elseif ($role === 'Doctor') {
    // Doctors can only see reminders where the user_id matches their username or ID
    $sql = "SELECT * FROM reminder WHERE doctor =?";

} else {
    // If the role is unrecognized, deny access
    echo "Access denied.";
    exit;
}

// Prepare and execute the SQL query
$stmt = $connection->prepare($sql);

if ($role !== 'Administrator') {
    $stmt->bind_param("s", $username);
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
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
} else {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">No Reminders Found</h2>';
    echo '</div>';
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>