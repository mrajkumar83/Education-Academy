<div class="content-warp">
    <div class="table">
    	<div style="margin-left: 20px">
    		 <form method="post" name="batchForn" id="batchForn" action="branch_wise_summ.php?id=<?php echo $id; ?>">
       
            <table cellspacing="0" cellpadding="0" class="listing form" style="margin-top: 20px;">
                <tbody>
                    <tr>
                        <th colspan="4" class="full"><?php echo $heading; ?></th>
                    </tr>
                   
                    <tr class="bg">
                        <td class="first" style="width: 300px"><strong>Date:</strong></td>
                        <td  class="last">
                        	<?php echo date("d-m-Y")  ?> 
                       </td>
                    </tr>
                    
					<tr>
                        <td class="first"><strong>Branch Name:</strong></td>
                        <td  class="last">
                        	<?php echo $branchname;  ?> 
                       </td>
                    </tr>
					
                    <tr class="bg">
                        <td class="first"><strong>Total Batches:</strong></td>
                        <td  class="last">
                        	<?php echo $batch_count;  ?> 
                       </td>
                    </tr>
					
                     <tr>
                        <td class="first"><strong>Total Students:</strong></td>
                        <td  class="last">
                        	<?php echo $student_count;  ?> 
                       </td>
                    </tr>
                     <tr class="bg">

                        <td class="first"><strong>Total Amount Collected:</strong></td>
                        <td  class="last">
                        	<?php echo $sum_paid_amt;  ?> 
                       </td>
                    </tr>
                     <tr>

                        <td class="first"><strong>Total Amount Due:</strong></td>
                        <td  class="last">
                        	<?php echo $sum_unpaid_amt; ?> 
                       </td>
                    </tr>
                </tbody></table>
        </form>