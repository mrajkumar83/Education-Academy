<?php
ini_set('max_execution_time', 300);
require_once('../common/sess.php');
require_once('../common/configure.php');
//require_once('../classes/Database.class.php');
//require_once('../classes/Query.class.php');
require_once("../common/attachsendmail.php");
require_once("../common/sms.php");
require_once("../common/xlreader.php");
require_once('../common/fileupload.php');
require_once('../mails/interactive-mail1.php');


//$db = new Query();
$to = $email = '';
$subject = 'ABCforJAVA: Placement Alert';

$file = fileupload('TXT','../ext-std','stdlist','N');
$arr = read_file($file, 3, 'ext-std/');
$arr_cnt = count($arr);

@set_time_limit(0);//Infinite time

for($i=0; $i<$arr_cnt; ++$i)
{
	if($arr[$i][0] != '' && $arr[$i][1] != '' && filter_var($arr[$i][1], FILTER_VALIDATE_EMAIL) && $arr[$i][2] != '' && strlen($arr[$i][2])==10){
		$msg = str_replace('<STD_NAME>', $arr[$i][0],$body);
		$msg = str_replace('<URL_Y>', 'http://abc4java.com/iemail.php?op=Y&amp;sname='.urlencode($arr[$i][0]).'&amp;smail='.urlencode($arr[$i][1]).'&amp;sphno='.urlencode($arr[$i][2]), $msg);
		$msg = str_replace('<URL_N>', 'http://abc4java.com/iemail.php?op=N&amp;sname='.urlencode($arr[$i][0]).'&amp;smail='.urlencode($arr[$i][1]).'&amp;sphno='.urlencode($arr[$i][2]), $msg);
		sendSMS(10, $arr[$i][2], $arr[$i][0]);
		mailClient($arr[$i][1], $msg, $subject, ADMINNAME, ADMINMAIL, $arr[$i][0]);
	}
}//End of for(;;)

header('Location: ../interactive_mail.php?sts=S');
exit;