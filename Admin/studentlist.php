<?php
include 'db/connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// if (isset($_POST['studentdetail'])) {
//     $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
//     $_SESSION['pay_student_id'] = $fetch_students;
//     header('Location: actions/studentfeedetail.php');
//     exit();
// }


if (isset($_POST['studentdetailbtn'])) {
    $_SESSION['detail_student_id'] = $_POST['studentdetailinput'];
        header('Location: actions/studentandfeedetail.php');
    exit();
}



$where = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where = "WHERE sname LIKE '%$search%' OR senroll LIKE '%$search%' OR scontact LIKE '%$search%'";
}


$default_limit = 10;

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : $default_limit;

if ($limit < 1) {
    $limit = $default_limit;
}




$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $limit;



$counter = ($page - 1) * $limit + 1;
// $total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM student $where");
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM student $where");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);


$sort_order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'asc' : 'desc';
$new_sort_order = $sort_order === 'asc' ? 'desc' : 'asc';



// $select_student = "SELECT * FROM student
// JOIN program ON student.pid = program.pid
// $where ORDER BY senroll LIMIT $limit OFFSET $offset";
$select_student = "SELECT * FROM student
JOIN program ON student.pid = program.pid
$where ORDER BY CAST(senroll AS UNSIGNED) DESC LIMIT $limit OFFSET $offset";
$fetch_students = mysqli_query($conn, $select_student);
?>

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
                <form method="GET" action="studentlist.php">
                    <input type="text" name="search" placeholder="Search by enroll, name or contact"
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit">Search</button>
                    <button type="button" onclick="window.location.href='studentlist.php';">Reset</button>
                </form>
            </div>

            <a href="studentadd.php">Add student</a>
        </div>
        <div class="studentlist_table_limit">
            <label>Table Limit</label>
            <form action="" method="GET" id="studentlist_limit_form">
                <input class="studentlist_limit" id="studentlist_limitid" type="text" name="limit" value="<?php echo isset($_GET['limit']) ? (int)$_GET['limit'] : 10; ?>">
                <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">SET</button>
                <button type="button" onclick="resetLimit()">RESET</button>
            </form>
            <script>
                function resetLimit() {
                    document.getElementById('studentlist_limitid').value = 10;
                    document.getElementById('studentlist_limit_form').submit();
                }
            </script>
        </div>

        <div class="studentlist_table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Enroll No</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Batch</th>
                        <th>Faculty</th>
                        <th>Action</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($fetch_students)) {
                    ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $row['senroll']; ?></td>
                            <td><?php echo $row['sname']; ?></td>
                            <td><?php echo $row['scontact']; ?></td>
                            <td><?php echo $row['sbatchyear']; ?></td>
                            <td><?php echo $row['pname']; ?></td>
                            <td class="studentlist_action_buttons">
                                <a href="actions/studentupdate.php?update=<?php echo $row['sid']; ?>" class="studentlist_update">Update</a>
                                <a href="actions/studentdelete.php?delete=<?php echo $row['sid']; ?>" class="studentlist_delete" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                            </td>
                            <td>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="studentdetailinput" value="<?php echo $row['sid']; ?>">
                                    <button type="submit" name="studentdetailbtn" class="studentlist_detail">Detail</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <div class="studentlist_pagination">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>&limit=<?php echo $limit; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>&limit=<?php echo $limit; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages) : ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>&limit=<?php echo $limit; ?>">Next</a>
            <?php endif; ?>
        </div>

    </div>

</body>

</html>