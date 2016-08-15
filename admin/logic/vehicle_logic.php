<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
if(!isset($op) || $op != 'D')
    $fields = ' vehicle_name="' . htmlspecialchars(trim($vehicle_name)) . '", vehicle_category="'.$vehicle_category.'",vehicle_price="'.$vehicle_price.'", vehicle_number="'. trim($vehicle_number) .'", vehicle_status="'.$vehicle_status.'" ';

switch ($op) {
    case 'A':
        $fields .=' , vehicle_createdby = "' . $_SESSION['UID'] . '", vehicle_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_vehicle_details', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , 	vehicle_modifiedby = "' . $_SESSION['UID'] . '", vehicle_modifieddate = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_vehicle_details', $fields, ' WHERE vehicle_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_vehicle_details', ' vehicle_id="' . $id . '"');
        break;
}
header('Location: ../manage_vehicle_details.php?sts=' . $sts);
exit;