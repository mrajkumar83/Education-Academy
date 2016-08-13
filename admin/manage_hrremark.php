<?php
$step = '2';
$path = '.';
$title = 'Search Remarks';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('managerem.js', 'list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'managerem_dates.js');
require_once('includes/common.php');

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' batch_branch = "'.$user->user_branch.'" ';
$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id  ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);

$date = isset($date) ? $date : '';
$batchbranch = isset($batchbranch) ? $batchbranch : '';
$mockrating = isset($mockrating) ? $mockrating : '';
$sname = isset($sname) ? $sname : '';

function convert_rating($rating){
    if($rating >= 9){
        return 'Excellent';
    }
    elseif ($rating >= 7 && $rating < 9) {
        return 'Good';
    }
    elseif ($rating >= 5 && $rating < 7) {
        return 'Satisfactory';
    }
    else{
        return 'Un-Satisfactory';
    }
}//Endo of Func

function cond_rating($rating){
    switch($rating){
        case '9':
           return ' mock_rating>="9" ';
        break;
    
        case '7':
           return ' mock_rating>="7" AND mock_rating<"9" ';
        break;
    
        case '5':
           return ' mock_rating>="5" AND mock_rating<"7" ';
        break;
    
        default:
           return ' mock_rating<"5" ';
        break;
    }
    
}
?>
<style>
    .ui-datepicker{display: none;}

</style>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <div class="content-warp">
        <div class="table">

            <form method="post" name="enquiryform" id="enquiryform" action="" onsubmit="return chk_remarks(this.form)">
                <table cellspacing="0" cellpadding="0" class="listing form">
                    <tbody>

                        <tr>
                            <th colspan="4" class="full">Remarks Details</th>
                        </tr>

                        <tr>
                            <td class="first"><strong>Interview Date</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="text" value="<?php echo $date; ?>" id="date" name="date" class="text"></td>
                            <td class="first"><strong>Batch:</strong><span class="complsory">*</span></td>
                            <td class="last"><select name="batchbranch" id="batchbranch" onchange="javascript:get_course(this.value)">
                                    <option value="">-- Select --</option>
                                    <?php
                                    while ($batch_rec = mysql_fetch_object($batch)) {
                                        $val = $batch_rec->batch_id . "::" . $batch_rec->branch_id;
                                        $opt = $batch_rec->batch_name . "[" . $batch_rec->branch_name . "]";
                                        echo '<option value="', $val, '"', (($val == $batchbranch) ? ' selected="selected"' : ''), '>', $opt, '</option>';
                                    }
                                    ?>
                                </select></td>
                        </tr>

                        <tr class="bg">
                            <td class="first"><strong>Mock Rating</strong></td>
                            <td class="last">
                                <select value="<?php echo $mockrating; ?>" id="mockrating" name="mockrating" class="text">
                                    <option value="">--Select -- </option>
                                    <option value="9"<?php echo ($mockrating == 9)? ' selected="selected"': '';?>>Excellent</option>
                                    <option value="7"<?php echo ($mockrating == 7)? ' selected="selected"': '';?>>Good</option>
                                    <option value="5"<?php echo ($mockrating == 5)? ' selected="selected"': '';?>>Satisfactory</option>
                                    <option value="0"<?php echo ($mockrating == 0)? ' selected="selected"': '';?>>Un-Satisfactory</option>
                                </select>
                            </td>
                            <td class="first"><strong>Student Name</strong></td>
                            <td class="last"><input type="text" value="<?php echo $sname; ?>" id="sname" name="sname" class="text"></td>
                        </tr>

                    </tbody>
                </table>
                <p class="buttons">
                    <input type="hidden" value="<?php echo $op; ?>" name="op">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">

                    <input type="submit" value="Submit" name="Add">
                </p>
            </form>
        </div>
