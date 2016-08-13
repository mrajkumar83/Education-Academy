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

$_POST['enquiry_dob'] = convert_date($enquiry_dob);
$_POST['enquiry_crtdate'] = convert_date($enquiry_crtdate);
$_POST['enquiry_call1_date'] = convert_date($enquiry_call1_date);
$_POST['enquiry_call2_date'] = isset($enquiry_call2_date) ? convert_date($enquiry_call2_date) : '';

if (isset($enquiry_call1_status) && $enquiry_call1_status == '1') {
    $_POST['enquire_junk'] = "YES";
}
if (isset($enquiry_call2_status) && $enquiry_call2_status == '1') {
    $_POST['enquire_junk'] = "YES";
}
if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
    list($enquiry_batch, $enquiry_branch) = explode("::", $batchbranch);
    $_POST['enquiry_batch'] = $enquiry_batch;
    $_POST['enquiry_branch'] = $enquiry_branch;
}

switch ($op) {
    case 'A':

        if (isset($enquiry_call2_status)) {
            $_POST['enquiry_status'] = $enquiry_call2_status;
        } elseif (isset($enquiry_call1_status)) {
            $_POST['enquiry_status'] = $enquiry_call1_status;
        }

        $_POST['enquiry_createddate'] = 'DATESTAMP';
        $_POST['enquiry_createdby'] = $_SESSION['UID'];
        $db->addToDB('tb_enquiry');

        $id = $db->newRowId;

        break;
    case 'E':
        /* $fields .=' , 	enquiry_modifiedby = "'.$_SESSION['UID'].'", enquiry_modifieddate = "'.date(DATE_TIME_FORMAT).'"';
          $db->storeDetails('tb_enquiry', $fields, ' WHERE enquiry_id = "'.$id.'"');
         */
        if (isset($enquiry_call2_status)) {
            $_POST['enquiry_status'] = $enquiry_call2_status;
        } elseif (isset($enquiry_call1_status)) {
            $_POST['enquiry_status'] = $enquiry_call1_status;
        }
        $_POST['enquiry_modifiedby'] = $_SESSION['UID'];
        $_POST['enquiry_modifieddate'] = 'DATESTAMP';
        $db->updateDB('tb_enquiry', $id, 'enquiry_id');

        break;

    case 'D':
        $db->delData('tb_enquiry', ' enquiry_id="' . $id . '"');
        break;
    case 'DJ':
        $db->delData('tb_enquiry', ' enquiry_id="' . $id . '"');
        header('Location: ../junk_student.php?sts=' . $sts);
        exit;
        break;
}
header('Location: ../manage_enquiry.php?sts=' . $sts);
exit;