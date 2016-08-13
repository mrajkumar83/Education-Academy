<div class="content-warp">
    <div class="table">
        <form method="post" name="batchForn" id="batchForn" action="../admin/logic/batch_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Batch</th>
                    </tr>
                    <?php
                    if (isset($UTYPE) && $UTYPE == "SA") {
                     ?>
                    <tr>
                        <td class="first"><strong>Branch</strong><span class="complsory">*</span></td>
                        <td class="last" colspan="3">
                            <select name="batch_branch" id="batch_branch" required="required" tabindex="1">
                                <option value="">-- Select --</option>
                                <?php
                                while ($branch_rec = mysql_fetch_object($branch)) {
                                    echo '<option value="', $branch_rec->branch_id, '"', (($branch_rec->branch_id == $batch_branch) ? ' selected="selected"' : ''), '>', $branch_rec->branch_name, '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr class="bg">

                        <td class="first"><strong>Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="batch_name" id="batch_name" value="<?php echo $batch_name; ?>" style="width: 400px;">
                        </td>
                    </tr>
                    <tr>
                        <td class="first" valign="top"><strong>Description:</strong></td>
                        <td colspan="3" class="last">
                            <textarea name="batch_desc" id="batch_desc" style="height: 80px; width: 400px; resize: none;"><?php echo $batch_desc; ?></textarea>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Course:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <select name="batch_course" id="batch_course" required="required">
                                <option value="">-- Select --</option>
                                <?php
                                while ($course_rec = mysql_fetch_object($course)) {
                                    echo '<option value="', $course_rec->course_id, '"', (($course_rec->course_id == $batch_course) ? ' selected="selected"' : ''), '>', $course_rec->course_name, '</option>';
                                }
                                ?>
                            </select>

                        </td>
                        <td class="first"><strong>Amount:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="batch_amount" id="batch_amount" value="<?php echo $batch_amount; ?>">
                        </td>
                    </tr>
                    <tr>

                        <td class="first"><strong>Start Date:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text" class="text" name="batch_startdt" id="batch_startdt" value="<?php echo $batch_startdt; ?>">
                        </td>
                        <td class="first"><strong>End Date:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text" class="text" name="batch_enddt" id="batch_enddt" value="<?php echo $batch_enddt; ?>">
                        </td>
                    </tr>

                    <tr class="bg">
                        <td class="first"><strong>Select Time:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <select name="batch_hr" id="batch_hr" required="required">
                                <option value="">Hr</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo '<option value="', $i, '"' . (($batch_hr == $i) ? ' selected="selected"' : '') . '>', $i, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                            <select name="batch_min" id="batch_min" required="required">
                                <option value="">Min</option>
                                <?php
                                for ($i = 0; $i <= 59; $i++) {
                                    if ($i < 10) {
                                        $k = "0" . $i;
                                    } else {
                                        $k = $i;
                                    }
                                    echo '<option value="', $k, '"' . (($batch_min == $k) ? ' selected="selected"' : '') . '>', $k, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                            <select name="batch_ampm" id="batch_ampm" required="required">
                                <option value="">AM/PM</option>
                                <?php
                                echo '<option value="A"' . (($batch_ampm == 'A') ? ' selected="selected"' : '') . '>AM</option>';
                                echo '<option value="P"' . (($batch_ampm == 'P') ? ' selected="selected"' : '') . '>PM</option>';
                                ?>
                            </select>


                        </td>
                    </tr>

                    <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="batch_status" value="A"<?php echo ($batch_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="batch_status" value="D"<?php echo ($batch_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>


                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_batch.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>