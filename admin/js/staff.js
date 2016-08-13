jQuery(document).ready(function($){
    $("#staffForm").validate({
        rules: {
            staff_fname:{
                required : true
            },
            staff_lname:{
                required : true
            },
            staff_email:{
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
            staff_semail:{	
                email:true
            },
            staff_phno:{
                digits: true
            },
            staff_mobile:{
                required : true,
                digits: true,
                minlength:10
            },
            staff_address:{
                required : true
            },
            user_role:{
                required : true
            },
            user_branch:{
                required : true
            },
            user_name:{
                required : true
            },
            user_password:{
                required : true
            }
			
        },
        messages: {
            staff_fname:{
                required: "Required"
            },
            staff_lname:{
                required: "Required"
            },
            staff_email:{
                required: "Required",
                email:"Invalid email",
                remote: "Duplicate Entry"
            },
            staff_semail:{				
                email:"Invalid email"
            },
            staff_phno:{
                digits: "Numbers only"
            },
            staff_mobile:{
                required: "Required",
                minlength: "Invalid Number",
                digits: "Numbers only"
            },
            staff_address:{
                required: "Required"
            },
            user_role:{
                required: "Required"
            },
            user_branch:{
                required: "Required"
            },
            user_name:{
                required: "Required"
            },
            user_password:{
                required: "Required"
            }
			
        },
		submitHandler: function(form) {
			if(confirm('Please wait, Your Profile is been updating.')){
				form.submit();
			}
		}
    });
	
});