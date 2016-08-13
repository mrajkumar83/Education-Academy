<?php
require_once('common/configure.php');
  
mysql_connect(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD);
mysql_select_db(DATABASE_NAME);

extract($_GET); extract($_POST);



$sql = "select * from tb_mode_fields where mode_id='".$mode_id."' ";
$result = mysql_query($sql);
$i=0;
if(mysql_num_rows($result))
{
	$sql_mode ="select mode_name from tb_mode where mode_id='".$mode_id.'" ';
	$res = mysql_query($sql_mode);
	$row = mysql_fetch_array($res);
	
?>
 <input type="hidden" name="mode_fields_count" value="<?php echo mysql_num_rows($result);?>" />
	<table cellspacing="0" cellpadding="0" class="listing form">
    	<!--<tr>
        	<th colspan="4" class="full"><?php echo ucfirst($row['mode_name']);?></th>
        </tr>--><?php
		
	while($items= mysql_fetch_object($result))
	{
		$i++;
		echo '
		<tr class="bg">
            <td class="first" width="23%"><strong>'.$items->mode_field_name.'</strong><span class="complsory">*</span></td>
            <td class="last" width="77%" colspan="3"><input type="text" id="mode_field_value'.$i.'" name="mode_field_value'.$i.'" class="text required" title=" Required">
			<input type="hidden" id="mode_field_name'.$i.'" name="mode_field_name'.$i.'" value="'.$items->mode_field_name.'" class="text required" title=" Required"></td>
			</tr>';
			
	}  ?>
    </table>
   
	<?php	
}

?>