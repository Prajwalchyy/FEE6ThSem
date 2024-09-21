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

    $query = "SELECT student.*, morefee.*, program.*, fee_transaction.*
    FROM student
    LEFT JOIN morefee ON student.sid = morefee.sid
    LEFT JOIN program ON student.pid = program.pid
    LEFT JOIN fee_transaction ON morefee.mid = fee_transaction.mid
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
                        <input type="checkbox" name="fee_categories[]" value="ProgramFee">
                        Program Fee
                </div>
                <div class="paymentprocess_inputgroup">
                    <label for="amount">Amount to Pay:</label>
                    <input type="number" id="amount" class="paymentprocess_inputamount" name="amount" placeholder="Enter amount to pay" required>
                </div>

                <div>
                    total paying amount: <span id="total_paying_amount">calculate total amount</span>
                </div>
                <button type="submit" class="paymentprocess_inputpaybtn">Process Payment</button><br><br><br>
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