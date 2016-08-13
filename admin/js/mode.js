jQuery(document).ready(function($){
	$("#modeForm").validate({
		rules: {
			mode_name:{
				required : true,
				remote: {
							url: "./logic/validate.php",
							type: "post",
							data: {
									id: function() {
										return $( "#id" ).val();
									}
								}
						}	
			}
		},
		messages: {
			mode_name:{
				required: "Required",
				remote: "Duplicate Entry"
			}
		}
	});	
});

function add_click()
{
	$('.fields').append (  
			'<tr class="bg"><td class="first"><strong>Field Name</strong></td><td colspan="3" class="last"><input type="text" name="mode_fields[]" />&nbsp;&nbsp;&nbsp;<input type="button" class="btnRemove" value="Delete" onclick="del_click(this)"></td></tr>'                    
		);
}
function del_click(obj)
{
	$(obj).parent().parent().remove (); 
}

 	