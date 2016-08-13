<?php
	$step = '2';
	$path = '.';
	$title = 'Add Role';
	$css = array('styles.css');
	$js = array('role.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$role = $db->fetchRecord(' tb_roles ' , ' 	role_id,role_name,role_status ', NULL , NULL, null, NULL, 0,'All');
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	$role_name = '';
	$role_permission = 'C';
	$role_status = 'A';	
		
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_roles ', ' * ', ' role_id="'.$id.'"');	
		$role_name = $data->role_name;
		$role_permission = $data->role_permission;
		$role_status = $data->role_status;
		$pageTitle = 'Edit Role';
	}
?>
<div id="main">
		<div class="top-bar"><h1><?php echo $title;?></h1></div>
	<?php 
	require_once('templates/role.php');
	?>
</div>
</body>
</html>

