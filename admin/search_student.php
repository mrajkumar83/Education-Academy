<?php
$path = '.';
require_once('includes/common.php');
$db = new Query();

extract($_GET); extract($_POST);

session_start();
$q = strtolower($_GET["q"]);
if (!$q) return;


$sql = "select * from tb_branches";
$result = mysql_query($sql);
#echo $sql;
/*while($items= mysql_fetch_object($result))
{
	if (strpos($items->enquiry_fname, $q) !== false) 
	{
		echo $items->enquiry_fname."\n";
	}
}
	*/

?>