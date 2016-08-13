<?php
$step = '2';
$path = '.';
$title = 'Test';
$css = array('styles.css');
$js = array();

require_once('includes/common.php');

$db = new Query();
$id = $UID;
$op = isset($op) ? $op : '';
$test_date = date("Y-m-d");
$todaydate = date('Y-m-d',mktime(date('H')+5,date('i')+30));
$current_time = date("H:i", mktime(date('H')+5,date('i')+30));
$utodaydate =  strtotime(date('Y-m-d',mktime(date('H')+5,date('i')+30)));
//$current_time = date("Y-m-d");
//$utodaydate = strtotime(date("Y-m-d"));

$ucurrent_time = strtotime(date("H:i", mktime(date('H')+5,date('i')+30)));
//$ucurrent_time = strtotime(date("H:i:s"));
$msg =  '';
if (isset($test_id) && $test_id != '') {
	
    $data = $db->fetchRecord(' tb_users ', ' * ', ' user_id ="' . $id . '"');
    $test = $db->fetchRecord('tb_test ', ' *,DATE_FORMAT(test_sdate, "%Y-%m-%e") test_sdate ', ' test_id= "'.$test_id.'"  ', NULL, 'test_name', NULL, NULL, 'All');// AND test_sdate ="'.$test_date.'" AND test_starttime >="'.$current_time.'" AND test_endtime<="'.$current_time.'" 
	$test_date = $test->test_sdate;
	$utest_date = strtotime($test_date);
	$utest_etime = strtotime($test->test_endtime);
	$utest_stime = strtotime($test->test_starttime);
	
	if($utest_date != $utodaydate){
		echo '<div id="main">
				<div class="top-bar"><h1>',$title,'</h1></div>This Test is not <strong>today</strong>
			</div>
		</body>
	</html>';
		exit;
	}
	else
	{
		if($ucurrent_time < $utest_stime){
			echo '<div id="main">
					<div class="top-bar"><h1>',$title,'</h1></div>Please refresh the page on time to attend the exam.
					</div>
				</body>
			</html>';
		exit;
		}
		if($ucurrent_time > $utest_etime){
			echo '<div id="main">
				<div class="top-bar"><h1>',$title,'</h1></div>Exam time is completed.
			</div>
		</body>
	</html>';
		exit;
		}		
		
	}
	
} else {
    
    $current_time = date("H:i:s", mktime(date('H')+5,date('i')+30,date('s')));
    //$current_time = date("H:i:s");
    $data_user = $db->fetchRecord(' tb_student_details ', ' std_branch,std_batch ', ' std_id="'.$_SESSION['UID'].'" ');
    $batch_id = $data_user->std_batch;
    $branch_id = $data_user->std_branch;
	$test_today = $db->fetchAllRecord(' tb_test ', ' * ', ' test_batch="'. $batch_id.'" AND test_branch="'.$branch_id.'" AND test_sdate ="'.$test_date.'"  ');
	if($db->getRowCount() > 0){
		$test = $db->fetchRecord(' tb_test ', ' * ', ' test_batch="'. $batch_id.'" AND test_branch="'.$branch_id.'" AND test_sdate ="'.$test_date.'" AND test_starttime <="'.$current_time.'" AND test_endtime>="'.$current_time.'" ');//  AND test_endtime>="'.$test_endtime.'"
		$msg = 'Please wait and Refresh at the test Time.';
	}
	
		$ucurrent_time = strtotime(date("H:i", mktime(date('H')+5,date('i')+30)));
		//$ucurrent_time = strtotime('H:i:s');
		$utest_endtime = strtotime($user_test->test_endtime);
		$utest_starttime = strtotime($user_test->test_starttime);

    $test_id = isset($test->test_id) ? $test->test_id : 0;
}
if($test_id == 0 && $msg != ''){
}else
if($test_id != 0 ){
    
    $data = $db->fetchRecord(' tb_student_results ', ' std_result_id ', ' test_id="'.$test_id.'" AND std_id="'.$id.'" AND std_attendance!="A" ');
	
    if($db->getRowCount() > 0)
    {       	  
        header('Location: thankyou.php?id='.$data->std_result_id);
        exit;
    }
    
    $current_time = date("H:i:s", mktime(date('H')+5,date('i')+30,date('s')));
    
    list($c_hr, $c_min, $c_sec) = explode(":", $current_time);
    list($hr, $min, $sec) = isset($test->test_endtime) ? explode(":", $test->test_endtime) : '00:00:00';

    $test_dhr = $hr - $c_hr;
    $test_dmin = $min - $c_min;
    $test_dsec = $sec - $c_sec;

    if ($test_dsec < 0) {
        $test_dmin = $test_dmin - 1;
        $test_dsec = 60 + $test_dsec;
    }

    $test_duration = $test_dhr . ":" . $test_dmin . ":" . $test_dsec;
    $total_secs = 0;
    $total_secs+= $test_dhr * 3600;
    $total_secs+= $test_dmin * 60;
    $total_secs+= $test_dsec;
    $milliseconds = $total_secs * 1000;

    if (isset($test_id) && $test_id != '') {
        $questions = $db->fetchAllRecord('tb_test_details ', ' * ', ' test_id= "'. $test_id.'" ', NULL, NULL, NULL, NULL, 'All');
    }
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/question.php');?>
</div>
</body>
</html>

