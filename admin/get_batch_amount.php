<?php

require_once('common/configure.php');

mysql_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD);
mysql_select_db(DATABASE_NAME);

extract($_GET);
extract($_POST);
if (isset($batch_id) && strpos($batch_id, "::") !== false) {
    list($batch, $branch) = explode("::", $batch_id);
}
$sql = "select batch_amount,course_name,c.course_id from tb_batch b 
join tb_courses c on b.batch_course = c.course_id where batch_id=" . $batch . "";
$result = mysql_query($sql);
$i = 0;
if (mysql_num_rows($result)) {
    $row = mysql_fetch_array($result);
    echo $row['batch_amount'] . "::" . $row['course_name']. "::" . $row['course_id'];
}
?>