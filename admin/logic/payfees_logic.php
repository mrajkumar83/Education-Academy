<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/fileupload.php');
require_once("../common/generate_password.php");
require_once("../common/attachsendmail.php");
require_once("../common/sms.php");

$db = new Query();

if ($op != 'D') {
    if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
        list($std_batch, $std_branch) = explode("::", $batchbranch);

        $_POST['std_batch'] = $std_batch;
        $_POST['std_branch'] = $std_branch;
        $_POST['user_branch'] = $std_branch;
    }
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
    $_POST['fee_status'] =  ($installment == 'N' || (int)$balance == 0) ? 'Approved' : 'Pending';
}
if (isset($std_batch) && $std_batch != '') {
    $batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_ampm,batch_startdt ', ' batch_id="' . $std_batch . '" ');

    $month = date('F Y', strtotime($batch_rec->batch_startdt));
    $fmonth = strtoupper($month[0]);
    $year = date('Y', strtotime($batch_rec->batch_startdt));
    $fyear = substr($year, 2);
    if (isset($batch_rec->batch_ampm) && $batch_rec->batch_ampm != '') {
        if ($batch_rec->batch_ampm == 'A') {
            $moreve = 'M';
        } else {
            $moreve = 'E';
        }
    }
}
$user = "ABC" . $fbranch . $branch_string;

