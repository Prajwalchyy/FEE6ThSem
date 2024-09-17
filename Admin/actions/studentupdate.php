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
      <input type="text" id="enroll" name="enroll" class="updatestudent_contents_input" required><br>

      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" class="updatestudent_contents_input" required><br>

      <label for="contact">Contact Number:</label>
      <input type="tel" id="contact" name="contact" class="updatestudent_contents_input" required><br><br>

      <label>Sex:</label>
      <input type="radio" id="male" name="sex" value="male" required>
      <label for="male">Male</label>
      <input type="radio" id="female" name="sex" value="female">
      <label for="female">Female</label>
      <br><br>

      <label for="faculty">Faculty:</label>
      <select id="faculty" name="faculty" class="updatestudent_contents_input" required>
        <option value="">Select a faculty</option>
        
      </select>

      <br>

      <label for="batch_year">Batch Year:</label>
      <input type="text" id="batch_year" name="batch_year" class="updatestudent_contents_input" required><br>

      <p>Fee Information</p>

      <label for="totalfee">Total Fees</label>
      <input type="text" name="totalfee" class="updatestudent_contents_input">

      <label for="payment_style">Student Payment plan:</label>
      <select id="payment_style" name="payment_style" class="updatestudent_contents_input" required>
        <option value="">Select.....</option>
        <option value="yearly">Yearly</option>
        <option value="semester">Semester</option>
      </select>
      <br><br>

      <button class="updatestudent_subbutton" type="submit" name="studentsubbtn">UPDATE</button>

    </form>
  </div>

</body>

</html>
