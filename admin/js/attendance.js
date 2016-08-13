jQuery(document).ready(function($){
	$("#attForn").validate({
		rules: {
			batchbranch:{
				required : true
			},
			att_document:{
				required : true
			}
		},
		messages: {
			batchbranch:{
				required: "Required"
			},
			att_document:{
				required: "Required"
			}
		}
	});
	
});
