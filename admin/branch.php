<?php
$step = '2';
$path = '.';
$title = 'Add Branch';
$css = array('styles.css');
$js = array('branch.js');
require_once('includes/common.php');

$db = new Query();
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$branch_name = '';
$branch_short_name = '';
$branch_address = '';
$branch_status = 'A';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_branches ', ' * ', ' branch_id="' . $id . '"');
    $branch_name = $data->branch_name;
    $branch_short_name = $data->branch_short_name;
    $branch_address = $data->branch_address;
    $branch_status = $data->branch_status;
    $title = 'Edit Course';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/branch.php'); ?>
</div>
</body>
</html>