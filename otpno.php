<?php
session_start();
$path = './admin/';

require_once($path . 'common/configure.php');
require_once($path . 'common/attachsendmail.php');
require_once($path . 'common/sms.php');

if (isset($_SESSION) && isset($_SESSION['UID'])) {
    header("Location: home.php");
    exit;
}

if(isset($sub) && $sub == 'SUBMIT')
{
	$_SESSION['FNAME'] = $fname;
	$std_fname = $_SESSION['FNAME'];
	$_SESSION['LNAME'] = $lname;
	$std_lname = $_SESSION['LNAME'];
	$_SESSION['PHNO'] = $phone = $phno;
	
	$_SESSION['EMAILID'] = $std_email;
	$email = $_SESSION['EMAILID'];
	$_SESSION['OTPNO'] = $rand;
	$otp = $_SESSION['OTPNO'];
    $_SESSION['TIME'] = $time;
	if(isset($rand) && $rand != '')
	{
		if($phone != '' && strlen($phone)==10){		
			sendSMS(5, $phone, $_SESSION['OTPNO']);
		}
		require_once($path.'mails/otp-mail.php');
		
		$subject = 'Your OTP to Activate ABC account';
		$fullname = htmlspecialchars(trim($std_fname . ' ' . $std_lname));
		
		mailClient($email,$body, $subject, 'abc4java' , 'info@abc4java.com  ', $fullname);  
	}   
}
if(isset($submit) && $submit == 'VERIFY')
{	
	 $sessiontime = strtotime($_SESSION['TIME']) + strtotime('+24 hours');//120;
	 $currenttime = strtotime(date("H:i:s"));
	if(isset($_SESSION['OTPNO']) && isset($otpno) && ($_SESSION['OTPNO'] == $otpno))
	{
		
		if($sessiontime <= $currenttime)
		{
			header('location:index.php?Err=7');
			exit;
		}
		if($sessiontime >= $currenttime)
		{
			header('location:guest.php?utype=GS');
			exit;
		}		
	}
	else {
		$err = 'please enter valid OTP number';
	}
}
require_once($path.'templates/otpno.php');