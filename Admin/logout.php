<?php
// Check if the logout link was clicked
if (isset($_GET['logout'])) {
    // Ask the user if they are sure they want to log out
    echo "<script>
        if (confirm('Are you sure you want to log out?')) {
            // Redirect to the login page
            window.location.href = 'login.php';
        } else {
            // Cancel the logout
            window.location.href = 'studentlist.php'; // Replace with your dashboard page
        }
    </script>";
} else {
    // The user is not trying to log out, redirect to the dashboard
    header("Location: studentlist.php");
    exit();
}
?>