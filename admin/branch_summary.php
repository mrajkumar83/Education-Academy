<?php
$step = '2';
$path = '.';
$title = 'Branch Wise Summary';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('batch.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'batch_dates.js');
require_once('includes/common.php');

$db = new Query();

$branch = $db->fetchAllRecord('tb_branches ', ' branch_id,branch_name ', ' branch_status="A" ', NULL, 'branch_name', NULL, NULL, 'All');
?>
<div id="main">
    <div class="top-bar"><h1>Branch Wise Financial Summary, ABC for Java & Testing </h1></div>
	<div class="content-warp">
    <div class="table">
			<?php
			while($branch_rec = mysql_fetch_object($branch))
			{	
				echo '<div>
						<a href="branch_wise_summ.php?id='.$branch_rec->branch_id.'" class="sbuttons">
							'.$branch_rec->branch_name.'
						</a>
					</div>';
			}
			?>

</div>
</body>
</html>       