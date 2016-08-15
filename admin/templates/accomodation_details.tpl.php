<div class="content-warp">
    <div class="table">
        <form method="post" name="vehicleForm" id="vehicleForm" action="../admin/logic/accomadation_details_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Accomodation</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Accomodation Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="accomadation_name" id="accomadation_name" value="<?php echo $accomadation_name; ?>">
                        </td>
                    </tr>
					<tr>
                        <td class="first"><strong>Accomodation Category</strong><span class="complsory">*</span></td>
                        <td class="last" colspan="3">
                            <select name="accomadation_category" id="accomadation_category" required="required">
                                <option value="">-- Select --</option>
                                <?php
                                while ($lib_categories_rec = mysql_fetch_object($lib_categories)) {
                                    echo '<option value="', $lib_categories_rec->category_id, '"', (($lib_categories_rec->category_id == $accomadation_category) ? ' selected="selected"' : ''), '>', $lib_categories_rec->category_name, '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
					
					<tr class="bg">
                        <td class="first"><strong>Accomodation Price:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="accomadation_price" id="accomadation_price" value="<?php echo $accomadation_price; ?>">
                        </td>
                    </tr>
					
					<tr>
                        <td class="first"><strong>Assigned number:</strong></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="accomadation_number" id="accomadation_number" value="<?php echo $accomadation_number; ?>">
                        </td>
                    </tr>
					
					<tr class="bg">
                        <td class="first"><strong>Number of rooms:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="accomadation_rooms" id="accomadation_rooms" value="<?php echo $accomadation_rooms; ?>">
                        </td>
                    </tr>
					
					<tr>
                        <td class="first"><strong>Address:</strong></td>
                        <td colspan="3" class="last">
                            <textarea type="text" class="text" name="accomadation_address" id="accomadation_address"><?php echo $accomadation_address; ?></textarea>
                        </td>
                    </tr>
                    
                     <tr class="bg">
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="accomadation_status" value="O"<?php echo ($accomadation_status == 'O' ? ' checked' : ''); ?>>&nbsp;Occupied&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="accomadation_status" value="E"<?php echo ($accomadation_status == 'E' ? ' checked' : ''); ?>>&nbsp;Empty&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_accomadation_details.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>