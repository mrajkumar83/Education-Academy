<?php
	$step = '2';
	$path = '.';
	$title = 'Fee Receipts';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js','jquery.dataTables.min.js', 'datepicker/js/jquery-1.9.1.js','datepicker/js/jquery-ui-1.10.3.custom.js','managerem_dates.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$remark = $db->fetchAllRecord('tb_student_fees', ' fee_id,payment_date,amount_pay, balance ', 'std_id="'.$UID.'"', NULL, null, NULL, 0,'All');
?>

<div id="main">
  <div class="top-bar">
    <h1><?php echo $title;?></h1>
  </div>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Date</th>
		<th>Amount</th>
		<th>Balance</th>
      </thead>
      
      <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($remark))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      		echo '<td><a href="receipt.php?fid=',$data->fee_id,'">',$data->payment_date,'</a></td>',"\n";
			echo '<td>',$data->amount_pay,'</td>',"\n";
			echo '<td>',$data->balance,'</td>',"\n";
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>