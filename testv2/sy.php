<?php
include '../Admin/db/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $period_type = $_POST['period'];
    $count = intval($_POST['count']);
    
    for ($i = 1; $i <= $count; $i++) {
        $period_data = $_POST[$period_type . $i];
        $sql = "INSERT INTO test (period_type, period_number, period_data) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $period_type, $i, $period_data);
        $stmt->execute();
    }
    
    echo "<p>Data inserted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Period Input</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 20px; }
        form { max-width: 400px; margin: 0 auto; }
        div { margin-bottom: 15px; }
        label { display: inline-block; margin-right: 10px; }
        input[type="number"], input[type="submit"] { width: 100%; padding: 5px; }
        input[type="radio"] { margin-right: 5px; }
    </style>
</head>
<body>
    <form method="post" id="periodForm">
        <div>
            <label>Academic Period:</label>
            <input type="radio" name="period" value="yearly" required> Yearly
            <input type="radio" name="period" value="semester"> Semester
        </div>
        <div>
            <label for="count">Number of <?php echo isset($_POST['period']) ? $_POST['period'] : 'periods'; ?>:</label>
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
</body>
</html>