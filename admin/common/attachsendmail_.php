<?php
require("../classes/class.phpmailer.php");
include("../classes/class.smtp.php"); 

function mailClient($email,$body,$subject,$yourname,$youremail,$toname, $attachments=''){
	if($toname == '')
		$toname=$email;
	$mail = new phpmailer();
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$mail->Host       = 'mail.abcforjava.org';      // sets GMAIL as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the GMAIL server
	$mail->Username = 'info@javaforjava.org';
	$mail->Password = 'abc@123';  
	


	
	//$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Timeout = "300";
	$mail->IsHTML(true);
	$mail->From = $youremail;
	$mail->FromName = $yourname;
	$mail->AddReplyTo($youremail);
	$mail->WordWrap = 50;// set word wrap
	
	$mail->Body    = $body;
	$mail->Subject = $subject;
	$email = explode(',',$email);
	$toname = explode(',',$toname);
	$mail_cnt = count($email);
	for($i=0;$i<$mail_cnt;$i++)
		$mail->AddAddress($email[$i], $toname[$i]);
	
	if(is_array($attachments))
	{
		$attach_cnt = count($attachments);
		for($i=0; $i<$attach_cnt; $i++)
		{
			$mail->AddAttachment($attachments[$i]['path'], $attachments[$i]['name']);
		}
		if(!$mail->Send())
		{
			   $msg = "Message was not sent <br />";
			   $msg .= "Mailer Error: " . $mail->ErrorInfo;
		}//End of if
	}
	else
	$mail->Send();
	exit;
	//return $mail->Send();
	
}//End of Func(sending mail)

function prepareBody($fname, $arr)
{
	$fGetContents = file_get_contents('../mails/'.$fname.'.txt');
	foreach($arr as $key => $val)
	{
		$fGetContents = str_replace($key,$val,$fGetContents); 
	}
	return $fGetContents;
}