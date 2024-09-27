<?php
include '../db/connection.php';


if (isset($_GET['update'])) {
    $id = mysqli_real_escape_string($conn, $_GET['update']);
    $query = "SELECT * FROM program WHERE pid = '$id'";
    $result = mysqli_query($conn, $query);
    $faculty = mysqli_fetch_assoc($result);
}


if (isset($_POST['fupdatebutton'])) {
    $programname = mysqli_real_escape_string($conn, $_POST['programname']);
    $programfullname = mysqli_real_escape_string($conn, $_POST['programfullname']);
    $programyear = mysqli_real_escape_string($conn, $_POST['programyear']);
    $programbased = mysqli_real_escape_string($conn, $_POST['programbased']);

    $update = "UPDATE program SET pname='$programname', pfullname='$programfullname', pyear='$programyear', pbased='$programbased' WHERE pid='$id'";
    if (mysqli_query($conn, $update)) {
        echo "<script>alert('program updated successfully'); window.location.href='../faculty.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<html>

<head>
    <title>Update Faculty</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body class="updatefaculty_body">
    <div class="updatefaculty_contents">
        <h2>UPDATE PROGRAM</h2>
        <form action="" method="post">

            <label>Program Name</label>
            <input class="updatefacultyinput" type="text" name="programname" value="<?php echo htmlspecialchars($faculty['pname']); ?>" required><br><br>

            <div class="updateaddfaculty_pbased">
                <label>Program Based:</label>

                <input type="radio" id="year" name="programbased" value="year"
                    <?php echo strtolower($faculty['pbased']) == 'year' ? 'checked' : ''; ?> required>
                <label for="year">Year</label>

                <input type="radio" id="semester" name="programbased" value="semester"
                    <?php echo strtolower($faculty['pbased']) == 'semester' ? 'checked' : ''; ?>>
                <label for="semester">Semester</label>
            </div>


            <br>

            <label>Program Fullname</label>
            <input class="updatefacultyinput" type="text" name="programfullname" value="<?php echo htmlspecialchars($faculty['pfullname']); ?>" required><br><br>


            <label>Program Year</label>
            <input class="updatefacultyinput" type="number" name="programyear" value="<?php echo htmlspecialchars($faculty['pyear']); ?>" required><br><br>


            <button type="submit" class="updatefacbtn" name="fupdatebutton">UPDATE</button>
        </form>
    </div>
</body>

</html>