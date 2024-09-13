
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .studentlist_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .studentlist_header h1 {
            margin: 0;
        }

        .student_search_bar {
            display: flex;
            align-items: center;
        }

        .student_search_bar input {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .student_search_bar button {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .studentlist_header a {
            text-decoration: none;
            color: white;
            background-color: #375d5e;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .studentlist_table table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .studentlist_table th, .studentlist_table td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .studentlist_table th {
            background-color: #f8f8f8;
        }

        .studentlist_table tr:hover {
            background-color: #f1f1f1;
        }

        .studentlist_action_buttons a {
            text-decoration: none;
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 3px;
        }

        .studentlist_update {
            background-color: #007bff;
            color: white;
        }

        .studentlist_delete {
            background-color: #dc3545;
            color: white;
        }

        .studentlist_detail {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="studentlist_header">
        <h1>Student List</h1>
        <div class="student_search_bar">
            <input type="text" placeholder="Search students...">
            <button type="button">Search</button>
        </div>
        <a href="">Add student</a>
    </div>

    <div class="studentlist_table">
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
                    <td>1</td>
                    <td>ABCDEFGH IJKLM</td>
                    <td>1234567890</td>
                    <td>Male</td>
                    <td>Science</td>
                    <td class="studentlist_action_buttons">
                        <a href="#" class="studentlist_update">Update</a>
                        <a href="#" class="studentlist_delete">Delete</a>
                    </td>
                    <td>
                        <a href="#" class="studentlist_detail">Detail</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>B</td>
                    <td>0987654321</td>
                    <td>Female</td>
                    <td>Arts</td>
                    <td class="studentlist_action_buttons">
                        <a href="#" class="studentlist_update">Update</a>
                        <a href="#" class="studentlist_delete">Delete</a>
                    </td>
                    <td>
                        <a href="#" class="studentlist_detail">Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
