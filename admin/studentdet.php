<?php
$step = '1';
$path = '.';
$title = 'Student';
$css = array('styles.css');
$js = array('common.js');
require_once('includes/common.php');
?>	
<div class="left-panel">
    <div class="left-menu">
        <div class="left"></div><h2>Student</h2><div class="right"></div>
        <ul>
            <li><a href="question.php" target="frame2">Test </a></li> 
            <!--<li><a href="student_attendance.php" target="frame2">Attendance </a></li> -->
			<!-- <li><a href="fee_receipt.php" target="frame2">Fee Receipts </a></li> -->
        </ul>
        <br />
        <div class="left"></div><h2>Sample Resume</h2><div class="right"></div>
        <ul>
            <li><a href="student_resume.php" target="frame2">Resumes </a></li> 
        </ul>

        <div class="left"></div><h2>Results</h2><div class="right"></div>
        <ul>
            <li><a href="manage_remark.php" target="frame2">HR Remarks</a></li>
            <li><a href="test_results.php" target="frame2">Test Results </a></li>
        </ul>
    </div>
</div>
<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0">

</iframe>

</body>
</html>
