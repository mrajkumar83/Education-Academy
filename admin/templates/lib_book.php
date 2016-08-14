<div class="content-warp">
    <div class="table">
        <form method="post" name="bookForm" id="bookForm" action="../admin/logic/lib_book_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Book</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Book Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="book_name" id="book_name" value="<?php echo $book_name; ?>">
                        </td>
                    </tr>
					<tr>
                        <td class="first"><strong>Book Category</strong><span class="complsory">*</span></td>
                        <td class="last" colspan="3">
                            <select name="book_category" id="book_category" required="required">
                                <option value="">-- Select --</option>
                                <?php
                                while ($lib_categories_rec = mysql_fetch_object($lib_categories)) {
                                    echo '<option value="', $lib_categories_rec->category_id, '"', (($lib_categories_rec->category_id == $book_category) ? ' selected="selected"' : ''), '>', $lib_categories_rec->category_name, '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
					<tr class="bg">

                        <td class="first"><strong>Book Price:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="book_price" id="book_price" value="<?php echo $book_price; ?>">
                        </td>
                    </tr>
					
					<tr class="bg">

                        <td class="first"><strong>Book Stock:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="book_stock" id="book_stock" value="<?php echo $book_stock; ?>">
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="book_status" value="A"<?php echo ($book_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="book_status" value="D"<?php echo ($book_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_library_book.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>