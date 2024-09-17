<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .student-container {
            background-color: white;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .student-photo {
            float: right;
            width: 120px;
            height: 120px;
            background-color: lightgray;
            border-radius: 50%;
        }
        .student-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .student-info div {
            width: 45%;
            margin-bottom: 15px;
        }
        .student-info label {
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }
        .student-status {
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .status-active {
            background-color: #28a745;
            color: white;
        }
        .status-inactive {
            background-color: #dc3545;
            color: white;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .toggle-status-btn, .print-btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .toggle-status-btn {
            background-color: #007bff;
            color: white;
            margin-right: 10px;
        }
        .print-btn {
            background-color: #28a745;
            color: white;
        }
        .print-btn:hover {
            background-color: #218838;
        }
        @media print {
            .btn-container {
                display: none;
            }
            .student-photo {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="student-container">
        <div class="student-photo">
            <!-- Photo placeholder -->
        </div>
        <h1>Student Information</h1>

        <div class="student-info">
            <div>
                <label>Full Name:</label>
                <p>Niraj Chaudhary</p>
            </div>
            <div>
                <label>Enrollment Number:</label>
                <p>1</p>
            </div>
            <div>
                <label>Contact Number:</label>
                <p>9811111111</p>
            </div>
            <div>
                <label>Sex:</label>
                <p>Male</p>
            </div>
            <div>
                <label>Batch Year:</label>
                <p>2081</p>
            </div>
            <div>
                <label>Program:</label>
                <p>CSIT</p>
            </div>
            <div>
                <label>Total Fees:</label>
                <p>Rs. 20,000.00</p>
            </div>
            <div>
                <label>Payment Plan:</label>
                <p>Semester</p>
            </div>
            <div>
                <label>Status:</label>
                <p>
                    <span id="student-status" class="student-status status-active">Active</span>
                </p>
            </div>
        </div>

        <div class="btn-container">
            <button class="toggle-status-btn" onclick="toggleStatus()">Toggle Status</button>
            <button class="print-btn" onclick="window.print()">Print</button>
        </div>
    </div>

    <script>
        function toggleStatus() {
            var statusElement = document.getElementById('student-status');
            if (statusElement.classList.contains('status-active')) {
                statusElement.classList.remove('status-active');
                statusElement.classList.add('status-inactive');
                statusElement.innerText = 'Inactive';
            } else {
                statusElement.classList.remove('status-inactive');
                statusElement.classList.add('status-active');
                statusElement.innerText = 'Active';
            }
        }
    </script>

</body>
</html>
