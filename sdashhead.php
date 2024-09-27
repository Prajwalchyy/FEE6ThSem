<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header side</title>
    <link rel="stylesheet" href="sindex.css">
</head>
<body class="dashhead_body">
<div class="dashheader_sidebar">
     <p>STUDENT FEE MANAGEMENT</p>
    <a href="index.php"class="dashheader_sidebar_contents <?php if ($current_page == 'index.php') { echo 'active'; } ?>">Dashboard</a>
    <a href="studentdetail.php" class="dashheader_sidebar_contents <?php if ($current_page == 'studendetail.php') { echo 'active'; } ?>">Student Management</a>
    <a href="sreceipthistory.php"class="dashheader_sidebar_contents <?php if ($current_page == 'sreceipthistory.php') { echo 'active'; } ?>">Fee History</a>
    <a href="schangepass.php"class="dashheader_sidebar_contents <?php if ($current_page == 'schangepass.php') { echo 'active'; } ?>">Account Settings</a>
    <a href="slogout.php" class="dashheader_sidebar_contents" onclick="return confirmLogout();">Logout</a>

<script>
    function confirmLogout() {
        return confirm('Are you sure you want to logout?');
    }
</script>

</div>
</body>
</html>