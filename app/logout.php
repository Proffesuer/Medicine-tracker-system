<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page with a logout success message
header('Location: ../index.php?page=login&success=loggedout');
exit();
