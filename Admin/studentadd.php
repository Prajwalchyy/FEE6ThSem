<?php include 'db/connection.php';

session_start();

// $fetch_programnames = "SELECT pname FROM program ORDER BY pname ASC";
$fetch_program_all = "SELECT * FROM program ORDER BY pname ASC";
$program_result = mysqli_query($conn, $fetch_program_all);

if (isset($_POST['studentsubbtn'])) {
  $enroll = mysqli_real_escape_string($conn, $_POST['enroll']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $sex = mysqli_real_escape_string($conn, $_POST['sex']);
  $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
  $batch_year = mysqli_real_escape_string($conn, $_POST['batch_year']);
  $sfee = mysqli_real_escape_string($conn, $_POST['totalfee']);
  $sfeeplan = mysqli_real_escape_string($conn, $_POST['payment_style']);
  $spassword = 'pass12345';

  $check_enroll = "SELECT * FROM student WHERE senroll = '$enroll'";
  $result_enroll = mysqli_query($conn, $check_enroll);
  $check_contact = "SELECT * FROM student WHERE scontact = '$contact'";
  $result_contact = mysqli_query($conn, $check_contact);
  $faculty_query = "SELECT * FROM program WHERE pname = '$faculty' LIMIT 1";
  $faculty_result = mysqli_query($conn, $faculty_query);

  if (mysqli_num_rows($result_enroll) > 0) {
    $_SESSION['message'] = "Enrollment number already exists.";
  } elseif (mysqli_num_rows($result_contact) > 0) {
    $_SESSION['message'] = "Contact number already exists.";
  } elseif (!preg_match('/^9[78][0-9]{8}$/', $contact)) {
    $_SESSION['message'] = "INVALID CONTACT NUMBER. PLEASE USE A VALID CONTACT NUMBER.";
  } elseif (!preg_match('/^\d{4}$/', $batch_year)) {
    $_SESSION['message'] = "BATCH YEAR MUST BE 4 DIGITS.";
  } elseif (empty($enroll) || empty($name) || empty($contact) || empty($sex) || empty($faculty) || empty($batch_year) || empty($sfee) || empty($sfeeplan)) {
    $_SESSION['message'] = "ALL FIELDS ARE REQUIRED!";
  } elseif (mysqli_num_rows($faculty_result) > 0) {
    $faculty_row = mysqli_fetch_assoc($faculty_result);
    $pnameid = $faculty_row['pid'];

    $insertquery = "INSERT INTO student (senroll, sname, scontact, ssex, pid, sbatchyear, sfee, sfeeplan, spassword) 
    VALUES ('$enroll', '$name', '$contact', '$sex', '$pnameid', '$batch_year', '$sfee', '$sfeeplan', '$spassword')";

    $result = mysqli_query($conn, $insertquery);
    if ($result) {
      $_SESSION['message'] = "Student added successfully!";
    } else {
      $_SESSION['message'] = "Failed to add student: " . mysqli_error($conn);
    }
    $_SESSION['redirect'] = "studentlist.php";
    header("location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    $_SESSION['message'] = "Invalid Faculty selected.";
    header("location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}

if (isset($_SESSION['message'])) {
  $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES);
  $redirect = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : '';
  echo "
  <script>
  alert('$message');
  " . ($redirect ? "window.location.href = '$redirect';" : "") . "
  </script>
  ";
  unset($_SESSION['message']);
  unset($_SESSION['redirect']);
}
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

      <label for="enroll">Enroll number:</label>
      <input type="text" id="enroll" name="enroll" class="addstudent_contents_input" required><br>

      <label for="name">Full Name:</label>
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
      <select id="faculty" name="faculty" class="addstudent_contents_input" required onchange="updatePaymentStyle()">
        <option value="">Select a faculty</option>
        <?php
        while ($program = mysqli_fetch_assoc($program_result)) {
          echo '<option value="' . htmlspecialchars($program['pname']) . '" data-pbased="' . htmlspecialchars($program['pbased']) . '">' . htmlspecialchars($program['pname']) . '</option>';
        }
        ?>
      </select>

      <br>

      <label for="batch_year">Batch Year:</label>
      <input type="text" id="batch_year" name="batch_year" class="addstudent_contents_input" required><br>

      <p>Fee Information</p>

      <label for="totalfee">Total Fees</label>
      <input type="text" name="totalfee" class="addstudent_contents_input">

      <label for="payment_style">Student Payment plan:</label>
      <select id="payment_style" name="payment_style" class="addstudent_contents_input" required>
        <option value="">Select.....</option>
        <script>
          function updatePaymentStyle() {
            // Get the selected faculty option and its data-pbased attribute
            var facultySelect = document.getElementById('faculty');
            var selectedOption = facultySelect.options[facultySelect.selectedIndex];
            var pbased = selectedOption.getAttribute('data-pbased');

            var paymentStyleSelect = document.getElementById('payment_style');

            paymentStyleSelect.innerHTML = '<option value="">Select.....</option>';

            if (pbased === 'year') {
              paymentStyleSelect.innerHTML += '<option value="yearly">Yearly</option>';
            } else if (pbased === 'semester') {
              paymentStyleSelect.innerHTML += '<option value="yearly">Yearly</option>';
              paymentStyleSelect.innerHTML += '<option value="semester">Semester</option>';
            }
          }
        </script>

      </select>
      <br><br>

      <button class="addstudent_subbutton" type="submit" name="studentsubbtn">Submit</button>

    </form>
  </div>

</body>

</html>