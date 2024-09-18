<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Payment</title>
    <style>
        :root {
    --primary-color: #4CAF50;
    --background-color: #f9f9f9;
    --text-color: #333;
    --input-border-color: #ccc;
    --input-focus-border-color: #4CAF50;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
}

.payment-container {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: var(--primary-color);
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--input-border-color);
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="number"]:focus,
select:focus {
    border-color: var(--input-focus-border-color);
}

.submit-btn {
    width: 100%;
    background-color: var(--primary-color);
    color: #fff;
    padding: 10px;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #45a049;
}

    </style>
    <!-- <link rel="stylesheet" href="feepayment.css"> -->
</head>
<body>
    <div class="payment-container">
        <h2>Fee Payment</h2>

        <form method="POST" action="#">

            <div class="input-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" placeholder="Enter your student ID" required>
            </div>

            <div class="input-group">
                <label for="program">Program</label>
                <select id="program" name="program" required>
                    <option value="">Select Program</option>
                    <option value="bbs">BBS</option>
                    <option value="csit">CSIT</option>
                </select>
            </div>

            <div class="input-group">
                <label for="total_fee">Total Fee</label>
                <input type="text" id="total_fee" name="total_fee" placeholder="Total fee" readonly>
            </div>

            <div class="input-group">
                <label for="amount_paid">Amount to Pay</label>
                <input type="number" id="amount_paid" name="amount_paid" placeholder="Enter amount" required>
            </div>

            <div class="input-group">
                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="card_payment">Card Payment</option>
                    <option value="cash">Cash</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Submit Payment</button>
        </form>
    </div>
</body>
</html>
