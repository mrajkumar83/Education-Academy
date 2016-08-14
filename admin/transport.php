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
			  <div class="left"></div><h2>Category</h2><div class="right"></div>
				<ul>
						<li><a href="vehicle_category.php" target="frame2">Add Category</a></li>
						<li><a href="manage_vehicle_category.php" target="frame2">Manage Categories</a></li>
				</ul>
				<div class="clear"></div>
				<br>
				
				<div class="left"></div><h2>Vehicles</h2><div class="right"></div>
				<ul>
					   <li><a href="vehicle.php" target="frame2">Add Vehicle</a></li>
					   <li><a href="manage_vehicles.php" target="frame2">Manage Vehicles</a></li>
				</ul>
				
		</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0"></iframe>
	
</body>
</html>
