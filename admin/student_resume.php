<?php
	$step = '2';
	$path = '.';
	
	$title =  'Resume';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$resume = $db->fetchAllRecord(' tb_resume ' , ' resume_id,resume_name,resume_doc,resume_status ', ' resume_status = "A" ' , NULL, null, NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Resume</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Resume Name</th>
      </thead>
	  <tbody>
      <?php
      
		$row=0;
		while($data = mysql_fetch_object($resume))
		{
			if(isset($data->resume_name) && $data->resume_doc)
			{
				$file = 'resumes/'.$data->resume_doc;
				if(file_exists($file))
				{
					$class = ($row%2) ? 'even' : 'odd';
					echo '<tr class="',$class,'">',"\n\t";
	      			echo '<td align="center"><a href="downloadfile.php?path=resumes&amp;filename=',$data->resume_doc,'" title="Download Resume" alt="Download Resume">',$data->resume_name,'</a>',"\n";
					//echo '<td>',$file,'</td>',"\n";
		    		echo '</td></tr>',"\n";
					$row++;
				}
			}
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

