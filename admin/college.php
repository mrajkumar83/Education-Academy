<?php
$step = '2';
$path = '.';
$title = 'Add College';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('test.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'test_dates.js');
require_once('includes/common.php');

$db = new Query();

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
if ($op == 'A') {
$college_file = '';
}
if ($op == 'E' && $id > 0) {
	
    $data = $db->fetchRecord(' tb_college ', ' * ', ' college_id="' . $id . '"');
    $college_name = $data->college_name;
	$college_status = $data->college_status;
    $pageTitle = 'Edit College';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/college.php');?>
</div>
</body>
</html>