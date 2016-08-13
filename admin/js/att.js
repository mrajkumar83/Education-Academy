jQuery(document).ready(function($){
	$("#atttForm").validate({
		rules: {
			batchbranch:{
				required : true
			},
			std_course:{
				required : true
			},
			att_from_date:{
				required : true
			},
			att_to_date:{
				required : true
			}
		},
		messages: {
			batchbranch:{
				required: "Required"
			},
			std_course:{
				required : "Required"
			},
			att_from_date:{
				required : "Required"
			},
			att_to_date:{
				required : "Required"
			}
		}
	});
	
});
function getXMLHTTP() 
{
	var xmlhttp=false;	
	try{
		xmlhttp=new XMLHttpRequest();
	}
	catch(e)	{		
		try{			
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e){
			try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1){
				xmlhttp=false;
			}
		}
	}
		
	return xmlhttp;
}

function get_course(val) 
{
	if(val!='')
	{
	var strURL="get_course.php?batchbranch="+val;
	
	var req = getXMLHTTP();
	if (req) {
		
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				// only if "OK"
				if (req.status == 200) 
				{	
					//txt = req.responseText;
					var res = req.responseText;
					document.getElementById('std_course').value = res ;	
				} 
				else 
				{
					//alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}				
		}			
		req.open("GET", strURL, true);
		req.send(null);
	}		
	}
	else
	{
		
					document.getElementById('std_course').value = '';
	}
}
