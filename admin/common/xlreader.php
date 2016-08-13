<?php
function read_file($myfile, $cols=1, $path = '',$test_id=null)
{
	$arr = array();
	if(isset($myfile) && $myfile!='')
	{
		$file_ext = get_file_extension($myfile);
		switch($file_ext)
		{
			case 'xls' : require_once('../classes/excel_reader2.php');
						 $data = new Spreadsheet_Excel_Reader('../'.$path.$myfile);
						 $arr = $data->xl_arr($cols);
			break;
			case 'xlsx':require_once('../classes/xlsxreader.php');
						$xlsx = new XLSXReader('../'.$path.$myfile);
						$sheetNames = $xlsx->getSheetNames();
						foreach($sheetNames as $sheetName) 
						{
							$sheet = $xlsx->getSheet($sheetName);
							$data = $sheet->getData();			
							if(isset($data) && is_array($data) && count($data))
							{
								foreach($data as $row) 
								{
									$arr[] = $row;
								}
							}
						}
						//echo "<br>xlsx";
			break;
		}
	}
	//print_R($arr);exit;
	return $arr;
}
function array2Table($data) 
{
	$data_arr = array();
	if(isset($data) && is_array($data) && count($data))
	{
		foreach($data as $row) 
		{
			$data_arr[] = $row;
		}
	}
	return $data_arr;
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