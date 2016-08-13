jQuery(document).ready(function($){
	$("#skillFrm").validate({
		rules: {
			skill_name:{
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
			skill_name:{
				required: "Required",
				remote: "Duplicate Entry"
			}
		}
	});
});