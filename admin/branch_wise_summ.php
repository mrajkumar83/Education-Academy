
<?php
$step = '2';
$path = '.';
$title = 'Overall Financial Summery, ABC for Java & Testing';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('batch.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'batch_dates.js');
require_once('includes/common.php');

$db = new Query();
$student_count = 0;
$branch_count = 0;
$sum_paid_amt = 0;
$sum_unpaid_amt = 0;
$heading = 'Over-All Details';

$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', 'branch_id = "'.$id.'"' , NULL, null, NULL, 0, 'All');
$branchname = $branch->branch_name;
$batch = $db->fetchAllRecord(' tb_batch ', ' batch_name,batch_id,batch_amount ', ' batch_branch = "'.$id.'" ' , NULL, null, NULL, 0, 'All');
$batch_count = $db->getRowCount();

while ($batch_rec = mysql_fetch_object($batch)) {
	$info = $db->fetchRecord(' tb_student_details D LEFT JOIN tb_student_fees F ON F.std_id = D.std_id ', ' sum(paid_amount) paid_amt, count( DISTINCT (D.std_id) ) AS cnt ', ' std_batch = "'.$batch_rec->batch_id.'" ');
	$student_count += $info->cnt;
	$sum_paid_amt += $info->paid_amt;
	$sum_unpaid_amt += ($info->cnt*$batch_rec->batch_amount)- $info->paid_amt;
} 
	
 $ttl = $branchname.' Financial Summary, ABC for Java & Testing';
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $ttl; ?></h1></div>
    <?php require_once('templates/branch_wise_summ.php');?>
</div>
</body>
</html>

