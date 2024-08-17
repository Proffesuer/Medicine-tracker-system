<?php
// Start the session
session_start();

// Set the base URL of the project
define('BASE_URL', '/medicine-tracker-system/');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'medical');

// Attempt to connect to the database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Function to redirect to a different page
function redirect($url) {
    header('Location: ' . BASE_URL . $url);
    exit;
}

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to check login and redirect if not logged in
function require_login() {
    if (!is_logged_in()) {
        redirect('login.php');
    }
}

?>
