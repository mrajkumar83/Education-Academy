jQuery(document).ready(function($){
				$('#grid-data').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
			} );
function del(loc){
	if(confirm('This record will be deleted. Are you sure you wanted to continue?'))
	{
		document.location.href = loc;
	}
}