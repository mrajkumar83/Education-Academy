<?php
	$step = '2';
	$path = '.';
	$title = 'View Remark';
	$css = array('styles.css');
	$js = array(' ');	
	require_once('includes/common.php');
	
	$db = new Query();
	$remarks =  $db->fetchRecord(' tb_hr_remarks ', ' * ', ' rating_id="'.$id.'"');	
?>
<div id="main">
		<div class="top-bar"><h1><?php echo $title;?></h1></div>
<div class="content-warp">
	<div class="table">
		<form method="post" name="batchForn" id="batchForn" action="../admin/logic/batch_logic.php?op=<?php echo $op;?>">
			<table cellspacing="0" cellpadding="0" class="listing form">
				<tbody>
					<tr>
						<th colspan="4" class="full">View Remarks</th>
					</tr>
					<tr class="bg">
						
						<td class="first" width="100px;"><strong>Student Username:</strong><span class="complsory">*</span></td>
						<td colspan="3" class="last">
                            <?php echo $remarks->student_username ; ?>
                      </td>
					</tr>
					<tr>
						
						<td class="first" width="100px;"><strong>Student Name:</strong><span class="complsory">*</span></td>
						<td colspan="3" class="last">
                            <?php echo $remarks->student_name ; ?>
                      </td>
					</tr>
					<tr class="bg">
						
						<td class="first" width="100px;"><strong>Remarks:</strong><span class="complsory">*</span></td>
						<td colspan="3" class="last">
                            <?php echo $remarks->Remark ; ?>
                      </td>
                      <tr>
						
						<td class="first" width="150px;"><strong>Rating:</strong><span class="complsory">*</span></td>
						<td colspan="3" class="last">
                            <?php echo $remarks->mock_rating ; ?>
                      </td>
                      <tr class="bg">
						
						<td class="first" width="100px;"><strong>Interview Date:</strong><span class="complsory">*</span></td>
						<td colspan="3" class="last">
                            <?php echo date('m/d/Y',strtotime($remarks->date)) ; ?>
                      </td>
					</tr>
					</tr>
					 
	         		
			</tbody></table>
			
			<p class="buttons">
			
	         <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_hrremark.php'">
               &nbsp; &nbsp;
            
	        </p>
		</form>
		</div>
</body>
</html>