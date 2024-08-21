<?php
require_once '../config.php'; // Include your database connection

// Check if 'id' is present in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Fetch the user's current details
    $stmt = $connection->prepare("SELECT id, username, email, phone, dob, image, role FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }

    $stmt->close();
} else {
    echo "No user ID provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $role = $_POST['role'];
    
    // Handle the image upload if a new image is provided
    $image = $user['image']; // Retain old image if no new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $image = basename($_FILES['image']['name']);
        } else {
            echo "Error uploading file.";
            exit;
        }
    }

    // Update user details in the database
    $stmt = $connection->prepare("UPDATE user SET username = ?, email = ?, phone = ?, dob = ?, image = ?, role = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $username, $email, $phone, $dob, $image, $role, $userId);

    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit User</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="dob">DOB:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <?php
            if (!empty($user['image'])) {
                echo '<img src="uploads/' . htmlspecialchars($user['image']) . '" alt="Current Image" style="width: 100px; height: auto;">';
            }
            ?>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role" required>
                <option value="Administrator" <?php echo ($user['role'] === 'Administrator') ? 'selected' : ''; ?>>Administrator</option>
                <option value="Doctor" <?php echo ($user['role'] === 'Doctor') ? 'selected' : ''; ?>>Doctor</option>
                <option value="patient" <?php echo ($user['role'] === 'patient') ? 'selected' : ''; ?>>patient</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="user_list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
