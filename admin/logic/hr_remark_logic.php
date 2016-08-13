<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");
require_once("../store_remarks.php");
$id = (isset($id)) ? $id : 0;
$sts = '';
$intrerview_date = $_POST['hr_intr_date'] = convert_date($hr_intr_date);
$_POST['hr_document'] = (isset($_FILES['hr_document']) && isset($_FILES['hr_document']['name']) && ($_FILES['hr_document']['name'] != '')) ? fileupload('TXT','../hrremarks','hr_document','N', '', $id) : '';

if(isset($batchbranch) && strpos($batchbranch,"::")!==false)
{
	list($hr_batch_id,$hr_branch_id) = explode("::",$batchbranch);	
	$_POST['hr_batch_id'] = $hr_batch_id;	
	$_POST['hr_branch_id'] = $hr_branch_id;
}


switch($op)
{
	case 'A':
	    $_POST['hr_crtby'] = $_SESSION['UID'];
		$_POST['hr_crtdate'] = 'DATESTAMP';
		$hr_id = $db->addToDB('tb_hr');
		if(isset($hr_id) && $hr_id != '')
		{
			
			store_data($_POST['hr_document'],$hr_id,$intrerview_date,$hr_batch_id,$hr_branch_id);
			
			echo '<table cellpadding="2" cellspacing="0" align="center" border="0" width="100%">
    
				<tr><td height="300" align="center"><table border="1" width="40%">
				<tr><td align="center">Remarks submited successfully for '.$hr_intr_date.'.<br />
			<br />
			</td></tr></table></td></tr>
			  </table>';
		}
		
		
	break;
	case 'E':
		
		$_POST['hr_modby'] = $_SESSION['UID'];
		$_POST['hr_crtdate'] = 'DATESTAMP';
		$db->updateDB('tb_hr',$id,'hr_id');
		
	break;

	case 'D':
			$db->delData('tb_attendance1', ' attendance_id="'.$id.'"');			
	break;
}
//header('Location: ../staff_attendance.php?sts='.$sts);
//xit;