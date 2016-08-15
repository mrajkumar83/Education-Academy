<div class="content-warp">
    <div class="table">
        <form method="post" name="announcementForm" id="announcementForm" action="../admin/logic/announcements_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Announcement</th>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Title:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="announcement_title" id="announcement_title" value="<?php echo $announcement_title; ?>">
                        </td>
                    </tr>
					
					<tr class="">
                        <td class="first"><strong>Description:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <textarea class="text" name="announcement_content" id="announcement_content"><?php echo $announcement_content; ?></textarea>
                        </td>
                    </tr>
					
					<tr class="bg">
                        <td class="first"><strong>Last Date:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="announcement_date" id="announcement_date" value="<?php echo $announcement_date; ?>">
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="announcement_status" value="A"<?php echo ($announcement_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="announcement_status" value="D"<?php echo ($announcement_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_announcements.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>