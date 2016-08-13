<?php
$step = '2';
$path = '.';
$title = 'Over-All Financial Summary, ABC for Java & Testing';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('batch.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'batch_dates.js');
require_once('includes/common.php');

$current_date = date("Y-m-d"); 
$db = new Query();

$submit = isset($submit) ? $submit : '';
$student_count = 0;
$branch_count = 0;
$sum_paid_amt = 0;
$sum_unpaid_amt = 0;
$batch_branch_arr = array();
$batch_branch_cnt = 0;

switch($submit){
	case 'ON-GOING BATCHES':
		$heading = 'On-Going Batches Details';  
		
		$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name,batch_id,batch_branch,batch_amount ', ' batch_enddt >= "'.$current_date.'" AND batch_startdt <= "'.$current_date.'" AND batch_status="A" ', NULL, null, NULL, 0, 'All');		
	break;
	
	case 'COMPLETED BATCHES':
		$heading = 'Completed Batches Details';

		$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name,batch_id,batch_branch,batch_amount ', ' batch_enddt < "'.$current_date.'"  AND batch_status="A" ', NULL, null, NULL, 0, 'All');		
	break;
	
	default:
		$heading = 'Over-All Details'; 
		
		$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name,batch_id,batch_branch,batch_amount ', '  batch_status="A" ', NULL, null, NULL, 0, 'All');	
	break;	
}//End of switch()
$batch_count = $db->getRowCount();
	
while ($batch_rec = mysql_fetch_object($batch)) {
	if(!in_array($batch_rec->batch_branch,$batch_branch_arr)){
		$batch_branch_arr[] = $batch_rec->batch_branch;
	}
	$info = $db->fetchRecord(' tb_student_details D LEFT JOIN tb_student_fees F ON F.std_id = D.std_id ', ' sum(paid_amount) paid_amt, count( DISTINCT (D.std_id) ) AS cnt ', ' std_batch = "'.$batch_rec->batch_id.'" ');
	$student_count += $info->cnt;
	$sum_paid_amt += $info->paid_amt;
	$sum_unpaid_amt += ($info->cnt*$batch_rec->batch_amount)- $info->paid_amt;
}
$batch_branch_cnt = count($batch_branch_arr);
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/overal_summery.php');?>
</div>
</body>
</html>