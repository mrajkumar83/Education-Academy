<?php

require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");
require_once("../store_attdoc.php");

$id = (isset($id)) ? $id : 0;
$sts = '';
$attendance_date = $_POST['att_date'] = convert_date($att_date);
$_POST['att_document'] = (isset($_FILES['att_document']) && isset($_FILES['att_document']['name']) && ($_FILES['att_document']['name'] != '')) ? fileupload('TXT', '../attendance', 'att_document', 'N', '', $id) : '';

if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
    list($att_batch_id, $att_branch) = explode("::", $batchbranch);
    $_POST['att_batch_id'] = $att_batch_id;
    $_POST['att_branch'] = $att_branch;
}


switch ($op) {
    case 'A':
        $_POST['att_creadetby'] = $_SESSION['UID'];
        $_POST['att_creatdate'] = 'DATESTAMP';
        $att_doc_id = $db->addToDB('tb_attendance_doc');
        if (isset($att_doc_id) && $att_doc_id != '') {
            store_data($_POST['att_document'], $att_doc_id, $attendance_date, $att_batch_id, $att_branch);
            echo '<table cellpadding="2" cellspacing="0" align="center" border="0" width="100%">
    
				<tr><td height="300" align="center"><table border="1" width="40%">
				<tr><td align="center">Attendance submited successfully for ' . $att_date . '.<br />
			<br />
			</td></tr></table></td></tr>
			  </table>';
        }
        break;
    case 'E':
        $_POST['att_modifyby'] = $_SESSION['UID'];
        $_POST['att_modifydate'] = 'DATESTAMP';
        $db->updateDB('tb_attendance1', $id, 'attendance_id');
        break;

    case 'D':
        $db->delData('tb_attendance1', ' attendance_id="' . $id . '"');
        break;
}
//header('Location: ../staff_attendance.php?sts='.$sts);
//xit;