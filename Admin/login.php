<?php
include 'db/connection.php';
session_start(); 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please enter both email and password.";
    } else {
        $query = "SELECT * FROM admin WHERE auser = '$email' AND apass = '$password'";
        $result = mysqli_query($conn, $query);

       
        if (mysqli_num_rows($result) == 1) {
            $admin = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $admin['aid'];
            $_SESSION['admin_email'] = $admin['auser'];
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
        <title>ADMIN LOGIN</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body class="alogin-body">
        <div class="login-middiv">
            <h2>ADMIN LOGIN PAGE</h2>
            <form action="#" method="post">
                <label>Email</label>
                <input class="adinput" type="email" name="email" required><br><br>
                <label>Password</label>
                <input class="adinput" type="password" name="password" required><br><br>
                <input class="aloginbtn" type="submit" value="LOGIN" name="submit">
            </form>
        </div>
    </body>
</html>
