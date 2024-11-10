<?php
// Start the session if it's not already started
function startSessionIfNotStarted() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Define the users' credentials in an array
function getUsers() {
    return [
        ["email" => "example@gmail.com", "password" => "example"],
        ["email" => "example1@gmail.com", "password" => "example1"],
        ["email" => "example2@gmail.com", "password" => "example2"],
        ["email" => "example3@gmail.com", "password" => "example13"]
    ];
}

// Validate login credentials
function validateLoginCredentials($email, $password) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user["email"] == $email && $user["password"] == $password) {
            return true; // Credentials are valid
        }
    }
    return false; // Invalid credentials
}

// Check if the login credentials match any of the users
function checkLoginCredentials($email, $password) {
    return validateLoginCredentials($email, $password);
}

// Check if the user session is active (already logged in)
function checkUserSessionIsActive() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>


<?php
// Start session and check if the user is logged in
function check_login() {
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: index.php"); // Redirect to login page if not logged in
        exit;
    }
}

// Retrieve the user email from the session
function get_user_email() {
    return isset($_SESSION['email']) ? $_SESSION['email'] : 'Guest';
}
?>
