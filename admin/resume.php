<?php
$step = '2';
$path = '.';
$title = 'Add Resume';
$css = array('styles.css');
$js = array('resume.js');

require_once('includes/common.php');

$db = new Query();
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';

$resume_name = '';
$resume_org_name = '';
$resume_doc = '';
$resume_status = 'A';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_resume ', ' * ', ' resume_id="' . $id . '"');
    $resume_name = $data->resume_name;
    $resume_org_name = $data->resume_org_doc;
    $resume_doc = $data->resume_doc;
    $resume_status = $data->resume_status;
    $pageTitle = 'Edit Resume';
}
?>
    <div id="main">
        <div class="top-bar"><h1><?php echo $title; ?></h1></div>
        <?php require_once('templates/resume.php');?>
    </div>
</body>
</html>

