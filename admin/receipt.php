<?php
$path = '.';

require_once($path.'/common/configure.php');
require_once($path.'/classes/Database.class.php');
require_once($path.'/classes/Query.class.php');
require_once($path.'/classes/conversion.php');
require_once("dompdf/dompdf_config.inc.php");

$db = new Query();
$file_name = 'Receipt.pdf';

if(isset($fid) && $fid > 0){
	$tabl = ' tb_users U, tb_student_fees SF, tb_student_details SD LEFT JOIN tb_branches BR ON SD.std_branch = BR.branch_id LEFT JOIN tb_batch BT ON SD.std_batch = BT.batch_id ';
	$flds = ' U.user_name, U.user_email, U.user_fullname, SF.payment_date, SF.installment_due_date, SF.balance,SF.paid_amount,SD.std_phno, BR.branch_name, BT.batch_name, BT.batch_amount ';
	$cond = ' SF.fee_id="'.$fid.'" AND SF.std_id = SD.std_id AND SF.std_id=U.user_id ';
	$std = $db->fetchRecord($tabl, $flds, $cond);
	$obj    = new toWords($std->batch_amount);
	$file_name = str_replace(' ', '_', $std->user_fullname).'.pdf';
	//echo $obj->number; // gives 12,345.67
	require_once("templates/fee_reciept.php");
	//echo $receipt;exit;
}  
$old_limit = ini_set("memory_limit", "25M");
$dompdf = new DOMPDF();
$dompdf->load_html($receipt);
$dompdf->set_paper('letter', 'portrait');
$dompdf->render();
if(isset($p) && $p==1){
	$dompdf->stream($file_name, array("Attachment" => 0));
}else{
	$dompdf->stream($file_name);
}
exit(0);