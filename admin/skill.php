<?php
	$step = '2';
	$path = '.';
	$title = 'Add Skills';
	$css = array('styles.css');
	$js = array('skill.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_skills ', ' * ', ' skill_id ="'.$id.'"');
		$skill_name = $data->skill_name;
		$skill_status = $data->skill_status;
		$pageTitle = 'Edit Skill';
	}
	else
	{
		$skill_status = 'A';
		$skill_name = '';		
	}
?>
<div id="main">
	<div class="top-bar"><h1><?php echo $title;?></h1></div>
	<?php 
	require_once('./templates/skill.php');
	?>
</div>
</body>
</html>

