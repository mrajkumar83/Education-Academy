<?php
$step = '2';
$path = '.';
$title = 'Search Student';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('managerem.js', 'list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'managerem_dates.js');
require_once('includes/common.php');

$db = new Query();
$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$std_ssc_percentage = isset($std_ssc_percentage) ? $std_ssc_percentage : '';
$std_ipe_percentage = isset($std_ipe_percentage) ? $std_ipe_percentage : '';
$std_graduation_percentage = isset($std_graduation_percentage) ? $std_graduation_percentage : '';
$std_hometown = isset($std_hometown) ? $std_hometown : '';
$std_relocate = isset($std_relocate) ? $std_relocate : 'Y';

$std_postgraduate_pecentage = isset($std_postgraduate_pecentage) ? $std_postgraduate_pecentage : '';
$std_contract = isset($std_contract) ? $std_contract : 'Y';
$std_project_name = isset($std_project_name) ? $std_project_name : '';

if (isset($UTYPE) && $UTYPE == 'SA') {
    $batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id  ', ' batch_id ,batch_name,br.branch_id,branch_name ', NULL);
} else {
    $batch = $db->fetchAllRecord(' tb_batch AS b LEFT JOIN tb_branches AS br on b.batch_branch = br.branch_id  ', ' batch_id ,batch_name,br.branch_id,branch_name ', 'batch_branch = "' . $user->user_branch . '"');
}
$skill_rec = $db->fetchAllRecord(' tb_skills ', ' skill_id,skill_name ', ' skill_status="A" ', NULL, NULL, NULL, NULL, 'All');
$skill_cnt = $db->getRowCount();
$skills = isset($skills) ? $skills : array();
?>
<style>
    .ui-datepicker{display: none;}

</style>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <div class="content-warp">
        <div class="table">

            <form method="post" name="stdSearch" id="stdSearch" action="" onsubmit="return chk_remarks(this.form)">
                <table cellspacing="0" cellpadding="0" class="listing form">
                    <tbody>

                        <tr>
                            <th colspan="4" class="full">Student Details</th>
                        </tr>

                        <tr>
                            <td class="first"><strong>10th Standard %</strong><span class="complsory">*</span>&nbsp;&nbsp;<div style="float:right; font-weight: bold;>"><=</div></td>
                            <td class="last"><input type="text" value="<?php echo $std_ssc_percentage; ?>" id="std_ssc_percentage" name="std_ssc_percentage" class="text"></td>
                            <td class="first"><strong>12th Standard %</strong>&nbsp;&nbsp;<span class="complsory">*</span><div style="float:right; font-weight: bold;>"><=</div></td>
                            <td class="last">
                                <input type="text" value="<?php echo $std_ipe_percentage; ?>" id="std_ipe_percentage" name="std_ipe_percentage" class="text">
                            </td>
                        </tr>

                        <tr class="bg">
                            <td class="first"><strong>Graduation %</strong>&nbsp;&nbsp;<div style="float:right; font-weight: bold;>"><=</div></td>
                            <td class="last"><input type="text" value="<?php echo $std_graduation_percentage; ?>" id="std_graduation_percentage" name="std_graduation_percentage" class="text"></td>
                            <td class="first"><strong>Post Graduate %</strong>&nbsp;&nbsp;<div style="float:right; font-weight: bold;>"><=</div></td>
                            <td class="last"><input type="text" value="<?php echo $std_postgraduate_pecentage; ?>" id="std_postgraduate_pecentage" name="std_postgraduate_pecentage" class="text"></td>
                        </tr>
                        <tr>
                            <td class="first"><strong>Home Town</strong></td>
                            <td class="last"><input type="text" value="<?php echo $std_hometown; ?>" id="std_hometown" name="std_hometown" class="text"></td>
                            <td class="first"><strong>Ready To Relocate</strong></td>
                            <td class="last"><input type="radio" class="textarea" id="std_relocate"  name="std_relocate" value="Y" <?php echo ($std_relocate == 'Y' ? ' checked' : ''); ?>>
                                &nbsp;Yes&nbsp;&nbsp;
                                <input type="radio" class="textarea" id="std_relocate" name="std_relocate" value="N" <?php echo ($std_relocate == 'N' ? ' checked' : ''); ?>>
                                &nbsp;No&nbsp; </td>
                        </tr>
                        <tr class="bg">
                            <td class="first"><strong>Ready to Sign Bond</strong></td>
                            <td class="last"><input type="radio" class="textarea" id="std_contract" name="std_contract" onclick="change_bond(this.value)" value="Y" <?php echo (($std_contract == 'Y') ? ' checked' : ''); ?>>
                                &nbsp;Yes&nbsp;&nbsp;
                                <input type="radio" class="textarea" name="std_contract" onclick="change_bond(this.value)" value="N" <?php echo (($std_contract == 'N') ? ' checked' : ''); ?>>
                                &nbsp;No&nbsp; 
                            </td>
                            <td class="first" colspan="2">
                                <div id="bondTR" style="display:<?php echo ((isset($std_contract) && $std_contract == 'Y') ? '' : 'none'); ?>;">
                                <select name="bond_duration" id="bond_duration">
                                    <option value="">Select</option>
                                    <option value="1" <?php echo ((isset($bond_duration) && $bond_duration == 1) ? 'selected="selected"' : ''); ?>>1 Year</option>
                                    <option value="2" <?php echo ((isset($bond_duration) && $bond_duration == 2) ? 'selected="selected"' : ''); ?>>2 Year</option>
                                    <option value="3" <?php echo ((isset($bond_duration) && $bond_duration == 3) ? 'selected="selected"' : ''); ?>>3 Year</option>
                                </select></div>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td class="first"><strong>Skills</strong></td>
                            <td class="last" colspan="3">
                                 <?php
                                    if($skill_cnt > 0){
                                       $j = 0;
                                     while ($skill = mysql_fetch_object($skill_rec)) {
                                        echo '<div><input type="checkbox" value="',$skill->skill_id,'" id="skill_',$skill->skill_id,'" name="skills[]" ',((isset($skills) && is_array($skills) && in_array($skill->skill_id, $skills))?'checked="checked"':'') ,' >';
                                        echo '&nbsp;&nbsp;&nbsp;<label for="skill_',$skill->skill_id,'">',$skill->skill_name,'</label></div>';
                                     }
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr class="bg">
                            <td class="first"><strong>Academic Project Name</strong></td>
                            <td class="last" colspan="3"><input type="text" value="<?php echo $std_project_name; ?>" id="std_project_name" name="std_project_name" class="text"></td>
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
            <form method="post" name="hr_records" id="hr_records" action="export_student_det.php">
                <div style="width:700px;padding:3px;">
                    <input type="submit" value="Export" name="export" />
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
                    <thead>
                    <th><input type="checkbox" onClick="checkAll(this)" id="parentChk" title="Check All"/></th> 
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Phone No</th>

                    </thead>
                    <tbody>

    <?php
    $row = 0;

    $con = ' std_branch = "' . $user->user_branch . '" ';
    if (isset($std_ssc_percentage) && $std_ssc_percentage != '') {
        $con .=' AND std_ssc_percentage <= "' . $std_ssc_percentage . '"';
    }
    if (isset($std_ipe_percentage) && $std_ipe_percentage != '') {
        $con .=' AND std_ipe_percentage <= "' . $std_ipe_percentage . '"';
    }
    if (isset($std_graduation_percentage) && $std_graduation_percentage != '') {
        $con .=' AND std_graduation_percentage <= "' . $std_graduation_percentage . '"';
    }
    if (isset($std_postgraduate_pecentage) && $std_postgraduate_pecentage != '') {
        $con .=' AND std_postgraduate_pecentage <= "' . $std_postgraduate_pecentage . '"';
    }
    if (isset($std_hometown) && $std_hometown != '') {
        $con .=' AND std_hometown = "' . strtolower($std_hometown) . '"';
    }
    if (isset($std_relocate) && $std_relocate != '') {
        $con .=' AND std_relocate = "' . $std_relocate . '"';
    }
    if (isset($std_contract) && $std_contract != '') {
        $con .=' AND std_contract = "' . $std_contract . '"';
    }
    if (isset($std_contract) && $std_contract == 'Y') {
        if (isset($bond_duration) && $bond_duration != '') {
            $con .=' AND bond_duration = "' . $bond_duration . '"';
        }
    }
    if (isset($std_project_name) && $std_project_name != '') {
        $con .=' AND std_project_name = "' . strtolower($std_project_name) . '"';
    }
    if (isset($skills) && is_array($skills) && count($skills)) {
        $skills_list = implode(",", $skills);
        $con .= " AND std_skill_set IN (".$skills_list.") ";
    }
    
    $student = $db->fetchAllRecord(' tb_student_details ', ' std_id,std_email,std_fname,std_lname,std_phno ', $con, NULL, null, NULL, 0, 'All');
    while ($data = mysql_fetch_object($student)) {
        $class = ($row % 2) ? 'even' : 'odd';
        echo '<tr class="', $class, '">', "\n\t";
        echo '<td><input type="checkbox" name="std_id[]" value="'.$data->std_id.'"  id="std_id[]" class="chkBox">', '</td>', "\n";
        echo '<td>', $data->std_fname, '</td>', "\n";
        echo '<td>', $data->std_lname, '</td>', "\n";
        echo '<td>', $data->std_email, '</td>', "\n";
        echo '<td>', $data->std_phno, '</td>', "\n";
        echo '</td></tr>', "\n";
        $row++;
    }
    ?>
                    </tbody>
                </table>
                <input type="hidden" name="branch_id" value="<?php echo $user->user_branch; ?>" /> 
                <input type="hidden" name="std_ipe_percentage" value="<?php echo ((isset($std_ipe_percentage) && $std_ipe_percentage != '') ? $std_ipe_percentage : ''); ?>" /> 
                <input type="hidden" name="std_ssc_percentage" value="<?php echo ((isset($std_ssc_percentage) && $std_ssc_percentage != '') ? $std_ssc_percentage : ''); ?>" />
                <input type="hidden" name="std_graduation_percentage" value="<?php echo ((isset($std_graduation_percentage) && $std_graduation_percentage != '') ? $std_graduation_percentage : ''); ?>" />
                <input type="hidden" name="std_postgraduate_pecentage" value="<?php echo ((isset($std_postgraduate_pecentage) && $std_postgraduate_pecentage != '') ? $std_postgraduate_pecentage : ''); ?>" />
                <input type="hidden" name="std_hometown" value="<?php echo ((isset($std_hometown) && $std_hometown != '') ? $std_hometown : ''); ?>" />
                <input type="hidden" name="std_relocate" value="<?php echo ((isset($std_relocate) && $std_relocate != '') ? $std_relocate : ''); ?>" />
                <input type="hidden" name="std_contract" value="<?php echo ((isset($std_contract) && $std_contract != '') ? $std_contract : ''); ?>" />
                <input type="hidden" name="bond_duration" value="<?php echo ((isset($bond_duration) && $bond_duration != '') ? $bond_duration : ''); ?>" />
                <input type="hidden" name="std_project_name" value="<?php echo ((isset($std_project_name) && $std_project_name != '') ? $std_project_name : ''); ?>" />

            </form>
        <?php
        }
        ?>
    </div>
</div>
</body>
</html>