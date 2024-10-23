<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/teacher_dashboard.css" rel="stylesheet">
</head>
<body>
<!-- Navbar Header -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto " href="#" style="color: white; text-align: center; font-size:40px;">Teacher Dashboard</a>
        </div>
    </nav>

    <main class="main bd-grid">
        <article class="card">
            <div class="card-img">
                <img src="https://media.istockphoto.com/id/1447132233/vector/person-people-with-check-mark-illustration-vector.jpg?s=612x612&w=0&k=20&c=u1I3Q-LwDdLIr13UV3089mPYJnuIffJlnIFo-UmvzwY=" class="mx-auto d-block" alt="image">
            </div>

            <div class="card-name">
                <p>MARK ATTENDANCE</p>
            </div>

            <div class="card-prices justify-content-center">
            <a href="mark_attendance.php" class="btn btn-success float-end">Mark</a>
            </div>
        </article>

        <article class="card">
            <div class="card-img">
                <img src="https://png.pngitem.com/pimgs/s/63-635993_join-us-join-us-icon-png-transparent-png.png" class="mx-auto d-block" alt="image">
            </div>

            <div class="card-name">
                <p>ADD STUDENT</p>
            </div>

            <div class="card-prices justify-content-center">
            <a href="add_student.php" class="btn btn-success float-end">Add</a>
            </div>
        </article>

        <article class="card">
            <div class="card-img">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF5YhjsqWCfIJwutUDu9v1-MuHt84DSPs3k85LDDd39OUvfAIol-JuTAvi7lK4yjP7kFE&usqp=CAU" class="mx-auto d-block" alt="image">
            </div>

            <div class="card-name">
                <p>UPDATE ATTENDANCE</p>
            </div>

            <div class="card-prices justify-content-center">
            <a href="update_attendance.php" class="btn btn-success float-end">Update</a>
            </div>
        </article>

        <article class="card">
            <div class="card-img">
                <img src="https://t4.ftcdn.net/jpg/05/09/07/49/360_F_509074915_vIpk4slJokUyXrdD4AOAYwWN7GiN4Frb.jpg" class="mx-auto d-block" alt="image">
            </div>

            <div class="card-name">
                <p>DELETE ATTENDANCE</p>
            </div>

            <div class="card-prices justify-content-center">
            <a href="delete_attendance.php" class="btn btn-success float-end">Delete</a>
            </div>
        </article>
    </main>

    <div class="container mt-5">

    <!-- Add Logout Button -->
    <a href="logout.php" class="btn btn-danger float-end">Log Out</a>

    <!-- Rest of your dashboard code -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
