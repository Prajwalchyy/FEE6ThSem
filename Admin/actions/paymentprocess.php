<?php

include '../db/connection.php';
session_start();

if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']);
}

if (isset($_GET['pay'])) {

    //fetch student information
    $id = mysqli_real_escape_string($conn, $_GET['pay']);
    // $query = "SELECT * FROM morefee
    //           JOIN student ON morefee.sid = student.sid
    //           JOIN program ON student.pid = program.pid
    //           WHERE student.sid = '$id'";
    // $query = "SELECT * FROM student
    //       LEFT JOIN morefee ON student.sid = morefee.sid
    //       JOIN program ON student.pid = program.pid
    //       WHERE student.sid = '$id'";

    // $query = "SELECT student.*, morefee.*, program.*, fee_transaction.*
    // FROM student
    // LEFT JOIN morefee ON student.sid = morefee.sid
    // LEFT JOIN program ON student.pid = program.pid
    // LEFT JOIN fee_transaction ON morefee.mid = fee_transaction.mid
    // WHERE student.sid = '$id'";



    $query = "SELECT student.*, morefee.*, program.*, fee_transaction.*
    FROM student
    LEFT JOIN morefee ON student.sid = morefee.sid
    LEFT JOIN program ON student.pid = program.pid
    LEFT JOIN fee_transaction ON morefee.sid = fee_transaction.sid
    WHERE student.sid = '$id'";

    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);


    if ($student) {

        //Student payment plan
        if ($student['sfeeplan'] === 'yearly') {
            $programpayplan = $student['pyear'] * 1; // Yearly fee
        } else if ($student['sfeeplan'] === 'semester') {
            $programpayplan = $student['pyear'] * 2; // Semesterly fee
        } else {
            $programpayplan = 0;
        }

        //Student total program fee
        $studenttotalprogramfee = $student['sfee'];

        //student remaining program fee
        // $studentId = $student['sid'];
        $sumof_programfee = "SELECT SUM(amount) as total_paid FROM fee_transaction 
          WHERE sid = '$id' AND feecategory = 'ProgramFee'";
        $result_sumof_programfee = mysqli_query($conn, $sumof_programfee);
        $fetch_sumof_programfee = mysqli_fetch_assoc($result_sumof_programfee);
        $totalPaid_programfee = $fetch_sumof_programfee['total_paid'] ?? 0;
        $student_remaining_programfee = $student['sfee'] - $totalPaid_programfee;

        // Calculate the fee per year or semester
        $feePerTerm = $studenttotalprogramfee / $programpayplan;

        // Calculate how many terms (years/semesters) have been fully paid
        $paidTerms = floor($totalPaid_programfee / $feePerTerm);
        // $paidTerms = intdiv($totalPaid_programfee, $feePerTerm);

        // Determine current term (year or semester)
        $currentTerm = $paidTerms + 1;

        // Check if there's partial payment for the next term
        $paidForCurrentTerm = $totalPaid_programfee - ($paidTerms * $feePerTerm);
        $remainingForCurrentTerm = $feePerTerm - $paidForCurrentTerm;

        //more fee
        // Initialize an array to hold totals for each fee category
        $remainingFees = []; // Initialize the array

        // $query_morefee = "SELECT * FROM morefee WHERE sid = '$id'";
        $query_morefee = "SELECT mfeecategory, SUM(amount) as total_fee FROM morefee WHERE sid = '$id' GROUP BY mfeecategory";
        $result_morefee = mysqli_query($conn, $query_morefee);

        while ($morefee = mysqli_fetch_assoc($result_morefee)) {
            $feeCategory = $morefee['mfeecategory'];
            // $amount = $morefee['amount'];
            $totalFee = $morefee['total_fee'];

            // Calculate total paid for this more fee category
            // $query_paid = "SELECT SUM(amount) as total_paid FROM fee_transaction 
            //                WHERE mid = '$mid' AND feecategory = '$feeCategory'";
            $query_paid = "SELECT SUM(amount) as total_paid FROM fee_transaction 
            WHERE sid = '$id' AND feecategory = '$feeCategory'";

            $result_paid = mysqli_query($conn, $query_paid);

            $fetch_paid = mysqli_fetch_assoc($result_paid);
            $totalPaid = $fetch_paid['total_paid'] ?? 0;

            // Calculate remaining fee
            $remainingFee = $totalFee - $totalPaid;

            // Only store if there is a remaining fee
            if ($remainingFee > 0) {
                if (!isset($remainingFees[$feeCategory])) {
                    $remainingFees[$feeCategory] = 0; // Initialize if not set
                }
                $remainingFees[$feeCategory] += $remainingFee; // Sum up remaining fees
            }
        }
        $query_categories = "SELECT mfeecategory, SUM(amount) as total_amount FROM morefee WHERE sid = '$id' GROUP BY mfeecategory";
        $result_categories = mysqli_query($conn, $query_categories);
        $feeCategories = [];

        if (mysqli_num_rows($result_categories) > 0) {
            while ($category = mysqli_fetch_assoc($result_categories)) {
                $mfeecategory = $category['mfeecategory'];
                $totalAmount = $category['total_amount']; // Use the summed total amount

                // Fetch the sum of amounts already paid for this category from the fee_transaction table
                $query_paid = "SELECT SUM(amount) as total_paid FROM fee_transaction 
                       WHERE sid = '$id' AND feecategory = '$mfeecategory'";
                $result_paid = mysqli_query($conn, $query_paid);
                $paid = mysqli_fetch_assoc($result_paid);
                $totalPaid = $paid['total_paid'] ?? 0;

                // Only add to the list if the total paid is less than the total fee amount
                if ($totalPaid < $totalAmount) {
                    $feeCategories[] = htmlspecialchars($mfeecategory);
                }
            }
        }
    }
}

