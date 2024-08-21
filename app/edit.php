<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session to check user role


// Check if user is authenticated and authorized (optional)
if (!isset($_SESSION['role']) || $_SESSION['role'] === 'Patient') {
    echo "<script>alert('Access denied.'); window.location.href='list_medicines.php';</script>";
    exit();
}

// Initialize variables for form data
$medicine_id = $medicine_name = $indications = $precautions = $storage = '';

// Fetch medicine details if ID is set
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $medicine_id = intval($_GET['id']);
    
    $query = "SELECT * FROM medicine WHERE medicine_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $medicine_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $medicine_name = htmlspecialchars($row['medicine_name']);
        $indications = htmlspecialchars($row['indications']);
        $precautions = htmlspecialchars($row['precautions']);
        $storage = htmlspecialchars($row['storage']);
    } else {
        echo "<script>alert('Medicine not found.'); window.location.href='list_medicines.php';</script>";
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicine_name = $_POST['medicine_name'];
    $indications = $_POST['indications'];
    $precautions = $_POST['precautions'];
    $storage = $_POST['storage'];

    // Validate form data
    if (empty($medicine_name) || empty($indications) || empty($precautions) || empty($storage)) {
        echo "<script>alert('All fields are required.'); window.location.href='edit.php?id=$medicine_id';</script>";
        exit();
    }

    // Update medicine details
    $update_query = "UPDATE medicine SET medicine_name = ?, indications = ?, precautions = ?, storage = ? WHERE medicine_id = ?";
    $update_stmt = $connection->prepare($update_query);
    $update_stmt->bind_param("ssssi", $medicine_name, $indications, $precautions, $storage, $medicine_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Medicine updated successfully.'); window.location.href='list_medicines.php';</script>";
    } else {
        echo "<script>alert('Error updating medicine.'); window.location.href='edit.php?id=$medicine_id';</script>";
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
        <form method="POST" action="edit.php?id=<?php echo urlencode($medicine_id); ?>">
            <div class="mb-3">
                <label for="medicine_name" class="form-label">Medicine Name:</label>
                <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo htmlspecialchars($medicine_name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="indications" class="form-label">Indications:</label>
                <input type="text" class="form-control" id="indications" name="indications" value="<?php echo htmlspecialchars($indications); ?>" required>
            </div>
            <div class="mb-3">
                <label for="precautions" class="form-label">Precautions:</label>
                <input type="text" class="form-control" id="precautions" name="precautions" value="<?php echo htmlspecialchars($precautions); ?>" required>
            </div>
            <div class="mb-3">
                <label for="storage" class="form-label">Storage:</label>
                <input type="text" class="form-control" id="storage" name="storage" value="<?php echo htmlspecialchars($storage); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Medicine</button>
            <a href="list_medicines.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
