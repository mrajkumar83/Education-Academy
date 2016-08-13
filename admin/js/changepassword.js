$().ready(function() {
	// validate the comment form when it is submitted

	// validate signup form on keyup and submit
	$("#changepassword").validate({
		rules: {
		     oldpassword:{
			      required: true
			},
			 newpassword:{
			    required: true,
				minlength: 6
			},
			confrimpasword: {
				required: true,
				minlength: 6,
			equalTo: "#newpassword"
			}
		},
		messages: {
			oldpassword:{
			      required: "<span>Required</span>"
			},
		    newpassword: {
				required: "<span>Required</span>",
				minlength: "Your password must be at least 6 characters long",
				},
			confrimpasword: {
				required: "<span>Required</span>",
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Please enter the same password as above"
			}
	    }
	});
});