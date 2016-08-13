jQuery(document).ready(function($){
	$("#subjectForm").validate({
		rules: {
			call_sts_type:{
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
			call_sts_type:{
				required: "Required",
				remote: "Duplicate Entry"
			}
		}
	});
});