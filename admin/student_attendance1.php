<?php
	$step = '2';
	$path = '.';
	$title = 'Student Attendance';
	$css = array('styles.css',  'jquery-ui-1.10.3.custom.css');
	$js = array('manage_att.js','datepicker/js/jquery-1.9.1.js','datepicker/js/jquery-ui-1.10.3.custom.js','att_dates.js');	
	require_once('includes/common.php');
	
	$db = new Query();
	$batch = $db->fetchRecord(' tb_student_details sd, tb_batch b ', ' b.batch_startdt, DATE_FORMAT(b.batch_startdt, "%m/%e/%Y") sdate, b.batch_enddt, DATE_FORMAT(b.batch_enddt, "%m/%e/%Y") edate ',' sd.std_id="'.$_SESSION['UID'].'" AND sd.std_batch=b.batch_id ');
	
	$frm_date =(isset($att_from_date) && $att_from_date!='' && $att_from_date!='0000-00-00')?date("m/d/Y",strtotime($att_from_date)) : $batch->sdate;	
	$end_date =(isset($att_to_date) && $att_to_date!='' && $att_to_date!='0000-00-00')?date("m/d/Y",strtotime($att_to_date)):  $batch->edate;
	$uend_date = strtotime($batch->batch_enddt);
	$current_date = strtotime(date('Y-m-d'));
	
?>

<div id="main">
  <div class="top-bar">
    <h1><?php echo $title;?></h1>
  </div>
  <div class="content-warp">
    <div class="table">
      <form method="post" name="atttForm" id="atttForm" action="">
        <table cellspacing="0" cellpadding="0" class="listing form">
          <tbody>
            <tr>
              <th colspan="4"  class="full">Attendance</th>
            </tr>
        
            <tr class="bg">
              <td class="first"><strong>Attendance&nbsp;From&nbsp;Date:</strong><span class="complsory">*</span></td>
              <td class="last"><input type="text"  class="text" name="att_from_date" id="att_from_date" value="<?php echo $frm_date;?>"></td>
              <td class="first"><strong>Attendance&nbsp;To&nbsp;Date:</strong><span class="complsory">*</span></td>
              <td class="last"><input type="text"  class="text" name="att_to_date" id="att_to_date" value="<?php echo $end_date;?>"></td>
            </tr>
          </tbody>
        </table>
        <p class="buttons">
          <input type="hidden" value="<?php echo $op;?>" name="op">
          <input type="hidden" value="<?php echo $id;?>" name="id">
          &nbsp; &nbsp;
          <input type="submit" value="Submit" name="Add">
        </p>
      </form>
    </div>
    <?php 
if(isset($Add) && $Add == 'Submit')
{
	
	$student = $db->fetchRecord('tb_student_details sd, tb_users u ' , ' sd.std_id, sd.std_fname, sd.std_lname, sd.std_batch, sd.std_branch, u.user_name ', ' sd.std_id="'.$_SESSION['UID'].'" AND u.user_id=sd.std_id  ' , NULL, NULL, NULL,NULL,'All');
		
	$att_batch_id = $student->std_batch;	
	$att_branch = $student->std_branch;	
	
	$cond = " date BETWEEN '".date("Y-m-d",strtotime($att_from_date))."' AND '".date("Y-m-d",strtotime($att_to_date))."' AND att_batch_id='".$att_batch_id."' AND att_branch_id='".$att_branch."' " ;
	$dates =  $db->fetchAllRecord('tb_att_details ' , ' DISTINCT date ', $cond , NULL, 'date', NULL,NULL,'All');
	$dates_td_rows = '';
	$present_days = 0;
	$total_classes_conducted = 0;
	
	if(isset($dates))
	{
		echo '<table cellpadding="2" border="1" cellspacing="1" class="listing form">',"\n\t";
		echo '<tr">',"\n\t";
		echo '<th>&nbsp;Username&nbsp;</th>';
		echo '<th>&nbsp;Name</th>';
		
		
		while($data = mysql_fetch_object($dates))
		{
		  echo '<th>',date("m/d",strtotime($data->date)),'</th>';
			$cond1 = $cond . " ";
		  	$attendance = $db->fetchAllRecord('tb_att_details ' , ' attendance  ', ' date="'.$data->date.'" AND student_id = "'.$student->std_id.'" ' , NULL, 'date', NULL,NULL,'All');
			if($db->getRowCount() > 0){
				while($data2 = mysql_fetch_object($attendance))
				{
					$dates_td_rows .= '<td align="center">'.$data2->attendance.'</td>';
					if($data2->attendance == "P"){  $present_days++; }					
				}
			}else{
				$dates_td_rows .= '<td align="center">A</td>';
			}
			$total_classes_conducted++;
		}//End of while
		echo '<th>&nbsp;Percentage</th>';
		echo '</tr><tr>';
		
			echo '<td align="center">',$student->user_name,'</td>'.'<td>&nbsp;',$student->std_fname,' ',$student->std_lname,'&nbsp;</td>';
		  	echo $dates_td_rows;
			$att_percent = ($total_classes_conducted == 0) ? 0 : (($present_days / $total_classes_conducted)*100);
			$class = 'style="color:#'.(($att_percent<90) ? 'F00' : '0F0').'"';
			echo '<td align="center" ',$class,'>',$att_percent,'</td>';
		  	echo '</tr>';		
		echo '</table>';
	}
  }
?>
  </div>
</div>
</body></html>
<script type="text/javascript">

function getXMLHTTP() 
{
	var xmlhttp=false;	
	try{
		xmlhttp=new XMLHttpRequest();
	}
	catch(e)	{		
		try{			
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e){
			try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1){
				xmlhttp=false;
			}
		}
	}
		
	return xmlhttp;
}

function get_course(val) 
{
	if(val!='')
	{
	var strURL="get_course.php?batchbranch="+val;
	
	var req = getXMLHTTP();
	if (req) {
		
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				// only if "OK"
				if (req.status == 200) 
				{	
					//txt = req.responseText;
					var res = req.responseText;
					document.getElementById('std_course').value = res ;	
				} 
				else 
				{
					//alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}				
		}			
		req.open("GET", strURL, true);
		req.send(null);
	}		
	}
	else
	{
		
					document.getElementById('std_course').value = '';
	}
}

</script>