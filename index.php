<?php
// Include the functions file
include('function.php');

// Start session if not already started
startSessionIfNotStarted();

// Initialize error message
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate credentials
    if (empty($email) || empty($password)) {
        $error_message = "<ul>";
        if (empty($email)) {
            $error_message .= "<li>Email is required</li>";
        }
        if (empty($password)) {
            $error_message .= "<li>Password is required</li>";
        }
        $error_message .= "</ul>";
    } 
    // Check if login credentials are valid
    elseif (checkLoginCredentials($email, $password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email; // Store email in session
        header("Location: dashboard.php"); // Redirect to dashboard.php
        exit;
    } else {
        $error_message = "<ul><li>Invalid email or password</li></ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50vh;
            margin: 0;
            flex-direction: column;
        }
        .error-box {
            color: #b94a48;
            background-color: #f2dede;
            padding: 10px;
            margin-bottom: 20px;
            text-align: left;
            border-radius: 5px;
            width: 300px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .error-box strong {
            font-weight: bold;
        }
        .error-box .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            color: #b94a48;
            cursor: pointer;
        }
        .container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 95%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <?php if ($error_message): ?>
        <div class="error-box">
            <button class="close-btn" onclick="closeErrorBox()">×</button>
            <strong>System Errors</strong>
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2>Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="Enter email" >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" >
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

    <script>
        function closeErrorBox() {
            document.querySelector('.error-box').style.display = 'none';
        }
    </script>

</body>
</html>
