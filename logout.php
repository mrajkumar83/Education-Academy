<?php
@session_start();
require_once('./admin/common/configure.php');
require_once('./admin/classes/Database.class.php');
require_once('./admin/classes/Query.class.php');

$db = new Query();
$db->storeDetails('tb_users', ' user_sess="0" ',' WHERE user_sess="'.session_id().'" ');
session_destroy();
$alert = isset($alert) ? $alert : 'N';
if(isset($step))
{
	switch($step)
	{
		case '1':
			$step = '.parent';
		break;
		
		case '2':
			$step = '.parent.parent';
		break;
		
		default:
			$step = '';
		break;
	}
}else
{
	header("Location: index.php");
}
?>
<html>
<body>
<script language="javascript">
	<?php if($alert == 'Y'){ ?>
	alert('Your session is expired.  Login in once.');
	<?php } ?>
	window<?php echo $step;?>.document.location.href = "index.php";
</script>
</body>
</html>