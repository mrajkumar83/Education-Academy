<?php

ini_set('max_execution_time', 30000);

$path = '.';
require_once($path.'/common/sess.php');
require_once($path.'/common/configure.php');
require_once($path.'/templates/loder.php');
require_once($path.'/classes/Database.class.php');
require_once($path.'/classes/Query.class.php');
require_once($path.'/common/attachsendmail.php');
require_once($path.'/common/sms.php');



$old_limit = ini_set("memory_limit", "200M"); 


$db = new Query();
$sub_query = "";
$sub_query1 = '';
$students_list = '';
$attach = '';
$interviewdate = '-';
$time = '-';
$i = 0;

$job_det = $db->fetchRecord(' tb_bd_job ', ' * ', ' bd_status = "A" AND bd_job_id = "'.$job_id.'"');

if(isset($op) && $op == 'Ext')
{
	//require_once('callletter_pdf.php');
	 $con = ' std_type="Y" ';
    
    if (isset($job_det->bd_percutoff) && $job_det->bd_percutoff == 'C') {
        $con .=' AND std_ssc_percentage >= 60 AND (std_ipe_percentage >= 60 OR std_diploma_percentage >= 60) AND std_graduation_percentage >= 60';
    }
    if (isset($job_det->bd_percutoff) && $job_det->bd_percutoff == 'G') {
        $con .=' AND std_graduation_percentage >= 60';
    }
    
    if (isset($job_det->bd_relocate) && $job_det->bd_relocate == 'Y') {
        $con .=' AND std_relocate = "' . $job_det->bd_relocate . '"';
    }
    
    if (isset($job_det->bd_bond) && $job_det->bd_bond == 'Y') {
        if (isset($job_det->bd_bondyear) && $job_det->bd_bondyear != '' ) {
            $con .=' AND bond_duration >= "' . $job_det->bd_bondyear . '" AND  std_contract = "Y"';
        }
    }
    
    if (isset($job_det->bd_yearofpass) && $job_det->bd_yearofpass != '') {
			$yearpass = explode(',', $job_det->bd_yearofpass);
			$yearpass_cnt = count($yearpass);
			for($k=0; $k<$yearpass_cnt; $k++){
				$tmp_cond[] = ' std_graduation_year="'.$yearpass[$k].'" ';
			}
		$con .=' AND ('.implode('OR', $tmp_cond).')';
		
	}
	
}
else
{
	if (isset($std_id) && is_array($std_id) && count($std_id)) {
		$students_list = implode(",", $std_id);
		$con = " std_id in (" . $students_list . ") ";
	}
}

$result = $db->fetchAllRecord(' tb_student_details ', ' std_id,std_email,std_fname,std_lname,std_phno,std_type ', $con, NULL, NULL, NULL, NULL, 'All');
$comments = $job_det->bd_comment;
$location = $job_det->bd_interviewloc;
$job_location = $job_det->bd_joblocation;
$company_name =  $job_det->bd_companyname;
$job_title = $job_det->bd_jobtitle;

