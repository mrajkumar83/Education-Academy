jQuery(document).ready(function($){
    $("#branchForm").validate({
        rules: {
            branch_name:{
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
            }
        /*,
			branch_short_name:{
				required : true
			},
			branch_address:{
				required : true
			}*/
        },
        messages: {
            branch_name:{
                required: "Required",
                remote: "Duplicate Entry"
            }
        /*,
			branch_short_name:{
				required: "Please enter branch short name."
			},
			branch_address:{
				required: "Please enter address."
			}*/
        }
    });
	
});