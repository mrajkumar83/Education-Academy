<div class="content-warp">
  <div class="table">
    <form method="post" name="enquiryform" id="enquiryform" action="../admin/logic/enquiry_logic.php?op=<?php echo $op;?>" enctype="multipart/form-data">
      <table cellspacing="0" cellpadding="0" class="listing form">
        <tbody>
          <tr>
            <th colspan="4" class="full">Enquiry Details</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
            <td class="last"><?php if(isset($enquiry_fname)) { echo $enquiry_fname ;}   ?></td>
            <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
            <td class="last"><?php if(isset($enquiry_lname)) { echo $enquiry_lname ;} ?></td>
          </tr>
          <tr>
            <td class="first"><strong>Phone No</strong><span class="complsory">*</span></td>
            <td class="last"><?php if(isset($enquiry_phno)) { echo $enquiry_phno; } ?></td>
            <td class="first"><strong>Email</strong><span class="complsory">*</span></td>
            <td class="last"><?php if(isset($enquiry_email)) { echo $enquiry_email; } ?></td>
          </tr>
          <tr class="bg">
            
            <td class="first"><strong>Batch</strong><span class="complsory">*</span></td>
            <td class="last">
                <?php
							
								echo $batch_rec->batch_name;
							
						?>
              </td>
              <td class="first"><strong>Course</strong><span class="complsory">*</span></td>
            <td class="last"><?php echo $course_name; ?></td>
          </tr>
          <tr>
            <td class="first"><strong>Enquiry</strong></td>
            <td colspan="3" class="last">
            	<?php if(isset($enquiry_comments)) { echo $enquiry_comments;} ?>
           </td>
          </tr>
           <tr class="bg">
            <td class="first"><strong>Enquiry Date:</strong></td>
            <td class="last" colspan="3">
            	<?php echo ((isset($enquiry_crtdate) && ($enquiry_crtdate!='' && $enquiry_crtdate!='0000-00-00'))?date("m/d/Y",strtotime($enquiry_crtdate)):''); ?>
            	</td>
          </tr>
          <tr >
            <td class="first"><strong>Enquiry Type</strong></td>
            <td colspan="3" class="last">
            	  <?php echo $enquiry_type;?>
		 
              </td>
          </tr>
          <?php
          if(isset($enquiry_call1_comments) && $enquiry_call1_comments != '') 
		  {
          ?>
           
          <tr class="bg" id="callTR1">
            <td class="first"><strong>Call1 Status</strong></td>
            <td colspan="3" class="last">
           <?php echo $call1_sts_value;?>
			</td>
          </tr>
           <tr id="callTR2">
            <td class="first"><strong>Call1 Comments</strong></td>
            <td colspan="3" class="last">
            
			<?php echo $enquiry_call1_comments;?>
            </td>
          </tr>
                    <tr class="bg" id="callTR3">
            <td class="first"><strong>Call 1 Date</strong></td>
            <td colspan="3" class="last"><?php echo ((isset($enquiry_call1_date) && ($enquiry_call1_date!='' && $enquiry_call1_date!='0000-00-00'))?date("m/d/Y",strtotime($enquiry_call1_date)):''); ?></td>
          </tr>

          <?php
		  }
		 
		  	 if(isset($enquiry_call2_comments) && $enquiry_call2_comments != '') 
		  		{?>
          <tr class="bg" >
            <td class="first"><strong>Call2 Status</strong></td>
            <td colspan="3" class="last"><?php echo $call2_sts_value; ?></td>
          </tr>
          <tr>
            <td class="first"><strong>Call 2 Comments</strong></td>
            <td colspan="3" class="last"><?php echo $enquiry_call2_comments; ?></td>
                      </tr>
          <tr class="bg">
            <td class="first"><strong>Call 2 Date</strong></td>
            <td colspan="3" class="last"><?php echo ((isset($enquiry_call2_date) && ($enquiry_call2_date!='' && $enquiry_call2_date!='0000-00-00'))?date("m/d/Y",strtotime($enquiry_call2_date)):''); ?>
            	</td>

          </tr><?php 
		  }
				?>
		 
        </tbody>
      </table>
      <p class="buttons">
        <input type="hidden" value="<?php echo $op;?>" name="op">
        <input type="hidden" value="<?php echo $id;?>" name="id">
         <input type="hidden" id="amount_pay" name="amount_pay">
        
        <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='junk_student.php'">
        &nbsp; &nbsp;
       
      </p>
    </form>
  </div>
</div>
</body></html>
