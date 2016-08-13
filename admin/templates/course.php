<div class="content-warp">
    <div class="table">
        <form method="post" name="courseForm" id="courseForm" action="../admin/logic/course_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Course</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Course Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="course_name" id="course_name" value="<?php echo $course_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td class="first" valign="top"><strong>Course Description:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <textarea name="course_desc" id="course_desc" style="height: 80px; width: 400px; resize: none;"><?php echo $course_desc; ?></textarea>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="course_status" value="A"<?php echo ($course_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="course_status" value="D"<?php echo ($course_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>

                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_course.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>