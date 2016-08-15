<?php
$step = '2';
$path = '.';

$title = 'Vehicle Details';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
// it has to be with the branch for time being do it
//$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' vehicle_category = category_id ';//$user->user_branch
$vehicle = $db->fetchAllRecord(' tb_vehicle_details , tb_vehicle_categories ', ' vehicle_id, vehicle_name, category_name, vehicle_status ', $cond, NULL, null, NULL, 0, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Vehicle</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
		<th>Vehicle Name</th>
        <th>Category Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($vehicle)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->vehicle_name, '</td>', "\n";
				echo '<td>', $data->category_name, '</td>', "\n";
                echo '<td class="center">', ($data->vehicle_status == 'A' ? '' : 'Not-'), 'Working</td>';
                echo '<td class="center"><a href="vehicle.php?op=E&amp;id=', $data->vehicle_id, '" title="Edit Vehicle" alt="Edit Vehicle"><div class="img edit"></div></a>&nbsp;';
                echo '<a href="../admin/logic/vehicle_logic.php?op=D&amp;id=', $data->vehicle_id, '" title="Delete vehicle" alt="Delete vehicle"><div class="img delete"></div></a>';
                
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

