<?php

require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
$batch_startdt = convert_date($batch_startdt);
$batch_enddt = convert_date($batch_enddt);
$batch_time = $batch_hr . ":" . $batch_min;

if ($op != 'D') {
    if (isset($UTYPE) && $UTYPE == 'SA') {
        $branch = $batch_branch;
    } else {
        $branch_rec = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id="' . $_SESSION['UID'] . '" ');
        $branch = $branch_rec->user_branch;
    }
    $fields = ' batch_name="' . htmlspecialchars(trim($batch_name)) . '", batch_desc="' . htmlspecialchars(trim($batch_desc)) . '",  batch_course = "' . $batch_course . '", batch_amount = "' . $batch_amount . '",
 batch_branch = "' . $branch . '", batch_status = "' . $batch_status . '", batch_startdt = "' . $batch_startdt . '", batch_enddt = "' . $batch_enddt . '", batch_time = "' . $batch_time . '", batch_ampm = "' . $batch_ampm . '" ';
}

switch ($op) {
    case 'A':
        $batch_bid = $db->generatenextid('tb_batch', ' batch_bid ', 'B', '000', ' batch_bid like "B%" ');
        $fields .=' , batch_bid = "' . $batch_bid . '", batch_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_batch', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , batch_modifeddate  = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_batch', $fields, ' WHERE batch_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_batch', ' batch_id="' . $id . '"');
        break;
}
header('Location: ../manage_batch.php?sts=' . $sts);
exit;