<?php
$step = '2';
$path = '.';
$title = 'Add Vehicles';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('vehicles.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js');
require_once('includes/common.php');

$db = new Query();

$lib_categories = $db->fetchAllRecord('tb_vehicle_categories ', ' category_id,category_name ', ' category_status="A" AND category_createdby = "' . $_SESSION['UID'] . '" ', NULL, 'category_name', NULL, NULL, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$vehicle_name = '';
$vehicle_category = '0';
$vehicle_price = '0.0';
$vehicle_number = '';
$vehicle_status = 'W';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_vehicle_details ', ' * ', ' vehicle_id="' . $id . '"');
    $vehicle_name = $data->vehicle_name;
    $vehicle_category = $data->vehicle_category;
    $vehicle_price = $data->vehicle_price;
    $vehicle_number = $data->vehicle_number;
	$vehicle_status = $data->vehicle_status;
    $pageTitle = 'Edit Vehicle';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/vehicle_details.php');?>
</div>
</body>
</html>

