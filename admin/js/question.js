$().ready(function() {
	$("#questionForm").validate({
		rules: {
			test_id:{
				required : true
			},
			test_question:{
				required : true
			},
			test_option1:{
				required : true
			},
			test_option2:{
				required : true
			},
			test_option3:{
				required : true
			},
			test_option4:{
				required : true
			},
			test_answer:{
				required : true
			}
		},
		messages: {
			test_id:{
				required: "Please select test name."
			},
			test_question:{
				required: "Please enter Question."
			},
			test_option1:{
				required: "Please enter option1."
			},
			test_option2:{
				required: "Please enter option2."
			},
			test_option3:{
				required: "Please enter option3."
			},
			test_option4:{
				required: "Please enter option4."
			},
			test_answer:{
				required: "Please enter  true answer."
			}
		}
	});

});