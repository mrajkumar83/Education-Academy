<div class="top-bar">
	<h1>Change Password</h1>
</div>
<form action="changepassword.php" name="changepassword" id="changepassword" method="post" target="_self">
<table cellspacing="0" cellpadding="0" class="listing form" width="100%">
			  <tbody><tr>
			    <th colspan="2" align="left">&nbsp;&nbsp;Change Password</th>
			    </tr>
				<tr>
			    <?php
			    if(isset($id) && isset($uname) && ($id != '') && ($uname != ''))
				{
				?>
					<td class="first"><strong>User ID</strong></td>
					<td class="last"><?php echo $uname;?></td>
				<?php
				}
				else
				{
				?>
                    <td class="first"><strong>Old Password</strong></td>
					<td class="last"><input type="password" name="oldpassword" id="oldpassword" value="" alt="Old Password" title="Old Password"  placeholder="Oldpassword "></td>
				<?php
				}
				?>
				</tr>
				
				<tr class="bg">
					<td class="first"><strong>New Password</strong></td>
					<td class="last"><input type="password" name="newpassword" id="newpassword" value="" alt="New Password" title="New Password"  placeholder="********" /></td>
		      </tr>
			  <tr>
                    <td class="first"><strong>Confrim Password</strong></td>
					<td class="last"><input type="password" name="confrimpasword" id="confrimpasword" value="" alt="Confrim Password" title="Confrim Password"   placeholder="******** "></td>
				</tr>
				    </tr>
				</table>
				<div class="label"> </div>
				  <p class="buttons">
					<input type="submit" value="Submit" class="login gradient" alt="Submit" name="changepassword" title=""/>
					&nbsp;
					<input type="reset" value="Reset" class="login cancel" alt="Reset" title="Reset" />&nbsp;&nbsp;
					<?php
					if(isset($id) && isset($uname) && $id !='' && $uname != '')
								{
									if(isset($type) && $type == 'SD')
									{
										?>
										<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='manage_stddetails.php?utype=SD';">
                                    <?php										
									}
									if(isset($type) && $type == 'GS')
									{
										?>
										<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='manage_stddetails.php?utype=GS';">
					
									<?php										
									}
									if(isset($type) && $type == 'AS')
									{
										?>
										<input name="Cancel" type="button" value="Cancel" class="login cancel" onclick="javascript: window.document.location.href='manage_staff.php';">
					            <?php
					            }
					
					
								}
								?>
				  </p>
				  <input type="hidden" name="id" value="<?php echo $id;?>" />
				  <input type="hidden" name="uname" value="<?php echo $uname; ?>" />
				  <input type="hidden" name="type" value="<?php echo $type ;?>"
				</form>
	</div>
</body>
</html>