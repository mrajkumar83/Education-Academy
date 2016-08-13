<div id="main">
<div class="top-bar"><h1><?php echo $title; ?></h1></div>
<div class="content-warp">
	<div class="table">
		<div style="background-color:#fff; padding:3px;" align="right"><input type="button" value="Add New Student" class="addBtn" onclick="document.location.href='payfees.php?op=A';"></div>
		<form method="post" name="enquiryform" id="enquiryform" action="">
			<table cellspacing="0" cellpadding="0" class="listing form">
				<tbody>

					<tr>
						<th colspan="4" class="full">Enquiry Details</th>
					</tr>
					<tr class="bg">
						<td class="first"><strong>First Name</strong><span class="complsory">*</span></td>
						<td class="last"><input type="text" value="<?php echo $enquiry_fname; ?>" id="enquiry_fname" name="enquiry_fname" class="text"></td>
						<td class="first"><strong>Last Name</strong><span class="complsory">*</span></td>
						<td class="last"><input type="text" value="<?php echo $enquiry_lname; ?>" id="enquiry_lname" name="enquiry_lname" class="text"></td>
					</tr>
					<tr>
						<td class="first"><strong>Phone No</strong><span class="complsory">*</span></td>
						<td class="last"><input type="text" value="<?php echo $enquiry_phno; ?>" id="enquiry_phno" name="enquiry_phno" class="text"></td>
						<td class="first"><strong>E-mail</strong><span class="complsory">*</span></td>
						<td class="last"><input type="text" value="<?php echo $enquiry_email; ?>" id="enquiry_email" name="enquiry_email" class="text"></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Student Type</strong><span class="complsory">*</span></td>
						<td class="last" colspan="3">
							<select name="std_type" id="std_type">
								<option value="E">Enquiry</option>
								<option value="S"<?php echo $std_type=='S' ? ' selected="selected"' : '';?>>External Student</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="buttons">
				<input type="submit" value="Submit" name="Add">
			</p>
		</form>
	</div>