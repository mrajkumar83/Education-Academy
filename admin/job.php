<?php
$step = '2';
$path = '.';
$title = 'Add Job';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('job.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'job_date.js');
require_once('includes/common.php');

$db = new Query();

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$uname = $db->fetchRecord(' tb_users ', ' user_name ', ' user_id="'.$UID.'"');
$branch = $db->fetchAllRecord('tb_branches ', ' branch_id,branch_name ', ' branch_status="A" ', NULL, 'branch_name', NULL, NULL, 'All');

$bd_login_id = $uname->user_name;
$bd_branch = '';
$bd_companyname = '';
$bd_contactper = '';
$bd_designation = '';
$bd_emailid = '';
$bd_qualification = '';
$bd_stream = '';
$bd_percutoff = 'C';
$bd_yearofpass = '';
$bd_jobtitle= '';
$bd_joblocation = '';
$bd_interviewloc = '';
$bd_interviewdate = '';
$bd_genderpre = 'B';
$bd_bond = 'N';
$bd_relocate = 'Y';
$bd_bondyear = '';
$bd_deposit = 'N';
$bd_depositamnt = '';
$bd_subcirt = 'N';
$bd_shift = 'N';
$bd_comment = '';
$bd_status = 'A';
$hr = '';
$min = '';
$ampm = '';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_bd_job ', ' * ', ' bd_job_id ="' . $id . '"');
	
    while (list($var, $val) = each($data)) {
        $$var = $val;
    }
	if(isset($bd_interviewtime) && $bd_interviewtime != '')
	{
	if (strpos($bd_interviewtime, ":") !== false) {
        list($hr, $min, $ampm) = explode(":", $bd_interviewtime);
    }
	}
    $title = 'Edit Job';
}
if (isset($bd_qualification) && $bd_qualification != '') {
    if (strpos($bd_qualification, ",") !== false) {
        $qualification = explode(",", $bd_qualification);
    } else {
        $qualification = array();
        $qualification[] = $bd_qualification;
    }
}
if (isset($bd_stream) && $bd_stream != '') {
    if (strpos($bd_stream, ",") !== false) {
        $stream = explode(",", $bd_stream);
    } else {
        $stream = array();
        $stream[] = $bd_stream;
    }
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/job.php');?>
</div>
</body>
</html>

