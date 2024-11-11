<?php
session_start();

function deleteStudent($index) {
    if (isset($_SESSION['students'][$index])) {
        unset($_SESSION['students'][$index]);
        $_SESSION['students'] = array_values($_SESSION['students']);
    }
}


if (isset($_GET['delete']) && isset($_GET['studentId']) && isset($_GET['firstName']) && isset($_GET['lastName'])) {

    $index = $_GET['delete'];
    $studentId = $_GET['studentId'];
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmDelete'])) {
        deleteStudent($index); 
        header("Location: student.php?deleted=true"); 
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Error: Student not found!</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group button {
    width: 20%;
    padding: 7px;
    font-size: 16px;
    background-color: #2d8feb;
    color: white;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
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
        .headers {
    margin-left: 380px;
    font-size: 2rem;
    color: #333;
    padding: 10px;
    font-family: 'Arial', sans-serif;
}

        
        .delete-student-title {
            font-size: 2rem; 
            color: #333; 
            width: 700px;
            margin: 20px 0; 
            margin-left: 380px;
            padding: 10px; 
            font-family: 'Arial', sans-serif;
        }
        
    </style>
</head>
<body>

<h2 class= "headers">Delete a Student</h2>

<nav aria-label="breadcrumb" class="breadcrumbs">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="student.php">Register Student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
    </ol>
</nav>

<div class="container">
    <h4>Are you sure you want to delete this student?</h4>
    
    <form action="" method="POST">
        <div class="form-group">
            <label><b>Student ID:</b> <?php echo htmlspecialchars($studentId); ?></label>
        </div>
        <div class="form-group">
            <label><b>First Name:</b> <?php echo htmlspecialchars($firstName); ?></label>
        </div>
        <div class="form-group">
            <label><b>Last Name:</b> <?php echo htmlspecialchars($lastName); ?></label>
        </div>
        <div class="form-group">
            <a href="student.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" name="confirmDelete" class="btn btn-danger">Delete Student Record</button>
        </div>
    </form>
</div>

</body>
</html>
