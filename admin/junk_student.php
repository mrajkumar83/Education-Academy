<?php
	$step = '2';
	$path = '.';
	
	$title =  'Un Pay Fees';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	#$result = $db->fetchAllRecord(' tb_student_fees AS f LEFT JOIN tb_student_details AS s on f.std_id = s.std_id ', ' f.*,CONCAT(std_fname," ",std_lname) as fullname ', NULL);
	$data = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "'.$_SESSION['UID'].'"');
	if(isset($UTYPE) && $UTYPE == 'SA')
	{
	$result = $db->fetchAllRecord(' tb_enquiry   ', ' *,CONCAT(enquiry_fname," ",enquiry_lname) as fullname ', ' enquire_junk = "Yes"' ,NULL,NULL,NULL,0,'All');	
	}
	else {
		$result = $db->fetchAllRecord(' tb_enquiry   ', ' *,CONCAT(enquiry_fname," ",enquiry_lname) as fullname ', ' enquire_junk = "Yes" AND enquiry_branch = "'.$data->user_branch.'" ' ,NULL,NULL,NULL,0,'All');
	}
?>
 
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Junk Student</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
    	<th>Counselor Name</th>
    	<th>Counselor Email</th>
		<th>Student Name</th>
		<th>Student Email</th>
        <th>Phone No.</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$counselor = $db->fetchRecord(' tb_users ', ' user_fullname,user_email ', ' user_id="'.$data->enquiry_createdby.'"');
			echo '<tr class="',$class,'">',"\n\t";
			echo '<td>',$counselor->user_fullname,'</td>',"\n";
			echo '<td>',$counselor->user_email,'</td>',"\n";
      		echo '<td>',$data->fullname,'</td>',"\n";
			echo '<td align="middle">',$data->enquiry_email,'</td>',"\n";
			echo '<td align="middle">',$data->enquiry_phno,'</td>',"\n";
      		echo '<td class="center"><a href="junk_std_detail.php?op=E&amp;id=',$data->enquiry_id,'" title="View Details" alt="Edit Branch"><div class="img edit"></div></a>&nbsp;';
			echo '<a href="../admin/logic/enquiry_logic.php?op=DJ&amp;id=',$data->enquiry_id,'" title="Delete Unpaid fees" alt="Delete Branch"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

