<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>ABC for JAVA & TESTING</title>
            <link rel="shortcut icon" href="admin/img/favicon.ico" type="image/x-icon">
             <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="author" content="sark, sarktechnologies, sarktechnologies.net" />
            <link rel="stylesheet" type="text/css" href="./admin/css/logo.css">
             <script type="text/javascript" src="./admin/js/jquery.min.js"></script>
             <script type="text/javascript" src="./admin/js/jquery.validate.js"></script>
                <script type="text/javascript" src="./admin/js/forgotpass.js">
                </script><script language="javascript" type="text/javascript">
                    window.history.forward();
                </script> 
                </head>
                <body>
                    <div class="mainBox">
                        <div class="header">
                            <div class="logo"></div>

                        </div>
                        <div class="contentBox">
<?php echo $div_err; ?>
                            <div class="moduleBoxWrapper_left"></div>
                            <div class="moduleBoxWrapper_TOP">Welcome to ABC for JAVA & TESTING</div>
                            <div class="moduleBoxWrapper_right"></div>
                            <div class="clear"></div>
                            <div class="moduleBoxWrapper_BACK">
                                <div class="boxText"><strong>Please enter your email to send your new password.</strong>
                                </div>
                                <div class="clearBoth"></div>
                                <div class="boxText">
                                    <form method="post" name="loginfrm" id="loginfrm" action="admin/logic/forgot_logic.php" autocomplete="off">
                                        <ul class="loginFields">
                                            <li>E-mail<span class="complsory">*</span></li>
                                            <li>
                                                <input name="uemail" id="uemail" size="30" maxlength="100" autocomplete="off" type="text" required="required">
                                            </li>

                                            <li>
                                                <input type="submit" class="gradient submit" value="Send" id="frmsubmit" alt="Send" title="Send" name="submit">
                                            </li>
                                        </ul>
                                    </form>
                                    <div class="clearBoth"></div>
                                </div>
                            </div>
                        </div>
                        <div class="moduleBoxWrapper_BOTTOM"></div>
                    </div>
                </body>
                </html>