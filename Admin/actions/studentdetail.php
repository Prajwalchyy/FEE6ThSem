<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .student-card {
            background-color: white;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            text-align: center;
        }
        .student-photo {
            width: 100px;
            height: 100px;
            background-color: lightgray;
            border-radius: 50%;
            margin: 0 auto 20px auto;
        }
        h2 {
            margin-bottom: 10px;
        }
        .student-info {
            text-align: left;
        }
        .student-info label {
            font-weight: bold;
        }
        .student-info p {
            margin: 5px 0;
        }
        .student-status {
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }
        .active-status {
            background-color: #28a745;
            color: white;
        }
        .inactive-status {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    <div class="student-card">
        <div class="student-photo">
            <!-- You can add an image here -->
        </div>
        <h2>Niraj Chaudhary</h2>

        <div class="student-info">
            <p><label>Enrollment Number:</label> 1</p>
            <p><label>Contact:</label> 9811111111</p>
            <p><label>Sex:</label> Male</p>
            <p><label>Batch Year:</label> 2081</p>
            <p><label>Program:</label> CSIT</p>
            <p><label>Total Fees:</label> Rs. 20,000.00</p>
            <p><label>Payment Plan:</label> Semester</p>

            <p>
                <label>Status:</label>
                <span class="student-status active-status">Active</span>
            </p>
        </div>
    </div>

</body>
</html>
