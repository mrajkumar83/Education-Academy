<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');	
require_once('../common/fileupload.php');
require_once("../common/attachsendmail.php");

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';


switch($op)
{
	case 'A':
		require_once("../common/xlreader.php");
	
		$college_file = (isset($_FILES['college_file']) && isset($_FILES['college_file']['name']) && ($_FILES['college_file']['name'] != '')) ? fileupload('TXT','../college','college_file','N', '', $id) : '';

		$arr = read_file($college_file, 2, 'college/');
		$arr_cnt = count($arr);
		
		for($i=0; $i<$arr_cnt; ++$i)
		{
			$db->storeDetails('tb_college', ' college_name="'.$arr[$i][1].'", 	college_status="A" ');
		}//End for(;;)

	break;
	case 'E':
			
			$db->updateDB('tb_college',$id,'college_id');
			
	break;

	case 'D':
			$db->delData('tb_college', ' college_id="'.$id.'"');			
	break;
	
}
header('Location: ../manage_colleges.php?sts='.$sts);
exit;