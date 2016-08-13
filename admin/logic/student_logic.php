<?php
require_once('../common/configure.php');
if(isset($utype) && $utype == 'GS')
{
	session_start();
}
else if(isset($type) && ($type == 'SD1' || $type == 'GS1'))
{
	session_start();
}
else
{
	require_once('../common/sess.php');
}
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");
require_once("../common/sms.php");

if(isset($_FILES['std_photo']))
{
	if(($_FILES['std_photo']["size"]/ 1024) > 1024)
	{
		header('Location: ../student.php?Err=S');
		exit;
	}
}
if(isset($_FILES['std_resume']))
{
	if(($_FILES['std_resume']["size"]/ 1024) > 2048)
	{
		header('Location: ../student.php?Err=R');
		exit;
	}
}

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
$Name = $std_fname . ' ' . $std_lname;
if(isset($op) && $op != 'D' )
{
	$std_access_card = isset($std_access_card) ? $std_access_card : '';
	$std_usno = isset($std_usno) ? $std_usno : '';
	$fields = 'std_fname="'.$std_fname.'" ,std_lname="'.$std_lname.'" ,std_email="'.$std_email.'",std_secondary_email="'.$std_secondary_email.'",	std_phno="'.$std_phno.'", std_sphone="'.$std_sphone.'", std_access_card="'.$std_access_card.'"
			, std_hometown="'.$std_hometown.'", std_gender="'.$std_gender.'", std_ssc_year="'.$std_ssc_year.'", std_ssc_board="'.$std_ssc_board.'", std_ssc_percentage="'.$std_ssc_percentage.'"
			, std_ipe_year="'.$std_ipe_year.'", std_ipe_board="'.$std_ipe_board.'", std_ipe_percentage="'.$std_ipe_percentage.'", std_graduation_year="'.$std_graduation_year.'"
			, std_graduation_board="'.$std_graduation_board.'", std_graduation_percentage="'.$std_graduation_percentage.'"
			,std_graduation_college="'.$std_graduation_college.'", std_graduation_branch="'.$std_graduation_branch.'", std_gusno="'.$std_gusno.'", std_garrears="'.$std_garrears.'", std_gblogs="'.$std_gblogs.'"
			,std_postgraduation_year="'.$std_postgraduation_year.'"
			,std_postgraduation_board="'.$std_postgraduation_board.'",std_postgraduate_pecentage="'.$std_postgraduate_pecentage.'"
			,std_postgraduation_college="'.$std_postgraduation_college.'", std_postgraduation_branch="'.$std_postgraduation_branch.'"
			,std_pusno="'.$std_pusno.'", std_parrears="'.$std_parrears.'", std_pblogs="'.$std_pblogs.'"
			, std_team="'.$std_team.'",std_contract="'.$std_contract.'"
			, std_relocate="'.$std_relocate.'", std_job_offers="'.$std_job_offers.'", std_salary="'.$std_salary.'", std_other_course="'.$std_other_course.'",std_got_cirt="'.$std_got_cirt.'"
			, std_academic_gap="'.$std_academic_gap.'", std_graduation_gap="'.$std_graduation_gap.'", std_passportno="'.$std_passportno.'" ';
	
		if(isset($skills) && is_array($skills))
		{
			$fields .= ', std_skill_set="'.implode(",",$skills).'" ';
		}
		$fields .= ', bond_duration="'.((isset($std_contract) && $std_contract == 'N') ? 0 : $bond_duration ). '" '; 
		$fields .= ', std_dob="'. convert_date($std_dob).'" ';
		$fields .= ', std_job_jdate="'.convert_date($std_job_jdate).'", std_cirt_name="'.$std_cirt_name.'", std_aca_gap_reason="'.$std_aca_gap_reason.'", std_gra_gap_reason="'.$std_gra_gap_reason.'", std_coverletter="'.$std_coverletter.'" ';
		$fields .= ', std_project_name="'.$std_project_name.'",	std_team="'.(isset($std_team) ? $std_team : 'G').'", std_project_duration="'.$std_project_duration.'", std_project_description="'.$std_project_description.'" ';
}
switch($op)
{
	case 'A':
		
		$user = 'ABCN';
		$_POST['user_name'] = $db->generatenextid('tb_users', 'user_name', $user, '000', ' user_name like "' . $user . '%" ');
		$username = $_POST['user_name'];
        $pass_word = 'abc';//generate_password(6);
		$_POST['user_type'] = 'GS';
		$_POST['user_password'] = md5('abc');//md5($pass_word);
		$_POST['user_branch'] = $std_branch;
		$_POST['user_email'] = $std_email;
		$_POST['user_createddate'] = 'DATESTAMP';
		$_POST['user_fullname'] = htmlspecialchars(trim($Name));
		
		$id = $db->addToDB('tb_users');
		
		if (isset($id) && $id != '') {
			$fields .= ',std_id="'.$id.'", std_createdby="'.$_SESSION['UID'].'", std_createddate="'.DATE_TIME_FORMAT.'" ';
			$db->storeDetails('tb_student_details', $fields);
		
			if($std_phno != '' && strlen($std_phno)==10){
					sendSMS(7, $std_phno);
					sendSMS(8, $std_phno, $username, $pass_word);
				}
		
                $body = '<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
       			<h1><strong>Account Activated </strong></h1>  
       			<br>
       			<p>Hi ' . $std_fname . ',</p>
       			<p>Your  account is now active. Please use the below login details.</p>
      			<br /><br />
		      	<strong>Your Acount Details:<hr /></strong><br>
	   	   		<table>
					<tr>
		      			<td>First Name : </td><td>' . $std_fname . '</td>
		      		</tr>
					<tr>
		      			<td>Last Name : </td><td>' . $std_lname . '</td>
		      		</tr>
		      		<tr>
		      			<td>Email Id : </td><td>' . $std_email . '</td>
		      		</tr>
					<tr>
		      			<td>Phone No. : </td><td>' . $std_phno . '</td>
		      		</tr>
		     	</table>
						
       			<br>
   				<strong>Your Login Details:<hr /></strong><br>
				<table>
					<tr>
		      			<td>Username : </td><td>' . $username . '</td>
		      		</tr>
					<tr>
		      			<td>Password : </td><td>' . $pass_word . '</td>
		      		</tr>
				</table>
         		<br><br>
       			
				</div>';
				
				$subject = 'Your Account Is Now Active';
				$fullname = htmlspecialchars(trim($std_fname . ' ' . $std_lname));
				
				mailClient($std_email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname);               
            }
	break;
	case 'E':
		$fields .= ', std_modifedby="'.$_SESSION['UID'].'", std_modifeddate="'.DATE_TIME_FORMAT.'" ';
		$db->storeDetails('tb_student_details', $fields, ' WHERE std_id = "' . $id . '"');
		$user_status = (isset($UTYPE) &&  ($UTYPE == 'SA' || $UTYPE == 'AD') ) ? ', user_status="'.$user_status.'" ' : ' ';
		$db->storeDetails('tb_users', ' user_email="'.$std_email.'", user_fullname="'.htmlspecialchars(trim($Name)).'", user_modifedby="'.$_SESSION['UID'].'", user_modifeddate="'.DATE_TIME_FORMAT.'"'.$user_status, ' WHERE user_id = "' . $id . '"');
		if($std_type === 'Y'){
			require_once('../mails/interactive-mail3.php');
			$subject = 'ABCforJAVA: Profile Update Alert';
			$msg = str_replace('<STD_NAME>', trim($Name), $body);
			sendSMS(12, $std_phno, trim($Name));
			mailClient($std_email, $msg, $subject, ADMINNAME, ADMINMAIL, trim($Name));
		}
		
	break;
	case 'D':
			$db->delData('tb_student_details', ' std_id="'.$id.'"');
			$db->delData('tb_users',' user_id="'.$id.'"');
			header('Location: ../manage_stddetails.php?utype=SD');
			exit;
	break;
}
$image = (isset($_FILES['std_photo']) && isset($_FILES['std_photo']['name']) && ($_FILES['std_photo']['name'] != '')) ? ' std_photo = "'.fileupload('IMG','../photos','std_photo','N', '', $id).'"' : '';

