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
$date = convert_date($date);
$fields = ' student_id="'.$student_id.'", date = "'.$date.'", attendance = "'.$attendance.'" ';


switch($op)
{
	case 'A':
		$store = $db->storeDetails('tb_attendance', $fields);
		$id = $db->newRowId;
		
	break;
	case 'E':
		$db->storeDetails('tb_attendance', $fields, ' WHERE attendance_id = "'.$id.'"');
	break;

	case 'D':
			$db->delData('tb_attendance', ' attendance_id="'.$id.'"');			
	break;
}
header('Location: ../attendance.php?sts='.$sts);
exit;