<?php
$body='<div  style="float:left;width:960px;	height: 500px; background: #fff; padding-left:15px;"> 
					<!-- Begin Nav DIV --><!-- End Sidebar DIV -->
					<h1><strong>Account Activated </strong></h1>  
					<br>
					<p>Hi '.$rec->user_fullname.',</p>
					<br /><br />
					<br>
					<strong>Your Login Details:<hr /></strong>         <br>
					<table>
						<tr>
							<td>Username : </td><td>'.$rec->user_name.'</td>
						</tr>
						<tr>
							<td>Password : </td><td>'.$user_password.'</td>
						</tr>
					</table>
					<br><br>
					
					</div>';