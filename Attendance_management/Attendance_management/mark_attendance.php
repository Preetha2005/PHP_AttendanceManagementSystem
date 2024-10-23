<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}

include 'db.php';

// Mark attendance
if (isset($_POST['mark_attendance'])) {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $query = "INSERT INTO attendance (student_id, date, status) VALUES ('$student_id', '$date', '$status')";
    mysqli_query($conn, $query);
    echo "<div class='alert alert-success'>Attendance marked successfully!</div>";
}

// Fetch all students
$students = mysqli_query($conn, "SELECT * FROM users WHERE role = 'student'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance</title>
    <link href="css/mark_attendance.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar Header -->
<nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto " href="#" style="color: white; text-align: center; font-size:40px;">Mark Attendance</a>
        </div>
    </nav>

<div class="container">
        <div class="form-container">
            <form method="POST">
                <div class="mb-3">
                    <label for="student_id" class="form-label">Select Student</label>
                    <select name="student_id" class="form-control" required>
                        <?php while ($student = mysqli_fetch_assoc($students)): ?>
                            <option value="<?= $student['id'] ?>"><?= $student['username'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>
                <button type="submit" name="mark_attendance" class="btn btn-success">Mark Attendance</button>
            </form>
        </div>
    </div>

    <div class="container mt-5">
<a href="teacher_dashboard.php" class="btn btn-dark float-end">Back</a>

<!-- Rest of your dashboard code -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
