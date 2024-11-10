<?php
// Include the functions file
include('function.php');

// Check if the user is logged in
check_login();

// Retrieve user email from session using the function
$user_email = get_user_email();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #FFFFFF;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 30vh;
        }
        .navbar {
            width: 73.5%;
            background-color: #ffffff;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }
        .navbar h1 {
            font-size: 1.2rem;
            color: #000000;
        }
        .logout-btn {
            padding: 0.5rem 1rem;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .container {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .heading-container {
            background-color: #d3d3d3; /* Grey background for headings */
            padding: 0.8rem;
            text-align: left;
    
            margin-bottom: 2rem; /* Space between heading and content */
        }
        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 700px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .card h2 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #333;
        }
        .card p {
            font-size: 1rem;
            padding: 0.5rem 2rem;
            color: #666;
            margin-bottom: 2.5rem;
        }
        .card button {
            padding: 1.5rem 2rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Welcome to the System: <?php echo htmlspecialchars($user_email); ?></h1>
        <a href="index.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <div class="card">
            <div class="heading-container">
                <h2>Add a Subject</h2>
            </div>
            <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
            <a href="subject.php">
                <button>Add Subject</button>
            </a>
        </div>

        <div class="card">
            <div class="heading-container">
                <h2>Register a Student</h2>
            </div>
            <p>This section allows you to register a new student in the system.Click the button to proceed with registration process.</p>
            <a href="student.php">
                <button>Register</button>
            </a>
        </div>
    </div>
</body>
</html>
