<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');
require_once('../common/fileupload.php');
require_once("../common/generate_password.php");
require_once("../common/attachsendmail.php");
require_once("../common/sms.php");

if (isset($UTYPE)) {
    require_once('../common/checksess.php');
}
else
    $db = new Query();
$id = (isset($id)) ? $id : 0;
$url = 'Location: ../staff.php?';
$role_permission = isset($role_permission) ? $role_permission : '';

if ($op == 'ADD') {
    $duplicatedata = $db->fetchRecord(' tb_users ', ' count(1) AS cnt ', '  user_email = "' . $staff_email . '" ');
    if ($duplicatedata->cnt > 0) {
        header($url . 'utype=' . $utype . '&Err=D');
        exit;
    }
}
if (isset($_FILES['staff_photo'])) {
    if (($_FILES['staff_photo']["size"] / 1024) > 1024) {
        header($url . 'utype=' . $utype . '&Err=S');
        exit;
    }
}

if ($op != 'D') {
    $branch_rec = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id="' . $_SESSION['UID'] . '" ');
}

switch ($op) {
    case 'ADD':

        switch ($role_permission) {
            case 'A':
                $prefix = 'ADM';
                $utype = 'AD';
                break;
            default :
                $prefix = 'STF';
                $utype = 'SF';
                break;
        }
        $user_name = $db->generatenextid('tb_users', ' user_name ', $prefix, '000', ' user_name like "' . $prefix . '%" ');
        $user_password = 'abc';//generate_password(6);

        $date = date('YYYY-MM-DD HH:MM:SS');
        $Name = $staff_fname . ' ' . $staff_lname;
        $image = (isset($_FILES['staff_photo']) && isset($_FILES['staff_photo']['name']) && ($_FILES['staff_photo']['name'] != '')) ? fileupload('IMG', '../photos', 'staff_photo', 'N', '', $id) : '';

        $fields = ' user_id=NULL, user_name = "' . $user_name . '", user_password = "' . md5($user_password) . '", user_type = "' . $utype . '", user_fullname="' . htmlspecialchars(trim($Name)) . '"
		, user_email = "' . $staff_email . '", role_permission = "' . $role_permission . '", user_sess="' . $_SESSION['UID'] . '", user_createdby = "' . $_SESSION['UID'] . '",   user_branch = "' . (isset($user_branch) ? $user_branch : $branch_rec->user_branch) . '", user_createddate="' . date(DATE_TIME_FORMAT) . '", user_modifeddate=""';

        $store = $db->storeDetails('tb_users', $fields);

        if ($store == true) {
            $id = $db->newRowId;
            $image = (isset($_FILES['staff_photo']) && isset($_FILES['staff_photo']['name']) && ($_FILES['staff_photo']['name'] != '')) ? fileupload('IMG', '../photos', 'staff_photo', 'N', '', $id) : '';

            $fields = ' staff_id = "' . $id . '", staff_fname = "' . $staff_fname . '", staff_lname = "' . $staff_lname . '" ';
			$fields .= (isset($staff_phno) && $staff_phno != '') ? ', staff_phno = "' . $staff_phno . '" ' : '';
            $fields .= ', staff_mobile = "' . $staff_mobile . '", staff_email = "' . $staff_email . '", staff_semail = "' . $staff_semail . '", staff_photo = "' . $image . '"';
            $fields .= ', staff_address = "' . $staff_address . '", staff_createddate = "' . date(DATE_TIME_FORMAT) . '", staff_modifeddate="0000-00-00 00:00:00"';
            $fields .= ', staff_createdby = "' . $_SESSION['UID'] . '" ';

            $store1 = $db->storeDetails(' tb_staff_details ', $fields);
            if ($store1 == TRUE) {
                $data = $db->fetchRecord(' tb_users ', ' user_branch,role_permission ', ' user_id="' . $id . '"');
                $branch = $db->fetchRecord(' tb_branches ', ' branch_name ', ' branch_id="' . $data->user_branch . '"');
                if (isset($data->role_permission) && $data->role_permission != '') {
                    if ($data->role_permission == 'A') {
                        $role_name = 'ADMIN';
                    }
                    if ($data->role_permission == 'C') {
                        $role_name = 'Counselor';
                    }
                    if ($data->role_permission == 'F') {
                        $role_name = 'Finance';
                    }
                    if ($data->role_permission == 'O') {
                        $role_name = 'Operational';
                    }
                    if ($data->role_permission == 'H') {
                        $role_name = 'HR';
                    }
					if ($data->role_permission == 'B') {
                        $role_name = 'Business Development';
                    }
					if ($data->role_permission == 'L') {
                        $role_name = 'Librarian';
                    }
					if ($data->role_permission == 'T') {
                        $role_name = 'Transport Manager';
                    }
					if ($data->role_permission == 'Q') {
                        $role_name = 'Quaters Incharge';
                    }
                }
				/*
                $body = '<div  style="float:left;width:960px;height: 500px; background: #fff; padding-left:15px;"> 
        		
       			<h1><strong>Account Activated </strong></h1>  
       			<br>
       			<p>Hi ' . $staff_fname . ',</p>
       			<p>Your  account is now active. Please use the below login details.</p>
      			<br /><br />
		      	<strong>Your Acount Details:<hr /></strong><br>
	   	   		<table>
					<tr>
		      			<td>First Name : </td><td>' . $staff_fname . '</td>
		      		</tr>
					<tr>
		      			<td>Last Name : </td><td>' . $staff_lname . '</td>
		      		</tr>
		      		<tr>
		      			<td>Branch : </td><td>' . $branch->branch_name . '</td>
		      		</tr>
					<tr>
		      			<td>Role : </td><td>' . $role_name . '</td>
		      		</tr>
		     	</table>
						
       			<br>
   				<strong>Your Login Details:<hr /></strong><br>
				<table>
					<tr>
		      			<td>Username : </td><td>' . $user_name . '</td>
		      		</tr>
					<tr>
		      			<td>Password : </td><td>' . $user_password . '</td>
		      		</tr>
				</table>
         		<br><br>
       			
				</div>';
				$subject = 'Your Account Is Now Active';
				$fullname = htmlspecialchars(trim($staff_fname . ' ' . $staff_lname));
				
				if($staff_mobile != '' && strlen($staff_mobile)==10){
					sendSMS(13, $staff_mobile);
					sendSMS(0, $staff_mobile, $user_name, $user_password);
				}
				if($staff_email != ''){
					mailClient($staff_email,$body, $subject, ADMINNAME, ADMINMAIL, $fullname);
				}
*/
                $location = 'Location: ../manage_staff.php?'.((isset($UTYPE) && $UTYPE == 'SA') ? '' : 'utype='.$utype);
                header($location);
                exit;
            } else {
                echo "email not send.";
            }
        } else {
            header($url . 'op=A&Err=NA');
        }
        exit;

        break;
    case 'Edit':
        $fields = ' user_fullname="' . htmlspecialchars(trim($staff_fname . ' ' . $staff_lname)) . '",';
        $fields.= 'user_email = "' . $staff_email . '", user_modifeddate = "' . date(DATE_TIME_FORMAT) . '",';
        $fields.= 'user_status="' . $user_status . '", role_permission = "' . $role_permission . '" ';
        if (isset($utype) && $utype == "SF") {
            $fields.= ', user_role = "' . $user_role . '" ';
        }
        $fields.= ',user_branch = "' . (isset($user_branch) ? $user_branch : $branch_rec->user_branch) . '" ';

        $db->storeDetails('tb_users', $fields, 'WHERE user_id = "' . $id . '"');
        
        $image = (isset($_FILES['staff_photo']) && isset($_FILES['staff_photo']['name']) && ($_FILES['staff_photo']['name'] != '')) ? fileupload('IMG', '../photos', 'staff_photo', 'N', '', $id) : '';

        $fields = ' staff_fname = "' . $staff_fname . '", staff_lname = "' . $staff_lname . '", staff_phno = "' . $staff_phno . '" ';
        $fields .= ', staff_mobile = "'.$staff_mobile.'", staff_email = "'.$staff_email.'", staff_semail="'.$staff_semail.'"';
        $fields .=  (isset($image) && $image!='') ? ', staff_photo = "' . $image . '"' : '';
        $fields .= ', staff_address = "' . $staff_address . '", staff_modifeddate="' . date(DATE_TIME_FORMAT) . '"';
        $fields .= ', staff_modifedby  = "' . $_SESSION['UID'] . '"';

        $output = $db->storeDetails('tb_staff_details', $fields, ' WHERE staff_id = "' . $id . '"');
		
        if (isset($pagefrom) && ($pagefrom == 'profile')) {
            echo '<html><body><script>
                    alert("Please login once, to reflect your changes..\n Thank you.");
                    window.parent.parent.document.location.href = "../../logout.php";</script></body></html>';
            exit;
        } else {
            $location = 'Location: ../manage_staff.php?sts=E' . ($output ? 'S' : 'F' ) . ((isset($UTYPE) && $UTYPE == 'SA') ? '' : '&utype='.$utype);
        }
        header($location);
        break;

    case 'D':
        $db->delData('tb_users', ' user_id="' . $id . '"');
        $db->delData('tb_staff_details', ' staff_id="' . $id . '"');
        $location = 'Location: ../manage_staff.php?sts=E' . ($output ? 'S' : 'F' ) . ((isset($UTYPE) && $UTYPE == 'SA') ? '' : '&utype='.$utype);
        header($location);
        break;

    case 'E':
        $user_type ? $user_type : 'SF';
        $db->storeDetails('tb_users', ' user_type = "'.$user_type.'", user_dom = "' . date(DATE_TIME_FORMAT) . '" ', ' WHERE user_id = "' . $id . '"');
		echo '<html><body><script>alert("Your Profile is Successfully Updated.");window.location.href="../manage_admin.php";</script></body></html>';
        break;
}

exit;