<?php
$step = '2';
$path = '.';

$title = 'Batch';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "' . $user->user_branch . '" ';
$batch = $db->fetchAllRecord(' tb_batch ', ' batch_id,batch_name,batch_desc,batch_course,batch_branch,batch_status,batch_bid ', $cond, NULL, null, NULL, 0, 'All');

function chkBatch($id)
{
    global $db;
    $batch_obj = $db->fetchRecord(' tb_enquiry ', ' count(1) AS cnt ', ' enquiry_batch="'.$id.'" ');
    if($batch_obj->cnt > 0)
    {
            return false;
    }  
    return true;
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Batch</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Batch Name</th>
        <th>Batch ID</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($batch)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->batch_name, '</td>', "\n";
                echo '<td>', $data->batch_bid, '</td>', "\n";
                echo '<td class="center">', ($data->batch_status == 'A' ? '' : 'In-'), 'Active</td>';
                echo '<td class="center"><a href="batch.php?op=E&amp;id=', $data->batch_id, '" title="Edit Batch" alt="Edit Batch"><div class="img edit"></div></a>&nbsp;';
                if(chkBatch($data->batch_id)){
                    echo '<a href="../admin/logic/batch_logic.php?op=D&amp;id=', $data->batch_id, '" title="Delete Batch" alt="Delete Batch"><div class="img delete"></div></a>';
                }else{
                    echo '&nbsp;&nbsp;&nbsp;';
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

