<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add More Fee</title>
</head>
<body>

    <h2>Add Additional Fee</h2>

    <!-- Form to add more fee -->
    <form method="POST" action="">
        <label for="sid">Student ID:</label><br>
        <input type="number" id="sid" name="sid" required><br><br>

        <label for="mfeecategory">Fee Category:</label><br>
        <select id="mfeecategory" name="mfeecategory" required>
            <option value="transportation">Transportation</option>
            <option value="examfee">Exam Fee</option>
            <option value="others">Others</option>
        </select><br><br>

        <label for="amount">Amount:</label><br>
        <input type="number" id="amount" name="amount" step="0.01" required><br><br>

        <input type="submit" name="submit" value="Add Fee">
    </form>

    <?php
    // Include your database connection
    include '../db/connection.php';

    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $sid = $_POST['sid'];
        $mfeecategory = $_POST['mfeecategory']; // Selected category from dropdown
        $amount = $_POST['amount'];

        // Insert data into Morefee table
        $sql = "INSERT INTO morefee (sid, mfeecategory, amount) VALUES ('$sid', '$mfeecategory', '$amount')";

        if (mysqli_query($conn, $sql)) {
            echo "<p>Additional fee added successfully.</p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>

</body>
</html>
