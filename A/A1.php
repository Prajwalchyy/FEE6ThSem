<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fee Management Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Fee Management Form</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="type">Select Type:</label>
            <select id="type" name="type" onchange="this.form.submit()">
                <option value="">--Select--</option>
                <option value="yearly" <?php if(isset($_POST['type']) && $_POST['type'] == 'yearly') echo 'selected'; ?>>Yearly</option>
                <option value="semester" <?php if(isset($_POST['type']) && $_POST['type'] == 'semester') echo 'selected'; ?>>Semester</option>
            </select>
        </div>

        <?php if(isset($_POST['type']) && $_POST['type'] == 'yearly'): ?>
            <div class="form-group">
                <label for="year1">Year 1:</label>
                <input type="text" id="year1" name="year1">
            </div>
            <div class="form-group">
                <label for="year2">Year 2:</label>
                <input type="text" id="year2" name="year2">
            </div>
            <div class="form-group">
                <label for="year3">Year 3:</label>
                <input type="text" id="year3" name="year3">
            </div>
            <div class="form-group">
                <label for="year4">Year 4:</label>
                <input type="text" id="year4" name="year4">
            </div>
        <?php elseif(isset($_POST['type']) && $_POST['type'] == 'semester'): ?>
            <div class="form-group">
                <label for="semester1">Semester 1:</label>
                <input type="text" id="semester1" name="semester1">
            </div>
            <div class="form-group">
                <label for="semester2">Semester 2:</label>
                <input type="text" id="semester2" name="semester2">
            </div>
            <div class="form-group">
                <label for="semester3">Semester 3:</label>
                <input type="text" id="semester3" name="semester3">
            </div>
            <div class="form-group">
                <label for="semester4">Semester 4:</label>
                <input type="text" id="semester4" name="semester4">
            </div>
            <div class="form-group">
                <label for="semester5">Semester 5:</label>
                <input type="text" id="semester5" name="semester5">
            </div>
            <div class="form-group">
                <label for="semester6">Semester 6:</label>
                <input type="text" id="semester6" name="semester6">
            </div>
            <div class="form-group">
                <label for="semester7">Semester 7:</label>
                <input type="text" id="semester7" name="semester7">
            </div>
            <div class="form-group">
                <label for="semester8">Semester 8:</label>
                <input type="text" id="semester8" name="semester8">
            </div>
        <?php endif; ?>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
