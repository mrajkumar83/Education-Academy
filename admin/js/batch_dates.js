// JavaScript Document
jQuery(document).ready(function($){
		$("#batch_startdt").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#batch_enddt").datepicker("option","minDate", selected)
		}
	});
	$("#batch_enddt").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#batch_startdt").datepicker("option","maxDate", selected)
		}
	});
});