<?php
if (isset($Add) && $Add == 'Submit') {
    ?>
            <form method="post" name="" id="" action="export_students.php">
                <div style="width:700px;padding:3px;">
                    <input type="submit" value="Export" name="export" />
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
                    <thead>
                    <th><input type="checkbox" onClick="checkAll(this)" id="parentChk" title="Check All"/></th> 
                    <th>Student Username</th>
                    <th>Student Name</th>
                    <th>Mock Rating</th>
                    <th>Interview Date</th>
                    <th>Action</th>
                    </thead>
                    <tbody>

    <?php
    $row = 0;
    $mockrating = (isset($mockrating) && $mockrating != '') ? (int) $mockrating : '';
    $stdname = (isset($sname) && $sname != '') ? $sname : '';

    $cond = (isset($mockrating) && $mockrating != '') ? cond_rating($mockrating) : '';
    $cond .= (isset($stdname) && $stdname != '') ? (($cond != '') ? ' AND ' : '' ) . ' student_name LIKE "' . $stdname . '%" ' : '';
    
    $fields = ' student_id,rating_id, hr_id,student_username,student_name,mock_rating,date ';

    if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
        list($att_batch_id, $att_branch) = explode("::", $batchbranch);

        if (isset($date) && $date != '') {
            $hrremarks = $db->fetchAllRecord(' tb_hr_remarks ', $fields, '  date = "' . convert_date($date) . '"  and (batch_id="' . $att_batch_id . '" and branch_id="' . $att_branch . '" ) ' . (($cond == '') ? '' : ' AND ' . $cond), NULL, null, NULL, 0, 'All');
        } else {
            $hrremarks = $db->fetchAllRecord(' tb_hr_remarks ', $fields, '  batch_id="' . $att_batch_id . '" and branch_id="' . $att_branch . '" ' . (($cond == '') ? '' : ' AND ' . $cond), NULL, null, NULL, 0, 'All');
        }
    } else {
        if (isset($date) && $date != '') {
            $hrremarks = $db->fetchAllRecord(' tb_hr_remarks ', $fields, '   date = "' . convert_date($date) . '" ' . (($cond == '') ? '' : ' AND ' . $cond), NULL, null, NULL, 0, 'All');
        } else {
            $hrremarks = $db->fetchAllRecord(' tb_hr_remarks ', $fields, $cond, NULL, null, NULL, 0, 'All');
        }
    }


    while ($data = mysql_fetch_object($hrremarks)) {

        $class = ($row % 2) ? 'even' : 'odd';
        echo '<tr class="', $class, '">', "\n\t";
        echo '<td><input type="checkbox" name="student_id[]" value="' . $data->student_id . '"  id="student_id[]" class="chkBox">', '</td>', "\n";
        echo '<td>', $data->student_username, '</td>', "\n";
        echo '<td class="center">', $data->student_name, '</td>';
        echo '<td class="center">', convert_rating($data->mock_rating), '</td>';
        echo '<td class="center">', date("m/d/Y", strtotime($data->date)), '</td>';
        echo '<td class="center"><a href="view_remarks.php?id=', $data->rating_id, '" title="View Remarks" alt="View Remarks"><div class="img edit"></div></a>&nbsp;';
        echo '</td></tr>', "\n";
        $row++;
    }
    ?>

                    </tbody>
                </table>
                <input type="hidden" name="batch_id" value="<?php echo ((isset($att_batch_id) && $att_batch_id != '') ? $att_batch_id : ''); ?>" /> 
                <input type="hidden" name="branch_id" value="<?php echo ((isset($att_branch) && $att_branch != '') ? $att_branch : ''); ?>" /> 
                <input type="hidden" name="date" value="<?php echo ((isset($date) && $date != '') ? $date : ''); ?>" /> 
				 <input type="hidden" name="mockrating" value="<?php echo ((isset($mockrating) && $mockrating != '') ? $mockrating : ''); ?>" /> 
				 <input id="sname" type="hidden" name="sname" value="<?php echo ((isset($sname) && $sname != '') ? $sname : ''); ?>">

            </form>
                        <?php
                    }
                    ?>
    </div>
</div>
</body>
</html>