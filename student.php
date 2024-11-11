<?php
session_start();

// Function to add a new student
function addStudent($studentId, $firstName, $lastName) {
    // Check if any of the fields are empty
    if (empty($studentId) || empty($firstName) || empty($lastName)) {
        return "All fields are required!";
    }

    // Check if the student ID already exists in the session
    foreach ($_SESSION['students'] as $student) {
        if ($student['studentId'] == $studentId) {
            return "Student ID already exists!";
        }
    }

    // Add new student
    $_SESSION['students'][] = [
        'studentId' => $studentId,
        'firstName' => $firstName,
        'lastName'  => $lastName
    ];

    return "";
}

// Function to delete a student
function deleteStudent($index) {
    if (isset($_SESSION['students'][$index])) {
        unset($_SESSION['students'][$index]);
        $_SESSION['students'] = array_values($_SESSION['students']); // Re-index array
    }
}

// Handle adding a new student
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['deleteStudent'])) {
    $studentId = $_POST["studentId"] ?? '';
    $firstName = $_POST["firstName"] ?? '';
    $lastName = $_POST["lastName"] ?? '';
    $error = addStudent($studentId, $firstName, $lastName);
}

// Handle deleting a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteStudent'])) {
    $index = $_POST['deleteStudent'];
    deleteStudent($index);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .h2 {
            width: 60%;
            margin-left: 380px;
        }

        .breadcrumbs {
            margin: 10px 0;
            width: 60%;
            margin: 0 auto;
        }

        .breadcrumbs ol {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .breadcrumbs a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumbs .breadcrumb-item.active {
            color: #6c757d;
        }

        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            width: 60%;
            margin-left: 380px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 20%;
            padding: 15px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .student-list-container {
            margin-top: 40px;
            margin-left: 380px;
        }

        .student-list table {
            width: 75%;
            border-collapse: collapse;
        }

        .student-list th, .student-list td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .student-list th {
            background-color: #f8f9fa;
        }

        .student-list td {
            background-color: #fdfdfd;
        }

        .student-list tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            padding: 5px 10px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

        .action-buttons .delete {
            background-color: #dc3545;
        }

        .action-buttons .delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h2 class="h2">Register New Student</h2>

<nav aria-label="breadcrumb" class="breadcrumbs">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Register Student</li>
    </ol>
</nav>

<?php if (!empty($error)): ?>
    <div class="error-box"><?php echo $error; ?></div>
<?php endif; ?>

<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label for="studentId">Student ID</label>
            <input type="text" id="studentId" name="studentId" placeholder="Enter Student ID" >
        </div>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" placeholder="Enter First Name" >
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name" >
        </div>
        <button type="submit" class="btn btn-primary">Register Student</button>
    </form>
</div>

<div class="student-list-container container">
    <h3>Student List</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['students'])): ?>
                <?php foreach ($_SESSION['students'] as $index => $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['studentId']); ?></td>
                        <td><?php echo htmlspecialchars($student['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($student['lastName']); ?></td>
                        <td>
                            <a href="editstudent.php?edit=<?php echo $index; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="deleteStudent" value="<?php echo $index; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
