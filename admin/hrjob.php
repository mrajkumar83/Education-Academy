<?php
$step = '2';
$path = '.';
$title = 'Job Details';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
//$js = array('datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'job_date.js');
require_once('includes/common.php');

$db = new Query();

if (isset($id) && $id != '') 
{
    $data = $db->fetchRecord(' tb_bd_job ', ' * ', ' bd_job_id ="' . $id . '"');
    while (list($var, $val) = each($data)) {
        $$var = $val;
    }
	if(isset($bd_interviewtime) && $bd_interviewtime)
	{
		if (strpos($bd_interviewtime, ":") !== false) {
        list($hr, $min, $ampm) = explode(":", $bd_interviewtime);
			if(isset($ampm) && $ampm != '')
			{
				if($ampm == "A")
				{
					$ampm = 'AM';
				}
				if($ampm == "P")
				{
					$ampm = 'PM';
				}
			}
			$time = $hr.":".$min." ".$ampm;
    	}
		
	}
	else 
		{
		$hr = '';
		$min = '';
		$ampm = '';
		$time = '';
		}
	
    $title = 'Job Details';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/hrjob.php');?>
</div>
</body>
</html>