$id = (isset($id)) ? $id : 0;
$sts = '';
switch ($op) {
    case 'A':
		if(isset($ext_std_id) && $ext_std_id >0){
			$username = $db->generatenextid('tb_users', 'user_name', $user, '000', ' user_name like "' . $user . '%" ');
			$pass_word = 'abc';
			$std_photo = (isset($_FILES['std_photo']) && isset($_FILES['std_photo']['name']) && ($_FILES['std_photo']['name'] != '')) ? fileupload('IMG', '../photos', 'std_photo', 'N', '', $ext_std_id) : '';
			
			$std_conv_fields = ' std_course="'.$std_course.'", std_batch="'.$std_batch.'", std_branch="'.$std_branch.'", std_type="I" '.(($std_photo != '') ? ', std_photo="'.$std_photo.'"' : '' );
			$db->storeDetails(' tb_users ', ' user_name="'.$username.'", user_branch="'.$std_branch.'", user_type="SD", user_password="'.md5($pass_word).'", user_modifedby="'.$_SESSION['UID'].'",	user_modifeddate="'.DATE_TIME_FORMAT.'" ', ' WHERE user_id="'.$ext_std_id.'" ');
			$db->storeDetails(' tb_student_details ', $std_conv_fields, ' WHERE std_id="'.$ext_std_id.'" ');
			
			$subject = 'Your Account Is Now Active';
				$fullname = htmlspecialchars(trim($std_fname . ' ' . $std_lname));
				require_once('../mails/student_mail.php');
				if($_POST['std_phno'] != '' && strlen($_POST['std_phno'])==10){
					sendSMS(1, $std_phno);
					sendSMS(2, $std_phno, $username, $pass_word);
				}
				mailClient($std_email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname); 
				
			$_POST['createdby'] = $_SESSION['UID'];
			$_POST['createddate'] = DATE_TIME_FORMAT;

			$_POST['installment_due_date'] = convert_date($installment_due_date);
			$_POST['payment_date'] = convert_date($fee_date);
			$_POST['std_id'] = $ext_std_id;

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
		}
    case 'E':
        if(($op == "A" && !isset($ext_std_id)) || ($op == "E" && isset($new) && $new == "new")) {
            $_POST['user_name'] = $db->generatenextid('tb_users', 'user_name', $user, '000', ' user_name like "' . $user . '%" ');
            $username = $_POST['user_name'];
            $pass_word = 'abc';//generate_password(6);
            $_POST['user_password'] = md5($pass_word);

            $_POST['user_type'] = 'SD';
            $_POST['user_createddate'] = 'DATESTAMP';
            $_POST['user_createdby'] = $_SESSION['UID'];
            $_POST['user_fullname'] = $std_fname . ' ' . $std_lname;
            $_POST['user_email'] = $std_email;
            $student_id = $db->addToDB('tb_users');
            
            if ($installment == "N") {
                $_POST['full_amt'] = $_POST['paid_amt'] = $amount_pay;
            } else {
                $_POST['full_amt'] = $amount_pay;
                $_POST['paid_amt'] = $balance;
            }

            $_POST['std_id'] = $student_id;
            $_POST['std_createdby'] = $_SESSION['UID'];
            $_POST['std_createddate'] = 'DATESTAMP';
            $_POST['std_photo'] = (isset($_FILES['std_photo']) && isset($_FILES['std_photo']['name']) && ($_FILES['std_photo']['name'] != '')) ? fileupload('IMG', '../photos', 'std_photo', 'N', '', $id) : '';
            $db->addToDB('tb_student_details');
			if (isset($student_id) && $student_id != '') {

                require_once('../mails/student_mail.php');
				
				$subject = 'Your Account Is Now Active';
				$fullname = htmlspecialchars(trim($std_fname . ' ' . $std_lname));
				if($_POST['std_phno'] != '' && strlen($_POST['std_phno'])==10){
					sendSMS(1, $_POST['std_phno']);
					sendSMS(2, $_POST['std_phno'], $username, $pass_word);
				}
				mailClient($std_email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname);               
            }
			
            if ($student_id) {
                $_POST['createdby'] = $_SESSION['UID'];
                $_POST['createddate'] = 'DATESTAMP';

                $_POST['installment_due_date'] = convert_date($installment_due_date);
                $_POST['payment_date'] = convert_date($fee_date);
                $_POST['std_id'] = $student_id;

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
            }
        } elseif ($op == "E" && isset($old) && $old == "old" && isset($tbl) && $tbl == "enquiry") {

            $_POST['user_name'] = $db->generatenextid('tb_users', 'user_name', $user, '000', ' user_name like "' . $user . '%" ');
            $username = $_POST['user_name'];
            $pass_word = 'abc';//generate_password(6);
            $_POST['user_password'] = md5($pass_word);
            $_POST['user_email'] = $_POST['std_email'];
            $_POST['user_type'] = 'SD';
            $_POST['user_createddate'] = 'DATESTAMP';
            $_POST['user_createdby'] = $_SESSION['UID'];
            $_POST['user_fullname'] = $_POST['std_fname'] . ' ' . $_POST['std_lname'];
            $student_id = $db->addToDB('tb_users');
			$db->delData('tb_enquiry', ' enquiry_id="' . $eid . '"');
			         

            if ($installment == "N") {
                $_POST['full_amt'] = $_POST['paid_amt'] = $amount_pay;
            } else {
                $_POST['full_amt'] = $amount_pay;
                $_POST['paid_amt'] = $balance;
            }

            $_POST['std_id'] = $student_id;
            $_POST['std_createdby'] = $_SESSION['UID'];
            $_POST['std_createddate'] = 'DATESTAMP';
            $_POST['std_photo'] = (isset($_FILES['std_photo']) && isset($_FILES['std_photo']['name']) && ($_FILES['std_photo']['name'] != '')) ? fileupload('IMG', '../photos', 'std_photo', 'N', '', $id) : '';
            $db->addToDB('tb_student_details');

			if (isset($student_id) && $student_id != '') {
				require_once('../mails/student_mail.php');
				
				$subject = 'Your Account Is Now Active';
				$fullname = htmlspecialchars(trim($std_fname . ' ' . $std_lname));
				
				mailClient($std_email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname);
            }

            $_POST['createdby'] = $_SESSION['UID'];
            $_POST['createddate'] = 'DATESTAMP';

            $_POST['std_id'] = $student_id;
            $_POST['installment_due_date'] = convert_date($installment_due_date);
            $_POST['payment_date'] = convert_date($fee_date);

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
                    $_POST['createdby'] = $_SESSION['UID'];
                    $_POST['createddate'] = 'DATESTAMP';
                    $db->addToDB('tb_fee_fields');
                }
            }
        } elseif ($op == "E" && !isset($tbl)) {
            $_POST['modifiedby'] = $_SESSION['UID'];
            $_POST['modifieddate'] = 'DATESTAMP';

            $_POST['std_id'] = $id;
            $_POST['installment_due_date'] = convert_date($installment_due_date);
            $_POST['payment_date'] = convert_date($fee_date);

            if ($installment == "N") {
                $_POST['paid_amt'] = $_POST['paid_amount'] = $amount_pay;
                $_POST['balance'] = '0.00';
            }

            $_POST['fee_id'] = $db->addToDB('tb_student_fees');

            if (isset($mode_fields_count) && $mode_fields_count != 0) {
                for ($i = 1; $i <= $mode_fields_count; $i++) {
                    $field_name = "mode_field_name" . $i;
                    $field_value = "mode_field_value" . $i;
                    $_POST['field_name'] = $$field_name;
                    $_POST['field_value'] = $$field_value;
                    $_POST['createdby'] = $_SESSION['UID'];
                    $_POST['createddate'] = 'DATESTAMP';
                    $db->addToDB('tb_fee_fields');
                }
            }
        }

        break;

    case 'D':
        $data = $db->fetchAllRecord(' tb_student_fees  ', ' * ', ' std_id=' . $id);

        while ($row = mysql_fetch_object($data)) {
            $db->delData('tb_fee_fields', ' fee_id="' . $row->fee_id . '"');
        }
        $db->delData('tb_student_fees', ' std_id="' . $id . '"');

        break;
}

header('Location: ../manage_payfees.php?sts=' . $sts);
exit;