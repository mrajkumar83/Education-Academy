<?php
$path = '.';
extract($_POST);
require_once("dompdf/dompdf_config.inc.php");
require_once($path.'/common/attachsendmail.php');
require_once($path.'/mails/interactive-mail4.php');

$msg = str_replace('<STD_NAME>', trim($STD_NAME), $body1);

$dompdf = new DOMPDF();
$dompdf->load_html($msg);
$dompdf->render();
$dompdf->set_paper('A4');
$output = $dompdf->output();
$file_to_save = './temp/Call Letter.pdf';

file_put_contents($file_to_save, $output);

unset($output);
unset($dompdf);
$subject = 'ABCforJAVA: Placement Invitation Letter for '.$company_name;
$attach = array(0=>array('path' => $file_to_save, 'name' => 'Call Letter.pdf'));
mailClient($to, $msg, $subject, 'abc4java', 'info@abc4java.com', trim($STD_NAME), $attach);
@unlink($file_to_save);