<?php
$step = '2';
$path = '.';
$title = 'Search Student';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js', 'search.js');
require_once('includes/common.php');

$db = new Query();
$enquiry_email = isset($enquiry_email) ? $enquiry_email : '';
$enquiry_fname = isset($enquiry_fname) ? $enquiry_fname : '';
$enquiry_lname = isset($enquiry_lname) ? $enquiry_lname : '';
$enquiry_phno = isset($enquiry_phno) ? $enquiry_phno : '';
$cond = '';
$std_type = isset($std_type) ? $std_type : '';

$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
if (isset($Add) && $Add == 'Submit') {
    if($std_type !== 'S'){
	   $cond = ($enquiry_fname == '') ? '' : ' enquiry_fname LIKE "'.$enquiry_fname.'%" ';
	   $cond .=  ($enquiry_lname == '') ? '' : (($cond == '') ? '' : ' OR ').' enquiry_lname LIKE "'.$enquiry_lname.'%" ';
	   $cond .=  ($enquiry_email == '') ? '' : (($cond == '') ? '' : ' OR ').' enquiry_email LIKE "' . $enquiry_email.'%" ';
	   $cond .=  ($enquiry_phno == '') ? '' : (($cond == '') ? '' : ' OR ').' enquiry_phno LIKE "' . $enquiry_phno.'%" ';
	   
		if ($UTYPE != 'SA') {
		   $cond = ' ('.$cond.') AND enquiry_branch = "' . $user->user_branch . '" ';
		}
		$enquiry = $db->fetchAllRecord(' tb_enquiry ', ' enquiry_id,enquiry_fname,enquiry_lname,enquiry_email,enquiry_phno,enquiry_course,enquiry_batch  ', $cond, NULL, null, NULL, 0, 'All');
	}else{
		$cond = ($enquiry_fname == '') ? '' : ' std_fname LIKE "'.$enquiry_fname.'%" ';
		$cond .=  ($enquiry_lname == '') ? '' : (($cond == '') ? '' : ' OR ').' std_lname LIKE "'.$enquiry_lname.'%" ';
		$cond .=  ($enquiry_email == '') ? '' : (($cond == '') ? '' : ' OR ').' std_phno LIKE "' . $enquiry_email.'%" ';
		$cond .=  ($enquiry_phno == '') ? '' : (($cond == '') ? '' : ' OR ').' std_email LIKE "' . $enquiry_phno.'%" ';
		$cond = ' std_type="Y" AND ('.$cond.')';
		$std_rec = $db->fetchAllRecord(' tb_student_details ', ' std_id, std_fname, std_lname,std_phno,std_email  ', $cond, NULL, null, NULL, 0, 'All'); 
	}
}

require_once($path.'/templates/student_search.php');

if (isset($Add) && $Add == 'Submit') {
		require_once($path.'/templates/'.(($std_type !== 'S') ? 'search_results.php': 'std_search_results.php'));
}
require_once($path.'/templates/student_search_footer.php');