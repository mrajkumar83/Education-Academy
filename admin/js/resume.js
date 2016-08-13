jQuery(document).ready(function($){
	$("#resumeFrm").validate({
		rules: {
			resume_name:{
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
			resume_doc : {
				accept: "(docx?|pdf)"
			}
		},
		messages: {
			resume_name:{
				required: "Required",
				remote: "Duplicate Entry"
			},
			resume_doc : {
				required: "Required",
				accept: "Only following extensions are allowed Doc(x)|Pdf"
			}
		}
	});	
}); 	