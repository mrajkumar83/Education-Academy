<div class="content-warp">
    <div class="table">
        
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Requirement</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>BD Login Id:</strong></td>
                        <td colspan="3" class="last">
                        	<?php echo $bd_login_id; ?>
                        </td>
                    </tr>
                    <tr>

                        <td class="first"><strong>Company Name:</strong><span class="complsory">*</span></td>
                        <td  class="last">
							<?php echo $bd_companyname; ?>
                        </td>
                         <td class="first"><strong>Contact Person:</strong></td>
                        <td class="last">
								<?php echo $bd_contactper; ?>
                        </td>
                    </tr>
                    <tr class="bg">
						<td class="first"><strong>Designation:</strong></td>
                        <td  class="last">
                        	<?php echo $bd_designation; ?>
                        </td>
                         <td class="first"><strong>Email Id:</strong></td>
                        <td class="last">
                          <?php echo $bd_emailid; ?>
                        </td>
                    </tr>
                     <tr>
                        <th colspan="4" class="full">Job Description</th>
                    </tr>
                     <tr class="bg">
						<td class="first"><strong>Qualification:</strong></td>
                        <td colspan="3"  class="last">
                           <?php echo $bd_qualification;?>       
                        </td>
                       
                    </tr>
                     <tr>
						<td class="first"><strong>Stream:</strong></td>
                        <td colspan="3"  class="last">
                           <?php echo $bd_stream ; ?>       
                        </td>
                       
                    </tr>
                     <tr class="bg">
						<td class="first" valign="top"><strong>Percentage Cutoff:</strong><span class="complsory">*</span></td>
                        <td colspan="3"  class="last">
                        	<?php
                        	if(isset($bd_percutoff) && $bd_percutoff == 'C')
							{
								echo ">=60% & above troughout";
							}
							if(isset($bd_percutoff) && $bd_percutoff == 'G')
							{
								echo ">=60% in Graduation";
							}
							if(isset($bd_percutoff) && $bd_percutoff == 'P')
							{
								echo "Any Percentage";
							}
							if(isset($bd_percutoff) && $bd_percutoff == 'O')
							{
								echo "Others";
							}
                        	?>
                               
                        </td>
                       
                    </tr>
                     <tr>

                        <td class="first"><strong>Year of Passing:</strong></td>
                        <td  class="last">
							<?php echo $bd_yearofpass; ?>
                        </td>
                         <td class="first"><strong>Job Title:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <?php echo $bd_jobtitle; ?>
                        </td>
                    </tr>
                     <tr class="bg">

                        <td class="first"><strong>Job Location:</strong><span class="complsory">*</span></td>
                        <td  class="last">
                            <?php echo $bd_joblocation; ?>
                        </td>
                         <td class="first"><strong>Interview Location:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <?php echo $bd_interviewloc; ?>
                        </td>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Interview Date:</strong><span class="complsory">*</span></td>
                        <td  class="last">
                            <?php echo ((isset($bd_interviewdate) && ($bd_interviewdate != '' && $bd_interviewdate != '0000-00-00')) ? date("m/d/Y", strtotime($bd_interviewdate)) : ''); ?>
                        (month/date/year)
                        </td>
                        <td class="first"><strong>Interview Time:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <?php echo $time; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Gender Preference</strong></td>
                        <td colspan="3" class="last">
                        	<?php
                        	if(isset($bd_genderpre) && $bd_genderpre == 'B')
							{
								echo "Both Male and Female";
							}
							if(isset($bd_genderpre) && $bd_genderpre == 'M')
							{
								echo "Only Male";
							}
							if(isset($bd_genderpre) && $bd_genderpre == 'F')
							{
								echo "Only Female";
							}
							?>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Any Bond:</strong></td>
                        <td colspan="3" class="last">
                        	<?php
                        	if(isset($bd_bond) && $bd_bond == 'Y')
							{
								if(isset($bd_bondyear) && $bd_bondyear != '')
								{
									echo $bd_bondyear."Year(s) Bond.";
								}
							}
							if(isset($bd_bond) && $bd_bond == 'N')
							{
								echo "No Bond";
							}
							?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="first"><strong>Any Deposit:</strong></td>
                        <td colspan="3" class="last">
                        	<?php
                        	if(isset($bd_deposit) && $bd_deposit == 'Y')
							{
								if(isset($bd_depositamnt) && $bd_depositamnt != '')
								{
									echo "Deposit amounts are ".$bd_depositamnt." Rupees";
								}
							}
							if(isset($bd_deposit) && $bd_deposit == 'N')
							{
								echo "No deposit";
							}
							?>
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Submission of certificate:</strong></td>
                        <td colspan="3" class="last">
                        	<?php
                        	if(isset($bd_subcirt) && $bd_subcirt == 'Y')
							{
								echo "Yes";
							}
							if(isset($bd_subcirt) && $bd_subcirt == 'N')
							{
								echo "No";
							}
							?>
                        </td>
                    </tr>
                    <tr  class="bg">
                        <td class="first"><strong>Ready To Relocate:</strong></td>
                        <td colspan="3" class="last">
                        	<?php
                        	if(isset($bd_relocate) && $bd_relocate == 'Y')
							{
								echo "Yes";
							}
							if(isset($bd_relocate) && $bd_relocate == 'N')
							{
								echo "No";
							}
							?>
                        </td>
                    </tr>
                    <tr >
                        <td class="first"><strong>Shift Involved:</strong></td>
                        <td colspan="3" class="last">
                        	<?php
                        	if(isset($bd_shift) && $bd_shift == 'Y')
							{
								echo "Yes";
							}
							if(isset($bd_shift) && $bd_shift == 'N')
							{
								echo "No";
							}
							?>
                        </td>
                    </tr>
                     <tr>

                        <td class="first" valign="top"><strong>Additional Comment:</strong></td>
                        <td colspan="3" class="last">
                        	<?php echo $bd_comment; ?>
                        </td>
                    </tr>
                     
                </tbody></table>

            <div class="buttons">
				<form method="post" name="jobFRM" id="jobFRM" action="../admin/search_jobstd.php" style="display:inline-block;">
					<input type="hidden" value="<?php echo isset($op) ? $op: 'A' ; ?>" name="op">
					<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
					<input type="reset" value="Back" name="Cancel" onclick="document.location.href='manage_hrjob.php'">
					&nbsp; &nbsp;&nbsp;
				   <input type="submit" value="Search" name="search">
				</form>
				<form method="post" name="ext-job" id="ext-job" action="../admin/send_mail.php" style="display:inline-block;">
				   &nbsp; &nbsp;&nbsp;
				   <input type="hidden" value="Ext" name="op">
				   <input type="hidden" value="<?php echo $id; ?>" name="job_id" id="job_id">
				   <input type="submit" value="External Students" name="send">
			   </form>
            </div>
		</div>
	</div>