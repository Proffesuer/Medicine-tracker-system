<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session if needed (e.g., for user authentication)
// session_start();

// Check if an ID is provided
if (!isset($_GET['medicine_id']) || !is_numeric($_GET['medicine_id'])) {
    echo "<script>alert('Invalid medicine ID'); window.location.href='list_medicines.php';</script>";
    exit();
}

$medicine_id = intval($_GET['medicine_id']);

// Fetch the current medicine details
$query = "SELECT medicine_id, medicine_name, indications, precautions, storage FROM medicine WHERE medicine_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $medicine_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Medicine not found');</script>";
    exit();
}

$medicine = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated values from the form
    $medicine_name = htmlspecialchars($_POST['medicine_name']);
    $indications = htmlspecialchars($_POST['indications']);
    $precautions = htmlspecialchars($_POST['precautions']);
    $storage = htmlspecialchars($_POST['storage']);

    // Prepare and execute the SQL update statement
    $update_query = "UPDATE medicine SET medicine_name = ?, indications = ?, precautions = ?, storage = ? WHERE medicine_id = ?";
    $update_stmt = $connection->prepare($update_query);
    $update_stmt->bind_param("ssssi", $medicine_name, $indications, $precautions, $storage, $medicine_id);

    if ($update_stmt->execute()) {
        // If successful, redirect to the medicine list with a success message
        echo "<script>alert('Medicine updated successfully'); window.location.href='list_medicines.php';</script>";
    } else {
        // If there's an error, display an error message
        echo "<script>alert('Error: Could not update medicine'); window.history.back();</script>";
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
    <title>Edit Medicine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Medicine</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="medicine_name" class="form-label">Medicine Name:</label>
                <input type="text" class="form-control" medicine_id="medicine_name" name="medicine_name" value="<?php echo htmlspecialchars($medicine['medicine_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="indications" class="form-label">Indications:</label>
                <input type="text" class="form-control" medicine_id="indications" name="indications" value="<?php echo htmlspecialchars($medicine['indications']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="precautions" class="form-label">Precautions:</label>
                <input type="text" class="form-control" medicine_id="precautions" name="precautions" value="<?php echo htmlspecialchars($medicine['precautions']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="storage" class="form-label">Storage:</label>
                <input type="text" class="form-control" medicine_id="storage" name="storage" value="<?php echo htmlspecialchars($medicine['storage']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Medicine</button>
            <a href="list_medicines.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
