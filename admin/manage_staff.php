<?php
$step = '2';
$path = '.';
$title = 'Manage Staff';
$css = array('miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

if (isset($UTYPE) && $UTYPE == 'SA') {
    $cond = ' U.user_type!="SD" AND U.user_type!="GS" AND U.user_type!="SA" AND U.user_type!="ES"  ';
} else {
    $cond = ' U.user_type="' . $utype . '" AND U.user_type<>"SA"  ';
}

$tables = (!isset($utype) || $utype == 'AD') ? ' tb_users U ' : ' tb_users US,tb_users U ';

if(isset($utype))
switch ($utype) {
    case 'SF':
        $cond = ' U.user_type="SF" AND US.user_id="' . $UID . '" AND U.user_branch=US.user_branch ';
        break;
}
$tables .= ' LEFT JOIN tb_branches B ON B.branch_id=U.user_branch ';
$result = $db->fetchAllRecord($tables, ' U.user_id, U.user_name, U.user_fullname, U.user_email, U.user_status, U.user_type, U.role_permission ,U.user_branch, B.branch_name ', $cond, NULL, '  user_name', NULL, 0, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Staff</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Name</th>
        <th>User Name</th>
        <th>Center</th>
        <th>User Role</th>
        <th>E-mail</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
<?php
$row = 0;
while ($data = mysql_fetch_object($result)) {

    //$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id ="' . $data->user_branch . '"');
	$role_name = "Admin";
    if (isset($data->role_permission) && $data->role_permission != " ") {
        if ($data->role_permission == 'C') {
            $role_name = 'Counselor';
        }
        if ($data->role_permission == 'F') {
            $role_name = 'Finance';
        }
        if ($data->role_permission == 'O') {
            $role_name = 'Operational';
        }
        if ($data->role_permission == 'H') {
            $role_name = 'HR';
        }
		if ($data->role_permission == 'B') {
            $role_name = 'Business Development';
        }
        if ($data->role_permission == 'A') {
            $role_name = 'Admin';
        }
		if ($data->role_permission == 'L') {
			$role_name = 'Librarian';
		}
		if ($data->role_permission == 'T') {
			$role_name = 'Transport Manager';
		}
		if ($data->role_permission == 'Q') {
			$role_name = 'Quaters Incharge';
		}
    }
    $class = ($row % 2) ? 'even' : 'odd';
    echo '<tr class="', $class, '">', "\n\t";
    echo '<td>', $data->user_fullname, '</td>', "\n";
    echo '<td>', $data->user_name, '</td>';
    echo '<td>', $data->branch_name, '</td>';
    echo '<td>', $role_name, '</td>';

    echo '<td>', $data->user_email, '</td>';
    echo '<td class="center">', ($data->user_status == 'A' ? '' : 'In-'), 'Active</td>';
    echo '<td class="center"><a href="staff.php?op=E&amp;utype=', $data->user_type, '&amp;id=', $data->user_id, '" title="Edit"><div class="img edit"></div></a>&nbsp;';
    echo '<a href="../admin/logic/staff_logic.php?op=D&amp;id=', $data->user_id, '&amp;utype=', $data->user_type, '" title="Delete"><div class="img delete"></div></a>';
    if(isset($UTYPE) && $UTYPE == 'SA')
	{
    echo '<a href="../admin/changepassword.php?id=', $data->user_id, '&amp;uname=', $data->user_name, '&amp;type=AS" title="Change Password"><img src="img/change.png" /></a>';
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