if(isset($send) && ($send == 'Send Mail' || $send == 'External Students'))
{
	require_once($path.'/mails/'.(($send == 'External Students') ? 'interactive-mail4.php' : 'interview-mail.php'));
	$interviewdate = ((isset($job_det->bd_interviewdate) && ($job_det->bd_interviewdate != '' && $job_det->bd_interviewdate != '0000-00-00')) ? date("m/d/Y", strtotime($job_det->bd_interviewdate)) : '');
	$postdate = ((isset($job_det->bd_createddate) && ($job_det->bd_createddate != '' && $job_det->bd_createddate != '0000-00-00')) ? date("m/d/Y", strtotime($job_det->bd_createddate)) : '');
	if (strpos($job_det->bd_interviewtime, ":") !== false) {
		list($hr, $min, $ampm) = explode(':', $job_det->bd_interviewtime);
	}
	
	$ampm1 = (isset($ampm) && $ampm == 'A') ? 'AM' :  'PM';
	$time = ((isset($hr) && $hr == '' && isset($min) && $min == '') ? '-' : ($hr.':'.$min.' '.$ampm1)) ;
	
	while ($data = mysql_fetch_object($result))
	{
		$ufname = htmlspecialchars(trim($data->std_fname.' '.$data->std_lname));
		
		
		if($send == 'External Students'){
			$students_list .= $data->std_id.',';
		}
		switch($data->std_type){
			case 'Y': //External
				if($data->std_phno != '' && strlen($data->std_phno)==10){
					sendSMS(10, $data->std_phno, $data->std_fname.' '.$data->std_lname);
				}
				$subject = 'ABCforJAVA: Placement Invitation Letter for '.$job_det->bd_companyname;
				$msg = str_replace('<STD_NAME>', trim($ufname), $body1);
			break;
			
			case 'N': //External but not interested
			break;
			
			default: //Internal
				if($data->std_phno != '' && strlen($data->std_phno)==10){
					sendSMS(6, $data->std_phno, $job_det->bd_companyname);
				}
				$msg = str_replace('<STD_NAME>', trim($ufname), $body);
				$subject = 'INTERACTIVE PLACEMENT INVITATION';
			break;
		
		}//End of switch
		
		if($send == 'External Students'){
			
			$ch = curl_init('http://abc4java.com/admin/callletter_pdf.php');
			$data = 'to='.urlencode(trim($data->std_email)).'&STD_NAME='.trim($ufname).'&comments='.$comments.'&location='.$location.'&job_location='.$job_location.'&company_name='.$company_name.'&job_title='.$job_title.'&time='.$time.'&interviewdate='.$interviewdate;
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$cop = curl_exec($ch);
			curl_close($ch);
			//echo $cop;
		}else if($data->std_type != 'N'){
			$to = $data->std_email;		
			$headers = "From: info@abc4java.com";
			mailClient($to, $msg, $subject, 'abc4java', 'info@abc4java.com', trim($ufname), $attach);
		}
		@set_time_limit(0);//Infinite time
	}//End of while-data

	if($send == 'External Students'){
		require_once($path.'/mails/interactive-mail5.php');
		
		$con = " std_type='Y' ".(($students_list != '') ? "AND std_id NOT IN (".trim($students_list,',').") " : '');
		$result = $db->fetchAllRecord(' tb_student_details ', ' std_id,std_email,std_fname,std_lname,std_phno,std_type ', $con, NULL, NULL, NULL, NULL, 'All');
		while ($data = mysql_fetch_object($result))
		{
			$ufname = htmlspecialchars(trim($data->std_fname.' '.$data->std_lname));
			if($data->std_phno != '' && strlen($data->std_phno)==10){
				sendSMS(10, $data->std_phno, $data->std_fname.' '.$data->std_lname);
			}
			$subject = 'ABCforJAVA: Placement Invitation Letter for '.$job_det->bd_companyname;
			$msg = str_replace('<STD_NAME>', trim($ufname), $body2);
			$to = $data->std_email;		
			$headers = "From: info@abc4java.com";
			mailClient($to, $msg, $subject, 'abc4java', 'info@abc4java.com', trim($ufname));
		}//End of while -- Not selected candidates.
	}
}
if(isset($resend) && $resend == 'Resend Mail')
{
	ob_start();
	while ($data = mysql_fetch_object($result))
	{
		$std_job_enq = $db->fetchRecord(' tb_job_enquiry ', ' * ', ' job_id ="' . $job_det->bd_job_id . '" AND std_id = " '.$data->std_id.' "');
		
		if(!$std_job_enq)
		{		
			$interviewdate = ((isset($job_det->bd_interviewdate) && ($job_det->bd_interviewdate != '' && $job_det->bd_interviewdate != '0000-00-00')) ? date("m/d/Y", strtotime($job_det->bd_interviewdate)) : '');
			$ufname = htmlspecialchars(trim($data->std_fname.' '.$data->std_lname));
			if (strpos($job_det->bd_interviewtime, ":") !== false) {
				list($hr, $min, $ampm) = explode(":", $job_det->bd_interviewtime);
			}
			$ampm1 = (isset($ampm) && $ampm == 'A') ? 'AM' :  'PM';
		}
		$time = $hr.":".$min." ".$ampm1;
		if($data->std_phno != '' && strlen($data->std_phno)==10){
				sendSMS(6, $data->std_phno, $job_det->bd_companyname);
		}
	
		$body = '<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
        		
       			<br>
       			<p>Dear <strong>' .$data->std_fname.' '.$data->std_lname. ',</strong></p>
       			<div>Greetings.</div>
       			
      			<p> <span style="margin-left: 25px">  ABC is glad to inform that you have been short listed for an interview with <strong><span style="color: #006699">' . $job_det->bd_companyname .', '.$job_det->bd_joblocation.'
      			</span></strong> based on 
      				student information you have provided at the time of admission.</span></p>
		      	<p><b>Following are the details about the interview. </b></p>
	   	   		<table cellpadding="5" style="border:  0px solid black" width="450px">
	   	   		
		      		<tr>
		      			<td><b>Job Title : </b></td><td>' . $job_det->bd_jobtitle . '</td>
		      		</tr>
					<tr>
		      			<td><b>Company Name : </b></td><td>' . $job_det->bd_companyname . '</td>
		      		</tr>
		      		<tr>
		      			<td><b>Job Location : </b></td><td>' . $job_det->bd_joblocation . '</td>
		      		</tr>
		      		<tr>
		      			<td><b>Interview Location : </b></td><td>' . $job_det->bd_interviewloc . '</td>
		      		</tr>
		      		<tr>
		      			<td><b>Interview Date :</b> </td><td>' .  $interviewdate . '</td>
		      		</tr>
					<tr>
		      			<td><b>Interview Time :</b> </td><td>' .  $time . '</td>
		      		</tr>
		      		<tr>
		      			<td><b>Other Information: </b></td><td>' . $job_det->bd_comment . '</td>
		      		</tr>
		      		
		     	</table>
				<p style="color:#FF0000; font-weight:bold;">
					Caution: If you press yes button and collect the call letter and would not attend the interview (due to what ever reasons) then the software has been designed such that your database would be automatically deleted from ABC placement activities.
				</p>
				<p>If you are interested and want the call letter press <strong> YES</strong>. Otherwise press <strong>NO.</strong></p>
	            <a href="http://abc4java.com/email.php?op=Y&amp;std_id='.$data->std_id.'&amp;job_id='.$job_det->bd_job_id.'" target="_blank">
	            <input type="button" value="Yes" style="background-color:#01AAE3 !important "></a>
                &nbsp; &nbsp;&nbsp;
				<a href="http://abc4java.com/email.php?op=N&amp;std_id='.$data->std_id.'&amp;job_id='.$job_det->bd_job_id.'" target="_blank">
               <input type="button" value="No" name="no" style="background-color:#01AAE3 !important"></a>
         		<br><br>
       			
				</div>';
		
		$to = $data->std_email;
		$subject = 'INTERACTIVE PLACEMENT INVITATION';
		$headers = "From: info@abc4java.com";
		mailClient($to,$body,$subject,'abc4java','info@abc4java.com',trim($ufname));		
	}
	ob_flush();
}
@ob_end_flush();
?>
<script language="javascript">
	window.location.href = 'manage_hrjob.php';
</script>

</body>
</html>