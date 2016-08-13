// JavaScript Document
jQuery(document).ready(function($){
    $("#enquiryform").validate({
        rules: {
            date:{
                required: true
            },
            batchbranch:{
                required: true
            }
        },
        messages: {
            date:{
                required: "<span>Required</span>"
            },
            batchbranch:{
                required: "<span>Required</span>"
            }
        }
    });	
});

function checkAll(source) {
    var checkboxes = $('.chkBox');
    var check = $('#parentChk').is(':checked') ;
    checkboxes.each(function(){
        //$(this).attr('checked',check);
        this.checked = check;
    });
}
    
function chk_remarks(form)
{
    var e_sid = document.getElementById('student_id');
    var e_sname = document.getElementById('student_name');
    var e_idate = document.getElementById('date');
	
	
    if(e_sid.value=='' && e_sname.value=='' && e_idate.value=='')
    {
        alert("Please Enter at least one field");
        return false;
    }
    else
    {
        return true;
    }
    return false
}