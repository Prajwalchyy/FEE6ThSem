<?php
include 'dbconn/connection.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header('Location: slogin.php');
    exit();
}

$student_id = $_SESSION['student_id'];

$student_name_fetch = "SELECT * FROM student WHERE sid = '$student_id'";
$student_name_result = mysqli_query($conn, $student_name_fetch);
$student_name_fetchresult = mysqli_fetch_assoc($student_name_result);


$query_totalfee_paid = "SELECT SUM(amount) as program_fee_paid FROM fee_transaction WHERE sid = '$student_id' AND feecategory = 'ProgramFee'";
$result_totalfee_paid = mysqli_query($conn, $query_totalfee_paid);
if ($result_totalfee_paid) {
    $row_totalfee_paid = mysqli_fetch_assoc($result_totalfee_paid);
    $program_totalfee_paid = $row_totalfee_paid['program_fee_paid'] ?? 0; 
}


$query_additional_fee = "SELECT SUM(amount) as additional_fee_paid FROM fee_transaction WHERE sid = '$student_id' AND feecategory != 'ProgramFee'";
$result_additional_fee = mysqli_query($conn, $query_additional_fee);
if ($result_additional_fee) {
    $row_additional_fee = mysqli_fetch_assoc($result_additional_fee);
    $additional_fee_paid = $row_additional_fee['additional_fee_paid'] ?? 0;
}



$query_total_transactions = "SELECT COUNT(DISTINCT receipt_number) as total_transaction FROM fee_transaction WHERE sid = '$student_id'";
$result_total_transactions = mysqli_query($conn, $query_total_transactions);

if ($result_total_transactions) {
    $row_total_transactions = mysqli_fetch_assoc($result_total_transactions);
    $total_transaction = $row_total_transactions['total_transaction'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="sindex.css">
</head>

<body class="dashview_body">
    <?php include 'sdashhead.php'; ?>
    <div class="dashview_dashboard">
        <h1 class="dashview_dashboard-title">WELCOME STUDENT</h1>

        <div class="dashview_card admin-card">
            <h2>Student Name</h2>
            <p id="Studentname"><?php echo $student_name_fetchresult['sname']; ?></p>
        </div>

        <div class="dashview_cards-container">
            <div class="dashview_card">
                <h2>Program Fee Paid</h2>
                <p id="programfeepaid"><?php echo  number_format($program_totalfee_paid); ?></p>
            </div>
            <div class="dashview_card">
                <h2>Additional Fee Paid</h2>
                <p id="Additionalfeepaid"><?php echo  number_format($additional_fee_paid); ?></p>
            </div>
            <div class="dashview_card">
                <h2>Total Transaction</h2>
                <p id="Totaltransaction"><?php echo  $total_transaction; ?></p>
            </div>
        </div>

        <div class="dashview_time-container">
            <h2 id="currentTime"></h2>
        </div>


    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            document.getElementById('currentTime').textContent = now.toLocaleTimeString([], options);
        }

        setInterval(updateTime, 1000); 
        updateTime(); 
    </script>
</body>

</html>