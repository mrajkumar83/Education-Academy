<?php
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
$db = new Query();
if(isset($uname) && isset($upassword))
{
	$rec = $db->fetchRecord('tb_users', ' * ','LOWER(user_name)="'.strtolower($uname).'" AND user_password="'.md5($upassword).'" AND user_status="A" ');
	if($db->_rowCount > 0)
	{
	//user_sess
		if($rec->user_status == 'D')
		{
			header('Location: ../index.php?Err=2');
			exit;
		}		
		session_start();
		$_SESSION['UID'] = $rec->user_id;
		$_SESSION['UNAME'] = $rec->user_name;
		$_SESSION['UTYPE'] = $rec->user_type;
		$_SESSION['UEMAIL'] = $rec->user_email;
		$_SESSION['UFULLNAME'] = $rec->user_fullname;
		$_SESSION['UROLE_PERMISSION'] = $rec->role_permission;
		$_SESSION['UBRANCH'] = $rec->user_branch;
		// if($rec->user_type=="SF")
		// {
			// $rec1 = $db->fetchRecord('tb_roles', ' * ',' role_status="A" and role_id="'.$rec->user_role.'" ');
			// $_SESSION['UROLE'] = $rec1->role_name;
			// $_SESSION['UROLE_PERMISSION'] = $rec1->role_permission;
		// }
		
		$_SESSION['USESS'] = session_id();//$rec->user_sess;
		$output = $db->storeDetails('tb_users', ' user_sess="'.$_SESSION['USESS'].'" ',' WHERE user_id = "'.$_SESSION['UID'].'"');
		header('Location: ../../home.php');
		exit;
	}
	else
	{
		header('Location: ../../index.php?Err=3');
		exit;
	}
}
header('Location: ../../index.php?Err=1');
exit;