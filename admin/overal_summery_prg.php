<?php
$step = '2';
$path = '.';
$title = 'Over-All Financial Summary, ABC for Java & Testing';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('batch.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'batch_dates.js');
require_once('includes/common.php');

$current_date = date("Y-m-d"); 
$db = new Query();

$branch = $db->fetchAllRecord(' tb_branches ', ' branch_name ', NULL, NULL, null, NULL, 0, 'All');
$branch_count = $db->getRowCount();

$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name ', NULL, NULL, null, NULL, 0, 'All');
$batch_count = $db->getRowCount();

$student = $db->fetchAllRecord(' tb_student_details ', ' std_id ', ' std_batch != 0 ' , NULL, null, NULL, 0, 'All');
$student_count = $db->getRowCount();

$sumunpaidamt = 0;  
$sumpaidamt = 0;                    

$paidfee = $db->fetchAllRecord(' tb_student_fees ', ' sum(paid_amount)  ', NULL, NULL, null, NULL, 0, 'All');
while ($paidfee_rec = mysql_fetch_object($paidfee)) 
{
  $sumpaidamt = $sumpaidamt + $paidfee_rec->paid_amount;
}

$deu = $db->fetchAllRecord(' tb_student_fees ', ' paid_amount,balance  ', NULL, NULL, null, NULL, 0, 'All');
while ($deu_rec = mysql_fetch_object($deu)) 
{
  $sumunpaidamt = $sumunpaidamt + $deu_rec->balance;
}
    
 
if(isset($submit) && $submit == 'ON-GOING BATCHES')
{
	$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name,batch_id ', ' batch_enddt >= "'.$current_date.'" ', NULL, null, NULL, 0, 'All');
	$batch_count = $db->getRowCount();
	$branch = $db->fetchAllRecord(' tb_batch ', ' DISTINCT batch_branch ', ' batch_enddt >= "'.$current_date.'" ', NULL, null, NULL, 0, 'All');
	$branch_count = $db->getRowCount();
	$student_count = 0;
	$sumpaidamt = 0;
	$sumunpaidamt = 0;
	while ($batch_rec = mysql_fetch_object($batch)) {
		$student = $db->fetchAllRecord(' tb_student_details ', ' std_id ', ' std_batch = "'.$batch_rec->batch_id.'" ' , NULL, null, NULL, 0, 'All');
		$std_rec= $db->getRowCount();
		$student_count = $student_count + $std_rec;
		while($std_rec = mysql_fetch_object($student))
		{
			$paidfee = $db->fetchAllRecord(' tb_student_fees ', ' paid_amount,balance ', ' std_id="' . $std_rec->std_id . '"');
			while($paidfee_rec = mysql_fetch_object($paidfee))
				{
					$balance = $paidfee_rec->balance;
					$sumpaidamt = $sumpaidamt + $paidfee_rec->paid_amount;
				}
			
			$sumunpaidamt = $sumunpaidamt + $balance;
		}
	}
	  
}

$submit = isset($submit) ? $submit : '';
$student_count = 0;
$sumpaidamt = 0;
$sumunpaidamt = 0;

switch($submit){
	case 'ON-GOING BATCHES':
		$heading = 'On-Going Batches Details';  
	break;
	
	case 'COMPLETED BATCHES':
		$heading = 'Completed Batches Details';

		$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name,batch_id ', ' batch_enddt < "'.$current_date.'" ', NULL, null, NULL, 0, 'All');
		$batch_count = $db->getRowCount();
		
		$branch = $db->fetchAllRecord(' tb_batch ', ' DISTINCT batch_branch ', ' batch_enddt < "'.$current_date.'" ', NULL, null, NULL, 0, 'All');
		$branch_count = $db->getRowCount();
		
		while ($batch_rec = mysql_fetch_object($batch)) {
			$student = $db->fetchAllRecord(' tb_student_details ', ' std_id ', ' std_batch = "'.$batch_rec->batch_id.'" ' , NULL, null, NULL, 0, 'All');
			$std_rec= $db->getRowCount();
			$student_count = $student_count + $std_rec;
			while($std_rec = mysql_fetch_object($student))
			{
				$paidfee = $db->fetchRecord(' tb_student_fees ', ' paid_amount,balance ', ' std_id="' . $std_rec->std_id . '"');
				$sumpaidamt = $sumpaidamt + $paidfee->paid_amount;
				$sumunpaidamt = $sumunpaidamt + $paidfee->balance;
			}
		}
	break;
	
	default:
		$heading = 'Over-All Details'; 
	break;
	
}//End of switch()                
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/overal_summery.php');?>
</div>
</body>
</html>

