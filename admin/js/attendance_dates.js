// JavaScript Document
jQuery(document).ready(function($){
		$("#att_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy"
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
                console.log(msg);
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