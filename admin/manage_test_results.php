<?php
	$step = '2';
	$path = '.';
	
	$title =  'TEST';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$test = $db->fetchAllRecord(' tb_student_results r JOIN tb_users u on r.std_id= u.user_id ' , ' r.*,user_name ', ' test_id="'.$test_id.'" AND u.user_type="SD" ' , NULL, ' std_score desc ', NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Test</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Student ID</th>
        <th>Test Date</th>
        <th>Marks Scored</th>
		<!-- <th>Action</th> -->
      </thead>
	  <tbody>
      <?php
		$row=0;
		if($db->getRowCount() > 0)
		while($data = mysql_fetch_object($test)){
		//print_R($data);
			
			//$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id="'.$data->test_branch.'"');
			//$batch = $db->fetchRecord(' tb_batch ', ' batch_name,batch_branch ', ' batch_id="'.$data->test_batch.'"');
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->user_name,'</td>',"\n";
				$date_taken = (date("m/d/Y",strtotime($data->std_test_date)) == '01/01/1970') ? 'Not Applicable' : date("m/d/Y",strtotime($data->std_test_date));
				echo '<td class="center">',$date_taken,'</td>';
				//echo '<td align="center">',$batch->batch_name,'&nbsp;[',$branch->branch_name,']</td>',"\n";
				echo '<td align="center">',$data->std_score,'</td>',"\n";
				
      			//echo '<td class="center"><a href="test.php?op=E&amp;id=',$data->test_id,'" title="Edit Test" alt="Edit Test"><div class="img edit"></div></a>&nbsp;';
				//echo '<td class="center"><a href="../admin/logic/test_logic.php?op=D&amp;id=',$data->test_id,'" title="Delete Test" alt="Delete Test"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

