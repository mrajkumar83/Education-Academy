<?php
$step = '2';
$path = '.';
$title = 'Add Batch';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('batch.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'batch_dates.js');
require_once('includes/common.php');

$db = new Query();

$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', ' course_status="A" ', NULL, 'course_name', NULL, NULL, 'All');
$branch = $db->fetchAllRecord('tb_branches ', ' branch_id,branch_name ', ' branch_status="A" ', NULL, 'branch_name', NULL, NULL, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$batch_name = '';
$batch_desc = '';
$batch_course = '';
$batch_amount = '';
$batch_branch = '';
$batch_startdt = '';
$batch_startdt = '';
$batch_time = '';
$batch_ampm = '';
$ampm = '';
$batch_status = 'A';
$batch_enddt = '';
$batch_hr = '';
$batch_min = '';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_batch ', ' * ', ' batch_id="' . $id . '"');
    $batch_name = $data->batch_name;
    $batch_desc = $data->batch_desc;
    $batch_course = $data->batch_course;
    $batch_amount = $data->batch_amount;
    $batch_branch = $data->batch_branch;
    $batch_status = $data->batch_status;
    $batch_startdt = date("m/d/Y", strtotime($data->batch_startdt));
    $batch_time = $data->batch_time;
    $batch_ampm = $data->batch_ampm;

    if (strpos($batch_time, ":") !== false) {
        list($batch_hr, $batch_min) = explode(":", $batch_time);
    }

    $ampm = '';
    $batch_enddt = date("m/d/Y", strtotime($data->batch_enddt));
    $pageTitle = 'Edit Batch';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/batch.php');?>
</div>
</body>
</html>

