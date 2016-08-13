jQuery(document).ready(function($){
	$("#optFRM").validate({
		rules: {
			fname:{
				required : true
			},
			lname:{
				required : true
			},
			phno:{
				required : true,
				digits : true,
				maxlength:10,
				minlength:10,
				remote: {
							url: "./admin/logic/validate.php",
							type: "post"
						}
			},
			std_email:{
				required : true,
				email:true
			}
		},
		messages: {
			fname:{
				required: "Required"
			},
			lname:{
				required : "Required"
			},
			phno:{
				required : "Required",
				digits : "Numbers only",
				maxlength: "Valid Mobile Number",
				minlength: "Valid Mobile Number",
				remote: 'Already Registered'
			},
			std_email:{
				required: "Required",
				email:"Invalid email"
				//remote: "Duplicate Entry"
			}
		}
	});
	
});