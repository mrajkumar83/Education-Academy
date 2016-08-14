<div class="content-warp">
    <div class="table">
        <form method="post" name="categoryForm" id="categoryForm" action="../admin/logic/lib_category_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Books Category</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Category Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="category_name" id="category_name" value="<?php echo $category_name; ?>">
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="category_status" value="A"<?php echo ($category_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="category_status" value="D"<?php echo ($category_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_library_category.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>