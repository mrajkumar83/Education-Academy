<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/generate_password.php");
require_once("../classes/class.phpmailer.php");
$db = new Query();

extract($_REQUEST);

if($op != 'D')
{
	$branch_rec = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id="'.$_SESSION['UID'].'" ');	
	$_POST['std_branch'] = $branch_rec->user_branch;
	$branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id="'.$_POST['std_branch'].'" ');
	$branch_name = $branch->branch_name;
	$fbranch = strtoupper($branch_name[0]);
}
if(isset($std_batch) &&  std_batch != '')
{
	$batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_ampm,batch_startdt ', ' batch_id="'.$std_batch.'" ');	
	
	$month = date('F Y', strtotime($batch_name->batch_startdt));
	$fmonth = strtoupper($month[0]);
	$year = date('Y', strtotime($batch_rec->batch_startdt));
	$fyear = substr($year, 2);
	if(isset($batch_rec->batch_ampm) && $batch_rec->batch_ampm != '')
	{
		if($batch_rec->batch_ampm == 'A')
		{
			$moreve = 'M';
		}
		else
		{
			$moreve = 'E';
		}
	}
}
$user = 'ABC'.$fbranch.$moreve.$fmonth.$fyear.'0001';

$id = (isset($id)) ? $id : 0;
$sts = '';
switch($op)
{
	case 'A':
	case 'E':
	
	if($op=="A" ||($op=="E" && isset($new) && $new=="new"))
	{
		$_POST['user_name'] = $db->generatenextid('tb_users','user_name','STD','00',' user_name like "STD%" ');
		$username = $_POST['user_name'];
		$pass_word = generate_password(6);
		$_POST['user_password'] = md5($pass_word);
		
		$_POST['user_type'] = 'SD';
		$_POST['user_createddate'] = 'DATESTAMP';
		$_POST['user_fullname'] = $std_fname.' '.$std_lname;
		$_POST['user_email'] = $std_email;
		$student_id = $db->addToDB('tb_users');
		if(isset($student_id) && $student_id != '')
			{
				
				$body='<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
       			<h1><strong>Account Activated </strong></h1>  
       			<br>
       			<p>Hi '.$std_fname.',<u></u><u></u></p>
       			<p>Your  account is now active. Please use the below login details.<u></u><u></u></p>
      			<br /><br />
		      	<strong>Your Acount Details:<hr /></strong>         <br>
	   	   		<table>
					<tr>
		      			<td>First Name : </td><td>'.$std_fname.'</td>
		      		</tr>
					<tr>
		      			<td>Last Name : </td><td>'.$std_lname.'</td>
		      		</tr>
		      		<tr>
		      			<td>Email Id : </td><td>'.$std_email.'</td>
		      		</tr>
					<tr>
		      			<td>Phone No. : </td><td>'.$std_phno.'</td>
		      		</tr>
		     	</table>
						
       			<br>
   				<strong>Your Login Details:<hr /></strong>         <br>
				<table>
					<tr>
		      			<td>Username : </td><td>'.$username.'</td>
		      		</tr>
					<tr>
		      			<td>Password : </td><td>'.$pass_word.'</td>
		      		</tr>
				</table>
         		<br><br>
       			
				</div>';
				
				$body = eregi_replace("[\]",'',$body);
		   		$mail = new PHPMailer();
		   		$mail->IsMail();
		  		$mail->From = "info@school.com";
				$mail->FromName = "Schoolmanagement";
				$mail->AddAddress($std_email);
				$mail->WordWrap = 50;                                   // set word wrap to 50 characters
				$mail->IsHTML(true);
				$mail->Subject = "Your Account Is Now Active";
				$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$mail->MsgHTML($body);
				$mail->send();
			
	        }
			else {
			 echo "email not send.";
			}
		
		
		if($installment=="N")
		{
			$_POST['full_amt'] = $_POST['paid_amt'] = $amount_pay;
		}
		else
		{
			$_POST['full_amt'] = $amount_pay;
			$_POST['paid_amt'] = $balance;
		}
			
		$_POST['std_id'] = $student_id;
		$_POST['std_createdby'] = $_SESSION['UID'];
		$_POST['std_createddate'] = 'DATESTAMP';
		$_POST['std_photo'] = (isset($_FILES['std_photo']) && isset($_FILES['std_photo']['name']) && ($_FILES['std_photo']['name'] != '')) ? fileupload('IMG','../photos','std_photo','N', '', $id) : '';
		$db->addToDB('tb_student_details');
		
		if($student_id)
		{
			$_POST['createdby'] = $_SESSION['UID'];
			$_POST['createddate'] = 'DATESTAMP';

			$_POST['installment_due_date'] = convert_date($installment_due_date);
			$_POST['payment_date'] = convert_date($fee_date);
			$_POST['std_id'] = $student_id;
			
			if($installment=="N")
			{
				$_POST['paid_amount'] = $amount_pay;
				$_POST['balance'] = '0.00';
			}
			$_POST['fee_id'] = $db->addToDB('tb_student_fees');
			
			if(isset($mode_fields_count) && $mode_fields_count!=0)
			{
				for($i=1;$i<=$mode_fields_count;$i++)
				{
					$field_name = "mode_field_name".$i;
					$field_value = "mode_field_value".$i;
					$_POST['field_name'] = $$field_name;
					$_POST['field_value'] = $$field_value;
					$db->addToDB('tb_fee_fields');
				}
			}
		}
	}
	elseif($op=="E" && isset($old) && $old=="old" && isset($tbl) && $tbl=="enquiry")
	{
		  
		/*$data = $db->fetchRecord(' tb_enquiry ',' * ',' enquiry_id='.$id ,NULL, NULL, NULL, 0,'All');
  
		$_POST['std_fname'] = $data->enquiry_fname;
		$_POST['std_lname'] = $data->enquiry_lname;
		$_POST['std_phno'] = $data->enquiry_pnno;
		$_POST['std_email'] = $data->enquiry_email;
		$_POST['std_course'] = $data->enquiry_course;
		$_POST['std_batch'] = $data->enquiry_batch;
		$_POST['std_dob'] = $data->enquiry_dob;*/
		
		
		$_POST['user_name'] = $db->generatenextid('tb_users','user_name','STD','00',' user_name like "STD%" ');
		$username = $_POST['user_name'];
		$pass_word = generate_password(6);
		$_POST['user_password'] = md5($pass_word);
		$_POST['user_email'] = $_POST['std_email'];
		$_POST['user_type'] = 'SD';
		$_POST['user_createddate'] = 'DATESTAMP';
		$_POST['user_fullname'] = $_POST['std_fname'].' '.$_POST['std_lname'];
		$student_id = $db->addToDB('tb_users');
		
		if(isset($student_id) && $student_id != '')
			{
				
				$body='<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
       			<h1><strong>Account Activated </strong></h1>  
       			<br>
       			<p>Hi '.$std_fname.',<u></u><u></u></p>
       			<p>Your  account is now active. Please use the below login details.<u></u><u></u></p>
      			<br /><br />
		      	<strong>Your Acount Details:<hr /></strong>         <br>
	   	   		<table>
					<tr>
		      			<td>First Name : </td><td>'.$std_fname.'</td>
		      		</tr>
					<tr>
		      			<td>Last Name : </td><td>'.$std_lname.'</td>
		      		</tr>
		      		<tr>
		      			<td>Email Id : </td><td>'.$std_email.'</td>
		      		</tr>
					<tr>
		      			<td>Phone No. : </td><td>'.$std_phno.'</td>
		      		</tr>
		     	</table>
						
       			<br>
   				<strong>Your Login Details:<hr /></strong>         <br>
				<table>
					<tr>
		      			<td>Username : </td><td>'.$username.'</td>
		      		</tr>
					<tr>
		      			<td>Password : </td><td>'.$pass_word.'</td>
		      		</tr>
				</table>
         		<br><br>
       			
				</div>';
				
				$body = eregi_replace("[\]",'',$body);
		   		$mail = new PHPMailer();
		   		$mail->IsMail();
		  		$mail->From = "info@school.com";
				$mail->FromName = "Schoolmanagement";
				$mail->AddAddress($std_email);
				$mail->WordWrap = 50;                                   // set word wrap to 50 characters
				$mail->IsHTML(true);
				$mail->Subject = "Your Account Is Now Active";
				$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$mail->MsgHTML($body);
				$mail->send();
			
	        }
			else {
			 echo "email not send.";
			}
			
		
		$db->delData('tb_enquiry', ' enquiry_id="'.$id.'"');
		
		if($installment=="N")
		{
			$_POST['full_amt'] = $_POST['paid_amt'] = $amount_pay;
		}
		else
		{
			$_POST['full_amt'] = $amount_pay;
			$_POST['paid_amt'] = $balance;
		}
			
		$_POST['std_id'] = $student_id;
		$_POST['std_createdby'] = $_SESSION['UID'];
		$_POST['std_createddate'] = 'DATESTAMP';
		$_POST['std_photo'] = (isset($_FILES['std_photo']) && isset($_FILES['std_photo']['name']) && ($_FILES['std_photo']['name'] != '')) ? fileupload('IMG','../photos','std_photo','N', '', $id) : '';
		$db->addToDB('tb_student_details');
		
		
		
		$_POST['createdby'] = $_SESSION['UID'];
		$_POST['createddate'] = 'DATESTAMP';
		
		$_POST['std_id'] = $student_id;
		$_POST['installment_due_date'] = convert_date($installment_due_date);
		$_POST['payment_date'] = convert_date($fee_date);
		
		if($installment=="N")
		{
			$_POST['paid_amount'] = $amount_pay;
			$_POST['balance'] = '0.00';
		}
		
		$_POST['fee_id'] = $db->addToDB('tb_student_fees');
		
		if(isset($mode_fields_count) && $mode_fields_count!=0)
		{
			for($i=1;$i<=$mode_fields_count;$i++)
			{
				$field_name = "mode_field_name".$i;
				$field_value = "mode_field_value".$i;
				$_POST['field_name'] = $$field_name;
				$_POST['field_value'] = $$field_value;
				$_POST['createdby'] = $_SESSION['UID'];
				$_POST['createddate'] = 'DATESTAMP';
				$db->addToDB('tb_fee_fields');
			}
		}
	}
	elseif($op=="E" && !isset($tbl))
	{
		$_POST['modifiedby'] = $_SESSION['UID'];
		$_POST['modifieddate'] = 'DATESTAMP';
		
		$_POST['std_id'] = $id;
		$_POST['installment_due_date'] = convert_date($installment_due_date);
		$_POST['payment_date'] = convert_date($fee_date);
		
		if($installment=="N")
		{
			$_POST['paid_amt'] = $_POST['paid_amount'] = $amount_pay;
			$_POST['balance'] = '0.00';
		}
		
		$_POST['fee_id'] = $db->addToDB('tb_student_fees');
		
		if(isset($mode_fields_count) && $mode_fields_count!=0)
		{
			for($i=1;$i<=$mode_fields_count;$i++)
			{
				$field_name = "mode_field_name".$i;
				$field_value = "mode_field_value".$i;
				$_POST['field_name'] = $$field_name;
				$_POST['field_value'] = $$field_value;
				$_POST['createdby'] = $_SESSION['UID'];
				$_POST['createddate'] = 'DATESTAMP';
				$db->addToDB('tb_fee_fields');
			}
		}
	}
		
	break;

	case 'D':
			 $data = $db->fetchAllRecord(' tb_student_fees  ', ' * ', ' std_id='.$id);	
		
			while($row = mysql_fetch_object($data)) 
			{
				$db->delData('tb_fee_fields', ' fee_id="'.$row->fee_id.'"');
			}
			$db->delData('tb_student_fees', ' std_id="'.$id.'"');
				
	break;
}

header('Location: ../manage_payfees.php?sts='.$sts);
exit;