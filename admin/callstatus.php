<?php
	$step = '2';
	$path = '.';
	$title = 'Add Call Status';
	$css = array('styles.css');
	$js = array('callsts.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$course = $db->fetchRecord(' tb_call_sts ' , ' 	call_sts_id,call_sts_type,call_sts_status ', NULL , NULL, null, NULL, 0,'All');
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_call_sts ', ' * ', ' call_sts_id ="'.$id.'"');
		$call_sts_type = $data->call_sts_type;
		$call_sts_status = $data->call_sts_status;
		$pageTitle = 'Edit Call Status';
	}
	else
	{
		$call_sts_status = 'A';
		$call_sts_type = '';		
	}
?>
<div id="main">
	<div class="top-bar"><h1><?php echo $title;?></h1></div>
	<?php 
	require_once('./templates/callstatus.php');
	?>
</div>
</body>
</html>

