<?php
	$add_path = isset($path) ? $path : '.';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="sarktechnologies.net">
<?php
	$css_length = count($css);
	for($i =0 ; $i < $css_length; $i++)
	{
		echo '<link rel="stylesheet" type="text/css" href="'.$add_path.'/css/'.$css[$i].'">';
	}
?>
<script type="text/javascript" src="<?php echo $add_path;?>/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  -->
<script type="text/javascript" src="<?php echo $add_path;?>/js/jquery.validate.js"></script>
<?php
	$js_length = isset($js) ? count($js) : 0;		
	for($i =0 ; $i < $js_length; $i++)
	{
		echo '<script type="text/javascript" src="'.$add_path.'/js/'.$js[$i].'"></script>'."\n";
	}	
?>
<script language="javascript" type="text/javascript">
    window.history.forward();
</script> 
</head>
<body>