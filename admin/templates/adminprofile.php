<div class="content-warp">
    <div class="table">
        <form method="post" name="staffForm" id="staffForm" action="../admin/logic/staff_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Personal Details</th>
                    </tr>
                    <tr>
                        <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_fname;?>" id="staff_fname" name="staff_fname" class="text" tabindex="1"></td>
                        <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_lname;?>" id="staff_lname" name="staff_lname" class="text" autocomplete="off"></td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Primary E-mail</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_email;?>" id="staff_email" name="staff_email" class="text" autocomplete="off"></td>
                        <td class="first"><strong>Secondary E-mail</strong></td>
                        <td class="last"><input type="text" value="<?php echo $staff_semail;?>" id="staff_semail" name="staff_semail" class="text" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Mobile No.</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="<?php echo $staff_mobile;?>" maxlength="10" id="staff_mobile" name="staff_mobile" class="text" autocomplete="off"></td>
                        <td class="first"><strong>Phone No.</strong></td>
                        <td class="last"><input type="text" value="<?php echo $staff_phno;?>" id="staff_phno" name="staff_phno" class="text" autocomplete="off"></td>                        
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Photo</strong></td>
                        <td colspan="3" class="last"><input type="file" id="staff_photo" value="" name="staff_photo" style="width:85%" class="text"><img src="<?php echo $img; ?>" height="40px" width="50px"> </td>

                    </tr>
                    <tr>
                        <td class="first"><strong>Street Address</strong></td>
                        <td colspan="3" class="last"><textarea name='staff_address' id='staff_address' style="height: 50px; width: 300px"><?php echo $staff_address;?></textarea></td>
                    </tr>
                                <?php
                                if ($utype1 == "SA" || $utype1 == "AD") {
                                    ?><tr class="bg"><?php
                                if (isset($utype) && $utype == "SF") {
                                        ?>
                                <td class="first"><strong>Role</strong><span class="complsory">*</span></td>
                                <td class="last" colspan="3">
                                    <select name="user_role" id="user_role" required="required">
                                        <option value="">-- Select --</option>
                                        <?php
                                        while ($role_rec = mysql_fetch_object($role)) {
                                            echo '<option value="', $role_rec->role_id, '"', (($role_rec->role_id == $user_role) ? ' selected="selected"' : ''), '>', $role_rec->role_name, '</option>';
                                        }
                                        ?>
                                    </select>
                                </td><?php }
    ?>
                                    <?php
                                    if ($pagefrom != 'profile' && $utype1 == "SA") {
                                        ?>
                                <td class="first"><strong>Branch</strong><span class="complsory">*</span></td>
                                <td class="last" colspan="3">
                                        <?php
                                        if (isset($utype1) && $utype1 == "SA") {
                                            ?>
                                        <select name="user_branch" id="user_branch" required="required">
                                            <option value="">-- Select --</option>
                                        <?php
                                        while ($branch_rec = mysql_fetch_object($branch)) {
                                            echo '<option value="', $branch_rec->branch_id, '"', (($branch_rec->branch_id == $user_branch) ? ' selected="selected"' : ''), '>', $branch_rec->branch_name, '</option>';
                                        }
                                        ?>
                                        </select><?php
                        } elseif (isset($utype1) && $utype1 == "AD") {
                            echo $user_branch_name;
                                        ?>
                                        <input type="hidden" name="user_branch" value="<?php echo $user_branch; ?>" /><?php }
                                    ?>

                                </td>
                            <?php
                        }
                        ?>
                        </tr>
                        <?php
                    }
                    ?>
<?php
if ($op == 'ADD' || $op == '') {
    ?>
                        <tr>
                            <th colspan="4" class="full">Login Details</th>
                        </tr>						
                        <tr>
                            <td class="first"><strong>User ID</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="text" value="<?php echo $user_name ?>" class="text" id="user_name" name="user_name" autocomplete="off"></td>
                            <td class="first"><strong>Password</strong><span class="complsory">*</span></td>
                            <td class="last"><input type="password" class="text" id="user_password" name="user_password" autocomplete="off"></td>
                        </tr>
                        <?php
                    }
                    if ($pagefrom != 'profile') {
                        ?>
                        <tr>
                            <td class="first"><strong>Staff Status</strong></td>
                            <td colspan="3" class="last">
                                <input type="radio" class="textarea" name="user_status" value="A"<?php echo (($user_status == 'A' || $user_status == '') ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                                <input type="radio" class="textarea" name="user_status" value="D"<?php echo ($user_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                            </td>
                        </tr>
    <?php
}
?>
                </tbody>
            </table>
            <p class="buttons">
                <?php
                if (isset($pagefrom) && $pagefrom == 'profile') {
                    echo '<input name="user_status" id="user_status" type="hidden" value="A">';
                }
                ?>
                <input name="utype" id="utype" type="hidden" value="<?php echo (isset($utype1) ? $utype1 : ''); ?>">
                <input name="id" id="id" type="hidden" value="<?php echo (isset($id) ? $id : ''); ?>">
                <input name="pagefrom" id="pagefrom" type="hidden" value="<?php echo $pagefrom; ?>">
                <?php
                if (!isset($pagefrom) || $pagefrom == '') {
                    echo '<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href=\'manage_staff.php?utype=', $utype, '\';">';
                }
                if (isset($pagefrom) && $pagefrom == 'front') {
                    echo '<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href=\'index.php\';">';
                }
                ?>
                &nbsp; &nbsp;
                <input name="AddNew" type="submit" value="Submit" class="login gradient" />
            </p>
        </form>
    </div>
</div>

</body>
</html>
