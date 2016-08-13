jQuery(document).ready(function($){
    $("#feeForm").validate({
        rules: {
            std_fname:{
                required : true
            },
            std_lname:{
                required : true
            },
            std_phno:{
                required : true,
                digits: true
            },
            std_email:{
                required : true,
                email : true,
                remote: {
                    url: "./logic/validate.php",
                    type: "post",
                    data: {
                        id: function() {
                            return $( "#id" ).val();
                        },
						batchbranch: function(){
							return $( "#batchbranch" ).val();
                        }
                    }
                }
            },
            std_batch:{
                required : true
            },
            batchbranch:{
                required : true,
				remote: {
                    url: "./logic/validate.php",
                    type: "post",
                    data: {
                        id: function() {
                            return $( "#id" ).val();
                        },
						std_email: function(){
							return $( "#std_email" ).val();
                        }
                    }
                }
				
            },
            fee_date:{
                required : true
            },
            fee_mode:{
                required : true
            },
            paid_amount:{
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
            std_phno:{
                required: "Required",
                digits: "Numbers only"                
            },
            std_email:{
                required: "Required",
                email:"Invalid email",
                remote: "Duplicate Entry"
            }, 
            batchbranch:{
                 required: "Required",
				 remote: "Already Registered"
            },
            std_batch:{
                required: "Required"
            },
            fee_date:{
                required: "Required"
            },
            fee_mode:{
                required: "Required"
            },
            paid_amount:{
                required: "Required"
            },
			
            installment_due_date:{
                required: "Required"
            }
        },
		submitHandler: function(form) {
			if($('#balance').val() < 0){
				alert('Please settle the balance and submit.');
				return false;
			}
			form.submit();
		}
    });
});

function verify_field(obj)
{
    var element = $(obj);		
    if(isNaN(new Number(element.val())))
    {
        element.val(element.val().substring(0, element.val().length - 1) );
    }
    else
    {
        var amount_pay = $('#amount_pay');
        var paid_amount = $('#paid_amount');
        var balance = $('#balance');
        var amtpay = (paid_amount.val() == '') ? 0 : paid_amount.val();
        var paidamt = (amount_pay.val() == '') ? 0 : amount_pay.val();

        total_amount = parseFloat(paidamt) - parseFloat(amtpay);
        balance.val(parseFloat(total_amount).toFixed(2));
        
         $('#installment_due_date').removeAttr('required');
        if(parseInt(balance.val()) > 0){
             $('#installment_due_date').attr('required', 'required');
         }
    }			
}

function change_installment(val)
{
	if(val=="N")
	{
		$('#instdate').hide();
		$('#instdate1').hide();
	}
	else if(val=="Y")
	{
	   $('#instdate').show();
	   $('#instdate1').show();
	}

}

function mode_change(val) 
{
	if(val!='')
	{
		$.ajax({
				type: "GET",
				url: "get_mode_fields.php",
				data: "mode_id="+val,
				success: function(msg) {
					$('#modeDiv').html(msg);
				}
			});
	}
}




function get_amount(val) 
{
	if(val!='')
	{
		$.ajax({
			type: "GET",
			url: "get_batch_amount.php",
			data: "batch_id="+val,
			success: function(msg) {
				var res = msg.split("::");
				$('#amount_pay').val(res[0]);
				$('#balance').val(parseInt(res[0])-parseInt($('#paid_amount').val()));
				$('#course_amount').val(res[0]);
				$('#std_course').val(res[2]);
				$('#std_course_td').html(res[1]);
			}
		});
	}
	else
	{
		$('#amount_pay').val(0);
		$('#balance').val(0);
		$('#course_amount').val(0);
		$('#std_course').val('');
		$('#std_course_td').html('&nbsp;');
	}
}
