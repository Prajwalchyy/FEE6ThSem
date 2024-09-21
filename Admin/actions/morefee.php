<?php
include '../db/connection.php';

session_start();

if (isset($_GET['more'])) {
    $id = mysqli_real_escape_string($conn, $_GET['more']);
    $query = "SELECT * FROM student
    JOIN program ON student.pid = program.pid
     WHERE sid = '$id'";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
}

// $mfeecategory = mysqli_real_escape_string($conn, $_POST['mfeecategory']);
// $amount = mysqli_real_escape_string($conn, $_POST['amount']);

// if (isset($_POST['addfeebtn'])) {
//     $query = "INSERT INTO morefee (sid, mfeecategory, amount) VALUES ('$id', '$mfeecategory', '$amount')";
//     mysqli_query($conn, $query);
//     header('location:paymentprocess.php');
// }

if (isset($_POST['addfeebtn'])) {
    $mfeecategory = mysqli_real_escape_string($conn, $_POST['mfeecategory']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $sid = $_POST['sid'];

    $query = "INSERT INTO morefee (sid, mfeecategory, amount) VALUES ('$sid', '$mfeecategory', '$amount')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = 'Fee added successfully';
        header("Location: paymentprocess.php?pay=$sid");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add more Process</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body class="morefee_body">


    <div class="morefee_parentdiv">
        <h2>Add more Fee</h2>

        <section class="morefee_studentinfo">
            <h3>Student Information</h3>
            <div class="morefee_infogroup">
                <label>Name:</label>
                <span><?php echo htmlspecialchars($student['sname']) ?></span>
            </div>
            <div class="morefee_infogroup">
                <label>Contact:</label>
                <span><?php echo htmlspecialchars($student['scontact']) ?></span>
            </div>
            <div class="morefee_infogroup">
                <label>Sex:</label>
                <span><?php echo htmlspecialchars($student['ssex']) ?></span>
            </div>
            <div class="morefee_infogroup">
                <label>Batch:</label>
                <span><?php echo htmlspecialchars($student['sbatchyear']) ?></span>
            </div>
            <div class="morefee_infogroup">
                <label>Faculty:</label>
                <span><?php echo htmlspecialchars($student['pname']) ?></span>
            </div>
        </section>

        <section class="morefee_pay">
            <h3>Add Student Fee</h3>
            <form method="POST" action="#">
            <input type="hidden" name="sid" value="<?php echo $student['sid']; ?>">
                <div class="morefee_inputgroup">
                    <label for="mfeecategory">Fee Category:</label>
                    <select name="mfeecategory" id="mfeecategory" class="morefee_option" required>
                        <option value="">Select Category.......</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Exam">Exam Fee</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="morefee_inputgroup">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" class="morefee_inputamount" name="amount" placeholder="Enter amount to pay" required>
                </div>
                <button type="submit" class="morefee_inputpaybtn" name="addfeebtn">Add</button><br><br><br>
                <button type="button" class="morefee_inputpaybtn" onclick="confirmBack()">Back</button>

                <script>
                    function confirmBack() {
                        if (confirm("Are you sure you want to go back? Any unsaved changes will be lost.")) {
                            window.history.back(); // This will take the user to the previous page
                        }
                    }
                </script>
            </form>
        </section>
    </div>
</body>

</html>