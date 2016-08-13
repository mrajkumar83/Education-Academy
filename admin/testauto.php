<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Fee</title>
<meta name="keywords" content="sark, sarktechnologies, sarktechnologies.net" />
<link rel="stylesheet" type="text/css" href="css/styles.css">
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 -->
 <script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
 <script type="text/javascript" src="js/date/jquery.datepick.js">
</script>
<script>
jQuery.noConflict();
</script>
<script type="text/javascript" src="js/autocomplete/lib/jquery.js"></script>
<script type='text/javascript' src='js/autocomplete/lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='js/autocomplete/lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='js/autocomplete/lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='js/autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript">
			
					
			      $().ready(function() {
					 $("#std_id").autocomplete("get_student.php", {
						 selectFirst: false
				 });
				 $("#std_id").result(function(event, data, formatted) {
					 if (data) 
					 $("#std_name").val(data[0]);
					 $("#batch_name").val(data[1]); 
					 $("#course_name").val(data[3]); 
					 $("#amount_pay").val(data[2]); 
					}); 
				});
				
				
			</script>


<script type="text/javascript" src="js/fee.js"></script>
<script language="javascript" type="text/javascript">
    window.history.forward();
</script>
</head>
<body>
<div id="main">
<div class="top-bar">
  <h1>Add Fee</h1>
</div>

<div class="content-warp">
  <div class="table">
    <form method="post" name="feeForm" id="feeForm" action="./logic/payfees_logic.php?op=A" enctype="multipart/form-data">
      <table cellspacing="0" cellpadding="0" class="listing form">
        <tbody>
          <tr>
            <th colspan="4" class="full">FEES</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Student Id</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="" id="std_id" name="std_id" class="text"></td>
            <td class="first"><strong>Name</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="" id="std_name" name="std_name" readonly="readonly" class="text"></td>
          </tr>
          <tr>
            <td class="first"><strong>Batch</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="" id="batch_name" name="batch_name" readonly="readonly" class="text"></td>
            <td class="first"><strong>Course</strong></td>
            <td class="last"><input type="text" value="" id="course_name" name="course_name" readonly="readonly" class="text"></td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Amount</strong></td>
            <td class="last"><input type="text" value="" id="amount_pay" name="amount_pay" readonly="readonly" class="text"></td>
            <td class="last"><strong>Date of Payment.</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last"><input type="text" value="" id="fee_date" name="fee_date" class="text"></td>
          </tr>
          <tr>
            <td class="first"><strong>Photo</strong></td>
            <td colspan="3" class="last"><input type="file" id="std_photo"   required="required"  name="std_photo" >
              <br />
              &nbsp; </td>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Mode</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last"><select name="fee_mode" id="fee_mode" required="required" tabindex="1">
                <option value="">-- Select --</option>
                <option value="6">cheque</option>
                <option value="3">Mode1</option>
                <option value="2">Mode2</option>
                <option value="4">Mode3</option>
                <option value="8">Mode5</option>
              </select></td>
          </tr>
          <tr>
            <th colspan="4" class="full">Cheque</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Cheque No.</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="" id="cheque_no" name="cheque_no" class="text"></td>
            <td class="first"><strong>Branch</strong><span class="complsory">*</span></td>
            <td class="last"><input type="text" value="" id="branch" name="branch" class="text"></td>
          </tr>
          <tr>
            <td class="first"><strong>Cheque Bank</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last"><input type="text" value="" id="cheque_bank" name="cheque_bank" class="text"></td>
          </tr>
          <tr>
            <th colspan="4" class="full">Installment</th>
          </tr>
          <tr class="bg">
            <td class="first"><strong>Installment</strong></td>
            <td colspan="3" class="last"><input type="radio" class="textarea" name="installment" onclick="change_installment(this.value)" value="Y" checked>
              &nbsp;Yes&nbsp;&nbsp;
              <input type="radio" class="textarea" name="installment" onclick="change_installment(this.value)" value="N">
              &nbsp;No&nbsp; </td>
          </tr>
          <tr id="instdate" style="display">
            <td class="first"><strong>Installment Due Date</strong><span class="complsory">*</span></td>
            <td colspan="3" class="last"><input type="text" value="" id="installment_due_date" name="installment_due_date" class="text"></td>
          </tr>
        </tbody>
      </table>
      <p class="buttons">
        <input name="utype" id="utype" type="hidden" value="">
        <input name="id" id="id" type="hidden" value="">
        <input name="pagefrom" id="pagefrom" type="hidden" value="">
        <input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='manage_staff.php?utype=SF';">
        &nbsp; &nbsp;
        <input name="AddNew" type="submit" value="Submit" class="login gradient" />
      </p>
    </form>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
function change_installment(val)
{
	if(val=="N")
	{
		document.getElementById('instdate').style.display ='none';
	}
	else if(val=="Y")
	{
		document.getElementById('instdate').style.display ='';
	}

}
</script>
</div>
</body>
</html>
