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
    <style>

.paymentprocess_body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.paymentprocess_parentdiv {
    max-width: 500px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.paymentprocess_parentdiv h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #4CAF50; 
}

.paymentprocess_parentdiv h3 {
    color: #4CAF50; 
    margin-bottom: 10px;
}

.paymentprocess_parentdiv section {
    margin-bottom: 20px;
    padding: 20px; 
    background-color: #f0f0f0;
    border-radius: 8px; 
}

.paymentprocess_infogroup {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.paymentprocess_parentdiv label {
    font-weight: bold;
}

.paymentprocess_parentdiv span {
    color: #333;
    background-color: #fff;
    padding: 5px;
    border-radius: 4px;
    font-size: 14px;
}

.paymentprocess_inputgroup {
    margin-bottom: 15px;
}

.paymentprocess_inputdate,
.paymentprocess_inputamount,
.paymentprocess_inputpaybtn {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc; 
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.paymentprocess_inputdate:focus,
.paymentprocess_inputamount:focus,
.paymentprocess_inputpaybtn:focus {
    border-color: #4CAF50; 
    outline: none;
}

.paymentprocess_inputpaybtn {
    background-color: #4CAF50; 
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.paymentprocess_inputpaybtn:hover {
    background-color: #45a049;
}
    </style>
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
                <span>9876543210</span>
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


