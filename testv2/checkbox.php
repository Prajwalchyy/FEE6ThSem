<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Example</title>
</head>
<body>

<form method="POST" action="your-action-page.php">
    <label>
        <input type="checkbox" name="fee_categories[]" value="Transportation">
        Transportation
    </label><br>

    <label>
        <input type="checkbox" name="fee_categories[]" value="Exam Fee">
        Exam Fee
    </label><br>

    <label>
        <input type="checkbox" name="fee_categories[]" value="Others">
        Others
    </label><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>
