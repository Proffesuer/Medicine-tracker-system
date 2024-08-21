
<br><br><br>
<?php
require_once '../config.php';
// Start session to get the active user's role
$user_role = $_SESSION['role'];  // The role of the currently logged-in user
?>

<!-- Add New Prescription Button -->
<?php if ( $user_role !== 'patient' && $user_role !== 'Patient' && $user_role !== 'Administrator') : ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
        Add New Prescription
    </button>
<?php endif; ?>
<?php
// Include database configuration file to establish connection


// Fetch all medicines to populate the Medicine dropdown
$sql_medicine = "SELECT medicine_name FROM medicine";
$result_medicine = $connection->query($sql_medicine);

// Fetch all patients to populate the Patient dropdown
$sql_patient = "SELECT username FROM user WHERE role = 'patient'";
$result_patient = $connection->query($sql_patient);

// Start session to get the active user's ID

$user_id = $_SESSION['id'];  // The ID of the currently logged-in user
?>

<div style="margin-top : 10px;">
  <a href="prescription_csv.php" class="btn btn-success mb-3">Download CSV</a>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New Prescription</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="submit_prescription.php" method="POST">
          <div class="mb-3">
            <label for="medicine" class="col-form-label">Medicine:</label>
            <select class="form-control" id="medicine" name="medicine" required>
              <option value="">Select Medicine</option>
              <?php
              if ($result_medicine->num_rows > 0) {
                  while ($row = $result_medicine->fetch_assoc()) {
                      echo '<option value="' . htmlspecialchars($row['medicine_name']) . '">' . htmlspecialchars($row['medicine_name']) . '</option>';
                  }
              } else {
                  echo '<option value="">No medicines available</option>';
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="quantity" class="col-form-label">Quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity" required>
          </div>
          <div class="mb-3">
            <label for="times" class="col-form-label">Times:</label>
            <input type="text" class="form-control" id="times" name="times" required>
          </div>
          <div class="mb-3">
            <label for="days_prescribed" class="col-form-label">Days Prescribed:</label>
            <select class="form-control" id="days_prescribed" name="days_prescribed" required>
              <option value="">Select Days</option>
              <?php for ($i = 1; $i <= 10; $i++) {
                  echo '<option value="' . $i . '">' . $i . '</option>';
              } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="number_refils" class="col-form-label">Number of Refills:</label>
            <input type="text" class="form-control" id="number_refils" name="number_refils" required>
          </div>
          <div class="mb-3">
            <label for="instructions" class="col-form-label">Instructions:</label>
            <textarea class="form-control" id="instructions" name="instructions" required></textarea>
          </div>
          <div class="mb-3">
            <label for="patient" class="col-form-label">Patient:</label>
            <select class="form-control" id="patient" name="patient" required>
              <option value="">Select Patient</option>
              <?php
              if ($result_patient->num_rows > 0) {
                  while ($row = $result_patient->fetch_assoc()) {
                      echo '<option value="' . htmlspecialchars($row['username']) . '">' . htmlspecialchars($row['username']) . '</option>';
                  }
              } else {
                  echo '<option value="">No patients available</option>';
              }
              ?>
            </select>
          </div>
          <!-- Hidden field to store the user ID -->
          <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
          <!-- Hidden field to store the current timestamp -->
          <input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Prescription list starts here-->

<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session to get the active user's ID and role

$user_id = $_SESSION['id'];      // The ID of the currently logged-in user
$user_role = $_SESSION['role'];  // The role of the currently logged-in user
$username = $_SESSION['username']; // The username of the currently logged-in user

// Prepare the SQL query based on user role
if ( $user_role === 'Administrator') {
  // Query for users with Doctor or Administrator roles
  $stmt = $connection->prepare("SELECT `id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `patient`, `date` FROM prescription");
} elseif ($user_role === 'Doctor') {
  // Query for users with Doctor or Administrator roles
  $stmt = $connection->prepare("SELECT `id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `patient`, `date` FROM prescription WHERE user_id = ?");
  $stmt->bind_param("s", $user_id);
} elseif ($user_role === 'patient'|| $user_role === 'Patient') {
    // Query for users with Patient roles
    $stmt = $connection->prepare("SELECT `id`, `medicine`, `quantity`, `times`, `days_prescribed`, `number_refils`, `instructions`, `patient`, `date` FROM prescription WHERE patient = ?");
    $stmt->bind_param("s", $username);
} else {
    // If the user has an invalid role, redirect to an error page or display an error message
    echo "<script>alert('Access Denied: Invalid User Role');</script>";
    echo "<script>window.location.href='error_page.php';</script>";
    exit();
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any prescriptions found
if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr>
            <th>ID</th>
            <th>Medicine</th>
            <th>Quantity</th>
            <th>Times</th>
            <th>Days Prescribed</th>
            <th>Number of Refills</th>
            <th>Instructions</th>
            <th>Patient</th>
            <th>Date</th>
          </tr></thead>";
    echo "<tbody>";

    // Fetch and display each row of the result
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['medicine']) . "</td>
                <td>" . htmlspecialchars($row['quantity']) . "</td>
                <td>" . htmlspecialchars($row['times']) . "</td>
                <td>" . htmlspecialchars($row['days_prescribed']) . "</td>
                <td>" . htmlspecialchars($row['number_refils']) . "</td>
                <td>" . htmlspecialchars($row['instructions']) . "</td>
                <td>" . htmlspecialchars($row['patient']) . "</td>
                <td>" . htmlspecialchars($row['date']) . "</td>
              </tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No prescriptions found.</p>";
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
