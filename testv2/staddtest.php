<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form action="#" method="post">
        <h2>Personal Information</h2>
        
        <label for="symbolNumber">Symbol Number:</label>
        <input type="text" id="symbolNumber" name="symbolNumber" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="contact">Contact:</label>
        <input type="tel" id="contact" name="contact" required><br><br>

        <label for="sex">Sex:</label>
        <select id="sex" name="sex" required>
            <option value="">Select Sex</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="faculty">Faculty:</label>
        <input type="text" id="faculty" name="faculty" required><br><br>

        <label for="batchYear">Batch Year:</label>
        <input type="number" id="batchYear" name="batchYear" min="2000" max="2099" step="1" required><br><br>

        <h2>Fee Information</h2>
        
        <form method="post" id="periodForm">
    <div>
        <label>Academic Period:</label>
        <input type="radio" name="period" value="yearly" required> Yearly
        <input type="radio" name="period" value="semester"> Semester
    </div>
    <div>
        <label for="count">Number of periods:</label>
        <input type="number" id="count" name="count" min="1" required>
    </div>
    <div>
        <input type="submit" name="generate" value="Generate">
    </div>
</form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generate'])) {
            $period = $_POST['period'];
            $count = intval($_POST['count']);

            echo "<form method='post'>";
            echo "<input type='hidden' name='period' value='$period'>";
            echo "<input type='hidden' name='count' value='$count'>";

            if ($period == 'yearly') {
                for ($i = 1; $i <= $count; $i++) {
                    echo "<div>";
                    echo "<label for='yearly$i'>Year $i:</label>";
                    echo "<input type='text' id='yearly$i' name='yearly$i' required>";
                    echo "</div>";
                }
            } else {
                for ($i = 1; $i <= $count; $i++) {
                    echo "<div>";
                    echo "<label for='semester$i'>Semester $i:</label>";
                    echo "<input type='text' id='semester$i' name='semester$i' required>";
                    echo "</div>";
                }
            }

            echo "<div><input type='submit' name='submit' value='Submit'></div>";
            echo "</form>";
        }
        ?>

        <input type="submit" value="Add Student">
    </form>
</body>
</html>