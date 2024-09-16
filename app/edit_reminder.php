<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session if needed (e.g., for user authentication)
// session_start();

// Check if an ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid reminder ID'); window.location.href='list_reminders.php';</script>";
    exit();
}

$reminder_id = intval($_GET['id']);

// Fetch the current reminder details
$query = "SELECT id, prescription_id, phone, mode, status, patient, time_date_start FROM reminder WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $reminder_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Reminder not found'); window.location.href='list_reminders.php';</script>";
    exit();
}

$reminder = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated values from the form
    $prescription_id = htmlspecialchars($_POST['prescription_id']);
    $phone = htmlspecialchars($_POST['phone']);
    $mode = htmlspecialchars($_POST['mode']);
    $status = htmlspecialchars($_POST['status']);
    $patient = htmlspecialchars($_POST['patient']);
    $time_date_start = htmlspecialchars($_POST['time_date_start']);
    $date = htmlspecialchars($_POST['date']);

    // Prepare and execute the SQL update statement
    $update_query = "UPDATE reminder SET prescription_id = ?, phone = ?, mode = ?, status = ?, patient = ?, date = ?, time_date_start = ? WHERE id = ?";
    $update_stmt = $connection->prepare($update_query);
    $update_stmt->bind_param("sssssssi", $prescription_id, $phone, $mode, $status, $patient, $date, $time_date_start, $reminder_id);

    if ($update_stmt->execute()) {
        // If successful, redirect to the reminder list with a success message
        echo "<script>alert('Reminder updated successfully'); ';</script>";
    } else {
        // If there's an error, display an error message
        echo "<script>alert('Error: Could not update reminder'); window.history.back();</script>";
    }

    // Close the statement
    $update_stmt->close();
}

// Close the connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reminder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Reminder</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="prescription_id" class="form-label">Prescription ID:</label>
                <input type="text" class="form-control" id="prescription_id" name="prescription_id" value="<?php echo htmlspecialchars($reminder['prescription_id']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($reminder['phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="mode" class="form-label">Mode:</label>
                <input type="text" class="form-control" id="mode" name="mode" value="<?php echo htmlspecialchars($reminder['mode']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($reminder['status']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="patient" class="form-label">Patient:</label>
                <input type="text" class="form-control" id="patient" name="patient" value="<?php echo htmlspecialchars($reminder['patient']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="time_date_start" class="form-label">Time and Date Start:</label>
                <input type="text" class="form-control" id="time_date_start" name="time_date_start" value="<?php echo htmlspecialchars($reminder['time_date_start']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Reminder</button>
            <a href="#" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
