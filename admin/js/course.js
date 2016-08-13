jQuery(document).ready(function($){
	$("#courseForm").validate({
		rules: {
			course_name:{
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
			course_amout:{
				required : true
			},
			course_desc:{
				required : true
			}
		},
		messages: {
			course_name:{
				required: "Required",
				remote: "Duplicate Entry"
			},
			course_amout:{
				required: "Required"
			},
			course_desc:{
				required: "Required"
			}
		}
	});
	
});