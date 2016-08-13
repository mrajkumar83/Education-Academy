<?php
$path = './admin/';

require_once($path . 'common/configure.php');
require_once($path . 'classes/Database.class.php');
require_once($path . 'classes/Query.class.php');

$std_msg = 'Think again!!';
$db = new Query();
$std_type = ((isset($op) && $op == 'Y') ? 'Y' : 'N');
$pass = $sphno;
$fname = $sname;
$mail = $smail;
$user = 'ABC'.date('my');
$username = $db->generatenextid('tb_users', 'user_name', $user, '0000', ' user_name like "' . $user . '%" ');
$std_rec = $db->fetchRecord(' tb_users U, tb_student_details S ', ' S.std_id, S.std_type ', ' U.user_id=S.std_id AND S.std_phno="'.$sphno.'" AND U.user_email="'.$smail.'" AND U.user_fullname="'.htmlspecialchars(trim($sname)).'" AND U.user_type="ES" AND U.user_status="A" ');

if($db->getRowCount() == 0 && $std_type == 'Y'){
	$user_fields = ' user_name="'.$username.'", user_password="'.md5($sphno).'", user_email="'.$smail.'", user_fullname="'.htmlspecialchars(trim($sname)).'", user_type="ES", user_status="A",  user_createdby="0", user_createddate="'.DATE_TIME_FORMAT.'"';
	$db->storeDetails('tb_users', $user_fields);
	$id = $db->newRowId;
	if (isset($id) && $id != '') {			
		$fields = 'std_id="'.$id.'", std_fname="'.htmlspecialchars(trim($sname)).'",std_phno="'.$sphno.'",std_email="'.$smail.'", std_createdby="0", std_createddate="'.DATE_TIME_FORMAT.'", std_type="'.$std_type.'" ';
		$db->storeDetails('tb_student_details', $fields);
		if((isset($op) && $op == 'Y')){
			require_once($path . 'mails/interactive-mail2.php');
			require_once($path . 'common/sms.php');
			require_once($path . 'common/attachsendmail.php');
			
			$msg = str_replace('<STD_NAME>', $sname, $body);
			$msg = str_replace('<UNAME>', $username, $msg);
			$msg = str_replace('<PHONENO>', $sphno, $msg);
			$subject = 'ABCforJAVA: Login Alert';
			sendSMS(11, $sphno, htmlspecialchars(trim($sname)), $username);
			mailClient($smail, $msg, $subject, ADMINNAME, ADMINMAIL, $sname);
			$std_msg = 'Please wait your request is being processed.<br><br>
						Your request has been accepted.<br><br>
						Your unique ABC-ID is <strong>'.$username.'</strong> and Password is <strong>'.$sphno.'</strong>.<br><br>
						To receive call letters for the mentioned drives, visit our website <a href="www.abcforjava.org">www.abcforjava.org</a>.  And provide your academic details so that call letters can be sent to u based on eligibility criteria set by the companies.<br><br>
						Use your unique ABC-ID for logging in.
						';
		}
	}
}//End of db count
else
{
	if($std_type == 'Y' && $std_rec->std_type == 'N'){
		$db->storeDetails(' tb_student_details ', ' std_type="Y" ', ' std_id="'.$std_rec->std_id.'" ');
		$std_msg = 'Thanks for changing your opinion ..';
	}
	if($std_rec->std_type == 'Y'){
		if($std_type == 'Y'){
			$std_msg = 'You are already registered with us.';
		}else{
			$db->storeDetails(' tb_student_details ', ' std_type="N" ', ' std_id="'.$std_rec->std_id.'" ');
			$std_msg = 'You might be missing right opportunities. Think again!!';
		}
	}
}
require_once($path . 'templates/thanks.php');