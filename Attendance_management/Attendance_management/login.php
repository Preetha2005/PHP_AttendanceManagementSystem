<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch user
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if ($password == $user['password']) {
            // Set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = $user['role'];  // Store the user role for redirection
            $_SESSION['id']=$user['id'];
            
            // Redirect based on user role
            if ($user['role'] == 'teacher') {
                header("Location: teacher_dashboard.php");
                exit; // Ensure script execution stops here
            } elseif ($user['role'] == 'student') {
                header("Location: student_dashboard.php");
                exit; // Ensure script execution stops here
            }
        } else {
            // Invalid password message
            $_SESSION['error'] = "Invalid password!";
            header("Location: login.php");
            exit;
        }
    } else {
        // User not found message
        $_SESSION['error'] = "User not found!";
        header("Location: login.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Header -->
    <header class="header">
        <img src="https://www.shutterstock.com/image-vector/effective-teamwork-icon-black-thin-600nw-2227180861.jpg" class="rounded-circle" alt="Website Logo"> <!-- Replace with your logo URL -->
        <h1>One Tap</h1> <!-- Replace 'Website Name' with your site name -->
    </header>

    <!-- Login Form -->
    <div class="login-container">
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">
                <i class="bi bi-person-circle"></i>Username
                </label>
                <input type="text" class="form-control" name="username" placeholder="Enter email or username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">
                <i class="bi bi-person-lock"></i> Password
                </label>
                <input type="password" class="form-control" name="password" placeholder="Enter password">
            </div>
            <button type="submit" name="login" class="btn btn-success w-100">Log in</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
