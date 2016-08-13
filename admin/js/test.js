jQuery(document).ready(function($){
	$("#testForm").validate({
		rules: {
			test_name:{
				required : true
			},
			test_course:{
				required : true
			},
			test_batch:{
				required : true
			},
			test_branch:{
				required : true
			},
			test_date:{
				required : true
			},
			test_starttime:{
				required : true
			},
			test_endtime:{
				required : true
			},
			test_time:{
				required : true
			}
			
		},
		messages: {
			test_name:{
				required: "Required"
			},
			test_course:{
				required: "Required"
			},
			test_batch:{
				required: "Required"
			},
			test_branch:{
				required: "Required"
			},
			test_date:{
				required: "Required"
			},
			test_starttime:{
				required: "Required"
			},
			test_endtime:{
				required: "Required"
			},
			test_time:{
				required: "Required"
			}
		}
	});
});

