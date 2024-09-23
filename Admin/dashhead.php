<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header side</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="dashhead_body">
<div class="header_sidebar">
     <p>STUDENT FEE MANAGEMENT</p>
    <a href="dashboardview.php"class="header_sidebar_contents <?php if ($current_page == 'dashboardview.php') { echo 'active'; } ?>">Dashboard</a>
    <a href="studentlist.php" class="header_sidebar_contents <?php if ($current_page == 'studentlist.php') { echo 'active'; } ?>">Student Management</a>
    <a href="faculty.php" class="header_sidebar_contents <?php if ($current_page == 'faculty.php') { echo 'active'; } ?>">Programs</a>
    <a href="collectfee.php" class="header_sidebar_contents <?php if ($current_page == 'collectfee.php') { echo 'active'; } ?>">Collect Fee</a>
    <a href="#student-history"class="header_sidebar_contents <?php if ($current_page == 'student-history.php') { echo 'active'; } ?>">Student History</a>
    <a href="changepass.php"class="header_sidebar_contents <?php if ($current_page == 'changepass.php') { echo 'active'; } ?>">Account Settings</a>
    <a href="logout.php" class="header_sidebar_contents" onclick="return confirmLogout();">Logout</a>

<script>
    function confirmLogout() {
        return confirm('Are you sure you want to logout?');
    }
</script>

</div>
</body>
</html>