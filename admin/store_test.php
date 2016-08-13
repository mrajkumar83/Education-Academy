<?php
error_reporting(E_ALL ^ E_NOTICE);
extract($_REQUEST);

date_default_timezone_set('UTC');

function store_data($myfile,$test_id)
{
	if(isset($myfile) && $myfile!='')
	{
		$file_ext = get_file_extension($myfile);
		switch($file_ext)
		{
			case 'xls' : require_once('../classes/excel_reader2.php');
						 $data = new Spreadsheet_Excel_Reader("../papers/".$myfile);
						 $data->storeTest($test_id,true,true);
						 //echo "xls";
						 
			break;
			case 'xlsx':require_once('../classes/xlsxreader.php');
						$xlsx = new XLSXReader("../papers/".$myfile);
						$sheetNames = $xlsx->getSheetNames();
						foreach($sheetNames as $sheetName) 
						{
							$sheet = $xlsx->getSheet($sheetName);
							array2Table($sheet->getData(),$test_id);
						}
						//echo "<br>xlsx";
			break;
		}
	}
}
function array2Table($data,$test_id) 
{
	if(isset($data) && is_array($data) && count($data))
	{
		$i=0;
		foreach($data as $row) 
		{
			if($i>=1)
			{
				/*$_POST['test_id'] = $test_id; 
				$_POST['test_question'] = escape($row[1]);
				$_POST['test_option1'] = escape($row[2]);
				$_POST['test_option2'] = escape($row[3]);
				$_POST['test_option3'] = escape($row[4]);				
				$_POST['test_option4'] = escape($row[5]);				
				$_POST['test_answer'] = escape($row[6]);				
				$_POST['test_marks'] = escape($row[7]);			
				$db->addToDB('tb_test_details');*/
				
				$sql = "insert into tb_test_details(test_id,test_question,test_option1,
							test_option2,test_option3,test_option4,test_answer,test_marks)
						values(".$test_id.",'".escape($row[1])."','".escape($row[2])."'
						,'".escape($row[3])."','".escape($row[4])."','".escape($row[5])."'
						,'".escape($row[6])."','".escape($row[7])."')";
						//echo "<br><br>";
				mysql_query($sql);
			}
			$i++;
		}
	}
}

function debug($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function escape($string) {
	return htmlspecialchars($string, ENT_QUOTES);
}

function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
}
?>