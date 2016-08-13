<?php
$step = '2';
$path = '.';

$title = 'Manage Job';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id="' . $_SESSION['UID'] . '"');
if(isset($UTYPE) && $UTYPE == "SA")
{
	$jobs = $db->fetchAllRecord(' tb_bd_job ', ' bd_job_id,bd_user_id,bd_companyname,bd_status ', NULL, NULL, null, NULL, 0, 'All');
}
else {
	$jobs = $db->fetchAllRecord(' tb_bd_job ', ' bd_job_id,bd_user_id,bd_companyname,bd_status ', ' bd_branch = "'.$user->user_branch.'" ', NULL, null, NULL, 0, 'All');
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Job</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Company Name</th>
        <th> Posted By</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($jobs)) {
            	$user = $db->fetchRecord(' tb_users ', ' user_fullname ', ' user_id ="'.$data->bd_user_id.'"');
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->bd_companyname, '</td>', "\n";
				echo '<td>', $user->user_fullname, '</td>', "\n";
                echo '<td>', ($data->bd_status == 'A' ? '' : 'In-'), 'Active</td>', "\n";
                echo '<td class="center"><a href="job.php?op=E&amp;id=', $data->bd_job_id, '" title="Edit Job" alt="Edit Job"><div class="img edit"></div></a>&nbsp;';
                echo '<a href="./logic/job_logic.php?op=D&amp;id=', $data->bd_job_id, '" title="Delete Job" alt="Delete Job"><div class="img delete"></div></a>';
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

