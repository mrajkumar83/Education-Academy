<?php

require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
$announcement_date = convert_date($announcement_date);

if(!isset($op) || $op != 'D')
    $fields = ' announcement_title="' . htmlspecialchars(trim($announcement_title)) . '", announcement_content="'.htmlspecialchars(trim($announcement_content)).'", announcement_date="'.$announcement_date.'", announcement_status="'.$announcement_status.'" ';

switch ($op) {
    case 'A':
        $fields .=' , announcement_createdby = "' . $_SESSION['UID'] . '", announcement_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_announcements', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , 	announcement_modifiedby = "' . $_SESSION['UID'] . '", announcement_modifieddate = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_announcements', $fields, ' WHERE announcement_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_announcements', ' announcement_id="' . $id . '"');
        break;
}
header('Location: ../manage_announcements.php?sts=' . $sts);
exit;