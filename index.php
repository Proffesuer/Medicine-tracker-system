<?php
require_once 'config.php';

// Get the requested page from the URL, default to 'home'
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Function to handle page inclusion
function loadPage($page) {
    $pageFile = $page . '.php';
    
    // Check if the requested file exists
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        include '404.php'; // Include a 404 error page if the file does not exist
    }
}

// Define routes
switch ($page) {
    case 'home':
        loadPage('home');
        break;
    case 'login':
        loadPage('login');
        break;
    case 'register':
        loadPage('register');
        break;
    case 'logout':
        loadPage('logout');
        break;
    case 'intake_form':
        require_login(); // Ensure the user is logged in
        loadPage('intake_form');
        break;
    case 'records':
        require_login(); // Ensure the user is logged in
        loadPage('records');
        break;
    case 'profile':
        require_login(); // Ensure the user is logged in
        loadPage('profile');
        break;
    case 'doctor_dashboard':
        require_login(); // Ensure the user is logged in
        if ($_SESSION['role'] === 'doctor') {
            loadPage('doctor_dashboard');
        } else {
            redirect('index.php?page=home');
        }
        break;
    case 'admin_dashboard':
        require_login(); // Ensure the user is logged in
        if ($_SESSION['role'] === 'administrator') {
            loadPage('admin_dashboard');
        } else {
            redirect('index.php?page=home');
        }
        break;
    case 'patient_dashboard':
        require_login(); // Ensure the user is logged in
        if ($_SESSION['role'] === 'patient') {
            loadPage('patient_dashboard');
        } else {
            redirect('index.php?page=home');
        }
        break;
    default:
        loadPage('404'); // Default to a 404 page if no valid page is requested
        break;
}
?>
