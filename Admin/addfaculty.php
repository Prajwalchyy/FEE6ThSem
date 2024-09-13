<?php include 'db/connection.php';

session_start();

if (isset($_POST['faddbutton'])) {
    $program_name = mysqli_real_escape_string($conn, $_POST['programname']);
    $program_fullname = mysqli_real_escape_string($conn, $_POST['programfullname']);
    $program_based = mysqli_real_escape_string($conn, $_POST['programbase']);
    $program_year = mysqli_real_escape_string($conn, $_POST['programyear']);


    $select = "SELECT * FROM program WHERE pname = '$program_name'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Program name already exists. Please choose a different name.";

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {

        $insert = "INSERT INTO program (pname, pbased, pfullname, pyear) 
           VALUES ('$program_name', '$program_based', '$program_fullname', $program_year)";

        if (mysqli_query($conn, $insert)) {
            $_SESSION['message'] = "Program added successfully";
        } else {
            $_SESSION['message'] = "Error adding program: " . mysqli_error($conn);
        }
        // header("Location: faculty.php");
        // exit();
        $_SESSION['redirect'] = "faculty.php";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_SESSION['message'])) {
    $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES);
    $redirect = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : '';
    echo "
    <script>
    alert('$message');
    " . ($redirect ? "window.location.href = '$redirect';" : "") . "
    </script>
    ";
    unset($_SESSION['message']);
    unset($_SESSION['redirect']);
}
?>
<html>

<head>
    <title>ADD PROGRAM</title>
    <link rel="stylesheet" href="index.css">
</head>

<body class="addfaculty_body">
    <div class="addfaculty_contents">

        <h2>ADD PROGRAM</h2>
        <!-- <form action="#" method="post"> -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>Program Name</label>
            <input class="addfacultyinput" type="text" name="programname" required><br><br>


            <div class="addfaculty_pbased">
                <label>Program Based:</label>
                <input type="radio" id="year" name="programbase" value="year" required>
                <label for="year">Year</label>
                <input type="radio" id="semester" name="programbase" value="semester">
                <label for="semester">Semester</label>
            </div>
            <br>

            <label for="facultydetails">Program Full Name</label>
            <input class="addfacultyinput" type="text" name="programfullname" required><br><br>

            <label for="fnyear">No Of Year</label>
            <input class="addfacultyinput" type="number" id="fnyear" name="programyear" required><br><br>

            <button type="submit" class="addfacbtn" name="faddbutton">ADD</button>

        </form>
    </div>
</body>

</html>