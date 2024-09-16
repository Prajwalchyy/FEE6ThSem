<?php include 'db/connection.php';

//search query
$where = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    // $where = "WHERE pname LIKE '%$search%' OR ecategorydetail LIKE '%$search%'";
    $where = "WHERE pname LIKE '%$search%'";
}


//page table limit
$default_limit = 5;

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : $default_limit;

if ($limit < 1) {
    $limit = $default_limit;
}



//limit logic of table
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $limit;


//COUNT 
$counter = ($page - 1) * $limit + 1;
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM program $where");
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

$total_pages = ceil($total_records / $limit);


// sorting logic
$sort_order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'asc' : 'desc';
$new_sort_order = $sort_order === 'asc' ? 'desc' : 'asc';


//fetching
// $select = "SELECT * FROM program $where ORDER BY pname $sort_order LIMIT $limit OFFSET $offset";
$select = "SELECT * FROM program $where ORDER BY pname LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Category</title>
    <link rel="stylesheet" href="index.css">
</head>
<?php include 'dashhead.php'; ?>

<body class="faculty_body">
    <div class="faculty_contents">
        <div class="faculty_header">
            <div class="faculty_heading">
                <h1>Programs</h1>
            </div>
            <div class="faculty_search">
                <form action="" method="GET">
                    <input type="text" name="search" placeholder="Search program..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit">Search</button>
                    <button type="button" onclick="window.location.href='faculty.php';">Reset</button>
                </form>
            </div>

            <div class="faculty_add">
                <a href="addfaculty.php">Add program</a>
            </div>
        </div>
        <div class="faculty_table_limit">
            <label>Table Limit</label>
            <form id="facultyLimitForm" action="" method="GET">
                <input class="faculty_limit" type="text" id="facultyLimitInput" name="limit" value="<?php echo isset($_GET['limit']) ? (int)$_GET['limit'] : 5; ?>">
                <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">SET</button>
                <button type="button" onclick="resetFacultyLimit()">RESET</button>
            </form>

            <script>
                function resetFacultyLimit() {
                    document.getElementById('facultyLimitInput').value = 5;
                    document.getElementById('facultyLimitForm').submit();
                }
            </script>
        </div>
        <div class="faculty_table">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th><a href="?page=<?php echo $page; ?>&limit=<?php echo $limit; ?>&order=<?php echo $new_sort_order; ?>&search=<?php echo isset($_GET['search']) ? urlencode($_GET['search']) : ''; ?>">
                                Name
                            </a>
                        </th>

                        <th>Full Name</th>
                        <th>Based</th>
                        <th>Year</th>
                        <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo htmlspecialchars($row["pname"]); ?></td>
                            <td><?php echo htmlspecialchars($row["pfullname"]); ?></td>
                            <td><?php echo htmlspecialchars($row["pbased"]); ?></td>
                            <td><?php echo htmlspecialchars($row["pyear"]); ?></td>
                            <td class="faculty_action_buttons">
                                <a href="actions/facultyUpdate.php?update=<?php echo $row['pid']; ?>" class="faculty_update">Update</a>
                                <a href="actions/facultyDelete.php?delete=<?php echo $row['pid']; ?>" class="faculty_delete" onclick="return confirm('Are you sure you want to delete this faculty?');">Delete</a>
                            </td>
                        </tr>
                    <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="faculty_pagination">
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