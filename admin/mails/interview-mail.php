<?php
$body = '<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
        		
       			<br>
       			<p>Dear <strong><STD_NAME>,</strong> <u></p>
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
					<a href="http://abc4java.com/email.php?op=Y&amp;std_id=<STD_ID>&amp;job_id='.$job_det->bd_job_id.'" target="_blank">
					<input type="button" value="Yes" style="background-color:#01AAE3 !important "></a>
					&nbsp; &nbsp;&nbsp;
					<a href="http://abc4java.com/email.php?op=N&amp;std_id=<STD_ID>&amp;job_id='.$job_det->bd_job_id.'" target="_blank">
					<input type="button" value="No" name="no" style="background-color:#01AAE3 !important"></a>
					<br><br>       			
				</div>';