<?php
error_reporting(E_ALL ^ E_NOTICE);
extract($_REQUEST);
require_once("functions.php");

date_default_timezone_set('UTC');

if(isset($submit) && $submit=="Get Content")
{
	if(isset($myfile) && $myfile!='')
	{
		$file_ext = get_file_extension($myfile);
		switch($file_ext)
		{
			case 'xls' : require_once('classes/excel_reader2.php');
						 $data = new Spreadsheet_Excel_Reader("documents/".$myfile);
						 
			break;
			case 'xlsx':require_once('classes/XLSXReader.php');
						$xlsx = new XLSXReader("documents/".$myfile);
						$sheetNames = $xlsx->getSheetNames();
			break;
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Read Excel</title>
<style>
body {
	font-family: Helvetica, sans-serif;
	font-size: 12px;
}

table, td {
	border: 1px solid #000;
	border-collapse: collapse;
	padding: 2px 4px;
}
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>
<body>
<form name="myform" action="" method="post"> 
<table>
<tr><td>
<label>Choose you file to Read</label></td>
<td>
<select name="myfile">
<option value=="">Select File</option> 
<?php
if ($handle = opendir('documents')) {
    while (false !== ($file = readdir($handle)))
    {
        if (($file != ".") 
         && ($file != ".."))
        {?>
           <option value="<?php echo $file;?>" <?php echo ((isset($myfile) && $myfile==$file)?'selected="selected"':'');?>><?php echo $file;?></option><?php
        }
    }

    closedir($handle);
}
?>
</select></td></tr>
<tr><td colspan="2">
<input type="submit" name="submit" value="Get Content" />
</td></tr></table>

<?php 
if(isset($file_ext) && $file_ext=="xlsx")
{?>
    <h2>Sheet Names</h2>
    
    <p>List of the sheets in this workbook (indexed by sheetId):</p>
    
    <?php echo debug($sheetNames);?>
    <hr>
    
    
    <h2>All Sheets</h2>
    
    <p>Loop through all sheets, printing the sheet name and all of the sheet data in a table</p>
    
    <?php
    foreach($sheetNames as $sheetName) {
        $sheet = $xlsx->getSheet($sheetName);
        ?>
        <h3><?php echo escape($sheetName);?></h3>
        <?php 
        array2Table($sheet->getData());
    }
}
elseif(isset($file_ext) && $file_ext=="xls")
{
	echo $data->dump(true,true);
}
?>
</body>
</html>
