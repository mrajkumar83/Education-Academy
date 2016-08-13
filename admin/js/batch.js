jQuery(document).ready(function($){
    $("#batchForn").validate({
        rules: {
            batch_name:{
                required : true,
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
            batch_course:{
                required : true
            },
            batch_amount:{
                required : true,
                digits: true
            },      		
            batch_branch:{
                required : true
            },
            batch_startdt :{
                required : true
            },
            batch_enddt :{
                required : true
            }
			
        },
        messages: {
            batch_name:{
                required: "Required",
                remote: "Duplicate Entry"
            },
            batch_course:{
                required: "Required"
            },
            batch_amount:{
                required : "Required",
                digits: "Numbers only"
            },
            batch_hr:{
                required : "Required"
            },
            batch_min:{
                required : "Required"
            },
            batch_ap:{
                required : "Required"
            },
            batch_ampm : {
                required : "Required"
            },
            batch_branch:{
                required: "Required"
            },
            batch_startdt :{
                required: "Required"
            },
            batch_enddt :{
               required: "Required"
            }
        }
    });
});