<?php
	$step = '1';
	$path = '.';
	$title =  'Administrator';
	$css = array('styles.css');
	$js = array('common.js');
	require_once('includes/common.php');
?>	
<div class="left-panel">
	<div class="left-menu">
		<div class="left"></div><h2>Staff</h2><div class="right"></div>						
		   <ul>
					<li><a href="staff.php?utype=SF" target="frame2">Add Staff</a></li>
					<li><a href="manage_staff.php?utype=SF" target="frame2">Manage Staff</a></li>
			</ul>
			<br />
			<div class="left"></div><h2>Batch</h2><div class="right"></div>	
			<ul>
				   <li><a href="batch.php" target="frame2">Add Batch</a></li>
				   <li><a href="manage_batch.php" target="frame2">Manage Batch</a></li>
			</ul><br>
			<br>
			
			<div class="left"></div><h2>Course</h2><div class="right"></div>	
			<ul>
				 <li><a href="course.php" target="frame2">Add Course</a></li>
				 <li><a href="manage_course.php" target="frame2">Manage Course</a></li>
			</ul>
			<br>
			
			<div class="left"></div><h2>Enquiries</h2><div class="right"></div>
			<ul>
				<li><a href="enquiry.php?utype=AD" target="frame2">Add Enquiry</a></li>
				<li><a href="manage_enquiry.php?utype=AD" target="frame2">Manage Enquiries</a></li>
			</ul>
			<br />
			
			<div class="left"></div><h2>Messages</h2><div class="right"></div>	
			<ul>
				<li><a href="send_bulk_msg.php" target="frame2">Bulk Mail</a></li>
			</ul>
			<br />
			
			<div class="left"></div><h2>Payments</h2><div class="right"></div>
			<ul>
				<li><a href="student_search.php" target="frame2">Add Fee</a></li>
				<li><a href="manage_payfees.php" target="frame2">Manage Fee</a></li>
			</ul>
			<br />
			 <div class="left"></div><h2>Junk Student</h2><div class="right"></div>	
			<ul>
				<li><a href="junk_student.php" target="frame2">Junk Details</a></li>							   
			</ul>
			<br>
			<div class="left"></div><h2>Remark</h2><div class="right"></div>
			<ul>
				<li><a href="hr_remark.php" target="frame2">Add Remark</a></li>
				<li><a href="manage_hrremark.php" target="frame2">Manage Remark</a></li>
					
			</ul>
			<br />
			<div class="left"></div><h2>Requirement</h2><div class="right"></div>						<ul>
					<li><a href="job.php" target="frame2">Add Job</a></li>
					<li><a href="manage_job.php" target="frame2">Manage job</a></li>
			</ul>
			<br />
			<div class="left"></div><h2>Student Details </h2><div class="right"></div>	
			<ul>
				   <li><a href="manage_stddetails.php?utype=SD" target="frame2">Manage Student</a></li>
			</ul>
			<br />
			<div class="left"></div><h2>Student </h2><div class="right"></div>	
			<ul>
				<li><a href="staff_attendance.php" target="frame2">Add Attendance</a></li>
				<li><a href="manage_attendance.php" target="frame2">Attendance</a></li>
			</ul>
			<br />
			<div class="left"></div><h2>Announcement </h2><div class="right"></div>	
			<ul>
				<li><a href="announcements.php" target="frame2">Add Announcement</a></li>
				<li><a href="manage_announcements.php" target="frame2">Manage Announcements</a></li>
			</ul>
	</div>
</div>
	<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0">
	
	</iframe>
	
</body>
</html>
