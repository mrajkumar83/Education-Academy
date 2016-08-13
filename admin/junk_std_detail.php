<?php
	$step = '2';
	$path = '.';
	$title = 'Add Enquiry ';
	$css = array('styles.css','jquery-ui-1.10.3.custom.css');
	$js = array('enquiry.js','datepicker/js/jquery-1.9.1.js','datepicker/js/jquery-ui-1.10.3.custom.js','enquiry_dates.js');	
	require_once('includes/common.php');
	$db = new Query();
	$batch = $db->fetchAllRecord('tb_batch ' , ' batch_id ,batch_name,batch_course ', ' batch_status="A"' , NULL, 'batch_name', NULL,NULL,'All');
	$course = $db->fetchAllRecord('tb_courses ' , ' course_id,course_name ', NULL , NULL, 'course_name', NULL,NULL,'All');
	
	
	$call_sts = $db->fetchAllRecord(' tb_call_sts ' , ' call_sts_id,call_sts_type ', ' call_sts_status="A"' , NULL, 'call_sts_type', NULL, NULL,'All');
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_enquiry ', ' * ', ' 	enquiry_id="'.$id.'"');	
	
		$batch_rec = $db->fetchRecord(' tb_batch ', ' batch_name,batch_amount,batch_course ', ' batch_id="'.$data->enquiry_batch.'" ');	
		
		$course_rec = $db->fetchRecord(' tb_courses ', ' course_name ', ' course_id="'.$batch_rec->batch_course.'" ');	
		$course_name = $course_rec->course_name;
		
		if(isset($data->enquiry_crtdate) && $data->enquiry_crtdate!='' && $data->enquiry_crtdate!='0000-00-00')
		{
			$data->enquiry_crtdate = date("m/d/Y",strtotime($data->enquiry_crtdate));
		}
		if(isset($data->enquiry_dob) && $data->enquiry_dob!='' && $data->enquiry_dob!='0000-00-00')
		{
			$data->enquiry_dob = date("m/d/Y",strtotime($data->enquiry_dob));
		}
		
		$data1 = $db->fetchRecord(' tb_call_sts ',' call_sts_type ',' call_sts_id='.$data->enquiry_call1_status,NULL, 'call_sts_type', NULL, 0,'All');
		$call1_sts_value = $data1->call_sts_type;
		$data2 = $db->fetchRecord(' tb_call_sts ',' call_sts_type ',' call_sts_id='.$data->enquiry_call2_status,NULL, 'call_sts_type', NULL, 0,'All');
		$call2_sts_value = $data2->call_sts_type;
		while(list($var, $val)=each($data)) 
		{
			$$var=$val;
		}
		
		/*$enquiry_fname = $data->enquiry_fname;
		$enquiry_lname = $data->enquiry_lname;
		$enquiry_pnno = $data->enquiry_pnno;
		$enquiry_email = $data->enquiry_email;
		$enquiry_course = $data->enquiry_course;
		$enquiry_batch = $data->enquiry_batch;
		$enquiry_comments = $data->enquiry_comments;
		$enquiry_type = $data->enquiry_type;
		$enquiry_status = $data->enquiry_status;
		$enquiry_call1_comments = $data->enquiry_call1_comments;
		$enquiry_call1_status = $data->enquiry_call1_status;
		$enquiry_call2_comments = $data->enquiry_call2_comments;
		$enquiry_call2_status = $data->enquiry_call2_status;
		$enquiry_dob = $data->enquiry_dob;
		$enquiry_date = $data->enquiry_date;*/
		
		$pageTitle = 'Edit Enquiry';
	}
?>
<div id="main">
	<div class="top-bar"><h1><?php echo $pageTitle;?></h1></div>
	<?php 
	require_once('./templates/junk_std_detail.php');
	?>
</div>
</body>
</html>

