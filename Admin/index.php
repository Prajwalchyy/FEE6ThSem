<?php
session_start();
include 'db/connection.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


$admins_count = "SELECT COUNT(*) AS total_admins FROM admin";
$admins_result = mysqli_query($conn, $admins_count);
$admins_row = mysqli_fetch_assoc($admins_result);
$total_admins = $admins_row['total_admins'];


$student_count = "SELECT COUNT(*) AS total_students FROM student";
$total_students_result = mysqli_query($conn, $student_count);
$total_students_row = mysqli_fetch_assoc($total_students_result);
$total_students = $total_students_row['total_students'];


$programs_count = "SELECT COUNT(*) AS total_programs FROM program";
$programs_result = mysqli_query($conn, $programs_count);
$programs_row = mysqli_fetch_assoc($programs_result);
$total_programs = $programs_row['total_programs'];


$active_students_count = "SELECT COUNT(*) AS active_students FROM student WHERE sstatus = 'active'";
$active_students_result = mysqli_query($conn, $active_students_count);
$active_students_row = mysqli_fetch_assoc($active_students_result);
$active_students = $active_students_row['active_students'];

$inactive_students_count = "SELECT COUNT(*) AS inactive_students FROM student WHERE sstatus = 'inactive'";
$inactive_students_result = mysqli_query($conn, $inactive_students_count);
$inactive_students_row = mysqli_fetch_assoc($inactive_students_result);
$inactive_students = $inactive_students_row['inactive_students'];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="index.css">
</head>

<body class="dashview_body">
    <?php include 'dashhead.php'; ?>
    <div class="dashview_dashboard">
        <h1 class="dashview_dashboard-title">ADMIN DASHBOARD</h1>

        <div class="dashview_card admin-card">
            <h2>Total Admins</h2>
            <p id="totalAdmins"><?php echo $total_admins; ?></p>
        </div>

        <div class="dashview_cards-container">
            <div class="dashview_card">
                <h2>Total Students Enrolled</h2>
                <p id="totalStudents"><?php echo $total_students; ?></p>
            </div>
            <div class="dashview_card">
                <h2>Active Students</h2>
                <p id="activeStudents"><?php echo $active_students; ?></p>
            </div>
            <div class="dashview_card">
                <h2>Inactive Students</h2>
                <p id="inactiveStudents"><?php echo $inactive_students; ?></p>
            </div>
            <div class="dashview_card">
                <h2>Total Programs</h2>
                <p id="totalPrograms"><?php echo $total_programs; ?></p>
            </div>
        </div>

        <div class="dashview_time-container">
            <h2 id="currentTime"></h2>
        </div>


    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            document.getElementById('currentTime').textContent = now.toLocaleTimeString([], options);
        }

        setInterval(updateTime, 1000); 
        updateTime(); 
    </script>
</body>

</html>