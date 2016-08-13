<?php
	$step = '2';
	$path = '..';
	$title = 'Registration';
	$css = array('styles.css','register.css', 'jquery.datepick.css');
	$js = array('register.js', 'date/jquery.datepick.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$grade = $db->fetchRecord(' tb_grade ' , ' grade_id,grade_name,grade_status ', NULL , NULL, null, NULL, 0,'All');
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_grade ', ' * ', ' grade_id="'.$id.'"');	
		$grade_name = $data->grade_name;
		$grade_status = $data->grade_status;
		$pageTitle = 'Edit Grade';
	}
	else
	{
		$grade_name = '';
		$grade_status = 'A';		
	}
?>
<div id="main">
	<?php 
	require_once('../admin/grade.php');
	//require_once('page/grade.php');?>
</div>
</body>
</html>

