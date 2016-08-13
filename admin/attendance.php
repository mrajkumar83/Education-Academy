<?php
	$step = '2';
	$path = '..';
	$title = 'Add Attendance';
	$css = array('styles.css', 'jquery.datepick.css');
	$js = array('register.js', 'date/jquery.datepick.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_attendance ', ' * ', ' role_id="'.$id.'"');	
		$role_name = $data->role_name;
		$role_status = $data->role_status;
		$pageTitle = 'Edit Role';
	}
	else
	{
		$student_id = '';
		$date = '';	
		$attendance	= '';
	}
?>
<div id="main">
		<div class="top-bar"><h1><?php echo $title;?></h1></div>
	<?php 
	require_once('../admin/attendance.php');
	?>
</div>
</body>
</html>

