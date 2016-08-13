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
					<div class="left"></div><h2>Enquiries</h2><div class="right"></div>						<ul>
							    <li><a href="enquiry.php?utype=SF" target="frame2">Add Enquiry</a></li>
								<li><a href="manage_enquiry.php?utype=SF" target="frame2">Manage Enquiries</a></li>
						</ul>
						
				</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0">
		
		</iframe>
	
</body>
</html>
