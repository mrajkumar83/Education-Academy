<?php 
$path = './admin/';

require_once($path . 'common/configure.php');
require_once($path . 'classes/Database.class.php');
require_once($path . 'classes/Query.class.php');

$db = new Query();
if(isset($op) && $op != '')
{
	if($op == 'Y')
	{
		$job_option = 'Y';
	} 
	if($op == 'N')
	{
		$job_option = 'N';
	} 
}

$user  = $db->fetchRecord(' tb_users ', ' user_fullname ', '  user_id = " '.$std_id.' "');
$data = $db->fetchRecord(' tb_job_enquiry ', ' * ', ' 	job_id ="' . $job_id . '" AND std_id = " '.$std_id.' "');

if(isset($data) && $data!= '')
{
	if($data->job_option == $job_option)
	{
		echo "<table style='margin: 250px auto; border: 2px solid #006699' height='200px' width='500px' >
					<tr>
						<td>
							<table style='margin : 0px auto'>
								<tr>
											<td align='center'>Thanks,".strtoupper($user->user_fullname)." </td>
										</tr>
										<tr>
											<td align='center'>Your request has been successfully submitted.</td>
										</tr>
							</table>
						</td>
					</tr>
						
			</table>";
	}
	else {
		{
			$fields = ' job_option = "' . $job_option . '"';
			$store = $db->storeDetails(' tb_job_enquiry ', $fields, ' where  job_id ="' . $job_id . '" AND std_id = " '.$std_id.' "');
		    if(isset($store) && $store != '')
			{
				echo "<table style='margin: 250px auto; border: 2px solid #006699' height='200px' width='500px' >
						<tr>
							<td>
								<table style='margin : 0px auto'>
									<tr>
												<td align='center'>Thanks,".strtoupper($user->user_fullname)." </td>
											</tr>
											<tr>
												<td align='center'>Your request has been successfully submitted.</td>
											</tr>
								</table>
							</td>
						</tr>
					</table>";
			}
		}
	}
	
}
else {
	$fields = ' job_id = "' . $job_id . '", std_id = "' . $std_id . '", job_option = "' . $job_option . '"';
	$store = $db->storeDetails(' tb_job_enquiry ', $fields);
	if(isset($store) && $store != '')
	{
		echo "<table style='margin: 250px auto; border: 2px solid #006699' height='200px' width='500px' >
					<tr>
						<td>
							<table style='margin : 0px auto'>
								<tr>
											<td align='center'>Thanks,".strtoupper($user->user_fullname)." </td>
										</tr>
										<tr>
											<td align='center'>Your request has been successfully submitted.</td>
										</tr>
							</table>
						</td>
					</tr>
					</table>";
	}
	
}

?>
