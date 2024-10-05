<?php
session_start();
include 'db/connection.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['receipt_databtn'])) {
    $_SESSION['receipt_number'] = $_POST['receipt_number'];
    header('Location: actions/receipt.php');
}

$where = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE s.senroll LIKE '%$search%' OR s.sname LIKE '%$search%' OR ft.receipt_number LIKE '%$search%'";
}

if (isset($_GET['start_date']) && !empty($_GET['start_date']) && isset($_GET['end_date']) && !empty($_GET['end_date'])) {
    $start_date = mysqli_real_escape_string($conn, $_GET['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_GET['end_date']);
    if (!empty($where)) {
        $where .= " AND ft.payment_date BETWEEN '$start_date' AND '$end_date'";
    } else {
        $where .= " WHERE ft.payment_date BETWEEN '$start_date' AND '$end_date'";
    }
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
    $where 
    GROUP BY ft.receipt_number
    ORDER BY ft.feeid DESC
    LIMIT $limit OFFSET $offset
";
$fetch_transactions = mysqli_query($conn, $select_transaction);

if (isset($_POST['actionpdf']) && $_POST['actionpdf'] == 'pdf') {
    //PDF PHP CODES
    require('C:\xampp\htdocs\Library\Pdf\fpdf.php');
    $pdf = new FPDF();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->AddPage();
    $pdf->Cell(0, 10, 'Fee Payment History', 0, 1, 'C');
    if (!empty($search)) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Search: ' . htmlspecialchars($search), 0, 1);
    }
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'No', 1);
    $pdf->Cell(80, 10, 'Student Name', 1);
    $pdf->Cell(30, 10, 'Receipt No.', 1);
    $pdf->Cell(30, 10, 'Payment Date', 1);
    $pdf->Cell(40, 10, 'Amount', 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 12);
    $counter = 1;
    $pdftotal_amount = 0;
    while ($row = mysqli_fetch_assoc($fetch_transactions)) {
        $pdf->Cell(10, 10, $counter, 1);
        $pdf->Cell(80, 10, $row['sname'], 1);
        $pdf->Cell(30, 10, $row['receipt_number'], 1);
        $pdf->Cell(30, 10, $row['payment_date'], 1);
        $pdf->Cell(40, 10, 'Rs ' . number_format($row['total_amount']), 1);
        $pdf->Ln();
        $pdftotal_amount += $row['total_amount'];
        $counter++;
    }
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, 10, 'Total Amount', 1);
    $pdf->Cell(40, 10, 'Rs ' . number_format($pdftotal_amount), 1);
    $pdf->Output('D', 'fee_payment_history.pdf');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .limitforflex {
            display: flex;
            justify-content: space-between;
            width: 1200px;
        }

        .downlaodpdforexcell {
            /* margin-left: 20%; */
            display: flex;
        }
        .feepaidhistory_search-forflex{
            display: flex;
        }
    </style>
</head>

<body class="feepaidhistory_body">
    <?php include 'dashhead.php'; ?>

    <div class="feepaidhistory_maincontents">
        <div class="feepaidhistory_header">
            <h1>Fee Paid History</h1>
            <div class="feepaidhistory_search_bar">
                <form method="GET" action="feepaidhistory.php">
                    <div class="feepaidhistory_search-forflex">
                        <div>
                            <input type="text" name="search" placeholder="Search by student enroll, name, or receipt number" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        </div>
                        <div class="feepaid_search_bydate">
                            <input type="date" name="start_date" placeholder="Start Date" value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>">
                            <span>TO</span>
                            <input type="date" name="end_date" placeholder="End Date" value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>">
                        </div>
                        <div>
                            <button type="submit">Search</button>
                            <button type="button" onclick="window.location.href='feepaidhistory.php';">Reset</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="limitforflex">
            <div class="feepaidhistory_table_limit">
                <label>Table Limit</label>
                <form action="" method="GET" id="feepaidhistory_limit_form">

                    <div>
                        <input class="feepaidhistory_limit" id="feepaidhistory_limitid" type="text" name="limit" value="<?php echo isset($_GET['limit']) ? (int)$_GET['limit'] : 10; ?>">
                        <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit">SET</button>
                        <button type="button" onclick="resetLimit()">RESET</button>
                    </div>

                </form>
                <script>
                    function resetLimit() {
                        document.getElementById('feepaidhistory_limitid').value = 10;
                        document.getElementById('feepaidhistory_limit_form').submit();
                    }
                </script>
            </div>
            <div class="downlaodpdforexcell">
                <form action="" method="POST">
                    <input type="hidden" name="actionpdf" value="pdf">
                    <button type="submit">Download PDF</button>
                </form>
            </div>
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