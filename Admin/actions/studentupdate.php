<?php
include '../db/connection.php';

if (isset($_GET['update'])) {
  $id = mysqli_real_escape_string($conn, $_GET['update']);
  $query = "SELECT student.*, program.pname 
  FROM student 
  JOIN program ON student.pid = program.pid 
  WHERE student.sid = $id";
  $result = mysqli_query($conn, $query);
  $student = mysqli_fetch_assoc($result);

  $program_query = "SELECT * FROM program ORDER BY pname ASC";
  $program_result = mysqli_query($conn, $program_query);
}

if (isset($_POST['studentsubbtn'])) {
  $enroll = mysqli_real_escape_string($conn, $_POST['enroll']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $sex = mysqli_real_escape_string($conn, $_POST['sex']);
  // $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
  // $batch_year = mysqli_real_escape_string($conn, $_POST['batch_year']);
  // $totalfee = mysqli_real_escape_string($conn, $_POST['totalfee']);
  // $payment_style = mysqli_real_escape_string($conn, $_POST['payment_style']);

  // $updatequery = "UPDATE student SET senroll= '$enroll', sname= '$name', scontact= '$contact', ssex= '$sex', pid= '$faculty', sbatchyear= '$batch_year', sfee= '$totalfee', sfeeplan= '$payment_style' WHERE sid= $id";
  $updatequery = "UPDATE student SET sname= '$name', scontact= '$contact', ssex= '$sex' WHERE sid= $id";
  $updateresult = mysqli_query($conn, $updatequery);
  if ($updateresult) {
    echo "<script>alert('program updated successfully'); window.location.href='../studentlist.php';</script>";
  } else {
    echo "<script>alert('Error updating record: " . mysqli_error($conn) . "');</script>";
  }
}
?>
<html>

<head>
  <title>Update Student</title>
  <link rel="stylesheet" href="../index.css">
</head>

<body class="updatestudent_body">
  <div class="updatestudent_contents">

    <h2>UPDATE STUDENT</h2>

    <p>Student Information</p>
    <form method="post" action="#">

      <label for="enroll">Enroll number:</label>
      <input type="text" id="enroll" name="enroll" class="updatestudent_contents_input" value="<?php echo htmlspecialchars($student['senroll']); ?>" disabled><br>

      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" class="updatestudent_contents_input" value="<?php echo htmlspecialchars($student['sname']); ?>" required><br>

      <label for="contact">Contact Number:</label>
      <input type="tel" id="contact" name="contact" class="updatestudent_contents_input" value="<?php echo htmlspecialchars($student['scontact']); ?>" required><br><br>

      <label>Sex:</label>
      <input type="radio" id="male" name="sex" value="male" <?php echo strtolower($student['ssex']) == 'male' ? 'checked' : ''; ?> required>
      <label for="male">Male</label>
      <input type="radio" id="female" name="sex" value="female" <?php echo strtolower($student['ssex']) == 'female' ? 'checked' : ''; ?>>
      <label for="female">Female</label>
      <br><br>

      <label for="faculty">Faculty:</label>
      <select id="faculty" name="faculty" class="updatestudent_contents_input" disabled>
        <option value="">Select a faculty</option>

        <?php
        while ($program = mysqli_fetch_assoc($program_result)) {
          $selected = ($program['pid'] == $student['pid']) ? 'selected' : '';
          echo '<option value="' . htmlspecialchars($program['pid']) . '" data-pbased="' . htmlspecialchars($program['pbased']) . '" ' . $selected . '>' . htmlspecialchars($program['pname']) . '</option>';
        }
        ?>
      </select>

      <br>

      <label for="batch_year">Batch Year:</label>
      <input type="text" id="batch_year" name="batch_year" class="updatestudent_contents_input" value="<?php echo htmlspecialchars($student['sbatchyear']); ?>" disabled required><br>

      <p>Fee Information</p>

      <label for="totalfee">Total Fees</label>
      <input type="text" name="totalfee" class="updatestudent_contents_input" value="<?php echo htmlspecialchars($student['sfee']); ?>" disabled>

      <label for="payment_style">Student Payment plan:</label>
      <select id="payment_style" name="payment_style" class="updatestudent_contents_input" disabled required>
        <option value="">Select.....</option>
        <script>
          function updatePaymentStyle() {
            var facultySelect = document.getElementById('faculty');
            var selectedOption = facultySelect.options[facultySelect.selectedIndex];
            var pbased = selectedOption.getAttribute('data-pbased');

            var paymentStyleSelect = document.getElementById('payment_style');

            paymentStyleSelect.innerHTML = '<option value="">Select.....</option>';

            // Pre-selected payment style value from PHP
            var selectedPaymentStyle = "<?php echo htmlspecialchars($student['sfeeplan']); ?>";

            // Show options based on pbased value
            if (pbased === 'year') {
              paymentStyleSelect.innerHTML += '<option value="yearly" ' + (selectedPaymentStyle == 'yearly' ? 'selected' : '') + '>Yearly</option>';
            } else if (pbased === 'semester') {
              paymentStyleSelect.innerHTML += '<option value="yearly" ' + (selectedPaymentStyle == 'yearly' ? 'selected' : '') + '>Yearly</option>';
              paymentStyleSelect.innerHTML += '<option value="semester" ' + (selectedPaymentStyle == 'semester' ? 'selected' : '') + '>Semester</option>';
            }
          }
          document.getElementById('faculty').addEventListener('change', updatePaymentStyle);

          window.onload = updatePaymentStyle;
        </script>


      </select>
      <br><br>

      <button class="updatestudent_subbutton" type="submit" name="studentsubbtn">UPDATE</button>

    </form>
  </div>

</body>

</html>