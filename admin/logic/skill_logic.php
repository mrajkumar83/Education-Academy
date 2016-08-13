<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' skill_name="'.$skill_name.'", skill_status = "'.htmlspecialchars(trim($skill_status)).'" ';


switch($op)
{
	case 'A':
		
		$store = $db->storeDetails('tb_skills', $fields);
		$id = $db->newRowId;
		
	break;
	case 'E':
		
		$db->storeDetails('tb_skills', $fields, ' WHERE skill_id = "'.$id.'"');
	break;

	case 'D':
			$db->delData('tb_skills', ' skill_id ="'.$id.'"');			
	break;
}
header('Location: ../manage_skills.php?sts='.$sts);
exit;