<?php

//sessions
session_start();
include 'dbconn/connection.php';
if (!isset($_SESSION['student_id'])) {
    header('Location: slogin.php');
    exit();
}
$student_id = $_SESSION['student_id'];
if (isset($_POST['receipt_databtn'])) {
    $_SESSION['receipt_number'] = $_POST['receipt_number'];

    header('Location: sreceipt.php');
    
}


//others
$where = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE s.senroll LIKE '%$search%' OR s.sname LIKE '%$search%' OR ft.receipt_number LIKE '%$search%'";
}

$default_limit = 10;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : $default_limit;

if ($limit < 1) {
    $limit = $default_limit;
}


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $limit;

$counter = ($page - 1) * $limit + 1;


// $total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM fee_transaction ft JOIN student s ON ft.sid = s.sid $where");
$total_result = mysqli_query($conn, "
    SELECT COUNT(DISTINCT receipt_number) AS total 
    FROM fee_transaction ft 
    JOIN student s ON ft.sid = s.sid 
    $where
");

$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);


$select_transaction = "
    SELECT ft.receipt_number, SUM(ft.amount) AS total_amount, MAX(ft.payment_date) AS payment_date, s.senroll, s.sname
    FROM fee_transaction ft
    JOIN student s ON ft.sid = s.sid
    WHERE ft.sid = '$student_id' $where 
    GROUP BY ft.receipt_number
    ORDER BY ft.feeid DESC
    LIMIT $limit OFFSET $offset
";
$fetch_transactions = mysqli_query($conn, $select_transaction);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <link rel="stylesheet" href="sindex.css">
</head>

<body class="feepaidhistory_body">
    <?php include 'sdashhead.php'; ?>

    <div class="feepaidhistory_maincontents">
        <div class="feepaidhistory_header">
            <h1>Fee Paid History</h1>
            <!-- <div class="feepaidhistory_search_bar">
                <form method="GET" action="feepaidhistory.php">
                    <input type="text" name="search" placeholder="Search by student enroll, name or receipt number">
                    <button type="submit">Search</button>
                    <button type="button" onclick="window.location.href='sreceipthistory.php';">Reset</button>
                </form>
            </div> -->
        </div>

        <div class="feepaidhistory_table_limit">
            <label>Table Limit</label>
            <form action="" method="GET" id="feepaidhistory_limit_form">
                <input class="feepaidhistory_limit" id="feepaidhistory_limitid" type="text" name="limit" value="<?php echo isset($_GET['limit']) ? (int)$_GET['limit'] : 10; ?>">
                <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">SET</button>
                <button type="button" onclick="resetLimit()">RESET</button>
            </form>
            <script>
                function resetLimit() {
                    document.getElementById('feepaidhistory_limitid').value = 10;
                    document.getElementById('feepaidhistory_limit_form').submit();
                }
            </script>
        </div>

        <div class="feepaidhistory_table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Student Name</th>
                        <th>Receipt Number</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($fetch_transactions)) {
                    ?>

                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $row['sname']; ?></td>
                            <td><?php echo $row['receipt_number']; ?></td>
                            <td><?php echo $row['payment_date']; ?></td>
                            <td><?php echo $row['total_amount']; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="receipt_number" value="<?php echo $row['receipt_number']; ?>">
                                    <button type="submit" name="receipt_databtn" class="feepaidhistory_detail">Detail</button>
                                </form>

                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="feepaidhistory_pagination">
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