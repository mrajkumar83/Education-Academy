// JavaScript Document
jQuery(document).ready(function($){
		$("#att_from_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#att_to_date").datepicker("option","minDate", selected)
			$("#att_to_date").val($('#att_from_date').val())
		}
	});
	$("#att_to_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
			onSelect: function(selected) {
			$("#att_from_date").datepicker("option","maxDate", selected)
		}
	});
	
});
function get_course(val) 
{
    if(val!='')
    {
        $.ajax({
            type: "GET",
            url: "get_course.php",
            data: "batchbranch="+val,
            success: function(msg) {
                var txt = msg.split('::');
                $('#std_course_td').html(txt[0]);
                $('#std_course_id').val(txt[1]);
            }
        });
    }
    else
    {
        $('#std_course_td').html('&nbsp;');
    }
}