<?php
session_start();

include 'dbconn/connection.php';


if (!isset($_SESSION['student_id'])) {
    header('Location: slogin.php');
    exit();
}
// $receipt_number = isset($_GET['receiptfetcher']) ? mysqli_real_escape_string($conn, $_GET['receiptfetcher']) : '';
$receipt_number = isset($_SESSION['receipt_number']) ? mysqli_real_escape_string($conn, $_SESSION['receipt_number']) : '';

$query = "
    SELECT s.sname, s.senroll, ft.payment_date, ft.receipt_number, p.pbased, SUM(ft.amount) AS total_due
    FROM fee_transaction ft 
    JOIN student s ON ft.sid = s.sid 
    JOIN program p ON s.pid = p.pid 
    WHERE ft.receipt_number = '$receipt_number'
    GROUP BY s.sname, s.senroll, ft.payment_date, ft.receipt_number, p.pbased
    LIMIT 1
";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);


$fee_query = "
    SELECT * 
    FROM fee_transaction 
    WHERE receipt_number = '$receipt_number'
";


$fee_result = mysqli_query($conn, $fee_query);


$total_fee_query = "
    SELECT mf.mfeecategory, mf.amount AS total_fee 
    FROM morefee mf
    JOIN student s ON s.sid = mf.sid
    WHERE s.sid = (SELECT sid FROM fee_transaction WHERE receipt_number = '$receipt_number' LIMIT 1)
";
$total_fee_result = mysqli_query($conn, $total_fee_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Bill</title>
    <style>
        .receipt_body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .receipt_container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .receipt_head {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt_head h1 {
            margin: 0;
            font-size: 24px;
        }

        .receipt_head p {
            margin: 5px 0;
        }

        .receipt_info {
            margin-bottom: 20px;
        }

        .receipt_info p {
            margin: 5px 0;
        }

        .receipt_table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .receipt_table th,
        .receipt_table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .receipt_table th {
            background-color: #f2f2f2;
        }

        .receipt_total {
            text-align: right;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .receipt_footer {
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .receipt_print-btn {
            display: block;
            width: 150px;
            padding: 10px;
            margin: 20px auto;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .receipt_print-btn:hover {
            background-color: #45a049;
        }

        @media print {
            .receipt_print-btn {
                display: none;
            }
        }
    </style>
</head>

<body class="receipt_body">

    <div class="receipt_container" id="receipt">
        <div class="receipt_head">
            <h1>EXAMPLE UNIVERSITY</h1>
            <p>Address, City, ZIP</p>
            <p>Phone: 9876543210 | Email: exampleinfo@university.com</p>
        </div>

        <div class="receipt_info">
            <p><strong>Bill To:</strong> <?php echo $row['sname']; ?></p>
            <p><strong>Enroll no:</strong> <?php echo $row['senroll']; ?></p>
            <p><strong>Payment Date:</strong> <?php echo $row['payment_date']; ?></p>
            <p><strong>Receipt Number:</strong> <?php echo $row['receipt_number']; ?></p>
            <p><strong>Payment Plan:</strong> <?php echo $row['pbased']; ?></p>

        </div>

        <table class="receipt_table">
            <thead>
                <tr>
                    <th>Fee Category</th>
                    <th>Total Fee</th>
                    <th>Amount Paid</th>
                    <th>Remaining Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fee_row = mysqli_fetch_assoc($fee_result)) {
                    $feeremaining = $fee_row['fee_fetchtotal'] - $fee_row['amount'];
                ?>
                    <tr>
                        <td><?php echo $fee_row['feecategory']; ?></td>
                        <td><?php echo $fee_row['fee_fetchtotal']; ?></td>
                        <td><?php echo $fee_row['amount']; ?></td>
                        <td><?php echo $feeremaining; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="receipt_total">
            <p><strong>Total Amount Due:</strong> <?php echo $row['total_due']; ?></p>
        </div>

        <div class="receipt_footer">
            <p>Thank you for your payment!</p>
        </div>
    </div>

    <button class="receipt_print-btn" onclick="window.print()">Print Bill</button>

    <button type="button" class="receipt_print-btn" onclick="confirmBack()">Back</button>

    <script>
        function confirmBack() {
            if (confirm("Are you sure you want to go back? Any unsaved changes will be lost.")) {
                // window.location.href = 'sreceipthistory.php';
                window.location.href = document.referrer;
            }
        }
    </script>


</body>

</html>