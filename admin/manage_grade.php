<?php
	$step = '2';
	$path = '..';
	
	$title =  'Healthy School';
	$css = array('miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$grade = $db->fetchAllRecord(' tb_grade ' , ' grade_id,grade_name,grade_status ', NULL , NULL, null, NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar"><h1>Manage Grade</h1><input type="button" value="ADD" class="addBtn" onclick="document.location.href='grade.php?op=A';"></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Grade Name</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($grade))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->grade_name,'</td>',"\n";
				echo '<td class="center">',($data->grade_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="grade.php?op=E&amp;id=',$data->grade_id,'" title="Edit Grade" alt="Edit Grade"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="../admin/logic/grade_logic.php?op=D&amp;id=',$data->grade_id,'" title="Delete Grade" alt="Delete Grade"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

