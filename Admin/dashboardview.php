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
            <p id="totalAdmins">3</p>
        </div>
        
        <div class="dashview_cards-container">
            <div class="dashview_card">
                <h2>Total Students Enrolled</h2>
                <p id="totalStudents">150</p>
            </div>
            <div class="dashview_card">
                <h2>Active Students</h2>
                <p id="activeStudents">120</p>
            </div>
            <div class="dashview_card">
                <h2>Inactive Students</h2>
                <p id="inactiveStudents">30</p>
            </div>
            <div class="dashview_card">
                <h2>Total Programs</h2>
                <p id="totalPrograms">5</p>
            </div>
        </div>
        
        <div class="dashview_time-container">
            <h2 id="currentTime"></h2>
        </div>

        
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            document.getElementById('currentTime').textContent = now.toLocaleTimeString([], options);
        }

        setInterval(updateTime, 1000); // Update time every second
        updateTime(); // Initial call to display time immediately
    </script>
</body>
</html>
