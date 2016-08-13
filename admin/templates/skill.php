<div class="content-warp">
	<div class="table">
		<form method="post" name="skillFrm" id="skillFrm" action="./logic/skill_logic.php?op=<?php echo $op;?>">
			<table cellspacing="0" cellpadding="0" class="listing form">
				<tbody>
					<tr>
						<th colspan="4" class="full">Skills</th>
					</tr>
					<tr class="bg">
						
						<td class="first"><strong>Skill Name:</strong></td>
						<td colspan="3" class="last">
                            <input type="text" class="text" name="skill_name" id="skill_name" value="<?php echo $skill_name;?>">
                      </td>
					</tr>
					
					 <tr>
						<td class="first"><strong>Status</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="skill_status" value="A"<?php echo ($skill_status == 'A' ? ' checked' : '');?>>&nbsp;Active&nbsp;&nbsp;
							<input type="radio" class="textarea" name="skill_status" value="D"<?php echo ($skill_status == 'D' ? ' checked' : '');?>>&nbsp;De-Active&nbsp;
                      </td>
					</tr> 
	         		
			</tbody></table>
			
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op">
			<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
	         <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_skills.php'">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>