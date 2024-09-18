<?php 
include 'db/connection.php';

// Fetch 
$fetch_programnames = "SELECT * FROM program ORDER BY pname ASC";
$program_result = mysqli_query($conn, $fetch_programnames);



$where = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE sname LIKE '%$search%' OR senroll LIKE '%$search%' OR scontact LIKE '%$search%'";
}

//page table limit
$default_limit = 10;

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : $default_limit;

if ($limit < 1) {
    $limit = $default_limit;
}



//limit logic of table
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $limit;



$counter = ($page - 1) * $limit + 1;
// $total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM student $where");
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM student $where");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);


$select_student = "SELECT * FROM student
JOIN program ON student.pid = program.pid
$where ORDER BY CAST(senroll AS UNSIGNED) DESC LIMIT $limit OFFSET $offset";
$fetch_students = mysqli_query($conn, $select_student);


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
            <form action="" method="GET" id="collectfee_limit_form">
                <input class="collectfee_limit" id="collectfee_limit" type="text" name="limit" value="<?php echo isset($_GET['limit']) ? (int)$_GET['limit'] : 10; ?>">
                <button type="submit">SET</button>
                <button type="button" onclick="resetLimit()">RESET</button>
            </form>
            <script>
                function resetLimit() {
                    document.getElementById('collectfee_limit').value = 10;
                    document.getElementById('collectfee_limit_form').submit();
                }
            </script>
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
                <?php
                    while ($row = mysqli_fetch_assoc($fetch_students)) {
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $row['sname']; ?></td>
                        <td><?php echo $row['scontact']; ?></td>
                        <td><?php echo $row['pname']; ?></td>
                        <td>10000</td>
                        <td>1000</td>
                        <td><button>Collect Fee</button></td>
                    </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="collectfee_pagination">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>&limit=<?php echo $limit; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>&limit=<?php echo $limit; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages) : ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>&limit=<?php echo $limit; ?>">Next</a>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>