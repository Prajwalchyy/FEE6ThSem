<?php
include 'dbconn/connection.php';
session_start(); 

if (isset($_POST['submit'])) {
    $email = $_POST['contact'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please enter both contact and password.";
    } else {
        $query = "SELECT * FROM student WHERE scontact = '$email' AND spassword = '$password'";
        $result = mysqli_query($conn, $query);

       
        if (mysqli_num_rows($result) == 1) {
            $student = mysqli_fetch_assoc($result);
            $_SESSION['student_id'] = $student['sid'];
            $_SESSION['student_contact'] = $student['scontact'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password. Please try again.');</script>";
        }
    }
}
?>
<html>
    <head>
        <title>STUDENT LOGIN</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="alogin-body">
        <div class="login-middiv">
            <h2>STUDENT LOGIN PAGE</h2>
            <form action="#" method="post">
                <label>Contact</label>
                <input class="adinput" type="text" name="contact" required><br><br>
                <label>Password</label>
                <input class="adinput" type="password" name="password" required><br><br>
                <input class="aloginbtn" type="submit" value="LOGIN" name="submit">
            </form>
        </div>
    </body>
</html>