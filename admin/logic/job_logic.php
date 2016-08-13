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

$_POST['bd_interviewdate'] = convert_date($bd_interviewdate);
if(!isset($hr) || (isset($hr) && $hr==''))
{
	$hr="0";
}
if(isset($hr) && isset($min) && isset($ampm) && $hr != '' && $min != '' && $ampm != '')
{
	$_POST['bd_interviewtime'] = $hr.":".$min.":".$ampm;
	
}


if(isset($UTYPE) && $UTYPE == 'SA')
{
	$_POST['bd_branch'] = $bd_branch;
}
else {
	$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id="' . $_SESSION['UID'] . '"');
$_POST['bd_branch'] = $user->user_branch;
	
}
switch ($op) {
    case 'A':
		if(isset($job_qual) && is_array($job_qual))
		{
			$_POST['bd_qualification'] = implode(",",$job_qual);
		}
		if(isset($job_stream) && is_array($job_stream))
		{
			$_POST['bd_stream'] = implode(",",$job_stream);
		}
		$_POST['bd_user_id'] = $_SESSION['UID'];
        $_POST['bd_createddate'] = 'DATESTAMP';
        $_POST['bd_createdby'] = $_SESSION['UID'];
        $db->addToDB('tb_bd_job');

        $id = $db->newRowId;

        break;
    case 'E':
       if(isset($job_qual) && is_array($job_qual))
		{
			$_POST['bd_qualification'] = implode(",",$job_qual);
		}
		if(isset($job_stream) && is_array($job_stream))
		{
			$_POST['bd_stream'] = implode(",",$job_stream);
		}
        $_POST['bd_modifyby'] = $_SESSION['UID'];
        $_POST['bd_modifydate'] = 'DATESTAMP';
        $db->updateDB('tb_bd_job', $id, 'bd_job_id');

        break;

    case 'D':
        $db->delData('tb_bd_job', ' bd_job_id="' . $id . '"');
        break;
    
}
header('Location: ../manage_job.php?sts=' . $sts);
exit;