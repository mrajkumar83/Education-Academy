jQuery(document).ready(function($){
	$("#hrremFrm").validate({
		rules: {
			batchbranch:{
				required : true
			},
			hr_document:{
				required : true
			}
		},
		messages: {
			batchbranch:{
				required: "Required"
			},
			hr_document:{
				required: "Required"
			}
		}
	});
	
});
