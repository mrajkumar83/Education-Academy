<?php
$step = '2';
$path = '.';
$title = 'Manage Student';
$css = array('miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

if (isset($UTYPE) && $UTYPE == 'SA') {
    $cond = ' U.user_type ="'.$utype.'" AND U.user_type!="SA"  ';
} else {
    $cond = ' U.user_type="' . $utype . '" AND U.user_type<>"SA" ';
}

$tables = (!isset($utype) || $utype == 'AD') ? ' tb_users U ' : ' tb_users US,tb_users U ';

if(isset($UTYPE))
switch ($UTYPE) {
    	case 'AD':
        $cond = ' U.user_type="'.$utype.'" AND US.user_id="' . $UID . '" AND U.user_branch=US.user_branch ';
        break;
		case 'SA':
        $cond = ' U.user_type="'.$utype.'" AND US.user_id="' . $UID . '" ';
        break;
		
		case 'SD':
			$tables = ' tb_users U ';
		break;
}
$tables .= ' LEFT JOIN tb_branches B ON B.branch_id=U.user_branch ';
$result = $db->fetchAllRecord($tables, ' U.user_id, U.user_name, U.user_fullname, U.user_email,U.user_type, U.user_status,U.user_branch, B.branch_name ', $cond, NULL, ' U.user_name', NULL, 0, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Name</th>
        <th>User Name</th>
         <?php
        if(isset($utype) && $utype == 'SD')
		{
			echo '<th>Center</th>';
		}
        ?>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
<?php
$row = 0;
while ($data = mysql_fetch_object($result)) {

    //$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id ="' . $data->user_branch . '"');
    
    $class = ($row % 2) ? 'even' : 'odd';
    echo '<tr class="', $class, '">', "\n\t";
    echo '<td>', $data->user_fullname, '</td>', "\n";
    echo '<td>', $data->user_name, '</td>';
    if(isset($utype) && $utype == 'SD')
	{
		echo '<td>', $data->branch_name, '</td>';
	}
    echo '<td>', $data->user_email, '</td>';
    echo '<td class="center">', ($data->user_status == 'A' ? '' : 'In-'), 'Active</td>';
    echo '<td class="center"><a href="student.php?op=E&amp;id=', $data->user_id, '&amp;utype=', $data->user_type, '" title="Edit"><div class="img edit"></div></a>&nbsp;';
   
    if(isset($UTYPE) && $UTYPE == 'SA')
	{
		echo '<a href=\'javascript:del("../admin/logic/student_logic.php?op=D&amp;id=', $data->user_id, '&amp;utype=', $utype, '")\' title="Delete"><div class="img delete"></div></a>';
		echo '<a href="../admin/changepassword.php?id=', $data->user_id, '&amp;uname=', $data->user_name, '&amp;type=', $data->user_type, '" title="Change Password"><img src="img/change.png" /></a>';
	}
    echo '</td></tr>', "\n";
    $row++;
}
?>
        </tbody>
    </table>
</div>
</body>
</html>

