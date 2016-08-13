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
$fields = ' call_sts_type="'.$call_sts_type.'", call_sts_status = "'.htmlspecialchars(trim($call_sts_status)).'" ';


switch($op)
{
	case 'A':
		
		$store = $db->storeDetails('tb_call_sts', $fields);
		$id = $db->newRowId;
		
	break;
	case 'E':
		
		$db->storeDetails('tb_call_sts', $fields, ' WHERE call_sts_id = "'.$id.'"');
	break;

	case 'D':
			$db->delData('tb_call_sts', ' call_sts_id ="'.$id.'"');			
	break;
}
header('Location: ../managecallstatus.php?sts='.$sts);
exit;