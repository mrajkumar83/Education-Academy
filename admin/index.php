<?php
	$path = '.';
	$step = '1';
	$title =  'Home';
	$css = array('styles.css');
	$js = array('common.js');
	require_once('includes/common.php');
?>
<div class="left-panel">
				<div class="left-menu">
						<div class="left"></div><h2>My Account</h2><div class="right"></div>
						<ul>
								<li><a href="<?php echo  (($UTYPE== 'SD' || $UTYPE== 'ES' || $UTYPE== 'GS') ? 'student.php' : 'profile.php') ?>" target="frame2">Profile</a></li>
								<li><a href="changepassword.php" target="frame2">ChangePassword</a></li>
						</ul>
				</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0"></iframe>		
		</body>
</html>
