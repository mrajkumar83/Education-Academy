<?php
$db = new Query();
$u = $db->fetchRecord('tb_users', ' user_sess ', ' user_id="'.$UID.'" '); 
if($u->user_sess != session_id())
{
	session_destroy();
?>
<html>
<body>
<script language="javascript">
	window.parent.parent.document.location.href = "../index.php?Err=5";
</script>
</body>
</html>
<?php
	exit;
	}
?>