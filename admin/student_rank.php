<?php
	$step = '2';
	$path = '.';
	
	$title =  'Student Rank';
	$css = array('styles.css','miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
	$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
	
    require_once('includes/common.php');
	require_once($path.'/common/attachsendmail.php');
	require_once($path."/common/sms.php");
	require_once($path."/mails/rank_mail.php");

	$store = false;
	$subject = 'Test Result With Rank';
	$headers = "From: info@abc4java.com";
	$db = new Query();
	$rank = $db->fetchAllRecord(' tb_student_results r, tb_users u ' , ' r.std_result_id,r.test_id,r.std_id,r.std_score,r.total_marks,r.std_test_date,r.std_attendance,r.std_submit_time, u.user_name, u.user_fullname ', ' u.user_id=r.std_id AND r.test_id = "'.$id.'" ' , NULL, ' r.std_score,r.std_submit_time ' , ' DESC,ASC ', 0,'All');
	
	function submitTime($date){
		if($date == '0000-00-00 00:00:00'){
			return 'Absent';
		}
		return date('H', strtotime($date)).' Hrs '.date('i', strtotime($date)).' Mins '.date('s', strtotime($date)).' Secs' ;
	}
?>
<div id="main">
	<div id="sts"></div>
	<div class="top-bar"><h1>Manage Result</h1></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
    <thead>
		<th>Student Name</th>
		<th>Student ID</th>
		<th>Total Mark</th>
        <th>Student Score</th>
        <th>Rank</th>
    </thead>
	  <tbody>
      <?php
		$row=0;
		while($data = mysql_fetch_object($rank))
		{
			$class = ($row%2) ? 'even' : 'odd';
			echo '<tr class="',$class,'">',"\n\t";
      		echo '<td>',$data->user_name,'</td>',"\n";
			echo '<td align="center">',$data->user_fullname,'</td>',"\n";
			echo '<td align="center">',$data->total_marks,'</td>',"\n";
			echo '<td align="center">',$data->std_score,'</td>',"\n";
			
            if($data->std_score == 0)
			{
				$std_rank =  $db->fetchRecord(' tb_student_rank ', ' * ', ' test_id="'.$data->test_id.'" and std_id="'.$data->std_id.'"  ');
				if($std_rank)
				{
				echo '<td align="center">',$row+1,'('.submitTime($data->std_submit_time).')</td>',"\n";
				}	
				else
				{
				echo '<td align="center">',$row+1,'('.submitTime($data->std_submit_time).')</td>',"\n";
				$rw = $row +1;
				$store = $db->storeDetails(' tb_student_rank ', ' test_id="'.$data->test_id.'",  std_score="'.$data->std_score.'", std_rank = "'.$rw.'", std_id="'.$data->std_id.'"');
				}
			}
			else 
			{
				$std_rank =  $db->fetchRecord(' tb_student_rank ', ' * ', ' test_id="'.$data->test_id.'" and std_id="'.$data->std_id.'"  ');
				if($std_rank)
				{
				echo '<td align="center">',$row+1,'('.submitTime($data->std_submit_time).')</td>',"\n";
				}
				else
				{
				echo '<td align="center">',$row+1,'('.submitTime($data->std_submit_time).')</td>',"\n";
				$row++;
				$store = $db->storeDetails(' tb_student_rank ', ' test_id="'.$data->test_id.'", std_id="'.$data->std_id.'", std_score="'.$data->std_score.'", std_rank = "'.$row.'" ');
				}
			}
			$std_rank =  $db->fetchRecord(' tb_student_rank ', ' * ', ' test_id="'.$data->test_id.'" and std_id="'.$data->std_id.'"  ');
			if($store)
			{
				$std_rank = ($data->std_score == 0) ? $rw : $row;
				
				$user =  $db->fetchRecord(' tb_student_details ', ' std_id,std_fname,std_lname,std_email,std_phno ', '  std_id="'.$data->std_id.'"  ');
				
				$arr = array('STD_FNAME>' => $user->std_fname,
							'<STD_LNAME>' => $user->std_lname,
							'<STD_EMAIL>' => $user->std_email,
							'<STD_PHNO>' => $user->std_phno ,
							'<STD_TOTMRKS>' => $data->total_marks,
							'<STD_SCORE>' => $data->std_score,
							'<STD_RNK>' => $std_rank
							);
				foreach($arr as $key => $val)
				{
					$body  = str_replace($key,$val,$body ); 
				}
				$to = $user->std_email;
				$fullname = htmlspecialchars(trim($user->std_fname . ' ' . $user->std_lname));
				
				if($user->std_phno != '' && strlen($user->std_phno)==10){
					sendSMS(4, $user->std_phno, $data->std_score, $row);
				}
				mailClient($to,$body,$subject,'abc4java','info@abc4java.com',trim($fullname));
			}
			echo '</tr>',"\n";			
		}
?>
		</table>
	</div>
	</body>
</html>