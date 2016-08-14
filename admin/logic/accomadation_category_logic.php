<?php

require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
if(!isset($op) || $op != 'D')
    $fields = ' category_name="' . htmlspecialchars(trim($category_name)) . '", category_status="'.$category_status.'" ';

switch ($op) {
    case 'A':
        $fields .=' , category_createdby = "' . $_SESSION['UID'] . '", category_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_accomodation_categories', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , 	category_modifiedby = "' . $_SESSION['UID'] . '", category_modifieddate = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_accomodation_categories', $fields, ' WHERE category_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_accomodation_categories', ' category_id="' . $id . '"');
        break;
}
header('Location: ../manage_accomadation_category.php?sts=' . $sts);
exit;