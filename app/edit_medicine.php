<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session if needed (e.g., for user authentication)
// session_start();

// Check if an ID is provided and is valid
if (!isset($_GET['medicine_id']) || !is_numeric($_GET['medicine_id'])) {
    echo "<script>alert('Invalid medicine ID'); window.location.href='list_medicines.php';</script>";
    exit();
}

$medicine_id = intval($_GET['medicine_id']);

// Fetch the current medicine details
$query = "SELECT medicine_id, medicine_name, indications, precautions, storage, quantity FROM medicine WHERE medicine_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $medicine_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the medicine exists
if ($result && $result->num_rows > 0) {
    $medicine = $result->fetch_assoc();
} else {
    echo "<script>alert('No medicine found with the provided ID.'); window.location.href='list_medicines.php';</script>";
    exit();
}

// Handle form submission for updating medicine details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicine_name = $_POST['medicine_name'];
    $indications = $_POST['indications'];
    $precautions = $_POST['precautions'];
    $storage = $_POST['storage'];
    $quantity = $_POST['quantity'];

    // Validate form data
    if (empty($medicine_name) || empty($indications) || empty($precautions) || empty($storage)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        // Prepare and execute update query
        $update_query = "UPDATE medicine SET medicine_name = ?, indications = ?, precautions = ?, storage = ?, quantity = ? WHERE medicine_id = ?";
        $update_stmt = $connection->prepare($update_query);
        $update_stmt->bind_param("ssssii", $medicine_name, $indications, $precautions, $storage, $quantity, $medicine_id);

        if ($update_stmt->execute()) {
            echo "<script>alert('Medicine updated successfully.'); window.location.href='list_medicines.php';</script>";
        } else {
            echo "<script>alert('Error updating medicine: " . $connection->error . "');</script>";
        }
    }
}

// Close the database connection
mysqli_close($connection);
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
                <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo htmlspecialchars($medicine['medicine_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="indications" class="form-label">Indications:</label>
                <input type="text" class="form-control" id="indications" name="indications" value="<?php echo htmlspecialchars($medicine['indications']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="precautions" class="form-label">Precautions:</label>
                <input type="text" class="form-control" id="precautions" name="precautions" value="<?php echo htmlspecialchars($medicine['precautions']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="storage" class="form-label">Storage:</label>
                <input type="text" class="form-control" id="storage" name="storage" value="<?php echo htmlspecialchars($medicine['storage']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($medicine['quantity']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Medicine</button>
            <a href="list_medicines.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
