<?php
include 'db/connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are empty
    if (empty($email) || empty($password)) {
        echo "Please enter both email and password.";
    } else {
        // Query the database for the user
        $query = "SELECT * FROM admin WHERE auser = '$email' AND apass = '$password'";
        $result = mysqli_query($conn, $query);

        // Check if a user was found
        if (mysqli_num_rows($result) == 1) {
            // Successful login, redirect to student.php
            header("Location: studentlist.php");
            exit();
        } else {
            // Invalid login credentials, display an error message
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
                <input class="adinput" type="email" name="email"><br><br>
    
                <label>Password</label>
                <input class="adinput" type="password" name="password"><br><br>
    
                <input class="aloginbtn" type="submit"  value="LOGIN" name="submit">
            </form>
        </div>
    </body>
</html>