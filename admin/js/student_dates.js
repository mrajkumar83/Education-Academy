// JavaScript Document
jQuery(document).ready(function($){
		$("#std_dob").datepicker({
			 changeMonth: true,
                        changeYear: true,
						yearRange: '-50y:c+nn',
            			maxDate: '-15y',
                        dateFormat: "mm/dd/yy"
	});
	
	$("#std_job_jdate").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			
	});
});
