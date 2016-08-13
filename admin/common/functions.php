<?php
function array2Table($data) 
{
	if(isset($data) && is_array($data) && count($data))
	{
	echo '<table>';
	foreach($data as $row) 
	{
		echo "<tr>";
		foreach($row as $cell) 
		{
			echo "<td>" . escape($cell) . "</td>";
		}
		echo "</tr>";
	}
	echo '</table>';
	}
	else
	{
		echo "<table><tr><td>No Data Available. It is an empty sheet</td></tr></table>";
	}
}

function debug($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function escape($string) {
	return htmlspecialchars($string, ENT_QUOTES);
}

function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
}
?>