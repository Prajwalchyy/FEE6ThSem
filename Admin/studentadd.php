<?php include 'db/connection.php';

//fetch program
$fetch_programnames = "SELECT pname FROM program ORDER BY pname ASC";
$program_result = mysqli_query($conn, $fetch_programnames);

?>

<html>

<head>
  <title>Add Student</title>
  <link rel="stylesheet" href="index.css">
</head>

<body class="addstudent_body">
  <div class="addstudent_contents">

    <h2>ADD NEW STUDENT</h2>

    <p>Student Information</p>
    <form method="post" action="#">

      <label for="symbol_number">Symbol Number:</label>
      <input type="text" id="symbol_number" name="symbol_number" class="addstudent_contents_input" required><br>


      <label for="name">Name:</label>
      <input type="text" id="name" name="name" class="addstudent_contents_input" required><br>


      <label for="contact">Contact Number:</label>
      <input type="tel" id="contact" name="contact" class="addstudent_contents_input" required><br><br>


      <label>Sex:</label>
      <input type="radio" id="male" name="sex" value="male" required>
      <label for="male">Male</label>
      <input type="radio" id="female" name="sex" value="female">
      <label for="female">Female</label>
      <br><br>

      <label for="faculty">Faculty:</label>
      <select id="faculty" name="faculty" class="addstudent_contents_input" required>
        <option value="">Select a faculty</option>
        <?php
        while ($program = mysqli_fetch_assoc($program_result)) {
          echo '<option value="' . htmlspecialchars($program['pname']) . '">' . htmlspecialchars($program['pname']) . '</option>';
        }
        ?>
      </select>
      <br>

      <label for="batch_year">Batch Year:</label>
      <input type="text" id="batch_year" name="batch_year" class="addstudent_contents_input" required><br>



      <p>Fee Information</p>

      <label for="totalfee">Total Fees</label>
      <input type="text" class="addstudent_contents_input">

      <label for="faculty">Payment Style:</label>
      <select id="faculty" name="faculty" class="addstudent_contents_input" required>
        <option value="">Select a faculty</option>
        <option value="yearly">Yearly</option>
        <option value="semester">Semester</option>
      </select>
      <br><br>

      <button class="addstudent_subbutton" type="submit">Submit</button>

    </form>
  </div>

</body>

</html>