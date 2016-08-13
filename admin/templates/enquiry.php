<div class="content-warp">
    <div class="table">
        <form method="post" name="enquiryform" id="enquiryform" action="../admin/logic/enquiry_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Enquiry Details</th>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $enquiry_fname; ?>" id="enquiry_fname" name="enquiry_fname" class="text"></td>
                        <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $enquiry_lname; ?>" id="enquiry_lname" name="enquiry_lname" class="text"></td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Phone No</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $enquiry_phno; ?>" id="enquiry_phno" name="enquiry_phno" class="text required" title=" Required"></td>
                        <td class="first"><strong>Email</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $enquiry_email; ?>" id="enquiry_email" name="enquiry_email" class="text"></td>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Batch</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <select name="batchbranch" id="batchbranch" required="required" onchange="javascript:get_amount(this.value)">
                                <option value="">-- Select --</option>
                                <?php
                                while ($batch_rec = mysql_fetch_object($batch)) {
                                    $val = $batch_rec->batch_id . "::" . $batch_rec->branch_id;
                                    $opt = $batch_rec->batch_name . "[" . $batch_rec->branch_name . "]";
                                    echo '<option value="', $val, '"', (($val == $batchbranch) ? ' selected="selected"' : ''), '>', $opt, '</option>';
                                }
                                ?>
                            </select></td>
                        <td class="first"><strong>Course</strong></td>
                        <td class="last" id="td_course_id"><?php echo $course_name; ?></td></td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Enquiry</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last"><textarea name='enquiry_comments' id='enquiry_comments' style="height: 50px; width: 300px"><?php echo $enquiry_comments; ?></textarea></td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Enquiry Date:</strong></td>
                        <td class="last" colspan="3">
                            <input type="text"  class="text" name="enquiry_crtdate" id="enquiry_crtdate" value="<?php echo $enquiry_crtdate; ?>"></td>
                    </tr>
                    <tr >
                        <td class="first"><strong>Enquiry Type</strong></td>
                        <td colspan="3" class="last">
                            <?php
                            if (isset($op) && $op == "A") {
                                ?>
                                <input type="radio" class="textarea" name="enquiry_type" onclick="change_etype(this.value)" value="Direct"<?php echo ((isset($enquiry_type) && $enquiry_type == 'Direct' ) ? ' checked' : ''); ?>>
                                &nbsp;Direct&nbsp;&nbsp;
                                <input type="radio" class="textarea" name="enquiry_type" onclick="change_etype(this.value)"  value="Call"<?php echo ((isset($enquiry_type) && ($enquiry_type == 'Call' || $enquiry_type == '')) ? ' checked' : ''); ?>>
                                &nbsp;Call&nbsp; <?php
                        } else {
                            echo $enquiry_type;
                        }
                            ?>

                        </td>
                    </tr>
                    <?php
                    if (isset($enquiry_call1_comments) && $enquiry_call1_comments != '') {
                        ?>

                        <tr class="bg" id="callTR1">
                            <td class="first"><strong>Call1 Status</strong></td>
                            <td colspan="3" class="last">
                                <?php echo $call1_sts_value; ?>
                            </td>
                        </tr>
                        <tr id="callTR2">
                            <td class="first"><strong>Call1 Comments</strong></td>
                            <td colspan="3" class="last">

                                <?php echo $enquiry_call1_comments; ?>
                            </td>
                        </tr>
                        <tr class="bg" id="callTR3">
                            <td class="first"><strong>Call 1 Date</strong></td>
                            <td colspan="3" class="last"><?php echo ((isset($enquiry_call1_date) && ($enquiry_call1_date != '' && $enquiry_call1_date != '0000-00-00')) ? date("m/d/Y", strtotime($enquiry_call1_date)) : ''); ?></td>
                        </tr>

                        <?php
                    } else {
                        ?>

                        <tr class="bg" id="callTR1" >
                            <td class="first"><strong>Call1 Status</strong></td>
                            <td colspan="3" class="last">
                                <select name="enquiry_call1_status" id="enquiry_call1_status" required="required" tabindex="1">
                                    <option value="">-- Select --</option>
                                    <?php
                                    while ($call_sts_rec = mysql_fetch_object($call_sts)) {
                                        echo '<option value="', $call_sts_rec->call_sts_id, '"', (($call_sts_rec->call_sts_id == $enquiry_call1_status) ? ' selected="selected"' : ''), '>', $call_sts_rec->call_sts_type, '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr id="callTR2">
                            <td class="first"><strong>Call1 Comments</strong></td>
                            <td colspan="3" class="last">

                                <textarea name='enquiry_call1_comments' id='enquiry_call1_comments' style="height: 50px; width: 300px"><?php echo $enquiry_call1_comments; ?></textarea>

                            </td>
                        </tr>
                        <tr class="bg" id="callTR3">
                            <td class="first"><strong>Call 1 Date</strong></td>
                            <td colspan="3" class="last"><input type="text" value="<?php echo ((isset($enquiry_call1_date) && ($enquiry_call1_date != '' && $enquiry_call1_date != '0000-00-00')) ? date("m/d/Y", strtotime($enquiry_call1_date)) : ''); ?>" name="enquiry_call1_date" id="enquiry_call1_date" ></td>
                        </tr>

                        <?php
                        }
                        if (isset($op) && $op == "E") {
                            if (isset($enquiry_call2_comments) && $enquiry_call2_comments != '') {
                         ?>
                            <tr class="bg" >
                                <td class="first"><strong>Call2 Status</strong></td>
                                <td colspan="3" class="last"><?php echo $call2_sts_value; ?></td>
                            </tr>
                            <tr>
                                <td class="first"><strong>Call 2 Comments</strong></td>
                                <td colspan="3" class="last"><?php echo $enquiry_call2_comments; ?></td>
                            </tr>
                            <tr class="bg">
                                <td class="first"><strong>Call 2 Date</strong></td>
                                <td colspan="3" class="last"><?php echo ((isset($enquiry_call2_date) && ($enquiry_call2_date != '' && $enquiry_call2_date != '0000-00-00')) ? date("m/d/Y", strtotime($enquiry_call2_date)) : ''); ?>
                                </td>

                            </tr><?php
                                    } elseif (isset($enquiry_call1_comments) && $enquiry_call1_comments != '') {
                                ?>
                            <tr class="bg" >
                                <td class="first"><strong>Call2 Status</strong></td>
                                <td colspan="3" class="last"><select name="enquiry_call2_status" id="enquiry_call2_status" required="required" tabindex="1">
                                        <option value="">-- Select --</option>
                            <?php
                            while ($call_sts_rec = mysql_fetch_object($call_sts)) {
                                echo '<option value="', $call_sts_rec->call_sts_id, '"', (($call_sts_rec->call_sts_id == $enquiry_call2_status) ? ' selected="selected"' : ''), '>', $call_sts_rec->call_sts_type, '</option>';
                            }
                            ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="first"><strong>Call 2 Comments</strong></td>
                                <td colspan="3" class="last"><textarea name='enquiry_call2_comments' id='enquiry_call2_comments' style="height: 50px; width: 300px"><?php echo $enquiry_call2_comments; ?></textarea></td>
                            </tr>
                            <tr class="bg">
                                <td class="first"><strong>Call 2 Date</strong></td>
                                <td colspan="3" class="last"><input type="text" value="<?php echo ((isset($enquiry_call2_date) && ($enquiry_call2_date != '' && $enquiry_call2_date != '0000-00-00')) ? date("m/d/Y", strtotime($enquiry_call2_date)) : ''); ?>" name="enquiry_call2_date" id="enquiry_call2_date" ></td>

                            </tr>
                            <?php
                            }
                        }
                        ?>
                    <tr class="bg">
                        <td class="first"><strong>Date Of Birth:</strong></td>
                        <td class="last" colspan="3"><input type="text" class="text" name="enquiry_dob" id="enquiry_dob" value="<?php echo $enquiry_dob; ?>"></td>
                    </tr>
                    <?php
                    if (isset($op) && $op == "E") {
                        if (isset($enquiry_call2_status) && $enquiry_call2_status != '0') {
                            if (isset($enquire_junk) && $enquire_junk == "No") {
                                ?>
                                <tr class="bg">
                                    <td class="first"><strong>Move To Junk:</strong></td>
                                    <td class="last" colspan="3"><input type="checkbox" class="text" name="enquire_junk" id="enquire_junk" value="Yes"> Yes</td>
                                </tr><?php
                            }
                        }
                    }
                    ?>

                </tbody>
            </table>
            <p class="buttons">
                <input type="hidden" value="<?php echo $enquiry_course; ?>" id="enquiry_course" name="enquiry_course">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <input type="hidden" value="" id="amount_pay" name="amount_pay">

                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_enquiry.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>
    </div>
</div>
</body></html>