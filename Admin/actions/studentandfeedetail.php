<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Fee Details</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
     <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.student-info {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h2 {
    color: #444;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f1f1f1;
}

a {
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

     </style>
</head>
<body>
    <div class="container">
        <h1>Student Fee Details</h1>

        <div class="student-info">
            <h2>Student Information</h2>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Student ID:</strong> 123456</p>
            <p><strong>Program:</strong> Computer Science</p>
            <p><strong>Total Fee:</strong> $10,000</p>
            <p><strong>Remaining Fee:</strong> $4,000</p>
        </div>

        <h2>Payment History</h2>
        <table>
            <thead>
                <tr>
                    <th>Receipt Number</th>
                    <th>Payment Date</th>
                    <th>Category</th>
                    <th>Amount Paid</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>RC-001</td>
                    <td>2024-09-01</td>
                    <td>Program Fee</td>
                    <td>$5,000</td>
                    <td><a href="detail.php?receipt=RC-001">View Details</a></td>
                </tr>
                <tr>
                    <td>RC-002</td>
                    <td>2024-09-15</td>
                    <td>Exam Fee</td>
                    <td>$2,000</td>
                    <td><a href="detail.php?receipt=RC-002">View Details</a></td>
                </tr>
                <tr>
                    <td>RC-003</td>
                    <td>2024-09-20</td>
                    <td>Program Fee</td>
                    <td>$1,000</td>
                    <td><a href="detail.php?receipt=RC-003">View Details</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
