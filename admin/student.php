<?php
$step = '2';
$path = '.';
$title = 'Registration';
$action = '';

$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('student.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'student_dates.js');
require_once('includes/common.php');

require_once("common/generate_password.php");
$db = new Query();
$id = (isset($UTYPE) && ($UTYPE == 'AD' || $UTYPE == 'SA')) ? $id : $UID;

$course = $db->fetchAllRecord('tb_courses ', ' course_id,course_name ', NULL, NULL, 'course_name', NULL, NULL, 'All');
$college = $db->fetchAllRecord('tb_college ', ' college_id,college_name,college_status ', ' college_status="A" ', NULL, 'college_name', NULL, NULL, 'All');
$college1 = $db->fetchAllRecord('tb_college ', ' college_id,college_name,college_status ', ' college_status="A" ', NULL, 'college_name', NULL, NULL, 'All');
$utype1 = $UTYPE;
///// Variables //////

$data = $db->fetchRecord(' tb_users AS u LEFT JOIN tb_student_details AS i on i.std_id = u.user_id ', ' * ', 'u.user_id="' . $id . '"');
$batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_amount,batch_course ', ' batch_id="' . $data->std_batch . '" ');
$std_rec = $db->fetchRecord(' tb_student_details ', ' std_graduation_branch,std_grbranch_other,std_postgraduation_branch,std_ptgrbranch_other ', ' std_id="' . $id . '" ');

$op = 'E';
while (list($var, $val) = each($data)) {
    $$var = $val;
}
if (isset($std_skill_set) && $std_skill_set != '') {
    if (strpos($std_skill_set, ",") !== false) {
        $std_skills = explode(",", $std_skill_set);
    } else {
        $std_skills = array();
        $std_skills[] = $std_skill_set;
    }
}
$user_status = $data->user_status;

$skill_rec = $db->fetchAllRecord(' tb_skills ', ' skill_id,skill_name ', ' skill_status="A" ', NULL, NULL, NULL, NULL, 'All');
$skill_cnt = $db->getRowCount();
$title = 'Edit ';


if(isset($utype))
{
    switch ($utype) {
        case 'SA':
            $title .= 'Super Admin';
            break;
        case 'AD':
            $title .= 'Admin';
            break;
        case 'SF':
            $title .= 'Staff';
            break;
		case 'SD':
            $title .= 'Student';
            break;
        default:
            $title .= 'Profile';
            break;
    }
}
 else {
    $title .= 'Student';
	$utype = 'SD';
}
$errDiv = '';
if (isset($Err)) {
    switch ($Err) {
        case 'D':
            $errDiv = '<div class="complsory">Duplicate entry of UserName OR Email.</div>';
        break;

        case 'S':
            $errDiv = '<div class="complsory">Image size is more.</div>';
        break;
		
		case 'R':
            $errDiv = '<div class="complsory">Resume size is more.</div>';
        break;
    }
}
$action = $utype;
/*
if(isset($utype) && $utype == 'SD')
{
	$action = "SD1";
}
if(isset($utype) && $utype == 'GS')
{
	$action = "GS1";
}
echo $action,'<hr>'; */
?> 
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
<?php
echo $errDiv;
require_once('./templates/student.php');
?>
</div>
</body>
</html>