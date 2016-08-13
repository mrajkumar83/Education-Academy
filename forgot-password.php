<?php
session_start();
if (isset($_SESSION) && isset($_SESSION['UID'])) {
    header("Location: home.php");
    exit;
}
if (isset($_REQUEST['Err'])) {
    switch ($_REQUEST['Err']) {
        case 1:
            $div_err = '<div class="errorDiv">Enter valid Email-Id.</div>';
            break;

        case 2:
            $div_err = '<div class="errorDiv">You are not a registered user.</div>';
            break;

        case 3:
            $div_err = '<div class="errorDiv">Please contact Administrator, you are De-activated.</div>';
            break;
    }
} else {
    $div_err = '';
}
require_once('./admin/templates/forgot-password.php');
?>