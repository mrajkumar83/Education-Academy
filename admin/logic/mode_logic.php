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

#$fields = ' mode_name="'.htmlspecialchars(trim($mode_name)).'", mode_status = "'.$mode_status.'" ';


switch($op)
{
	case 'A':
		/*$fields .=' , mode_createdby = "'.$_SESSION['UID'].'", mode_createddate = "'.date(DATE_TIME_FORMAT).'"';
		$store = $db->storeDetails('tb_mode', $fields);*/
		#$id = $db->newRowId;
		
		$_POST['mode_createdby'] = $_SESSION['UID'];
		$_POST['mode_createddate'] = 'DATESTAMP';
		$id = $db->addToDB('tb_mode');
		
		if(isset($mode_fields) && is_array($mode_fields) && count($mode_fields))
		{
			for($i = 0; $i < count($mode_fields); $i++)
			{
				if(isset($mode_fields[$i]) and $mode_fields[$i]!='')
				{
					$_POST['mode_field_id'] = $db->newID('tb_mode_fields','mode_field_id');
					$_POST['mode_id'] = $id;
					$_POST['mode_field_name'] =  $mode_fields[$i];
					$_POST['mode_field_createdby'] =  $_SESSION['UID'];
					$_POST['mode_field_createddate'] = "DATESTAMP";							
					$db->addToDB('tb_mode_fields');
				}
			}
		}

	break;
	case 'E':
		/*$fields .=' , 	mode_modifiedby = "'.$_SESSION['UID'].'", mode_modifieddate = "'.date(DATE_TIME_FORMAT).'"';
		$db->storeDetails('tb_mode', $fields, ' WHERE mode_id = "'.$id.'"');*/
		
		$_POST['mode_modifiedby'] = $_SESSION['UID'];
		$_POST['mode_modifieddate'] = 'DATESTAMP';
		$db->updateDB('tb_mode',$id,'mode_id');
		$db->delData('tb_mode_fields', ' mode_id="'.$id.'"');
		if(isset($mode_fields) && is_array($mode_fields) && count($mode_fields))
		{
			for($i = 0; $i < count($mode_fields); $i++)
			{
				if(isset($mode_fields[$i]) and $mode_fields[$i]!='')
				{
					$_POST['mode_field_id'] = $db->newID('tb_mode_fields','mode_field_id');
					$_POST['mode_id'] = $id;
					$_POST['mode_field_name'] =  $mode_fields[$i];
					$_POST['mode_field_createdby'] =  $_SESSION['UID'];
					$_POST['mode_field_createddate'] = "DATESTAMP";							
					$db->addToDB('tb_mode_fields');
				}
			}
		}
		
	break;

	case 'D':
			$db->delData('tb_mode', ' mode_id="'.$id.'"');
			$db->delData('tb_mode_fields', ' mode_id="'.$id.'"');			
	break;
}

header('Location: ../manage_mode.php?sts='.$sts);
exit;