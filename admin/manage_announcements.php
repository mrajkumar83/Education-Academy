<?php
$step = '2';
$path = '.';

$title = 'Announcement';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
// it has to be with the branch for time being do it
//$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' announcement_createdby = "' . $_SESSION['UID'] . '" ';//$user->user_branch
$announcement = $db->fetchAllRecord(' tb_announcements ', ' announcement_id, announcement_title, DATE_FORMAT(announcement_date, "%e/%m/%Y") announcement_date, announcement_status ', $cond, NULL, null, NULL, 0, 'All');

?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Announcement</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Title</th>
		<th>Still Date</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($announcement)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->announcement_title, '</td>', "\n";
				 echo '<td>', $data->announcement_date, '</td>', "\n";
                echo '<td class="center">', ($data->announcement_status == 'A' ? '' : 'In-'), 'Active</td>';
                echo '<td class="center"><a href="announcements.php?op=E&amp;id=', $data->announcement_id, '" title="Edit Announcement" alt="Edit Announcement"><div class="img edit"></div></a>&nbsp;';
                echo '<a href="../admin/logic/announcements_logic.php?op=D&amp;id=', $data->announcement_id, '" title="Delete Announcement" alt="Delete Announcement"><div class="img delete"></div></a>';
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

