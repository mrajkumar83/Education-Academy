<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';

$_POST['resume_doc'] = (isset($_FILES['resume_doc']) && isset($_FILES['resume_doc']['name']) && ($_FILES['resume_doc']['name'] != '')) ? fileupload('TXT','../resumes','resume_doc','N', '', $id) : '';
$_POST['resume_org_doc'] = $_FILES['resume_doc']['name'];

switch($op)
{
	case 'A':
	    $_POST['resume_crtby'] = $_SESSION['UID'];
		$_POST['resume_crtdate'] = 'DATESTAMP';
		$db->addToDB('tb_resume');
		
	break;
	
	case 'E':
		$_POST['resume_mdfby'] = $_SESSION['UID'];
		$_POST['resume_mdfdate'] = 'DATESTAMP';
		$db->updateDB('tb_resume',$id,'	resume_id');
	break;

	case 'D':
			$db->delData('tb_resume', ' resume_id="'.$id.'"');			
	break;
}
header('Location: ../manage_resume.php?sts='.$sts);
exit;