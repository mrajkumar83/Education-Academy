<?php
$step = '2';
$path = '.';
$title = 'Add Enquiry ';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('enquiry.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'enquiry_dates.js');

require_once('includes/common.php');

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "' . $user->user_branch . '" ';

$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);
$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', ' course_status="A" ', NULL, 'course_name', NULL, NULL, 'All');
$call_sts = $db->fetchAllRecord(' tb_call_sts ', ' call_sts_id,call_sts_type ', ' call_sts_status="A" ', NULL, 'call_sts_type', NULL, NULL, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$enquiry_fname = '';
$enquiry_lname = '';
$enquiry_phno = '';
$enquiry_email = '';
$enquiry_course = '';
$enquiry_batch = '';
$enquiry_branch = '';
$enquiry_comments = '';
$enquiry_crtdate = date("m/d/Y");
$enquiry_type = '';
$enquiry_status = '';
$enquiry_call1_comments = '';
$enquiry_call1_status = '';
$enquiry_call2_comments = '';
$enquiry_call2_status = '';
$enquiry_dob = '';
$enquiry_date = '';
$enquiry_call1_date = '';
$batchbranch = '';
$std_course = '';
$course_name = '';
$pageTitle = 'Add Enquiry';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_enquiry ', ' * ', ' 	enquiry_id="' . $id . '"');
    $batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_amount,batch_course ', ' batch_id="' . $data->enquiry_batch . '" ');
    $enquiry_course = $batch_rec->batch_course;
    $course_rec = $db->fetchRecord(' tb_courses ', ' course_name ', ' course_id="' . $batch_rec->batch_course . '" ');
    $course_name = $course_rec->course_name;

    if (isset($data->enquiry_crtdate) && $data->enquiry_crtdate != '' && $data->enquiry_crtdate != '0000-00-00') {
        $data->enquiry_crtdate = date("m/d/Y", strtotime($data->enquiry_crtdate));
    }
    if (isset($data->enquiry_dob) && $data->enquiry_dob != '' && $data->enquiry_dob != '0000-00-00') {
        $data->enquiry_dob = date("m/d/Y", strtotime($data->enquiry_dob));
    }

    $data1 = $db->fetchRecord(' tb_call_sts ', ' call_sts_type ', ' call_sts_id=' . $data->enquiry_call1_status, NULL, 'call_sts_type', NULL, 0, 'All');
    $call1_sts_value = isset($data1->call_sts_type) ? $data1->call_sts_type : '';
    $data2 = $db->fetchRecord(' tb_call_sts ', ' call_sts_type ', ' call_sts_id=' . $data->enquiry_call2_status, NULL, 'call_sts_type', NULL, 0, 'All');
    $call2_sts_value = isset($data2->call_sts_type) ? $data2->call_sts_type : '';
    while (list($var, $val) = each($data)) {
        $$var = $val;
    }
    $batchbranch = $enquiry_batch . "::" . $enquiry_branch;
    $pageTitle = 'Edit Enquiry';
}
?>
    <div id="main">
        <div class="top-bar"><h1><?php echo $pageTitle; ?></h1></div>
        <?php require_once('./templates/enquiry.php');?>
    </div>
</body>
</html>

