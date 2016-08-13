<?php
$step = '2';
$path = '.';
$batchbranch = '';
$title = 'Manage Attendance';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'att_dates.js');
require_once('includes/common.php');

$db = new Query();
$std_course = '';
if(isset($std_course_id) && $std_course_id > 0){
    $course = $db->fetchRecord('tb_courses ', ' course_id,course_name ', ' course_id="'.$std_course_id.'" ', NULL, 'course_name', NULL, NULL, 'All');
    $std_course = $course->course_name;
}

$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
if (isset($UTYPE) && $UTYPE == 'SA') {
    $cond = NULL;
} else {
    $cond = ' batch_branch = "'.$user->user_branch.'" ';
}

$batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id  ', ' batch_id ,batch_name,br.branch_id,branch_name ', $cond);
?>
<style>
    .ui-datepicker{display: none;}

</style>
<div id="main">
    <div class="top-bar">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="content-warp">
        <div class="table">
            <form method="post" name="atttForm" id="atttForm" action="">
                <table cellspacing="0" cellpadding="0" class="listing form">
                    <tbody>
                        <tr>
                            <th colspan="4" class="full">Attendance</th>
                        </tr>
                        <tr class="bg">
                            <td class="first"><strong>Batch:</strong><span class="complsory">*</span></td>
                            <td class="last"><select name="batchbranch" id="batchbranch" required="required" tabindex="1" onchange="javascript:get_course(this.value)">
                                    <option value="">-- Select --</option>
                                <?php
                                while ($batch_rec = mysql_fetch_object($batch)) {
                                    $val = $batch_rec->batch_id . "::" . $batch_rec->branch_id;
                                    $opt = $batch_rec->batch_name . "[" . $batch_rec->branch_name . "]";
                                    echo '<option value="', $val, '"', (($val == $batchbranch) ? ' selected="selected"' : ''), '>', $opt, '</option>';
                                }
                                ?>
                                </select></td>
                            <td class="first"><strong>Course:</strong><span class="complsory">*</span></td>
                            <td class="last" id="std_course_td"><?php echo ((isset($std_course) && $std_course != '') ? $std_course : ''); ?></td>
                        </tr>
                        <tr class="bg">
                            <td class="first"><strong>Attendance&nbsp;From&nbsp;Date:</strong></td>
                            <td class="last"><input type="text"  class="text" name="att_from_date" id="att_from_date" value="<?php echo ((isset($att_from_date) && $att_from_date != '' && $att_from_date != '0000-00-00') ? date("m/d/Y", strtotime($att_from_date)) : ''); ?>"></td>
                            <td class="first"><strong>Attendance&nbsp;To&nbsp;Date:</strong></td>
                            <td class="last"><input type="text"  class="text" name="att_to_date" id="att_to_date" value="<?php echo ((isset($att_to_date) && $att_to_date != '' && $att_to_date != '0000-00-00') ? date("m/d/Y", strtotime($att_to_date)) : ''); ?>"></td>
                        </tr>
                        <tr class="bg">
                            <td class="first"><strong>Student Username&nbsp;:</strong></td>
                            <td class="last" colspan="3"><input type="text"  class="text" name="student_id" id="student_id" value="<?php echo ((isset($student_id) && $student_id != '') ? $student_id : ''); ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <p class="buttons">
                    <input type="hidden" value="<?php echo $op; ?>" name="op">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    <input type="hidden" id="std_course_id" name="std_course_id" value="<?php echo ((isset($std_course_id) && $std_course_id != '') ? $std_course_id : ''); ?>">
                    &nbsp; &nbsp;
                    <input type="submit" value="Submit" name="Add">
                </p>
            </form>
        </div>
<?php
if (isset($Add) && $Add == 'Submit') {
    if (isset($batchbranch) && strpos($batchbranch, "::") !== false) {
        list($att_batch_id, $att_branch) = explode("::", $batchbranch);
    }

    $cond = "  att_batch_id=" . $att_batch_id . " and att_branch_id=" . $att_branch . " ";
    if (isset($att_from_date) && $att_from_date != '' && isset($att_to_date) && $att_to_date != '') {
        $cond.= " and date between '" . date("Y-m-d", strtotime($att_from_date)) . "' and '" . date("Y-m-d", strtotime($att_to_date)) . "'  ";
    }
    $cond_stud = '';
    if (isset($student_id) && $student_id != '') {
        $cond_stud = " and user_name LIKE '" . $student_id . "%' ";
    }


    $dates = $db->fetchAllRecord('tb_att_details ', ' DISTINCT date ', $cond, NULL, 'date', NULL, NULL, 'All');
    $date_arr = array();
    $date_cnt = 0;
    $students = $db->fetchAllRecord('tb_student_details s JOIN tb_users as u on s.std_id = u.user_id', ' std_id,std_fname,std_lname,user_name ', 'std_batch=' . $att_batch_id . ' and std_branch=' . $att_branch . ' ' . $cond_stud, NULL, 'user_name', NULL, NULL, 'All');
    $cnt_dates = $db->getRowCount();
    $row_cnt = 3 + $cnt_dates;
    if (isset($dates)) {
        ?>
                <div id="sts"></div>
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
                    <thead>
                    <th>Username</th>
                    <th>Name</th>
                <?php
                if ($cnt_dates > 0) {
                    while ($data = mysql_fetch_object($dates)) {
                        echo '<th>', date("m/d", strtotime($data->date)), '</th>';
                        $date_arr[] = $data->date;
                    }
                    $date_cnt = count($date_arr);
                }
                ?>
                    <th>Percentage</th>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    if ($cnt_dates > 0) {
                        
                        while ($data1 = mysql_fetch_object($students)) {                            
                            $present_days = 0;
                            echo '<tr>';
                            echo '<td align="center">', $data1->user_name, '</td>',
                            '<td>&nbsp;', $data1->std_fname, ' ', $data1->std_lname, '&nbsp;</td>';
                            $cond1 = $cond . " and student_username = '" . $data1->user_name . "' ";
                            for($j=0; $j < $date_cnt; $j++){
                                
                                $attendance = $db->fetchAllRecord('tb_att_details ', ' distinct(date), attendance  ', $cond1.' AND date="'.$date_arr[$j].'" ', NULL, 'date', NULL, NULL, 'All');
                                //$total_classes_conducted = $db->getRowCount();
                                if($db->getRowCount() > 0)
                                {
                                    while ($data2 = mysql_fetch_object($attendance)) {
                                        echo '<td align="center">', $data2->attendance, '</td>';
                                        if ($data2->attendance == "P") {
                                            $present_days += 1;
                                        }
                                    }
                                }
                                else
                                {
                                    echo '<td align="center">A</td>';
                                }                                
                            }
                            $att_percent = (string)($date_cnt == 0) ? '0' : (($present_days / $date_cnt ) * 100);
                            $class = 'style="color:' . (($att_percent < 90) ? '#F00' : '#0F0') . '"';
                            echo '<td align="center" ', $class, '>', $att_percent, '</td>';
                            echo '</tr>';
                        }
                        
                    }
                    ?>
                    </tbody>
                </table>
                        <?php
                    }
                }
                ?>
    </div>
</div>
</body>
</html>