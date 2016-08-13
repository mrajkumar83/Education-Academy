<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
$db = new Query();

if(isset($id) && $id != '')
{
	if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
        list($std_batch, $std_branch) = explode("::", $batchbranch);
	}
	if(isset($batch_name) && trim($batch_name) != '')
	{
		$db->fetchRecord(' tb_batch ', ' * ', ' batch_name="'.trim($batch_name).'" AND batch_id<>"'.$id.'" ');
	}
	if(isset($branch_name) && trim($branch_name) != '')
	{
		$db->fetchRecord(' tb_branches ', ' * ', ' branch_name="'.trim($branch_name).'" AND branch_id<>"'.$id.'" ');
	}
	
	if(isset($course_name) && trim($course_name) != '')
	{
		$db->fetchRecord(' tb_courses ', ' * ', ' course_name="'.trim($course_name).'" AND course_id<>"'.$id.'" ');
	}
	if(isset($call_sts_type) && trim($call_sts_type) != '')
	{
		$db->fetchRecord(' tb_call_sts ', ' * ', ' call_sts_type="'.trim($call_sts_type).'" AND call_sts_id <>"'.$id.'" ');
	}
	if(isset($skill_name) && trim($skill_name) != '')
	{
		$db->fetchRecord(' tb_skills ', ' * ', ' skill_name="'.trim($skill_name).'" AND skill_id <>"'.$id.'" ');
	}
	if(isset($role_name) && trim($role_name) != '')
	{
		$db->fetchRecord(' tb_roles ', ' * ', ' role_name="'.trim($role_name).'" AND role_id <>"'.$id.'" ');
	}
	if(isset($mode_name) && trim($mode_name) != '')
	{
		$db->fetchRecord(' tb_mode ', ' * ', ' mode_name="'.trim($mode_name).'" AND mode_id<>"'.$id.'" ');
	} 
	if(isset($std_email) && trim($std_email) != '')
	{
		list($batch, $branch) = explode('::', $batchbranch);
		//$db->fetchRecord(' tb_users ', ' * ', ' std_batch = "'.$batch.'" AND user_email="'.$std_email.'" AND user_id <> "'.$id.'"');
		$db->fetchRecord(' tb_student_details ', ' * ', ' std_batch = "'.$batch.'" AND std_email="'.$std_email.'" AND std_id <> "'.$id.'"');
	}
	if(isset($staff_email) && trim($staff_email) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', 'user_email="'.$staff_email.'" AND user_id <> "'.$id.'"');
	}
}
else
{
	if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
        list($std_batch, $std_branch) = explode("::", $batchbranch);
	}
	if(isset($batch_name) && trim($batch_name) != '')
	{
		$db->fetchRecord(' tb_batch ', ' * ', ' batch_name="'.trim($batch_name).'"');
	}
	
	if(isset($branch_name) && trim($branch_name) != '')
	{
		$db->fetchRecord(' tb_branches ', ' * ', ' branch_name="'.trim($branch_name).'"');
	}
	
	if(isset($course_name) && trim($course_name) != '')
	{
		$db->fetchRecord(' tb_courses ', ' * ', ' course_name="'.trim($course_name).'"');
	}
	if(isset($call_sts_type) && trim($call_sts_type) != '')
	{
		$db->fetchRecord(' tb_call_sts ', ' * ', ' call_sts_type="'.trim($call_sts_type).'"');
	}
	if(isset($skill_name) && trim($skill_name) != '')
	{
		$db->fetchRecord(' tb_skills ', ' * ', ' skill_name="'.trim($skill_name).'"');
	}
	if(isset($role_name) && trim($role_name) != '')
	{
		$db->fetchRecord(' tb_roles ', ' * ', ' role_name="'.trim($role_name).'"');
	}
	if(isset($mode_name) && trim($mode_name) != '')
	{
		$db->fetchRecord(' tb_mode ', ' * ', ' mode_name="'.trim($mode_name).'"');
	}
	if(isset($std_email) && trim($std_email) != '')
	{
		if(isset($batchbranch) && $batchbranch != '')
			list($batch, $branch) = explode('::', $batchbranch);
		else
			$batch = '';
			
		//$db->fetchRecord(' tb_users ', ' * ', ' std_batch = "'.$batch.'" AND user_email="'.$std_email.'" ');
		$db->fetchRecord(' tb_student_details ', ' * ', ' std_batch = "'.$batch.'" AND std_email="'.$std_email.'" ');
	}
	if(isset($staff_email) && trim($staff_email) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', 'user_email="'.$staff_email.'" ');
	}
	if(isset($user_name) && trim($user_name) != '')
	{
		$db->fetchRecord(' tb_users ', ' * ', 'user_name="'.$user_name.'" ');
	}
	if(isset($phno) && trim($phno) != '')
	{
		$db->fetchRecord(' tb_users u, tb_student_details s', ' * ', 'u.user_id=s.std_id AND u.user_type="GS" AND s.std_phno="'.$phno.'" ');
	}
}
echo ($db->getRowCount()>0) ? 'false' : 'true';
exit;