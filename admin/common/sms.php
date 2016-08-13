<?php

function sendSMS($opt, $mobile, $param1='', $param2=''){
	switch($opt){
		//Staff
		case 13:
			$msg = urlencode("Dear Staff, Your registration process with ABC is completed successfully. Team ABC welcomes you.");
		break;
		
		case 0:
			$msg = urlencode("Dear Staff, Login at www.abcforjava.org using your Username as $param1 and Password as $param2.");
		break;
		
		case 1:
			$msg = urlencode('Dear Student, Your registration process with ABC is completed successfully. Team ABC welcomes you for a new learning experience.');
		break;
		
		//Student
		case 2:
			$msg = urlencode("Dear Student, Login at www.abcforjava.org using your Username as $param1 and Password as $param2.");
		break;		
		case 3:
			$msg = urlencode('Dear Student, a test is scheduled on '.$param1.' at '.$param2.'. Kindly attend the test. This Score is mandatory for Placement evaluation.');
		break;
		case 4:
			$msg = urlencode('Dear Student, your test result is  '.$param1.' and test rank is '.$param2.'.');
		break;
		case 9:
			$msg = urlencode('Dear Student,Please check your mail. We have sent you an important message.Team ABC');
		break;
		
		//OTP
		case 5:
			$msg = urlencode('Dear User, Your One Time Password is '.$param1.'. Please use it before 24 Hours. Team ABC.');
		break;
		
		case 6:
			$msg = urlencode('You have been short listed for '.$param1.'. Check your email & reply within 24 hrs. Failing which you will miss the offer. Team ABC.');
		break;
		
		//Guest
		case 7:
			$msg = urlencode('Dear User, Your registration process with ABC is completed successfully. Team ABC welcomes you.');
		break;
		case 8:
			$msg = urlencode('Dear User, Your Username is '.$param1.' and Password is '.$param2.'. Login at www.abcforjava.org.');
		break;
		
		//External Std
		case 10:
			$msg = urlencode("Dear Student, ABC (Aradhya's Brilliance Center) for Java & Testing a sister concern of Aradhya Tutorials is pleased to announce a series of JOB PLACEMENT DRIVES during June, July, & August 2014 for all fresh Engineering Graduates of 2014 Batch. An email has been sent to your mail-ID which has the details of these drives. Follow the instructions given in the email to be eligible for the drive. If you have not received the email then please contact us on +91 96-20-020502 or +91 96-20-020802. If you want to know the details of the Placement Drives which we have already conducted for 2014 Batch visit our FaceBook page - ABC for Java and Testing and Like it. Team ABC.");
		break;
		
		case 11:
			$msg = urlencode('Dear '.$param1.', login at www.abcforjava.org using Username as '.$param2.' and Password as '.$mobile.'. Team ABC.');
		break;
		
		case 12:
			$msg = urlencode('Dear '.$param1.', Your profile information has been successfully updated. Team ABC.');
		break;
		
		case 14:
			$msg = urlencode(' ');
		break;
	}//Max-12
	
	$ch = curl_init('http://www.unicel.in/SendSMS/sendmsg.php');
	$data = 'uname=gigavit&pass=abc4java&send=ABCGRP&dest=91'.$mobile.'&msg='.$msg;
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($ch);
	curl_close($ch);
}