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

$table = ' tb_hr_remarks hr';

if (isset($student_id) && is_array($student_id) && count($student_id)) {
    $students_list = implode(",", $student_id);
    $sub_query = " AND hr.student_id in (" . $students_list . ")";
}

if($_SESSION['UTYPE'] == 'SF' && isset($_SESSION['UBRANCH'] )){
	$table .= ', tb_users u  ';
	 $sub_query .= ' AND u.user_branch="'.$_SESSION['UBRANCH'].'" AND u.user_id=hr.student_id ';
}
if (isset($date) && $date != '') {
	$sub_query1.= " AND hr.date ='" . convert_date($date) . "' ";
}
if (isset($batch_id) && $batch_id != '' && isset($branch_id) && $branch_id != '') {
	$sub_query1.= " AND hr.batch_id =" . $batch_id . " AND hr.branch_id=" . $branch_id . "";
}
if(isset($mockrating) &&  $mockrating != ''){
	$sub_query1.= ' AND hr.mock_rating >="'.$mockrating .'" ';
}
if(isset($sname) &&  $sname != ''){
	$sub_query1.= ' AND hr.student_name LIKE "'.$sname.'%"';
}
/*
$sql = "Select student_id,student_name,date,mock_rating,Remark from tb_hr_remarks
		where 1 " . $sub_query;
$result = mysql_query($sql);*/

function convert_rating($rating){
    if($rating >= 9){
        return 'Excellent';
    }
    elseif ($rating >= 7 && $rating < 9) {
        return 'Good';
    }
    elseif ($rating >= 5 && $rating < 7) {
        return 'Satisfactory';
    }
    else{
        return 'Un-Satisfactory';
    }
}//Endo of Func
$result = $db->fetchAllRecord( $table, ' hr.student_username, hr.student_name, hr.date, hr.mock_rating, hr.Remark ', ' 1=1 '. $sub_query.$sub_query1, NULL, null, NULL, 0, 'All');

$file_ending = "xls";
$file_name = "hr_" . date("m_d_y") . ".xls";
;
//header info for browser
/* * *****Start of Formatting for Excel****** */
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
echo "Username, Name, Date, Rating, Remarks";
print("\n");
//end of printing column names  
//start while loop to get data
$data = '';
while ($row = mysql_fetch_row($result)) {
    $line = '';
    $i = 1;
    $row_cnt = count($row)-1;
    foreach ($row as $value) {
        if ((!isset($value)) OR ($value == "")) {
            $value = " ,";
        } else {
            $value = stripcslashes($value);
            $value = str_replace('"', '""', $value);
            $value = '"' .(($i == $row_cnt) ? convert_rating($value) : $value). '"' . ",";
        }
        $line .= $value;
        $i++;
    }
    $data .= trim($line) . "\n";
}
$data = str_replace("\r", "", $data);
if ($data == "") {
    $data = "\n(0) Records Found!\n";
}

print $data;
?>