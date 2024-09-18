<?php include 'db/connection.php';

// Fetch 
$fetch_programnames = "SELECT * FROM program ORDER BY pname ASC";
$program_result = mysqli_query($conn, $fetch_programnames);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collect fee</title>
    <link rel="stylesheet" href="index.css">
</head>
<?php include 'dashhead.php'; ?>

<body class="collectfee_body">
    <div class="collectfee_contents">
        <div class="collectfee_header">
            <div class="collectfee_heading">
                <h1>Fees</h1>
            </div>
            <div class="collectfee_centre">
                <div class="collectfee_search">
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Enter name">
                </div>
                <div class="collectfee_faculty">
                    <label for="faculty">Grade</label>
                    <select id="faculty">
                        <option>Select Program</option>
                        <?php
                        while ($program = mysqli_fetch_assoc($program_result)) {
                            echo '<option value="' . htmlspecialchars($program['pname']) . '">' . htmlspecialchars($program['pname']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="collectfee_header_actionbtns">
                    <button class="collectfee_filter">Filter</button>
                    <button class="collectfee_reset">Reset</button>
                </div>
            </div>
        </div>
        <div class="collectfee_table_limit">
            <label>Table Limit</label>
            <form action="" method="GET">
                <input class="collectfee_limit" type="text" name="limit" value="<?php echo isset($_GET['limit']) ? (int)$_GET['limit'] : 5; ?>">
                <button type="submit">SET</button>
                <button type="button" onclick="window.location.href='collectfee.php';">RESET</button>
            </form>
        </div>


        <div class="collectfee_table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Faculty</th>
                        <th>Fees Remaining</th>
                        <th>Fees Paid</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Apple</td>
                        <td>0099887766</td>
                        <td>BCA</td>
                        <td>10000</td>
                        <td>1000</td>
                        <td><button>Collect Fee</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>