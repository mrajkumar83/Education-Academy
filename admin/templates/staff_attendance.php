<div class="content-warp">
    <div class="table">
        <form method="post" name="attForn" id="attForn" action="../admin/logic/staff_attendance_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Attendance</th>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Batch:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <select name="batchbranch" id="batchbranch" required="required" tabindex="1" onchange="javascript:get_course(this.value)">
                                <option value="">-- Select --</option>
                                <?php
                                while ($batch_rec = mysql_fetch_object($batch)) {
                                    $val = $batch_rec->batch_id . "::" . $batch_rec->branch_id;
                                    $opt = $batch_rec->batch_name . "[" . $batch_rec->branch_name . "]";
                                    echo '<option value="', $val, '"', (($val == $batchbranch) ? ' selected="selected"' : ''), '>', $opt, '</option>';
                                }
                                ?>
                            </select>

                        </td>

                    </tr>
                    <tr >
                        <td class="first"><strong>Course:</strong><span class="complsory">*</span></td>
                        <td class="last" id="std_course_td">&nbsp;</td>

                    </tr>

                    <tr class="bg">
                        <td class="first"><strong>Attendance Date:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text"  class="text" name="att_date" id="att_date" value="<?php echo ((isset($att_date) && $att_date != '' && $att_date != '0000-00-00') ? date("m/d/Y", strtotime($att_date)) : ''); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Document:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="file" name="att_document" id="att_document" value="" />
                        </td>
                    </tr>



                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <input type="hidden" value="" id="std_course_id" name="std_course">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_batch.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>