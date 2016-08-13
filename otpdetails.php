<?php
session_start();
$title = 'Add Guest';
$time= date("H:i:s") ;
$rand = rand(1000, 9999);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login to ABC for JAVA & TESTING</title>
        <link rel="shortcut icon" href="admin/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="./admin/css/logo.css">
        <script type="text/javascript" src="./admin/js/jquery.min.js"></script>
        <script type="text/javascript" src="./admin/js/jquery.validate.js"></script>
        <script type="text/javascript" src="./admin/js/otp.js"></script>
        <script language="javascript" type="text/javascript">
               window.history.forward();
        </script>
    </head>
                <body>
                    <div class="mainBox">
                        <div class="header">
                            <div class="logo1"></div>

                        </div>
                        <div class="contentBox">
                            <?php echo (isset($div_err) ? $div_err : ''); ?>
                            <div class="moduleBoxWrapper_left"></div>
                            <div class="moduleBoxWrapper_TOP">Welcome to ABC for JAVA & TESTING</div>
                            <div class="moduleBoxWrapper_right"></div>
                            <div class="clear"></div>
                            <div class="moduleBoxWrapper_BACK">
                                <div class="boxText"><strong>Please enter below details to get OTP and procced for registration.</strong>
                                </div>
                                <div class="clearBoth"></div>
                                <div class="boxText">
                                    <form method="post" name="optFRM" id="optFRM" action="otpno.php" autocomplete="off">
                                        <ul class="loginFields">
                                            <li>First Name<span class="complsory">*</span></li>
                                            <li>
                                                <input name="fname" id="fname" size="30" maxlength="100" autocomplete="off" type="text" >
                                            </li>
                                            <li>Last Name<span class="complsory">*</span></li>
                                            <li>
                                                <input name="lname" id="lname" size="30" maxlength="100" autocomplete="off" type="text" >
                                            </li>
                                             <li>Phone No<span class="complsory">*</span></li>
                                            <li>
                                                <input name="phno" id="phno" size="30" maxlength="100" autocomplete="off" type="text">
                                            </li>
                                            <li>Email Id<span class="complsory">*</span></li>
                                            <li>
                                                <input name="std_email" id="std_email" size="30" maxlength="100" autocomplete="off" type="text" >
                                            </li>
                                            <li>
                                            
                                                <input type="submit" class="gradient submit" name="sub" value="SUBMIT" id="frmsubmit" alt="Submit" title="Submit">
                                            </li>
                                        </ul>
                                        <input type="hidden" name="time" value="<?php echo $time; ?>" />
                                        <input type="hidden" name="rand" value="<?php echo $rand; ?>" />
                                    </form>
                                    <div class="clearBoth"></div>
                                    <ul>
                                        <li><a href="forgot-password.php">Forgot Password</a></li>
                                        <!-- <li><a href="otpdetails.php">Guest Registration</a></li>  -->
                                        <li> Contact the Team ABC Support Team</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="moduleBoxWrapper_BOTTOM"></div>
                    </div>
                </body>
    </html>