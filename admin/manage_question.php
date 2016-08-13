<?php
	$step = '2';
	$path = '..';
	
	$title =  'Question';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$question = $db->fetchAllRecord(' tb_test_details ' , ' test_qust_id,test_id,test_question ', NULL , NULL, null, NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Question</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Question</th>
		<th>Test Name</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($question))
		{
			$test = $db->fetchRecord('tb_test ' , ' test_id,test_name ', ' test_id ="'.$data->test_id.'" ' , NULL, 'test_name', NULL,NULL,'All');
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->test_question,'</td>',"\n";
				echo '<td>',$test->test_name,'</td>',"\n";
      			echo '<td class="center"><a href="question.php?op=E&amp;id=',$data->test_qust_id,'" title="Edit Question" alt="Edit Question"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="../admin/logic/question_logic.php?op=D&amp;id=',$data->test_qust_id,'" title="Delete Question" alt="Delete Qquestion"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

