<?php
$step = '2';
$path = '.';
$title = 'Mode';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');

require_once('includes/common.php');

$db = new Query();
$mode = $db->fetchAllRecord(' tb_mode ', ' mode_id,mode_name,mode_status ', NULL, NULL, null, NULL, 0, 'All');

function chkMode($id)
{
    global $db;
    $mode_obj = $db->fetchRecord(' tb_student_fees ', ' count(1) AS cnt ', ' fee_mode="'.$id.'" ');
    if($mode_obj->cnt > 0)
    {
            return false;
    }  
    return true;
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Mode</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Mode Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($mode)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->mode_name, '</td>', "\n";
                echo '<td class="center">', ($data->mode_status == 'A' ? '' : 'In-'), 'Active</td>';
                echo '<td class="center"><a href="mode.php?op=E&amp;id=', $data->mode_id, '" title="Edit Mode" alt="Edit Mode"><div class="img edit"></div></a>&nbsp;';
                if(chkMode($data->mode_id)){
                    echo '<a href="../admin/logic/mode_logic.php?op=D&amp;id=', $data->mode_id, '" title="Delete Mode" alt="Delete Mode"><div class="img delete"></div></a>';
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

