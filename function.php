<?php
//LOGIN FUNCTION
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
        ["email" => "example3@gmail.com", "password" => "example13"],
        ["email" => "example3@gmail.com", "password" => "example14"]
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


function checkLoginCredentials($email, $password) {
    return validateLoginCredentials($email, $password);
}


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
// SUBJECT FUNCTION
session_start();
$error = "";


function addSubject($subjectCode, $subjectName) {
    if (empty($subjectCode) || empty($subjectName)) {
        return "<b>System Errors</b> <br> <li>Subject Code is required!</li><li>Subject Name is required!</li>";
    }

    if (!empty($_SESSION['subjects'])) {
        foreach ($_SESSION['subjects'] as $subject) {
            if ($subject['subjectCode'] == $subjectCode || strtolower($subject['subjectName']) == strtolower($subjectName)) {
                return "<b>System Errors</b> <br> <li>Duplicate Subject!</li>";
            }
        }
    }

    $_SESSION['subjects'][] = [
        'subjectCode' => $subjectCode,
        'subjectName' => $subjectName
    ];
    return "Subject added successfully!";
   
}

function updateSubject($editIndex, $subjectCode, $subjectName) {


    
    if (isset($_SESSION['subjects'][$editIndex])) {
        $_SESSION['subjects'][$editIndex] = [
            'subjectCode' => $subjectCode,
            'subjectName' => $subjectName
        ];
      
        

        header("Location: subject.php");
        exit();
    }
}
function getSubjectForEdit($editIndex) {
    if (isset($_SESSION['subjects'][$editIndex])) {
        return $_SESSION['subjects'][$editIndex];
    }
    return null;
}
function deleteSubject($index) {
    if (isset($_SESSION['subjects'][$index])) {
        unset($_SESSION['subjects'][$index]);
        $_SESSION['subjects'] = array_values($_SESSION['subjects']); // Re-index the array
        return "Subject deleted successfully!";
    } else {
        return "Error: Subject not found!";
    }
}
function getSubject($index) {
    return $_SESSION['subjects'][$index] ?? null;
}

function deleteSubjectByIndex($index) {
    if (isset($_SESSION['subjects'][$index])) {
        unset($_SESSION['subjects'][$index]);
        $_SESSION['subjects'] = array_values($_SESSION['subjects']); 
       
    }
  
}
// Function to add a new student
function validateStudentData($student_data) {
    if (empty($student_data['studentId']) || empty($student_data['firstName']) || empty($student_data['lastName'])) {
        return "All fields are required.";
    }
    return true;
}

// Helper function to check for duplicate student ID
function checkDuplicateStudentData($student_data) {
    if (isset($_SESSION['students'])) {
        foreach ($_SESSION['students'] as $student) {
            if ($student['studentId'] === $student_data['studentId']) {
                return "Student with this ID already exists.";
            }
        }
    }
    return true;
}
function addStudent($studentId, $firstName, $lastName) {
    $student_data = [
        'studentId' => $studentId,
        'firstName' => $firstName,
        'lastName' => $lastName,
    ];

    // Validate student data
    $validation_result = validateStudentData($student_data);
    if ($validation_result !== true) {
        return $validation_result;
    }

    // Check for duplicate student data
    $duplicate_check = checkDuplicateStudentData($student_data);
    if ($duplicate_check !== true) {
        return $duplicate_check;
    }

    // Add the student to session if validation passes
    $_SESSION['students'][] = $student_data;
    return "";
}

// Function to delete a student by index
function deleteStudent($index) {
    if (isset($_SESSION['students'][$index])) {
        unset($_SESSION['students'][$index]);
        $_SESSION['students'] = array_values($_SESSION['students']); // Reindex array
    }
}

?>
<?php

?>