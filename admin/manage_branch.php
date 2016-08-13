<?php
$step = '2';
$path = '.';

$title = 'Branch';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$branch = $db->fetchAllRecord(' tb_branches ', ' branch_id,branch_name,branch_short_name,branch_address ', NULL, NULL, null, NULL, 0, 'All');

function chkBranchs($id)
{
    global $db;
    $branch_obj = $db->fetchRecord(' tb_users ', ' count(1) AS cnt ', ' user_branch="'.$id.'" ');
    if($branch_obj->cnt > 0)
    {
            return false;
    }
    else
    {
        $branch_obj = $db->fetchRecord(' tb_batch ', ' count(1) AS cnt ', ' batch_branch="'.$id.'" ');
        if($branch_obj->cnt > 0)
        {
                return false;
        }        
    }
    return true;
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Branch</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Branch Name</th>
        <th>Branch Short Name</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($branch)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->branch_name, '</td>', "\n";
                echo '<td>', $data->branch_short_name, '</td>', "\n";
                echo '<td class="center"><a href="branch.php?op=E&amp;id=', $data->branch_id, '" title="Edit branch" alt="Edit Branch"><div class="img edit"></div></a>&nbsp;';
                if(chkBranchs($data->branch_id))
                {
                    echo '<a href="../admin/logic/branch_logic.php?op=D&amp;id=', $data->branch_id, '" title="Delete branch" alt="Delete Branch"><div class="img delete"></div></a>';
                }else{
                    echo '&nbsp;';
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

