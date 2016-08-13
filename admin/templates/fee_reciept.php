<?php
$receipt = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Fee Receipt</title>
		<style>
			div{
				margin-top:100px;
				height:100%;
				vertical-align: middle;
			}
			table, td{
				border: 1px solid  #000;
				border-collapse: collapse;
			}
			.no_top_bottom_border{
				border-top: 0px;
				border-bottom: 0px;
			}
		</style>
	</head>
	<body>
		<div>
		<table width="100%" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
				<td>&nbsp;</td>
				<td colspan="4" align="center"><strong>STUDENT FEE RECEIPT</strong></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" align="center">&nbsp;</td>
			</tr>			
		</thead>
		
		<tbody>
			<tr>
				<td align="left"><strong>Slip No:</strong></td>
				<td align="left"colspan="2">ABC'.$fid.'</td>
				<td align="left"><strong>Date</strong></td>
				<td align="left" colspan="2">'.date("m/d/Y",strtotime($std->payment_date)).'</td>
			</tr>
			<tr>
				<td align="left"><strong>Studnet Name</strong></td>
				<td align="left"colspan="2">'.$std->user_fullname.'</td>
				<td align="left"><strong>Branch</strong></td>
				<td align="left" colspan="2">'.$std->branch_name.'</td>
			</tr>
			<tr>
				<td align="left"><strong>Student E-mail</strong></td>
				<td align="left"colspan="2">'.$std->user_email.'</td>
				<td align="left"><strong>Batch</strong></td>
				<td align="left" colspan="2">'.$std->batch_name.'</td>
			</tr>
			<tr>
				<td align="left"><strong>Student Phone</strong></td>
				<td align="left"colspan="2">'.$std->std_phno.'</td>
				<td align="left"><strong>Student Username</strong></td>
				<td align="left" colspan="2">'.$std->user_name.'</td>
			</tr>
			
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="center"><strong>Description</strong></td>
				<td align="center"><strong>Amount</strong></td>
				<td align="left">&nbsp;</td>
				<td align="left" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left"><strong>FEE PAID</strong></td>
				<td align="right">'.$std->paid_amount.'</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" colspan="2">PAN Number: '.$PANNO.'</td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left"><strong>DUE AMOUNT</strong></td>
				<td align="right">'.$std->balance.'</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" colspan="2">TAN Number: '.$TANNO.'</td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left"><strong>NEXT PAYMENT DATE</strong></td>
				<td align="right">'.($std->installment_due_date != '' || $std->installment_due_date == '0000-00-00' ? 'N/A' : date("m/d/Y",strtotime($std->installment_due_date))).'</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" colspan="2">TIN Number: '.$TINNO.'</td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">Signature of Student</td>
				<td align="left" colspan="2" rowspan="5" valign="middle" align="center"><img src="img/logo.jpg" width="100%"></td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
				<td align="left" class="no_top_bottom_border">&nbsp;</td>
			</tr>
			<tr>
				<td align="left" colspan="2"><strong>Total Course Fee</strong></td>
				<td align="right">'.$std->batch_amount.'</td>
				<td align="left" class="no_top_bottom_border">Authorised Signatory</td>
			</tr>
			<tr>
				<td align="left" colspan="2"><strong>Total Course Fee (in words)</strong></td>
				<td align="left" colspan="4">'.$obj->words.'</td>
			</tr>
		</tbody>
	</table>
	</div>
	</body>
</html>';
