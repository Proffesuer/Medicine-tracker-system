<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Create New User</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="submit_user.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="username" class="col-form-label">Username:</label>
    <input type="text" class="form-control" id="username" name="username" required>
  </div>
  <div class="mb-3">
    <label for="email" class="col-form-label">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="phone" class="col-form-label">Phone:</label>
    <input type="text" class="form-control" id="phone" name="phone" required>
  </div>
  <div class="mb-3">
    <label for="dob" class="col-form-label">DOB:</label>
    <input type="date" class="form-control" id="dob" name="dob" required max="<?php echo date('Y-m-d', strtotime('-10 years')); ?>">
  </div>
  <div class="mb-3">
    <label for="image" class="col-form-label">Image:</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
  </div>
  <div class="mb-3">
    <label for="role" class="col-form-label">Role:</label>
    <select class="form-control" id="role" name="role" required>
      <option value="Administrator">Administrator</option>
      <option value="Doctor">Doctor</option>
      <option value="Patient">Patient</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="password" class="col-form-label">Password:</label>
    <input type="password" class="form-control" id="password" name="password" required
           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!]).{8,}"
           title="Password must be at least 8 characters long and contain at least one number, one uppercase letter, one lowercase letter, and one special character.">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    </div>
  </div>
</div>
<?php
require_once '../config.php'; // Include your database connection

// Fetch all users from the user table
$sql = "SELECT id, username, email, phone, dob, image, role FROM user";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">List of Users</h2>';
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Username</th>';
    echo '<th>Email</th>';
    echo '<th>Phone</th>';
    echo '<th>DOB</th>';
    echo '<th>Image</th>';
    echo '<th>Role</th>';
    echo '<th>Actions</th>'; // New column for actions
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Fetch and display each user record
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
        echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
        echo '<td>';
        if (!empty($row['image'])) {
            echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="User Image" style="width: 100px; height: auto;">';
        } else {
            echo 'No Image';
        }
        echo '</td>';
        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
        echo '<td>';
        // Edit button
        echo '<a href="edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-sm btn-primary">Edit</a> ';
        // Delete button
        echo '<a href="delete_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<div class="container mt-5">';
    echo '<h2 class="mb-4">No Users Found</h2>';
    echo '</div>';
}

// Close the database connection
$connection->close();
?>
