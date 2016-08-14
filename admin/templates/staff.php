<div class="content-warp">
    <div class="table">
        <form method="post" name="staffForm" id="staffForm" action="./logic/staff_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Personal Details</th>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_fname;?>" id="staff_fname" name="staff_fname" class="text"></td>
                        <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_lname;?>" id="staff_lname" name="staff_lname" class="text"></td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Primary E-mail</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_email;?>" id="staff_email" name="staff_email" class="text"></td>
                        <td class="first"><strong>Secondary E-mail</strong></td>
                        <td class="last"><input type="text" value="<?php  echo $staff_semail;?>" id="staff_semail" name="staff_semail" class="text"></td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Mobile No.</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_mobile;?>" id="staff_mobile" name="staff_mobile" maxlength="10" class="text"></td>
                        <td class="first"><strong>Phone No.</strong></td>
                        <td class="last"><input type="text" value="<?php echo $staff_phno;?>" id="staff_phno" name="staff_phno" maxlength="20" class="text"></td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Photo</strong></td>
                        <td colspan="3" class="last"><input type="file" id="staff_photo" value="" name="staff_photo" style="width:85%" class="text"><img src="<?php echo $img; ?>" height="40px" width="50px"></td>

                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Street Address</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last"><textarea name='staff_address' id='staff_address' style="height: 50px; width: 300px"><?php echo $staff_address; ?></textarea></td>
                    </tr>
                    <tr>
                            <td class="first"><strong>Permissions</strong></td>
                            <td colspan="3" class="last"><input type="radio" class="textarea" name="role_permission" value="C"<?php echo ($role_permission == 'C' ? ' checked' : ''); ?>>
                                &nbsp;Counselor&nbsp;
                                <input type="radio" class="textarea" name="role_permission" value="F"<?php echo ($role_permission == 'F' ? ' checked' : ''); ?>>
                                &nbsp;Finance&nbsp;
                                <input type="radio" class="textarea" name="role_permission" value="O"<?php echo ($role_permission == 'O' ? ' checked' : ''); ?>>
                                &nbsp;Operational&nbsp;
                                <input type="radio" class="textarea" name="role_permission" value="H"<?php echo ($role_permission == 'H' ? ' checked' : ''); ?>>
                                &nbsp;HR&nbsp;
                                <input type="radio" class="textarea" name="role_permission" value="B"<?php echo ($role_permission == 'B' ? ' checked' : ''); ?>>
                                &nbsp;Business Development&nbsp;
								<input type="radio" class="textarea" name="role_permission" value="L"<?php echo ($role_permission == 'L' ? ' checked' : ''); ?>>
                                &nbsp;Librarian&nbsp;
								<input type="radio" class="textarea" name="role_permission" value="T"<?php echo ($role_permission == 'T' ? ' checked' : ''); ?>>
                                &nbsp;Transport Manager&nbsp;
								<input type="radio" class="textarea" name="role_permission" value="Q"<?php echo ($role_permission == 'Q' ? ' checked' : ''); ?>>
                                &nbsp;Quaters Incharge&nbsp;
                                <?php
                                if (isset($UTYPE) && $UTYPE == "SA") {
                                 ?>
                                    <input type="radio" class="textarea" name="role_permission" value="A"<?php echo ($role_permission == 'A' ? ' checked' : ''); ?>>
                                    &nbsp;Admin&nbsp; 
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                                    <?php
                                    if (isset($UTYPE) && $UTYPE == "SA") {
                                        ?>
                            <tr>
                                <td class="first"><strong>Branch</strong><span class="complsory">*</span></td>
                                <td class="last" colspan="3">
                                    <select name="user_branch" id="user_branch" required="required" tabindex="1">
                                        <option value="">-- Select --</option>
                            <?php
                            while ($branch_rec = mysql_fetch_object($branch)) {
                                echo '<option value="', $branch_rec->branch_id, '"', (($branch_rec->branch_id == $user_branch) ? ' selected="selected"' : ''), '>', $branch_rec->branch_name, '</option>';
                            }
                            ?>
                                    </select>
                                </td><?php } ?>
                        </tr>
                      
                    <tr class="bg">
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="user_status" value="A"<?php echo (($user_status == 'A' || $user_status == '') ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="user_status" value="D"<?php echo ($user_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="buttons">
                <?php
                if (isset($pagefrom) && $pagefrom == 'profile') {
                    echo '<input name="user_status" id="user_status" type="hidden" value="A">';
                }
                ?>
                <input name="utype" id="utype" type="hidden" value="<?php echo $utype; ?>">
                <input name="id" id="id" type="hidden" value="<?php echo $id; ?>">
                <input name="pagefrom" id="pagefrom" type="hidden" value="<?php echo $pagefrom; ?>">
                 <input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='manage_staff.php<?php echo ((isset($UTYPE) && $UTYPE == 'SA') ? '' : 'utype=SF');?>'">

                &nbsp; &nbsp;
                <input name="AddNew" type="submit" value="Submit" class="login gradient" />
            </p>
        </form>
    </div>
</div>

</body>
</html>
