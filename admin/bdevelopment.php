<?php
	$step = '1';
	$path = '.';
	$title =  'Business Development';
	$css = array('styles.css');
	$js = array('common.js');
	require_once('includes/common.php');
?>	
	<div class="left-panel">
			<div class="left-menu">
				<div class="left"></div><h2>Requirement</h2><div class="right"></div>
					<ul>
							<li><a href="job.php" target="frame2">Add Job</a></li>
							<li><a href="manage_job.php" target="frame2">Manage job</a></li>
					</ul>
					
			</div>
	</div>
	<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0"></iframe>
</body>
</html>
