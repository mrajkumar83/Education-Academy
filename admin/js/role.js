jQuery(document).ready(function($){
	$("#subjectForm").validate({
		rules: {
			role_name:{
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
		},
		messages: {
			role_name:{
				required: "Required",
				remote: "Duplicate Entry"
			}
		}
	});
});