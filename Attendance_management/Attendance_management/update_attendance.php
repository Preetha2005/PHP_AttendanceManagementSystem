<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}

include 'db.php';

// Update attendance
if (isset($_POST['update_attendance'])) {
    $attendance_id = $_POST['attendance_id'];
    $status = $_POST['status'];
    $query = "UPDATE attendance SET status='$status' WHERE id='$attendance_id'";
    mysqli_query($conn, $query);
    echo "<div class='alert alert-success'>Attendance updated successfully!</div>";
}

// Fetch attendance records
$attendances = mysqli_query($conn, "SELECT a.id, u.username, a.date, a.status FROM attendance a JOIN users u ON a.student_id = u.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Attendance</title>
    <link href="css/update_attendance.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar Header -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto " href="#" style="color: white; text-align: center; font-size:40px;">Update Attendance</a>
        </div>
    </nav>
    
<div class="container table-container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($attendance = mysqli_fetch_assoc($attendances)): ?>
                    <tr>
                        <td><?= $attendance['username'] ?></td>
                        <td><?= $attendance['date'] ?></td>
                        <td><?= $attendance['status'] ?></td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="attendance_id" value="<?= $attendance['id'] ?>">
                                <select name="status" class="form-control d-inline w-auto">
                                    <option value="Present" <?= $attendance['status'] == 'Present' ? 'selected' : '' ?>>Present</option>
                                    <option value="Absent" <?= $attendance['status'] == 'Absent' ? 'selected' : '' ?>>Absent</option>
                                </select>
                                <button type="submit" name="update_attendance" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">

<a href="teacher_dashboard.php" class="btn btn-dark float-end">Back</a>

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
