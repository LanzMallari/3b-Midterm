<?php
session_start();

// Function to update student info
function updateStudent($index, $firstName, $lastName) {
    // Check if the student index is valid
    if (isset($_SESSION['students'][$index])) {
        // Update the student information
        $_SESSION['students'][$index]['firstName'] = $firstName;
        $_SESSION['students'][$index]['lastName'] = $lastName;
    }
}

$error = "";
$student = null;

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $index = $_GET['edit'];
    
    // Retrieve the student info
    if (isset($_SESSION['students'][$index])) {
        $student = $_SESSION['students'][$index];
    } else {
        $error = "Student not found!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $index = $_GET['edit'];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    
    // Update the student information
    updateStudent($index, $firstName, $lastName);
    
    // Redirect to the students list after update
    header("Location: student.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-top: 30px; 
            font-size: 2em;
            color: #333;
            width: 1000px;
            margin-left: 400px;
            margin-bottom: 50px;
        }

        fieldset {
            width: 80%; 
            min-height: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .breadcrumbs {
            margin-top: 30px;
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

        .form-group {
            margin-bottom: 20px;
            width: 75%;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
        }

        .form-group input {
            width: 130%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 20%;
            padding: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Edit Student</h2>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="breadcrumbs">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="student.php">Register Student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
    </ol>
</nav>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<fieldset style="width: 60%; height: 140px;">
    <form action="" method="POST">
        <div class="form-group">
            <label for="studentId">Student ID</label>
            <input type="text" id="studentId" name="studentId" value="<?php echo htmlspecialchars($student['studentId']); ?>" readonly style="background-color: #e9ecef; color: #6c757d;">
        </div>

        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($student['firstName']); ?>" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($student['lastName']); ?>" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Student</button>
        </div>
    </form>
</fieldset>

</body>
</html>