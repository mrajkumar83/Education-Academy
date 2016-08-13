<?php
	$step = '1';
	$path = '.';
	$title =  'HR';
	$css = array('styles.css');
	$js = array('common.js');
	require_once('includes/common.php');
?>
<div class="left-panel">
				<div class="left-menu">
					<div class="left"></div><h2>Remark</h2><div class="right"></div>						<ul>
							    <li><a href="hr_remark.php" target="frame2">Add Remark</a></li>
								<li><a href="manage_hrremark.php" target="frame2">Manage Remark</a></li>
								
						</ul>
						<br />
						<div class="left"></div><h2>Requirement</h2><div class="right"></div>						<ul>
							    <li><a href="manage_hrjob.php" target="frame2">Requirement</a></li>								
						</ul>
						<br />
						<div class="left"></div><h2>Student Filter</h2><div class="right"></div>						<ul>
								<li><a href="manage_student.php" target="frame2">Manage Student</a></li>
								
						</ul>
						
						
				</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0">
		
		</iframe>
	
</body>
</html>
