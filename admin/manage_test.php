<?php
	$step = '2';
	$path = '.';
	
	$title =  'TEST';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	$current_time =   date("H:i:s", mktime(date('H')+5,date('i')+30,date('s')));
	$current_datetime = strtotime(date("Y-m-d ".$current_time." "));
	require_once('includes/common.php');
	
	$db = new Query();
	$test = $db->fetchAllRecord(' tb_test ' , ' test_id,test_name,test_sdate,test_branch,test_batch,test_time,test_endtime ', NULL , NULL, null, NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Test</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Test Name</th>		
		<th>Allocated To</th>
		<th>Duration</th>
        <th>Test Date</th>
        <th>Results</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($test))
		{
			$testtime = strtotime(date($data->test_sdate.' '. $data->test_endtime)) ;
			$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id="'.$data->test_branch.'"');
			$batch = $db->fetchRecord(' tb_batch ', ' batch_name,batch_branch ', ' batch_id="'.$data->test_batch.'"');
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->test_name,'</td>',"\n";
				echo '<td align="center">',$batch->batch_name,'&nbsp;[',$branch->branch_name,']</td>',"\n";
				echo '<td align="center">',$data->test_time,'</td>',"\n";
				echo '<td class="center">',date("m/d/Y",strtotime($data->test_sdate)),'</td>';
				echo '<td class="center"><a href="manage_test_results.php?test_id=',$data->test_id,'" title="View Results" alt="View Test">View</a>&nbsp;';
      			echo '<td class="center"><a href="test.php?op=E&amp;id=',$data->test_id,'" title="Edit Test" alt="Edit Test"><div class="img edit"></div></a>&nbsp;';
				
				if(isset($testtime) && ($current_datetime > $testtime ))
				{
					echo '<a href="student_rank.php?id=',$data->test_id,'" title="Results" alt="Results"><img src="img/result.png" /></a>&nbsp;';
				}
				
				
				echo '<a href="../admin/logic/test_logic.php?op=D&amp;id=',$data->test_id,'" title="Delete Test" alt="Delete Test"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

