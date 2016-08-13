<?php
$step = '2';
$path = '.';
$title = 'Bulk Mail';
$css = array('styles.css', 'tinyeditor.css');
$js = array('bulk_mail.js', 'tiny.editor.packed.js');

require_once('includes/common.php');

$td_name = 'File';

if(!isset($ty) ||$ty !== 'E')
{
	$db = new Query();
	$batchbranch = '';
	$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
	$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "' . $user->user_branch . '" ';
	$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);
	$td_name = 'Batch';
}
?> 
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
	<?php
	if(isset($sts) && $sts == 'S')
	{
		echo '<div class="errDiv"><strong>Mails Send Successfully.</strong></div>';
	}
	require_once('./templates/bulk_msg.php');
	?>
</div>
</body>
</html>