<div class="content-warp">
	<div class="table">
		<form method="post" name="subjectForm" id="subjectForm" action="./logic/callstatus.php?op=<?php echo $op;?>">
			<table cellspacing="0" cellpadding="0" class="listing form">
				<tbody>
					<tr>
						<th colspan="4" class="full">Call Status</th>
					</tr>
					<tr class="bg">
						
						<td class="first"><strong>Type:</strong></td>
						<td colspan="3" class="last">
                            <input type="text" class="text" name="call_sts_type" id="call_sts_type" value="<?php echo $call_sts_type;?>">
                      </td>
					</tr>
					
					 <tr>
						<td class="first"><strong>Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="call_sts_status" value="A"<?php echo ($call_sts_status == 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="call_sts_status" value="D"<?php echo ($call_sts_status == 'D' ? ' checked' : '');?>>&nbsp;De-Active&nbsp;
                      </td>
					</tr> 
	         		
			</tbody></table>
			
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op">
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
	         <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='managecallstatus.php'">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>