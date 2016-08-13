<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
<div class="content-warp">
    <div class="table">
        <form method="post" name="feeForm" id="feeForm" action="./logic/payfees_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">FEES</th>
                    </tr>
                    <?php
                    if (isset($op) && $op == "A") {
						if(isset($ext_std_id) && $ext_std_id >0){
							echo '<input  type="hidden" name="ext_std_id" id="ext_std_id" value="'.$ext_std_id.'" />';
						}else{
							echo '<input  type="hidden" name="new" id="new" value="new" />';
						}
                        ?>
					
                    <tr class="bg">
                        <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo isset($std_fname) ? $std_fname : '';?>" id="std_fname" name="std_fname" class="text"></td>
                        <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo isset($std_lname) ? $std_lname : '';?>" id="std_lname" name="std_lname" class="text"></td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Phone No</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo isset($std_phno) ? $std_phno : '';?>" id="std_phno" name="std_phno" class="text" maxlength="10"></td>
                        <td class="first"><strong>E-mail</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo isset($std_email) ? $std_email : '';?>" id="std_email" name="std_email" class="text"></td>
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
                            </select>
                        </td>
                        <td class="first"><strong>Course</strong></td>
                        <td class="last" id="std_course_td">&nbsp;</td>
                        </td>
                    </tr>

                    <tr>
                        <td class="first"><strong>Photo</strong></td>
                        <td class="last">
						<?php
                            if (isset($std_photo) && $std_photo != '') {
                                $img_file = './photos/' . $std_photo;
                                if (file_exists($img_file)) {
                                    echo '<img src="', $img_file, '" height="50" width="50">';
                                }
								else {
									echo '<input type="file" name="std_photo" id="std_photo"  title=" Required" />';
								}
                            } else {
                                echo '<input type="file" name="std_photo" id="std_photo"  title=" Required" />';
                            }
                        ?>
						</td>

                        <td class="first"><strong>Amount To Pay</strong></td>
                        <td class="last"><input type="text" value="<?php echo $balance; ?>" id="course_amount" readonly="readonly" name="course_amount" class="text"></td>
                    </tr>
                    <?php
                } elseif (isset($op) && $op == "E") {
                    ?>
                    <input type="hidden" name="old" id="old" value="old" />
                    <?php
                    if (isset($tbl) && $tbl == "enquiry") {
                        ?>
                        <tr class="bg">
                            <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="text"  id="std_fname" name="std_fname" class="text" value="<?php echo $enquiry_fname; ?>"></td>
                            <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="text"  id="std_lname" name="std_lname" class="text" value="<?php echo $enquiry_lname; ?>"></td>
                        </tr>
                        <tr>
                            <td class="first"><strong>Phone No</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="text" id="std_phno" name="std_phno" class="text" value="<?php echo $enquiry_phno; ?>"></td>
                            <td class="first"><strong>E-mail</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="text" value="<?php echo $enquiry_email; ?>" id="std_email" name="std_email" class="text"></td>
                        </tr>
                        <tr class="bg">
                           <td class="first"><strong>Batch</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <select name="batchbranch" id="batchbranch" required="required" onchange="javascript:get_amount(this.value)">
                                <option value="">-- Select --</option>
                                <?php
                                while ($batch_data = mysql_fetch_object($batch)) {
                                    $val = $batch_data->batch_id . "::" . $batch_data->branch_id;
                                    $opt = $batch_data->batch_name . "[" . $batch_data->branch_name . "]";
                                    echo '<option value="', $val, '"', (($val == $batchbranch) ? ' selected="selected"' : ''), '>', $opt, '</option>';
                                }
                                ?>
                            </select>
                        </td>
                            <td class="first"><strong>Course</strong></td>
                            <td class="last" id="std_course_td"><?php echo $course_name; ?></td>                                
                        </tr>
                        <tr>
                            <td class="first"><strong>Photo</strong></td>
                            <td class="last"><?php
                            if ($std_photo != '') {
                                $img_file = 'photos/' . $std_photo;
                                if (file_exists($img_file)) {
                                    echo '<img src="', $img_file, '" height="50" width="50">';
                                }
                            } else {
                                echo '<input type="file" name="std_photo" id="std_photo"  title=" Required" />';
                            }
                                    ?></td>
                            <td class="first"><strong>Amount To Pay</strong></td>
                            <td class="last"><input type="text" value="<?php echo (isset($fee_amount) ? $fee_amount : ''); ?>" id="course_amount" readonly="readonly" name="course_amount" class="text"></td>
                        </tr><?php
                    } else {
                                    ?>

                        <tr class="bg">
                <!--<td class="first" width="23%"><strong>Student Id</strong></td>
                <td class="last"><?php echo $std_id; ?></td>-->

                            <td class="first"><strong>Name</strong></td>
                            <td class="last" colspan="3"><?php echo $fullname; ?></td>
                        </tr>
                        <tr>
                            <td class="first" width="23%"><strong>E-mail</strong></td>
                            <td class="last"><?php echo $std_email; ?></td>
                            <td class="first"><strong>Phone Number</strong></td>
                            <td class="last" colspan="3"><?php echo $std_phno; ?></td>
                        </tr>

                        <tr class="bg">
                            <td class="first"><strong>Batch</strong></td>
                            <td class="last"><?php echo $batch_name; ?></td>
                            <td class="first"><strong>Course</strong></td>
                            <td class="last"><?php echo $course_name; ?></td>
                        </tr>
                        <tr>
                            <td class="first"><strong>Amount To Pay</strong></td>
                            <td class="last" colspan="3"><?php echo $fee_amount; ?></td>
                        </tr>
                        <tr class="bg">
                            <td class="first"><strong>Photo</strong></td>
                            <td class="last" colspan="3"><?php
                if ($std_photo != '') {
                    $img_file = 'photos/' . $std_photo;
                    if (file_exists($img_file)) {
                        echo '<img src="', $img_file, '" height="50" width="50">';
                    }
                } else {
                    echo "Not Available";
                }
                                    ?></td>

                        </tr>
                    <?php }
                    $data = $db->fetchAllRecord(' tb_student_fees  ', ' * ', ' std_id="'.$id.'" ');
                    if (mysql_num_rows($data)) {
                        ?>
                        <tr>
                            <th colspan="4" class="full">Old Payment Details</th>
                        </tr><?php
                while ($row = mysql_fetch_object($data)) {

                    $mode1 = $db->fetchRecord(' tb_mode ', ' mode_id,mode_name ', ' mode_id="' . $row->fee_mode . '" ');
                    $mode_name = $mode1->mode_name;
                    $fee_fields = $db->fetchAllRecord(' tb_fee_fields ', ' * ', ' fee_id = ' . $row->fee_id . ' ', NULL, NULL, NULL, 0, 'All');
                            ?>
                            <tr class="bg">
                                <td class="first"><strong>Payment Mode</strong></td>
                                <td class="last" colspan="3"><?php echo $mode_name; ?></td>
                            </tr>
                            <tr>
                                <td class="first"><strong>Paid Amount</strong></td>
                                <td class="last"><?php echo $row->paid_amount; ?></td>
                                <td class="last"><strong>Balance</strong></td>
                                <td class="last" colspan="3"><?php echo $row->balance; ?></td>
                            </tr>
                            <?php
                            if (isset($fee_fields)) {
                                $i = 0;
                                while ($items = mysql_fetch_object($fee_fields)) {
                                    $class = ($i % 2 == 0) ? 'bg' : '';
                                    echo '
                            <tr class="' . $class . '">
                                <td class="first"><strong>' . $items->field_name . '</strong></td>
                                <td class="last"colspan="3">' . $items->field_value . '</td>
                                </tr>';
                                    $i++;
                                }
                            }
                            $balance = $row->balance;

                            if ($balance != "0.00") {
                                ?>
                                <tr class="bg">
                                    <td class="first"><strong>Installment Due Date</strong></td>
                                    <td class="last" colspan="3"><?php echo date("d-M-Y", strtotime($row->installment_due_date)); ?></td>
                                </tr>
                                <tr>
                                    <th colspan="4" class="full">New Payment Details</th>
                                </tr>
                                <?php
                            }
                        }
                    } else {
                        $balance = $fee_amount;
                    }
                }
                if (isset($op) && ($op == "A" || ($op == "E" && $balance != "0.00"))) {
                    if ($op == "E") {
                        $fee_mode = '';
                    }
                    ?>
                    <input type="hidden" name="amount_pay" id="amount_pay" value="<?php echo $balance; ?>" />
                    <tr class="bg">
                        <td class="first"><strong>Mode</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last"><select name="fee_mode" id="fee_mode" required="required" onchange="mode_change(this.value)"  title=" Required">
                                <option value="">-- Select --</option>
                                <?php
                                while ($mode_rec = mysql_fetch_object($mode)) {
                                    echo '<option value="', $mode_rec->mode_id, '"', (($mode_rec->mode_id == $fee_mode) ? ' selected="selected"' : ''), '>', $mode_rec->mode_name, '</option>';
                                }
                                ?>
                            </select></td>
                    </tr>

                <?php }
                ?>
                </tbody>
            </table>
            <?php
            if (isset($op) && ($op == "A" || ($op == "E" && $balance != "0.00"))) {
                ?>
                <div id="modeDiv"> </div>
                <table cellspacing="0" cellpadding="0" class="listing form" id="paymentTable" >
                    <tr>
                        <th colspan="4" class="full">Payment Details</th>
                    </tr>
                    <tr class="bg">
                        <td class="first" width="23%"><strong>Date of Payment</strong><span class="complsory">*</span></td>
                        <td class="first"><input type="text" value="<?php echo $fee_date; ?>" id="fee_date" name="fee_date" class="text required" title=" Required"></td>
                        <td class="last"><strong>Installment</strong></td>
                        <td  class="last"><input type="radio" class="textarea" name="installment" onclick="change_installment(this.value)" value="Y"<?php echo (($installment == 'Y' || $installment == '') ? ' checked' : ''); ?>>
                            &nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="installment" onclick="change_installment(this.value)" value="N"<?php echo ($installment == 'N' ? ' checked' : ''); ?>>
                            &nbsp;No&nbsp; </td>
                    </tr>
                    <tr id="instdate1">
                        <td class="first"><strong>Paid Amount.</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" autocomplete="off" onkeyup="verify_field(this)" value="<?php echo $paid_amount; ?>" id="paid_amount" name="paid_amount" class="text"></td>
                        <td class="first"><strong>Balance</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $balance; ?>" id="balance" name="balance" class="text"></td>
                    </tr>
                    <tr class="bg" id="instdate">
                        <td class="first"><strong>Installment Due Date</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last"><input type="text" value="<?php echo $installment_due_date; ?>" id="installment_due_date" name="installment_due_date" class="text"></td>
                    </tr>
                </table>
            <?php }
            ?>
            <p class="buttons">
                <?php
                if (isset($pagefrom) && $pagefrom == 'profile') {
                    echo '<input name="user_status" id="user_status" type="hidden" value="A">';
                }
                if (isset($tbl) && $tbl == 'enquiry') {
                    echo '<input name="tbl" id="tbl" type="hidden" value="enquiry">';
                }
                ?>
				<input type="hidden" id="std_course" name="std_course" value="<?php echo $course_id;?>">
                <input name="utype" id="utype" type="hidden" value="<?php echo $utype; ?>">
                <input name="id" id="id" type="hidden" value="<?php echo $id; ?>">
				<input name="eid" id="eid" type="hidden" value="<?php echo $eid; ?>">
                <input name="std_id" id="std_id" type="hidden" value="<?php echo (isset($std_id) ? $std_id : ''); ?>">
                <input name="pagefrom" id="pagefrom" type="hidden" value="<?php echo $pagefrom; ?>">
                <input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='manage_payfees.php';">
                &nbsp; &nbsp;
                <?php
                if (isset($op) && ($op == "A" || ($op == "E" && $balance != "0.00"))) {
                    ?>
                    <input name="AddNew" type="submit" value="Submit" class="login gradient" />
                <?php }
                ?>
            </p>
        </form>
    </div>
</div>
</div>
</body>
</html>