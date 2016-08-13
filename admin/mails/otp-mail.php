<?php
$body = '<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
       			<h1><strong>Account Activated </strong></h1>  
       			<br>
       			<p>Hi ' . $std_fname . ',</p>
       			<p>Your  OTP details are given below.</p>
      			<br /><br />
		      	<strong>Your Acount Details:<hr /></strong><br>
	   	   		<table>
					<tr>
		      			<td>First Name : </td><td>' . $std_fname . '</td>
		      		</tr>
					<tr>
		      			<td>Last Name : </td><td>' . $std_lname . '</td>
		      		</tr>
		      		<tr>
		      			<td>Email Id : </td><td>' .  $email. '</td>
		      		</tr>
					<tr>
		      			<td>Phone No. : </td><td>' . $phone . '</td>
		      		</tr>
		     	</table>
						
       			<br>
   				<strong>Your OTP number is:<hr /></strong>         <br>
				<table>
					<tr>
		      			<td>OTP Number : </td><td>' . $otp . '</td>
		      		</tr>
					
				</table>
         		<br><br>
       			
				</div>';