<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
//require_once('../common/fileupload.php');
//require_once("../common/generate_password.php");
//require_once("../common/attachsendmail.php");
//require_once("../common/sms.php");

$db = new Query();
list($std_batch, $std_branch) = explode("::", $batchbranch);

$data = $db->fetchRecord(' tb_batch ', ' batch_branch,batch_bid ', ' batch_id = "' . $_POST['std_batch'] . '"');
if (strpos($data->batch_bid, "B") !== false) {
	$batch_bid = explode("B", $data->batch_bid);
	$fbranch = $batch_bid[1];
} else {
	$fbranch = "0000";
}
$branch = $db->fetchRecord(' tb_branches ', ' branch_short_name ', ' branch_id="' . $_POST['std_branch'] . '" ');
$string = preg_replace('/[^A-Za-z0-9\-]/', '', $branch->branch_short_name);
$branch_string = substr($string, 0, 2);

$user = "ABC" . $fbranch . $branch_string;
$username = $db->generatenextid('tb_users', 'user_name', $user, '000', ' user_name like "' . $user . '%" ');
$pass_word = 'abc';

$data = $db->fetchAllRecord(' tb_student_fees  ', ' * ', ' std_id=' . $std_id);

while ($row = mysql_fetch_object($data)) {
	$db->delData('tb_fee_fields', ' fee_id="' . $row->fee_id . '"');
}
$db->delData('tb_student_fees', ' std_id="' . $std_id . '"');

$std_conv_fields = ' std_course="'.$std_course.'", std_batch="'.$std_batch.'", std_branch="'.$std_branch.'" ';
$db->storeDetails(' tb_users ', ' user_name="'.$username.'", user_password="'.md5($pass_word).'", user_branch="'.$std_branch.'", user_modifedby="'.$_SESSION['UID'].'",	user_modifeddate="'.DATE_TIME_FORMAT.'" ', ' WHERE user_id="'.$std_id.'" ');
$db->storeDetails(' tb_student_details ', $std_conv_fields, ' WHERE std_id="'.$std_id.'" ');

$sdata = $db->fetchRecord(' tb_student_details ', ' std_fname, std_lname, std_email, std_phno ', ' std_id="' .$std_id. '" ');
$std_fname = $sdata->std_fname;
$std_lname = $sdata->std_lname;
$std_email = $sdata->std_email;
$std_phno = $sdata->std_phno;
$subject = 'Your Account Is Now Active';
$fullname = htmlspecialchars(trim($std_fname . ' ' . $std_lname));
require_once('../mails/student_mail.php');
if($_POST['std_phno'] != '' && strlen($std_phno)==10){
	sendSMS(1, $std_phno);
	sendSMS(2, $std_phno, $username, $pass_word);
}
mailClient($std_email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname); 
			

$_POST['createdby'] = $_SESSION['UID'];
$_POST['createddate'] = 'DATESTAMP';

$_POST['installment_due_date'] = convert_date($installment_due_date);
$_POST['payment_date'] = convert_date($fee_date);
$_POST['std_id'] = $std_id;

if ($installment == "N") {
	$_POST['paid_amount'] = $amount_pay;
	$_POST['balance'] = '0.00';
}
$_POST['fee_id'] = $db->addToDB('tb_student_fees');

if (isset($mode_fields_count) && $mode_fields_count != 0) {
	for ($i = 1; $i <= $mode_fields_count; $i++) {
		$field_name = "mode_field_name" . $i;
		$field_value = "mode_field_value" . $i;
		$_POST['field_name'] = $$field_name;
		$_POST['field_value'] = $$field_value;
		$db->addToDB('tb_fee_fields');
	}
}
header('Location: ../manage_payfees.php?sts=CB');
exit;