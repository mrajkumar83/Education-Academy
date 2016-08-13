<?php
	$step = '1';
	$path = '.';
	$title =  'Administrator';
	$css = array('styles.css');
	$js = array('common.js');
	require_once('includes/common.php');
?>	
</body>
</html>


		<div class="left-panel">
				<div class="left-menu">
					
					   <div class="left"></div><h2>Mode</h2><div class="right"></div>	
						<ul>
							   <li><a href="mode.php" target="frame2">Add Mode</a></li>
							   <li><a href="manage_mode.php" target="frame2">Manage Mode</a></li>
						</ul>
						<br />
						<div class="left"></div><h2>Payments</h2><div class="right"></div>						<ul>
							     <li><a href="student_search.php" target="frame2">Add Fee</a></li>
							   <li><a href="manage_payfees.php" target="frame2">Manage Fee</a></li>
							   <li><a href="unpayfees.php" target="frame2">Unpaid Fees</a></li>
						</ul>
						
				</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0">
		
		</iframe>
	
</body>
</html>
