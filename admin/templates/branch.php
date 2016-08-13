<div class="content-warp">
    <div class="table">
        <form method="post" name="branchForm" id="branchForm" action="../admin/logic/branch_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Branch</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Branch Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="branch_name" id="branch_name" value="<?php echo $branch_name; ?>">
                        </td>
                    </tr>
                    <tr>

                        <td class="first"><strong>Short Name:</strong></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="branch_short_name" id="branch_short_name" value="<?php echo $branch_short_name; ?>">
                        </td>
                    </tr>
                    <tr class="bg">

                        <td class="first" valign="top"><strong>Branch Address:</strong></td>
                        <td colspan="3" class="last">
                            <textarea name="branch_address" id="branch_address" style="height: 80px; width: 400px; resize: none;"><?php echo $branch_address; ?></textarea>
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="branch_status" value="A"<?php echo ($branch_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="branch_status" value="D"<?php echo ($branch_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_branch.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>