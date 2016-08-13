jQuery(document).ready(function($){
	$("#jobFRM").validate({
		rules: {
			bd_companyname:{
				required : true
			},
			bd_emailid:{
				
				email:true
			},
			bd_percutoff:{
				required : true
			},
			bd_jobtitle:{
				required : true
			},
			bd_joblocation:{
				required : true
			},
			bd_interviewloc:{
				required : true
			},
			bd_interviewdate:{
				required : true
			},
			hr:{
				required : true
			},
			min:{
				required : true
			},
			ampm:{
				required : true
			}
		},
		messages: {
			
			bd_companyname:{
				required: "Required"
			},
			bd_emailid:{
				
				email:"Invalid email"
			},
			bd_percutoff:{
				required: "Required"
			},
			bd_jobtitle:{
				required: "Required"
			},
			bd_joblocation:{
				required: "Required"
			},
			bd_interviewloc:{
				required: "Required"
			},
			bd_interviewdate:{
				required: "Required"
			},
			hr:{
				required : "Required"
			},
			min:{
				required : "Required"
			},
			ampm:{
				required : "Required"
			}
		}
	});
	
});