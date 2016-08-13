<?php

require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
if(!isset($op) || $op != 'D')
    $fields = ' branch_name="' . htmlspecialchars(trim($branch_name)) . '", branch_short_name = "' . htmlspecialchars(trim($branch_short_name)) . '", branch_address="' . htmlspecialchars(trim($branch_address)) . '", branch_status="'.$branch_status.'" ';

switch ($op) {
    case 'A':
        $fields .=' , branch_createdby = "' . $_SESSION['UID'] . '", branch_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_branches', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , 	branch_modifiedby = "' . $_SESSION['UID'] . '", branch_modifieddate = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_branches', $fields, ' WHERE branch_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_branches', ' branch_id="' . $id . '"');
        break;
}
header('Location: ../manage_branch.php?sts=' . $sts);
exit;