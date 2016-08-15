jQuery(document).ready(function($){
    $("#announcementForm").validate({
        rules: {
            announcement_title:{
                required : true	
            },
            announcement_content:{
                required : true
            },
            announcement_date:{
                required : true
            }			
        },
        messages: {
            announcement_title:{
                required: "Required"
            },
            announcement_content:{
                required: "Required"
            },
            announcement_date:{
                required : "Required"
            }
        }
    });
});