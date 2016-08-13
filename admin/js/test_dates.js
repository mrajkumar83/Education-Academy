// JavaScript Document
jQuery(document).ready(function($){
		$("#test_sdate").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#test_edate").datepicker("option","minDate", selected)
			$("#test_edate").val($('#test_sdate').val())
		}
	});
	$("#test_edate").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#test_sdate").datepicker("option","maxDate", selected)
		}
	});
});
