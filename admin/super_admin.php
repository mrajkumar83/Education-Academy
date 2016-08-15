<?php
	$step = '1';
	$path = '.';
	$title =  'Administrator';
	$css = array('styles.css');
	$js = array('common.js');
	require_once('./includes/common.php');
?>
	<div class="left-panel">
		<div class="left-menu">
			  <div class="left"></div><h2>Staff</h2><div class="right"></div>
				<ul>
						<li><a href="staff.php" target="frame2">Add Staff</a></li>
						<li><a href="manage_staff.php" target="frame2">Manage Staff</a></li>
				</ul>
				<div class="clear"></div>
				<br>
				
				<div class="left"></div><h2>Branch</h2><div class="right"></div>
				<ul>
					   <li><a href="branch.php" target="frame2">Add Branch</a></li>
					   <li><a href="manage_branch.php" target="frame2">Manage Branch</a></li>
				</ul>
				<br>
				<div class="left"></div><h2>Batch</h2><div class="right"></div>	
				<ul>
					   <li><a href="batch.php" target="frame2">Add Batch</a></li>
					   <li><a href="manage_batch.php" target="frame2">Manage Batch</a></li>
				</ul>
				<br>
				<div class="left"></div><h2>College</h2><div class="right"></div>	
				<ul>
					   <li><a href="college.php?op=A" target="frame2">Add College</a></li>
					   <li><a href="manage_colleges.php" target="frame2">Manage College</a></li>
				</ul>
				<br>
				
				<div class="left"></div><h2>Course</h2><div class="right"></div>	
				<ul>
					   <li><a href="course.php" target="frame2">Add Course</a></li>
					   <li><a href="manage_course.php" target="frame2">Manage Course</a></li>
				</ul>
				<br>
				
				<div class="left"></div><h2>Call Status</h2><div class="right"></div>
				<ul>
					   <li><a href="callstatus.php" target="frame2">Add Call Status</a></li>
					   <li><a href="managecallstatus.php" target="frame2">Manage Call Status</a></li>
				</ul>
				<br>
				<div class="left"></div><h2>Enquiries</h2><div class="right"></div>						<ul>
						<li><a href="enquiry.php?utype=AD" target="frame2">Add Enquiry</a></li>
						<li><a href="manage_enquiry.php?utype=AD" target="frame2">Manage Enquiries</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Junk Student</h2><div class="right"></div>	
				<ul>
					   <li><a href="junk_student.php" target="frame2">Junk Details</a></li>
				</ul>
				<br />
				
				<div class="left"></div><h2>Messages</h2><div class="right"></div>	
				<ul>
					<li><a href="send_bulk_msg.php?ty=I" target="frame2">Bulk Mail</a></li>
					<li><a href="interactive_mail.php" target="frame2">Interactive Mail</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Mode</h2><div class="right"></div>	
				<ul>
					   <li><a href="mode.php" target="frame2">Add Mode</a></li>
					   <li><a href="manage_mode.php" target="frame2">Manage Mode</a></li>
				</ul>
				<br>
				<div class="left"></div><h2>Payments</h2><div class="right"></div>						<ul>
						 <li><a href="student_search.php" target="frame2">Add Fee</a></li>
					   <li><a href="manage_payfees.php" target="frame2">Manage Fee</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Remark</h2><div class="right"></div>						<ul>
						<li><a href="hr_remark.php" target="frame2">Add Remark</a></li>
						<li><a href="manage_hrremark.php" target="frame2">Manage Remark</a></li>
						
				</ul>
				<br />
				<div class="left"></div><h2>Requirement</h2><div class="right"></div>						<ul>
						<li><a href="job.php" target="frame2">Add Job</a></li>
						<li><a href="manage_job.php" target="frame2">Manage job</a></li>
				</ul>
				
				<br />
				<div class="left"></div><h2>Resume</h2><div class="right"></div>
				<ul>
						<li><a href="resume.php" target="frame2">Add Resume</a></li>
						<li><a href="manage_resume.php" target="frame2">Manage Resume</a></li>
				</ul>
				<br/>
				 <div class="left"></div><h2>Skills</h2><div class="right"></div>	
				<ul>
					<li><a href="skill.php" target="frame2">Add Skills</a></li>
					   <li><a href="manage_skills.php" target="frame2">Manage Skills</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Student Details </h2><div class="right"></div>	
				<ul>
					   <li><a href="manage_stddetails.php?utype=SD" target="frame2">Manage Student</a></li>
					   <li><a href="manage_stddetails.php?utype=GS" target="frame2">Manage Guest</a></li>
				</ul>
				<br />
				 <div class="left"></div><h2>Student</h2><div class="right"></div>	
				<ul>
					<li><a href="staff_attendance.php" target="frame2">Add Attendance</a></li>
					   <li><a href="manage_attendance.php" target="frame2">Attendance</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Summary</h2><div class="right"></div>	
				<ul>
					<li><a href="overal_summery.php" target="frame2">Over All</a></li>
					   <li><a href="branch_summary.php" target="frame2">Branch Wise</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Test</h2><div class="right"></div>	
				<ul>
					   <li><a href="test.php" target="frame2">Add Test</a></li>
					   <li><a href="manage_test.php" target="frame2">Manage Test</a></li>
				</ul>
				<br />
				<div class="left"></div><h2>Announcement </h2><div class="right"></div>	
				<ul>
					<li><a href="announcements.php" target="frame2">Add Announcement</a></li>
					<li><a href="manage_announcements.php" target="frame2">Manage Announce.s</a></li>
				</ul>
				
		</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0"></iframe>
	
</body>
</html>
