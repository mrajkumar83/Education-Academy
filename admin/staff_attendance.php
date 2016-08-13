<?php
$step = '2';
$path = '.';
$title = 'Add Attendance';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('attendance.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'attendance_dates.js');
require_once('includes/common.php');

$db = new Query();

$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', NULL, NULL, ' course_name ', NULL, NULL, 'All');
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');

$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "' . $user->user_branch . '" ';
$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id  ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);

$id = (isset($id) && $id > 0) ? $id : 0;
$op = (isset($op) && $op != '') ? $op : 'A';
$att_batch_id = '';
$att_course = '';
$att_branch = '';
$att_date = '';
$att_document = '';
$batchbranch = '';
    
if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_attendance_doc ', ' * ', ' att_doc_id="' . $id . '" ');
    while (list($var, $val) = each($data)) {
        $$var = $val;
    }
    $batchbranch = $att_batch_id . "::" . $att_branch;
    $pageTitle = 'Edit Attendance';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/staff_attendance.php');?>
</div>
</body>
</html>

