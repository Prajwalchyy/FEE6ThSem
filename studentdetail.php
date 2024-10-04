<?php

session_start();
include 'dbconn/connection.php';
if (!isset($_SESSION['student_id'])) {
    header('Location: slogin.php');
    exit();
}

$student_id = $_SESSION['student_id'];
$student_iid = mysqli_real_escape_string($conn, $student_id);
$query = "SELECT student.*, morefee.*, program.*, fee_transaction.*
    FROM student
    LEFT JOIN morefee ON student.sid = morefee.sid
    LEFT JOIN program ON student.pid = program.pid
    LEFT JOIN fee_transaction ON morefee.sid = fee_transaction.sid
    WHERE student.sid = '$student_iid'";



//for total additional fee
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

$query_additional_fee = "SELECT SUM(amount) as additional_fee_paid FROM fee_transaction WHERE sid = '$student_id' AND feecategory != 'ProgramFee'";
$result_additional_fee = mysqli_query($conn, $query_additional_fee);
if ($result_additional_fee) {
    $row_additional_fee = mysqli_fetch_assoc($result_additional_fee);
    $additional_fee_paid = $row_additional_fee['additional_fee_paid'] ?? 0;
}



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
          WHERE sid = '$student_iid' AND feecategory = 'ProgramFee'";
    $result_sumof_programfee = mysqli_query($conn, $sumof_programfee);
    $fetch_sumof_programfee = mysqli_fetch_assoc($result_sumof_programfee);
    $totalPaid_programfee = $fetch_sumof_programfee['total_paid'] ?? 0;
    $student_remaining_programfee = $student['sfee'] - $totalPaid_programfee;


    $feePerTerm = $studenttotalprogramfee / $programpayplan;


    $paidTerms = floor($totalPaid_programfee / $feePerTerm);
    // $paidTerms = intdiv($totalPaid_programfee, $feePerTerm);


    $currentTerm = $paidTerms + 1;


    $paidForCurrentTerm = $totalPaid_programfee - ($paidTerms * $feePerTerm);
    $remainingForCurrentTerm = $feePerTerm - $paidForCurrentTerm;


    $remainingFees = [];

    // $query_morefee = "SELECT * FROM morefee WHERE sid = '$id'";
    $query_morefee = "SELECT mfeecategory, SUM(amount) as total_fee FROM morefee WHERE sid = '$student_iid' GROUP BY mfeecategory";
    $result_morefee = mysqli_query($conn, $query_morefee);

    while ($morefee = mysqli_fetch_assoc($result_morefee)) {
        $feeCategory = $morefee['mfeecategory'];
        // $amount = $morefee['amount'];
        $totalFee = $morefee['total_fee'];


        $query_paid = "SELECT SUM(amount) as total_paid FROM fee_transaction 
            WHERE sid = '$student_iid' AND feecategory = '$feeCategory'";

        $result_paid = mysqli_query($conn, $query_paid);

        $fetch_paid = mysqli_fetch_assoc($result_paid);
        $totalPaid = $fetch_paid['total_paid'] ?? 0;

        // Calculate remaining fee
        $remainingFee = $totalFee - $totalPaid;


        if ($remainingFee > 0) {
            if (!isset($remainingFees[$feeCategory])) {
                $remainingFees[$feeCategory] = 0;
            }
            $remainingFees[$feeCategory] += $remainingFee;
        }
    }
    $query_categories = "SELECT mfeecategory, SUM(amount) as total_amount FROM morefee WHERE sid = '$student_iid' GROUP BY mfeecategory";
    $result_categories = mysqli_query($conn, $query_categories);
    $feeCategories = [];

    if (mysqli_num_rows($result_categories) > 0) {
        while ($category = mysqli_fetch_assoc($result_categories)) {
            $mfeecategory = $category['mfeecategory'];
            $totalAmount = $category['total_amount']; // Use the summed total amount


            $query_paid = "SELECT SUM(amount) as total_paid FROM fee_transaction 
                       WHERE sid = '$student_iid' AND feecategory = '$mfeecategory'";
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




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Full Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="studentdetail_body">
    <?php include 'sdashhead.php'; ?>
    <div class="studentdetail_secondbody">
        <div class="studentdetail_student-wrapper">
            <section class="allstudent-details">
                <h2>Student Details</h2>
                <div class="detail">
                    <label>Enroll Number:</label>
                    <span id="enroll-number"><?php echo htmlspecialchars($student['senroll']) ?></span>
                </div>
                <div class="detail">
                    <label>Name:</label>
                    <span id="student-name"><?php echo htmlspecialchars($student['sname']) ?></span>
                </div>
                <div class="detail">
                    <label>Contact:</label>
                    <span id="student-contact"><?php echo htmlspecialchars($student['scontact']) ?></span>
                </div>
                <div class="detail">
                    <label>Sex:</label>
                    <span id="student-sex"><?php echo htmlspecialchars($student['ssex']) ?></span>
                </div>
                <div class="detail">
                    <label>Program:</label>
                    <span id="student-program"><?php echo htmlspecialchars($student['pname']) ?></span>
                </div>
                <div class="detail">
                    <label>Batch:</label>
                    <span id="student-batch"><?php echo htmlspecialchars($student['sbatchyear']) ?></span>
                </div>
                <div class="detail">
                    <label>Fee Plan:</label>
                    <span id="student-feeplan"><?php echo htmlspecialchars($student['sfeeplan']) ?></span>
                </div>
            </section>

            <?php
            if ($student['sfeeplan'] == 'yearly') {
                $yearorsemester = 'year';
            } else if ($student['sfeeplan'] == 'semester') {
                $yearorsemester = 'semester';
            }
            ?>

            <section class="allfee-details">
                <h2>Fee Details</h2>
                <div class="detail">
                    <label>Total Program Fee:</label>
                    <span id="total-program-fee">RS <?php echo htmlspecialchars(number_format($studenttotalprogramfee)); ?></span>
                </div>
                <div class="detail">
                    <label>Total Program Fee Paid:</label>
                    <span id="total-fee-paid">RS <?php echo htmlspecialchars(number_format($totalPaid_programfee)); ?></span>
                </div>
                <div class="detail">
                    <label>Program Fee Remaining:</label>
                    <span id="program-fee-remaining">RS <?php echo htmlspecialchars(number_format($student_remaining_programfee)); ?></span>
                </div>
                <div class="detail">
                    <label>Fee of <?php echo $yearorsemester ?> <?php echo $currentTerm ?>:</label>
                    <span id="semester-fee">RS <?php echo htmlspecialchars(number_format($feePerTerm)); ?></span>
                </div>
                <div class="detail">
                    <label>Remaining Fee of <?php echo $yearorsemester ?> <?php echo $currentTerm ?></label>
                    <span id="semester-fee-remaining">RS <?php echo htmlspecialchars(number_format($remainingForCurrentTerm)); ?></span>
                </div>
                <div class="detail">
                    <label>Total Additional Fees Paid:</label>
                    <span id="other-fee-paid">RS <?php echo  number_format($additional_fee_paid); ?></span>
                </div>

                <?php foreach ($remainingFees as $category => $remaining) : ?>
                    <div class="detail">
                        <label>Remaining Fee of <?php echo htmlspecialchars($category); ?>:</label>
                        <span id="other-fee-remaining">RS <?php echo htmlspecialchars(number_format($remaining)); ?></span>
                    </div>
                <?php endforeach; ?>

            </section>
        </div>
    </div>
</body>

</html>