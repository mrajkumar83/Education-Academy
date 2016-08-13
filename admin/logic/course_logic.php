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
$fields = ' course_name="'.htmlspecialchars(trim($course_name)).'", course_desc="'.htmlspecialchars(trim($course_desc)).'", course_status="'.$course_status.'" ';

switch($op)
{
	case 'A':
		$fields .=' , course_createdby = "'.$_SESSION['UID'].'", course_createddate = "'.date(DATE_TIME_FORMAT).'"';
		$store = $db->storeDetails('tb_courses', $fields);
		$id = $db->newRowId;
		
	break;
	case 'E':
		$fields .=' , 	course_modifedby = "'.$_SESSION['UID'].'", course_modifeddate = "'.date(DATE_TIME_FORMAT).'"';
		$db->storeDetails('tb_courses', $fields, ' WHERE course_id = "'.$id.'"');
	break;

	case 'D':
			$db->delData('tb_courses', ' course_id="'.$id.'"');			
	break;
}
header('Location: ../manage_course.php?sts='.$sts);
exit;