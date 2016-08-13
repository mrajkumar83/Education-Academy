<?php
$step = '2';
$path = '.';
$title = 'Add Test';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('test.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'test_dates.js');
require_once('includes/common.php');

$db = new Query();


$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', NULL, NULL, 'course_name', NULL, NULL, 'All');
$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id ', ' batch_id ,batch_name,br.branch_id,branch_name ', NULL);

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$test_name = '';
$test_course = '';
$test_batch = '';
$test_branch = '';
$test_date = '';
$test_starttime = '';
$test_endtime = '';
$test_time = '';
$test_orgfile = '';
$allocated_to = '';
$hr=$min=$sec=$hr1=$min1=$sec1 = '-1';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_test ', ' * ', ' test_id="' . $id . '"');
    while (list($var, $val) = each($data)) {
        $$var = $val;
    }
    $allocated_to = $test_batch . "::" . $test_branch;
    if (strpos($test_time, ":") !== false) {
        list($hr, $min, $sec) = explode(":", $test_time);
    }
    if (strpos($test_starttime, ":") !== false) {
        list($hr1, $min1, $sec1) = explode(":", $test_starttime);
    }
    $pageTitle = 'Edit Test';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/test.php');?>
</div>
</body>
</html>