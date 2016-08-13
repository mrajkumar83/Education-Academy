	<div style="width:700px;padding:3px;"><input type="button" value="Add New Student" class="addBtn" onclick="document.location.href='payfees.php?op=A';"></div>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
		<thead>
		<th>Name</th>
		<th>Email</th>
		<th>Phone No.</th>
		<th>Action</th>
		</thead>
		<tbody>
	<?php
	$row = 0;

	while ($data = mysql_fetch_object($std_rec)) {
	
	$class = ($row % 2) ? 'even' : 'odd';
	echo '<tr class="', $class, '">', "\n\t";
	echo '<td>', $data->std_fname, '&nbsp', $data->std_lname, '</td>', "\n";
	echo '<td class="center">', $data->std_phno, '</td>';
	echo '<td class="center">', $data->std_email, '</td>';
	echo '<td class="center"><a href="payfees.php?op=A&amp;ext_std_id=', $data->std_id, '" title="Edit Enquiry" alt="Edit Enquiry"><div class="img edit"></div></a>&nbsp;';
	echo '</td></tr>', "\n";
	$row++;
	}
	?>
		</tbody>
	</table>