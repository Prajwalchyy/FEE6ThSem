<?php
include 'dbconn/connection.php';
session_start();


if (!isset($_SESSION['student_id'])) {
    header("Location: slogin.php");
    exit();
}


if (isset($_POST['change_password'])) {
    $current_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    $student_id = $_SESSION['student_id'];

 
    if ($new_password !== $confirm_password) {
        echo "<script>alert('New password and confirm password do not match.');</script>";
    } else {
        
        $query = "SELECT * FROM student WHERE sid = '$student_id' AND spassword = '$current_password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
           
            $update_query = "UPDATE student SET spassword = '$new_password' WHERE sid = '$student_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password changed successfully.');</script>";
            } else {
                echo "<script>alert('Error updating password. Please try again later.');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="changepass-body">
    <?php include 'sdashhead.php'; ?>

    <div class="changepass-main-container">
        <div class="change-password-container">
            <h2>Change Password</h2>
            <form method="POST" action="">
                <div class="chnage-password-form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                </div>

                <div class="chnage-password-form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="newPassword" required>
                </div>

                <div class="chnage-password-form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>

                <div class="chnage-password-form-group">
                    <input type="submit" name="change_password" value="Change Password">
                </div>
            </form>
            <div class="error-message" id="errorMessage">Passwords do not match!</div>
        </div>
    </div>
</body>

</html>
