<?php
// Include the functions file
include('function.php');

// Initialize error and success messages
$error = "";
$success = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Call the function to add a subject
    addSubject($_POST["subjectCode"], $_POST["subjectName"]);
}

// Handle delete functionality
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    deleteSubject($deleteIndex);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
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
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .subject-list-container {
            margin-top: 40px;
            margin-left: 380px;
        }

        .subject-list table {
            width: 75%;
            border-collapse: collapse;
        }

        .subject-list th, .subject-list td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .subject-list th {
            background-color: #f8f9fa;
        }

        .subject-list td {
            background-color: #fdfdfd;
        }

        .subject-list tr:hover {
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

<h2 class="h2">Add New Subject</h2>

<nav aria-label="breadcrumb" class="breadcrumbs">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
    </ol>
</nav>

<?php if (!empty($error)): ?>
    <div class="error-box"><?php echo $error; ?></div>
<?php endif; ?>


<div class="container">
    <!-- Form for adding new subject -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="subjectCode">Subject Code</label>
            <input type="text" id="subjectCode" name="subjectCode" placeholder="Enter Subject Code">
        </div>
        <div class="form-group">
            <label for="subjectName">Subject Name</label>
            <input type="text" id="subjectName" name="subjectName" placeholder="Enter Subject Name">
        </div>

        <div class="form-group">
            <button type="submit">Add Subject</button>
        </div>
    </form>
</div>

<div class="subject-list-container">
    <h3>Subject List</h3>
    <div class="subject-list">
        <table>
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['subjects'])): ?>
                    <?php foreach ($_SESSION['subjects'] as $index => $subject): ?>
                        <tr>
                            <td><?php echo $subject['subjectCode']; ?></td>
                            <td><?php echo $subject['subjectName']; ?></td>
                            <td class="action-buttons">
                                <a >Edit</a>
                                <a  class="delete">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="no-subjects">No subjects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
