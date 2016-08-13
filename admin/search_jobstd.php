<?php
$step = '2';
$path = '.';
$title = 'Search Student';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('managerem.js', 'list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
?>

<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <div class="content-warp">
<?php
if (isset($search) && $search == 'Search') {
    ?>
            <form method="post" name="hr_records" id="hr_records" action="send_mail.php">
                <div style="width:700px;padding:3px;">
                	<input type="hidden" name="job_id" value="<?php echo $id; ?>" />
                   <input type="submit" value="Send Mail" name="send" />
                   &nbsp;&nbsp;
                   <input type="submit" value="Resend Mail" name="resend" />
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
                    <thead>
                    <th><input type="checkbox" onClick="checkAll(this)" id="parentChk" title="Check All"/></th> 
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Phone No</th>
					<th>Type</th>
                    </thead>
                    <tbody>

    <?php
    $row = 0;
    $job_det = $db->fetchRecord(' tb_bd_job ', ' bd_percutoff,bd_bond,bd_bondyear,bd_yearofpass,bd_relocate,bd_status ', ' bd_status = "A" AND bd_job_id = "' . $id . '"');
    $con = ' (std_branch = "' . $user->user_branch . '" OR (std_branch="0" AND std_type="I"))';
    
    if (isset($job_det->bd_percutoff) && $job_det->bd_percutoff == 'C') {
        $con .=' AND std_ssc_percentage >= 60 AND (std_ipe_percentage >= 60 OR std_diploma_percentage >= 60) AND std_graduation_percentage >= 60';
    }
    if (isset($job_det->bd_percutoff) && $job_det->bd_percutoff == 'G') {
        $con .=' AND std_graduation_percentage >= 60';
    }
    
    if (isset($job_det->bd_relocate) && $job_det->bd_relocate == 'Y') {
        $con .=' AND std_relocate = "' . $job_det->bd_relocate . '"';
    }
    
    if (isset($job_det->bd_bond) && $job_det->bd_bond == 'Y') {
        if (isset($job_det->bd_bondyear) && $job_det->bd_bondyear != '' ) {
            $con .=' AND bond_duration >= "' . $job_det->bd_bondyear . '" AND  std_contract = "Y"';
        }
    }
    
    if (isset($job_det->bd_yearofpass) && $job_det->bd_yearofpass != '') {
			$yearpass = explode(',', $job_det->bd_yearofpass);
			$yearpass_cnt = count($yearpass);
			for($k=0; $k<$yearpass_cnt; $k++){
				$tmp_cond[] = ' std_graduation_year="'.$yearpass[$k].'" ';
			}
		$con .=' AND ('.implode('OR', $tmp_cond).')';
		
	}

    $student = $db->fetchAllRecord(' tb_student_details ', ' std_id,std_email,std_fname,std_lname,std_phno,bond_duration,std_branch ', $con, NULL, null, NULL, 0, 'All');
    while ($data = mysql_fetch_object($student)) {
        $class = ($row % 2) ? 'even' : 'odd';
        echo '<tr class="', $class, '">', "\n\t";
        echo '<td><input type="checkbox" name="std_id[]" value="'.$data->std_id.'"  id="std_id[]" class="chkBox">', '</td>', "\n";
        echo '<td>', $data->std_fname, '</td>', "\n";
        echo '<td>', $data->std_lname, '</td>', "\n";
        echo '<td>', $data->std_email, '</td>', "\n";
        echo '<td>', $data->std_phno, '</td>', "\n";
		echo '<td>', (($data->std_branch == 0) ? 'Guest' : 'Student'), '</td>', "\n";
        echo '</tr>', "\n";
        $row++;
    }
    ?>
                    </tbody>
                </table>
               
            </form>
        <?php
        }
        ?>
    </div>
</div>
</body>
</html>