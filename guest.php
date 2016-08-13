<?php
session_start();
$step = '0';
$path = './admin';
$title = 'Add Guest';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css', 'logo.css');
$js = array('student.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'student_dates.js');
require_once($path.'/common/configure.php');
require_once($path.'/classes/Database.class.php');
require_once($path.'/classes/Query.class.php');
require_once($path.'/includes/commonheader.php');

$db = new Query();
$college = $db->fetchAllRecord('tb_college ', ' college_id,college_name,college_status ', ' college_status="A" ', NULL, 'college_name', NULL, NULL, 'All');
$college1 = $db->fetchAllRecord('tb_college ', ' college_id,college_name,college_status ', ' college_status="A" ', NULL, 'college_name', NULL, NULL, 'All');
$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', ' course_status="A" ', NULL, 'course_name', NULL, NULL, 'All');
$branch = $db->fetchAllRecord('tb_branches ', ' branch_id,branch_name ', ' branch_status="A" ', NULL, 'branch_name', NULL, NULL, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$pagefrom  = (isset($pagefrom)) ? $pagefrom : '';
$std_fname = $_SESSION['FNAME'];
$std_lname = $_SESSION['LNAME'];
$std_phno = $_SESSION['PHNO'];
$std_sphone = '';
$std_email = $_SESSION['EMAILID'];
$std_secondary_email = '';
$std_branch = '';
$std_photo = '';
$std_dob = '';
$std_hometown = '';
$std_passportno ='';
$std_ssc_year ='';
$std_ssc_board = '';
$std_ssc_percentage = '';
$std_ipe_year = '';
$std_ipe_board = '';
$std_ipe_percentage = '';
$std_diploma_year = '';
$std_diploma_board = '';
$std_diploma_percentage = '';
$std_graduation_year = '';
$std_graduation_board = '';
$std_graduation_percentage = '';
$std_graduation_college = '';
$std_graduation_other = '';
$std_postgraduation_year = '';
$std_postgraduation_board = '';
$std_postgraduate_pecentage= '';
$std_postgraduation_college = '';
$std_postgraduation_other = '';
$std_ptgrbranch_other = '';
$std_grbranch_other  = '';
$std_relocate = 'N';
$std_contract = 'N';
$std_job_offers = 'Y';
$std_company_name = '';
$std_salary = '';
$std_job_jdate= '';
$std_resume= '';
$std_project_name = '';
$std_project_duration = '';
$std_team = '';
$std_project_description = '';
$std_other_course = 'N';
$std_cirt_name = '';
$std_got_cirt = '';
$std_academic_gap = 'N';
$std_aca_gap_reason = '';
$std_graduation_gap = 'N';
$std_graduation_gap = '';
$std_status = 'A';

$skill_rec = $db->fetchAllRecord(' tb_skills ', ' skill_id,skill_name ', ' skill_status="A" ', NULL, NULL, NULL, NULL, 'All');
$skill_cnt = $db->getRowCount();
?>
<div class="mainBox">
	<div class="header">
		<div class="logo1" style=""></div>

	</div>
	<div class="contentBox">
		<?php require_once('./admin/templates/guest.php');
