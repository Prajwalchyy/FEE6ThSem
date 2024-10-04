<?php
include '../db/connection.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['receipt_databtn'])) {
    $_SESSION['receipt_number'] = $_POST['receipt_number'];
    header('Location: receipt.php');
}


if (isset($_SESSION['detail_student_id'])) {
    $student_iid = $_SESSION['detail_student_id'];


    $select_student = "SELECT * FROM student
    JOIN program ON student.pid = program.pid 
    WHERE sid = $student_iid";
    $student_info_result = mysqli_query($conn, $select_student);
    $student_info = mysqli_fetch_assoc($student_info_result);


    $select_transaction = "
     SELECT ft.receipt_number, SUM(ft.amount) AS total_amount, MAX(ft.payment_date) AS payment_date, s.senroll, s.sname
    FROM fee_transaction ft
    JOIN student s ON ft.sid = s.sid
    WHERE ft.sid = '$student_iid'
    GROUP BY ft.receipt_number
    ORDER BY ft.feeid DESC
";
    $transaction_result = mysqli_query($conn, $select_transaction);
}

$counter = 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Fee Details</title>
    <!-- <link rel="stylesheet" href="../index.css"> -->

    <style>
        .standfe_body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        /* Container for the main content */
        .standfe_container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Heading style */
        .standfe_h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Styling for the student information section */
        .standfe_detail {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #ffffff;
        }

        .standfe_detail h2 {
            color: #444;
            margin-bottom: 10px;
        }

        /* Table styles */
        .standfe_table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        /* Table header styles */
        .standfe_table th,
        .standfe_table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .standfe_table th {
            background-color: #f2f2f2;
            color: #333;
        }

        /* Hover effect for table rows */
        .standfe_table tr:hover {
            background-color: #f1f1f1;
        }

        /* Styling for the detail button */
        .standfe_feepaidhistory_detail {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .standfe_feepaidhistory_detail:hover {
            background-color: #0056b3;
        }

        .standfe_feepaidhistory_detail:focus {
            outline: none;
        }


        .back_btn {
            background-color: #343A40;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            min-width: 100px;
            height: 36px;
            text-transform: uppercase;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .back_btn:hover {
            background-color: #23272b;
        }


        .inactive_btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            min-width: 100px;
            height: 36px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            opacity: 0.9;
        }

        .inactive_btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body class="standfe_body">
    <div class="standfe_container">
        <button type="button" class="back_btn" onclick="confirmBack()">Back</button>
        <h1 class="standfe_h1">Student Transaction Details</h1>

        <script>
            function confirmBack() {
                if (confirm("Are you sure you want to go back?")) {
                    window.location.href = '../studentlist.php';
                }
            }
        </script>


        <div class="standfe_detail">
            <h2 class="standfe_h2">Student Information</h2>
            <p><strong>Enroll No:</strong><?php echo $student_info['senroll'] ?></p>
            <p><strong>Name:</strong> <?php echo $student_info['sname'] ?></p>
            <p><strong>Program:</strong> <?php echo $student_info['pname'] ?></p>
            <p><strong>Batch:</strong> <?php echo $student_info['sbatchyear'] ?></p>
            <button type="button" class="inactive_btn">Inactive Student</button>
        </div>
        <h2 class="standfe_h2">Payment History</h2>
        <table class="standfe_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Receipt Number</th>
                    <th>Payment Date</th>
                    <th>Amount Paid</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($transaction = mysqli_fetch_assoc($transaction_result)) {
                ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $transaction['receipt_number']; ?></td>
                        <td><?php echo $transaction['payment_date']; ?></td>
                        <td>Rs <?php echo number_format($transaction['total_amount']); ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="receipt_number" value="<?php echo $transaction['receipt_number']; ?>">
                                <button type="submit" name="receipt_databtn" class="standfe_feepaidhistory_detail">Detail</button>
                            </form>
                        </td>
                    </tr>
                <?php
                    $counter++;
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>