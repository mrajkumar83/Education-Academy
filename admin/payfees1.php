<?php
	$step = '2';
	$path = '.';
	$title = 'Add Fee';
	$css = array('styles.css', 'jquery.datepick.css');
	$js = array('date/jquery.datepick.js','fee.js');	
	require_once('includes/common.php');
	
	$page_name = "addFee";
	
	$db = new Query();
	$batch = $db->fetchAllRecord(' tb_batch ' , ' 	batch_id,batch_name,batch_status ', ' batch_status = "A" ' , NULL, ' batch_name ', NULL, 0,'All');
	$course = $db->fetchAllRecord(' tb_courses ' , ' course_id,course_name ', NULL , NULL, ' course_name ', NULL, 0,'All');
	$mode = $db->fetchAllRecord(' tb_mode ' , ' mode_id,mode_name,mode_status ', ' mode_status = "A" ' , NULL, ' mode_name ', NULL, 0,'All');
	
	$id = (isset($id) && $id > 0) ? $id : '';
	$op = (isset($op) && $op != '') ? $op  : 'A';
	if($op == 'E' && $id>0)
	{
		$data = $db->fetchRecord(' tb_student_fees AS f LEFT JOIN tb_student_details AS s on f.std_id = s.std_id ', ' f.*,CONCAT(std_fname," ",std_lname) as fullname,std_course,std_batch,std_photo ', ' fee_id='.$id);	
		
		while(list($var, $val)=each($data)) 
		{
			$$var=$val;
		}
		
		$mode1 = $db->fetchRecord(' tb_mode ', ' mode_id,mode_name ', ' mode_id="'.$data->fee_mode.'" ');	
		
		$batch = $db->fetchRecord(' tb_batch ', ' batch_name,batch_amount ', ' batch_id="'.$data->std_batch.'" ');	
		
		$course = $db->fetchRecord(' tb_courses ', ' course_name ', ' course_id="'.$data->std_course.'" ');	
		
		$batch_name = $batch->batch_name;
		
		$fee_amount = $batch->batch_amount;
		
		$course_name = $course->course_name;
		
		$mode_name = $mode1->mode_name;
		
		$fee_fields = $db->fetchAllRecord(' tb_fee_fields ' , ' * ', ' fee_id = '.$data->fee_id .' ' , NULL, NULL, NULL, 0,'All');
				
		$pageTitle = 'Edit Fee';
	}
	else
	{
		$payfee_student_id = '';
		$payfee_name = '';
		$payfee_batch = '';
		$payfee_cource = '';
		$payment_date = '';
		$payfee_photo = '';
		$payfee_mode = '';
		$cheque_no = '';
		$branch = '';
        $cheque_bank = '';
		$installment = 'Y';
		$installment_due_date = '';
				
	}
?>
<div id="main">
		<div class="top-bar"><h1><?php echo $title;?></h1></div>
	<?php 
	require_once('templates/payfees.php');
	?>
</div>
</body>
</html>

