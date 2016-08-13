// JavaScript Document
jQuery(document).ready(function($){
		$("#date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "mm/dd/yy",
	});
	
});
function change_bond(val)
{
    if(val=="N")
    {
        $('#bondTR').hide();
    }
    else if(val=="Y")
    {
        $('#bondTR').show();
    }

}