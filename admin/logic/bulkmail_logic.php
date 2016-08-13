<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once("../common/attachsendmail.php");
require_once("../common/sms.php");

$db = new Query();
$to = $email = '';

if(isset($ty) && $ty === 'E'){
	require_once("../common/xlreader.php");
	require_once('../common/fileupload.php');
	$file = fileupload('TXT','../ext-std','stdlist','N');
	$arr = read_file($file, 3, 'ext-std/');
	$arr_cnt = count($arr);
	
	for($i=0; $i<$arr_cnt; ++$i)
	{
		if($arr[$i][1] != '' && filter_var($arr[$i][1], FILTER_VALIDATE_EMAIL) && $arr[$i][2] != '' && strlen($arr[$i][2])==10){
			$to .= $arr[$i][0].',';
			$email .= $arr[$i][1].',';
			$user = 'ABC'.date('my');
			$username = $db->generatenextid('tb_users', 'user_name', $user, '0000', ' user_name like "' . $user . '%" ');
			$user_fields = ' user_name="'.$username.'", user_password="'.md5($arr[$i][2]).'", user_email="'.$arr[$i][1].'", user_fullname="'.htmlspecialchars(trim($arr[$i][0])).'", user_type="ES", user_status="A",  user_createdby="'.$_SESSION['UID'].'", user_createddate="'.DATE_TIME_FORMAT.'"';
			$db->storeDetails('tb_users', $user_fields);
			$id = $db->newRowId;
			if (isset($id) && $id != '') {			
				$fields = 'std_id="'.$id.'", std_fname="'.$arr[$i][0].'",std_phno="'.$arr[$i][2].'",std_email="'.$arr[$i][1].'", std_createdby="'.$_SESSION['UID'].'", std_createddate="'.DATE_TIME_FORMAT.'" ';
				$db->storeDetails('tb_student_details', $fields);
				sendSMS(10, $arr[$i][2], $username);
			}
		}
	}//End of for(;;)	

}else
{
	$cond = ($batchbranch == 'A') ? NULL : ' std_batch = "' . $batchbranch . '" ';

	$std_obj = $db->fetchAllRecord(' tb_student_details ', ' std_fname, std_lname, std_phno, std_email ', $cond, NULL, null, NULL, 0, 'All');

	while ($std = mysql_fetch_object($std_obj)) {
		
		if($std->std_phno != '' && strlen($std->std_phno)==10){
			sendSMS(9, $std->std_phno);
		}
		
		if($std->std_email != '' && filter_var($std->std_email, FILTER_VALIDATE_EMAIL)){
			$to .= $std->std_fname.' '.$std->std_lname.',';
			$email .= $std->std_email.',';		
		}	
	}//End of while{} 
}
//echo trim($to, ','), '', trim($email, ',');exit;
mailClient(ADMINMAIL,$msg, $subject, ADMINNAME, ADMINMAIL, trim($to, ','), '', trim($email, ','));
header('Location: ../send_bulk_msg.php?sts=S');
exit;