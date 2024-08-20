<br><br><br>
<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session if needed (e.g., for user authentication)
// session_start();

// Fetch medicines from the 'medicine' table
$query = "SELECT medicine_id, medicine_name, indications, precautions, storage FROM medicine";
$result = $connection->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            margin-right: 5px;
        }
    </style>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Medicine</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Medicine</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="submit_medicine.php" method="POST">
          <div class="mb-3">
            <label for="medicine_name" class="col-form-label">Medicine Name:</label>
            <input type="text" class="form-control" id="medicine_name" name="medicine_name" required>
          </div>
          <div class="mb-3">
            <label for="indications" class="col-form-label">Indication Name:</label>
            <input type="text" class="form-control" id="indications" name="indications" required>
          </div>
          <div class="mb-3">
            <label for="precausions" class="col-form-label">Precautions:</label>
            <input type="text" class="form-control" id="precausions" name="precausions" required>
          </div>
          <div class="mb-3">
            <label for="storage" class="col-form-label">Storage:</label>
            <input type="text" class="form-control" id="storage" name="storage" required>
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
<!--Medicine list starts her-->
<div class="container mt-4">
        <h2>Medicine List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Medicine Name</th>
                    <th>Indications</th>
                    <th>Precautions</th>
                    <th>Storage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['medicine_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['medicine_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['indications']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['precautions']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['storage']) . '</td>';
                        echo '<td>';
                        echo '<a href="edit_medicine.php?id=' . htmlspecialchars($row['medicine_id']) . '" class="btn btn-warning btn-sm">Edit</a>';
                        echo '<a href="delete_medicine.php?id=' . htmlspecialchars($row['medicine_id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this medicine?\');">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No medicines found.</td></tr>';
                } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<?php
// Close the connection
$connection->close();
?>