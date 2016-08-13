<?php
error_reporting(E_ALL);
ini_set('display_errors',0);
date_default_timezone_set('UTC');

define('DATABASE_HOST', 'localhost');  
define('DATABASE_NAME', 'abc4java');   
define('DATABASE_USER',  'root');  
define('DATABASE_PASSWORD', 'abc4java');
  
define('APPLICATION_TITLE', 'School Management');
define('MAX_ENTRIES_PER_PAGE', 10); 
define('TECH','technologies');
define('ADMINMAIL', 'info@abcforjava.org');
define('ADMINNAME', 'abc4java');

//date_default_timezone_set('Asia/Mumbai');
$time_now=mktime(date('H')+5,date('i')+30,date('s'));
$date_time = date('d-m-Y H:i:s', $time_now);
define('DATE_TIME_FORMAT', date('Y-m-d H:i:s', $time_now));

$PANNO =  'AMUPM0758R';
$TANNO =  'AMUPM0758R';
$TINNO =  'AMUPM0758R';

extract($_REQUEST);
function convert_date($date)
{
	if(!isset($date) || trim($date) == '')
		return '';
	$temp = explode("/",$date);
		$da = $temp[2]."-".$temp[0]. "-".$temp[1];
	return $da;
}
function date_reverse($date)
{
	$temp = explode("-",$date);
		$da = $temp[1]."/".$temp[2]. "/".$temp[0];
	return $da;
}