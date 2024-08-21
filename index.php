<?php
// Start the session to manage user sessions
// session_start();

// Define the base URL for the project
// define('BASE_URL', 'http://localhost/your-project-directory/');

// Include the configuration file
require_once 'config.php';

// Include the home.php file by default or another file based on the 'page' parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

function loadPage($page) {
    // Sanitize the page name to prevent directory traversal attacks
    $page = basename($page);
    $pageFile = $page . '.php';
    
    // Check if the file exists, if not, load a 404 error page
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        include '404.php';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Intake Tracker</title>
    <!-- Use BASE_URL for linking CSS and other resources -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>
<body>

    <?php
    // Load the requested page, or the home page if none is specified
    loadPage($page);
    ?>

</body>
</html>
