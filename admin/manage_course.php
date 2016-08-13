<?php
$step = '2';
$path = '.';

$title = 'Course';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$course = $db->fetchAllRecord(' tb_courses ', ' course_id,course_name,course_desc,course_status ', NULL, NULL, null, NULL, 0, 'All');

function chkCourse($id)
{
    global $db;    
    $enquiry_obj = $db->fetchRecord(' tb_enquiry ', ' count(1) AS cnt ', ' enquiry_course="'.$id.'" ');
    if($enquiry_obj->cnt > 0)
    {
            return false;
    }  
    $batch_obj = $db->fetchRecord(' tb_batch ', ' count(1) AS cnt ', ' batch_course="'.$id.'" ');
    if($batch_obj->cnt > 0)
    {
            return false;
    }  
    return true;
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Course</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Course Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($course)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->course_name, '</td>', "\n";
                echo '<td class="center">', ($data->course_status == 'A' ? '' : 'In-'), 'Active</td>';
                echo '<td class="center"><a href="course.php?op=E&amp;id=', $data->course_id, '" title="Edit course" alt="Edit Course"><div class="img edit"></div></a>&nbsp;';
                if(chkCourse($data->course_id)){
                echo '<a href="../admin/logic/course_logic.php?op=D&amp;id=', $data->course_id, '" title="Delete course" alt="Delete Course"><div class="img delete"></div></a>';
                }else{
                    echo '&nbsp;&nbsp;&nbsp;';
                }
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

