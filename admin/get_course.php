<?php
require_once('common/configure.php');
  
mysql_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD);
mysql_select_db(DATABASE_NAME);

extract($_GET); extract($_POST);

if(isset($batchbranch) && strpos($batchbranch,"::")!==false)
{
	list($batch_id,$branch_id) = explode("::",$batchbranch);	
}


$sql = "select course_name,course_id from tb_batch b 
join tb_courses c on b.batch_course = c.course_id where batch_id=".$batch_id."";
$result = mysql_query($sql);
$i=0;
if(mysql_num_rows($result))
{
	$row = mysql_fetch_array($result);
	echo $row['course_name'],'::',$row['course_id'];
}

?>