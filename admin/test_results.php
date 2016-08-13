<?php
	$step = '2';
	$path = '.';
	
	$title =  'Test Result';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$id = $_SESSION['UID'];
	$results = $db->fetchAllRecord(' tb_student_results ' , ' std_result_id,test_id,std_id,std_score,total_marks,DATE_FORMAT(std_test_date, "%c/%e/%Y") std_test_date ', ' std_id = "'.$id.'" And std_attendance = "P" ' , NULL, null, NULL, 0,'All');
	//$results = $db->fetchAllRecord(' tb_student_results ' , ' std_result_id,test_id,std_id,std_score,total_marks,DATE_FORMAT(std_test_date, "%c/%e/%Y") std_test_date ', ' std_id = "'.$id.'" ' , NULL, null, NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Results</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Test Name</th>
		<th>Test Date</th>
		<th>Total Mark</th>
		<th>Score</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($results))
		{
			$test = $db->fetchRecord('tb_test ' , ' test_id,test_name ', ' test_id ="'.$data->test_id.'" ' , NULL, 'test_name', NULL,NULL,'All');
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$test->test_name,'</td>',"\n";
				echo '<td>',$data->std_test_date,'</td>',"\n";
      			echo '<td>',$data->total_marks,'</td>',"\n";
				echo '<td>',$data->std_score,'</td>',"\n";
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

