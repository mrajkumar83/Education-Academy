<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");
extract($_REQUEST);
$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
$fields = ' role_name="'.htmlspecialchars(trim($role_name)).'", role_status = "'.$role_status.'" ';

switch($op)
{
	case 'A':
		$_POST['role_createdby'] = $_SESSION['UID'];
		$_POST['role_createddate'] = 'DATESTAMP';
		$id = $db->addToDB('tb_roles');
		
	
		/*$fields .=' , role_createdby = "'.$_SESSION['UID'].'", role_createddate = "'.date(DATE_TIME_FORMAT).'"';
		$fields.=' ,role_permission ="'.$role_permission.'"';
		$store = $db->storeDetails('tb_roles', $fields);
		$id = $db->newRowId;*/
			
	break;
	case 'E':
	
		/*$fields .=' , role_modifiedby = "'.$_SESSION['UID'].'", role_modifieddate = "'.date(DATE_TIME_FORMAT).'"';
		$fields.=' ,role_permission ="'.$role_permission.'"';
		$db->storeDetails('tb_roles', $fields, ' WHERE role_id = "'.$id.'"');*/
		
		$_POST['role_modifiedby'] = $_SESSION['UID'];
		$_POST['role_modifieddate'] = 'DATESTAMP';
		$db->updateDB('tb_roles',$id,'role_id');
		

	break;

	case 'D':
			$db->delData('tb_roles', ' role_id="'.$id.'"');			
	break;
}
header('Location: ../manage_role.php?sts='.$sts);
exit;