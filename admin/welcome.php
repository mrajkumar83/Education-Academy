<?php
require_once('common/configure.php');
require_once('classes/Database.class.php');
require_once('classes/Query.class.php');
require_once('common/sess.php');

$db = new Query();

$permissions = array("C" => "Counselor", "F" => "Finance", "O" => "Operational", "H" => "HR" , "B" => "Business Development");

$data1 = $db->fetchRecord(' tb_users ', ' user_branch,user_fullname,user_type ', ' user_id="'.$_SESSION['UID'].'" ');
$row1 = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id=' . $data1->user_branch . ' ');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="refresh" content="60">
		<meta name="author" content="Rajkumar Madishetti">

        <title>ABC for JAVA & TESTING</title>
		<link href="./css/styles.css" type="text/css" rel="stylesheet">
		
    </head>

    <body>
        <div class="content-warp home">
			 <h1>Welcome  <?php echo $data1->user_fullname; ?><?php echo ((($data1->user_type != 'SD' && $data1->user_type != 'GS') && isset($row1->branch_name) && $row1->branch_name != '' ) ? (', ' . $row1->branch_name) : ''); ?></h1>
			<?php //echo $date_time;?>
        </div>

<?php
	$current_date = date("Y-m-d", mktime(date('H')+5,date('i')+30,date('s'))); 
	
	$cond = ' A.announcement_status="A" AND announcement_date>="'.$current_date.'"  AND (A.announcement_createdby=1 || (A.announcement_createdby=U.user_id ';
	$cond .= (isset($UTYPE) && $UTYPE == 'SA') ? '' : ' AND U.user_branch="' . $data1->user_branch .'" ';//$user->user_branch
	$cond .= '))';
	$announcements = $db->fetchAllRecord(' tb_announcements A, tb_users U', ' DISTINCT(announcement_id), announcement_title, DATE_FORMAT(announcement_date, "%e/%m/%Y") announcement_date, announcement_content  ', $cond, NULL, null, NULL, 0, 'All');
	if ($db->getRowCount() > 0) {
		echo "<table class=\"listing form\" border=\"1\" align=\"center\" cellpadding=\"5\" cellspacing=\"0\" width=\"80%\">";
			echo '<tr><th colspan="4" class="full">Announcements</th></tr>';
			
		while($data = mysql_fetch_object($announcements)){
			echo '<tr class="bg">
                        <td class="first" colspan="3" align="left"><strong>', $data->announcement_title, '</strong></td>
                        <td class="last" align="left">', $data->announcement_date, '</td>
                    </tr>';
			echo '<tr>
                        <td colspan="4" align="left">', $data->announcement_title, '</td>
                    </tr>';
		}
		echo '</table>';
	}
	
$data = array();
if ($UTYPE == "SD") {  

    $data_user = $db->fetchRecord(' tb_student_details ', ' std_branch,std_batch ', ' std_id=' . $_SESSION['UID'] . ' ');
    $batch_id = $data_user->std_batch;
    $branch_id = $data_user->std_branch;
	
    $user_tests = $db->fetchAllRecord(' tb_test ', ' *, DATE_FORMAT(test_sdate, "%Y-%m-%e") test_sdate,DATE_FORMAT(test_sdate, "%e-%m-%Y") sdate ', ' test_batch="'.$batch_id.'" and test_branch="'.$branch_id.'" and test_sdate>="'.$current_date.'" ');
    
    if ($db->getRowCount() > 0) {
            while($user_test = mysql_fetch_object($user_tests)){
               $current_time = date("H:i", mktime(date('H')+5,date('i')+30,date('s')));
              //echo $current_time = date("H:i:s");
               // echo date("Y-m-d");
                
				$ucurrent_time = strtotime($current_time);
				
				$ucurrent_day = strtotime($current_date);				
				$utest_day = strtotime($user_test->test_sdate);
				
                $utest_etime = strtotime($user_test->test_endtime);
				$utest_stime = strtotime($user_test->test_starttime);
				
				if($ucurrent_day < $utest_day){
					//echo $current_date,'--',$ucurrent_day,'--',$utest_day,'--',$user_test->test_sdate,'<br>';
                    	
					$data[] = array('time' => $user_test->test_starttime,
                                         'id' => $user_test->test_id,
										 'date' => $user_test->sdate,
										 'click' => 'N'
										 );
				}
                if(($ucurrent_day ==$utest_day) && $ucurrent_time <= $utest_etime){				
                    $test_chk = $db->fetchRecord(' tb_student_results ', ' std_result_id ', ' test_id="'.$user_test->test_id.'" AND std_id="'.$_SESSION['UID'].'" AND std_attendance="A" ');					
                    if ($db->getRowCount() > 0) {
                    					
                        $data[] = array('time' => $user_test->test_starttime,
                                         'id' => $user_test->test_id,
										 'date' => $user_test->sdate,
										 'click' => ( ($ucurrent_time >= $utest_stime)? 'Y' : 'N')
										 );
                    }
                }
           }//End of while
    }//End of if
}
$data_cnt = count($data);
if($data_cnt > 0)
{	
    echo "<table border=\"1\" align=\"center\" cellpadding=\"5\" cellspacing=\"0\" >";
    for($i=0; $i<$data_cnt; $i++){
            echo "<tr><td height=\"150\">&nbsp;&nbsp;<h3>Hi you have to attend a test at ".$data[$i]['time']."<br />&nbsp;&nbsp;";
			if($data[$i]['click'] == 'Y'){
				echo "</h3><a href=\"question.php?test_id=".$data[$i]['id']."\">Click Here</a>&nbsp;to attend the test";
			}else{
				echo ' on ',$data[$i]['date'],'.</h3>';
			}
			echo "</td></tr>";
    }//End of for()
    echo '</table>';
}
?>
    </body>
</html>
