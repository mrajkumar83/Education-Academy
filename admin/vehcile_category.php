<?php
$step = '2';
$path = '.';
$title = 'Add Category';
$css = array('styles.css');
$js = array('category.js');
require_once('includes/common.php');

$db = new Query();
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$category_name = '';
$category_status = 'A';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_vehcile_categories ', ' * ', ' category_id="' . $id . '"');
    $category_name = $data->category_name;
    $category_status = $data->category_status;
    $title = 'Edit Vehcile Category';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/vehcile_category.php'); ?>
</div>
</body>
</html>