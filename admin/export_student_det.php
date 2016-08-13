<?php
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=student_details.csv");
header("Pragma: no-cache");
header("Expires: 0");

$path = '.';
require_once($path.'/common/sess.php');
require_once($path.'/common/configure.php');
require_once($path.'/classes/Database.class.php');
require_once($path.'/classes/Query.class.php');

$db = new Query();
$sub_query = "";
$sub_query1 = '';

if($_SESSION['UTYPE'] == 'SF' && isset($_SESSION['UBRANCH'] )){
	$sub_query .= ' AND u.user_branch="'.$_SESSION['UBRANCH'].'" ';
}

if (isset($std_id) && is_array($std_id) && count($std_id)) {
    $students_list = implode(",", $std_id);
    $sub_query = " and std_id in (" . $students_list . ")";
}
if (isset($std_ipe_percentage) && $std_ipe_percentage != '') {
	$sub_query1.= " and std_ipe_percentage >='" . $std_ipe_percentage . "' ";
}

if (isset($std_ssc_percentage) && $std_ssc_percentage) {
	$sub_query1.= " and std_ssc_percentage >='".$std_ssc_percentage."' ";
}
if (isset($std_graduation_percentage) && $std_graduation_percentage) {
	$sub_query1.= " and std_graduation_percentage >='". $std_graduation_percentage . "' ";
}
if (isset($std_postgraduate_pecentage) && $std_postgraduate_pecentage) {
	$sub_query1.= " and std_postgraduate_pecentage >='" . $std_postgraduate_pecentage . "' ";
}
if (isset($std_hometown) && $std_hometown) {
	$sub_query1.= " and std_hometown ='".strtolower($std_hometown)."' ";
}
if (isset($std_relocate) && $std_relocate) {
	$sub_query1.= " and std_relocate = '". $std_relocate . "' ";
}
if (isset($std_contract) && $std_contract) {
	$sub_query1.= " and std_contract ='" . $std_contract . "' ";
}
if (isset($bond_duration) && $bond_duration) {
	$sub_query1.= " and bond_duration ='" . $bond_duration . "' ";
}
if (isset($std_project_name) && $std_project_name) {
	$sub_query1.= " and std_project_name ='" . strtolower($std_project_name) . "' ";
}
if (isset($branch_id) && $branch_id) {
	$sub_query1.= " and std_branch ='" . $branch_id . "' ";
}

/*
$sql = "Select * from tb_student_details
		where 1 " . $sub_query1 . $sub_query;

$result = mysql_query($sql);*/
$fields = ' u.user_name, s.std_fname, s.std_lname, s.std_phno, s.std_sphone, s.std_email, s.std_secondary_email,
    c.course_name, b.batch_name, br.branch_name,DATE_FORMAT(s.std_dob, "%e-%b-%Y") dob,s.std_passportno, s.std_hometown, s.std_ssc_year,s.std_ssc_board, s.std_ssc_percentage, 
    s.std_ipe_year, s.std_ipe_board, s.std_ipe_percentage, s.std_diploma_year, s.std_diploma_board, s.std_diploma_percentage,
    s.std_graduation_year, s.std_graduation_board, s.std_graduation_percentage, s.std_postgraduation_year, s.std_postgraduation_board,
    s.std_postgraduate_pecentage,if(std_relocate = "Y", "Yes", "No") relocate,if(s.std_contract = "Y", "Yes", "No") contract,
    if(s.std_job_offers = "Y", "Yes", "No") joboffer ,s.std_company_name,std_salary, DATE_FORMAT(s.std_job_jdate, "%e-%b-%Y"),
    s.std_project_name, s.std_project_duration, s.std_team, s.std_project_description, s.std_other_course, s.std_academic_gap,
    s.std_aca_gap_reason, s.std_graduation_gap, s.std_gra_gap_reason, s.std_coverletter, s.bond_duration, s.std_skill_set ';//,std_cirt_name,std_got_cirt

$tables = ' tb_student_details s     
    LEFT JOIN tb_courses c ON s.std_course=c.course_id
    LEFT JOIN tb_batch b ON b.batch_id=s.std_batch 
    LEFT JOIN tb_branches br ON br.branch_id=s.std_branch 
	LEFT JOIN tb_users u ON u.user_id=s.std_id  
    ';

$result = $db->fetchAllRecord( $tables, $fields, ' 1=1 '. $sub_query.$sub_query1, NULL, null, NULL, 0, 'All');
$file_ending = "xls";
$file_name = "hr_" . date("m_d_y") . ".xls";
;
//header info for browser
/* * *****Start of Formatting for Excel****** */
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
echo "Username, First Name,Last Name,Phone No,Secondary Phone,E-mail,Secondary E-mail,Course, Batch,Branch, Birth Date, Passport,Home Town,SSLC Year,SSLC Board,SSLC Percentage,2nd PU Year,2nd PU Board,2nd PU Percentage,Diploma Year,Diploma Board,Diploma Percentage,Graduation Year,Graduation Board,Graduation Percentage,PostGraduation Year,PostGraduation Board,PostGraduation Percentage,Relocation,Contract,Job Offers,Company Name,Salary,Job Join Date,Project Name,Project Duration,Team size,Projection Description,Other Course, Academic Gap,Academic Gap Reason, Graduation Gap,Graduation Gap Reason,Cover Letter,Bond Duration,Skills";
print("\n");
//end of printing column names  
//start while loop to get data
$data = '';
while ($row = mysql_fetch_row($result)) {
    $line = '';
    $cnt = count($row);
    $i = 1;
    foreach ($row as $value) {
        
        if($i != $cnt){
            if ((!isset($value)) OR ($value == "")) {
                $value = " ,";
            } else {
                $value = stripcslashes($value);
                $value = str_replace('"', '""', $value);
                $value = '"' . $value . '"' . ",";
            }         
        }
        else
        {
            $skills = '';
            if(trim($value) != '')
            {
                $skill_res = $db->fetchAllRecord(' tb_skills ', ' skill_name ', ' skill_id IN ('.$value.') ', NULL, null, NULL, 0, 'All');
                $skill_cnt = $db->getRowCount();
                if($skill_cnt > 0)
                {
                  while($skill = mysql_fetch_object($skill_res)){
                      $skills .= $skill->skill_name.',';
                  }
                  $value = '"'.trim($skills,','). '"' . ",";
                }else{
                    $value = " ,"; 
                }                
            }else{
                $value = " ,"; 
            }
                
        }            
        $line .= $value;
        $i++;
    }//For each
    $data .= trim($line) . "\n";
}
$data = str_replace("\r", "", $data);
if ($data == "") {
    $data = "\n(0) Records Found!\n";
}


print $data;
?>