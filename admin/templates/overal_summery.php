<div class="content-warp">
    <div class="table">
    	<div style="margin-left: 20px">
    		 <form method="post" name="batchForn" id="batchForn" action="overal_summery.php">
    	        <input type="submit" value="OVER ALL" name="submit" class="sbuttons<?php echo ( $submit == '' || $submit == 'OVER ALL') ? ' selectedButton' : ''?>">
                &nbsp; &nbsp;
                <input type="submit" value="ON-GOING BATCHES" name="submit" class="sbuttons<?php echo (isset($submit) && $submit == 'ON-GOING BATCHES') ? ' selectedButton' : ''?>">
                &nbsp; &nbsp;
                <input type="submit" value="COMPLETED BATCHES" name="submit" class="sbuttons<?php echo (isset($submit) && $submit == 'COMPLETED BATCHES') ? ' selectedButton' : ''?>">
                
				<table cellspacing="0" cellpadding="0" class="listing form" style="margin-top: 20px;">
                <tbody>
                    <tr>
                        <th colspan="4" class="full" align="center"><?php echo $heading; ?></th>
                    </tr>
                   
                    <tr class="bg">
                        <td class="first" style="width: 300px" align="left"><strong>Date:</strong></td>
                        <td  class="last" align="left"><?php echo date("d-m-Y")  ?></td>
                    </tr>
                    <tr >

                        <td class="first" align="left"><strong>Total Branches:</strong></td>
                        <td  class="last" align="left"><?php echo $batch_branch_cnt; ?></td>
                    </tr>
                     <tr class="bg">

                        <td class="first" align="left"><strong>Total Batches:</strong></td>
                        <td  class="last" align="left"><?php echo $batch_count; ?></td>
                    </tr>
                     <tr >

                        <td class="first" align="left"><strong>Total Students:</strong></td>
                        <td  class="last" align="left"><?php echo $student_count; ?></td>
                    </tr>
                     <tr class="bg">
                        <td class="first" align="left"><strong>Total Amount Collected:</strong></td>
                        <td  class="last" align="left"><?php echo $sum_paid_amt; ?></td>
                    </tr>
                     <tr>
                        <td class="first" align="left"><strong>Total Amount Due:</strong></td>
                        <td  class="last" align="left"><?php echo $sum_unpaid_amt; ?></td>
                    </tr>
                </tbody></table>

            <p class="buttons">
               
                <!-- <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_batch.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add"> -->
            </p>
        </form>