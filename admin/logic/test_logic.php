<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");
require_once("../store_test.php");
require_once("../common/sms.php");

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
$_POST['test_sdate'] = convert_date($test_sdate);	
$_POST['test_edate'] = convert_date($test_edate);	

/*$fields = ' test_name="'.htmlspecialchars(trim($test_name)).'", test_course = "'.$test_course.'" , 	test_batch = "'.$test_batch.'"
, test_branch = "'.$test_branch.'", test_date = "'.$test_date.'", test_starttime = "'.$test_starttime.'", test_endtime = "'.$test_endtime.'"
, test_time = "'.$test_time.'"';*/

$_POST['test_file'] = (isset($_FILES['test_file']) && isset($_FILES['test_file']['name']) && ($_FILES['test_file']['name'] != '')) ? fileupload('TXT','../papers','test_file','N', '', $id) : '';
$_POST['test_orgfile'] = $_FILES['test_file']['name'];
if(!isset($hr) || (isset($hr) && $hr==''))
{
	$hr="0";
}
$_POST['test_time'] = $hr.":".$min.":00";

//$_POST['test_sdate'] = convert_date($test_sdate) ." ". $hr1.":".$min1.":00";

$_POST['test_sdate'] = convert_date($test_sdate);

$test_etime_min = $min + $min1;
$test_etime_hr = $hr + $hr1+($test_etime_min >= 60 ? ($test_etime_min/60)  :  0 );
$test_etime_min = $test_etime_min >= 60 ? ($test_etime_min%60)  : $test_etime_min;

$_POST['test_starttime'] = $hr1.":".$min1.":00";
$_POST['test_endtime'] = (int)$test_etime_hr.":".$test_etime_min.":00";

if(isset($allocated_to) && strpos($allocated_to,"::")!==false)
{
	list($test_batch,$test_branch) = explode("::",$allocated_to);		
	$_POST['test_batch'] = $test_batch;	
	$_POST['test_branch'] = $test_branch;
	
}

switch($op)
{
	case 'A':
		$_POST['createddate'] = 'DATESTAMP';
		$test_id = $db->addToDB('tb_test');
		
		$students = $db->fetchAllRecord(' tb_student_details ', ' std_id,std_phno ', ' std_batch='.$test_batch.' and std_branch='.$test_branch.' ');
		while($row = mysql_fetch_object($students))
		{
			$_POST['std_id'] = $row->std_id;
			$_POST['test_id'] = $test_id;
			$_POST['std_score'] = "0.00";
			
		    $db->addToDB('tb_student_results');
			if($row->std_phno != '' && strlen($row->std_phno)==10){
				sendSMS(3, $row->std_phno, $_POST['test_sdate'], $_POST['test_starttime']);
			}
		}
		store_data($_POST['test_file'],$test_id);
		
	break;
	case 'E':
			$db->delData(' tb_test_details ', ' test_id="'.$id.'"');	
			$_POST['modifieddate'] = 'DATESTAMP';
			$db->updateDB('tb_test',$id,'test_id');
			store_data($_POST['test_file'],$id);
	break;

	case 'D':
			$db->delData('tb_test', ' test_id="'.$id.'"');			
	break;
}
header('Location: ../manage_test.php?sts='.$sts);
exit;