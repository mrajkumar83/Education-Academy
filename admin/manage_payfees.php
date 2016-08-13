<?php
	$step = '2';
	$path = '.';
	
	$title =  'Pay Fees';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	//$result = $db->fetchAllRecord(' tb_student_fees AS f LEFT JOIN tb_student_details AS s on f.std_id = s.std_id ', ' f.*,CONCAT(std_fname," ",std_lname) as fullname ', NULL);
	$data = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "'.$_SESSION['UID'].'"');
	$sub_query = ' (SELECT SUM( paid_amount ) AS paid_amount FROM tb_student_fees WHERE std_id = U.user_id ) AS paid_amount ';
	$result1 = $db->fetchAllRecord(' tb_users U, tb_student_fees F  ', ' U.user_id AS std_id, U.user_name, U.user_fullname AS fullname, F.fee_id, F.balance, F.installment_due_date, F.installment,'.$sub_query , ' F.std_id = U.user_id '.((isset($UTYPE) && $UTYPE == 'SA')? '' :'AND U.user_branch = "'.$data->user_branch.'" '), NULL,NULL,NULL,0,'All');	
	
?>
 
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Fee</h1></div>
     <div style="background-color:#fff; padding:3px;" align="right"><input type="button" value="Add New Student" class="addBtn" onclick="document.location.href='payfees.php?op=A';"></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Username</th>
		<th>Student Name</th>
		<th>Paid Amount</th>
        <th>Balance</th>
        <th>Due Date</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data1 = mysql_fetch_object($result1))
		{						
			$class = ($row%2) ? 'even' : 'odd';
			$color = (!isset($data1->balance) || $data1->balance=="0.00") ? '#6DA828' : '#D80909';
			
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td align="center" style="color:'.$color.';"><strong>',$data1->user_name,'</strong></td>',"\n";
				echo '<td>',$data1->fullname,'</td>',"\n";
				
				echo '<td align="right">',$data1->paid_amount,'</td>',"\n";
				echo '<td align="right">',$data1->balance,'</td>',"\n";
				if($data1->installment == 'Y' && $data1->installment_due_date!='' && $data1->installment_due_date!='0000-00-00')
					echo '<td align="center">',date("d-M-Y",strtotime($data1->installment_due_date)),'</td>',"\n";
				else
					echo '<td align="center">&nbsp;&nbsp;N/A</td>';
				
				#echo '<td class="center">',($data->installment == 'Y' ? 'Yes' : 'No'),'</td>';
      			echo '<td class="center"><a href="payfees.php?op=E&amp;id=',$data1->std_id,'" title="Edit Payfee" alt="Edit Branch"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="../admin/logic/payfees_logic.php?op=D&amp;id=',$data1->std_id,'" title="Delete Payfee" alt="Delete Branch"><div class="img delete"></div></a>';
				echo '<a href="receipt.php?fid=',$data1->fee_id,'&amp;p=1" style="text-decoration:none;" target="_blank"><img src="./img/print-icon.png" border="0"></a>';
				echo '<a href="change_batch.php?id=',$data1->std_id,'" style="text-decoration:none;"><img src="./img/change-batch.gif" border="0"></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

