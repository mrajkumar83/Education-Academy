<div class="content-warp">
	<div class="table">
		<form method="post" name="modeForm" id="modeForm" enctype="multipart/form-data" action="../admin/logic/mode_logic.php?op=<?php echo $op;?>">
			<table cellspacing="0" cellpadding="0" class="listing form" border="1">
				<tbody class="fields">
					<tr>
						<th colspan="4" class="full">Mode</th>
					</tr>
					<tr class="bg">
						
						<td class="first"><strong>Name:<span class="complsory">*</span></strong></td>
						<td class="last" colspan="3">
                            <input type="text" class="text" name="mode_name" id="mode_name" value="<?php echo $mode_name;?>">
                      &nbsp;&nbsp;&nbsp;<input type="button" value="Add Field" id="mode_field" onclick="add_click()" /></td>
					</tr>
					<tr>
						<td class="first"><strong>Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="mode_status" value="A"<?php echo (($mode_status== 'A' || $mode_status == '') ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="mode_status" value="D"<?php echo ($mode_status== 'D' ? ' checked' : '');?>>&nbsp;De-Active&nbsp;
                      </td>
					</tr>
                    <?php 
					if(isset($op) && $op=="E" && isset($data1) && count($data1))
					{
						$i = 0;
						while($field_rec = mysql_fetch_object($data1))
						{
							$css = ($i % 2 == 0) ? 'bg' : '';
							echo '<tr class="'.$css.'">';
						?>
								<td class="first"><strong>Field Name</strong></td>
                                <td class="last" colspan="3">
							<input type="text" value="<?php echo $field_rec->mode_field_name;?>" name="mode_fields[]" />&nbsp;&nbsp;&nbsp;<input type="button" class="btnRemove" value="Delete" onclick="del_click(this)">
						<?php
							$i++;
						}
					}
					?>
                    
	         		
			</tbody></table>
			
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op">
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
	         <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_mode.php'">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>