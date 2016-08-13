$().ready(function() {
	$("#loginfrm").validate({
		rules: {
			uemail:{
				required : true
			}
		},
		messages: {
			uemail:{
				required: "Required"
			}
		}
	});
});