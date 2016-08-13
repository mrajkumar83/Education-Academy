<div class="content-warp">
    <div class="table">
        <form method="post" name="resumeFrm" id="resumeFrm" action="../admin/logic/resume_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Resumes</th>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Resume Name</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text"  class="text" name="resume_name" id="resume_name" value="<?php echo $resume_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Resume:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="file" name="resume_doc" id="resume_doc"<?php echo ($op == 'A') ? ' required="true"' : ''; ?>>&nbsp;&nbsp;&nbsp;
                            <?php
                            if($resume_org_name != ''){
                            ?>
                              <a href="./downloadfile.php?path=resumes&amp;filename=<?php echo ($resume_org_name); ?>"><?php echo $resume_org_name; ?></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="resume_status" value="A"<?php echo ($resume_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="resume_status" value="D"<?php echo ($resume_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>


                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_resume.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>
