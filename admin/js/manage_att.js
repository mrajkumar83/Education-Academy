jQuery(document).ready(function($){
	$("#atttForm").validate({
		rules: {
			batchbranch:{
				required : true
			},
			att_from_date:{
				required : true
			},
			att_to_date:{
				required : true
			}
		},
		messages: {
			batchbranch:{
				required: "Required"
			},
			att_from_date:{
				required: "Required"
			},
			att_to_date:{
				required: "Required"
			}
		}
	});
});

