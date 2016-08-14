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
						<li><a href="library_category.php" target="frame2">Add Category</a></li>
						<li><a href="manage_library_category.php" target="frame2">Manage Staff</a></li>
				</ul>
				<div class="clear"></div>
				<br>
				
				<div class="left"></div><h2>Books</h2><div class="right"></div>
				<ul>
					   <li><a href="book.php" target="frame2">Add Book</a></li>
					   <li><a href="manage_books.php" target="frame2">Manage Branch</a></li>
				</ul>
				
		</div>
		</div>
		<iframe src="welcome.php" class="inner-frame" name="frame2" id="frame2" frameborder="0"></iframe>
	
</body>
</html>
