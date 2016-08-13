<?php
$step = '2';
$path = '.';
$title = 'Add Course ';
$css = array('styles.css');
$js = array('course.js');
require_once('includes/common.php');

$db = new Query();
$course = $db->fetchRecord(' tb_courses ', ' course_id,course_name,course_desc ', NULL, NULL, null, NULL, 0, 'All');
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$course_name = '';
$course_amout = '';
$course_desc = '';
$course_status = 'A';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_courses ', ' * ', ' course_id="' . $id . '"');
    $course_name = $data->course_name;
    $course_desc = $data->course_desc;
    $course_status = $data->course_status;
    $title = 'Edit Course';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/course.php');?>
</div>
</body>
</html>

