<?php
require_once '../config.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password

    // Handle the image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Directory where the image will be stored
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        // Check if the upload directory exists, if not, create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $image = basename($_FILES['image']['name']);
        } else {
            echo "Error uploading file.";
            exit;
        }
    }

    // Check if the username or email already exists
    $stmt = $connection->prepare("SELECT id FROM user WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username or email already exists
        echo "Username or email already exists.";
        $stmt->close();
    } else {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $connection->prepare("INSERT INTO user (username, email, phone, dob, image, role, password) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            // Bind parameters to the SQL query
            $stmt->bind_param("sssssss", $username, $email, $phone, $dob, $image, $role, $password);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New user added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
}
?>
