<?php
error_reporting(E_ALL ^ E_NOTICE);
extract($_REQUEST);

date_default_timezone_set('UTC');

function store_data($myfile)
{
	if(isset($myfile) && $myfile!='')
	{
		$file_ext = get_file_extension($myfile);
		switch($file_ext)
		{
			case 'xls' : require_once('../classes/excel_reader2.php');
						 $data = new Spreadsheet_Excel_Reader("../college/".$myfile);
						 $data->storeCollege(true,true);
						 //echo "xls";
						 
			break;
			case 'xlsx':require_once('../classes/xlsxreader.php');
						$xlsx = new XLSXReader("../college/".$myfile);
						$sheetNames = $xlsx->getSheetNames();
						foreach($sheetNames as $sheetName) 
						{
							$sheet = $xlsx->getSheet($sheetName);
							array2Table($sheet->getData());
						}
						//echo "<br>xlsx";
			break;
		}
	}
}
function array2Table($data) 
{
	if(isset($data) && is_array($data) && count($data))
	{
		$i=0;
		foreach($data as $row) 
		{
			if($i>=1)
			{				
				$sql = "insert into tb_college(college_name)
						values('".escape($row[1])."')";
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

function storeRemarks($hr_intr_date,$hr_id,$att_batch_id,$att_branch,$row_numbers=false,$col_letters=false,$sheet=0,$table_class='excel') {
			
			for($row=2;$row<=$this->rowcount($sheet);$row++) 
			{
				$q_fields = array();
				for($col=1;$col<=$this->colcount($sheet);$col++) 
				{
					// Account for Rowspans/Colspans
					$rowspan = $this->rowspan($row,$col,$sheet);
					$colspan = $this->colspan($row,$col,$sheet);
					for($i=0;$i<$rowspan;$i++) 
					{
						for($j=0;$j<$colspan;$j++) 
						{
							if ($i>0 || $j>0) 
							{
								$this->sheets[$sheet]['cellsInfo'][$row+$i][$col+$j]['dontprint']=1;
							}
						}
					}
					if(!$this->sheets[$sheet]['cellsInfo'][$row][$col]['dontprint']) 
					{
						$style = $this->style($row,$col,$sheet);
						if ($this->colhidden($col,$sheet)) {
							$style .= "display:none;";
						}
						$out .= "\n\t\t<td style=\"$style\"" . ($colspan > 1?" colspan=$colspan":"") . ($rowspan > 1?" rowspan=$rowspan":"") . ">";
						$val = $this->val($row,$col,$sheet);
						if ($val=='') { $val="&nbsp;"; }
						else { 
							$val = htmlentities($val); 
							$link = $this->hyperlink($row,$col,$sheet);
							if ($link!='') {
								$val = "<a href=\"$link\">$val</a>";
							}
						}
						$out .= "<nobr>".nl2br($val)."</nobr>";
						$out .= "</td>";
						$q_fields [] = $val;
					}
				}
				$sql = "insert into tb_hr_remarks(hr_id,student_id,student_name,
								Remark,mock_rating,date,batch_id,branch_id)
						values(".$hr_id.",'".$q_fields[0]."','".$q_fields[1]."'
						,'".$q_fields[2]."','".$q_fields[3]."','".$hr_intr_date."','".$att_batch_id."','".$att_branch."')";
							//echo "<br><br>";
							
					mysql_query($sql);
			}
		}