// JavaScript Document
jQuery(document).ready(function($){
		$("#fee_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#installment_due_date").datepicker("option","minDate", selected)
		}
	});
	$("#installment_due_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#fee_date").datepicker("option","maxDate", selected)
		}
	});
});
