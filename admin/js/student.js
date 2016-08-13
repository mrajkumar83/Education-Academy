
jQuery(document).ready(function($){
	$("#studentForm").validate({
		rules: {
			std_fname:{
				required : true
			},
			std_lname:{
				required : true
			},
			std_email1:{
				required : true,
				email:true,
					remote: {
							url: "./logic/validate.php",
							type: "post",
							data: {
									id: function() {
										return $( "#id" ).val();
									}
								}
						}
			},
			std_secondary_email:{	
				email:true
			},
			std_phno:{
				required : true,
				digits : true
			},
			// std_photo:{
				// required : true
		    // },
		    std_dob:{
				required : true
			},
			std_ssc_year:{
				required : true
			},
			std_ssc_board:{
				required : true
			},
			std_ssc_percentage:{
				required : true
			},
			std_graduation_year:{
				required : true
			},
			std_graduation_board:{
				required : true
			},
			std_graduation_percentage:{
				required : true
			},
			std_contract:{
				required : true
			},
			std_relocate:{
				required : true
			},
			bond_duration:{
				required : true
			},
			std_job_offers:{
				required : true
			},
			std_company_name:{
				required : true
			},
			std_salary:{
				required : true
			},
			std_job_jdate:{
				required : true
			},
			// std_resume:{
				// required : true
			// },
			std_cirt_name:{
				required : true
			},
			std_got_cirt:{
				required : true
			},
			std_aca_gap_reason:{
				required : true
			},
			std_gra_gap_reason:{
				required : true
			}
			
		},
		messages: {
			std_fname:{
				required: "Required"
			},
			std_lname:{
				required: "Required"
			},
			std_email1:{
				required: "Required",
				email:"Invalid email",
				remote: "Duplicate Entry"
			},
			std_secondary_email:{				
				email:"Invalid email"
			},
			std_phno:{
				required: "Required",
				digits : "Numbers only"
			},
			// std_photo:{
				// required : "Required"
		    // },
		    std_dob:{
				required : "Required"
			},
			std_ssc_year:{
				required : "Required"
			},
			std_ssc_board:{
				required : "Required"
			},
			std_ssc_percentage:{
				required : "Required"
			},
			std_graduation_year:{
				required : "Required"
			},
			std_graduation_board:{
				required : "Required"
			},
			std_graduation_percentage:{
				required : "Required"
			},
			std_contract:{
				required : "Required"
			},
			std_relocate:{
				required : "Required"
			},
			bond_duration:{
				required : "Required"
			},
			std_job_offers:{
				required : "Required"
			},
			std_company_name:{
				required : "Required"
			},
			std_salary:{
				required : "Required"
			},
			std_job_jdate:{
				required : "Required"
			},
			// std_resume:{
				// required : "Required"
			// },
			std_cirt_name:{
				required : "Required"
			},
			std_got_cirt:{
				required : "Required"
			},
			std_aca_gap_reason:{
				required : "Required"
			},
			std_gra_gap_reason:{
				required : "Required"
			}
			
		},
		submitHandler: function(form) {
			if(confirm('Please wait, Your Profile is been updating.')){
				form.submit();
			}
		}
	});

});

function add_click()
{
	$('#skill_count').val(eval($('#skill_count').val()) + 1);
	var skil_no = $('#skill_count').val();
	$('.fields').append ('<tr><td class="first"><strong>Name</strong><span class="complsory">*</span></td><td colspan="3" class="last"><table><tr><td><input type="text" name="skill_name'+skil_no+'" class="text" style="width:200px;"></td><td valign="middle"><table><tr><td width="5%" valign="middle"><input type="radio" value="B" name="skill_proficieny'+skil_no+'" class="text"></td><td width="20%" valign="middle">Beginner</td><td width="5%" valign="middle"><input type="radio" value="M" name="skill_proficieny'+skil_no+'" class="text"></td><td width="20%" valign="middle">Medium</td><td width="5%" valign="middle"><input type="radio" value="G" name="skill_proficieny'+skil_no+'" class="text"></td><td width="20%" valign="middle">Good</td><td width="5%" valign="middle"><input type="radio" value="E" name="skill_proficieny'+skil_no+'" class="text"></td><td width="20%" valign="middle">Excellent</td></tr></table></td><td width="5%"><input type="button" class="btnRemove" value="Delete" onclick="del_click(this)"></td></tr></table></td></tr>');
	//alert($('#skill_count').val());
	   
}
function del_click(obj)
{
	$(obj).parent().parent().parent().parent().parent().parent().remove (); 
	$('#skill_count').val(eval($('#skill_count').val()) - 1);
	//alert($('#skill_count').val());
}
function change_etype(val)
{
	if(val=="N")
	{
		$('#othCou').hide();
	}
	else if(val=="Y")
	{
		$('#othCou').show();
	}

}
function change_graGap(val)
{
	if(val=="N")
	{
		$('#graGap').hide();
	}
	else if(val=="Y")
	{
		$('#graGap').show();
	}

}
function change_acaGap(val)
{
	if(val=="N")
	{
		$('#acadGap').hide();
	}
	else if(val=="Y")
	{
		$('#acadGap').show();
	}
}
function change_bond(val)
{
	if(val=="N")
	{
		$('#bondTR').hide();
	}
	else if(val=="Y")
	{
		$('#bondTR').show();
	}
}
function change_job(val)
{
	if(val=="N")
	{
		$('#jobTR1').hide();
		$('#jobTR2').hide();
	}
	else if(val=="Y")
	{
		$('#jobTR1').show();
		$('#jobTR2').show();
	}
}
function change_otherCol(val)
{
	if(val=="OT")
	{
		$('#OthPGrColl').show();		
	}
	else if(val=="C")
	{
		$('#OthPGrColl').hide();
	}

}
function change_otherGCol(val)
{	
	if(val=="OT")
	{
		$('#OthGrColl').show();		
	}
	else if(val=="C")
	{
		$('#OthGrColl').hide();
	}
}
function change_otherBranch(val)
{	
	if(val=="OTB")
	{
		$('#OthGrBranch').show();		
	}
	/*else if(val=="C")
	{
		$('#OthGrBranch').hide();
	}*/
}
function change_otherPoBranch(val)
{	
	if(val=="OTB")
	{
		$('#OthPGrBranch').show();		
	}
	/*else if(val=="C")
	{
		$('#OthGrBranch').hide();
	}*/
}