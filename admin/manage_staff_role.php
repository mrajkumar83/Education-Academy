<?php
	$step = '2';
	$path = '..';
	
	$title =  'School Management';
	$css = array('miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$result = $db->fetchAllRecord(' tb_users ' , ' user_id,user_name,user_fullname,user_email,user_role,user_status ', 'user_type'.(($utype=='SF') ? '<>"SD" AND user_id<>"'.$UID: '="'.$utype) .'" AND user_type<>"SA"  ' , NULL, '  user_name', NULL, 0,'All');
	
	
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Staff Role</h1></div>
	  <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Staff Name</th>
		<th>Role</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($result))
		{
			$role = $db->fetchAllRecord(' tb_roles ', ' * ', ' role_id="'.$data->user_role.'"');
			$role_rec = mysql_fetch_object($role);
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->user_fullname ,'</td>',"\n";
				echo '<td>',$role_rec->role_name,'</td>';
      			echo '<td class="center">',($data->user_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="#" title="Edit"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="#" title="Delete"><div class="img delete"></div></a>';
				
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

