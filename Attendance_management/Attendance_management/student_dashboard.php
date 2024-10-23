<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}

include 'db.php';

// Fetch attendance records for the logged-in student
$student_id = $_SESSION['id'];
$attendances = mysqli_query($conn, "SELECT date, status FROM attendance WHERE student_id = '$student_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="css/update_attendance.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <!-- Navbar Header -->
   <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto " href="#" style="color: white; text-align: center; font-size:40px;">Student Dashboard</a>
        </div>
    </nav>
    <h2 class="text-center">Your Attendance</h2>
    <div class="container table-container">
        <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($attendance = mysqli_fetch_assoc($attendances)): ?>
                <tr>
                    <td><?= $attendance['date'] ?></td>
                    <td><?= $attendance['status'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    </div>
    <div class="container mt-5">

    <!-- Add Logout Button -->
    <a href="logout.php" class="btn btn-danger float-end">Log Out</a>

    <!-- Rest of your dashboard code -->
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
