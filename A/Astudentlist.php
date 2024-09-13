<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
        }
        .update {
            background-color: #2196F3;
            color: white;
        }
        .delete {
            background-color: #f44336;
            color: white;
        }
        .detail {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Student List</h1>
    <a href="add_student.php">Add Student</a>
</div>

<div class="student-table">
    <table>
        <thead>
            <tr>
                <th>Enroll No</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Sex</th>
                <th>Faculty</th>
                <th>Action</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>12345</td>
                <td>John Doe</td>
                <td>123-456-7890</td>
                <td>Male</td>
                <td>Science</td>
                <td class="action-buttons">
                    <a href="update_student.php?id=12345" class="update">Update</a>
                    <a href="delete_student.php?id=12345" class="delete">Delete</a>
                </td>
                <td>
                    <a href="detail_student.php?id=12345" class="detail">Detail</a>
                </td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Jane Smith</td>
                <td>987-654-3210</td>
                <td>Female</td>
                <td>Arts</td>
                <td class="action-buttons">
                    <a href="update_student.php?id=67890" class="update">Update</a>
                    <a href="delete_student.php?id=67890" class="delete">Delete</a>
                </td>
                <td>
                    <a href="detail_student.php?id=67890" class="detail">Detail</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
