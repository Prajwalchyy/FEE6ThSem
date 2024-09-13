<!DOCTYPE html>
<html>
<head>
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
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }
        .form-group .radio-group {
            display: flex;
            align-items: center;
        }
        .form-group .radio-group label {
            margin-right: 20px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Student</h2>
    <form action="save_student.php" method="POST">
        <div class="form-group">
            <label for="enroll_no">Enroll No</label>
            <input type="text" id="enroll_no" name="enroll_no" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="parent_name">Parent Name</label>
            <input type="text" id="parent_name" name="parent_name" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="faculty">Faculty</label>
            <input type="text" id="faculty" name="faculty" required>
        </div>
        <div class="form-group">
            <label for="sex">Sex</label>
            <div class="radio-group">
                <input type="radio" id="male" name="sex" value="male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="sex" value="female" required>
                <label for="female">Female</label>
            </div>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" id="year" name="year" required>
        </div>
        <div class="form-group">
            <button type="submit">Save</button>
        </div>
    </form>
</div>

</body>
</html>
