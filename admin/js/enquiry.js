jQuery(document).ready(function($){
    $("#enquiryform").validate({
        rules: {
            enquiry_fname:{
                required : true
            },
            enquiry_lname:{
                required : true
            },
            enquiry_phno:{
                required : true,
                digits : true
            },
            enquiry_email:{
                required : true,
                email : true
            },
            enquiry_course:{
                required : true
            },
            batchbranch:{
                required : true
            },
            enquiry_comments:{
                required : true
            },
            enquiry_call1_status:{
                required : true
            }
        },
        messages: {
            enquiry_fname:{
                required: "Required"
            },
            enquiry_lname:{
                required: "Required"
            },
            enquiry_phno:{
                required: "Required",
                digits : "Numbers only"
            },
            enquiry_email:{
                required: "Required",
                email:"Invalid email"
            },
            enquiry_course:{
                required: "Required"
            },
            batchbranch:{
                required: "Required"
            },
            enquiry_comments:{
                required: "Required"
            },
            enquiry_call1_status:{
                required: "Required"
            }
        }
    });
});

function change_etype(val)
{
    if(val=="Direct")
    {
        $('#callTR1').hide();
        $('#callTR2').hide();
        $('#callTR3').hide();
    }
    else if(val=="Call")
    {
        $('#callTR1').show();
        $('#callTR2').show();
        $('#callTR3').show();            
    }

}

function get_amount(val) 
{
    $('#amount_pay').val(0);
    $('#enquiry_course').val(0);
    $('#td_course_id').html('');
        
    if(val!='')
    {             
        $.ajax({
            type: "GET",
            url: "get_batch_amount.php",
            data: "batch_id="+val,
            success: function(msg) {
                txt = msg;
                var res = txt.split("::");
                $('#amount_pay').val(res[0]);
                $('#enquiry_course').val(res[2]);
                $('#td_course_id').html(res[1]);
            }
        });
    }
}
                   