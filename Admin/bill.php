<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Bill</title>
    
    <style>
        body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-color: #f4f4f4;
}

.bill-container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.bill-header {
    text-align: center;
    margin-bottom: 20px;
}

.bill-header h1 {
    margin: 0;
    font-size: 24px;
}

.bill-header p {
    margin: 5px 0;
}

.bill-info {
    margin-bottom: 20px;
}

.bill-info p {
    margin: 5px 0;
}

.bill-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.bill-table th,
.bill-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.bill-table th {
    background-color: #f2f2f2;
}

.bill-total {
    text-align: right;
    font-size: 18px;
    margin-bottom: 20px;
}

.bill-footer {
    text-align: center;
    font-size: 14px;
    color: #777;
}

.print-btn {
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

.print-btn:hover {
    background-color: #45a049;
}

@media print {
    .print-btn {
        display: none;
    }
}

    </style>
</head>
<body>

<div class="bill-container" id="bill">
    <div class="bill-header">
        <h1>University Name</h1>
        <p>Address, City, ZIP</p>
        <p>Phone: (123) 456-7890 | Email: info@university.com</p>
    </div>

    <div class="bill-info">
        <p><strong>Bill To:</strong> Student Name</p>
        <p><strong>Student ID:</strong> 123456</p>
        <p><strong>Date:</strong> 22 September 2024</p>
        <p><strong>Receipt Code:</strong> RC-12345ABC</p>
    </div>

    <table class="bill-table">
        <thead>
            <tr>
                <th>Fee Category</th>
                <th>Total Fee</th>
                <th>Amount Paid</th>
                <th>Remaining Fee</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Program Fee</td>
                <td>$4000</td>
                <td>$3000</td>
                <td>$1000</td>
            </tr>
            <tr>
                <td>Other Fee</td>
                <td>$2000</td>
                <td>$1500</td>
                <td>$500</td>
            </tr>
            <tr>
                <td>Exam Fee</td>
                <td>$1000</td>
                <td>$1000</td>
                <td>$0</td>
            </tr>
        </tbody>
    </table>

    <div class="bill-total">
        <p><strong>Total Amount Due:</strong> $1500</p>
    </div>

    <div class="bill-footer">
        <p>Thank you for your payment!</p>
    </div>
</div>

<button class="print-btn" onclick="window.print()">Print Bill</button>

</body>
</html>
