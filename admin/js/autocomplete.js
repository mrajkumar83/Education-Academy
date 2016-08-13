 jQuery(document).ready(function($){
					 $("#std_id").autocomplete("get_student.php", {
						 selectFirst: false
				 });
				 $("#std_id").result(function(event, data, formatted) {
					 if (data) 
					 $("#std_name").val(data[0]);
					 $("#batch_name").val(data[1]); 
					 $("#course_name").val(data[3]); 
					 $("#amount_pay").val(data[2]); 
					}); 
				});