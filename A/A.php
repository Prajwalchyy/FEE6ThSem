<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1 {
            text-align: left;
            color: #333;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .search-container input, .search-container select, .search-container button {
            padding: 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-container button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .search-container button.reset {
            background-color: #dc3545;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        table th {
            background-color: #f8f8f8;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Fees</h1>
        <div class="search-container">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Enter name">
            </div>
            <div>
                <label for="date">Date Of Joining</label>
                <input type="text" id="date" placeholder="Enter date">
            </div>
            <div>
                <label for="grade">Grade</label>
                <select id="grade">
                    <option>Select Grade</option>
                    <option>Grade 1</option>
                    <option>Grade 2</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <button>Filter</button>
            <button class="reset">Reset</button>
        </div>

        <div class="table-container">
            <h2>Manage Fees</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name/Contact</th>
                        <th>Fees</th>
                        <th>Balance</th>
                        <th>Grade</th>
                        <th>DOJ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Christine Moore<br>7566969650</td>
                        <td>3660</td>
                        <td>2160</td>
                        <td>Junior/11th Grade</td>
                        <td>14 Feb 20</td>
                        <td><button>Collect Fee</button></td>
                    </tr>
                    <tr>
                        <td>Leo Maxwell<br>7563690002</td>
                        <td>5120</td>
                        <td>2620</td>
                        <td>8th Grade</td>
                        <td>14 Jan 21</td>
                        <td><button>Collect Fee</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
