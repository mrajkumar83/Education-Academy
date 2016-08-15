<?php
$step = '2';
$path = '.';

$title = 'Accomodation Details';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
// it has to be with the branch for time being do it
//$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = ' accomadation_category = category_id '.((isset($UTYPE) && $UTYPE == 'SA') ? '' : ' AND accomadation_createdby = "' . $_SESSION['UID'] . '" ');//$user->user_branch
$accomodation = $db->fetchAllRecord(' tb_accomadation_details , tb_accomodation_categories ', ' accomadation_id, accomadation_name, category_name, accomadation_status ', $cond, NULL, null, NULL, 0, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Accomodation</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
		<th>Accomodation Name</th>
        <th>Category Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($accomodation)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->accomadation_name, '</td>', "\n";
				echo '<td>', $data->category_name, '</td>', "\n";
                echo '<td class="center">', ($data->accomadation_status == 'O' ? 'Occupied' : 'Empty'), '</td>';
                echo '<td class="center"><a href="accomodation_details.php?op=E&amp;id=', $data->accomadation_id, '" title="Edit Accomodation" alt="Edit Accomodation"><div class="img edit"></div></a>&nbsp;';
                echo '<a href="../admin/logic/accomadation_details_logic.php?op=D&amp;id=', $data->accomadation_id, '" title="Delete accomodation" alt="Delete accomodation"><div class="img delete"></div></a>';
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

