<?php
include 'function.php';

$error = "";
$success = "";

// Check if the delete parameter is in the URL
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    $subject = getSubject($index);
    if (!$subject) {
        echo "<div class='alert alert-danger'>Error: Subject not found!</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Error: Subject not found!</div>";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteSubject'])) {
    $index = $_POST['deleteSubject'];
    $success = deleteSubjectByIndex($index);


    header("Location: subject.php?deleted=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Subject</title>
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
            width: 60%;
            min-height: 300px;
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
        .form-group {
            margin-bottom: 20px;
            width: 75%;
        }
        .form-group label {
            font-size: 16px;
            color: #555;
        }
        .form-group ul {
            font-size: 16px;
            color: #333;
            list-style-type: disc;
            padding-left: 20px;
        }
        .form-group button {
            width: 20%;
            padding: 8.5px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Delete Subject</h2>

<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="breadcrumbs">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="subject.php">Add Subject</a></li>
        <li class="breadcrumb-item active" aria-current="page">Delete Subject</li>
    </ol>
</nav>

<fieldset>
    <form action="" method="POST">
    
        <div class="form-group">
            <label for="subjectCode">Subject Code:</label>
            <ul>
                <li><?php echo htmlspecialchars($subject['subjectCode']); ?></li>
            </ul>
        </div>

        <div class="form-group">
            <label for="subjectName">Subject Name:</label>
            <ul>
               <li><?php echo htmlspecialchars($subject['subjectName']); ?></li>
            </ul>
        </div>

    
        <div class="form-group">
            <a href="subject.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" name="deleteSubject" class="btn btn-danger" value="<?php echo $index; ?>">Delete Subject Record</button>
        </div>
    </form>
</fieldset>

</body>
</html>