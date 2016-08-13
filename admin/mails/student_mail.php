<?php
$body = '<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
        		<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
       			<h1><strong>Account Activated </strong></h1>  
       			<br>
       			<p>Hi ' . $std_fname . ',</p>
       			<p>Your  account is now active. Please use the below login details.<u></u><u></u></p>
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
		      			<td>Email Id : </td><td>' . $std_email . '</td>
		      		</tr>
					<tr>
		      			<td>Phone No. : </td><td>' . $std_phno . '</td>
		      		</tr>
		     	</table>
						
       			<br>
   				<strong>Your Login Details:<hr /></strong>         <br>
				<table>
					<tr>
		      			<td>Username : </td><td>' . $username . '</td>
		      		</tr>
					<tr>
		      			<td>Password : </td><td>' . $pass_word . '</td>
		      		</tr>
				</table>
         		<br><br>
       			
				</div>';