<?php
  /*mysql_connect("localhost","root","");
  mysql_select_db("school");*/
  
  require_once('common/configure.php');
  
	mysql_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD);
	mysql_select_db(DATABASE_NAME);

extract($_GET); extract($_POST);

session_start();
$q = strtolower($_GET["q"]);
if (!$q) return;


$sql = "select e.*,b.batch_name,batch_amount from tb_enquiry e 
		join tb_batch b on e.enquiry_batch = b.batch_id";
$result = mysql_query($sql);
#echo $sql;
$records ='';
if(mysql_num_rows($result))
{
	while($items= mysql_fetch_object($result))
	{
		$sql1  = "select course_name from tb_courses where course_id = ".$items->enquiry_course."";
		$res1 = mysql_query($sql1);
		$row1 = mysql_fetch_object($res1);
		
		if (strpos($items->enquiry_id, $q) !== false) 
		{
			$records.= $items->enquiry_id." :: ".$items->enquiry_fname." ".$items->enquiry_lname. "|" . $items->enquiry_fname." ".$items->enquiry_lname."|" .$items->batch_name."|".$items->batch_amount."|".$row1->course_name."|".$items->enquiry_id."\n";
		}
	}
	if($records!='')
	{
		echo $records;
	}
	else
	{
		echo "Not Matched";
	}
}
else
{
	echo "No Records";
}
?>