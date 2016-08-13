<?php
$step = '2';
$path = '.';
$title = 'Add Remarks';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('remarks.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'remarks_dates.js');
require_once('includes/common.php');

$db = new Query();

$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', NULL, NULL, 'course_name', NULL, NULL, 'All');
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "'.$user->user_branch.'" ';
$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$hr_batch_id = '';
$hr_branch_id = '';
$hr_course_id = '';
$hr_intr_date = '';
$hr_document = '';
$batchbranch = '';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_attendance ', ' * ', ' role_id="' . $id . '"');
    $role_name = $data->role_name;
    $role_status = $data->role_status;
    $pageTitle = 'Edit Role';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/hr_remark.php');?>
</div>
</body>
</html>

