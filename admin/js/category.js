jQuery(document).ready(function($){
    $("#categoryForm").validate({
        rules: {
            category_name:{
                required : true	
            }			
        },
        messages: {
            category_name:{
                required: "Required"
            }
        }
    });
});