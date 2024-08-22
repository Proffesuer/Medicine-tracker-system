<?php 
require_once '../config.php';
$user_role = $_SESSION['role']; // Replace with actual method to get the user role

// Check if the user is neither 'Administrator' nor 'Patient'
$should_display_button = ($user_role !== 'Administrator' && $user_role !== 'patient');
?>
<br><br><br>
<?php if ($should_display_button): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
            Add New Reminder
        </button>
    <?php endif; ?>
<br><?php  date_default_timezone_set('Africa/Nairobi');

// Get the current time and add one hour, formatted as 'H:i' (hours and minutes)
$current_time = date('H:i');
    echo "The Current time is $current_time.";
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
              <!-- Options will be populated by PHP -->
              <?php
              // Fetch prescription IDs from the database
              require_once '../config.php';
              $sql = "SELECT id FROM prescription";
              $result = $connection->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</option>';
                }
              } else {
                echo '<option value="">No Prescriptions Available</option>';
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="phone" class="col-form-label">Phone:</label>
            <input type="tel" class="form-control" id="phone" name="phone" pattern="\+254[0-9]{9,10}" placeholder="+254XXXXXXXXX" required>
          </div>
          <div class="mb-3">
            <label for="mode" class="col-form-label">Mode:</label>
            <select class="form-control" id="mode" name="mode" required>
              <option value="Daily">Daily</option>
              <option value="Weekly">Weekly</option>
              <option value="Monthly">Monthly</option>
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
            <select class="form-control" id="patient" name="patient" required>
              <!-- Options will be populated by PHP -->
              <?php
              $sql = "SELECT DISTINCT patient FROM prescription";
              $result = $connection->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . htmlspecialchars($row['patient']) . '">' . htmlspecialchars($row['patient']) . '</option>';
                }
              } else {
                echo '<option value="">No Patients Available</option>';
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="'time_date_start" class="col-form-label">Time/Date Start:</label>
            <input type="time" class="form-control" id="time_date_start" name="time_date_start"required>
          </div>
          <div class="mb-3">
            <!-- Hidden doctor field -->
            <input type="hidden" class="form-control" id="doctor" name="doctor" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

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
        if ($role === 'Doctor' || $role !=='Administrator') {
        echo '<a href="edit_reminder.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-sm btn-primary">Edit</a>';
        }
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
