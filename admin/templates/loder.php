<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
	p{
		text-align: center; 
		margin: 200px auto 0;
		font-weight: bold;
		color: #0000FF;
	}
	div{margin: 20px auto; width: 300px; height: 20px; text-align: center; background: #FFF url("./img/loder.gif") no-repeat;</style>
</head>
<body>
<p>
	Please Wait...............
</p>
<div></div>
<?php
ob_flush();
@flush();
ob_clean();
?>