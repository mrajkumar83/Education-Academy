<?php
$p = (isset($path) && $path != '') ? $path : '..';

require($p.'/classes/class.phpmailer.php');
include($p.'/classes/class.smtp.php'); 

function mailClient($email,$body,$subject,$yourname,$youremail,$toname, $attachments='', $bcc=''){
	if($toname == '')
		$toname=$email;
	$mail = new phpmailer();
	
	$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server  111.118.184.58  103.8.127.88
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username = "info@abcforjava.org";
	$mail->Password = "abc@123";  
	
	
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
	if($mail_cnt == 1 && $email[0] === $youremail && $bcc != ''){
		$bcc = explode(',',$bcc);
		$mail_cnt = count($bcc);
		$mail->AddAddress($youremail, $yourname);
		for($i=0;$i<$mail_cnt;$i++)
			$mail->AddBCC($bcc[$i], $toname[$i]);
	}
	else{
		for($i=0;$i<$mail_cnt;$i++)
			$mail->AddAddress($email[$i], $toname[$i]);
	}//
	
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
	
	return $mail->Send();
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