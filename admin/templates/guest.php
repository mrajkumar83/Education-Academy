<div class="content-warp">
  <div class="table">
    <form method="post" name="studentForm" id="studentForm" action="./admin/logic/student_logic.php?op=<?php echo $op;?>" enctype="multipart/form-data">
      <table cellspacing="0" cellpadding="0" class="listing form">
        <tbody class="fields">
          <tr>
            <th colspan="4" class="full">Personal Details</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo $std_fname; ?>" id="std_fname" name="std_fname" class="text"></td>
            <td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo  $std_lname; ?>" id="std_lname" name="std_lname" class="text"></td>
          </tr>
          <tr>
            <td class="first"><strong>Primary E-mail</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo $std_email ?>" id="std_email" name="std_email" class="text" readonly="readonly"></td>
            <td class="first"><strong>Secondary E-mail</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_secondary_email; ?>" id="std_secondary_email" name="std_secondary_email" class="text"></td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Primary Phone No.</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo $std_phno; ?>" id="std_phno" name="std_phno" class="text" readonly="readonly"></td>
            <td class="first"><strong>Secondary Phone No.</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_sphone; ?>" id="std_sphone" name="std_sphone" class="text"></td>
          </tr>
          <tr>
            <td class="first"><strong>Branch</strong></td>
                        <td class="last" colspan="3">
                            <select name="std_branch" id="std_branch" tabindex="1">
                                <option value="">-- Select --</option>
                                <?php
                                while ($branch_rec = mysql_fetch_object($branch)) {
                                    echo '<option value="', $branch_rec->branch_id, '"', (($branch_rec->branch_id == $std_branch) ? ' selected="selected"' : ''), '>', $branch_rec->branch_name, '</option>';
                                }
                                ?>
                            </select>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Photo</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last" valign="top"><input type="file" id="std_photo" value="" name="std_photo" title="Required" style="width:85%" class="text<?php echo ((!isset($std_photo) ||(isset($std_photo) && $std_photo==''))?' required':'');?>"> 
              <?php
								if($std_photo!='')
								{			
									$img_file = 'photos/'.$std_photo;
									if(file_exists($img_file))
									{
										echo '<img src="',$img_file,'" height="50" width="50">';
									}
								}
								else
								{
									echo "Not Available";
								}?></td>
          </tr>
          <tr>
            <td class="first"><strong>Date Of Birth</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo ((isset($std_dob) && $std_dob != '' && $std_dob != '0000-00-00') ? date('m/d/Y',strtotime($std_dob)) : '' ) ?>" id="std_dob" name="std_dob" class="text"></td>
            <td class="first"><strong>Passport No.</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_passportno; ?>" id="std_passportno" name="std_passportno" class="text"></td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Home Town</strong></td>
            <td colspan="3" class="last"><input type="text" value="<?php echo $std_hometown; ?>" id="std_hometown" name="std_hometown" class="text"></td>
          </tr>
          <tr>
            <th colspan="4" class="full">Education Qualification</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Qualification</strong></td>
            <td class="last"><strong>Year Of Passing</strong></td>
            <td class="first"><strong>Education Board</strong></td>
            <td class="last"><strong>Percentage</strong></td>
          </tr>
          <tr>
            <td class="first"><strong>10th Standard:</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo $std_ssc_year; ?>" id="std_ssc_year" name="std_ssc_year" class="text" style="width: 100px;" ></td>
            <td class="first"><input type="text" value="<?php echo $std_ssc_board?>" ;id="std_ssc_board" name="std_ssc_board" class="text" style="width: 100px;" ></td>
            <td class="last"><input type="text" value="<?php echo $std_ssc_percentage; ?>" id="std_ssc_percentage" name="std_ssc_percentage" class="text" style="width: 100px;">&#37;</td>
          </tr>		  
          <tr class="bg">
            <td class="first"><strong>12th</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_ipe_year; ?>" id="std_ipe_year" name="std_ipe_year" class="text" style="width: 100px;" ></td>
            <td class="first"><input type="text" value="<?php echo $std_ipe_board; ?>" id="std_ipe_board" name="std_ipe_board" class="text" style="width: 100px;" ></td>
            <td class="last"><input type="text" value="<?php echo $std_ipe_percentage ?>" id="std_ipe_percentage" name="std_ipe_percentage" class="text" style="width: 100px;">&#37;</td>
          </tr>
          <tr>
            <td class="first"><strong>Diploma Education</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_diploma_year; ?>" id="std_diploma_year" name="std_diploma_year" class="text" style="width: 100px;" ></td>
            <td class="first"><input type="text" value="<?php echo $std_diploma_board; ?>" id="std_diploma_board" name="std_diploma_board" class="text" style="width: 100px;" ></td>
            <td class="last"><input type="text" value="<?php echo $std_diploma_percentage ?>" id="std_diploma_percentage" name="std_diploma_percentage" class="text" style="width: 100px;">&#37;</td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Graduation</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php if(isset($std_graduation_year)){ echo $std_graduation_year;} ?>" id="std_graduation_year" name="std_graduation_year" class="text" style="width: 100px;" ></td>
            <td class="first"><input type="text" value="<?php if(isset($std_graduation_board)){ echo $std_graduation_board;} ?>" id="std_graduation_board" name="std_graduation_board" class="text" style="width: 100px;" ></td>
            <td class="last"><input type="text" value="<?php if(isset($std_graduation_percentage)){ echo $std_graduation_percentage;} ?>" id="std_graduation_percentage" name="std_graduation_percentage" class="text" style="width: 100px;">&#37;</td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Graduation College Name</strong><span class="complsory">*</span></td>
           <td class="last" colspan="3">
            	
                            <select name="std_graduation_college" id="std_graduation_college" required="required">
                                <option value="">-- Select --</option>
                                <?php
                                if(isset($college) && $college != '')
								{
                                while ($college_rec = mysql_fetch_object($college)) {
                                    echo '<option id="C" onclick="change_otherCol(this.value)" value="', $college_rec->college_id, '"', (($college_rec->college_id == $std_graduation_college) ? ' selected="selected"' : ''), '>', $college_rec->college_name, '</option>';
                                }
                                ?>
                                 <option value="">----------------------------------------------------------------</option>
                               <option value="OT" id="OT" onclick="change_otherGCol(this.value)" <?php echo (( $std_graduation_college == 'OT') ? ' selected="selected"' : '') ?>>Other</option>
                            <?php
								}
								?>
                            </select>
                        
            	</td>
          </tr>
		  
          <tr id="OthGrColl" style="display: <?php echo ( (isset($std_graduation_college) && $std_graduation_college == 'OT')  ? ' ' : 'none');?>">
          <td class="first" valign="top"><strong>College Name</strong><span class="complsory">*</span></td>
          <td class="last" colspan="3"><input type="text" name="std_graduation_other" id="std_graduation_other" value="<?php echo $std_graduation_other ?>">
          	</td>
        </tr>
		
		<tr class="bg">
            <td class="first"><strong>Graduation Branch</strong><span class="complsory">*</span></td>
           <td class="last" colspan="3">            	
                            <select name="std_graduation_branch" id="std_graduation_branch"  tabindex="1">
                                <option value="">-- Select --</option>                               
							   <?php
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Electronics"', ((isset($std_graduation_branch) && $std_graduation_branch == "Electronics") ? ' selected="selected"' : ''), '>Electronics</option>';
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Computer Science"', ((isset($std_graduation_branch) && $std_graduation_branch == "Computer Science") ? ' selected="selected"' : ''), '>Computer Science</option>';
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Information science"', ((isset($std_graduation_branch) && $std_graduation_branch == "Information science") ? ' selected="selected"' : ''), '>Information science</option>';
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Telecom"', ((isset($std_graduation_branch) && $std_graduation_branch == "Telecom") ? ' selected="selected"' : ''), '>Telecom</option>';
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Electrical"', ((isset($std_graduation_branch) && $std_graduation_branch == "Electrical") ? ' selected="selected"' : ''), '>Electrical</option>';
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Mechanical"', ((isset($std_graduation_branch) && $std_graduation_branch == "Mechanical") ? ' selected="selected"' : ''), '>Mechanical</option>';
								echo '<option id="C" onclick="change_otherBranch(this.value)" value="Civil"', ((isset($std_graduation_branch) && $std_graduation_branch == "Civil") ? ' selected="selected"' : ''), '>Civil</option>';
								echo ' <option value="">----------------------------------------------------------------</option>';
								echo '<option value="OTB" id="OTB" onclick="change_otherBranch(this.value)"', ((isset($std_graduation_branch) && $std_graduation_branch == "OTB") ? ' selected="selected"' : ''), '>Other</option>';
							  ?>                             
                            </select>                        
            	</td>
          </tr>
		  
          <tr id="OthGrBranch" style="display: <?php echo ( (isset($std_graduation_branch) && $std_graduation_branch == 'OTB')  ? ' ' : 'none');?>">
          <td class="first" valign="top"><strong>Branch Name</strong><span class="complsory">*</span></td>
          <td class="last" colspan="3"><input type="text" name="std_grbranch_other" id="std_grbranch_other" value="<?php echo $std_grbranch_other ?>"></td>
		  </tr>
		
          <tr>
            <td class="first"><strong>Post Graduation</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_postgraduation_year; ?>" id="std_postgraduation_year" name="std_postgraduation_year" class="text" style="width: 100px;" ></td>
            <td class="first"><input type="text" value="<?php echo $std_postgraduation_board; ?>" id="std_postgraduation_board" name="std_postgraduation_board" class="text" style="width: 100px;" ></td>
            <td class="last"><input type="text" value="<?php echo $std_postgraduate_pecentage; ?>" id="std_postgraduate_pecentage" name="std_postgraduate_pecentage" class="text" style="width: 100px;">&#37;</td>
          </tr>
          <tr>
            <td class="first"><strong>Post Graduation College Name</strong></td>
            <td class="last" colspan="3">
            	
                            <select name="std_postgraduation_college" id="std_postgraduation_college">
                                <option value="">-- Select --</option>
                                <?php
                                 if(isset($college1) && $college1 != '')
								{
                                while ($college_rec1 = mysql_fetch_object($college1)) {
                                    echo '<option id="C" onclick="change_otherCol(this.value)" value="', $college_rec1->college_id, '"', (($college_rec1->college_id == $std_postgraduation_college) ? ' selected="selected"' : ''), '>', $college_rec1->college_name, '</option>';
                                }
                                ?>
                               <option value="">----------------------------------------------------------------</option>
                               <option value="OT" id="OT" onclick="change_otherCol(this.value)" <?php echo (( $std_postgraduation_college == 'OT') ? ' selected="selected"' : '') ?>>Other</option>
                           <?php
								}
								?>
                            </select>
                        
            	</td>
            
          </tr>
          <tr id="OthPGrColl" style="display: <?php echo ( (isset($std_postgraduation_college) && $std_postgraduation_college == 'OT')  ? ' ' : 'none');?>">
          <td class="first" valign="top"><strong>College Name</strong><span class="complsory">*</span></td>
          <td class="last" colspan="3"><input type="text" name="std_postgraduation_other" id="std_postgraduation_other" value="<?php echo $std_postgraduation_other ?>">
          	</td>
        </tr>
		<tr>
            <td class="first"><strong>Post Graduation Branch</strong></td>
           <td class="last" colspan="3">
            	
                            <select name="std_postgraduation_branch" id="std_postgraduation_branch">
                                <option value="">-- Select --</option>
                               
							   <?php
							    echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Electronics"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Electronics") ? ' selected="selected"' : ''), '>Electronics</option>';
								 echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Computer Science"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Computer Science") ? ' selected="selected"' : ''), '>Computer Science</option>';
								  echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Information science"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Information science") ? ' selected="selected"' : ''), '>Information science</option>';
								  echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Telecom"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Telecom") ? ' selected="selected"' : ''), '>Telecom</option>';
								  echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Electrical"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Electrical") ? ' selected="selected"' : ''), '>Electrical</option>';
								   echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Mechanical"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Mechanical") ? ' selected="selected"' : ''), '>Mechanical</option>';
								    echo '<option id="C" onclick="change_otherPoBranch(this.value)" value="Civil"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "Civil") ? ' selected="selected"' : ''), '>Civil</option>';
                                echo ' <option value="">----------------------------------------------------------------</option>';
								  echo '<option value="OTB" id="OTB" onclick="change_otherPoBranch(this.value)"', ((isset($std_postgraduation_branch) && $std_postgraduation_branch == "OTB") ? ' selected="selected"' : ''), '>Other</option>';
								  ?>
                              
                            </select>
                        
            	</td>
          </tr>
          <tr id="OthPGrBranch" style="display: <?php echo ( (isset($std_postgraduation_branch) && $std_postgraduation_branch == 'OTB')  ? ' ' : 'none');?>">
          <td class="first" valign="top"><strong>Branch Name</strong></td>
          <td class="last" colspan="3"><input type="text" name="std_ptgrbranch_other" id="std_ptgrbranch_other" value="<?php echo $std_ptgrbranch_other ?>"></td>
        </tr>
          <tr>
            <th colspan="4" class="full">Academic Project Details</th>
          </tr>
          <tr>
            <td class="first"><strong>Topic Name</strong></td>
            <td class="last"><input type="text" value="<?php echo $std_project_name; ?>" id="std_project_name" name="std_project_name" class="text"></td>
            <td class="first"><strong>Duration</strong></td>
            <td class="last"><input type="text" value="<?php echo  $std_project_duration; ?>" id="std_project_duration" name="std_project_duration" class="text"></td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Team</strong></td>
            <td colspan="3" class="last"><input type="radio" class="textarea" name="std_team" value="G"<?php echo (($std_team== 'G'|| $std_team == '') ? ' checked' : '');?>>
              &nbsp;Group&nbsp;&nbsp;
              <input type="radio" class="textarea" name="std_team" value="S"<?php echo ($std_team== 'S' ? ' checked' : '');?>>
              &nbsp;Single Member&nbsp; </td>
          </tr>
          <tr>
            <td class="first" valign="top"><strong>SYNOPSIS</strong></td>
            <td class="last" colspan="3"><textarea style="height:100px;width:300px;" name="std_project_description" id="std_project_description"><?php echo $std_project_description; ?></textarea></td>
          </tr>
          <tr>
            <th colspan="4" class="full">Job Particular</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Ready To Sign Bond</strong><span class="complsory">*</span></td>
            <td class="last"><input type="radio" class="textarea" id="std_contract" name="std_contract" onclick="change_bond(this.value)" value="Y" <?php echo (($std_contract== 'Y') ? ' checked' : '');?>>
              &nbsp;Yes&nbsp;&nbsp;
              <input type="radio" class="textarea" name="std_contract" onclick="change_bond(this.value)" value="N" <?php echo (($std_contract== 'N'|| $std_contract == '') ? ' checked' : '');?>>
              &nbsp;No&nbsp; </td>
            <td class="first"><strong>Ready To Relocate</strong><span class="complsory">*</span></td>
            <td class="last"><input type="radio" class="textarea" id="std_relocate"  name="std_relocate" value="Y" <?php echo ($std_relocate== 'Y' ? ' checked' : '');?>>
              &nbsp;Yes&nbsp;&nbsp;
              <input type="radio" class="textarea" id="std_relocate" name="std_relocate" value="N" <?php echo ($std_relocate== 'N' ? ' checked' : '');?>>
              &nbsp;No&nbsp; </td>
          </tr>
          <tr id="bondTR" style="display:<?php echo ((isset($std_contract) && $std_contract=='Y')?'':'none');?>;">
            <td class="first" colspan="4"><select name="bond_duration" id="bond_duration">
                <option value="1" <?php echo ((isset($bond_duration) && $bond_duration==1)?'selected="selected"':'');?>>1 Year</option>
                <option value="2" <?php echo ((isset($bond_duration) && $bond_duration==2)?'selected="selected"':'');?>>2 Year</option>
                <option value="3" <?php echo ((isset($bond_duration) && $bond_duration==3)?'selected="selected"':'');?>>3 Year</option>
              </select></td>
          </tr>
          <tr>
            <td class="first" colspan="2"><strong>DO YOU ALREADY HAVE ANY JOB OFFERS?</strong><span class="complsory">*</span></td>
            <td colspan="2" class="last"><input type="radio" class="textarea" onclick="change_job(this.value)" id="std_job_offers" name="std_job_offers" value="Y"<?php echo (($std_job_offers== 'Y'|| $std_job_offers == '') ? ' checked' : '');?>>
              &nbsp;Yes&nbsp;&nbsp;
              <input type="radio" class="textarea" name="std_job_offers" id="std_job_offers" onclick="change_job(this.value)" value="N"<?php echo ($std_job_offers== 'N' ? ' checked' : '');?>>
              &nbsp;No&nbsp; </td>
          </tr>
          <tr class="bg" id="jobTR1" style="display:<?php echo ((isset($std_job_offers) && $std_job_offers=='Y')?'':'none');?>;">
            <td class="first"><strong>Company Name</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo $std_company_name; ?>" id="std_company_name" name="std_company_name" class="text"></td>
            <td class="first"><strong>Salary Offered</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo  $std_salary; ?>" id="std_salary" name="std_salary" class="text"></td>
          </tr>
          <tr id="jobTR2" style="display:<?php echo ((isset($std_job_offers) && $std_job_offers=='Y')?'':'none');?>;">
            <td class="first"><strong>Date Of Joining</strong><span class="complsory">*</span></td>
            <td class="last" colspan="3"><input type="text" value="<?php echo ((isset($std_job_jdate) && $std_job_jdate != '' && $std_job_jdate != '0000-00-00') ? date('m/d/y',strtotime($std_job_jdate)) : '' ) ?>" id="std_job_jdate" name="std_job_jdate" class="text"></td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Resume</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last"><input type="file" id="std_resume" value="" title="Required" name="std_resume" class="text<?php echo ((!isset($std_resume) ||(isset($std_resume) && $std_resume==''))?' required':'');?>">
              <a href="./downloadfile.php?path=resumes&amp;&amp;filename=<?php echo $std_resume;?>"><?php echo $std_resume;?></a></td>
          </tr>
          <tr class="bg">
            <th colspan="4" class="full">Skill Set</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Skills</strong></td>
            <td colspan="3" class="last">
                <?php
                    if($skill_cnt > 0){
                       $j = 0;
                     while ($skill = mysql_fetch_object($skill_rec)) {
                        echo '<div><input type="checkbox" value="',$skill->skill_id,'" id="skill_',$skill->skill_id,'" name="skills[]" ',((isset($std_skills) && is_array($std_skills) && in_array($skill->skill_id, $std_skills))?'checked="checked"':'') ,' >';
                        echo '&nbsp;&nbsp;&nbsp;<label for="skill_',$skill->skill_id,'">',$skill->skill_name,'</label></div>';
                     }
                    }
                ?>
                  
            </td>
          </tr>
          <tr>
            <th colspan="4" class="full">Other Course Details </th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Other Course Completed</strong></td>
            <td colspan="3" class="last"><input type="radio" class="textarea" name="std_other_course"  value="Y" onclick="change_etype(this.value)" <?php echo (($std_other_course== 'Y') ? ' checked' : '');?>>
              &nbsp;Yes&nbsp;&nbsp;
              <input type="radio" class="textarea" name="std_other_course" value="N" onclick="change_etype(this.value)" <?php echo (($std_other_course== 'N' || $std_other_course == '') ? ' checked' : '' );?>>
              &nbsp;No&nbsp; </td>
          </tr>
          <tr id="othCou" style="display:<?php echo ( (isset($std_other_course) && $std_other_course == 'Y')  ? ' ' : 'none');?>">
            <td class="first"><strong>Certification Name</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="<?php echo $std_cirt_name; ?>" id="std_cirt_name" name="std_cirt_name" class="text"></td>
            <td class="first"><strong>Have You Got Certificate?</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last"><input type="radio" class="textarea" id="std_got_cirt" name="std_got_cirt" value="Y"<?php echo (($std_got_cirt== 'Y'|| $std_got_cirt == '') ? ' checked' : '');?>>
              &nbsp;Yes&nbsp;&nbsp;
              <input type="radio" class="textarea" name="std_got_cirt" value="N"<?php echo ($std_got_cirt== 'N' ? ' checked' : '');?>>
              &nbsp;No&nbsp; </td>
          </tr>
        <th colspan="4" class="full">Year Gaps </th>
        </tr>
        <tr class="bg">
          <td class="first"><strong>Gap In Academics</strong></td>
          <td colspan="3" class="last"><input type="radio" class="textarea" name="std_academic_gap"  value="Y" onclick="change_acaGap(this.value)" <?php echo (($std_academic_gap== 'Y') ? ' checked' : '');?>>
            &nbsp;Yes&nbsp;&nbsp;
            <input type="radio" class="textarea" name="std_academic_gap" value="N" onclick="change_acaGap(this.value)" <?php echo (($std_academic_gap== 'N' || $std_academic_gap == '') ? ' checked' : '' );?>>
            &nbsp;No&nbsp; </td>
        </tr>
        <tr id="acadGap" style="display: <?php echo ( (isset($std_academic_gap) && $std_academic_gap == 'Y')  ? ' ' : 'none');?>">
          <td class="first" valign="top"><strong>Reason</strong><span class="complsory">*</span></td>
          <td class="last" colspan="3"><textarea style="height:100px;width:300px;" name="std_aca_gap_reason" id="std_aca_gap_reason" ><?php echo $std_aca_gap_reason; ?></textarea></td>
        </tr>
        <tr class="bg">
          <td class="first"><strong>Gap After Graduation</strong></td>
          <td colspan="3" class="last"><input type="radio" class="textarea" name="std_graduation_gap"  value="Y" onclick="change_graGap(this.value)" <?php echo (($std_graduation_gap== 'Y') ? ' checked' : '');?>>
            &nbsp;Yes&nbsp;&nbsp;
            <input type="radio" class="textarea" name="std_graduation_gap" value="N" onclick="change_graGap(this.value)" <?php echo (($std_graduation_gap== 'N' || $std_graduation_gap == '') ? ' checked' : '' );?>>
            &nbsp;No&nbsp; </td>
        </tr>
        <tr id="graGap" style="display: <?php echo ( (isset($std_graduation_gap) && $std_graduation_gap == 'Y')  ? ' ' : 'none');?>">
          <td class="first" valign="top"><strong>Reason</strong><span class="complsory">*</span></td>
          <td class="last" colspan="3"><textarea style="height:100px;width:300px;" name="std_gra_gap_reason" id="std_gra_gap_reason"><?php echo $std_gra_gap_reason; ?></textarea></td>
        </tr>
        <?php
        if(isset($UTYPE) && ($UTYPE == 'SA' || $UTYPE == 'AD'))
		{
			?>
			  <tr class="bg">
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="user_status" value="A"<?php echo (($user_status == 'A' || $user_status == '') ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp;
                            <input type="radio" class="textarea" name="user_status" value="D"<?php echo ($user_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
              </tr>
              <?php
		}
         ?>
      
        </tbody>
        
      </table>
      <p class="buttons">
        <?php
		   if(isset($pagefrom) && $pagefrom == 'profile')
			{
				echo '<input name="user_status" id="user_status" type="hidden" value="A">';
			}
			?>
			
        <input name="utype" id="utype" type="hidden" value="<?php echo $utype;?>">
        <input name="id" id="id" type="hidden" value="<?php echo $id;?>">
        <input name="pagefrom" id="pagefrom" type="hidden" value="<?php echo $pagefrom;?>">
        <input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='./index.php';">
        &nbsp; &nbsp;
        <input name="AddNew" type="submit" value="Submit" class="login gradient" />
      </p>
    </form>
  </div>
</div>
</body></html><script>
	function change_etype(val)
{
	if(val=="N")
	{
		document.getElementById('othCou').style.display ='none';
		
	}
	else if(val=="Y")
	{
		document.getElementById('othCou').style.display ='';
		
	}

}
function change_graGap(val)
{
	if(val=="N")
	{
		document.getElementById('graGap').style.display ='none';
		
	}
	else if(val=="Y")
	{
		document.getElementById('graGap').style.display ='';
		
	}

}
function change_otherCol(val)
{
	
	if(val=="OT")
	{
		
		document.getElementById('OthPGrColl').style.display ='';
		
	}
	else if(val=="C")
	{
		
		document.getElementById('OthPGrColl').style.display ='none';
	}

}
function change_otherGCol(val)
{
	
	if(val=="OT")
	{
		
		document.getElementById('OthGrColl').style.display ='';
		
	}
	else if(val=="C")
	{
		
		document.getElementById('OthGrColl').style.display ='none';
	}

}
function change_acaGap(val)
{
	if(val=="N")
	{
		document.getElementById('acadGap').style.display ='none';
		
	}
	else if(val=="Y")
	{
		document.getElementById('acadGap').style.display ='';
		
	}

}
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
function change_job(val)
{
	if(val=="N")
	{
		document.getElementById('jobTR1').style.display ='none';
		document.getElementById('jobTR2').style.display ='none';
		
	}
	else if(val=="Y")
	{
		document.getElementById('jobTR1').style.display ='';
		document.getElementById('jobTR2').style.display ='';
		
	}

}
</script>