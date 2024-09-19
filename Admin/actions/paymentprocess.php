<?php

include '../db/connection.php';

if (isset($_GET['pay'])) {
    $id = mysqli_real_escape_string($conn, $_GET['pay']);
    $query = "SELECT * FROM student WHERE sid = '$id'";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Payment Process</title>
</head>
<body class="paymentprocess_body">
    <div class="paymentprocess_parentdiv">
        <h2>Fee Payment Process</h2>

        <section class="paymentprocess_studentinfo">
            <h3>Student Information</h3>
            <div class="paymentprocess_infogroup">
                <label>Name:</label>
                <span><?php echo htmlspecialchars($student['sname'])?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Contact:</label>
                <span>987654321</span>
            </div>
                <div class="paymentprocess_infogroup">
                <label>Sex:</label>
                <span>Male</span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Batch:</label>
                <span>2022</span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Faculty:</label>
                <span>CSIT</span>
            </div>
        </section>

        <section class="paymentprocess_feeinfo">
            <h3>Fee Information</h3>
            <div class="paymentprocess_infogroup">
                <label>Payment Plan:</label>
                <span>Yearly</span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Total Fee:</label>
                <span>$5000</span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Paid Fee:</label>
                <span>$3000</span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Remaining Fee:</label>
                <span>$2000</span>
            </div>
        </section>

        <section class="paymentprocess_pay">
            <h3>Payment Process</h3>
            <form method="POST" action="#">
                <div class="paymentprocess_inputgroup">
                    <label for="payment_date">Payment Date:</label>
                    <input type="date" class="paymentprocess_inputdate" id="payment_date" name="payment_date" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="paymentprocess_inputgroup">
                    <label for="amount">Amount to Pay:</label>
                    <input type="number" id="amount"class="paymentprocess_inputamount" name="amount" placeholder="Enter amount to pay" required>
                </div>
                <button type="submit" class="paymentprocess_inputpaybtn">Process Payment</button>
            </form>
        </section>
    </div>
</body>
</html>


