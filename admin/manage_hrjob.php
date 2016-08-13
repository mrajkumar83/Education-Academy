<?php
$step = '2';
$path = '.';

$title = 'Manage Job';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$jobs = $db->fetchAllRecord(' tb_bd_job ', ' bd_job_id,bd_user_id,bd_companyname,bd_status,bd_branch ', ' bd_status = "A" ' , NULL, null, NULL, 0, 'All');

?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Job</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Company Name</th>
        <th> Posted By</th>
        <th> Branch</th>
        
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($jobs)) {
            	$user = $db->fetchRecord(' tb_users ', ' user_fullname ', ' user_id ="'.$data->bd_user_id.'"');
				$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id ="'.$data->bd_branch.'"');
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->bd_companyname, '</td>', "\n";
				echo '<td>', $user->user_fullname, '</td>', "\n";
				echo '<td>', $branch->branch_name, '</td>', "\n";
               
                echo '<td class="center"><a href="hrjob.php?id=', $data->bd_job_id, '" title="View Job" alt="View Job"><img src="img/view.gif" /></a>&nbsp;';
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

