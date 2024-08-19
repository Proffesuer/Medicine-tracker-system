
<br><br><br>
<?php
require_once '../config.php';
// Assuming the user's role is stored in the session
$role = $_SESSION['role'];

// Only display the "Add New Reminder" button if the user is not a patient
if ($role !== 'patient') {
    echo '
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Reminder</button>';
}
?>

<?php
// Assuming you have a connection to your database


// Fetch all prescriptions to populate the Prescription ID dropdown
$sql_prescriptions = "SELECT id, patient FROM prescription";
$result_prescriptions = $connection->query($sql_prescriptions);
$sql_prescriptions = "SELECT id FROM prescription";
$result_prescriptions = $connection->query($sql_prescriptions);

// Start the session to get the active user's ID
$user_id = $_SESSION['id'];  // The ID of the currently logged-in user
?>
<?php
// Assuming you have a connection to your database


// Fetch all prescriptions to populate the Prescription ID dropdown
$sql_prescriptions = "SELECT id FROM prescription";
$result_prescriptions = $connection->query($sql_prescriptions);


$user_id = $_SESSION['id'];  // The ID of the currently logged-in user
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Reminder</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="submit_reminder.php" method="POST">
          <div class="mb-3">
            <label for="prescription_id" class="col-form-label">Prescription ID:</label>
            <select class="form-control" id="prescription_id" name="prescription_id" required>
              <option value="">Select Prescription ID</option>
              <?php
              if ($result_prescriptions->num_rows > 0) {
                  while ($row = $result_prescriptions->fetch_assoc()) {
                      echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</option>';
                  }
              } else {
                  echo '<option value="">No prescriptions available</option>';
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="phone" class="col-form-label">Phone Number:</label>
            <input type="number" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="mode" class="col-form-label">Mode:</label>
            <select class="form-control" id="mode" name="mode" required>
              <option value="Daily">Daily</option>
              <option value="Weekly">Weekly</option>
              <option value="Monthly">Monthly</option>
              <option value="Once">Once</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="status" class="col-form-label">Status:</label>
            <select class="form-control" id="status" name="status" required>
              <option value="Subscribe">Subscribe</option>
              <option value="Unsubscribe">Unsubscribe</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="patient" class="col-form-label">Patient:</label>
            <input type="text" class="form-control" id="patient" name="patient" readonly required>
          </div>
          <div class="mb-3">
            <label for="time_date_start" class="col-form-label">Time/Date Start:</label>
            <input type="time" class="form-control" id="time_date_start" name="time_date_start" required>
          </div>
          <!-- Hidden field to store the user ID -->
          <input type="hidden" id="doctor" name="doctor" value="<?php echo htmlspecialchars($user_id); ?>">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// JavaScript to handle the change event on prescription_id
document.getElementById('prescription_id').addEventListener('change', function() {
    var prescriptionId = this.value;

    if (prescriptionId) {
        // Make an AJAX call to fetch the corresponding patient
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_patient.php?prescription_id=' + prescriptionId, true);
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById('patient').value = this.responseText;
            }
        };
        xhr.send();
    } else {
        // Clear the patient field if no prescription is selected
        document.getElementById('patient').value = '';
    }
});
</script>



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

<?php


if (isset($_GET['prescription_id'])) {
    $prescription_id = intval($_GET['prescription_id']);

    // Fetch the patient associated with the selected prescription ID
    $sql = "SELECT patient FROM prescription WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $prescription_id);
    $stmt->execute();
    $stmt->bind_result($patient);
    $stmt->fetch();

    echo htmlspecialchars($patient);

    $stmt->close();
}

$connection->close();
?>
