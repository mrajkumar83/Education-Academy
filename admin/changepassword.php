<?php
$path = '.';
$step = '2';
$title =  'Change Password';
$css = array('styles.css');
$js = array('changepassword.js');
require_once($path.'/includes/common.php');
$db = new Query();
echo '<div id="main">';
if(isset($changepassword))
{
	if(isset($id) && isset($uname) && $id !='' && $uname != '')
	{
		if($newpassword == $confrimpasword)
		{
			$rec = $db->fetchRecord('tb_users', ' user_type ','user_name="'.$uname.'" AND user_id="'.$id.'" AND user_status="A" ');
			$db->storeDetails('tb_users', ' user_password="'.md5($newpassword).'"', ' WHERE user_id="'.$id.'" AND user_name="'.$uname.'" ');
			if(isset($rec->user_type) && $rec->user_type == 'SD')
			{
			echo '<script>
					alert("Student password has been changed.");
					window.location.href= "manage_stddetails.php?utype=SD";
					</script>';
			exit;
			}
			if(isset($rec->user_type) && $rec->user_type == 'GS')
			{
			echo '<script>
					alert("Student password has been changed.");
					window.location.href= "manage_stddetails.php?utype=GS";
					</script>';
			exit;
			}
			if(isset($rec->user_type) && ($rec->user_type == 'SF' || $rec->user_type = 'AD'))
			{
			echo '<script>
					alert("Staff password has been changed.");
					window.location.href= "manage_staff.php";
					</script>';
			exit;
			}
			//header('location:./manage_stddetails.php?utype=SD');
			//exit;
		}
		//$rec = $db->fetchRecord('tb_users', ' user_password ','user_name="'.$uname.'" AND user_id="'.$id.'" AND user_status="A" ');
	}
	$rec = $db->fetchRecord('tb_users', ' user_password ','user_name="'.$UNAME.'" AND user_id="'.$UID.'" AND user_status="A" ');
	if( $rec->user_password == md5($oldpassword))
	{
		if($newpassword == $confrimpasword)
		{
			$db->storeDetails('tb_users', ' user_password="'.md5($newpassword).'" ', ' WHERE user_id="'.$UID.'"');
			echo '<script>
					alert("Your password has been changed.  Please login once again.");
					window.location.href= "../logout.php?step=2&alert=N";
					</script>';
			exit;
		}
		else
		{
			echo '<div class="message-div">Enter New Password  and Confirmation Password is not Matching.</div>';
		}
	}
	else
	{ 
		echo '<div class="message-div">Enter Old Password Correctly.</div>';
	}
}
require_once($path.'/templates/change_password.php');
?>