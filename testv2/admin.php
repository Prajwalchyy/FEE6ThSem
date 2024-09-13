<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_GET['student_id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalFee = $_POST['total-fee'];
    $feeType = $_POST['fee-type'];
    $year1Fee = $_POST['year1-fee'] ?? NULL;
    $year2Fee = $_POST['year2-fee'] ?? NULL;
    $year3Fee = $_POST['year3-fee'] ?? NULL;
    $year4Fee = $_POST['year4-fee'] ?? NULL;
    $semester1Fee = $_POST['semester1-fee'] ?? NULL;
    $semester2Fee = $_POST['semester2-fee'] ?? NULL;
    $semester3Fee = $_POST['semester3-fee'] ?? NULL;
    $semester4Fee = $_POST['semester4-fee'] ?? NULL;
    $semester5Fee = $_POST['semester5-fee'] ?? NULL;
    $semester6Fee = $_POST['semester6-fee'] ?? NULL;
    $semester7Fee = $_POST['semester7-fee'] ?? NULL;
    $semester8Fee = $_POST['semester8-fee'] ?? NULL;

    $sql = "INSERT INTO Fees (student_id, total_fee, fee_type, year1_fee, year2_fee, year3_fee, year4_fee, semester1_fee, semester2_fee, semester3_fee, semester4_fee, semester5_fee, semester6_fee, semester7_fee, semester8_fee) 
            VALUES ('$student_id', '$totalFee', '$feeType', '$year1Fee', '$year2Fee', '$year3Fee', '$year4Fee', '$semester1Fee', '$semester2Fee', '$semester3Fee', '$semester4Fee', '$semester5Fee', '$semester6Fee', '$semester7Fee', '$semester8Fee')";

    if ($conn->query($sql) === TRUE) {
        echo "Fee data saved successfully";
        // Optionally, redirect or clear the form
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Fee Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .dynamic-inputs label {
            margin-top: 0;
        }

        .dynamic-inputs {
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .button-container button {
            width: 48%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Fee Management</h1>
        <form id="fee-form">
            <label for="total-fee">Total Fee:</label>
            <input type="number" id="total-fee" name="total-fee" required>

            <label for="fee-type">Fee Type:</label>
            <select id="fee-type" name="fee-type" required>
                <option value="">Select Fee Type</option>
                <option value="yearly">Yearly</option>
                <option value="semester">Semester</option>
            </select>

            <div id="dynamic-inputs" class="dynamic-inputs"></div>

            <div class="button-container">
                <button type="button" id="automatic-button">Automatic</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('fee-type').addEventListener('change', function() {
            const feeType = this.value;
            const dynamicInputs = document.getElementById('dynamic-inputs');
            dynamicInputs.innerHTML = '';

            if (feeType === 'yearly') {
                for (let i = 1; i <= 4; i++) {
                    dynamicInputs.innerHTML += `
                        <label for="year${i}-fee">Year ${i} Fee:</label>
                        <input type="number" id="year${i}-fee" name="year${i}-fee" required>
                    `;
                }
            } else if (feeType === 'semester') {
                for (let i = 1; i <= 8; i++) {
                    dynamicInputs.innerHTML += `
                        <label for="semester${i}-fee">Semester ${i} Fee:</label>
                        <input type="number" id="semester${i}-fee" name="semester${i}-fee" required>
                    `;
                }
            }
        });

        document.getElementById('automatic-button').addEventListener('click', function() {
            const totalFee = parseFloat(document.getElementById('total-fee').value);
            const feeType = document.getElementById('fee-type').value;

            if (isNaN(totalFee) || !feeType) {
                alert('Please enter a valid total fee and select a fee type.');
                return;
            }

            let periods;
            if (feeType === 'yearly') {
                periods = 4;
            } else if (feeType === 'semester') {
                periods = 8;
            } else {
                return;
            }

            const dividedFee = totalFee / periods;

            for (let i = 1; i <= periods; i++) {
                const feeInput = document.getElementById(`${feeType === 'yearly' ? 'year' : 'semester'}${i}-fee`);
                if (feeInput) {
                    feeInput.value = dividedFee.toFixed(2);
                }
            }
        });

        document.getElementById('fee-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const feeType = document.getElementById('fee-type').value;
            const totalFee = document.getElementById('total-fee').value;
            const feeData = { feeType: feeType, totalFee: totalFee };

            if (feeType === 'yearly') {
                for (let i = 1; i <= 4; i++) {
                    feeData[`year${i}Fee`] = document.getElementById(`year${i}-fee`).value;
                }
            } else if (feeType === 'semester') {
                for (let i = 1; i <= 8; i++) {
                    feeData[`semester${i}Fee`] = document.getElementById(`semester${i}-fee`).value;
                }
            }

            localStorage.setItem('feeData', JSON.stringify(feeData));
            alert('Fee data saved successfully!');
        });
    </script>
</body>
</html>
