<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once("../common/attachsendmail.php");
//require_once("../common/generate_password.php");

$db = new Query();
$link = 'Location: ../../forgot-password.php?Err=';

if(isset($submit) && $submit == 'Send')
{	
	if(isset($uemail))
	{
		$rec = $db->fetchRecord(' tb_users ', ' * ', ' user_email="'.$uemail.'" ');		
		
		if(!isset($rec) && $rec == '')
		{			
			header($link.'2');
			exit;
		}
		
		if($rec->user_status == 'D')
		{
			header($link.'3');
			exit;
		}
		$user_password = 'abc4java';//generate_password(6);		
		$store = $db->storeDetails('tb_users', '  user_password = "'.md5($user_password).'"', ' WHERE user_id="'.$rec->user_id.'"');
		
		if (isset($store) && $store == TRUE )
		{
			require_once('../mails/forgot-password.php');
			
			//echo $email = $rec->user_email;
			$email = $rec->user_email;
			$uname = $rec->user_name;
			$fullname = $rec->user_fullname;
			$subject = 'Your ABC4JAVA Login Credentials';
				
			mailClient($email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname); 
			header('Location: ../../index.php?Err=4');
			exit;
		}
		else
		{
			header('Location: ../../index.php?Err=M');
		}
	}
	header($link.'1');
}