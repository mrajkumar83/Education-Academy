<?php
$step = '2';
$path = '.';

$title = 'Call Status';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$callsta = $db->fetchAllRecord(' tb_call_sts ', ' call_sts_id,call_sts_type,call_sts_status ', NULL, NULL, null, NULL, 0, 'All');

function chkCallSts($id)
{
    global $db;
    $enquiry_obj = $db->fetchRecord(' tb_enquiry ', ' count(1) AS cnt ', ' enquiry_call1_status="'.$id.'" OR enquiry_call2_status="'.$id.'" ');
    if($enquiry_obj->cnt > 0)
    {
            return false;
    }  
    return true;
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Call</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Call Type</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($callsta)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->call_sts_type, '</td>', "\n";
                echo '<td>', ($data->call_sts_status == 'A' ? '' : 'In-'), 'Active</td>', "\n";
                echo '<td class="center"><a href="callstatus.php?op=E&amp;id=', $data->call_sts_id, '" title="Edit call status" alt="Edit Branch"><div class="img edit"></div></a>&nbsp;';
                if(chkCallSts($data->call_sts_id)){
                    echo '<a href="./logic/callstatus.php?op=D&amp;id=', $data->call_sts_id, '" title="Delete call status" alt="Delete Branch"><div class="img delete"></div></a>';
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

