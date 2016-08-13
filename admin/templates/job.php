<div class="content-warp">
    <div class="table">
        <form method="post" name="jobFRM" id="jobFRM" action="../admin/logic/job_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Requirement</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>BD Login Id:</strong></td>
                        <td colspan="3" class="last">
                            <input type="text" class="text" readonly="readonly" name="bd_login_id" id="bd_login_id" value="<?php echo $bd_login_id; ?>">
                        </td>
                         </tr>
                        <?php
                        if(isset($UTYPE) && $UTYPE == 'SA')
						{
                        ?>
                        <tr class="bg">
                        <td class="first"><strong>Branch</strong><span class="complsory">*</span></td>
                        <td class="last" colspan="3">
                            <select name="bd_branch" id="bd_branch" required="required" tabindex="1">
                                <option value="">-- Select --</option>
                                <?php
                                while ($branch_rec = mysql_fetch_object($branch)) {
                                    echo '<option value="', $branch_rec->branch_id, '"', (($branch_rec->branch_id == $bd_branch) ? ' selected="selected"' : ''), '>', $branch_rec->branch_name, '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        </tr>
                        <?php
						}
						?>
                   
                    <tr>

                        <td class="first"><strong>Company Name:</strong><span class="complsory">*</span></td>
                        <td  class="last">
                            <input type="text" class="text" name="bd_companyname" id="bd_companyname" value="<?php echo $bd_companyname; ?>">
                        </td>
                         <td class="first"><strong>Contact Person:</strong></td>
                        <td class="last">
                            <input type="text" class="text" name="bd_contactper" id="bd_contactper" value="<?php echo $bd_contactper; ?>">
                        </td>
                    </tr>
                    <tr class="bg">
						<td class="first"><strong>Designation:</strong></td>
                        <td  class="last">
                            <input type="text" class="text" name="bd_designation" id="bd_designation" value="<?php echo $bd_designation; ?>">
                        </td>
                         <td class="first"><strong>Email Id:</strong></td>
                        <td class="last">
                            <input type="text" class="text" name="bd_emailid" id="bd_emailid" value="<?php echo $bd_emailid; ?>">
                        </td>
                    </tr>
                     <tr>
                        <th colspan="4" class="full">Job Description</th>
                    </tr>
                     <tr class="bg">
						<td class="first"><strong>Qualification:</strong></td>
                        <td colspan="3"  class="last">
                            <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="BE" <?php echo ((isset($qualification) && is_array($qualification) && in_array("BE",$qualification))?'checked="checked"':'');?>>
                           BE&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="BTech" <?php echo ((isset($qualification) && is_array($qualification) && in_array("BTech",$qualification))?'checked="checked"':'');?>>
                            Btech&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="ME" <?php echo ((isset($qualification) && is_array($qualification) && in_array("ME",$qualification))?'checked="checked"':'');?>>
                            ME&nbsp;&nbsp;
                        <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="MTech" <?php echo ((isset($qualification) && is_array($qualification) && in_array("MTech",$qualification))?'checked="checked"':'');?>>
                            Mtech&nbsp;&nbsp;
                        <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="BCA" <?php echo ((isset($qualification) && is_array($qualification) && in_array("BCA",$qualification))?'checked="checked"':'');?>>
                            BCA&nbsp;&nbsp;
                        <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="MCA" <?php echo ((isset($qualification) && is_array($qualification) && in_array("MCA",$qualification))?'checked="checked"':'');?>>
                            MCA&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="BSc" <?php echo ((isset($qualification) && is_array($qualification) && in_array("BSc",$qualification))?'checked="checked"':'');?>>
                            BSc&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_qual[]" id="job_qual" value="MSc" <?php echo ((isset($qualification) && is_array($qualification) && in_array("MSc",$qualification))?'checked="checked"':'');?>>
                            MSc&nbsp;&nbsp;        
                        </td>
                       
                    </tr>
                     <tr>
						<td class="first"><strong>Stream:</strong></td>
                        <td colspan="3"  class="last">
                            <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="CS" <?php echo ((isset($stream) && is_array($stream) && in_array("CS",$stream))?'checked="checked"':'');?>>
                           CS&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="ECE" <?php echo ((isset($stream) && is_array($stream) && in_array("ECE",$stream))?'checked="checked"':'');?>>
                           ECE&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="EEE" <?php echo ((isset($stream) && is_array($stream) && in_array("EEE",$stream))?'checked="checked"':'');?>>
                            EEE&nbsp;&nbsp;
                        <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="IT" <?php echo ((isset($stream) && is_array($stream) && in_array("IT",$stream))?'checked="checked"':'');?>>
                            IT&nbsp;&nbsp;
                        <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="IS" <?php echo ((isset($stream) && is_array($stream) && in_array("IS",$stream))?'checked="checked"':'');?>>
                            IS&nbsp;&nbsp;
                        <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="TC" <?php echo ((isset($stream) && is_array($stream) && in_array("TC",$stream))?'checked="checked"':'');?>>
                            TC&nbsp;&nbsp;
                            <input type="checkbox" class="text" name="job_stream[]" id="job_stream" value="ME" <?php echo ((isset($stream) && is_array($stream) && in_array("ME",$stream))?'checked="checked"':'');?>>
                            ME&nbsp;&nbsp;        
                        </td>
                       
                    </tr>
                     <tr class="bg">
						<td class="first" valign="top"><strong>Percentage Cutoff:</strong><span class="complsory">*</span></td>
                        <td colspan="3"  class="last">
                            <input type="radio" class="text" name="bd_percutoff" id="bd_percutoff" value="C"<?php echo ($bd_percutoff == 'C' ? ' checked' : ''); ?>>
                           >=60% & above troughout<br />
                              <input type="radio" class="text" name="bd_percutoff" id="bd_percutoff" value="G"<?php echo ($bd_percutoff == 'G' ? ' checked' : ''); ?>>
                           >=60% in Graduation<br />
                             <input type="radio" class="text" name="bd_percutoff" id="bd_percutoff" value="P"<?php echo ($bd_percutoff == 'P' ? ' checked' : ''); ?>>
                           Any Percentage<br />
                             <input type="radio" class="text" name="bd_percutoff" id="bd_percutoff" value="O"<?php echo ($bd_percutoff == 'O' ? ' checked' : ''); ?>>
                           Others     
                        </td>
                       
                    </tr>
                     <tr>

                        <td class="first"><strong>Year of Passing:</strong></td>
                        <td  class="last">
                            <input type="text" class="text" name="bd_yearofpass" id="bd_yearofpass" value="<?php echo $bd_yearofpass; ?>">
                        </td>
                         <td class="first"><strong>Job Title:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text" class="text" name="bd_jobtitle" id="bd_jobtitle" value="<?php echo $bd_jobtitle; ?>">
                        </td>
                    </tr>
                     <tr class="bg">

                        <td class="first"><strong>Job Location:</strong><span class="complsory">*</span></td>
                        <td  class="last">
                            <input type="text" class="text" name="bd_joblocation" id="bd_joblocation" value="<?php echo $bd_joblocation; ?>">
                        </td>
                         <td class="first"><strong>Interview Location:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text" class="text" name="bd_interviewloc" id="bd_interviewloc" value="<?php echo $bd_interviewloc; ?>">
                        </td>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Interview Date:</strong><span class="complsory">*</span></td>
                        <td  class="last" >
                            <input type="text" class="text" name="bd_interviewdate" id="bd_interviewdate" value="<?php echo ((isset($bd_interviewdate) && ($bd_interviewdate != '' && $bd_interviewdate != '0000-00-00')) ? date("m/d/Y", strtotime($bd_interviewdate)) : ''); ?>">
                        </td>
                          <td class="first"><strong>Inerview  Time:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <select name="hr" id="hr">
                                <option value="">Hr</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    if ($i < 10) {
                                        $k = "0" . $i;
                                    } else {
                                        $k = $i;
                                    }
                                    echo '<option value="', $k, '"' . (($hr == $i) ? ' selected="selected"' : '') . '>', $k, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                            <select name="min" id="min">
                                <option value="">Min</option>
                                <?php
                                for ($i = 0; $i <= 59; $i++) {
                                    if ($i < 10) {
                                        $k = "0" . $i;
                                    } else {
                                        $k = $i;
                                    }
                                    echo '<option value="', $k, '"' . (($min == $k) ? ' selected="selected"' : '') . '>', $k, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                            <select name="ampm" id="ampm">
                                <option value="">AM/PM</option>
                                <?php
                                echo '<option value="A"' . (($ampm == 'A') ? ' selected="selected"' : '') . '>AM</option>';
                                echo '<option value="P"' . (($ampm == 'P') ? ' selected="selected"' : '') . '>PM</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Gender Preference</strong></td>
                        <td colspan="3" class="last">
                          <input type="radio" class="textarea" name="bd_genderpre" value="B"<?php echo ($bd_genderpre == 'B' ? ' checked' : ''); ?>>&nbsp;Both&nbsp;&nbsp;
                          <input type="radio" class="textarea" name="bd_genderpre" value="M"<?php echo ($bd_genderpre == 'M' ? ' checked' : ''); ?>>&nbsp;Male&nbsp;
                          <input type="radio" class="textarea" name="bd_genderpre" value="F"<?php echo ($bd_genderpre == 'F' ? ' checked' : ''); ?>>&nbsp;Female&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Any Bond:</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="bd_bond" onclick="change_bond(this.value)" value="Y"<?php echo ($bd_bond == 'Y' ? ' checked' : ''); ?>>&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="bd_bond" onclick="change_bond(this.value)" value="N"<?php echo ($bd_bond == 'N' ? ' checked' : ''); ?>>&nbsp;No&nbsp;
                        </td>
                    </tr>
                    <tr id="bondTR" style="display:<?php echo ((isset($bd_bond) && $bd_bond=='Y')?'':'none');?>;">
			            <td class="first" colspan="4"><select name="bd_bondyear" id="bd_bondyear">
			                <option value="1" <?php echo ((isset($bd_bondyear) && $bd_bondyear==1)?'selected="selected"':'');?>>1 Year</option>
			                <option value="2" <?php echo ((isset($bd_bondyear) && $bd_bondyear==2)?'selected="selected"':'');?>>2 Year</option>
			                <option value="3" <?php echo ((isset($bd_bondyear) && $bd_bondyear==3)?'selected="selected"':'');?>>3 Year</option>
			              </select></td>
          			</tr>
                    <tr>
                        <td class="first"><strong>Any Deposit:</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="bd_deposit" onclick="deposit_amount(this.value)" value="Y"<?php echo ($bd_deposit == 'Y' ? ' checked' : ''); ?>>&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="bd_deposit" onclick="deposit_amount(this.value)" value="N"<?php echo ($bd_deposit == 'N' ? ' checked' : ''); ?>>&nbsp;No&nbsp;
                        </td>
                    </tr>
                    <tr id="bondTR1" style="display:<?php echo ((isset($bd_deposit) && $bd_deposit=='Y')?'':'none');?>;">
                    	<td class="first"><strong>Amount:</strong></td>
			            <td class="first" colspan="4">
			            	<input type="text" class="text" name="bd_depositamnt" id="bd_depositamnt" value="<?php echo $bd_depositamnt; ?>">
			            </td>
          			</tr>
                    <tr class="bg">
                        <td class="first"><strong>Ready to Relocate:</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="bd_relocate"" value="Y"<?php echo ($bd_relocate == 'Y' ? ' checked' : ''); ?>>&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="bd_relocate" value="N"<?php echo ($bd_relocate == 'N' ? ' checked' : ''); ?>>&nbsp;No&nbsp;
                        </td>
                    </tr>
                    <tr >
                        <td class="first"><strong>Submission of certificate:</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="bd_subcirt" value="Y"<?php echo ($bd_subcirt == 'Y' ? ' checked' : ''); ?>>&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="bd_subcirt" value="N"<?php echo ($bd_subcirt == 'N' ? ' checked' : ''); ?>>&nbsp;No&nbsp;
                        </td>
                    </tr>
                    <tr class="bg">
                        <td class="first"><strong>Shift Involved:</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="bd_shift" value="Y"<?php echo ($bd_shift == 'Y' ? ' checked' : ''); ?>>&nbsp;Yes&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="bd_shift" value="N"<?php echo ($bd_shift == 'N' ? ' checked' : ''); ?>>&nbsp;No&nbsp;
                        </td>
                    </tr>
                     <tr>

                        <td class="first" valign="top"><strong>Additional Comment:</strong></td>
                        <td colspan="3" class="last">
                            <textarea name="bd_comment" id="bd_comment" style="height: 80px; width: 400px; resize: none;"><?php echo $bd_comment; ?></textarea>
                        </td>
                    </tr>
                     <tr class="bg">
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="bd_status" value="A"<?php echo ($bd_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="bd_status" value="D"<?php echo ($bd_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_job.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>
        

<script>
	function change_bond(val)
{
	if(val=="N")
	{
		document.getElementById('bondTR').style.display ='none';
		
	}
	else if(val=="Y")
	{
		document.getElementById('bondTR').style.display ='';
		
	}

}
function deposit_amount(val)
{
	if(val=="N")
	{
		document.getElementById('bondTR1').style.display ='none';
		
	}
	else if(val=="Y")
	{
		document.getElementById('bondTR1').style.display ='';
		
	}

}
</script>