<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="index.css">
   
</head>
<?php include 'dashhead.php'; ?>
<body class="Student_list_body">
    <div class="studentlist_maincontents">


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
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>