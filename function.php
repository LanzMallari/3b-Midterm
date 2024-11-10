<?php

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


function validateLoginCredentials($email, $password) {
    $users = getUsers();
    foreach ($users as $user) {
        if ($user["email"] == $email && $user["password"] == $password) {
            return true;
        }
    }
    return false; 
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

function check_login() {
    
    // Check if the user is logged in
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: index.php");
        exit;
    }
}

function get_user_email() {
    return isset($_SESSION['email']) ? $_SESSION['email'] : 'Guest';
}
?>
<?php
// Start the session
session_start();
$error = "";


function addSubject($subjectCode, $subjectName) {
    global $error;


    if (empty($subjectCode) || empty($subjectName)) {
        $error = "<b>System Errors</b> <br> <li>Subject Code is required!</li><li> Subject Name is required!</li>";
    } elseif (empty($subjectCode)) {
        $error = "<b>System Errors</b> <br> <li>Subject Code is required!</li>";
    } elseif (empty($subjectName)) {
        $error = "<b>System Errors</b> <br> <li>Subject Name is required!</li>";
    } else {

        $duplicate = false;
        if (!empty($_SESSION['subjects'])) {
            foreach ($_SESSION['subjects'] as $subject) {
                if ($subject['subjectCode'] == $subjectCode || strtolower($subject['subjectName']) == strtolower($subjectName)) {
                    $duplicate = true;
                    break;
                }
            }
        }

        if ($duplicate) {
            $error = "<b>System Errors</b> <br> <li>Duplicate Subject!</li>";
        } else {
    
            if (!isset($_SESSION['subjects'])) {
                $_SESSION['subjects'] = [];
            }
            $_SESSION['subjects'][] = [
                'subjectCode' => $subjectCode,
                'subjectName' => $subjectName
            ];

            
        }
    }
}