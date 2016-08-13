<div class="content-warp">
	<div class="table">
		<form method="post" name="subjectForm" id="subjectForm" action="../admin/logic/logic_attendance.php?op=<?php echo $op;?>">
			<table cellspacing="0" cellpadding="0" class="listing form">
				<tbody>
					<tr>
						<th colspan="4" class="full">Attendance</th>
					</tr>
					<tr class="bg">
						
						<td class="first"><strong>Student Id:</strong></td>
						<td colspan="3" class="last">
                            <input type="text" class="text" name="student_id" id="student_id" value="<?php echo $student_id;?>">
                      </td>
					</tr>
				
					<tr class="bg">
						
						<td class="first"><strong> Date:</strong></td>
						<td colspan="3" class="last">
                           <input type="text" class="text" name="date" id="date_enrollment" value="<?php echo $date;?>">
                      </td>
					</tr>
					<tr>
						<td class="first"><strong>Attendance</strong></td>
						<td colspan="3" class="last">
                            <input type="radio" class="textarea" name="attendance" value="A"<?php echo ($attendance== 'P' ? ' checked' : '');?>>&nbsp;Present&nbsp;&nbsp;
							<input type="radio" class="textarea" name="attendance" value="D"<?php echo ($attendance== 'A' ? ' checked' : '');?>>&nbsp;Absent&nbsp;
                      </td>
					</tr>
	         		
			</tbody></table>
			
			<p class="buttons">
			<input type="hidden" value="<?php echo $op;?>" name="op">
			<input type="hidden" value="<?php echo $id;?>" name="id">
	         <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_batch.php'">
               &nbsp; &nbsp;
             <input type="submit" value="Submit" name="Add">
	        </p>
		</form>