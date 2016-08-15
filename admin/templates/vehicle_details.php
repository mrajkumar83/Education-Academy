<div class="content-warp">
    <div class="table">
        <form method="post" name="vehicleForm" id="vehicleForm" action="../admin/logic/vehicle_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Vehicle</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Vehicle Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="vehicle_name" id="vehicle_name" value="<?php echo $vehicle_name; ?>">
                        </td>
                    </tr>
					<tr>
                        <td class="first"><strong>Vehicle Category</strong><span class="complsory">*</span></td>
                        <td class="last" colspan="3">
                            <select name="vehicle_category" id="vehicle_category" required="required">
                                <option value="">-- Select --</option>
                                <?php
                                while ($lib_categories_rec = mysql_fetch_object($lib_categories)) {
                                    echo '<option value="', $lib_categories_rec->category_id, '"', (($lib_categories_rec->category_id == $vehicle_category) ? ' selected="selected"' : ''), '>', $lib_categories_rec->category_name, '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
					<tr class="bg">

                        <td class="first"><strong>Vehicle Price:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="vehicle_price" id="vehicle_price" value="<?php echo $vehicle_price; ?>">
                        </td>
                    </tr>
					
					<tr class="bg">

                        <td class="first"><strong>Vehicle number:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" name="vehicle_number" id="vehicle_number" value="<?php echo $vehicle_number; ?>">
                        </td>
                    </tr>
                    
                     <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="vehicle_status" value="W"<?php echo ($vehicle_status == 'W' ? ' checked' : ''); ?>>&nbsp;Working&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="vehicle_status" value="N"<?php echo ($vehicle_status == 'N' ? ' checked' : ''); ?>>&nbsp;Not-Working&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_library_vehicle.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>