if($image != '')
{
	$db->storeDetails('tb_student_details', $image, ' WHERE std_id = "'.$id.'"');
}
$resumes = (isset($_FILES['std_resume']) && isset($_FILES['std_resume']['name']) && ($_FILES['std_resume']['name'] != '')) ? ' std_resume = "'.fileupload('TXT','../resumes','std_resume','N', '', $id).'"' : '';

if($resumes != '')
{
	
	$db->storeDetails('tb_student_details', $resumes, ' WHERE std_id = "'.$id.'"');
}
if(isset($op) && $op == 'E')
{
	  if(isset($UTYPE) && ($UTYPE == 'SA' || $UTYPE == 'AD'))
		{
			echo '<html><body><script>alert("Profile is Successfully Updated.");window.location.href="../manage_stddetails.php?utype=SD";</script></body></html>';
			header('Location: ../manage_stddetails.php?utype=SD');
		}
		else if(isset($utype) && $utype == 'GS' && $type != 'GS1')
		{
		 	echo '<html><body><script>alert("Your Profile is Successfully Updated.");window.location.href="../../index.php?Err=6";</script></body></html>';
		}	
		
		else if(isset($utype) && $utype == 'SD'&& $type != 'SD1')
		{
			echo '<html><body><script>alert("Your Profile is Successfully Updated.");window.location.href="../student.php?sts='.$sts.'";</script></body></html>';
		}
		
		else if(isset($type) && $type == 'SD1' && isset($utype) && $utype == 'SD')
		{
			echo '<html><body><script>alert("Your Profile is Successfully Updated.");window.location.href=" ../manage_stddetails.php?utype=SD";</script></body></html>';
		}	
		else if(isset($type) && $type == 'GS1' && isset($utype) && $utype == 'GS')
		{
			echo '<html><body><script>alert("Your Profile is Successfully Updated.");window.location.href="../manage_stddetails.php?utype=GS";</script></body></html>';
		}			
}

if(isset($UTYPE) && ($UTYPE == 'SA' || $UTYPE == 'AD'))
{
	header('Location: ../manage_stddetails.php?utype=SD');
}
else if(isset($utype) && $utype == 'GS' && $type != 'GS1')
{
	header('Location: ../../index.php?Err=6');
}
else if(isset($utype) && $utype == 'SD'&& $type != 'SD1')
{
	header('Location: ../student.php?sts='.$sts);
}
else if(isset($type) && $type == 'SD1' && isset($utype) && $utype == 'SD')
{
	header('Location: ../manage_stddetails.php?utype=SD');
}	
else if(isset($type) && $type == 'GS1' && isset($utype) && $utype == 'GS')
{
	header('Location: ../manage_stddetails.php?utype=GS');
}		

exit;