<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
if(!isset($op) || $op != 'D')
    $fields = ' accomadation_name="' . htmlspecialchars(trim($accomadation_name)) . '", accomadation_category="'.$accomadation_category.'",accomadation_price="'.$accomadation_price.'", accomadation_number="'. trim($accomadation_number) .'", accomadation_address="'. trim($accomadation_address) .'", accomadation_rooms="'. trim($accomadation_rooms) .'", accomadation_status="'.$accomadation_status.'" ';

switch ($op) {
    case 'A':
        $fields .=' , accomadation_createdby = "' . $_SESSION['UID'] . '", accomadation_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_accomadation_details', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , 	accomadation_modifiedby = "' . $_SESSION['UID'] . '", accomadation_modifieddate = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_accomadation_details', $fields, ' WHERE accomadation_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_accomadation_details', ' accomadation_id="' . $id . '"');
        break;
}
header('Location: ../manage_accomadation_details.php?sts=' . $sts);
exit;