if (isset($_POST['processpaybtn'])) {
    $receipt_code = uniqid('RC-', true); // Generates a unique receipt code
    $payment_date = mysqli_real_escape_string($conn, string: $_POST['payment_date']);
    $fee_categories = $_POST['fee_categories'] ?? [];
    $amounts = $_POST['amounts'] ?? [];

    foreach ($fee_categories as $category) {
        $amount = mysqli_real_escape_string($conn, $amounts[$category]);
        $query_insert = "INSERT INTO fee_transaction (sid, receipt_number, feecategory, amount, payment_date)
                         VALUES ('$id', '$receipt_code', '$category', '$amount', '$payment_date')";
        $inserting_paymentdata = mysqli_query($conn, $query_insert);
    }
    if ($inserting_paymentdata) {
        echo '<script>alert("Payment processed successfully."); window.location.href="../collectfee.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error processing payment.");</script>';
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Payment Process</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body class="paymentprocess_body">
    <div class="paymentprocess_parentdiv">
        <h2>Fee Payment Process</h2>

        <section class="paymentprocess_studentinfo">
            <h3>Student Information</h3>
            <div class="paymentprocess_infogroup">
                <label>Name:</label>
                <span><?php echo htmlspecialchars($student['sname']) ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Contact:</label>
                <span><?php echo htmlspecialchars($student['scontact']) ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Sex:</label>
                <span><?php echo htmlspecialchars($student['ssex']) ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Batch:</label>
                <span><?php echo htmlspecialchars($student['sbatchyear']) ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Faculty:</label>
                <span><?php echo htmlspecialchars($student['pname']) ?></span>
            </div>
        </section>

        <section class="paymentprocess_feeinfo">
            <h3>Fee Information</h3>
            <div class="paymentprocess_infogroup">
                <label>Payment Plan:</label>
                <span><?php echo htmlspecialchars($student['sfeeplan']) ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Program Payment Plan <?php echo htmlspecialchars($student['sfeeplan']) ?></label>
                <span><?php echo htmlspecialchars($programpayplan) ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Program Total Fee:</label>
                <span>RS <?php echo htmlspecialchars(number_format($studenttotalprogramfee)); ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Program Remaining Fee:</label>
                <span>RS <?php echo htmlspecialchars(number_format($student_remaining_programfee)); ?></span>
            </div>
            <div class="paymentprocess_infogroup">
                <label>Program Total Paid Fee:</label>
                <span>RS <?php echo htmlspecialchars(number_format($totalPaid_programfee)); ?></span>
            </div>
            <div class="paymentprocess_infogroup">

                <label>Fee of <?php echo $student['pbased'] ?> <?php echo $currentTerm ?>:</label>
                <span>RS <?php echo htmlspecialchars(number_format($feePerTerm)); ?></span>
            </div>

            <div class="paymentprocess_infogroup">
                <label> Remaining Fee of <?php echo $student['pbased'] ?> <?php echo $currentTerm ?>:</label>
                <span>RS <?php echo htmlspecialchars(number_format($remainingForCurrentTerm)); ?></span>
            </div>

            <?php foreach ($remainingFees as $category => $remaining) : ?>
                <div class="paymentprocess_infogroup">
                    <label>Remaining Fee of <?php echo htmlspecialchars($category); ?>:</label>
                    <span>RS <?php echo htmlspecialchars(number_format($remaining)); ?></span>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="paymentprocess_pay">
            <h3>Payment Process</h3>
            <form method="POST" action="#">
                <div class="paymentprocess_inputgroup">
                    <label for="payment_date">Payment Date:</label>
                    <input type="date" class="paymentprocess_inputdate" id="payment_date" name="payment_date" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="paymentprocess_inputgroup">
                    <label>Fee Categories:</label><br>
                    <label>
                        <input type="checkbox" name="fee_categories[]" value="ProgramFee" onclick="toggleInput(this)"> Program Fee
                    </label><br>
                    <?php foreach ($feeCategories as $category): ?>
                        <label>
                            <input type="checkbox" name="fee_categories[]" value="<?php echo $category; ?>" onclick="toggleInput(this)"> <?php echo $category; ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <div id="amountInputs" class="paymentprocess_inputgroup"></div>

                <script>
                    function toggleInput(checkbox) {
                        const amountInputsDiv = document.getElementById("amountInputs");

                        if (checkbox.checked) {
                            // Create a new input field for the selected category
                            const inputField = document.createElement("div");
                            inputField.innerHTML = `
            <label>${checkbox.value} Amount:</label>
            <input type="number" class="paymentprocess_inputamount" name="amounts[${checkbox.value}]" placeholder="Enter amount" required>`;
                            amountInputsDiv.appendChild(inputField);
                        } else {
                            // Remove the corresponding input field if the checkbox is unchecked
                            const inputs = amountInputsDiv.getElementsByTagName("div");
                            for (let i = 0; i < inputs.length; i++) {
                                if (inputs[i].innerText.includes(checkbox.value)) {
                                    amountInputsDiv.removeChild(inputs[i]);
                                    break;
                                }
                            }
                        }
                    }
                </script>
                <div>
                    total paying amount: <span id="total_paying_amount">calculate total amount</span>
                </div>
                <button type="submit" name="processpaybtn" class="paymentprocess_inputpaybtn">Process Payment</button><br><br>

                <a href="morefee.php?more=<?php echo $id; ?>" class="paymentprocess_inputpaybtn" style="display: inline-block; margin-top: 15px;">Add More Fees</a><br><br>

                <button type="button" class="paymentprocess_inputpaybtn" onclick="confirmBack()">Back</button>

                <script>
                    function confirmBack() {
                        if (confirm("Are you sure you want to go back? Any unsaved changes will be lost.")) {
                            window.location.href = '../collectfee.php';
                        }
                    }
                </script>

            </form>
        </section>
    </div>
</body>

</html>