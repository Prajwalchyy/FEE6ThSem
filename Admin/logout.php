<?php
session_start();

if (isset($_POST['logout'])) {
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script>
        function confirmLogout() {
            // Display a confirmation dialog
            var result = confirm("Are you sure you want to log out?");
            if (result) {
                // If the user confirms, submit the logout form
                document.getElementById('logoutForm').submit();
            }
        }
    </script>
</head>
<body>

    <h2>Logout Page</h2>
    <p>Click the button below to log out of your account:</p>
    
    <!-- This form will be submitted when the user confirms logout -->
    <form id="logoutForm" action="" method="POST">
        <input type="hidden" name="logout" value="1">
        <button type="button" onclick="confirmLogout()">Logout</button>
    </form>

</body>
</html>
