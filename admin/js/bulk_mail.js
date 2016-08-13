jQuery(document).ready(function($){
    $("#mailForm").validate({
        rules: {
            batchbranch:{
                required : true
            },
			subject:{
                required : true
            },
            msg :{
                required : true
            },
			stdlist :{
				 required : true,
				 accept: "[xX][lL][sS][xX]?"
			}
        },
        messages: {
            batchbranch:{
                required: "Required"
            },
            subject:{
                required : "Required"
            },
            msg:{
                required : "Required"
            },
			stdlist :{
				required : "Required",
				accept: " xls(x) only"
			}
        },
		submitHandler: function(form) {
			var content = editor.i.contentWindow.document.body.innerHTML;
			
			if(content == '<br>' || content == '')
			{
				alert('Please enter your Message.');// Editor empty
				return false;
			}
			
			if(confirm('Please wait......')){
				editor.post();
				$('form input[type=submit]').attr('disabled', 'disabled');
				form.submit();
			}
		}
    });
});