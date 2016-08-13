<?php
	$step = '2';
	$path = '.';
	$title =  'Manage College';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$college = $db->fetchAllRecord(' tb_college ' , ' college_id,college_name,college_status ', NULL , NULL, NULL, NULL, 0,'All');
?>
<div id="main">
	<div class="top-bar">
        <h1><?php echo $title; ?></h1>
    </div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
    	<th>Sl No.</th>
		<th>Grade Name</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		$slno = 1;
		while($data = mysql_fetch_object($college))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
			echo '<td class="center">',$slno,'</td>',"\n";
      			echo '<td>',$data->college_name,'</td>',"\n";
				echo '<td class="center">',($data->college_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="college.php?op=E&amp;id=',$data->college_id,'" title="Edit college" alt="Edit College"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="../admin/logic/college_logic.php?op=D&amp;id=',$data->college_id,'" title="Delete college" alt="Delete College"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
			$slno++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

