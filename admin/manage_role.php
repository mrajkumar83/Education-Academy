<?php
	$step = '2';
	$path = '.';
	
	$title =  'Role';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	require_once('includes/common.php');
	
	$db = new Query();
	$role = $db->fetchAllRecord(' tb_roles ' , ' role_id,role_name,role_status,role_permission ', NULL , NULL, null, NULL, 0,'All');
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage  Role</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Role Name</th>
   		<th>Role Permission</th>
		<th>Status</th>
		<th>Action</th>
      </thead>
	  <tbody>
      <?php
		$row=0;
		$permissions = array("C"=>"Counselor","F"=>"Finance","O"=>"Operational","H"=>"HR");
		while($data = mysql_fetch_object($role))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      			echo '<td>',$data->role_name,'</td>',"\n";
      			echo '<td>',$permissions[$data->role_permission],' (',$data->role_permission,')</td>',"\n";
				echo '<td class="center">',($data->role_status == 'A' ? '' : 'In-'),'Active</td>';
      			echo '<td class="center"><a href="role.php?op=E&amp;id=',$data->role_id,'" title="Edit Role" alt="Edit Role"><div class="img edit"></div></a>&nbsp;';
				echo '<a href="../admin/logic/role_logic.php?op=D&amp;id=',$data->role_id,'" title="Delete Role" alt="Delete Role"><div class="img delete"></div></a>';
    		echo '</td></tr>',"\n";
			$row++;
		}
	?>
	</tbody>
  </table>
</div>
</body>
</html>

