<?php
$step = '2';
$path = '.';

$title = 'Enquiry';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$data = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? ' enquire_junk="No" ' : ' enquire_junk="No" AND enquiry_branch = "' . $data->user_branch . '" ';
$enquiry = $db->fetchAllRecord(' tb_enquiry ', ' enquiry_id,enquiry_fname,enquiry_lname,enquiry_email,enquiry_type,enquiry_status ', $cond, NULL, null, NULL, 0, 'All');

?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Enquiry</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Name</th>
        <th>Type</th>
        <th>Email</th>
        <th>Action</th>
        </thead>
        <tbody>
<?php
$row = 0;

while ($data = mysql_fetch_object($enquiry)) {
    $row1 = $db->fetchRecord(' tb_call_sts ', ' call_sts_type ', ' call_sts_id=' . $data->enquiry_status . ' ');    
    $color = (isset($row1) && isset($row1->call_sts_type) && strtolower($row1->call_sts_type) == "busy") ? "#D80909" : "#6DA828";

    $class = ($row % 2) ? 'even' : 'odd';
    echo '<tr class="', $class, '">', "\n\t";
    echo '<td style="color:' . $color . ';"><strong>', $data->enquiry_fname, '&nbsp', $data->enquiry_lname, '</strong></td>', "\n";
    echo '<td class="center">', $data->enquiry_type, '</td>';
    echo '<td class="center">', $data->enquiry_email, '</td>';
    echo '<td class="center"><a href="enquiry.php?op=E&amp;id=', $data->enquiry_id, '" title="Edit Enquiry" alt="Edit Enquiry"><div class="img edit"></div></a>&nbsp;';
    echo '<a href="../admin/logic/enquiry_logic.php?op=D&amp;id=', $data->enquiry_id, '" title="Delete Enquiry" alt="Delete Enquiry"><div class="img delete"></div></a>';
    echo '</td></tr>', "\n";
    $row++;
}
?>
        </tbody>
    </table>
</div>
</body>
</html>

