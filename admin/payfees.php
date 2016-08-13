<?php
$step = '2';
$path = '.';
$title = 'Add Fee';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('fee.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'fee_dates.js');

require_once('includes/common.php');
require_once("common/generate_password.php");
$page_name = "addFee";

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "' . $user->user_branch . '" ';
$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);
$course = $db->fetchAllRecord(' tb_courses ', ' course_id,course_name ', ' course_status="A" ', NULL, ' course_name ', NULL, 0, 'All');
$mode = $db->fetchAllRecord(' tb_mode ', ' mode_id,mode_name,mode_status ', ' mode_status = "A" ', NULL, ' mode_name ', NULL, 0, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$eid = (isset($eid) && $eid > 0) ? $eid : '';
$utype= (isset($utype)) ? $utype : '';
$pagefrom = (isset($pagefrom)) ? $pagefrom : '';
$payfee_student_id = '';
$payfee_name = '';
$payfee_batch = '';
$payfee_cource = '';
$payment_date = '';
$payfee_photo = '';
$payfee_mode = '';
$cheque_no = '';
$branch = '';
$cheque_bank = '';
$installment = 'Y';
$installment_due_date = '';
$fee_date = date('m/d/Y');
$batchbranch = isset($batchbranch) ? $batchbranch : '';
$balance = isset($balance) ? $balance : 0;
$fee_mode = isset($fee_mode) ? $fee_mode : '';
$paid_amount = isset($paid_amount) ? $paid_amount : 0;
$balance = isset($balance) ? $balance : 0;
$std_photo = '';
$course_id = 0;

if ($op == 'E' && ($eid > 0 || $id >0)) {
    if (isset($tbl) && $tbl == "enquiry") {
    	
        $data1 = $db->fetchRecord(' tb_enquiry   ', ' *,CONCAT(enquiry_fname," ",enquiry_lname) as fullname ', ' enquiry_id="'.$eid.'" ');
        $batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_amount,batch_course ', ' batch_id="' . $data1->enquiry_batch . '" ');
        $course_rec = $db->fetchRecord(' tb_courses ', ' course_name ', ' course_id="' . $batch_rec->batch_course . '" ');
		$course_id = $batch_rec->batch_course;
    } else {
        $data1 = $db->fetchRecord(' tb_student_details   ', ' *,CONCAT(std_fname," ",std_lname) as fullname ', ' std_id="'.$id.'" ');
        $batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_amount,batch_course ', ' batch_id="' . $data1->std_batch . '" ');
        $branch_rec = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id="' . $data1->std_branch . '" ');
        $course_rec = $db->fetchRecord(' tb_courses ', ' course_name ', ' course_id="' . $batch_rec->batch_course . '" ');
		$course_id = $batch_rec->batch_course;
    }

    while (list($var, $val) = each($data1)) {
        $$var = $val;
    }
    if (isset($tbl) && $tbl == "enquiry") {
        $batchbranch = $enquiry_batch . "::" . $enquiry_branch;
    } else {
        $batchbranch = $std_batch . "::" . $std_branch;
    }
    $batch_name = $batch_rec->batch_name;
    $branch_name = (isset($branch_rec->branch_name)) ? $branch_rec->branch_name : '';
    $fee_amount = (isset($batch_rec->batch_amount)) ? $batch_rec->batch_amount : 0;
    $course_name = $course_rec->course_name;
	$course_id = (isset($batch_rec->batch_course)) ? $batch_rec->batch_course : 0;	
    $title = 'Edit Fee';
}
if($op =='A' && isset($ext_std_id) && $ext_std_id > 0){
	$data1 = $db->fetchRecord(' tb_student_details   ', ' *,CONCAT(std_fname," ",std_lname) as fullname ', ' std_id="'.$ext_std_id.'" ');
	while (list($var, $val) = each($data1)) {		
        $$var = $val;
    }
	
}
require_once('templates/payfees.php');

