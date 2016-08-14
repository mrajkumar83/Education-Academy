<?php
session_start();
if (isset($_SESSION) && isset($_SESSION['UID'])) {
    header("Location: home.php");
    exit;
}

$div_err = '';
if (isset($_REQUEST['Err'])) {
    switch ($_REQUEST['Err']) {
        default:
            $div_err = '<div class="errorDiv">Invalid Username or Password.</div>';
            break;
        case 2:
            $div_err = '<div class="errorDiv">Please contact Administrator, you are De-activated.</div>';
            break;

        case 4:
            $div_err = '<div class="errorDiv">Your new password is sent to your E-mail.</div>';
            break;

        case 5:
            $div_err = '<div class="errorDiv">You have logged some where.</div>';
            break;
		case 6:
            $div_err = '<div class="errorDiv">You have registered successfully.</div>';
            break;
		case 7:
            $div_err = '<div class="errorDiv">Your OTP number have Expired.</div>';
            break;
    }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login to ABC for JAVA & TESTING</title>
        <link rel="shortcut icon" href="admin/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="./admin/css/logo.css">
        <script type="text/javascript" src="./admin/js/jquery.min.js"></script>
        <script type="text/javascript" src="./admin/js/jquery.validate.js"></script>
        <script type="text/javascript" src="./admin/js/login.js"></script>
        <script language="javascript" type="text/javascript">
               window.history.forward();
        </script>
    </head>
                <body >
                    <div class="mainBox" style="width:330px;margin-left:-10px;">
                          <div class="header" >
                            <div ><img src="admin/img/logo.jpg" style="margin-left:0px;"/></div>

                        </div>
                        <div class="contentBox" style="margin-top:10px;width:300px;">
                            <?php echo $div_err; ?>
                           
                           
                               
                             
                                <div class="boxText" >
                                    <form method="post" name="loginfrm" id="loginfrm" action="admin/logic/login_logic.php" autocomplete="off">
                                        <ul class="loginFields" style="border:2px solid #fff;width:356px;">
                                            <li>Username<span class="complsory">*</span></li>
                                            <li>
                                                <input name="uname" id="uname" size="30" maxlength="100" autocomplete="off" type="text" required="required">
                                            </li>
                                            <li>Password<span class="complsory">*</span></li>
                                            <li>
                                                <input name="upassword" id="upassword" size="30" maxlength="100" autocomplete="off" type="password" required="required">
                                            </li>
                                            <li>
                                                <input type="submit" class="gradient submit" value="Login" id="frmsubmit" alt="Submit" title="Submit">
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                 
                        
                    </div>
                </body>
                </html>