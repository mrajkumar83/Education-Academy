jQuery(document).ready(function($){
    $("#enquiryform").validate({
        rules: {
            enquiry_email:{
              email : true  
            },
            enquiry_phno:{
                digits: true
            }	
        },
        messages: {
            enquiry_email:{
              email:"Invalid email"
            },
            enquiry_phno:{
                digits: "Numbers only"
            }
        },
        submitHandler: function(f){
           if($('#enquiry_fname').val()=='' && $('#enquiry_lname').val() == '' && $('#enquiry_phno').val() == '' && $('#enquiry_email').val() == '')
            {
                alert("Please Enter at least one field");
                return;
            }
            $("#enquiryform").submit();
        }//End of Submit
    });
});