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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['student-name'];
    $contact = $_POST['contact'];
    $sex = $_POST['sex'];
    $faculty = $_POST['faculty'];

    $sql = "INSERT INTO Students (name, contact, sex, faculty) VALUES ('$name', '$contact', '$sex', '$faculty')";

    if ($conn->query($sql) === TRUE) {
        $student_id = $conn->insert_id; // Get the last inserted ID
        header("Location: admin.php?student_id=$student_id"); // Redirect to admin.php with student ID
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
    <title>Add Student</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Student</h1>
        <form id="student-form">
            <label for="student-name">Name:</label>
            <input type="text" id="student-name" name="student-name" required>

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>

            <label for="sex">Sex:</label>
            <select id="sex" name="sex" required>
                <option value="">Select Sex</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="faculty">Faculty:</label>
            <select id="sex" name="sex" required>
                <option value="">Select faculty</option>
                <option value="BCA">BCA</option>
                <option value="BIM">BIM</option>
                <option value="BBS">BBS</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('student-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const studentData = {
                name: document.getElementById('student-name').value,
                contact: document.getElementById('contact').value,
                sex: document.getElementById('sex').value,
                faculty: document.getElementById('faculty').value
            };

            // Save student data to local storage or send to server
            localStorage.setItem('studentData', JSON.stringify(studentData));
            alert('Student data saved successfully!');
            window.location.href = 'admin.html';  // Redirect to admin.html after submitting the form
        });
    </script>
</body>
</html>
