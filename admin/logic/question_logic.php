<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once("../common/attachsendmail.php");

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';

$studentscore = 0;
$totalmarks = 0; 
function convertOptions($opt){
	if(isset($opt)){
		switch($opt){
			case 'option1':
				return 'A';
			break;
			
			case 'option2':
				return 'B';
			break;
			
			case 'option3':
				return 'C';
			break;
			
			default:
				return 'D';
			break;
		}
	}else{
		return '';
	}
}

for ($i=1; $i < $total_qst ; $i++) {  	 
    $Question_std_ans = "question_".$i;
    $student_ans = $$Question_std_ans; 
    $answer = "answer_".$i;
	$true_ans = $$answer;
	
   //   $true_ans = convertOptions($$answer);
	
    $mark = "qust_marks_".$i;
    $qmark = $$mark; 
    $totalmarks = $totalmarks + $qmark;
	if(isset($student_ans) && $student_ans != '')
    {
        if(isset($true_ans) && ($student_ans == $true_ans))
        {
            if(isset($qmark) && $qmark)
            {
               $studentscore = $studentscore + $qmark;
            }
        }
    }
  }//End of for();;

$current_time = date("H:i:s", mktime(date('H')+5,date('i')+30,date('s')));
$datetime = date("Y-m-d ".$current_time." ");
$current_date = date("Y-m-d");
$db->storeDetails(' tb_student_results ', ' std_attendance="P", total_marks="'.$totalmarks.'", std_score="'.$studentscore.'", std_submit_time = "'.$datetime.'", std_test_date="'.$current_date.'" ', ' WHERE std_id="'.$id.'" AND test_id="'.$test_id.'"');
$data =  $db->fetchRecord(' tb_student_results ', ' std_result_id ', ' test_id="'.$test_id.'" and std_id="'.$id.'"  ');
  	  
header('Location: ../thankyou.php?id='.$data->std_result_id.'&tmarks='.$totalmarks.'&score='.$studentscore);
exit;