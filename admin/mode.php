<?php
	$step = '2';
	$path = '.';
	$title = 'Add Payment Mode';
	$css = array('styles.css');
	$js = array('mode.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$grade = $db->fetchRecord(' tb_mode ' , ' 	mode_id,mode_name,mode_status,mode_createdby,mode_modifiedby ', NULL , NULL, null, NULL, 0,'All');
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	$mode_name = '';
	$mode_status = 'A';
	
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_mode ', ' * ', ' mode_id="'.$id.'"');	
		
		$mode_name = $data->mode_name;
		$mode_status = $data->mode_status;
		$pageTitle = 'Edit Mode';
		
		$data1 = $db->fetchAllRecord('tb_mode_fields ' , ' mode_field_id,mode_field_name ', ' mode_id="'.$id.'"' , NULL, NULL, NULL,NULL,'All');
	}
?>
<div id="main">
	<div class="top-bar"><h1><?php echo $title;?></h1></div>
	<?php 
	require_once('templates/mode.php');
	?>
</div>
</body>
</html>

