<?php
$body1 = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
					<head>
					<style>
						@page {
							margin:0;
							padding:0;
						}
						body {
							margin: 0; 
							padding: 0;
							background-color: #FFFFFF;
							background-image: url(http://localhost/admin/img/call_letter.jpg);
							background-position: top left;
							background-repeat: no-repeat;
							width:612px;
							height:792px;
						}
						#bck-img{margin-top: 200px;}
					</style>	
					</head>
					<body>

<table id="bck-img">
			<tr>
				<td>Dear <STD_NAME>,<br></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>CONGRATUALTIONS! ABC is glad to inform that, you have been short listed for an exclusive recruitment drive conducted by ABC for JAVA & TESTING for <strong>'.$company_name.'</strong>, '.$job_location.' based on student information you have provided at the time of admission.
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<strong>Following are the details about the interview.</strong></td>
			</tr>
			<tr>
				<td>
					<table cellspacing="0" cellpadding="3" border="1" width="100%" style="border-collapse:collapse;">
						<tr>
							<td><strong>Job Title:</strong></td>
							<td><strong>' . $job_title . '</strong></td>
						</tr>

						<tr>
							<td><strong>Company Name:</strong></td>
							<td><strong>'.$company_name.'</strong></td>
						</tr>

						<tr>
							<td><strong>Job Location:</strong></td>
							<td><strong>'.$job_location.'</strong></td>
						</tr>
						<tr>
							<td><strong>Interview Location:</strong></td>
							<td><strong>' . $location . '</strong></td>
						</tr>
						<tr>
							<td><strong>Interview Date:</strong></td>
							<td><strong>' .  $interviewdate . '</strong></td>
						</tr>
						<tr>
							<td><strong>Interview Time:</strong></td>
							<td><strong>' .  $time . '</strong></td>
						</tr>
						<tr>
							<td><strong>Other Information:</strong></td>
							<td><strong>' . $comments . '</strong></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
					<br>
					<span style="color:#FF0000;">Note: Please carry this Placement Invitation Letter along with your Photo ID Proof, Passport-Size Photograph, Copy of Educational Certificates and Updated Hard Copy of your Resume for the Placement Drive.</span>
					<br>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
					<td>Thanks & Regards,<br>'.
'Team ABC for JAVA & TESTING<br>'.
'www.abcforjava.org</td></tr></table>
</body></html>';