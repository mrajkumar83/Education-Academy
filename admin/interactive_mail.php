<?php
$step = '2';
$path = '.';
$title = 'Bulk Mail';
$css = array('styles.css');
$js = array('interactive_mail.js');

require_once('includes/common.php');

?> 
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
	<?php
	if(isset($sts) && $sts == 'S')
	{
		echo '<div class="errDiv"><strong>Mails Send Successfully.</strong></div>';
	}
	require_once('./templates/interactive_mail.php');
	?>
</div>
</body>
</html>