<?php
$step = '2';
$path = '.';
$title = 'Add Vehicles';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('vehicles.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js');
require_once('includes/common.php');

$db = new Query();

$lib_categories = $db->fetchAllRecord('tb_accomodation_categories ', ' category_id,category_name ', ' category_status="A" AND category_createdby = "' . $_SESSION['UID'] . '" ', NULL, 'category_name', NULL, NULL, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$accomadation_name = '';
$accomadation_category = '0';
$accomadation_price = '0.0';
$accomadation_number = '';
$accomadation_rooms = 1;
$accomadation_address = '';
$accomadation_status = 'E';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_accomadation_details ', ' * ', ' accomadation_id="' . $id . '"');
    $accomadation_name = $data->accomadation_name;
    $accomadation_category = $data->accomadation_category;
    $accomadation_price = $data->accomadation_price;
    $accomadation_number = $data->accomadation_number;
	$accomadation_status = $data->accomadation_status;
	$accomadation_rooms = $data->accomadation_rooms;
	$accomadation_address = $data->accomadation_address;
    $pageTitle = 'Edit Vehicle';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/accomodation_details.tpl.php');?>
</div>
</body>
</html>

